<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{RoomCategory, Setting, TempCheckout, UsedPromocode, Promocode, Book, Transaction, RefundUsers};
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use App\Jobs\{RoomConfirmJob,RoomConfirmAdminJob};

class RoomCheckoutController extends Controller
{

  public function testMail(){
    $setting = Setting::whereIn('key',['phone_number','address'])->get();
    $email = "leena.sharma@mailinator.com";
    $txn_rec = Transaction::where('txnid','b6bc8c14bd')->first();
    
  //  dispatch(new RoomConfirmAdminJob(env('MAIL_USERNAME'),$txn_rec));
    dispatch(new RoomConfirmJob($email,$txn_rec,$setting));
  }
  public function roomcart($order_id)
  {

    $order_id = base64_decode($order_id);
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
      $address = Setting::where('key', 'address')->first();


      return view('room-checkout.checkout', compact('address', 'promocodes', 'form_data', 'order_id', 'per_room_person', 'no_of_rooms', 'roomcategory', 'per_room_childrens_allowed'));
    }
  }

  public function saveRoomTempData(Request $request)
  {
    $checkout_form_data = $request->all();

    if (!empty($checkout_form_data)) {
      $rooms = RoomCategory::with('roomadditionaldata')->where('id', $checkout_form_data['room_id'])->first();
      if (!empty($rooms->roomadditionaldata)) {
        foreach ($rooms->roomadditionaldata as $room_value) {
          if ($checkout_form_data['checkin'] == $room_value['date']) {
            $rooms['avails_price'] = $room_value['price'];
          }
        }
      }

      $available_price = (isset($rooms['avails_price'])) ? $rooms['avails_price'] : $rooms->price;

      // $sum = 0;
      // if (isset($request->food_items)) {
      //     foreach ($request->food_items as $food_value) {
      //         $sum = $sum + (int)$food_value['value'];
      //     }
      // }
      $data  = [];

      $data['txn_type'] = 'ROOM';
      $data['user_id'] = (!Auth::check()) ? 0 : Auth::user()->id;
      $data['customerName'] = $checkout_form_data['customerName'];
      $data['customerEmail'] = $checkout_form_data['customerEmail'];
      $data['customerPhone'] = $checkout_form_data['customerPhone'];
      $data['checkin'] = $checkout_form_data['checkin'];
      $data['checkout'] = $checkout_form_data['checkout'];

      $data['item']['room_id'] = $checkout_form_data['room_id'];
      $data['item']['room_category'] = $rooms['room_category'];
      $data['item']['per_shift_price'] = $available_price;
      $data['item']['room'] = $checkout_form_data['room'];
      $data['item']['guest'] = $checkout_form_data['guest'];
      $data['item']['children'] = ($checkout_form_data['children']) ? $checkout_form_data['children'] : 0;

      $data['item']['country'] = (isset($checkout_form_data['country'])) ? $checkout_form_data['country'] : 0;
      $data['item']['preference'] = (isset($checkout_form_data['preference'])) ? $checkout_form_data['preference'] : 0;
      $data['item']['arrival_time'] = (isset($checkout_form_data['arrival_time'])) ? $checkout_form_data['arrival_time'] : 0;

      $data['no_of_dyas'] = $checkout_form_data['diffDays'];
      $per_room_person = Setting::where('key', 'per_room_person')->first();
      $total_persons = $per_room_person->value * $checkout_form_data['room'];

      $category = ($rooms['room_category'] == "super_deluxe") ? "deluxe" : $rooms['room_category']; //because of get same amount for deluxe or super deluxe

      $charges = Setting::where('key', $category . '_room_charges')->first();

      //calculate total amount
      $data['totalAmount'] =  $checkout_form_data['guest'] + ($checkout_form_data['diffDays'] * ($available_price * $checkout_form_data['room']));

      if ($checkout_form_data['guest'] > $total_persons) {
        $add_on_peoples = $checkout_form_data['guest'] - $total_persons;
        $add_charges = $add_on_peoples * ((int)$charges->value * $checkout_form_data['diffDays']);

        $data['add_peoples'] = $add_on_peoples;
        $data['add_peoples_amount'] = $add_charges;
        $data['extra_charges'] = 'Added charge Rs.' . $add_charges . ' for extra Person.';
      } elseif ($checkout_form_data['guest'] < $total_persons) {
        $less_on_peoples = $total_persons - $checkout_form_data['guest'];
        $less_charges = $less_on_peoples * ((int)$charges->value * $checkout_form_data['diffDays']);

        $data['minus_peoples'] = $less_on_peoples;
        $data['minus_peoples_amount'] = $less_charges;
        $data['extra_charges'] = 'Reduce Room Charge Rs.' . $less_charges . ' for ' . $less_on_peoples . ' Person';
      } else {
      }

      $temp_checkout = new TempCheckout();
      $record_is_exist = TempCheckout::where('user_id', $data['user_id'])->first();
      if (!empty($record_is_exist)) {
        TempCheckout::where('user_id', $data['user_id'])->delete();
      }
      $temp_checkout->user_id = $data['user_id'];
      $temp_checkout->formData = json_encode($data);
      $temp_checkout->save();

      return response()->json(['status' => 'success', 'last_inserted_id' => $temp_checkout->id]);
    } else {
      return response()->json(['status' => 'error', 'last_inserted_id' => 0]);
    }
  }

  public function submitBookNow(Request $request)
  {
    $data = $request->all();

    $date_validate = 1;

    $checkin = $data['checkin'];
    $checkout = $data['checkout'];
    $room_id = $data['room_id'];
    $guest = $data['guest'];


    $room = RoomCategory::with('roomadditionaldata')->where('id', $room_id)->first();
    $room_category_filter = $room->room_category;

    if ($room->roomadditionaldata) {
      foreach ($room->roomadditionaldata as $room_key => $room_value) {
        if (date('Y-m-d', strtotime(date('Y-m-d', strtotime($checkin)))) == $room_value['date']) {
          $room['room_avail'] = $room_value['room_avail'];
        }
      }
    }

    $avail_rooms = isset($room->room_avail) ? $room->room_avail : $room->no_of_rooms;

    $total_needed_room = $data['room'];
    $total_avail_rooms = $avail_rooms;
    $per_room_person = Setting::where('key', 'per_room_person')->first();
    $total_persons = $per_room_person->value * $total_needed_room;
    $max_person_room = ($per_room_person->value + 1) * $total_needed_room;


    $max_allowed_rooms = $guest;
    $min_allowed_rooms = (int)ceil($max_allowed_rooms / ($per_room_person->value + 1));

    $per_room_childrens_allowed = Setting::where('key', 'per_room_childrens_allowed')->first();
    $max_allowed_children = $per_room_childrens_allowed->value * $data['room'];


    //validation
    if ($data['checkin'] < date('Y-m-d') || $data['checkin'] > date('Y-m-d', strtotime(" +2 months"))) {
      $date_validate = 0;
    }

    if ($data['checkout'] < date('Y-m-d') || $data['checkout'] > date('Y-m-d', strtotime(" +2 months", strtotime("+1 days")))) {
      $date_validate = 0;
    }

    if (($data['checkin'] >= date('Y-m-d') && $data['checkin'] <=  date('Y-m-d', strtotime(" +2 months")) && ($data['checkout'] >= date('Y-m-d') && $data['checkout'] <= date('Y-m-d', strtotime(" +2 months", strtotime("+1 days")))))) {
      $date_validate = 1;
    }

    if ($date_validate == 0) {
      return response()->json(['status' => 'incorrect-date']);
    }
    if ($guest > $max_person_room && $total_avail_rooms < 0 && ($total_needed_room > $max_allowed_rooms && $total_needed_room < $min_allowed_rooms)) {
      return response()->json(['status' => 'invalid-room-guest']);
    }
    if ($data['children'] > $max_allowed_children) {
      return response()->json(['status' => 'invalid-children']);
    }


    if ($guest <= $max_person_room && $total_avail_rooms > 0 && ($total_needed_room <= $max_allowed_rooms && $total_needed_room >= $min_allowed_rooms) && $data['children'] <= $max_allowed_children) {
      // get all bookings that are free and not approve
      $booking_data = Book::where('room_id', $room_id)->whereNotIn('status', [2, 3])->get();
      $no_default_rooms = Setting::where('key', 'total_' . $room_category_filter . '_room')->first();

      $rooms_count = 0;
      if (!$booking_data->isEmpty()) {
        foreach ($booking_data as $key => $value) {
          $rooms_count = $rooms_count + $value->room;
        }

        if (!empty($no_default_rooms) && ($no_default_rooms->value - $rooms_count) != 0) {
          return response()->json(['status' => 'available']);
        } else {
          return response()->json(['status' => 'un-available']);
        }
      } else {
        return response()->json(['status' => 'available']);
      }
    } else {
      return response()->json(['status' => 'un-available']);
    }
  }


  // public function registerUser($userdata, $randomString)
  // {
  //     if ($userdata) {
  //         $first_name = explode(' ', $userdata['customerName'])[0];
  //         $first_name = str_replace(" ", "-", $first_name);

  //         $insert = new User();
  //         $insert->username = strtolower($first_name) . '-' . random_int(100000, 999999);
  //         $insert->first_name = ucfirst($first_name);
  //         $insert->email = $userdata['customerEmail'];
  //         $insert->phone_number = '+91' . $userdata['customerPhone'];
  //         $insert->email_verifid_token = Str::random(20);
  //         $insert->referral_code = strtolower(Str::random(6));
  //         $insert->password =  bcrypt(env('AUTO_PASSWORD'));
  //         $insert->save();

  //         $wallet = new Wallet();
  //         $wallet->user_id = $insert->id;
  //         $wallet->amount = env('SELF_SIGNUP_AMOUNT');
  //         $wallet->message = "Account Signup Amount";
  //         $wallet->txn_type = 'credit';
  //         $wallet->amount_type = 'TTI_REWARD';
  //         $wallet->save();

  //         $activity_array = ['reviews', 'follow', 'friends_join', 'up_tti', 'weeknesltr', 'prc_sett'];
  //         $title_array = ['Activity on my reviews', 'Someone follows me', 'My friends join TTI', 'Important updates from TTI', 'Weekly Newsletter', 'Privacy Setting'];

  //         foreach ($activity_array as $key => $value) {
  //             $prference = new NotificationPreferece();
  //             $prference->user_id = $insert->id;
  //             $prference->activity = $value;
  //             $prference->title = $title_array[$key];
  //             $prference->is_email = 'Yes';
  //             $prference->is_phone = 'Yes';
  //             $prference->is_active = 'Yes';
  //             $prference->save();
  //         }

  //         // Mail::to($insert['email'])->send(new UserRegisterDetailMail($insert,$randomString));

  //     }
  // }

  public function updateRoomTempData(Request $request)
  {
    $checkout_form_data = $request->all();
    $order_id = explode('-', $checkout_form_data['orderid'])[1];
    $tempdata = TempCheckout::where('id', $order_id)->first();

    $form_data = json_decode($tempdata->formData, true);
    $final_arr = array_merge($form_data, $checkout_form_data);

    $final_arr_json = json_encode($final_arr);
    $tempdata->formData = $final_arr_json;
    $tempdata->save();
    echo 'success';
    die;
  }

  public function generateRoomSignature(Request $request)
  {

    if (env('CASHFREE_TEST_MODE')) {
      $secretKey = env('CASHFREE_SECRET_KEY_TEST');
      $appId = env('CASHFREE_APP_ID_TEST');
    } else {
      $secretKey = env('CASHFREE_SECRET_KEY_LIVE');
      $appId = env('CASHFREE_APP_ID_LIVE');
    }

    $merchantData = array(
      "last_inserted_id" => explode('-', $request->orderId)[1],
    );

    $merchantData = base64_encode(json_encode($merchantData));

    $checkout_form_data = $request->all();
    $room = RoomCategory::with('roomadditionaldata')->where('id', $checkout_form_data['roomid'])->first();
    if ($room && count($room->roomadditionaldata) > 0) {
      foreach ($room->roomadditionaldata as $room_key => $room_value) {
        if ($checkout_form_data['checkindate'] == $room_value['date']) {
          $rooms['avails_price'] = $room_value['price'];
        }
      }
    }
    //per room price
    $available_price = (isset($room['avails_price'])) ? $room['avails_price'] : $room->price;

    $tempdata = TempCheckout::where('id', explode('-', $request->orderId)[1])->first();
    $form_data = json_decode($tempdata->formData, true);

    $sum = 0;
    if (array_key_exists('food_items', $form_data) && isset($form_data['food_items'])) {
      foreach ($form_data['food_items'] as $food_value) {
        $sum = $sum + (int)$food_value['value'];
      }
    }

    $room_guest_amount = ($form_data['no_of_dyas'] * ($available_price * $form_data['item']['room']));

    $per_room_person_allow = Setting::where('key', 'per_room_person')->first();
    $total_persons = $per_room_person_allow->value * $form_data['item']['room'];

    $category = ($form_data['item']['room_category'] == 'super_deluxe') ? 'deluxe' : $form_data['item']['room_category']; //because of get same amount for deluxe or super deluxe
    $charges = Setting::where('key', $category . '_room_charges')->first();

    if ($form_data['item']['guest'] > $total_persons) {
      $add_on_peoples = $form_data['item']['guest'] - $total_persons;
      $add_charges = $add_on_peoples * ((int)$charges->value * $form_data['no_of_dyas']);
      $amount = $room_guest_amount + $add_charges;
    } elseif ($form_data['item']['guest'] < $total_persons) {
      $less_on_peoples = $total_persons - $form_data['item']['guest'];
      $less_charges = $less_on_peoples * ((int)$charges->value * $form_data['no_of_dyas']);
      $amount = $room_guest_amount - $less_charges;
    } else {
      $amount = $room_guest_amount;
    }

    //room tax
    $room_tax = $amount * 12 / 100;

    //meal amount
    $sum = $sum * $form_data['item']['guest'];
    $meal_tax =  $sum * 5 / 100;

    //grand_tota
    $net_total_amount = $amount + $room_tax + $sum + $meal_tax;

    // if ($request->subtotal_tti_rewardpoint > 0) {
    //     $grand_total_amount = $net_total_amount - $request->subtotal_tti_rewardpoint;
    // } else if ($request->subtotal_tti_credit > 0) {
    //     $grand_total_amount = $net_total_amount - $request->subtotal_tti_credit;
    // } else if ($request->subtotal_tti_rewardpoint > 0 && $request->subtotal_tti_credit > 0) {
    //     $grand_total_amount = $net_total_amount - $request->subtotal_tti_rewardpoint - $request->subtotal_tti_credit;
    // } else if ($request->promocode) {
    //     $promocode = Promocode::where('code', trim(strtoupper($request->promocode)))->first();
    //     $grand_total_amount = $net_total_amount - $promocode->max_discount;
    // } else {
    //     $grand_total_amount = (float)$net_total_amount;
    // }

    if ($request->promocode) {
      $promocode = Promocode::where('code', trim(strtoupper($request->promocode)))->first();
      $grand_total_amount = $net_total_amount - $promocode->max_discount;
    } else {
      $grand_total_amount = (float)$net_total_amount;
    }

    //after apply get discount price
    $final_amount = (float)($grand_total_amount * $checkout_form_data['payment_options'] / 100);

    foreach ($checkout_form_data as $form_key => $form_value) {
      if ($form_key == 'subtotal_amt') {
        $checkout_form_data['subtotal_amt'] = number_format((float)$amount, 2, '.', '');
      }
      if ($form_key == 'subtotal_taxes') {
        $checkout_form_data['subtotal_taxes'] =  number_format((float)$room_tax, 2, '.', '');
      }
      // if ($form_key == 'subtotal_meal_amt') {
      //     $checkout_form_data['subtotal_meal_amt'] = number_format((float)$sum, 2, '.', '');
      // }
      // if ($form_key == 'subtotal_meal_tax') {
      //     $checkout_form_data['subtotal_meal_tax'] = $meal_tax;
      // }
      if ($form_key == 'net_total_amt') {
        $checkout_form_data['net_total_amt'] = $net_total_amount;
      }
      if ($form_key == 'grand_total_amt') {
        $checkout_form_data['grand_total_amt'] = number_format((float)$grand_total_amount, 2, '.', '');
      }
      if ($form_key == 'f_total_amt') {
        $checkout_form_data['f_total_amt'] = number_format((float)$final_amount, 2, '.', '');
      }
    }

    $final_total_amount = number_format((float)$request->f_total_amt, 2, '.', '');

    $postData = array(
      "appId" => $appId,
      "orderId" => $request->orderId,
      "orderAmount" => $final_total_amount,
      "orderCurrency" => 'INR',
      "orderNote" => '',
      "customerName" => $request->customerName,
      "customerEmail" => $request->customerEmail,
      "customerPhone" => $request->customerPhone,
      "merchantData" => $merchantData,
      "returnUrl" => env('APP_URL') . 'room-checkout-payment',
      "notifyUrl" => '',
      "roomcat" => $request->roomcat,
      "roomid" => $request->roomid,
      "subtotal_amt" => $request->subtotal_amt,
      "subtotal_taxes" => $request->subtotal_taxes,
      // "subtotal_meal_amt" => $request->subtotal_meal_amt,
      // "subtotal_meal_tax" => $request->subtotal_meal_tax,
      // "subtotal_tti_credit" => $request->subtotal_tti_credit,
      // "subtotal_tti_rewardpoint" => $request->subtotal_tti_rewardpoint,
      "net_total_amt" => $request->net_total_amt,
      "grand_total_amt" => $request->grand_total_amt,
      "f_total_amt" => $request->f_total_amt,
      "promocode" => $request->promocode,
      "promocode_deduction" => $request->promocode_deduction,
      "payment_options" => $request->payment_options
    );

    if (isset($request['add_wallet_amount']) && !empty($request['add_wallet_amount'])) {
      $add_wallet_amount_arr = array(
        "add_wallet_amount" => $request['add_wallet_amount'],
      );
      $postData = array_merge($postData, $add_wallet_amount_arr);
    }

    // if (isset($request['add_reward_amount']) && !empty($request['add_reward_amount'])) {
    //   $add_reward_amount_arr = array(
    //     "add_reward_amount" => $request['add_reward_amount'],
    //   );
    //   $postData = array_merge($postData, $add_reward_amount_arr);
    // }

    ksort($postData);

    $signatureData = "";
    foreach ($postData as $key => $value) {
      $signatureData .= $key . $value;
    }

    $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
    $signature = base64_encode($signature);

    $opt['status'] = 'success';
    $opt['signature'] = $signature;
    $opt['merchantData'] = $merchantData;
    echo json_encode($opt);
    die;
  }


  public function roomCheckoutPayment(Request $request)
  {
    $data = $request->all();

    if (!empty($data) && ($data['txStatus'] == 'SUCCESS')) {

      $temp_checkout_inserted_data = explode('-', $data['orderId']);
      $temp_checkout_inserted_id = trim($temp_checkout_inserted_data[1]);
      $checkout_records = TempCheckout::where('id', $temp_checkout_inserted_id)->first();
      $checkout_form_data = !empty($checkout_records) ? json_decode($checkout_records['formData'], true) : array();

      $setting = Setting::whereIn('key',['phone_number','address'])->get();

      if ($checkout_form_data) {
        $book = new Book();
        $book->user_id = $checkout_form_data['user_id'];
        $book->room_id = $checkout_form_data['item']['room_id'];
        $book->cin_date = $checkout_form_data['checkin'];
        $book->cout_date = $checkout_form_data['checkout'];
        $book->category = $checkout_form_data['item']['room_category'];
        $book->room = $checkout_form_data['item']['room'];
        $book->guests = $checkout_form_data['item']['guest'];
        $book->name = $checkout_form_data['customerName'];
        $book->email = $checkout_form_data['customerEmail'];
        $book->phone_number = '+91' . $checkout_form_data['customerPhone'];
        $book->save();

        //decrease value by 1 accoding to category
        $room_category = RoomCategory::with('roomadditionaldata')->where('room_category', $checkout_form_data['item']['room_category'])->first();
        $how_many_rooms = 0;

        if ($room_category->roomadditionaldata) {
          foreach ($room_category->roomadditionaldata as $room_key => $room_value) {
            if ($checkout_form_data['checkin'] == $room_value['date']) {
              if ($room_value['room_avail'] > 0) {
                $how_many_rooms = "yes";
                $room_value['room_avail'] = (int)$room_value['room_avail'] - $checkout_form_data['item']['room'];
                $room_value->save();
              }
            }
          }
        }

        if ($how_many_rooms !== "yes" && $room_category->no_of_rooms != 0) {
          $room_category->no_of_rooms = (int)$room_category['no_of_rooms'] - $checkout_form_data['item']['room'];
          $room_category->save();
        }
      }

      if (!empty($checkout_form_data)) {
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 10);
        $txn_rec = new Transaction();
        $txn_rec->user_id = $checkout_form_data['user_id'];
        $txn_rec->txnid = $txnid;
        $txn_rec->amount = $checkout_form_data['f_total_amt'];
        $txn_rec->txn_type = $checkout_form_data['txn_type'];
        $txn_rec->checkout_form_data = json_encode($checkout_form_data);
        $txn_rec->payu_data =  json_encode($data);
        $txn_rec->status =  'D';
        $txn_rec->f_status =  'U';
        $txn_rec->read_status =  'Unread';
        $txn_rec->pin_code =  rand(1000,9999);
        $txn_rec->booking_from =  'TTF_BOOKING_ENGIN';
        $txn_rec->save();
      }

      if (!empty($checkout_form_data) && $checkout_form_data['promocode'] != '') {
        $promocodeData = Promocode::with('usedpromo')->where('code', trim(strtoupper($checkout_form_data['promocode'])))->first();

        if (!empty($promocodeData)) {
          $already_used = UsedPromocode::where('promocode_id', $promocodeData['id'])->where('phone_number', '+91' . $checkout_form_data['customerPhone'])->count();
          if ($already_used == 0 && $checkout_form_data['item']['room_category'] == "deluxe") {
            $used_promocode = new UsedPromocode();
            $used_promocode->phone_number = '+91' . $checkout_form_data['customerPhone'];
            $used_promocode->promocode_id = $promocodeData['id'];
            $used_promocode->used_time += $checkout_form_data['item']['room'];
            $used_promocode->save();
          }
        }
      }

      $email = $checkout_form_data['customerEmail'];
      dispatch(new RoomConfirmAdminJob(env('MAIL_USERNAME'),$txn_rec));
      dispatch(new RoomConfirmJob($email,$txn_rec,$setting));

      $post = [
        'txn_rec' => $txn_rec,
        'email' => $email,
      ];

   
      TempCheckout::where('id', $temp_checkout_inserted_id)->delete();
 
      return redirect('room-payment-summary/' . $txnid);
    } else {
      
      return view('paymenterror');
    }
  }

  public function cancelReservation(Request $request)
  {
    $data = $request->all();

    if (!empty($data)) {
      $txnid = $data['txnid'];
      $trans_data = Transaction::where('txnid', $txnid)->first();
      if (!empty($trans_data)) {
        if (in_array($trans_data->f_status, array('IH', 'C'))) {
          echo json_encode(array('status' => 'error', 'message' => 'You have already checked in. You can\'t cancel now'));
          die;
        }
        $checkout_data = json_decode($trans_data->checkout_form_data, true);
        $payudata_data = json_decode($trans_data->payu_data, true);

        $checkin  = strtotime($checkout_data['checkin'] . " 12:00:00");
        $before_24_hour_time = $checkin - 86400;
        $current_time = time() + env('TIMEZONE');


        $room_category = RoomCategory::with('roomadditionaldata')->where('room_category', $checkout_data['item']['room_category'])->first();
        $how_many_rooms = 0;

        if ($room_category->roomadditionaldata) {
          foreach ($room_category->roomadditionaldata as $room_key => $room_value) {
            if ($checkout_data['checkin'] == $room_value['date']) {
              if ($room_value['room_avail'] > 0) {
                $how_many_rooms = "yes";
                $room_value['room_avail'] = (int)$room_value['room_avail'] + $checkout_data['item']['room'];
                $room_value->save();
              }
            }
          }
        }

        if ($how_many_rooms !== "yes" && $room_category->no_of_rooms != 0) {
          $room_category->no_of_rooms = (int)$room_category['no_of_rooms'] + $checkout_data['item']['room'];
          $room_category->save();
        }

        $booking_data = Book::where('room_id', $checkout_data['item']['room_id'])->whereDate('cin_date', date('Y-m-d', strtotime($checkout_data['checkin'])))->whereDate('cout_date', date('Y-m-d', strtotime($checkout_data['checkout'])))->whereIn('status', [0, 2, 1])->first();
        if (!empty($booking_data)) {
          $booking_data->status = 3;
          $booking_data->is_free = 1;
          $booking_data->save();
        }

        if ($current_time >= $before_24_hour_time) {

          $amount = $trans_data->amount;
          $trans_data->status = 'ROOM_CANCELLED';
          $trans_data->reason_cancelled_room = 'User did cancel the room';
          $trans_data->inperson_checkin_time = date('Y-m-d H:i:s');
          $trans_data->inperson_checkout_time = date('Y-m-d H:i:s', strtotime($checkout_data['checkout'] . " 12:00 AM"));
          $trans_data->save();

          echo json_encode(array('status' => 'success', 'message' => 'You cancellation request is received.'));
          die;
        } else {
          $amount = $trans_data->amount;
          $referenceId = $payudata_data['referenceId'];

          $baseurl = env('CASHFREE_LIVE_REFUND_URL');
          $appId = env('CASHFREE_APP_ID_LIVE');
          $secretKey = env('CASHFREE_SECRET_KEY_LIVE');
          if (env('CASHFREE_TEST_MODE')) {
            $baseurl = env('CASHFREE_TEST_REFUND_URL');
            $appId = env('CASHFREE_APP_ID_TEST');
            $secretKey = env('CASHFREE_SECRET_KEY_TEST');
          }

          //echo $baseurl; die;
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl . 'api/v1/order/refund',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
              'appId' => $appId,
              'secretKey' => $secretKey,
              'referenceId' => $referenceId,
              'refundAmount' => $amount,
              'refundNote' => 'Cancelled Room Booking',
              'refundAmount' => $amount
            ),
          ));
          $response = curl_exec($curl);

          curl_close($curl);
          $response_decode = json_decode($response, true);

          if ($response_decode['status'] != 'ERROR') {
            $trans_data->status = 'ROOM_CANCELLED';
            $trans_data->reason_cancelled_room = 'User did cancel the room';
            $trans_data->ref_id = $response_decode['refundId'];
            $trans_data->inperson_checkin_time = date('Y-m-d H:i:s');
            $trans_data->inperson_checkout_time = date('Y-m-d H:i:s', strtotime($checkout_data['checkout'] . " 12:00 AM"));
            $trans_data->save();

            $refunds_data = array("txnid" => $txnid, "refundId" => $response_decode['refundId'], "orderId" => $payudata_data['orderId'], "referenceId" => $referenceId, "amount" => $amount);

            $refunds = new RefundUsers();
            $refunds->txn_data = $response;
            $refunds->user_id = $trans_data->user_id;
            $refunds->other_data = json_encode($refunds_data);
            $refunds->txnid = $txnid;
            $refunds->save();

            echo json_encode(array('status' => 'success', 'message' => 'It may take 5 to 7 business days for the amount to be credited to your account.'));
            die;
          } else {
            echo json_encode(array('status' => 'error', 'message' => $response_decode['message']));
            die;
          }
        }

        $email = $checkout_data['customerEmail'];

        $url = "cancel-room-confirmation";
        $post = [
          'email' => $email,
          'trans_data' => $trans_data,
        ];

        // $this->cronFunMail($url, $post);

        //  dispatch(new CancelRoomCofirmation($email,$trans_data));

        $message = "Hello " . $checkout_data['customerName'] . ", Your booking has been cancelled. It's sad we won't be seeing you. We're listing the details for your cancellation below. Hope to see you in the future. HAVE A GREAT TIME";
        $this->sendMessageWhatsapp($checkout_data['customerPhone'], $message);
      }
    }
  }

  // public function room_checkout_payment_for_zero_amount(Request $request)
  // {
  //   $data = $request->all();
  //   if (!empty($data)) {
  //     $temp_checkout_inserted_data = explode('-', $data['orderId']);
  //     $temp_checkout_inserted_id = trim($temp_checkout_inserted_data[1]);
  //     $checkout_records = TempCheckout::where('id', $temp_checkout_inserted_id)->first();
  //     $checkout_form_data = !empty($checkout_records) ? json_decode($checkout_records['formData'], true) : array();
  //     $payu_data = json_encode($data);

  //     if ($checkout_form_data) {

  //       //book table
  //       $room_category = RoomCategory::with('roomadditionaldata')->where('room_category', $checkout_form_data['item']['room_category'])->first();
  //       $how_many_rooms = 0;
  //       if ($room_category->roomadditionaldata) {
  //         foreach ($room_category->roomadditionaldata as $room_key => $room_value) {
  //           if ($checkout_form_data['checkindate'] == $room_value['date']) {
  //             if ($room_value['room_avail'] > 0) {
  //               $how_many_rooms = "yes";
  //               $room_value['room_avail'] = (int)$room_value['room_avail'] - $checkout_form_data['item']['room'];
  //               $room_value->save();
  //             }
  //           }
  //         }
  //       }

  //       //decrease value by 1 accoding to category
  //       if ($how_many_rooms !== "yes" && $room_category->no_of_rooms != 0) {
  //         $room_category->no_of_rooms = (int)$room_category['no_of_rooms'] - $checkout_form_data['item']['room'];
  //         $room_category->save();
  //       }

  //       $book = new Book();
  //       $book->user_id = $checkout_form_data['user_id'];
  //       $book->room_id = $checkout_form_data['item']['room_id'];
  //       $book->cin_date = $checkout_form_data['checkin'];
  //       $book->cout_date = $checkout_form_data['checkout'];
  //       $book->category = $checkout_form_data['item']['room_category'];
  //       $book->room = $checkout_form_data['item']['room'];
  //       $book->guests = $checkout_form_data['item']['guest'];
  //       $book->name = $checkout_form_data['customerName'];
  //       $book->email = $checkout_form_data['customerEmail'];
  //       $book->phone_number = '+91' . $checkout_form_data['customerPhone'];
  //       $book->save();
  //     }

  //     $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 10);
  //     $txn_rec = new Transaction();
  //     $txn_rec->user_id = $checkout_form_data['user_id'];
  //     $txn_rec->txnid = $txnid;
  //     $txn_rec->amount = $checkout_form_data['f_total_amt'];
  //     $txn_rec->txn_type = $checkout_form_data['txn_type'];
  //     $txn_rec->checkout_form_data = json_encode($checkout_form_data);
  //     $txn_rec->payu_data =  json_encode($data);
  //     $txn_rec->f_status =  'U';
  //     $txn_rec->status =  'D';
  //     $txn_rec->read_status =  'Unread';
  //     $txn_rec->save();

  //     // if (!empty($checkout_form_data) && ($checkout_form_data['subtotal_tti_credit'] > 0)) {
  //     //   $wallet = new Wallet();
  //     //   $wallet->user_id  = $checkout_form_data['user_id'];
  //     //   $wallet->amount   = $checkout_form_data['subtotal_tti_credit'];
  //     //   $wallet->message  = 'Room Booked';
  //     //   $wallet->txn_type = 'DEBIT';
  //     //   $wallet->amount_type = 'TTI_CREDIT';
  //     //   $wallet->txnid = $txnid;
  //     //   $wallet->txn_data = '';
  //     //   $wallet->save();
  //     // }

  //     // if (!empty($checkout_form_data) && ($checkout_form_data['subtotal_tti_rewardpoint'] > 0)) {
  //     //   $wallet = new Wallet();
  //     //   $wallet->user_id  = $checkout_form_data['user_id'];
  //     //   $wallet->amount   = $checkout_form_data['subtotal_tti_rewardpoint'];
  //     //   $wallet->message  = 'Room Booked';
  //     //   $wallet->txn_type = 'DEBIT';
  //     //   $wallet->amount_type = 'TTI_REWARD';
  //     //   $wallet->txnid = $txnid;
  //     //   $wallet->txn_data = '';
  //     //   $wallet->save();
  //     // }


  //     if (!empty($checkout_form_data) && $checkout_form_data['promocode'] != '') {
  //       $promocodeData = Promocode::with('usedpromo')->where('code', trim(strtoupper($checkout_form_data['promocode'])))->first();

  //       if (!empty($promocodeData)) {
  //         $already_used = UsedPromocode::where('promocode_id', $promocodeData['id'])->where('phone_number', '+91' . $checkout_form_data['customerPhone'])->count();
  //         if ($already_used == 0 && $checkout_form_data['item']['room_category'] == "deluxe") {
  //           $used_promocode = new UsedPromocode();
  //           $used_promocode->phone_number = '+91' . $checkout_form_data['customerPhone'];
  //           $used_promocode->promocode_id = $promocodeData['id'];
  //           $used_promocode->used_time += $checkout_form_data['item']['room'];
  //           $used_promocode->save();
  //         }
  //       }
  //     }

  //     Auth::loginUsingId($checkout_form_data['user_id']);

  //     $email = $checkout_form_data['customerEmail'];

  //     //dispatch(new RoomConfirmAdminJob(env('MAIL_USERNAME'),$txn_rec));
  //     dispatch(new RoomConfirmJob($email,$txn_rec));

  //     $post = [
  //       'txn_rec' => $txn_rec,
  //       'email' => $email,
  //     ];
  //     $url = "send-room-confirmation-mail";
  //     // $this->roomCurlMailFunction($url,$post);

  //     //   $message = "Hello ".$checkout_form_data['customerName'].", Thank you for choosing Hotel The Trade International. We’re all set to serve you hassle-free stays with Check-in Assured. In case you face issues with your check-in, contact us for immediate assistance and you may avail a free stay, HAVE A GREAT TIME";
  //     //   $this->sendMessageWhatsapp($checkout_form_data['customerPhone'],$message);

  //     TempCheckout::where('id', $temp_checkout_inserted_id)->delete();
  //     echo json_encode(array('status' => 'success', 'txnid' => $txnid));
  //   } else {
  //     if (!empty($data)) {
  //       $temp_checkout_inserted_data = explode('-', $data['orderId']);
  //       $temp_checkout_inserted_id = trim($temp_checkout_inserted_data[1]);
  //       $checkout_records = TempCheckout::where('id', $temp_checkout_inserted_id)->first();
  //       $user_id = $checkout_records['user_id'];
  //       Auth::loginUsingId($user_id);
  //     }
  //     return view('paymenterror');
  //   }
  // }

  public function room_payment_success($txn_id)
  {
    if ($txn_id != '') {
      $transaction_data = Transaction::where('txnid', $txn_id)->orderby('id', 'DESC')->first();
      if (empty($transaction_data)) {
        return redirect('/');
      }
 
      return view('roompaymentsuccess', compact('transaction_data'));
    }
  }

  public function deductAmountForDeluxe(Request $request)
  {
    $roomcategory = $request['roomcategory'];
    $start_date =  strtotime($request['checkin']); // or your date as well
    $end_date = strtotime($request['checkout']);
    $datediff = $end_date - $start_date;
    $guest = $request['guest'];
    $no_of_rooms = $request['no_of_rooms'];
    $subtotal_meal_amt = $request['subtotal_meal_amt'];
    // $reward_amount = $request['reward_amount'];
    $payable_amount = 0;
    $final_amount = 0;

    $datediff = $datediff / (60 * 60 * 24);
    $charges = ($roomcategory == "super_deluxe" || $roomcategory == "super-deluxe" || $roomcategory == "deluxe") ? Setting::where('key', 'deluxe_room_charges')->first() : Setting::where('key', 'suite_room_charges')->first();

    $room_Category = RoomCategory::with('roomadditionaldata')->where('slug', str_replace('_', '-', $roomcategory) . '-room')->first();
    if ($room_Category) {
      if (!empty($room_Category->roomadditionaldata) && $room_Category->roomadditionaldata) {
        foreach ($room_Category->roomadditionaldata as $room_key => $room_value) {
          if (date('Y-m-d') == $room_value['date']) {
            $room_Category['final_price'] = $room_value['price'];
            $room_Category['new_old_price'] = $room_value['old_price'];
            $room_Category['new_off_percentage'] = $room_value['off_percentage'];
          }
        }
      }

      $room_price = (isset($room_Category->final_price)) ? $room_Category->final_price : $room_Category->price;
      $deducted_price = $charges->value;

      $per_room_person_allow = Setting::where('key', 'per_room_person')->first();
      $total_persons = $per_room_person_allow->value * $no_of_rooms;

      $sum = 0;
      $total_amount = ($sum * $guest) + ($datediff * ($room_price * $no_of_rooms));

      if ($request['case'] == "add") { //when we add promocode
        if ($guest > $total_persons) {
          $add_on_peoples = $guest - $total_persons;
          $add_charges = $add_on_peoples * ((int)$deducted_price * $datediff);
          $payable_amount += $add_charges;
          // $final_amount = $total_amount + $add_charges;
        } else {
          $payable_amount = $payable_amount;
          //$final_amount = $total_amount;
        }
      } else {
        if ($guest < $total_persons) { //when we remove promocode
          $less_on_peoples = $total_persons - $guest;
          $less_charges = $less_on_peoples * ((int)$deducted_price * $datediff);
          $payable_amount -= $less_charges;
          //$final_amount = $total_amount - $less_charges ;
        } else if ($guest > $total_persons) { //when we remove promocode
          $add_on_peoples =  $guest - $total_persons;
          $add_charges = $add_on_peoples * ((int)$deducted_price * $datediff);
          $payable_amount += $add_charges;
          // $final_amount = $total_amount + $add_charges;
        } else {
          $payable_amount = $payable_amount;
          // $final_amount = $total_amount;
        }
      }
      $promocode = Promocode::where('code', $request['coupon_code'])->first();

      $room_tax = $total_amount * env('DEFAULT_ROOM_TAX_RATE') / 100;
      $tax_total_amount = $room_tax + $total_amount;
      $food_tax = $subtotal_meal_amt * env('DEFAULT_MEAL_TAX_RATE') / 100;
      $tax_include_taxes =  $total_amount + $room_tax + $subtotal_meal_amt + $food_tax;

      if ($request['case'] == "add")
        $promo_amount = ($promocode->discount == "net") ? $promocode->discount : ($tax_include_taxes * $promocode->discount) / 100;
      else
        $promo_amount = 0;

      //$payable_amount += ($reward_amount != 0) ? $tax_include_taxes - $reward_amount :  $tax_include_taxes - $promo_amount;
      $payable_amount += $tax_include_taxes - $promo_amount;

      return response()->json(['final_amount' => number_format(
        (float)$total_amount,
        2,
        '.',
        ''
      ), 'room_tax' => (int)$room_tax, 'meal_amount' => $subtotal_meal_amt, 'food_tax' => (int)$food_tax, 'tax_include_taxes' => number_format((float)$tax_include_taxes, 2, '.', ''), 'promo_amount' => $promo_amount, 'payable_amount' => $payable_amount]);
    }
  }


  //new work


  public function applyPromoCode(Request $request)
  {
    $data = $request->all();

    $coupon_code = $data['coupon_code'];
    $net_total_amt = $data['net_total_amt'];
    $no_of_rooms = (int)$data['no_of_rooms'];
    $roomcategory = $data['roomcategory'];
    $current_user_id = (Auth::check()) ? Auth::user()->id : '';
    $checkin = ($data['checkin'] == 0) ? time() : $data['checkin'];
    $checkout = ($data['checkout'] == 0) ? time() : $data['checkout'];
    // $subtotal_meal_amt = $data['subtotal_meal_amt'];
    $subtotal_meal_amt = 0;
    $order_id = $data['order_id'];
    $additional_amount = 0;
    if ($data['order_id'] != 0) {
      $order_id = explode('-', $order_id)[1];

      $tempdata = TempCheckout::where('id', $order_id)->first();
      $form_data = json_decode($tempdata->formData, true);

      if (array_key_exists('add_peoples_amount', $form_data))
        $additional_amount = $form_data['add_peoples_amount'];
      if (array_key_exists('minus_peoples_amount', $form_data))
        $additional_amount = 0;

      $arr = array();
      $used_promo = UsedPromocode::where('phone_number', '+91' . $form_data['customerPhone'])->where('used_time', '>=', 1)->get();
      if (!empty($used_promo)) {
        foreach ($used_promo as $key => $value) {
          array_push($arr, $value->promocode_id);
        }
      }
    }

    // if($roomcategory == "restaurant"){

    //     $promodata = Promocode::where('code', $coupon_code)->where('category','Rastaurant')->first();
    // }else{
    $room_category = str_replace(" ", "_", ucwords(str_replace("_", " ", $roomcategory))) . '_Room';

    //only for 1 night for deluxe Room conditions
    $checkin =  strtotime($checkin); // or your date as well
    $checkout = strtotime($checkout);
    $datediff = $checkout - $checkin;
    $datediff = $datediff / (60 * 60 * 24);

    $promodata = Promocode::with('usedpromo')->where('code', $coupon_code)->where('category', $room_category)->first();
    $promo_id = (!empty($promodata)) ? $promodata->id : 0;

    if ($promo_id != 0 && in_array($promo_id, $arr)) {
      echo json_encode(array('status' => 'error', 'message' => 'Invalid promocode'));
      die;
    } else if (round($datediff) > 1 && $roomcategory == "deluxe") {
      echo json_encode(array('status' => 'error', 'message' => 'You can Book Room only for 1 Night with this promocode.'));
      die;
    } else if ($no_of_rooms > 1 && $roomcategory == "deluxe") {
      echo json_encode(array('status' => 'error', 'message' => 'You can Book only 1 Room with this promocode.'));
      die;
    } else {
      $promodata = Promocode::with('usedpromo')->whereNotIn('id', $arr)->where('code', $coupon_code)->where('category', $room_category)->first();
    }
    // }

    if (!empty($promodata)) {
      $this->IsApplicablepromocode($promodata, $net_total_amt, $roomcategory, $subtotal_meal_amt, $order_id, $checkin, $checkout, $additional_amount);
    } else {
      echo json_encode(array('status' => 'error', 'message' => 'Invalid promocode'));
      die;
    }
  }


  public function IsApplicablepromocode($promodata, $net_total_amt, $roomcategory, $subtotal_meal_amt, $order_id, $checkin, $checkout, $additional_amount)
  {
    $type_of_discount = $promodata['type_of_discount'];
    $discount = $promodata['discount'];
    $max_discount = $promodata['max_discount'];
    $min_order_value = $promodata['min_order_value'];
    $validity_period = explode('-', $promodata['validity_period']);
    $from_time = $promodata['from_time'];
    $to_time = $promodata['to_time'];
    $type_of_customer = $promodata['type_of_customer'];

    //$time = time() + env('TIMEZONE');
    //$date = date('d-m-Y H:i');

    $validity_start_date = strtotime(trim($validity_period[0] . ' 12:00 AM'));
    $validity_to_date = strtotime(trim($validity_period[1]) . ' 11:59:59 PM');

    $validity_start_time = strtotime(date('d-m-Y ') . $from_time);
    $validity_to_time = strtotime(date('d-m-Y ') . $to_time);

    // if($validity_start_date <= time() && time() <= $validity_to_date){
    //if(time() >= $validity_start_time && time() <= $validity_to_time){
    if (($checkin >= $validity_start_date && $checkin <= $validity_to_date) || ($checkout >= $validity_start_date && $checkout <= $validity_to_date)) {

      if ((time() >= $validity_start_time && time() <= $validity_to_time) || (time() >= $validity_start_time && time() <= $validity_to_time)) {

        if ($net_total_amt  < $min_order_value) {
          echo json_encode(array('status' => 'error', 'message' => 'Minimum order must be ' . $min_order_value . ' Rs.'));
          die;
        } else {
          if ($type_of_customer == 'new') {
            $is_txn_exist = Transaction::where('user_id', $current_user_id)->first();
            if (empty($is_txn_exist)) {
              if ($type_of_discount == 'net') {
                $dicounted_amt = $discount;
              } else {
                $dicounted_amt = ($net_total_amt * $discount) / 100;
                if ($dicounted_amt > $max_discount) {
                  $dicounted_amt = $max_discount;
                }
              }

              $net_amount_data = ($type_of_discount == "net" && $roomcategory == "deluxe") ? $this->updateRoomPrices($promodata, $subtotal_meal_amt, $order_id, $additional_amount) : '';
              echo json_encode(array('status' => 'success', 'message' => 'Congrats!! Promocode has applied.', 'dicounted_amt' => $dicounted_amt, 'net_amount_data' => $net_amount_data));
              die;
            } else {
              echo json_encode(array('status' => 'error', 'message' => 'Offer is applicable for first time user only.'));
              die;
            }
          } else {
            if ($type_of_discount == 'net') {
              $dicounted_amt = $discount;
            } else {
              $dicounted_amt = ($net_total_amt * $discount) / 100;
              if ($dicounted_amt > $max_discount) {
                $dicounted_amt = $max_discount;
              }
            }
            $net_amount_data = ($type_of_discount == "net" && $roomcategory == "deluxe") ? $this->updateRoomPrices($promodata, $subtotal_meal_amt, $order_id, $additional_amount) : '';

            echo json_encode(array('status' => 'success', 'message' => 'Congrats!! Promocode has applied.', 'dicounted_amt' => $dicounted_amt, 'net_amount_data' => $net_amount_data));
            die;
          }
        }
      } else {

        echo json_encode(array('status' => 'error', 'message' => 'Offer is not valid at this time.'));
        die;
      }
    } else {

      echo json_encode(array('status' => 'error', 'message' => 'Offer is not valid at this time.'));
      die;
    }
  }


  public function updateRoomPrices($promodata, $subtotal_meal_amt, $order_id, $additional_amount)
  {
    $room_tax = $promodata->max_discount * env('DEFAULT_ROOM_TAX_RATE') / 100;
    $tax_total_amount = $room_tax + $promodata->max_discount;
    $food_tax = $subtotal_meal_amt * env('DEFAULT_MEAL_TAX_RATE') / 100;
    $tax_include_taxes =  $promodata->max_discount + $room_tax + $subtotal_meal_amt + $food_tax;

    $promo_amount = ($promodata->type_of_discount == "net") ? 0.00 : ($tax_include_taxes * $promodata->discount) / 100;

    $payable_amount = (float)$additional_amount + ($tax_include_taxes - $promo_amount);

    return array('final_amount' => number_format(
      (float)$promodata->max_discount,
      2,
      '.',
      ''
    ), 'room_tax' => (float)$room_tax, 'meal_amount' => $subtotal_meal_amt, 'food_tax' => (int)$food_tax, 'tax_include_taxes' => number_format((float)$tax_include_taxes, 2, '.', ''), 'promo_amount' => $promo_amount, 'payable_amount' => $payable_amount);
  }
  public function generateRoomPDF($txnid, $generate_type)
  {
    $getallData = Transaction::where('txnid', $txnid)->first();
    if (!empty($getallData)) {
      $addres_setting = Setting::where('key', 'address')->first();
      $phone_setting = Setting::where('key', 'phone_number')->first();

      $checkout_form_data = json_decode($getallData['checkout_form_data'], true);
      $room_title = '';
      $total_room = '';
      $total_guest = '';
      $total_child = 0;
      $per_shift_price = '';
      $room_image = '';
      $room_category = '';

      $room_number = "";
      if ($getallData->room_number != null) {
        foreach (json_decode($getallData->room_number) as $room_key => $room_value) {
          $commasep = ($room_key >= 1) ? ',' : '';
          $room_number =  $room_number . '' . $commasep . '' . $room_value;
        }
      }

      foreach ($checkout_form_data['item'] as $key => $value) {
        if ($key == 'room_title')
          $room_title = $value;

        if ($key == 'per_shift_price')
          $per_shift_price = $value;

        if ($key == 'room')
          $total_room = $value;

        if ($key == 'guest')
          $total_guest = $value;

        if ($key == 'children')
          $total_child = $value;

        if ($key == 'room_image')
          $room_image = $value;

        if ($key == 'room_category')
          $room_category = ($value == "super") ? "Super Deluxe" : $value;
      }

      $total_child = ($total_child == null) ? 0 : $total_child;

      $date = date_create($checkout_form_data['checkin']);
      $date1 = date_create($checkout_form_data['checkout']);
      $checkin = date_format($date, "F d, Y");
      $checkout = date_format($date1, "F d, Y");

      $date2 = date_create($checkout_form_data['checkin']);
      $date3 = date_create($checkout_form_data['checkout']);
      $diff = date_diff($date2, $date3);
      $days = $diff->format("%a ");
      $days = ucfirst($days);
      $transactionId = strtoupper($getallData['txnid']);
      $pin_code = strtoupper($getallData['pin_code']);
      $issued_date = date('F d,Y', strtotime($getallData['created_at']));
      $room_category = ucwords(str_replace('_', ' ', $room_category));

      //food loop
      if ($getallData->room_number != null) {
        $roomNumber = json_decode($getallData->room_number, true);
        $items_data = Transaction::where('room_number', 'like', '["%' . $roomNumber[0] . '"]')->whereBetween('created_at', [$checkout_form_data['checkin'] . ' 00:00:00', $checkout_form_data['checkout'] . ' 23:59:00'])->where('txn_type', 'ITEM')->get();
      }

      // $service_arr = '';
      // $service_arr1 = '';
      // $service_final_arr = '';
      // if (!empty($items_data) && $getallData['f_status'] == "C") {
      //   $subtotal = 0;
      //   $subtotal_taxes = 0;
      //   $subtotal_donate = 0;
      //   $subtotal_rider = 0;
      //   $net_total_amt = 0;
      //   $subtotal_tti_credit = 0;
      //   $subtotal_tti_rewardpoint = 0;
      //   $promocode_deduction = 0;
      //   $grand_total_amt = 0;

        // foreach ($items_data as $key1 => $value1) {
        //   $itemcheckoutdata = json_decode($value1['checkout_form_data'], true);
        //   foreach ($itemcheckoutdata['item'] as $it_key => $it_value) {
        //     $service_arr = $service_arr . '<tr><td height="7"></td><td height="7"></td></tr> <tr><td valign="top" style=" width:80%"><div style="font-size: 12px; color: #fff; font-weight:400; font-family: "Raleway", sans-serif; margin:0; padding-bottom:5px;"><span style="width:58px; display:inline-block;">' . $it_value['quantity'] . 'x ' . $it_value['price'] . '</span><img src="' . env('APP_URL') . 'public/img/order-img.png"><span style="display:inline-block; padding-left:18px;">' . $it_value['name'] . '</span></div> </td><td valign="top" style="width:20%; text-align: right; font-size:12px; line-height:12px;"> Rs.' . number_format((float)$it_value['final_price'], 2, '.', '') . ' </td></tr>';
        //   }

        //   $subtotal += $itemcheckoutdata['subtotal_amt'];
        //   $subtotal_taxes += $itemcheckoutdata['subtotal_taxes'];
        //   $subtotal_donate += $itemcheckoutdata['subtotal_donate'];
        //   $subtotal_rider += $itemcheckoutdata['subtotal_rider'];
        //   $net_total_amt += $itemcheckoutdata['net_total_amt'];
        //   $subtotal_tti_credit += $itemcheckoutdata['subtotal_tti_credit'];
        //   $subtotal_tti_rewardpoint += $itemcheckoutdata['subtotal_tti_rewardpoint'];
        //   $promocode_deduction += $itemcheckoutdata['promocode_deduction'];
        //   $grand_total_amt += $itemcheckoutdata['grand_total_amt'];
        // }

      //   $service_arr1 = '<tr><td style="border-bottom: 1px solid #f1f1f1; padding-top:10px;"></td><td style="border-bottom: 1px solid #f1f1f1; padding-top:10px;"></td></tr><tr><td valign="middle" style="width:70%; padding:3px 0;"><div style="font-size: 13px; color: #fff; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Sub Total:</div></td><td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">Rs. ' . number_format((float)$subtotal, 2, '.', '') . '</td></tr><tr><td valign="middle" style="width:70%; padding:3px 0;"><div style="font-size: 13px; color: #fff; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Taxes:</div></td><td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">Rs. ' . number_format((float)$subtotal_taxes, 2, '.', '') . '</td></tr><tr><td valign="middle" style="width:70%; padding:3px 0;"><div style="font-size: 13px; color: #fff; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Donation:</div></td><td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">Rs. ' . number_format((float)$subtotal_donate, 2, '.', '') . '</td></tr><tr><td valign="middle" style="width:70%; padding:3px 0;"><div style="font-size: 13px; color: #fff; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Support Rider:</div></td><td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">Rs. ' . number_format((float)$subtotal_rider, 2, '.', '') . '</td></tr><tr><td valign="middle" height="3" style="width:70%; padding:3px 0;"></td><td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;"></td></tr><tr><td valign="middle" style="width:70%; padding:4px 10px; background:#fff; "><div style="font-size:16px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Total :</div></td><td valign="middle" style="width:30%; padding:4px 10px;  background:#fff; color:#222; font-weight: 700; text-align: right; font-size:16px; line-height:14px;">Rs. ' . number_format((float)$net_total_amt, 2, '.', '') . '</td></tr><tr><td valign="middle" height="3" style="width:70%; padding:3px 0;"></td><td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right;font-size:13px; line-height:14px;"></td></tr><tr><td valign="middle" style="width:70%; padding:3px 0;"><tr><td valign="middle" style="width:70%; padding:3px 0;"><tr><td valign="middle" style="width:70%; padding:3px 0;"><div style="font-size: 13px; color: #fff; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Promocode :</div></td><td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">Rs. ' . number_format((float)$promocode_deduction, 2, '.', '') . '</td></tr><tr><td valign="middle" height="3" style="width:70%; padding:3px 0;"></td><td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;"></td></tr><tr><td valign="middle" style="padding:4px 10px; width:70%;  background:#fff;"><strong style="text-transform: uppercase;font-size:16px; color: #222; font-weight: 700; display: block;">Payable Amount:</strong></td><td valign="middle" style="padding:4px 10px;  background:#fff; width:30%; text-align: right;"><strong style="text-transform: uppercase; font-size:16px; line-height:16px; color: #222; font-weight: 700; display: block;">Rs. ' . number_format((float)$grand_total_amt, 2, '.', '') . '</strong</td></tr>';
      // }

      // if ($service_arr != '') {
      //   //$service_final_arr = $service_arr.''.$service_arr1;
      //   $service_final_arr = '<tr><td><table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="background: #222; padding:10px 10px 5px; color:#fff;"><tr>
      //           <td colspan="2" style="text-align:center;text-transform: uppercase; font-size:14px; line-height:16px; font-weight: 700; padding:8px 5px 8px 10px; background:#fae17c; color:#000;">Order Item List</td></tr><tr><td style="height:3px;"></td><td style="height:3px;"></td></tr>' . $service_arr . '' . $service_arr1  . '<tr><td style="height:10px;"></td><td style="height:10px;"></td></tr><tr><td style="border-top: 1px solid #f1f1f1; padding-top:10px;"></td><td style="border-top: 1px solid #f1f1f1; padding-top:10px;"></td></tr></table></td></tr>';
      // } else {
      //   $service_final_arr = '';
      // }

      $additional_charges = '';
      if (array_key_exists('extra_charges', $checkout_form_data)) {
        if (array_key_exists('minus_peoples_amount', $checkout_form_data))
          $extra_charges_amount = $checkout_form_data['minus_peoples_amount'];
        else
          $extra_charges_amount = $checkout_form_data['add_peoples_amount'];

        $extra_charges = $checkout_form_data['extra_charges'];
        $additional_charges = '<tr><td valign="top" style="width:70%;"><div style="font-size: 12px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;"><strong style=" color: #222; font-weight: 700; display: block; padding-top: 10px;">Additional Charges <small style="font-size: 11px;color: red;line-height: 13px;display: block;">(' . $extra_charges . ')</small></strong></div></td><td valign="top" style="width:30%; text-align: right; font-size:12px;"><strong style="color: #222; font-weight: 700; display: block; padding-top: 10px;"> Rs.' . $extra_charges_amount . '</strong></td></tr>';
      }
      /************************PDF Generate *******************************************/
      $messagehtml = '
        <html>
          <head></head>
          <body>
          <div class="table-responsive">
            <table border="0" cellpadding="0" cellspacing="0" style="font-family: "Raleway", sans-serif;" align="center">
              <tr>
                <td align="center">
                  <table border="0" cellpadding="0" cellspacing="0" style="width:600px; margin:0 auto;">
                    <tr>
                      <td style="padding-bottom:10px;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                          <tr>
                            <td valign="top" width="500" style="vertical-align:bottom;">
                              <h1 style="text-transform: uppercase; font-size:22px; font-weight:500; margin:0;">Invoice</h1>
                            </td>
                            <td valign="top" width="100">
                              <img src="' . env('APP_URL') . 'img/logo.png" alt="Img" style="text-align: right; width:100px;">
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-bottom:1px solid #d9d9d9"></td>  
                    </tr>
                    <tr>
                      <td style="height:10px"></td>  
                    </tr>
                    <tr>
                      <td>
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                          <tr>
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding-bottom:4px; width:200px;">Transaction ID</th>
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding:0 10px 4px;">PIN CODE</th>
                           
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding:0 10px 4px;">Date Of Booking</th>
                            <th> </th>
                          </tr>
                          <tr>
                            <td style="font-size:12px; color:#666;">' . $transactionId . '</td>
                            <td style="font-size:12px; color:#666;">' . $pin_code . '</td>
                            <td style="font-size:12px; color:#666; padding:0 10px 6px;">' . $issued_date . '</td>
                            <td> </td>
                          </tr>
                          <tr>
                            <td height="5"></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding-bottom:4px;">Billed to</th>
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding:0 10px 4px;">Hotel The Trade Fair</th>
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding-bottom:4px;">Booking</th>
                          </tr>
                          <tr>
                            <td style="font-size:12px; color:#666;" valign="top">
                              <p style="font-size:12px; color:#666; margin:0;">' . $checkout_form_data['customerName'] . '</p>
                              <p style="font-size:12px; color:#666; margin:0;">' . $checkout_form_data['customerEmail'] . '</p>
                              <p style="font-size:12px; color:#666; margin:0;">+91' . $checkout_form_data['customerPhone'] . '</p>
                            </td>
                            <td style="vertical-align:top;font-size:12px; color:#666; width:280px; padding:0 10px 4px;">
                              <address style="font-size: 12px; color: #2e2e2e; font-weight:400; font-style: normal; margin:0; padding-bottom:5px;">' . $addres_setting->value . '</address>
                              <div style="font-size: 12px; color: #e4c64d; text-decoration: none;  margin:0; padding-bottom:12px;">' . $phone_setting->value . '</div>
                            </td>
                            <td style="font-size:12px; color:#666;" valign="top">
                              <div style="font-size:12px; color:#666; margin:0;">' . $checkin . ' - ' . $checkout . '</div>
                              <div style="font-size:12px; color:#666; margin:0;">' . $total_room . ' Room</div>
                              <div style="font-size:12px; color:#666; margin:0;">' . $total_guest . ' Guests, ' . $total_child . ' Childrens</div>
                              <div style="font-size:12px; color:#666; margin:0;"><b>Room Number </b> : ' . $room_number . '</div>
                            </td>
                          </tr>
                          <tr>
                            <td height="5"></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding-bottom:6px;">Check In</th>
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding:0 10px 6px;">Check Out</th>
                            <th style="font-size:12px; font-weight:700; color:#000; text-align: left; padding-bottom:6px;">ROOM DETAILS</th>
                          </tr>
                          <tr>
                            <td style="font-size:12px; color:#666;" valign="top">After 12:00 PM</td>
                            <td style="font-size:12px; color:#666; padding:0 10px 6px;" valign="top">Before 11:00 AM</td>
                            <td style="font-size:12px; color:#666;" valign="top">' . $room_category . ' Room</td>
                          </tr>
                        </table>      
                      </td>
                    </tr>
                    <tr>
                      <td height="5"></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>
                        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="background: #fffcf1; padding: 12px 12px 3px;">
                            <tr>
                              <td valign="top" style=" width:70%">
                                <div style="font-size: 12px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Room Total Price</div>
                              </td>
                              <td valign="top" style="width:30%; text-align: right; font-size:12px;">Rs. ' . $checkout_form_data['subtotal_amt'] . '</td>
                            </tr>
                            <tr>
                              <td height="2"></td>
                              <td height="2"></td>
                            </tr>
                            <tr>
                              <td valign="top" style="width:70%;">
                                <div style="font-size: 12px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Room Tax</div>
                              </td>
                              <td valign="top" style="width:30%; text-align: right; font-size:12px;">Rs.' . $checkout_form_data['subtotal_taxes'] . '</td>
                            </tr>
                            <tr>
                              <td height="2"></td>
                              <td height="2"></td>
                            </tr>
                           
                            <tr>
                              <td valign="top" style="width:70%;">
                                <div style="font-size: 12px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">
                                  <strong style="text-transform: uppercase; color: #222; font-weight: 700; display: block; border-top: 1px solid #d9d9d9;border-bottom: 1px solid #d9d9d9; padding-top:5px; padding-bottom:5px;">Total Amount</strong>
                                </div>
                              </td>
                              <td valign="top" style="width:30%; text-align: right; font-size:12px;">
                                <strong style=" color: #222; font-weight: 700; display: block; border-top: 1px solid #d9d9d9;border-bottom: 1px solid #d9d9d9; padding-top: 5px; padding-bottom:5px;">Rs.' . $checkout_form_data['net_total_amt'] . '</strong>
                              </td>
                            </tr> 
      
                            <tr>
                              <td height="2"></td>
                              <td height="2"></td>
                            </tr> 
                            ' . $additional_charges . '
                            <tr>
                                <td height="2"></td>
                                <td height="2"></td>
                            </tr> 
                            <tr>
                                <td valign="top" style="width:70%;">
                                  <div style="font-size: 12px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;"><strong style=" color: #222; font-weight: 700; display: block; padding-top: 10px;">Promocode</strong></div>
                                </td>
                                <td valign="top" style="width:30%; text-align: right; font-size:12px;"><strong style="color: #222; font-weight: 700; display: block; padding-top: 10px;">- Rs.' . $checkout_form_data['promocode_deduction'] . '</strong></td>
                            </tr>
                            <tr>
                                <td height="2"></td>
                                <td height="2"></td>
                            </tr>
                            
                            
                            <tr>
                                <td valign="top" style="width:70%;">
                                  <div style="font-size: 12px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Payable Amount</div>
                                </td>
                                <td valign="top" style="width:30%; text-align: right; font-size:12px;">Rs.' . $checkout_form_data['grand_total_amt'] . '</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #d9d9d9; padding-bottom:0;"></td>
                                <td style="border-bottom: 1px solid #d9d9d9; padding-bottom:0;"></td>
                            </tr>
                            <tr>
                                <td style="height:10px;"></td>
                                <td style="height:10px;"></td>
                            </tr>
                             <tr>
                                <td valign="top" style="width:70%;">
                                  <div style="font-size: 12px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Advanced Payment</div>
                                </td>
                                <td valign="top" style="width:30%; text-align: right; font-size:12px;">Rs.' . $checkout_form_data['f_total_amt'] . '</td>
                            </tr>
                            <tr>
                                <td style="height:10px;"></td>
                                <td style="height:10px;"></td>
                            </tr>
      
                        </table>
                      </td>
                    </tr>
                   
                  </table>
                </td>
              </tr>
            </table>
            </div>
          </body>
        </html>';

      if ($generate_type == "downl_invoice") {
        require_once base_path() . '/vendor/dompdf/autoload.inc.php';
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($messagehtml);
        @$dompdf->render();
        $filename = "Invoice.pdf";
        $dompdf->stream($filename);
      } else {
        echo $messagehtml;
        die;
      }
    }

    /*******************************************************************/
  }
}
