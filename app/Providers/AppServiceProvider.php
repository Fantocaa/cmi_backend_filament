<?php

namespace App\Providers;

use App\Models\Project;
use App\Observers\ProjectObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // if (config('app.env') === 'production') {
        //     URL::forceScheme('https');
        // }
    }
}
