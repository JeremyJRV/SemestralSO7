<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo Prize
 * Representa los premios que se otorgan al completar niveles
 */
class Prize extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'points_value',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación: Un premio pertenece a muchos usuarios
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_prizes')
                    ->withTimestamps();
    }

    /**
     * Relación: Un premio pertenece a muchos niveles
     */
    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_prize')
                    ->withTimestamps();
    }
}