@extends('layouts.layout')
@section('content')
@include('header')

<main class="main-div">

    <div class="max-container">

      <div class="main-banner" style="background-image:url(img/new-banner.jpg);">
        <div class="container">
          <div class="main-title">Find your next stay</div>
          <p>Search low prices on hotels, resorts and much more</p>
        </div>
      </div>

    </div>

    <div class="container">

      <form>
        <div class="form-box main-form mb-3">
          <div>
            <div class="control-location">
              <input type="text" class="form-control location-icon" placeholder="The Trade Fair Jaipur" disabled="disabled">

            </div>
          </div>
          <div>
            <div class="control-datepiker">
              <input type="datepiker" class="form-control control-calendar-icon" placeholder="Arrival & Departure Date">
            </div>
          </div>

          <div class="dropdown">
            <button type="button" class="control-user form-dropdown dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">15 adults · 0 children · 1 room</button>
            <div class="dropdown-menu p-3 w-100" style="">

              <div class="row mb-2">
                <div class="col-sm-6 col-xs-6">
                  <span>Adults</span>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="indec-field d-flex align-items-center justify-content-between">
                    <div class="dec indec-button">-</div>
                    <input type="text" name="adults-field" id="adults-field" value="0" readonly="readonly">
                    <div class="inc indec-button">+</div>
                  </div>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-sm-6 col-xs-6">
                  <span>Children</span>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="indec-field d-flex align-items-center justify-content-between">
                    <div class="dec indec-button">-</div>
                    <input type="text" name="children-field" id="children-field" value="0" readonly="readonly">
                    <div class="inc indec-button">+</div>
                  </div>
                </div>
              </div>

              <div class="children-box">
                <div class=" ">
                  <select>
                    <option>Age needed</option>
                    <option>0 years old</option>
                    <option>1 year old</option>
                    <option>2 years old</option>
                    <option>3 years old</option>
                    <option>4 years old</option>
                    <option>5 years old</option>
                    <option>6 years old</option>
                    <option>7 years old</option>
                    <option>8 years old</option>
                    <option>9 years old</option>
                    <option>10 years old</option>
                    <option>11 years old</option>
                    <option>12 years old</option>
                    <option>13 years old</option>
                    <option>14 years old</option>
                    <option>15 years old</option>
                    <option>16 years old</option>
                    <option>17 years old</option>
                  </select>
                </div>
                <p>To find you a place to stay that fits your entire group along with correct prices, we need to know how old your child will be at check-out</p>
              </div>

              <div class="row">
                <div class="col-sm-6 col-xs-6">
                  <span>Rooms</span>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="indec-field d-flex align-items-center justify-content-between">
                    <div class="dec indec-button">-</div>
                    <input type="text" name="rooms-field" id="rooms-field" value="0" readonly="readonly">
                    <div class="inc indec-button">+</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Book Now</button>
          </div>

        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
          <label class="form-check-label" for="inlineCheckbox1">I'm looking for an entire home or apartment</label>
        </div>
        
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
          <label class="form-check-label" for="inlineCheckbox2">I'm travelling for work</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option2">
          <label class="form-check-label" for="inlineCheckbox3">I'm travelling for Festival</label>
        </div>

      </form>


      <div class="offers-section">
        <div class="section-title">Offers</div>
        <p class="text-uppercase mb-3">Promotions, deals, and special offers for you</p>

        <div class="owl-carousel owl-theme" id="offser-slider">
          <!-- 1 -->
          <div class="item">
            <div class="offser-list">
              <a href="#" class="offser-list-img">
                <img src="img/offer-img.jpg" alt="Image">
              </a>
              <div class="offser-list-text">
                <div class="offser-list-title"><a href="#">Honeymoon in Rajasthan</a></div>
                <p>Welcome to Pink City- Jaipur. On Arrival proceed to check in the hotel.</p>
                <a href="#" class="btn btn-primary">Search for Hotel</a>
              </div>
            </div>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <div class="offser-list">
              <a href="#" class="offser-list-img">
                <img src="img/offer-img2.jpg" alt="Image">
              </a>
              <div class="offser-list-text">
                <div class="offser-list-title"><a href="#">Honeymoon in Rajasthan</a></div>
                <p>Welcome to Pink City- Jaipur. On Arrival proceed to check in the hotel.</p>
                <a href="#" class="btn btn-primary">Search for Hotel</a>
              </div>
            </div>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <div class="offser-list">
              <a href="#" class="offser-list-img">
                <img src="img/offer-img.jpg" alt="Image">
              </a>
              <div class="offser-list-text">
                <div class="offser-list-title"><a href="#">Honeymoon in Rajasthan</a></div>
                <p>Welcome to Pink City- Jaipur. On Arrival proceed to check in the hotel.</p>
                <a href="#" class="btn btn-primary">Search for Hotel</a>
              </div>
            </div>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <div class="offser-list">
              <a href="#" class="offser-list-img">
                <img src="img/offer-img.jpg" alt="Image">
              </a>
              <div class="offser-list-text">
                <div class="offser-list-title"><a href="#">Honeymoon in Rajasthan</a></div>
                <p>Welcome to Pink City- Jaipur. On Arrival proceed to check in the hotel.</p>
                <a href="#" class="btn btn-primary">Search for Hotel</a>
              </div>
            </div>
          </div>
          <!-- 1 -->
        </div>

      </div>


      <div class="explore-section">
        <div class="section-title">Explore Jaipur</div>
        <p class="text-uppercase mb-3">These popular destinations have a lot to offer</p>

        <div class="owl-carousel owl-theme" id="explore-slider">
          <!-- 1 -->
          <div class="item">
            <a href="#" class="explore-list">
              <div class="explore-list-img">
                <img src="img/explore-6.jpg" alt="Image">
              </div>
              <div class="explore-list-text">
                <div class="explore-list-title">Amber Fort</div>
                <p>2 Properties</p>
              </div>
            </a>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <a href="#" class="explore-list">
              <div class="explore-list-img">
                <img src="img/explore-5.jpg" alt="Image">
              </div>
              <div class="explore-list-text">
                <div class="explore-list-title">Hawa Mahal</div>
                <p>7 Properties</p>
              </div>
            </a>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <a href="#" class="explore-list">
              <div class="explore-list-img">
                <img src="img/explore-4.jpg" alt="Image">
              </div>
              <div class="explore-list-text">
                <div class="explore-list-title">City Palace</div>
                <p>1 Properties</p>
              </div>
            </a>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <a href="#" class="explore-list">
              <div class="explore-list-img">
                <img src="img/explore-3.jpg" alt="Image">
              </div>
              <div class="explore-list-text">
                <div class="explore-list-title">Jantar Mantar</div>
                <p>6 Properties</p>
              </div>
            </a>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <a href="#" class="explore-list">
              <div class="explore-list-img">
                <img src="img/explore-2.jpg" alt="Image">
              </div>
              <div class="explore-list-text">
                <div class="explore-list-title">Jaigarh Fort</div>
                <p>10 Properties</p>
              </div>
            </a>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <a href="#" class="explore-list">
              <div class="explore-list-img">
                <img src="img/explore-1.jpg" alt="Image">
              </div>
              <div class="explore-list-text">
                <div class="explore-list-title">Jal Mahal</div>
                <p>4 Properties</p>
              </div>
            </a>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <a href="#" class="explore-list">
              <div class="explore-list-img">
                <img src="img/explore-4.jpg" alt="Image">
              </div>
              <div class="explore-list-text">
                <div class="explore-list-title">City Palace</div>
                <p>1 Properties</p>
              </div>
            </a>
          </div>
          <!-- 1 -->
        </div>

      </div>


      <div class="properties-section">
        <div class="section-title">Stay at our top unique properties</div>
        <p class="text-uppercase mb-4">From castles and villas to boats and igloos, we have it all</p>

        <div class="owl-carousel owl-theme" id="properties-slider">
          <!-- 1 -->
          <div class="item">
            <div class="properties-list">
              <a href="#" class="properties-list-img">
                <img src="img/properties.jpg" alt="Image">
              </a>
              <div class="properties-list-text">
                <div class="properties-list-title"><a href="#">The Trade International</a></div>
                <p>The Trade International provides a variety of accommodations that rank among the best in Jaipur hotel accommodations.</p>
                <div class="reviews-div">
                  <span class="review-number">9.3</span>
                  <span>Wonderful</span>.<span>141 reviews</span>
                </div>
              </div>
            </div>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <div class="properties-list">
              <a href="#" class="properties-list-img">
                <img src="img/properties2.jpg" alt="Image">
              </a>
              <div class="properties-list-text">
                <div class="properties-list-title"><a href="#">The Trade Bite</a></div>
                <p>Indian, Chinese, and continental influences, Intricate preparations, unique textures, and balanced flavors making Trade Bite a ...</p>
                <div class="reviews-div">
                  <span class="review-number">9.3</span>
                  <span>Wonderful</span>.<span>141 reviews</span>
                </div>
              </div>
            </div>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <div class="properties-list">
              <a href="#" class="properties-list-img">
                <img src="img/properties3.jpg" alt="Image">
              </a>
              <div class="properties-list-text">
                <div class="properties-list-title"><a href="#">Saatfera</a></div>
                <p>We are a youthful company that wants to revolutionize wedding planning in the nation and assist families and couples in ...</p>
                <div class="reviews-div">
                  <span class="review-number">9.3</span>
                  <span>Wonderful</span>.<span>141 reviews</span>
                </div>
              </div>
            </div>
          </div>
          <!-- 1 -->
          <!-- 1 -->
          <div class="item">
            <div class="properties-list">
              <a href="#" class="properties-list-img">
                <img src="img/properties3.jpg" alt="Image">
              </a>
              <div class="properties-list-text">
                <div class="properties-list-title"><a href="#">Saatfera</a></div>
                <p>We are a youthful company that wants to revolutionize wedding planning in the nation and assist families and couples in ...</p>
                <div class="reviews-div">
                  <span class="review-number">9.3</span>
                  <span>Wonderful</span>.<span>141 reviews</span>
                </div>
              </div>
            </div>
          </div>
          <!-- 1 -->
        </div>

      </div>

      <div class="main-blog-section">

        <div class="section-title mb-0">Get inspiration for your next trip</div>
        <p class="text-uppercase mb-4">Lorem Ipsum is simply dummy text of the printing</p>

        <div class="row">
          <div class="col-xl-6 col-lg-6">

            <div class="main-blog">
              <div class="row gx-0 align-items-center">
                <div class="col-lg-5 col-md-5 col-sm-5">
                  <a href="#" class="main-blog-img">
                    <img src="img/blog-img.jpg" alt="Image" class="img-fluid">
                  </a>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7">
                  <div class="blog-inner-text">
                    <div class="main-blog-title"><a href="#">7 best places in Jaipur to celebrate Christmas</a></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="main-blog">
              <div class="row gx-0 align-items-center">
                <div class="col-lg-5 col-md-5 col-sm-5">
                  <a href="#" class="main-blog-img">
                    <img src="img/blog-img2.jpg" alt="Image" class="img-fluid">
                  </a>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7">
                  <div class="blog-inner-text">
                    <div class="main-blog-title"><a href="#">6 magical Christmas experiences in Jaipur</a></div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-xl-6 col-lg-6">
            <div class="main-big-blog">
              <a href="#" class="main-blog-img">
                <img src="img/blog-img3.jpg" alt="Image" class="img-fluid">
              </a>
              <div class="big-blog-inner">
                <div class="main-blog-title"><a href="#">6 best ryokans in Japan to rejuvenate yourself</a></div>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="sign-section">
        <div class="row align-items-center">
          <div class="col-xl-2 col-lg-2 col-md-2">
            <img src="img/logo.png" align="The Trade Fair Brand">
          </div>
          
          <div class="col-xl-7 col-lg-7 col-md-7">
            <div class="sign-title">Get instant discounts</div>
            <p>Simply sign into your  account and get up to 10 % discount</p>
          </div>

          <div class="col-xl-3 col-lg-3 col-md-3">
            <div class="text-end">
              <a href="#" class="btn btn-bordered">Sign in</a>
              <a href="#" class="btn btn-primary">Sign Up</a>
            </div>
          </div>
        </div>
      </div>



      <section class="subscribe-section">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-4">
            <div class="subscribe-title">Save time, save money!</div>
            <p>Sign up and we'll send the best deals to you</p>
          </div>
          <div class="col-lg-5">
            <div class="input-group serch-field">
              <input type="email" class="form-control" placeholder="Your email address" aria-label="" aria-describedby="button-addon2">
              <button class="btn btn-primary" type="button" id="button-addon2">Subscribe</button>
            </div>
          </div>
        </div>
      </section>

    </div>
  </main>

  {{-- @include('models') --}}
@include('footer')


<!-- Slider Script Start -->
<script type="text/javascript">
    $(document).ready(function () {
  
      $("#offser-slider").owlCarousel({
        margin: 24,
        loop: true,
        nav: true,
        navText:['<img src="img/left-icon.png">','<img src="img/right-icon.png">'],
        dots: false,
        items: 2.5,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          992: {
            items: 2.5
          },
          1200: {
            items: 2.5
          },
        },
      });
      
      $("#explore-slider").owlCarousel({
        margin:18,
        loop: true,
        nav: true,
        navText:['<img src="img/left-icon.png">','<img src="img/right-icon.png">'],
        dots: false,
        items: 6,
        autoplay: true,
        smartSpeed: 2500,
        autoplayTimeout: 3500,
        responsiveClass: true,
        responsive: {
          0: {
            items: 2
          },
          600: {
            items: 3
          },
          992: {
            items: 4
          },
          1200: {
            items: 6
          },
        },
      });
  
      
      $("#properties-slider").owlCarousel({
        margin:26,
        loop: true,
        nav: true,
        navText:['<img src="img/left-icon.png">','<img src="img/right-icon.png">'],
        dots: false,
        items: 6,
        autoplay: true,
        smartSpeed: 2600,
        autoplayTimeout: 4200,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          992: {
            items: 2
          },
          1200: {
            items: 3
          },
        },
      });
  
    });
  </script>
  
  <script type="text/javascript">
    $(".indec-button").on("click", function() {
  
      var $button = $(this);
      var oldValue = $button.parent().find("input").val();
  
      if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
      } else {
     // Don't allow decrementing below zero
     if (oldValue > 0) {
      var newVal = parseFloat(oldValue) - 1;
    } else {
      newVal = 0;
    }
  }
  
  $button.parent().find("input").val(newVal);
  
  });
  </script>

  @endsection