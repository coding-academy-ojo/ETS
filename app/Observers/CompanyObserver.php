<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function created(Company $company)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'created',
            'model'    => 'Company',
            'model_id' => $company->id,
            'changes'  => json_encode($company->toArray()),
        ]);
    }

    /**
     * Handle the Company "updated" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updated(Company $company)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'updated',
            'model'    => 'Company',
            'model_id' => $company->id,
            'changes'  => json_encode($company->getChanges()),
        ]);
    }

    /**
     * Handle the Company "deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function deleted(Company $company)
    {
        ActivityLog::create([
            'user_id'  => Auth::id(),
            'action'   => 'deleted',
            'model'    => 'Company',
            'model_id' => $company->id,
            'changes'  => json_encode($company->toArray()),
        ]);
    }

    /**
     * Handle the Company "restored" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function restored(Company $company)
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        //
    }
}
