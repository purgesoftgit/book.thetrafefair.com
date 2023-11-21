@extends('layouts.register-layout')
@section('content')
<div class="container-fluid">
  <div class="login-signup-form signup-page-form">
  	<a href="{{url('/')}}" class="back-link"><i class="fa fa-long-arrow-left"></i> <span>Back to Hotel</span></a>
    <div class="text-center">
      <a href="{{ url('/') }}"><img src="{{asset('img/logo.png')}}" alt="The Trade International"></a>
      <h1>Create Account</h1>
    </div>
	
	@if(session('error'))
    	<div class="alert alert-danger">{{session('error')}}</div>
	@endif

    <form class="needs-validation" method="post" action="{{ url('save-users') }}">
     @csrf
		<div class="row">
		 <div class="mb-3 col-md-6 {{ $errors->has('first_name') ?'has-error' : ''}}">
			<label for="First-Name" class="form-label">Full Name <sup class="mandatory-fields">*</sup></label>
			<input type="text" class="form-control first_name" name="first_name" id="First-Name" placeholder="">
			<span class="f_err"></span>
			 @if ($errors->has('first_name'))
              <span class="help-block">
                 <strong>{{ $errors->first('first_name') }}</strong>
              </span>
             @endif
		  </div>
		  
		  <div class="mb-3 col-md-6 {{ $errors->has('email') ?'has-error' : ''}}">
			<label for="email-address" class="form-label">Email Address <sup class="mandatory-fields">*</sup></label>
			<input type="email" class="form-control email" name="email" id="email-address" placeholder="">
			<span class="e_err"></span>
			 @if ($errors->has('email'))
              <span class="help-block">
                 <strong>{{ $errors->first('email') }}</strong>
              </span>
             @endif
		  </div>
		</div>

     	<div class="row">
		  <div class="mb-3 col-md-6 {{ $errors->has('use_referral_code') ?'has-error' : ''}}">
	         <label class="form-label">Referral Code</label>
	          <input type="text" name="use_referral_code" maxlength="6" minlength="6" class="form-control use_referral_code" value="<?php echo (isset($referral_code)) ? $referral_code : ''; ?>">
	          <span class="referral_error"></span>
          	  <span class="referral_success"></span>
			  @if ($errors->has('use_referral_code'))
	             <span class="help-block">
	                 <strong>{{ $errors->first('use_referral_code') }}</strong>
	             </span>
	          @endif

			  @if(isset($referral_code) && $referral_code != '')
			  	<span class="already_referral_success"></span>
			  @endif
	      </div>
		  <div class="mb-2 col-md-6 {{ $errors->has('phone_number') ?'has-error' : ''}}">
			<label for="Phone-Number" class="form-label">Phone Number <sup class="mandatory-fields">*</sup></label>
			<div class="input-group ">
				  <span class="input-group-text" id="basic-addon1"><img src="{{asset('img/india-flag.png')}}" alt="India Flag Image">&nbsp; +91</span>
				  <input type="number" class="form-control phone_number phone-num" name="phone_number" maxlength="10" minlength="10" id="Phone-Number" placeholder="">
				  <div class="input-group-append edit-input-group-append">
					<span toggle="#password-field" class="input-group-text field-icon" style="height: 100%;color: #fff;background: #efcc3d;border-color: #efcc3d;">
						<i class="fa fa-pencil"></i>
					</span>
				  </div>
			 </div>
			 <span class="p_err"></span>
			  @if ($errors->has('phone_number'))
              <span class="help-block">
                 <strong>{{ $errors->first('phone_number') }}</strong>
              </span>
             @endif
		  </div>
        </div>

		<div class="row">
			<div class="col-md-6 offset-md-6">
				<div class="otp-input" style="display: none;">
					<div class="passcode-wrapper">
						<input id="codeBox1" type="text" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" maxlength="1">
						<input id="codeBox2" type="text" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" maxlength="1">
						<input id="codeBox3" type="text" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" maxlength="1">
						<input id="codeBox4" type="text" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" maxlength="1">
					</div>
					<span class="invalid_otp"></span>
				</div>

				<div class="second-verify-btn otp-input" style="display: none;"><button type="button" class="btn btn-info verify-btn" style="height:40px;" ><span class="verify-spinner-border spinner-border spinner-border-sm" style="display:none; margin: 0 5px;"></span>Verify</button></div>
				<div class="verify-btn"><button type="button" class="btn btn-primary">verify</button></div>

			</div>
		</div>

		<div class="row">
			<div class="mb-3 col-md-6 offset-md-6" >
				<div class="resend-otp">
					<div id="resend-otp-block">
			  			 <div class="countdown" id="ten-countdown"></div>
					</div>
					<div>
						<a class="resend-otp-btn" data-url="{{ url('resend-otp') }}/" style="display:none;">Resend OTP</a>
						<span class="spinner-border resend-spinner-border spinner-border-sm" style="display:none;"></span>
					</div>
				</div>
			</div>
		</div>
	
       <div class="card-body slider-form-captcha">
		<div id="captcha"></div>
		<strong id="captcha_error-info" class="error"></strong>
	   </div>

      <div class="form-check last-check">
		  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
		  <label class="form-check-label" for="flexCheckDefault">By signing up, I agree & accept the <a href="{{ url('terms-&-conditions') }}" class="text-decoration-none">Terms & Conditions</a> of the The Trade International Hotel<sup class="mandatory-fields">*</sup></label>
		  <span class="tc_err"></span>
		</div>
		
		<div class="text-center bottom-links">
			<button class="btn btn-primary register" type="button">Register</button>
			<button type="reset" onclick="this.form.reset();" class="btn btn-dark">Reset</button>
		</div>
		<div class="account-message">Already have an Account? <a href="{{ url('login-user')}}" class="text-decoration-none">Log in</a></div>
    </form>
</div>
</div>

@include('messages')

<style type="text/css">.referral_error{color: red;font-size: 13px;}.already_referral_success,.referral_success{color: green;font-size: 13px;}.back-link:hover{color: #eabc59;}
</style>

@endsection
<style>.verify-btn button, .second-verify-btn button{float: right; min-height: 26px; min-width: 30px;font-size: 13px; border-radius: 25px;line-height: 1.8;}.second-verify-btn button, .second-verify-btn button:hover{background: #212529;border: 3px solid #fae17c;color: #fff;border-radius: 25px;font-weight: 500;}.passcode-wrapper input{width: 35px; height: 35px;border-radius: 25px;border: 2px solid #fae17c; margin: 2px auto;padding: 10px;}.otp-input{display:inline-block;}.second-verify-btn{display:inline;}.resend-otp{    text-align: right;padding: 12px;display: flex;justify-content: space-between;align-items: center;} .resend-otp .resend-otp-btn{cursor:pointer;text-decoration:none;}.alert-error{background: #ffd1d1;border-color: #ffc5c5;}</style>
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
    },3000);

	var isSubmit = true
	var isVerify = false;
	
	$('.already_referral_success').text('Referral Code is correct.').show().delay(10000).fadeOut();

	$('.resend-otp-btn').click(function(evt){
	 
		$('.resend-spinner-border').show();
		setTimeout(() => {
			$('.resend-spinner-border').hide();
			$('.otp-input .passcode-wrapper input').val("");
			$('.resend-otp-btn').hide();
			$('.countdown').removeClass("d-none");
			localStorage.setItem("resent_otp",true)
			sendOTPFunction();
			
			$('.invalid_otp').text("Successfully send new OTP.").css({'display':'block','font-size': '13px','color': 'green'}).delay(3000).fadeOut();
		}, 1000);
	 
     
    });

    $('.verify-btn button').click(function(){
		$.ajax({
			url:"{{ url('check-user-already-exists') }}/"+$('#Phone-Number').val(),
			type:"get",
			success:function(response){
				if(response == 1){
					isSubmit = false;
					//$('.verify-btn button').prop("disabled",true)
					$('.p_err').text("You are Already Registerd.").css({'display':'block','color':'red','font-size':'13px'});
				}else{
					isSubmit = true;
					//$('.verify-btn button').prop("disabled",false)
					$('.p_err').hide()
					sendOTPFunction();
				}
			}
		})
      //sendOTPFunction();
    });


	function sendOTPFunction(){
		var phone_number = $('#Phone-Number').val();
		if(phone_number.length == 0){
			$('.p_err').text("Phone Number field is required.").css({'display':'block','color':'red','font-size':'13px'}).delay(2000).fadeOut();
		}else if(phone_number.length != 10){
			$('.p_err').text("Enter Valid Phone Number.").css({'display':'block','color':'red','font-size':'13px'}).delay(2000).fadeOut();
		}else{
			$('.edit-input-group-append').show();
            document.getElementById("Phone-Number").readOnly = true;
			$('.otp-input').show()
			$('.second-verify-btn').show()
			$('.resend-otp').show();
			$('.verify-btn button').hide();
			localStorage.setItem("resent_otp",true)
			$.ajax({
				url:"{{ url('send-otp') }}/"+phone_number,
				type:"get",
				success:function(response){
				}
			})
		}
	}

	$('.edit-input-group-append').click(function(){
      document.getElementById("Phone-Number").readOnly = false;
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
				$.ajax({
					url:'{{url("verify-otp")}}/'+$('#Phone-Number').val()+'/'+otp,
					type:'get',
					success:function(response){
					if(response.is_verify == 1){
						$('.otp-input').hide()
						$('.second-verify-btn').hide()
						$('.resend-otp').hide();
						$('.verify-btn button').show();
						$('.verify-btn button').prop('disabled',true);
						$('.edit-input-group-append').hide();
   				   		document.getElementById("Phone-Number").readOnly = true;
						isVerify = true;
						$("#ten-countdown").remove();
					}else{
						isVerify = false;
						$('.invalid_otp').text("Invalid OTP.").css({'display':'block','font-size': '13px','color': 'red'}).delay(3000).fadeOut();
					}
					}
				});
			}else{
				isVerify = false;
				$('.invalid_otp').text("Invalid OTP.").css({'display':'block','font-size': '13px','color': 'red'}).delay(2000).fadeOut();
			}
			$('.verify-spinner-border').hide();
		}, 2000);
	})

	$('.country').change(function(){
		$.ajax({
			url:'{{url("get-all-state")}}/'+$(this).val(),
			type:'get',
			success:function(response){
				var append = '';
					response.forEach(function(value,key){
					append = append + '<option value="'+value.id+'">'+value.name+'</option>';
					});
				$('.state').html(append)
			}
			});
	});

		$('.state').change(function(){
			$.ajax({
			 	url:'{{url("get-all-city")}}/'+$(this).val(),
			 	type:'get',
			 	success:function(response){
			 	   var append = '';
			 		 response.forEach(function(value,key){
			 		 	append = append + '<option value="'+value.id+'">'+value.name+'</option>';
			 		 });
			 	   $('.city').html(append)
			 	}
			 });
		});

		//toggle password
		$(".toggle-password").click(function() {
	   $(".toggle-password i").toggleClass("fa-eye fa-eye-slash");
		  var input = $(this).parent().parent().find('input');
		  if (input.attr("type") == "password") {
		    input.attr("type", "text");
		  } else {
		    input.attr("type", "password");
		  }
		});
		$(".toggle-confirm-password").click(function() {
		 	 $(".toggle-confirm-password i").toggleClass("fa-eye fa-eye-slash");
			  var input = $(this).parent().parent().find('input');
			  if (input.attr("type") == "password") {
			    input.attr("type", "text");
			  } else {
			    input.attr("type", "password");
		  }
		});
		$('.use_referral_code').on('keypress keyup',function(){
			 
			if($(this).val().length == 0){
				isSubmit = true;
				$('.referral_error').hide();
			}else{
				$.ajax({
					url:"{{ url('check-valid-referral-code') }}/"+$(this).val(),
					type:"get",
					success:function(response){
						 
						if(response == 'not valid'){
							$('.referral_error').text('Invalid Referral Code.').show();
							isSubmit = false
						}
						else{
							$('.referral_error').hide();
							$('.referral_success').text('Referral Code is correct.').show().delay(10000).fadeOut();
							isSubmit = true
						}
					}
				})
			}
		});

		$('.phone_number').on('keypress keyup',function(e) 
		{
			if ($('.phone_number').val().length > 10){
				$('.phone_number').val($('.phone_number').val().slice(0, 9));
			}  
			var charCode = (e.which) ? e.which : event.keyCode    
			if (!( /^\d*$/.test($('.phone_number').val()))){
				return false;                        
			}
			 
			// else{
			// 	$.ajax({
			// 		url:"{{ url('check-user-already-exists') }}/"+$(this).val(),
			// 		type:"get",
			// 		success:function(response){
			// 			if(response == 1){
			// 				isSubmit = false;
			// 				$('.verify-btn button').prop("disabled",true)
			// 				$('.p_err').text("You are Already Registerd.").css({'display':'block','color':'red','font-size':'13px'});
			// 			}else{
			// 				isSubmit = true;
			// 				$('.verify-btn button').prop("disabled",false)
			// 				$('.p_err').hide()
			// 			}
			// 		}
			// 	})
			// }
		});
		//validation
		$('.register').click(function(){
		 
			var pass_regex = "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"
			var eml_reglx = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			 
			// if($('input[name="salutation"]:checked').val() == undefined){
			// 	$('.sat_err').text("Salutation field is required.").css({'display':'block','color':'red','font-size':'13px'});
			// }
			if($('.first_name').val().length == 0){
				$('.f_err').text("First Name field is required.").css({'display':'block','color':'red','font-size':'13px'});
			}
			if($('.email').val().length == 0){
				$('.e_err').text("Email field is required.").css({'display':'block','color':'red','font-size':'13px'});
			}
			if (!$('.email').val().match(eml_reglx))
	        {
	          $(".e_err").text("Enter Valid Email").css({'display':'block','color':'red','font-size':'13px','display':'block'});
	        }
			if($('.phone_number').val().length == 0){
				$('.p_err').text("Phone Number field is required.").css({'display':'block','color':'red','font-size':'13px'});
			}
			if($('.phone_number').val().length < 10){
				$('.p_err').text("Please enter Valid Phone Number.").css({'display':'block','color':'red','font-size':'13px'});
			}
			if($('#flexCheckDefault').prop('checked') == false){
				$('.tc_err').text("Please accept our policies.").css({'display':'block','color':'red','font-size':'13px'});
			}
 

			if( $('.first_name').val().length != 0  && $('.phone_number').val().length == 10 && $('.email').val().length != 0 && $('.email').val().match(eml_reglx) && isSubmit == true && $('#flexCheckDefault').prop('checked') == true){
				if(!$(".sliderContainer").hasClass("sliderContainer_success")){
          			$('#captcha_error-info').html("Captcha required.")
        		}else if(isVerify == false){
					$('#unsuccess-popups .errormessage').text('Please Verify Your Phone Number');
        			$('#unsuccess-popups').modal('show');
				}else{
					$('.needs-validation').submit();
				}
			}
		});
		
		$('#flexCheckDefault').click(function(){ $('.tc_err').hide(); })
		$("input[name='salutation']").change(function(){ $('.sat_err').hide(); })
		$("input[name='gender']").change(function(){ $('.g_err').hide(); })
		$(".country").change(function(){ $('.c_err').hide(); })
		$(".state").change(function(){ $('.s_err').hide(); })
		$(".city").change(function(){ $('.city_err').hide(); })
		$("input").on('keyup keypress',function(){
			if($(this).attr('name') == "first_name"){  $('.f_err').hide(); }
			if($(this).attr('name') == "last_name"){  $('.l_err').hide(); }
			if($(this).attr('name') == "email"){  $('.e_err').hide(); }
			if($(this).attr('name') == "password"){ $(".password-info-text").hide(), $('.pass_err').hide(); }
			if($(this).attr('name') == "c_password"){ $(".password-info-text").hide(), $('.cpass_err').hide(); }
			if($(this).attr('name') == "phone_number"){  $('.p_err').hide(); }
			if($(this).attr('name') == "address"){  $('.add_err').hide(); }
		})
	});
</script>
 