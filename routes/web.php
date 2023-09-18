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
Route::post('store','HomeController@contactStore')->name('store');
Route::post('event-store','HomeController@eventStore')->name('eventStore');

// Route::get('login','PageController@login');
// Route::get('register','PageController@register');
Route::get('about-us','PageController@about')->name('about');
Route::get('gallery','PageController@gallery');
Route::get('contact-us','PageController@contact')->name('contact');
Route::get('terms','PageController@terms');


Route::get('login','PageController@login');
Route::get('login/number','PageController@loginWithNumber');
Route::post('login/verify','PageController@verifyLogin');
Route::get('profile','PageController@profile')->middleware('auth');   
Route::post('profile/update','PageController@profileUpdate')->middleware('auth'); 

//log out
Route::post('logout','PageController@Logout');


// Registater route
Route::get('register','PageController@register')->name('register');
Route::get('register/data','PageController@phoneVerification');
Route::post('register/store','PageController@registerData');
Route::get('register/data/otp','PageController@otp');
Route::get('register/is_verify_type','PageController@isVerify');

//Room
Route::get('rooms','PageController@rooms');
Route::post('get-room-ajax','PageController@getRoomsAjax');
Route::get('get-avails-room/{id}/{checkin}','PageController@getAvailsRooms');
Route::get('/room-detail/{slug}', 'PageController@roomDetail');



Route::get('blog','PageController@blog')->name('blog');
Route::get('blog-detail/{slug}','PageController@blogDetail');
Route::get('career','PageController@career');

