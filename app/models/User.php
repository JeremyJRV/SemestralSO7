<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class User extends Model
{
    protected static string $table = 'users';

    public static function findByEmail(string $email): ?self
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        return $row ? new self($row) : null;
    }

    public function addPoints(int $points): void
    {
        $this->total_points += $points;
        $this->save();
    }

    public static function cedulaExists(string $cedula): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE cedula = :cedula LIMIT 1");
        $stmt->execute(['cedula' => $cedula]);
        return (bool)$stmt->fetch();
    }

    /**
     * Ranking global de jugadores por puntos totales. En caso de empate,
     * desempata por quién alcanzó ese puntaje primero (updated_at más
     * antiguo), para que la posición coincida siempre con
     * globalRankPosition() y no haya contradicciones visuales entre
     * el banner "tu posición" y la fila que ocupa en la tabla.
     */
    public static function topByPoints(int $limit = 20): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT id, username, avatar, total_points, role
             FROM users
             WHERE role = 'player'
             ORDER BY total_points DESC, updated_at ASC
             LIMIT :lim"
        );
        $stmt->bindValue(':lim', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Posición (1-based) de un usuario específico en el ranking global,
     * usando el mismo criterio de desempate que topByPoints(): en caso
     * de mismo puntaje, cuenta como "por delante" a quien lo alcanzó
     * antes (updated_at más antiguo).
     */
    public static function globalRankPosition(int $userId): int
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT COUNT(*) + 1 AS position
             FROM users u2, users me
             WHERE me.id = :uid AND u2.role = 'player'
             AND (
                 u2.total_points > me.total_points
                 OR (u2.total_points = me.total_points AND u2.updated_at < me.updated_at)
             )"
        );
        $stmt->execute(['uid' => $userId]);
        $row = $stmt->fetch();
        return (int)($row['position'] ?? 1);
    }
}