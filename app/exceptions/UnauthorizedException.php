<?php
namespace App\Exceptions;

class UnauthorizedException extends \Exception
{
    protected $message = 'Debes iniciar sesión para acceder.';
    protected $code = 401;
}