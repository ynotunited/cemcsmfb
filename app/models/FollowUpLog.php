<?php
require_once APP_ROOT . '/app/models/Model.php';

class FollowUpLog extends Model {
    protected static string $table = 'follow_up_logs';
    private static bool $tableChecked = false;

    private static function ensureTable(): void {
        if (self::$tableChecked) {
            return;
        }
        self::$tableChecked = true;

        try {
            static::db()->exec(
                "CREATE TABLE IF NOT EXISTS follow_up_logs (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    abandonment_id INT NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    stage TINYINT NOT NULL,
                    channel ENUM('email') NOT NULL DEFAULT 'email',
                    success TINYINT(1) NOT NULL DEFAULT 0,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    INDEX idx_abandonment (abandonment_id),
                    INDEX idx_stage (stage)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
        } catch (PDOException $e) {
            // Keep resilient.
        }
    }

    public static function logAttempt(int $abandonmentId, string $email, int $stage, bool $success): void {
        self::ensureTable();
        try {
            static::insert([
                'abandonment_id' => $abandonmentId,
                'email' => $email,
                'stage' => $stage,
                'channel' => 'email',
                'success' => $success ? 1 : 0,
            ]);
        } catch (PDOException $e) {
            // Non-blocking.
        }
    }

    public static function summary(): array {
        self::ensureTable();
        $defaults = [
            'total_sent' => 0,
            'successful' => 0,
            'failed' => 0,
        ];
        try {
            $stmt = static::db()->query(
                "SELECT
                    COUNT(*) AS total_sent,
                    SUM(CASE WHEN success = 1 THEN 1 ELSE 0 END) AS successful,
                    SUM(CASE WHEN success = 0 THEN 1 ELSE 0 END) AS failed
                 FROM follow_up_logs"
            );
            $row = $stmt->fetch();
            if (!$row) {
                return $defaults;
            }
            return [
                'total_sent' => (int) ($row['total_sent'] ?? 0),
                'successful' => (int) ($row['successful'] ?? 0),
                'failed' => (int) ($row['failed'] ?? 0),
            ];
        } catch (PDOException $e) {
            return $defaults;
        }
    }
}
