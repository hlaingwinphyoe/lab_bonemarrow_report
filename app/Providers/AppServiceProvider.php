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
        // Wrapped in try-catch to prevent errors before migrations run
        try {
            View::share('clinicInfo', ClinicInfo::with('clinic_phones')->first());
        } catch (\Exception $e) {
            View::share('clinicInfo', null);
        }
    }
}
