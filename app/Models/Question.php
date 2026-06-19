<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo Question
 * Representa las preguntas del sistema
 * Tipos: opción_múltiple, verdadero_falso
 */
class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'theme_id',
        'level_id',
        'question_text',
        'type', // opción_múltiple, verdadero_falso
        'correct_answer_id',
        'explanation',
        'difficulty_score',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Una pregunta pertenece a un tema
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Relación: Una pregunta pertenece a un nivel
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Relación: Una pregunta tiene muchas opciones
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /**
     * Relación: Una pregunta tiene muchas respuestas de usuarios
     */
    public function gameResponses()
    {
        return $this->hasMany(GameResponse::class);
    }

    /**
     * Obtiene la opción correcta
     */
    public function getCorrectOption()
    {
        return $this->options()->find($this->correct_answer_id);
    }
}