<?php
require_once APP_ROOT . '/config/db.php';

/**
 * Base Model — thin PDO wrapper.
 * Subclasses set $table and get find/insert/update helpers for free.
 */
abstract class Model {
    protected static string $table = '';

    protected static function db(): PDO {
        return DB::getInstance();
    }

    public static function all(): array {
        try {
            $stmt = static::db()->query('SELECT * FROM ' . static::$table . ' ORDER BY created_at DESC');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function find(int $id): ?array {
        try {
            $stmt = static::db()->prepare('SELECT * FROM ' . static::$table . ' WHERE id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function insert(array $data): int {
        try {
            $cols        = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));
            $stmt = static::db()->prepare(
                'INSERT INTO ' . static::$table . " ($cols) VALUES ($placeholders)"
            );
            $stmt->execute(array_values($data));
            return (int) static::db()->lastInsertId();
        } catch (PDOException $e) {
            return 0;
        }
    }

    public static function update(int $id, array $data): bool {
        try {
            $set  = implode(', ', array_map(fn($col) => "$col = ?", array_keys($data)));
            $stmt = static::db()->prepare(
                'UPDATE ' . static::$table . " SET $set WHERE id = ?"
            );
            return $stmt->execute([...array_values($data), $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function count(): int {
        try {
            $stmt = static::db()->query('SELECT COUNT(*) FROM ' . static::$table);
            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }
}
