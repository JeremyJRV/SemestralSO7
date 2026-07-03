<?php
namespace App\Models;

use clases\Model;
use clases\Database;

class Prize extends Model
{
    protected static string $table = 'prizes';

    // Sincronizar niveles (para guardar relaciones muchos a muchos)
    public function syncLevels(array $levelIds): void
    {
        $db = Database::getInstance()->getConnection();
        // Borrar existentes
        $stmt = $db->prepare("DELETE FROM prize_levels WHERE prize_id = :pid");
        $stmt->execute(['pid' => $this->id]);
        // Insertar nuevos
        $stmt = $db->prepare("INSERT INTO prize_levels (prize_id, level_id) VALUES (:pid, :lid)");
        foreach ($levelIds as $lid) {
            $stmt->execute(['pid' => $this->id, 'lid' => $lid]);
        }
    }
}