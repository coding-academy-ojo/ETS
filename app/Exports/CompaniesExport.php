<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CompaniesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::where('type_of_deal', 1)
        ->select( 'company_name','company_email', 'created_at', 'updated_at')
        ->get();
    }

    public function headings(): array
    {
        return [
            'company_name',
            'company_email',
            'Creation Date',
            'Update Date',
        ];
    }
}
