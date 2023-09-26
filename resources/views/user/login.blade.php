@extends('layouts.layout')
@section('content')
<section class="account-detail-page">
    <div class="container">
        <div class="row g-0 justify-content-center align-items-center">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="account-img">
                    <a class="brand-img" href="{{ url('/') }}"><img src="img/logo-blog.png" align="The Trade Fair Brand"></a>
                    <img src="img/destinations-img3.jpg" alt="Image" class="img-fluid">
                    <div class="account-title">Login</div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-7 col-md-8">
                <div class="account-form">
                    <div class="account-form-inner">
                        <div class="form-title">Please login your Phone Number </div>
                        <form action="{{ url('login/verify') }}" method="POST" id="loginForm">
                            @csrf

                            <!-- Phone Verification Field Start -->
                            <div id="phoneVerify">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="https://www.thetradeinternational.com/public//img/india-flag.png" alt="India Flag Image">&nbsp; +91
                                    </span>
                                    <input type="text" class="form-control phone_number phone" minlength="10" maxlength="10" style="width: 30%;" name="phone_number" id="Phone-Number" placeholder="Phone Number*" value="{{ old('phone_number') }}">
                                    <label class="error p_err"></label>

                                    @error('phone_number')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    <!-- <div class="input-group-append edit-input-group-append" style="display: none;">
                                        <span toggle="#password-field" class="input-group-text field-icon" style="height: 100%;color: #fff;background: #00b542;border-color: #00b542;">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                    </div>
                                    <label for="" id="error"></label> -->
                                </div>
                                <label for="" class="successMassage"></label>

                                <!-- OTP code -->
                                @include('otp')
                                <!-- OTP code -->



                                <!-- <div class="row align-items-center mb-3">
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
                                        <a href="javascript:void(0);" id="submitButton" class="btn btn-primary btn-sm login-verify-btn">verify</a>

                                    </div>
                                    <div class="col-lg-6 verify-btn  text-end" id="verifyButton" style="display: none;">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm verify-btn">verify</a>
                                    </div>
                                </div> -->

                                <!-- <div class="resend-otp" style="display: none;">
                                    <div class="row mt-2 mb-3 align-items-center">

                                        <div class="col-md-6" id="resend-otp-block">
                                            <div class="countdown" id="ten-countdown"></div>
                                        </div>

                                        <div class="col-md-6 text-end">
                                            <a class="resend-otp-btn" href="javascript:void(0);" id="submitButton1" style="display:none;">Resend OTP</a>
                                            <span class="spinner-border resend-spinner-border spinner-border-sm" style="display:none; margin-left: auto;"></span>
                                        </div>

                                    </div>
                                </div> -->

                            </div>

                            <!-- Phone Verification Field End -->

                            <div class="text-center d-grid gap-3 mt-3 mb-3">
                                <button type="button" id="btn-login" class="btn btn-primary btn-block">Login</button>
                            </div>

                            <p class="text-center m-0"><small>Don't have an Account? <a href="{{ url('register') }}">Register</a></small></p>
                            <div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('messages')

</section>
<script>
    $(document).ready(function() {
        // var isVerify = false;
        // $('.login-verify-btn').click(function() {
        //     if ($('#Phone-Number').val().length == 0) {
        //         $('.p_err').text("Please enter phone number").css({
        //             'display': 'block'
        //         });
        //     } else if ($('#Phone-Number').val().length != 10) {
        //         $('.p_err').text("Please enter valid phone number").css({
        //             'display': 'block'
        //         });
        //     } else {
        //         var codeBox1 = $("#codeBox1").val();
        //         var codeBox2 = $("#codeBox2").val();
        //         var codeBox3 = $("#codeBox3").val();
        //         var codeBox4 = $("#codeBox4").val();
        //         var codeBox = codeBox1 + codeBox2 + codeBox3 + codeBox4;
        //         $.ajax({
        //             url: "{{ url('register/data/otp') }}",
        //             type: 'get',
        //             data: {
        //                 codeBox: codeBox,
        //                 number: $('#Phone-Number').val()
        //             },
        //             success: function(response) {
        //                 if (response['status'] == 500) {
        //                     isVerify = false
        //                 } else {

        //                     isVerify = true

        //                     $('#verifyButton').hide()
        //                     $(".passcode-wrapper")
        //                         .hide();
        //                     $('#ten-countdown').hide();
        //                     $('.valid_otp').text(
        //                         "Verification Successfully..."
        //                     );
        //                     // $('.valid_otp').show();
        //                     setTimeout(function() {
        //                         $(".valid_otp")
        //                             .hide();
        //                     }, 3000);
        //                     $('#btn_register').prop(
        //                         "disabled", false);
        //                 }
        //             }
        //         });
        //     }

        // })
        var is_phone_verified = localStorage.getItem("isVerify") ? localStorage.getItem("isVerify") : false;
 
        $("#btn-login").click(function() {
           
            // console.log("click");
            // if ($('#Phone-Number').val().length == 0) {
            //     $('.p_err').text("Please enter phone number").css({
            //         'display': 'block'
            //     });
            // } else if ($('#Phone-Number').val().length != 10) {
            //     $('.p_err').text("Please enter valid phone number").css({
            //         'display': 'block'
            //     });
            // } else {
                if (is_phone_verified == false) {
                    $('#unsuccess-popups .errormessage').text('Please Verify Your Phone Number');
                    $('#unsuccess-popups').modal('show');
                } else {
                    $('#loginForm').submit();
                }
            // }
        })
    });
</script>
@endsection