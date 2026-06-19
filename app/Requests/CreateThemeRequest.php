<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateThemeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['armador', 'administrador']);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:themes',
            'description' => 'sometimes|string|max:1000',
            'icon_path' => 'sometimes|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'El tema ya existe',
            'name.required' => 'El nombre del tema es requerido',
        ];
    }
}