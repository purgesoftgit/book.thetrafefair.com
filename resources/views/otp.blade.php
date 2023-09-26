<div class="row mb-3">
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
<!-- 
    <div class="second-verify-btn otp-input" style="display: none;"><button type="button" class="btn btn-info verify-btn" style="height:40px;"><span class="verify-spinner-border spinner-border spinner-border-sm" style="display:none; margin: 0 5px;"></span>Verify</button></div>
    <div class="verify-btn"><button type="button" class="btn btn-primary" style="min-width:70px;">verify</button></div> -->

    <div class="col-lg-6 verify-btn otp-input text-end" style="">
        <!-- <a href="javascript:void(0);" class="btn btn-primary btn-sm verify-btn">verify</a> -->

        <button type="button" class="btn btn-primary btn-sm verify-btn"><span class="verify-spinner-border spinner-border spinner-border-sm" style="display:none; margin: 0 5px;"></span>Verify</button>
    </div>
    <div class="col-lg-6 second-verify-btn  text-end" style="display: none;">
        <!-- <a href="javascript:void(0);" class="btn btn-primary btn-sm verify-btn">verify</a> -->

        <button type="button" class="btn btn-primary btn-sm verify-btn" >verify</button>
    </div>
</div>


<div class="resend-otp" style="display: none;">
    <div class="row mt-2 mb-3 align-items-center">

        <div class="col-md-6" id="resend-otp-block">
            <div class="countdown" id="ten-countdown"></div>
        </div>

        <div class="col-md-6 text-end resend-url-link" data-url="{{ url('resend-otp') }}/">
            <a class="resend-otp-btn" style="display:none;">Resend OTP</a>
            <span class="spinner-border resend-spinner-border spinner-border-sm" style="display:none; margin-left: auto;"></span>
        </div>

    </div>
</div>


<!-- 
<div class="col-lg-6 offset-lg-6">
    <div class="otp-input" style="display: none;">
        <div class="passcode-wrapper">
            <input id="codeBox1" type="text" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" maxlength="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            <input id="codeBox2" type="text" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" maxlength="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            <input id="codeBox3" type="text" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" maxlength="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            <input id="codeBox4" type="text" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" maxlength="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
        </div>

        <span class="invalid_otp"></span>
    </div>
    <div class="second-verify-btn otp-input" style="display: none;"><button type="button" class="btn btn-info verify-btn" style="height:40px;"><span class="verify-spinner-border spinner-border spinner-border-sm" style="display:none; margin: 0 5px;"></span>Verify</button></div>
    <div class="verify-btn"><button type="button" class="btn btn-primary" style="min-width:70px;">verify</button></div>
</div>
 -->


<!-- <div class="col-lg-6 offset-lg-6 resend-otp">
    <div id="resend-otp-block">
        <div class="countdown" id="ten-countdown"></div>
    </div>
    <div><a class="resend-otp-btn" data-url="{{ url('resend-otp') }}/" style="display:none;">Resend OTP</a> <span class="spinner-border resend-spinner-border spinner-border-sm" style="display:none;"></span></div>
</div> -->