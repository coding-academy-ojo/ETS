<?php

namespace App\Imports;

use App\Models\Trainee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class TraineeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Trainee([
            'email' => $row['email'],
            'mobile' => $row['mobile'],
            'graduated' => $row['graduated'],
            'certificat_type' => $row['certificat_type'],
            'nationality' => $row['nationality'],
            'country' => $row['country'],
            'passport_number' => $row['passport_number'],
            'national_id' => $row['national_id'],
            'birthdate' => $this->parseBirthdate($row['birthdate']),            
            'first_name' => $row['first_name'],
            'second_name' => $row['second_name'],
            'third_name' => $row['third_name'],
            'last_name' => $row['last_name'],
            'ar_first_name' => $row['ar_first_name'],
            'ar_second_name' => $row['ar_second_name'],
            'ar_third_name' => $row['ar_third_name'],
            'ar_last_name' => $row['ar_last_name'],
            'gender' => $row['gender'],
            'martial_status' => $row['martial_status'],
            'education' => $row['education'],
            'educational_status' => $row['educational_status'],
            'field' => $row['field'],
            'educational_background' => $row['educational_background'],
            'city' => $row['city'],
            'address' => $row['address'],
            'id_img' => $row['id_img'],
            'academy_id' => $row['academy_id'],
            'cohort_id' => $row['cohort_id'],
            'personal_img' => $row['personal_img'],
            'vaccination_img' => $row['vaccination_img'],
            'git_hub' => $row['git_hub'],
            'linkedin' => $row['linkedin'],
            'employment_status' => $row['employment_status'],
            'internship_status' => $row['internship_status'],
            'stack' => $row['stack'],
            'trainee_cv' => $row['trainee_cv'],

        ]);
    }
   private function parseBirthdate($date)
    {
        try {
            if (is_numeric($date)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d');
            }

            if (\DateTime::createFromFormat('d.m.Y', $date)) {
                return Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
            }

            return Carbon::parse($date)->format('Y-m-d');

        } catch (\Exception $e) {
            \Log::warning("Failed to parse birthdate: {$date}");
            return null;
        }
    }

}





    