<?php
// regenerate_signatures.php
// Ejecutar desde CLI para regenerar TODAS las firmas

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/clases/Database.php';
require_once __DIR__ . '/clases/DigitalSignature.php';
require_once __DIR__ . '/clases/Model.php';
require_once __DIR__ . '/app/models/Prize.php';

use App\Models\Prize;
use clases\DigitalSignature;
use clases\Database;

echo "=== Regenerando firmas para TODOS los premios ===\n";

$db = Database::getInstance()->getConnection();
$stmt = $db->query("SELECT id, name, image, points_value FROM prizes");
$rows = $stmt->fetchAll();

$count = 0;
foreach ($rows as $row) {
    $data = $row;
    $signature = DigitalSignature::sign($data);
    $update = $db->prepare("UPDATE prizes SET signature = :sig WHERE id = :id");
    $update->execute(['sig' => $signature, 'id' => $row['id']]);
    $count++;
    echo "  ✅ Premio ID {$row['id']} ('{$row['name']}') firmado\n";
}

echo "\n📦 Premios actualizados: $count\n";
echo "=== ✅ Regeneración completada ===\n";