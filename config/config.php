<?php

// ─── Application ─────────────────────────────────────────────────────────────
define('APP_NAME', 'Chevron CEMCS MFB');

$currentHost = $_SERVER['HTTP_HOST'] ?? '';
$isLocalHost = in_array($currentHost, ['localhost', '127.0.0.1'], true)
    || str_ends_with($currentHost, '.test')
    || str_ends_with($currentHost, '.localhost')
    || str_ends_with($currentHost, '.local');

// Default to production on hosted environments unless explicitly overridden.
define('APP_ENV', getenv('APP_ENV') ?: ($isLocalHost ? 'development' : 'production'));

// ─── Database ────────────────────────────────────────────────────────────────
// Local development stays on localhost, while production uses the Byet Host
// MySQL details unless env vars override them.
define('DB_HOST', getenv('DB_HOST') ?: (APP_ENV === 'production' ? 'sql113.byethost3.com' : 'localhost'));
define('DB_USER', getenv('DB_USER') ?: (APP_ENV === 'production' ? 'b3_41782053' : 'root'));
define('DB_PASS', getenv('DB_PASS') ?: (APP_ENV === 'production' ? 'vn#tqVb44L73ES.' : ''));
define('DB_NAME', getenv('DB_NAME') ?: (APP_ENV === 'production' ? 'b3_41782053_cemcsmfb' : 'cemcsmfb_db'));

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
