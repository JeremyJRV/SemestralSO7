<?php
namespace clases\interfaces;

/**
 * Contrato para clases de validación y sanitización de datos.
 *
 * Pedido explícitamente por la rúbrica (punto 13: "Debe contar con una
 * clase de sanitizar y validar datos", y punto 14, que da como ejemplo
 * justamente "ValidatorInterface").
 */
interface ValidatorInterface
{
    /**
     * Limpia una cadena de entrada (quita tags, espacios, escapa HTML).
     */
    public static function sanitizeString(string $input): string;

    /**
     * Valida un conjunto de campos contra un conjunto de reglas
     * (ej. ['email' => 'required|email']) y devuelve un arreglo de
     * errores (vacío si todo es válido).
     */
    public static function validateMultiple(array $data, array $rules): array;
}