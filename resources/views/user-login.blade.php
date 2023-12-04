@extends('layouts.layout')
@section('content')

<section>
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="text-center">
              <a href="{{ url('/') }}"><img src="{{asset('img/brand-img.png')}}" alt="The Trade Fair"></a>
              
            </div>
          <div class="text-center mt-4"><strong>Login</strong></div>
          </div>
          <div class="card-body">
            <form id="loginForm" action="{{url('verify-login')}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{asset('img/india-flag.png')}}" alt="India Flag Image">&nbsp; +91 
                    </span>
                    <input type="text" class="form-control phone_number phone validate[required]" minlength="10" maxlength="10" name="phone_number" id="checkout-phone" placeholder="Phone Number*" value="{{ old('phone_number') }}" />
                    <label class="error p_err"></label>
                  </div>
                @if(session('error'))
                <div class="alert alert-error text-danger">
                    {{ session('error') }}
                </div>
                @endif
                @include('otp')
              <div class="form-group text-center">
                <button type="button" class="btn btn-primary btn-block" id="loginButton">Login</button>
              </div>
               
            </form>
          </div>
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
</section>
<script>
      $(document).on('click', '#loginButton', function() {
            var is_validate = $('#loginForm').validationEngine('validate');
            if ($('#checkout-phone').val().length == 0) {

            } else if ($('#checkout-phone').val().length != 10) {
              $('.p_err').text("Enter Valid Phone Number.").css({ 'display': 'block', 'color': 'red', 'font-size': '13px', 'position': 'absolute', 'top': '50px' }).delay(2000).fadeOut();

            } else if (localStorage.getItem("isVerify") == false || localStorage.getItem("isVerify") == "false") {
                $('#unsuccess-popups .errormessage').text('Please Verify Your Phone Number');
                $('#unsuccess-popups').modal('show');
            } else {
                $('#loginForm').submit();
            }
        });
</script>
@endsection