<?php

namespace App\Providers;

use App\Events\AddPermissionInRoleEvent;
use App\Events\BuffetCreatedEvent;
use App\Events\CreateRoleEvent;
use App\Events\DeleteBuffetEvent;
use App\Events\EditBuffetEvent;
use App\Events\RemovePermissionInRoleEvent;
use App\Events\SubscriptionCreatedEvent;
use App\Listeners\AddPermissionInCommercialRoleListener;
use App\Listeners\CreateBuffetInCommercialListener;
use App\Listeners\CreateCommercialRoleListener;
use App\Listeners\CreateCommercialSubscriptionListener;
use App\Listeners\CreateCommercialUserWhenBuffetIsCreatedListener;
use App\Listeners\CreateRolesAfterSubscriptionListener;
use App\Listeners\DeleteBuffetInComercialRoleListener;
use App\Listeners\EditBuffetInCommercialListener;
use App\Listeners\RemovePermissionInCommercialRoleListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        SubscriptionCreatedEvent::class => [
            CreateCommercialSubscriptionListener::class,
            CreateRolesAfterSubscriptionListener::class
        ],

        CreateRoleEvent::class => [
            CreateCommercialRoleListener::class
        ],

        AddPermissionInRoleEvent::class => [
            AddPermissionInCommercialRoleListener::class
        ],

        RemovePermissionInRoleEvent::class => [
            RemovePermissionInCommercialRoleListener::class
        ],
        BuffetCreatedEvent::class => [
            CreateBuffetInCommercialListener::class,
            CreateCommercialUserWhenBuffetIsCreatedListener::class
        ],
        EditBuffetEvent::class => [
            EditBuffetInCommercialListener::class
        ],
        DeleteBuffetEvent::class => [
            DeleteBuffetInComercialRoleListener::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
