<?php

namespace App\Listeners;

use App\Enums\SystemEnum;
use App\Events\CreateRoleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CreateCommercialRoleListener
{
    public function __construct() {}

    public function handle(CreateRoleEvent $event): void
    {
        // Enviar para o outro sistema
        if($event->role->system === SystemEnum::COMMERCIAL->name) {
            $response = Http::acceptJson()->post(config('app.commercial_url').'/api/subscription/role', ['role'=>$event->role]);
        }
    }
}
