<?php

namespace App\Helpers;

/**
 * ResponseHelper
 * Helper para generar respuestas JSON estandarizadas
 */
class ResponseHelper
{
    public static function success($data = null, $message = 'Operación exitosa', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error($message = 'Error en la operación', $code = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    public static function notFound($message = 'Recurso no encontrado')
    {
        return self::error($message, 404);
    }

    public static function unauthorized($message = 'No autorizado')
    {
        return self::error($message, 401);
    }

    public static function forbidden($message = 'Prohibido')
    {
        return self::error($message, 403);
    }
}