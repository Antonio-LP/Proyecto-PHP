<?php
use App\Infrastructure\Controllers\RegisterUserController;
use App\Application\UseCase\RegisterUserUseCase;
use App\Infrastructure\EventsHandler\SendWelcomeEmailHandler;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Application\DTO\UserResponseDTO;

$userRepository = DoctrineUserRepository::getInstance();

$eventHandler = new SendWelcomeEmailHandler();
$registerUserUseCase = new RegisterUserUseCase($userRepository, $eventHandler);
$registerUserController = new RegisterUserController($registerUserUseCase);

return [
    'POST' => [
        '/user' => function () use ($registerUserController) {
            $requestData = json_decode(file_get_contents('php://input'), true);

            if (!isset($requestData['name'], $requestData['email'], $requestData['password'])) {
                http_response_code(400);
                echo json_encode(['error' => '']);
                return;
            }

            try {
                $userResponse = $registerUserController->register($requestData);
                $userDTORes = new UserResponseDTO(
                    $userResponse->getId(),
                    $userResponse->getName(),
                    $userResponse->getEmail());

                echo json_encode($userDTORes);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    ]
];