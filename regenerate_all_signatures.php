<?php
// regenerate_all_signatures.php
// Ejecutar desde CLI

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/clases/Database.php';
require_once __DIR__ . '/clases/DigitalSignature.php';

use clases\DigitalSignature;
use clases\Database;

echo "=== Regenerando TODAS las firmas ===\n";

$db = Database::getInstance()->getConnection();

// Obtener TODOS los premios
$stmt = $db->query("SELECT id, name, image, points_value FROM prizes");
$rows = $stmt->fetchAll();

$count = 0;
foreach ($rows as $row) {
    // Datos a firmar (SOLO los campos que definen la integridad)
    $data = [
        'id' => $row['id'],
        'name' => $row['name'],
        'image' => $row['image'],
        'points_value' => $row['points_value']
    ];
    
    $signature = DigitalSignature::sign($data);
    $update = $db->prepare("UPDATE prizes SET signature = :sig WHERE id = :id");
    $update->execute(['sig' => $signature, 'id' => $row['id']]);
    $count++;
    echo "  ✅ Premio ID {$row['id']} ('{$row['name']}') → puntos: {$row['points_value']}\n";
}

echo "\n📦 Premios actualizados: $count\n";
echo "=== ✅ Regeneración completada ===\n";