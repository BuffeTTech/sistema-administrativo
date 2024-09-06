<?php

namespace App\Listeners;

use App\Events\BuffetCreatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CreateCommercialUserWhenBuffetIsCreatedListener
{
    public function __construct()
    {
    }

    public function handle(BuffetCreatedEvent $event): void
    {
        // $user = User::where('id', $event->buffet->owner_id)->with('user_address', 'user_phone1')->get()->first();
        // $user['address'] = $user->user_address ?? null;
        // $user['phone1'] = $user->user_phone1 ?? null;
        // $user['phone2'] = $user->user_phone2 ?? null;

        // if($user->isBuffet() && $user->buffets->count() == 1) {
        //     // Se for 1 é pq acabou de cadastrar e o usuario nao tem conta no outro sistema

        //     $response = Http::acceptJson()->post(config('app.commercial_url').'/api/buffet/user', ['user'=>$user]);

        // }

    }
}
