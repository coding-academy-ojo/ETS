<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id', 'type', 'sent',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id');    }
}

