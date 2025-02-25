<?php
namespace App\Application\DTO;

use JsonSerializable;

class UserResponseDTO implements JsonSerializable {
    private string $id;
    private string $name;
    private string $email;

    public function __construct(string $id, string $name, string $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    
   public function jsonSerialize():mixed {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email
        ];
    }
}
