<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapTaskAsFailedJob implements ShouldQueue
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
        if ($this->task->status != 'finished' && $this->task->status != 'abandoned') {
            $this->task->status = 'abandoned';
            $this->task->save();
        }
    }
}
