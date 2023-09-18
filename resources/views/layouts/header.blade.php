<header class="web-header">
    <div class="header-top">
        <div class="container">
            <div class="left-menu">
                {{-- @dump($settings['tradefair_contact_number']) --}}
                <a href="tel:{{ $settings['tradefair_contact_number'] ?? '' }}"><img src={{ asset('img/call-icon.png') }}
                  alt="Call Icon"> <span><b>Phone: </b>{{ $settings['tradefair_contact_number'] ?? '' }}</span></a>
                <span class="seprator"></span>
                <a href="mailto:{{ $settings['tradefair_email'] ?? '' }}"><img src={{ asset('img/email-icon.png') }}
                  alt="Email Icon"> <span><b>Email: </b>{{ $settings['tradefair_email'] ?? '' }}</span></a>
            </div>
            <div class="right-menu">
                {{-- {{Auth::user()->first_name}} --}}
                @if (Auth::user())
                    <span class="dropdown">
                        <a href="javascript:void(0)" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->first_name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item text-dark " href="{{ url('profile') }}">Profile</a></li>
                            <li>
                                <form action="{{ url('logout') }}" method="POST" id="logForm">
                                    @csrf
                                    <a class="dropdown-item text-dark" id="log_out" href="javascript:void(0)">Log
                                        out</a>
                                </form>

                            </li>
                        </ul>
                    </span>
                @else
                {{-- @if (Auth::user())
                {{ Redirect::to('/login') }}
                @endif --}}
                    <a href="{{ url('login') }}">Login </a>
                    <span>|</span>
                    <a href="{{ url('register') }}">Signup</a>
                @endif
                <div class="header-social">
                    <a href="{{ $settings['ttf_instagram_url'] ?? '' }}" target="_blank" class="fa fa-instagram"></a>
                    <a href="{{ $settings['ttf_twitter_url'] ?? '' }}" target="_blank" class="fa fa-twitter"></a>
                    <a href="{{ $settings['ttf_facebook_url'] ?? '' }}" target="_blank" class="fa fa-facebook"></a>
                    <a href="{{ $settings['ttf_linkedin_url'] ?? '' }}" target="_blank" class="fa fa-linkedin"></a>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src={{ asset('img/brand-img.png') }} align="The Trade Fair Brand">
            </a>
            <a class="btn btn-primary d-block d-lg-none" href="{{ url('rooms') }}">Book Now</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#website-menu"
                aria-controls="website-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="website-menu">
                <a href="javascript:void(0)" class="mobile-menu-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x" viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                </a>
                <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('about-us') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://saatfera.in/" target="_blank">Wedding Hall</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('event') }}">our Events</a>
                    </li>
                    <li class="blogo-space"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.thetradebite.com/" target="_blank">Our Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('gallery') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="btn btn-primary" href="{{ url('rooms') }}">Book Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script>
    $(document).ready(function() {
        $("#log_out").click(function() {
            $("#logForm").submit();
        });
    })
</script>
