<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class UserThemeRating extends Model
{
    protected static string $table = 'user_theme_ratings';

    public static function updateOrCreate(int $userId, int $themeId, string $rating): void
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "INSERT INTO user_theme_ratings (user_id, theme_id, rating)
             VALUES (:uid, :tid, :rating)
             ON DUPLICATE KEY UPDATE rating = :rating2"
        );
        $stmt->execute([
            'uid' => $userId,
            'tid' => $themeId,
            'rating' => $rating,
            'rating2' => $rating
        ]);
    }

    public static function averageRatings(): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT t.id, t.name,
                    COUNT(CASE WHEN r.rating = 'boring' THEN 1 END) as boring,
                    COUNT(CASE WHEN r.rating = 'interesting' THEN 1 END) as interesting,
                    COUNT(CASE WHEN r.rating = 'great' THEN 1 END) as great
             FROM themes t
             LEFT JOIN user_theme_ratings r ON t.id = r.theme_id
             GROUP BY t.id"
        );
        return $stmt->fetchAll();
    }
}