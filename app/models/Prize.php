<?php

namespace App\Models;

use clases\Model;
use clases\Database;
use clases\DigitalSignature;

class Prize extends Model
{
    protected static string $table = 'prizes';

    public function syncThemeLevels(array $themeLevelIds): void
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM prize_levels WHERE prize_id = :pid");
        $stmt->execute(['pid' => $this->id]);
        $stmt = $db->prepare("INSERT INTO prize_levels (prize_id, theme_level_id) VALUES (:pid, :tlid)");
        foreach ($themeLevelIds as $tlid) {
            $stmt->execute(['pid' => $this->id, 'tlid' => $tlid]);
        }
    }

    public function themeLevelIds(): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT theme_level_id FROM prize_levels WHERE prize_id = :pid");
        $stmt->execute(['pid' => $this->id]);
        return array_map('intval', $stmt->fetchAll(\PDO::FETCH_COLUMN));
    }

    /**
     * Firma calculada sobre la fila fresca traída de la base (find()),
     * no sobre $this->attributes en memoria, por la misma razón que en
     * Question::saveWithSignature() -- evita desincronización entre lo
     * que se firma al crear y lo que se verifica después.
     */
    public function saveWithSignature(): bool
    {
        $result = $this->save();

        if ($result && isset($this->attributes['id'])) {
            $fresh = self::find($this->attributes['id']);

            $data = [
                'id' => $fresh->attributes['id'],
                'name' => $fresh->attributes['name'],
                'description' => $fresh->attributes['description'] ?? '',
                'image' => $fresh->attributes['image'] ?? 'default.png',
                'points_value' => (int)($fresh->attributes['points_value'] ?? 0)
            ];

            $signature = DigitalSignature::sign($data);
            $this->attributes['signature'] = $signature;

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
            'description' => $this->attributes['description'] ?? '',
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