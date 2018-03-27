<?php

namespace App\Listeners;

use App\Events\ClientAcquisitionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientAcquisitionEventListener
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
     * @param  ClientAcquisitionEvent  $event
     * @return void
     */
    public function handle(ClientAcquisitionEvent $event)
    {
        return $event;
    }
}
