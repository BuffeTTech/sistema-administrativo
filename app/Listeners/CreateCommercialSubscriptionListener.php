<?php

namespace App\Listeners;

use App\Enums\SystemEnum;
use App\Events\SubscriptionCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CreateCommercialSubscriptionListener
{
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(SubscriptionCreatedEvent $event): void
    {
        // Enviar os dados para o outro sistema
        $response = Http::acceptJson()->post(config('app.commercial_url').'/api/subscription', ['subscription'=>$event->subscription, 'configuration'=>$event->configuration]);
        // if($response->ok()) {
        // }
        // Enviar para o outro sistema
        //$event->subscription contém os dados do plano criado  
    }
}
