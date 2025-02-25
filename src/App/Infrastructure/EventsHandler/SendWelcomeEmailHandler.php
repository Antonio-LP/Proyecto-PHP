<?php

namespace App\Infrastructure\EventsHandler;

use App\Domain\Events\EventHandlerInterface;
use App\Domain\Events\DomainEventInterface;

class SendWelcomeEmailHandler implements EventHandlerInterface
{
    public function handle(DomainEventInterface $event): void
    {
        $user = $event->user();
        
        $email = $user->getEmail();
        
        echo "\nEnviando email de bienvenida a {$email}...\n";
        
        sleep(2);
        
        echo "Email enviado con éxito a {$email}!\n";
    }
}
