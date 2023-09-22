@extends('layouts.layout')
@section('content')
<!-- header section -->
@include('layouts.header')
<!-- Mid Section Start -->
<main class="web-main">

  <div class="confirm-page">
    <div class="container">

      <ul id="progressbar">
        <li class="active" id="step1">
          <strong>SELECT A ROOM</strong>
        </li>
        <li class="active" id="step2">
          <strong>PAY</strong>
        </li>
        <li class="active" id="step3">
          <strong>CONFIRM</strong>
        </li>
      </ul>

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
        <img src="{{asset('img/success-check.png')}}">
        <h3>Thanks {{$checkout_form_data['customerName'] ?? ''}}, your booking is confirmed</h3>
        <p><strong>Confirmation Number:</strong>{{$transaction_data->txnid ?? ''}}</p>
        {{--<a href="{{url('downloadTicket',$transaction_data->txnid ?? '')}}" class="btn btn-dark">Print Invoice</a>
        <a href="{{ url('rooms') }}" class="btn btn-primary">Book another room</a>--}}

        <a class="view-invoice btn btn-dark" type="button" data-toggle="modal" data-target="#staticBackdrop">View Invoice</a>
        <a href="{{url('downloadTicket',$transaction_data->txnid ?? '')}}/downl_invoice" class="btn btn-dark">Download Invoice</a>


        <?php
        if ($checkout_form_data['grand_total_amt'] > 0) {
        ?>


          <div class="text-center">
            <a href="javascript:void(0)" class="btn btn-primary cancel-reservation">Cancel Reservation</a>
          </div>

        <?php } ?>

      </div>

    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
@include('layouts.footer')
<!-- footer section -->
@endsection