<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class Theme extends Model
{
    protected static string $table = 'themes';

    // Temas más jugados (basado en game_responses)
    public static function mostPlayed(int $limit = 5): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT t.id, t.name, COUNT(gr.id) as total_responses
             FROM themes t
             JOIN theme_levels tl ON tl.theme_id = t.id
             JOIN game_sessions gs ON gs.theme_level_id = tl.id
             JOIN game_responses gr ON gr.session_id = gs.id
             GROUP BY t.id
             ORDER BY total_responses DESC
             LIMIT :limit"
        );
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}