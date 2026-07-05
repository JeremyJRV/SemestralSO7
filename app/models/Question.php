<?php
namespace App\Models;

use clases\Model;
use clases\Database;
use clases\DigitalSignature;

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
        return array_map(fn($row) => new static($row), $rows);
    }

    // Obtener opciones de la pregunta
    public function options(): array
    {
        return Option::where('question_id', $this->id);
    }

    /**
     * Guarda la pregunta con firma digital
     */
    public function saveWithSignature(): bool
    {
        $data = $this->attributes;
        // Quitar firma anterior si existe para recalcular
        unset($data['signature']);
        // Firmar datos
        $signed = DigitalSignature::signData($data);
        $this->attributes = $signed;
        return $this->save();
    }

    /**
     * Verifica la integridad de la pregunta mediante su firma
     */
    public function verifyIntegrity(): bool
    {
        if (!isset($this->attributes['signature'])) {
            return true; // Si no tiene firma, consideramos que es válido
        }
        $data = $this->attributes;
        $signature = $data['signature'];
        unset($data['signature']);
        return DigitalSignature::verify($data, $signature);
    }

    /**
     * Obtiene una pregunta y verifica su integridad
     */
    public static function findWithVerification(int $id): ?self
    {
        $question = self::find($id);
        if ($question && !$question->verifyIntegrity()) {
            return null; // Firma inválida
        }
        return $question;
    }
}