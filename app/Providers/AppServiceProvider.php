<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::component('jqueryTable', \App\View\Components\Script\JqueryTable::class);
        Blade::component('jqueryForm', \App\View\Components\Script\JqueryForm::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\DB::statement('SET SESSION sql_require_primary_key=0');
        }
    }
}
