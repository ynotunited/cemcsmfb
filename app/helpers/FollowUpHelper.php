<?php
require_once APP_ROOT . '/app/models/FormAbandonment.php';
require_once APP_ROOT . '/app/models/FollowUpLog.php';
require_once APP_ROOT . '/app/helpers/Mailer.php';

class FollowUpHelper {
    public static function run(): array {
        $result = [
            'checked' => 0,
            'sent' => 0,
            'failed' => 0,
        ];

        $stage1 = FormAbandonment::pendingForReminder(0, 24);
        $stage2 = FormAbandonment::pendingForReminder(1, 72);
        $targets = array_merge($stage1, $stage2);

        foreach ($targets as $row) {
            $result['checked']++;
            $email = trim((string) ($row['email'] ?? ''));
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            $currentStage = (int) ($row['reminder_stage'] ?? 0);
            $nextStage = $currentStage + 1;
            $subject = $nextStage === 1
                ? 'Complete your application — CEMCS MFB'
                : 'Final reminder: Your CEMCS MFB application is waiting';

            $fullName = trim((string) ($row['full_name'] ?? ''));
            $first = $fullName !== '' ? explode(' ', $fullName)[0] : 'there';
            $formLink = $row['form_type'] === 'loan' ? APP_URL . '/loans' : APP_URL . '/open-account';
            $body = "<p>Hi {$first},</p>
                     <p>We noticed your application was not completed. You can continue where you left off using the link below:</p>
                     <p><a href='{$formLink}'>{$formLink}</a></p>
                     <p>If you need help, contact our support team via WhatsApp or the contact page.</p>
                     <p>Warm regards,<br><strong>CEMCS MFB</strong></p>";

            $ok = Mailer::send($email, $subject, $body);
            FollowUpLog::logAttempt((int) $row['id'], $email, $nextStage, $ok);

            if ($ok) {
                $result['sent']++;
                FormAbandonment::bumpReminderStage((int) $row['id'], min(2, $nextStage));
            } else {
                $result['failed']++;
            }
        }

        return $result;
    }
}
