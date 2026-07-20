<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use clases\Database;
use App\Models\GameSession;
use App\Models\GameResponse;
use App\Models\AppRating;
use App\Services\GameService;

class GameController extends Controller
{
    private GameService $gameService;

    public function __construct()
    {
        $this->gameService = new GameService();
    }

    public function selectMode()
    {
        $userId = $this->requireAuth();

        $availableLevels = $this->gameService->getAvailableLevelsForUser($userId);
        $hasRatedApp = AppRating::hasUserRated($userId);
        $hasSuggested = \App\Models\ThemeSuggestion::hasUserSuggested($userId);
        // AGREGADO: para mostrar la insignia de "100% superado" en cada
        // tarjeta de tema-nivel que el usuario ya haya jugado.
        $myScores = \App\Models\UserLevelProgress::scoresForUser($userId);
        $csrfToken = Session::csrfToken();

        $this->render('game/select', [
            'levels' => $availableLevels,
            'hasRatedApp' => $hasRatedApp,
            'hasSuggested' => $hasSuggested,
            'myScores' => $myScores,
            'csrfToken' => $csrfToken,
            'activePage' => 'game'
        ]);
    }

    public function start($themeLevelId)
    {
        $userId = $this->requireAuth();

        try {
            $session = $this->gameService->createSession($userId, $themeLevelId);
        } catch (\App\Exceptions\UnauthorizedException $e) {
            $this->redirect('/game?error=' . urlencode($e->getMessage()));
            return;
        }
        $this->redirect("/game/play/{$session->id}");
    }

    public function play($sessionId)
    {
        $userId = $this->requireAuth();

        $session = GameSession::find($sessionId);
        if (!$session) {
            $this->redirect('/game');
        }
        $questions = $this->gameService->getQuestionsForSession($session->theme_level_id);
        $csrfToken = Session::csrfToken();
        $this->render('game/play', [
            'session' => $session,
            'questions' => $questions,
        ]);
    }

    public function submitAnswers($sessionId)
    {
        $userId = $this->requireAuth();

        $this->csrfCheck();

        $existing = GameResponse::whereMultiple([
            'session_id' => $sessionId,
            'user_id' => $userId
        ]);
        if (!empty($existing)) {
            $this->redirect("/game/results/{$sessionId}");
            return;
        }

        $answers = $_POST['answers'] ?? [];
        $responseTimes = $_POST['times'] ?? [];

        $result = $this->gameService->processAnswers($sessionId, $userId, $answers, $responseTimes);

        Session::set('last_prizes_awarded_' . $sessionId, $result['prizes_awarded'] ?? []);

        $this->redirect("/game/results/{$sessionId}");
    }


public function results($sessionId)
{
    $session = GameSession::find($sessionId);
    $responses = GameResponse::whereMultiple([
        'session_id' => $sessionId,
        'user_id' => Session::get('user_id')
    ]);

    // Obtener textos de opciones para cada respuesta
    $db = Database::getInstance()->getConnection();
    foreach ($responses as $r) {
        // Obtener el texto de la opcion que eligio el usuario
        if ($r->selected_option_id) {
            $stmt = $db->prepare("SELECT text FROM options WHERE id = :id");
            $stmt->execute(['id' => $r->selected_option_id]);
            $opt = $stmt->fetch();
            $r->user_answer_text = $opt ? $opt['text'] : null;
        } else if ($r->boolean_answer !== null) {
            $r->user_answer_text = $r->boolean_answer ? 'Verdadero' : 'Falso';
        } else {
            $r->user_answer_text = null;
        }

        // Obtener el texto de la opcion correcta
        $stmt = $db->prepare(
            "SELECT text FROM options WHERE question_id = :qid AND is_correct = 1"
        );
        $stmt->execute(['qid' => $r->question_id]);
        $opt = $stmt->fetch();
        $r->correct_answer_text = $opt ? $opt['text'] : null;
    }

    $total = count($responses);
    $correct = 0;
    $totalTime = 0;
    foreach ($responses as $r) {
        if ($r->is_correct) $correct++;
        $totalTime += (int)$r->response_time_ms;
    }
    $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
    $avgTime = $total > 0 ? $totalTime / $total : 0;
    $pointsEarned = $correct * 10;

    $result = [
        'correct' => $correct,
        'total' => $total,
        'percentage' => $percentage,
        'avg_time_ms' => $avgTime,
        'points_earned' => $pointsEarned
    ];

    $newPrizes = Session::get('last_prizes_awarded_' . $sessionId) ?? [];
    Session::remove('last_prizes_awarded_' . $sessionId);

    $this->render('game/results', [
        'session' => $session,
        'responses' => $responses,
        'result' => $result,
        'newPrizes' => $newPrizes
    ]);
}




    public function createRoom()
    {
        $this->requireRole(['armador','admin']);
        $userId = $this->requireAuth();
        $themeLevels = $this->gameService->getAvailableLevelsForUser($userId);
        $csrfToken = Session::csrfToken();
        $this->render('game/create_room', [
            'csrfToken' => $csrfToken,
            'themeLevels' => $themeLevels
        ]);
    }

    public function storeRoom()
    {
        $this->requireRole(['armador','admin']);
        $this->csrfCheck();
        $roomCode = substr(md5(uniqid()), 0, 6);
        $session = new GameSession([
            'room_code' => $roomCode,
            'theme_level_id' => $_POST['theme_level_id'],
            'host_user_id' => Session::get('user_id')
        ]);
        $session->save();
        $this->redirect("/game/room/{$roomCode}");
    }

    public function joinRoom($roomCode)
    {
        $userId = $this->requireAuth();

        $session = GameSession::findByRoomCode($roomCode);
        if (!$session) {
            $this->redirect('/game');
        }

        $this->render('game/room', [
            'roomCode' => $roomCode,
            'sessionId' => $session->id
        ]);
    }

    public function accessByQr($themeLevelId)
    {
        $themeLevel = \App\Models\ThemeLevel::findWithNames((int)$themeLevelId);
        if (!$themeLevel) {
            $this->redirect('/game?error=' . urlencode(
                'El código QR no es válido o el set de preguntas ya no existe.'
            ));
            return;
        }

        $userId = $this->requireAuth();

        $this->redirect('/game/start/' . (int)$themeLevelId);
    }
}