<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class GameSession extends Model
{
    protected static string $table = 'game_sessions';

    public static function findByRoomCode(string $roomCode): ?static
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM game_sessions WHERE room_code = :code");
        $stmt->execute(['code' => $roomCode]);
        $row = $stmt->fetch();
        return $row ? new static($row) : null;
    }
}