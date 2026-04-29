<?php

/**
 * Google reCAPTCHA v3 server-side verifier.
 *
 * Configuration in config/config.php:
 *   RECAPTCHA_SECRET_KEY  — your server-side secret key
 *   RECAPTCHA_SITE_KEY    — your public site key (used in views)
 *   RECAPTCHA_THRESHOLD   — minimum score to accept (default 0.5)
 *
 * Usage in a controller:
 *   if (!ReCaptcha::verify($_POST['g-recaptcha-response'] ?? '')) {
 *       return $this->jsonResponse(['error' => 'reCAPTCHA failed'], 400);
 *   }
 */
class ReCaptcha {

    private const VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Verify a reCAPTCHA v3 token.
     *
     * @param string $token   The token from the frontend (g-recaptcha-response)
     * @param string $action  Expected action name (e.g. 'contact', 'open_account')
     * @return bool
     */
    public static function verify(string $token, string $action = ''): bool {
        $secret    = defined('RECAPTCHA_SECRET_KEY') ? RECAPTCHA_SECRET_KEY : '';
        $threshold = defined('RECAPTCHA_THRESHOLD')  ? (float) RECAPTCHA_THRESHOLD : 0.5;

        // If no secret key is configured, skip verification gracefully
        // (allows local dev without reCAPTCHA keys)
        if (empty($secret) || $secret === 'YOUR_RECAPTCHA_SECRET_KEY') {
            return true;
        }

        if (empty($token)) {
            return false;
        }

        $payload = http_build_query([
            'secret'   => $secret,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
        ]);

        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $payload,
                'timeout' => 5,
            ],
        ]);

        $result = @file_get_contents(self::VERIFY_URL, false, $context);

        if ($result === false) {
            // Network failure — fail open in dev, fail closed in prod
            return !defined('APP_ENV') || APP_ENV !== 'production';
        }

        $data = json_decode($result, true);

        if (!isset($data['success']) || $data['success'] !== true) {
            return false;
        }

        if ((float) ($data['score'] ?? 0) < $threshold) {
            return false;
        }

        // Optionally verify the action name matches
        if ($action && isset($data['action']) && $data['action'] !== $action) {
            return false;
        }

        return true;
    }
}
