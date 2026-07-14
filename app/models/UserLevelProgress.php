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

    /**
     * Nivel actual (el más alto COMPLETADO) y siguiente nivel, calculado
     * POR CADA TEMA por separado. Reemplaza a currentAndNextLevelForUser()
     * en el Dashboard.
     *
     * BUG CORREGIDO: el Dashboard usaba currentAndNextLevelForUser(), que
     * calcula un único "nivel actual" tomando el máximo entre TODOS los
     * temas mezclados. Así, si el jugador llegó a Avanzado en un tema
     * pero apenas empieza otro, el Dashboard mostraba "Avanzado" como si
     * fuera su nivel en todo, ocultando que en los demás temas va más
     * atrás (o no ha empezado). Ahora se calcula un nivel actual/siguiente
     * independiente para CADA tema.
     *
     * @return array<int, array{theme_name:string, current:?string, next:?string}>
     */
    public static function currentAndNextLevelByTheme(int $userId): array
    {
        $db = Database::getInstance()->getConnection();

        $themes = $db->query("SELECT id, name FROM themes ORDER BY name ASC")->fetchAll();
        $allLevels = $db->query("SELECT id, name, order_index FROM levels ORDER BY order_index ASC")->fetchAll();

        // Nivel más alto (order_index) que el usuario ya completó, por tema
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
                'current' => $current, // null = todavía no completa ningún nivel de este tema
                'next' => $next        // null = ya completó el nivel más alto de este tema
            ];
        }
        return $result;
    }

    /**
     * Ranking de jugadores para un tema-nivel específico, ordenado por
     * porcentaje de acierto (score_percentage) y, en empate, por quién lo
     * completó primero. Usado en la nueva pantalla de Ranking.
     */
    public static function rankingByThemeLevel(int $themeLevelId, int $limit = 20): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT u.id AS user_id, u.username, u.avatar,
                    ulp.score_percentage, ulp.completed, ulp.attempted_at
             FROM user_level_progress ulp
             JOIN users u ON u.id = ulp.user_id
             WHERE ulp.theme_level_id = :tlid
             ORDER BY ulp.score_percentage DESC, ulp.attempted_at ASC
             LIMIT :lim"
        );
        $stmt->bindValue(':tlid', $themeLevelId, \PDO::PARAM_INT);
        $stmt->bindValue(':lim', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Posición (1-based) de un usuario en el ranking de un tema-nivel
     * específico (aunque no esté dentro del $limit del listado principal).
     */
    public static function rankPositionForUser(int $userId, int $themeLevelId): ?int
    {
        $db = Database::getInstance()->getConnection();

        $ownScore = $db->prepare(
            "SELECT score_percentage FROM user_level_progress
             WHERE user_id = :uid AND theme_level_id = :tlid"
        );
        $ownScore->execute(['uid' => $userId, 'tlid' => $themeLevelId]);
        $own = $ownScore->fetch();
        if (!$own) return null; // el usuario no ha jugado este tema-nivel

        $stmt = $db->prepare(
            "SELECT COUNT(*) + 1 AS position
             FROM user_level_progress
             WHERE theme_level_id = :tlid AND score_percentage > :score"
        );
        $stmt->execute(['tlid' => $themeLevelId, 'score' => $own['score_percentage']]);
        $row = $stmt->fetch();
        return (int)($row['position'] ?? 1);
    }
}