<?php

namespace App\Jobs;

use App\Models\Task;
use App\Notifications\TaskFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class TaskFailedJob implements ShouldQueue
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
        Notification::send($this->task->user, new TaskFailedNotification($this->task));
    }
}
