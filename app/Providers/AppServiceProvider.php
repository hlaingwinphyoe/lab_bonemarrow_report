<?php

namespace App\Providers;

use App\Models\ClinicInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        // Share clinic info globally to all views
        View::share('clinicInfo', ClinicInfo::with('clinic_phones')->first());
    }
}
