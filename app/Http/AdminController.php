<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Theme;
use App\Models\Question;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;

/**
 * AdminController
 * Panel de administración del sistema
 */
class AdminController extends Controller
{
    /**
     * Obtiene dashboard del administrador
     */
    public function dashboard()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_users' => User::count(),
                'total_themes' => Theme::count(),
                'total_questions' => Question::count(),
                'users_by_role' => [
                    'jugadores' => User::where('role', 'jugador')->count(),
                    'armadores' => User::where('role', 'armador')->count(),
                    'administradores' => User::where('role', 'administrador')->count(),
                ],
                'recent_logins' => LoginAttempt::where('is_successful', true)
                                              ->orderBy('attempted_at', 'desc')
                                              ->limit(10)
                                              ->get(),
            ],
        ]);
    }

    /**
     * Obtiene intentos de login fallidos
     */
    public function getFailedLoginAttempts()
    {
        $attempts = LoginAttempt::where('is_successful', false)
                               ->orderBy('attempted_at', 'desc')
                               ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $attempts,
        ]);
    }

    /**
     * Desbloquea una cuenta de usuario
     */
    public function unlockUserAccount($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $user->update(['account_locked_until' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Cuenta desbloqueada exitosamente',
        ]);
    }

    /**
     * Obtiene bitácora de auditoría
     */
    public function getAuditLog()
    {
        $log = LoginAttempt::orderBy('attempted_at', 'desc')
                          ->paginate(50);

        return response()->json([
            'success' => true,
            'data' => $log,
        ]);
    }
}