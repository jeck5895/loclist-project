<?php

namespace App\Listeners;

use App\Events\ClientSubrecordEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientSubrecordEventListener
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
     * @param  ClientSubrecordEvent  $event
     * @return void
     */
    public function handle(ClientSubrecordEvent $event)
    {
        return $event;
    }
}
