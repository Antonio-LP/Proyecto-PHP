<?php
namespace App\Domain\Exceptions;

use DomainException;

class WeakPasswordException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            "La contraseña no cumple las medidas de seguridad." .
            "**Requisitos de la contraseña:**" .
            "- Mínimo 8 caracteres." .
            "- Al menos una letra mayúscula." .
            "- Al menos un número." .
            "- Al menos un carácter especial."
        );
    }
}