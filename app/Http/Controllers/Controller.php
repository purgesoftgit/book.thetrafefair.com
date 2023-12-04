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

    // public function ifAWSKeyisNotResponse(){
    //     $setting = Setting::where('key','is_aws_active')->first();
    //     if($setting)
    //         return $setting->value;
    //     else
    //         return 0; 
    // }

    // public function sendSMSMessage($phone_number,$sms_text_message){
         
    //      $is_sms_auth_key = Setting::where('key','is_sms_auth_key')->first();
    //      $is_sms_sender_id = Setting::where('key','is_sms_sender_id')->first();
        
    //      if($is_sms_auth_key && $is_sms_sender_id){
    //          $message = urlencode($sms_text_message);
    //          $phone_number = '+91'.$phone_number;
    //          $otp_url = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$is_sms_auth_key->value."&message=".$message."&senderId=".$is_sms_sender_id->value."&routeId=1&mobileNos=".$phone_number."&smsContentType=english";
    //          $handle = curl_init();
    //          curl_setopt($handle,CURLOPT_RETURNTRANSFER, true);
    //          curl_setopt($handle, CURLOPT_URL, $otp_url);
    //          $response = curl_exec($handle);
    //          curl_close($handle);
    //      }
    //  }

}
