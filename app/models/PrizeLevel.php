<?php
namespace App\Models;

use clases\Model;

class PrizeLevel extends Model
{
    protected static string $table = 'prize_levels';
    protected static string $primaryKey = 'prize_id'; // compuesto, pero para consultas simples usamos así.
}
/*Comentario del asistente:
Dado que el método syncLevels() dentro de Prize.php ya 
maneja la sincronización mediante SQL nativo de forma limpia y segura, 
el archivo PrizeLevel.php queda como código huérfano que no se utiliza o que es peligroso 
utilizar bajo el ORM actual. Es recomendable eliminarlo o ampliar la clase base Model.php para 
soportar explícitamente claves primarias compuestas.*/