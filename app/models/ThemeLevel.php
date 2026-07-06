<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class ThemeLevel extends Model
{
    protected static string $table = 'theme_levels';

    /**
     * Trae todos los theme_levels con el nombre del tema y del nivel
     * (antes usaba el all() genérico de Model, que solo hacía SELECT *
     * y no traía theme_name/level_name, por eso las vistas mostraban
     * "Tema" / "Nivel" o no encontraban el tema).
     */
    public static function all(): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT tl.*, t.name AS theme_name, l.name AS level_name
             FROM theme_levels tl
             JOIN themes t ON t.id = tl.theme_id
             JOIN levels l ON l.id = tl.level_id
             ORDER BY t.name ASC, l.id ASC"
        );
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new static($row), $rows);
    }

    /**
     * Igual que find(), pero incluye theme_name y level_name.
     * Útil para precargar el select en el formulario de edición.
     */
    public static function findWithNames(int $id): ?self
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT tl.*, t.name AS theme_name, l.name AS level_name
             FROM theme_levels tl
             JOIN themes t ON t.id = tl.theme_id
             JOIN levels l ON l.id = tl.level_id
             WHERE tl.id = :id"
        );
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? new static($row) : null;
    }

    /**
     * Todos los theme_levels de un tema específico (por si lo necesitas
     * para filtrar el select por tema, ej. al alimentar la BD).
     */
    public static function byTheme(int $themeId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT tl.*, t.name AS theme_name, l.name AS level_name
             FROM theme_levels tl
             JOIN themes t ON t.id = tl.theme_id
             JOIN levels l ON l.id = tl.level_id
             WHERE tl.theme_id = :themeId
             ORDER BY l.id ASC"
        );
        $stmt->execute(['themeId' => $themeId]);
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new static($row), $rows);
    }
}