<?php

namespace App\Listeners;

use App\Events\ClientPresentationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientPresentationEventListener
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
     * @param  ClientPresentationEvent  $event
     * @return void
     */
    public function handle(ClientPresentationEvent $event)
    {
        return $event;
    }
}
