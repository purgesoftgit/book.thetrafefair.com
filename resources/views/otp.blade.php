<div class="row mb-3 mobile-col">
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 otp-input">
        <div class="passcode-wrapper" style="display: none">
            <input id="codeBox1" type="text" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)">
            <input id="codeBox2" type="text" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)">
            <input id="codeBox3" type="text" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)">
            <input id="codeBox4" type="text" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)">
        </div>
        <span class="valid_otp"></span>
        <span id="invalid_otp"></span>
    </div>

    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        <div class="verify-btn otp-input text-end" style="">
            <button type="button" class="btn btn-primary btn-sm verify-btn"><span class="verify-spinner-border spinner-border spinner-border-sm" style="display:none; margin: 0 5px;"></span>Verify</button>
        </div>
        <div class="second-verify-btn  text-end" style="display: none;">
            <button type="button" class="btn btn-primary btn-sm verify-btn" >verify</button>
        </div>
    </div>
</div>


<div class="resend-otp" style="display: none;">
    <div class="row mt-2 mb-3 align-items-center mobile-col">

        <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5" id="resend-otp-block">
            <div class="countdown" id="ten-countdown"></div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 text-end resend-url-link" data-url="{{ url('resend-otp') }}/">
            <a class="resend-otp-btn" style="display:none;">Resend OTP</a>
            <span class="spinner-border resend-spinner-border spinner-border-sm" style="display:none; margin-left: auto;"></span>
        </div>

    </div>
</div>
