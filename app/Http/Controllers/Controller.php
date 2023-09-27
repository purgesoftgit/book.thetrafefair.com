<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
 
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Setting;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    { 
    }

    public function ifAWSKeyisNotResponse(){
        $setting = Setting::where('key','is_aws_active')->first();
        if($setting)
            return $setting->value;
        else
            return 0; 
    }
}
