<?php

namespace App\Listeners;

use App\Jobs\TaskFailedJob;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyFailedTaskListener
{
    /**
     * Create the event listener.
     */
    public function __construct(public Task $task)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        TaskFailedJob::dispatch($event->task);
    }
}
