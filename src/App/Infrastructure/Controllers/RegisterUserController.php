<?php
namespace App\Infrastructure\Controllers;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\Entities\User;


class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function register(array $data): User
    {

        if (!isset($data['name'], $data['email'], $data['password'])) {
            $this->sendResponse(400, ["error" => "Faltan campos"]);
            throw new \InvalidArgumentException("Faltan campos requeridos.");
        }

        try {
            $data=$this->registerUserUseCase->save(new RegisterUserRequest(
                $data['name'],
                $data['email'],
                $data['password']
            ));
            $this->sendResponse(201, ["message" => "Usuario registrado"]);
            return $data;
        } catch (\Exception $e) {
            throw new \RuntimeException("Error al registrar el usuario: " . $e->getMessage());
        }
    }

    private function sendResponse(int $statusCode, array $data): void
    {
        http_response_code($statusCode);
        echo json_encode($data);
    }
}