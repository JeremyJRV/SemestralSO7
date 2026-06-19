<?php

namespace App\Traits;

/**
 * HasApiResponse
 * Proporciona métodos estandarizados para respuestas JSON
 */
trait HasApiResponse
{
    /**
     * Respuesta de éxito
     */
    public function successResponse($data = null, $message = 'Operación exitosa', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Respuesta de error
     */
    public function errorResponse($message = 'Error en la operación', $code = 400, $errors = null)
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

    /**
     * Respuesta no autorizada
     */
    public function unauthorizedResponse($message = 'No autorizado')
    {
        return $this->errorResponse($message, 401);
    }

    /**
     * Respuesta prohibida
     */
    public function forbiddenResponse($message = 'Prohibido')
    {
        return $this->errorResponse($message, 403);
    }

    /**
     * Respuesta no encontrada
     */
    public function notFoundResponse($message = 'Recurso no encontrado')
    {
        return $this->errorResponse($message, 404);
    }
}