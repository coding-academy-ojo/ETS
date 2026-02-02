<?php

namespace App\Observers;

use App\Models\Employer;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
class EmployerObserver
{
    /**
     * Handle the Employer "created" event.
     *
     * @param  \App\Models\Employer  $employer
     * @return void
     */
    public function created(Employer $employer)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'created',
            'model'    => 'Employer',
            'model_id' => $employer->id,
            'changes'  => json_encode($employer->toArray()),
        ]);
    }

    /**
     * Handle the Employer "updated" event.
     *
     * @param  \App\Models\Employer  $employer
     * @return void
     */
    public function updated(Employer $employer)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'updated',
            'model'    => 'Employer',
            'model_id' => $employer->id,
            'changes'  => json_encode($employer->getChanges()),
        ]);
    }


    /**
     * Handle the Employer "deleted" event.
     *
     * @param  \App\Models\Employer  $employer
     * @return void
     */
    public function deleted(Employer $employer)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'deleted',
            'model'    => 'Employer',
            'model_id' => $employer->id,
            'changes'  => json_encode($employer->toArray()),
        ]);
    }

    /**
     * Handle the Employer "restored" event.
     *
     * @param  \App\Models\Employer  $employer
     * @return void
     */
    public function restored(Employer $employer)
    {
        //
    }

    /**
     * Handle the Employer "force deleted" event.
     *
     * @param  \App\Models\Employer  $employer
     * @return void
     */
    public function forceDeleted(Employer $employer)
    {
        //
    }
}
