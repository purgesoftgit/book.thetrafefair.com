@extends('layouts.dashboard-layout')
@section('content')

<div class="page-wrapper chiller-theme toggled">
<a id="show-sidebar" href="#"><i class="fas fa-bars"></i></a>
<!--Navbar Start-->
@include('dashboard.navbar')
<!--EndNavbar Start-->

<!-- sidebar-wrapper  -->
<main class="page-content">
    
  <!-- top bar -->
 @include('dashboard.header')
  <div class="midsection">
    <div class="container-fluid">
    <div class="row ">
     <!-- <div class="col-md-2 col-lg-2">&nbsp;</div> -->
     <div class="col-lg-12 col-xl-12">          
        <div class="whbox formbox">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
              <li class="breadcrumb-item">/</li>
              <li class="breadcrumb-item">
                 @if(isset($rastro_order_history))
                    <a href="{{url('rastaurant-order-history')}}">Restaurant Order History</a>
                 @else
                    <a href="{{url('room-order-history')}}">Room Order History</a>
                 @endif

              </li>
              <li class="breadcrumb-item">/</li>
              <li class="breadcrumb-item active" aria-current="page">View Order History</li>
            </ol>
          </nav>
          <div class="clearfix"><hr/></div>

          <div class="row">
            <div class="col-md-8 col-sm-7">  <h3>@if(isset($rastro_order_history)) Restaurant @else Room @endif Order History</h3> </div>
            <div class="col-md-4 col-sm-5 add-blogpost-right">
                 @if($rastro_order_history->status == 'D')
                    <a href="{{ url('downloadReceipt',$rastro_order_history->txnid) }}" class="btn btn-primary success-btn">Download Receipt</a>
                 @endif
                 <button class="btn btn-dark" onclick="history.back();"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
          </div>


          <div class="clearfix">&nbsp;</div>

          <ul style="line-height: 2.5;">

          
          @if(isset($rastro_order_history))
          <?php
            $status_arr = array('P'=>'Pending','C'=>'Cancelled','D'=>'Delievered','R'=>'Ready','A'=>'Approved','PU'=>'PickedUp');
            if(!empty($rastro_order_history)){
              $checkoutdata = json_decode($rastro_order_history['checkout_form_data'], true);
          ?>

          <div style="max-width:800px; margin:30px auto 0; font-family: 'Raleway', sans-serif;" class="order-invoice restaurant-receipt-table">
            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
              <tr>
                <td style="">
                  <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                    <tr>
                      <td valign="top" style="text-align: center; padding-bottom:12px;">
                        <h1 style="text-transform: uppercase; font-size:20px; font-weight:700; margin:0;">
                          <img src="{{ asset('img/chef.png')}}" alt="Img" style="height:25px; padding-right:6px; display:inline-block; vertical-align:middle;">
                          Restaurant Receipt
                          <img src="{{ asset('img/chef.png')}}" alt="Img" style="height:25px; padding-left:6px; display:inline-block; vertical-align:middle;">
                        </h1>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
              <td style="background: #fffcf1; padding:10px 15px;">
                <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Order ID:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php echo strtoupper($rastro_order_history->txnid); ?></td>
                  </tr>
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Order Number:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php echo 'ORDER-'.$rastro_order_history->id; ?></td>
                  </tr>
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Status:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php echo !empty($rastro_order_history->status) ? $status_arr[$rastro_order_history->status] : '----'; ?></td>
                  </tr>
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Date:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php echo !empty($rastro_order_history->created_at) ? date('d/m/Y, h:i A', strtotime($rastro_order_history->created_at)) : '----'; ?></td>
                  </tr>
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Customer Name:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php if($rastro_order_history->user) {echo $rastro_order_history->user['first_name'].' '. $rastro_order_history->user['last_name']; }else{ echo '----'; }?></td>
                  </tr>
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Email:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php if($rastro_order_history->user) { echo $rastro_order_history->user['email'];}else{ echo "----";} ?></td>
                  </tr>
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Phone:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php if($rastro_order_history->user) { echo $rastro_order_history->user['phone_number'];}else{ echo "----";} ?></td>
                  </tr>
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Delivery Mode:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php echo isset($checkoutdata['delivery_mode']) ? $checkoutdata['delivery_mode'] : '----'; ?></td>
                  </tr>


                   
                       
                  <?php 
                    if(isset($checkoutdata['delivery_mode']) && $checkoutdata['delivery_mode'] == 'In House Order'){
                     
                 ?>                 
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Room No.:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php echo $checkoutdata['delivery_mode_room_no'] ?></td>

                  </tr>

                 <?php }else{ ?>

                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Delivery Address.:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php echo !empty($deliver_address) ? $deliver_address['address'] : ''; ?></td>
 
                  </tr>
                
                <?php } ?>
 
 
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size:13px; color: #222; font-weight:600; font-family: 'Raleway', sans-serif; margin:0;">Addon Instruction:</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"><?php echo !empty($checkoutdata['addon_instructions']) ? $checkoutdata['addon_instructions'] : '----'; ?></td>
                  </tr>
                  <tr>
                    <td height="10"></td>
                    <td></td>
                  </tr>
                  <?php 
                    foreach($checkoutdata['item'] as $key => $value){
                  ?>   
                  <tr>             
                    <td valign="top" style="width:70%; background:#f5efd8; padding:5px 8px; border-bottom:1px solid #fffcf1;">
                      <h5 style="font-size: 13px; color: #222; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;"> <?php echo $value['quantity']; ?> x <?php echo $value['price']; ?> <img src="{{ env('APP_URL') }}public/img/item-icon.png">  <?php echo $value['name']; ?></h5>
                    </td>

                    <td valign="top" style="width:30%; text-align: right; font-size:13px; line-height:14px; background:#f5efd8; padding:5px 8px; border-bottom:1px solid #fffcf1;">
                      &#8377;<?php echo number_format((float)$value['final_price'], 2, '.', ''); ?>
                    </td>
                  </tr>
                  <?php } ?> 
                  
                  <tr>
                    <td valign="top" height="5" style="width:70%; padding:5px 0;"></td>
                    <td valign="top" height="5" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                  </tr>
                  
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size: 13px; color: #222; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;">Sub Total:</h5>
                    </td>

                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;">
                      &#8377;<?php echo number_format((float)$checkoutdata['subtotal_amt'], 2, '.', ''); ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size: 13px; color: #222; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;">Taxes:</h5>
                    </td>

                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;">
                      &#8377;<?php echo number_format((float)$checkoutdata['subtotal_taxes'], 2, '.', ''); ?>
                    </td>
                  </tr>
                  
                  <!-- <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size: 13px; color: #222; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;">Donation:</h5>
                    </td>

                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;">
                      &#8377;<?php //echo number_format((float)$checkoutdata['subtotal_donate'], 2, '.', ''); ?>
                    </td>
                  </tr> -->
                  
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size: 13px; color: #222; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;">Support Rider:</h5>
                    </td>

                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;">
                      &#8377;<?php echo number_format((float)$checkoutdata['subtotal_rider'], 2, '.', ''); ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td valign="top" height="5" style="width:70%; padding:5px 0;"></td>
                    <td valign="top" height="5" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                  </tr>
                  
                  <tr>
                    <td valign="top" style="width:70%; padding:10px; background:#222; ">
                      <h5 style="font-size:16px; line-height:16px; color: #fff; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;">Total :</h5>
                    </td>

                    <td valign="top" style="width:30%; padding:10px;  background:#222; color:#fff; font-weight: 700; text-align: right; font-size:16px; line-height:14px;">
                      &#8377;<?php echo number_format((float)($checkoutdata['net_total_amt'] + $checkoutdata['subtotal_rider']), 2, '.', ''); ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td valign="top" height="5" style="width:70%; padding:5px 0;"></td>
                    <td valign="top" height="5" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;"></td>
                  </tr>
                  
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size: 13px; color: #222; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;">Trade International Credit :</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;">- <?php echo number_format((float)$checkoutdata['subtotal_tti_credit'], 2, '.', ''); ?> P</td>
                  </tr>
                  
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size: 13px; color: #222; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;">Reward Points :</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;">- <?php echo number_format((float)$checkoutdata['subtotal_tti_rewardpoint'], 2, '.', ''); ?> P</td>
                  </tr>
                  
                  <tr>
                    <td valign="top" style="width:70%; padding:5px 0;">
                      <h5 style="font-size: 13px; color: #222; font-weight: 700; font-family: 'Raleway', sans-serif; margin:0;">Promocode :</h5>
                    </td>
                    <td valign="top" style="width:30%; padding:5px 0; text-align: right; font-size:13px; line-height:14px;">
                      -&#8377;<?php echo number_format((float)$checkoutdata['promocode_deduction'], 2, '.', ''); ?></td>
                  </tr>
                  
                  <tr>
                    <td valign="top" style="padding:15px 10px; width:70%;  background:#222;">
                      <strong style="text-transform: uppercase; font-size:16px; line-height:16px; color: #fff; font-weight: 700; display: block;">Payable Amount :</strong>
                    </td>

                    <td valign="top" style="padding:15px 10px;  background:#222; width:30%; text-align: right;">
                      <strong style="text-transform: uppercase; font-size:16px; line-height:16px; color: #fff; font-weight: 700; display: block;">
                        &#8377;<?php echo number_format((float)$rastro_order_history['amount'], 2, '.', ''); ?>
                      </strong>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          </div>
          <?php  } ?>
          @endif

          @if(isset($room_order_history))
            <?php $checkoutdata = json_decode($room_order_history['checkout_form_data'],true); ?>
            <li>
              <b>Name</b> : {{$checkoutdata['customerName']}}<br>
              <b>Email</b> : {{$checkoutdata['customerEmail']}}<br>
              <b>Phone</b> : +91{{$checkoutdata['customerPhone']}}
            </li>
            <li><b>Transaction ID</b> : {{ $room_order_history->txnid }}</li>
            <li><b>Order Number</b> : ORDER-{{ $room_order_history->id }}</li>
            <li>
              @foreach($checkoutdata['item'] as $key => $value)
                @if($key == 'room_category')
                  <strong>Room Category : </strong> {{ucfirst($value)}}<br>
                @endif
                
                @if($key == 'room_shift')
                  <strong>Room Shift : </strong>{{ucfirst($value)}}<br>
                @endif

                @if($key == 'per_shift_price')
                  <strong>Per Shift Price : </strong>&#8377;{{$value}}<br>
                @endif
                
                @if($key == 'room_title')
                  <strong>Room Title : </strong>{{ucfirst($value)}}<br>
                @endif
              @endforeach
                <strong>CheckIn : </strong>{{$checkoutdata['checkin']}}<br>
                <strong>CheckOut : </strong>{{$checkoutdata['checkout']}}
            </li>
            <li><b>Total Amount : </b>&#8377;{{$checkoutdata['totalAmount']}}</li>
            <li><b>Status : </b>@if($room_order_history->status == 'P') <span class="incomplete">Pending</span> @elseif($room_order_history->status == 'D') <span class="delivered">Approved</span> @else <span class="reject">Cancelled</span> @endif</li>
          @endif
          </ul>
        </div>
      </div>            
    </div>
  </div>
</div>
</main>
</div>
<style type="text/css">b{font-weight: 600;}</style>
@endsection
