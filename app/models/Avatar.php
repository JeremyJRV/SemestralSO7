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
 * "Desactivar" (activo = 0) nunca borra el registro: es la acción para
 * dejar de usar un avatar sin perderlo del historial.
 *
 * "Eliminar" (deleteWithFile) SÍ borra el registro y el archivo físico,
 * pero solo está permitido sobre avatares inactivos: el jugador puede
 * arrepentirse de haber subido una imagen y quitarla del todo, siempre
 * que no sea la que está en uso en ese momento.
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
            return false;
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

    /**
     * Borra un avatar de forma definitiva: la fila de la base de datos
     * Y el archivo físico en disco. Solo se permite si el avatar NO
     * está activo (no se puede borrar el que está en uso).
     */
    public static function deleteWithFile(int $avatarId, int $userId): bool
    {
        $avatar = self::find($avatarId);
        if (!$avatar || (int)$avatar->user_id !== $userId) {
            return false;
        }

        if ((bool)$avatar->activo) {
            return false;
        }

        $path = __DIR__ . '/../../public/uploads/avatars/' . $avatar->image;
        if (is_file($path)) {
            @unlink($path);
        }

        $avatar->delete();
        return true;
    }
}