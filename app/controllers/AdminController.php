<?php
require_once APP_ROOT . '/app/Controller.php';
require_once APP_ROOT . '/app/models/AccountApplication.php';
require_once APP_ROOT . '/app/models/LoanApplication.php';
require_once APP_ROOT . '/app/models/ContactMessage.php';
require_once APP_ROOT . '/app/models/CvApplication.php';
require_once APP_ROOT . '/app/models/ChatbotInteraction.php';
require_once APP_ROOT . '/app/models/LeadScore.php';
require_once APP_ROOT . '/app/models/FormAbandonment.php';
require_once APP_ROOT . '/app/models/FollowUpLog.php';
require_once APP_ROOT . '/app/models/FaqEntry.php';
require_once APP_ROOT . '/app/models/ManagedPage.php';
require_once APP_ROOT . '/app/helpers/FollowUpHelper.php';
require_once APP_ROOT . '/app/helpers/FAQTrainerHelper.php';
require_once APP_ROOT . '/app/helpers/FreshnessHelper.php';
require_once APP_ROOT . '/app/helpers/LeadScoringHelper.php';

class AdminController extends Controller {

    public function __construct() {
        $this->startSecureSession();
    }

    // Strip tags from username input (replaces deprecated FILTER_SANITIZE_STRING)
    private function sanitizeUsername(string $value): string {
        return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
    }

    private function startSecureSession(): void {
        if (session_status() !== PHP_SESSION_NONE) {
            return;
        }

        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (($_SERVER['SERVER_PORT'] ?? null) == 443);

        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.cookie_httponly', '1');

        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/',
            'domain'   => '',
            'secure'   => $isHttps,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        session_start();
    }

    private function isAuthenticated(): bool {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }

    private function requireAuth(): void {
        if (!$this->isAuthenticated()) {
            header('Location: ' . APP_URL . '/admin/login');
            exit;
        }
    }

    private function setFlash(string $type, string $message): void {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    private function pullFlash(): ?array {
        if (empty($_SESSION['flash']) || !is_array($_SESSION['flash'])) {
            return null;
        }
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    private function redirectAdmin(string $path): void {
        header('Location: ' . APP_URL . $path);
        exit;
    }

    private function sanitizeRedirectPath(string $path): string {
        $path = trim($path);
        if ($path === '' || strpos($path, '/admin/') !== 0) {
            return '/admin/dashboard';
        }
        return $path;
    }

    private function withLeadScores(array $rows, string $type): array {
        $scoreMap = LeadScore::mapByType($type);
        return array_map(function ($row) use ($scoreMap) {
            $id = (int) ($row['id'] ?? 0);
            $score = $scoreMap[$id] ?? null;
            $row['_lead_score'] = $score ? (int) $score['score'] : null;
            $row['_lead_priority'] = $score['priority'] ?? 'low';
            $row['_lead_reasons'] = isset($score['reasons']) ? (json_decode((string) $score['reasons'], true) ?: []) : [];
            return $row;
        }, $rows);
    }

    private function backfillLeadScores(array $accounts, array $loans): void {
        foreach ($accounts as $row) {
            $id = (int) ($row['id'] ?? 0);
            if ($id <= 0) continue;
            $score = LeadScoringHelper::scoreAccount($row);
            LeadScore::upsert('account', $id, $score['score'], $score['priority'], $score['reasons']);
        }
        foreach ($loans as $row) {
            $id = (int) ($row['id'] ?? 0);
            if ($id <= 0) continue;
            $score = LeadScoringHelper::scoreLoan($row);
            LeadScore::upsert('loan', $id, $score['score'], $score['priority'], $score['reasons']);
        }
    }

    private function dashboardAnalytics(array $recentAccounts, array $recentLoans): array {
        $chat = ChatbotInteraction::summaryCounts();
        $intentBreakdown = ChatbotInteraction::intentBreakdown();
        $dropoff = FormAbandonment::dropoffSummary();
        $followups = FollowUpLog::summary();
        $faqDrafts = FaqEntry::countDrafts();
        $stalePages = FreshnessHelper::stalePages(120);
        $topLeads = LeadScore::topPriorities(8);

        $highPriority = array_values(array_filter($topLeads, fn($x) => ($x['priority'] ?? '') === 'high'));
        $newAccounts = array_values(array_filter($recentAccounts, fn($x) => ($x['status'] ?? '') === 'new'));
        $newLoans = array_values(array_filter($recentLoans, fn($x) => ($x['status'] ?? '') === 'new'));

        $actions = [];
        if (($chat['unanswered_or_handoff'] ?? 0) > 0) {
            $actions[] = [
                'label' => 'Review unresolved chatbot intents',
                'detail' => (int) $chat['unanswered_or_handoff'] . ' interactions need review',
                'link' => '/admin/chatbot-review',
            ];
        }
        if (count($highPriority) > 0) {
            $top = $highPriority[0];
            $typeLabel = ($top['entity_type'] ?? '') === 'loan' ? 'Loan lead' : 'Account lead';
            $actions[] = [
                'label' => 'Contact top high-priority lead',
                'detail' => $typeLabel . ' #' . (int) ($top['entity_id'] ?? 0) . ' scored ' . (int) ($top['score'] ?? 0),
                'link' => '/admin/' . (($top['entity_type'] ?? '') === 'loan' ? 'loans' : 'accounts'),
            ];
        }
        if (($dropoff['pending'] ?? 0) > 0) {
            $actions[] = [
                'label' => 'Run recovery follow-ups',
                'detail' => (int) $dropoff['pending'] . ' pending abandoned sessions',
                'link' => '/admin/dashboard',
            ];
        }
        if ($faqDrafts > 0) {
            $actions[] = [
                'label' => 'Publish FAQ drafts',
                'detail' => $faqDrafts . ' drafts are waiting in FAQ trainer',
                'link' => '/admin/faq-trainer',
            ];
        }

        return [
            'chat' => $chat,
            'intentBreakdown' => $intentBreakdown,
            'dropoff' => $dropoff,
            'followups' => $followups,
            'faqDrafts' => $faqDrafts,
            'stalePages' => $stalePages,
            'actions' => array_slice($actions, 0, 4),
            'topLeads' => $topLeads,
            'executive' => [
                'lead_conversion_proxy' => ($dropoff['total'] ?? 0) > 0
                    ? round((($dropoff['converted'] ?? 0) / max(1, $dropoff['total'])) * 100, 1)
                    : 0,
                'chat_resolution_proxy' => ($chat['total'] ?? 0) > 0
                    ? round((1 - (($chat['unanswered_or_handoff'] ?? 0) / max(1, $chat['total']))) * 100, 1)
                    : 100,
            ],
        ];
    }

    public function login() {
        if ($this->isAuthenticated()) {
            $this->redirectAdmin('/admin/dashboard');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF check
            if (!CsrfHelper::verify()) {
                $error = 'Security token mismatch. Please try again.';
            } else {
                $username = $this->sanitizeUsername($_POST['username'] ?? '');
                $password = $_POST['password'] ?? '';

                if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
                    session_regenerate_id(true);
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_login_at']  = time();
                    $this->redirectAdmin('/admin/dashboard');
                } else {
                    $error = 'Invalid secure credentials.';
                }
            }
        }

        return $this->view('admin/login', [
            'title' => 'Admin Login - CEMCS MFB', 
            'error' => $error,
            'layout' => 'admin-layout',
            'hideNav' => true
        ]);
    }

    public function logout() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        $this->redirectAdmin('/admin/login');
    }

    public function dashboard() {
        $this->requireAuth();

        $totalAccounts      = AccountApplication::count();
        $activeLoanApps     = LoanApplication::countByStatus('new') + LoanApplication::countByStatus('review');
        $unreadMessages     = ContactMessage::count();
        $totalCvApps        = CvApplication::count();
        $accountRows        = AccountApplication::all();
        $loanRows           = LoanApplication::all();
        $this->backfillLeadScores($accountRows, $loanRows);
        $recentAccounts     = $this->withLeadScores($accountRows, 'account');
        $recentLoans        = $this->withLeadScores($loanRows, 'loan');
        $analytics          = $this->dashboardAnalytics($recentAccounts, $recentLoans);

        // Merge and sort by created_at for the combined recent table (last 10)
        $recentApplications = array_merge(
            array_map(fn($r) => array_merge($r, ['_type' => 'Account Opening', '_source' => 'account']), $recentAccounts),
            array_map(fn($r) => array_merge($r, ['_type' => 'Loan Request', '_source' => 'loan']),       $recentLoans)
        );
        usort($recentApplications, fn($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at']));
        $recentApplications = array_slice($recentApplications, 0, 10);

        return $this->view('admin/dashboard', [
            'title'              => 'Admin Dashboard - CEMCS MFB',
            'layout'             => 'admin-layout',
            'totalAccounts'      => $totalAccounts,
            'activeLoanApps'     => $activeLoanApps,
            'unreadMessages'     => $unreadMessages,
            'totalCvApps'        => $totalCvApps,
            'recentApplications' => $recentApplications,
            'analytics'          => $analytics,
            'flash'              => $this->pullFlash(),
        ]);
    }

    public function exportLeads() {
        $this->requireAuth();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="cemcs_leads_' . date('Y-m-d') . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Ref ID', 'Application Type', 'Applicant Name', 'Email', 'Phone', 'Status', 'Date Submitted']);

        // Account applications
        $accounts = AccountApplication::all();
        foreach ($accounts as $row) {
            fputcsv($output, [
                'ACC-' . str_pad($row['id'], 4, '0', STR_PAD_LEFT),
                'Account Opening',
                $row['full_name'],
                $row['email'],
                $row['phone'],
                ucfirst($row['status']),
                $row['created_at'],
            ]);
        }

        // Loan applications
        $loans = LoanApplication::all();
        foreach ($loans as $row) {
            fputcsv($output, [
                'L-' . str_pad($row['id'], 5, '0', STR_PAD_LEFT),
                'Loan Request (' . ucfirst($row['loan_type']) . ')',
                '—', // name not collected on loan form yet
                '—',
                '—',
                ucfirst($row['status']),
                $row['created_at'],
            ]);
        }

        fclose($output);
        exit;
    }

    public function accounts() {
        $this->requireAuth();

        $rows = AccountApplication::all();
        $this->backfillLeadScores($rows, []);
        $applications = $this->withLeadScores($rows, 'account');

        return $this->view('admin/accounts', [
            'title'        => 'Account Applications - CEMCS MFB Admin',
            'layout'       => 'admin-layout',
            'applications' => $applications,
            'flash'        => $this->pullFlash(),
        ]);
    }

    public function loans() {
        $this->requireAuth();

        $rows = LoanApplication::all();
        $this->backfillLeadScores([], $rows);
        $applications = $this->withLeadScores($rows, 'loan');

        return $this->view('admin/loans', [
            'title'        => 'Loan Applications - CEMCS MFB Admin',
            'layout'       => 'admin-layout',
            'applications' => $applications,
            'flash'        => $this->pullFlash(),
        ]);
    }

    public function application() {
        $this->requireAuth();

        $type = strtolower(trim($_GET['type'] ?? ''));
        $id   = (int) ($_GET['id'] ?? 0);

        if ($id <= 0 || !in_array($type, ['account', 'loan', 'cv'], true)) {
            $this->setFlash('error', 'Invalid application reference.');
            $this->redirectAdmin('/admin/dashboard');
        }

        $record = null;
        $title  = '';

        if ($type === 'account') {
            $record = AccountApplication::find($id);
            $title  = 'Account Application Details';
        } elseif ($type === 'loan') {
            $record = LoanApplication::find($id);
            $title  = 'Loan Application Details';
        } else {
            $record = CvApplication::find($id);
            $title  = 'CV Application Details';
        }

        if (!$record) {
            $this->setFlash('error', 'Application not found.');
            $this->redirectAdmin('/admin/dashboard');
        }

        return $this->view('admin/application', [
            'title'    => $title . ' - CEMCS MFB Admin',
            'layout'   => 'admin-layout',
            'type'     => $type,
            'record'   => $record,
            'flash'    => $this->pullFlash(),
        ]);
    }

    public function updateAccountStatus() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectAdmin('/admin/accounts');
        }

        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch. Please try again.');
            $this->redirectAdmin('/admin/accounts');
        }

        $id      = (int) ($_POST['id'] ?? 0);
        $status  = strtolower(trim($_POST['status'] ?? ''));
        $allowed = ['new', 'contacted', 'approved', 'rejected'];
        $next    = $this->sanitizeRedirectPath($_POST['redirect_to'] ?? '/admin/accounts');

        if ($id <= 0 || !in_array($status, $allowed, true) || !AccountApplication::find($id)) {
            $this->setFlash('error', 'Invalid account status update payload.');
            $this->redirectAdmin($next);
        }

        AccountApplication::update($id, ['status' => $status]);
        $this->setFlash('success', 'Account application status updated.');
        $this->redirectAdmin($next);
    }

    public function updateLoanStatus() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectAdmin('/admin/loans');
        }

        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch. Please try again.');
            $this->redirectAdmin('/admin/loans');
        }

        $id      = (int) ($_POST['id'] ?? 0);
        $status  = strtolower(trim($_POST['status'] ?? ''));
        $allowed = ['new', 'review', 'approved', 'rejected'];
        $next    = $this->sanitizeRedirectPath($_POST['redirect_to'] ?? '/admin/loans');

        if ($id <= 0 || !in_array($status, $allowed, true) || !LoanApplication::find($id)) {
            $this->setFlash('error', 'Invalid loan status update payload.');
            $this->redirectAdmin($next);
        }

        LoanApplication::update($id, ['status' => $status]);
        $this->setFlash('success', 'Loan application status updated.');
        $this->redirectAdmin($next);
    }

    public function updateCvStatus() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectAdmin('/admin/careers');
        }

        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch. Please try again.');
            $this->redirectAdmin('/admin/careers');
        }

        $id      = (int) ($_POST['id'] ?? 0);
        $status  = strtolower(trim($_POST['status'] ?? ''));
        $allowed = ['new', 'reviewed', 'shortlisted', 'rejected'];
        $next    = $this->sanitizeRedirectPath($_POST['redirect_to'] ?? '/admin/careers');

        if ($id <= 0 || !in_array($status, $allowed, true) || !CvApplication::find($id)) {
            $this->setFlash('error', 'Invalid CV status update payload.');
            $this->redirectAdmin($next);
        }

        CvApplication::update($id, ['status' => $status]);
        $this->setFlash('success', 'CV application status updated.');
        $this->redirectAdmin($next);
    }

    public function careers() {
        $this->requireAuth();

        $applications = CvApplication::all();

        return $this->view('admin/careers', [
            'title'        => 'CV Applications - CEMCS MFB Admin',
            'layout'       => 'admin-layout',
            'applications' => $applications,
            'flash'        => $this->pullFlash(),
        ]);
    }

    public function chatbotReview() {
        $this->requireAuth();

        $logs = ChatbotInteraction::recent(250);
        $summary = ChatbotInteraction::summaryCounts();
        $topQuestions = ChatbotInteraction::topUnresolvedQuestions(12);

        return $this->view('admin/chatbot-review', [
            'title'        => 'Chatbot Review Queue - CEMCS MFB Admin',
            'layout'       => 'admin-layout',
            'logs'         => $logs,
            'summary'      => $summary,
            'topQuestions' => $topQuestions,
            'flash'        => $this->pullFlash(),
        ]);
    }

    public function faqTrainer() {
        $this->requireAuth();

        return $this->view('admin/faq-trainer', [
            'title' => 'AI FAQ Trainer - CEMCS MFB Admin',
            'layout' => 'admin-layout',
            'drafts' => FaqEntry::drafts(200),
            'topQuestions' => ChatbotInteraction::topUnresolvedQuestions(20),
            'flash' => $this->pullFlash(),
        ]);
    }

    public function generateFaqDrafts() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectAdmin('/admin/faq-trainer');
        }
        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch. Please try again.');
            $this->redirectAdmin('/admin/faq-trainer');
        }
        $created = FAQTrainerHelper::generateDrafts(12);
        $this->setFlash('success', $created . ' FAQ draft(s) generated from unresolved chatbot questions.');
        $this->redirectAdmin('/admin/faq-trainer');
    }

    public function publishFaqDraft() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectAdmin('/admin/faq-trainer');
        }
        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch. Please try again.');
            $this->redirectAdmin('/admin/faq-trainer');
        }
        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0 || !FaqEntry::publish($id)) {
            $this->setFlash('error', 'Could not publish FAQ draft.');
            $this->redirectAdmin('/admin/faq-trainer');
        }
        $this->setFlash('success', 'FAQ draft published successfully.');
        $this->redirectAdmin('/admin/faq-trainer');
    }

    public function runFollowUps() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectAdmin('/admin/dashboard');
        }
        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch. Please try again.');
            $this->redirectAdmin('/admin/dashboard');
        }

        $result = FollowUpHelper::run();
        $this->setFlash(
            'success',
            "Follow-up run complete. Checked {$result['checked']} abandonment(s), sent {$result['sent']}, failed {$result['failed']}."
        );
        $this->redirectAdmin('/admin/dashboard');
    }

    public function updateChatbotStatus() {        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectAdmin('/admin/chatbot-review');
        }

        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch. Please try again.');
            $this->redirectAdmin('/admin/chatbot-review');
        }

        $id      = (int) ($_POST['id'] ?? 0);
        $status  = strtolower(trim($_POST['status'] ?? ''));
        $note    = trim((string) ($_POST['review_note'] ?? ''));
        $allowed = ['new', 'reviewed', 'resolved', 'escalated'];
        $next    = $this->sanitizeRedirectPath($_POST['redirect_to'] ?? '/admin/chatbot-review');

        if ($id <= 0 || !in_array($status, $allowed, true) || !ChatbotInteraction::find($id)) {
            $this->setFlash('error', 'Invalid chatbot review payload.');
            $this->redirectAdmin($next);
        }

        ChatbotInteraction::update($id, [
            'status' => $status,
            'review_note' => $note !== '' ? $note : null,
        ]);

        $this->setFlash('success', 'Chatbot item updated.');
        $this->redirectAdmin($next);
    }

    // ─── Page Manager ─────────────────────────────────────────────────────────

    public function pages() {
        $this->requireAuth();
        return $this->view('admin/pages/index', [
            'title'  => 'Page Manager - CEMCS MFB Admin',
            'layout' => 'admin-layout',
            'pages'  => ManagedPage::allOrdered(),
            'flash'  => $this->pullFlash(),
        ]);
    }

    public function pageNew() {
        $this->requireAuth();
        return $this->view('admin/pages/edit', [
            'title'  => 'New Page - CEMCS MFB Admin',
            'layout' => 'admin-layout',
            'page'   => null,
            'flash'  => $this->pullFlash(),
        ]);
    }

    public function pageCreate() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirectAdmin('/admin/pages'); }
        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch.');
            $this->redirectAdmin('/admin/pages/new');
        }

        $slug    = '/' . ltrim(trim($_POST['slug'] ?? ''), '/');
        $title   = trim($_POST['title'] ?? '');
        $meta    = trim($_POST['meta_description'] ?? '');
        $content = $_POST['content'] ?? '';
        $status  = in_array($_POST['status'] ?? '', ['draft', 'published']) ? $_POST['status'] : 'draft';

        if (!$slug || $slug === '/' || !$title) {
            $this->setFlash('error', 'Slug and title are required.');
            $this->redirectAdmin('/admin/pages/new');
        }
        if (ManagedPage::findBySlug($slug)) {
            $this->setFlash('error', "A page with slug \"{$slug}\" already exists.");
            $this->redirectAdmin('/admin/pages/new');
        }

        ManagedPage::insert(['slug' => $slug, 'title' => $title, 'meta_description' => $meta, 'content' => $content, 'status' => $status]);
        $this->setFlash('success', "Page \"{$title}\" created.");
        $this->redirectAdmin('/admin/pages');
    }

    public function pageEdit() {
        $this->requireAuth();
        $id   = (int) ($_GET['id'] ?? 0);
        $page = $id > 0 ? ManagedPage::find($id) : null;
        if (!$page) { $this->setFlash('error', 'Page not found.'); $this->redirectAdmin('/admin/pages'); }

        return $this->view('admin/pages/edit', [
            'title'  => 'Edit: ' . htmlspecialchars($page['title']) . ' - CEMCS MFB Admin',
            'layout' => 'admin-layout',
            'page'   => $page,
            'flash'  => $this->pullFlash(),
        ]);
    }

    public function pageUpdate() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirectAdmin('/admin/pages'); }
        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch.');
            $this->redirectAdmin('/admin/pages');
        }

        $id      = (int) ($_POST['id'] ?? 0);
        $title   = trim($_POST['title'] ?? '');
        $meta    = trim($_POST['meta_description'] ?? '');
        $content = $_POST['content'] ?? '';
        $status  = in_array($_POST['status'] ?? '', ['draft', 'published']) ? $_POST['status'] : 'draft';

        if ($id <= 0 || !$title || !ManagedPage::find($id)) {
            $this->setFlash('error', 'Invalid page update.');
            $this->redirectAdmin('/admin/pages');
        }

        ManagedPage::update($id, ['title' => $title, 'meta_description' => $meta, 'content' => $content, 'status' => $status]);
        $this->setFlash('success', "Page \"{$title}\" updated.");
        $this->redirectAdmin('/admin/pages');
    }

    public function pageDelete() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirectAdmin('/admin/pages'); }
        if (!CsrfHelper::verify()) {
            $this->setFlash('error', 'Security token mismatch.');
            $this->redirectAdmin('/admin/pages');
        }

        $id   = (int) ($_POST['id'] ?? 0);
        $page = $id > 0 ? ManagedPage::find($id) : null;
        if (!$page) { $this->setFlash('error', 'Page not found.'); $this->redirectAdmin('/admin/pages'); }

        DB::getInstance()->prepare('DELETE FROM managed_pages WHERE id = ?')->execute([$id]);
        $this->setFlash('success', "Page \"{$page['title']}\" deleted.");
        $this->redirectAdmin('/admin/pages');
    }
}
