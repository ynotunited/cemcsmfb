<?php
require_once APP_ROOT . '/app/models/Model.php';

class ManagedPage extends Model {
    protected static string $table = 'managed_pages';
    private static bool $tableChecked = false;
    private static bool $defaultsSeeded = false;

    private static function ensureTable(): void {
        if (self::$tableChecked) {
            return;
        }
        self::$tableChecked = true;

        try {
            static::db()->exec(
                "CREATE TABLE IF NOT EXISTS managed_pages (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    slug VARCHAR(150) NOT NULL UNIQUE,
                    title VARCHAR(255) NOT NULL,
                    meta_description VARCHAR(255) NULL,
                    content LONGTEXT NOT NULL,
                    status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
        } catch (PDOException $e) {
            // Keep admin usable even if schema creation is restricted.
        }
    }

    public static function findBySlug(string $slug): ?array {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare(
                'SELECT * FROM managed_pages WHERE slug = ? LIMIT 1'
            );
            $stmt->execute([$slug]);
            $row = $stmt->fetch();
            return $row ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function findPublished(string $slug): ?array {
        self::ensureTable();
        self::seedDefaultPages();
        try {
            $stmt = static::db()->prepare(
                "SELECT * FROM managed_pages WHERE slug = ? AND status = 'published' LIMIT 1"
            );
            $stmt->execute([$slug]);
            $row = $stmt->fetch();
            return $row ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function allOrdered(): array {
        self::ensureTable();
        self::seedDefaultPages();
        try {
            $stmt = static::db()->query(
                'SELECT id, slug, title, status, updated_at FROM managed_pages ORDER BY updated_at DESC'
            );
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function upsert(string $slug, array $data): int {
        self::ensureTable();
        $existing = static::findBySlug($slug);
        if ($existing) {
            static::update((int) $existing['id'], $data);
            return (int) $existing['id'];
        }
        $data['slug'] = $slug;
        return static::insert($data);
    }

    public static function slugForView(string $view): ?string {
        $definitions = self::defaultPageDefinitions();
        foreach ($definitions as $slug => $definition) {
            if (($definition['view'] ?? '') === $view && ($definition['managed'] ?? true)) {
                return $slug;
            }
        }

        return null;
    }

    public static function seedDefaultPages(): void {
        if (self::$defaultsSeeded) {
            return;
        }

        self::$defaultsSeeded = true;
        self::ensureTable();

        try {
            $expected = count(self::defaultPageDefinitions());
            $existingCount = (int) static::db()->query('SELECT COUNT(*) FROM managed_pages')->fetchColumn();
            if ($existingCount >= $expected) {
                return;
            }
        } catch (PDOException $e) {
            return;
        }

        foreach (self::defaultPageDefinitions() as $slug => $definition) {
            if (static::findBySlug($slug)) {
                continue;
            }

            $content = self::renderViewContent($definition['view'], $definition['data'] ?? []);
            if ($content === '') {
                continue;
            }

            try {
                static::insert([
                    'slug'             => $slug,
                    'title'            => $definition['title'],
                    'meta_description' => $definition['meta_description'] ?? null,
                    'content'          => $content,
                    'status'           => $definition['status'] ?? 'published',
                ]);
            } catch (PDOException $e) {
                // Ignore duplicate inserts or restricted schema environments.
            }
        }
    }

    private static function renderViewContent(string $view, array $data = []): string {
        $viewFile = APP_ROOT . '/app/views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            return '';
        }

        require_once APP_ROOT . '/app/Controller.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data['csrf_token'] = CsrfHelper::token();
        $data['recaptcha_site_key'] = defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : '';

        extract($data, EXTR_SKIP);

        ob_start();
        require $viewFile;
        return trim((string) ob_get_clean());
    }

    private static function defaultPageDefinitions(): array {
        return [
            '/' => [
                'title' => 'Home - Chevron CEMCS MFB',
                'view' => 'pages/home',
                'meta_description' => 'Banking built for Chevron employees, contractors, and the wider community.',
            ],
            '/about' => [
                'title' => 'About Us - Chevron CEMCS MFB',
                'view' => 'pages/about',
                'meta_description' => 'Learn about CEMCS MFB, our story, mission, and service approach.',
            ],
            '/personal' => [
                'title' => 'Personal Banking - Chevron CEMCS MFB',
                'view' => 'pages/personal',
                'meta_description' => 'Discover personal banking services tailored to members and families.',
            ],
            '/business' => [
                'title' => 'Business Banking - Chevron CEMCS MFB',
                'view' => 'pages/business',
                'meta_description' => 'Business-focused banking, finance, and support for growing enterprises.',
            ],
            '/help' => [
                'title' => 'Help Centre - Chevron CEMCS MFB',
                'view' => 'pages/help',
                'meta_description' => 'Find answers to common questions about accounts, loans, and support.',
            ],
            '/contact' => [
                'title' => 'Contact Support - Chevron CEMCS MFB',
                'view' => 'pages/contact',
                'meta_description' => 'Get in touch with CEMCS MFB by phone, email, or the contact form.',
                'managed' => false,
            ],
            '/branches' => [
                'title' => 'Branch Locator - Chevron CEMCS MFB',
                'view' => 'pages/branches',
                'meta_description' => 'Locate our branches and view service hours and directions.',
            ],
            '/calculators' => [
                'title' => 'Financial Calculators - CEMCS MFB',
                'view' => 'pages/calculators',
                'meta_description' => 'Use financial calculators to estimate savings growth and loan payments.',
            ],
            '/loans' => [
                'title' => 'Loan Application - CEMCS MFB',
                'view' => 'pages/loans',
                'meta_description' => 'Apply for a loan and explore borrowing options with CEMCS MFB.',
                'managed' => false,
            ],
            '/open-account' => [
                'title' => 'Open an Account - CEMCS MFB',
                'view' => 'pages/open-account',
                'meta_description' => 'Start your account opening journey online in a few minutes.',
                'managed' => false,
            ],
            '/forms' => [
                'title' => 'Forms & Downloads - CEMCS MFB',
                'view' => 'pages/forms',
                'meta_description' => 'Download bank forms and supporting documents from one place.',
            ],
            '/careers' => [
                'title' => 'Careers - CEMCS MFB',
                'view' => 'pages/careers',
                'meta_description' => 'View current opportunities and submit your CV to join the team.',
                'managed' => false,
            ],
            '/blog' => [
                'title' => 'Blog - CEMCS MFB',
                'view' => 'pages/placeholder',
                'data' => [
                    'page_title' => 'News & Insights',
                    'page_desc' => 'Financial tips, cooperative updates, and news from CEMCS MFB.',
                ],
                'meta_description' => 'News, insights, and updates from CEMCS MFB.',
            ],
            '/directors' => [
                'title' => 'Our Directors - CEMCS MFB',
                'view' => 'pages/our-directors',
                'meta_description' => 'Meet the directors guiding the vision and governance of CEMCS MFB.',
            ],
            '/management' => [
                'title' => 'Management Team - CEMCS MFB',
                'view' => 'pages/management-team',
                'meta_description' => 'Learn more about the management team and their responsibilities.',
            ],
            '/quality-policy' => [
                'title' => 'Quality Policy - CEMCS MFB',
                'view' => 'pages/quality-policy',
                'meta_description' => 'Read the quality policy that shapes our customer service standards.',
            ],
            '/current-account' => [
                'title' => 'Current Account - CEMCS MFB',
                'view' => 'pages/current-account',
                'meta_description' => 'Explore the CEMCS MFB current account and its features.',
            ],
            '/savings-account' => [
                'title' => 'Savings Account - CEMCS MFB',
                'view' => 'pages/savings-account',
                'meta_description' => 'Save smarter with the CEMCS MFB savings account.',
            ],
            '/joint-savings' => [
                'title' => 'Joint Savings Account - CEMCS MFB',
                'view' => 'pages/joint-savings',
                'meta_description' => 'Open a joint savings account for family or shared goals.',
            ],
            '/cashplan-savings' => [
                'title' => 'Cash Plan Savings Account - CEMCS MFB',
                'view' => 'pages/cashplan-savings',
                'meta_description' => 'Save toward future goals with the cash plan savings account.',
            ],
            '/fixed-deposit' => [
                'title' => 'Fixed Deposit Account - CEMCS MFB',
                'view' => 'pages/fixed-deposit',
                'meta_description' => 'Lock funds in a fixed deposit and earn competitive returns.',
            ],
            '/smart-salary' => [
                'title' => 'Smart Salary Account - CEMCS MFB',
                'view' => 'pages/smart-salary',
                'meta_description' => 'Manage salary payments with the Smart Salary account.',
            ],
            '/loan-no-story' => [
                'title' => '10-14-24 No Story Loan - CEMCS MFB',
                'view' => 'pages/loan-no-story',
                'meta_description' => 'View details for the 10-14-24 No Story loan product.',
            ],
            '/loan-home-improvement' => [
                'title' => 'Home Improvement Loan - CEMCS MFB',
                'view' => 'pages/loan-home-improvement',
                'meta_description' => 'Finance home improvements with a tailored loan product.',
            ],
            '/loan-housing' => [
                'title' => 'Micro Housing Loan - CEMCS MFB',
                'view' => 'pages/loan-housing',
                'meta_description' => 'Explore the micro housing loan for accommodation needs.',
            ],
            '/loan-education' => [
                'title' => 'Education Support Loan - CEMCS MFB',
                'view' => 'pages/loan-education',
                'meta_description' => 'Support school fees and learning goals with an education loan.',
            ],
            '/loan-target' => [
                'title' => 'Target Loans & Salary Advances - CEMCS MFB',
                'view' => 'pages/loan-target',
                'meta_description' => 'Target loans and salary advances for planned borrowing needs.',
            ],
            '/loan-spy-police' => [
                'title' => 'Spy Police Special Loan - CEMCS MFB',
                'view' => 'pages/loan-spy-police',
                'meta_description' => 'Special loan support for Spy Police members.',
            ],
            '/loan-short-term' => [
                'title' => 'Short Term Loan / Overdraft - CEMCS MFB',
                'view' => 'pages/loan-short-term',
                'meta_description' => 'Short-term financing and overdraft support for businesses.',
            ],
            '/debit-cards' => [
                'title' => 'Debit Cards - CEMCS MFB',
                'view' => 'pages/debit-cards',
                'meta_description' => 'Learn about debit card access and usage with CEMCS MFB.',
            ],
            '/mobile-banking' => [
                'title' => 'Mobile Banking - CEMCS MFB',
                'view' => 'pages/mobile-banking',
                'meta_description' => 'Bank on the go with the CEMCS MFB mobile banking experience.',
            ],
            '/instant-payment' => [
                'title' => 'Instant Payment - CEMCS MFB',
                'view' => 'pages/instant-payment',
                'meta_description' => 'Send and receive money instantly through supported payment rails.',
            ],
            '/payments-deposits' => [
                'title' => 'Payments & Deposits - CEMCS MFB',
                'view' => 'pages/payments-deposits',
                'meta_description' => 'Make payments and deposits quickly and securely.',
            ],
        ];
    }
}
