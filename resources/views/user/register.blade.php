@extends('layouts.layout')
@section('content')
<style>
</style>
<section class="account-detail-page">


    <div class="container">
        <div class="row g-0 justify-content-center align-items-center">


            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="account-img">
                    <a class="brand-img" href="{{ url('/') }}"><img src="img/logo-blog.png" align="The Trade Fair Brand"></a>
                    <img src="img/destinations-img3.jpg" alt="Image" class="img-fluid">
                    <div class="account-title">Register</div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-7 col-md-8">

                <div class="account-form">

                    <div class="account-form-inner">
                        <!-- <p class="text-danger">Please fill all required fields</p> -->

                        <form id="registationForm" method="POST" action="{{ url('register/store') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" id="first-name-field" name="first_name" placeholder="First Name*" value="{{ old('first_name') }}">
                                <label class="error f_err"></label>
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" id="last-name-field" name="last_name" placeholder="Last Name*" value="{{ old('last_name') }}">
                                <label class="error l_err"></label>
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address*" value="{{ old('email') }}">
                                <label class="error e_err"></label>
                                @error('email')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>


                            <!-- Phone Verification Field Start -->
                            <div id="phoneVerify">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="https://www.thetradeinternational.com/public//img/india-flag.png" alt="India Flag Image">&nbsp; +91
                                    </span>
                                    <input type="text" class="form-control phone_number" style="width: 30%;" name="phone_number" id="Phone-Number" placeholder="Phone Number*" value="{{ old('phone_number') }}">
                                    <label class="error p_err"></label>

                                    @error('phone_number')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    <div class="input-group-append edit-input-group-append" style="display: none;">
                                        <span toggle="#password-field" class="input-group-text field-icon" style="height: 100%;color: #fff;background: #00b542;border-color: #00b542;">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                    </div>
                                    <label for="" id="error"></label>
                                </div>
                                <label for="" class="successMassage"></label>

                                <div class="row align-items-center mb-3">
                                    <div class="col-lg-6 otp-input">
                                        <div class="passcode-wrapper" style="display: none">
                                            <input id="codeBox1" type="text" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)">
                                            <input id="codeBox2" type="text" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)">
                                            <input id="codeBox3" type="text" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)">
                                            <input id="codeBox4" type="text" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)">
                                        </div>
                                        <span class="valid_otp"></span>
                                        <span id="invalid_otp"></span>
                                    </div>

                                    <div class="col-lg-6 first-verify-btn otp-input text-end" style="">
                                        <a href="javascript:void(0);" id="submitButton" class="btn btn-primary btn-sm verify-btn">verify</a>

                                    </div>
                                    <div class="col-lg-6 verify-btn  text-end" id="verifyButton" style="display: none;">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm verify-btn">verify</a>
                                    </div>
                                </div>

                                <div class="resend-otp" style="display: none;">
                                    <div class="row mt-2 mb-3 align-items-center">

                                        <div class="col-md-6" id="resend-otp-block">
                                            <div class="countdown" id="ten-countdown"></div>
                                        </div>

                                        <div class="col-md-6 text-end">
                                            <a class="resend-otp-btn" href="javascript:void(0);" id="submitButton1" style="display:none;">Resend OTP</a>
                                            <span class="spinner-border resend-spinner-border spinner-border-sm" style="display:none; margin-left: auto;"></span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Phone Verification Field End -->

                            <div class="mb-3">
                                <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                                <span class="text-error gc_err" id="recaptchaError"></span>
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger"> {{ $errors->first('recaptcha') }} </span>
                                @endif

                            </div>


                            <div class="form-check last-check">
                                <input class="form-check-input" type="checkbox" name="checkbox_value" id="flexCheckDefault">
                                @error('checkbox_value')
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                                <label class="form-check-label" for="flexCheckDefault">By signing up, I agree
                                    &amp;accept the <a href="#">Terms &amp; Conditions</a> of the The Trade Fair
                                    Hotel</label>
                                <label class="error tc_err"></label>
                            </div>

                            <div class="text-center d-grid gap-3 mt-3 mb-3 " id="registerSubmitButton">
                                <button type="button" id="btn_register" class="btn btn-primary">Register</button>
                            </div>
                            <p class="text-center m-0"><small>Already have an Account? <a href="{{ url('login') }}">Log in</a></small></p>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    @include('messages')

</section>
@endsection