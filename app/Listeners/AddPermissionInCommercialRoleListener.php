<?php

namespace App\Listeners;

use App\Enums\SystemEnum;
use App\Events\AddPermissionInRoleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddPermissionInCommercialRoleListener
{
    public function __construct() {}

    public function handle(AddPermissionInRoleEvent $event): void
    {
        if($event->permission->system === SystemEnum::COMMERCIAL->name) {

            // Enviar para o outro sistema
        }
    }
}
