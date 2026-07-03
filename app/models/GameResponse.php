<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class GameResponse extends Model
{
    protected static string $table = 'game_responses';

    // Método 'where' con varias condiciones (para simplificar)
    public static function whereMultiple(array $conditions): array
    {
        $db = Database::getInstance()->getConnection();
        $where = [];
        $params = [];
        foreach ($conditions as $field => $value) {
            $where[] = "$field = :$field";
            $params[$field] = $value;
        }
        //Sugerencia del asistente
        //$table = static::$table;
        //$stmt = $db->prepare("DELETE FROM `$table` WHERE question_id = :qid");
        $sql = "SELECT * FROM game_responses WHERE " . implode(' AND ', $where);
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new static($row), $rows);
    }
}