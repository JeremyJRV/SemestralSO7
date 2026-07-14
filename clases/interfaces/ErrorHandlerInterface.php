<?php
namespace clases\interfaces;

/**
 * Contrato para clases de manejo de errores.
 *
 * Pedido explícitamente por la rúbrica (punto 14: "Implementar el uso
 * de una Interfaz en el proyecto"), que da como ejemplo justamente
 * "ErrorHandlerInterface".
 *
 * Cualquier clase que implemente esta interfaz garantiza que sabe
 * registrarse como manejador global de excepciones y procesar una
 * excepción no capturada de forma consistente (loguearla y responder
 * al usuario).
 */
interface ErrorHandlerInterface
{
    /**
     * Registra la clase como manejador global de excepciones de PHP
     * (normalmente vía set_exception_handler).
     */
    public static function register(): void;

    /**
     * Procesa una excepción no capturada: la registra en el log y
     * responde al usuario de forma amigable.
     */
    public static function handleException(\Throwable $e): void;
}