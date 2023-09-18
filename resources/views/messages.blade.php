
<!-- Success Modal -->
<div class
="modal fade normal-popup success-popups" id="success-popups" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="message-top-icon">
          <i class="fa fa-thumbs-up" aria-hidden="true"></i>
        </div>
        <div class="modal-sub-title">Success</div>
        <img src="{{ env('BACKEND_URL').'public/img/line-check.png' }}" alt="Img" class="img-fluid">
        <p class="successmessage"></p>
        <button type="button" class="btn btn-dark " data-bs-dismiss="modal"><span>Ok</span></button>
      </div>
    </div>
  </div>
</div>

<!--when restaurant status is changed Success Modal -->
<div class="modal fade normal-popup success-popups status-success-popups" id="status-success-popups" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="message-top-icon">
          <i class="fa fa-thumbs-up" aria-hidden="true"></i>
        </div>
        <div class="modal-sub-title">Success</div>
        <img src="{{env('BACKEND_URL').'public/img/line-check.png'}}" alt="Img" class="img-fluid">
        <p class="successmessage"></p>
      </div>
    </div>
  </div>
</div>


<!--pending Success Modal -->
<div class="modal fade normal-popup pending-popups" id= "pending-popups" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="message-top-icon">
          <i class="fa fa-clock-o" aria-hidden="true"></i>
        </div>
         <div class="modal-sub-title">Pending</div>
        <img src="{{env('BACKEND_URL').'public/img/pending-icon.png'}}" alt="Img" class="img-fluid">
        <p class="pendingmessage">Under Processing</p>
        <button type="button" class="btn btn-dark " data-bs-dismiss="modal"><span>Ok</span></button>
      </div>
    </div>
  </div>
</div>

<!--OTP Success Modal -->

<div class="modal fade normal-popup OTP-popups" id="OTP-popups" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="OTP-popupsLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
         <div class="modal-sub-title">Enter OTP</div>
        <div class="row">
          <div class="otp-input">
            <div class="passcode-wrapper">
              <input id="codeBox1" type="text" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" maxlength="1">
              <input id="codeBox2" type="text" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" maxlength="1">
              <input id="codeBox3" type="text" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" maxlength="1">
              <input id="codeBox4" type="text" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" maxlength="1">
            </div>
            <span class="invalid_otp"></span>
          </div>
          <div class="second-verify-btn otp-input" style="display: none;"><button type="button" class="btn btn-info verify-btn" style="height:40px;" ><span class="spinner-border spinner-border-sm" id="otp-verify-btn" style="display:none; margin: 0 5px;"></span>Verify</button></div>
          <div class="verify-btn"><button type="button" class="btn btn-primary">verify</button></div>
          <div class="resend-otp"><a class="resend-otp-btn">Resend OTP</a></div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--review Success Modal -->
<div class="modal fade normal-popup review-success-popups" id="review-success-popups" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="message-top-icon">
         <img src="{{ env('BACKEND_URL').'public/img/review-icon.png' }}" style="margin-top:-10px;" alt="review  icon"/>
        </div>
        <div class="modal-sub-title">Success</div>
        <img src="{{ env('BACKEND_URL').'public/img/line-check.png'}}" alt="Img" class="img-fluid">
        <p class="successmessage"></p>
        <button type="button" class="btn btn-dark " data-bs-dismiss="modal"><span>Ok</span></button>
      </div>
    </div>
  </div>
</div>

<!-- Unsuccess Modal -->
<div class="modal fade normal-popup unsuccess-popups" id="unsuccess-popups" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="message-top-icon">
          <i class="fa fa-thumbs-down" aria-hidden="true"></i>
        </div>
         <div class="modal-sub-title">Error</div>
        <img src="{{asset('img/line-close.png') }}" alt="Img" class="img-fluid">
        <p class="errormessage"></p>
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><span>Ok</span></button>
      </div>
    </div>
  </div>
</div>

<!-- Information Modal -->
<div class="modal fade normal-popup information-popups" id="information-popups" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="message-top-icon">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
        </div>
         <div class="modal-sub-title">Notice</div>
        <img src="{{ env('BACKEND_URL').'public/img/info-icon.png'}}" alt="Img" class="img-fluid">
        <p class="successmessage"></p>
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><span>Ok</span></button>
      </div>
    </div>
  </div>
</div>
