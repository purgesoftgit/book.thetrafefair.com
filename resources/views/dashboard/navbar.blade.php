<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="{{url('home')}}" class="big-logo"><small>Booking Engine</small></a>
            <a href="{{url('home')}}" class="small-logo"><small>TTF</small></a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">
            <a href="{{url('home')}}" class="user-pic">
                @if(Auth::check() && Auth::user()->image != null)
                <img src="{{asset('upload').'/'.Auth::user()->image}}" class="img-fluid" alt="Profile Image">
                @else
                <img src="{{asset('img/circle-cropped.png')}}" class="img-fluid" alt="Profile Image">
                @endif
            </a>
            <div class="user-info">
                <span class="user-name"> @if(Auth::check() && Auth::user()->role_id == 1) {{ ucfirst(Auth::user()->first_name)}} {{ ucfirst(Auth::user()->last_name)}} @endif</span>
                <span class="user-role">Welcome</span>
            </div>
        </div>
        <!-- sidebar-search  -->
        <div class="sidebar-menu">
            <ul>

                <li class="sidebar-dropdown">
                    <a href="{{url('get-upcoming-checkin-checkout')}}" class="{{ Request::is('get-upcoming-checkin-checkout') ? 'active' : '' }} order-history" data-type="ROOM">
                        <i class="fas fa-hotel"></i>
                        <span>Room Booking History</span>
                        <span class="totalroombookings totalroombookings-nav"></span>
                    </a>
                </li>

                <li>
                    <a href="{{url('faqs')}}" class="{{ Request::is('faqs') ? 'active' : '' }} not-show-icon">
                        <i class="fas fa-newspaper"></i>
                        <span>Faq Management</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('asked-questions')}}" class="{{ Request::is('asked-questions') ? 'active' : '' }} not-show-icon">
                        <i class="fas fa-newspaper"></i>
                        <span>Asked Questions</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('facility')}}" class="{{ Request::is('facility') ? 'active' : '' }} not-show-icon">
                        <i class="fas fa-newspaper"></i>
                        <span>Facility Management</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('newsletters')}}" class="{{ Request::is('newsletters') ? 'active' : '' }} not-show-icon">
                        <i class="fas fa-newspaper"></i>
                        <span>Subscribe Management</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
</nav>
<style type="text/css">
    #contact,
    #reservation {
        cursor: pointer;
    }

    .counter {
        display: inline-block;
        background: #edc35f;
        height: 35px;
        border-radius: 20px;
        color: #000;
        width: 35px;
        text-align: center;
        line-height: 35px;
        position: absolute;
        top: 8px;
        right: 5px;
        font-size: 13px;
    }

    .small-counter {
        display: inline-block;
        background: #edc35f;
        height: 25px;
        border-radius: 20px;
        color: #000;
        width: 25px;
        text-align: center;
        line-height: 25px;
        position: absolute;
        top: 8px;
        right: 5px;
        font-size: 13px;
    }
</style>
<script>
    $(document).ready(function() {

        function gettotalrservationunread() {
            $.ajax({
                url: "{{ url('count-total-unread-reservations') }}",
                type: "get",
                success: function(response) {
                    if (response.reservation_count > 0) {
                        $('.totalreservation-dash').addClass('counter');
                        $('.totalreservation-nav').addClass('small-counter');
                        $('.totalreservation').text(response.reservation_count);
                    } else {
                        $('.totalreservation-dash').removeClass('counter');
                        $('.totalreservation-nav').removeClass('small-counter');
                        $('.totalreservation').text("");
                    }
                }
            })
        }


        function gettotalRoomBooking() {
            $.ajax({
                url: "{{ url('count-total-unread-room-bookings') }}",
                type: "get",
                success: function(response) {
                    if (response.room_booking_count > 0) {
                        $('.totalroombookings-dash').addClass('counter');
                        $('.totalroombookings-nav').addClass('small-counter');
                        $('.totalroombookings').text(response.room_booking_count);
                    } else {
                        $('.totalroombookings-dash').removeClass('counter');
                        $('.totalroombookings-nav').removeClass('small-counter');
                        $('.totalroombookings').text("");
                    }
                }
            })
        }

        function countBannquetMessages() {
            $.ajax({
                url: "{{ url('count-banquet-hall-messages') }}",
                type: "get",
                success: function(response) {
                    if (response.b_contact > 0) {
                        $('.totalbanquet-dash').addClass('counter');
                        $('.totalbanquet-nav').addClass('small-counter');
                        $('.totalbanquet').text(response.b_contact);

                    } else {
                        $('.totalbanquet-dash').removeClass('counter');
                        $('.totalbanquet-nav').removeClass('small-counter');
                        $('.totalbanquet').text("");
                    }
                }
            })
        }

        function countContactMessages() {
            $.ajax({
                url: "{{ url('count-contact-messages') }}",
                type: "get",
                success: function(response) {
                    if (response.c_contact > 0) {
                        $('.totalcontact-dash').addClass('counter');
                        $('.totalcontact-nav').addClass('small-counter');
                        $('.totalcontact').text(response.c_contact);
                    } else {
                        $('.totalcontact-dash').removeClass('counter');
                        $('.totalcontact-nav').removeClass('small-counter');
                        $('.totalcontact').text("");
                    }
                }
            })
        }

        function countMeetingMessages() {
            $.ajax({
                url: "{{ url('count-meeting-messages') }}",
                type: "get",
                success: function(response) {
                    if (response.m_contact > 0) {
                        $('.totalmeeting-dash').addClass('counter');
                        $('.totalmeeting-nav').addClass('small-counter');
                        $('.totalmeeting').text(response.m_contact);
                    } else {
                        $('.totalmeeting-dash').removeClass('counter');
                        $('.totalmeeting-nav').removeClass('small-counter');
                        $('.totalmeeting').text("");
                    }
                }
            })
        }

        $(document).ready(function() {
            gettotalRoomBooking()

            setInterval(function() {
                gettotalRoomBooking()
            }, 3000);
        });

        $("#close-sidebar").click(function() {
            $(".page-wrapper").removeClass("toggled");
        });
        $("#show-sidebar").click(function() {
            $(".page-wrapper").addClass("toggled");
        });

    });

    $(function() {
        setTimeout(function() {
            $('.fade-message').slideUp();
        }, 5000);
    });
</script>