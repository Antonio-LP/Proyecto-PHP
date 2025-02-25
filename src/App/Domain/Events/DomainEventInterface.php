<?php 
namespace App\Domain\Events;

interface DomainEventInterface
{
    public function occurredOn(): \DateTimeImmutable;
}
