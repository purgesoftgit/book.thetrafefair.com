@extends('layouts.layout')
@section('content')
@include('header')
<!-- Mid Section Start -->
<main class="web-main">

  <div class="confirm-page">
    <div class="container">

      <?php $checkout_form_data = !(empty($transaction_data)) ? json_decode($transaction_data->checkout_form_data, true) : array();

      $room_title = '';
      $total_room = '';
      $total_guest = '';
      $shift = '';
      $per_shift_price = '';
      $room_image = '';
      $room_category = '';

      foreach ($checkout_form_data['item'] as $key => $value) {
        if ($key == 'room_title')
          $room_title = $value;

        if ($key == 'per_shift_price')
          $per_shift_price = $value;

        if ($key == 'room')
          $total_room = $value;

        if ($key == 'guest')
          $total_guest = $value;

        if ($key == 'room_shift')
          $shift = $value;

        if ($key == 'room_image')
          $room_image = $value;

        if ($key == 'room_category')
          $room_category = $value;
      }
      ?>

      <!-- print div start-->

      <div class="thanks-box">
        <!-- <img src="{{asset('img/success-check.png')}}"> -->
        <h3>Your booking is confirmed at THE TRADE FAIR - RESORT AND SPA</h3>

        <ul class="list-unstyled">
          <li><i class="fa fa-check" aria-hidden="true"></i> You Booking Confirmation is in your Inbox!</li>
          <li><i class="fa fa-check" aria-hidden="true"></i> Your Payment will be handles by the property</li>
          <li><i class="fa fa-check" aria-hidden="true"></i> You can now cancel your booking untill check-in</li>
        </ul>


        <div class="text-center mt-5">

          <a href="{{url('downloadTicket',$transaction_data->txnid ?? '')}}/downl_invoice" class="btn btn-dark">Download Invoice</a>

          <?php
          if ($checkout_form_data['grand_total_amt'] > 0) {
          ?>
            <a href="javascript:void(0)" class="btn btn-primary cancel-reservation">Cancel Reservation</a>
          <?php } ?>
        </div>

      </div>


      <div class="you-booking-summary mt-5">
        <h4>Your Booking Summary</h4>
        <div class="row g-0 mt-4">
          <div class="col-md-5">
            <img src="{{ asset('img/room-photo.webp')}}" alt="" width="400" height="250">
          </div>
          <div class="col-md-7">
            <h4>THE TRADE FAIR - RESORT AND SPA</h4>
            <p><small class="checkin-date" data-checkindate="{{$checkout_form_data['checkin']}}">{{ date('d M Y',strtotime($checkout_form_data['checkin'])) }}</small>
              <small> From 12:00 PM</small> - <small class="checkout-date" data-checkoutdate="{{$checkout_form_data['checkin']}}">{{ date('d M Y',strtotime($checkout_form_data['checkout'] )) }}</small> To 11:00 AM
            </p>

            <p>Confirmation Number : <span class="badge text-bg-success">{{$transaction_data->txnid ?? ''}}</span></p>
            <p>PIN Number : <span class="badge text-bg-success">{{$transaction_data->pin_code ?? '4564'}}</span></p>

            <p>{{ $checkout_form_data['item']['room'] }} Room {{ $checkout_form_data['item']['guest'] }} Adults, {{$checkout_form_data['item']['children'] }} Child</p>
            <p>Advance Payable Amount: <i class="fa fa-rupee"></i>{{ $checkout_form_data['f_total_amt'] }} </p>

            <hr>
            <div class="text-end">
              <a class="view-invoice btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">View Invoice</a>
            </div>
          </div>


        </div>


      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Invoice Summary</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="viewinvoicePDF"></div>
        </div>
      </div>
    </div>
  </div>


</main>
<!-- Mid Section End -->
@include('messages')
<!-- footer section -->
<style>
  .final_amount {
    font-size: 18px !important;
  }
</style>

<script type="text/javascript">
  $(document).ready(function() {
    localStorage.removeItem("food_type");

    $('.view-invoice').click(function() {
      $.ajax({
        url: "{{url('downloadTicket',$transaction_data->txnid ?? '')}}/view_invoice",
        type: "get",
        success: function(response) {

          $('.viewinvoicePDF').html(response)
          $('#staticBackdrop').modal('show');

        }
      });
    });

    $('.cancel-reservation').click(function() {
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to cancel Room Reservation!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Decline',
        confirmButtonText: 'Cancel Reservation'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "{{ url('cancelReservation') }}",
            type: "POST",
            data: {
              txnid: "{{$transaction_data->txnid ?? ''}}"
            },
            success: function(response) {
              const obj = JSON.parse(response)
              if (obj.status == "success") {
                $('#success-popups .successmessage').text(obj.message + ' Please Wait a minute.');
                $('#success-popups').modal('show');

                setTimeout(() => {
                  window.location = "{{ url('/') }}";
                }, 5000);
              }

              if (obj.status == "error") {
                $('#unsuccess-popups .errormessage').text(obj.message);
                $('#unsuccess-popups').modal('show');
              }

            }
          })



        }
      })

    });


  })
</script>

<!-- footer section -->
@endsection