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

    // Selección de tema/nivel para jugar
    public function selectMode()
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

        $availableLevels = $this->gameService->getAvailableLevelsForUser($userId);
        $this->render('game/select', ['levels' => $availableLevels]);
    }

    // Iniciar partida (single player)
    public function start($themeLevelId)
    {
        $userId = Session::get('user_id');
        $session = $this->gameService->createSession($userId, $themeLevelId);
        $this->redirect("/game/play/{$session->id}");
    }

    public function play($sessionId)
    {
        $session = GameSession::find($sessionId);
        if (!$session || $session->host_user_id != Session::get('user_id')) {
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
        $this->csrfCheck();

        $answers = $_POST['answers'] ?? []; // formato [question_id => response]
        $responseTimes = $_POST['times'] ?? [];

        $result = $this->gameService->processAnswers($sessionId, $userId, $answers, $responseTimes);
        // Redirigir a resultados
        $this->redirect("/game/results/{$sessionId}");
    }

    public function results($sessionId)
    {
        $session = GameSession::find($sessionId);
        $responses = GameResponse::whereMultiple([
         'session_id' => $sessionId,
         'user_id' => Session::get('user_id')
        ]);
        // Calcular estadísticas...
        $this->render('game/results', ['session' => $session, 'responses' => $responses]);
    }

    // Multijugador (crear sala)
    public function createRoom()
    {
        $this->requireRole(['armador','admin']);
        $csrfToken = Session::csrfToken();
        $this->render('game/create_room', ['csrfToken' => $csrfToken]);
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
        // Vista para unirse a sala
    }
}