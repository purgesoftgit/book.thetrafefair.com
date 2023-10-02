<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\{Blog, Category, PhoneVerification, User, Job, RoomCategory, Wallet, NotificationPreferece, RoomAdditionalData, Review, ContactUs, SpaReservation, WeddingEnquiry, CMSPage, career};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Support\Facades\Date;
use App\Jobs\{ContactUsJob};
use CURLFile;
// use Illuminate\Validation\ValidationException;
// use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Str;
// use App\Mail\UserRegisterDetailMail;/

class PageController extends Controller
{

    public function testMail()
    {
        $contact = ContactUs::where('id', 1)->first();
        dispatch(new ContactUsJob($contact));
    }

    public function getauthuser()
    {
        // $allUsers = User::where('id','!=',Auth::user()->id)->where('role_id','!=',1)->orderBy('id','desc')->get();
        $user = User::where('id', Auth::user()->id)->first();
        return $user;
    }

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

        dispatch(new ContactUsJob($contact));

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
        $data->subject = "contact-us";
        $data->save();

        $subjectAdmin = "Contact Enquiry";
        $subjectUser = "Contact Enquiry";
        $type = $data->is_meeting_contact;

        dispatch(new ContactUsJob($data, $subjectAdmin, $type, $subjectUser));

        // dispatch(new SendToAdminJob($contact,$subjectAdmin,$admin_mail));
        // 			dispatch(new SendToUserJob($type,$name,$subjectUser,$email));


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
        $data->phone = $request->phone;
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

    public function wedding()
    {
        return view('wedding');
    }

    public function saveWeddingEnquiry(Request $request)
    {
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

    public function banquet()
    {
        $data = Review::all();
        return view('banquet', compact('data'));
    }


    public function saveBanquetRequest(Request $request)
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
        $contact->message = $request->message;
        $contact->booking_purpose = $request->booking_purpose;

        $contact->status = 'Unread';
        $contact->save();

        dispatch(new ContactUsJob($contact));

        return redirect('thankyou');
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
        } else if ($request->url_str == "login") {
            $user = User::where('phone_number', '+91' . $request->data)->count();
            if ($user == 0) {
                return response()->json(['status' => 500, 'error' => 'Not a registered user. Please Register to continue.']);
            } else {
                $this->updateInsertVerification($request->data);
            }
        } else {
            $this->updateInsertVerification($request->data);
        }
    }

    public function updateInsertVerification($phone_number)
    {
        //$random_number = rand(1000, 9999);
        $random_number = 1234;
        $phoneVerification = PhoneVerification::where('phone', '+91' . $phone_number)->first();

        if ($phoneVerification != null) {
            PhoneVerification::where('phone', '+91' . $phone_number)->update(['is_varify' => '0', 'otp' => $random_number]);
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
        $insert->login_type = 3;
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
        if (!empty($user)) {
            Auth::loginUsingId($user->id);
            return redirect('room-order-history');
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



    public function career()
    {
        $career = Job::all();

        return view('career', compact('career'));
    }

    public function saveCarrerForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name'     => 'required',
            'last_name'     => 'required',
            'email'    => 'required',
            'phone'    => 'required',
            'job_title'    => 'required',
            'qulification'    => 'required',
            'job_location'    => 'required',
            'job_position'    => 'required',
            'experience'    => 'required',

        ]);

        if ($validator->fails()) {
            return redirect('career')->withErrors($validator)->withInput();
        }

        $career = new career();
        $career->first_name = ucfirst($request->first_name);
        $career->last_name = ucfirst($request->last_name);
        $career->email = $request->email;
        $career->phone_number = '+91' . $request->phone;
        $career->job_title = str_replace("_", " ", $request->job_title);
        $career->job_type = $request->job_type;
        $career->qualification = $request->qulification;
        $career->job_location = ucfirst($request->job_location);
        $career->job_position = str_replace("_", " ", $request->job_position);
        $career->experience = $request->experience;
        $career->selected_website = 1;


        if ($request->resume) {
            $image = $request->resume;

            try{
                $file_extention = $image->getClientOriginalExtension();

            
                $headers = [
                    'Content-Type: multipart/form-data',
                    'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'],
                ];
    
                $fields = [
                    'resume' => new CURLFile($image),
                    'file_extention' => $file_extention
                ];
    
                $url = env('BACKEND_URL')."upload-images";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                $curl_response = curl_exec($ch);
                curl_close($ch);
    
                // $image = $request->file('resume');
                // $is_aws_active = $this->ifAWSKeyisNotResponse();
                // if ($is_aws_active == 0) {
                //     $extention = uniqid() . '.' . $image->getClientOriginalExtension();
                //     $destinationPath = public_path('/images');
                //     $image->move($destinationPath, $extention);
                // } else {
                //     $s3 = \Storage::disk('s3');
                //     $extention = uniqid() . '.' . $image->getClientOriginalExtension();
                //     $s3filePath = '/images/' . $extention;
                //     $s3->put($s3filePath, file_get_contents($image), 'public');
                // }
    
                $career->pdf = $curl_response;
            }catch(Exception $e) {
            }
        }

        $career->save();

        return redirect('thankyou');
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
        // $url = env('BACKEND_URL') . 'get-avails-room/' . $id . '/' . $checkin;
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec($ch);
        // if (!$response) {
        //     die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        // }

        // curl_close($ch);
        // $data = json_decode($response, true);
        // if ($data === null) {
        //     die('Error decoding JSON: ' . json_last_error_msg());
        // }

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

        $about_TTF_city_center = CMSPage::where('slug', 'about-ttf-city-center')->first();
        $facility_TTF_city_center = CMSPage::where('slug', 'facility-ttf-city-center')->first();

        $total_rating = Review::where('item_id', $room_detail->id)->where('item_type', 'room')->sum('rating');
        $total_reviews = Review::where('item_id', $room_detail->id)->where('item_type', 'room')->count();


        return view('room-detail', ['room' => $room_detail, "related_room" => $related_room, "about_TTF_city_center" => $about_TTF_city_center, "facility_TTF_city_center" => $facility_TTF_city_center, "total_rating" => $total_rating, "total_reviews" => $total_reviews]);
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
    public function privacypolicy()
    {
        return view('privacy-policy');
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
        $review->save();

        if ($request->ajax()) {
            return response()->json(['success' => 200]);
        } else {
            return redirect()->back()->with('success', 'Thank you for submitting your feedback.');
        }
    }

    public function updateRoomAdditionalYearData()
    {
        $room_ids = RoomCategory::all();
        $year_arr = [
            1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December"
        ];
        if (!empty($room_ids) && count($room_ids) > 0) {
            foreach ($room_ids as $key => $value) {

                foreach ($year_arr as $y_key => $y_value) {
                    if ((int)date('m') <= (int)$y_key) {
                        $current_date = Date::now();
                        $daysInYear = $current_date->isLeapYear() ? 366 : 365; 
                        $remainingDays = $daysInYear - $current_date->dayOfYear;
                        $month = $y_value;
                        for ($i = 0; $i <= $remainingDays; $i++) {
                            $date = date('Y-m-d', strtotime(" +" . $i . " day"));
                            $newMonth = date('F', strtotime($date));
                            
                            if ($newMonth != $month) {
                                $month = $newMonth;
                            }
                
                            $is_already = RoomAdditionalData::where('date', $date)->where('room_id', $value['id'])->count();
                            if ($is_already == 0) {
                                $room_data = new RoomAdditionalData();
                                $room_data->room_id = $value['id'];
                                $room_data->monthval = $month;
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
