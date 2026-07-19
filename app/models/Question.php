<?php
namespace App\Models;

use clases\Model;
use clases\Database;
use clases\DigitalSignature;

class Question extends Model
{
    protected static string $table = 'questions';

    public static function all(): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT q.*, t.name AS theme_name, l.name AS level_name
             FROM questions q
             JOIN theme_levels tl ON tl.id = q.theme_level_id
             JOIN themes t ON t.id = tl.theme_id
             JOIN levels l ON l.id = tl.level_id
             ORDER BY q.id DESC"
        );
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new static($row), $rows);
    }

    public static function byThemeLevel(int $themeLevelId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT q.*, t.name AS theme_name, l.name AS level_name
             FROM questions q
             JOIN theme_levels tl ON tl.id = q.theme_level_id
             JOIN themes t ON t.id = tl.theme_id
             JOIN levels l ON l.id = tl.level_id
             WHERE q.theme_level_id = :tlid
             ORDER BY q.id DESC"
        );
        $stmt->execute(['tlid' => $themeLevelId]);
        $rows = $stmt->fetchAll();
        return array_map(fn($row) => new static($row), $rows);
    }

    public function options(): array
    {
        return Option::where('question_id', $this->id);
    }

    /**
     * Guarda la pregunta con firma digital.
     *
     * Firma calculada SIEMPRE sobre la fila fresca traída de la base
     * (no sobre $this->attributes en memoria), porque columnas como
     * created_at se rellenan del lado de MySQL (DEFAULT CURRENT_TIMESTAMP)
     * y no existen todavía en el objeto PHP justo después de crear. Si
     * se firmara con el objeto en memoria, la firma no incluiría
     * created_at, pero verifyIntegrity() sí lo trae al hacer find(),
     * y la verificación fallaría siempre la primera vez.
     */
    public function saveWithSignature(): bool
    {
        unset($this->attributes['signature']);

        $result = $this->save();

        if ($result && isset($this->attributes['id'])) {
            $fresh = self::find($this->attributes['id']);
            $data = $fresh->attributes;
            unset($data['signature']);

            $signature = DigitalSignature::sign($data);
            $this->attributes['signature'] = $signature;

            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("UPDATE questions SET signature = :sig WHERE id = :id");
            $stmt->execute(['sig' => $signature, 'id' => $this->attributes['id']]);
        }

        return $result;
    }

    public function verifyIntegrity(): bool
    {
        if (!isset($this->attributes['signature']) || empty($this->attributes['signature'])) {
            return true;
        }
        $data = $this->attributes;
        $signature = $data['signature'];
        unset($data['signature']);
        return DigitalSignature::verify($data, $signature);
    }

    public static function findWithVerification(int $id): ?self
    {
        $question = self::find($id);
        if ($question && !$question->verifyIntegrity()) {
            return null;
        }
        return $question;
    }
}