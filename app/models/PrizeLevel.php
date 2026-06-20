<?php
namespace App\Models;

use clases\Model;

class PrizeLevel extends Model
{
    protected static string $table = 'prize_levels';
    protected static string $primaryKey = 'prize_id'; // compuesto, pero para consultas simples usamos así.
}