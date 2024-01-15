<?php

namespace App\Listeners;

use App\Events\BuffetCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CreateBuffetInCommercialListener
{
    public function __construct()
    {
    }

    public function handle(BuffetCreatedEvent $event): void
    {
        // cadastrar o buffet no outro sistema
        $buffet = $event->buffet;
        $buffet['address'] = $event->buffet->buffet_address ?? null;
        $buffet['phone1'] = $event->buffet->buffet_phone1 ?? null;
        $buffet['phone2'] = $event->buffet->buffet_phone2 ?? null;
        
        $user = $event->buffet->owner;
        $user['address'] = $user->user_address ?? null;
        $user['phone1'] = $user->user_phone1 ?? null;
        $user['phone2'] = $user->user_phone2 ?? null;
        $user->makeVisible(['password']);
        try {

            $response = Http::acceptJson()->post(config('app.commercial_url').'/api/buffet', ['subscription'=>$event->subscription, 'buffet'=>$event->buffet, 'buffet_subscription'=>$event->buffet_subscription, 'user'=>$user]);
            dd($response->body());
        } catch (\Illuminate\Http\Client\RequestException $e) {
            $response = $e->response;

            $statusCode = $response->status();
            $errorMessage = $response->json()['error'] ?? 'Erro desconhecido';
        } finally {
            $user->makeHidden(['password']);
        }

    }
}
