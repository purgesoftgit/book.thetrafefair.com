@extends('layouts.layout')
@section('content')
@include('layouts.header')
<main class="web-main">

    <!-- Page Title Section Start -->
    <section class="page-title-section" style="background-image:url(img/banquet-hall-banner.jpg);">
      <div class="container">
        <div class="page-title">Best Banquet Hall</div>
      </div>
    </section>
    <!-- Page Title Section End -->

    <!-- Banquet Hall Section Start -->
    <section class="banquet-service-section">
      <div class="container">

        <div class="sub-title">Choose Our Services For Your Special Occasions</div>
        <div class="section-title mb-5">Services</div>

        <div class="row">

          <!-- Col Start -->
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <div class="banquet-service-list">
              <img src="{{ asset('img/banquet-service-img.jpg')}}" alt="image" class="img-fluid">
              <div class="banquet-service-inner">
                <div class="banquet-service-list-title"><strong>WEDDINGS</strong></div>
                <span>405 Weddings</span>
              </div>
            </div>
          </div>
          <!-- Col End -->
          
          <!-- Col Start -->
          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 order-lg-last">

            <div class="banquet-service-list">
              <img src="{{ asset('img/banquet-service-img4.jpg')}}" alt="image" class="img-fluid">
              <div class="banquet-service-inner">
                <div class="banquet-service-list-title"><strong>BIRTHDAY</strong></div>
                <span>405 Birthday</span>
              </div>
            </div>
            
          </div>
          <!-- Col End -->

          <!-- Col Start -->
          <div class="col-xl-4 col-lg-4 col-md-12">

            <div class="row col-grid">
              <div class="col-lg-12 col-md-6 col-sm-6">
                <div class="banquet-service-list">
                  <img src="{{ asset('img/banquet-service-img2.jpg')}}" alt="image" class="img-fluid">
                  <div class="banquet-service-inner">
                    <div class="banquet-service-list-title"><strong>CORPORATE PARTY</strong></div>
                    <span>120 CORPORATE PARTY</span>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-6 col-sm-6">
                  <div class="banquet-service-list">
                    <img src="{{ asset('img/banquet-service-img3.jpg')}}" alt="image" class="img-fluid">
                    <div class="banquet-service-inner">
                      <div class="banquet-service-list-title"><strong>ANNIVERSARY</strong></div>
                      <span>100 Anniversary</span>
                    </div>
                  </div>
              </div>
            </div>



            
          </div>
          <!-- Col End -->
          

        </div>
      </div>
    </section>
    <!-- Banquet Hall Section End -->

    <!-- Banquet Hall Service Detail Section Start -->
    <section class="banquet-service-detail-section">
      <div class="container">

        <div class="row gx-0">

          <!-- Col Start -->
          <div class="col-xl-6 col-lg-6">
            <div class="banq-service-det-list">
              <div class="banq-service-det-list-icon">
                <img src="{{asset('img/banquet-icon.png')}}" alt="image">
              </div>
              <div class="banq-service-det-list-title">Weddings</div>
              <p>Being one of the best destinations for residential weddings, our luxurious suites, rooms, chic decor, ambience and fully facilitated amenities would ensure your stay is a pleasurable one. Our banquets provide the desired ambience and can accommodate from large gatherings to intimate assemblage. We make celebrations memorable, adorned with breathtaking decor, tantalizing our guests’ tastebuds with a serving of global cuisines specially prepared by our internationally trained culinary experts and soulful ambience.</p>
            </div>
          </div>
          <!-- Col End -->

          <!-- Col Start -->
          <div class="col-xl-6 col-lg-6">
            <div class="banq-service-det-list">
              <div class="banq-service-det-list-icon">
                <img src="{{asset('img/banquet-icon2.png')}}" alt="image">
              </div>
              <div class="banq-service-det-list-title">Corporate Parties</div>
              <p>Be it your engagement ceremony, pre-wedding functions, reception, social gatherings or a VIP gathering, your search for a robust party ends here. We spruce up the parties with joyful and fascinating themes and props, delighting our guests. We offer best-in-class services to pamper our guests and indulge in a mesmerizing experience. Experience unmatched luxury partying at our opulent banquet space.</p>
            </div>
          </div>
          <!-- Col End -->

          <!-- Col Start -->
          <div class="col-xl-6 col-lg-6">
            <div class="banq-service-det-list">
              <div class="banq-service-det-list-icon">
                <img src="{{asset('img/banquet-icon3.png')}}" alt="image">
              </div>
              <div class="banq-service-det-list-title">Anniversaries</div>
              <p>Making your day special with outstanding guest service, elegant accommodations, dine out options with lush greenery around and a picturesque view. Relive the magic of love and cherish togetherness in the lap of luxury. Treat your loved one with the world’s best wines, and we will ensure that your day has a touch of extravagance and make your day as glamorous as you are.</p>
            </div>
          </div>
          <!-- Col End -->

          <!-- Col Start -->
          <div class="col-xl-6 col-lg-6">
            <div class="banq-service-det-list">
              <div class="banq-service-det-list-icon">
                <img src="{{asset('img/banquet-icon4.png')}}" alt="image">
              </div>
              <div class="banq-service-det-list-title">Birthday</div>
              <p>We create date events unforgettable memories, and whether you want to dine under a starry night or have a lavish indoor affair with the love of your life, we cater to all your needs. Our banquets provide a perfect romantic getaway, be it a candlelight dinner with complimentary music beats or a champagne breakfast. We make every date a moment magical.</p>
            </div>
          </div>
          <!-- Col End -->

        </div>
      </div>
    </section>
    <!-- Banquet Hall Service Detail Section End -->

    <div class="container">
      <img src="{{asset('img/ad-img.jpg')}}" alt="image" class="img-fluid">
    </div>

    <!-- Banquet Hall Section Start -->
    <section class="banquet-offers-section">
      <div class="container">

        <div class="sub-title">What We Offers</div>
        <div class="section-title mb-5">Offers</div>

        <div class="row justify-content-center">

          <!-- Col Start -->
          <div class="col-xl-10">
            <div class="row justify-content-center">

              <!-- Col Start -->
              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="banquet-offers-list">
                  <img src="{{asset('img/banq-offer-img.jpg')}}" alt="image" class="img-fluid">
                  <div class="banquet-offers-list-title">Indoor and Outdoor Catering</div>
                </div>
              </div>
              <!-- Col End -->

              <!-- Col Start -->
              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="banquet-offers-list banquet-offers-bg2">
                  <img src="{{asset('img/banq-offer-img2.jpg')}}" alt="image" class="img-fluid">
                  <div class="banquet-offers-list-title">Decoration</div>
                </div>
              </div>
              <!-- Col End -->

              <!-- Col Start -->
              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="banquet-offers-list banquet-offers-bg3">
                  <img src="{{asset('img/banq-offer-img3.jpg')}}" alt="image" class="img-fluid">
                  <div class="banquet-offers-list-title">Complete Event Management</div>
                </div>
              </div>
              <!-- Col End -->


            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Banquet Hall Section End -->

    <section class="testimonials-section">
      <div class="container">
        <div class="sub-title">Testimonials</div>
        <div class="section-title">words from People</div>

        <div class="owl-carousel owl-theme" id="testimonials-slider">

            @foreach ($data as $item)
            @if ($item->selected_website == 1)
            <div class="item">
                <div class="tes-message-box">
                    <p>{{ Illuminate\Support\Str::words($item->review,100)}}</p>
                </div>
                <div class="tes-author-box">
                    <div class="tes-author-img">

                        @if(!is_null(json_decode($item->image)))
                        <img src="{{ env('BACKEND_URL') . 'show-images/' . json_decode($item->image)[0] }}" alt="{{ $item->author_name }}">
                        @else
                        <img src="{{ asset('img/dummy.png')}}" alt="Default Image">
                        @endif
                    </div>
                    <div class="author-name text-primary">{{ $item->author_name }}</div>
                </div>
            </div>
            @endif
            @endforeach

        </div>

      </div>
    </section>

    <!-- new form data start -->
    <section class="meeting-contact-form">
      <div class="container">
        <form action="{{route('banquet-store')}}" id="banquet_form" method="POST" class="form-style" novalidate="novalidate">
            @csrf
          <h4 class="con-form-title">WE ARE HERE TO HELP YOU</h4>


          <div class="row" data-select2-id="select2-data-4-m7li">
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="userfirstName" class="form-label">First Name<sup>*</sup></label>
                <input name="name" type="text" class="form-control validate[required,minSize[2],maxSize[50]]" id="userfirstName" placeholder="">
                <span id="userfirstName-info" class="error"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="userlastName" class="form-label">Last Name<sup>*</sup></label>
                <input name="userlastName" type="text" class="form-control validate[required,minSize[2],maxSize[50]]" id="userlastName" placeholder="">
                <span id="userlastName-info" class="error"></span>
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
                <span id="userEmail-info" class="error"></span>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="mb-3">
                <label for="dateofevent" class="form-label">Date Of Event<sup>*</sup></label>
                <input type="date" class="form-control dateofevent" placeholder="" autocomplete="off" onfocus="(this.type='date')" name="dateofevent" min="<?php echo date('Y-m-d'); ?>" onkeydown="return false" value="<?php echo date('Y-m-d'); ?>" id="dateofevent" onblur="if(!this.value) this.type='text'" required="">

                <span id="date-info" class="error"></span>
              </div>
            </div>

            <div class="col-lg-6 ">

              <label for="myTextBox" class="form-label">Phone Number<sup>*</sup></label>
              <div class="mb-3 input-group banquet-contact">
                <span class="input-group-text" id="basic-addon1">
                  <img src="{{ asset('img/india-flag.jpg')}}" alt="India Flag Image">&nbsp; +91
                </span>
                
                <input type="number" class="form-control phone-num validate[required,phone,maxSize[10],minSize[10]]" placeholder="" maxlength="10" minlength="10" name="phone" id="myTextBox">
                
                <!-- <div class="input-group-append edit-input-group-append">
                  <span toggle="#password-field" class="input-group-text field-icon"><i class="fa fa-pencil"></i></span>
                </div> -->
                <span class="phone_error"></span>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="mb-3">
                <label for="numberofguest" class="form-label">Number of Guest</label>
                <input name="numberofguest" type="text" class="form-control validate[required]" id="numberofguest" placeholder="">
                <span id="numberofguest-info" class="error"></span>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="mb-3">
                <label for="company" class="form-label">Company Name<sup>*</sup></label>
                <input name="company" type="text" class="form-control validate[required]" id="company" placeholder="">
                <span id="company-info" class="error"></span>
              </div>
            </div>


            <div class="col-lg-12" data-select2-id="select2-data-3-0rdd">
              <div id="list1" class="mb-3 wedding-planner" tabindex="100" data-select2-id="select2-data-list1">

                <label class="wedding-service-select form-label" for="services">Services You are interested in<sup>*</sup></label>
                <select id="select-date-checkinout" required="" class="form-select valid validate[required]" name="booking_purpose" aria-invalid="false">
                  <option value="" selected="" disabled="">Select Booking Purpose</option>
                  <option value="Board_ROOMS">Board ROOMS</option>
                  <option value="Corporate Meeting Hall">Corporate Meeting Hall</option>
                  <option value="other">Other</option>
                </select>
                <span id="services-info" class="error"></span>
              </div>
            </div>
            
            <div class="col-lg-12">
              <div class="mb-5">
                <label for="content" class="form-label">Any Additional Information</label>
                <textarea name="message" class="form-control validate[required]" id="content" placeholder="" style="height:110px; resize:none;"></textarea>
                <span id="content-info" class="error"></span>
              </div>
            </div>

            <div class="mb-4">
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

  </main>

@include('layouts.footer')

<script type="text/javascript">
    $('#testimonials-slider').owlCarousel({
      loop:true,
      nav: true,
      navText: ["<img src='img/slider-left-icon.png'>","<img src='img/slider-right-icon.png'>"],
      dots: false,
      items:1,
      autoplay:true,
      smartSpeed:2000,
      autoplayTimeout:4000,
      responsiveClass: true,
      responsive: {
       0: {
        items: 1
      }
    }
  })
</script>

<script>
    $(document).ready(function() {
      $("#submit-banquet-form").click(function(e) {
       
       var is_validate = $('#banquet_form').validationEngine('validate');
   
        if(is_validate === false || is_validate == "false"){
        }else if(grecaptcha.getResponse().length == 0){
          $('.captcha_err').text('Please complete the reCAPTCHA challenge.')
        }else if (is_validate === true) {
          Swal.fire({
            title: '',
            text: 'Please wait while processing...',
            icon: 'info',
            timer: 3000, // Show this message for 3 seconds
            timerProgressBar: true,
            showConfirmButton: false
          }).then(function() {
            $('#banquet_form').submit();
          });
  
        } 
      });
    });
  </script>
@endsection