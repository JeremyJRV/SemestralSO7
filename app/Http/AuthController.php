<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * AuthController
 * Gestiona la autenticación: login, registro, logout
 * Implementa control de seguridad: máximo 3 intentos fallidos, bloqueo temporal
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Autentica el usuario
     * Requisito: máximo 3 intentos fallidos, luego bloqueo temporal
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        // Verificar si la cuenta está bloqueada
        if ($user && $user->isAccountLocked()) {
            return response()->json([
                'success' => false,
                'message' => 'Cuenta bloqueada temporalmente. Intenta más tarde.',
            ], 403);
        }

        // Obtener intentos fallidos recientes
        $failedAttempts = LoginAttempt::getRecentFailedAttempts($validated['email'], 30);

        if (count($failedAttempts) >= 3) {
            // Bloquear cuenta por 15 minutos
            if ($user) {
                $user->update(['account_locked_until' => now()->addMinutes(15)]);
            }

            LoginAttempt::create([
                'email' => $validated['email'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'is_successful' => false,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Demasiados intentos fallidos. Cuenta bloqueada por 15 minutos.',
            ], 429);
        }

        // Validar credenciales
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            LoginAttempt::create([
                'user_id' => $user?->id,
                'email' => $validated['email'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'is_successful' => false,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Credenciales inválidas.',
            ], 401);
        }

        // Login exitoso
        LoginAttempt::create([
            'user_id' => $user->id,
            'email' => $validated['email'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'is_successful' => true,
        ]);

        // Generar token (si usas Sanctum)
        $token = $user->createToken('trivia-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login exitoso',
            'token' => $token,
            'user' => $user,
        ]);
    }

    /**
     * Muestra el formulario de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Registra un nuevo usuario
     * Requisito: contraseña 8-12 caracteres
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:100|unique:users',
            'password' => 'required|string|min:8|max:12|confirmed',
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
            'role' => 'jugador', // Rol por defecto
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
        ], 201);
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout exitoso',
        ]);
    }
}