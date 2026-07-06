<?php
namespace App\Models;

use clases\Model;
use clases\Database;
use clases\DigitalSignature;

class Question extends Model
{
    protected static string $table = 'questions';

    // Todas las preguntas, con el nombre del tema y del nivel al que pertenecen
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

    // Preguntas por tema-nivel (con JOIN para traer los nombres)
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

    // Obtener opciones de la pregunta
    public function options(): array
    {
        return Option::where('question_id', $this->id);
    }

    /**
     * Guarda la pregunta con firma digital.
     *
     * BUG CORREGIDO: antes se calculaba la firma ANTES de guardar, cuando
     * una pregunta nueva todavía no tenía 'id'. save() recién le asignaba
     * el id DESPUÉS de firmar, así que la firma guardada nunca incluía el
     * id. Al verificar más adelante (verifyIntegrity), se recalculaba la
     * firma con TODAS las columnas de la fila -incluyendo el id- y nunca
     * coincidía, por lo que toda pregunta se consideraba "corrupta" y el
     * CRUD de edición no cargaba nada.
     *
     * Ahora seguimos el mismo patrón que Prize::saveWithSignature():
     * 1) guardamos primero (para tener el id si es una pregunta nueva),
     * 2) firmamos ya con el id incluido,
     * 3) actualizamos solo la columna signature.
     */
    public function saveWithSignature(): bool
    {
        // Quitar cualquier firma anterior para no incluirla en el guardado normal
        unset($this->attributes['signature']);

        // 1) Guardar primero, para asegurar que tenemos el id
        $result = $this->save();

        if ($result && isset($this->attributes['id'])) {
            // 2) Ahora que tenemos el id, firmamos con TODOS los campos
            //    relevantes (incluido el id) para que coincida siempre
            //    con lo que se recalculará al verificar.
            $data = $this->attributes;
            unset($data['signature']);

            $signature = DigitalSignature::sign($data);
            $this->attributes['signature'] = $signature;

            // 3) Guardar solo la firma
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("UPDATE questions SET signature = :sig WHERE id = :id");
            $stmt->execute(['sig' => $signature, 'id' => $this->attributes['id']]);
        }

        return $result;
    }

    /**
     * Verifica la integridad de la pregunta mediante su firma
     */
    public function verifyIntegrity(): bool
    {
        if (!isset($this->attributes['signature']) || empty($this->attributes['signature'])) {
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