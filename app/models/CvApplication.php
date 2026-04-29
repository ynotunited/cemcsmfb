<?php
require_once APP_ROOT . '/app/models/Model.php';

class CvApplication extends Model {
    protected static string $table = 'cv_applications';

    public static function countByStatus(string $status): int {
        $stmt = static::db()->prepare(
            'SELECT COUNT(*) FROM cv_applications WHERE status = ?'
        );
        $stmt->execute([$status]);
        return (int) $stmt->fetchColumn();
    }
}
