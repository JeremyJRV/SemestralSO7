<?php
namespace App\Exceptions;

class AccountLockedException extends \Exception
{
    protected $message = 'Cuenta bloqueada temporalmente por múltiples intentos fallidos.';
    protected $code = 423; // HTTP 423 Locked
}