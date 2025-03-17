<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskUnnoticedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Task $task)
    {
        //
    }

    public function envelope()
    {
        $priorities = [
            'low' => '2 weeks',
            'medium' => 'a week',
            'high' => '3 days',
        ];
        return new Envelope(
            from: new Address(env('MAIL_USERNAME'), 'maxonthephp'),
            subject: $this->task->title . " has been unnoticed for {$priorities[$this->task->priority]}!",
            to: new Address($this->task->user->email, $this->task->user->email)
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.notification_unnoticed',
            with: ['task' => $this->task]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
