<?php

namespace App\Exports;

use App\Models\EmploymentLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportLog implements FromCollection, WithHeadings
{
    protected $logs;
    

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        // Return the logs collection

        return $this->logs;

    }

    public function headings(): array
    {
        // Define the headings for your exported Excel file
        return [
            'ID',
            'Employee Status',
            'Company',
            'Position',
            'Start Date',
            'End Date',
            'Academy Id',
            'Cohort Id',
            'Trainee Id',
            'Created By',
            'Created At',
            'Updated At',
        ];
    }
}
