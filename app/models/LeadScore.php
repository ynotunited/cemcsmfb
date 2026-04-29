<?php
require_once APP_ROOT . '/app/models/Model.php';

class LeadScore extends Model {
    protected static string $table = 'lead_scores';
    private static bool $tableChecked = false;

    private static function ensureTable(): void {
        if (self::$tableChecked) {
            return;
        }
        self::$tableChecked = true;

        try {
            static::db()->exec(
                "CREATE TABLE IF NOT EXISTS lead_scores (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    entity_type ENUM('account','loan') NOT NULL,
                    entity_id INT NOT NULL,
                    score INT NOT NULL DEFAULT 0,
                    priority ENUM('low','medium','high') NOT NULL DEFAULT 'low',
                    reasons TEXT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    UNIQUE KEY uq_entity (entity_type, entity_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
            );
        } catch (PDOException $e) {
            // Keep app resilient.
        }
    }

    public static function upsert(string $entityType, int $entityId, int $score, string $priority, array $reasons): void {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare(
                "INSERT INTO lead_scores (entity_type, entity_id, score, priority, reasons)
                 VALUES (?, ?, ?, ?, ?)
                 ON DUPLICATE KEY UPDATE
                    score = VALUES(score),
                    priority = VALUES(priority),
                    reasons = VALUES(reasons),
                    updated_at = CURRENT_TIMESTAMP"
            );
            $stmt->execute([$entityType, $entityId, $score, $priority, json_encode($reasons)]);
        } catch (PDOException $e) {
            // Non-blocking for primary flow.
        }
    }

    public static function mapByType(string $entityType): array {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare('SELECT * FROM lead_scores WHERE entity_type = ?');
            $stmt->execute([$entityType]);
            $rows = $stmt->fetchAll();
            $map = [];
            foreach ($rows as $row) {
                $map[(int) $row['entity_id']] = $row;
            }
            return $map;
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function topPriorities(int $limit = 10): array {
        self::ensureTable();
        try {
            $stmt = static::db()->prepare(
                "SELECT * FROM lead_scores
                 ORDER BY
                    CASE priority WHEN 'high' THEN 3 WHEN 'medium' THEN 2 ELSE 1 END DESC,
                    score DESC,
                    updated_at DESC
                 LIMIT ?"
            );
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}
