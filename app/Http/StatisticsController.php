<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use App\Models\GameResponse;
use App\Models\Theme;
use App\Models\UserLevel;
use Illuminate\Http\Request;

/**
 * StatisticsController
 * Gestiona reportes y estadísticas del sistema
 */
class StatisticsController extends Controller
{
    /**
     * Obtiene los temas más jugados
     */
    public function getMostPlayedThemes()
    {
        $themes = Theme::withCount('userRatings')
                       ->orderBy('user_ratings_count', 'desc')
                       ->limit(10)
                       ->get();

        return response()->json([
            'success' => true,
            'data' => $themes,
        ]);
    }

    /**
     * Obtiene estadísticas generales del sistema
     */
    public function getGeneralStatistics()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_sessions' => GameSession::count(),
                'total_responses' => GameResponse::count(),
                'average_session_duration' => GameSession::where('status', 'completada')
                                                         ->avg(\DB::raw('TIMESTAMPDIFF(SECOND, started_at, ended_at)')),
                'total_themes' => Theme::count(),
            ],
        ]);
    }

    /**
     * Obtiene estadísticas de un usuario específico
     */
    public function getUserStatistics($userId)
    {
        $userSessions = GameSession::where('user_id', $userId)
                                   ->where('status', 'completada')
                                   ->get();

        $stats = [
            'total_sessions' => $userSessions->count(),
            'total_score' => $userSessions->sum('score'),
            'average_score' => $userSessions->avg('score'),
            'average_duration' => $userSessions->avg(function ($session) {
                return $session->getDurationInSeconds();
            }),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    /**
     * Genera reporte de progreso de usuarios (para Excel)
     */
    public function getUserProgressReport()
    {
        $report = UserLevel::with(['user', 'theme', 'level'])
                          ->get()
                          ->map(function ($userLevel) {
                              return [
                                  'usuario' => $userLevel->user->name,
                                  'apodo' => $userLevel->user->nickname,
                                  'tema' => $userLevel->theme->name,
                                  'nivel_actual' => $userLevel->level->name,
                                  'puntos' => $userLevel->points,
                                  'intentos' => $userLevel->attempts,
                                  'completado' => $userLevel->is_completed ? 'Sí' : 'No',
                                  'fecha_inicio' => $userLevel->created_at->format('Y-m-d H:i'),
                                  'fecha_completado' => $userLevel->passed_at?->format('Y-m-d H:i'),
                              ];
                          });

        return response()->json([
            'success' => true,
            'data' => $report,
        ]);
    }

    /**
     * Obtiene tiempos promedio de respuesta por pregunta
     */
    public function getAverageResponseTimes()
    {
        $stats = GameResponse::with('question')
                            ->get()
                            ->groupBy('question_id')
                            ->map(function ($responses) {
                                return [
                                    'question_id' => $responses[0]->question_id,
                                    'average_time' => $responses->avg('time_spent_seconds'),
                                    'total_responses' => $responses->count(),
                                ];
                            });

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }
}