<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\{Setting, MetaData};
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

        //share meta data to all blade file 
        if (isset($_SERVER['REQUEST_URI'])) {
           
            $request = parse_url($_SERVER['REQUEST_URI']);
            $result = $request['path'];
            $meta_datas = MetaData::where('type', 1)->where('route', $result)->first();
            View::share('meta_datas', $meta_datas);
        }
    }
}
