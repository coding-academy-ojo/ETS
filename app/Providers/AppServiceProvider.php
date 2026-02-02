<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\employeer_trainee;
use Illuminate\Pagination\Paginator;
use App\Models\Company;
use App\Models\Trainee;
use App\Models\EmploymentLog;
use App\Models\Employer;
use App\Models\ActivityLog;

use App\Observers\CompanyObserver;
use App\Observers\TraineeObserver;
use App\Observers\EmploymentLogObserver;
use App\Observers\EmployerObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            if (Auth::guard('employer')->check()) {
                // dd('checked');
                // dd(Auth::guard('employer')->user()->id);
                $numberOfTrainees = employeer_trainee::where('employee_id', Auth::guard('employer')->user()->id)->count();
                // dd($numberOfTrainees);
                $view->with('numberOfTrainees', $numberOfTrainees);
            }
        });
        Paginator::useBootstrap();
        Company::observe(CompanyObserver::class);
        Trainee::observe(TraineeObserver::class);
        EmploymentLog::observe(EmploymentLogObserver::class);
        Employer::observe(EmployerObserver::class);

//check notification
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = ActivityLog::where('read', 0)->count();
                $view->with('unreadActivityCount', $unreadCount);
            }
        });
    }
}
