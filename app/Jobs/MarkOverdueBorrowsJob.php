<?php

namespace App\Jobs;

use App\Models\Borrower;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MarkOverdueBorrowsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $borrowers = Borrower::where('status', 'active')
            ->where('first_warning', true)
            ->where('last_warning', true)
            ->whereDate('created_at', '<', Carbon::now()->subDays(7)) // Correct condition
            ->get();

        foreach ($borrowers as $borrower) {
            $borrower->status = 'not_returned';
            $borrower->save();
        }
    }
}
