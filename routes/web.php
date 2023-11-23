<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test-mail','RoomCheckoutController@testMail');

/***************************new routes *******************************/

Route::get('/','PageController@index')->name('home');
// //Room
Route::get('rooms','PageController@getRooms');

//check room availibility
Route::get('get-avails-room/{id}/{checkin}','PageController@getAvailsRooms');

Route::get('check-room-availability/{checkin?}','PageController@checkRoomAvailability');

Route::any('user-information','PageController@userInformation');

Route::get('checkout-information/{slug}/{hash}','PageController@checkoutInformation');
Route::post('submit-newsletter','PageController@newsletter');
 

// //room checkout routes
Route::any('submit-book-now','RoomCheckoutController@submitBookNow');
Route::get('room-cart/{orderid}','RoomCheckoutController@roomcart');
Route::any('save-room-temp-checkouts','RoomCheckoutController@saveRoomTempData');
Route::any('room-checkout-payment','RoomCheckoutController@roomCheckoutPayment');
Route::any('update-room-temp-checkouts','RoomCheckoutController@updateRoomTempData');
Route::any('generate-room-signature','RoomCheckoutController@generateRoomSignature');
Route::post('cancelReservation','RoomCheckoutController@cancelReservation');
Route::any('zero-checkout-room-payment','RoomCheckoutController@room_checkout_payment_for_zero_amount');
Route::get('room-payment-summary/{txn_id}','RoomCheckoutController@room_payment_success');
Route::get('downloadTicket/{txn_id}/{generate_type}','RoomCheckoutController@generateRoomPDF');

Route::post('apply-promo-code','RoomCheckoutController@applyPromoCode');
// //new route
Route::post('deduct-room-price','RoomCheckoutController@deductAmountForDeluxe');

Route::post('submit-ask-question','PageController@submitAskQuestion');

//log out
Route::post('logout','LoginUsers\LoginController@Logout');


// Route::group(['prefix' => 'SFJfrRsrEs6859UyGXiEL7dA2MBj9KuSrtbrtbrb'], function () {
    Route::get('login',function(){
        return view('auth.login');
    })->name('login');

	Route::post('login', [
        'as' => '',
        'uses' => 'LoginUsers\LoginController@loginManager'
    ]);
// });

Route::group(['middleware' => 'admin'],function(){

    // Route::get('/SFJfrRsrEs6859UyGXiEL7dA2MBj9KuSrtbrtbrb', 'OrderHistoryController@getUpcomingCheckinCheckout');
    Route::get('get-upcoming-checkin-checkout', 'OrderHistoryController@getUpcomingCheckinCheckout');

    // Route::get('count-total-unread-item-orders', 'OrderHistoryController@countItemOrders');

    Route::get('asked-questions', 'OrderHistoryController@askedQuestions');
    Route::get('count-total-unread-room-bookings', 'OrderHistoryController@countRoomBooking');

    
    Route::get('room-order-history/change-status/{id}/{status}/{amount}/{type}/{typeJson}/{position}','OrderHistoryController@changeStatusOrderHistory');
    Route::get('get-upcoming-history/{start_date?}/{end_date?}','OrderHistoryController@getUpcoming');
    Route::get('get-checkin-history/{start_date?}/{end_date?}','OrderHistoryController@getCheckin');
    Route::get('get-upcoming-cancel-history/{start_date?}/{end_date?}/{current_page?}/{records_per_page?}/{offset?}/{search_text?}','OrderHistoryController@getCheckout');
    Route::get('see-all-upcoming-checkin-checkout/{id}/{type}','OrderHistoryController@seeAllUpcomingCheckinCheckout');
    Route::get('export-csv-of-all-bookings/{start_date}/{end_date}/{status}','OrderHistoryController@exportCsvAllBookings');
    Route::delete('delete-all-payments/{type}/{ids}','OrderHistoryController@deleteAllPayments');

    Route::get('validation-room-number/{txnid}/{length}/{number_arr}', 'OrderHistoryController@validationforRoomNumber');
    Route::get('check-room-number-already-exists/{room_number}', 'OrderHistoryController@roomnumberAlreadyExists');
    Route::post('save-room-number', 'OrderHistoryController@saveRoomNumber');
    
    Route::get('newsletters','OrderHistoryController@newsletterListing');
    Route::delete('newsletters/{id}','OrderHistoryController@deleteNewsletter');

    Route::resource('faqs','FAQController');
    Route::delete('delete-all-faqs/{allids}','FAQController@deleteAllFAQs');
    
});