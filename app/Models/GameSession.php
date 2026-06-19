<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo GameSession
 * Representa una sesión de juego (puede ser individual o multijugador)
 */
class GameSession extends Model
{
    use HasFactory;

    protected $table = 'game_sessions';

    protected $fillable = [
        'theme_id',
        'level_id',
        'user_id',
        'is_multiplayer',
        'status', // en_progreso, completada, abandonada
        'started_at',
        'ended_at',
        'score',
    ];

    protected $casts = [
        'is_multiplayer' => 'boolean',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Una sesión pertenece a un tema
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Relación: Una sesión pertenece a un nivel
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Relación: Una sesión pertenece a un usuario (creador/principal)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Una sesión tiene muchas respuestas
     */
    public function responses()
    {
        return $this->hasMany(GameResponse::class);
    }

    /**
     * Calcula el tiempo total de la sesión en segundos
     */
    public function getDurationInSeconds(): int
    {
        if (!$this->ended_at) {
            return 0;
        }
        return $this->started_at->diffInSeconds($this->ended_at);
    }
}