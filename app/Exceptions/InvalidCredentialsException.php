<?php
namespace App\Exceptions;

class InvalidCredentialsException extends \Exception
{
    protected $message = 'Credenciales inválidas.';
    protected $code = 401;
}