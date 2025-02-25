<?php
namespace App\Domain\ValueObjects;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Name
{
    #[ORM\Column(type: 'string', length: 255)]
    private string $value;

    private const MIN_LENGTH = 2;

    private const ALLOWED_CHARACTERS = '/^[a-zA-Z\s\-\'áéíóúÁÉÍÓÚñÑ]+$/';

    public function __construct(string $value)
    {
        if (strlen($value) < self::MIN_LENGTH) {
            throw new \InvalidArgumentException(
                sprintf('El nombre debe tener al menos %d caracteres.', self::MIN_LENGTH)
            );
        }

        if (!preg_match(self::ALLOWED_CHARACTERS, $value)) {
            throw new \InvalidArgumentException(
                'El nombre contiene caracteres no permitidos.'
            );
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
