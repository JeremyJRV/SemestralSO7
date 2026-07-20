<?php

namespace App\Models;

use clases\Model;
use clases\Database;

class GameResponse extends Model
{
    protected static string $table = 'game_responses';

    // Método 'where' con varias condiciones (para simplificar)
    public static function whereMultiple(array $conditions): array
    {
        $db = Database::getInstance()->getConnection();
        $where = [];
        $params = [];
        foreach ($conditions as $field => $value) {
            $where[] = "gr.$field = :$field";
            $params[$field] = $value;
        }
        $sql = "SELECT gr.*, q.text AS question_text 
            FROM game_responses gr
            JOIN questions q ON q.id = gr.question_id
            WHERE " . implode(' AND ', $where);
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new static($row), $rows);
    }

    /**
     * Tiempo promedio de respuesta por pregunta (en milisegundos), con el
     * texto de la pregunta, el tema y el nivel al que pertenece.
     * Usado en el módulo de Estadísticas (StatisticsController).
     *
     * BUG CORREGIDO: el límite por defecto era 10, y el ORDER BY es
     * "avg_time_ms DESC" (de mayor a menor tiempo). Las 3 preguntas
     * originales de PHP-Básico tienen tiempos de respuesta enormes en los
     * datos de prueba iniciales del proyecto (hasta ~430 segundos), así
     * que siempre quedan arriba de la lista. En cuanto se agregaron más
     * de 10 preguntas distintas respondidas en total (ej. al sumar
     * PHP-Intermedio y Laravel, con tiempos normales y bajos), esas
     * quedaban FUERA del límite y nunca se mostraban. Se subió el límite
     * por defecto para que esto no vuelva a pasar con pocos temas/niveles.
     */
    public static function averageTimePerQuestion(int $limit = 100): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT q.id AS question_id,
                    q.text AS question_text,
                    t.name AS theme_name,
                    l.name AS level_name,
                    AVG(gr.response_time_ms) AS avg_time_ms,
                    COUNT(gr.id) AS total_answers
             FROM game_responses gr
             JOIN questions q ON q.id = gr.question_id
             JOIN theme_levels tl ON tl.id = q.theme_level_id
             JOIN themes t ON t.id = tl.theme_id
             JOIN levels l ON l.id = tl.level_id
             GROUP BY q.id
             ORDER BY avg_time_ms DESC
             LIMIT :limit"
        );
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Tiempo promedio de respuesta por pregunta, calculado SOLO para un
     * usuario específico. Útil para el perfil/avance de un jugador.
     */
    public static function averageTimePerQuestionForUser(int $userId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT q.id AS question_id,
                    q.text AS question_text,
                    t.name AS theme_name,
                    l.name AS level_name,
                    AVG(gr.response_time_ms) AS avg_time_ms,
                    COUNT(gr.id) AS total_answers
             FROM game_responses gr
             JOIN questions q ON q.id = gr.question_id
             JOIN theme_levels tl ON tl.id = q.theme_level_id
             JOIN themes t ON t.id = tl.theme_id
             JOIN levels l ON l.id = tl.level_id
             WHERE gr.user_id = :uid
             GROUP BY q.id
             ORDER BY avg_time_ms DESC"
        );
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Tiempo promedio general de respuesta (todas las preguntas, todos los
     * usuarios), en milisegundos. Para la tarjeta resumen de Estadísticas.
     */
    public static function overallAverageTime(): float
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT AVG(response_time_ms) AS avg_time_ms FROM game_responses");
        $row = $stmt->fetch();
        return (float)($row['avg_time_ms'] ?? 0);
    }

    /**
     * Cantidad de partidas distintas jugadas por un usuario (sesiones
     * distintas en las que respondió al menos una pregunta).
     * Usado en el Dashboard, que antes siempre mostraba 0 porque nadie
     * calculaba este dato.
     */
    public static function sessionsPlayedByUser(int $userId): int
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT COUNT(DISTINCT session_id) AS total
             FROM game_responses WHERE user_id = :uid"
        );
        $stmt->execute(['uid' => $userId]);
        $row = $stmt->fetch();
        return (int)($row['total'] ?? 0);
    }

    /**
     * Porcentaje de aciertos de un usuario sobre todas sus respuestas.
     * Usado en el Dashboard.
     */
    public static function accuracyForUser(int $userId): float
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT
                SUM(is_correct) AS correct,
                COUNT(*) AS total
             FROM game_responses WHERE user_id = :uid"
        );
        $stmt->execute(['uid' => $userId]);
        $row = $stmt->fetch();
        $total = (int)($row['total'] ?? 0);
        if ($total === 0) return 0;
        return round(((int)$row['correct'] / $total) * 100, 1);
    }

    /**
     * Actividad reciente de un usuario, agrupada por partida (sesión),
     * con tema, nivel, aciertos y fecha. Usado en el Dashboard, que antes
     * siempre mostraba "Aún no tienes actividad" porque nadie consultaba
     * esta información.
     */
    public static function recentActivityForUser(int $userId, int $limit = 5): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT
                gr.session_id,
                MAX(gr.answered_at) AS played_at,
                t.name AS theme_name,
                l.name AS level_name,
                SUM(gr.is_correct) AS correct,
                COUNT(*) AS total
             FROM game_responses gr
             JOIN game_sessions gs ON gs.id = gr.session_id
             JOIN theme_levels tl ON tl.id = gs.theme_level_id
             JOIN themes t ON t.id = tl.theme_id
             JOIN levels l ON l.id = tl.level_id
             WHERE gr.user_id = :uid
             GROUP BY gr.session_id
             ORDER BY played_at DESC
             LIMIT :lim"
        );
        $stmt->bindValue(':uid', $userId, \PDO::PARAM_INT);
        $stmt->bindValue(':lim', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $activity = [];
        foreach ($rows as $row) {
            $percentage = $row['total'] > 0 ? round(($row['correct'] / $row['total']) * 100) : 0;
            $activity[] = [
                'icon' => $percentage >= 80 ? 'bi-trophy' : 'bi-joystick',
                // Texto plano (sin HTML): la vista dashboard/index.php
                // imprime esto con htmlspecialchars(), así que las
                // etiquetas HTML se mostrarían literalmente en pantalla.
                'description' => "Jugaste {$row['theme_name']} - {$row['level_name']} ({$row['correct']}/{$row['total']} correctas, {$percentage}%)",
                'time' => self::timeAgo($row['played_at'])
            ];
        }
        return $activity;
    }

    /**
     * Convierte una fecha a formato relativo ("hace 5 minutos", "hace 2 días").
     */
    private static function timeAgo(string $datetime): string
    {
        $diff = time() - strtotime($datetime);
        if ($diff < 60) return 'Justo ahora';
        if ($diff < 3600) return 'Hace ' . floor($diff / 60) . ' min';
        if ($diff < 86400) return 'Hace ' . floor($diff / 3600) . ' h';
        return 'Hace ' . floor($diff / 86400) . ' d';
    }
}
