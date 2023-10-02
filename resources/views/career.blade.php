@extends('layouts.layout')
@section('content')
@include('layouts.header')

<main class="web-main">

    <!-- Page Title Section Start -->
    <section class="page-title-section" style="background-image:url(img/career-banner-img.jpg);">
        <div class="container">
            <div class="page-title">Current Openings</div>
        </div>
    </section>
    <!-- Page Title Section End -->

    <!-- Vacancies Listing Section Start -->
    <section class="vacancies-listing-section">
        <div class="container">

            <!-- Vacancies List Start -->
            @foreach ($career as $item)
            @if (count($career) == 0)
            <div class="vacancies-list">
                <div class="vacancies-list-left">
                    <div class="vacancies-name">No Openings Available</div>
                </div>
            </div>
            @else
            @if ($item->selected_website == 1)
            <div class="vacancies-list">
                <div class="vacancies-list-left">
                    <div class="vacancies-name"><span>{{ $item->job_title }}</span></div>
                    <div class="vacancies-position">{{ $item->department }}</div>
                    <div class="vacancies-loc-time">
                        <span>{{ $item->experience }}</span>
                        <span>{{ $item->location }}

                        </span>
                    </div>

                    <?php $des_text = strip_tags($item->description); ?>
                    @if(strlen($des_text) > 101 && $item['room_category'] != "suite")
                    {!! substr($des_text,0,101) !!}
                    <span class="read-more-show hide_content"> Read More</span>
                    <span class="read-more-content">{!! substr($des_text,101,strlen($des_text))!!}
                        <span class="read-more-hide hide_content"> Less </span>
                        @else
                        {{$des_text}}
                        @endif


                </div>

                <div class="vacancies-list-right">
                    <a href="#career_form" class="apply-now">Apply Now
                      <svg height="24px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M322.7,128.4L423,233.4c6,5.8,9,13.7,9,22.4c0,8.7-3,16.5-9,22.4L322.7,383.6c-11.9,12.5-31.3,12.5-43.2,0  c-11.9-12.5-11.9-32.7,0-45.2l48.2-50.4h-217C93.7,288,80,273.7,80,256c0-17.7,13.7-32,30.6-32h217l-48.2-50.4  c-11.9-12.5-11.9-32.7,0-45.2C291.4,115.9,310.7,115.9,322.7,128.4z"/></svg>
                    </a>
                </div>

            </div>
            @endif
            @endif
            @endforeach
            <!-- Vacancies List End -->
            <!-- 
            <div class="please-contact">
                <p>If you have any more questions, for further inquiries please contact :- <a href="mailto:{{ $settings['tradefair_email'] ?? '' }}">{{ $settings['tradefair_email'] ?? '' }}</span></a>
                </p>
            </div> -->
        </div>
    </section>
    <!-- Vacancies Listing Section End -->

    <section class="meeting-contact-form">
        <div class="container">
            <form action="{{ url('save-career-details') }}" id="career_form" method="POST" class="form-style form-validate" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <h4 class="con-form-title">Career Form</h4>
                <input type="hidden" name="job_type" class="job_type" value="" />

                <div class="row" data-select2-id="select2-data-4-m7li">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userfirstName" class="form-label">First Name<sup>*</sup></label>
                            <input name="first_name" type="text" class="form-control validate[required,minSize[2],maxSize[50]]" id="userfirstName" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userlastName" class="form-label">Last Name<sup>*</sup></label>
                            <input name="last_name" type="text" class="form-control validate[required,minSize[2],maxSize[50]]" id="userlastName" placeholder="">
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email<sup>*</sup></label>
                            <input name="email" type="email" class="form-control validate[required,custom[email]]" id="userEmail" placeholder="">
                        </div>
                    </div>



                    <div class="col-lg-6 ">

                        <label for="myTextBox" class="form-label">Phone Number<sup>*</sup></label>
                        <div class="mb-3 input-group banquet-contact">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{asset('img/india-flag.jpg')}}" alt="India Flag Image">&nbsp; +91
                            </span>
                            <input type="text" name="phone" id="Phone-Number" minlength="10" maxlength="10" class="form-control phone validate[required,maxSize[10],minSize[10]]" />
                            <label class="error p_err"></label>
                        </div>

                        <!-- OTP code -->
                        @include('otp')
                        <!-- OTP code -->
                    </div>



                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('job_title') ?'has-error' : ''}}">
                            <label class="form-label" for="job_title">Job Title <span class="valid-icon">*</span></label>

                            <select class="form-select subject-box validate[required]" id="job_title" rows="4" name="job_title" value="">
                                <option value="" disabled="disabled" selected>Select Job Title</option>
                                <option value="event_planner">Event Planner</option>
                                <option value="executive_chef">Executive Chef</option>
                                <option value="hotel_general_manager">Hotel General Manager</option>
                                <option value="housekeeper">Housekeeper</option>
                                <option value="porter">Porter</option>
                                <option value="waiter">Waiter/Waitress</option>
                                <option value="gate_keeper">Gate Keeper</option>
                                <option value="receptionist">Receptionist</option>
                                <option value="marketing_manager">Marketing Manager</option>
                                <option value="talent_manager">Talent Manager</option>
                                <option value="reservation_agent">Reservation Agent</option>
                            </select>

                            <p id="subject-box-text"></p>
                            @if ($errors->has('job_title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('job_title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('qulification') ?'has-error' : ''}}">
                            <label class="form-label" for="qulification">Qualification <span class="valid-icon">*</span></label>
                            <input class="form-control subject-box validate[required]" id="qulification" rows="4" name="qulification" value="" placeholder="Qualification">
                            @if ($errors->has('qulification'))
                            <span class="help-block">
                                <strong>{{ $errors->first('qulification') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group {{ $errors->has('job_location') ?'has-error' : ''}}">
                            <label class="form-label" for="job_location"> Job Location <span class="valid-icon">*</span></label>
                            <input class="form-control subject-box validate[required]" id="job_location" rows="4" name="job_location" value="" placeholder="Job Location">
                            @if ($errors->has('job_location'))
                            <span class="help-block">
                                <strong>{{ $errors->first('job_location') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group {{ $errors->has('job_position') ?'has-error' : ''}}">
                            <label class="form-label" for="job_position">Job Position <span class="valid-icon">*</span></label>
                            <select class="form-select subject-box validate[required]" id="job_position" rows="4" name="job_position" value="">
                                <option value="" disabled="disabled" selected>Select Job Position</option>
                                <option value="part_time">Part Time</option>
                                <option value="full_time">Full Time</option>
                            </select>
                            @if ($errors->has('job_position'))
                            <span class="help-block">
                                <strong>{{ $errors->first('job_position') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group {{ $errors->has('experience') ?'has-error' : ''}}">
                            <label class="form-label" for="experience">Experience <span class="valid-icon">*</span></label>
                            <select class="form-select custom-select validate[required]" id="experience" placeholder="Enter Experience" name="experience">
                                <option value="" disabled="disabled" selected>Select Experience</option>
                                <option value="0-3">0-3 Years</option>
                                <option value="3-5">3-5 Years</option>
                                <option value="5-10">5-10 Years</option>
                                <option value="10+">10+</option>
                            </select>
                            @if ($errors->has('experience'))
                            <span class="help-block">
                                <strong>{{ $errors->first('experience') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <div class="form-group ">
                            <label for="message-field" class="form-label">Captcha<span aria-label="required" class="text-danger">*</span></label>
                            <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger"> {{ $erros->first('recaptcha') }} </span>
                            @endif
                            <span class="captcha_err text-danger"></span>


                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label not-active">Upload Attachment <span class="valid-icon">*</span></label>
                            <div class="dropzone-wrapper">
                                <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cloud-upload-alt" class="svg-inline--fa fa-cloud-upload-alt fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path fill="currentColor" d="M537.6 226.6c4.1-10.7 6.4-22.4 6.4-34.6 0-53-43-96-96-96-19.7 0-38.1 6-53.3 16.2C367 64.2 315.3 32 256 32c-88.4 0-160 71.6-160 160 0 2.7.1 5.4.2 8.1C40.2 219.8 0 273.2 0 336c0 79.5 64.5 144 144 144h368c70.7 0 128-57.3 128-128 0-61.9-44-113.6-102.4-125.4zM393.4 288H328v112c0 8.8-7.2 16-16 16h-48c-8.8 0-16-7.2-16-16V288h-65.4c-14.3 0-21.4-17.2-11.3-27.3l105.4-105.4c6.2-6.2 16.4-6.2 22.6 0l105.4 105.4c10.1 10.1 2.9 27.3-11.3 27.3z"></path>
                                    </svg>
                                    <span class="" id="img-name">Select a file</span>

                                </div>
                                <input type="file" name="resume" class="dropzone validate[required, custom[validateMIME[pdf|doc|docx]]]" id="myInput">
                                <span class="file_error"></span>
                            </div>

                        </div>


                    </div>

                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" id="submit-career-form">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

@include('messages')
@include('layouts.footer')
<!-- <script src="{{ asset('js/custom.js') }}"></script> -->
<script>
    $(document).ready(function() {
        $('.vacancies-listing-section .vacancies-list').each(function(key, value) {

            if (key == 0) {
                $('.job_type').val($(value).find('.vacancies-name span').text());
            }
           
        });

        $('.vacancies-listing-section .vacancies-list').click(function(){
            $('.job_type').val($(this).find('.vacancies-name span').text());
      });

        $("#submit-career-form").click(function(e) {

            var is_validate = $('#career_form').validationEngine('validate');
            var is_phone_verified = localStorage.getItem("isVerify") ? localStorage.getItem("isVerify") : false;
 
            if (is_validate == false || is_validate == "false") {} else if (grecaptcha.getResponse().length == 0) {
                $('.captcha_err').text('Please complete the reCAPTCHA challenge.')
            } else if (is_phone_verified == false || is_phone_verified == "false") {
                $('#unsuccess-popups .errormessage').text('Please Verify Your Phone Number');
                $('#unsuccess-popups').modal('show');
            } else if (is_validate == true) {
                Swal.fire({
                    title: '',
                    text: 'Please wait while processing...',
                    icon: 'info',
                    timer: 3000, // Show this message for 3 seconds
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(function() {
                    $('#career_form').submit()
                });
            }
        });
    });
</script>
@endsection