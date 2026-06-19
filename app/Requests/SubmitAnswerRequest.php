<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'jugador';
    }

    public function rules(): array
    {
        return [
            'game_session_id' => 'required|exists:game_sessions,id',
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'required|exists:options,id',
            'time_spent_seconds' => 'required|integer|min:1|max:3600',
        ];
    }

    public function messages(): array
    {
        return [
            'time_spent_seconds.max' => 'El tiempo de respuesta no puede ser mayor a 1 hora',
        ];
    }
}