@extends('layouts.layout')
@section('content')

@include('layouts.header')
<style>
    .enjoy-meals-during button.active {
        background: #009837;
        color: #fff;
        border-color: #009837;
    }
</style>
<main class="web-main">

    <!-- Page Title Section Start -->
    <section class="page-title-section" style="background-image:url(../img/suite-room-banner.jpg);">
        <div class="container">
            <div class="page-title">Book {{ $room->title ?? ''}}</div>
        </div>
    </section>
    <!-- Page Title Section End -->

    <!-- urls setting -->
    <span class="d-none send-otp-url" data-sendotp="{{url('register/data')}}"></span>
    <span class="d-none verify-opt-url" data-verifyopturl="{{url('register/data/otp')}}"></span>
    <span class="d-none fetch-avail-room" data-fetchavailroom="{{url('get-avails-room')}}"></span>
    <span class="d-none submit-book-now" data-submitbooknowurl="{{ url('submit-book-now') }}"></span>
    <span class="d-none save-room-temp-checkout" data-saveroomtempcheckout="{{ url('save-room-temp-checkouts') }}"></span>
    <span class="d-none room-checkout-url" data-roomcheckouturl="{{ url('room-cart') }}"></span>

    <input type="hidden" name="no_of_rooms" class="no_of_rooms" value="<?php echo isset($room->avails_room) ? $room->avails_room : $room->no_of_rooms; ?>">
    <input type="hidden" name="is_auth_check" class="is_auth_check" value="{{ Auth::check() }}">

    <span class="per_room_person d-none"><?php echo isset($room->avails_room) ? $room->avails_room : $room->no_of_rooms; ?></span>
    <span class="setting_person d-none">{{ $settings['per_room_person'] ?? 2}}</span>
    <span class="per_room_childrens_allowed d-none">{{ $settings['per_room_childrens_allowed'] ?? 0}}</span>
    <span class="no_of_avail_rooms d-none"><?php echo isset($room->avails_room) ? $room->avails_room : $room->no_of_rooms; ?></span>


    <!-- Rooms Page Section Start -->
    <section class="rooms-detail-page-section">
        <div class="container">
            <div class="rooms-detail-row">
                <!-- Col Start -->
                <div class="rooms-detail-col">

                    <section id="gallery-con">

                        <div class="room-offers">
                            <big>
                                <?php echo isset($room['new_off_percentage']) && !empty($room['new_off_percentage']) ? $room->new_off_percentage : $room->off_percentage;  ?><sup>%</sup></big>
                            <span>Off</span>
                        </div>
                        <div class="web-logo"><img src="{{asset('img/logo-blog.png')}}" alt="Logo"></div>

                        <section id="gallery-main">
                            @if (!is_null(json_decode($room->image)))
                            <img src="{{ env('BACKEND_URL') . 'show-images/' . json_decode($room->image)[0] }}">
                            @endif
                        </section>


                        {{--<section id="gallery-hidden">

                            @foreach(json_decode($room->image) as $key => $room_img)

                            <img src="{{env('BACKEND_URL') . 'show-images/' . $room_img}}" alt="Image">

                        @endforeach
                    </section>--}}


                    <!-- <section id="thumbnails">
                            <div id="left-arrow" class="ui-button">
                                <div class="icon icon-arrow-left"></div>
                            </div>
                            <div id="thumbcon">
                            </div>
                            <div id="right-arrow" class="ui-button">
                                <div class="icon icon-arrow-right"></div>
                            </div>
                        </section> -->
    </section>


    <div class="room-detail">
        <div class="room-detail-top">
            <div class="room-detail-title category-title">{{$room->title ?? ''}}</div>
        </div>
        <div class="room-detail-rate">

            <big>₹<small class="per_person_price"><?php echo isset($room->final_price) && !empty($room->final_price) ? $room->final_price : $room->price; ?></small></big>

            <s>₹<?php echo isset($room->new_old_price) && !empty($room->new_old_price) ? $room->new_old_price : $room->old_price; ?></s>
        </div>
        <p>{!! $room->description !!}</p>

    </div>

    <div class="enjoy-meals-during-section">
        <div class="room-detail-title mt-5 mb-3">Enjoy meals during your stay</div>
        <div class="row">

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <!-- Enjoy Meals During Start -->
                <div class="enjoy-meals-during">
                    <div class="enjoy-meals-img"><img src="{{asset('img/enjoy-meal-img.jpg')}}" alt="Breakfast in Hotel Trade Fair" class="img-fluid"></div>
                    <div class="enjoy-meals-title">Breakfast</div>
                    <p>Continental &amp; indian menu - (per person price)</p>
                    <div class="select-rs mb-2">Rs.

                        @if(isset($settings))

                        <span class="room-meal-price first_meal_price" data-foodType="Breakfast" data-mealIndex="0">{{$settings['breakfast_price'] ?? '0'}}</span>

                        @endif
                    </div>
                    <div class="d-grid">
                        <button type="button" class="btn btn-light" id="breakfast_select">Select</button>
                    </div>
                </div>
                <!-- Enjoy Meals During End -->
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <!-- Enjoy Meals During Start -->
                <div class="enjoy-meals-during">
                    <div class="enjoy-meals-img"><img src="{{asset('img/enjoy-meal-img2.jpg')}}" alt="Lunch Menu in Hotel Trade Fair" class="img-fluid"></div>
                    <div class="enjoy-meals-title">Lunch</div>
                    <p>Continental &amp; indian menu - (per person price)</p>
                    <select class="select-rs mb-2 second_meal_price select-rs-lunch" data-foodtype="Lunch" data-mealindex="1">
                        @if(isset($settings))

                        <option>Rs.{{$settings['lunch_price_veg']}} Veg</option>

                        <option>Rs.{{$settings['lunch_price_nonveg']}} Non-Veg</option>

                        @endif
                    </select>
                    <div class="d-grid">
                        <button type="button" class="btn btn-light" id="lunch_select">Select</button>
                    </div>
                </div>
                <!-- Enjoy Meals During End -->
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <!-- Enjoy Meals During Start -->
                <div class="enjoy-meals-during">
                    <div class="enjoy-meals-img"><img src="{{asset('img/enjoy-meal-img3.jpg')}}" alt="Best Dinner in Hotel Trade Fair" class="img-fluid"></div>
                    <div class="enjoy-meals-title">Dinner</div>
                    <p>Continental &amp; indian menu - (per person price)</p>
                    <select class="select-rs mb-2 third_meal_price select-rs-dinner" data-foodtype="Dinner" data-mealindex="2">
                        @if(isset($settings))

                        <option>Rs.{{$settings['dinner_price_veg']}} Veg</option>

                        <option>Rs.{{$settings['dinner_price_nonveg']}} Non-Veg</option>

                        @endif
                        <!-- <option>Rs.350 Veg</option>
                                        <option>Rs.450 Non-Veg</option> -->
                    </select>
                    <div class="d-grid">
                        <button type="button" class="btn btn-light" id="dinner_select">Select</button>
                    </div>
                </div>
                <!-- Enjoy Meals During End -->
            </div>

        </div>
    </div>


    <div class="detail-list">
        <div class="room-detail-title">About Hotel The Trade Fair</div>

        <ul class="checkin-checkout">
            <li>CHECK IN 12 PM</li>
            -
            <li>CHECK OUT 11 AM</li>
        </ul>

        <p>Conveniently close to major transit points and tourist hotspots, Hotel The Trade Fair&nbsp;presents a blend of elegance and comfort through its services and accommodation.</p>

        <ul class="ul-style">
            <li>Located 5km from Jaipur Railway Station.</li>
            <li>Just 2 minutes drive away from Akshardham Temple Jaipur.</li>
            <li>Shop for major shopping brands at Elements Mall, located 3 minutes away.</li>
        </ul>

        <div class="facility-list">
            <span class="badge">Food and Dining</span>
            <span class="badge">Location &amp; Surroundings</span>
            <span class="badge">Property Highlights</span>
            <span class="badge">Room Details &amp; Amenities</span>
            <span class="badge">Activities &amp; Nearby Attractions</span>
        </div>
    </div>


    </div>
    <!-- Col End -->


    <!-- Col Start -->
    <div class="rooms-detail-col-side">

        <div class="related-rooms-listing mb-5">
            <div class="room-detail-title mb-3">Other Rooms</div>

            <!-- Related Rooms List Start -->
            @if(!empty($related_room))
            @foreach($related_room as $rel_key => $rel_value)
            <a href="{{ url('room',$rel_value->slug) }}" class="related-rooms-list">
                <div class="related-rooms-img">
                    @foreach(json_decode($room->image) as $key => $image)
                    @if($loop->index == 0)
                    <img src="{{ env('BACKEND_URL') . 'show-images/' .$image}}" alt="{{ucwords($rel_value['title'])}}">
                    @endif
                    @endforeach
                </div>
                <div class="related-rooms-inner">
                    <div class="related-rooms-title ">{{ $rel_value->title ?? ''}}</div>
                    <div class="related-rooms-price">₹<?php echo isset($rel_value->final_price) && !empty($rel_value->final_price) ? $rel_value->final_price : $rel_value->price; ?>
                    </div>
                    <div class="related-rooms-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                </div>
            </a>
            @endforeach
            @endif
            <!-- Related Rooms List End -->

        </div>


        <section class="reservation-form guest-info-form">

            <!-- checkout URL and Data -->

            <?php
            if (env('CASHFREE_TEST_MODE')) {
                $merchant_key = env('CASHFREE_APP_ID_TEST');
                $action = env('CASHFREE_MERCHANT_ACTION_TEST');
            } else {
                $merchant_key = env('CASHFREE_APP_ID_LIVE');
                $action = env('CASHFREE_MERCHANT_ACTION_LIVE');
            }

            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            ?>


            <form class="form-validate" action="<?php echo $action; ?>" id="CheckoutRoomBook" method="post">

                <input type="hidden" name="appId" value="<?php echo $merchant_key; ?>" />
                <input type="hidden" name="orderId" value="" id="orderId" />
                <input type="hidden" name="orderAmount" id="payuprice" value="" />
                <input type="hidden" name="orderCurrency" class="orderCurrency" value="INR" />
                <input type="hidden" name="orderNote" value="" />
                <input type="hidden" name="customerName" class="customerName" value="{{ (Auth::check()) ? Auth::user()->first_name : ''}}" />
                <input type="hidden" name="customerEmail" class="customerEmail" value="{{ (Auth::check()) ? Auth::user()->email : '' }}" />
                <input type="hidden" name="customerPhone" class="customerPhone" value="{{ (Auth::check()) ? preg_replace('/^\+?91|\|1|\D/', '', (Auth::user()->phone_number)) : '' }}" />
                <input type="hidden" name="merchantData" id="merchantData" value="" />
                <input type="hidden" name="returnUrl" value="<?php echo env('APP_URL'); ?>room-checkout-payment" />
                <input type="hidden" name="notifyUrl" value="" />
                <input type="hidden" name="signature" id="signature" value="" />
                <input type="hidden" name="category" class="room_category" value="{{$room->room_category ?? ''}}">
                <input type="hidden" name="room_id" class="room_id" value="{{$room->id ?? ''}}">

                @if(!Auth::check())<div class="guest-info-form-maintitle">Already a Hotel The Trade Fair Member? <a href="{{ url('login') }}">Sign In</a> For Faster Booking</div>@endauth


                <span id="cashfreeData" data-txnid="<?php echo $txnid; ?>"></span>

                <div class="guest-info-form-title">GUEST INFORMATION</div>
                <div class="guest-info-form-subtitle">{{ strtoupper($room->title) }}</div>

                <div class="mb-4">
                    <label class="form-label">Salutation <sup class="text-danger">*</sup></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input salutation validate[required]" type="radio" name="salutation" id="Mr" value="1" {{ (Auth::check() && Auth::user()->role_id == 0 && Auth::user()->salutation == 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="mr-radio">Mr.</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input salutation validate[required]" type="radio" name="salutation" id="mrs" value="2" {{ (Auth::check() && Auth::user()->role_id == 0 && Auth::user()->salutation == 2) ? 'checked' : '' }}>
                            <label class="form-check-label" for="mrs-radio">Mrs.</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input salutation validate[required]" type="radio" name="salutation" id="ms" value="3" {{ (Auth::check() && Auth::user()->role_id == 0 && Auth::user()->salutation == 3) ? 'checked' : '' }}>
                            <label class="form-check-label" for="ms-radio">Ms.</label>
                        </div>
                    </div>

                </div>

                <div class="mb-4">
                    <label class="form-label" for="full-name-id">Full name <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control first_name validate[required]" name="first_name" placeholder="Full Name" value="{{ (Auth::check() && Auth::user()->role_id == 0) ? Auth::user()->first_name : '' }}">
                </div>

                <div class="mb-4">
                    <label class="form-label" for="full-name-id">Phone Number <sup class="text-danger">*</sup></label>
                    <div class="input-group mb-3">

                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{asset('img/india-flag.jpg')}}" alt="India Flag Image">&nbsp; +91
                        </span>
                        <input type="number" class="form-control phone phone-num validate[required,maxSize[10],minSize[10]]" id="checkout-phone" name="phone" maxlength="10" minlength="10" placeholder="Phone" value="{{ (Auth::check() && Auth::user()->role_id == 0) ? preg_replace('/^\+?91|\|1|\D/', '', (Auth::user()->phone_number)) : '' }}">

                        <div class="input-group-append edit-input-group-append" style="display: none;">
                            <span toggle="#password-field" class="input-group-text field-icon" style="height: 100%;color: #fff;background: #00b542;border-color: #00b542;">
                                <i class="fa fa-pencil"></i>
                            </span>
                        </div>

                        <span class="phone_error"></span>

                    </div>
                </div>

                @if(!Auth::check())
                <div class="row align-items-center mb-4">
                    <div class="col-lg-6 otp-input" style="display:none;">
                        <div class="passcode-wrapper">
                            <input id="codeBox1" type="text" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)">
                            <input id="codeBox2" type="text" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)">
                            <input id="codeBox3" type="text" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)">
                            <input id="codeBox4" type="text" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)">
                        </div>
                        <span id="invalid_otp"></span>
                    </div>

                    <div class="col-lg-6 second-verify-btn otp-input text-end" style="display: none;">
                        <button type="button" class="btn btn-primary btn-sm verify-btn">
                            <span class="verify-spinner-border spinner-border spinner-border-sm" style="display:none; margin: 0 5px;"></span>
                            Verify
                        </button>
                    </div>
                    <div class="verify-btn text-end">
                        <button type="button" class="btn btn-primary btn-sm">verify</button>
                    </div>

                </div>

                <div class="resend-otp" style="display: none;">
                    <div class="row mt-2 mb-3 align-items-center">

                        <div class="col-md-6" id="resend-otp-block">
                            <div class="countdown" id="ten-countdown"></div>
                        </div>

                        <div class="col-md-6 text-end">
                            <a class="resend-otp-btn" data-url="{{ url('resend-otp') }}/" style="display:block;">Resend OTP</a>
                            <span class="spinner-border resend-spinner-border spinner-border-sm" style="display:none; margin-left: auto;"></span>
                        </div>

                    </div>
                </div>
                @endif


                <div class="row">
                    <div class="mb-4 col-md-6 col-sm-6">
                        <label class="form-label">CHECK-IN <sup class="text-danger">*</sup></label>
                        <div class="datepicher-field">
                            <input type="date" class="form-control check-in {{ (!Auth::check()) ? 'remaining-box' : '' }}" name="checkin" id="datepicker" onkeydown="return false" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>

                    <div class="mb-4 col-md-6 col-sm-6">
                        <label class="form-label">CHECK-OUT <sup class="text-danger">*</sup></label>
                        <div class="datepicher-field">
                            <input type="date" class="form-control check-out {{ (!Auth::check()) ? 'remaining-box' : '' }}" name="checkout" onkeydown="return false" min="<?php echo date('Y-m-d', time() + 86400); ?>" value="<?php echo date('Y-m-d', time() + 86400); ?>" max="<?php echo date('Y-m-d', strtotime('+2 month')); ?>">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="mb-4 col-md-6 col-sm-6">
                        <label class="form-label">Guest <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control guest validate[required]" placeholder="Enter Guest">
                    </div>

                    <div class="mb-4 col-md-6 col-sm-6">
                        <label class="form-label">Room <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control room validate[required]" placeholder="Enter room number">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="email-id">Email <sup class="text-danger">*</sup></label>
                    <input type="email" class="form-control email  validate[required, custom[email]] " id="checkout-email" placeholder="Enter Email" value="{{ (Auth::check()) ? Auth::user()->email : '' }}">
                </div>

                <div class="mb-4">
                    <label class="form-label" for="children-id">Children</label>
                    <input type="number" class="form-control children" id="children-id" value="0" placeholder="Enter Children">
                </div>

                <div class="mb-4">
                    <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div><span class="text-error text-danger" id="recaptchaError"></span>
                    @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger"> {{ $erros->first('recaptcha') }} </span>
                    @endif
                </div>


                <div class="form-check mb-4">
                    <input class="form-check-input tandc validate[required] {{ (!Auth::check()) ? 'remaining-box' : '' }}" type="checkbox" name="accepttc" id="inlineCheckbox1">

                    <label class="form-check-label" for="flexCheckguest">To complete your reservation, you must agree to the Hotel The Trade Fair (“TTF”) Website Terms of Use. I agree to the TTF Website Terms of Use and Cancellation & Rate Details, and have read the Privacy Notice.</label>
                </div>

                <div class="d-grid">
                    <button type="button" class="btn btn-primary reservation-btn" id="complete-room-reservation-btn">Complete Reservation</button>
                </div>
            </form>
        </section>
    </div>
    <!-- Col End -->

    </div>


    <div class="room-detail-title mt-5 mb-3">Facilities at Hotel The Trade Fair</div>

    <div class="facility-box">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <div class="facility-box-list">
                    <div class="facility-box-icon"><img src="{{asset('img/lounge-icon.png')}}"></div>
                    <span>Lounge</span>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <div class="facility-box-list">
                    <div class="facility-box-icon"><img src="{{asset('img/parking-icon.png')}}"></div>
                    <span>Free Parking</span>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <div class="facility-box-list">
                    <div class="facility-box-icon"><img src="{{asset('img/briefcase-icon.png')}}"></div>
                    <span>Business Centre</span>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <div class="facility-box-list">
                    <div class="facility-box-icon"><img src="{{asset('img/conference-room-icon.png')}}"></div>
                    <span>Conference Room</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Col Start -->
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="facility-label">Transfers</div>

            <div class="facility-list">
                <span class="badge">Paid Pickup/Drop</span>
                <span class="badge">Paid Shuttle Service</span>
                <span class="badge">Paid Railway Station Transfers</span>
                <span class="badge">Paid Airport Transfers</span>
                <span class="badge">Paid Bus Station Transfers</span>
            </div>

            <div class="facility-label">Business center and conferences</div>

            <div class="facility-list">
                <span class="badge">Business Centre</span>
                <span class="badge">Printer</span>
                <span class="badge">Banquet</span>
                <span class="badge">Conference Room</span>
                <span class="badge">Photocopying</span>
                <span class="badge">Business Services</span>
            </div>
        </div>
        <!-- Col End -->


        <!-- Col Start -->
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="facility-label">Common area</div>

            <div class="facility-list">
                <span class="badge">Lounge</span>
                <span class="badge">Lawn</span>
                <span class="badge">Reception</span>
                <span class="badge">Seating Area</span>
            </div>

            <div class="facility-label">Outdoor activities and sports</div>

            <div class="facility-list">
                <span class="badge">Vehicle Rentals</span>
            </div>

            <div class="facility-label">Payment services</div>

            <div class="facility-list">
                <span class="badge">Currency Exchange</span>
            </div>

            <div class="facility-label">Family and kids</div>

            <div class="facility-list">
                <span class="badge">Childcare Services</span>
            </div>
        </div>
        <!-- Col End -->


        <!-- Col Start -->
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="facility-label">Media and technology</div>

            <div class="facility-list">
                <span class="badge">Electrical Adapters</span>
                <span class="badge">TV</span>
                <span class="badge">Electrical Chargers</span>
            </div>

            <div class="facility-label">Health and wellness</div>

            <div class="facility-list">
                <span class="badge">First-aid Services</span>
            </div>

            <div class="facility-label">Entertainment</div>

            <div class="facility-list">
                <span class="badge">Night Club</span>
            </div>
        </div>
        <!-- Col End -->

    </div>

    <div class="accordion accordion-style" id="accordionExample">
        <div class="row">

            <!-- col Start -->
            <div class="col-lg-6">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-safetyhygiene" aria-expanded="false" aria-controls="collapse-safetyhygiene">Safety and hygiene</button>
                    </h2>
                    <div id="collapse-safetyhygiene" class="accordion-collapse collapse" aria-labelledby="heading-safetyhygiene" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-basic-facilities" aria-expanded="false" aria-controls="collapse-basic-facilities">Basic facilities</button>
                    </h2>
                    <div id="collapse-basic-facilities" class="accordion-collapse collapse" aria-labelledby="heading-basic-facilities" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefood-drinks" aria-expanded="false" aria-controls="collapsefood-drinks">Food and drinks</button>
                    </h2>
                    <div id="collapsefood-drinks" class="accordion-collapse collapse" aria-labelledby="headingfood-drinks" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
            <!-- col End -->

            <!-- col Start -->
            <div class="col-lg-6">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-safetysecurity" aria-expanded="false" aria-controls="collapse-safetysecurity">Safety and security</button>
                    </h2>
                    <div id="collapse-safetysecurity" class="accordion-collapse collapse" aria-labelledby="heading-safetysecurity" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-general-services" aria-expanded="false" aria-controls="collapse-general-services">General services</button>
                    </h2>
                    <div id="collapse-general-services" class="accordion-collapse collapse" aria-labelledby="heading-general-services" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            </div>
            <!-- col End -->

        </div>
    </div>

    </div>

    <div class="room-detail-review">
        <div class="container">
            <div class="room-detail-title">Verified Ratings & Reviews for HOTEL THE TRADE Fair</div>
            <p class="review-intro">Take a look at verified ratings & reviews posted by guests</p>

            <ul class="makeFlex">
                <li class="value-list">
                    <div class="makeFlex-column">
                        <span class="box-title">FOOD</span>
                        <a class="text-primary">2 Reviews</a>
                    </div>
                </li>

                <li class="value-list">
                    <div class="makeFlex-column">
                        <span class="box-title">HOSPITALITY</span>
                        <a class="text-primary">1 Reviews</a>
                    </div>
                </li>

                <li class="value-list">
                    <div class="makeFlex-column">
                        <span class="box-title">SAFETY AND HYGIENE</span>
                        <a class="text-primary">1 Reviews</a>
                    </div>
                </li>
            </ul>

            <ul class="whatgstLv__content--features mb-5">
                <li>
                    <i class="fa fa-thumbs-up"></i>
                    <span class="font14">Excellent in all services</span>
                </li>
                <li>
                    <i class="fa fa-thumbs-up"></i>
                    <span class="font14">Decent safety precautions</span>
                </li>
                <li>
                    <i class="fa fa-thumbs-up"></i>
                    <span class="font14">Excellent in all services</span>
                </li>
            </ul>

            <div class="overall-rating-div">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="overall-rating-left">
                            <div class="overall-rating-inner-title">Overall Rating</div>
                            <big>4.9</big>
                            <div class="overall-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9">
                        <div class="overall-rating-right">
                            <div class="row">

                                <!-- Col Start -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="progress-list">
                                        <div class="progress-title">FOOD</div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col End -->

                                <!-- Col Start -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="progress-list">
                                        <div class="progress-title">HOSPITALITY </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col End -->

                                <!-- Col Start -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="progress-list">
                                        <div class="progress-title">SAFETY AND HYGIENE</div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col End -->

                                <!-- Col Start -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="progress-list">
                                        <div class="progress-title">NIGHTLIFE </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col End -->

                                <!-- Col Start -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="progress-list">
                                        <div class="progress-title">MARKET </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col End -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="d-flex align-items-start flex-tabs">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-all-reviews-tab" data-bs-toggle="pill" data-bs-target="#v-pills-all-reviews" type="button" role="tab" aria-controls="v-pills-all-reviews" aria-selected="true">All Reviews</button>

                    <button class="nav-link" id="v-pills-luxury-tab" data-bs-toggle="pill" data-bs-target="#v-pills-luxury" type="button" role="tab" aria-controls="v-pills-luxury" aria-selected="false">Luxury</button>

                    <button class="nav-link" id="v-pills-location-tab" data-bs-toggle="pill" data-bs-target="#v-pills-location" type="button" role="tab" aria-controls="v-pills-location" aria-selected="false">Location</button>

                    <button class="nav-link" id="v-pills-connectivity-tab" data-bs-toggle="pill" data-bs-target="#v-pills-connectivity" type="button" role="tab" aria-controls="v-pills-connectivity" aria-selected="false">Connectivity</button>

                    <button class="nav-link" id="v-pills-market-tab" data-bs-toggle="pill" data-bs-target="#v-pills-market" type="button" role="tab" aria-controls="v-pills-market" aria-selected="false">Market</button>

                    <button class="nav-link" id="v-pills-nightlife-tab" data-bs-toggle="pill" data-bs-target="#v-pills-nightlife" type="button" role="tab" aria-controls="v-pills-nightlife" aria-selected="false">Nightlife</button>

                    <button class="nav-link" id="v-pills-safety-hygiene-tab" data-bs-toggle="pill" data-bs-target="#v-pills-safety-hygiene" type="button" role="tab" aria-controls="v-pills-safety-hygiene" aria-selected="false">Safety And Hygiene</button>

                    <button class="nav-link" id="v-pills-hospitality-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hospitality" type="button" role="tab" aria-controls="v-pills-hospitality" aria-selected="false">Hospitality</button>

                    <button class="nav-link" id="v-pills-food-tab" data-bs-toggle="pill" data-bs-target="#v-pills-food" type="button" role="tab" aria-controls="v-pills-food" aria-selected="false">Food</button>
                </div>

                <div class="tab-content" id="v-pills-tabContent">

                    <div class="review-tabs-title-div">
                        <div class="review-tabs-title">Top Reviews</div>
                        <div class="sort-by-box">
                            <div class="row g-0">
                                <div class="col-auto">
                                    <label class="col-form-label">Sort By</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-select sorting-firsts">
                                        <option value="latest">Latest first</option>
                                        <option value="helpful">Helpful first</option>
                                        <option value="positive">Positive first</option>
                                        <option value="negative">Negative first</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="v-pills-all-reviews" role="tabpanel" aria-labelledby="v-pills-all-reviews-tab">

                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->

                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->

                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->

                    </div>

                    <div class="tab-pane fade" id="v-pills-luxury" role="tabpanel" aria-labelledby="v-pills-luxury-tab">
                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay luxury</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->
                    </div>

                    <div class="tab-pane fade" id="v-pills-location" role="tabpanel" aria-labelledby="v-pills-location-tab">
                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay location</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->
                    </div>

                    <div class="tab-pane fade" id="v-pills-connectivity" role="tabpanel" aria-labelledby="v-pills-connectivity-tab">
                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay connectivity</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->
                    </div>

                    <div class="tab-pane fade" id="v-pills-market" role="tabpanel" aria-labelledby="v-pills-market-tab">
                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay market</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->
                    </div>

                    <div class="tab-pane fade" id="v-pills-nightlife" role="tabpanel" aria-labelledby="v-pills-nightlife-tab">
                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay nightlife</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->
                    </div>

                    <div class="tab-pane fade" id="v-pills-safety-hygiene" role="tabpanel" aria-labelledby="v-pills-safety-hygiene-tab">
                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay safety-hygiene</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->
                    </div>

                    <div class="tab-pane fade" id="v-pills-hospitality" role="tabpanel" aria-labelledby="v-pills-hospitality-tab">
                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay hospitality</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->
                    </div>

                    <div class="tab-pane fade" id="v-pills-food" role="tabpanel" aria-labelledby="v-pills-food-tab">
                        <!-- Review List Start -->
                        <div class="review-list">
                            <div class="review-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="review-list-title">Amazing Stay food</div>
                            <div class="review-list-date">Sachin Sachdeva - Nov 20, 2021</div>
                            <p>Awesome place to stay with value for money. Food and facilities were good. With cooperative staff. Location of the hotel is fine and is easily connected to other places.</p>
                        </div>
                        <!-- Review List End -->
                    </div>
                </div>
            </div>

        </div>

    </div>
    </section>
    <!-- Rooms Page Section End -->

</main>
@include('messages')

@include('layouts.footer')
<script type="text/javascript" src="{{asset('js/room-detail.js')}}"></script>
@endsection