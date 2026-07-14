<?php
namespace clases;

use clases\interfaces\ErrorHandlerInterface;

class ErrorHandler implements ErrorHandlerInterface
{
    public static function register(): void
    {
        set_exception_handler([self::class, 'handleException']);
    }

    public static function handleException(\Throwable $e): void
    {
        // Log detallado (siempre, sin importar el entorno)
        $log = date('Y-m-d H:i:s') . ' - ' . $e::class . ': ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
        error_log($log, 3, __DIR__ . '/../logs/errors.log');

        if (php_sapi_name() === 'cli') {
            echo "Error: " . $e->getMessage() . PHP_EOL;
            return;
        }

        http_response_code(500);

        // BUG/REQUISITO CORREGIDO: la rúbrica (punto 12) exige que, en
        // fase de desarrollo, se vean TODOS los errores. Antes el
        // comentario decía "Opcionalmente mostrar mensaje en desarrollo"
        // pero nunca se implementaba: siempre se mostraba el mensaje
        // genérico, incluso en desarrollo. Ahora, si APP_ENV es
        // 'development', se muestra el detalle completo (tipo de
        // excepción, mensaje, archivo, línea y stack trace).
        if (defined('APP_ENV') && APP_ENV === 'development') {
            echo "<div style=\"font-family: monospace; background:#1e1e1e; color:#f87171; padding:1.5rem; margin:1rem;\">";
            echo "<h2 style=\"color:#f87171;\">⚠ " . htmlspecialchars($e::class) . "</h2>";
            echo "<p><strong>Mensaje:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<p><strong>Archivo:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p>";
            echo "<pre style=\"white-space:pre-wrap; color:#e5e7eb;\">" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
            echo "</div>";
        } else {
            // En producción, nunca se expone información sensible del error
            echo "<h1>Error interno del servidor</h1>";
        }
    }
}