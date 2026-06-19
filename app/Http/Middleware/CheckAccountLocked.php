<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * CheckAccountLocked
 * Verifica que la cuenta del usuario no esté bloqueada
 */
class CheckAccountLocked
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAccountLocked()) {
            return response()->json([
                'success' => false,
                'message' => 'Cuenta bloqueada temporalmente',
            ], 403);
        }

        return $next($request);
    }
}