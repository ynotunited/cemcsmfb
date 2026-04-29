<?php
require_once APP_ROOT . '/app/models/Model.php';

class FaqEntry extends Model {
    protected static string $table = 'faq_entries';
    private static bool $tableChecked = false;

    private static function ensureTable(): void {
        if (self::$tableChecked) {
            return;
        }
        self::$tableChecked = true;

        try {
            static::db()->exec(
                "CREATE TABLE IF NOT EXISTS faq_entries (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    question TEXT NOT NULL,
                    answer_text TEXT NOT NULL,
                    source_hint VARCHAR(255) NULL,
                    status ENUM('draft','published') NOT NULL DEFAULT 'draft',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
        } catch (PDOException $e) {
            // Non-blocking.
        }
    }

    public static function createDraft(string $question, string $answerText, string $sourceHint = ''): void {
        self::ensureTable();
        try {
            static::insert([
                'question' => $question,
                'answer_text' => $answerText,
                'source_hint' => $sourceHint !== '' ? $sourceHint : null,
                'status' => 'draft',
            ]);
        } catch (PDOException $e) {
            // Non-blocking.
        }
    }

    public static function drafts(int $limit = 100): array {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare("SELECT * FROM faq_entries WHERE status = 'draft' ORDER BY created_at DESC LIMIT ?");
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function publish(int $id): bool {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare("UPDATE faq_entries SET status = 'published' WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function countDrafts(): int {
        self::ensureTable();
        try {
            $stmt = static::db()->query("SELECT COUNT(*) FROM faq_entries WHERE status = 'draft'");
            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }

    public static function published(int $limit = 200): array {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare("SELECT * FROM faq_entries WHERE status = 'published' ORDER BY updated_at DESC LIMIT ?");
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}
