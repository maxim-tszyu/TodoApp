<?php

namespace App\Listeners;

use App\Jobs\TaskDeleteJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InactiveTasksDelete
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
    public function handle(\App\Events\InactiveTasksDeleteEvent $event): void
    {
        TaskDeleteJob::dispatch($event->task);
    }
}
