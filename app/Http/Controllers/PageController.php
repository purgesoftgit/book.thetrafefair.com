<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Setting, User, RoomCategory,GoogleReviews,BookingEngineFacility,RoomServiceCategory, Country, Transaction, Review, UserAddress, Wallet, TempCheckout, UsedPromocode, Promocode, TempUserInfo, FAQ, AskQuestion, NewsLetter,PhoneVerification};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
     //API function start
     public function getRoomImagesApi(){
        $rooms = RoomCategory::get();
        $all_images = [];
        if(!empty($rooms)){
            foreach($rooms as $key => $value){
                $room_images = json_decode($value->image, true);
                foreach($room_images as $img_key => $img_value){
                    array_push($all_images, $img_value);
                }
            }
        }

        $all_images  = json_encode($all_images);

        return view('location-gallery',compact('all_images'));

    }

    public function submitReviewsApi(Request $request){
        $validator = Validator::make($request->all(),array(
            'name' => 'required',
            'description' => 'required',
        ));

        if($validator->fails()){
            return response()->json(["status"=>500,'message'=>'Validation Error.']);
        }

        $review = new Review();
        $review->user_id = 0;
        $review->author_name = $request->name;
        $review->liked = $request->liked;
        $review->review = $request->description;
        $review->rating = $request->rating; 
        $review->selected_website = 2;
        $review->save();
        return response()->json(["status"=>200,'message'=>'Successfully added review.']);

    }

    public function getAllReviewsApi(){
        $reviews = Review::where('selected_website',2)->limit(10)->orderBy('id','desc')->get();
       
        return view('reviews-listing',compact('reviews'));
    }
    //API function end
    
    
    public function location()
    {
        $rooms = RoomCategory::get();
        $all_images = [];
        if(!empty($rooms)){
            foreach($rooms as $key => $value){
                $room_images = json_decode($value->image, true);
                foreach($room_images as $img_key => $img_value){
                    array_push($all_images, $img_value);
                }
            }
        }

        $all_images  = json_encode($all_images);

        $rating_avg = Review::where('selected_website',2)->avg('rating');
        $total_rating = Review::where('selected_website',2)->count();

        $one_rating = Review::where('selected_website',2)->where('rating',0)->where('rating','<=',1)->avg('rating');
        $two_rating = Review::where('selected_website',2)->where('rating','>',1)->where('rating','<=',2)->avg('rating');
        $three_rating = Review::where('selected_website',2)->where('rating','>',2)->where('rating','<=',3)->avg('rating');
        $four_rating = Review::where('selected_website',2)->where('rating','>',3)->where('rating','<=',4)->avg('rating');
        $five_rating = Review::where('selected_website',2)->where('rating','>',4)->where('rating','<=',5)->avg('rating');
 
        return view('location',compact('rating_avg','total_rating','one_rating','two_rating','three_rating','four_rating','five_rating','all_images'));
    }
    
    public function index()
    {
        $faqs = FAQ::all();

        $room = RoomCategory::all();
        $myArr = [];
        foreach ($room as $value) {
            $myArr[] = json_decode($value['image']);
        }
        $resultArray = call_user_func_array('array_merge', $myArr);
        $count = count($resultArray);

        $facilities = BookingEngineFacility::all();

        return view('index', compact('room', 'resultArray', 'count','facilities','faqs'));
    }

    public function Newindex(){
        return view('newIndex');
    }

    public function submitAskQuestion(Request $request)
    {

        $validator = Validator::make($request->all(), array(
            'email' => 'required',
            'question' => 'required',
        ));

        if ($validator->fails()) {
            return redirect('/');
        }

        $askQuestion = new AskQuestion();
        $askQuestion->email = $request->email;
        $askQuestion->question = $request->question;
        $askQuestion->save();

        return redirect('/')->with('success', 'Successfully submit your Request. Team will contact you as soon as possible');
    }

    public function submitBookingEngineReviews(Request $request)
    {
        if ($request->hasFile('image')) {
        $request->validate([
            'image' => 'file|mimes:jpeg,png,jpg,gif',
        ]);
        }
        $review = new GoogleReviews();
        $review->name = $request->name;
        $review->overall_rating = $request->rating;
        $review->room_rating = $request->room_rating;
        $review->service_rating = $request->service_rating;
        $review->location_rating = $request->location_rating;
        $review->experience = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = uniqid() . '.' . $image->getClientOriginalExtension();
            $review->image = $extension;
            $image->storeAs('images', $extension, 'public');
        }
        $review->kind_trip = $request->kind_of_trip;
        $review->travel = $request->travel;
        $review->describe_hotel = $request->describe_hotel;
        $review->more_about = $request->more_about;
        $review->save();

        return response()->json(['status'=>200, 'message'=>'Review submitted successfully!']);
    }



    public function newsletter(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, array(
            'email' => 'unique:newsletters|required',
        ));

        if ($validator->fails()) {
            return redirect()->back()->with('newsletter-failure', 'You are already subscribed to our Newsletter.');
        } else {

            $newsletter = new NewsLetter();
            $newsletter->email = $request->email;
            $newsletter->selected_website=1;
            $newsletter->save();
        }
        return redirect('/')->with('newsletter-success', 'Thank You for subscribing to our Newsletter, We will contact you shortly.');
    }

    public function fetchSingleAdditionalRoomData($room_detail, $checkin)
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
      
        if (isset($request->is_update) && $request->is_update) {
            $temp_user_info = TempUserInfo::where('hash_id', $request->hash_id)->first();
            $temp_user_info->room =  $request->room;
            $temp_user_info->guest =  $request->guest;
            $temp_user_info->room_id = $temp_user_info->room_id;
            $temp_user_info->price = $temp_user_info->price;
            $temp_user_info->with_tax_price = $temp_user_info->with_tax_price;
            $temp_user_info->final_price = $temp_user_info->final_price;
            $temp_user_info->hash_id = $request->hash_id;
            $temp_user_info->save();

            return response()->json(['status' => 200, "message" => "Succesfully Updated Data.", 'room' => $temp_user_info->room, 'guest' => $temp_user_info->guest]);
        }


        $room_guest = explode(" - ", $request->room_guest);

        $room = RoomCategory::with('roomadditionaldata')->where('id', $request->room_id)->first();
        $room_data = $this->fetchSingleAdditionalRoomData($room, $request->checkin);

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


        return response()->json(['status' => 200, "message" => "Succesfully added Data.", "hash_id" => $temp_user_info->hash_id]);
    }
    public function checkoutInformation($slug, $hash)
    {
        $country = Country::get();
        $temp_user_info = TempUserInfo::where('hash_id', $hash)->first();
        $per_room_childrens_allowed = Setting::where('key', 'per_room_childrens_allowed')->first();
        $address = Setting::where('key', 'address')->first();

        $per_room_person = Setting::where('key', "per_room_person")->first();
        $room_detail = RoomCategory::with('roomadditionaldata')->where('slug', $slug)->first();

        Session::put('room_category', $slug);
        Session::put('user_info_hash', $hash);

        $room = $this->fetchSingleAdditionalRoomData($room_detail, $temp_user_info->checkin);

        return view('checkout-info', compact('country', 'temp_user_info', 'per_room_childrens_allowed', 'address', 'per_room_person', 'room'));
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



    public function login(){
        return view('user-login');
    }

    public function verifyLogin(Request $request)
    {
        $user = User::where('phone_number', '+91' . $request->phone_number)->first();
        if (!empty($user)) {
            Auth::loginUsingId($user->id);
            // return view('login-user.dashboard',compact('user'));
            // return redirect()->to($this->getRoomOrderHistory());
            return redirect()->to(('dashboard'));
        } else {
            return redirect()->back()->with('error', 'This number is not registered with us.');
        }
    }

    public function phoneVerification(Request $request)
    {
        // $this->updateInsertVerification($request->data);
        if ($request->url_str == "user-login"){
            $user = User::where('phone_number', '+91' . $request->data)->count();
            if ($user == 0) {
                return response()->json(['status' => 500, 'error' => 'Not a registered user. Please Register to continue.']);
            } else {
                $this->updateInsertVerification($request->data);
            }
        }else{
            $this->updateInsertVerification($request->data);
        }
    }

    public function updateInsertVerification($phone_number)
    {
        //$random_number = rand(1000, 9999);
        $random_number = 1234;
        $phoneVerification = PhoneVerification::where('phone', '+91' . $phone_number)->first();

        if ($phoneVerification != null) {
            $phoneVerification->update(['is_varify' => '0', 'otp' => $random_number]);
        } else {
            PhoneVerification::create([
                'phone' => '+91' . $phone_number,
                'otp' => $random_number,
                'is_verifiy' => 0,
            ]);
        }

        // $sms_text_message = "SECRET OTP is " . $random_number . " for Hotel The Trade International. It's only valid for 5 minutes. - Don't share it - BHSPVT";
        // $this->sendSMSMessage($phone_number, $sms_text_message);
    }


    public function otp(Request $request)
    {
        $number = '+91' . $request->number;
        $otp = $request->codeBox;

        $phoneVerification = PhoneVerification::where('phone', $number)->first();

        if (!empty($phoneVerification) && $phoneVerification['otp'] != $otp) {
            return response()->json(["status" => 500, "error" => "Invalid OTP", "is_verify" => 0]);
        } else {
            $phoneVerification->update(['is_varify' => '1']);
            return response()->json(["status" => 200, "success" => "Valid OTP", "is_verify" => 1]);
        }
    }

    public function userLogout()
    { 
        Auth::logout();
        return redirect('/');
    }

    public function getRoomOrderHistory($status = ''){
        $data = $this->getauthuser();
        $user = $data;
        $category = RoomServiceCategory::get();
        $txn= Transaction::where('user_id',$user->id)->where('txn_type','ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN');
        if($status != ''){
            $room_order_history = $txn->where(function($q) use ($status){
                $q->where('status',$status);
            })->orderby('id','DESC')->paginate(10); 
        }
        else{
            $room_order_history = $txn->where(function($q){
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
        return view('login-user.room-booking-history',compact('room_order_history','category'));
        
    }

     public function getauthuser()
    {
        // $allUsers = User::where('id','!=',Auth::user()->id)->where('role_id','!=',1)->orderBy('id','desc')->get();
        $user = User::where('id', Auth::user()->id)->first();
        return $user;
    }

    public function saveReviews(Request $request)
    {

        if (Auth::check()) {
            $data = $this->getauthuser();
            $user = $data;
        }
        $review = new Review();
        $review->user_id = (isset($user)) ? $user->id : 0;
        $image_arr = [];
        if ($request->item_type == 'room') {

            $review->category = $request->category;
            if ($request->fileUpload) {
                $image = $request->file('fileUpload');
                $is_aws_active = $this->ifAWSKeyisNotResponse();
                if ($is_aws_active == 0) {
                    foreach ($image as $file) {
                        $extention = uniqid() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('/images');
                        $file->move($destinationPath, $extention);
                        array_push($image_arr, $extention);
                    }
                } else {
                    $s3 = \Storage::disk('s3');
                    foreach ($image as $file) {
                        $extention = uniqid() . '.' . $file->getClientOriginalExtension();
                        $s3filePath = '/images/' . $extention;
                        $s3->put($s3filePath, file_get_contents($file), 'public');
                        array_push($image_arr, $extention);
                    }
                }

                $review->image = json_encode($image_arr);
            }
        }
        if ($request->public_review) {
            if ($request->fileUpload) {
                $image = $request->file('fileUpload');
                $is_aws_active = $this->ifAWSKeyisNotResponse();
                if ($is_aws_active == 0) {
                    foreach ($image as $file) {
                        $extention = uniqid() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('/images');
                        $file->move($destinationPath, $extention);
                        array_push($image_arr, $extention);
                    }
                } else {
                    $s3 = \Storage::disk('s3');
                    foreach ($image as $file) {
                        $extention = uniqid() . '.' . $file->getClientOriginalExtension();
                        $s3filePath = '/images/' . $extention;
                        $s3->put($s3filePath, file_get_contents($file), 'public');
                        array_push($image_arr, $extention);
                    }
                }

                $review->image = json_encode($image_arr);
            }

            $review->public_review = 1;
        }

        if ($request->likecomment)
            $review->liked = $request->likecomment;

        if ($request->unlikecomment)
            $review->unliked = $request->unlikecomment;


        if ($request->message)
            $review->review = $request->message;

        $review->item_id = $request->item_id;
        $review->item_type = $request->item_type;
        $review->rating = $request->rating;
        $review->selected_website = 3; // 3 for booking engine
        $review->save();

        if ($request->ajax()) {
            return response()->json(['success' => 200]);
        } else {
            return redirect()->back()->with('success', 'Thank you for submitting your feedback.');
        }
    }


    public function facility(){
        return view('facility');
    }

    public function saveFacility(Request $request)
    {
       $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif',
            'data' => 'required',
        ]);

       $data = new BookingEngineFacility();
       $data->title = $request->title;
       $data->data = $request->data;    
       if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = uniqid() .'.'. $image->getClientOriginalExtension();
            $data->image = $extention;
            $image->storeAs('images', $extention, 'public');
        }
       $data->save();

       return redirect('facility');
    }

}
