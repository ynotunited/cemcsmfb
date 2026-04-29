<?php
require_once APP_ROOT . '/app/models/Model.php';

class FormAbandonment extends Model {
    protected static string $table = 'form_abandonments';
    private static bool $tableChecked = false;

    private static function ensureTable(): void {
        if (self::$tableChecked) {
            return;
        }
        self::$tableChecked = true;

        try {
            static::db()->exec(
                "CREATE TABLE IF NOT EXISTS form_abandonments (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    form_type ENUM('open_account','loan') NOT NULL,
                    session_id VARCHAR(100) NULL,
                    full_name VARCHAR(255) NULL,
                    email VARCHAR(255) NULL,
                    phone VARCHAR(80) NULL,
                    current_step VARCHAR(80) NULL,
                    payload TEXT NULL,
                    converted TINYINT(1) NOT NULL DEFAULT 0,
                    reminder_stage TINYINT NOT NULL DEFAULT 0,
                    last_reminder_at DATETIME NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    INDEX idx_email_form (email, form_type),
                    INDEX idx_stage (reminder_stage, converted)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
        } catch (PDOException $e) {
            // Keep app resilient.
        }
    }

    public static function logEvent(array $data): void {
        self::ensureTable();
        try {
            static::insert($data);
        } catch (PDOException $e) {
            // Non-blocking.
        }
    }

    public static function markConverted(string $formType, string $email): void {
        self::ensureTable();
        if ($email === '') {
            return;
        }
        try {
            $stmt = static::db()->prepare(
                "UPDATE form_abandonments
                 SET converted = 1
                 WHERE form_type = ? AND LOWER(email) = LOWER(?)"
            );
            $stmt->execute([$formType, $email]);
        } catch (PDOException $e) {
            // Non-blocking.
        }
    }

    public static function pendingForReminder(int $stage, int $hours): array {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare(
                "SELECT * FROM form_abandonments
                 WHERE converted = 0
                   AND reminder_stage = ?
                   AND email IS NOT NULL
                   AND email <> ''
                   AND updated_at <= DATE_SUB(NOW(), INTERVAL ? HOUR)
                 ORDER BY updated_at ASC
                 LIMIT 200"
            );
            $stmt->bindValue(1, $stage, PDO::PARAM_INT);
            $stmt->bindValue(2, $hours, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function bumpReminderStage(int $id, int $nextStage): void {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare(
                "UPDATE form_abandonments
                 SET reminder_stage = ?, last_reminder_at = NOW()
                 WHERE id = ?"
            );
            $stmt->execute([$nextStage, $id]);
        } catch (PDOException $e) {
            // Non-blocking.
        }
    }

    public static function dropoffSummary(): array {
        self::ensureTable();
        $defaults = [
            'total' => 0,
            'open_account' => 0,
            'loan' => 0,
            'converted' => 0,
            'pending' => 0,
        ];

        try {
            $stmt = static::db()->query(
                "SELECT
                    COUNT(*) AS total,
                    SUM(CASE WHEN form_type = 'open_account' THEN 1 ELSE 0 END) AS open_account,
                    SUM(CASE WHEN form_type = 'loan' THEN 1 ELSE 0 END) AS loan,
                    SUM(CASE WHEN converted = 1 THEN 1 ELSE 0 END) AS converted,
                    SUM(CASE WHEN converted = 0 THEN 1 ELSE 0 END) AS pending
                 FROM form_abandonments"
            );
            $row = $stmt->fetch();
            if (!$row) {
                return $defaults;
            }
            return [
                'total' => (int) ($row['total'] ?? 0),
                'open_account' => (int) ($row['open_account'] ?? 0),
                'loan' => (int) ($row['loan'] ?? 0),
                'converted' => (int) ($row['converted'] ?? 0),
                'pending' => (int) ($row['pending'] ?? 0),
            ];
        } catch (PDOException $e) {
            return $defaults;
        }
    }
}
