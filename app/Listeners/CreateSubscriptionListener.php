<?php

namespace App\Listeners;

use App\Events\SubscriptionCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateSubscriptionListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SubscriptionCreatedEvent $event): void
    {
        // Enviar os dados para o outro sistema
        //$event->subscription contém os dados do plano criado
    }
}
