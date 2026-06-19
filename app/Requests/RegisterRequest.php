<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * RegisterRequest
 * Valida los datos de registro de nuevo usuario
 */
class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users|max:255',
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|unique:users|max:100|regex:/^[a-zA-Z0-9_\-]{3,20}$/',
            'password' => 'required|string|min:8|max:12|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'El email ya está registrado',
            'nickname.unique' => 'El nickname ya está en uso',
            'nickname.regex' => 'El nickname solo puede contener letras, números, guiones y guiones bajos',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.max' => 'La contraseña no puede exceder 12 caracteres',
        ];
    }
}