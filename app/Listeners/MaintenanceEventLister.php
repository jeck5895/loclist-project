<?php

namespace App\Listeners;

use App\Events\MaintenanceEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MaintenanceEventLister
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MaintenanceEvent  $event
     * @return void
     */
    public function handle(MaintenanceEvent $event)
    {
        return $event;
    }
}
