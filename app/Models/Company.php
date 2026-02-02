<?php

namespace App\Models;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company_name','type_of_deal','company_email','company_img'];

    public function employers()
    {
        return $this->hasMany(Employer::class, 'company_id');
    }//reupload work for company and employer relation
    // test
}
