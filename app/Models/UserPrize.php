<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo UserPrize
 * Tabla pivote que registra qué premios ha obtenido cada usuario
 */
class UserPrize extends Model
{
    use HasFactory;

    protected $table = 'user_prizes';

    protected $fillable = [
        'user_id',
        'prize_id',
        'obtained_at',
    ];

    protected $casts = [
        'obtained_at' => 'datetime',
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
     * Relación: Un registro pertenece a un premio
     */
    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }
}