<div class="side-menu">
    <button type="button" class="side-menu-close"><i class="fa fa-times"></i></button>
    <div class="side-menu-inner tab">

        <h3 class="d-none">PAYMENTS</h3>
        <ul class="d-none">
            <li><a href="javascript:void(0);" class="active">TTF Wallets</a></li>
            <li><a href="javascript:void(0);">Extra Discount</a></li>
            <li><a href="javascript:void(0);">Refer &amp; Earn</a></li>
        </ul>

        <h3 class="d-none">ACTIVITY</h3>
        <ul class="d-none">
            <li><a href="javascript:void(0);">Book a Room</a></li>
            <li><a href="javascript:void(0);">Favourite Items</a></li>
            <li><a href="javascript:void(0);">Followers</a></li>
            <li><a href="javascript:void(0);">Restaurant</a></li>
        </ul>

        <h3>ORDERING & Enquiry</h3>
        <ul>
            <li><a href="{{url('room-order-history')}}" class="{{Request::is('room-order-history') ? 'active' : ''}}">Room Booking History</a></li>
            <li><a href="{{url('event-requests')}}" class="{{Request::is('event-requests') ? 'active' : ''}}">Event Booking History</a></li>
            <li><a href="{{url('wedding-history')}}" class="{{Request::is('wedding-history') ? 'active' : ''}}">Wedding History</a></li>
            <li><a href="{{url('spa-reservation-history')}}" class="{{Request::is('spa-reservation-history') ? 'active' : ''}}">spa reservation History</a></li>
        </ul>

        <h3 class="d-none">TABLE BOOKING</h3>
        <ul class="d-none">
            <li><a href="javascript:void(0);">Your Bookings</a></li>
        </ul>

        <!-- if user is login -->
        <h3 class="d-none">SUGGESTED FOODIES TO FOLLOW</h3>
        <div class="suggested-follow my-suggested-follow d-none">

            <!-- Suggested Follow List Start -->
            <div class="suggested-follow-list">
                <a href="javascript:void(0);" class="suggested-follow-img">
                    <img src="{{asset('img/profile-img2.png')}}" alt="Suggested">
                </a>
                <div class="suggested-follow-content">
                    <h5><a href="#" target="_blank" rel="noopener noreferrer">Hjtyt </a></h5>
                    <p><span>0 Reviews</span> / <span>0 Followers</span></p>
                    <a href="javascript:void(0);" data-id="274" class="add-friend follow-user-btn fa fa-user-plus" disabled=""></a>
                </div>
            </div>
            <div class="suggested-follow-list">
                <a href="javascript:void(0);" class="suggested-follow-img">
                    <img src="{{asset('img/profile-img2.png')}}" alt="Suggested">
                </a>
                <div class="suggested-follow-content">
                    <h5><a href="#" target="_blank" rel="noopener noreferrer">Hgj </a></h5>
                    <p><span>0 Reviews</span> / <span>0 Followers</span></p>
                    <a href="javascript:void(0);" data-id="273" class="add-friend follow-user-btn fa fa-user-plus" disabled=""></a>
                </div>
            </div>
            <div class="suggested-follow-list">
                <a href="javascript:void(0);" class="suggested-follow-img">
                    <img src="{{asset('img/profile-img2.png')}}" alt="Suggested">
                </a>
                <div class="suggested-follow-content">
                    <h5><a href="#" target="_blank" rel="noopener noreferrer">Hfdgh </a></h5>
                    <p><span>0 Reviews</span> / <span>0 Followers</span></p>
                    <a href="javascript:void(0);" data-id="272" class="add-friend follow-user-btn fa fa-user-plus" disabled=""></a>
                </div>
            </div>
            <div class="suggested-follow-list">
                <a href="javascript:void(0);" class="suggested-follow-img">
                    <img src="{{asset('img/profile-img2.png')}}" alt="Suggested">
                </a>
                <div class="suggested-follow-content">
                    <h5><a href="#" target="_blank" rel="noopener noreferrer">Vamp </a></h5>
                    <p><span>0 Reviews</span> / <span>0 Followers</span></p>
                    <a href="javascript:void(0);" data-id="271" class="add-friend follow-user-btn fa fa-user-plus" disabled=""></a>
                </div>
            </div>
            <div class="suggested-follow-list">
                <a href="javascript:void(0);" class="suggested-follow-img">
                    <img src="{{asset('img/profile-img2.png')}}" alt="Suggested">
                </a>
                <div class="suggested-follow-content">
                    <h5><a href="#" target="_blank" rel="noopener noreferrer">Leena </a></h5>
                    <p><span>0 Reviews</span> / <span>0 Followers</span></p>
                    <a href="javascript:void(0);" data-id="270" class="add-friend follow-user-btn fa fa-user-plus" disabled=""></a>
                </div>
            </div>
            <!-- Suggested Follow List End -->
        </div>

    </div>
</div>
