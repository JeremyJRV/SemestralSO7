<?php
namespace clases;

class ErrorHandler
{
    public static function register(): void
    {
        set_exception_handler([self::class, 'handleException']);
    }

    public static function handleException(\Throwable $e): void
    {
        // Log detallado
        $log = date('Y-m-d H:i:s') . ' - ' . $e::class . ': ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
        error_log($log, 3, __DIR__ . '/../logs/errors.log');

        // Respuesta amigable
        if (php_sapi_name() === 'cli') {
            echo "Error: " . $e->getMessage() . PHP_EOL;
        } else {
            http_response_code(500);
            echo "<h1>Error interno del servidor</h1>";
            // Opcionalmente mostrar mensaje en desarrollo
        }
    }
}