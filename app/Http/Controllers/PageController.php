<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\{Blog, Category, PhoneVerification, User, Job, RoomCategory, Wallet, NotificationPreferece, RoomAdditionalData, Review, ContactUs, SpaReservation, WeddingEnquiry};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\ValidationException;
// use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Str;
// use App\Mail\UserRegisterDetailMail;/

class PageController extends Controller
{

    public function thankyou()
    {
        return view('thankyou');
    }

    public function spa()
    {
        $data = Review::all();
        return view('spa', compact('data'));
    }

    public function meetingpage()
    {
        return view('corporte-meeting-halls');
    }

    public function storeMeetingData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'userlastName' => ['required'],
            'city' => ['required'],
            'dateofevent' => ['required'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'phone' => ['required', 'numeric'],
            'numberofguest' => ['required'],
            'company' => ['required'],
            'booking_purpose' => ['required'],
            'message' => ['required'],
            'g-recaptcha-response' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $contact = new ContactUs;
        $contact->selected_website = 1; //1 for thetradefair
        $contact->name = ucwords($request->name);
        $contact->email = $request->email;
        $contact->phone = '+91' . $request->phone;
        $contact->userlastName = $request->userlastName;
        $contact->city = $request->city;
        $contact->dateofevent = $request->dateofevent;
        $contact->numberofguest = $request->numberofguest;
        $contact->compny = $request->company;
        $contact->is_meeting_contact = 1;
        $contact->message = $request->message;
        $contact->services = $request->booking_purpose;
        $contact->status = 'Unread';
        $contact->save();

        return redirect('thankyou');
    }
    public function contactStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'phone' => ['required', 'numeric'],
            'message' => ['required'],
            'g-recaptcha-response' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back();
        }

        $data = new ContactUs;
        $data->selected_website = 1; //1 for thetradefair
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->message = $request->message;
        $data->status = 'Unread';
        $data->save();

        return redirect('thankyou');
    }

    public function spaReservation(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:3'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'selectedPeople' => 'required',
            'request_message' => ['required'],
            'g-recaptcha-response' => ['required']
        ]);

       
        $data = new SpaReservation;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->selectedPeople = $request->input('selectedPeople');
        $data->request_message = $request->request_message;
        $data->save();
        return redirect('thankyou');
        // return redirect()->route('home')->with(['status'=>200,'message'=>"Your request is in processing."]);
    }

    public function wedding(){
        return view('wedding');
    }
    
    public function saveWeddingEnquiry(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'phone' => ['required'],
            'city' => ['required'],
            'enquiry' => ['required'],
            'g-recaptcha-response' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $data = new WeddingEnquiry;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->city = $request->city;
        $data->enquiry = $request->enquiry;
        
        $data->save();

        return redirect('thankyou');
    }
    public function about()
    {
        return view('about');
    }
    public function blog(Request $request)
    {
        $categoryFilter = $request->query('category');

        $category = Category::where('slug', $categoryFilter)->first();

        $categoryValue = '';
        if ($category) {
            $categoryValue = $category->value;
        }

        $query = Blog::where('type', 1);

        if ($categoryFilter) {
            $query->where('category', $categoryValue);
        }

        $blogs = $query->get();

        $latest_blog = Blog::where('type', 1)->get();
        $categories = Category::all();

        return view('blogs.blog', compact('blogs', 'categories', 'categoryFilter', 'latest_blog'));
    }

    public function blogDetail($slug)
    {
        $blog_detail = Blog::where('slug', $slug)->first();
        $categories = Category::all();
        $latest_blog = Blog::where('id', '!=', $blog_detail->id)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();


        if ($blog_detail) {
            $tagsString = $blog_detail->tags;
            $tagsArray = explode(',', $tagsString);
        }

        return view('blogs.blog-detail', compact('blog_detail', 'categories', 'latest_blog', 'tagsArray'));
    }

    public function register()
    {
        return view('user.register');
    }

    public function phoneVerification(Request $request)
    {
        if ($request->url_str == "register") {
            $user = User::where('phone_number', '+91' . $request->data)->count();
            if ($user > 0) {
                return response()->json(['status' => 500, 'error' => 'Already registered.']);
            } else {
                $this->updateInsertVerification($request->data);
            }
        } else if ($request->url_str == "room") {
            $this->updateInsertVerification($request->data);
        } else {
            $user = User::where('phone_number', '+91' . $request->data)->count();
            if ($user == 0) {
                return response()->json(['status' => 500, 'error' => 'Not a registered user. Please Register to continue.']);
            } else {
                $this->updateInsertVerification($request->data);
            }
        }
    }

    public function updateInsertVerification($phone_number)
    {

        $phoneVerification = PhoneVerification::where('phone', '+91' . $phone_number)->first();

        if ($phoneVerification != null) {
            PhoneVerification::where('phone', '+91' . $phone_number)->update(['is_varify' => '0', 'otp' => 1234]);
        } else {
            PhoneVerification::create([
                'phone' => '+91' . $phone_number,
                'otp' => 1234,
                'is_verifiy' => 0,
            ]);
        }
    }


    public function otp(Request $request)
    {
        $number = '+91' . $request->number;
        $otp = $request->codeBox;

        $phoneVerification = PhoneVerification::where('phone', $number)->first();

        if ($phoneVerification['otp'] != $otp) {
            return response()->json(["status" => 500, "error" => "Invalid OTP", "is_verify" => 0]);
        } else {
            $phoneVerification = PhoneVerification::where('phone', $number)->first();
            PhoneVerification::where('phone', $number)->update(['is_varify' => '1']);
            return response()->json(["status" => 200, "success" => "Valid OTP", "is_verify" => 1]);
        }
    }
    public function registerData(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'phone_number' => [
                'required',
                'string',
                Rule::unique('users')->ignore(auth()->user()->id ?? null),
            ],
            'g-recaptcha-response' => 'required',
            "checkbox_value" => 'required',
        ]);

        // User::insert([
        //     "username" => str_replace(' ', '_', strtolower($request->first_name) . strtolower($request->last_name)),
        //     "first_name" => ucfirst($request->first_name),
        //     "last_name" => ucfirst($request->last_name),
        //     'email' => $request->input('email'),
        //     "phone_number" => '+91' . $request->input('phone_number'),
        //     "password" => bcrypt(env('AUTO_PASSWORD')),
        //     "remember_token" => $request->_token,
        //     "created_at" => date("Y-m-d"),
        //     'email_verifid_token' => null,
        // ]);


        $insert = new User();
        $insert->username = str_replace(' ', '_', strtolower($request->first_name)) . '-' . random_int(100000, 999999);
        $insert->first_name = ucfirst($request->first_name);
        $insert->email = $request->input('email');
        $insert->phone_number = '+91' . $request->input('phone_number');
        $insert->email_verifid_token = Str::random(20);
        $insert->referral_code = strtolower(Str::random(6));
        $insert->password =  bcrypt(env('AUTO_PASSWORD'));
        $insert->save();


        $wallet = new Wallet();
        $wallet->user_id = $insert->id;
        $wallet->amount = env('SELF_SIGNUP_AMOUNT');
        $wallet->message = "Account Signup Amount";
        $wallet->txn_type = 'credit';
        $wallet->amount_type = 'TTI_REWARD';
        $wallet->save();

        $activity_array = ['reviews', 'follow', 'friends_join', 'up_tti', 'weeknesltr', 'prc_sett'];
        $title_array = ['Activity on my reviews', 'Someone follows me', 'My friends join TTI', 'Important updates from TTI', 'Weekly Newsletter', 'Privacy Setting'];

        foreach ($activity_array as $key => $value) {
            $prference = new NotificationPreferece();
            $prference->user_id = $insert->id;
            $prference->activity = $value;
            $prference->title = $title_array[$key];
            $prference->is_email = 'Yes';
            $prference->is_phone = 'Yes';
            $prference->is_active = 'Yes';
            $prference->save();
        }

        //Mail::to($insert['email'])->send(new UserRegisterDetailMail($insert,$randomString));


        return redirect('login');
    }

    public function isVerify(Request $request)
    {
        $number = $request->data;
        $isVerify = PhoneVerification::where('phone', $number)->orWhere('is_varify', 1)->first();
        return response($isVerify);
    }

    public function login()
    {
        return view('user.login');
    }

    public function verifyLogin(Request $request)
    {
        $user = User::where('phone_number', '+91' . $request->phone_number)->first();
        if ($user) {
            Auth::loginUsingId($user->id);
            return redirect('profile');
            // return response()->json(['message' => 'Logged in successfully']);
        } else {
            return redirect()->back();
        }
    }

    public function profile()
    {
        $userProfile = Auth::user('id');
        // dd($userProfile);
        return view('dashboard.profile', compact('userProfile'));
    }

    public function profileUpdate(Request $request)
    {
        //dd($request->all());
        $userProfile = Auth::user('id');
        //dd($userProfile->phone_number,$request->all());
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
        PhoneVerification::where('phone', $userProfile->phone_number)->update(['phone' => '+91' . $request->input('phone_number')]);
        $profile = User::where('id', $userProfile->id)->first();
        $profile->username = str_replace(' ', '_', strtolower($request->first_name) . strtolower($request->last_name));
        $profile->first_name = ucfirst($request->first_name);
        $profile->last_name =  ucfirst($request->last_name);
        $profile->email =  $request->input('email');
        $profile->phone_number = '+91' . $request->input('phone_number');
        $profile->updated_at = date("Y-m-d");
        $profile->email_verifid_token = null;
        $profile->save();
        return redirect('profile');
    }

    public function career()
    {
        $career = Job::all();

        return view('career', compact('career'));
    }
    public function gallery()
    {
        return view('gallery');
    }
    public function contact()
    {
        return view('contactus');
    }
    public function getRooms()
    {
        $slug = '';
        $rooms = $this->fetchAllAdditionalRoomData($slug);

        return view('rooms', compact('rooms'));
    }

    public function getAvailsRooms($id, $checkin)
    {
        $rooms = RoomCategory::with('roomadditionaldata')->where('id', $id)->first();
        $avails_price = 0;
        $url = env('BACKEND_URL') . 'get-avails-room/' . $id . '/' . $checkin;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        if (!$response) {
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }

        curl_close($ch);
        $data = json_decode($response, true);
        if ($data === null) {
            die('Error decoding JSON: ' . json_last_error_msg());
        }

        if ($rooms) {
            if (count($rooms->roomadditionaldata) > 0 && !empty($rooms->roomadditionaldata)) {
                foreach ($rooms->roomadditionaldata as $room_key => $room_value) {
                    if ($checkin == $room_value['date']) {
                        $rooms['room_avail'] = $room_value['room_avail'];
                        $rooms['avails_price'] = $room_value['price'];
                        $rooms['new_old_price'] = $room_value['old_price'];
                        $rooms['new_off_percentage'] = $room_value['off_percentage'];
                    }
                }
            }
        }

        if ((isset($rooms['room_avail']) && !empty($rooms['room_avail'])) && (isset($rooms['avails_price']) && !empty($rooms['avails_price'])) || (isset($rooms['new_old_price']) && !empty($rooms['new_old_price'])) || (isset($rooms['new_off_percentage']) && !empty($rooms['new_off_percentage']))) {
            return response()->json(['avails_room' => $rooms['room_avail'], 'avails_price' => $rooms['avails_price'], 'old_price' => $rooms['new_old_price'], 'off_percentage' => $rooms['new_off_percentage']]);
        } else {
            return response()->json(['avails_room' => $rooms->no_of_rooms, 'avails_price' => $rooms->price, 'old_price' => $rooms['old_price'], 'off_percentage' => $rooms['off_percentage']]);
        }
    }

    public function roomDetail($slug)
    {
        $room_detail = RoomCategory::with('roomadditionaldata')->where('slug', $slug)->first();

        $room_detail = $this->fetchSingleAdditionalRoomData($room_detail);

        $related_room = $this->fetchAllAdditionalRoomData($slug);

        return view('room-detail', ['room' => $room_detail, "related_room" => $related_room]);
    }

    public function fetchSingleAdditionalRoomData($room_detail)
    {
        if ($room_detail) {
            if (count($room_detail->roomadditionaldata) > 0 && !empty($room_detail->roomadditionaldata)) {
                foreach ($room_detail->roomadditionaldata as $room_key => $room_value) {
                    if (date('Y-m-d') == $room_value['date']) {
                        $room_detail['room_avail'] = $room_value['room_avail'];
                        $room_detail['avails_price'] = $room_value['price'];
                        $room_detail['new_old_price'] = $room_value['old_price'];
                        $room_detail['new_off_percentage'] = $room_value['off_percentage'];
                    }
                }
            }
        }

        return $room_detail;
    }

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


    public function Logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function terms()
    {
        return view('terms');
    }

    public function updateRoomAdditionalYearData()
    {

        $room_ids = RoomCategory::where('id', 3)->get();
        $year_arr = [
            1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
        ];

        if (!empty($room_ids) && count($room_ids) > 0) {
            foreach ($room_ids as $key => $value) {

                foreach ($year_arr as $y_key => $y_value) {

                    if ((int)date('m') <= (int)$y_key) {

                        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $y_key, date('Y'));

                        for ($i = 0; $i < $days_in_month; $i++) {
                            $date = date('Y-m-d', strtotime(" +" . $i . " day"));

                            $is_already = RoomAdditionalData::where('date', $date)->where('room_id', $value['id'])->count();

                            if ($is_already == 0) {
                                $room_data = new RoomAdditionalData();
                                $room_data->room_id = $value['id'];
                                $room_data->monthval = $y_value;
                                $room_data->date = $date;

                                $room_data->save();
                            }
                        }
                    }
                }
            }
        }
    }
}
