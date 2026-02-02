<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeer_trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'trainee_id'];
}
