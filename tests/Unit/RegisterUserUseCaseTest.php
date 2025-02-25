<?php 

use PHPUnit\Framework\TestCase;
use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Entities\User;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use App\Domain\ValueObjects\UserId;
use App\Domain\ValueObjects\Name;
use App\Infrastructure\EventsHandler\SendWelcomeEmailHandler;

class RegisterUserUseCaseTest extends TestCase
{
    public function testRegisterUserSuccessfully(): void
    {
        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $userRepositoryMock->method('findByEmail')->willReturn(null);
        $userRepositoryMock->expects($this->once())->method('save');

        $emailHandlerMock = $this->createMock(SendWelcomeEmailHandler::class);

        $useCase = new RegisterUserUseCase($userRepositoryMock,$emailHandlerMock);
        $request = new RegisterUserRequest("John Doe", "johndoe@example.com", "Str0ng@Pass");

        $useCase->save($request);

        $this->assertTrue(true); 
    }

    public function testRegisterUserFailsIfEmailExists(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Este correo ya está en uso");

        $existingUser = new User(
            new UserId(),
            new Name("John Doe"),
            new Email("johndoe@example.com"),
            new Password("Str0ng@Pass")
        );

        $userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $userRepositoryMock->method('findByEmail')->willReturn($existingUser);

        $emailHandlerMock = $this->createMock(SendWelcomeEmailHandler::class);

        $useCase = new RegisterUserUseCase($userRepositoryMock, $emailHandlerMock);
        $request = new RegisterUserRequest("John Doe", "johndoe@example.com", "Str0ng@Pass");

        $useCase->save($request);
    }
}
