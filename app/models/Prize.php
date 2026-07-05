<?php

namespace App\Models;

use clases\Model;
use clases\Database;
use clases\DigitalSignature;

class Prize extends Model
{
    protected static string $table = 'prizes';

    public function syncLevels(array $levelIds): void
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM prize_levels WHERE prize_id = :pid");
        $stmt->execute(['pid' => $this->id]);
        $stmt = $db->prepare("INSERT INTO prize_levels (prize_id, level_id) VALUES (:pid, :lid)");
        foreach ($levelIds as $lid) {
            $stmt->execute(['pid' => $this->id, 'lid' => $lid]);
        }
    }

    public function saveWithSignature(): bool
    {
        // Guardar primero para obtener el ID
        $result = $this->save();

        if ($result && isset($this->attributes['id'])) {
            // Ahora que tenemos ID, generamos la firma con el ID incluido
            $data = [
                'id' => $this->attributes['id'],
                'name' => $this->attributes['name'],
                'image' => $this->attributes['image'] ?? 'default.png',
                'points_value' => (int)($this->attributes['points_value'] ?? 0)
            ];

            $signature = DigitalSignature::sign($data);
            $this->attributes['signature'] = $signature;

            // Actualizar solo la firma
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("UPDATE prizes SET signature = :sig WHERE id = :id");
            $stmt->execute(['sig' => $signature, 'id' => $this->attributes['id']]);
        }

        return $result;
    }

    public function verifyIntegrity(): bool
    {
        if (empty($this->attributes['signature']) || empty($this->attributes['id'])) {
            return false;
        }

        $data = [
            'id' => $this->attributes['id'],
            'name' => $this->attributes['name'],
            'image' => $this->attributes['image'] ?? 'default.png',
            'points_value' => (int)($this->attributes['points_value'] ?? 0)
        ];

        $signature = $this->attributes['signature'];
        return DigitalSignature::verify($data, $signature);
    }
    public static function findForEdit(int $id): ?self
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM prizes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        if ($row) {
            return new static($row);
        }
        return null;
    }

    public static function findWithVerification(int $id): ?self
    {
        $prize = self::find($id);
        if ($prize && !$prize->verifyIntegrity()) {
            $prize->_corrupted = true;
            return $prize;
        }
        return $prize;
    }
}
