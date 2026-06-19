<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePrizeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'administrador';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'sometimes|string|max:1000',
            'image_path' => 'sometimes|string|max:255',
            'points_value' => 'required|integer|min:1|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'points_value.required' => 'El valor en puntos es requerido',
            'points_value.min' => 'El valor debe ser mayor a 0',
        ];
    }
}