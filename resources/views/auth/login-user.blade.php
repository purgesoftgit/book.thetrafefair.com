@extends('layouts.layout')
@section('content')
<style type="text/css">.back-link:hover{color: #eabc59;}.alert-success{padding: 10px;}.resend-spinner-border{color: #929292;margin: 0 5px;width: 25px;height: 25px;}</style>
<div class="container-fluid">
  <div class="login-signup-form">
    <a href="{{url('/')}}" class="back-link"><i class="fa fa-long-arrow-left"></i> <span>Back to Hotel</span></a>
    <div class="text-center">
      <a href="{{ url('/') }}"><img src="{{asset('img/logo.png')}}" alt="The Trade International"></a>
      <h1 class="heading-one">Please login with your Phone Number</h1>
    </div>

    @if($message = Session::get('error'))
    <div class="alert alert-danger">
      <p>{{$message}}</p>
    </div>
    @endif

    @if($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{$message}}</p>
    </div>
    @endif

    <form action="{{ url('login-user') }}" method="post" class="login-form">
      @csrf
      <div class="mb-3 email-div">
         <label for="phone-field" class="form-label">Phone Number</label>
         <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><img src="{{asset('img/india-flag.png')}}" alt="India Flag Image">&nbsp; +91</span>
            <input type="number" class="form-control phone phone-num" name="phone" maxlength="10" minlength="10" id="phone-field" placeholder="Phone">
            <div class="input-group-append edit-input-group-append">
                <span toggle="#password-field" class="input-group-text field-icon" style="height: 100%;color: #fff;background: #efcc3d;border-color: #efcc3d;">
                  <i class="fa fa-pencil"></i>
                </span>
            </div>
          </div>
            <span class="m_err"></span>
      </div>

      <div class="row">
			<div class="mb-3">
				<div class="otp-input" style="display: none;">
					<div class="passcode-wrapper">
						<input id="codeBox1" type="text" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" maxlength="1">
						<input id="codeBox2" type="text" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" maxlength="1">
						<input id="codeBox3" type="text" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" maxlength="1">
						<input id="codeBox4" type="text" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" maxlength="1">
					</div>

					<span class="invalid_otp"></span>
				</div>
				<div class="second-verify-btn otp-input" style="display: none;"><button type="button" class="btn btn-info verify-btn" style="height:40px;"><span class="spinner-border verify-spinner-border spinner-border-sm" style="display:none; margin: 0 5px;"></span>Verify</button></div>
				<div class="verify-btn"><button type="button" class="btn btn-primary">verify</button></div>
				
			</div>
		</div>

    <div class="row">
      <!-- <div class="col-md-6 col-sm-6 resend-otp">Didn't receive OTP?</div> -->
      <div class="col-md-12 col-sm-12" style="display: flex; justify-content: space-between;">
        <div id="resend-otp-block">
          <div class="countdown" id="ten-countdown"></div>
        </div>
        <div class="resend-otp">
          <a class="resend-otp-btn" data-url="{{ url('resend-otp') }}/" style="display:none;">Resend OTP</a>
          <span class="spinner-border resend-spinner-border spinner-border-sm" style="display:none;"></span>
        </div>
      </div>
    </div>
    
    <div class="account-message">Don't have an Account? <a href="{{ url('register-user') }}">Register</a></div>

  </form>

  

  </div>
</div>
<style>.verify-btn button, .second-verify-btn button{float: right; min-height: 26px; min-width: 30px;font-size: 13px; border-radius: 25px;line-height: 1.8;}.second-verify-btn button, .second-verify-btn button:hover{background: #212529;border: 3px solid #fae17c;color: #fff;border-radius: 25px;font-weight: 500;}.passcode-wrapper input{width: 35px; height: 35px;border-radius: 25px;border: 2px solid #fae17c; margin: 2px auto;padding: 10px;}.otp-input{display:inline-block;}.second-verify-btn{display:inline;}.resend-otp, .resend-otp-btn{cursor:pointer;text-decoration:none;}</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
  //otp input box script
  function getCodeBoxElement(index) {
    return document.getElementById('codeBox' + index);
  }

  function onKeyUpEvent(index, event) {
    const eventCode = event.which || event.keyCode;
    if (getCodeBoxElement(index).value.length === 1) {
     if (index !== 4) {
      getCodeBoxElement(index+ 1).focus();
     } else {
      getCodeBoxElement(index).blur();
      // Submit code
      console.log('submit code ');
     }
    }
    if (eventCode === 8 && index !== 1) {
     getCodeBoxElement(index - 1).focus();
    }
  }

  function onFocusEvent(index) {
    for (item = 1; item < index; item++) {
     const currentElement = getCodeBoxElement(item);
     if (!currentElement.value) {
        currentElement.focus();
        break;
     }
    }
  }

</script>
<script type="text/javascript">
 $(document).ready(function(){

  setTimeout(function(){
      $('.alert-danger').hide("slow");
      $('.alert-success').hide("slow");
    },4000);
  
   var is_email = true;
   var is_phone = false;
   var isVerify = false;
   var is_submit = true
  
  //set local storage to false for set timeinterval on condition 
   localStorage.setItem("resent_otp",false)

   $('.edit-input-group-append').click(function(){
      document.getElementById("phone-field").readOnly = false;
      $('.verify-btn button').show();
      $('.second-verify-btn').hide();
      $('.otp-input').hide();
      $('.otp-input .passcode-wrapper input').val("");
      $('.resend-otp-btn').hide();
      localStorage.setItem("resent_otp",false)
      $("#ten-countdown").remove();
   });


   $('.second-verify-btn .verify-btn').click(function(){
 
     $('.verify-spinner-border').show();
     setTimeout(() => {
       var otp = $('#codeBox1').val()+$('#codeBox2').val()+$('#codeBox3').val()+$('#codeBox4').val() 
       if(otp.length == 4){
        $('.countdown').addClass("d-none");
         $.ajax({
           url:'{{url("verify-otp")}}/'+ $('#phone-field').val()+'/'+otp,
           type:'get',
           success:function(response){
            
           if(response.is_verify == 1){
             $('.otp-input').hide()
             $('.second-verify-btn').hide()
           
             $('.verify-btn button').show();
             $('.verify-btn button').text("verified");
             $('.edit-input-group-append').hide();
   				   document.getElementById("phone-field").readOnly = true;
             is_submit == true
             isVerify = true;
             $("#ten-countdown").remove();
             $(".login-form").submit();
           }else{
             isVerify = false;
             $('.invalid_otp').text("Invalid OTP.").css({'display':'block','font-size': '13px','color': 'red'}).delay(3000).fadeOut();
           }
           }
         });
       }else{
         isVerify = false;
         $('.invalid_otp').text("Invalid OTP.").css({'display':'block','font-size': '13px','color': 'red'}).delay(3000).fadeOut();
       }
       $('.verify-spinner-border').hide();
     }, 2000);
     
   });
 
     $('#phone-field').on('keypress keyup keydown input',function(e) 
      {
        if ($('#phone-field').val().length > 10){
          $('#phone-field').val($('#phone-field').val().slice(0, 10));
        }  
         var charCode = (e.which) ? e.which : event.keyCode    
         if (!( /^\d*$/.test($('#phone-field').val()))){
              return false;                        
         }
     })

    $('.login-user').click(function(){
      var phone = $('#phone-field').val()
 
        if(is_phone == true){
           phone.length < 10 && $(".m_err").text("Plase enter Valid Mobile No.").css({ 'display': "block", 'color': "red", "font-size": "13px" }),
            phone.length > 10 && $(".m_err").text("Plase enter Valid Mobile No.").css({ display: "block", color: "red", "font-size": "13px" });
        }
        if((phone.length != 0 && phone.length == 10) && is_submit == true){
        }
    });

    $("input").on('keyup keypress',function(){
      if($(this).attr('name') == 'phone')
      {
      $('.m_err').css('display','none');
      }
    });

    $('.resend-otp-btn').click(function(evt){
      
        $('.resend-spinner-border').show();
        setTimeout(() => {
          $('.resend-spinner-border').hide();
          $('.otp-input .passcode-wrapper input').val("");
          $('.resend-otp-btn').hide();
          $('.countdown').removeClass("d-none");
          localStorage.setItem("resent_otp",false)
          sendOTPFunction();
          
          $('.invalid_otp').text("Successfully send new OTP.").css({'display':'block','font-size': '13px','color': 'green'}).delay(3000).fadeOut();
        }, 1000);
     
    });

    $('.verify-btn button').click(function(){
      $.ajax({
        url:"{{ url('check-valid-phone-number') }}/"+$('#phone-field').val(),
        type:"get",
        success:function(response){
          $('.string').text(response)
          if(response == 1){
            is_submit = true;
            isVerify = true;
            $(".m_err").hide();
            sendOTPFunction();
          }else{
            is_submit = false;
            isVerify = false;
            $(".m_err").text("Mobile number is not exists in our record.").css({ 'display': "block", 'color': "red", "font-size": "13px" })
          }
        }

      });
      //sendOTPFunction();
    });

  function sendOTPFunction(){
    var phone_number =  $('#phone-field').val();
    if(phone_number.length == 0){
      $('.m_err').text("Phone Number field is required.").css({'display':'block','color':'red','font-size':'13px'});
    }else if(phone_number.length < 10 || phone_number.length != 10 ){
      $('.m_err').text("Enter Valid Phone Number.").css({'display':'block','color':'red','font-size':'13px'});
    }else{
      setTimeout(() => {
          if(isVerify == false){
            $(".m_err").text("Mobile number is not exists in our record.").css({ 'display': "block", 'color': "red", "font-size": "13px" })
          }
          else{
              $('.edit-input-group-append').show();
              document.getElementById("phone-field").readOnly = true;
              $(".m_err").hide()
              $('.otp-input').show()
              $('.second-verify-btn').show()
              $('.verify-btn button').hide();

              localStorage.setItem("resent_otp",true)

              $.ajax({
                url:"{{ url('send-otp') }}/"+phone_number,
                type:"get",
                success:function(response){
                }
              });
          }
      }, 500);
    }
  }
  });
</script>
@endsection