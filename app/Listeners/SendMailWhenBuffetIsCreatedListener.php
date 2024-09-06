<?php

namespace App\Listeners;

use App\Events\BuffetCreatedEvent;
use App\Notifications\BuffetCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendMailWhenBuffetIsCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BuffetCreatedEvent $event): void
    {
        $user = $event->buffet->owner;
        if($user) {
            Notification::send($user, new BuffetCreatedNotification($event->buffet, $event->subscription, $event->buffet_subscription));
        }
    }
}
