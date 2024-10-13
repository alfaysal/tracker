<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Console\Scheduling\Event::macro('customWeekdays', function () {
            return $this->days(Schedule::SUNDAY.'-'.Schedule::THURSDAY);
        });
    }
}
