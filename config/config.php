<?php

// ─── Database ────────────────────────────────────────────────────────────────
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cemcsmfb_db');

// ─── Application ─────────────────────────────────────────────────────────────
define('APP_NAME', 'Chevron CEMCS MFB');
define('APP_ENV',  'development'); // Change to 'production' on live server

// Use dynamically detected base paths when deployed on cPanel
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
$cwd_path = str_replace('\\', '/', dirname(dirname(__FILE__)));
$doc_root = $_SERVER['DOCUMENT_ROOT'] ? str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) : $cwd_path;
$base_url = str_replace($doc_root, '', $cwd_path);

define('APP_URL',  $protocol . '://' . $host . $base_url);
define('APP_ROOT', dirname(dirname(__FILE__)));

// ─── Admin authentication ────────────────────────────────────────────────────
// Override via environment variables on production:
// ADMIN_USERNAME and ADMIN_PASSWORD_HASH (bcrypt hash)
define('ADMIN_USERNAME', getenv('ADMIN_USERNAME') ?: 'cemcsadmin');
define(
    'ADMIN_PASSWORD_HASH',
    getenv('ADMIN_PASSWORD_HASH') ?: '$2y$12$BOld4v2uhECCLFDD0.j/SOxDJ4zzw1GmiNbfa/EhcfxRqGIR8GOjK'
);

// ─── Email / SMTP ─────────────────────────────────────────────────────────────
// These are used by app/helpers/Mailer.php
// On cPanel, configure SMTP relay in the hosting panel and set these values.
define('MAIL_FROM_ADDRESS', 'noreply@cemcsmfb.com');
define('MAIL_FROM_NAME',    'Chevron CEMCS MFB');
define('MAIL_STAFF_ADDRESS', 'admin@cemcsmfb.com'); // Staff notification recipient

// ─── Chat support handoff ────────────────────────────────────────────────────
define('WHATSAPP_SUPPORT_NUMBER', getenv('WHATSAPP_SUPPORT_NUMBER') ?: '2348087995012');

// ─── Google reCAPTCHA v3 ──────────────────────────────────────────────────────
// Register at https://www.google.com/recaptcha/admin
// Replace placeholder values with your actual keys before going live.
define('RECAPTCHA_SITE_KEY',   'YOUR_RECAPTCHA_SITE_KEY');   // Public — used in views
define('RECAPTCHA_SECRET_KEY', 'YOUR_RECAPTCHA_SECRET_KEY'); // Private — server-side only
define('RECAPTCHA_THRESHOLD',  0.5); // Minimum score (0.0–1.0) to accept a submission
