<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/clases/Database.php';
require_once __DIR__ . '/clases/DigitalSignature.php';
require_once __DIR__ . '/clases/Model.php';
require_once __DIR__ . '/app/models/Prize.php';
require_once __DIR__ . '/app/models/Question.php';

use App\Models\Prize;
use App\Models\Question;
use clases\DigitalSignature;
use clases\Database;

echo "=== Regenerando firmas de TODOS los premios y preguntas ===\n\n";

$db = Database::getInstance()->getConnection();

$prizeIds = $db->query("SELECT id FROM prizes")->fetchAll(\PDO::FETCH_COLUMN);
$countPrizes = 0;
foreach ($prizeIds as $id) {
    $prize = Prize::find($id);
    if (!$prize) continue;
    $data = $prize->toArray();
    unset($data['signature']);
    $signature = DigitalSignature::sign($data);
    $stmt = $db->prepare("UPDATE prizes SET signature = :sig WHERE id = :id");
    $stmt->execute(['sig' => $signature, 'id' => $id]);
    $countPrizes++;
    echo "  Premio ID $id refirmado\n";
}
echo "Premios actualizados: $countPrizes\n\n";

$questionIds = $db->query("SELECT id FROM questions")->fetchAll(\PDO::FETCH_COLUMN);
$countQuestions = 0;
foreach ($questionIds as $id) {
    $question = Question::find($id);
    if (!$question) continue;
    $data = $question->toArray();
    unset($data['signature']);
    $signature = DigitalSignature::sign($data);
    $stmt = $db->prepare("UPDATE questions SET signature = :sig WHERE id = :id");
    $stmt->execute(['sig' => $signature, 'id' => $id]);
    $countQuestions++;
    echo "  Pregunta ID $id refirmada\n";
}
echo "Preguntas actualizadas: $countQuestions\n\n";

echo "=== Listo ===\n";
