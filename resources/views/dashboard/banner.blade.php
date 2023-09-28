<?php $userProfile=Auth::user(); ?>
<!-- Page Title Section Start -->
 <div class="profile-banner">
     <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-profile-popup" class="edit-banner btn btn-primary"><i class="fa fa-edit"></i> <span>Edit Profile</span></a>
     <img src="{{asset('img/profile-banner.jpg')}}" alt="Banner" class="img-fluid">
 </div>
 <!-- Page Title Section End -->

 <div class="profile-content">
     <div class="profile-div">
         <div class="profile-img">
            @if(Auth::check() && Auth::user()->image != null)
            <img src="{{ env('BACKEND_URL') .'public/upload'.'/'.Auth::user()->image}}" alt="Img">
            @else
            <img src="{{asset('img/profile-img2.png')}}" alt="Img">
            @endif      
         </div>
         <div class="profile-text">
             <h1>{{ Auth::check() ? Auth::user()->first_name : 'User'}}</h1>
             <address>
             </address>
         </div>
     </div>
 </div>

 <!-- Edit Profile Modal Start -->
  <div class="modal fade edit-profile-popup" id="edit-profile-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <form method="POST" action="{{ url('profile/update') }}" id="update_form">
              @csrf
              <div class="row">
                  <div class="mb-3 col-lg-6">
                      <label for="firstname" class="form-label">First Name</label>
                      <input type="text" class="form-control" name="first_name" id="firstname"
                          value="{{ $userProfile->first_name }}">
                  </div>
                  <div class="mb-3 col-lg-6">
                      <label for="lastname" class="form-label">Last Name</label>
                      <input type="text" class="form-control" name="last_name" id="lastname"
                          value="{{ $userProfile->last_name }}">
                  </div>
                  <div class="mb-3 col-lg-6">
                      <label for="phone" class="form-label">Phone Number</label>
                      <input type="text" class="form-control" name="phone_number" id="phone"
                          value=" {{ str_replace('+91', '', $userProfile->phone_number) }}">
                  </div>
                  <div class="mb-3 col-lg-6">
                      <label for="Email" class="form-label">Email address</label>
                      <input type="email" class="form-control" name="email" id="email"
                          value="{{ $userProfile->email }}">
                  </div>
              </div>
              <button type="button" class="btn btn-primary" id="update-profile">Update</button>
              <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
          </form>
        </div>  
      </div>
    </div>
  </div> 
 <!-- Edit Profile Modal End -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script>
   $(document).ready(function() {
    $("#update-profile").click(function() {
      $('#update_form').submit();
    });
   });
 </script>
  