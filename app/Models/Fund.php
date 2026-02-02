<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;
     protected $fillable = [
        'fund_name',
        'start_date',
        'end_date',
    ];

    public function cohorts()
    {
        return $this->hasMany(Cohort::class);
    }
}
