<?php

namespace App\Listeners;

use App\Enums\SystemEnum;
use App\Events\RemovePermissionInRoleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class RemovePermissionInCommercialRoleListener
{
    public function __construct() {}

    public function handle(RemovePermissionInRoleEvent $event): void
    {
        if($event->permission->system === SystemEnum::COMMERCIAL->name) {
            $response = Http::acceptJson()->delete(config('app.commercial_url').'/api/subscription/permission/'.$event->permission->name, ['role'=>$event->role, 'permission'=>$event->permission]);
            dd($response->body());
            // if($response->ok()) {
            // }
            // // Enviar para o outro sistema
        }
    }
}
