<?php

namespace App\Listeners;

use App\Events\TaskProcessed;
use App\Events\TaskRemindedEvent;
use App\Jobs\TaskRemindJob;
use App\Notifications\TaskRemindNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakeTaskRemindJob
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
    public function handle(TaskRemindedEvent $event): void
    {
        TaskRemindJob::dispatch($event->task);
    }
}
