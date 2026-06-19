<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * CheckRole
 * Verifica que el usuario tiene el rol requerido
 */
class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'No autenticado',
            ], 401);
        }

        if (!in_array(auth()->user()->role, $roles)) {
            return response()->json([
                'success' => false,
                'message' => 'Permisos insuficientes',
            ], 403);
        }

        return $next($request);
    }
}