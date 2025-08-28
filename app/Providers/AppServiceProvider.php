<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        Blade::withoutDoubleEncoding();
        Paginator::useBootstrap();

        if (config('app.force_https')) {
            URL::forceScheme('https');
        }
    }
}
