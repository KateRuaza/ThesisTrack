<?php

namespace App\Jobs;

use App\Mail\FirstWarningDueDate;
use App\Mail\LastWarningDueDate;
use App\Models\Borrower;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class NotifyDueBorrowersJob implements ShouldQueue
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
        $borrowersFirstWarning = Borrower::whereDate('created_at', Carbon::now()->subDays(6))
            ->whereNotIn('status', ['returned', 'late'])
            ->whereNull('first_warning')
            ->get();

        $borrowerslastWarning = Borrower::whereDate('created_at', Carbon::now()->subDays(7))
            ->whereNotIn('status', ['returned', 'late'])
            ->where('first_warning', true)
            ->whereNull('last_warning')
            ->get();

        $this->sendWarning($borrowersFirstWarning, 'first');
        $this->sendWarning($borrowerslastWarning, 'last');
    }

    private function sendWarning(Collection $borrowers, string $type)
    {
        foreach ($borrowers as $borrower) {

            if ($type === 'first') {
                Mail::to($borrower->email)->send(new FirstWarningDueDate($borrower));
                $borrower->first_warning = true;
            } elseif ($type === 'last') {
                Mail::to($borrower->email)->send(new LastWarningDueDate($borrower));
                $borrower->last_warning = true;
            }

            $borrower->save();
        }
    }
}
