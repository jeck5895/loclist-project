<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ClientEvent' => [
            'App\Listeners\ClientEventListener',
        ],
        'App\Events\ClientCallEvent' => [
            'App\Listeners\ClientCallEventListener',
        ],
        'App\Events\ClientSaturationEvent' => [
            'App\Listeners\ClientSaturationEventListener',
        ],
        'App\Events\ClientPresentationEvent' => [
            'App\Listeners\ClientPresentationEventListener',
        ],
        'App\Events\ClientAcquisitionEvent' => [
            'App\Listeners\ClientAcquisitionEventListener',
        ],
        'App\Events\UserEvent' => [
            'App\Listeners\UserEventListener',
        ],
        'App\Events\MaintenanceEvent' => [
            'App\Listeners\MaintenanceEventLister',
        ],
        'App\Events\UpdateClientEvent' => [
            'App\Listeners\UpdateClientEventListener'
        ],
        'App\Events\ClientSubrecordEvent' => [
            'App\Listeners\ClientSubrecordEventListener'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
