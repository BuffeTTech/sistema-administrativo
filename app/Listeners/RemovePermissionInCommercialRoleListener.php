<?php

namespace App\Listeners;

use App\Enums\SystemEnum;
use App\Events\RemovePermissionInRoleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemovePermissionInCommercialRoleListener
{
    public function __construct() {}

    public function handle(RemovePermissionInRoleEvent $event): void
    {
        if($event->permission->system === SystemEnum::COMMERCIAL->name) {

            // Enviar para o outro sistema
        }
    }
}
