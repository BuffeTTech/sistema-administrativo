<?php

namespace App\Listeners;

use App\Events\CreateRoleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCommercialRoleListener
{
    public function __construct() {}

    public function handle(CreateRoleEvent $event): void
    {
        // Enviar para o outro sistema
    }
}
