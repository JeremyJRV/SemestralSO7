<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo GameResponse
 * Registra las respuestas dadas por los usuarios en cada pregunta
 */
class GameResponse extends Model
{
    use HasFactory;

    protected $table = 'game_responses';

    protected $fillable = [
        'game_session_id',
        'user_id',
        'question_id',
        'selected_option_id',
        'is_correct',
        'time_spent_seconds',
        'answered_at',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'answered_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Una respuesta pertenece a una sesión de juego
     */
    public function gameSession()
    {
        return $this->belongsTo(GameSession::class);
    }

    /**
     * Relación: Una respuesta pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Una respuesta pertenece a una pregunta
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Relación: Una respuesta pertenece a una opción seleccionada
     */
    public function selectedOption()
    {
        return $this->belongsTo(Option::class, 'selected_option_id');
    }
}