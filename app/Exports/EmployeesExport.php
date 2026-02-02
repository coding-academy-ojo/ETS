<?php
namespace App\Exports;

use App\Models\Employer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employer::with('company')
    ->whereHas('company', function ($query) {
        $query->where('type_of_deal', 1);
    })
    ->get()
    ->map(function ($employee) {
        return [
            'name' => $employee->name,
            'email' => $employee->email,
            'company_name' => $employee->company->company_name ?? 'No Company',
            'company_id' => $employee->company->id ?? 'No Company',
        ];
    });

    }

    public function headings(): array
    {
        return [
            'name',
            'email',
            'company_name',
            'company_id',
        ];
    }
}
