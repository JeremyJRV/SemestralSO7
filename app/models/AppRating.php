<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class AppRating extends Model
{
    protected static string $table = 'app_ratings';

    public static function hasUserRated(int $userId): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT 1 FROM app_ratings WHERE user_id = :uid");
        $stmt->execute(['uid' => $userId]);
        return (bool)$stmt->fetch();
    }

    public static function submit(int $userId, string $rating): bool
    {
        if (self::hasUserRated($userId)) {
            return false;
        }
        $appRating = new self([
            'user_id' => $userId,
            'rating' => $rating
        ]);
        $appRating->save();
        return true;
    }

    public static function stats(): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT rating, COUNT(*) as total FROM app_ratings GROUP BY rating"
        );
        $rows = $stmt->fetchAll();
        $result = ['mucho' => 0, 'regular' => 0, 'medio' => 0, 'bastante' => 0];
        foreach ($rows as $row) {
            $result[$row['rating']] = (int)$row['total'];
        }
        return $result;
    }

    public static function all(): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT ar.*, u.username
             FROM app_ratings ar
             JOIN users u ON u.id = ar.user_id
             ORDER BY ar.created_at DESC"
        );
        return $stmt->fetchAll();
    }
}