<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * PrizeController
 * Gestiona CRUD de premios
 */
class PrizeController extends Controller
{
    /**
     * Lista todos los premios
     */
    public function index()
    {
        $prizes = Prize::where('is_active', true)->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $prizes,
        ]);
    }

    /**
     * Obtiene un premio específico
     */
    public function show($id)
    {
        $prize = Prize::with(['levels', 'users'])->find($id);

        if (!$prize) {
            return response()->json([
                'success' => false,
                'message' => 'Premio no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $prize,
        ]);
    }

    /**
     * Crea un nuevo premio
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'sometimes|string',
            'image_path' => 'sometimes|string',
            'points_value' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $prize = Prize::create([
            'name' => $request->name,
            'description' => $request->description ?? '',
            'image_path' => $request->image_path ?? null,
            'points_value' => $request->points_value,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Premio creado exitosamente',
            'data' => $prize,
        ], 201);
    }

    /**
     * Actualiza un premio
     */
    public function update(Request $request, $id)
    {
        $prize = Prize::find($id);

        if (!$prize) {
            return response()->json([
                'success' => false,
                'message' => 'Premio no encontrado',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100',
            'description' => 'sometimes|string',
            'image_path' => 'sometimes|string',
            'points_value' => 'sometimes|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $prize->update($request->only(['name', 'description', 'image_path', 'points_value', 'is_active']));

        return response()->json([
            'success' => true,
            'message' => 'Premio actualizado exitosamente',
            'data' => $prize,
        ]);
    }

    /**
     * Elimina un premio
     */
    public function destroy($id)
    {
        $prize = Prize::find($id);

        if (!$prize) {
            return response()->json([
                'success' => false,
                'message' => 'Premio no encontrado',
            ], 404);
        }

        $prize->delete();

        return response()->json([
            'success' => true,
            'message' => 'Premio eliminado exitosamente',
        ]);
    }
}