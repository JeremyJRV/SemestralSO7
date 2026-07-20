<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class ThemeSuggestion extends Model
{
    protected static string $table = 'theme_suggestions';

    public static function submit(int $userId, string $suggestion): void
    {
        $themeSuggestion = new self([
            'user_id' => $userId,
            'suggestion' => trim($suggestion)
        ]);
        $themeSuggestion->save();
    }

    public static function hasUserSuggested(int $userId): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT 1 FROM theme_suggestions WHERE user_id = :uid LIMIT 1"
        );
        $stmt->execute(['uid' => $userId]);
        return (bool)$stmt->fetch();
    }

    public static function all(): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT ts.*, u.username
             FROM theme_suggestions ts
             JOIN users u ON u.id = ts.user_id
             ORDER BY ts.created_at DESC"
        );
        return $stmt->fetchAll();
    }
}