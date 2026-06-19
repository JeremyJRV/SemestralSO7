<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

/**
 * ProfileController
 * Gestiona el perfil del usuario: avatar, puntos, premios
 */
class ProfileController extends Controller
{
    /**
     * Obtiene el perfil completo del usuario autenticado
     */
    public function show()
    {
        $user = auth()->user()->load(['userLevels', 'prizes', 'themeRatings']);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'total_points' => $user->getTotalPoints(),
                'completed_levels' => $user->userLevels()->where('is_completed', true)->count(),
                'total_prizes' => $user->prizes()->count(),
            ],
        ]);
    }

    /**
     * Actualiza el avatar del usuario
     */
    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = auth()->user();

        // Eliminar avatar anterior si existe
        if ($user->avatar_path && Storage::exists($user->avatar_path)) {
            Storage::delete($user->avatar_path);
        }

        // Guardar nuevo avatar
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar_path' => $path]);

        return response()->json([
            'success' => true,
            'message' => 'Avatar actualizado exitosamente',
            'avatar_url' => Storage::url($path),
        ]);
    }

    /**
     * Obtiene los puntos totales del usuario
     */
    public function getTotalPoints()
    {
        $user = auth()->user();
        $totalPoints = $user->getTotalPoints();

        return response()->json([
            'success' => true,
            'total_points' => $totalPoints,
        ]);
    }

    /**
     * Obtiene todos los premios del usuario
     */
    public function getPrizes()
    {
        $prizes = auth()->user()->prizes()->get();

        return response()->json([
            'success' => true,
            'data' => $prizes,
        ]);
    }

    /**
     * Obtiene la progresión del usuario por tema
     */
    public function getProgress()
    {
        $progress = auth()->user()->userLevels()
                                  ->with(['theme', 'level'])
                                  ->get()
                                  ->groupBy('theme_id');

        return response()->json([
            'success' => true,
            'data' => $progress,
        ]);
    }
}