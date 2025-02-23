<?php

namespace App\Listeners;

use App\Events\DueDateApproaching;
use App\Mail\DeadlineEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendDueDateReminder implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DueDateApproaching $event): void
    {
        $borrowers = $event->borrowers;

        foreach ($borrowers as $borrower) {
            Mail::to($borrower->email)->send(new DeadlineEmail($borrower));
        }
    }
}
