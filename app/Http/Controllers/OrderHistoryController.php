<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\UserAddress;
use App\Setting;
use App\Wallet;
use App\User;
use App\AskQuestion;
use App\NewsLetter;
use Log;
use Illuminate\Support\Facades\Auth;
use App\RefundUsers;


class OrderHistoryController extends Controller
{

    public function newsletterListing()
    {
        $newsletters = NewsLetter::where('selected_website',1)->get();
        return view('newsletters.index', compact('newsletters'));
    }

    public function deleteNewsletter($id)
    {
        $data = NewsLetter::where('id', $id)->delete();
        if ($data != '' || $data != null) {
            echo 1;
            exit;
        } else {

            echo 0;
            exit;
        }
        return redirect('faqs')->with('success', 'FAQ has successfully deleted');
    }
    public function askedQuestions()
    {
        $asked_questions = AskQuestion::orderBy('id', 'desc')->get();
        return view('dashboard.asked_questions', compact('asked_questions'));
    }
    function countRoomBooking()
    {
        $room_booking_count = Transaction::where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->where('read_status', 'Unread')->count();
        return response()->json(['room_booking_count' => $room_booking_count]);
    }

    public function deleteAllPayments($type, $ids)
    {
        $ids = explode(',', $ids);
        if ($type == "wallet") {
            Wallet::whereIn('id', $ids)->delete();
        } else {
            Transaction::whereIn('id', $ids)->delete();
        }
        echo 1;
        die;
    }

    //Room booking functions start

    public function getUpcomingCheckinCheckout($start_date = '', $end_date = '')
    {
        if (Auth::user() && Auth::user()->role_id == 3) {

            $total_cmc_data = Transaction::where(function ($q) {
                $q->orWhereIn('f_status', ['M', 'C'])->orWhere('status', 'ROOM_CANCELLED');
            })->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->count();

          
            return view('orderhistory.all-bookings', compact('total_cmc_data'));
        }
    }
    public function getUpcoming($start_date = '', $end_date = '')
    {

        $today_upcoming_booking_query = Transaction::with('user')->where('f_status', 'U')->where('status', '!=', 'ROOM_CANCELLED')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN');
        $later_upcoming_booking_query = Transaction::with('user')->where('f_status', 'U')->where('status', '!=', 'ROOM_CANCELLED')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN');
        $prev_upcoming_booking_query = Transaction::with('user')->where('f_status', 'U')->where('status', '!=', 'ROOM_CANCELLED')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN');

        if ($start_date != '' && $end_date != '') {

            $today_upcoming_booking_query = $today_upcoming_booking_query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 00:00:00'])->whereDate('checkout_form_data->checkin', '=', date('Y-m-d'));

            $later_upcoming_booking_query = $later_upcoming_booking_query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 00:00:00'])->whereDate('checkout_form_data->checkin', '>', date('Y-m-d'));

            $prev_upcoming_booking_query = $prev_upcoming_booking_query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 00:00:00'])->whereDate('checkout_form_data->checkin', '<', date('Y-m-d'));
        } else {

            $today_upcoming_booking_query =  $today_upcoming_booking_query->whereDate('checkout_form_data->checkin', '=', date('Y-m-d'));

            $later_upcoming_booking_query = $later_upcoming_booking_query->whereDate('checkout_form_data->checkin', '>', date('Y-m-d'));

            $prev_upcoming_booking_query = $prev_upcoming_booking_query->whereDate('checkout_form_data->checkin', '<', date('Y-m-d'));
        }


        $today_upcoming_booking = $today_upcoming_booking_query->orderBy('updated_at', 'desc')->get();

        $later_upcoming_booking = $later_upcoming_booking_query->orderBy('updated_at', 'desc')->get();

        $prev_upcoming_booking = $prev_upcoming_booking_query->orderBy('updated_at', 'desc')->get();

        //$in_house_booking =  $in_house_booking = Transaction::with('user')->where('f_status', 'IH')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->orderBy('updated_at', 'desc')->get();

        $total_today_later = Transaction::with('user')->where('f_status', 'U')->where('status', '!=', 'ROOM_CANCELLED')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->orderBy('updated_at', 'desc')->count();


        return view('orderhistory.upcoming-history', compact('today_upcoming_booking', 'later_upcoming_booking', 'prev_upcoming_booking', 'total_today_later'));
    }

    public function getCheckin($start_date = '', $end_date = '')
    {
        $inhouse_query = Transaction::with('user')->where('f_status', 'IH')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN');

        if ($start_date != '' && $end_date != '') {
            $inhouse_query = $inhouse_query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 00:00:00']);
        }

        $in_house_booking = $inhouse_query->orderBy('updated_at', 'desc')->get();

        if (!empty($in_house_booking)) {
            foreach ($in_house_booking as $ih_key => $ih_value) {
                $checkout_form_data = json_decode($ih_value->checkout_form_data, true);
                if (date('Y-m-d', time()) == $checkout_form_data['checkout']) {
                    $ih_value['today_checkout_record'] =  $ih_value->id;
                }

                $room_number = json_decode($ih_value['room_number'], true);

                if ($room_number) {
                    foreach ($room_number as $key => $value) {
                        $ih_value['items_booking'] =  Transaction::where('room_number', 'like', '["%' . $value . '"]')->whereBetween('created_at', [$checkout_form_data['checkin'] . ' 00:00:00', $checkout_form_data['checkout'] . ' 23:59:00'])->where('txn_type', 'ITEM')->get();
                    }
                }
            }
        }

        return view('orderhistory.inhour-history', compact('in_house_booking'));
    }

    public function getCheckout($start_date = '', $end_date = '', $current_page = '', $records_per_page = '', $offset = '', $search_text = '')
    {

        $query = Transaction::with('user', 'wallet')->where(function ($q) {
            $q->orWhereIn('f_status', ['M', 'C'])->orWhere('status', 'ROOM_CANCELLED');
        })->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->orderBy('updated_at', 'desc')->offset($offset)->limit($records_per_page);

        if ($start_date != "0" && $end_date != "0" && $search_text == "0") {
            $mark_complete_cancel = $query->where(function ($q) use ($start_date, $end_date) {
                $q->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
            });
        } else if ($start_date != "0" && $end_date != "0" && $search_text != "0") {

            $mark_complete_cancel = $query->where(function ($q) use ($start_date, $end_date) {
                $q->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 00:00:00']);
            })->where(function ($query) use ($search_text) {
                $query->whereJsonContains('checkout_form_data->customerName', $search_text)->orWhereJsonContains('checkout_form_data->customerEmail', $search_text)->orWhereJsonContains('checkout_form_data->customerPhone', $search_text)->orWhereJsonContains('checkout_form_data->room_category', $search_text);
            });
        } else if ($start_date == "0" && $end_date == "0" && $search_text != "0") {

            $mark_complete_cancel = $query->where(function ($query1) use ($search_text) {
                $query1->whereJsonContains('checkout_form_data->customerName', $search_text)->orWhereJsonContains('checkout_form_data->customerEmail', $search_text);
            });
        } else {
        }

        $mark_complete_cancel = $query->get();

        $total_cmc_data = Transaction::where(function ($q) {
            $q->orWhereIn('f_status', ['M', 'C'])->orWhere('status', 'ROOM_CANCELLED');
        })->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->count();


        return view('orderhistory.completed-history', compact('mark_complete_cancel', 'offset', 'total_cmc_data'));
    }
    //Room booking functions end

    public function seeAllUpcomingCheckinCheckout($id, $type)
    {

        $transaction_data = Transaction::with('user')->where('id', $id)->first();
        if ($type == "inhouse")
            return view('orderhistory.view-inhouse-room-detail', compact('transaction_data'));
        else
            return view('orderhistory.view-room-detail', compact('transaction_data'));
    }



    public function getModes($mode)
    {
        if ($mode == "inhouse")
            return "In House Order";
        else if ($mode == "delivery")
            return "Delivery";
        else
            return "Takeaway";
    }

    //new orderes function



    public function exportCsvAllBookings($start_date = '', $end_date = '', $status = '')
    {

        $txn_query = Transaction::with('user')->where('status', $status)->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN');

        if ($status != 'no') {
            if ($status == "ROOM_CANCELLED")
                $txn_query = $txn_query->where('status', $status)->get();
            else
                $txn_query = ($status == 'all') ? $txn_query : $txn_query->where('f_status', $status);
        }
        if ((($start_date != ''  && $start_date != 0)  && ($end_date != '' && $end_date != 0)) && $status == 'no') {
            $txn_query = $txn_query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
        }
        if ((($start_date != ''  && $start_date != 0)  && ($end_date != '' && $end_date != 0)) && $status != 'no') {
            if ($status == "ROOM_CANCELLED")
                $txn_query = $txn_query->where('status', $status)->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
            else
                $txn_query = ($status == 'all') ? $txn_query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']) : $txn_query->where('f_status', $status)->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
        }

        $transaction = $txn_query->get();

        $fileName = 'ordered-item.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Room Type', 'Checkin Date', 'Checkout Date', 'Bill Amount', 'Status');
        $callback = function () use ($transaction, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transaction as $value) {
                $checkout_data = json_decode($value->checkout_form_data, true);

                $row['name']  = ucwords($checkout_data['customerName']);
                foreach ($checkout_data['item'] as $key => $item_value) {
                    if ($key == 'room_title')
                        $row['room_type'] = $item_value;
                }
                $row['checkin']  = $checkout_data['checkin'];
                $row['checkout']  = $checkout_data['checkout'];

                $row['bill_detail'] = '₹' . ($checkout_data['f_total_amt']);

                if ($value->status == "ROOM_CANCELLED")
                    $row['status'] = "Cancelled";
                elseif ($value->f_status == "U")
                    $row['status'] = "Upcoming";
                elseif ($value->f_status == "M")
                    $row['status'] = "Mark as No Show";
                elseif ($value->f_status == "C")
                    $row['status'] = "Completed";
                elseif ($value->f_status == "IH")
                    $row['status'] = "In House";
                else
                    $row['status'] = "Cancelled";

                fputcsv($file, array($row['name'], $row['room_type'], $row['checkin'], $row['checkout'], $row['bill_detail'], $row['status']));
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
        $room_order_history = Transaction::with('user')->where('status', '!=', 'ROOM_CANCELLED')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->get();

        if (!empty($room_order_history)) {
            foreach ($room_order_history as $value) {
                if (isset(json_decode($value['checkout_form_data'], true)['selectedaddress'])) {
                    $address_id = !isset($value['checkout_form_data']) ? json_decode($value['checkout_form_data'], true)['selectedaddress'] : 0;
                    $deliver_address = UserAddress::select('address')->where('id', $address_id)->first();
                    $value['deliver_address'] = $deliver_address['address'];
                }
            }
        }
        return view('orderhistory.index', compact('room_order_history'));
    }


    public function show($id)
    {
        $order_history = Transaction::with('user')->where('id', $id)->first();
        if ($order_history->txn_type == 'ITEM') {
            if (!empty($order_history)) {
                if (isset(json_decode($order_history['checkout_form_data'], true)['selectedaddress'])) {
                    $address_id = !empty($order_history['checkout_form_data']) ? json_decode($order_history['checkout_form_data'], true)['selectedaddress'] : 0;
                    $deliver_address = UserAddress::select('address')->where('id', $address_id)->first();
                }
            }
            $from_address = Setting::where('key', 'address')->first();
            $rastro_order_history = $order_history;
            return view('orderhistory.view', compact('rastro_order_history', 'deliver_address', 'from_address'));
        }

        if ($order_history->txn_type == 'ROOM') {
            $room_order_history = $order_history;
            return view('orderhistory.view', compact('room_order_history'));
        }
    }

    public function upcomingOrderHistory()
    {
        $upcoming_transaction = Transaction::where('f_status', 'U')->where('status', '!=', 'ROOM_CANCELLED')->get();
        return view('orderhistory.upcoming-history', compact('upcoming_transaction'));
    }
    public function inhouseOrderHistory()
    {

        $ih_transaction = Transaction::where('f_status', 'IH')->where('status', '!=', 'ROOM_CANCELLED')->get();
        if (!empty($ih_transaction)) {
            foreach ($ih_transaction as $ih_key => $ih_value) {
                $checkout_form_data = json_decode($ih_value->checkout_form_data, true);

                if (date('Y-m-d', time()) == $checkout_form_data['checkout']) {
                    $ih_value['today_checkout_record'] =  $ih_value->id;
                }

                $room_number = json_decode($ih_value['room_number'], true);
                if ($room_number)
                    $ih_value['items_booking'] =  Transaction::whereIn('room_number', $room_number)->whereBetween('created_at', [$checkout_form_data['checkin'] . ' 00:00:00', $checkout_form_data['checkout'] . ' 23:59:00'])->where('txn_type', 'ITEM')->get();
            }
        }
        return view('orderhistory.inhour-history', compact('ih_transaction'));
    }
    public function completedOrderHistory()
    {
        $c_transaction = Transaction::where('f_status', 'C')->where('status', '!=', 'ROOM_CANCELLED')->get();

        return view('orderhistory.completed-history', compact('c_transaction'));
    }

    public function changeStatusOrderHistory($id, $status, $amount, $type, $typeJson, $position)
    {
        $transaction = Transaction::where('id', $id)->first();

        if ($type == 'status') {
            $transaction->f_status = $status;
        } else {
            $checkout_form_data = json_decode($transaction->checkout_form_data, true);
            $new_remaining_amount = $checkout_form_data['f_total_amt'] + $amount;
            $percentage = $new_remaining_amount / $checkout_form_data['grand_total_amt'] * 100;
            $percentage = round($percentage, 2);
            $payment_arr = [];
            $payment_new_arr = [];
            $payment_object = json_encode(['mode' => $status, 'value' => $amount]);
            array_push($payment_arr, $payment_object);
            array_push($payment_new_arr, $payment_arr);

            $prev_arr = $transaction->payment_mode != null && $transaction->payment_mode != "" ? json_decode($transaction->payment_mode) : [];

            array_push($prev_arr, $payment_object);

            $transaction->payment_mode = $prev_arr;

            $final_amount = 0;
            $grand_total_amt = 0;
            foreach ($checkout_form_data as $key => $value) {

                if ($key == 'f_total_amt') {
                    $amt_new = round($value, 2) + round($amount, 2);
                    $final_amount = round(abs($amt_new), 2);
                    $checkout_form_data['f_total_amt'] = round(abs($amt_new), 2);
                }
                if ($key == 'payment_option') {
                    $checkout_form_data['payment_option'] = (round($percentage, 2) >= 100 || round($percentage, 2) == 0) ? 100 : round($percentage, 2);
                }
            }

            if ($final_amount == $grand_total_amt) {
                $checkout_form_data['payment_option'] = 100;
            }

            $transaction->checkout_form_data = $checkout_form_data;
        }

        if ($position == 2 || $position == "2")
            $transaction->inperson_checkin_time = date('Y-m-d H:i:s');

        if ($position == 1 || $position == "1")
            $transaction->inperson_checkout_time = date('Y-m-d H:i:s');

        $transaction->save();
        return response()->json(['status' => 200]);
    }

    public function saveRoomNumber(Request $request)
    {
        $roomnumber = explode(',', $request->roomnumber);
        $all_room_number = [];
        foreach ($roomnumber as $key_room => $value_room) {
            array_push($all_room_number, $value_room);
        }

        $length = count($roomnumber);
        $length_in_range_is_true = 1;
        $count = 0;

        $is_true = "";
        while ($count < $length) {
            if ($this->count_digit($roomnumber[$count]) != 3) {
                return redirect()->back()->with('error', 'Maximum 3 digits is required for each Room Number.'); //echo "length_in_range_is_true";die;
            }
            $count++;
        }

        foreach ($roomnumber as $key => $value) {

            $room_exits = Transaction::where('room_number', 'like', '["%' . $value . '"]')->where('f_status', 'IH')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->get();
            if (count($room_exits) > 0) {
                $is_true = "already_exists";
            }
        }

        if ($is_true == "") {
            $txn_data = Transaction::where('id', $request->txn_id)->first();
            $txn_data->room_number = json_encode($all_room_number);
            $txn_data->save();

            return redirect()->back()->with('success', 'Room Number Successfully Alloted.');
        } else {
            return redirect()->back()->with('error', 'Room Number Already Exists.');
        }
    }

    public function changeUnreadStatusOrder($type)
    {
        $transaction = Transaction::where('txn_type', $type)->where('read_status', 'Unread')->get();
        if (!empty($transaction)) {
            foreach ($transaction as $key => $value) {
                $value['read_status'] = 'Read';
                $value->save();
            }
        }
    }

    public function roomnumberAlreadyExists($room_number)
    {

        $room_number = explode(',', $room_number);
        $length = count($room_number);
        $length_in_range_is_true = 1;
        $count = 0;

        $is_true = "";
        while ($count < $length) {
            if ($this->count_digit($room_number[$count]) != 3) {
                echo "length_in_range_is_true";
                die;
            }
            $count++;
        }

        foreach ($room_number as $key => $value) {

            $room_exits = Transaction::where('room_number', 'like', '["%' . $value . '"]')->where('f_status', 'IH')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->get();
            if (count($room_exits) > 0) {
                $is_true = "already_exists";
            }
        }


        if ($is_true != "") {
            echo $is_true;
        } else {
            echo "not_exists";
        }
    }



    public function CancelRoomOrderHistory()
    {
        $c_room_orders = Transaction::where('status', 'ROOM_CANCELLED')->get();
        if ($c_room_orders) {
            foreach ($c_room_orders as $key => $value) {
                $refund_users = RefundUsers::where('user_id', $value->user_id)->where('txnid', $value->txnid)->first();
                if (!empty($refund_users)) {
                    $other_data_json = json_decode($refund_users->other_data, true);
                    $value['refunded_amount'] = $other_data_json['amount'];
                }
            }
        }

        return view('orderhistory.cancel-room-order', compact('c_room_orders'));
    }



    public function count_digit($number)
    {
        return strlen((string) $number);
    }

    public function validationforRoomNumber($txnid, $length, $number_arr)
    {
        $t_data = Transaction::where('txnid', $txnid)->first();
        $array = explode(',', $number_arr);
        if ($t_data) {
            $checkout_data = json_decode($t_data->checkout_form_data, true);

            $count = 0;
            $length_in_range_is_true = 1;
            $already_exists_is_true = 1;

            while ($count < $length) {
                if ($this->count_digit($array[$count]) != 3) {
                    $length_in_range_is_true = 0;
                }
                $count++;
            }

            foreach ($array as $key => $value) {
                $room_exits = Transaction::where('room_number', 'like', '["%' . $value . '"]')->where('f_status', 'IH')->where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->get();
                if (count($room_exits) > 0) {
                    $already_exists_is_true = 0;
                }
            }

            if (count(array_unique($array)) < count($array)) {
                return response()->json(['status' => 'repeat_room_number']);
            } else if ($length_in_range_is_true == 0) {
                return response()->json(['status' => 'length_of_room_number_in_range']);
            } else if ($checkout_data['item']['room'] != $length) {
                return response()->json(['status' => 'length_of_room_number']);
            } else if ($already_exists_is_true == 0) {
                return response()->json(['status' => 'already_exists_is_true']);
            } else {
                return response()->json(['status' => 200]);
            }
        }
    }

    public function cancellIfCheckOutTimeOver()
    {
        Log::info("cron run in one day at a time");
        $transactions = Transaction::where('txn_type', 'ROOM')->where('booking_from', 'TTF_BOOKING_ENGIN')->where('f_status', 'U')->get();
        $today_date = strtotime("now");

        if ($transactions) {
            foreach ($transactions as $tr_key => $tr_value) {
                $checkout_form_data = json_decode($tr_value->checkout_form_data, true);
                if ($checkout_form_data != null) {
                    $checkout_date = $checkout_form_data['checkout'];
                    if (strtotime($checkout_date . ' 11:00:00') < $today_date) {
                        $tr_value->f_status = "U";
                        $tr_value->status = "ROOM_CANCELLED";
                        $tr_value->reason_cancelled_room = "User did not cancel the room";
                        $tr_value->save();
                    }
                }
            }
        }
    }

    public function payments($user_id = '', $start_Date = '', $end_Date = '')
    {
        if ($start_Date != '' && $end_Date != '') {
            $topup_payments = Wallet::with('user', 'transactions')->where('amount_type', 'TTI_CREDIT')->where('txn_type', 'CREDIT')->whereBetween('created_at', [$start_Date . ' 00:00:00', $end_Date . ' 00:00:00'])->orderBy('created_at', 'desc')->get()->unique('user_id');
            $wallet_payments = Wallet::with('user', 'transactions')->whereBetween('created_at', [$start_Date . ' 00:00:00', $end_Date . ' 00:00:00'])->orderBy('created_at', 'desc')->get()->unique('user_id');
            $transactions = Transaction::with('user')->whereBetween('created_at', [$start_Date . ' 00:00:00', $end_Date . ' 00:00:00'])->orderBy('created_at', 'desc')->get()->unique('user_id');
        } else if ($user_id != '') {
            $topup_payments = Wallet::with('user', 'transactions')->where('user_id', $user_id)->where('amount_type', 'TTI_CREDIT')->where('txn_type', 'CREDIT')->orderBy('created_at', 'desc')->get()->unique('user_id');
            $wallet_payments = Wallet::with('user', 'transactions')->where('user_id', $user_id)->orderBy('created_at', 'desc')->get()->unique('user_id');
            $transactions = Transaction::with('user')->where('user_id', $user_id)->orderBy('created_at', 'desc')->get()->unique('user_id');
        } else {
            $topup_payments = Wallet::with('user', 'transactions')->where('amount_type', 'TTI_CREDIT')->where('txn_type', 'CREDIT')->orderBy('created_at', 'desc')->get()->unique('user_id');
            $wallet_payments = Wallet::with('user', 'transactions')->orderBy('created_at', 'desc')->get()->unique('user_id');
            $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->get()->unique('user_id');
        }

        return view('payments.index', compact('topup_payments', 'wallet_payments', 'transactions'));
    }

    public function refundData($id, $type)
    {
        $wallet = Wallet::where('txnid', $id)->first();
        if ($wallet) {

            $trans_data = Transaction::where('txnid', $id)->first();

            if ($type == 'room') {
                $checkout_data = json_decode($trans_data->checkout_form_data, true);
                $payudata_data = json_decode($trans_data->payu_data, true);

                $checkin  = strtotime($checkout_data['checkin'] . " 12:00:00");
                $before_24_hour_time = $checkin - 86400;
                $current_time = time() + env('TIMEZONE');
            }

            if ($type == 'room' && $current_time >= $before_24_hour_time) {
                return response()->json(['status' => 500]);
            } else {
                $trans_data->is_refunded = 1;
                $trans_data->save();

                $wallet->is_refunded = 1;
                $wallet->save();
                $user = User::where('id', $wallet->user_id)->first();

                $refund = new Wallet();
                $refund->user_id = $wallet->user_id;
                $refund->amount = $wallet->amount;
                $refund->message = ($wallet->amount_type == "TTI_CREDIT") ? "Credit Refunded TTI Amount" : "Credit Refunded Wallet Amount";
                $refund->txn_type = 'credit';
                $refund->amount_type = 'REFUND_CREDIT';
                $refund->save();

                //  $email = $user['email'];
                $name = $user['first_name'] . ' ' . $user['last_name'];
                $amount = $wallet->amount;

                return response()->json(['status' => 200]);
            }
        }
        return response()->json(['status' => 500]);
    }

    public function seeTopUpPyemtns($user_id)
    {
        $topwallet =  Wallet::with('user')->where('user_id', $user_id)->where('amount_type', 'TTI_CREDIT')->where('txn_type', 'CREDIT')->orderBy('created_at', 'desc')->get();
        return view('payments.view', compact('topwallet'));
    }

    public function seeAllPyemtns($user_id)
    {
        $gruped_payments =  Wallet::with('user')->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return view('payments.view', compact('gruped_payments'));
    }

    public function seeRoomItemAllPyemtns($user_id)
    {
        $roomitempayments =  Transaction::with('user')->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return view('payments.view', compact('roomitempayments'));
    }
}
