<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo User
 * Representa los usuarios del sistema con roles: Jugador, Armador, Administrador
 */
class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'name',
        'nickname',
        'role', // jugador, armador, administrador
        'avatar_path',
        'is_active',
        'account_locked_until',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'is_active' => 'boolean',
        'account_locked_until' => 'datetime',
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Un usuario tiene muchos intentos de login
     */
    public function loginAttempts()
    {
        return $this->hasMany(LoginAttempt::class);
    }

    /**
     * Relación: Un usuario tiene muchos niveles completados
     */
    public function userLevels()
    {
        return $this->hasMany(UserLevel::class);
    }

    /**
     * Relación: Un usuario tiene muchos premios
     */
    public function prizes()
    {
        return $this->belongsToMany(Prize::class, 'user_prizes')
                    ->withTimestamps();
    }

    /**
     * Relación: Un usuario tiene muchas calificaciones de temas
     */
    public function themeRatings()
    {
        return $this->hasMany(UserThemeRating::class);
    }

    /**
     * Relación: Un usuario participa en muchas sesiones de juego
     */
    public function gameSessions()
    {
        return $this->hasMany(GameSession::class);
    }

    /**
     * Relación: Un usuario da muchas respuestas
     */
    public function gameResponses()
    {
        return $this->hasMany(GameResponse::class);
    }

    /**
     * Verifica si la cuenta está bloqueada
     */
    public function isAccountLocked(): bool
    {
        return $this->account_locked_until && now() < $this->account_locked_until;
    }

    /**
     * Obtiene el nivel actual del usuario en un tema
     */
    public function getCurrentLevel($themeId)
    {
        return $this->userLevels()
                    ->where('theme_id', $themeId)
                    ->latest('updated_at')
                    ->first();
    }

    /**
     * Obtiene puntos totales del usuario
     */
    public function getTotalPoints(): int
    {
        return $this->userLevels()->sum('points') ?? 0;
    }
}