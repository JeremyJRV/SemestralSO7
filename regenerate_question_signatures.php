<?php
// regenerate_question_signatures.php
// Ejecutar desde CLI o navegador, UNA SOLA VEZ, después de aplicar el fix
// en Question::saveWithSignature().
//
// A diferencia de migrate_signatures.php (que solo firma preguntas SIN
// firma), este script REGENERA la firma de TODAS las preguntas, sin
// importar si ya tenían una firma (la vieja firma es incorrecta porque
// no incluía el id, así que hay que sobrescribirla siempre).
//
// Uso: php regenerate_question_signatures.php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/clases/Database.php';
require_once __DIR__ . '/clases/DigitalSignature.php';

use clases\DigitalSignature;
use clases\Database;

echo "=== Regenerando firmas para TODAS las preguntas ===\n";

$db = Database::getInstance()->getConnection();

// Traemos la fila completa, tal como la trae Question::find() /
// verifyIntegrity(), para que la firma se calcule exactamente sobre
// los mismos datos que se van a verificar después.
$stmt = $db->query("SELECT * FROM questions");
$rows = $stmt->fetchAll();

$count = 0;
foreach ($rows as $row) {
    $data = $row;
    unset($data['signature']); // nunca se firma la propia firma

    $signature = DigitalSignature::sign($data);

    $update = $db->prepare("UPDATE questions SET signature = :sig WHERE id = :id");
    $update->execute(['sig' => $signature, 'id' => $row['id']]);

    $count++;
    $preview = mb_strimwidth($row['text'], 0, 50, '...');
    echo "  ✅ Pregunta ID {$row['id']} ('{$preview}') firmada correctamente\n";
}

echo "\n📦 Preguntas actualizadas: $count\n";
echo "=== ✅ Regeneración completada ===\n";
echo "\nAhora puedes editar cualquier pregunta desde el panel de admin sin problema.\n";
