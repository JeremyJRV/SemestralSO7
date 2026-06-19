<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo Theme
 * Representa los temas: PHP, JavaScript, Laravel
 */
class Theme extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'icon_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Un tema tiene muchas preguntas
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Relación: Un tema tiene muchos niveles
     */
    public function levels()
    {
        return $this->belongsToMany(Level::class, 'theme_level')
                    ->withTimestamps();
    }

    /**
     * Relación: Un tema tiene muchas calificaciones de usuarios
     */
    public function userRatings()
    {
        return $this->hasMany(UserThemeRating::class);
    }

    /**
     * Obtiene el promedio de calificación del tema
     */
    public function getAverageRating(): float
    {
        return $this->userRatings()->avg('rating') ?? 0;
    }

    /**
     * Obtiene el total de veces que se jugó el tema
     */
    public function getTotalPlays(): int
    {
        return $this->userRatings()->count();
    }
}