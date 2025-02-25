<?php

namespace App\Application\UseCase;

use App\Domain\Entities\User;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\ValueObjects\UserId;
use App\Domain\ValueObjects\Name;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use App\Domain\Events\UserRegisteredEvent;
use App\Domain\Events\EventHandlerInterface;
use App\Infrastructure\EventsHandler\SendWelcomeEmailHandler;
use App\Application\DTO\RegisterUserRequest;


class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private SendWelcomeEmailHandler $emailHandler;

    public function __construct(UserRepositoryInterface $userRepository, EventHandlerInterface $emailHandler)
    {
        $this->userRepository = $userRepository;
        $this->emailHandler = $emailHandler;
    }

    public function save(RegisterUserRequest $request): User
    {
        if ($this->userRepository->findByEmail(new Email($request->email()))) {
            throw new \Exception("Este correo ya está en uso");
        }

        $user = new User(
            new UserId(),
            new Name($request->name()),
            new Email($request->email()),
            new Password($request->password())
        );

        $this->userRepository->save($user);

        $event = new UserRegisteredEvent($user);
        $this->emailHandler->handle($event);

        return $user;
    }
}