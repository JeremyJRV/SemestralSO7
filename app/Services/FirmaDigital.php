<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

/**
 * FirmaDigital
 * Genera y verifica firmas HMAC para garantizar integridad de datos
 * Requisito RNF-06: Integridad de datos críticos
 */
class FirmaDigital
{
    /**
     * Clave secreta para HMAC (guardada en .env)
     */
    private static string $clave_secreta;

    /**
     * Inicializa la clave secreta
     */
    public static function inicializar(): void
    {
        self::$clave_secreta = env('SIGNATURE_KEY', env('APP_KEY', 'firma-secreta'));
    }

    /**
     * Genera una firma HMAC para un conjunto de datos
     * 
     * @param array $datos Datos a firmar
     * @param string $prefijo Prefijo opcional (ej: 'usuarios', 'salarios')
     * @return string Firma HMAC en hexadecimal
     */
    public static function generar(array $datos, string $prefijo = ''): string
    {
        self::inicializar();

        // Ordenar datos alfabéticamente para consistencia
        ksort($datos);

        // Crear cadena de datos concatenada
        $cadena = $prefijo . json_encode($datos);

        // Generar HMAC-SHA256
        $firma = hash_hmac('sha256', $cadena, self::$clave_secreta);

        return $firma;
    }

    /**
     * Verifica una firma HMAC
     * 
     * @param array $datos Datos originales
     * @param string $firma_almacenada Firma a verificar
     * @param string $prefijo Prefijo opcional
     * @return bool True si la firma es válida
     */
    public static function verificar(array $datos, string $firma_almacenada, string $prefijo = ''): bool
    {
        self::inicializar();

        $firma_calculada = self::generar($datos, $prefijo);

        // Comparación segura usando hash_equals para evitar timing attacks
        return hash_equals($firma_calculada, $firma_almacenada);
    }

    /**
     * Genera firma para datos de usuario (Salarios, Cédula, etc.)
     * 
     * @param int $user_id ID del usuario
     * @param string $cedula Cédula
     * @param float $salario Salario base
     * @param string $fecha Fecha
     * @return string Firma
     */
    public static function generarFirmaUsuario(int $user_id, string $cedula, float $salario, string $fecha): string
    {
        $datos = [
            'user_id' => $user_id,
            'cedula' => $cedula,
            'salario' => $salario,
            'fecha' => $fecha,
        ];

        return self::generar($datos, 'usuario_');
    }

    /**
     * Verifica firma de usuario
     * 
     * @param int $user_id ID del usuario
     * @param string $cedula Cédula
     * @param float $salario Salario base
     * @param string $fecha Fecha
     * @param string $firma_almacenada Firma a verificar
     * @return bool
     */
    public static function verificarFirmaUsuario(int $user_id, string $cedula, float $salario, string $fecha, string $firma_almacenada): bool
    {
        $datos = [
            'user_id' => $user_id,
            'cedula' => $cedula,
            'salario' => $salario,
            'fecha' => $fecha,
        ];

        return self::verificar($datos, $firma_almacenada, 'usuario_');
    }

    /**
     * Genera firma para respuestas de juego
     * 
     * @param int $user_id ID del usuario
     * @param int $question_id ID de la pregunta
     * @param int $option_id Opción seleccionada
     * @param bool $is_correct ¿Es correcta?
     * @return string Firma
     */
    public static function generarFirmaRespuesta(int $user_id, int $question_id, int $option_id, bool $is_correct): string
    {
        $datos = [
            'user_id' => $user_id,
            'question_id' => $question_id,
            'option_id' => $option_id,
            'is_correct' => $is_correct ? 1 : 0,
        ];

        return self::generar($datos, 'respuesta_');
    }

    /**
     * Verifica firma de respuesta
     * 
     * @param int $user_id ID del usuario
     * @param int $question_id ID de la pregunta
     * @param int $option_id Opción seleccionada
     * @param bool $is_correct ¿Es correcta?
     * @param string $firma_almacenada Firma a verificar
     * @return bool
     */
    public static function verificarFirmaRespuesta(int $user_id, int $question_id, int $option_id, bool $is_correct, string $firma_almacenada): bool
    {
        $datos = [
            'user_id' => $user_id,
            'question_id' => $question_id,
            'option_id' => $option_id,
            'is_correct' => $is_correct ? 1 : 0,
        ];

        return self::verificar($datos, $firma_almacenada, 'respuesta_');
    }

    /**
     * Genera firma para premios
     * 
     * @param int $user_id ID del usuario
     * @param int $prize_id ID del premio
     * @param string $fecha Fecha de obtención
     * @return string Firma
     */
    public static function generarFirmaPremio(int $user_id, int $prize_id, string $fecha): string
    {
        $datos = [
            'user_id' => $user_id,
            'prize_id' => $prize_id,
            'fecha' => $fecha,
        ];

        return self::generar($datos, 'premio_');
    }

    /**
     * Verifica firma de premio
     * 
     * @param int $user_id ID del usuario
     * @param int $prize_id ID del premio
     * @param string $fecha Fecha de obtención
     * @param string $firma_almacenada Firma a verificar
     * @return bool
     */
    public static function verificarFirmaPremio(int $user_id, int $prize_id, string $fecha, string $firma_almacenada): bool
    {
        $datos = [
            'user_id' => $user_id,
            'prize_id' => $prize_id,
            'fecha' => $fecha,
        ];

        return self::verificar($datos, $firma_almacenada, 'premio_');
    }
}