<?php

namespace App\Listeners;

use App\Events\ClientCallEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientCallEventListener
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
     * @param  ClientCallEvent  $event
     * @return void
     */
    public function handle(ClientCallEvent $event)
    {
        return $event;
    }
}
