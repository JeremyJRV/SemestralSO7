<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * UserController
 * Gestiona CRUD de usuarios (solo para administradores)
 */
class UserController extends Controller
{
    /**
     * Lista todos los usuarios
     */
    public function index()
    {
        $users = User::paginate(15);

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    /**
     * Obtiene un usuario específico
     */
    public function show($id)
    {
        $user = User::with(['userLevels', 'prizes', 'gameSessions'])->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    /**
     * Crea un nuevo usuario
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:8|max:12',
            'role' => 'required|in:jugador,armador,administrador',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'nickname' => $request->nickname,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado exitosamente',
            'data' => $user,
        ], 201);
    }

    /**
     * Actualiza un usuario
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'name' => 'sometimes|string|max:255',
            'nickname' => 'sometimes|string|max:100|unique:users,nickname,' . $id,
            'role' => 'sometimes|in:jugador,armador,administrador',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->update($request->only(['email', 'name', 'nickname', 'role', 'is_active']));

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado exitosamente',
            'data' => $user,
        ]);
    }

    /**
     * Elimina un usuario (soft delete)
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado exitosamente',
        ]);
    }

    /**
     * Obtiene usuarios por rol
     */
    public function getByRole($role)
    {
        $users = User::where('role', $role)->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }
}