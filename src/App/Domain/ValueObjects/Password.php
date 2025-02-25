<?php

namespace App\Domain\ValueObjects;

use App\Domain\Exceptions\WeakPasswordException;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Password
{
    #[ORM\Column(type: 'string')]
    private string $hash;

    public function __construct(string $password)
    {
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            throw new WeakPasswordException('La contraseña es demasiado débil.');
        }

        $this->hash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hash);
    }

    public function getValue(): string
    {
        return $this->hash;
    }

    public function __toString(): string
    {
        return $this->hash;
    }
}
