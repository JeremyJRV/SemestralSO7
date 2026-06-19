<?php

namespace App\Traits;

use App\Services\SanitizadorValidador;

/**
 * ValidatesInput
 * Proporciona métodos de validación centralizados
 */
trait ValidatesInput
{
    /**
     * Valida un email
     */
    protected function validateEmail($email)
    {
        return SanitizadorValidador::sanitizarEmail($email);
    }

    /**
     * Valida una contraseña
     */
    protected function validatePassword($password)
    {
        return SanitizadorValidador::validarContraseña($password);
    }

    /**
     * Valida un nickname
     */
    protected function validateNickname($nickname)
    {
        return SanitizadorValidador::validarNickname($nickname);
    }

    /**
     * Sanitiza un texto
     */
    protected function sanitizeText($text)
    {
        return SanitizadorValidador::sanitizarTexto($text);
    }
}