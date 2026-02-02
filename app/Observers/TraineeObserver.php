<?php

namespace App\Observers;

use App\Models\Trainee;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
class TraineeObserver
{
    /**
     * Handle the Trainee "created" event.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return void
     */
    public function created(Trainee $trainee)
    {
        //
    }

    /**
     * Handle the Trainee "updated" event.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return void
     */
    public function updated(Trainee $trainee)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'updated',
            'model'    => 'Trainee',
            'model_id' => $trainee->id,
            'changes'  => json_encode([
                'trainee_name' => $trainee->name,
                'updated_at'   => now()->toDateTimeString(),
            ]),
        ]);
    }

    /**
     * Handle the Trainee "deleted" event.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return void
     */
    public function deleted(Trainee $trainee)
    {
        //
    }

    /**
     * Handle the Trainee "restored" event.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return void
     */
    public function restored(Trainee $trainee)
    {
        //
    }

    /**
     * Handle the Trainee "force deleted" event.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return void
     */
    public function forceDeleted(Trainee $trainee)
    {
        //
    }
}
