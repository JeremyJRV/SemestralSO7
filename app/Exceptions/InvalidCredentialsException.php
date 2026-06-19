<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function __construct($message = 'Credenciales inválidas', $code = 0)
    {
        parent::__construct($message, $code);
    }
}