<?php

namespace App\Listeners;

use App\Events\BuffetCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateBuffetInCommercialListener
{
    public function __construct()
    {
    }

    public function handle(BuffetCreatedEvent $event): void
    {
        // cadastrar o buffet no outro sistema
    }
}
