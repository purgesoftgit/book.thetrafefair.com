<?php

namespace App\Http\Controllers\LoginUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\URL;
use Redirect;
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
