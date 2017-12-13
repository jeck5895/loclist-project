<?php

namespace App\Listeners;

use App\Events\ClientEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientEventListener
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
     * @param  ClientEvent  $event
     * @return void
     */
    public function handle(ClientEvent $event)
    {
        return $event;
    }
}
