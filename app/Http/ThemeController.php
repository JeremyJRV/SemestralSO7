<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * ThemeController
 * Gestiona CRUD de temas (PHP, JavaScript, Laravel)
 */
class ThemeController extends Controller
{
    /**
     * Lista todos los temas
     */
    public function index()
    {
        $themes = Theme::with(['questions', 'levels'])
                       ->where('is_active', true)
                       ->get();

        return response()->json([
            'success' => true,
            'data' => $themes,
        ]);
    }

    /**
     * Obtiene un tema específico
     */
    public function show($id)
    {
        $theme = Theme::with(['questions', 'levels', 'userRatings'])->find($id);

        if (!$theme) {
            return response()->json([
                'success' => false,
                'message' => 'Tema no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $theme,
        ]);
    }

    /**
     * Crea un nuevo tema
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:themes',
            'description' => 'sometimes|string',
            'icon_path' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $theme = Theme::create([
            'name' => $request->name,
            'description' => $request->description ?? '',
            'icon_path' => $request->icon_path ?? null,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tema creado exitosamente',
            'data' => $theme,
        ], 201);
    }

    /**
     * Actualiza un tema
     */
    public function update(Request $request, $id)
    {
        $theme = Theme::find($id);

        if (!$theme) {
            return response()->json([
                'success' => false,
                'message' => 'Tema no encontrado',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100|unique:themes,name,' . $id,
            'description' => 'sometimes|string',
            'icon_path' => 'sometimes|string',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $theme->update($request->only(['name', 'description', 'icon_path', 'is_active']));

        return response()->json([
            'success' => true,
            'message' => 'Tema actualizado exitosamente',
            'data' => $theme,
        ]);
    }

    /**
     * Elimina un tema (soft delete)
     */
    public function destroy($id)
    {
        $theme = Theme::find($id);

        if (!$theme) {
            return response()->json([
                'success' => false,
                'message' => 'Tema no encontrado',
            ], 404);
        }

        $theme->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tema eliminado exitosamente',
        ]);
    }

    /**
     * Obtiene estadísticas de un tema (más jugado, promedio de calificación)
     */
    public function getStatistics($id)
    {
        $theme = Theme::find($id);

        if (!$theme) {
            return response()->json([
                'success' => false,
                'message' => 'Tema no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'theme' => $theme,
                'total_plays' => $theme->getTotalPlays(),
                'average_rating' => $theme->getAverageRating(),
                'total_questions' => $theme->questions()->count(),
            ],
        ]);
    }
}