<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Mail\TaskFailedMail;
use App\Mail\TaskRemindMail;

class TaskFailedNotification extends Notification implements ShouldQueue
{
    use Queueable;


    public function __construct(public $task)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): TaskRemindMail
    {
        return (new TaskFailedMail($this->task));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task' => $this->task->id,
            'date' => now()
        ];
    }
}
