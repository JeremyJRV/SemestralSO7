<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo UserLevel
 * Registra la progresión de cada usuario en cada tema y nivel
 */
class UserLevel extends Model
{
    use HasFactory;

    protected $table = 'user_levels';

    protected $fillable = [
        'user_id',
        'theme_id',
        'level_id',
        'points',
        'attempts',
        'passed_at',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'passed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Un registro pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un registro pertenece a un tema
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Relación: Un registro pertenece a un nivel
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}