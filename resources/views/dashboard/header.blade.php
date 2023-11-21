<!-- top bar -->
<div class="topbar">
  <div class="bluebar">
    <ul class="nav justify-content-end">
     
      <li class="nav-item dropdown user-link-box">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
        @if(Auth::check() && Auth::user()->image != null)
          <img src="{{asset('upload').'/'.Auth::user()->image}}" class="img-responsive img-circle profile-image" height="60px" width="60px" />
        @else
          <img src="{{asset('img/circle-cropped.png')}}" class="img-fluid" alt="Profile Image" height="60px" width="60px">
        @endif

        @if(Auth::check() && (Auth::user()->role_id == 3))  {{ ucfirst(Auth::user()->first_name)}} {{ ucfirst(Auth::user()->last_name)}} @endif</a>
         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
              {{-- <a class="dropdown-item" href="{{url('update-profile')}}">Profile</a> --}}
            <a class="dropdown-item" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             Logout
            </a>

            <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
      </li>
    </ul>
  </div>
</div>
 
