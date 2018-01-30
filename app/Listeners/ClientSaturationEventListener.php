<?php

namespace App\Listeners;

use App\Events\ClientSaturationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientSaturationEventListener
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
     * @param  ClientSaturationEvent  $event
     * @return void
     */
    public function handle(ClientSaturationEvent $event)
    {
        return $event;
    }
}
