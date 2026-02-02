<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'company',
        'position',
        'start_date',
        'end_date',
        'academy_id',
        'cohort_id',
        'created_at',
        'created_by',
        'updated_at',
        'trainee_id',
    ];


    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
