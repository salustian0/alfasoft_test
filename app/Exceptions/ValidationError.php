<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\Validator;

class ValidationError extends Exception
{
    /**
     * @var Validator
     */
    protected $validator;

    public function __construct($message, $validator = null, $code = 0, Throwable $previous = null)
    {
        $this->validator = $validator;
        parent::__construct($message, $code, $previous);
    }

    public function getValidator() : Validator
    {
        return $this->validator;
    }
}
