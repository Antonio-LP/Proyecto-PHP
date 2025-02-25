<?php

namespace App\Domain\Exceptions;

use InvalidArgumentException;

class InvalidEmailException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("El formato del email no es válido.");
    }
}
