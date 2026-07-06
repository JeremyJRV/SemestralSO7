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

    /**
     * Nivel más alto que el usuario ha COMPLETADO, en cualquier tema
     * (según order_index de la tabla levels), y el siguiente nivel al
     * que podría avanzar. Usado en el Dashboard, que antes siempre
     * mostraba "Sin nivel asignado" porque nadie calculaba este dato.
     *
     * @return array{current: ?string, next: ?string}
     */
    public static function currentAndNextLevelForUser(int $userId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT l.name, l.order_index
             FROM user_level_progress ulp
             JOIN theme_levels tl ON tl.id = ulp.theme_level_id
             JOIN levels l ON l.id = tl.level_id
             WHERE ulp.user_id = :uid AND ulp.completed = 1
             ORDER BY l.order_index DESC
             LIMIT 1"
        );
        $stmt->execute(['uid' => $userId]);
        $highest = $stmt->fetch();

        if (!$highest) {
            // Aún no completa ningún nivel: el "siguiente" es el primero (Básico)
            $first = $db->query("SELECT name FROM levels ORDER BY order_index ASC LIMIT 1")->fetch();
            return ['current' => null, 'next' => $first['name'] ?? null];
        }

        $nextStmt = $db->prepare(
            "SELECT name FROM levels WHERE order_index > :idx ORDER BY order_index ASC LIMIT 1"
        );
        $nextStmt->execute(['idx' => $highest['order_index']]);
        $next = $nextStmt->fetch();

        return [
            'current' => $highest['name'],
            'next' => $next['name'] ?? null // null si ya completó el nivel más alto
        ];
    }
}