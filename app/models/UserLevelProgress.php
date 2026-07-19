<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class UserLevelProgress extends Model
{
    protected static string $table = 'user_level_progress';
    protected static string $primaryKey = 'user_id';

    /**
     * Mapa theme_level_id => ['score_percentage' => ..., 'completed' => ...]
     * del usuario, para poder mostrar en la selección de juego qué tema-
     * nivel ya se superó al 100% (insignia de estrella).
     */
    public static function scoresForUser(int $userId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT theme_level_id, score_percentage, completed
             FROM user_level_progress WHERE user_id = :uid"
        );
        $stmt->execute(['uid' => $userId]);
        $result = [];
        foreach ($stmt->fetchAll() as $row) {
            $result[(int)$row['theme_level_id']] = [
                'score_percentage' => (float)$row['score_percentage'],
                'completed' => (int)$row['completed'] === 1
            ];
        }
        return $result;
    }

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

    public static function isLevelUnlocked(int $userId, int $themeLevelId): bool
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare(
            "SELECT tl.theme_id, l.order_index
             FROM theme_levels tl
             JOIN levels l ON l.id = tl.level_id
             WHERE tl.id = :tlid"
        );
        $stmt->execute(['tlid' => $themeLevelId]);
        $current = $stmt->fetch();
        if (!$current) return false;

        $prevStmt = $db->prepare(
            "SELECT tl.id
             FROM theme_levels tl
             JOIN levels l ON l.id = tl.level_id
             WHERE tl.theme_id = :theme_id AND l.order_index < :order_index
             ORDER BY l.order_index DESC
             LIMIT 1"
        );
        $prevStmt->execute([
            'theme_id' => $current['theme_id'],
            'order_index' => $current['order_index']
        ]);
        $previous = $prevStmt->fetch();

        if (!$previous) return true;

        return self::isCompleted($userId, (int)$previous['id']);
    }

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
            'next' => $next['name'] ?? null
        ];
    }

    public static function currentAndNextLevelByTheme(int $userId): array
    {
        $db = Database::getInstance()->getConnection();

        $themes = $db->query("SELECT id, name FROM themes ORDER BY name ASC")->fetchAll();
        $allLevels = $db->query("SELECT id, name, order_index FROM levels ORDER BY order_index ASC")->fetchAll();

        $stmt = $db->prepare(
            "SELECT tl.theme_id, MAX(l.order_index) AS max_order
             FROM user_level_progress ulp
             JOIN theme_levels tl ON tl.id = ulp.theme_level_id
             JOIN levels l ON l.id = tl.level_id
             WHERE ulp.user_id = :uid AND ulp.completed = 1
             GROUP BY tl.theme_id"
        );
        $stmt->execute(['uid' => $userId]);
        $completedByTheme = [];
        foreach ($stmt->fetchAll() as $row) {
            $completedByTheme[$row['theme_id']] = (int)$row['max_order'];
        }

        $result = [];
        foreach ($themes as $theme) {
            $maxOrder = $completedByTheme[$theme['id']] ?? 0;
            $current = null;
            $next = null;
            foreach ($allLevels as $level) {
                if ((int)$level['order_index'] === $maxOrder) {
                    $current = $level['name'];
                }
                if ((int)$level['order_index'] === $maxOrder + 1) {
                    $next = $level['name'];
                }
            }
            $result[] = [
                'theme_name' => $theme['name'],
                'current' => $current,
                'next' => $next
            ];
        }
        return $result;
    }

    /**
     * Ranking de jugadores para un tema-nivel específico, ordenado por
     * PUNTOS acumulados en ese tema-nivel (permite que cualquiera siga
     * escalando jugando más veces). El porcentaje se conserva solo como
     * dato informativo de "mejor racha".
     */
    public static function rankingByThemeLevel(int $themeLevelId, int $limit = 20): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT u.id AS user_id, u.username, u.avatar,
                    ulp.score_percentage, ulp.completed,
                    ulp.points AS theme_level_points, ulp.attempted_at
             FROM user_level_progress ulp
             JOIN users u ON u.id = ulp.user_id
             WHERE ulp.theme_level_id = :tlid AND u.role = 'player'
             ORDER BY ulp.points DESC, ulp.score_percentage DESC, ulp.attempted_at ASC
             LIMIT :lim"
        );
        $stmt->bindValue(':tlid', $themeLevelId, \PDO::PARAM_INT);
        $stmt->bindValue(':lim', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Posición (1-based) de un usuario en el ranking de un tema-nivel,
     * ahora basada en PUNTOS acumulados (mismo criterio de rankingByThemeLevel).
     */
    public static function rankPositionForUser(int $userId, int $themeLevelId): ?int
    {
        $db = Database::getInstance()->getConnection();

        $ownScore = $db->prepare(
            "SELECT points FROM user_level_progress
             WHERE user_id = :uid AND theme_level_id = :tlid"
        );
        $ownScore->execute(['uid' => $userId, 'tlid' => $themeLevelId]);
        $own = $ownScore->fetch();
        if (!$own) return null;

        $stmt = $db->prepare(
            "SELECT COUNT(*) + 1 AS position
             FROM user_level_progress ulp
             JOIN users u ON u.id = ulp.user_id
             WHERE ulp.theme_level_id = :tlid AND u.role = 'player'
             AND ulp.points > :points"
        );
        $stmt->execute(['tlid' => $themeLevelId, 'points' => $own['points']]);
        $row = $stmt->fetch();
        return (int)($row['position'] ?? 1);
    }
}