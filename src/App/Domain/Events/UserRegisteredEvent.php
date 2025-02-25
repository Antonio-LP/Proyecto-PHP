<?php
namespace App\Domain\Events;

use App\Domain\Entities\User;
use DateTimeImmutable;


class UserRegisteredEvent implements DomainEventInterface
{
    private User $user;
    private DateTimeImmutable $occurredOn;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->occurredOn = new DateTimeImmutable();
    }

    public function user(): User
    {
        return $this->user;
    }

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
