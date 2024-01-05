<?php

namespace App\Listeners;

use App\Enums\SystemEnum;
use App\Events\CreateRoleEvent;
use App\Events\SubscriptionCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Role;

class CreateRolesAfterSubscriptionListener
{
    public function __construct(
        protected Role $role
    ) {}

    public function handle(SubscriptionCreatedEvent $event): void
    {
        $slug = $event->subscription->slug;

        $commercial = $this->role->create(['name' => $slug.'.commercial', 'system'=>SystemEnum::COMMERCIAL->name]);
        event(new CreateRoleEvent($commercial));

        $operational = $this->role->create(['name' => $slug.'.operational', 'system'=>SystemEnum::COMMERCIAL->name]);
        event(new CreateRoleEvent($operational));

        $administrative = $this->role->create(['name' => $slug.'.administrative', 'system'=>SystemEnum::COMMERCIAL->name]);
        event(new CreateRoleEvent($administrative));
    }
}
