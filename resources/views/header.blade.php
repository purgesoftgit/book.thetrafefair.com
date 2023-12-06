 <!-- Header Section Start -->
 <div class="container">
     <header class="main-header">
        <nav class="navbar navbar-expand-lg">
          <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" align="The Trade Fair Brand" alt="Image"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#website-menu" aria-controls="website-menu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="website-menu">
              <a href="javascript:void(0)" class="mobile-menu-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
              </a>
    
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="#">Stays</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact Us</a>
                </li>
              </ul>
            </div>
    
            <div class="head-btns">
                @if (!Auth::check())
                <a class="btn btn-light" href="{{url('user-login')}}">Sign In</a>
                <a class="btn btn-bordered" href="javascript:void(0);">Sign Up</a>
                
                @elseif(Auth::check() && Auth::user()->role_id == 0)
                 <div class="dropdown profile-btn">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ Auth::check() ? Auth::user()->first_name : 'User'}}</span>
                    </button>
    
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{url('dashboard')}}">Dashboard</a></li>
                        <li>
                            <form action="{{ url('user-logout') }}" method="POST" id="logoutForm">
                                @csrf
                                <a class="dropdown-item" href="javascript:void(0);" id="logout">Logout</a>
                            </form>
                        </li>
                    </ul>
                </div>
             @endif

            </div>
    
          </div>
        </nav>
      </header>
 </div>

 <script>
     $(document).ready(function() {
         $("#logout").click(function() {
             $("#logoutForm").submit();
         });
     });
 </script>
 <!-- Header Section End -->
