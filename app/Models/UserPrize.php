<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class UserPrize extends Model
{
    protected static string $table = 'user_prizes';
    protected static string $primaryKey = 'user_id'; // compuesto, pero consultamos por user_id

    public static function byUser(int $userId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT p.name, p.image, p.points_value, up.awarded_at
             FROM user_prizes up
             JOIN prizes p ON up.prize_id = p.id
             WHERE up.user_id = :uid"
        );
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }
}