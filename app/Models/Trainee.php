<?php

namespace App\Models;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Trainee extends Model
{
    use HasFactory;


    protected $fillable = [
        'email', 'mobile', 'graduated', 'certificat_type', 'nationality', 'country',
        'passport_number', 'national_id', 'birthdate', 'first_name', 'second_name',
        'third_name', 'last_name', 'ar_first_name', 'ar_second_name', 'ar_third_name',
        'ar_last_name', 'gender', 'martial_status', 'education', 'educational_status',
        'field', 'educational_background', 'city', 'address', 'id_img', 'academy_id',
        'cohort_id', 'personal_img', 'vaccination_img', 'git_hub', 'linkedin','employment_status','internship_status','stack',
        'created_at', 'updated_at','trainee_cv'
    ];
    


    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function employment_logs()
    {
        // return $this->hasMany(EmploymentLog::class);
        return $this->hasMany(EmploymentLog::class, 'trainee_id');

    }
    public function employeers()
    {
        return $this->belongsToMany(Employer::class);
    }

}

