<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class LoginAttempt extends Model
{
    protected static string $table = 'login_attempts';

    // Registrar intento
    public static function log(?int $userId, string $ip, bool $success): void
    {
        $attempt = new self([
            'user_id' => $userId,
            'ip_address' => $ip,
            'success' => $success ? 1 : 0
        ]);
        $attempt->save();
    }

    // Verificar si la IP está bloqueada (3 fallos en los últimos 15 minutos)
    public static function isBlocked(string $ip): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT COUNT(*) as attempts FROM login_attempts
             WHERE ip_address = :ip AND success = 0
             AND attempted_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE)"
        );
        $stmt->execute(['ip' => $ip]);
        $row = $stmt->fetch();
        return $row['attempts'] >= 3;
    }

    // Intentos restantes
    public static function remainingAttempts(string $ip): int
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT COUNT(*) as attempts FROM login_attempts
             WHERE ip_address = :ip AND success = 0
             AND attempted_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE)"
        );
        $stmt->execute(['ip' => $ip]);
        $row = $stmt->fetch();
        return max(0, 3 - (int)$row['attempts']);
    }
}