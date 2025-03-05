<?php

namespace App\Mail;

use App\Models\Borrower;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LastWarningDueDate extends Mailable
{
    use Queueable, SerializesModels;

    public $borrower;

    /**
     * Create a new message instance.
     */
    public function __construct(Borrower $borrower)
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
            subject: 'Warning: Today Is The Due Date for Your Borrowed Thesis',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.last-warning',
        );
    }
}
