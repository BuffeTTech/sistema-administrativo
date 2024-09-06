<?php

namespace App\Listeners;

use App\Events\CreateManyPermissionsAndRolesEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CreateManyPermissionsAndRolesInCommercialListener
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
    public function handle(CreateManyPermissionsAndRolesEvent $event): void
    {
        $response = Http::acceptJson()->post(config('app.commercial_url').'/api/subscription/permission/many', ['data'=>$event->data]);
        // if($response->created()){
        //     dd($response->body());
        // } else {
        //     dd($response);
        // }
    }
}
