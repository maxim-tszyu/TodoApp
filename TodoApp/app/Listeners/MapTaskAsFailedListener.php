<?php

namespace App\Listeners;

use App\Jobs\MapTaskAsFailedJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MapTaskAsFailedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        MapTaskAsFailedJob::dispatch($event->task);
    }
}
