@extends('layouts.layout')
@section('content')

<div class="location-page">

    <!-- Sidebar Start -->
    <div class="location-sidebar">
        <div class="location-banner">
            <img src="{{asset('img/banner-img.jpg')}}" alt="Image" class="img-fluid">
        </div>
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
                <!-- <div class="photos-div space-div">
                    <div class="side-title">Photos</div>
                    <div class="owl-carousel owl-theme" id="photos-slider"></div>
                </div> -->

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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#write-review-popup">Write a review</button>
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

<!-- Gallery Popup Modal -->
<div class="modal fade" id="write-review-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title fs-5">THE TRADE FAIR - RESORT AND SPA</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="reviewForm" class="form-validate reviewForm" action="{{ url('submit-booking-engine-reviews')}}" enctype="multipart/form-data">
                    @csrf()
                    <div class="big-rating-stars mb-3">
                        <div class="my-rating"></div>
                        <input type="hidden" name="rating" class="rating">
                    </div>

                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control validate[required]" name="name">
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control validate[required]" name="description" rows="6" placeholder="Share details of your own experience at this place"></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="side-title mb-0">How would you describe the hotel?</div>
                        <div class="side-subtitle mb-2">(Select all that apply)</div>

                        <div class="selecte-listing">
                            <button type="button" class="selecte-list">Luxury</button>
                            <button type="button" class="selecte-list">Great View</button>
                            <button type="button" class="selecte-list">Romantic</button>
                            <button type="button" class="selecte-list">Quiet</button>
                            <button type="button" class="selecte-list">Kid-friendly</button>
                            <button type="button" class="selecte-list">Great value</button>
                            <button type="button" class="selecte-list">High tech</button>
                        </div>
                    </div>

                    <input type="hidden" class="liked_facilities" name="liked[]" />

                    <hr>

                    <div class="text-end">
                        <button type="button" class="btn btn-primary submit-reviews">Submit Your Review</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        $(".my-rating").starRating({
            totalStars: 5,
            starShape: 'rounded',
            starSize: 40,
            emptyColor: 'lightgray',
            hoverColor: 'salmon',
            activeColor: 'crimson',
            useGradient: false,
            disableAfterRate: false,
            callback: function(currentRating, $el) {
                $('.rating').val(currentRating)
            },

        });

        var facilities = [];

        $('.selecte-listing .selecte-list').click(function() {
            $(this).toggleClass("active");
            if ($(this).hasClass("active")) {
                facilities.push($(this).text());
            } else {
                const index = facilities.indexOf($(this).text());
                if (index > -1) { // only splice array when item is found
                    facilities.splice(index, 1); // 2nd parameter means remove one item only
                }
            }
            $('.liked_facilities').val(facilities)
        });


        //topRight, bottomLeft, centerRight, bottomRight, inline
        $('#reviewForm').validationEngine({
            promptPosition: "bottomLeft"
        });

        $('.submit-reviews').click(function() {
            var isValidate = $('#reviewForm').validationEngine('validate')
            if (isValidate) {
                var formData = new FormData();
                formData.append("rating", $('.rating').val());
                formData.append("name", $('input[name="name"]').val());
                formData.append("description", $('textarea[name="description"]').val());
                formData.append("liked", $('.liked_facilities').val());

                $.ajax({
                    url: "api/submit-reviews",
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
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
                    }
                })
            }
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

<!-- 
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
</script> -->


@endsection