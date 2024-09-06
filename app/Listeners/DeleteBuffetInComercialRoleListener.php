<?php

namespace App\Listeners;

use App\Events\DeleteBuffetEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class DeleteBuffetInComercialRoleListener
{
    public function __construct()
    {
    }

    public function handle(DeleteBuffetEvent $event): void
    {
        $buffet = $event->buffet;

        try {

            $response = Http::acceptJson()->delete(config('app.commercial_url').'/api/buffet/'.$buffet->slug, ['buffet'=>$buffet]);
            dd($response->body());
        } catch (\Illuminate\Http\Client\RequestException $e) {
            $response = $e->response;

            $statusCode = $response->status();
            $errorMessage = $response->json()['error'] ?? 'Erro desconhecido';
            dd($errorMessage);
        }
    }
}
