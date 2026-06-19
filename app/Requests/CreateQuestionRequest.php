<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['armador', 'administrador']);
    }

    public function rules(): array
    {
        return [
            'theme_id' => 'required|exists:themes,id',
            'level_id' => 'required|exists:levels,id',
            'question_text' => 'required|string|max:1000',
            'type' => 'required|in:opción_múltiple,verdadero_falso',
            'correct_answer_id' => 'required|integer|min:1',
            'explanation' => 'sometimes|string|max:2000',
            'difficulty_score' => 'sometimes|integer|min:1|max:10',
            'options' => 'required|array|min:2',
            'options.*.option_text' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'options.min' => 'Debe proporcionar al menos 2 opciones',
            'correct_answer_id.required' => 'Debe indicar cuál es la respuesta correcta',
        ];
    }
}