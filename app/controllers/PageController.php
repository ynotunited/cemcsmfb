<?php
require_once APP_ROOT . '/app/Controller.php';

class PageController extends Controller {
    public function index() {
        return $this->view('pages/home', ['title' => 'Chevron CEMCS MFB - Digital Banking']);
    }
    
    public function about() {
        return $this->view('pages/about', ['title' => 'About Us - Chevron CEMCS MFB']);
    }
    
    public function personal() {
        return $this->view('pages/personal', ['title' => 'Personal Banking - Chevron CEMCS MFB']);
    }
    
    public function business() {
        return $this->view('pages/business', ['title' => 'Business Banking - Chevron CEMCS MFB']);
    }
    
    public function help() {
        return $this->view('pages/help', ['title' => 'Help Centre - Chevron CEMCS MFB']);
    }
    
    public function contact() {
        return $this->view('pages/contact', ['title' => 'Contact Support - Chevron CEMCS MFB']);
    }
    
    public function branches() {
         return $this->view('pages/branches', ['title' => 'Branch Locator - Chevron CEMCS MFB']);
    }

    public function calculators() {
        return $this->view('pages/calculators', ['title' => 'Financial Calculators - CEMCS MFB']);
    }

    public function loans() {
        return $this->view('pages/loans', ['title' => 'Loan Application - CEMCS MFB']);
    }

    public function openAccount() {
        return $this->view('pages/open-account', ['title' => 'Open an Account - CEMCS MFB']);
    }

    public function forms() {
        return $this->view('pages/forms', ['title' => 'Forms & Downloads - CEMCS MFB']);
    }

    public function careers() {
        return $this->view('pages/careers', ['title' => 'Careers - CEMCS MFB']);
    }

    public function blog() {
        return $this->view('pages/placeholder', ['title' => 'Blog - CEMCS MFB', 'page_title' => 'News & Insights', 'page_desc' => 'Financial tips, cooperative updates, and news from CEMCS MFB.']);
    }

    // ── Company submenu ──────────────────────────────────────────────────────
    public function directors() {
        return $this->view('pages/our-directors', ['title' => 'Our Directors - CEMCS MFB']);
    }
    public function management() {
        return $this->view('pages/management-team', ['title' => 'Management Team - CEMCS MFB']);
    }
    public function qualityPolicy() {
        return $this->view('pages/quality-policy', ['title' => 'Quality Policy - CEMCS MFB']);
    }

    // ── Account submenu ──────────────────────────────────────────────────────
    public function currentAccount() {
        return $this->view('pages/current-account', ['title' => 'Current Account - CEMCS MFB']);
    }
    public function savingsAccount() {
        return $this->view('pages/savings-account', ['title' => 'Savings Account - CEMCS MFB']);
    }
    public function jointSavings() {
        return $this->view('pages/joint-savings', ['title' => 'Joint Savings Account - CEMCS MFB']);
    }
    public function cashplanSavings() {
        return $this->view('pages/cashplan-savings', ['title' => 'Cash Plan Savings Account - CEMCS MFB']);
    }
    public function fixedDeposit() {
        return $this->view('pages/fixed-deposit', ['title' => 'Fixed Deposit Account - CEMCS MFB']);
    }
    public function smartSalary() {
        return $this->view('pages/smart-salary', ['title' => 'Smart Salary Account - CEMCS MFB']);
    }

    // ── Loan product pages ───────────────────────────────────────────────────
    public function loanNoStory() {
        return $this->view('pages/loan-no-story', ['title' => '10-14-24 No Story Loan - CEMCS MFB']);
    }
    public function loanHomeImprovement() {
        return $this->view('pages/loan-home-improvement', ['title' => 'Home Improvement Loan - CEMCS MFB']);
    }
    public function loanHousing() {
        return $this->view('pages/loan-housing', ['title' => 'Micro Housing Loan - CEMCS MFB']);
    }
    public function loanEducation() {
        return $this->view('pages/loan-education', ['title' => 'Education Support Loan - CEMCS MFB']);
    }
    public function loanTarget() {
        return $this->view('pages/loan-target', ['title' => 'Target Loans & Salary Advances - CEMCS MFB']);
    }
    public function loanSpyPolice() {
        return $this->view('pages/loan-spy-police', ['title' => 'Spy Police Special Loan - CEMCS MFB']);
    }
    public function loanShortTerm() {
        return $this->view('pages/loan-short-term', ['title' => 'Short Term Loan / Overdraft - CEMCS MFB']);
    }

    // ── E-Banking submenu ────────────────────────────────────────────────────
    public function debitCards() {
        return $this->view('pages/debit-cards', ['title' => 'Debit Cards - CEMCS MFB']);
    }
    public function mobileBanking() {
        return $this->view('pages/mobile-banking', ['title' => 'Mobile Banking - CEMCS MFB']);
    }
    public function instantPayment() {
        return $this->view('pages/instant-payment', ['title' => 'Instant Payment - CEMCS MFB']);
    }
    public function paymentsDeposits() {
        return $this->view('pages/payments-deposits', ['title' => 'Payments & Deposits - CEMCS MFB']);
    }

    /**
     * Catch-all: serve a page from the managed_pages DB table.
     * Falls through to 404 if not found or not published.
     */
    public function managedPage(): void {
        require_once APP_ROOT . '/app/models/ManagedPage.php';

        $url  = $_GET['url'] ?? '';
        $slug = '/' . trim($url, '/');

        $page = ManagedPage::findPublished($slug);

        if (!$page) {
            http_response_code(404);
            $this->view('pages/placeholder', [
                'title'      => '404 — Page Not Found',
                'page_title' => 'Page Not Found',
                'page_desc'  => 'The page you are looking for does not exist or has been moved.',
            ]);
            return;
        }

        // Render the managed page content inside the standard layout
        $this->view('pages/managed', [
            'title'            => htmlspecialchars($page['title']) . ' - CEMCS MFB',
            'meta_description' => $page['meta_description'] ?? '',
            'managed_content'  => $page['content'],
        ]);
    }
}
