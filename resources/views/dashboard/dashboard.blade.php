@extends('layouts.dashboard-layout')
@section('content')

<div class="page-wrapper chiller-theme my-custom-navbar toggled">
  <a id="show-sidebar" href="javascript:void(0)">
    <i class="fas fa-bars"></i>
  </a>
  <!--Navbar Start-->
    {{-- @include('dashboard.navbar') --}}
  <!--EndNavbar Start-->

  <!-- sidebar-wrapper  -->
  <main class="page-content">

    <!-- top bar -->
    @include('dashboard.header')
    <div class="midsection">
      <div class="container-fluid">

      <div class="row">
            <!-- Col- Lg Start --> 
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <a href="{{url('get-upcoming-checkin-checkout')}}" class="order-history" data-type="ROOM">
                  <div class="clientsection shadow">
                    <i class="fa fa-hotel" style="color: #edc360;font-size: 30px;"></i>
                    
                    <div class="totalroombookings totalroombookings-dash"></div>
                     
                    <h5>Room Booking History</h5>
                    <p>All Room Booking History</p>
                    <div class="clientsection-no"></div>
                  </div>
                </a>
              </div>
            <!-- Col- Lg End -->

            <!-- Col- Lg Start -->
              {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <a href="{{url('bar-restaurant-meeting-list')}}" class="reservation" id="reservation">
                  <div class="clientsection shadow">
                    <i class="fa fa-hotel" style="color: #edc360;font-size: 30px;"></i>
                    <div class="totalreservation totalreservation-dash"></div>
                    <h5>Reservation Listing History</h5>
                    <p>All Reservation Listing History</p>
                    <div class="clientsection-no"></div>
                  </div>
                </a>
              </div> --}}
            <!-- Col- Lg End -->
      {{-- @endif  --}}
      </div>
    </div>
</main>
</div>
<!-- page-content" -->
<style type="text/css">h5{color: black;margin-top: 15px;}
</style>
<script>
 jQuery(function ($) {

  $("#close-sidebar").click(function() {
    $(".page-wrapper").removeClass("toggled");
  });
  $("#show-sidebar").click(function() {
    $(".page-wrapper").addClass("toggled");
  });

}); 
</script>


<script>
// function gettotalrservationunread(){
//   $.ajax({
//     url:"{{ url('count-total-unread-reservations') }}",
//     type:"get",
//     success:function(response){ 
//       if(response.reservation_count > 0){
//         $('.totalreservation').text(response.reservation_count).addClass('counter');
//         $('.totalreservation-dash').addClass('counter');
//         $('.totalreservation-nav').addClass('small-counter');
//       }
//     }
//   })
// }

 $(document).ready(function(){
  setTimeout(function() {
    $('.fade-message').slideUp();
  }, 5000);
 
  $('.order-history').click(function(){
   
    $.ajax({
      url:"{{ url('change-unread-status-order') }}/"+$(this).data("type"),
      type:"get",
      success:function(){

      }
    })
  });

});
</script>
@endsection
 