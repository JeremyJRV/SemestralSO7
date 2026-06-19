<?php

namespace App\Exceptions;

use Exception;

class AccountLockedException extends Exception
{
    public function __construct($message = 'Cuenta bloqueada', $code = 0)
    {
        parent::__construct($message, $code);
    }
}