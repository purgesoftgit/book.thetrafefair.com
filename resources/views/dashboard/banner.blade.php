 <!-- Page Title Section Start -->
 <div class="profile-banner">
     <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-profile-popup" class="edit-banner btn btn-primary">
         <i class="fa fa-edit"></i>
         <span>Edit Profile</span>
     </a>
     <img src="{{asset('img/profile-banner.jpg')}}" alt="Banner" class="img-fluid">
 </div>
 <!-- Page Title Section End -->

 <div class="profile-content">
     <div class="profile-div">
         <div class="profile-img">
             <img src="{{asset('img/profile-img2.png')}}" alt="Img">
         </div>
         <div class="profile-text">
             <h1>{{ Auth::check() ? Auth::user()->first_name : 'User'}}</h1>
             <address>
             </address>
         </div>
     </div>
 
 </div>