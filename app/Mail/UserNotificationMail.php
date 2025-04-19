<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public function __construct(User $user)
    {
        $this->name = $user->name;
    }

    public function envelope(): Envelope
    {
        echo 'envelop';
        return new Envelope(
            subject: "Test Mail {$this->name}",
        );
    }

    /**
     * Get the message content definition.
     */

    public function content(): Content
    {
        echo 'content';
        return new Content(
            view: 'emails.welcome',
            with:[
                'name' => $this->name,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

}
