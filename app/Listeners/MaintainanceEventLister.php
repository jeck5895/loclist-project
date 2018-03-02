<?php

namespace App\Listeners;

use App\Events\MaintainanceEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MaintainanceEventLister
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
     * @param  MaintainanceEvent  $event
     * @return void
     */
    public function handle(MaintainanceEvent $event)
    {
        return $event;
    }
}
