<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Level
 * Representa los niveles: Básico, Intermedio, Avanzado
 */
class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Un nivel pertenece a muchos temas
     */
    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'theme_level')
                    ->withTimestamps();
    }

    /**
     * Relación: Un nivel tiene muchas preguntas
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Relación: Un nivel tiene muchos premios asociados
     */
    public function prizes()
    {
        return $this->belongsToMany(Prize::class, 'level_prize')
                    ->withTimestamps();
    }
}