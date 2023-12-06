@extends('layouts.layout')
@section('content')
<script type="text/javascript" src="{{asset('js/jquery.star-rating-svg.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/star-rating-svg.css')}}">
<div class="location-page">

    <!-- Sidebar Start -->
    <div class="location-sidebar">
        <div class="location-banner">
            <img src="{{asset('img/banner-img.jpg')}}" alt="Image" class="img-fluid">
        </div>

        <div class="se-pre-con d-none"></div>

        <div class="location-detail space-div">
            <div class="location-title">THE TRADE FAIR - RESORT AND SPA</div>
            <div class="location-slogan">THE ट्रेड FAIR - रेसॉर्ट AND SPA</div>

            <div class="location-rating">
                <div class="row">
                    <div class="col-md-6">
                        <big> {{round($rating_avg, 1, PHP_ROUND_HALF_DOWN) ?? 0}}</big>
                        <i class="fa fa-star"></i>

                        <!-- <i class="fa fa-star-o"></i> -->
                        <span>({{$total_rating ?? 0}})</span>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="dropdown share-drop">
                            <button type="button" class="normal-link dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"><img src="{{asset('img/share-icon.png')}}" alt="Image"></button>
                            <div class="dropdown-menu dropdown-menu-end p-3 w-100">
                                <div class="share-drop-title">Share this property</div>
                                <ul>
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ env('LOCATION_URL') }}" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
                                    </li>
                                    <li><a href="https://twitter.com/intent/tweet?text={{env('APP_NAME')}}&url={{ env('LOCATION_URL') }}" target="_blank"><i class="fa fa-twitter"></i> X (formerly Twitter)</a>
                                    </li>
                                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ env('LOCATION_URL') }}&title={{env('APP_NAME')}}" target="_blank"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
                                    <li><a href="https://wa.me/?text={{env('APP_NAME')}}%20{{ env('LOCATION_URL') }}" target="_blank"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <ul class="nav nav-underline nav-justified" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview-tab-pane" type="button" role="tab" aria-controls="overview-tab-pane" aria-selected="true">Overview</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane" type="button" role="tab" aria-controls="review-tab-pane" aria-selected="false">Review</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about-tab-pane" type="button" role="tab" aria-controls="about-tab-pane" aria-selected="false">About</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel" aria-labelledby="overview-tab" tabindex="0">
                <div class="space-div">
                    <!-- 1 -->
                    <div class="contact-list">
                        <div class="contact-img">
                            <img src="https://www.gstatic.com/images/icons/material/system_gm/1x/place_gm_blue_24dp.png" alt="Image">
                        </div>
                        <div class="contact-text">Jaipur, Ajmer Expy, near RIICO, Bagru, Dhami, Rajasthan 303007</div>
                    </div>
                    <!-- 1 -->

                    <!-- 2 -->
                    <button class="contact-list address-btn" onclick="copy()" data-toggle="tooltip" data-placement="bottom">
                        <div class="contact-img">
                            <img src="https://maps.gstatic.com/mapfiles/maps_lite/images/2x/ic_plus_code.png" alt="Image">
                        </div>
                        <div class="contact-text roadmap-address">RH7H+PG Bagru, Rajasthan <span class="text-success slogan-text" style="display:none;">Copied..!</span></div>
                    </button>
                    <!-- 2 -->

                    <!-- 3 -->
                    <button class="contact-list">
                        <div class="contact-img">
                            <img src="https://maps.gstatic.com/consumer/images/icons/1x/send_to_mobile_alt_gm_blue_24dp.png" alt="Image">
                        </div>
                        <div class="contact-text">Send to your phone</div>
                    </button>
                    <!-- 3 -->

                    <!-- 4 -->
                    <div class="contact-list">
                        <div class="contact-img">
                            <img src="https://gstatic.com/local/placeinfo/schedule_ic_24dp_blue600.png" alt="Image">
                        </div>
                        <div class="contact-text">Check-in time: 12:00 am<br>Check-out time: 11:00 am</div>
                    </div>
                    <!-- 4 -->
                </div>

                <div class="photos-div space-div">
                    <div class="side-title">Photos</div>
                    <div class="owl-carousel owl-theme" id="photos-slider">
                        @if(!empty($all_images))
                        @foreach(json_decode($all_images, true) as $key => $value)
                        <div class="item" data-bs-toggle="modal" data-bs-target="#gallery-popup">
                            <div class="photos-div-list">
                                <img src="{{ env('BACKEND_URL') . 'show-images/' . $value }}" alt="Image">
                                <!-- <span>All</span> -->
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="hotel-details space-div">
                    <div class="side-title">Hotel details</div>
                    <ul class="amenities-div">
                        <li><img src="{{asset('img/internet-icon.png')}}"> <span>Free Wi-Fi</span></li>
                        <li><img src="{{asset('img/food-drink-icon.png')}}"> <span>Free breakfast</span></li>
                        <li><img src="{{asset('img/main-ame-icon4.png')}}"> <span>Free parking</span></li>
                        <li><img src="{{asset('img/accessibility-img.png')}}"> <span>Accessible</span></li>
                        <li><img src="{{asset('img/main-ame-icon2.png')}}"> <span>Indoor and outdoor pool</span></li>
                        <li><img src="{{asset('img/ac-icon.png')}}"> <span>Air-conditioned</span></li>
                        <li><img src="{{asset('img/cleaning-services-icon.png')}}"> <span>Laundry service</span></li>
                        <li><img src="{{asset('img/business-facilities-icon.png')}}"> <span>Business centre</span></li>
                    </ul>
                </div>

            </div>
            <div class="tab-pane fade" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab" tabindex="0">

                <div class="space-div bdr-none">
                    <div class="side-title">Review summary</div>
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-7 col-md-7">
                            <!-- 1 -->
                            <div class="progress-side">
                                <span class="serial-number-span">5</span>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{$five_rating}}" aria-valuemin="0" aria-valuemax="{{$five_rating}}">
                                    <div class="progress-bar" style="width: {{$five_rating}}%"></div>
                                </div>
                            </div>
                            <!-- 1 -->

                            <!-- 1 -->
                            <div class="progress-side">
                                <span class="serial-number-span">4</span>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{$four_rating}}" aria-valuemin="0" aria-valuemax="{{$four_rating}}">
                                    <div class="progress-bar" style="width: {{$four_rating}}%"></div>
                                </div>
                            </div>
                            <!-- 1 -->

                            <!-- 1 -->
                            <div class="progress-side">
                                <span class="serial-number-span">3</span>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{$three_rating}}" aria-valuemin="0" aria-valuemax="{{$three_rating}}">
                                    <div class="progress-bar" style="width: {{$three_rating}}%"></div>
                                </div>
                            </div>
                            <!-- 1 -->

                            <!-- 1 -->
                            <div class="progress-side">
                                <span class="serial-number-span">2</span>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{$two_rating}}" aria-valuemin="0" aria-valuemax="{{$two_rating}}">
                                    <div class="progress-bar" style="width: {{$two_rating}}%"></div>
                                </div>
                            </div>
                            <!-- 1 -->

                            <!-- 1 -->
                            <div class="progress-side">
                                <span class="serial-number-span">1</span>
                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{$one_rating}}" aria-valuemin="0" aria-valuemax="{{$one_rating}}">
                                    <div class="progress-bar" style="width: {{$one_rating}}%"></div>
                                </div>
                            </div>
                            <!-- 1 -->

                        </div>

                        <div class="col-xl-5 col-lg-5 col-md-5">
                            <div class="big-rating">
                                <div class="main-rating">{{round($rating_avg, 1, PHP_ROUND_HALF_DOWN) ?? 0}}</div>
                                <div class="big-rating-stars">
                                    <i class="fa fa-star"></i>

                                </div>
                                <div class="main-rating-review">{{$total_rating ?? 0}} reviews</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-5 mb-3">
                        {{-- @if(Auth::check()) --}}
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#write-review-popup">Write a review</button>
                        {{-- @else
                        <a href="javascript:void(0)" class="btn btn-primary login-with-google">Write a review</a>
                        @endif --}}
                    </div>
                    <div class="review-div-listing">

                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="about-tab-pane" role="tabpanel" aria-labelledby="about-tab" tabindex="0">
                <div class="hotel-details space-div bdr-none">
                    <div class="side-title">Hotel details</div>

                    <ul class="amenities-div">
                        <li><img src="{{asset('img/internet-icon.png')}}"> <span>Free Wi-Fi</span></li>
                        <li><img src="{{asset('img/food-drink-icon.png')}}"> <span>Free breakfast</span></li>
                        <li><img src="{{asset('img/main-ame-icon4.png')}}"> <span>Free parking</span></li>
                        <li><img src="{{asset('img/accessibility-img.png')}}"> <span>Accessible</span></li>
                        <li><img src="{{asset('img/main-ame')}}-icon2.png"> <span>Indoor and outdoor pool</span></li>
                        <li><img src="{{asset('img/ac-icon.png')}}"> <span>Air-conditioned</span></li>
                        <li><img src="{{asset('img/cleaning-services-icon.pn')}}g"> <span>Laundry service</span></li>
                        <li><img src="{{asset('img/business-facilities-icon.png')}}"> <span>Business centre</span></li>
                        <li><img src="{{asset('img/pets-icon.png')}}"> <span>Pet-friendly</span></li>
                        <li><img src="{{asset('img/main-ame-icon.png')}}"> <span>Room service</span></li>
                        <li><img src="{{asset('img/child_friendly.png')}}"> <span>Child friendly</span></li>
                        <li><img src="{{asset('img/food-drink-icon.png')}}"> <span>Restaurant</span></li>
                        <li><img src="{{asset('img/main-ame-icon5.png')}}"> <span>Hot tub</span></li>
                        <li><img src="{{asset('img/wellness-icon.png')}}"> <span>Spa</span></li>
                        <li><img src="{{asset('img/fitness_center.png')}}"> <span>Fitness centre</span></li>
                        <li><img src="{{asset('img/activities-icon.png')}}"> <span>Golf course</span></li>
                        <li><img src="{{asset('img/local_bar.png')}}"> <span>Bar</span></li>
                        <li><img src="{{asset('img/smoke_free.png')}}"> <span>Smoke-free</span></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- Sidebar End -->

    <div class="location-box">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.806734146669!2d75.57676228378044!3d26.814281784688454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4918bba8a0c9%3A0x83eddb262ee1cb8b!2sTHE%20TRADE%20FAIR%20-%20RESORT%20AND%20SPA!5e0!3m2!1sen!2sin!4v1701084321402!5m2!1sen!2sin" width="1850" height="910" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

</div>

<!-- Gallery Popup Modal -->
<div class="modal fade" id="gallery-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id="gallery" class="gallery-grid">
                    @if(!empty($all_images))
                    @foreach(json_decode($all_images, true) as $key => $value)
                    <div class="box">
                        <img src="{{ env('BACKEND_URL') . 'show-images/' . $value }}" alt="Image">
                    </div>
                    @endforeach
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="write-review-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title fs-5">THE TRADE FAIR - RESORT AND SPA</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" id="reviewForm" class="form-validate reviewForm" action="{{ url('submit-booking-engine-reviews')}}" enctype="multipart/form-data">
                @csrf
            <div class="review-list-top ">
                @if(Auth::check())
                    @if(!is_null(Auth::user()->image))
                    <img src="{{ env('BACKEND_URL') . 'show-images/' . Auth::user()->image }}" alt="Image">
                    @else
                    <div class="review-list-img"><img src="{{ asset('img/dummy.png')}}" alt="Default Image"></div>
                    @endif
                   
                    <div class="review-list-text">
                        <div class="review-list-name review-user-name " name="name">{{Auth::user()->first_name}}</div>
                        <div class="review-list-number">Posting publicly</div>
                    </div>
                @endif
            </div>

            <div class="big-rating-stars mb-3 text-center">
                <div class="my-rating"></div>
                <input type="hidden" name="rating" class="rating">
            </div>

            <div class="mb-3">
                <h3>Rooms</h3>
                <span class="my-room-rating"></span>
                <input type="hidden" name="room_rating" class="room-rating">
            </div>
            <div class="mb-3">
                <h3>Service</h3>
                <span class="my-service-rating"></span>
                <input type="hidden" name="service_rating" class="service-rating">
            </div>
            <div class="mb-3">
                <h3>Location</h3>
                <span class="my-location-rating"></span>
                <input type="hidden" name="location_rating" class="location-rating">
            </div>

            <div class="mb-3">
              <textarea class="form-control" name="description" rows="6" placeholder="Share details of your own experience at this place"></textarea>
            </div>

            <div class="mb-3 d-grid">
              <label for="">Add photos & videos</label>
              <input type="file" name="image" id="image" class="btn btn-primary image-input" />
                <span id="error-container"></span>
            </div>

            <div class="mb-3">
                <div class="side-title">What kind of trip was it?</div>
                <div class="selecte-listing selected-kind_of_trip-listing">
                  <button type="button" class="selecte-list selecte-kind_of_trip-list">Business</button>
                  <button type="button" class="selecte-list selecte-kind_of_trip-list">Vacation</button>
                </div>
            </div>
            <input type="hidden" class="kind_of_trip" name="kind_of_trip[]" />

            <div class="mb-3">
                <div class="side-title">Who did you travel with?</div>
                <div class="selecte-listing selected-travel_with-listing">
                  <button type="button" class="selecte-list selecte-travel_with-list">Family</button>
                  <button type="button" class="selecte-list selecte-travel_with-list">Friends</button>
                  <button type="button" class="selecte-list selecte-travel_with-list">Couple</button>
                  <button type="button" class="selecte-list selecte-travel_with-list">Solo</button>
                </div>
            </div>
            <input type="hidden" class="travel_with" name="travel[]" />

            <div class="mb-3">
            <div class="side-title mb-0">How would you describe the hotel?</div>
            <div class="side-subtitle mb-2">(Select all that apply)</div>

            <div class="selecte-listing selected-describe_hotel-listing">
                <button type="button" class="selecte-list selecte-describe_hotel-list">Luxury</button>
                <button type="button" class="selecte-list selecte-describe_hotel-list">Great View</button>
                <button type="button" class="selecte-list selecte-describe_hotel-list">Romantic</button>
                <button type="button" class="selecte-list selecte-describe_hotel-list">Quiet</button>
                <button type="button" class="selecte-list selecte-describe_hotel-list">Kid-friendly</button>
                <button type="button" class="selecte-list selecte-describe_hotel-list">Great value</button>
                <button type="button" class="selecte-list selecte-describe_hotel-list">High tech</button>
            </div>
            </div>
              <input type="hidden" class="describe_hotel" name="describe_hotel[]" />

              <div class="mb-3">
                <div class="side-title mb-0">Can you say more about any of these topics?</div>
                <div class="side-subtitle mb-2">(Select all that apply)</div>
  
                <div class="selecte-listing selected_more_about_listing">
                  <button type="button" class="selecte-list selecte-more_about_list">Rooms</button>
                  <button type="button" class="selecte-list selecte-more_about_list">Nearby activities</button>
                  <button type="button" class="selecte-list selecte-more_about_list">Safety</button>
                  <button type="button" class="selecte-list selecte-more_about_list">Walkability</button>
                  <button type="button" class="selecte-list selecte-more_about_list">Food & drinks</button>
                  <button type="button" class="selecte-list selecte-more_about_list">Noteworthy Detail</button>
                </div>
              </div>
              <input type="hidden" class="more_about" name="more_about[]" /> 
            <hr>

            <div class="text-end">
                <button type="button" class="btn btn-primary submit-reviews">Post</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>

            
          </form>

        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
    $(document).ready(function() {

        $('.login-with-google').click(function(){
            $(".se-pre-con").removeClass('d-none');

            setTimeout(() => {
                $(".se-pre-con").fadeOut("slow");
                window.location.href = "{{ url('auth/google') }}";
            }, 2000);

        })

        $(".my-rating").starRating({
            starSize: 25,
            disableAfterRate: false,
            callback: function(currentRating, $el) {
                $('.rating').val(currentRating);
            },
        });

        $(".my-room-rating").starRating({
            starSize: 25,
            disableAfterRate: false,
            callback: function(currentRating, $el) {
                $('.room-rating').val(currentRating);
            },
        });

        $(".my-service-rating").starRating({
            starSize: 25,
            disableAfterRate: false,
            callback: function(currentRating, $el) {
                $('.service-rating').val(currentRating);
            },
        });

        $(".my-location-rating").starRating({
            starSize: 25,
            disableAfterRate: false,
            callback: function(currentRating, $el) {
                $('.location-rating').val(currentRating);
            },
        });

        var kind_of_trip = [];
        var describe_hotel = [];
        var travel = [];
        var more_about = [];

        $('.selected-travel_with-listing .selecte-travel_with-list').click(function() {
            $(this).toggleClass("active");
            if ($(this).hasClass("active")) {
                travel.push($(this).text());
            } else {
                const index1 = travel.indexOf($(this).text());
                if (index1 > -1) { // only splice array when item is found
                    travel.splice(index1, 1); // 2nd parameter means remove one item only
                }
            }
            $('.travel_with').val(travel)
        });

        $('.selected-describe_hotel-listing .selecte-describe_hotel-list').click(function() {
            $(this).toggleClass("active");
            if ($(this).hasClass("active")) {
                describe_hotel.push($(this).text());
            } else {
                const index2 = describe_hotel.indexOf($(this).text());
                if (index2 > -1) { // only splice array when item is found
                    describe_hotel.splice(index2, 1); // 2nd parameter means remove one item only
                }
            }
            $('.describe_hotel').val(describe_hotel)
        });

        $('.selected_more_about_listing .selecte-more_about_list').on('click',function() {
            $(this).toggleClass("active");
            if ($(this).hasClass("active")) {
                more_about.push($(this).text());
            } else {
                const index3 = more_about.indexOf($(this).text());
                if (index3 > -1) { // only splice array when item is found
                    more_about.splice(index3, 1); // 2nd parameter means remove one item only
                }
            }
            $('.more_about').val(more_about)
        
        });

        $('.selected-kind_of_trip-listing .selecte-kind_of_trip-list').click(function() {
            $(this).toggleClass("active");
            if ($(this).hasClass("active")) {
                kind_of_trip.push($(this).text());
            } else {
                const index4 = kind_of_trip.indexOf($(this).text());
                if (index4 > -1) { // only splice array when item is found
                    kind_of_trip.splice(index4, 1); // 2nd parameter means remove one item only
                }
            }
            $('.kind_of_trip').val(kind_of_trip)
        });

        //topRight, bottomLeft, centerRight, bottomRight, inline
        $('#reviewForm').validationEngine({
            promptPosition: "bottomLeft"
        });

        $('.submit-reviews').click(function() {
                var imageInput = $('.image-input')[0].files[0];
                var formData = new FormData();
                formData.append("rating", $('.rating').val());
                formData.append("room_rating", $('.room-rating').val());
                formData.append("service_rating", $('.service-rating').val());
                formData.append("location_rating", $('.location-rating').val());
                formData.append('image',imageInput);
                formData.append("name", $('.review-user-name').text());
                formData.append("description", $('textarea[name="description"]').val());
                formData.append("travel", $('.travel_with').val());
                formData.append("describe_hotel", $('.describe_hotel').val());
                formData.append("kind_of_trip", $('.kind_of_trip').val());
                formData.append("more_about", $('.more_about').val());
                $.ajax({
                    url: "submit-booking-engine-reviews",
                    type: "post",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                title: "",
                                text: response.message,
                                icon: 'success'
                            });

                            setTimeout(() => {
                                location.reload()
                            }, 4000);

                        } else {
                            Swal.fire({
                                title: "",
                                text: response.message,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { 
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#error-container').append('<p class="text-danger">' + value[0] + '</p>');
                            });
                        }else  if (xhr.status === 500) { 
                            Swal.fire({
                                title: "",
                                text: "Please fill with correct details",
                                icon: 'error'
                            });
                        }
                    }
                })
        })

        //get all room galllery images
        $.ajax({
            url: "api/get-all-reviews-api",
            type: "get",
            success: function(response) {
                $('.review-div-listing').html(response)
            }
        });
    });

    var $temp = $("<input>");
    var $url = $(location).attr('href');

    function copy() {
        $("body").append($temp);
        $temp.val($url).select();
        document.execCommand("copy");
        $temp.remove();
        $('.slogan-text').show()
        setTimeout(function() {
            $('.slogan-text').hide()
        }, 3000);
    }
</script>

@endsection