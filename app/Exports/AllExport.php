<?php

namespace App\Exports;

use App\Models\Trainee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class AllExport implements FromCollection, WithHeadings
{

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Trainee::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'email',
            'mobile',
            'graduated',
            'certificat_type',
            'nationality',
            'country',
            'passport_number',
            'national_id',
            'birthdate',
            'first_name',
            'second_name',
            'third_name',
            'last_name',
            'ar_first_name',
            'ar_second_name',
            'ar_third_name',
            'ar_last_name',
            'gender',
            'martial_status',
            'education',
            'educational_status',
            'field',
            'educational_background',
            'city',
            'address',
            'id_img',
            'academy_id',
            'cohort_id',
            'personal_img',
            'vaccination_img',
            'git_hub',
            'linkedin',
            'employment_status',
            'internship_status',
            'stack',
            'trainee_cv',
            'created_at',
            'updated_at',
            
        ];
    }

  
}
