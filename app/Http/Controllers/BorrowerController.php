<?php

namespace App\Http\Controllers;

use App\Events\DueDateApproaching;
use App\Http\Requests\StoreBorrowerRequest;
use App\Models\Borrower;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowers = Borrower::paginate(10);

        return inertia('Admin/BorrowerRecord', compact('borrowers'));
    }

    public function create()
    {
        return inertia('Admin/BorrowerForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowerRequest $request)
    {
        Borrower::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:active,returned,not_returned,late',
        ]);

        $borrower = Borrower::findOrFail($id);

        if ($request->status === 'returned') {
            $borrower->status = $borrower->created_at->diffInDays(now()) > 7 ? 'late' : 'returned';
        } else {
            $borrower->status = $request->status;
        }

        $borrower->returned_at = now();
        $borrower->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function notify()
    {
        $borrowers = Borrower::whereDate('created_at', Carbon::now()->subDays(6))
            ->whereNotIn('status', ['returned', 'late'])
            ->get();

        DueDateApproaching::dispatch($borrowers);
    }

}
