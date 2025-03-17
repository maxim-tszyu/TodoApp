<?php

namespace App\Listeners;

use App\Jobs\TaskUnnoticedJob;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskUnnoticedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(public Task $task)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->task->priority === 'low' && now()->gte(Carbon::parse($event->task->updated_at)->addDays(3))){
            TaskUnnoticedJob::dispatch($event->task);
        }
        if ($event->task->priority === 'medium' && now()->gte(Carbon::parse($event->task->updated_at)->addDays(7))){
            TaskUnnoticedJob::dispatch($event->task);
        }
        if ($event->task->priority === 'high' && now()->gte(Carbon::parse($event->task->updated_at)->addDays(14))){
            TaskUnnoticedJob::dispatch($event->task);
        }
    }
}
