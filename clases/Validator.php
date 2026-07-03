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
        if (strlen($password) < 8 || strlen($password) > 12) {
            $errors[] = "La contraseña debe tener entre 8 y 12 caracteres.";
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

    public static function validateMultiple(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $ruleSet) {
            $value = $data[$field] ?? null;
            $ruleList = explode('|', $ruleSet);
            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $errors[$field][] = "El campo $field es obligatorio.";
                }
                if ($rule === 'email' && !self::validateEmail($value)) {
                    $errors[$field][] = "El campo $field debe ser un email válido.";
                }
                // Puedes añadir más reglas
            }
        }
        return $errors;
    }
}