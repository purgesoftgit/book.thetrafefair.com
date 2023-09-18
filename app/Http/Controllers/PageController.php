<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\{Blog, Category, PhoneVerification, Setting, User, Job, RoomCategory};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\VarDumper\Cloner\Data;

class PageController extends Controller
{
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

        $categories = Category::all();

        return view('blogs.blog', compact('blogs', 'categories', 'categoryFilter'));
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
       

        if($request->url_str == "register"){
            $user = User::where('phone_number', '+91' . $request->data)->count();
            if($user > 0){
                return response()->json(['status' => 500,'error'=>'Already registered.']);
            }else{
                $this->updateInsertVerification( $request->data);
            }
        }else{
            $user = User::where('phone_number', '+91' . $request->data)->count();
            if($user == 0){
                return response()->json(['status' => 500,'error'=>'Not a registered user. Please Register to continue.']);
            }else{
                $this->updateInsertVerification( $request->data);
            }
        }
       
      
        // } else if ($phoneVerification != null) {
        //     PhoneVerification::where('phone', '+91' . $request->data)->update(['is_varify' => '0']);
        // } else {
        //     PhoneVerification::create([
        //         'phone' => '+91' . $request->data,
        //         'otp' => 1234,
        //         'is_verifiy' => 0,
        //     ]);
        // }
    }


    public function updateInsertVerification($phone_number){

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
            return response()->json(["status" => 500, "error" => "Invalid OTP"]);
        } else {
            $phoneVerification = PhoneVerification::where('phone', $number)->first();
            PhoneVerification::where('phone', $number)->update(['is_varify' => '1']);
            return response()->json(["data" => $number]);
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



        User::insert([
            "username" => str_replace(' ', '_', strtolower($request->first_name) . strtolower($request->last_name)),
            "first_name" => ucfirst($request->first_name),
            "last_name" => ucfirst($request->last_name),
            'email' => $request->input('email'),
            "phone_number" => '+91' . $request->input('phone_number'),
            "password" => bcrypt(env('AUTO_PASSWORD')),
            "remember_token" => $request->_token,
            "created_at" => date("Y-m-d"),
            'email_verifid_token' => null,
        ]);

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
        //  User::where('id', $userProfile->id)->update([
        //     "username" => str_replace(' ', '_', strtolower($request->first_name) . strtolower($request->last_name)),
        //     "first_name" => ucfirst($request->first_name),
        //     "last_name" => ucfirst($request->last_name),
        //     'email' => $request->input('email'),
        //     "phone_number" => '+91' . $request->input('phone_number'),
        //     "remember_token" => $request->_token,
        //     "updated_at" => date("Y-m-d"),
        //     'email_verifid_token' => null,
        // ]);

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
    public function rooms()
    {   
        $rooms = RoomCategory::all();
        return view('rooms', compact('rooms'));
    }

    public function getRoomsAjax(Request $request)
    {

      $data = $request->all();
      $page = (isset($data['page']) && ($data['page'] == 'room_rates')) ? 1 : 0 ; 

      $rooms = RoomCategory::with('roomadditionaldata')->orderby('id','DESC')->get();
      
      if($rooms){
        foreach($rooms as $key => $value){
          if($value->roomadditionaldata){
            foreach($value->roomadditionaldata as $room_key => $room_value){
              if(date('Y-m-d') == $room_value['date']){
                $value['final_price'] = $room_value['price'];
                $value['new_old_price'] = $room_value['old_price'];
                $value['new_off_percentage'] = $room_value['off_percentage'];
              }
            }
          } 
        }
      }
      
      $room_count = RoomCategory::count();
      
      return view('get-room-ajax',compact('rooms','room_count'));
   
    }

    public function getAvailsRooms($id,$checkin){
        $rooms = RoomCategory::with('roomadditionaldata')->where('id',$id)->first();
        $avails_price = 0;
        $url = env('BACKEND_URL') . 'get-avails-room/' . $id . '/' . $checkin;    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         
        $response = curl_exec($ch);
        if(!$response){
           die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }

        curl_close($ch);
        $data = json_decode($response, true); 
        if ($data === null) {
          die('Error decoding JSON: ' . json_last_error_msg());
        }

        if($rooms){
            if(count($rooms->roomadditionaldata) > 0 && !empty($rooms->roomadditionaldata)){
              foreach($rooms->roomadditionaldata as $room_key => $room_value){
                  if($checkin == $room_value['date']){
                    $rooms['room_avail'] = $room_value['room_avail'];
                    $rooms['avails_price'] = $room_value['price'];
                    $rooms['new_old_price'] = $room_value['old_price'];
                    $rooms['new_off_percentage'] = $room_value['off_percentage'];
                  }
                  
                }
              }
            }
    
        if((isset($rooms['room_avail']) && !empty($rooms['room_avail'])) && (isset($rooms['avails_price']) && !empty($rooms['avails_price'])) || (isset($rooms['new_old_price']) && !empty($rooms['new_old_price'])) || (isset($rooms['new_off_percentage']) && !empty($rooms['new_off_percentage']))){
          return response()->json(['avails_room'=>$rooms['room_avail'],'avails_price'=>$rooms['avails_price'],'old_price'=>$rooms['new_old_price'],'off_percentage'=>$rooms['new_off_percentage']]);
        }else{
          return response()->json(['avails_room'=>$rooms->no_of_rooms,'avails_price'=>$rooms->price,'old_price'=>$rooms['old_price'],'off_percentage'=>$rooms['off_percentage']]);
        }
    
      }

      public function roomDetail($slug)
      {
        $room_detail = RoomCategory::where('slug', $slug)->first();
        $related_room = RoomCategory::where('slug','!=', $slug)->get();
        return view('room-detail', ['room' => $room_detail, "related_room" => $related_room]);
      }

    
    //   public function roomDetail($slug)
    //   {
    //       $room_detail = RoomCategory::where('slug', $slug)->first();
    //       $related_room = RoomCategory::where('slug','!=', $slug)->get();
        
    //       $room = response()->json($room_detail);
  
    //       $data = $room->original;
         
    //       return view('room-detail', ['data' => $data, "related_room" => $related_room]);
    //   }

    public function Logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function terms(){
        return view('terms');
    }
}
