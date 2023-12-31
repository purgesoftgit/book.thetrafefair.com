@extends('layouts.layout')
@section('content')
@include('header')

<main class="main-div">
    <div class="container">
        <div class="back-btn">
            <a href="{{ url('/') }}" class="btn btn-dark"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
        @if(!empty($temp_user_info))
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fs-5">THE TRADE FAIR - RESORT AND SPA</h5>
                        <div class="card-info">
                            <p class="fs-6">
                                {{ (!empty($address)) ? $address->value : ''}}
                            </p>
                        </div>
                    </div>
                </div>
                </br>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fs-5">Your Booking Details</h5>
                        <div class="card-info">
                            <div class="row ">
                                <div class="col-md-6">
                                    Check-in </br> <small class="checkin-date" data-checkindate="{{$temp_user_info->checkin}}">{{ date('d M Y',strtotime($temp_user_info->checkin)) }}</small></br>
                                    <small>From 12:00 PM</small>
                                </div>
                                <div class="col-md-6">
                                    Check-out </br> <small class="checkout-date" data-checkoutdate="{{$temp_user_info->checkout}}">{{ date('d M Y',strtotime($temp_user_info->checkout )) }}</small></br>
                                    <small>To 11:00 AM</small>
                                </div>
                            </div>
                            <hr>
                            <small>Total length of stay :
                                @php
                                // Calculating the difference in timestamps
                                $diff = strtotime($temp_user_info->checkin) - strtotime($temp_user_info->checkout);
                                $total_days = abs(round($diff / 86400));
                                echo $total_days;
                                @endphp
                                night</small>
                            <hr>
                            <small>You Selected : </small></br>

                            <span class="room d-none">{{ $temp_user_info->room }}</span>
                            <span class="guest d-none">{{ $temp_user_info->guest }}</span>
                            <span class="per_room_childrens_allowed" style="display:none;">@if($per_room_childrens_allowed) {{$per_room_childrens_allowed->value}} @else 0 @endif</span>

                            <small>{{ $temp_user_info->room }} Room for {{ $temp_user_info->guest }} Adults</small>
                        </div>

                        <a href="{{ url('/') }}" class="text-primary text-decoration-none">Change Your Selection</a>
                    </div>
                </div>

                <br>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fs-5">Your Price Summary</h5>
                        <div class="card-info">
                            <div class="row">
                                <small class="fs-6 text-success">1 Day Price : ₹{{ $temp_user_info->price }}</small>
                                <div class="col-md-6">Price</div>
                                <div class="col-md-6 text-end roomamount" data-amount="{{$temp_user_info->price}}">
                                    ₹{{ $temp_user_info->price * $temp_user_info->room * $total_days}}</br>
                                </div>
                            </div>
                            <p class="text-end fs-6">+₹{{ ($temp_user_info->price * $temp_user_info->room * $total_days) * env('DEFAULT_ROOM_TAX_RATE') /100 }} taxes({{env('DEFAULT_ROOM_TAX_RATE')}}%) and charges</p>

                        </div>
                    </div>
                </div>

                <br>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fs-5">How much it will cost to cancel?</h5>
                        <div class="card-info">
                            <p class="text-success fs-6">Free cancellation before 12 hours of Booking</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
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

                <form action="<?php echo $action; ?>" id="validateUserInfo" class="form-validate" method="POST">
                    <input type="hidden" name="appId" value="<?php echo $merchant_key; ?>" />
                    <input type="hidden" name="orderId" value="" id="orderId" />
                    <input type="hidden" name="orderAmount" id="payuprice" value="" />
                    <input type="hidden" name="orderCurrency" class="orderCurrency" value="INR" />
                    <input type="hidden" name="orderNote" value="" />
                    <input type="hidden" name="customerName" class="customerName" value="" />
                    <input type="hidden" name="customerEmail" class="customerEmail" value="" />
                    <input type="hidden" name="customerPhone" class="customerPhone" value="" />
                    <input type="hidden" name="merchantData" id="merchantData" value="" />
                    <input type="hidden" name="returnUrl" value="<?php echo env('APP_URL'); ?>room-checkout-payment" />
                    <input type="hidden" name="notifyUrl" value="" />
                    <input type="hidden" name="signature" id="signature" value="" />
                    <input type="hidden" name="room_id" class="room_id" value="{{$temp_user_info->room_id ?? ''}}">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fs-5">Your Details</h5>
                            <div class="almost-done pl-2"> Almost done! Just fill in the <span class="text-danger">*</span> information</p>
                            </div>
                            <div class="card-info">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control first_name validate[required]" type="text" placeholder="Enter First Name" name="first_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control last_name validate[required]" type="text" placeholder="Enter Last Name" name="last_name">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Email Address<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control email validate[required, custom[email]]" id="exampleFormControlInput1" name="email" placeholder="name@example.com">
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <label class="form-label">Phone Number</label><sup class="mandatory-fields">*</sup>
                                        <input type="hidden" name="randomstr" id="randomstr">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><img src="{{asset('img/india-flag.png')}}" alt="India Flag Image">&nbsp; +91</span>
                                            <input type="text" class="form-control phone phone-num validate[required,maxSize[10],minSize[10]]" id="checkout-phone" name="phone" maxlength="10" minlength="10" placeholder="Phone" value="{{ (Auth::check() && Auth::user()->role_id == 0) ? preg_replace('/^\+?91|\|1|\D/', '', (Auth::user()->phone_number)) : '' }}">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                                        <!-- <input type="email" class="form-control" id="country"> -->
                                        <select name="country validate[required]" id="country" class="form-control country">
                                            @if(!empty($country))
                                            @foreach($country as $value)
                                            <option value="{{$value->id}}" {{ ($value->sortname == 'IN') ? 'selected' :'' }}>{{ $value->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" style="font-size: 12px;color: #555555;">Children</label>
                                        <input type="text" class="form-control children" name="children" value="0" maxlength="10" minlength="10">

                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="country" class="form-label">Floor preference</label>
                                        <select name="preference" class="form-control preference" id="preference">
                                            <option value="0">No Preference</option>
                                            <option value="1">High Preference</option>
                                            <option value="2">Ground Preference</option>
                                        </select>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title fs-5">Your arrival time</h5>
                            <div class="card-info">
                                <ul>
                                    <li>Your room will be ready for check-in between 12:00 PM and 11:00 AM</li>
                                    <li>24-hour front desk – Help whenever you need it!</li>
                                </ul>
                                <label>Add your estimated arrival time (optional)</label>
                                <input type="time" class="form-control arrival_time" name="arrival_time">

                            </div>
                        </div>
                    </div>

                    <div class="final_detail_action mt-4 text-end">
                        <button class="btn btn-primary final-details" type="button">Final Details <i class="fa fa-chevron-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @else

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Your Cart is empty</h5>

            </div>
        </div>
        @endif

    </div>
</main>
<script>
    $(document).ready(function() {
        $('#validateUserInfo').validationEngine({
            autoHidePrompt: true,
            autoHideDelay: 8000,
            scroll: false
        });

        //final button click script
        $('.final-details').click(function() {
            var isValidate = $('#validateUserInfo').validationEngine('validate')

            $('.customerName').val($('.first_name').val() + ' ' + $('.last_name').val())
            $('.customerEmail').val($('.email').val())
            $('.customerPhone').val($('.phone').val())

            var checkin = $('.checkin-date').data('checkindate');
            var checkout = $('.checkout-date').data('checkoutdate');
            var room = $('.room').text();
            var guest = $('.guest').text();
            var room_id = "{{ $temp_user_info->room_id ?? ''}}";
            var customerName = $('.customerName').val()
            var customerEmail = $('.customerEmail').val()
            var customerPhone = $('.customerPhone').val()
            var country = $('.country').val()
            var preference = $('.preference').val()
            var arrival_time = $('.arrival_time').val()
            var children = $('.children').val()

            const date1 = new Date(checkin);
            const date2 = new Date(checkout);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (isValidate == true) {
                $.ajax({
                    url: "{{ url('submit-book-now') }}",
                    type: "POST",
                    data: {
                        checkin: checkin,
                        checkout: checkout,
                        room_id: room_id,
                        room: room,
                        guest: guest,
                        name: customerName,
                        email: customerEmail,
                        phone: customerPhone,
                        country: country,
                        preference: preference,
                        arrival_time: arrival_time,
                        children: children,
                    },
                    success: function(response) {

                        if (response.status == "available") {
                            let total_amount = guest + (diffDays * parseInt($('.roomamount').data('amount')) * parseInt(room));

                            let totalAmount = total_amount
                            let children = $('.children').val()
                            let email = $('#checkout-email').val()
                            let phone = $('#checkout-phone').val()
                            $('#payuprice').val(totalAmount);

                            // var room_image = '<?php //echo $room_image; ?>';

                           // temporary checkout ajax
                            $.ajax({
                                url: "{{ url('save-room-temp-checkouts') }}",
                                type: "POST",
                                data: {
                                    customerName: customerName,
                                    customerEmail: customerEmail,
                                    customerPhone: customerPhone,
                                    totalAmount: totalAmount,
                                    room_id: room_id,
                                    checkin: checkin,
                                    checkout: checkout,
                                    room: room,
                                    guest: guest,
                                    children: children,
                                    diffDays: diffDays,
                                },
                                success: function(response) {
                                    orderid = "<?php //echo time(); 
                                                ?>" + response.last_inserted_id;
                                    $('#orderId').val(orderid);

                                    window.location.href = "{{url('room-cart')}}/" + btoa(orderid);
                                }
                            })

                        } else if (response.status == "un-available") {
                            swapPopPupMessage('Room Not available with this details.', 'error');
                        } else if (response.status == "validation-issue") {
                            swapPopPupMessage('Please fill all fields.', 'error');
                        } else if (response.status == "incorrect-date") {
                            swapPopPupMessage('You have enter wrong Date.', 'error');
                        } else if (response.status == "invalid-room-guest") {
                            swapPopPupMessage('You have entered wrong data for guest or room.', 'error');
                        } else if (response.status == "invalid-children") {
                            swapPopPupMessage('Childrens is reached the limitation of allowed Childrens for Room.', 'error');
                        } else {}
                    }
                });
            }
        });
    })

    function swapPopPupMessage(message, type) {
        Swal.fire({
            title: "",
            text: message,
            icon: type
        });
    }
</script>
@endsection