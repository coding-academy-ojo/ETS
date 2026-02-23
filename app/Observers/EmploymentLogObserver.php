<?php

namespace App\Observers;

use App\Models\EmploymentLog;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class EmploymentLogObserver
{
    /**
     * Handle the EmploymentLog "created" event.
     */
    public function created(EmploymentLog $log)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'created',
            'model'    => 'EmploymentLog',
            'model_id' => $log->id,
            // Use the private helper function here so the names are joined correctly
            'changes'  => json_encode($this->formatEmploymentLog($log)),
        ]);
    }

    /**
     * Handle the EmploymentLog "updated" event.
     */
   public function updated(EmploymentLog $log)
{
    $changes = $log->getChanges();

    // Remove auto-updated fields
    unset($changes['updated_at']);

    if (empty($changes)) {
        return;
    }

    // Add trainee name manually
    $trainee = $log->trainee;

    $changes['trainee_name'] = $trainee
        ? trim($trainee->first_name . ' ' . $trainee->last_name)
        : 'N/A';

    ActivityLog::create([
        'user_id'  => Auth::id(),
        'action'   => 'updated',
        'model'    => 'EmploymentLog',
        'model_id' => $log->id,
        'changes'  => json_encode($changes),
    ]);
}


    /**
     * Handle the EmploymentLog "deleted" event.
     */
 public function deleted(EmploymentLog $log)
{
    $trainee = $log->trainee;

    $data = [
        'trainee_name' => $trainee
            ? trim($trainee->first_name . ' ' . $trainee->last_name)
            : 'N/A',

        'status' => $log->status,
        'company' => optional($log->company)->name,
        'position' => $log->position,
        'start_date' => $log->start_date,
        'end_date' => $log->end_date,
        'source_of_information' => $log->source_of_information,
        'deleted_at' => now()->toDateTimeString(),
    ];

    ActivityLog::create([
        'user_id'  => Auth::id(),
        'action'   => 'deleted',
        'model'    => 'EmploymentLog',
        'model_id' => $log->id,
        'changes'  => json_encode($data),
    ]);
}


    /**
     * Helper to format the JSON data consistently
     */
    private function formatEmploymentLog($log)
    {
        $trainee = $log->trainee;
        
        return [
            // This combines BOTH names now
            'trainee_name' => $trainee 
                ? trim($trainee->first_name . ' ' . $trainee->last_name) 
                : 'N/A',
                
            'academy_name' => optional($log->academy)->name,
            'cohort_name'  => optional($log->cohort)->name,
            'status'       => $log->status,
            'company'      => optional($log->company)->name,
            'position'     => $log->position,
            'start_date'   => $log->start_date,
            'end_date'     => $log->end_date,
            'source_of_information' => $log->source_of_information ?? 'N/A',
            'created_by'   => optional(Auth::user())->name,
            'created_at'   => now()->toDateTimeString(),
        ];
    }
}