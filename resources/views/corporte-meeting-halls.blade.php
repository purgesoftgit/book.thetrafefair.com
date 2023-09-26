@extends('layouts.layout')
@section('content')
@include('layouts.header')

<main class="web-main">

  <!-- Page Title Section Start -->
  <section class="page-title-section" style="background-image:url(img/about-banner-img.jpg);">
    <div class="container">
      <div class="page-title">Conference & Corporate Meeting Hall</div>
    </div>
  </section>
  <!-- Page Title Section End -->

  <section class="event-section">
    <div class="container">
      <div class="sub-title">Events</div>
      <div class="section-title mb-5">Group Events</div>

      <div class="row">
        <!-- Col Start -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
          <div class="event-list" style="background-image:url(img/event-bg2.jpg);">
            <div class="event-list-inner">
              <div class="event-list-title">Board Rooms</div>
              <strong class="mt-3">No. of Attendees</strong>
              <small>20-25</small>
            </div>
          </div>
        </div>
        <!-- Col End -->

        <!-- Col Start -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
          <div class="event-list" style="background-image:url(img/event-bg3.jpg);">
            <div class="event-list-inner">
              <div class="event-list-title">Corporate Meeting Hall</div>
              <strong class="mt-3">No. of Attendees</strong>
              <small>300-500</small>
            </div>
          </div>
        </div>
        <!-- Col End -->

      </div>
    </div>
  </section>

  <div class="container">


    <!-- Custom Meeting Start -->
    <section class="custom-meeting">
      <div class="row">
        <div class="col-xxl-7 order-xxl-last col-xl-7 order-xl-last col-lg-7 order-lg-last">
          <div class="custom-meeting-img">
            <img src="{{asset('img/meeting-list.jpg')}}" alt="Meeting Rooms" class="img-fluid">
          </div>
        </div>

        <div class="col-xxl-5 order-xxl-first col-xl-5 order-xl-first col-lg-5 order-lg-first">
          <div class="custom-meeting-inner">
            <img src="{{asset('img/meeting-rooms-icon.png')}}" alt="Meeting Rooms" class="img-fluid">
            <h2>Board Meeting Rooms</h2>
            <p>A perfect place to conduct exclusive meetings with state-of-the-art facilities such as Audiovisual
              facilities, wireless high-speed internet access, LCD screen for business presentation, video
              conferencing facility, flip charts and built-in screen. All the meeting arrangements are highly
              customizable and facilities are made available with panache.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- Custom Meeting End -->

    <!-- Custom Meeting Start -->
    <section class="custom-meeting">
      <div class="row">
        <div class="col-xxl-7 col-xl-7 col-lg-7">
          <div class="custom-meeting-img">
            <img src="{{asset('img/meeting-list5.jpg')}}" alt="Corporate Meeting Hall" class="img-fluid">
          </div>
        </div>

        <div class="col-xxl-5 col-xl-5 col-lg-5">
          <div class="custom-meeting-inner">
            <img src="{{asset('img/banquet-hall-rooms-icon.png')}}" alt="Corporate Meeting Hall" class="img-fluid">
            <h2>Corporate Meeting Hall</h2>
            <p>Making every gathering a memorable experience, our corporate meeting hall can accommodate your varied
              needs, including corporate annual day celebrations, special corporate lunches and parties. The venue
              adorned by beautiful decor with wall paints, decorative masterpieces, to luxurious interiors. Be assured
              to receive world-class hospitality infused with exclusive facilities and privileges and our best in
              class catering services.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- Custom Meeting End -->

  </div>

  <div class="container">
    <!-- Activities Section Start -->
    <section class="activities-section">
      <div class="row  align-items-center">
        <!-- Col Start -->
        <div class="col-xxl-3 col-xl-3">
          <h2 class="section-title text-capitalize">Facilities</h2>
        </div>
        <!-- Col End -->

        <!-- Col Start -->
        <div class="col-xxl-9 col-xl-9">

          <!-- Row Start -->
          <div class="row responsive-col">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
              <!-- Activities List Start -->
              <div class="activities-list">
                <img src="{{asset('img/amen-01.png')}}" alt="Technical assistance">
                <h3>Technical assistance</h3>
                <p>Our team of specialized experts are available on the spot to provide seamless technical assistance
                  to make each meeting a value-packed memorable experience. </p>
              </div>
              <!-- Activities List End -->
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
              <!-- Activities List Start -->
              <div class="activities-list">
                <img src="{{asset('img/amen-02.png')}}" alt="Receiving and Maintance">
                <h3>Receiving and Maintance</h3>
                <p>A dedicated, sophisticated team is available 24*7 for managing arrangements and catering to guests
                  requests. </p>
              </div>
              <!-- Activities List End -->
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
              <!-- Activities List Start -->
              <div class="activities-list">
                <img src="{{asset('img/amen-03.png')}}" alt="Music and entertainment">
                <h3>Music and entertainment</h3>
                <p>The venue for banquet halls and conference rooms has Custom-designed music and entertainment to
                  suit all moods and vibes.</p>
              </div>
              <!-- Activities List End -->
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
              <!-- Activities List Start -->
              <div class="activities-list">
                <img src="{{asset('img/amen-05.png')}}" alt="Best experience">
                <h3>Best experience</h3>
                <p>We ensure every gathering is a story in itself with tales of luxury, quality service,
                  sophistication and fun. </p>
              </div>
              <!-- Activities List End -->
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
              <!-- Activities List Start -->
              <div class="activities-list">
                <img src="{{asset('img/icon-7.png')}}" alt="FAST WIF">
                <h3>FAST WIFI</h3>
                <p> Free and quick access to Wi-Fi enables our guests to experience hi-tech facilities at every hotel
                  space.</p>
              </div>
              <!-- Activities List End -->
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
              <!-- Activities List Start -->
              <div class="activities-list">
                <img src="{{asset('img/icon-8.png')}}" alt="SERVICE">
                <h3>SERVICE</h3>
                <p>Our high-quality service delivery at our meeting and conferencing facilities is exceptional, so
                  much so that it is on the top of the list for most meeting planners.</p>
              </div>
              <!-- Activities List End -->
            </div>
          </div>
          <!-- Row End-->

        </div>
        <!-- Col End -->
      </div>
    </section>
    <!-- Activities Section End -->
  </div>
  <!-- new form data start -->
  <section class="meeting-contact-form">
    <div class="container">
      <form action="{{ url('save-meeting-data') }}" id="meeting-form" method="POST" class="form-style form-validate" novalidate="novalidate">
        @csrf
        <h4 class="con-form-title">Book Your Meeting Space</h4>


        <div class="row" data-select2-id="select2-data-4-m7li">
          <div class="col-lg-6">
            <div class="mb-3">
              <label for="userfirstName" class="form-label">First Name<sup>*</sup></label>
              <input name="name" type="text" class="form-control validate[required,maxSize[50]]" id="userfirstName" placeholder="">
              <!-- <span id="userfirstName-info" class="error"></span> -->
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <label for="userlastName" class="form-label">Last Name<sup>*</sup></label>
              <input name="userlastName" type="text" class="form-control validate[required,maxSize[50]]" id="userlastName" placeholder="">
              <!-- <span id="userlastName-info" class="error"></span> -->
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="city" class="form-label">City<sup>*</sup></label>
              <input name="city" type="text" class="form-control validate[required]" id="city" placeholder="">
              <span id="userCity-info" class="error"></span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <label for="userEmail" class="form-label">Email<sup>*</sup></label>
              <input name="email" type="email" class="form-control validate[required,custom[email]]" id="userEmail" placeholder="">
              <!-- <span id="userEmail-info" class="error"></span> -->
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="dateofevent" class="form-label">Date Of Event<sup>*</sup></label>
              <input type="date" class="form-control dateofevent" placeholder="" autocomplete="off" onfocus="(this.type='date')" name="dateofevent" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" onkeydown="return false" id="dateofevent" onblur="if(!this.value) this.type='text'" required="">

              <!-- <span id="date-info" class="error"></span> -->
            </div>
          </div>

          <div class="col-lg-6 ">

            <label for="myTextBox" class="form-label">Phone Number<sup>*</sup></label>
            <div class="mb-3 input-group banquet-contact">
              <span class="input-group-text" id="basic-addon1">
                <img src="{{asset('img/india-flag.jpg')}}" alt="India Flag Image">&nbsp; +91
              </span>
              <input type="text" name="phone" id="phone" minlength="10" maxlength="10" class="form-control phone validate[required,maxSize[10],minSize[10]]"  />
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="numberofguest" class="form-label">Number of Guest<sup>*</sup></label>
              <input name="numberofguest" type="number" class="form-control validate[required]" id="numberofguest" placeholder="">
              <span id="numberofguest-info" class="error"></span>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="company" class="form-label">Company Name<sup>*</sup></label>
              <input name="company" type="text" class="form-control validate[required]" id="company" placeholder="">
              <!-- <span id="company-info" class="error"></span> -->
            </div>
          </div>


          <div class="col-lg-12" data-select2-id="select2-data-3-0rdd">
            <div id="list1" class="mb-3 wedding-planner" tabindex="100" data-select2-id="select2-data-list1">

              <label class="wedding-service-select form-label" for="services">Services You are interested
                in<sup>*</sup></label>
              <select id="select-date-checkinout" required="" class="form-select valid" name="booking_purpose" aria-invalid="false">
                <!-- <option value="" selected="" disabled="">Select Booking Purpose</option> -->
                <option value="Board_ROOMS">Board ROOMS</option>
                <option value="Corporate Meeting Hall">Corporate Meeting Hall</option>
                <option value="other">Other</option>
              </select>
              <!-- <span id="services-info" class="error"></span> -->
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-5">
              <label for="content" class="form-label">Any Additional Information</label>
              <textarea name="message" class="form-control" id="content" placeholder="" style="height:110px; resize:none;"></textarea>
              <!-- <span id="content-info" class="error"></span> -->
            </div>
          </div>

          <div class="col-lg-12">

            <label for="message-field" class="form-label">Captcha<span aria-label="required" class="text-danger">*</span></label>
            <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
            @if ($errors->has('g-recaptcha-response'))
            <span class="text-danger"> {{ $erros->first('recaptcha') }} </span>
            @endif
            <span class="captcha_err text-danger"></span>

          </div>

          <div class="text-center">
            <button type="button" class="btn btn-primary" id="submit-banquet-form">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- new form data end -->

  <div class="container">
    <!-- Contact Section Start -->
    <section class="contact-section">
      <div class="row">
        <div class="col-lg-12 contact-box" style="background-image:url(img/meeting-banner.jpg);">

          <div class="contact-box-inner">
            <div class="contact-list">
              <div class="contact-list-title">Visit us</div>
              <p>{{ $settings['address'] ?? ''}}</p>
            </div>

            <div class="contact-list">
              <div class="contact-list-title">Call us</div>
              <p><a href="tel:{{ $settings['tradefair_contact_number'] ?? ''}}" class="text-body">{{ $settings['tradefair_contact_number'] ?? ''}}</a></p>
            </div>

            <div class="contact-list">
              <div class="contact-list-title">Email Us</div>
              <p><a href="mailto:{{ $settings['tradefair_email'] ?? '' }}" class="text-body">{{ $settings['tradefair_email'] ?? '' }}</a>
              </p>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact Section End -->
  </div>

</main>


@include('layouts.footer')
<script>
  $(document).ready(function() {
    $("#submit-banquet-form").click(function(e) {

      var is_validate = $('#meeting-form').validationEngine('validate');
 
      if (is_validate === false || is_validate == "false") {} else if (grecaptcha.getResponse().length == 0) {
        $('.captcha_err').text('Please complete the reCAPTCHA challenge.')
      } else if (is_validate === true) {
        Swal.fire({
          title: '',
          text: 'Please wait while processing...',
          icon: 'info',
          timer: 3000, // Show this message for 3 seconds
          timerProgressBar: true,
          showConfirmButton: false
        }).then(function() {
          $('#meeting-form').submit();
        });

      }
    });
  });
</script>
@endsection