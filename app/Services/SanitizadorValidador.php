<?php

namespace App\Services;

/**
 * SanitizadorValidador
 * Centraliza todas las operaciones de sanitización y validación
 * Requisito: DRY - evitar duplicación de código de validación
 */
class SanitizadorValidador
{
    /**
     * Sanitiza una cadena de texto
     * 
     * @param string $input Texto a sanitizar
     * @return string Texto sanitizado
     */
    public static function sanitizarTexto(string $input): string
    {
        // Eliminar espacios en blanco innecesarios
        $input = trim($input);
        
        // Escapar caracteres HTML
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        
        // Eliminar caracteres especiales peligrosos
        $input = preg_replace('/[^a-zA-Z0-9\s\-_.áéíóúñÁÉÍÓÚÑ]/u', '', $input);
        
        return $input;
    }

    /**
     * Sanitiza un email
     * 
     * @param string $email Email a sanitizar
     * @return string|false Email sanitizado o false si es inválido
     */
    public static function sanitizarEmail(string $email)
    {
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        return $email;
    }

    /**
     * Sanitiza una URL
     * 
     * @param string $url URL a sanitizar
     * @return string|false URL sanitizada o false si es inválida
     */
    public static function sanitizarUrl(string $url)
    {
        $url = filter_var(trim($url), FILTER_SANITIZE_URL);
        
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }
        
        return $url;
    }

    /**
     * Sanitiza un número entero
     * 
     * @param mixed $input Número a sanitizar
     * @return int|false Número entero o false
     */
    public static function sanitizarEntero($input)
    {
        return filter_var($input, FILTER_VALIDATE_INT) !== false 
            ? (int)$input 
            : false;
    }

    /**
     * Sanitiza un número decimal
     * 
     * @param mixed $input Número a sanitizar
     * @return float|false Número decimal o false
     */
    public static function sanitizarDecimal($input)
    {
        return filter_var($input, FILTER_VALIDATE_FLOAT) !== false 
            ? (float)$input 
            : false;
    }

    /**
     * Valida la longitud de una contraseña
     * Requisito: 8-12 caracteres
     * 
     * @param string $password Contraseña a validar
     * @return bool
     */
    public static function validarContraseña(string $password): bool
    {
        return strlen($password) >= 8 && strlen($password) <= 12;
    }

    /**
     * Valida fortaleza de contraseña
     * Debe contener: mayúsculas, minúsculas, números y caracteres especiales
     * 
     * @param string $password Contraseña a validar
     * @return bool
     */
    public static function validarFortalezaContraseña(string $password): bool
    {
        $hasUpperCase = preg_match('/[A-Z]/', $password);
        $hasLowerCase = preg_match('/[a-z]/', $password);
        $hasNumber = preg_match('/[0-9]/', $password);
        $hasSpecial = preg_match('/[!@#$%^&*]/', $password);

        return $hasUpperCase && $hasLowerCase && $hasNumber && $hasSpecial;
    }

    /**
     * Valida un nickname/usuario
     * Puede contener letras, números, guiones y guiones bajos
     * 
     * @param string $nickname Nickname a validar
     * @return bool
     */
    public static function validarNickname(string $nickname): bool
    {
        return preg_match('/^[a-zA-Z0-9_\-]{3,20}$/', $nickname) === 1;
    }

    /**
     * Valida un nombre de persona
     * 
     * @param string $name Nombre a validar
     * @return bool
     */
    public static function validarNombre(string $name): bool
    {
        return preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{2,}$/', $name) === 1;
    }

    /**
     * Valida una dirección IP
     * 
     * @param string $ip IP a validar
     * @return bool
     */
    public static function validarIP(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * Valida una URL
     * 
     * @param string $url URL a validar
     * @return bool
     */
    public static function validarURL(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Limpia array de datos para evitar inyecciones
     * 
     * @param array $datos Array a limpiar
     * @return array Array limpio
     */
    public static function limpiarArray(array $datos): array
    {
        $limpio = [];
        
        foreach ($datos as $clave => $valor) {
            if (is_array($valor)) {
                $limpio[$clave] = self::limpiarArray($valor);
            } elseif (is_string($valor)) {
                $limpio[$clave] = self::sanitizarTexto($valor);
            } else {
                $limpio[$clave] = $valor;
            }
        }
        
        return $limpio;
    }

    /**
     * Valida múltiples campos
     * 
     * @param array $datos Datos a validar
     * @param array $reglas Reglas de validación
     * @return array Array con errores (vacío si todo es válido)
     */
    public static function validarMultiple(array $datos, array $reglas): array
    {
        $errores = [];
        
        foreach ($reglas as $campo => $validaciones) {
            $valor = $datos[$campo] ?? null;
            $validacionesArray = explode('|', $validaciones);
            
            foreach ($validacionesArray as $validacion) {
                $resultado = self::validarCampo($campo, $valor, $validacion);
                if ($resultado !== true) {
                    $errores[$campo] = $resultado;
                    break;
                }
            }
        }
        
        return $errores;
    }

    /**
     * Valida un campo individual
     * 
     * @param string $campo Nombre del campo
     * @param mixed $valor Valor a validar
     * @param string $validacion Tipo de validación
     * @return bool|string True si es válido, mensaje de error si no
     */
    private static function validarCampo(string $campo, $valor, string $validacion)
    {
        list($tipo, ...$params) = explode(':', $validacion);
        
        switch ($tipo) {
            case 'requerido':
                return empty($valor) ? "$campo es requerido" : true;
            
            case 'email':
                return !self::sanitizarEmail($valor) ? "$campo debe ser un email válido" : true;
            
            case 'min':
                $min = $params[0] ?? 0;
                return strlen($valor) < $min ? "$campo debe tener al menos $min caracteres" : true;
            
            case 'max':
                $max = $params[0] ?? 255;
                return strlen($valor) > $max ? "$campo no puede exceder $max caracteres" : true;
            
            case 'numero':
                return !is_numeric($valor) ? "$campo debe ser un número" : true;
            
            case 'entero':
                return self::sanitizarEntero($valor) === false ? "$campo debe ser un número entero" : true;
            
            default:
                return true;
        }
    }
}