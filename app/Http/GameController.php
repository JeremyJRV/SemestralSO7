<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use App\Models\GameResponse;
use App\Models\Question;
use App\Models\UserLevel;
use App\Models\UserPrize;
use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * GameController
 * Gestiona la lógica del juego: iniciar sesión, responder preguntas, calcular puntos
 */
class GameController extends Controller
{
    /**
     * Inicia una nueva sesión de juego
     */
    public function startSession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'theme_id' => 'required|exists:themes,id',
            'level_id' => 'required|exists:levels,id',
            'is_multiplayer' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $session = GameSession::create([
            'theme_id' => $request->theme_id,
            'level_id' => $request->level_id,
            'user_id' => auth()->id(),
            'is_multiplayer' => $request->is_multiplayer ?? false,
            'status' => 'en_progreso',
            'started_at' => now(),
        ]);

        // Obtener 10 preguntas aleatorias del tema y nivel
        $questions = Question::where('theme_id', $request->theme_id)
                             ->where('level_id', $request->level_id)
                             ->where('is_active', true)
                             ->inRandomOrder()
                             ->limit(10)
                             ->with('options')
                             ->get();

        return response()->json([
            'success' => true,
            'message' => 'Sesión iniciada',
            'session' => $session,
            'questions' => $questions,
        ]);
    }

    /**
     * Registra la respuesta de un usuario a una pregunta
     */
    public function submitAnswer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'game_session_id' => 'required|exists:game_sessions,id',
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'required|exists:options,id',
            'time_spent_seconds' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $question = Question::find($request->question_id);
        $isCorrect = $question->correct_answer_id == $request->selected_option_id;

        $response = GameResponse::create([
            'game_session_id' => $request->game_session_id,
            'user_id' => auth()->id(),
            'question_id' => $request->question_id,
            'selected_option_id' => $request->selected_option_id,
            'is_correct' => $isCorrect,
            'time_spent_seconds' => $request->time_spent_seconds,
            'answered_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => $isCorrect ? 'Respuesta correcta' : 'Respuesta incorrecta',
            'is_correct' => $isCorrect,
            'data' => $response,
        ]);
    }

    /**
     * Finaliza una sesión de juego y calcula puntos
     */
    public function endSession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'game_session_id' => 'required|exists:game_sessions,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $session = GameSession::find($request->game_session_id);

        // Contar respuestas correctas
        $correctAnswers = GameResponse::where('game_session_id', $session->id)
                                      ->where('is_correct', true)
                                      ->count();

        $totalQuestions = GameResponse::where('game_session_id', $session->id)->count();

        // Calcular puntos (10 puntos por respuesta correcta)
        $score = $correctAnswers * 10;

        // Actualizar sesión
        $session->update([
            'status' => 'completada',
            'ended_at' => now(),
            'score' => $score,
        ]);

        // Actualizar progresión del usuario
        $userLevel = UserLevel::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'theme_id' => $session->theme_id,
                'level_id' => $session->level_id,
            ],
            [
                'points' => 0,
                'attempts' => 0,
                'is_completed' => false,
            ]
        );

        $userLevel->increment('points', $score);
        $userLevel->increment('attempts');

        // Verificar si nivel fue completado (80% o más de respuestas correctas)
        if ($correctAnswers / $totalQuestions >= 0.8) {
            $userLevel->update([
                'is_completed' => true,
                'passed_at' => now(),
            ]);

            // Asignar premios
            $prizes = Prize::whereHas('levels', function ($q) use ($session) {
                $q->where('level_id', $session->level_id);
            })->get();

            foreach ($prizes as $prize) {
                auth()->user()->prizes()->attach($prize->id, ['obtained_at' => now()]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Sesión finalizada',
            'session' => $session,
            'statistics' => [
                'correct_answers' => $correctAnswers,
                'total_questions' => $totalQuestions,
                'percentage' => ($correctAnswers / $totalQuestions) * 100,
                'score' => $score,
                'level_completed' => $userLevel->is_completed,
            ],
        ]);
    }

    /**
     * Obtiene el histórico de sesiones del usuario
     */
    public function getUserSessions()
    {
        $sessions = GameSession::where('user_id', auth()->id())
                              ->with(['theme', 'level', 'responses'])
                              ->orderBy('created_at', 'desc')
                              ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $sessions,
        ]);
    }
}