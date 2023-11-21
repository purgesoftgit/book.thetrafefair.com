<?php

namespace App\Http\Controllers\LoginUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User,City,BlogPost,OrderFavourite,OrderHistory,Notification,NotificationPreferece,UserAddress,Reservation,Follow,RecentViewed,Rating,Review,Wallet,Bookmark,Transaction,Setting,RoomServiceCategory,Promocode,RefundUsers,SocialShare,career,TempCheckout,UsedPromocode,RoomCategory};
use Auth;
use Carbon\Carbon;
use View;
use Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
        public function forceDonwload($file)
        { 
            $path = 'images/'.$file;
            try {
                return Storage::disk('s3')->download($path);
            } catch (\Exception $e) {
                $file_path = public_path('images/'.$file);
                if (file_exists($file_path)){
                    return response()->download($file_path);
                }else{
                    return redirect()->back();
                }
            }
        }

        public function getauthuser(){
            $allUsers = User::where('id','!=',Auth::user()->id)->where('role_id','!=',1)->orderBy('id','desc')->get();
            $user = User::with('review','follow','bookmark','bookmark.rastaurant','recentviewed','recentviewed.rastaurant','notipref','order_favourite','order_favourite.rastaurant')->where('id',Auth::user()->id)->first();
            return [$user,$allUsers];
            
        }

        public function index()
        {   
            return view('login-users.profile');
        }

        public function careerlist(){
            $career = career::get();
            return view('career.index',compact('career'));
        }
        public function setting()
        {
            $data = $this->getauthuser();
            $user = $data[0];
            $getCity = City::where('state_id',$user->state)->get();
            return view('login-users.setting',compact('getCity'));
        }
        public function blogPost()
        {
            $blog_post = BlogPost::where('type', 0)->orWhereNull('type')->orderBy('id','desc')->get();
            return view('login-users.blog-post',compact('blog_post'));
        }
        public function deleteCareer($id){
            career::where('id',$id)->delete();
            echo 1;die;
        }

        public function deleteAllCareer($ids)
        {
            $allids = explode(',', $ids);
            if($allids){
               career::whereIn('id',$allids)->delete();
            }
            echo 1;die;
        }

        public function changeCareerStatus(){
            $all_career = career::get();
            if($all_career){
                foreach($all_career as $key => $value){
                    $value->status = 'Read';
                    $value->save();
                }
            }
        }
        public function saveCarrerForm(Request $request){
             $validator = Validator::make($request->all(), [
              //'first_name'     => 'required',
              'last_name'     => 'required',
              'email_address'    => 'required',
              'phone_number'    => 'required',
              'job_title'    => 'required',
              'qulification'    => 'required',
              'job_location'    => 'required',
              'job_position'    => 'required',
              'experience'    => 'required',
               
            ]);

            if ($validator->fails()) {
                return redirect('career#careerForm')->withErrors($validator)->withInput();
            }
            $career = new career();
            $career->last_name = ucfirst($request->last_name);
            $career->email = $request->email_address;
            $career->phone_number = '+91'.$request->phone_number;
            $career->job_title = str_replace("_"," ",$request->job_title);
            $career->qualification = $request->qulification;
            $career->s_qualification = $request->specific_qulification;
            $career->job_location = ucfirst($request->job_location);
            $career->job_type = $request->job_type;
            $career->job_position = str_replace("_"," ",$request->job_position);
            $career->experience = $request->experience;
        
            if($request->resume){
                $image = $request->file('resume');
                $is_aws_active = $this->ifAWSKeyisNotResponse();
                if($is_aws_active == 0){
                    $extention = uniqid().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/images');
                    $image->move($destinationPath, $extention);
                }else{
                    $s3 = \Storage::disk('s3');
                    $extention = uniqid() .'.'. $image->getClientOriginalExtension();
                    $s3filePath = '/images/' . $extention;
                    $s3->put($s3filePath, file_get_contents($image), 'public');
                }
                $career->pdf = $extention;
            }

            $career->save();
            
            return redirect('thankyou');
            //return redirect('/')->with('success',"Your submission is received and we will contact you soon.");
        }

        public function BookARoom()
        {
            $roomcategory = RoomCategory::with('roomadditionaldata')->orderBy('id','desc')->get();
            // $roomcategory = Setting::where("key","room_category")->first();
            // if($roomcategory){
            //     $roomcategory = explode(',', $roomcategory->value);
            //     return view('login-users.book-a-room',compact('roomcategory'));
            // }
      
            return view('login-users.book-a-room',compact('roomcategory'));
        }
        
        public function blogPostDetails($slug)
        { 
            $blog_post = BlogPost::where('slug',$slug)->first();
            $related_blog_post = BlogPost::where('slug','!=',$slug)->where('type','!=',1)->orWhereNull('type')->orderBy('id','desc')->limit(10)->get();

            return view('login-users.blog-post-detail',compact('blog_post',/*'user',*/'related_blog_post'));
        }
        public function addAddress(){
            return view('login-users.add-address');
        }
        public function MyAddress(){
            $data = $this->getauthuser();
            $user = $data[0];
            $address = UserAddress::where('user_id',$user->id)->get();
            return view('login-users.my-addresses',compact(/*'user',*/'address'/*,'allUser'*//*,'total_photos','total_reviews'*/));
        }
        public function saveUserAddress(Request $request){
            $address = new UserAddress();
            $address->address = $request->address;
            $address->user_id = Auth::user()->id;
            $address->category = $request->category;
            $address->to_address = $request->complete_address;
            if($request->floor_add)
                $address->floor =  $request->floor_add;
            if($request->how_reach)
                $address->how_reach =  $request->how_reach;

            $address->save();
            return redirect('my-address')->with('success','Succcefully Added New Address.');
        }
        public function updateUserAddress(Request $request,$id){
            $address = UserAddress::where('id',$id)->first();
            $address->address = $request->address;
            $address->user_id = Auth::user()->id;
            $address->category = $request->category;
            $address->to_address = $request->complete_address;
            if($request->floor_add)
                $address->floor =  $request->floor_add;
            if($request->how_reach)
                $address->how_reach =  $request->how_reach;

            $address->save();
            return redirect('my-address')->with('success','Succcefully Updated your Address.');
        }

        public function changePreferenceStatus($is_email,$is_phone,$activity,$title){

            $old_prference = NotificationPreferece::where('activity',$activity)->where('user_id',Auth::user()->id)->first();
            
            if($old_prference)
            {
            $prference = NotificationPreferece::where('activity',$activity)->where('user_id',Auth::user()->id)->first();
        }else{
            $prference = new NotificationPreferece();
        }

        $prference->user_id = Auth::user()->id;
        $prference->activity = $activity;
        $prference->title = $title;
        $prference->is_email = ($is_email == "true") ? 'Yes':'No';
        $prference->is_phone = ($is_phone == "true") ? 'Yes':'No';
        if($is_email == "true" || $is_phone == "true"){
            $prference->is_active = 'Yes';
        }else{
            $prference->is_active = 'No';
        }
        $prference->save();
        return response()->json(['success'=>200]);
        }


        public function changEmilAddress($email){
            $user = user::where('id',Auth::user()->id)->first();
            $user->email = $email;
            $user->save();
            return response()->json(['success'=>200]);
        }

        public function deleteAddress($id){
            UserAddress::where('id',$id)->delete();
            return redirect()->back();
        }

        public function deleteUserAccount($id){
            $user = User::where('id',$id)->first();
            $user->is_delete = 1;
            $user->save();

            Auth::logout();
            return redirect('login-user');
        }

        public function followUser($id){
            if(Follow::where('follow_user_id',$id)->where('user_id',Auth::user()->id)->count() == 0 )
            {
                $follow = new Follow();
                $follow->user_id = Auth::user()->id;
                $follow->follow_user_id = $id;
                $follow->status = 1;
                $follow->save();

                $title = '';
                $activity_name = "Follow User";
                $activity = "follow";
                $snd_message = 'has follow you, a new Fan @ The Trade Internationl';
                $this->notificationCheck($activity,$snd_message,$title,$activity_name);

                return response()->json(['success'=>200]);
            }else{
                $follow = Follow::where('follow_user_id',$id)->where('user_id',Auth::user()->id)->first();
                $follow->status = 1;
                $follow->save();
            }
        }
        
        public function unFollowUser($id){

            $follow = Follow::where('follow_user_id',$id)->where('user_id',Auth::user()->id)->first();
            $follow->status = 0;
            $follow->save();
            return response()->json(['success'=>200]);
        }

        public function OrderFavourite()
        {
        $order_fav = OrderFavourite::where('user_id',Auth::user()->id)->pluck('order_id');
        if(!empty($order_fav)){
            $data = $this->getauthuser();
            $user_data = $data[0];
            $order_history = Transaction::where('user_id',$user_data->id)->whereIn('id',$order_fav)->orderby('id','DESC')->paginate(10);  
            if(!empty($order_history)){
                foreach($order_history as $value){
                    $address_id = !empty($value['checkout_form_data']) ? json_decode($value['checkout_form_data'], true)['selectedaddress'] : 0;
                    $deliver_address = UserAddress::select('address')->where('id',$address_id)->first();
                }

                $from_address = Setting::where('key','address')->first();
                return view('login-users.favourite',compact('from_address','order_history'));
            }
        }else{
        $from_address = array();
        $order_history = array();
        $deliver_address = array();
        return view('login-users.favourite',compact('from_address','order_history','deliver_address'));
        }
        }
        public function getItemOrderHistory($status=''){

            $data = $this->getauthuser();
            $user = $data[0];
            if($status != ''){
                $order_history = Transaction::where('user_id',$user->id)->where('txn_type','ITEM')->where('status',$status)->orderBy('id','DESC')->paginate(10);  
            }else{
                $order_history = Transaction::where('user_id',$user->id)->where('txn_type','ITEM')->orderby('id','DESC')->paginate(10);  
            }

            if(!empty($order_history)){
                foreach($order_history as $value){
                    if(isset($value['checkout_form_data']['selectedaddress']) != null){
                        $address_id = !empty($value['checkout_form_data']) ? json_decode($value['checkout_form_data'], true)['selectedaddress'] : 0;
                        $deliver_address = UserAddress::select('address')->where('id',$address_id)->first();
                    }
                }

                $from_address = Setting::where('key','address')->first();
                return view('login-users.order-history',compact('from_address','order_history'));
            }
        }

        public function getAllItemOrderStatus(Request $request){
            $request = $request->all();
            if($request){
                $obj_arr = [];
                foreach ($request['txn_id'] as $key => $value) {
                    $transaction_data = Transaction::where('id',$value)->orderby('id','DESC')->first();
                    $status = 'Pending';

                    if(!empty($transaction_data)){
                        if($transaction_data['status'] == 'A'){
                          $status = 'Approved';
                        }else if($transaction_data['status'] == 'R'){
                          $status = 'Ready';
                        }else if($transaction_data['status'] == 'D'){
                          $status = 'Delievered';
                        }else if($transaction_data['status'] == 'C'){
                          $status = 'Cancelled';
                        }else{}
                    }
                    array_push( $obj_arr, ['id'=>$value,'status'=> $status]);
                    
                }
                return $obj_arr;
            }
        }

        public function getRoomOrderHistory($status = ''){
            $data = $this->getauthuser();
            $user = $data[0];
            $category = RoomServiceCategory::get();
            if($status != ''){
                $room_order_history = Transaction::where('user_id',$user->id)->where('txn_type','ROOM')->where(function($q) use ($status){
                    $q->where('status',$status)->where('status','ROOM_CANCELLED')->orWhereIn('f_status',['U','C','IH']);
                })->orderby('id','DESC')->paginate(10); 
            }
            else{
                //$room_order_history = Transaction::where('user_id',$user->id)->where('txn_type','ROOM')->where('status','ROOM_CANCELLED')->orWhereIn('f_status',['U','C','IH'])->orderby('id','DESC')->paginate(10);
                $room_order_history = Transaction::where('user_id',$user->id)->where('txn_type','ROOM')->where(function($q){
                    $q->orWhereIn('f_status',['U','C','IH'])->orWhere('status','ROOM_CANCELLED');
                })->orderBy('updated_at','desc')->orderby('id','DESC')->paginate(10);
            }

            return view('login-users.room-order-history',compact('room_order_history','category'));
            
        }
        public function getRefundHistory(Request $request){
            if($request->startDate == "" && $request->endDate == ""){
                $refund_data = RefundUsers::where('user_id',$request->user_id)->get();
            }else{
                $refund_data = RefundUsers::where('user_id',$request->user_id)->whereBetween('created_at',[$request->startDate.' 00:00:00',$request->endDate.' 23:59:00'])->get();
            }
           
            return response()->json(['refund_data'=>$refund_data]);
        }

        public function getSingleRefundStatus(Request $request){
            
            $baseurl = env('CASHFREE_LIVE_REFUND_URL');
            $appId = env('CASHFREE_APP_ID_LIVE');
            $secretKey = env('CASHFREE_SECRET_KEY_LIVE');
            if(env('CASHFREE_TEST_MODE')){
                $baseurl = env('CASHFREE_TEST_REFUND_URL');
                $appId = env('CASHFREE_APP_ID_TEST');
                $secretKey = env('CASHFREE_SECRET_KEY_TEST');
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $baseurl.'api/v1/refundStatus/',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('appId' => $appId,
                                          'secretKey' =>  $secretKey ,
                                          'refundId' => '9045705'),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $response_decode = json_decode($response, true);
            return response()->json(['refund_data'=>$response_decode]);die;
        }
        
        public function review($username){
            $allUser = User::where('username','!=',$username)->where('role_id','!=',1)->orderBy('id','desc')->get();
            $user = User::with('review','follow','bookmark','bookmark.rastaurant','recentviewed','recentviewed.rastaurant','notipref')->where('username',$username)->first();
            $category = RoomServiceCategory::get();
           
            return view('login-users.review',compact('user','allUser','category'));
        }

        public function recentViewedItems($item_id){
            if(Auth::check() && RecentViewed::where('item_id',$item_id)->where('user_id',Auth::user()->id)->count() == 0){
                $recentview = new RecentViewed();
                $recentview->user_id = Auth::user()->id;
                $recentview->item_id = $item_id;
                $recentview->save();
            }
        }

        public function notifications()
        {
            $notifications = Notification::orderBy('id','desc')->get();
        return view('login-users.notifications',compact(/*'user','allUser',*/'notifications'/*,'total_photos','total_reviews'*/));
        }

        public function photos($username){
            $allUser = User::where('username','!=',$username)->where('role_id','!=',1)->orderBy('id','desc')->limit(10)->get();
            $user = User::with('review','follow','bookmark','bookmark.rastaurant','recentviewed','recentviewed.rastaurant','notipref')->where('username',$username)->first();
            $photos = Bookmark::with('rastaurant')->where('user_id',$user->id)->get();
            $images = [];
            foreach($photos as $key => $value){
                if($value->rastaurant){
                    array_push($images, $value->rastaurant->image);
                }
            }

            $total_photos = count($images);
            
            return view('login-users.photos',compact('images','total_photos','user','allUser'));
        } 

        public function followers($username){
            $allUser = User::where('username','!=',$username)->where('role_id','!=',1)->orderBy('id','desc')->get();
            $user = User::with('review','follow','bookmark','bookmark.rastaurant','recentviewed','recentviewed.rastaurant','notipref')->where('username',$username)->first();

            $followers = Follow::with('followuser')->where('follow_user_id',$user->id)->where('status',1)->get();
            $following = Follow::with('followinguser')->where('user_id',$user->id)->where('status',1)->get();
            
            return view('login-users.followers',compact('followers','following','user','allUser'));
        } 
        public function recentViewed($username){
            $allUser = User::where('username','!=',$username)->where('role_id','!=',1)->orderBy('id','desc')->get();
            $user = User::with('review','follow','bookmark','bookmark.rastaurant','recentviewed','recentviewed.rastaurant','notipref')->where('username',$username)->first();

            if($user->recentviewed){
                foreach($user->recentviewed as $key => $value){
                    $rating = Review::where('item_id',$value->item_id)->where('item_type','restaurant')->sum('rating');
                    $count = Review::where('item_id',$value->item_id)->where('item_type','restaurant')->count();
                    
                    $value['total_peoples'] = $count;
                    if($count != 0 && $rating != 0)
                        $value['avg_rating'] = $rating / $count;
                    else
                        $value['avg_rating'] = 0;
                    
                }
            }
            
            return view('login-users.recent-viewd',compact('user','allUser'));
        } 

        public function favouriteItems(){
            $data = $this->getauthuser();
            $user = $data[0];
          
            if($user->recentviewed){
                foreach($user->recentviewed as $key => $value){
                    $rating = Review::where('item_id',$value->item_id)->where('item_type','restaurant')->sum('rating');
                    $count = Review::where('item_id',$value->item_id)->where('item_type','restaurant')->count();
                    
                    $value['total_peoples'] = $count;
                    if($count != 0 && $rating != 0)
                        $value['avg_rating'] = $rating / $count;
                    else
                        $value['avg_rating'] = 0;
                    
                }
            }
            return view('login-users.favourite-item',compact('user'));
        }
        public function manageCards(){
            return view('login-users.manage-cards');
        }
        public function refsEarn(){
            return view('login-users.refer-earn');
        }

        public function referEarnListing(){
            $referral_users = User::where("parent_id",Auth::user()->id)->get();
            return view('login-users.refer-earn-listing',compact('referral_users'));
        }

        public function manageWallets(){
            return view('login-users.manage-wallet');
        }
            public function bookmark()
            {
                $data = $this->getauthuser();
                $user = $data[0];
                if($user->bookmark){
                    foreach($user->bookmark as $key => $value){
                        $rating = Review::where('item_id',$value->item_id)->where('item_type','restaurant')->sum('rating');
                        $count = Review::where('item_id',$value->item_id)->where('item_type','restaurant')->count();
                        
                        $value['total_peoples'] = $count;
                        if($count != 0 && $rating != 0)
                            $value['avg_rating'] = $rating / $count;
                        else
                            $value['avg_rating'] = 0;
                        
                    }
                }

                return view('login-users.bookmark',compact('user'));
            }

            public function TTICredits(){
                $data = $this->getauthuser();
                $user = $data[0];
                
                $wallet = Wallet::with('user','transactions')->where('user_id',$user->id)->orderby('id','DESC')->get();
                
                return view('login-users.tti-credits',compact('wallet')); //,'total_wallet','recharge_wallet'
            }
            
            public function yourBooking()
            {
                $past_reservation = Reservation::with('user')->where('user_id','!=',0)->where('user_id',Auth::user()->id)->whereDate('date','<', date('Y-m-d'))->get();
                $upcoming_reservation = Reservation::with('user')->where('user_id','!=',0)->where('user_id',Auth::user()->id)->where('date','>=',date('Y-m-d'))->get();
                return view('login-users.your-book',compact(/*'user','allUser',*/'past_reservation','upcoming_reservation'/*,'total_photos','total_reviews'*/));
            }

        public function saveReviews(Request $request){
 
            if(Auth::check()){
                $data = $this->getauthuser();
                $user = $data[0];
            }
            $review = new Review();
            $review->user_id = (isset($user)) ? $user->id : 0;
            $image_arr = [];
            if($request->item_type == 'room'){

            $review->category = $request->category;
            if($request->fileUpload){
                $image = $request->file('fileUpload');
                $is_aws_active = $this->ifAWSKeyisNotResponse();
                if($is_aws_active == 0){
                    foreach($image as $file){
                        $extention = uniqid().'.'.$file->getClientOriginalExtension();
                        $destinationPath = public_path('/images');
                        $file->move($destinationPath, $extention);
                        array_push($image_arr,$extention);
                    }
                }else{
                    $s3 = \Storage::disk('s3');
                    foreach($image as $file){
                        $extention = uniqid() .'.'. $file->getClientOriginalExtension();
                        $s3filePath = '/images/' . $extention;
                        $s3->put($s3filePath, file_get_contents($file), 'public');
                        array_push($image_arr,$extention);
                    }
                }

                $review->image = json_encode($image_arr);
            }
            }
            if($request->public_review){
                if($request->fileUpload){
                    $image = $request->file('fileUpload');
                     $is_aws_active = $this->ifAWSKeyisNotResponse();
                     if($is_aws_active == 0){
                        foreach($image as $file){
                            $extention = uniqid().'.'.$file->getClientOriginalExtension();
                            $destinationPath = public_path('/images');
                            $file->move($destinationPath, $extention);
                            array_push($image_arr,$extention);
                        }
                     }else{
                      $s3 = \Storage::disk('s3');
                      foreach($image as $file){
                        $extention = uniqid() .'.'. $file->getClientOriginalExtension();
                        $s3filePath = '/images/' . $extention;
                        $s3->put($s3filePath, file_get_contents($file), 'public');
                        array_push($image_arr,$extention);
                     }
                    }
        
                $review->image = json_encode($image_arr);
                }

                $review->public_review = 1;
            }

            if($request->likecomment)
                $review->liked = $request->likecomment;

            if($request->unlikecomment)
                $review->unliked = $request->unlikecomment;


            if($request->message)
                $review->review = $request->message;

            $review->item_id = $request->item_id;
            $review->item_type = $request->item_type;
            $review->rating = $request->rating;
            $review->save();  

            if($request->ajax()){
                return response()->json(['success'=>200]);
            }else{
                return redirect()->back()->with('success','Thank you for submitting your feedback.');
            }
        }
        public function updateReviews(Request $request,$id){

            $data = $this->getauthuser();
            $user = $data[0];
            $review = Review::where('id',$id)->first();
            $review->user_id = $user->id;
            $review->liked = $request->likecomment;
            $review->review = $request->message;
            $review->item_id = $review->item_id;
            $review->item_type = $review->item_type;
            $review->rating = $request->rating;
            $review->category = $request->category;
            
            $review->save();  
            return redirect()->back()->with('success','Review Updated by '.$user->first_name.' '.$user->last_name);
        }
        public function deleteReview($id){
            Review::where('id',$id)->delete();
            return response()->json(['success'=>200]);
        }
        public function cart(){
            $address = UserAddress::where('user_id',Auth::user()->id)->orderby('id','desc')->get();
            $credit_sum_amt = 0;
            $credit_sub_amt = 0;
            $reward_sum_amt = 0;
            $reward_sub_amt = 0;
            $credit_amount = 0;
            $reward_amount = 0;
            
            $recharge_wallet_query = Wallet::where('user_id',Auth::user()->id)->get();
            if(!$recharge_wallet_query->isEmpty()){
                foreach($recharge_wallet_query as $key => $value){
                    if($value->amount_type == 'TTI_CREDIT'){
                        if($value->txn_type == 'CREDIT'){
                            $credit_sum_amt += $value->amount;
                        }else{
                            $credit_sub_amt += $value->amount;     
                        }
                    }else{
                        if($value->txn_type == 'CREDIT'){
                            $reward_sum_amt += $value->amount;
                        }else{
                            $reward_sub_amt += $value->amount;     
                        }   
                    }               
                }
                $credit_amount = $credit_sum_amt - $credit_sub_amt;
                $reward_amount = $reward_sum_amt - $reward_sub_amt;
            }

            $promocodes = Promocode::whereIN('code_type',array('S','N'))->whereIN('user_id',array(0,Auth::user()->id))->whereIN('category',array('Rastaurant','Both'))->orderby('id','DESC')->get();
            return view('login-users.cart',compact('address','credit_amount','reward_amount','promocodes'));
        }

        public function roomcart($order_id){
            if(Auth::check()){
                $address = UserAddress::where('user_id',Auth::user()->id)->orderby('id','desc')->get();
            }
            else{
                $address = array();
            }
            $credit_sum_amt = 0;
            $credit_sub_amt = 0;
            $reward_sum_amt = 0;
            $reward_sub_amt = 0;
            $credit_amount = 0;
            $reward_amount = 0;
            
            if(Auth::check()){
                $recharge_wallet_query = Wallet::where('user_id',Auth::user()->id)->get();
                if(!$recharge_wallet_query->isEmpty()){
                    foreach($recharge_wallet_query as $key => $value){
                        if($value->amount_type == 'TTI_CREDIT'){
                            if($value->txn_type == 'CREDIT'){
                                $credit_sum_amt += $value->amount;
                            }else{
                                $credit_sub_amt += $value->amount;     
                            }
                        }else{
                            if($value->txn_type == 'CREDIT'){
                                $reward_sum_amt += $value->amount;
                            }else{
                                $reward_sub_amt += $value->amount;     
                            }   
                        }               
                    }
                    $credit_amount = $credit_sum_amt - $credit_sub_amt;
                    $reward_amount = $reward_sum_amt - $reward_sub_amt;
                }
            }
    
            $order_id = explode('-',base64_decode($order_id))[1];
            $temp_data = TempCheckout::where('id', $order_id)->first();
            
            if(empty($temp_data)){
                return redirect('/');
            }else{
                $form_data = json_decode($temp_data['formData'], true);
                $room_category = str_replace(" ","_",ucwords(str_replace("_"," ",$form_data['item']['room_category']))).'_Room';
             
                $arr = array();
                $used_promo = UsedPromocode::where('phone_number','+91'.$form_data['customerPhone'])->where('used_time','>=',1)->get();
                foreach($used_promo as $key => $value){
                    array_push($arr,$value->promocode_id);
                }
    
                $promocodes = Promocode::whereNotIn('id',$arr)->whereIN('code_type',array('N','S'))->whereIn('category',array($room_category,'Both'))->orderby('id','desc')->get();
                //get total person and no of avails room start
                $per_room_person = Setting::where('key','per_room_person')->first();
                $rooms = RoomCategory::with('roomadditionaldata')->where('room_category',$form_data['item']['room_category'])->first();
                 if(!empty($rooms) && !empty($rooms->roomadditionaldata) && $rooms->roomadditionaldata){
                   foreach($rooms->roomadditionaldata as $room_key => $room_value){
                     if(date('Y-m-d',strtotime( date('Y-m-d',strtotime($form_data['checkin'])))) == $room_value['date']){
                       $rooms['room_avail'] = $room_value['room_avail'];
                       $rooms['final_price'] = $room_value['price'];
                       $rooms['new_old_price'] = $room_value['old_price'];
                       $rooms['new_off_percentage'] = $room_value['off_percentage'];
                     }
                   }
                 } 
                 $no_of_rooms = isset($rooms->room_avail) ? $rooms->room_avail : $rooms->no_of_rooms;
                 //get total person and no of avails room start
                
                 $roomcategory = Setting::where("key","room_category")->first();
                 $roomcategory = ($roomcategory) ? explode(',', $roomcategory->value) : array() ;
                 $per_room_childrens_allowed = Setting::where('key','per_room_childrens_allowed')->first();
    
                return view('login-users.roomcart',compact('address','credit_amount','reward_amount','promocodes', 'form_data','order_id','per_room_person','no_of_rooms','roomcategory','per_room_childrens_allowed'));
            }
        }

        public function saveSocialShareData(Request $request){
            if(SocialShare::where('id',Auth::user()->id)->where('type',$request->social_share)->count() != 1){
                $social = new SocialShare();
                $social->user_id = Auth::user()->id;
                $social->url = $request->url;

                if($request->customFile){
                    $image = $request->file('customFile');
                    $is_aws_active = $this->ifAWSKeyisNotResponse();
                    if($is_aws_active == 0){
                        $extention = uniqid().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('/images');
                        $image->move($destinationPath, $extention);
                    }else{
                        $s3 = \Storage::disk('s3');
                        $extention = uniqid() .'.'. $image->getClientOriginalExtension();
                        $s3filePath = '/images/' . $extention;
                        $s3->put($s3filePath, file_get_contents($image), 'public');

                    }
                    $social->screenshot = $extention;
                }
                $social->type = $request->social_share;
                $social->save();
                return redirect()->back()->with('success','Your query is received. Our representative will contact you soon.');
            }
        }


        public function socialShare(Request $request){
            $social_share = SocialShare::where('user_id',Auth::user()->id)->get();
            return view('login-users.socialshare',compact('social_share'));
        }

        public function changeNotificationStatus(){
            $notification = Notification::get();
            if($notification){
                foreach($notification as $key => $value){
                    $value->status = 1;
                    $value->save();
                }
            }
        }
}
