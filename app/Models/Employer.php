<?php

namespace App\Models;


use App\Models\Trainee;
use App\Models\Company;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model implements Authenticatable
{
    protected $table = 'employers';
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'company_name',
        'company_id',
        'status',
        'password'];


    // Implement the required methods from the Authenticatable interface
    public function getAuthIdentifierName()
    {
        return 'id'; // Assuming 'id' is the primary key of your employer_information table
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function trainees()
    {
        return $this->belongsToMany(Trainee::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }//reupload work for company and employer relation


}
