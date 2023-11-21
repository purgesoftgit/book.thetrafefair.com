<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\{Setting, RoomCategory, Country, UserAddress, Wallet, TempCheckout, UsedPromocode, Promocode, TempUserInfo};
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $room = RoomCategory::all();
        $myArr = [];
        foreach($room as $value){
            $myArr[] = json_decode($value['image']);
        }
        $resultArray = call_user_func_array('array_merge', $myArr);
        $count = count($resultArray);
        return view('index', compact('room','resultArray','count'));
    }


    public function fetchSingleAdditionalRoomData($room_detail,$checkin)
    {
        if ($room_detail) {
            if (count($room_detail->roomadditionaldata) > 0 && !empty($room_detail->roomadditionaldata)) {
                foreach ($room_detail->roomadditionaldata as $room_key => $room_value) {
                    if ($checkin == $room_value['date']) {
                        $room_detail['room_avail'] = $room_value['room_avail'];
                        $room_detail['final_price'] = $room_value['price'];
                        $room_detail['new_old_price'] = $room_value['old_price'];
                        $room_detail['new_off_percentage'] = $room_value['off_percentage'];
                    }
                }
            }
        }

        return $room_detail;
    }

    public function getRooms()
    {
        $slug = '';
        $rooms = $this->fetchAllAdditionalRoomData($slug);
        return view('room-filter', compact('rooms'));
    }

    // public function getAvailsRooms($id, $checkin)
    // {
    //     $rooms = RoomCategory::with('roomadditionaldata')->where('id', $id)->first();
    //     $avails_price = 0;

    //     if ($rooms) {
    //         if (count($rooms->roomadditionaldata) > 0 && !empty($rooms->roomadditionaldata)) {
    //             foreach ($rooms->roomadditionaldata as $room_key => $room_value) {
    //                 if ($checkin == $room_value['date']) {
    //                     $rooms['room_avail'] = $room_value['room_avail'];
    //                     $rooms['avails_price'] = $room_value['price'];
    //                     $rooms['new_old_price'] = $room_value['old_price'];
    //                     $rooms['new_off_percentage'] = $room_value['off_percentage'];
    //                 }
    //             }
    //         }
    //     }

    //     if ((isset($rooms['room_avail']) && !empty($rooms['room_avail'])) && (isset($rooms['avails_price']) && !empty($rooms['avails_price'])) || (isset($rooms['new_old_price']) && !empty($rooms['new_old_price'])) || (isset($rooms['new_off_percentage']) && !empty($rooms['new_off_percentage']))) {
    //         return response()->json(['avails_room' => $rooms['room_avail'], 'avails_price' => $rooms['avails_price'], 'old_price' => $rooms['new_old_price'], 'off_percentage' => $rooms['new_off_percentage']]);
    //     } else {
    //         return response()->json(['avails_room' => $rooms->no_of_rooms, 'avails_price' => $rooms->price, 'old_price' => $rooms['old_price'], 'off_percentage' => $rooms['off_percentage']]);
    //     }
    // }


    public function fetchAllAdditionalRoomData($slug)
    {
        if ($slug == "")
            $related_room =  RoomCategory::with('roomadditionaldata')->get();
        else
            $related_room =  RoomCategory::with('roomadditionaldata')->where('slug', '!=', $slug)->get();

        if ($related_room) {
            foreach ($related_room as $rel_key => $rel_value) {
                if ($rel_value->roomadditionaldata) {
                    foreach ($rel_value->roomadditionaldata as $room_key => $room_value) {

                        if (date('Y-m-d') == $room_value['date']) {

                            $rel_value['final_price'] = $room_value['price'];
                            $rel_value['new_old_price'] = $room_value['old_price'];
                            $rel_value['new_off_percentage'] = $room_value['off_percentage'];
                        }
                    }
                }
            }
        }

        return $related_room;
    }


    public function checkRoomAvailability($checkin = "")
    {
        $rooms = RoomCategory::with('roomadditionaldata')->whereHas('roomadditionaldata', function ($query) {
            $query->where('date', '>=', date('Y-m-d'));
        })->get();

        $avails_price = 0;
        $checkin = !empty($checkin) ? $checkin : date('Y-m-d');

        if ($rooms) {
            foreach ($rooms as $value) {
                if ($value->roomadditionaldata) {
                    foreach ($value->roomadditionaldata as $room_value) {

                        if ($checkin == $room_value['date']) {
                            $value['final_price'] = $room_value['price'];
                            $value['new_avail_price'] = $room_value['room_avail'];
                        }
                    }
                }
            }
        }
        return view('room-reserve-table', compact('rooms'));
    }

    public function userInformation(Request $request)
    {
        $room_guest = explode(" - ", $request->room_guest);

        $room = RoomCategory::with('roomadditionaldata')->where('id',$request->room_id)->first();
        $room_data = $this->fetchSingleAdditionalRoomData($room,$request->checkin);
        
        $room_price = (isset($room_data->final_price) && !empty($room_data->final_price)) ? $room_data->final_price : $room_data->price;

        $avail_room = (isset($room_data->room_avail) && !empty($room_data->room_avail)) ? $room_data->room_avail : $room_data->no_of_rooms;

        $room_price_with_taxes = $room_price * env('DEFAULT_ROOM_TAX_RATE') / 100;

        $final_price = $room_price + $room_price_with_taxes;
 
        $temp_user_info = new TempUserInfo();
       
        $temp_user_info->room_id = $request->room_id;
        $temp_user_info->checkin = $request->checkin;
        $temp_user_info->checkout = $request->checkout;
        $temp_user_info->room =  explode(" Room", $room_guest[0])[0];
        $temp_user_info->guest = explode(" Guest", $room_guest[1])[0];
        $temp_user_info->price = $room_price;
        $temp_user_info->with_tax_price = $room_price_with_taxes;
        $temp_user_info->final_price = $final_price;
        $temp_user_info->save();

        $temp_user_info->hash_id = md5($temp_user_info->id);
        $temp_user_info->save();
 
        return response()->json(['status' => 200, "message" => "Succesfully added Data.","hash_id" => $temp_user_info->hash_id]);
    }
    public function checkoutInformation($slug,$hash)
    {
        $country = Country::get();
        $temp_user_info = TempUserInfo::where('hash_id',$hash)->first();
        $per_room_childrens_allowed = Setting::where('key', 'per_room_childrens_allowed')->first();
        $address = Setting::where('key', 'address')->first();

        return view('checkout-info', compact('country','temp_user_info','per_room_childrens_allowed','address'));
    }

    public function roomcart($order_id)
    {
        if (Auth::check()) {
            $address = UserAddress::where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
        } else {
            $address = array();
        }
        $credit_sum_amt = 0;
        $credit_sub_amt = 0;
        $reward_sum_amt = 0;
        $reward_sub_amt = 0;
        $credit_amount = 0;
        $reward_amount = 0;

        if (Auth::check()) {
            $recharge_wallet_query = Wallet::where('user_id', Auth::user()->id)->get();
            if (!$recharge_wallet_query->isEmpty()) {
                foreach ($recharge_wallet_query as $key => $value) {
                    if ($value->amount_type == 'TTI_CREDIT') {
                        if ($value->txn_type == 'CREDIT') {
                            $credit_sum_amt += $value->amount;
                        } else {
                            $credit_sub_amt += $value->amount;
                        }
                    } else {
                        if ($value->txn_type == 'CREDIT') {
                            $reward_sum_amt += $value->amount;
                        } else {
                            $reward_sub_amt += $value->amount;
                        }
                    }
                }
                $credit_amount = $credit_sum_amt - $credit_sub_amt;
                $reward_amount = $reward_sum_amt - $reward_sub_amt;
            }
        }

        $order_id = explode('-', base64_decode($order_id))[1];
        $temp_data = TempCheckout::where('id', $order_id)->first();

        if (empty($temp_data)) {
            return redirect('/');
        } else {
            $form_data = json_decode($temp_data['formData'], true);
            $room_category = str_replace(" ", "_", ucwords(str_replace("_", " ", $form_data['item']['room_category']))) . '_Room';

            $arr = array();
            $used_promo = UsedPromocode::where('phone_number', '+91' . $form_data['customerPhone'])->where('used_time', '>=', 1)->get();
            foreach ($used_promo as $key => $value) {
                array_push($arr, $value->promocode_id);
            }

            $promocodes = Promocode::whereNotIn('id', $arr)->whereIN('code_type', array('N', 'S'))->whereIn('category', array($room_category, 'Both'))->orderby('id', 'desc')->get();
            //get total person and no of avails room start
            $per_room_person = Setting::where('key', 'per_room_person')->first();
            $rooms = RoomCategory::with('roomadditionaldata')->where('room_category', $form_data['item']['room_category'])->first();
            if (!empty($rooms) && !empty($rooms->roomadditionaldata) && $rooms->roomadditionaldata) {
                foreach ($rooms->roomadditionaldata as $room_key => $room_value) {
                    if (date('Y-m-d', strtotime(date('Y-m-d', strtotime($form_data['checkin'])))) == $room_value['date']) {
                        $rooms['room_avail'] = $room_value['room_avail'];
                        $rooms['final_price'] = $room_value['price'];
                        $rooms['new_old_price'] = $room_value['old_price'];
                        $rooms['new_off_percentage'] = $room_value['off_percentage'];
                    }
                }
            }
            $no_of_rooms = isset($rooms->room_avail) ? $rooms->room_avail : $rooms->no_of_rooms;
            //get total person and no of avails room start

            $roomcategory = Setting::where("key", "room_category")->first();
            $roomcategory = ($roomcategory) ? explode(',', $roomcategory->value) : array();
            $per_room_childrens_allowed = Setting::where('key', 'per_room_childrens_allowed')->first();

            return view('login-users.roomcart', compact('address', 'credit_amount', 'reward_amount', 'promocodes', 'form_data', 'order_id', 'per_room_person', 'no_of_rooms', 'roomcategory', 'per_room_childrens_allowed'));
        }
    }
}
