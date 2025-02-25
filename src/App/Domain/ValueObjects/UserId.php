<?php
namespace App\Domain\ValueObjects;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class UserId {

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $value;
    
    public function __construct(string $value = null) {
        $this->value = $value ?? bin2hex(random_bytes(16));
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}