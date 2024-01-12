<?php

namespace App\Listeners;

use App\Enums\SystemEnum;
use App\Events\AddPermissionInRoleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class AddPermissionInCommercialRoleListener
{
    public function __construct() {}

    public function handle(AddPermissionInRoleEvent $event): void
    {
        if($event->permission->system === SystemEnum::COMMERCIAL->name) {
            $response = Http::acceptJson()->post(config('app.commercial_url').'/api/subscription/permission/'.$event->permission->name, ['roles'=>[$event->role], 'permission'=>$event->permission]);
            // if($response->ok()) {
            // }
            // // Enviar para o outro sistema
        }
    }
}
