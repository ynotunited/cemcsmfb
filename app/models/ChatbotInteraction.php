<?php
require_once APP_ROOT . '/app/models/Model.php';

class ChatbotInteraction extends Model {
    protected static string $table = 'chatbot_interactions';
    private static bool $tableChecked = false;

    private static function ensureTable(): void {
        if (self::$tableChecked) {
            return;
        }
        self::$tableChecked = true;

        try {
            static::db()->exec(
                "CREATE TABLE IF NOT EXISTS chatbot_interactions (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    question TEXT NOT NULL,
                    answer_text TEXT,
                    answered TINYINT(1) NOT NULL DEFAULT 0,
                    handoff_whatsapp TINYINT(1) NOT NULL DEFAULT 0,
                    intent VARCHAR(60) NULL,
                    prefill_url VARCHAR(255) NULL,
                    source_title VARCHAR(255) NULL,
                    source_url VARCHAR(255) NULL,
                    status ENUM('new','reviewed','resolved','escalated') NOT NULL DEFAULT 'new',
                    review_note TEXT NULL,
                    user_ip VARCHAR(64) NULL,
                    user_agent VARCHAR(255) NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );

            self::ensureColumn('intent', "ALTER TABLE chatbot_interactions ADD COLUMN intent VARCHAR(60) NULL AFTER handoff_whatsapp");
            self::ensureColumn('prefill_url', "ALTER TABLE chatbot_interactions ADD COLUMN prefill_url VARCHAR(255) NULL AFTER intent");
        } catch (PDOException $e) {
            // Keep app resilient if DB permissions prevent CREATE TABLE.
        }
    }

    private static function ensureColumn(string $name, string $sql): void {
        try {
            $stmt = static::db()->prepare("SHOW COLUMNS FROM chatbot_interactions LIKE ?");
            $stmt->execute([$name]);
            $row = $stmt->fetch();
            if (!$row) {
                static::db()->exec($sql);
            }
        } catch (PDOException $e) {
            // Non-blocking.
        }
    }

    public static function log(array $data): void {
        self::ensureTable();
        try {
            static::insert($data);
        } catch (PDOException $e) {
            // Logging failures must never break chat responses.
        }
    }

    public static function recent(int $limit = 200): array {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare('SELECT * FROM chatbot_interactions ORDER BY created_at DESC LIMIT ?');
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function summaryCounts(): array {
        self::ensureTable();
        $defaults = [
            'total' => 0,
            'unanswered_or_handoff' => 0,
            'new' => 0,
            'reviewed' => 0,
            'resolved' => 0,
            'escalated' => 0,
        ];

        try {
            $stmt = static::db()->query(
                "SELECT
                    COUNT(*) AS total,
                    SUM(CASE WHEN answered = 0 OR handoff_whatsapp = 1 THEN 1 ELSE 0 END) AS unanswered_or_handoff,
                    SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) AS new,
                    SUM(CASE WHEN status = 'reviewed' THEN 1 ELSE 0 END) AS reviewed,
                    SUM(CASE WHEN status = 'resolved' THEN 1 ELSE 0 END) AS resolved,
                    SUM(CASE WHEN status = 'escalated' THEN 1 ELSE 0 END) AS escalated
                 FROM chatbot_interactions"
            );
            $row = $stmt->fetch();
            if (!$row) {
                return $defaults;
            }
            return [
                'total' => (int) ($row['total'] ?? 0),
                'unanswered_or_handoff' => (int) ($row['unanswered_or_handoff'] ?? 0),
                'new' => (int) ($row['new'] ?? 0),
                'reviewed' => (int) ($row['reviewed'] ?? 0),
                'resolved' => (int) ($row['resolved'] ?? 0),
                'escalated' => (int) ($row['escalated'] ?? 0),
            ];
        } catch (PDOException $e) {
            return $defaults;
        }
    }

    public static function topUnresolvedQuestions(int $limit = 10): array {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare(
                "SELECT question, COUNT(*) AS total_hits
                 FROM chatbot_interactions
                 WHERE (answered = 0 OR handoff_whatsapp = 1)
                   AND status IN ('new', 'reviewed', 'escalated')
                 GROUP BY question
                 ORDER BY total_hits DESC, MAX(created_at) DESC
                 LIMIT ?"
            );
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function intentBreakdown(): array {
        self::ensureTable();
        try {
            $stmt = static::db()->query(
                "SELECT COALESCE(intent, 'general') AS intent, COUNT(*) AS total
                 FROM chatbot_interactions
                 GROUP BY COALESCE(intent, 'general')
                 ORDER BY total DESC"
            );
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}
