<?php
namespace App\Models;

use clases\Model;
use clases\Database;

/**
 * CRUD de avatares (rúbrica punto 7). Un usuario puede tener varias
 * imágenes guardadas; solo UNA puede estar 'activo' a la vez, y esa es
 * la que se sincroniza en users.avatar para usarse en todo el sistema
 * (navbar, ranking, dashboard, etc.) sin tener que tocar esas vistas.
 *
 * IMPORTANTE: nunca se hace DELETE físico sobre un avatar. "Eliminar"
 * un avatar = ponerle activo = 0 (deactivate()). Esto es un requisito
 * explícito de la rúbrica: "sin borrarla de la base de datos".
 */
class Avatar extends Model
{
    protected static string $table = 'avatars';

    public static function byUser(int $userId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM avatars WHERE user_id = :uid ORDER BY created_at DESC");
        $stmt->execute(['uid' => $userId]);
        return array_map(fn($row) => new static($row), $stmt->fetchAll());
    }

    public static function activeForUser(int $userId): ?self
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT * FROM avatars WHERE user_id = :uid AND activo = 1
             ORDER BY updated_at DESC LIMIT 1"
        );
        $stmt->execute(['uid' => $userId]);
        $row = $stmt->fetch();
        return $row ? new static($row) : null;
    }

    /**
     * Marca $avatarId como el avatar activo del usuario (y desactiva
     * cualquier otro que tuviera activo), y sincroniza users.avatar.
     */
    public static function activate(int $avatarId, int $userId): bool
    {
        $avatar = self::find($avatarId);
        if (!$avatar || (int)$avatar->user_id !== $userId) {
            return false; // no existe o no le pertenece a este usuario
        }

        $db = Database::getInstance()->getConnection();
        $db->beginTransaction();
        try {
            $db->prepare("UPDATE avatars SET activo = 0 WHERE user_id = :uid")
               ->execute(['uid' => $userId]);
            $db->prepare("UPDATE avatars SET activo = 1 WHERE id = :id")
               ->execute(['id' => $avatarId]);
            $db->prepare("UPDATE users SET avatar = :img WHERE id = :uid")
               ->execute(['img' => $avatar->image, 'uid' => $userId]);
            $db->commit();
            return true;
        } catch (\Exception $e) {
            $db->rollBack();
            error_log('Error activando avatar: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * "Elimina" un avatar SIN borrarlo de la base de datos: solo pone
     * activo = 0. Si era el avatar activo, users.avatar se limpia (o
     * pasa a otro avatar activo si por alguna razón hubiera uno).
     */
    public static function deactivate(int $avatarId, int $userId): bool
    {
        $avatar = self::find($avatarId);
        if (!$avatar || (int)$avatar->user_id !== $userId) {
            return false;
        }

        $db = Database::getInstance()->getConnection();
        $db->prepare("UPDATE avatars SET activo = 0 WHERE id = :id")
           ->execute(['id' => $avatarId]);

        $user = User::find($userId);
        if ($user && $user->avatar === $avatar->image) {
            $next = self::activeForUser($userId);
            $db->prepare("UPDATE users SET avatar = :img WHERE id = :uid")
               ->execute(['img' => $next->image ?? null, 'uid' => $userId]);
        }
        return true;
    }
}