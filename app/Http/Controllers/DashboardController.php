<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\{RoomServiceCategory, Transaction, User, Review,EventRequest,WeddingEnquiry,SpaReservation,PhoneVerification};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function getauthuser(){
       // $allUsers = User::where('id','!=',Auth::user()->id)->where('role_id','!=',1)->orderBy('id','desc')->get();
        $user = User::where('id',Auth::user()->id)->first();
        return $user;
    }
    public function getRoomOrderHistory($status = ''){
        $data = $this->getauthuser();
        $user = $data;
        $category = RoomServiceCategory::get();
        if($status != ''){
            $room_order_history = Transaction::where('user_id',$user->id)->where('txn_type','ROOM')->where(function($q) use ($status){
                $q->where('status',$status);
            })->orderby('id','DESC')->paginate(10); 
        }
        else{
            $room_order_history = Transaction::where('user_id',$user->id)->where('txn_type','ROOM')->where(function($q){
                $q->orWhereIn('f_status',['U','C','IH'])->orWhere('status','ROOM_CANCELLED');
            })->orderBy('updated_at','desc')->orderby('id','DESC')->paginate(10);
        }

        if(!empty($room_order_history)){
            foreach($room_order_history as $key => $value){
                $checkoutdata = json_decode($value['checkout_form_data'],true);
                $room_id = $checkoutdata['item']['room_id'];
               
                $value['is_already_exists'] = Review::where('user_id',$value->user_id)->where('item_id',$room_id)->where('item_type','room')->count();
               
            }
        }


        return view('dashboard.room-booking-history',compact('room_order_history','category'));
        
    }

    public function getEventRequests(){
        $phoneNumber = Auth::user()->phone_number;
        $phone=substr($phoneNumber, 3);

        $category = EventRequest::where('phone',$phone)->get();

        return view('dashboard.event-requests-history',compact('category'));
    }

    public function getWeddingHistory(){
        $phoneNumber = Auth::user()->phone_number;
        $phone=substr($phoneNumber, 3);

        $wedding = WeddingEnquiry::where('phone',$phone)->get();
        return view('dashboard.wedding-history',compact('wedding'));
    }

    public function getSpaReservationHistory(){
        $phoneNumber = Auth::user()->phone_number;
        $phone=substr($phoneNumber, 3);

        $spa_reservation = SpaReservation::where('phone',$phone)->get();
        
        return view('dashboard.spa-reservation-history',compact('spa_reservation'));
    }

    public function profileUpdate(Request $request)
    {
        $userProfile = Auth::user('id');
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($userProfile->id),
            ],
            'phone_number' => [
                'required',
                'string',
                'min:10',
                Rule::unique('users')->ignore($userProfile->id ?? null),
            ]
        ]);
        // PhoneVerification::where('phone', $userProfile->phone_number)->update(['phone' => '+91' . $request->input('phone_number')]);
        // $profile = User::where('id', $userProfile->id)->first();
        // $profile->username = str_replace(' ', '_', strtolower($request->first_name) . strtolower($request->last_name));
        // $profile->first_name = ucfirst($request->first_name);
        // $profile->last_name =  ucfirst($request->last_name);
        // $profile->email =  $request->input('email');
        // $profile->phone_number = '+91' . $request->input('phone_number');
        // $profile->updated_at = date("Y-m-d");
        // $profile->email_verifid_token = null;
        $data = User::where('id', $userProfile->id)->first();
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->phone_number = $request->phone_number;
        $data->email = $request->email;
        $data->save();

        return redirect('room-order-history');
    }

    
}
