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
        $data = $this->attributes;
        unset($data['signature']);
        $signed = DigitalSignature::signData($data);
        $this->attributes = $signed;
        return $this->save();
    }

    public function verifyIntegrity(): bool
    {
        if (empty($this->attributes['signature'])) {
            return false;
        }
        $data = $this->attributes;
        $signature = $data['signature'];
        unset($data['signature']);
        return DigitalSignature::verify($data, $signature);
    }

    // Este método ahora permite editar incluso si la firma es inválida
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
            // Si la firma es inválida, marcamos el error pero retornamos el objeto igual
            $prize->_corrupted = true;
            return $prize;
        }
        return $prize;
    }
}