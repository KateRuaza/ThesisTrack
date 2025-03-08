<?php

namespace App\Exports;

use App\Models\Borrower;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BorrowersExport implements FromView, ShouldAutoSize, WithHeadings
{
    public function __construct(private ?string $filterName, private ?string $filterStartMonth, private ?string $filterEndMonth)
    {

    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Contact #',
            'Address',
            'Thesis',
            'Borrowed',
            'Returned',
            'First Warning',
            'Last Warning',
            'Status'
        ];
    }

    public function view(): View
    {
        $borrowers = Borrower::when($this->filterName, function ($query) {
                $query->where('name', 'like', '%' . $this->filterName . '%');
            })
            ->when($this->filterStartMonth, function ($query) {
                $query->where('created_at', '>=', $this->filterStartMonth);
            })
            ->when($this->filterEndMonth, function ($query) {
                $query->where('created_at', '<=', $this->filterEndMonth);
            })
            ->get();

        return view('exports.borrowers', compact('borrowers'));
    }
}
