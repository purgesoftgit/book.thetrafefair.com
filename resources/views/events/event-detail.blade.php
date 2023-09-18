@extends('layouts.layout')
@section('content')
@include('layouts.header')
<style type="text/css">.read-more-hide,.read-more-show{cursor:pointer;color:#00b542}.hide_content{display:none}</style>

    <main class="web-main">
        <!-- Page Title Section Start -->
        @if($event_detail)
        <section class="page-title-section" style="background-image:url({{env('BACKEND_URL') . 'show-images/' . $event_detail->image }});">
            <div class="container">
                <div class="page-title">{{$event_detail->location}} Event</div>
            </div>
        </section>
        @endif
        <!-- Page Title Section End -->
  
        <section class="event-detail-page">
          <div class="container" style="padding-bottom: 50px;">
            <div class="row">
    
              <!-- Col 8 Start -->
              @if($event_detail)
              <div class="col-xl-4 col-lg-5">
                <div class="event-details-box">
                  <div class="event-details-title">Event Details</div>
    
                  <ul>
                    <li>
                      <div class="e-icon">
                        <img src="{{ asset('img/e-date.png')}}" alt="Image">
                      </div>
                      <div class="flex-event">
                        <div class="e-title">Event DATE</div>
                        <div class="e-detail">  
                            {{ Carbon\Carbon::parse($event_detail->start_datetime)->format('d') }} -
                            {{ Carbon\Carbon::parse($event_detail->end_datetime)->format('d F, Y') }}
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="e-icon">
                        <img src="{{ asset('img/e-location.png')}}" alt="Image">
                      </div>
                      <div class="flex-event">
                        <div class="e-title">VENUE</div>
                        <div class="e-detail">{{$event_detail->location}}</div>
                      </div>
                    </li>
                    <li>
                      <div class="e-icon">
                        <img src="{{ asset('img/e-company.png')}}" alt="Image">
                      </div>
                      <div class="flex-event">
                        <div class="e-title">ORGANIZER</div>
                        @if($event_detail->selected_website == 1)
                            <div class="e-detail"> The Trade Fair</div>
                        @else
                            <div class="e-detail"> The Trade International</div>
                        @endif
                    </li>
                    <li>
                      <div class="e-icon">
                        <img src="{{ asset('img/e-call.png')}}" alt="Image">
                      </div>
                      <div class="flex-event">
                        <div class="e-title">Phone Number</div>
                        <div class="e-detail">{{ $settings['tradefair_contact_number'] ?? ''}}</div>
                      </div>
                    </li>
                    <li>
                      <div class="e-icon">
                        <img src="{{ asset('img/e-email.png')}}" alt="Image">
                      </div>
                      <div class="flex-event">
                        <div class="e-title">Email Addres</div>
                        <div class="e-detail font18">{{ $settings['tradefair_email'] ?? ''}}</div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- Col 8 End -->
    
              <!-- Col 4 Start -->
              <div class="col-xl-8 col-lg-7">
                <div class="event-detail-col">
                  <div class="event-detail-title">{{$event_detail->title}}</div>
                   <p>{!! Illuminate\Support\Str::words($event_detail->description, 200) !!}</p> 
                   
                   

                    <div class="sidebar-heading">SHARE THIS EVENT</div>
                    <div>
                      <div id="share"></div>

                      <!-- <a href="javascript:void(0)" class="side-social fa fa-facebook"></a>
                      <a href="javascript:void(0)" class="side-social fa fa-twitter"></a>
                      <a href="javascript:void(0)" class="side-social fa fa-instagram"></a>
                      <a href="javascript:void(0)" class="side-social fa fa-linkedin"></a>
                      <a href="javascript:void(0)" class="side-social fa fa-youtube"></a> -->
                    </div> 
                </div>
              </div>

              
            </div>
            @endif
            {{-- <div class="event-map">
              <div class="normal-title">Event Map</div>
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d17461.285550946286!2d85.84019356994256!3d20.29425543689536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1693907844632!5m2!1sen!2sin"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
            <div class="event-photos">
              <div class="normal-title">Event Photos</div>
    
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                  <img src="img/event-img.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                  <img src="img/event-img2.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                  <img src="img/event-img3.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                  <img src="img/event-img4.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                  <img src="img/event-img5.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                  <img src="img/event-img.jpg" alt="Image" class="img-fluid">
                </div>
              </div>
    
            </div> --}}
          </div>
        </section>
      </main>
@include('layouts.footer')

<script>
  $(document).ready(function(){
    $("#share").jsSocials({
        showLabel: false,
        showCount: false,
        shares: ["twitter", "facebook", "linkedin", "whatsapp"]
    });
  })
        
</script>

@endsection
