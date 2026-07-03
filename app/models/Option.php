<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class Option extends Model
{
    protected static string $table = 'options';

    // Eliminar todas las opciones de una pregunta
    public static function deleteByQuestion(int $questionId): void
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM options WHERE question_id = :qid");
        $stmt->execute(['qid' => $questionId]);
    }

    // Helper: obtener opciones por ID de pregunta
    public static function where(string $field, $value): array
    {
        $allowedFields = ['id', 'question_id', 'is_correct'];
        if (!in_array($field, $allowedFields)) {
        throw new \InvalidArgumentException("Columna no permitida para ordenamiento o búsqueda.");
        }


        $db = Database::getInstance()->getConnection();
        $table = static::$table;
        $stmt = $db->prepare("SELECT * FROM $table WHERE $field = :val");
        $stmt->execute(['val' => $value]);
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new static($row), $rows);
    }
}