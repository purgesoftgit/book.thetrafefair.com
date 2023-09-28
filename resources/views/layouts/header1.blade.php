<!-- Header Section Start -->
<header class="admin-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a href="{{url('/')}}" class="back-link">
                <svg enable-background="new 0 0 256 256" height="256px" id="Layer_1" version="1.1" viewBox="0 0 256 256" width="256px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path d="M91.474,33.861l-89.6,89.6c-2.5,2.5-2.5,6.551,0,9.051l89.6,89.6c2.5,2.5,6.551,2.5,9.051,0s2.5-6.742,0-9.242L21.849,134  H249.6c3.535,0,6.4-2.466,6.4-6s-2.865-6-6.4-6H21.849l78.676-78.881c1.25-1.25,1.875-2.993,1.875-4.629s-0.625-3.326-1.875-4.576  C98.024,31.413,93.974,31.361,91.474,33.861z" />
                </svg>
                <span>Back to Hotel</span>
            </a>
            <a class="navbar-brand" href="{{ url('/')}}">
                <img src="{{asset('img/brand-img.png')}}" align="The Trade Fair Brand">
            </a>

            @if(Auth::check())
            <div class="dropdown profile-btn">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(Auth::check() && Auth::user()->image != null)
                    <img src="{{ env('BACKEND_URL') .'public/upload'.'/'.Auth::user()->image}}" alt="Img">
                    @else
                    <img src="{{asset('img/profile-img2.png')}}" alt="Img">
                    @endif 
                    <span>{{ Auth::check() ? Auth::user()->first_name : 'User'}}</span>
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <!-- <li><a class="dropdown-item" href="javascript:void(0);">Cart</a></li> -->
                    <li><a class="dropdown-item" href="{{url('room-order-history')}}">Dashboard</a></li>
                    <!-- <li><a class="dropdown-item" href="javascript:void(0);">TTF Wallet</a></li>

                <li><a class="dropdown-item" href="javascript:void(0);">Notification <span class="cout_notification" style="">10</span></a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Setting</a></li> -->
                    <li>
                        <form action="{{ url('logout') }}" method="POST" id="logForm">
                            @csrf
                            <a class="dropdown-item" href="javascript:void(0);" id="log_out">Logout</a>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <a class="navbar-brand" href="{{ url('login') }}">
               Login
            </a>
            @endif
        </nav>
    </div>
</header>
<!-- Header Section End -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#log_out").click(function() {
            $("#logForm").submit();
        });
    })
</script>