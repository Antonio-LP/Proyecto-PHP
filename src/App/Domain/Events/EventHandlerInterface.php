<?php
namespace App\Domain\Events;

interface EventHandlerInterface
{
    public function handle(DomainEventInterface $event): void;
}
