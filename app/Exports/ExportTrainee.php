<?php
namespace App\Exports;
use App\Models\Trainee;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportTrainee implements FromCollection, WithHeadings 
{
    protected $academy_id;
    protected $cohort_id;

    public function __construct($academy_id, $cohort_id)
    {
        $this->academy_id = $academy_id;
        $this->cohort_id = $cohort_id;
    }

    public function collection()
    {
        return Trainee::where('academy_id', $this->academy_id)
                      ->where('cohort_id', $this->cohort_id)
                      ->get();
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
