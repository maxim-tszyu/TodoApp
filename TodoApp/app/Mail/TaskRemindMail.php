<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class TaskRemindMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Task $task)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->task->title.' has 1 day left!',
            from: new Address(env('MAIL_USERNAME'), 'maxonthephp'),
            to: new Address($this->task->user->email),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.notification',
            with: ['task' => $this->task]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
