<?php
// fix_signature.php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/clases/Database.php';
require_once __DIR__ . '/clases/DigitalSignature.php';
require_once __DIR__ . '/clases/Model.php';
require_once __DIR__ . '/app/models/Prize.php';

use App\Models\Prize;
use clases\DigitalSignature;
use clases\Database;

echo "=== REGENERANDO FIRMA PARA PREMIO #24 ===\n";

$db = Database::getInstance()->getConnection();

// Obtener el premio
$stmt = $db->prepare("SELECT id, name, image, points_value FROM prizes WHERE id = 24");
$stmt->execute();
$row = $stmt->fetch();

if (!$row) {
    die("Premio #24 no encontrado.\n");
}

echo "Datos del premio:\n";
print_r($row);

// Generar nueva firma
$signature = DigitalSignature::sign($row);
echo "\nNueva firma generada: " . $signature . "\n";

// Actualizar
$update = $db->prepare("UPDATE prizes SET signature = :sig WHERE id = :id");
$update->execute(['sig' => $signature, 'id' => 24]);

echo "\n✅ Firma actualizada correctamente.\n";