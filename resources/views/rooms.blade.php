@extends('layouts.layout')
@section('content')

@include('layouts.header')


<main class="web-main">

  <!-- Page Title Section Start -->
  <section class="page-title-section" style="background-image:url(img/event-banner-img.jpg);">
    <div class="container">
      <div class="page-title">Rooms</div>
    </div>
  </section>
  <!-- Page Title Section End -->

  <!-- Rooms Page Section Start -->
  <section class="rooms-page-section">
    <div class="container">
      <div class="row">

        <!-- Col Start -->
        <div class="col-xl-4 col-lg-5">

          <!-- room filter section start -->
          @include('room-filter')
          <!-- room filter section start -->


          <section class="direct-contact d-none d-lg-block">
            <div class="direct-contact-title">Direct Contact</div>
            <p>Do you need help? Feel free to contact us! We are here to help you.</p>

            <div class="direct-con-box">
              <div class="direct-con-img">
                <img src="img/testi-img.jpg" alt="Image">
              </div>
              <div class="direct-con-text">
                <div class="direct-sub-title">Booking Assistant</div>
                <div class="direct-sub-name">Himani Sherawat</div>
                <div class="direct-sub-number">+91 9876543210</div>
              </div>
            </div>
            <div class="d-grid">
              <a href="javascript:void(0)" class="btn btn-primary btn-block reservation-btn">CHAT WITH SUPPORT</a>
            </div>

          </section>
        </div>
        <!-- Col End -->

        <!-- Col Start -->
        <div class="col-xl-8 col-lg-7 order-lg-first">

          <!-- Room List Start -->
          @if(!empty($rooms))
          @foreach($rooms as $key => $value)
          <div class="room-list">
            <div class="room-list-img">
              <a href="{{ url('room',$value->slug) }}"><img src="{{env('BACKEND_URL').'show-images/'. json_decode($value->image)[0]  }}" alt="Image" class="img-fluid"></a>
              <div class="web-logo"><img src="{{asset('img/logo-blog.png')}}" alt="Logo"></div>
              <div class="room-offers">
                <big>
               
                {{ (isset($room['new_off_percentage']) && !empty($room['new_off_percentage'])) ? $room->new_off_percentage : $value->off_percentage }}<sup>%</sup></big>
                <span>Off</span>
              </div>
            </div>
            <div class="room-list-detail">
              <div class="room-list-title"><a href="{{ url('room',$value->slug) }}">{{ $value->title }}</a></div>
              <p>{{ strip_tags(\Illuminate\Support\Str::words($value->description, 50)) }}</p>
              <div class="room-list-bottom">
                <big>₹{{ $value->price }}</big>
                <s>₹{{ $value->old_price }}</s>
              </div>

              <a href="{{ url('room',$value->slug) }}" class="room-detail-btn"><span>Room Details</span></a>
            </div>
          </div>
          @endforeach
          @endif
          <!-- Room List End -->


        </div>
        <!-- Col End -->

        <!-- Col Start -->
        <section class="direct-contact d-block d-lg-none">
          <div class="direct-contact-title">Direct Contact</div>
          <p>Do you need help? Feel free to contact us! We are here to help you.</p>

          <div class="direct-con-box">
            <div class="direct-con-img">
              <img src="img/testi-img.jpg" alt="Image">
            </div>
            <div class="direct-con-text">
              <div class="direct-sub-title">Booking Assistant</div>
              <div class="direct-sub-name">Himani Sherawat</div>
              <div class="direct-sub-number">+91 9876543210</div>
            </div>
          </div>
          <div class="d-grid">
            <a href="javascript:void(0)" class="btn btn-primary btn-block reservation-btn">CHAT WITH SUPPORT</a>
          </div>

        </section>
        <!-- Col End -->


      </div>
    </div>
  </section>
  <!-- Rooms Page Section End -->

</main>
 
@include('layouts.footer')
<!-- <script src="{{ asset('js/room.js')}}"></script> -->
<script>

  
</script>
@endsection

