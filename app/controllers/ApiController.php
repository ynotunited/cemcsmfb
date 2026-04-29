<?php
require_once APP_ROOT . '/app/Controller.php';
require_once APP_ROOT . '/config/db.php';
require_once APP_ROOT . '/app/helpers/CsrfHelper.php';
require_once APP_ROOT . '/app/helpers/ReCaptcha.php';
require_once APP_ROOT . '/app/helpers/Mailer.php';
require_once APP_ROOT . '/app/helpers/ChatbotHelper.php';
require_once APP_ROOT . '/app/helpers/LeadScoringHelper.php';
require_once APP_ROOT . '/app/helpers/UploadQualityHelper.php';
require_once APP_ROOT . '/app/models/CvApplication.php';
require_once APP_ROOT . '/app/models/ChatbotInteraction.php';
require_once APP_ROOT . '/app/models/LeadScore.php';
require_once APP_ROOT . '/app/models/FormAbandonment.php';

class ApiController extends Controller {

    // ─── Shared helpers ───────────────────────────────────────────────────────

    private function jsonResponse(array $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /** Replacement for deprecated FILTER_SANITIZE_STRING */
    private function sanitizeString(?string $value): string {
        if ($value === null) return '';
        return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
    }

    private function readJsonBody(): array {
        $raw = file_get_contents('php://input');
        if (!$raw) {
            return [];
        }
        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    /** Run CSRF + reCAPTCHA guards. Returns error response and exits on failure. */
    private function guardRequest(string $recaptchaAction = ''): void {
        // CSRF
        if (!CsrfHelper::verify()) {
            $this->jsonResponse(['error' => 'Invalid or expired security token. Please refresh the page and try again.'], 403);
        }

        // reCAPTCHA v3
        $token = $_POST['g-recaptcha-response'] ?? '';
        if (!ReCaptcha::verify($token, $recaptchaAction)) {
            $this->jsonResponse(['error' => 'reCAPTCHA verification failed. Please try again.'], 403);
        }
    }

    // ─── Contact form ─────────────────────────────────────────────────────────

    public function processContact(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Invalid method'], 405);
        }

        $this->guardRequest('contact');

        $name     = $this->sanitizeString($_POST['name']     ?? '');
        $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $category = $this->sanitizeString($_POST['category'] ?? '');
        $message  = $this->sanitizeString($_POST['message']  ?? '');
        $phone    = $this->sanitizeString($_POST['phone']    ?? '');

        if (!$name || !$email || !$message) {
            $this->jsonResponse(['error' => 'Missing required fields'], 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->jsonResponse(['error' => 'Invalid email address'], 400);
        }

        try {
            $pdo  = DB::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([$name, $email, $phone, $message]);

            // ── Email: notify staff ──────────────────────────────────────────
            $categoryLabel = ucfirst($category ?: 'inquiry');
            Mailer::notifyStaff(
                "New Contact Message — {$categoryLabel}",
                "<h2>New {$categoryLabel} from {$name}</h2>
                 <p><strong>Email:</strong> {$email}</p>
                 <p><strong>Phone:</strong> " . ($phone ?: 'Not provided') . "</p>
                 <p><strong>Message:</strong><br>{$message}</p>"
            );

            // ── Email: confirm to sender ─────────────────────────────────────
            Mailer::confirmApplicant(
                $email,
                $name,
                'We received your message — CEMCS MFB',
                "<p>Dear {$name},</p>
                 <p>Thank you for reaching out to Chevron CEMCS MFB. We have received your message and a member of our support team will respond within <strong>1–2 business days</strong>.</p>
                 <p>If your matter is urgent, please call us at <strong>+234 (0) 1 234 5678</strong> (Mon–Fri, 8:00 AM – 4:00 PM).</p>
                 <p>Warm regards,<br><strong>CEMCS MFB Support Team</strong></p>"
            );

            $this->jsonResponse(['success' => true, 'message' => 'Message securely received']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Could not save message. Please try again.'], 500);
        }
    }

    // ─── Account opening ──────────────────────────────────────────────────────

    public function processOpenAccount(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Invalid method'], 405);
        }

        $this->guardRequest('open_account');

        $firstName  = $this->sanitizeString($_POST['first_name']  ?? '');
        $lastName   = $this->sanitizeString($_POST['last_name']   ?? '');
        $email      = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone      = $this->sanitizeString($_POST['phone']       ?? '');
        $department = $this->sanitizeString($_POST['department']  ?? '');
        $employeeId = $this->sanitizeString($_POST['employee_id'] ?? '');
        $incomeBand = $this->sanitizeString($_POST['income_band'] ?? '');
        $bvn        = $this->sanitizeString($_POST['bvn']         ?? '');

        if (!$firstName || !$bvn) {
            $this->jsonResponse(['error' => 'Incomplete data provided'], 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->jsonResponse(['error' => 'Invalid email address'], 400);
        }

        if (!preg_match('/^\d{11}$/', $bvn)) {
            $this->jsonResponse(['error' => 'BVN must be exactly 11 digits'], 400);
        }

        $fullName = trim($firstName . ' ' . $lastName);

        try {
            $pdo  = DB::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO account_applications
                    (account_type, full_name, dob, phone, email, address, occupation, status)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                'personal',
                $fullName,
                '1900-01-01', // DOB not collected in this form step
                $phone,
                $email,
                $department,
                $employeeId ?: 'Chevron Employee',
                'new',
            ]);
            $applicationId = (int) $pdo->lastInsertId();
            $scoreData = LeadScoringHelper::scoreAccount([
                'full_name' => $fullName,
                'email' => $email,
                'phone' => $phone,
                'occupation' => $employeeId ?: 'Chevron Employee',
                'address' => $department,
                'status' => 'new',
            ]);
            LeadScore::upsert('account', $applicationId, $scoreData['score'], $scoreData['priority'], $scoreData['reasons']);
            FormAbandonment::markConverted('open_account', (string) $email);

            $reference = 'ACC-' . rand(1000, 9999);

            // ── Email: notify staff ──────────────────────────────────────────
            Mailer::notifyStaff(
                "New Account Application — {$fullName}",
                "<h2>New Account Opening Request</h2>
                 <p><strong>Reference:</strong> {$reference}</p>
                 <p><strong>Name:</strong> {$fullName}</p>
                 <p><strong>Email:</strong> {$email}</p>
                 <p><strong>Phone:</strong> {$phone}</p>
                 <p><strong>Department:</strong> " . ($department ?: 'Not provided') . "</p>
                 <p><strong>Employee ID:</strong> " . ($employeeId ?: 'Not provided') . "</p>
                 <p><strong>Income Band:</strong> {$incomeBand}</p>
                 <p>Please log in to the <a href='" . APP_URL . "/admin/dashboard'>Admin Dashboard</a> to review.</p>"
            );

            // ── Email: confirm to applicant ──────────────────────────────────
            Mailer::confirmApplicant(
                $email,
                $fullName,
                "Account Application Received — {$reference}",
                "<p>Dear {$firstName},</p>
                 <p>We have received your account opening application. Your reference number is <strong>{$reference}</strong>.</p>
                 <p>A CEMCS MFB representative will contact you within <strong>24–48 hours</strong> to complete the process.</p>
                 <p>Please keep your reference number safe for follow-up enquiries.</p>
                 <p>Warm regards,<br><strong>CEMCS MFB Onboarding Team</strong></p>"
            );

            $this->jsonResponse(['success' => true, 'reference' => $reference]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Could not save application. Please try again.'], 500);
        }
    }

    // ─── Loan application ─────────────────────────────────────────────────────

    public function processLoan(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Invalid method'], 405);
        }

        $this->guardRequest('loan_application');

        $loanType         = $this->sanitizeString($_POST['loan_type']         ?? '');
        $amount           = filter_input(INPUT_POST, 'amount',         FILTER_VALIDATE_FLOAT);
        $duration         = filter_input(INPUT_POST, 'duration',        FILTER_VALIDATE_INT);
        $employmentStatus = $this->sanitizeString($_POST['employment_status'] ?? '');
        $monthlyIncome    = filter_input(INPUT_POST, 'monthly_income',  FILTER_VALIDATE_FLOAT) ?: 0;
        $businessName     = $this->sanitizeString($_POST['business_name']     ?? '');
        $accountNumber    = $this->sanitizeString($_POST['account_number']    ?? '');

        $allowedLoanTypes = ['personal', 'auto', 'mortgage'];
        if (!in_array($loanType, $allowedLoanTypes, true)) {
            $this->jsonResponse(['error' => 'Please choose a valid loan type.'], 400);
        }

        if (!$amount || $amount < 50000) {
            $this->jsonResponse(['error' => 'Loan amount must be at least ₦50,000.'], 400);
        }

        if (!$duration || $duration < 1) {
            $this->jsonResponse(['error' => 'Repayment duration is required.'], 400);
        }

        if (!$employmentStatus) {
            $this->jsonResponse(['error' => 'Employment status is required.'], 400);
        }

        if (!preg_match('/^\d{10}$/', $accountNumber)) {
            $this->jsonResponse(['error' => 'Account number must be exactly 10 digits.'], 400);
        }

        // ── Secure file uploads ──────────────────────────────────────────────
        $uploadDir    = APP_ROOT . '/uploads/';
        $allowedMimes = ['application/pdf', 'image/jpeg', 'image/png'];
        $maxSize      = 2 * 1024 * 1024; // 2 MB

        $uploadedDocs = [];

        foreach (['payslip', 'id_document'] as $fileKey) {
            if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES[$fileKey]['tmp_name'];
                $size    = $_FILES[$fileKey]['size'];
                $mime    = mime_content_type($tmpName);

                if (!in_array($mime, $allowedMimes)) {
                    $this->jsonResponse(['error' => "Invalid file format for {$fileKey}. Only PDF/JPEG/PNG allowed."], 400);
                }

                if ($size > $maxSize) {
                    $this->jsonResponse(['error' => "File too large for {$fileKey}. Max 2 MB."], 400);
                }

                $quality = UploadQualityHelper::validateDocument($tmpName, (string) $mime);
                if (!($quality['ok'] ?? false)) {
                    $this->jsonResponse(['error' => $quality['error'] ?? "Uploaded file quality is too low for {$fileKey}."], 400);
                }

                $ext     = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
                $newName = uniqid($fileKey . '_') . '.' . $ext;

                if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                    $uploadedDocs[$fileKey] = $newName;
                }
            }
        }

        try {
            $pdo  = DB::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO loan_applications
                    (loan_type, amount, duration, employment_status, monthly_income, business_name, documents, status)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                $loanType,
                $amount,
                $duration,
                $employmentStatus,
                $monthlyIncome,
                $businessName,
                json_encode($uploadedDocs),
                'new',
            ]);
            $loanId = (int) $pdo->lastInsertId();
            $scoreData = LeadScoringHelper::scoreLoan([
                'loan_type' => $loanType,
                'amount' => $amount,
                'duration' => $duration,
                'employment_status' => $employmentStatus,
                'monthly_income' => $monthlyIncome,
                'documents' => json_encode($uploadedDocs),
                'status' => 'new',
            ]);
            LeadScore::upsert('loan', $loanId, $scoreData['score'], $scoreData['priority'], $scoreData['reasons']);

            $reference    = 'L-' . strtoupper(uniqid());
            $amountFormatted = '₦' . number_format($amount, 2);
            $docCount     = count($uploadedDocs);

            // ── Email: notify staff ──────────────────────────────────────────
            Mailer::notifyStaff(
                "New Loan Application — {$reference}",
                "<h2>New Loan Application Received</h2>
                 <p><strong>Reference:</strong> {$reference}</p>
                 <p><strong>Account Number:</strong> " . ($accountNumber ?: 'Not provided') . "</p>
                 <p><strong>Loan Type:</strong> " . ucfirst($loanType) . "</p>
                 <p><strong>Amount Requested:</strong> {$amountFormatted}</p>
                 <p><strong>Duration:</strong> {$duration} months</p>
                 <p><strong>Employment Status:</strong> {$employmentStatus}</p>
                 <p><strong>Documents Uploaded:</strong> {$docCount}</p>
                 <p>Please log in to the <a href='" . APP_URL . "/admin/dashboard'>Admin Dashboard</a> to review.</p>"
            );

            $this->jsonResponse([
                'success'   => true,
                'reference' => $reference,
                'documents' => $uploadedDocs,
            ]);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Could not save application. Please try again.'], 500);
        }
    }

    // ─── CV / Job application ─────────────────────────────────────────────────

    public function processCvApplication(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Invalid method'], 405);
        }

        $this->guardRequest('cv_application');

        $fullName  = $this->sanitizeString($_POST['full_name']  ?? '');
        $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone     = $this->sanitizeString($_POST['phone']      ?? '');
        $whatsapp  = $this->sanitizeString($_POST['whatsapp']   ?? '');
        $position  = $this->sanitizeString($_POST['position']   ?? '');
        $coverNote = $this->sanitizeString($_POST['cover_note'] ?? '');

        if (!$fullName || !$email || !$position) {
            $this->jsonResponse(['error' => 'Name, email and position are required.'], 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->jsonResponse(['error' => 'Invalid email address.'], 400);
        }

        // ── CV file upload ───────────────────────────────────────────────────
        if (empty($_FILES['cv_file']) || $_FILES['cv_file']['error'] !== UPLOAD_ERR_OK) {
            $this->jsonResponse(['error' => 'Please attach your CV file.'], 400);
        }

        $uploadDir    = APP_ROOT . '/uploads/cv/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $allowedMimes = ['application/pdf', 'application/msword',
                         'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $maxSize      = 5 * 1024 * 1024; // 5 MB

        $tmpName = $_FILES['cv_file']['tmp_name'];
        $mime    = mime_content_type($tmpName);
        $size    = $_FILES['cv_file']['size'];

        if (!in_array($mime, $allowedMimes)) {
            $this->jsonResponse(['error' => 'CV must be a PDF or Word document (.pdf, .doc, .docx).'], 400);
        }
        if ($size > $maxSize) {
            $this->jsonResponse(['error' => 'CV file must be under 5 MB.'], 400);
        }

        if ($mime === 'image/jpeg' || $mime === 'image/png') {
            $quality = UploadQualityHelper::validateDocument($tmpName, (string) $mime);
            if (!($quality['ok'] ?? false)) {
                $this->jsonResponse(['error' => $quality['error'] ?? 'CV image is blurry. Please upload a clearer file.'], 400);
            }
        }

        $ext     = strtolower(pathinfo($_FILES['cv_file']['name'], PATHINFO_EXTENSION));
        $cvFile  = uniqid('cv_') . '_' . preg_replace('/[^a-z0-9]/i', '_', $fullName) . '.' . $ext;

        if (!move_uploaded_file($tmpName, $uploadDir . $cvFile)) {
            $this->jsonResponse(['error' => 'Could not save CV file. Please try again.'], 500);
        }

        try {
            $pdo  = DB::getInstance();
            $stmt = $pdo->prepare(
                'INSERT INTO cv_applications (full_name, email, phone, whatsapp, position, cv_file, cover_note, status)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([$fullName, $email, $phone, $whatsapp, $position, $cvFile, $coverNote, 'new']);

            // ── Email: notify HR & info ──────────────────────────────────────
            $body = "<h2>New CV Application — {$position}</h2>
                     <p><strong>Name:</strong> {$fullName}</p>
                     <p><strong>Email:</strong> {$email}</p>
                     <p><strong>Phone:</strong> " . ($phone ?: 'Not provided') . "</p>
                     <p><strong>WhatsApp:</strong> " . ($whatsapp ?: 'Not provided') . "</p>
                     <p><strong>Position:</strong> {$position}</p>
                     <p><strong>Cover Note:</strong><br>" . (nl2br($coverNote) ?: 'None') . "</p>
                     <p><strong>CV File:</strong> {$cvFile}</p>
                     <p>Log in to the <a href='" . APP_URL . "/admin/careers'>Admin Portal</a> to review.</p>";

            Mailer::send('hr@cemcsmfb.com',   "New CV Application: {$position} — {$fullName}", $body);
            Mailer::send('info@cemcsmfb.com',  "New CV Application: {$position} — {$fullName}", $body);

            // ── Email: confirm to applicant ──────────────────────────────────
            Mailer::send($email,
                "Application Received — {$position}",
                "<p>Dear {$fullName},</p>
                 <p>Thank you for applying for the <strong>{$position}</strong> position at CEMCS Microfinance Bank. We have received your application and CV.</p>
                 <p>Our HR team will review your application and contact you if your profile matches our requirements. We appreciate your interest in joining our team.</p>
                 <p>Warm regards,<br><strong>CEMCS MFB HR Team</strong></p>"
            );

            $this->jsonResponse(['success' => true, 'message' => 'Application submitted successfully.']);
        } catch (PDOException $e) {
            $this->jsonResponse(['error' => 'Could not save application. Please try again.'], 500);
        }
    }

    // ─── Website chatbot ──────────────────────────────────────────────────────

    public function processChatbot(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Invalid method'], 405);
        }

        $json = $this->readJsonBody();
        $message = $this->sanitizeString($json['message'] ?? ($_POST['message'] ?? ''));

        if ($message === '') {
            $this->jsonResponse(['error' => 'Please enter a message.'], 400);
        }

        $result = ChatbotHelper::answer($message);
        $sourceTitle = $result['source_title'] ?? null;
        $sourceUrl   = $result['source_url'] ?? null;
        $intent      = (string) ($result['intent'] ?? 'general');
        $prefillUrl  = (string) ($result['prefill_url'] ?? '');
        $userIp      = $_SERVER['REMOTE_ADDR'] ?? null;
        $userAgent   = isset($_SERVER['HTTP_USER_AGENT']) ? substr((string) $_SERVER['HTTP_USER_AGENT'], 0, 255) : null;

        if (!($result['answered'] ?? false)) {
            $fallbackText = "I couldn't find a confident answer right now. Please continue on WhatsApp and our team will assist you.";
            $waText = "Hello CEMCS MFB, I need help with this question: " . $message;
            $waLink = ChatbotHelper::whatsappLink($waText);

            ChatbotInteraction::log([
                'question'          => $message,
                'answer_text'       => $fallbackText,
                'answered'          => 0,
                'handoff_whatsapp'  => 1,
                'intent'            => $intent,
                'prefill_url'       => $prefillUrl !== '' ? $prefillUrl : null,
                'source_title'      => null,
                'source_url'        => null,
                'status'            => 'new',
                'user_ip'           => $userIp,
                'user_agent'        => $userAgent,
            ]);

            $this->jsonResponse([
                'success'       => true,
                'answered'      => false,
                'message'       => $fallbackText,
                'handoff'       => true,
                'whatsapp_link' => $waLink,
                'intent'        => $intent,
                'prefill_url'   => $prefillUrl,
            ]);
        }

        ChatbotInteraction::log([
            'question'          => $message,
            'answer_text'       => $result['answer'] ?? '',
            'answered'          => 1,
            'handoff_whatsapp'  => 0,
            'intent'            => $intent,
            'prefill_url'       => $prefillUrl !== '' ? $prefillUrl : null,
            'source_title'      => $sourceTitle,
            'source_url'        => $sourceUrl,
            'status'            => 'new',
            'user_ip'           => $userIp,
            'user_agent'        => $userAgent,
        ]);

        $this->jsonResponse([
            'success'      => true,
            'answered'     => true,
            'message'      => $result['answer'],
            'source_title' => $result['source_title'] ?? '',
            'source_url'   => $result['source_url'] ?? '',
            'intent'       => $intent,
            'prefill_url'  => $prefillUrl,
        ]);
    }

    public function processFormAbandonment(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Invalid method'], 405);
        }

        $data = $this->readJsonBody();
        if (empty($data)) {
            $data = $_POST;
        }

        $formType = $this->sanitizeString($data['form_type'] ?? '');
        if (!in_array($formType, ['open_account', 'loan'], true)) {
            $this->jsonResponse(['error' => 'Invalid form type'], 400);
        }

        $email = filter_var((string) ($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $email = is_string($email) ? trim($email) : '';
        $record = [
            'form_type' => $formType,
            'session_id' => $this->sanitizeString($data['session_id'] ?? ''),
            'full_name' => $this->sanitizeString($data['full_name'] ?? ''),
            'email' => $email,
            'phone' => $this->sanitizeString($data['phone'] ?? ''),
            'current_step' => $this->sanitizeString($data['current_step'] ?? ''),
            'payload' => isset($data['payload']) ? json_encode($data['payload']) : null,
            'converted' => 0,
            'reminder_stage' => 0,
        ];

        FormAbandonment::logEvent($record);
        $this->jsonResponse(['success' => true]);
    }
}
