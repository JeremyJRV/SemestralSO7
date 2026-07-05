<?php
// migrate_signatures.php
// Ejecutar desde CLI para agregar firmas a registros existentes
// php migrate_signatures.php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/clases/Database.php';
require_once __DIR__ . '/clases/DigitalSignature.php';
require_once __DIR__ . '/clases/Model.php';
require_once __DIR__ . '/app/models/Prize.php';
require_once __DIR__ . '/app/models/Question.php';

use App\Models\Prize;
use App\Models\Question;
use clases\DigitalSignature;

echo "=== Migrando firmas para premios y preguntas ===\n";

// Firmar todos los premios existentes
$prizes = Prize::all();
$countPrizes = 0;
foreach ($prizes as $prize) {
    if (empty($prize->signature)) {
        $data = $prize->toArray();
        unset($data['signature']);
        $signature = DigitalSignature::sign($data);
        $db = \clases\Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE prizes SET signature = :sig WHERE id = :id");
        $stmt->execute(['sig' => $signature, 'id' => $prize->id]);
        $countPrizes++;
        echo "  Premio ID {$prize->id} firmado\n";
    }
}
echo "Premios actualizados: $countPrizes\n\n";

// Firmar todas las preguntas existentes
$questions = Question::all();
$countQuestions = 0;
foreach ($questions as $question) {
    if (empty($question->signature)) {
        $data = $question->toArray();
        unset($data['signature']);
        $signature = DigitalSignature::sign($data);
        $db = \clases\Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE questions SET signature = :sig WHERE id = :id");
        $stmt->execute(['sig' => $signature, 'id' => $question->id]);
        $countQuestions++;
        echo "  Pregunta ID {$question->id} firmada\n";
    }
}
echo "Preguntas actualizadas: $countQuestions\n\n";

echo "=== Migración completada ===\n";