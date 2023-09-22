
<footer class="footer-section">
    <div class="container">
      <div class="row">

        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-md-6 col-sm-6">
          <div class="footer-title">CORPORATE</div>
          <ul>
            {{-- <li><a href="aboutus.html">About us</a></li> --}}
            <li><a href="{{route('about')}}">About us</a></li>
            <li><a href="javascript:void(0)">Management</a></li>
            <li><a href="{{ url('corporte-meeting-halls') }}">Corporate Meeting</a></li>
            <li><a href="javascript:void(0)">Vision, mission & values</a></li>
            <li><a href="javascript:void(0)">Why book with us directly</a></li>
            <li><a href="javascript:void(0)">Award</a></li>
            <li><a href="{{ url('career') }}">Career</a></li>
            <li><a href="{{url('gallery')}}">Gallery</a></li>
            <li><a href="{{ url('blog') }}">Blogs</a></li>
            <li><a href="{{ url('terms')}}">Terms & conditions</a></li>
          </ul>
        </div>
        <!-- Col End -->
        
        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-md-6 col-sm-6">
          <div class="footer-title">BOOKINGS</div>
          <ul>
            <li><a href="{{env('HOTEL_URL')}}" target="_blank">OUR HOTELS</a></li>
            <li><a href="{{ url('wedding') }}" >OUR WEDDING HALLS</a></li>
            <li><a href="{{ env('RESTAURANT_URL')}}" target="_blank">OUR RESTAURANTS</a></li>
            <li><a href="{{ route('spa') }}">OUR SPA</a></li>
            <li><a href="{{url('event')}}">OUR EVENTS</a></li>
            <li><a href="{{ route('contact')}}">CONTACT US</a></li>
          </ul>

          <div class="footer-title">MEDIA</div>
          <ul>
            <li><a href="javascript:void(0)">MEDIA </a></li>
            <li><a href="javascript:void(0)">COVERAGE</a></li>
          </ul>
        </div>
        <!-- Col End -->
        
        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-md-6 col-sm-6">
          <div class="footer-title">TRIPADVISOR</div>
          <ul class="mb-2">
            <li><a href="javascript:void(0)">HOTEL REVIEWS BY</a></li>
          </ul>

          <a href="javascript:void(0)" class="tripadvisor-icon"><img src="{{ asset('img/tripadvisor-icon.png')}}" alt="TRIPADVISOR"></a>

          <div class="footer-title">The Trade Fair  BY YOU</div>

          <p class="by-text">Staying at the thetradefair, as captured by our guests. Share your own experiences with #thetradefair <a href="javascript:void(0)" class="mt-3">Feedback</a></p>
        </div>
        <!-- Col End -->

        
        <!-- Col Start -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-md-6 col-sm-6">
          <!-- 1 -->
          <div class="footer-contact-list">
            <img src="{{asset('img/call-icon2.png')}}">
            <div class="footer-contact-detail">
              <div class="footer-contact-title">Phone</div>
                <a href="tel:{{ $settings['tradefair_contact_number'] ?? '' }}" class="footer-contact-detail">
                
                {{ $settings['tradefair_contact_number'] ?? ''}}</a>
               
              
            </div>
          </div>
          <!-- 1 -->

          <!-- 1 -->
          <div class="footer-contact-list">
            <img src="{{asset('img/email-icon2.png')}}">
            <div class="footer-contact-detail">
              <div class="footer-contact-title">Email</div>
                <a href="mailto:{{ $settings['tradefair_email'] ?? ''}}" class="footer-contact-detail">{{ $settings['tradefair_email'] ?? '' }}</a>
               
            </div>
          </div>
          <!-- 1 -->
          
          <!-- 1 -->
          <div class="footer-contact-list">
            <img src="{{asset('img/location-icon.png')}}">
            <div class="footer-contact-detail">
              <div class="footer-contact-title">Location</div>
              <address class="footer-contact-detail">{{ $settings['address'] ?? '' }}</address>
            </div>
          </div>
          <!-- 1 -->
          
        </div>
        <!-- Col End -->

      </div>

      <div class="copyright">
        <div class="header-social order-md-last order-sm-last">
            <a href="{{ $settings['ttf_instagram_url'] ?? ''}}" class="fa fa-instagram"></a>
            <a href="{{ $settings['ttf_twitter_url'] ?? ''}}" class="fa fa-twitter"></a>
            <a href="{{ $settings['ttf_facebook_url'] ?? '' }}" class="fa fa-facebook"></a>
            <a href="{{ $settings['ttf_linkedin_url'] ?? ''}}" class="fa fa-linkedin"></a>
        </div>
        <p>&copy; 2023 Resort The Trade Fair All Rights Reserved</p>
      </div>
    </div>
  </footer>
 