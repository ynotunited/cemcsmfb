<?php

/**
 * Mailer — lightweight SMTP-aware email helper for shared hosting.
 *
 * Uses PHP's built-in mail() with additional headers for SMTP relay.
 * For production, swap the send() body for PHPMailer/SwiftMailer if
 * the host supports Composer; the public API stays identical.
 *
 * Configuration lives in config/config.php:
 *   MAIL_FROM_ADDRESS, MAIL_FROM_NAME, MAIL_STAFF_ADDRESS
 */
class Mailer {

    /**
     * Send a plain-text + HTML email.
     *
     * @param string $to      Recipient email address
     * @param string $subject Email subject
     * @param string $body    HTML body (plain-text fallback auto-generated)
     * @return bool
     */
    public static function send(string $to, string $subject, string $body): bool {
        $fromAddress = defined('MAIL_FROM_ADDRESS') ? MAIL_FROM_ADDRESS : 'noreply@cemcsmfb.com';
        $fromName    = defined('MAIL_FROM_NAME')    ? MAIL_FROM_NAME    : 'CEMCS MFB';

        $plainText = strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>', '</div>'], "\n", $body));

        $boundary = md5(uniqid((string) time()));

        $headers  = "From: {$fromName} <{$fromAddress}>\r\n";
        $headers .= "Reply-To: {$fromAddress}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"{$boundary}\"\r\n";
        $headers .= "X-Mailer: CEMCS-MFB-Mailer/1.0\r\n";

        $message  = "--{$boundary}\r\n";
        $message .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
        $message .= $plainText . "\r\n\r\n";
        $message .= "--{$boundary}\r\n";
        $message .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
        $message .= self::wrapHtml($subject, $body) . "\r\n\r\n";
        $message .= "--{$boundary}--";

        return @mail($to, $subject, $message, $headers);
    }

    /**
     * Notify bank staff of a new submission.
     */
    public static function notifyStaff(string $subject, string $body): bool {
        $staffEmail = defined('MAIL_STAFF_ADDRESS') ? MAIL_STAFF_ADDRESS : 'admin@cemcsmfb.com';
        return self::send($staffEmail, $subject, $body);
    }

    /**
     * Send a confirmation email to an applicant.
     */
    public static function confirmApplicant(string $toEmail, string $applicantName, string $subject, string $body): bool {
        return self::send($toEmail, $subject, $body);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private static function wrapHtml(string $title, string $body): string {
        $year    = date('Y');
        $appName = defined('APP_NAME') ? APP_NAME : 'Chevron CEMCS MFB';

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$title}</title>
</head>
<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
          <!-- Header -->
          <tr>
            <td style="background:#0A1020;padding:28px 40px;text-align:center;">
              <span style="font-family:Georgia,serif;font-size:22px;font-weight:700;color:#ffffff;">
                <span style="color:#2D8EFF;">CEMCS</span> MFB
              </span>
            </td>
          </tr>
          <!-- Body -->
          <tr>
            <td style="padding:40px;color:#1a1a2e;font-size:15px;line-height:1.7;">
              {$body}
            </td>
          </tr>
          <!-- Footer -->
          <tr>
            <td style="background:#f4f6f9;padding:24px 40px;text-align:center;font-size:12px;color:#888;">
              &copy; {$year} {$appName}. All rights reserved.<br>
              This is an automated notification. Please do not reply directly to this email.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;
    }
}
