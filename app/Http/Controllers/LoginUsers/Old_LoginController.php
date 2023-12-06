<?php

namespace App\Http\Controllers\LoginUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\{User, Wallet};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    // Login via Gmail
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $this->loginViaSocials('google');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    // Login via facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $this->loginViaSocials('facebook');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function loginViaSocials($social_type)
    {
        $user = Socialite::driver($social_type)->user();

        $finduser = User::where($social_type.'_id', $user->id)->first();
        
        $slug = Session::get('room_category');
        $hash = Session::get('user_info_hash');

        if ($finduser) {
            Auth::login($finduser);
            return redirect('checkout-information/' . $slug . '/' . $hash);
        } else {
            
            $newUser = new User();
            $newUser->username = str_replace(' ', '_', strtolower($user->name)) . '-' . random_int(100000, 999999);
            $newUser->first_name = ucfirst($user->name);
            $newUser->email = $user->email;
            $newUser->phone_number = isset($user->phone) ? $user->phone : null;
            $newUser->email_verifid_token = Str::random(20);
            $newUser->referral_code = strtolower(Str::random(6));
            $newUser->password = bcrypt(env('AUTO_PASSWORD'));
            $newUser->login_type = 0;
            $newUser->role_id = 0;
            $newUser->google_id = $user->id;
            $newUser->save();

            $wallet = new Wallet();
            $wallet->user_id = $newUser->id;
            $wallet->amount = env('SELF_SIGNUP_AMOUNT');
            $wallet->message = "Account Signup Amount";
            $wallet->txn_type = 'credit';
            $wallet->amount_type = 'TTI_REWARD';
            $wallet->save();

            Auth::login($newUser);

            return redirect('checkout-information/' . $slug . '/' . $hash);
        }
    }
    public function loginManager(Request $request)
    {
        $rules = array(
            'email' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator);
        } else {
            // create our user data for the authentication
            $userdata = array(
                'email' => $request->email,
                'password' => $request->password,
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                if (Auth::user()->role_id == 3 && (!str_contains(URL::current(), 'subadmin'))) {
                    return redirect('/get-upcoming-checkin-checkout');
                } else {
                    return redirect()->back()->with('error-message', 'Opps!!! You are not valid user.');
                }
            } else {
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
