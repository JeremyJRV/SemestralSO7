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
        $sql = "SELECT * FROM game_responses WHERE " . implode(' AND ', $where);
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new self($row), $rows);
    }
}