<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * DateHelper
 * Helper para operaciones con fechas
 */
class DateHelper
{
    public static function formatearFecha($fecha, $formato = 'd/m/Y')
    {
        return Carbon::parse($fecha)->format($formato);
    }

    public static function tiempoTranscurrido($fecha)
    {
        return Carbon::parse($fecha)->diffForHumans();
    }

    public static function estaEntreFechas($fecha, $inicio, $fin)
    {
        $f = Carbon::parse($fecha);
        $i = Carbon::parse($inicio);
        $z = Carbon::parse($fin);

        return $f->between($i, $z);
    }

    public static function minutosTranscurridos($fecha)
    {
        return now()->diffInMinutes(Carbon::parse($fecha));
    }

    public static function segundosTranscurridos($fecha)
    {
        return now()->diffInSeconds(Carbon::parse($fecha));
    }
}