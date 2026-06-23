<?php
// guardar como create_test_users.php y ejecutar desde navegador o CLI
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/clases/Database.php';
use Clases\Database;

$db = Database::getInstance()->getConnection();

$users = [
    ['admin@trivias.com', 'admin', 'Secret123!', 'admin'],
    ['armador@trivias.com', 'armador', 'Secret123!', 'armador'],
    ['jugador@trivias.com', 'jugador', 'Secret123!', 'player']
];

$stmt = $db->prepare("INSERT INTO users (email, username, password, role) VALUES (?, ?, ?, ?)");
foreach ($users as $u) {
    $hash = password_hash($u[2], PASSWORD_DEFAULT);
    $stmt->execute([$u[0], $u[1], $hash, $u[3]]);
}
echo "Usuarios creados.";