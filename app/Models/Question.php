<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class Question extends Model
{
    protected static string $table = 'questions';

    // Preguntas por tema-nivel
    public static function byThemeLevel(int $themeLevelId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM questions WHERE theme_level_id = :tlid");
        $stmt->execute(['tlid' => $themeLevelId]);
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new self($row), $rows);
    }

    // Obtener opciones de la pregunta
    public function options(): array
    {
        return Option::where('question_id', $this->id);
    }
}