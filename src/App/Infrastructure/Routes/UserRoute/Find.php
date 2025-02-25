<?php
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Domain\ValueObjects\UserId;
use App\Application\DTO\UserResponseDTO;


$userRepository = DoctrineUserRepository::getInstance();

return [
    'GET' => [
        '/user' => function () use($userRepository) {
            
            $userId = $_GET['id'] ?? null;
            if (!$userId) {
                http_response_code(400);
                echo json_encode(['error' => 'User ID is required']);
                return;
            }
            try {
                $user = $userRepository->findById(new UserId($userId));
                
                echo $user->getId();
                $userResDTO = new UserResponseDTO(
                    $user->getId(),
                    $user->getName(),
                    $user->getEmail());

                echo json_encode($userResDTO);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    ]
];