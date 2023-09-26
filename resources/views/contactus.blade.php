@extends('layouts.layout')
@section('content')
@include('layouts.header')

<style scoped>
  .text-error {
    color: red;
    font-size: 13px;
  }
</style>
<main class="web-main">

  <!-- Page Title Section Start -->
  <section class="page-title-section" style="background-image:url(img/contact-banner-bg.jpg);">
    <div class="container">
      <div class="page-title">Contact Us</div>
    </div>
  </section>
  <!-- Page Title Section End -->


  <!-- Reservation Section Start -->
  <section class="reservation-section">
    <div class="container">
      <div class="reservation-box">

        <div class="reservation-title">RESERVATIONS </div>
        <div class="reservation-contact"><b>Email: </b>{{ $settings['tradefair_email'] ?? '' }}</div>
        <div class="reservation-contact"><b>Phone: </b>{{ $settings['tradefair_contact_number'] ?? ''}}</div>

        <form id="contact_form_us" class="ttf_form form-validate" action="{{route('store')}}" method="POST">
          @csrf
          <div class="mb-4">
            <label for="name">Name<span aria-label="required" class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control validate[required,minSize[2],maxSize[50],custom[onlyLetterNumber]]" />
            @if ($errors->has('name'))
            <span class="text-danger"> {{ $errors->first('name') }} </span>
            @endif
          </div>

          <div class="mb-4">
            <label for="email">Email<span aria-label="required" class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control validate[required,custom[email]]"/>
            @if ($errors->has('email'))
            <span class="text-danger"> {{ $errors->first('email') }} </span>
            @endif
          </div>

           <div class="mb-4">
            <label for="phone">Your Phone<span aria-label="required" class="text-danger">*</span></label>
            <div class="mb-3 input-group banquet-contact">
            <span class="input-group-text" id="basic-addon1">
              <img src="{{ asset('img/india-flag.jpg')}}" alt="India Flag Image">&nbsp; +91
            </span>
            <input type="text" name="phone" id="phone" minlength="10" maxlength="10" class="form-control phone validate[required,maxSize[10],minSize[10]]" />
            {{-- <button type="button" id="verifyButton" class="btn btn-primary btn-sm">Verify</button> --}}
            <span class="text-error" id="phoneError"></span>
            </div>
            @if ($errors->has('phone'))
            <span class="text-danger"> {{ $errors->first('phone') }} </span>
            @endif
          </div> 

               

          <div class="mb-5">
            <label for="message-field" class="form-label">Message<span aria-label="required" class="text-danger">*</span></label>
            <textarea name="message" id="message" class="form-control validate[required,maxSize[200]]"  rows="6" cols="50"></textarea>
            <span class="text-error" id="messageError"></span>
            @if ($errors->has('message'))
            <span class="text-danger"> {{ $errors->first('message') }} </span>
            @endif
          </div>

          <div class="mb-4">
            <label for="message-field" class="form-label">Captcha<span aria-label="required" class="text-danger">*</span></label>
            <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
            @if ($errors->has('g-recaptcha-response'))
            <span class="text-danger"> {{ $erros->first('recaptcha') }} </span>
            @endif
            <span class="captcha_err text-danger"></span>
          </div>
      </div>


      <div class="text-center">
        <button type="button" id="contact_btn" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
    </div>
  </section>
  <!-- Reservation Section End -->

  <!-- Reservation success modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Awesome!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="icon-box text-center">
            <i class="material-icons">check_circle</i>
          </div>
          <p class="text-center">Your booking has been confirmed. Check your email for details.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" id="okBtn">OK</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Reservation Address Section Start -->
  <section class="reservation-address-section">
    <div class="container">

      <!-- Col Start -->
      <div class="address-listing">
        <div class="address-title">REGIONAL OFFICE EAST</div>
        <address>Flat No-10, 2nd Floor, Hotel Allenby Inn 1/2, Allenby Rd, Kolkata-123456</address>
        <p>Mob: +91 9876543210</p>
        <p>Email: sales@thetradefairhotels.com</p>
      </div>
      <!-- Col End -->

      <!-- Col Start -->
      <div class="address-listing">
        <div class="address-title">NORTHERN INDIA</div>
        <address>K-117, 3rd Floor, Hauz Khas Enclave, New Delhi- 110016</address>
        <p>Mob: +91 9876543210</p>
        <p>Email: sales@thetradefairhotels.com</p>
      </div>
      <!-- Col End -->

      <!-- Col Start -->
      <div class="address-listing">
        <div class="address-title">NORTH EAST</div>
        <address>The Trade Fair Resort, New Chumta Tea Estate, Mati Gara, Distt.- Darjeeling, Siliguri, WB-734009 </address>
        <p>Mob: +91 9876543210</p>
        <p>Email: sales@thetradefairhotels.com</p>
      </div>
      <!-- Col End -->

      <!-- Col Start -->
      <div class="address-listing">
        <div class="address-title">SALES OFFICE - RAIPUR</div>
        <address>The Trade Fair Resort Sector - 24, Jhange Lake, Tuta , Atal Nagar, (Nava Raipur) Raipur , Chattishgarh - 492101 (INDIA)</address>
        <p>Mob: +91 9876543210</p>
        <p>Email: sales@thetradefairhotels.com</p>
      </div>
      <!-- Col End -->

    </div>
  </section>
  <!-- Reservation Address Section End -->

  <section class="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3560.8106389702402!2d75.57559587543612!3d26.81415747670602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjbCsDQ4JzUxLjAiTiA3NcKwMzQnNDEuNCJF!5e0!3m2!1sen!2sin!4v1691585556593!5m2!1sen!2sin" width="100%" height="675" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </section>

</main>
@include('layouts.footer')
<script>
  $(document).ready(function() {
    $("#contact_btn").click(function(e) {
     
     var is_validate = $('#contact_form_us').validationEngine('validate');
 
      if(is_validate === false || is_validate == "false"){
      }else if(grecaptcha.getResponse().length == 0){
        $('.captcha_err').text('Please complete the reCAPTCHA challenge.')
      }else if (is_validate === true) {
        Swal.fire({
          title: '',
          text: 'Please wait while processing...',
          icon: 'info',
          timer: 3000, // Show this message for 3 seconds
          timerProgressBar: true,
          showConfirmButton: false
        }).then(function() {
          $('#contact_form_us').submit();
        });
      } 
    });
});
</script>
@endsection