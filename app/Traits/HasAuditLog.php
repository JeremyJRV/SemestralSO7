<?php

namespace App\Traits;

use App\Models\AuditLog;

/**
 * HasAuditLog
 * Registra automáticamente cambios en modelos
 */
trait HasAuditLog
{
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            self::registrarAudit('created', $model);
        });

        static::updated(function ($model) {
            self::registrarAudit('updated', $model);
        });

        static::deleted(function ($model) {
            self::registrarAudit('deleted', $model);
        });
    }

    private static function registrarAudit($accion, $modelo)
    {
        \Log::channel('auditoría')->info("$accion: " . class_basename($modelo) . " ID: {$modelo->id}");
    }
}