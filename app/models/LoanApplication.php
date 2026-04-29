<?php
require_once APP_ROOT . '/app/models/Model.php';

class LoanApplication extends Model {
    protected static string $table = 'loan_applications';

    public static function countByStatus(string $status): int {
        $stmt = static::db()->prepare(
            'SELECT COUNT(*) FROM loan_applications WHERE status = ?'
        );
        $stmt->execute([$status]);
        return (int) $stmt->fetchColumn();
    }
}
