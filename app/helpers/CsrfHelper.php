<?php

/**
 * CSRF Protection Helper
 *
 * Usage:
 *   - In views:  CsrfHelper::field()          → renders a hidden <input>
 *   - In API:    CsrfHelper::verify()          → throws/returns false on mismatch
 *   - Token:     CsrfHelper::token()           → returns the raw token string
 */
class CsrfHelper {

    private const SESSION_KEY = '_csrf_token';

    /**
     * Return (and lazily generate) the session CSRF token.
     */
    public static function token(): string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(32));
        }

        return $_SESSION[self::SESSION_KEY];
    }

    /**
     * Echo a hidden input field containing the CSRF token.
     * Drop <?= CsrfHelper::field() ?> inside every <form>.
     */
    public static function field(): string {
        return '<input type="hidden" name="_csrf_token" value="' . htmlspecialchars(self::token(), ENT_QUOTES, 'UTF-8') . '">';
    }

    /**
     * Verify the submitted token against the session token.
     * Returns true on success, false on failure.
     * Regenerates the token after each successful verification.
     */
    public static function verify(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $submitted = $_POST['_csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
        $stored    = $_SESSION[self::SESSION_KEY] ?? '';

        if (!$stored || !hash_equals($stored, $submitted)) {
            return false;
        }

        // Rotate token after successful use
        $_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(32));
        return true;
    }
}
