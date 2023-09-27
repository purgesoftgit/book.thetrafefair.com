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

Route::get('/','HomeController@index')->name('home');
Route::get('event','HomeController@event')->name('event');
Route::get('event-detail/{slug}','HomeController@eventDetail');

Route::post('event-store','HomeController@eventStore')->name('eventStore');

Route::get('spa','PageController@spa')->name('spa');
Route::post('spa-reservation','PageController@spaReservation')->name('spaReservation');

Route::get('thankyou','PageController@thankyou');

// Route::get('login','PageController@login');
// Route::get('register','PageController@register');
Route::get('about-us','PageController@about')->name('about');
Route::get('gallery','PageController@gallery');
Route::get('contact-us','PageController@contact')->name('contact');
Route::post('store','PageController@contactStore')->name('store');
Route::get('terms','PageController@terms');

Route::get('wedding','PageController@wedding');
Route::post('save-wedding-enquiry','PageController@saveWeddingEnquiry');

Route::get('corporte-meeting-halls','PageController@meetingpage');
Route::post('save-meeting-data','PageController@storeMeetingData');

Route::get('banquet','PageController@banquet');
Route::post('banquet-store','PageController@saveBanquetRequest')->name('banquet-store');

//login routes
Route::get('login','PageController@login');
Route::get('login/number','PageController@loginWithNumber');
Route::post('login/verify','PageController@verifyLogin');


//log out
Route::post('logout','PageController@Logout');


// Registater route
Route::get('register','PageController@register')->name('register');
Route::get('register/data','PageController@phoneVerification');
Route::post('register/store','PageController@registerData');
Route::get('register/data/otp','PageController@otp');
Route::get('register/is_verify_type','PageController@isVerify');
Route::get('resend-otp/{phone_number}','PageController@updateInsertVerification');

//Room
Route::get('rooms','PageController@getRooms');
Route::get('get-avails-room/{id}/{checkin}','PageController@getAvailsRooms');
Route::get('/room/{slug}', 'PageController@roomDetail');

//room checkout routes
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
//new route
Route::post('deduct-room-price','RoomCheckoutController@deductAmountForDeluxe');


//blog routes
Route::get('blog','PageController@blog')->name('blog');
Route::get('blog-detail/{slug}','PageController@blogDetail');
Route::get('career','PageController@career');
Route::post('save-career-details','PageController@saveCarrerForm');


//insert data in room addition detail according to currenct year (like Jan 2023 - Dec 2023)
Route::get('update-room-addition-year-data','PageController@updateRoomAdditionalYearData');

Route::post('save-review', 'PageController@saveReviews');

//front login routes

Route::group(['middleware' => 'auth'],function(){

    Route::get('profile','PageController@profile');   
    Route::post('profile/update','PageController@profileUpdate'); 

    Route::get('room-order-history/{status?}', 'DashboardController@getRoomOrderHistory');
    
    // Route::get('event-requests', 'DashboardController@getEventRequests');
    
});
