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
            $where[] = "$field = :$field";
            $params[$field] = $value;
        }
        $sql = "SELECT * FROM game_responses WHERE " . implode(' AND ', $where);
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new static($row), $rows);
    }

    /**
     * Tiempo promedio de respuesta por pregunta (en milisegundos), con el
     * texto de la pregunta, el tema y el nivel al que pertenece.
     * Usado en el módulo de Estadísticas (StatisticsController).
     */
    public static function averageTimePerQuestion(int $limit = 10): array
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
}