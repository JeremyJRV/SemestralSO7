<?php
namespace App\Exceptions;

class InsufficientPermissionsException extends \Exception
{
    protected $message = 'No tienes permisos para realizar esta acción.';
    protected $code = 403;
}