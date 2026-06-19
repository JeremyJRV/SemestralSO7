<?php

namespace App\Services;

use Exception;
use Throwable;

/**
 * ManejadorErrores
 * Centraliza el manejo de excepciones y errores
 * Implementa patrón de manejo robusto con logging
 */
class ManejadorErrores
{
    /**
     * Log de errores
     */
    private static array $errores = [];

    /**
     * Manejador global de excepciones
     * 
     * @param Throwable $exception Excepción a manejar
     * @return array Respuesta JSON
     */
    public static function manejar(Throwable $exception): array
    {
        // Registrar en log
        self::registrarError($exception);

        // Determinar tipo de excepción
        $codigo = $exception->getCode();
        $mensaje = $exception->getMessage();

        if ($exception instanceof \App\Exceptions\AccountLockedException) {
            return [
                'success' => false,
                'message' => 'Cuenta bloqueada temporalmente',
                'code' => 'ACCOUNT_LOCKED',
                'status' => 403,
            ];
        }

        if ($exception instanceof \App\Exceptions\InvalidCredentialsException) {
            return [
                'success' => false,
                'message' => 'Credenciales inválidas',
                'code' => 'INVALID_CREDENTIALS',
                'status' => 401,
            ];
        }

        if ($exception instanceof \App\Exceptions\InsufficientPermissionsException) {
            return [
                'success' => false,
                'message' => 'Permisos insuficientes',
                'code' => 'INSUFFICIENT_PERMISSIONS',
                'status' => 403,
            ];
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return [
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $exception->errors(),
                'code' => 'VALIDATION_ERROR',
                'status' => 422,
            ];
        }

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return [
                'success' => false,
                'message' => 'Recurso no encontrado',
                'code' => 'NOT_FOUND',
                'status' => 404,
            ];
        }

        // Excepción genérica
        return [
            'success' => false,
            'message' => env('APP_DEBUG') ? $mensaje : 'Error interno del servidor',
            'code' => 'INTERNAL_ERROR',
            'status' => 500,
        ];
    }

    /**
     * Registra un error en el archivo de log
     * 
     * @param Throwable $exception Excepción a registrar
     * @return void
     */
    private static function registrarError(Throwable $exception): void
    {
        $error = [
            'timestamp' => now()->toDateTimeString(),
            'exception' => class_basename($exception),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
        ];

        \Log::error('Error capturado: ' . json_encode($error));
    }

    /**
     * Valida que un objeto implemente una interfaz
     * 
     * @param mixed $objeto Objeto a validar
     * @param string $interfaz Interfaz requerida
     * @return bool
     */
    public static function validarInterfaz($objeto, string $interfaz): bool
    {
        return $objeto instanceof $interfaz;
    }

    /**
     * Registra un error para auditoría
     * 
     * @param string $tipo Tipo de error
     * @param string $mensaje Mensaje de error
     * @param array $contexto Contexto adicional
     * @return void
     */
    public static function auditar(string $tipo, string $mensaje, array $contexto = []): void
    {
        $registro = [
            'tipo' => $tipo,
            'mensaje' => $mensaje,
            'usuario_id' => auth()->id() ?? null,
            'ip' => request()->ip(),
            'url' => request()->fullUrl(),
            'contexto' => $contexto,
            'timestamp' => now()->toDateTimeString(),
        ];

        \Log::channel('auditoría')->info(json_encode($registro));
    }
}