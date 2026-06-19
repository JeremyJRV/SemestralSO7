<?php

namespace App\Exceptions;

use Exception;

class InsufficientPermissionsException extends Exception
{
    public function __construct($message = 'Permisos insuficientes', $code = 0)
    {
        parent::__construct($message, $code);
    }
}