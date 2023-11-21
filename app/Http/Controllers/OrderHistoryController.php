<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderHistory;
use App\Transaction;
use App\UserAddress;
use App\Setting;
use App\Wallet;
use App\User;
use Mail;
use Log;
use Illuminate\Support\Facades\Auth;
use App\Jobs\CancellItemOrdersJob;
use App\Jobs\RoomInHouseJob;
use App\Jobs\RefundedAmountJob;
use Storage;
use DB;
use App\RefundUsers;
use Dompdf\Dompdf;
use Session;
class OrderHistoryController extends Controller
{ 

    function countItemOrders(){
        $order_count = Transaction::where('txn_type','ITEM')->where('read_status','Unread')->count();
        return response()->json(['order_count'=>$order_count]);
        
    }
     
    function countRoomBooking(){
        $room_booking_count = Transaction::where('txn_type','ROOM')->where('read_status','Unread')->count();
        return response()->json(['room_booking_count'=>$room_booking_count]);
    }
    
    public function deleteAllPayments($type,$ids)
    {
        $ids = explode(',',$ids);
        if($type == "wallet"){
            Wallet::whereIn('id',$ids)->delete();
        }else{
            Transaction::whereIn('id',$ids)->delete();
        }
     echo 1;die;
    }

    //Room booking functions start

    public function getUpcomingCheckinCheckout($start_date = '',$end_date = ''){
        if(Auth::user() && Auth::user()->role_id == 3){
        $total_cmc_data =  Transaction::whereIn('f_status',['M','C'])->orWhere('status','ROOM_CANCELLED')->where('txn_type','ROOM')->count();
        return view('orderhistory.all-bookings',compact('total_cmc_data'));
        }
    }
     public function getUpcoming($start_date = '',$end_date = ''){
        if($start_date != '' && $end_date != ''){
            $today_upcoming_booking = Transaction::with('user')->where('f_status','U')->where('status','!=','ROOM_CANCELLED')->where('txn_type','ROOM')->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 00:00:00'])->whereDate('checkout_form_data->checkin','=', date('Y-m-d'))->orderBy('updated_at','desc')->get();
            $later_upcoming_booking = Transaction::with('user')->where('f_status','U')->where('status','!=','ROOM_CANCELLED')->where('txn_type','ROOM')->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 00:00:00'])->whereDate('checkout_form_data->checkin','>', date('Y-m-d'))->orderBy('updated_at','desc')->get();
            $prev_upcoming_booking = Transaction::with('user')->where('f_status','U')->where('status','!=','ROOM_CANCELLED')->where('txn_type','ROOM')->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 00:00:00'])->whereDate('checkout_form_data->checkin','<', date('Y-m-d'))->orderBy('updated_at','desc')->get();
        }
        else{
            $today_upcoming_booking = Transaction::with('user')->where('f_status','U')->where('status','!=','ROOM_CANCELLED')->where('txn_type','ROOM')->whereDate('checkout_form_data->checkin','=', date('Y-m-d'))->orderBy('updated_at','desc')->get();
            $later_upcoming_booking = Transaction::with('user')->where('f_status','U')->where('status','!=','ROOM_CANCELLED')->where('txn_type','ROOM')->whereDate('checkout_form_data->checkin','>', date('Y-m-d'))->orderBy('updated_at','desc')->get();
            $prev_upcoming_booking = Transaction::with('user')->where('f_status','U')->where('status','!=','ROOM_CANCELLED')->where('txn_type','ROOM')->whereDate('checkout_form_data->checkin','<', date('Y-m-d'))->orderBy('updated_at','desc')->get();
            $in_house_booking = Transaction::with('user')->where('f_status','IH')->where('txn_type','ROOM')->orderBy('updated_at','desc')->get();
        }

        $total_today_later = Transaction::with('user')->where('f_status','U')->where('status','!=','ROOM_CANCELLED')->where('txn_type','ROOM')->orderBy('updated_at','desc')->count();


        return view('orderhistory.upcoming-history',compact('today_upcoming_booking','later_upcoming_booking','prev_upcoming_booking','total_today_later'));
     }

     public function getCheckin($start_date = '',$end_date = ''){
        if($start_date != '' && $end_date != ''){
            $in_house_booking = Transaction::with('user')->where('f_status','IH')->where('txn_type','ROOM')->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 00:00:00'])->orderBy('updated_at','desc')->get();
        }else{
            $in_house_booking = Transaction::with('user')->where('f_status','IH')->where('txn_type','ROOM')->orderBy('updated_at','desc')->get();
        }

         if(!empty($in_house_booking)){
            foreach($in_house_booking as $ih_key => $ih_value){
                $checkout_form_data = json_decode($ih_value->checkout_form_data, true);
                if(date('Y-m-d',time()) == $checkout_form_data['checkout'])
                {
                     $ih_value['today_checkout_record'] =  $ih_value->id;
                }

                $room_number = json_decode($ih_value['room_number'], true);
                 
                if($room_number){
                    foreach ($room_number as $key => $value) {
                        $ih_value['items_booking'] =  Transaction::where('room_number','like', '["%'.$value.'"]')->whereBetween('created_at',[$checkout_form_data['checkin'].' 00:00:00',$checkout_form_data['checkout'].' 23:59:00'])->where('txn_type','ITEM')->get();
                    }
                }
            }
         }

        return view('orderhistory.inhour-history',compact('in_house_booking'));
     }
 
     public function getCheckout($start_date = '',$end_date = '',$current_page = '',$records_per_page = '',$offset = '',$search_text = ''){
        if($start_date != "0" && $end_date != "0" && $search_text == "0"){
          $mark_complete_cancel = Transaction::with('user','wallet')->where(function($q){
              $q->orWhereIn('f_status',['M','C'])->orWhere('status','ROOM_CANCELLED');
          })->where(function($q) use ($start_date, $end_date ){
              $q->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59']);
          })->where('txn_type','ROOM')->orderBy('updated_at','desc')->offset($offset)->limit($records_per_page)->get();

        }else if($start_date != "0" && $end_date != "0" && $search_text != "0"){
          $mark_complete_cancel = Transaction::with('user','wallet')->where(function($q){
              $q->orWhereIn('f_status',['M','C'])->orWhere('status','ROOM_CANCELLED');
          })->where(function($q) use ($start_date, $end_date ){
              $q->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 00:00:00']);
          })->where(function($query) use ($search_text){
             $query->whereJsonContains('checkout_form_data->customerName', $search_text)->orWhereJsonContains('checkout_form_data->customerEmail', $search_text)->orWhereJsonContains('checkout_form_data->customerPhone', $search_text)->orWhereJsonContains('checkout_form_data->room_category', $search_text);
          })->where('txn_type','ROOM')->orderBy('updated_at','desc')->offset($offset)->limit($records_per_page)->get();
         
        }else if($start_date == "0" && $end_date == "0" && $search_text != "0" ){

          $mark_complete_cancel = Transaction::with('user','wallet')->where('txn_type','ROOM')->where(function($q){
              $q->orWhereIn('f_status',['M','C'])->orWhere('status','ROOM_CANCELLED');
          })->where(function($query1) use ($search_text){
             $query1->whereJsonContains('checkout_form_data->customerName',$search_text)->orWhereJsonContains('checkout_form_data->customerEmail',$search_text);
          })->orderBy('updated_at','desc')->get();
        }else{
          $mark_complete_cancel = Transaction::with('user','wallet')->whereIn('f_status',['M','C'])->orWhere('status','ROOM_CANCELLED')->where('txn_type','ROOM')->orderBy('updated_at','desc')->offset($offset)->limit($records_per_page)->get();
        
        }

        $total_cmc_data =  Transaction::whereIn('f_status',['M','C'])->orWhere('status','ROOM_CANCELLED')->where('txn_type','ROOM')->count();
        return view('orderhistory.completed-history',compact('mark_complete_cancel','offset','total_cmc_data'));
      }
    //Room booking functions end

    public function seeAllUpcomingCheckinCheckout($id,$type){
   
        $transaction_data = Transaction::with('user')->where('id',$id)->first();
        if($type == "inhouse")
          return view('orderhistory.view-inhouse-room-detail',compact('transaction_data'));
        else
          return view('orderhistory.view-room-detail',compact('transaction_data'));
    }

    public function getOrderedItemandCacnelledOrderHistory(){
      $total_orderd_data = Transaction::with('user')->whereIn('status',['D','C'])->where('txn_type','ITEM')->count();
      return view('orderhistory.all-orders-index',compact('total_orderd_data'));
    }

    public function getModes($mode){
         if($mode == "inhouse") 
            return "In House Order";
         else if($mode == "delivery")
            return "Delivery";
         else
            return "Takeaway";
    }

    //new orderes function
    public function getPendingOrders($start_date = '',$end_date = '',$mode = ""){

         if($mode != "no" && ($start_date == 0 && $end_date == 0)){
            $modes = $this->getModes($mode);
            $pending_order_history = Transaction::with('user')->whereJsonContains('checkout_form_data->delivery_mode', $modes)->where('status','P')->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }else if(($start_date != 0 && $end_date != 0) && $mode != "no"){
            $modes = $this->getModes($mode);
            $pending_order_history = Transaction::with('user')->where('status','P')->whereJsonContains('checkout_form_data->delivery_mode', $modes)->whereBetween('created_at',[$start_date,' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }else{
            $pending_order_history = Transaction::with('user')->where('status','P')->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }
        return view('orderhistory.items.pending',compact('pending_order_history'));
    }

     public function getPreparingOrders($start_date = '',$end_date = '',$mode = ""){
         if($mode != "no" && ($start_date == 0 && $end_date == 0)){
            $modes = $this->getModes($mode);
            $preparing_order_history = Transaction::with('user')->whereJsonContains('checkout_form_data->delivery_mode', $modes)->where('status','A')->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }else if(($start_date != 0 && $end_date != 0) && $mode != "no"){
            $modes = $this->getModes($mode);
            $preparing_order_history = Transaction::with('user')->where('status','A')->whereJsonContains('checkout_form_data->delivery_mode', $modes)->whereBetween('created_at',[$start_date,' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }else{
            $preparing_order_history = Transaction::with('user')->where('status','A')->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }
        return view('orderhistory.items.prepare',compact('preparing_order_history'));
    }

     public function getPickedUpOrders($start_date = '',$end_date = '',$mode = ""){
         if($mode != "no" && ($start_date == 0 && $end_date == 0)){
            $modes = $this->getModes($mode);
            $picked_up_order_history = Transaction::with('user')->whereJsonContains('checkout_form_data->delivery_mode', $modes)->where('status','PU')->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }else if(($start_date != 0 && $end_date != 0) && $mode != "no"){
            $modes = $this->getModes($mode);
            
            $picked_up_order_history = Transaction::with('user')->where('status','PU')->whereJsonContains('checkout_form_data->delivery_mode', $modes)->whereBetween('created_at',[$start_date,' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }else{
            $picked_up_order_history = Transaction::with('user')->where('status','PU')->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }

        return view('orderhistory.items.picked-up',compact('picked_up_order_history'));
    }

     public function getDeliveredOrders($start_date = '',$end_date = '',$mode = "",$current_page = '',$records_per_page = '',$offset = '',$search_text = ''){
    // dd($start_date,$end_date,$mode,$search_text);
        if($mode != "no" && $start_date == "0" && $end_date == "0" && $search_text == '' || $search_text == "0"){
        echo "if";
            $modes = $this->getModes($mode);
            
            $del_cancel_order_history = Transaction::with('user')->whereJsonContains('checkout_form_data->delivery_mode', $modes)->whereIn('status',['D','C'])->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();
        }else if($start_date != "0" && $end_date != "0" && $mode != "no"  && $search_text == '' || $search_text == "0"){
         echo "else if";
            $modes = $this->getModes($mode);
            
            $del_cancel_order_history = Transaction::with('user')->whereIn('status',['D','C'])->whereJsonContains('checkout_form_data->delivery_mode', $modes)->whereBetween('created_at',[$start_date,' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ITEM')->orderBy('updated_at','desc')->get();

        }else if($mode == "no" && $start_date == "0" && $end_date == "0" && $search_text != ''){
          echo "else if ffff2fff";
            $modes = $this->getModes($search_text);
            $del_cancel_order_history = Transaction::where('txn_type','ITEM')->whereIn('status',['D','C'])->whereHas('user', function ($query) use ($search_text){
                $query->where('first_name', 'like','%'.$search_text.'%');
            })->with(['user' => function($query) use ($search_text) { 
               $query->where('first_name', 'like','%'.$search_text.'%');
            }])->with('user')->orderBy('updated_at','desc')->get();

        }else{
          echo "else ";
            $del_cancel_order_history = Transaction::with('user')->whereIn('status',['D','C'])->where('txn_type','ITEM')->orderBy('updated_at','desc')->offset($offset)->limit($records_per_page)->get();
        }


         $total_orderd_data = Transaction::with('user')->whereIn('status',['D','C'])->where('txn_type','ITEM')->count();

         return view('orderhistory.items.delivered-cancelled',compact('del_cancel_order_history','offset','total_orderd_data'));
    }
   
    public function exportitemorderedCSV($start_date = '',$end_date = '',$status = ''){
        if($status != 'no')
            $transaction = ($status == 'all') ? Transaction::with('user')->where('txn_type','ITEM')->get() : Transaction::with('user')->where('status',$status)->where('txn_type','ITEM')->get();
        if((($start_date != ''  && $start_date != 0)  && ($end_date != '' && $end_date != 0)) && $status == 'no')
            $transaction = Transaction::with('user')->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ITEM')->get();
        if((($start_date != ''  && $start_date != 0)  && ($end_date != '' && $end_date != 0)) && $status != 'no')
            $transaction = ($status == 'all') ? Transaction::with('user')->where('txn_type','ITEM')->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])->get() : Transaction::with('user')->where('status',$status)->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ITEM')->get();

       
            $fileName = 'ordered-item.csv';            
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('Name','Delivery Mode','Order Item','Bill Amount','Date');
            $callback = function() use($transaction, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($transaction as $value) {
                    $checkout_data = json_decode($value->checkout_form_data,true);
                    $row['name']  = ucwords($value->user->first_name).' '.ucwords($value->user->last_name);
                    $row['delivery_mode']  = ($checkout_data['delivery_mode'] == "In House Order") ? $checkout_data['delivery_mode']. '(#'.$checkout_data['delivery_mode_room_no'].')' : $checkout_data['delivery_mode'];

                     
                     $result_names = '';
                      foreach($checkout_data['item'] as $item_key => $item_value){
                          $result_names .= $item_value['name'].' ,';
                      } 
                    $row['items'] = rtrim($result_names, ',');
                    $row['bill_detail'] = '₹'.($checkout_data['net_total_amt'] + $checkout_data['subtotal_rider']);
                    $row['date'] = date('F d, Y',strtotime($value->created_at));
                  
                    fputcsv($file, array($row['name'], $row['delivery_mode'], $row['items'],$row['bill_detail'],$row['date']));
                }
            
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
      
    }

    public function exportCsvAllBookings($start_date = '',$end_date = '',$status = ''){
        if($status != 'no'){
            if($status == "ROOM_CANCELLED")
                $transaction = Transaction::with('user')->where('status',$status)->where('txn_type','ROOM')->get();
            else
                $transaction = ($status == 'all') ? Transaction::with('user')->where('txn_type','ROOM')->get() : Transaction::with('user')->where('f_status',$status)->where('txn_type','ROOM')->get();
        }
        if((($start_date != ''  && $start_date != 0)  && ($end_date != '' && $end_date != 0)) && $status == 'no'){
            $transaction = Transaction::with('user')->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ROOM')->get();
        }
        if((($start_date != ''  && $start_date != 0)  && ($end_date != '' && $end_date != 0)) && $status != 'no'){
            if($status == "ROOM_CANCELLED")
                $transaction = Transaction::with('user')->where('status',$status)->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ROOM')->get();
            else
                $transaction = ($status == 'all') ? Transaction::with('user')->where('txn_type','ROOM')->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])->get() : Transaction::with('user')->where('f_status',$status)->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])->where('txn_type','ROOM')->get();
            
        }

        // if(count($transaction) > 0){
            $fileName = 'ordered-item.csv';            
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('Name','Room Type','Checkin Date','Checkout Date','Bill Amount','Status');
            $callback = function() use($transaction, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

               foreach ($transaction as $value) {
                    $checkout_data = json_decode($value->checkout_form_data,true);

                    $row['name']  = ucwords($checkout_data['customerName']);
                    foreach($checkout_data['item'] as $key => $item_value){
                        if($key == 'room_title')
                            $row['room_type'] = $item_value;
                    }
                    $row['checkin']  = $checkout_data['checkin'];
                    $row['checkout']  = $checkout_data['checkout'];
 
                    $row['bill_detail'] = '₹'.($checkout_data['f_total_amt']);

                    if($value->status == "ROOM_CANCELLED")
                        $row['status'] = "Cancelled";
                    elseif($value->f_status == "U")
                        $row['status'] = "Upcoming";
                    elseif($value->f_status == "M")
                        $row['status'] = "Mark as No Show";
                    elseif($value->f_status == "C")
                        $row['status'] = "Completed";
                    elseif($value->f_status == "IH")
                        $row['status'] = "In House";
                    else
                        $row['status'] = "Cancelled";
                  
                    fputcsv($file, array($row['name'], $row['room_type'], $row['checkin'],$row['checkout'],$row['bill_detail'],$row['status']));
                }
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        // }else{
        //     return redirect()->back();
        // }
    }

    public function roomOrderHistory()
    {
       $room_order_history = Transaction::with('user')->where('status','!=','ROOM_CANCELLED')->where('txn_type','ROOM')->get();
       
       if(!empty($room_order_history)){
            foreach($room_order_history as $value){
                if(isset(json_decode($value['checkout_form_data'], true)['selectedaddress'])){
                    $address_id = !isset($value['checkout_form_data']) ? json_decode($value['checkout_form_data'], true)['selectedaddress'] : 0;
                    $deliver_address = UserAddress::select('address')->where('id',$address_id)->first();
                    $value['deliver_address'] = $deliver_address['address'];
                }
            }
        }
       return view('orderhistory.index',compact('room_order_history'));
    }
    public function RastaurnatorderHistory()
    {
       $rastro_order_history = Transaction::with('user')->whereIn('status',['P','A','R'])->where('txn_type','ITEM')->get();
       if(!empty($rastro_order_history)){
            foreach($rastro_order_history as $value){
                if(isset(json_decode($value['checkout_form_data'], true)['selectedaddress'])){
                    $address_id = !isset($value['checkout_form_data']) ? json_decode($value['checkout_form_data'], true)['selectedaddress'] : 0;
                    $deliver_address = UserAddress::select('address')->where('id',$address_id)->first();
                    if($deliver_address){
                        $value['deliver_address'] = $deliver_address['address'];
                    }
                }
            }
        }
       
       return view('orderhistory.index',compact('rastro_order_history'));
    }
  
    public function show($id)
    {
       $order_history = Transaction::with('user')->where('id',$id)->first();
       if($order_history->txn_type == 'ITEM'){
           if(!empty($order_history)){
                if(isset(json_decode($order_history['checkout_form_data'], true)['selectedaddress'])){
                    $address_id = !empty($order_history['checkout_form_data']) ? json_decode($order_history['checkout_form_data'], true)['selectedaddress'] : 0;
                    $deliver_address = UserAddress::select('address')->where('id',$address_id)->first();
                }
           }
           $from_address = Setting::where('key','address')->first();
           $rastro_order_history = $order_history;
           return view('orderhistory.view',compact('rastro_order_history','deliver_address','from_address'));
       }

        if($order_history->txn_type == 'ROOM'){
            $room_order_history = $order_history;
            return view('orderhistory.view',compact('room_order_history'));
        }
    }

    public function upcomingOrderHistory(){
        $upcoming_transaction = Transaction::where('f_status','U')->where('status','!=','ROOM_CANCELLED')->get();
        return view('orderhistory.upcoming-history',compact('upcoming_transaction'));
    }
    public function inhouseOrderHistory(){

        $ih_transaction = Transaction::where('f_status','IH')->where('status','!=','ROOM_CANCELLED')->get();
        if(!empty($ih_transaction)){
            foreach($ih_transaction as $ih_key => $ih_value){
                $checkout_form_data = json_decode($ih_value->checkout_form_data, true);
                 
                if(date('Y-m-d',time()) == $checkout_form_data['checkout'])
                {
                     $ih_value['today_checkout_record'] =  $ih_value->id;
                }

                $room_number = json_decode($ih_value['room_number'], true);
                if($room_number)
                    $ih_value['items_booking'] =  Transaction::whereIn('room_number',$room_number)->whereBetween('created_at',[$checkout_form_data['checkin'].' 00:00:00',$checkout_form_data['checkout'].' 23:59:00'])->where('txn_type','ITEM')->get();
            }
        }
        return view('orderhistory.inhour-history',compact('ih_transaction'));
    }
    public function completedOrderHistory(){
        $c_transaction = Transaction::where('f_status','C')->where('status','!=','ROOM_CANCELLED')->get();

        return view('orderhistory.completed-history',compact('c_transaction'));
    }

    public function changeStatusOrderHistory($id,$status,$amount,$type,$typeJson,$position){
        $transaction = Transaction::where('id',$id)->first();
         
        if($type == 'status'){
            $transaction->f_status = $status;
        }else{
            $checkout_form_data = json_decode($transaction->checkout_form_data, true);
            $new_remaining_amount = $checkout_form_data['f_total_amt'] + $amount;
            $percentage = $new_remaining_amount / $checkout_form_data['grand_total_amt'] * 100;
            $percentage = round($percentage , 2);
            $payment_arr=[];
            $payment_new_arr=[];
            $payment_object=json_encode(['mode'=>$status,'value'=>$amount]);
            array_push($payment_arr,$payment_object);
            array_push($payment_new_arr,$payment_arr);

            $prev_arr = $transaction->payment_mode != null && $transaction->payment_mode != "" ? json_decode($transaction->payment_mode) :[];
        
            array_push($prev_arr,$payment_object);

            $transaction->payment_mode = $prev_arr;

            $final_amount = 0;
            $grand_total_amt = 0;
            foreach($checkout_form_data as $key => $value){
                
                if($key == 'f_total_amt'){
                    $amt_new = round($value,2) + round($amount,2);
                    $final_amount = round(abs($amt_new), 2);
                    $checkout_form_data['f_total_amt'] = round(abs($amt_new), 2);
                }
                if($key == 'payment_option') {                 
                    $checkout_form_data['payment_option'] = (round($percentage,2) >= 100 || round($percentage,2) == 0) ? 100 : round($percentage,2);
                }
            }

            if($final_amount == $grand_total_amt)
            {
                $checkout_form_data['payment_option'] = 100;
            }

            $transaction->checkout_form_data = $checkout_form_data;
            
            $full_name = $checkout_form_data['customerName'];
            $txnid = $transaction->txnid;
            
            $email = $checkout_form_data['customerEmail'];
        }
        
        if($position == 2 || $position == "2")
          $transaction->inperson_checkin_time = date('Y-m-d H:i:s');

        if($position == 1 || $position == "1")
          $transaction->inperson_checkout_time = date('Y-m-d H:i:s');

        $transaction->save();
        return response()->json(['status'=>200]);
    }
    
    public function saveRoomNumber(Request $request){
        $roomnumber = explode(',',$request->roomnumber);
        $all_room_number = [];
        foreach($roomnumber as $key_room => $value_room){
            array_push($all_room_number,$value_room);
        }
 
        $length = count($roomnumber);
        $length_in_range_is_true = 1;
        $count = 0;

        $is_true = "";
        while ($count < $length) {
           if($this->count_digit($roomnumber[$count]) != 3){
             return redirect()->back()->with('error','Maximum 3 digits is required for each Room Number.');//echo "length_in_range_is_true";die;
           }
           $count++;
        }
 
        foreach ($roomnumber as $key => $value) {

            $room_exits = Transaction::where('room_number','like', '["%'.$value.'"]')->where('f_status','IH')->where('txn_type','ROOM')->get();
             if(count($room_exits) > 0){
                $is_true = "already_exists";
             }
        }

        if($is_true == ""){
            $txn_data = Transaction::where('id',$request->txn_id)->first();
            $txn_data->room_number = json_encode($all_room_number);
            $txn_data->save();

            return redirect()->back()->with('success','Room Number Successfully Alloted.');
        }else{
            return redirect()->back()->with('error','Room Number Already Exists.');
        }
    }
 
    public function RestaurantOrderhistory($id,$status){
        
        $change = Transaction::where('id',$id)->first();
        $change->status = $status;
        $change->save();

         $status_arr = array('P'=>'Pending','C'=>'Cancelled','D'=>'Delievered','R'=>'Ready','A'=>'Approved','PU'=>'PickedUp');

        if($status == 'C'){
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>500]);
        }
    }

    public function changeUnreadStatusOrder($type){
       $transaction = Transaction::where('txn_type',$type)->where('read_status','Unread')->get();
       if(!empty($transaction)){
        foreach($transaction as $key => $value){
            $value['read_status'] = 'Read';
            $value->save();
        }
       }
     }

    public function roomnumberAlreadyExists($room_number){
     
        $room_number = explode(',', $room_number);
        $length = count($room_number);
        $length_in_range_is_true = 1;
        $count = 0;

        $is_true = "";
        while ($count < $length) {
           if($this->count_digit($room_number[$count]) != 3){
            echo "length_in_range_is_true";die;
           }
           $count++;
        }
 
        foreach ($room_number as $key => $value) {

            $room_exits = Transaction::where('room_number','like', '["%'.$value.'"]')->where('f_status','IH')->where('txn_type','ROOM')->get();
             if(count($room_exits) > 0){
                $is_true = "already_exists";
             }
        }


        if($is_true != ""){
           echo $is_true;
        }else{
           echo "not_exists";
        }
    }

    public function completedCancelledhistory(){
        $deli_cancel_txn = Transaction::whereIn('status',['D','C'])->where('txn_type','ITEM')->get();
        return view('orderhistory.index',compact('deli_cancel_txn'));
    }

    public function CancelRoomOrderHistory(){
        $c_room_orders = Transaction::where('status','ROOM_CANCELLED')->get();
        if($c_room_orders){
          foreach ($c_room_orders as $key => $value) {
            $refund_users = RefundUsers::where('user_id',$value->user_id)->where('txnid',$value->txnid)->first();
            if(!empty($refund_users)){
                $other_data_json = json_decode($refund_users->other_data, true);
                $value['refunded_amount'] = $other_data_json['amount'];
            }
          }
        }
 
        return view('orderhistory.cancel-room-order',compact('c_room_orders'));
    }



    public function count_digit($number)
    {
        return strlen((string) $number);
    }

    public function validationforRoomNumber($txnid,$length,$number_arr){
        $t_data = Transaction::where('txnid',$txnid)->first();
        $array = explode(',', $number_arr);
        if($t_data){
            $checkout_data = json_decode($t_data->checkout_form_data, true);

            $count = 0;
            $length_in_range_is_true = 1;
            $already_exists_is_true = 1;

            while ($count < $length) {
               if($this->count_digit($array[$count]) != 3){
                $length_in_range_is_true = 0;
               }
               $count++;
            }

            foreach ($array as $key => $value) {
                $room_exits = Transaction::where('room_number','like', '["%'.$value.'"]')->where('f_status','IH')->where('txn_type','ROOM')->get();
                if(count($room_exits) > 0){
                  $already_exists_is_true = 0;
               }
            }

            if(count(array_unique($array))<count($array)){
                return response()->json(['status'=>'repeat_room_number']);
            }else if($length_in_range_is_true == 0){
                return response()->json(['status'=>'length_of_room_number_in_range']);
            }else if($checkout_data['item']['room'] != $length){
                return response()->json(['status'=>'length_of_room_number']);
            }else if($already_exists_is_true == 0){
                return response()->json(['status'=>'already_exists_is_true']);
            }else{
                return response()->json(['status'=>200]);
            }

        }

    }

    public function cancellIfCheckOutTimeOver(){
        Log::info("cron run in one day at a time");
        $transactions = Transaction::where('txn_type','ROOM')->where('f_status','U')->get();
        $today_date = strtotime("now");
        
        if($transactions){
            foreach($transactions as $tr_key => $tr_value){
                $checkout_form_data = json_decode($tr_value->checkout_form_data, true);
                if($checkout_form_data != null){
                    $checkout_date = $checkout_form_data['checkout'];
                    if(strtotime($checkout_date.' 11:00:00') < $today_date){
                       $tr_value->f_status = "U";
                       $tr_value->status = "ROOM_CANCELLED";
                       $tr_value->reason_cancelled_room = "User did not cancel the room";
                       $tr_value->save();
                    }
                }
            }
        }
    }   

    public function payments($user_id = '',$start_Date='',$end_Date=''){
        if($start_Date != '' && $end_Date != ''){
            $topup_payments = Wallet::with('user','transactions')->where('amount_type','TTI_CREDIT')->where('txn_type','CREDIT')->whereBetween('created_at',[$start_Date.' 00:00:00',$end_Date.' 00:00:00'])->orderBy('created_at', 'desc')->get()->unique('user_id');
            $wallet_payments = Wallet::with('user','transactions')->whereBetween('created_at',[$start_Date.' 00:00:00',$end_Date.' 00:00:00'])->orderBy('created_at', 'desc')->get()->unique('user_id');
            $transactions = Transaction::with('user')->whereBetween('created_at',[$start_Date.' 00:00:00',$end_Date.' 00:00:00'])->orderBy('created_at','desc')->get()->unique('user_id');
        }else if($user_id != ''){ 
            $topup_payments = Wallet::with('user','transactions')->where('user_id',$user_id)->where('amount_type','TTI_CREDIT')->where('txn_type','CREDIT')->orderBy('created_at', 'desc')->get()->unique('user_id');
            $wallet_payments = Wallet::with('user','transactions')->where('user_id',$user_id)->orderBy('created_at', 'desc')->get()->unique('user_id');
            $transactions = Transaction::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get()->unique('user_id');
        }else{
            $topup_payments = Wallet::with('user','transactions')->where('amount_type','TTI_CREDIT')->where('txn_type','CREDIT')->orderBy('created_at', 'desc')->get()->unique('user_id');
            $wallet_payments = Wallet::with('user','transactions')->orderBy('created_at', 'desc')->get()->unique('user_id');
            $transactions = Transaction::with('user')->orderBy('created_at','desc')->get()->unique('user_id');
        }

        return view('payments.index',compact('topup_payments','wallet_payments','transactions'));
     }

     public function refundData($id,$type){
        $wallet = Wallet::where('txnid',$id)->first();
        if($wallet){
           
            $trans_data = Transaction::where('txnid',$id)->first();

            if($type == 'room'){
	            $checkout_data = json_decode($trans_data->checkout_form_data, true);
	            $payudata_data = json_decode($trans_data->payu_data, true);
	            
	            $checkin  = strtotime($checkout_data['checkin']." 12:00:00");
	            $before_24_hour_time = $checkin - 86400;
	            $current_time = time() + env('TIMEZONE');
            }

            if($type == 'room' && $current_time >= $before_24_hour_time){
            	return response()->json(['status'=>500]);
            }else{
	            $trans_data->is_refunded = 1;
	            $trans_data->save();

	            $wallet->is_refunded = 1;
	            $wallet->save();
	            $user = User::where('id',$wallet->user_id)->first();

	            $refund = new Wallet();
	            $refund->user_id = $wallet->user_id;
	            $refund->amount = $wallet->amount;
	            $refund->message = ($wallet->amount_type == "TTI_CREDIT") ? "Credit Refunded TTI Amount" : "Credit Refunded Wallet Amount";
	            $refund->txn_type = 'credit';
	            $refund->amount_type = 'REFUND_CREDIT';
	            $refund->save();

	            $email = $user['email'];
	            $name = $user['first_name'].' '.$user['last_name'];
	            $amount = $wallet->amount;
	           // dispatch(new RefundedAmountJob($email,$name,$amount));
	           
	            $message = "Hello ".$name.", Rs. ".$amount." is credited to your TTI Wallet. Hope to see you in the future. HAVE A GREAT TIME";
	           // $this->sendMessageWhatsapp($user['phone_number'],$message);

	            return response()->json(['status'=>200]);
            }
            

        }
        return response()->json(['status'=>500]);
     }
   
     public function seeTopUpPyemtns($user_id){
        $topwallet =  Wallet::with('user')->where('user_id',$user_id)->where('amount_type','TTI_CREDIT')->where('txn_type','CREDIT')->orderBy('created_at','desc')->get();
        return view('payments.view',compact('topwallet'));
     }
     
     public function seeAllPyemtns($user_id){
        $gruped_payments =  Wallet::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        return view('payments.view',compact('gruped_payments'));
     }
    
     public function seeRoomItemAllPyemtns($user_id){
        $roomitempayments =  Transaction::with('user')->where('user_id',$user_id)->orderBy('created_at','desc')->get();
        return view('payments.view',compact('roomitempayments'));
     }
 

    public function downloadReceipt($txnid){
    
    $getallData = Transaction::where('txnid', $txnid)->first();
   
    if(!empty($getallData)){
      $addres_setting = Setting::where('key','address')->first();
      $phone_setting = Setting::where('key','phone_number')->first();

      $checkout_form_data = json_decode($getallData['checkout_form_data'], true);
      $item_array = '';
             
      if(array_key_exists('item',$checkout_form_data)) {
        $item = $checkout_form_data['item'];
        foreach($item as $key => $food){
          $item_array = $item_array.'<tr><td valign="middle" style="width:60%; background:#f5efd8; padding:5px 8px; border-bottom:1px solid #fffcf1;">
          <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;"><img src="'.env('APP_URL').'public/img/order-img.png" style="margin-top:2px;"> &nbsp;&nbsp;'.$food['name'].'</div></td><td valign="middle" style="width:40%; background:#f5efd8; padding:5px 8px;  border-bottom:1px solid #fffcf1; text-align: right; font-size:13px; line-height:14px;"> <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"><td valign="middle" style="width:50%; background:#f5efd8; font-size:13px; line-height:14px;">'. $food['quantity'].' x '.$food['price'].'</td><td valign="middle" style="width:50%;text-align: right; font-size:13px; line-height:14px;"> Rs. '.number_format((float)$food['final_price'], 2, '.', '').'</td></tr></table></td></tr>';
        } 
      }
       $status_arr = array('P'=>'Pending','C'=>'Cancelled','D'=>'Delievered','R'=>'Ready','A'=>'Approved','PU'=>'PickedUp');

       if($getallData->user) {$full_name = $getallData->user['first_name'].' '. $getallData->user['last_name'];}else{ $full_name =  '----'; }
       if($getallData->user) { $email_address = $getallData->user['email'];}else{ $email_address = "----";}
       if($getallData->user) { $phone_number = $getallData->user['phone_number'];}else{ $phone_number =  "----"; }
       $status = !empty($getallData->status) ? $status_arr[$getallData->status] : '----';
       $created_at = !empty($getallData->created_at) ? date('d/m/Y, h:i A', strtotime($getallData->created_at)) : '----';

       $deliver_address = UserAddress::select('address')->where('id',$checkout_form_data['selectedaddress'])->first();

        $deli_addr = '';
       if(isset($checkout_form_data['delivery_mode']) && $checkout_form_data['delivery_mode'] == 'In House Order'){
            $deli_addr = ' <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Delivery Mode:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $checkout_form_data['delivery_mode'] .'</td>
                        </tr> <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Room No.:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $checkout_form_data['delivery_mode_room_no'] .'</td>
                        </tr>';
       }else{
             $deli_addr = ' <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Delivery Address:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'.  $deliver_address .'</td>
                        </tr>';
        }


       $addon_instructions =  !empty($checkout_form_data['addon_instructions']) ? $checkout_form_data['addon_instructions'] : '----';
 
        /************************PDF Generate *******************************************/
        $messagehtml = '<html><head></head><body>
                    <div style="width:800px; margin:0 auto; font-family: "Raleway", sans-serif;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                        <td style="padding-bottom:10px;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                            <td valign="middle" style="text-align: center;">
                                <h1 style="text-transform: uppercase; font-size:22px; font-weight:700; margin:0;">
                                    <img src="https://www.thetradeinternational.com/public/img/chef.png" alt="Img" style="height:25px; padding-right:6px; display:inline-block; vertical-align:middle;">
                                    Restaurant Receipt
                                    <img src="https://www.thetradeinternational.com/public/img/chef.png" alt="Img" style="height:25px; padding-left:6px; display:inline-block; vertical-align:middle;">
                                </h1>
                            </td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td ></td>  
                    </tr>
                    <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="background: #fffcf1; padding:0 15px 5px;">
                        <tr>
                            <td style="height:10px;"></td>
                            <td style="height:10px;"></td>
                        </tr>
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Order ID:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. strtoupper($getallData->txnid).'</td>
                        </tr>
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Order Number:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">ORDER-'.$getallData->id.'</td>
                        </tr>                    
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Delivery Status:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $status .'</td>
                        </tr>
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Date:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'.$created_at.'</td>
                        </tr>
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Customer Name:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'.$full_name.'</td>
                        </tr>
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Email:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $email_address.'</td>
                        </tr>                        
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Phone:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $phone_number.'</td>
                        </tr>
                       '.$deli_addr.'
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Addon Instruction:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'.$addon_instructions.'</td>
                        </tr>
                        <tr>
                            <td height="10"></td>
                            <td></td>
                        </tr>
                       '. $item_array.'
                        
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Sub Total:</div>
                            </td>

                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">
                            Rs. '. number_format((float)$checkout_form_data['subtotal_amt'], 2, '.', '').'
                            </td>
                        </tr>
                        
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Taxes:</div>
                            </td>

                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">
                            Rs. '. number_format((float)$checkout_form_data['subtotal_taxes'], 2, '.', '').'
                            </td>
                        </tr>
                        
                    
                        
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Support Rider:</div>
                            </td>

                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">
                            Rs. '.number_format((float)$checkout_form_data['subtotal_rider'], 2, '.', '').'
                            </td>
                        </tr>
                        
                        <tr>
                            <td valign="middle" height="3" style="width:70%; padding:3px 0;"></td>
                            <td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                        </tr>
                        
                        <tr>
                            <td valign="middle" style="width:70%; padding:4px 10px; background:#222; ">
                            <div style="font-size:16px; color: #fff; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Total :</div>
                            </td>

                            <td valign="middle" style="width:30%; padding:4px 10px;  background:#222; color:#fff; font-weight: 700; text-align: right; font-size:16px; line-height:14px;">
                            Rs. '. number_format((float)($checkout_form_data['net_total_amt'] + $checkout_form_data['subtotal_rider']), 2, '.', '').'
                            </td>
                        </tr>
                        
                        <tr>
                            <td valign="middle" height="3" style="width:70%; padding:3px 0;"></td>
                            <td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                        </tr>
                        
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Trade International Credit :</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">- '.number_format((float)$checkout_form_data['subtotal_tti_credit'], 2, '.', '').' P</td>
                        </tr>
                        
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Reward Points :</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">- '.number_format((float)$checkout_form_data['subtotal_tti_rewardpoint'], 2, '.', '').' P</td>
                        </tr>
                        
                        <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Promocode :</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">
                            -Rs. '.number_format((float)$checkout_form_data['promocode_deduction'], 2, '.', '').'</td>
                        </tr>
                        

                        <tr>
                            <td valign="middle" height="3" style="width:70%; padding:3px 0;"></td>
                            <td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                        </tr>

                        <tr>
                            <td valign="middle" style="padding:4px 10px; width:70%;  background:#222;">
                            <strong style="text-transform: uppercase; font-size:16px; color: #fff; font-weight: 700; display: block;">Payable Amount :</strong>
                            </td>

                            <td valign="middle" style="padding:4px 10px;  background:#222; width:30%; text-align: right;">
                            <strong style="text-transform: uppercase; font-size:16px; line-height:16px; color: #fff; font-weight: 700; display: block;">
                                Rs. '.number_format((float)$getallData['amount'], 2, '.', '').'
                            </strong>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                </table>
                </div>
        </body></html>';
        
     require_once base_path() . '/vendor/dompdf/autoload.inc.php';
     $dompdf = new Dompdf();
     $options = $dompdf->getOptions(); 
     $options->set(array('isRemoteEnabled' => true));
     $dompdf->setOptions($options);
     $dompdf->setPaper('A4', 'landscape');
     $dompdf->loadHtml($messagehtml);
     @$dompdf->render();
     $filename = "downloadRestaurantReceipt.pdf";
     $dompdf->stream($filename);
    // echo $messagehtml; die;
    }

  /*******************************************************************/
    }

    public function printRestatrantBill($txnid)
    {
        $getallData = Transaction::where('txnid', $txnid)->first();
        if(!empty($getallData)){
        $addres_setting = Setting::where('key','address')->first();
        $phone_setting = Setting::where('key','phone_number')->first();

        $checkout_form_data = json_decode($getallData['checkout_form_data'], true);
        $item_array = '';
                
        if(array_key_exists('item',$checkout_form_data)) {
            $item = $checkout_form_data['item'];
            foreach($item as $key => $food){
            $item_array = $item_array.'<tr><td valign="middle" style="width:60%; background:#f5efd8; padding:5px 8px; border-bottom:1px solid #fffcf1;">
            <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;"><img src="'.env('APP_URL').'public/img/order-img.png" style="margin-top:2px;-webkit-print-color-adjust: exact;"> &nbsp;&nbsp;'.$food['name'].'</div></td><td valign="middle" style="width:40%; background:#f5efd8; padding:5px 8px;  border-bottom:1px solid #fffcf1; text-align: right; font-size:13px; line-height:14px;"> <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"><td valign="middle" style="width:50%; background:#f5efd8; font-size:13px; line-height:14px;">'. $food['quantity'].' x '.$food['price'].'</td><td valign="middle" style="width:50%;text-align: right; font-size:13px; line-height:14px;"> Rs. '.number_format((float)$food['final_price'], 2, '.', '').'</td></tr></table></td></tr>';
            } 
        }
        $status_arr = array('P'=>'Pending','C'=>'Cancelled','D'=>'Delievered','R'=>'Ready','A'=>'Approved');

        if($getallData->user) {$full_name = $getallData->user['first_name'].' '. $getallData->user['last_name'];}else{ $full_name =  '----'; }
        if($getallData->user) { $email_address = $getallData->user['email'];}else{ $email_address = "----";}
        if($getallData->user) { $phone_number = $getallData->user['phone_number'];}else{ $phone_number =  "----"; }
        $status = !empty($getallData->status) ? $status_arr[$getallData->status] : '----';
        $created_at = !empty($getallData->created_at) ? date('d/m/Y, h:i A', strtotime($getallData->created_at)) : '----';
        // $delivery_mode = isset($checkout_form_data['delivery_mode']) ? $checkout_form_data['delivery_mode'] : '----';
        
        $deliver_address = UserAddress::select('address')->where('id',$checkout_form_data['selectedaddress'])->first();
 

        $deli_addr = '';
       if(isset($checkout_form_data['delivery_mode']) && $checkout_form_data['delivery_mode'] == 'In House Order'){
            $deli_addr = ' <tr><td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Delivery Mode:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $checkout_form_data['delivery_mode'] .'</td>
                        </tr> <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Room No.:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $checkout_form_data['delivery_mode_room_no'] .'</td>
                        </tr>';
       }else{
             $deli_addr = ' <tr>
                            <td valign="middle" style="width:70%; padding:3px 0;">
                            <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Delivery Address:</div>
                            </td>
                            <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'.  $deliver_address .'</td>
                        </tr>';
        }

        $addon_instructions =  !empty($checkout_form_data['addon_instructions']) ? $checkout_form_data['addon_instructions'] : '----';
    
            /************************PDF Generate *******************************************/
            $messagehtml = '<html><head></head><body style="-webkit-print-color-adjust: exact;">
                        <div style="width:800px; margin:0 auto; font-family: "Raleway", sans-serif;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                        <tr>
                            <td style="padding-bottom:10px;">
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                <tr>
                                <td valign="middle" style="text-align: center;">
                                    <h1 style="text-transform: uppercase; font-size:22px; font-weight:700; margin:0;">
                                    <picture><img src="'.env('APP_URL').'https://www.thetradeinternational.com/public/img/chef.png" alt="Img" style="height:25px; padding-right:6px; display:inline-block; vertical-align:middle;"></picture>
                                        Restaurant Receipt
                                        <img src="'.env('APP_URL').'https://www.thetradeinternational.com/public/img/chef.png" alt="Img" style="height:25px; padding-left:6px; display:inline-block; vertical-align:middle;">
                                    </h1>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td ></td>  
                        </tr>
                        <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="background: #fffcf1; padding:0 15px 5px;">
                             <tr>
                                <td style="height:20px;"></td>
                                <td style="height:20px;"></td>
                            </tr>
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Order ID:</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. strtoupper($getallData->txnid).'</td>
                            </tr>
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Order Number:</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">ORDER-'.$getallData->id.'</td>
                            </tr>                    
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Delivery Status:</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $status .'</td>
                            </tr>
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Date:</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'.$created_at.'</td>
                            </tr>
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Customer Name:</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'.$full_name.'</td>
                            </tr>
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Email:</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $email_address.'</td>
                            </tr>                        
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Phone:</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'. $phone_number.'</td>
                            </tr>
                          '.$deli_addr.'
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size:13px; color: #222; font-weight:600; font-family: "Raleway", sans-serif; margin:0;">Addon Instruction:</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">'.$addon_instructions.'</td>
                            </tr>
                            <tr>
                                <td height="10"></td>
                                <td></td>
                            </tr>
                        '. $item_array.'
                            
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Sub Total:</div>
                                </td>

                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">
                                Rs. '. number_format((float)$checkout_form_data['subtotal_amt'], 2, '.', '').'
                                </td>
                            </tr>
                            
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Taxes:</div>
                                </td>

                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">
                                Rs. '. number_format((float)$checkout_form_data['subtotal_taxes'], 2, '.', '').'
                                </td>
                            </tr>
                            
                        
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Support Rider:</div>
                                </td>

                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">
                                Rs. '.number_format((float)$checkout_form_data['subtotal_rider'], 2, '.', '').'
                                </td>
                            </tr>
                            
                            <tr>
                                <td valign="middle" height="3" style="width:70%; padding:3px 0;"></td>
                                <td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                            </tr>
                            
                            <tr>
                                <td valign="middle" style="width:70%; padding:4px 10px; background:#222; ">
                                <div style="font-size:16px; color: #fff; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Total :</div>
                                </td>

                                <td valign="middle" style="width:30%; padding:4px 10px;  background:#222; color:#fff; font-weight: 700; text-align: right; font-size:16px; line-height:14px;">
                                Rs. '. number_format((float)($checkout_form_data['net_total_amt'] + $checkout_form_data['subtotal_rider']), 2, '.', '').'
                                </td>
                            </tr>
                            
                            <tr>
                                <td valign="middle" height="3" style="width:70%; padding:3px 0;"></td>
                                <td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                            </tr>
                            
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Trade International Credit :</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">- '.number_format((float)$checkout_form_data['subtotal_tti_credit'], 2, '.', '').' P</td>
                            </tr>
                            
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Reward Points :</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">- '.number_format((float)$checkout_form_data['subtotal_tti_rewardpoint'], 2, '.', '').' P</td>
                            </tr>
                            
                            <tr>
                                <td valign="middle" style="width:70%; padding:3px 0;">
                                <div style="font-size: 13px; color: #222; font-weight: 700; font-family: "Raleway", sans-serif; margin:0;">Promocode :</div>
                                </td>
                                <td valign="middle" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;">
                                -Rs. '.number_format((float)$checkout_form_data['promocode_deduction'], 2, '.', '').'</td>
                            </tr>
                            

                            <tr>
                                <td valign="middle" height="3" style="width:70%; padding:3px 0;"></td>
                                <td valign="middle" height="3" style="width:30%; padding:3px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                            </tr>

                            <tr>
                                <td valign="middle" style="padding:4px 10px; width:70%;  background:#222;">
                                <strong style="text-transform: uppercase; font-size:16px; color: #fff; font-weight: 700; display: block;">Payable  Amount :</strong>
                                </td>

                                <td valign="middle" style="padding:4px 10px;  background:#222; width:30%; text-align: right;">
                                <strong style="text-transform: uppercase; font-size:16px; line-height:16px; color: #fff; font-weight: 700; display: block;">
                                    Rs. '.number_format((float)$getallData['amount'], 2, '.', '').'
                                </strong>
                                </td>
                            </tr>
                             <tr>
                                <td style="height:20px;"></td>
                                <td style="height:20px;"></td>
                            </tr>

                            </table>
                        </td>
                        </tr>
                    </table>
                    </div>
            </body></html>';
            return response()->json(['html'=>$messagehtml]);
        }
    }
}
