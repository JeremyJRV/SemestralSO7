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

    /**
     * Ranking global de jugadores por puntos totales.
     * Usado en la nueva pantalla de Ranking (rúbrica: "el jugador puede
     * ver el avance de otros jugadores y su posición").
     */
    public static function topByPoints(int $limit = 20): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT id, username, avatar, total_points, role
             FROM users
             WHERE role = 'player'
             ORDER BY total_points DESC
             LIMIT :lim"
        );
        $stmt->bindValue(':lim', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Posición (1-based) de un usuario específico en el ranking global
     * de puntos, sin importar si está dentro del top mostrado o no.
     */
    public static function globalRankPosition(int $userId): int
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT COUNT(*) + 1 AS position
             FROM users
             WHERE role = 'player' AND total_points > (
                 SELECT total_points FROM users WHERE id = :uid
             )"
        );
        $stmt->execute(['uid' => $userId]);
        $row = $stmt->fetch();
        return (int)($row['position'] ?? 1);
    }
}