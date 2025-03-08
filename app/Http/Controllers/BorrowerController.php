<?php

namespace App\Http\Controllers;

use App\Exports\BorrowersExport;
use App\Http\Requests\StoreBorrowerRequest;
use App\Models\Borrower;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterName = $request->input('filterName');
        $filterStartMonth = $request->input('filterStartMonth');
        $filterEndMonth = $request->input('filterEndMonth');

        $borrowers = Borrower::when($filterName, function ($query) use ($filterName) {
            $query->where('name', 'like', '%'.$filterName.'%');
        })
        ->when($filterStartMonth, function ($query) use ($filterStartMonth) {
            $query->where('created_at', '>=', $filterStartMonth);
        })
        ->when($filterEndMonth, function ($query) use ($filterEndMonth) {
            $query->where('created_at', '<=', $filterEndMonth);
        })
        ->paginate(10);

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
        $borrower = Borrower::findOrFail($id);

        return inertia('Admin/BorrowerDetails', compact('borrower'));
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

    public function export(Request $request)
    {
        $filterName = $request->input('filterName');
        $filterStartMonth = $request->input('filterStartMonth');
        $filterEndMonth = $request->input('filterEndMonth');

        return Excel::download(new BorrowersExport($filterName, $filterStartMonth, $filterEndMonth), 'borrowers.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv',]);
    }
}
