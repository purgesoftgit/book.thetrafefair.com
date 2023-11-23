<?php

namespace App\Http\Controllers\LoginUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;
use App\User;
use App\NotificationPreferece;
use App\UserAddress;
use App\PhoneVerification;
use App\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Jobs\ResetPasswordJob;
use Session;
use Mail;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\URL;
use Redirect;
use App\Mail\ResetPassword;
use App\Mail\SubscribeMail;

use Log;
class LoginController extends Controller
{ 
    
    public function loginManager(Request $request){
        $rules = array(
            'email' => 'required',
            'password' => 'required');
           
        $validator = Validator::make($request->all() , $rules);
        if ($validator->fails()){
            return Redirect::to('login')->withErrors($validator);
        }else{
            // create our user data for the authentication
            $userdata = array(
            'email' => $request->email,
            'password' => $request->password,
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                if(Auth::user()->role_id == 3 && ( !str_contains(URL::current(), 'subadmin') )){
                    return redirect('/get-upcoming-checkin-checkout');
                }
                else{
                    return redirect()->back()->with('error-message', 'Opps!!! You are not valid user.');
                }
                   
            }else{
                return redirect()->back()->with('error-message', 'Opps!!! You are not valid user.');
            }
        }
    }

    public function Logout()
    { 
        Auth::logout();
        return redirect('login');
    }

    
}
