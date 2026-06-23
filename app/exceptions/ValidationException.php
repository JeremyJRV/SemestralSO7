<?php
namespace App\Exceptions;

class ValidationException extends \Exception
{
    protected $message = 'Error de validación.';
    protected $code = 422;

    private array $errors;

    public function __construct(array $errors, string $message = '')
    {
        parent::__construct($message ?: $this->message, $this->code);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}