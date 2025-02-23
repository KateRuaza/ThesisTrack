<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeadlineEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $borrower;

    /**
     * Create a new message instance.
     */
    public function __construct($borrower)
    {
        $this->borrower = $borrower;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('thesistrack@email.com', 'ThesisTrack'),
            subject: 'Warning: Due Date Approaching for Your Borrowed Thesis',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.deadline',
        );
    }
}
