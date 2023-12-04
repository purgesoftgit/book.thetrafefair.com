@extends('layouts.layout')
@section('content')
@include('header')

<main class="main-div">
    <div class="container">
     
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
                                    Check-in </br> <small class="checkin-date" data-checkindate="{{$form_data['checkin']}}">{{ date('d M Y',strtotime($form_data['checkin'])) }}</small></br>
                                    <small>From 12:00 PM</small>
                                </div>
                                <div class="col-md-6">
                                    Check-out </br> <small class="checkout-date" data-checkoutdate="{{$form_data['checkin']}}">{{ date('d M Y',strtotime($form_data['checkout'] )) }}</small></br>
                                    <small>To 11:00 AM</small>
                                </div>
                            </div>
                            <hr>
                            <small>Total length of stay :
                                @php
                                // Calculating the difference in timestamps
                                $diff = strtotime($form_data['checkin']) - strtotime($form_data['checkout']);
                                $total_days = abs(round($diff / 86400));
                                echo $total_days;
                                @endphp
                                night</small>
                            <hr>
                            <small>You Selected : </small></br>

                            <small class="text-success fs-6 fw-bold">{{ucwords(str_replace('_', ' ',$form_data['item']['room_category']))}} Room</small><br>

                            <span class="room d-none">{{ $form_data['item']['room'] }}</span>
                            <span class="guest d-none">{{ $form_data['item']['guest'] }}</span>
                            <span class="per_room_childrens_allowed" style="display:none;">@if($per_room_childrens_allowed) {{$per_room_childrens_allowed->value}} @else 0 @endif</span>

                            <small>{{ $form_data['item']['room'] }} Room for {{ $form_data['item']['guest'] }} Adults, {{ $form_data['item']['children']}} Child</small>

                            <hr>
                            <span>Country : {{ $form_data['item']['country']}}</span></br>
                            @if($form_data['item']['arrival_time'] != 0)<span>Arrival Time : {{ $form_data['item']['arrival_time']}}</span></br>@endif
                            <span>preference : {{ ($form_data['item']['preference'] == 1) ? 'High Preference' : (($form_data['item']['preference'] == 2) ? 'Ground Preference' : 'No Preference')}}</span>
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
                                <small class="fs-6 text-success">1 Day Price : ₹{{ $form_data['item']['per_shift_price'] }}</small>
                                <div class="col-md-6">Price</div>
                                <div class="col-md-6 text-end roomamount" data-amount="{{$form_data['item']['per_shift_price']}}">
                                    ₹{{ $form_data['item']['per_shift_price'] * $form_data['item']['room'] * $total_days}}</br>
                                </div>
                            </div>
                            <p class="text-end fs-6">+₹{{ ($form_data['item']['per_shift_price'] * $form_data['item']['room'] * $total_days) * env('DEFAULT_ROOM_TAX_RATE') /100 }} taxes({{env('DEFAULT_ROOM_TAX_RATE')}}%) and charges</p>

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

                <div class="clearfix"> &nbsp;</div>

                <div class="card">
                    <div class="card-body">
                        <div class="select-payment-method">
                            <h4>Payment Method</h4>
                            <div class="clearfix"> &nbsp;</div>
                            <!-- <p>Select delivery address to select payment methods</p> -->
                            <span class="my-10"><img src="{{asset('img/cashfree.png')}}"></span><br>
                            <sub class="my-5"><strong><i>(All types of cards, Net Banking, UPI's are accepted)</i></strong></sub>
                            <br>
 

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

                <form name="checkout_form" id="checkout_form" action="<?php echo $action; ?>" method="post">
                    <input type="hidden" name="appId" value="<?php echo $merchant_key; ?>" />
                    <input type="hidden" name="orderId" value="" id="orderId" />
                    <input type="hidden" name="orderAmount" id="payuprice" value="" />
                    <input type="hidden" name="orderCurrency" class="orderCurrency" value="INR" />
                    <input type="hidden" name="orderNote" value="" />
                    <input type="hidden" name="customerName" class="customerName" value="{{ $form_data['customerName'] ?? ''}}" />
                    <input type="hidden" name="customerEmail" class="customerEmail" value="{{ $form_data['customerEmail'] ?? '' }}" />
                    <input type="hidden" name="customerPhone" class="customerPhone" value="{{  preg_replace('/^\+?91|\|1|\D/', '', ($form_data['customerPhone']))  }}" />
                    <input type="hidden" name="merchantData" id="merchantData" value="" />
                    <input type="hidden" name="returnUrl" value="<?php echo env('APP_URL'); ?>room-checkout-payment" />
                    <input type="hidden" name="notifyUrl" value="" />
                    <input type="hidden" name="signature" id="signature" value="" />
                    <input type="hidden" name="roomcat" class="room_category" value="<?php echo $form_data['item']['room_category']; ?>">
                    <input type="hidden" name="roomid" class="room_id" value="<?php echo $form_data['item']['room_id']; ?>">


                    <!-- additional changea -->
                    <span class="checkout-checkin-date" style="display:none;"><?php echo $form_data['checkin']; ?></span>
                    <span class="checkout-checkout-date" style="display:none;"><?php echo $form_data['checkout']; ?></span>
                    <span class="checkout-per_shift_price" style="display:none;"><?php echo $form_data['item']['per_shift_price']; ?></span>
                    <!-- additional changea -->


                    <h2 class="inner-title fontsize-32 text-primary text-decoration-none">Your Payment Details</h2>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <!-- Login Profile Section Start -->
                            <div class="login-profile-sec">
                                <h3>{{ $form_data['customerName'] }} <small>({{ $form_data['customerEmail'] }})</small></h3>
                            </div>
                            <!-- Login Profile Section End -->

                            <span id="settingdata" data-taxrate="<?php echo env('DEFAULT_ROOM_TAX_RATE'); ?>" data-txnidval="<?php echo $txnid; ?>" data-apcodeurl="{{ url('apply-promo-code') }}" data-removecart="{{ url('remove-cart-item') }}" data-tempcheckout="{{ url('update-room-temp-checkouts') }}" data-hashcheckout="{{url('get-sha256')}}" data-zerocheckout="{{url('zero-checkout-room-payment')}}" data-ordertimedata="<?php echo time(); ?>" data-orderid="{{ $order_id }}" data-customerName="{{ $form_data['customerName'] ?? '' }}" data-customerEmail="{{ $form_data['customerEmail'] ?? '' }}" data-customerPhone="{{ preg_replace('/^\+?91|\|1|\D/', '', ($form_data['customerPhone'])) }}" data-generatehashroom="{{ url('generate-room-signature') }}" data-roomcat="<?php echo $form_data['item']['room_category']; ?>" data-roomid="<?php echo $form_data['item']['room_id']; ?>" data-roomprice="<?php echo ((float)$form_data['totalAmount'] -  (float)$form_data['item']['guest']); ?>" data-deductionUrl="{{ url('deduct-room-price') }}" data-noofrooms="{{ $no_of_rooms ?? '' }}" data-perroomperson="{{ $per_room_person->value ?? '' }}" data-perroomprice="{{ $per_room_price ?? '' }}" data-perroomchildallow="{{ $per_room_childrens_allowed->value ?? ''}}"></span>

                            <div class="clearfix"> &nbsp;</div>

                            
                            <!-- Summary Box Start -->
                            <div class="summary-box card p-3">
                                <!-- Offers Box Start -->

                                <div class="order-inner-box offers-inner-box">
                                    <div class="row">
                                        <div class="col-sm-8 same-8">
                                            <h5>Offers</h5>
                                            <h6>Select a promo code</h6>
                                        </div>
                                        <div class="col-sm-4 same-4">
                                            <div class="text-end">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#promocodeModal" class="view-offers">View offers</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col" id="promosuccmsg"></div>
                                    </div>
                                </div>

                                <!-- Offers Box Start -->
                                <hr>
                                <!-- Sub Total Summery Start -->
                                <div class="order-inner-box offers-inner-box1">
                                    <div class="row">
                                        <div class="col-sm-6 same-6">
                                            <h5> Payment Options</h5>
                                            <!-- <h6>Select Options</h6> -->
                                        </div>
                                        
                                        <div class="col-sm-6 same-6">
                                            <div class="text-end">
                                                <select name="payment_options" id="payment_options" class="form-control">

                                                    <option value="100">Pay at Service (100%)</option>
                                                    <option value="10">Pay at Hotel (min: 10% required)</option>
                                                    <option value="25">Partial Booking (min: 25% required)</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="sub-total-box">
                                    <dl>
                                        <dt>Room Total Price</dt>

                                        <input type="hidden" class="calculate_grand_total_amount" name="subtotal_amt" id="subtotal_amt" value="<?php echo ((float)$form_data['totalAmount'] - ((float)$form_data['item']['guest'])); ?>">

                                        <input type="hidden" class="calculate_grand_total_amount" name="subtotal_taxes" id="subtotal_taxes" value="0">

                                        <input type="hidden" class="net_total_amt" name="net_total_amt" id="net_total_amt" value="0">

                                        <input type="hidden" class="grand_total_amt" name="grand_total_amt" id="grand_total_amt" value="0">

                                        <input type="hidden" class="f_total_amt" name="f_total_amt" id="f_total_amt" value="0">

                                        <input type="hidden" class="promocode" name="promocode" id="promocode" value="">

                                        <input type="hidden" class="promocode_deduction" name="promocode_deduction" id="promocode_deduction" value="0">


                                        <dd id="subtotal"><i class="fa fa-rupee"></i>0.00</dd>
                                        <dt>Room Tax <small style="font-size: 12px;">(<?php echo env('DEFAULT_ROOM_TAX_RATE'); ?>% Tax)</small></dt>
                                        <dd id="total_taxes"><i class="fa fa-rupee"></i>0.00</dd>
                                       
                                        <dt style="border-top:1px solid #c0c0c0; margin-top:1rem"><strong>Total</strong></dt>
                                        <dd class="net_total" style="border-top:1px solid #c0c0c0; margin-top:1rem"><i class="fa fa-rupee"></i>0.00</dd>


                                        @if(array_key_exists('extra_charges',$form_data))
                                        <div class="additional_persons_charges">
                                            <dt style="border-top:1px solid #c0c0c0; margin-top:1rem">Additional Charges
                                                <div class="additional_amount_stmt"><small class="text-danger">(<?php if (array_key_exists('extra_charges', $form_data)) echo $form_data['extra_charges']; ?>)</small></div>
                                            </dt>
                                            <dd style="border-top:1px solid #c0c0c0; margin-top:1rem" class="additional_charges <?php if (array_key_exists('minus_peoples_amount', $form_data)) {
                                                                                                                                    echo "minus_amount";
                                                                                                                                } else {
                                                                                                                                    echo "additional_amount";
                                                                                                                                } ?>"><i class="fa fa-rupee"></i>
                                                <?php if (array_key_exists('minus_peoples_amount', $form_data)) {
                                                    echo $form_data['minus_peoples_amount'];
                                                } else {
                                                    echo $form_data['add_peoples_amount'];
                                                } ?>
                                            </dd>
                                        </div>
                                        @endif


                                        <dt style="border-top:1px solid #c0c0c0; margin-top:1rem">Promocode</dt>
                                        <dd style="border-top:1px solid #c0c0c0; margin-top:1rem" id="promocode_amt">-<i class="fa fa-rupee"></i>0.00</dd>

                                        <dt class="grand-totle">Payable Amount</dt>
                                        <dd class="grand-totle gr_total"><i class="fa fa-rupee"></i>0.00</dd>
                                    </dl>
                                    <!-- Sub Total Summery End -->
                                </div>
                                <!-- Summary Box Start -->
                                <div class="place-order-sec">
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-primary btn-sm" id="item_place_order">
                                            <div class="spinner-border text-dark d-none" id="item-loader"></div><span>Book Room</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>

    </div>
</main>

<div class="modal fade" id="promocodeModal" tabindex="-1" aria-labelledby="promocodeModalLabel" aria-modal="false" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apply Offers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" style="height: 44px;" onchange="gettypeofbooking($promocodes)" placeholder="Enter Promocode">
                        </div>
                        <div class="col">
                            <a href="javascript:void(0);" id="apply_code" class="btn btn-primary">Apply</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-danger" id="pcode-error"></div>
                    </div>

                </div>

                <div id="promocodedata">
                    <?php if ($promocodes != [] && !$promocodes->isEmpty()) {
                    ?>
                        <div class="table-responsive">
                            <table class="table tabl-responsive table-bordered table-striped" style="margin-top:11px">
                                <tr>
                                    <td style="background-color: #6c757d;font-weight:bold;color: #fff;" colspan="2">Available Offers </td>
                                </tr>
                                <?php foreach ($promocodes as $key => $value) {
                                    if (strcmp($form_data['item']['room_category'] . '_room', strtolower($value->category)) === 0) {
                                ?>
                                        <tr>
                                            <td class="promotd" style="border-top: solid 1px #000; padding-top: 15px;">
                                                <strong class="codetext ">{{$value->code}}</strong><br>
                                                <span class="promotext"><?php if ($value->type_of_discount == 'percentage') { ?>Get {{$value->discount}} % off <br /><br /> <?php } else { ?> Get Discount upto {{$value->discount}} Rs.<br /> <?php } ?> </span>
                                                <span><a href="javascript:void(0);" class="btn btn-outline-dark btn-sm coupon_apply" data-typeofDiscount="{{$value->type_of_discount}}" data-coupon="{{$value->code}}">Apply Coupon</a></span>
                                            </td>

                                            <td class="promotext promotd" style="border-top: solid 1px #000; padding-top: 15px;">
                                                @if($value->summary) <p>{{$value->summary}}</p> @else </br> @endif
                                                <span>
                                                    @if($value->type_of_discount == "net")
                                                    Use Code <b>{{$value->code}}</b> & get Flat Rs. {{$value->discount}} off
                                                    @else
                                                    Use Code <b>{{$value->code}}</b> & get {{$value->discount}}{{ ($value->type_of_discount == 'percentage') ? '%' : ' Rs.' }} off {{ ($value->min_order_value > 0) ? 'on order above Rs. '.$value->min_order_value : ''  }}. {{ ($value->type_of_discount == 'percentage') ? 'Maximum discount: '.$value->max_discount.' Rs.' : ' Rs.' }}
                                                    @endif
                                                </span>
                                                <br />
                                                <span>
                                                    <a href="javascript:void(0);" class="show_more showmore_{{ $value->id }}" data-id="{{ $value->id }}" style="color: #5f5940;font-weight: bold;"> More +</a>
                                                    <a href="javascript:void(0);" class="show_less showless_{{ $value->id }}" data-id="{{ $value->id }}" style="display:none;color: #5f5940;font-weight: bold;"> Less -</a>
                                                </span>

                                                <table class="table table-bordered moredata-{{ $value->id }}" style="display:none">
                                                    <tr>
                                                        <td class="promotext">
                                                            <?php
                                                            $validity_period = explode('-', $value->validity_period);
                                                            ?>
                                                            <ul>
                                                                <li>Offer valid from {{ date('d/m/Y', strtotime($validity_period[0])) }} to {{ date('d/m/Y', strtotime($validity_period[1])) }}</li>
                                                                <li>Coupon can be applied between {{ date('h:i A', strtotime(date('d-m-Y '.$value->from_time)))  }} and {{ date('h:i A', strtotime(date('d-m-Y '.$value->to_time)))  }}</li>
                                                                <li>Offer valid for {{ ($value->type_of_customer == 'new') ? 'first time users' : 'all users' }} </li>
                                                                <li>Other terms & conditions may apply</li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/roomcart.js')}}"></script>
@endsection