<?php
require_once APP_ROOT . '/app/models/Model.php';

class AccountApplication extends Model {
    protected static string $table = 'account_applications';

    public static function countByStatus(string $status): int {
        $stmt = static::db()->prepare(
            'SELECT COUNT(*) FROM account_applications WHERE status = ?'
        );
        $stmt->execute([$status]);
        return (int) $stmt->fetchColumn();
    }
}
