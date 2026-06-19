<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo UserThemeRating
 * Registra las calificaciones "Me gusta" de los usuarios para cada tema
 * Valores: 1 (Aburrido), 2 (Interesante), 3 (Genial)
 */
class UserThemeRating extends Model
{
    use HasFactory;

    protected $table = 'user_theme_ratings';

    protected $fillable = [
        'user_id',
        'theme_id',
        'rating', // 1, 2, 3
        'rated_at',
    ];

    protected $casts = [
        'rated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Una calificación pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Una calificación pertenece a un tema
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}