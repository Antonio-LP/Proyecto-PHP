<?php
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Domain\ValueObjects\UserId;

$userRepository = DoctrineUserRepository::getInstance();

return [
    'DELETE' => [
        '/user' => function ()use($userRepository) {
    
            $userId = $_GET['id'] ?? null;
            if (!$userId) {
                http_response_code(400);
                echo json_encode(['error' => 'User ID is required']);
                return;
            }
            try {
                $userRepository->delete(new UserId($userId));
                echo json_encode(['message' => 'User deleted successfully']);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    ]
];