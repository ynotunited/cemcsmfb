<?php
// c:/laragon/www/cemcsmfb/app/views/admin-layout.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'CEMCS MFB Admin') ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/globals.css">
    <style>
        body { background: var(--off-white); }
        .admin-sidebar { background: var(--blue-deep); color: white; width: 250px; min-height: 100vh; position: fixed; padding: var(--space-4) 0; overflow-y: auto;}
        .admin-sidebar a { color: rgba(255,255,255,0.8); display: block; padding: var(--space-2) var(--space-4); text-decoration: none; border-left: 3px solid transparent; }
        .admin-sidebar a:hover, .admin-sidebar a.active { background: rgba(255,255,255,0.1); border-left-color: var(--red-primary); color: white; }
        .admin-content { margin-left: 250px; padding: var(--space-6); min-height: 100vh; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; background: white; padding: var(--space-3) var(--space-6); border-bottom: 1px solid var(--neutral-100); margin: calc(var(--space-6) * -1); margin-bottom: var(--space-6); }
        @media (max-width: 768px) {
            .admin-sidebar { display: none; }
            .admin-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <?php if(!isset($hideNav) || !$hideNav): ?>
    <?php
        $adminPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
        $isDashboard = strpos($adminPath, '/admin/dashboard') !== false;
        $isAccounts  = strpos($adminPath, '/admin/accounts') !== false;
        $isLoans     = strpos($adminPath, '/admin/loans') !== false;
        $isCareers   = strpos($adminPath, '/admin/careers') !== false;
        $isChatbot   = strpos($adminPath, '/admin/chatbot-review') !== false;
        $isFaq       = strpos($adminPath, '/admin/faq-trainer') !== false;
        $isPages     = strpos($adminPath, '/admin/pages') !== false;
    ?>
    <div class="admin-sidebar">
        <div style="padding: 0 var(--space-4) var(--space-4); border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: var(--space-4);">
            <a href="<?= APP_URL ?>/admin/dashboard" style="display:block; margin-bottom: 6px;">
                <img src="<?= APP_URL ?>/assets/images/cemcs-logo-colored-255x68.png" alt="Chevron CEMCS MFB" style="height:40px;width:auto;max-width:100%;">
            </a>
            <p style="font-size: 0.8rem; color: var(--red-primary); margin:0;">Secure Portal</p>
        </div>
        <a href="<?= APP_URL ?>/admin/dashboard" class="<?= $isDashboard ? 'active' : '' ?>">Dashboard</a>
        <a href="<?= APP_URL ?>/admin/accounts" class="<?= $isAccounts || ($isDetail && (($_GET['type'] ?? '') === 'account')) ? 'active' : '' ?>">Account Opens</a>
        <a href="<?= APP_URL ?>/admin/loans" class="<?= $isLoans || ($isDetail && (($_GET['type'] ?? '') === 'loan')) ? 'active' : '' ?>">Loan Apps</a>
        <a href="<?= APP_URL ?>/admin/careers" class="<?= $isCareers || ($isDetail && (($_GET['type'] ?? '') === 'cv')) ? 'active' : '' ?>">CV Applications</a>
        <a href="<?= APP_URL ?>/admin/pages" class="<?= $isPages ? 'active' : '' ?>">Page Manager</a>
        <a href="<?= APP_URL ?>/admin/chatbot-review" class="<?= $isChatbot ? 'active' : '' ?>">Chatbot Review</a>
        <a href="<?= APP_URL ?>/admin/faq-trainer" class="<?= $isFaq ? 'active' : '' ?>">AI FAQ Trainer</a>
        <a href="<?= APP_URL ?>/admin/logout" style="margin-top: var(--space-6); color: var(--red-primary);">Log Out</a>
    </div>
    <div class="admin-content">
        <div class="top-bar">
            <strong>Welcome, Administrator</strong>
            <a href="<?= APP_URL ?>/" target="_blank" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">View Public Site</a>
        </div>
        <?= $content ?? '' ?>
    </div>
    <?php else: ?>
        <?= $content ?? '' ?>
    <?php endif; ?>
</body>
</html>
