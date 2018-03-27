<?php

namespace App\Listeners;

use App\Events\UpdateClientEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateClientEventListener
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
     * @param  UpdateClientEvent  $event
     * @return void
     */
    public function handle(UpdateClientEvent $event)
    {
        return $event;
    }
}
