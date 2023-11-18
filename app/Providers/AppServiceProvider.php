<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\{Setting};
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Route;

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
        //share setting data to all blade file 
        $settings = Setting::pluck('value', 'key');
        View::share('settings', $settings);
    }
}
