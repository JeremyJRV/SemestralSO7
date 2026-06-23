<?php
namespace App\Services;

use clases\Database;
use App\Models\GameSession;
use App\Models\GameResponse;
use App\Models\Question;
use App\Models\Option;
use App\Models\User;
use App\Models\UserLevelProgress;
use App\Models\UserPrize;
use App\Models\ThemeLevel;
use App\Models\Prize;

class GameService
{
    // Obtener niveles disponibles para un usuario (progresión)
    public function getAvailableLevelsForUser(int $userId): array
    {
        // Lógica: devolver todos los theme_levels cuyo level anterior esté completado.
        // Simplificación: mostrar todos, en el controlador se puede filtrar.
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT tl.id, t.name as theme_name, l.name as level_name, l.order_index
             FROM theme_levels tl
             JOIN themes t ON tl.theme_id = t.id
             JOIN levels l ON tl.level_id = l.id
             ORDER BY t.id, l.order_index"
        );
        $allLevels = $stmt->fetchAll();

        // Filtrar según progreso: se debe haber completado el nivel anterior (mismo tema, order_index - 1)
        $available = [];
        foreach ($allLevels as $tl) {
            $themeId = $tl['theme_id'] ?? null;
            $currentOrder = $tl['order_index'];
            if ($currentOrder == 1) {
                // Básico siempre disponible
                $available[] = $tl;
                continue;
            }
            // Buscar nivel anterior dentro del mismo tema
            $prevOrder = $currentOrder - 1;
            $prev = $db->prepare(
                "SELECT ulp.completed
                 FROM user_level_progress ulp
                 JOIN theme_levels tl2 ON ulp.theme_level_id = tl2.id
                 WHERE ulp.user_id = :uid AND tl2.theme_id = :tid AND tl2.level_id = (SELECT id FROM levels WHERE order_index = :ord)"
            );
            $prev->execute(['uid' => $userId, 'tid' => $themeId, 'ord' => $prevOrder]);
            $prevCompleted = $prev->fetchColumn();
            if ($prevCompleted) {
                $available[] = $tl;
            }
        }
        return $available;
    }

    // Crear una sesión de juego
    public function createSession(int $userId, int $themeLevelId): GameSession
    {
        $session = new GameSession([
            'room_code' => null, // no necesario en single player
            'theme_level_id' => $themeLevelId,
            'host_user_id' => $userId
        ]);
        $session->save();
        return $session;
    }

    // Obtener preguntas para una sesión (por ejemplo, 5 aleatorias)
    public function getQuestionsForSession(int $themeLevelId, int $limit = 5): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT q.* FROM questions q
             WHERE q.theme_level_id = :tlid
             ORDER BY RAND()
             LIMIT :limit"
        );
        $stmt->bindValue(':tlid', $themeLevelId, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $questions = [];
        foreach ($rows as $row) {
            $q = new Question($row);
            // Adjuntar opciones
            $q->options = Option::where('question_id', $q->id);
            $questions[] = $q;
        }
        return $questions;
    }

    // Procesar respuestas y calcular resultados
    public function processAnswers(int $sessionId, int $userId, array $answers, array $responseTimes): array
    {
        $db = Database::getInstance()->getConnection();
        $correctCount = 0;
        $totalQuestions = count($answers);
        $totalTime = 0;

        foreach ($answers as $questionId => $response) {
            $question = Question::find($questionId);
            if (!$question) continue;

            $isCorrect = false;
            $optionId = null;
            $booleanAnswer = null;

            if ($question->type === 'multiple') {
                // $response es el option_id seleccionado
                $option = Option::find($response);
                if ($option) {
                    $isCorrect = (bool)$option->is_correct;
                    $optionId = $option->id;
                }
            } else { // boolean
                // $response es '1' o '0'
                $booleanAnswer = (int)$response;
                // Buscar opción correcta
                $correctOption = $db->prepare(
                    "SELECT id, is_correct FROM options WHERE question_id = :qid AND text = :text"
                );
                // Para boolean, las opciones se guardan como "Verdadero" o "Falso"
                $correctOption->execute(['qid' => $questionId, 'text' => $booleanAnswer ? 'Verdadero' : 'Falso']);
                $opt = $correctOption->fetch();
                if ($opt) {
                    $isCorrect = (bool)$opt['is_correct'];
                    $optionId = $opt['id'];
                }
            }

            $time = $responseTimes[$questionId] ?? 0;
            $totalTime += $time;

            $gameResponse = new GameResponse([
                'session_id' => $sessionId,
                'user_id' => $userId,
                'question_id' => $questionId,
                'selected_option_id' => $optionId,
                'boolean_answer' => $question->type === 'boolean' ? $booleanAnswer : null,
                'is_correct' => $isCorrect ? 1 : 0,
                'response_time_ms' => $time
            ]);
            $gameResponse->save();

            if ($isCorrect) $correctCount++;
        }

        $percentage = $totalQuestions > 0 ? ($correctCount / $totalQuestions) * 100 : 0;
        $avgTime = $totalQuestions > 0 ? $totalTime / $totalQuestions : 0;

        // Obtener el theme_level_id de la sesión
        $session = GameSession::find($sessionId);
        $themeLevelId = $session->theme_level_id;

        // Guardar progreso
        $progress = new UserLevelProgress([
            'user_id' => $userId,
            'theme_level_id' => $themeLevelId,
            'score_percentage' => $percentage,
            'completed' => $percentage >= 80 ? 1 : 0
        ]);
        // Si ya existía, reemplazar (INSERT ON DUPLICATE KEY UPDATE)
        $db->prepare(
            "INSERT INTO user_level_progress (user_id, theme_level_id, score_percentage, completed)
             VALUES (:uid, :tlid, :score, :comp)
             ON DUPLICATE KEY UPDATE score_percentage = :score2, completed = :comp2"
        )->execute([
            'uid' => $userId,
            'tlid' => $themeLevelId,
            'score' => $percentage,
            'comp' => $percentage >= 80 ? 1 : 0,
            'score2' => $percentage,
            'comp2' => $percentage >= 80 ? 1 : 0
        ]);

        // Otorgar premios si completó el nivel (>=80%) y aún no los tiene
        if ($percentage >= 80) {
            $this->awardPrizes($userId, $themeLevelId);
        }

        // Actualizar puntos totales del usuario
        $user = User::find($userId);
        if ($user) {
            $pointsEarned = $correctCount * 10; // Ejemplo: 10 puntos por respuesta correcta
            $user->addPoints($pointsEarned);
        }

        return [
            'correct' => $correctCount,
            'total' => $totalQuestions,
            'percentage' => $percentage,
            'avg_time_ms' => $avgTime,
            'points_earned' => $pointsEarned ?? 0
        ];
    }

    private function awardPrizes(int $userId, int $themeLevelId): void
    {
        $db = Database::getInstance()->getConnection();
        // Obtener level_id desde theme_level
        $stmt = $db->prepare("SELECT level_id FROM theme_levels WHERE id = :tlid");
        $stmt->execute(['tlid' => $themeLevelId]);
        $levelId = $stmt->fetchColumn();

        if (!$levelId) return;

        // Obtener premios asociados al nivel
        $stmt = $db->prepare("SELECT prize_id FROM prize_levels WHERE level_id = :lid");
        $stmt->execute(['lid' => $levelId]);
        $prizeIds = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        foreach ($prizeIds as $prizeId) {
            // Verificar si ya tiene el premio
            $exists = $db->prepare("SELECT 1 FROM user_prizes WHERE user_id = :uid AND prize_id = :pid");
            $exists->execute(['uid' => $userId, 'pid' => $prizeId]);
            if (!$exists->fetch()) {
                $db->prepare("INSERT INTO user_prizes (user_id, prize_id) VALUES (:uid, :pid)")
                   ->execute(['uid' => $userId, 'pid' => $prizeId]);

                // Sumar puntos del premio
                $prize = Prize::find($prizeId);
                if ($prize) {
                    $user = User::find($userId);
                    $user->addPoints($prize->points_value);
                }
            }
        }
    }
}