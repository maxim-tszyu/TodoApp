<?php

namespace App\Jobs;

use App\Models\Task;
use App\Notifications\TaskUnnoticedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class TaskUnnoticedJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Task $task)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->task->user, new TaskUnnoticedNotification($this->task));
    }
}
