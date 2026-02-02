<?php

namespace App\Observers;

use App\Models\EmploymentLog;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
class EmploymentLogObserver
{
    /**
     * Handle the EmploymentLog "created" event.
     *
     * @param  \App\Models\EmploymentLog  $employmentLog
     * @return void
     */
    public function created(EmploymentLog $log)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'created',
            'model'    => 'EmploymentLog',
            'model_id' => $log->id,
            'changes'  => json_encode(
                [
                    'status' => $log->status,
                    'company' => optional($log->company)->name ?? 'N/A',
                    'position' => $log->position ?? 'N/A',
                    'start_date' => $log->start_date,
                    'end_date' => $log->end_date,
                    'source_of_information' => $log->source_of_information,

                    // ✅ HUMAN READABLE
                    'academy_name' => optional($log->academy)->name,
                    'cohort_name'  => optional($log->cohort)->name,
                    'trainee_name' => optional($log->trainee)->first_name,

                    'created_by' => optional(Auth::user())->name,
                    'created_at' => now()->toDateTimeString(),
                ]
            ),
        ]);
    }

    /**
     * Handle the EmploymentLog "updated" event.
     *
     * @param  \App\Models\EmploymentLog  $employmentLog
     * @return void
     */
    public function updated(EmploymentLog $log)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'updated',
            'model'    => 'EmploymentLog',
            'model_id' => $log->id,
            'changes'  => json_encode($log->getChanges()),
        ]);
    }

    /**
     * Handle the EmploymentLog "deleted" event.
     *
     * @param  \App\Models\EmploymentLog  $employmentLog
     * @return void
     */
    public function deleted(EmploymentLog $log)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model' => 'EmploymentLog',
            'model_id' => $log->id,
            'changes' => json_encode($log->getChanges()),
            'previous_changes' => json_encode($log->getOriginal())
        ]);
    }

    /**
     * Handle the EmploymentLog "restored" event.
     *
     * @param  \App\Models\EmploymentLog  $employmentLog
     * @return void
     */
    public function restored(EmploymentLog $employmentLog)
    {
        //
    }

    /**
     * Handle the EmploymentLog "force deleted" event.
     *
     * @param  \App\Models\EmploymentLog  $employmentLog
     * @return void
     */
    public function forceDeleted(EmploymentLog $employmentLog)
    {
        //
    }
}
