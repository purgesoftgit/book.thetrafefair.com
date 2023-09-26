@extends('layouts.layout')
@section('content')
@include('layouts.header')

<main class="web-main">

    <main class="web-main">

        <!-- Page Title Section Start -->
        <section class="page-title-section" style="background-image:url(img/wedding-banner.jpg);">
            <div class="container">
                <div class="page-title">TTF Wedding</div>
            </div>
        </section>
        <!-- Page Title Section End -->

        <section class="about-wedding">
            <div class="container">
                <div class="about-wedding-title">The Trade Fair</div>
                <p>A wedding with us has meant something special for generations. Elevate your big day into a memorable and momentous celebration with our iconic repertoire of grand palaces, world class resorts and iconic properties. Make your dreams come true with The Trade Fair.</p>

                <div class="about-wedding-video">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/IlhOWmG8FZU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </section>

        <section class="wedding-gallery">
            <div class="container">
                <div class="wedding-gallery-title">Wedding Photo Gallery</div>
                <p class="m-0 wd-g-link">
                    <a href="#">Beautiful Picture</a>
                    <span>|</span>
                    <a href="#">Splendid idea</a>
                    <span>|</span>
                    <a href="#">Real Weddings</a>
                </p>
                <p class="mb-5">Exotic collection of thousands of pictures! Choose by color, theme, location, category & much more!</p>

                <div class="row gx-2">
                    <div class="col-xl-4">
                        <div class="wedding-gallery-list">
                            <a href="img/wedding-gallery-img.jpg" class="fancybox" data-fancybox="demo" rel="images-repeat" data-caption="Iconic city destination for a dream">
                                <img src="img/wedding-gallery-img.jpg" alt="image" class="img-fluid">
                            </a>
                            <span>Iconic city destination for a dream</span>
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <div class="wedding-gallery-list height50per">
                            <a href="img/wedding-gallery-img2.jpg" class="fancybox" data-fancybox="demo" rel="images-repeat" data-caption="Iconic city destination for a dream wedding">
                                <img src="img/wedding-gallery-img2.jpg" alt="image" class="img-fluid">
                            </a>
                            <span>Iconic city destination for a dream wedding</span>
                        </div>

                        <div class="wedding-gallery-list height50per">
                            <a href="img/wedding-gallery-img3.jpg" class="fancybox" data-fancybox="demo" rel="images-repeat" data-caption="Iconic city destination for a dream wedding 2">
                                <img src="img/wedding-gallery-img3.jpg" alt="image" class="img-fluid">
                            </a>
                            <span>Iconic city destination for a dream wedding2</span>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="wedding-gallery-list height50per">
                            <a href="img/wedding-gallery-img4.jpg" class="fancybox" data-fancybox="demo" rel="images-repeat" data-caption="Iconic city destination">
                                <img src="img/wedding-gallery-img4.jpg" alt="image" class="img-fluid">
                            </a>
                            <span>Iconic city destination</span>
                        </div>

                        <div class="wedding-gallery-button d-grid">
                            <button type="button" class="btn btn-primary">Get Inspired</button>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="exp-tim-wed-section">
            <div class="container">
                <div class="wedding-gallery-title">experience timeless wedding</div>
                <p class="mb-4">With The Trade Fair let your celebration be the beginning of a legacy of romance that generations ahead will listen.</p>
            </div>

            <div class="exp-tim-wed-slider">
                <div class="container">
                    <div class="owl-carousel owl-theme" id="exp-tim-wed-slider">
                        <!-- Items Start -->
                        <div class="item">
                            <img src="img/exp-tim-wed-img.jpg" alt="image">
                            <div class="exp-tim-wed-inner">
                                <div class="exp-tim-wed-title">The Perfect Proposal</div>

                                <div class="exp-tim-wed-text-btn">
                                    <div class="exp-tim-wed-left">
                                        <p>Confess your love with a proposal of a new beginning together.</p>
                                    </div>
                                    <div class="exp-tim-wed-right">
                                        <button type="button" class="btn btn-primary">View Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Items End -->
                        <!-- Items Start -->
                        <div class="item">
                            <img src="img/exp-tim-wed-img2.jpg" alt="image">
                            <div class="exp-tim-wed-inner">
                                <div class="exp-tim-wed-title">The Perfect Proposal</div>

                                <div class="exp-tim-wed-text-btn">
                                    <div class="exp-tim-wed-left">
                                        <p>Confess your love with a proposal of a new beginning together.</p>
                                    </div>
                                    <div class="exp-tim-wed-right">
                                        <button type="button" class="btn btn-primary">View Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Items End -->
                        <!-- Items Start -->
                        <div class="item">
                            <img src="img/exp-tim-wed-img3.jpg" alt="image">
                            <div class="exp-tim-wed-inner">
                                <div class="exp-tim-wed-title">The Perfect Proposal</div>

                                <div class="exp-tim-wed-text-btn">
                                    <div class="exp-tim-wed-left">
                                        <p>Confess your love with a proposal of a new beginning together.</p>
                                    </div>
                                    <div class="exp-tim-wed-right">
                                        <button type="button" class="btn btn-primary">View Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Items End -->
                        <!-- Items Start -->
                        <div class="item">
                            <img src="img/exp-tim-wed-img2.jpg" alt="image">
                            <div class="exp-tim-wed-inner">
                                <div class="exp-tim-wed-title">The Perfect Proposal</div>

                                <div class="exp-tim-wed-text-btn">
                                    <div class="exp-tim-wed-left">
                                        <p>Confess your love with a proposal of a new beginning together.</p>
                                    </div>
                                    <div class="exp-tim-wed-right">
                                        <button type="button" class="btn btn-primary">View Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Items End -->

                    </div>
                </div>
            </div>
        </section>

        <section class="venue-finder-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="venue-finder-left">
                            <div class="venue-finder-title">Venue Finder</div>
                            <p>The Trade Fair Wedding let your celebration be the beginning of a legacy of romance that generations ahead will listen.</p>
                        </div>
                    </div>

                    <div class="col-xl-9">
                        <div class="owl-carousel owl-theme" id="venue-finder-slider">

                            <!-- Items Start -->
                            <div class="item">
                                <img src="img/venue-finder-img.jpg" alt="image">
                                <div class="venue-finder-inner">
                                    <div class="venue-finder-subtitle">Taj Hotel &amp; Convention Centre, Agra</div>
                                    <button type="button" class="btn btn-dark">View Menu</button>
                                </div>
                            </div>
                            <!-- Items End -->

                            <!-- Items Start -->
                            <div class="item">
                                <img src="img/venue-finder-img2.jpg" alt="image">
                                <div class="venue-finder-inner">
                                    <div class="venue-finder-subtitle">Taj Hotel &amp; Convention Centre, Agra</div>
                                    <button type="button" class="btn btn-dark">View Menu</button>
                                </div>
                            </div>
                            <!-- Items End -->

                            <!-- Items Start -->
                            <div class="item">
                                <img src="img/venue-finder-img3.jpg" alt="image">
                                <div class="venue-finder-inner">
                                    <div class="venue-finder-subtitle">Taj Hotel &amp; Convention Centre, Agra</div>
                                    <button type="button" class="btn btn-dark">View Menu</button>
                                </div>
                            </div>
                            <!-- Items End -->

                            <!-- Items Start -->
                            <div class="item">
                                <img src="img/venue-finder-img2.jpg" alt="image">
                                <div class="venue-finder-inner">
                                    <div class="venue-finder-subtitle">Taj Hotel &amp; Convention Centre, Agra</div>
                                    <button type="button" class="btn btn-dark">View Menu</button>
                                </div>
                            </div>
                            <!-- Items End -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <section class="reachout-form">
                <div class="row">
                    <div class="col-xl-5 align-self-end">
                        <img src="img/reachout-img.jpg" alt="image" class="img-fluid mb-m5">
                    </div>
                    <div class="col-xl-7">
                        <form action="{{ url('save-wedding-enquiry') }}" id="wedding-form" method="POST" class="form-style form-validate" novalidate="novalidate">
                            @csrf
                            <div class="reachout-title">REACH OUT TO US</div>
                            <p>To book your dream wedding, please call {{ $settings['tradefair_contact_number'] ?? ''}} or write {{ $settings['tradefair_email'] ?? '' }}</p>

                            <div class="row">

                                <div class="mb-5 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control validate[required,maxSize[50]]" name="name" id="name-field" placeholder="Name">
                                        <label for="name-field">Name<span aria-label="required" class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="mb-5 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control validate[required,custom[email]]" name="email" id="email-field" placeholder="Email Address">
                                        <label for="email-field">Email Address<span aria-label="required" class="text-danger">*</span></label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="mb-5 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" name="phone" id="Phone-Number" minlength="10" maxlength="10" class="form-control phone validate[required,maxSize[10],minSize[10]]" />
                                        {{-- <input type="number" class="form-control phone-num validate[required,phone,maxSize[10],minSize[10]]" id="mobile-number " maxlength="10" minlength="10" name="phone" placeholder="Mobile Number"> --}}
                                        <label for="mobile-number">Mobile Number<span aria-label="required" class="text-danger">*</span></label>
                                        <label class="error p_err"></label>
                                    </div>

                                    <!-- OTP code -->
                                    @include('otp')
                                    <!-- OTP code -->
                                </div>

                                <div class="mb-5 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control  validate[required]" id="residing-city" name="city" placeholder="Residing City">
                                        <label for="residing-city">Residing City<span aria-label="required" class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-5">
                                <textarea class="form-control validate[required]" name="enquiry" placeholder="Enquiry" id="enquiry-field" style="height: 100px"></textarea>
                                <label for="enquiry-field">Enquiry<span aria-label="required" class="text-danger">*</span></label>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-xl-8 mb-3">
                                    <label for="message-field" class="form-label">Captcha<span aria-label="required" class="text-danger">*</span></label>
                                    <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger"> {{ $erros->first('recaptcha') }} </span>
                                    @endif
                                    <span class="captcha_err text-danger"></span>
                                </div>

                                <div class="col-xl-4 text-end mb-3">
                                    <button type="button" class="btn btn-dark" id="wedding-enquiry-btn">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </section>
        </div>

        </div>
        <!-- Mid Section End -->

    </main>


    @include('messages')
    @include('layouts.footer')
    <script>
        $(document).ready(function() {
            $("#wedding-enquiry-btn").click(function(e) {

                var is_validate = $('#wedding-form').validationEngine('validate');
                var is_phone_verified = localStorage.getItem("isVerify") ? localStorage.getItem("isVerify") : false;

                if (is_validate === false || is_validate == "false") {} else if (grecaptcha.getResponse().length == 0) {
                    $('.captcha_err').text('Please complete the reCAPTCHA challenge.')
                } else if (is_phone_verified == false || is_phone_verified == "false") {
                    $('#unsuccess-popups .errormessage').text('Please Verify Your Phone Number');
                    $('#unsuccess-popups').modal('show');
                } else if (is_validate === true) {
                    Swal.fire({
                        title: '',
                        text: 'Please wait while processing...',
                        icon: 'info',
                        timer: 3000, // Show this message for 3 seconds
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(function() {
                        $('#wedding-form').submit();
                    });

                }
            });
        });
    </script>
    @endsection