<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class User extends Model
{
    protected static string $table = 'users';

    // Buscar por email (para login)
    public static function findByEmail(string $email): ?self
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        return $row ? new self($row) : null;
    }

    // Total de puntos (puede ser calculado, pero se guarda en la columna total_points)
    public function addPoints(int $points): void
    {
        $this->total_points += $points;
        $this->save();
    }
}