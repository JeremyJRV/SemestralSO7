<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class UserLevelProgress extends Model
{
    protected static string $table = 'user_level_progress';
    protected static string $primaryKey = 'user_id'; // compuesto, pero usaremos user_id + theme_level_id

    public static function byUser(int $userId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT ulp.*, l.name as level_name, t.name as theme_name
             FROM user_level_progress ulp
             JOIN theme_levels tl ON ulp.theme_level_id = tl.id
             JOIN levels l ON tl.level_id = l.id
             JOIN themes t ON tl.theme_id = t.id
             WHERE ulp.user_id = :uid"
        );
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }

    // Verificar si un nivel está completado
    public static function isCompleted(int $userId, int $themeLevelId): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT completed FROM user_level_progress WHERE user_id = :uid AND theme_level_id = :tlid"
        );
        $stmt->execute(['uid' => $userId, 'tlid' => $themeLevelId]);
        $row = $stmt->fetch();
        return $row && $row['completed'] == 1;
    }
}