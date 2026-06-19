<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo LoginAttempt
 * Registra todos los intentos de login (exitosos y fallidos) para auditoría
 * Implementa control de seguridad: máximo 3 intentos fallidos
 */
class LoginAttempt extends Model
{
    use HasFactory;

    protected $table = 'login_attempts';

    protected $fillable = [
        'user_id',
        'email',
        'ip_address',
        'user_agent',
        'is_successful',
        'attempted_at',
    ];

    protected $casts = [
        'is_successful' => 'boolean',
        'attempted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Un intento pertenece a un usuario (puede ser null si no existe)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene intentos fallidos recientes (últimos 30 minutos)
     */
    public static function getRecentFailedAttempts($email, $minutes = 30)
    {
        return self::where('email', $email)
                   ->where('is_successful', false)
                   ->where('attempted_at', '>=', now()->subMinutes($minutes))
                   ->orderBy('attempted_at', 'desc')
                   ->get();
    }
}