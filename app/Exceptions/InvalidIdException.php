<?php

namespace App\Exceptions;

use Exception;

class InvalidIdException extends Exception
{
    public string $errorCode;

    public function __construct(
        string $errorCode,
        string $message
    ) {
        $this->errorCode = $errorCode;

        parent::__construct($message);
    }
}