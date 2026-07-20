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
    public function getAvailableLevelsForUser(int $userId): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT tl.id, tl.theme_id, t.name as theme_name, l.name as level_name, l.order_index
             FROM theme_levels tl
             JOIN themes t ON tl.theme_id = t.id
             JOIN levels l ON tl.level_id = l.id
             ORDER BY t.id, l.order_index"
        );
        $allLevels = $stmt->fetchAll();

        $available = [];
        foreach ($allLevels as $tl) {
            $themeId = $tl['theme_id'];
            $currentOrder = $tl['order_index'];
            if ($currentOrder == 1) {
                $available[] = $tl;
                continue;
            }
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

    public function createSession(int $userId, int $themeLevelId): GameSession
    {
        if (!UserLevelProgress::isLevelUnlocked($userId, $themeLevelId)) {
            throw new \App\Exceptions\UnauthorizedException(
                'Debes completar el nivel anterior de este tema antes de acceder a este.'
            );
        }

        $session = new GameSession([
            'room_code' => substr(md5(uniqid()), 0, 6),
            'theme_level_id' => $themeLevelId,
            'host_user_id' => $userId
        ]);
        $session->save();
        return $session;
    }

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
            $q->options = Option::where('question_id', $q->id);
            $questions[] = $q;
        }
        return $questions;
    }

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
                $option = Option::find($response);
                if ($option) {
                    $isCorrect = (bool)$option->is_correct;
                    $optionId = $option->id;
                }
            } else {
                $booleanAnswer = (int)$response;
                $correctOption = $db->prepare(
                    "SELECT id, is_correct FROM options WHERE question_id = :qid AND text = :text"
                );
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

        $session = GameSession::find($sessionId);
        $themeLevelId = $session->theme_level_id;

        // Antes nunca se marcaba cuándo terminó la partida, así que
        // "Duración Promedio de Partida" en el Excel siempre salía en 0
        // (la consulta filtra finished_at IS NOT NULL, y esa columna
        // nunca se llenaba). Se marca aquí, justo cuando se procesan
        // las respuestas finales de la sesión.
        if (!$session->finished_at) {
            $db->prepare("UPDATE game_sessions SET finished_at = NOW() WHERE id = :id")
                ->execute(['id' => $sessionId]);
        }

        // Se conserva el MEJOR puntaje histórico (score_percentage) para
        // no volver a bloquear un nivel ya desbloqueado si el usuario
        // repite el tema-nivel y saca menos.
        //
        // Además de ese porcentaje (que sirve para desbloquear niveles y
        // para la insignia de "completado"), ahora se acumulan los PUNTOS
        // ganados en cada intento de este tema-nivel específico (columna
        // `points`). El ranking por tema-nivel usa estos puntos
        // acumulados en vez del porcentaje, así jugar más veces siempre
        // suma y la competencia queda abierta para todos.
        $existing = $db->prepare(
            "SELECT score_percentage, completed FROM user_level_progress
             WHERE user_id = :uid AND theme_level_id = :tlid"
        );
        $existing->execute(['uid' => $userId, 'tlid' => $themeLevelId]);
        $previous = $existing->fetch();

        $bestPercentage = $previous ? max((float)$previous['score_percentage'], $percentage) : $percentage;
        $everCompleted = ($previous && (int)$previous['completed'] === 1) || $percentage >= 80;

        $pointsEarned = $correctCount * 10;

        $db->prepare(
            "INSERT INTO user_level_progress (user_id, theme_level_id, score_percentage, completed, points)
             VALUES (:uid, :tlid, :score, :comp, :pts)
             ON DUPLICATE KEY UPDATE
                score_percentage = :score2,
                completed = :comp2,
                points = points + :pts2"
        )->execute([
            'uid' => $userId,
            'tlid' => $themeLevelId,
            'score' => $bestPercentage,
            'comp' => $everCompleted ? 1 : 0,
            'pts' => $pointsEarned,
            'score2' => $bestPercentage,
            'comp2' => $everCompleted ? 1 : 0,
            'pts2' => $pointsEarned
        ]);

        $prizesAwarded = [];
        if ($percentage >= 80) {
            $prizesAwarded = $this->awardPrizes($userId, $themeLevelId);
        }

        $user = User::find($userId);
        if ($user) {
            $user->addPoints($pointsEarned);
        }

        return [
            'correct' => $correctCount,
            'total' => $totalQuestions,
            'percentage' => $percentage,
            'avg_time_ms' => $avgTime,
            'points_earned' => $pointsEarned,
            'prizes_awarded' => $prizesAwarded
        ];
    }

    /**
     * Otorga los premios configurados para el tema-nivel EXACTO recién
     * completado (ej. "PHP - Básico", no cualquier "Básico"). Devuelve
     * la lista de premios otorgados EN ESTE MOMENTO, para mostrarlos en
     * la pantalla de resultados justo después de terminar la partida.
     *
     * @return Prize[] premios nuevos otorgados en esta llamada
     */
    private function awardPrizes(int $userId, int $themeLevelId): array
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT prize_id FROM prize_levels WHERE theme_level_id = :tlid");
        $stmt->execute(['tlid' => $themeLevelId]);
        $prizeIds = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        $newlyAwarded = [];

        foreach ($prizeIds as $prizeId) {
            $exists = $db->prepare("SELECT 1 FROM user_prizes WHERE user_id = :uid AND prize_id = :pid");
            $exists->execute(['uid' => $userId, 'pid' => $prizeId]);
            if (!$exists->fetch()) {
                $db->prepare("INSERT INTO user_prizes (user_id, prize_id) VALUES (:uid, :pid)")
                    ->execute(['uid' => $userId, 'pid' => $prizeId]);

                $prize = Prize::find($prizeId);
                if ($prize) {
                    $user = User::find($userId);
                    $user->addPoints($prize->points_value);
                    $newlyAwarded[] = $prize;
                }
            }
        }

        return $newlyAwarded;
    }
}