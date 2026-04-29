<?php
require_once APP_ROOT . '/app/controllers/PageController.php';

// Public pages
$router->get('/', [PageController::class, 'index']);
$router->get('/about', [PageController::class, 'about']);
$router->get('/personal', [PageController::class, 'personal']);
$router->get('/business', [PageController::class, 'business']);
$router->get('/help', [PageController::class, 'help']);
$router->get('/contact', [PageController::class, 'contact']);
$router->get('/branches', [PageController::class, 'branches']);
$router->get('/calculators', [PageController::class, 'calculators']);

$router->get('/loans', [PageController::class, 'loans']);
$router->get('/open-account', [PageController::class, 'openAccount']);
$router->get('/forms', [PageController::class, 'forms']);
$router->get('/careers', [PageController::class, 'careers']);
$router->get('/blog', [PageController::class, 'blog']);

// Company submenu pages
$router->get('/directors', [PageController::class, 'directors']);
$router->get('/management', [PageController::class, 'management']);
$router->get('/quality-policy', [PageController::class, 'qualityPolicy']);

// Account submenu pages
$router->get('/current-account', [PageController::class, 'currentAccount']);
$router->get('/savings-account', [PageController::class, 'savingsAccount']);
$router->get('/joint-savings', [PageController::class, 'jointSavings']);
$router->get('/cashplan-savings', [PageController::class, 'cashplanSavings']);
$router->get('/fixed-deposit', [PageController::class, 'fixedDeposit']);
$router->get('/smart-salary', [PageController::class, 'smartSalary']);

// Loan product pages
$router->get('/loan-no-story', [PageController::class, 'loanNoStory']);
$router->get('/loan-home-improvement', [PageController::class, 'loanHomeImprovement']);
$router->get('/loan-housing', [PageController::class, 'loanHousing']);
$router->get('/loan-education', [PageController::class, 'loanEducation']);
$router->get('/loan-target', [PageController::class, 'loanTarget']);
$router->get('/loan-spy-police', [PageController::class, 'loanSpyPolice']);
$router->get('/loan-short-term', [PageController::class, 'loanShortTerm']);

// E-Banking submenu pages
$router->get('/debit-cards', [PageController::class, 'debitCards']);
$router->get('/mobile-banking', [PageController::class, 'mobileBanking']);
$router->get('/instant-payment', [PageController::class, 'instantPayment']);
$router->get('/payments-deposits', [PageController::class, 'paymentsDeposits']);

// API Endpoints
require_once APP_ROOT . '/app/controllers/ApiController.php';
$router->post('/api/contact', [ApiController::class, 'processContact']);
$router->post('/api/open-account', [ApiController::class, 'processOpenAccount']);
$router->post('/api/loan-application', [ApiController::class, 'processLoan']);
$router->post('/api/cv-application', [ApiController::class, 'processCvApplication']);
$router->post('/api/chatbot', [ApiController::class, 'processChatbot']);
$router->post('/api/form-abandonment', [ApiController::class, 'processFormAbandonment']);

// Secured Admin Routes
require_once APP_ROOT . '/app/controllers/AdminController.php';
$router->get('/admin/login', [AdminController::class, 'login']);
$router->post('/admin/login', [AdminController::class, 'login']);
$router->get('/admin/logout', [AdminController::class, 'logout']);
$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$router->get('/admin/export-leads', [AdminController::class, 'exportLeads']);
$router->get('/admin/careers', [AdminController::class, 'careers']);
$router->get('/admin/accounts', [AdminController::class, 'accounts']);
$router->get('/admin/loans', [AdminController::class, 'loans']);
$router->get('/admin/application', [AdminController::class, 'application']);
$router->get('/admin/chatbot-review', [AdminController::class, 'chatbotReview']);
$router->get('/admin/faq-trainer', [AdminController::class, 'faqTrainer']);
$router->post('/admin/faq-trainer/generate', [AdminController::class, 'generateFaqDrafts']);
$router->post('/admin/faq-trainer/publish', [AdminController::class, 'publishFaqDraft']);
$router->post('/admin/followups/run', [AdminController::class, 'runFollowUps']);
$router->post('/admin/accounts/status', [AdminController::class, 'updateAccountStatus']);
$router->post('/admin/loans/status', [AdminController::class, 'updateLoanStatus']);
$router->post('/admin/careers/status', [AdminController::class, 'updateCvStatus']);
$router->post('/admin/chatbot-review/status', [AdminController::class, 'updateChatbotStatus']);

// Page Manager
$router->get('/admin/pages',           [AdminController::class, 'pages']);
$router->get('/admin/pages/new',       [AdminController::class, 'pageNew']);
$router->post('/admin/pages/new',      [AdminController::class, 'pageCreate']);
$router->get('/admin/pages/edit',      [AdminController::class, 'pageEdit']);
$router->post('/admin/pages/edit',     [AdminController::class, 'pageUpdate']);
$router->post('/admin/pages/delete',   [AdminController::class, 'pageDelete']);

// Managed pages catch-all — must be last
$router->get('/*', [PageController::class, 'managedPage']);
