 <!-- Header Section Start -->
 <div class="container">
     <header class="header-section d-flex align-items-center justify-content-between">
         <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt="Image"></a>
         <div class="head-end">
             @if (!Auth::check())
                 <a href="{{ url('user-login') }}" class="btn btn-primary text-uppercase">Login</a>
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
