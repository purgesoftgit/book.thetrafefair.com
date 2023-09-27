<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\{RoomServiceCategory, Transaction, User, Review};
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
}
