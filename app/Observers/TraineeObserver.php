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
    $changes = $trainee->getChanges();

    // Remove auto fields
    unset($changes['updated_at']);

    if (empty($changes)) {
        return;
    }

    ActivityLog::create([
        'user_id'  => auth()->id(),
        'action'   => 'updated',
        'model'    => 'Trainee',
        'model_id' => $trainee->id,
        'changes'  => json_encode([
            'trainee_name' => trim($trainee->first_name . ' ' . $trainee->last_name),
            'fields' => $changes
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