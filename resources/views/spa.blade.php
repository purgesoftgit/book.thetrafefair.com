@extends('layouts.layout')
@section('content')

@include('layouts.header')

<main class="web-main">

  <!-- Page Banner Section Start -->
  <section class="spa-banner">
    <img src="img/spa-banner.jpg" alt="SPA" class="img-fluid">
  </section>
  <!-- Page Banner Section End -->

  <!-- Category Section Start -->
  <section class="spa-category">
    <div class="container">
      <div class="row">

        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <a class="spa-category-list">
            <div class="spa-category-icon">
              <img src="img/stone-massage-icon.png" alt="Image">
            </div>
            <div class="spa-category-name">Stone Massage</div>
          </a>
        </div>
        <!-- Col End -->

        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <a class="spa-category-list">
            <div class="spa-category-icon">
              <img src="img/aromatherapy-massage-icon.png" alt="Image">
            </div>
            <div class="spa-category-name">Aromatherapy Massage</div>
          </a>
        </div>
        <!-- Col End -->

        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <a class="spa-category-list">
            <div class="spa-category-icon">
              <img src="img/oil-cream-massage-icon.png" alt="Image">
            </div>
            <div class="spa-category-name">Oil & Cream Massage</div>
          </a>
        </div>
        <!-- Col End -->

        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <a class="spa-category-list">
            <div class="spa-category-icon">
              <img src="img/finnish-sauna-massage-icon.png" alt="Image">
            </div>
            <div class="spa-category-name">Finnish Sauna Massage</div>
          </a>
        </div>
        <!-- Col End -->

      </div>
    </div>
  </section>
  <!-- Category Section End -->

  <!-- Gallery Page Section Start -->
  <section class="gallery-page-section spa-gallery">
    <div class="container">
      <div class="sub-title">Perfectly Located</div>
      <div class="section-title">Gallery</div>

      <div class="row" id="my-gallery-container">
        <div class="item" data-order="1">
          <img src="img/spa-gallery-img.jpg" alt="">
        </div>
        <div class="item" data-order="2">
          <img src="img/spa-gallery-img3.jpg" alt="">
        </div>
        <div class="item" data-order="3">
          <img src="img/spa-gallery-img4.jpg" alt="">
        </div>
        <div class="item" data-order="4">
          <img src="img/spa-gallery-img2.jpg" alt="">
        </div>
        <div class="item" data-order="5">
          <img src="img/spa-gallery-img5.jpg" alt="">
        </div>
        <div class="item" data-order="6">
          <img src="img/spa-gallery-img6.jpg" alt="">
        </div>
      </div>
      {{--
        <div class="text-center mt-5">
          <button type="button" class="btn btn-primary">Load More</button>
        </div> --}}

    </div>
  </section>
  <!-- Gallery Page Section End -->

  <!-- Spa Counter Section Start -->
  <section class="spa-counter-section">
    <div class="container">
      <div class="row">
        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <div class="spa-counter-list">
            <div class="spa-counter-list-inner">
              <big>{{ $settings['client_served'] ?? '' }}</big>
              <div class="spa-counter-list-title">happy clients served</div>
            </div>
          </div>
        </div>
        <!-- Col End -->
        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <div class="spa-counter-list">
            <div class="spa-counter-list-inner">
              <big>{{ $settings['aroma_sticks_burnt'] ?? '' }}</big>
              <div class="spa-counter-list-title">aroma-sticks burnt</div>
            </div>
          </div>
        </div>
        <!-- Col End -->
        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <div class="spa-counter-list">
            <div class="spa-counter-list-inner">
              <big>{{ $settings['oil_poured'] ?? '' }}</big>
              <div class="spa-counter-list-title">oz. of massage oil poured</div>
            </div>
          </div>
        </div>
        <!-- Col End -->
        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
          <div class="spa-counter-list">
            <div class="spa-counter-list-inner">
              <big>{{ $settings['basalt_stones_used'] ?? '' }}</big>
              <div class="spa-counter-list-title">Basalt stones used</div>
            </div>
          </div>
        </div>
        <!-- Col End -->
      </div>
    </div>
  </section>
  <!-- Spa Counter Section End -->

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

  <section class="spa-reservation-section">
    <div class="container">
      <div class="row">

        <div class="col-xl-5 col-lg-5">
          <div class="spa-video-box">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/M80Fi6Mf-H4?si=UQT3A8wnXTmdSsCj" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;" allowfullscreen></iframe>

          </div>
        </div>

        <div class="col-xl-7 col-lg-7">
          <div class="spa-form-title">Reservation</div>
          <div class="spa-form-subtitle">Book Your Unforgettable Pleasure Time</div>

          <form id="spa_form" action="{{ route('spaReservation')}}" method="POST">
            @csrf
            <div class="mb-4">
              <label for="your-name-field" class="form-label">Your Name<sup>*</sup></label>
              <input type="text" name="name" id="name" class="form-control validate[required,minSize[2],maxSize[50]]" />
              @if ($errors->has('name'))
              <span class="text-danger"> {{ $errors->first('name') }} </span>
              @endif
            </div>

            <div class="mb-4">
              <label for="your-email-field" class="form-label">Your Email<sup>*</sup></label>
              <input type="email" name="email" id="email" class="form-control validate[required,custom[email]]" />
              @if ($errors->has('email'))
              <span class="text-danger"> {{ $errors->first('email') }} </span>
              @endif
            </div>

            <div class="mb-4">
              <label for="your-email-field" class="form-label">Phone<sup>*</sup></label>
              <div class="mb-3 input-group banquet-contact">
                <span class="input-group-text" id="basic-addon1">
                  <img src="{{ asset('img/india-flag.jpg')}}" alt="India Flag Image">&nbsp; +91
                </span>
              <input type="text" name="phone" id="phone" minlength="10" maxlength="10" class="form-control phone validate[required,maxSize[10],minSize[10]]" />
              </div>
              @if ($errors->has('phone'))
              <span class="text-danger"> {{ $errors->first('phone') }} </span>
              @endif
            </div>

            <div class="row">
              <div class="mb-4 col-md-6 col-sm-6">
                <label class="form-label" for="start-date">Start Date<sup>*</sup></label>
                <div class="datepicker-field">
                  <input type="date" name="start_date" id="sdate-field" class="form-control sdate" min="<?php echo date('Y-m-d'); ?>" onkeydown="return false" value="<?php echo date('Y-m-d'); ?>" />
                  @if ($errors->has('start_date'))
                  <span class="text-danger"> {{ $errors->first('start_date') }} </span>
                  @endif
                </div>
              </div>

              <div class="mb-4 col-md-6 col-sm-6">
                <label class="form-label" name="end_date" for="end-date">End Date<sup>*</sup></label>
                <div class="datepicker-field">
                  <input type="date" name="end_date" id="edate-field" class="form-control edate" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" onkeydown="return false" />
                  @if ($errors->has('end_date'))
                  <span class="text-danger">{{ $errors->first('end_date') }}</span>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="mb-4 col-md-6 col-sm-6">
                <label class="form-label" for="start-time">Start Time<sup>*</sup></label>
                <div class="timepicker-field">
                  <input type="time" name="start_time" class="form-control stime" min="<?php date_default_timezone_set('Asia/Kolkata');
                                                                                        echo date('H:i'); ?>" value="<?php date_default_timezone_set('Asia/Kolkata');
                                                                                                                                                                      echo date('H:i'); ?>" id="start-time">
                  @if ($errors->has('start_time'))
                  <span class="text-danger">{{ $errors->first('start_time') }}</span>
                  @endif
                </div>
              </div>

              <div class="mb-4 col-md-6 col-sm-6">
                <label class="form-label" for="end-time">End Time<sup>*</sup></label>
                <div class="timepicker-field">
                  <input type="time" name="end_time" class="form-control etime" min="<?php date_default_timezone_set('Asia/Kolkata');
                                                                                      echo date('H:i'); ?>" value="<?php date_default_timezone_set('Asia/Kolkata');
                                                                                                                                                                    echo date('H:i', time() + 3600); ?>" id="end-time">
                  @if ($errors->has('end_time'))
                  <span class="text-danger">{{ $errors->first('end_time') }}</span>
                  @endif
                </div>
              </div>
            </div>

            <div class="row align-items-center">
              <div class="mb-4 col-md-6 col-sm-6">
                <label class="form-label" for="start-time"># PEOPLE<sup>*</sup></label>
                <div class="man-icon-list">
                  <div class="man-icon-list-item active"></div>
                  <div class="man-icon-list-item"></div>
                  <div class="man-icon-list-item"></div>
                  <div class="man-icon-list-item"></div>
                  <div class="man-icon-list-item"></div>
                  <div class="man-icon-list-item"></div>

                  <div class="man-icon-list-number" id="selectedPeople">1</div>
                  <input type="hidden" name="selectedPeople" id="selectedPeopleInput" value="1">
                </div>
              </div>

              <div class="mb-4 col-md-6 col-sm-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">I have more than 6 people in my party</label>
                </div>
              </div>
              @if ($errors->has('selectedPeople'))
              <span class="text-danger">{{ $errors->first('selectedPeople') }}</span>
              @endif
            </div>

            <div class="mb-5">
              <label for="message-field" class="form-label">Special Requests<sup>*</sup></label>
              <textarea name="request_message" id="message-field" class="form-control validate[required]" rows="6" ></textarea>

              @if ($errors->has('request_message'))
              <span class="text-danger">{{ $errors->first('request_message') }}</span>
              @endif
            </div>

            <div class="mb-4">
              <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
              @if ($errors->has('g-recaptcha-response'))
              <span class="text-danger"> {{ $errors->first('g-recaptcha-response') }} </span>
              @endif
              <span class="captcha_err"></span>
            </div>

        </div>

        <div class="text-center">
          <button id="submit_btn" type="button" class="btn btn-primary">Make Reservation</button>
        </div>

        </form>
      </div>

    </div>
    </div>
  </section>

  <section class="spa-about-section">
    <div class="container">
      <div class="row">

        <!-- col Start -->
        <div class="col-xl-7 col-lg-6">
          <div class="spa-about-inner">
            <div class="spa-about-title">About us</div>

            <p>Certain but she but shyness why cottage. Gay the put instrument sir entreaties affronting. Pretended exquisite see cordially the you. Weeks quiet do vexed or whose. Motionless if no to affronting imprudence</p>

            <p>By impossible of in difficulty discovered celebrated ye. Justice joy manners boy met resolve produce. Bed head loud next plan rent had easy add him. As earnestly shameless elsewhere defective estimable fulfilled of. Esteem my advice it an excuse enable. Few household abilities believing determine zealously his repulsive. To open draw dear be by side like.</p>

            <button type="submit" class="btn btn-primary">reservation inquiry</button>

          </div>
        </div>
        <!-- col End -->

        <!-- col Start -->
        <div class="col-xl-5 col-lg-6">
          <div class="spa-onoff-box">
            <!-- 1 Start -->
            <div class="spa-onoff-list">
              <small>Monday</small>
              <span>9:00 — 21:00</span>
            </div>
            <!-- 1 End -->
            <!-- 1 Start -->
            <div class="spa-onoff-list">
              <small>Tuesday</small>
              <span>9:00 — 21:00</span>
            </div>
            <!-- 1 End -->
            <!-- 1 Start -->
            <div class="spa-onoff-list">
              <small>Wednesday</small>
              <span>9:00 — 21:00</span>
            </div>
            <!-- 1 End -->
            <!-- 1 Start -->
            <div class="spa-onoff-list">
              <small>Thursday</small>
              <span>8:00 — 23:00</span>
            </div>
            <!-- 1 End -->
            <!-- 1 Start -->
            <div class="spa-onoff-list">
              <small>Friday</small>
              <span>8:00 — 23:00</span>
            </div>
            <!-- 1 End -->
            <!-- 1 Start -->
            <div class="spa-onoff-list">
              <small>Saturday</small>
              <span>8:00 — 23:00</span>
            </div>
            <!-- 1 End -->
            <!-- 1 Start -->
            <div class="spa-onoff-list">
              <small>Sunday</small>
              <span>8:00 — 23:00</span>
            </div>
            <!-- 1 End -->
          </div>
        </div>
        <!-- col End -->

      </div>
    </div>
  </section>

  <section class="spa-menu-section">
    <div class="container">
      <div class="sub-title">Spa Menu</div>
      <div class="section-title">Packages</div>


      <div class="spa-menu-listing">


        <!-- 01 Start -->
        <div class="spa-menu-list">
          <div class="spa-menu-number">01</div>
          <div class="row">

            <!-- col Start -->
            <div class="col-xl-6 col-lg-6">
              <div class="spa-menu-photo">
                <img src="img/spa-menu-img.jpg" alt="Image" class="img-fluid">
              </div>
            </div>
            <!-- col End -->

            <!-- col Start -->
            <div class="col-xl-6 col-lg-6">
              <div class="spa-menu-detail">
                <div class="spa-menu-title">Shiatsu</div>
                <p>A form of physical therapy for the whole body. Shiatsu techniques include massages with fingers, thumbs, feet and palms; assisted stretching; and joint manipulation and mobilization.</p>

                <div class="spa-menu-footer">
                  <span>$130 / 30 MIN.</span>
                  <button type="submit" class="btn btn-primary">MORE DETAILS</button>
                </div>
              </div>
            </div>
            <!-- col End -->

          </div>
        </div>
        <!-- 01 End -->

        <!-- 01 Start -->
        <div class="spa-menu-list">
          <div class="spa-menu-number">02</div>
          <div class="row">

            <!-- col Start -->
            <div class="col-xl-6 col-lg-6 order-lg-last">
              <div class="spa-menu-photo">
                <img src="img/spa-menu-img2.jpg" alt="Image" class="img-fluid">
              </div>
            </div>
            <!-- col End -->

            <!-- col Start -->
            <div class="col-xl-6 col-lg-6">
              <div class="spa-menu-detail">
                <div class="spa-menu-title">Thai</div>
                <p>Generally speaking, givers of modern Thai massage operate on the hypothesis that the body is permeated with "lom", or "air", which is inhaled into the lungs and subsequently travels throughout the body along 72,000 pathways called "sen", which therapists manipulate manually.</p>

                <div class="spa-menu-footer">
                  <span>$140 / 80 MIN.</span>
                  <button type="submit" class="btn btn-primary">MORE DETAILS</button>
                </div>
              </div>
            </div>
            <!-- col End -->

          </div>
        </div>
        <!-- 01 End -->


        <!-- 01 Start -->
        <div class="spa-menu-list">
          <div class="spa-menu-number">03</div>
          <div class="row">

            <!-- col Start -->
            <div class="col-xl-6 col-lg-6">
              <div class="spa-menu-photo">
                <img src="img/spa-menu-img3.jpg" alt="Image" class="img-fluid">
              </div>
            </div>
            <!-- col End -->

            <!-- col Start -->
            <div class="col-xl-6 col-lg-6">
              <div class="spa-menu-detail">
                <div class="spa-menu-title">Swedish</div>
                <p>The most widely recognized and commonly used category of massage is the Swedish massage. Swedish massage has shown to be helpful in reducing pain, joint stiffness, and improving function in patients with osteoarthritis of the knee over a period of eight weeks.</p>

                <div class="spa-menu-footer">
                  <span>$115 / 60 MIN.</span>
                  <button type="submit" class="btn btn-primary">MORE DETAILS</button>
                </div>
              </div>
            </div>
            <!-- col End -->

          </div>
        </div>
        <!-- 01 End -->

        <!-- 01 Start -->
        <div class="spa-menu-list">
          <div class="spa-menu-number">04</div>
          <div class="row">

            <!-- col Start -->
            <div class="col-xl-6 col-lg-6 order-lg-last">
              <div class="spa-menu-photo">
                <img src="img/spa-menu-img4.jpg" alt="Image" class="img-fluid">
              </div>
            </div>
            <!-- col End -->

            <!-- col Start -->
            <div class="col-xl-6 col-lg-6">
              <div class="spa-menu-detail">
                <div class="spa-menu-title">Stone</div>
                <p>A stone massage uses cold or water-heated stones to apply pressure and heat to the body. Stones coated in oil can also be used by the therapist delivering various massaging strokes. The hot stones used are commonly Basalt stones (or lava rocks) which over time have become extremely polished and smooth. As the stones are placed along the recipient's back, they help to retain heat which then deeply penetrates into the muscles.</p>

                <div class="spa-menu-footer">
                  <span>$170 / 80 MIN</span>
                  <button type="submit" class="btn btn-primary">MORE DETAILS</button>
                </div>
              </div>
            </div>
            <!-- col End -->

          </div>
        </div>
        <!-- 01 End -->


      </div>



    </div>
  </section>

</main>

@include('layouts.footer')
<script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
  $('#testimonials-slider').owlCarousel({
    loop: true,
    nav: true,
    navText: ["<img src='img/slider-left-icon.png'>", "<img src='img/slider-right-icon.png'>"],
    dots: false,
    items: 1,
    autoplay: true,
    smartSpeed: 2000,
    autoplayTimeout: 4000,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1
      }
    }
  })
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $("#my-gallery-container").mpmansory({
      childrenClass: 'item', // default is a div
      columnClasses: 'padding', //add classes to items
      breakpoints: {
        xl: 4,
        lg: 4,
        md: 6,
        sm: 6
      },
      distributeBy: {
        order: false,
        height: false,
        attr: 'data-order',
        attrOrder: 'asc'
      }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
      onload: function(items) {
        //make somthing with items
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    //update end date
    $('.sdate').on('change', function() {
      startdate = $(this).val()
      $('.edate').val(moment(startdate).format("YYYY-MM-DD"))
      $('.edate').attr("min", moment(startdate).format("YYYY-MM-DD"));
    });

    // $('.stime').on('change',function(){
    //     starttime = $(this).val() 
    //     console.log(starttime);
    //     $('.etime').val(moment(starttime).add({hours: 1}).format("HH:mm"))
    //     $('.etime').attr("min",moment(starttime).add({hours: 1}).format("HH:mm"));
    // });

    let selectedPeople = 1;

    function updateSelectedPeopleCount() {
      $(".man-icon-list-number").text(selectedPeople);
      $("#selectedPeopleInput").val(selectedPeople);
    }

    function disableManIcons() {
      $(".man-icon-list-item").removeClass("active").addClass("disabled");
      selectedPeople = "6+";
      updateSelectedPeopleCount();
    }

    $(".man-icon-list-item").click(function() {
      if ($(this).hasClass("disabled")) {
        return; // Do nothing if the icon is disabled
      }

      const index = $(this).index() + 1; // +1 because index is 0-based

      selectedPeople = index;

      $(".man-icon-list-item").removeClass("active");
      $(".man-icon-list-item:nth-child(-n+" + index + ")").addClass("active");

      updateSelectedPeopleCount();
    });

    $("#flexCheckDefault").change(function() {
      if (this.checked) {
        disableManIcons();
      } else {
        selectedPeople = 1;
        updateSelectedPeopleCount();
        $(".man-icon-list-item").removeClass("disabled");
        $(".man-icon-list-item:nth-child(1)").addClass("active");
      }
    });


    $("#submit_btn").click(function(e) {
      var is_Validate  = $('#spa_form').validationEngine('validate');

      console.log(is_Validate);
      if(is_Validate === false){
      }else if (grecaptcha.getResponse().length == 0) {
        $('.captcha_err').text('Please complete the reCAPTCHA challenge.')
      }else if (is_Validate === true) {
        Swal.fire({
          title: '',
          text: 'Please wait while processing...',
          icon: 'info',
          timer: 3000, // Show this message for 3 seconds
          timerProgressBar: true,
          showConfirmButton: false
        }).then(function() {
          $('#spa_form').submit();
        });
      } else {
        console.log('Invalid entries');
      }
    });

  });
</script>


@endsection