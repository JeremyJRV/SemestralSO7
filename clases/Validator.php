<?php
namespace clases;

class Validator
{
    public static function sanitizeString(string $input): string
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }

    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword(string $password): array|bool
    {
        $errors = [];
        $length = strlen($password);

        if ($length < 8) {
            $errors[] = "La contraseña debe tener al menos 8 caracteres.";
        }
        if ($length > 12) {
            $errors[] = "La contraseña no puede tener más de 12 caracteres.";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Debe contener al menos una mayúscula.";
        }
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Debe contener al menos una minúscula.";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Debe contener al menos un número.";
        }
        return empty($errors) ? true : $errors;
    }

    /**
     * Valida formato de cédula (acepta dígitos y guiones, ej. 8-123-4567,
     * PE-123-4567, o solo dígitos). Longitud entre 5 y 20 caracteres.
     * Nuevo: pedido por la rúbrica actualizada (punto 1 y 2).
     */
    public static function validateCedula(string $cedula): bool
    {
        return (bool) preg_match('/^[A-Za-z0-9\-]{5,20}$/', $cedula);
    }

    public static function validateMultiple(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $ruleSet) {
            // BUG CORREGIDO: si el campo no venía en $data, $value era
            // null, y self::validateEmail(null) truena con un TypeError
            // (el parámetro es string, no nullable). Ahora se usa '' como
            // valor por defecto para poder validar sin romper.
            $value = $data[$field] ?? '';
            $ruleList = explode('|', $ruleSet);
            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $errors[$field][] = "El campo $field es obligatorio.";
                }
                if ($rule === 'email' && !empty($value) && !self::validateEmail($value)) {
                    $errors[$field][] = "El campo $field debe ser un email válido.";
                }
                if ($rule === 'cedula' && !empty($value) && !self::validateCedula($value)) {
                    $errors[$field][] = "El campo $field no tiene un formato de cédula válido.";
                }
            }
        }
        return $errors;
    }
}