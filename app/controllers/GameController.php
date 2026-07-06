<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\GameSession;
use App\Models\GameResponse;
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
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

        $availableLevels = $this->gameService->getAvailableLevelsForUser($userId);
        $this->render('game/select', ['levels' => $availableLevels]);
    }

    public function start($themeLevelId)
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login'); // BUG CORREGIDO: faltaba esta validación

        $session = $this->gameService->createSession($userId, $themeLevelId);
        $this->redirect("/game/play/{$session->id}");
    }

    public function play($sessionId)
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

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
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login'); // BUG CORREGIDO: faltaba esta validación

        $this->csrfCheck();

        // Evitar doble envío: si ya existen respuestas de este usuario para esta sesión, no procesar de nuevo
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

        $this->gameService->processAnswers($sessionId, $userId, $answers, $responseTimes);
        $this->redirect("/game/results/{$sessionId}");
    }

    public function results($sessionId)
    {
        $session = GameSession::find($sessionId);
        $responses = GameResponse::whereMultiple([
            'session_id' => $sessionId,
            'user_id' => Session::get('user_id')
        ]);

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

        $this->render('game/results', ['session' => $session, 'responses' => $responses, 'result' => $result]);
    }

    public function createRoom()
    {
        $this->requireRole(['armador','admin']);
        $userId = Session::get('user_id');
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
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

        $session = GameSession::findByRoomCode($roomCode);
        if (!$session) {
            $this->redirect('/game');
        }

        $this->render('game/room', [
            'roomCode' => $roomCode,
            'sessionId' => $session->id
        ]);
    }
}