@extends('layouts.layout')
@section('content')
@include('header')

<main class="main-div">
    <div class="container">
        <div class="row">

            <div class="col-xl-3 col-lg-3">
                <div class="light-primary">
                    <button type="button" class="price-match-btn" data-bs-toggle="modal" data-bs-target="#we-price-match"><img src="{{asset('img/price-icon.png')}}" alt="Image">We Price Match</button>
                </div>

                <!-- filter form start-->
                <div class="room_filter_block"></div>
                <!-- filter form end-->

                <div class="map-box" style="background-image:url({{asset('img/google-map.jpg')}});">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#google-map-popup">Show on map</button>
                </div>

            </div>



            <div class="col-xl-9 col-lg-9">
                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="javascript:void(0)">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#info-and-prices">Info & prices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#facilities">Facilities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#house-rules">House rules</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="row">

                    <div class="col-xl-3 col-lg-3 order-lg-last">
                        <div class="reserve-btns-div">

                            <div class="dropdown share-drop">
                                <button type="button" class="normal-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"><img src="{{asset('img/share-icon.png')}}" alt="Image"></button>
                                <div class="dropdown-menu dropdown-menu-end p-3 w-100">
                                    <div class="share-drop-title">Share this property</div>
                                    <ul>



                                        <li><a href="javascript:void(0)" class="clipboard"><i class="fa fa-copy"></i> <span id="copyText">Copy link</a>
                                        </li>

                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{env('TTF_URL')}}" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
                                        </li>
                                        <li><a href="https://twitter.com/intent/tweet?text={{env('APP_NAME')}}&url={{env('TTF_URL')}}" target="_blank"><i class="fa fa-twitter"></i> X (formerly Twitter)</a>
                                        </li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{env('TTF_URL')}}&title={{env('APP_NAME')}}" target="_blank"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
                                        <li><a href="https://wa.me/?text={{env('APP_NAME')}}%20{{env('TTF_URL')}}" target="_blank"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
                                    </ul>

                                </div>
                            </div>

                            <button class="btn btn-primary" type="button">Reserve</button>
                            <div class="price-match-div">
                                <button type="button" class="price-match-btn" data-bs-toggle="modal" data-bs-target="#we-price-match"><img src="{{asset('img/price-icon.png')}}" alt="Image">We Price Match</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9">

                        <div class="resort-title">The trade Fair - Resort and Spa</div>

                        <address class="address-tag"><img src="{{asset('img/location-icon.png')}}" alt="Image">
                            {{ $settings['address'] }} – <button class="showmap-link" data-bs-toggle="modal" data-bs-target="#google-map-popup">Show map</button>
                        </address>
                    </div>
                </div>



                <div class="photography-div" data-bs-toggle="modal" data-bs-target="#gallery-popup">
                    @if ($room && $count != null)
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="height-photo mb-10">
                                <img src="{{ env('BACKEND_URL') . 'show-images/' . $resultArray[0] }}" alt="Image" class="img-fluid">
                            </div>

                            <div class="height-photo">
                                <img src="{{ env('BACKEND_URL') . 'show-images/' . $resultArray[1] }}" alt="Image" class="img-fluid">
                            </div>

                        </div>
                        <div class="col-xl-8">
                            <div class="height-photo2">
                                <img src="{{ env('BACKEND_URL') . 'show-images/' . $resultArray[2] }}" alt="Image" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="flex-photo">
                        @for ($i = 3; $i < 7; $i++) <div>
                            <img src="{{ env('BACKEND_URL') . 'show-images/' . $resultArray[$i] }}" alt="Image" class="img-fluid">
                    </div>
                    @endfor
                    <div style="position: relative;">
                        <div class="photos-remain">
                            <span>View All Photos</span>
                        </div>
                        <img src="{{ env('BACKEND_URL') . 'show-images/' . $resultArray[0] }}" alt="Image" class="img-fluid">
                    </div>
                </div>
                @endif
            </div>

        </div>

    </div>

    <section class="main-facilities">

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon.png')}}" alt="Image">
            <span>Breakfast</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon2.png')}}" alt="Image">
            <span>Outdoor swimming pool</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon3.png')}}" alt="Image">
            <span>Restaurant</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon4.png')}}" alt="Image">
            <span>Free parking</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon5.png')}}" alt="Image">
            <span>Private bathroom</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon6.png')}}" alt="Image">
            <span>Balcony</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon7.png')}}" alt="Image">
            <span>Balcony</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon8.png')}}" alt="Image">
            <span>Spa and wellness centre</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon9.png')}}" alt="Image">
            <span>View</span>
        </div>

        <div class="main-facilities-list">
            <img src="{{asset('img/main-ame-icon10.png')}}" alt="Image">
            <span>Airport shuttle (free)</span>
        </div>

    </section>


    <section class="property-hig-section">
        <div class="row">
            <div class="col-lg-9">
                <p>Situated in Dahmi, 27 km from Jaipur Railway Station, THE TRADE FAIR - RESORT AND SPA features accommodation with an outdoor swimming pool, free private parking, a fitness centre and a garden. Among the various facilities of this property are a shared lounge, a bar and water sports facilities. The accommodation offers a kids' club, a shared kitchen and currency exchange for guests.</p>

                <p>The resort will provide guests with air-conditioned rooms with a desk, a kettle, a fridge, a minibar, a safety deposit box, a flat-screen TV, a terrace and a private bathroom with a bidet. THE TRADE FAIR - RESORT AND SPA provides some rooms with pool views, and every room is fitted with a balcony. At the accommodation rooms come with bed linen and towels.</p>

                <p>Breakfast is available each morning, and includes buffet, à la carte and continental options. At THE TRADE FAIR - RESORT AND SPA you will find a restaurant serving Chinese, Indian and Italian cuisine. Vegetarian, dairy-free and halal options can also be requested.</p>

                <p>The resort offers a children's playground. You can play table tennis, mini-golf and tennis at THE TRADE FAIR - RESORT AND SPA, and the area is popular for cycling.</p>

                <p>Languages spoken at the reception include English and Hindi, and guests are invited to request advice on the area when needed.</p>

                <p>Govind Dev Ji Temple is 27 km from the accommodation, while Birla Mandir Temple, Jaipur is 29 km from the property. The nearest airport is Jaipur International Airport, 30 km from THE TRADE FAIR - RESORT AND SPA.</p>

                <p>Distance in property description is calculated using © OpenStreetMap</p>

                <div class="most-facilities">
                    <div class="blue-title">Most popular facilities</div>
                    <div class="most-facilities-listing">

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon.png')}}" alt="Image"></big>
                            <span>Outdoor swimming pool</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon2.png')}}" alt="Image"></big>
                            <span>Free parking</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon3.png')}}" alt="Image"></big>
                            <span>Airport shuttle (free)</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon4.png')}}" alt="Image"></big>
                            <span>Room Service</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon5.png')}}" alt="Image"></big>
                            <span>Spa and wellness centre</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon6.png')}}" alt="Image"></big>
                            <span>Restaurant</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon7.png')}}" alt="Image"></big>
                            <span>Free WiFi</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon8.png')}}" alt="Image"></big>
                            <span>Tea/coffee maker in all rooms</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon9.png')}}" alt="Image"></big>
                            <span>Bar</span>
                        </div>

                        <div class="most-facilities-list">
                            <big><img src="{{asset('img/most-ame-icon10.png')}}" alt="Image"></big>
                            <span>Breakfast</span>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="pro-hig-box">
                    <div class="pro-hig-box-title">Property highlights</div>
                    <div class="pro-hig-box-subtitle">Breakfast info</div>
                    <p>Continental, Italian, Full English/Irish, Vegetarian, Halal, Gluten-free, Asian, American, Buffet, Breakfast to go</p>

                    <div class="parking-div">
                        <img src="{{asset('img/parking-icon.png')}}" alt="image">
                        <span>Free private parking available on-site</span>
                    </div>

                    <div class="pro-hig-box-subtitle">Activities:</div>
                    <p>Tennis court</p>
                    <p>Fitness centre</p>
                    <p>Golf course (within 3 km)</p>

                    <div class="d-grid mt-4">
                        <a href="#RoomReservation" class="btn btn-secondary">Reserve</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="availability-section" id="info-and-prices">
        <div class="row" id="availability-section">

            <div class="col-lg-8 col-md-9">
                <div class="section-title">Availability</div>
            </div>

            <div class="col-lg-4 col-md-3 text-end">
                <button type="button" class="price-match-btn" data-bs-toggle="modal" data-bs-target="#we-price-match"><img src="{{asset('img/price-icon.png')}}" alt="Image">We Price Match</button>
            </div>

        </div>

        <div class="table-sec">
            <div class="table-responsive room-reserve-table" id="RoomReservation">
            </div>
        </div>
        <div class="bordshad-div">
            <div class="row align-items-center">
                <div class="col-lg-10 col-md-10">
                    <div class="chat-div">
                        <div class="chat-img"><img src="{{asset('img/chat-icon.png')}}" alt="Image"></div>
                        <div>
                            <div class="chat-title">Property questions and answers</div>
                            <p class="fn-14 mb-0">Send a question to the property to find out more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="learn-div">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ask-question-popup">Ask a question</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="property-surroundings">
        <div class="row mb-4">

            <div class="col-lg-8 col-md-9">
                <div class="section-title">Property surroundings</div>
                <a href="javascript:void(0)" class="text-primary" data-bs-toggle="modal" data-bs-target="#google-map-popup">Show map</a>
            </div>

            <div class="col-lg-4 col-md-3 text-end">
                <a href="#availability-section" class="btn btn-primary">See availability</a>
            </div>

        </div>

        <div class="row">

            <!-- Col Start -->
            <div class="col-lg-4 col-md-4 col-sm-6">

                <div class="surroundings-title">
                    <img src="{{asset('img/nearby-icon.png')}}" alt="Image">
                    <span>What's nearby</span>
                </div>
                <div class="nearby-listing">
                    <div class="nearby-list">
                        <span>Khem didi park</span>
                        <span>18 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Nandan Kadan</span>
                        <span>18 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Ravi park</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Sector 82 Park</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Children Park</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Sai Udhyaan</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Veer Tejaji Park</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Adhaytm Vigyan Park</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Park</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Kid Park</span>
                        <span>19 km</span>
                    </div>
                </div>

            </div>
            <!-- Col End -->

            <!-- Col Start -->
            <div class="col-lg-4 col-md-4 col-sm-6">

                <div class="surroundings-title">
                    <img src="{{asset('img/restaurants-cafes-icon.png')}}" alt="Image">
                    <span>Restaurants & cafes</span>
                </div>

                <div class="nearby-listing">
                    <div class="nearby-list">
                        <span><strong>Restaurant -</strong> Chanakya</span>
                        <span>18 km</span>
                    </div>

                    <div class="nearby-list">
                        <span><strong>Cafe/bar -</strong> Green Leaf Cafe</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span><strong>Restaurant -</strong> Hotel Raj Style Inn</span>
                        <span>19 km</span>
                    </div>
                </div>



                <div class="nearby-listing">
                    <div class="surroundings-title">
                        <img src="{{asset('img/public-transport-icon.png')}}" alt="Image">
                        <span>Public transport</span>
                    </div>

                    <div class="nearby-list">
                        <span><strong>Train -</strong> Bobas</span>
                        <span>11 km</span>
                    </div>

                    <div class="nearby-list">
                        <span><strong>Train -</strong> Dhanakya</span>
                        <span>12 km</span>
                    </div>

                    <div class="nearby-list">
                        <span><strong>Metro -</strong> Manasarovar</span>
                        <span>19 km</span>
                    </div>

                    <div class="nearby-list">
                        <span><strong>Metro -</strong> New Aatish Market</span>
                        <span>20 km</span>
                    </div>
                </div>

            </div>
            <!-- Col End -->

            <!-- Col Start -->
            <div class="col-lg-4 col-md-4 col-sm-6">

                <div class="surroundings-title">
                    <img src="{{asset('img/closest-airports-icon.png')}}" alt="Image">
                    <span>Closest airports</span>
                </div>
                <div class="nearby-listing">
                    <div class="nearby-list">
                        <span>Jaipur International Airport</span>
                        <span>22 km</span>
                    </div>

                    <div class="nearby-list">
                        <span>Kishangarh Airport</span>
                        <span>79 km</span>
                    </div>
                </div>

            </div>
            <!-- Col End -->

        </div>

        <p class="fn-14">All distances are measured in straight lines. Actual travel distances may vary.</p>

        {{-- <div class="mission-div fn-14">
                <span>Missing some information?</span>
                <button type="button">Yes</button>/<button type="button">No</button>
            </div> --}}
    </section>

    <section class="restaurants-section">
        <div class="row">

            <div class="col-lg-8 col-md-9">
                <div class="section-title">Restaurants</div>
                <p class="fn-14">1 restaurant on site</p>
            </div>

        </div>

        <div class="row">

            <!-- Col Start -->
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="restaurants-box">
                    <div class="restaurants-box-title">THE TRADE BITE</div>

                    <ul class="restaurants-food-list">
                        <li>
                            <div class="food-list-title">Cuisine</div>
                            <div class="food-list-items">Chinese • Indian • Italian • Nepalese • Pizza • Seafood</div>
                        </li>
                        <li>
                            <div class="food-list-title">Open for</div>
                            <div class="food-list-items">Breakfast • Brunch • Lunch • Dinner • High tea • Cocktail hour</div>
                        </li>
                        <li>
                            <div class="food-list-title">Ambiance</div>
                            <div class="food-list-items">Family friendly • Traditional • Modern • Romantic</div>
                        </li>
                        <li>
                            <div class="food-list-title">Dietary options</div>
                            <div class="food-list-items">Halal • Kosher • Vegetarian • Vegan • Gluten-free • Dairy-free</div>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Col End -->

        </div>
    </section>

    <section class="resort-facilities-sec" id="facilities">
        <div class="row">

            <div class="col-lg-8 col-md-9">
                <div class="section-title">Resort facilities of THE TRADE FAIR - RESORT AND SPA</div>
            </div>

            <div class="col-lg-4 col-md-3 text-end">
                <a href="#availability-section" class="btn btn-primary">See availability</a>
            </div>

        </div>

        <div class="most-facilities">
            <div class="blue-title">Most popular facilities</div>
            <div class="most-facilities-listing">

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon.png')}}" alt="Image"></big>
                    <span>Outdoor swimming pool</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon2.png')}}" alt="Image"></big>
                    <span>Free parking</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon3.png')}}" alt="Image"></big>
                    <span>Airport shuttle (free)</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon4.png')}}" alt="Image"></big>
                    <span>Room Service</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon5.png')}}" alt="Image"></big>
                    <span>Spa and wellness centre</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon6.png')}}" alt="Image"></big>
                    <span>Restaurant</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon7.png')}}" alt="Image"></big>
                    <span>Free WiFi</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon8.png')}}" alt="Image"></big>
                    <span>Tea/coffee maker in all rooms</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon9.png')}}" alt="Image"></big>
                    <span>Bar</span>
                </div>

                <div class="most-facilities-list">
                    <big><img src="{{asset('img/most-ame-icon10.png')}}" alt="Image"></big>
                    <span>Breakfast</span>
                </div>

            </div>
        </div>

        <div class="row">

            <!-- Col Start -->
            <div class="col-lg-4 col-md-4 col-sm-6">

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/bathroom-icon.png')}}" alt="Image">
                        <span>Bathroom</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Toilet paper</li>
                        <li>Towels</li>
                        <li>Bidet</li>
                        <li>Towels/sheets (extra fee)</li>
                        <li>Bath or shower</li>
                        <li>Slippers</li>
                        <li>Private bathroom</li>
                        <li>Toilet</li>
                        <li>Free toiletries</li>
                        <li>Bathrobe</li>
                        <li>Hairdryer</li>
                        <li>Bath</li>
                        <li>Shower</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/bedroom-icon.png')}}" alt="Image">
                        <span>Bedroom</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Linen</li>
                        <li>Wardrobe or closet</li>
                        <li>Alarm clock</li>
                        <li>Dressing room</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/view-icon.png')}}" alt="Image">
                        <span>View</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>City view</li>
                        <li>Garden view</li>
                        <li>View</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/outdoors-icon.png')}}" alt="Image">
                        <span>Outdoors</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Outdoor fireplace</li>
                        <li>Picnic area</li>
                        <li>Outdoor furniture</li>
                        <li>Outdoor dining area</li>
                        <li>Sun terrace</li>
                        <li>Barbecue</li>
                        <li>BBQ facilities <span class="gray-bg">Additional charge</span></li>
                        <li>Balcony</li>
                        <li>Terrace</li>
                        <li>Garden</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/kitchen-icon.png')}}" alt="Image">
                        <span>Kitchen</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Shared kitchen</li>
                        <li>Children's high chair</li>
                        <li>Dining table</li>
                        <li>Cleaning products</li>
                        <li>Electric kettle</li>
                        <li>Refrigerator</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/room-amenities-icon.png')}}" alt="Image">
                        <span>Room Amenities</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Socket near the bed</li>
                        <li>Drying rack for clothing</li>
                        <li>Clothes rack</li>
                    </ul>
                </div>


                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/pets-icon.png')}}" alt="Image">
                        <span>Pets</span>
                    </div>
                    <p>Pets are allowed on request. Charges may be applicable.</p>
                </div>


                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/activities-icon.png')}}" alt="Image">
                        <span>Activities</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Bicycle rental <span class="gray-bg">Additional charge</span></li>
                        <li>Live sport events (broadcast)</li>
                        <li>Live music/performance <span class="gray-bg">Additional charge</span></li>
                        <li>Tour or class about local culture <span class="gray-bg">Additional charge</span></li>
                        <li>Happy hour <span class="gray-bg">Additional charge</span></li>
                        <li>Themed dinner nights <span class="gray-bg">Additional charge</span></li>
                        <li>Bike tours <span class="gray-bg">Additional charge</span></li>
                        <li>Walking tours <span class="gray-bg">Additional charge</span></li>
                        <li>Movie nights <span class="gray-bg">Additional charge</span></li>
                        <li>Stand-up comedy <span class="gray-bg">Additional charge</span></li>
                        <li>Pub crawls <span class="gray-bg">Additional charge</span></li>
                        <li>Temporary art galleries</li>
                        <li>Badminton equipment</li>
                        <li>Tennis equipment</li>
                        <li>Water park <span class="gray-bg">Additional charge</span></li>
                        <li>Evening entertainment <span class="gray-bg">Additional charge</span></li>
                        <li>Kids' club</li>
                        <li>Water sport facilities on site</li>
                        <li>Nightclub/DJ <span class="gray-bg">Additional charge</span></li>
                        <li>Entertainment staff</li>
                        <li>Mini golf</li>
                        <li>Horse riding <span class="gray-bg">Additional charge</span></li>
                        <li>Cycling</li>
                        <li>Karaoke <span class="gray-bg">Additional charge</span></li>
                        <li>Table tennis</li>
                        <li>Children's playground</li>
                        <li>Games room</li>
                        <li>Golf course (within 3 km) <span class="gray-bg">Additional charge</span></li>
                        <li>Tennis court</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/living-area-icon.png')}}" alt="Image">
                        <span>Living Area</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Dining area</li>
                        <li>Fireplace</li>
                        <li>Seating Area</li>
                        <li>Desk</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/media-icon.png')}}" alt="Image">
                        <span>Media & Technology</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Streaming service (like Netflix)</li>
                        <li>Flat-screen TV</li>
                        <li>Satellite channels</li>
                        <li>Telephone</li>
                        <li>TV</li>
                    </ul>
                </div>

            </div>
            <!-- Col End -->

            <!-- Col Start -->
            <div class="col-lg-4 col-md-4 col-sm-6">

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/food-drink-icon.png')}}" alt="Image">
                        <span>Food & Drink</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Coffee house on site</li>
                        <li>Fruits <span class="gray-bg">Additional charge</span></li>
                        <li>Wine/champagne <span class="gray-bg">Additional charge</span></li>
                        <li>Kid-friendly buffet</li>
                        <li>Kid meals <span class="gray-bg">Additional charge</span></li>
                        <li>Special diet menus (on request)</li>
                        <li>Snack bar</li>
                        <li>Breakfast in the room</li>
                        <li>Bar <span class="gray-bg">Additional charge</span></li>
                        <li>Minibar</li>
                        <li>Restaurant</li>
                        <li>Tea/Coffee maker</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/internet-icon.png')}}" alt="Image">
                        <span>Internet</span>
                    </div>
                    <p>WiFi is available in all areas and is free of charge.</p>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/parking-icon2.png')}}" alt="Image">
                        <span>Parking</span>
                    </div>
                    <p>Free private parking is possible on site (reservation is not needed).</p>

                    <ul class="dark-ul-check">
                        <li>Electric vehicle charging station</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/transport-icon.png')}}" alt="Image">
                        <span>Transport</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Public transport tickets <span class="gray-bg">Additional charge</span></li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/reception-services-icon.png')}}" alt="Image">
                        <span>Reception services</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Invoice provided</li>
                        <li>Lockers</li>
                        <li>Private check-in/check-out</li>
                        <li>Concierge service</li>
                        <li>ATM/cash machine on site</li>
                        <li>Luggage storage</li>
                        <li>Tour desk</li>
                        <li>Currency exchange</li>
                        <li>Express check-in/check-out <span class="gray-bg">Additional charge</span></li>
                        <li>24-hour front desk</li>

                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/entertainment-icon.png')}}" alt="Image">
                        <span>Entertainment and family services</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Baby safety gates</li>
                        <li>Kids' outdoor play equipment</li>
                        <li>Indoor play area</li>
                        <li>Board games/puzzles</li>
                        <li>Child safety socket covers</li>
                        <li>Babysitting/child services <span class="gray-bg">Additional charge</span></li>
                    </ul>
                </div>


                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/cleaning-services-icon.png')}}" alt="Image">
                        <span>Cleaning services</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Daily housekeeping</li>
                        <li>Trouser press <span class="gray-bg">Additional charge</span></li>
                        <li>Ironing service <span class="gray-bg">Additional charge</span></li>
                        <li>Dry cleaning <span class="gray-bg">Additional charge</span></li>
                        <li>Laundry <span class="gray-bg">Additional charge</span></li>
                    </ul>
                </div>


                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/business-facilities-icon.png')}}" alt="Image">
                        <span>Business facilities</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Fax/photocopying <span class="gray-bg">Additional charge</span></li>
                        <li>Business centre <span class="gray-bg">Additional charge</span></li>
                        <li>Meeting/banquet facilities <span class="gray-bg">Additional charge</span></li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/safety-icon.png')}}" alt="Image">
                        <span>Safety & security</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Fire extinguishers</li>
                        <li>CCTV outside property</li>
                        <li>CCTV in common areas</li>
                        <li>Smoke alarms</li>
                        <li>Security alarm</li>
                        <li>Key card access</li>
                        <li>Key access</li>
                        <li>24-hour security</li>
                        <li>Safety deposit box <span class="gray-bg">Additional charge</span></li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/general-icon.png')}}" alt="Image">
                        <span>General</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Shuttle service <span class="gray-bg">Additional charge</span></li>
                        <li>Pet bowls</li>
                        <li>Pet basket</li>
                        <li>Grocery deliveries <span class="gray-bg">Additional charge</span></li>
                        <li>Shared lounge/TV area</li>
                        <li>Vending machine (snacks)</li>
                        <li>Vending machine (drinks)</li>
                        <li>Designated smoking area</li>
                        <li>Air conditioning</li>
                        <li>Non-smoking throughout</li>
                        <li>Allergy-free room</li>
                        <li>Executive lounge access</li>
                        <li>Wake-up service</li>
                        <li>Hardwood or parquet floors</li>
                        <li>Tile/marble floor</li>
                        <li>Heating</li>
                        <li>Car hire</li>
                        <li>Packed lunches</li>
                        <li>Chapel/shrine</li>
                        <li>Soundproof rooms</li>
                        <li>Lift</li>
                        <li>Fan</li>
                        <li>Family rooms <span class="gray-bg">Additional charge</span></li>
                        <li>Barber/beauty shop</li>
                        <li>Ironing facilities</li>
                        <li>Facilities for disabled guests</li>
                        <li>Airport shuttle</li>
                        <li>Non-smoking rooms</li>
                        <li>Iron</li>
                        <li>Wake up service/Alarm clock</li>
                        <li>Room service</li>
                    </ul>
                </div>

            </div>
            <!-- Col End -->

            <!-- Col Start -->
            <div class="col-lg-4 col-md-4 col-sm-6">

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/accessibility-img.png')}}" alt="Image">
                        <span>Accessibility</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Auditory guidance</li>
                        <li>Visual aids: Tactile signs</li>
                        <li>Visual aids: Braille</li>
                        <li>Emergency cord in bathroom</li>
                        <li>Lower bathroom sink</li>
                        <li>Higher level toilet</li>
                        <li>Toilet with grab rails</li>
                        <li>Wheelchair accessible</li>
                        <li>Entire unit wheelchair accessible</li>
                        <li>Upper floors accessible by stairs only</li>

                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/swimming-img.png')}}" alt="Image">
                        <span>Outdoor swimming pool <small>Free!</small></span>
                    </div>
                    <ul class="dark-ul-check">
                        <li>Open all year</li>
                        <li>All ages welcome</li>
                        <li>Infinity pool</li>
                        <li>Salt-water pool</li>
                        <li>Water slide</li>
                        <li>Pool/beach towels</li>
                        <li>Pool bar</li>
                        <li>Pool cover</li>
                        <li>Sun loungers or beach chairs</li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/wellness-icon.png')}}" alt="Image">
                        <span>Wellness</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Kids' pool</li>
                        <li>Personal trainer</li>
                        <li>Fitness</li>
                        <li>Massage chair</li>
                        <li>Full body massage</li>
                        <li>Hand massage</li>
                        <li>Head massage</li>
                        <li>Couples massage</li>
                        <li>Foot massage</li>
                        <li>Neck massage</li>
                        <li>Back massage</li>
                        <li>Spa/wellness packages</li>
                        <li>Foot bath</li>
                        <li>Spa lounge/relaxation area</li>
                        <li>Steam room</li>
                        <li>Spa facilities</li>
                        <li>Light therapy</li>
                        <li>Body wrap</li>
                        <li>Body scrub</li>
                        <li>Body treatments</li>
                        <li>Hair styling</li>
                        <li>Hair colouring</li>
                        <li>Hair cut</li>
                        <li>Pedicure</li>
                        <li>Manicure</li>
                        <li>Hair treatments</li>
                        <li>Make up services</li>
                        <li>Waxing services</li>
                        <li>Facial treatments</li>
                        <li>Beauty Services</li>
                        <li>Sun umbrellas</li>
                        <li>Sun loungers or beach chairs</li>
                        <li>Water slide</li>
                        <li>Public Bath <span class="gray-bg">Additional charge</span></li>
                        <li>Open-air bath <span class="gray-bg">Additional charge</span></li>
                        <li>Hot spring bath <span class="gray-bg">Additional charge</span></li>
                        <li>Hot tub/Jacuzzi <span class="gray-bg">Additional charge</span></li>
                        <li>Massage <span class="gray-bg">Additional charge</span></li>
                        <li>Spa and wellness centre <span class="gray-bg">Additional charge</span></li>
                        <li>Fitness centre</li>
                        <li>Sauna <span class="gray-bg">Additional charge</span></li>
                    </ul>
                </div>

                <div class="resort-facilities-list">
                    <div class="surroundings-title">
                        <img src="{{asset('img/languages-icon.png')}}" alt="Image">
                        <span>Languages spoken</span>
                    </div>

                    <ul class="dark-ul-check">
                        <li>Bengali</li>
                        <li>English</li>
                        <li>Gujarati</li>
                        <li>Hindi</li>
                        <li>Punjabi</li>
                    </ul>
                </div>

            </div>
            <!-- Col End -->

        </div>

    </section>


    <section class="house-rules-sec" id="house-rules">
        <div class="row">

            <div class="col-lg-8 col-md-9">
                <div class="section-title">House rules</div>
                <p>THE TRADE FAIR - RESORT AND SPA takes special requests - add in the next step!</p>
            </div>

            <div class="col-lg-4 col-md-3 text-end">
                <a href="#availability-section" class="btn btn-primary">See availability</a>
            </div>

        </div>


        <div class="bordshad-div house-rules-box fn-15">

            <div class="house-rules-list">
                <div class="house-rules-left">
                    <img src="{{asset('img/checkin-icon.png')}}" alt="Image">
                    <span>Check-in</span>
                </div>
                <div class="house-rules-right">
                    <p>Available 24 hours</p>
                </div>
            </div>

            <div class="house-rules-list">
                <div class="house-rules-left">
                    <img src="{{asset('img/checkout-icon.png')}}" alt="Image">
                    <span>Check-out</span>
                </div>
                <div class="house-rules-right">
                    <p>From 12:00 PM to 11:00 AM</p>
                </div>
            </div>

            <div class="house-rules-list">
                <div class="house-rules-left">
                    <img src="{{asset('img/info-icon3.png')}}" alt="Image">
                    <span>Cancellation/prepayment</span>
                </div>
                <div class="house-rules-right">
                    <p>Cancellation and prepayment policies vary according to accommodation type. <a href="javascript:void(0)" class="text-primary"><b>Please enter the dates of your stay</b></a> and check the conditions of your required room.</p>
                </div>
            </div>

            <div class="house-rules-list">
                <div class="house-rules-left">
                    <img src="{{asset('img/children-beds-icon.png')}}" alt="Image">
                    <span>Children and beds</span>
                </div>
                <div class="house-rules-right">
                    <div class="fn-15 fw-7">Child policies</div>
                    <p>Children of any age are welcome.</p>
                    <p>To see correct prices and occupancy information, please add the number of children in your group and their ages to your search.</p>

                    <div class="fn-15 fw-7 mt-3">Cot and extra bed policies</div>
                    <p>Cots and extra beds are not available at this property.</p>
                </div>
            </div>

            <div class="house-rules-list">
                <div class="house-rules-left">
                    <img src="{{asset('img/restriction-icon.png')}}" alt="Image">
                    <span>No age restriction</span>
                </div>
                <div class="house-rules-right">
                    <p>There is no age requirement for check-in</p>
                </div>
            </div>

            <div class="house-rules-list">
                <div class="house-rules-left">
                    <img src="{{asset('img/pets-icon2.png')}}" alt="Image">
                    <span>Pets</span>
                </div>
                <div class="house-rules-right">
                    <p>Pets are allowed on request. Charges may be applicable.</p>
                </div>
            </div>

        </div>

    </section>

    <section class="the-fine-print-sec">
        <div class="row mb-4">

            <div class="col-lg-8 col-md-9">
                <div class="section-title">The fine print</div>
            </div>

            <div class="col-lg-4 col-md-3 text-end">
                <a href="#availability-section" class="btn btn-primary">See availability</a>
            </div>

        </div>

        <div class="secondary-bg">
            <p>This property will not accommodate hen, stag or similar parties.</p>
        </div>

        <div class="faq-about-section">
            <div class="row">
                <div class="col-lg-3">
                    <div class="faq-main-title">FAQs about <span class="text-secondary">THE TRADE FAIR</span> - RESORT AND SPA</div>
                </div>
                <div class="col-lg-9">

                    <div class="accordion" id="accordionExample">

                        @if($faqs)
                        @foreach($faqs as $key => $value)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                                    {{$value->question}}
                                </button>
                            </h2>
                            <div id="collapse{{$key}}" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    {!! $value->answer !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                    </div>

                </div>
            </div>
        </div>

    </section>

    <section class="subscribe-section">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4">
                <div class="subscribe-title">Save time, save money!</div>
                <p>Sign up and we'll send the best deals to you</p>
            </div>
            <div class="col-lg-5">


                <div class="input-group serch-field">

                    <form method="POST" class="form-group d-flex" action="{{ url('submit-newsletter') }}" id="newsletter_form">
                        @csrf
                        <input type="email" name="email" class="form-control validate[required,custom[email]]" placeholder="Your email address" aria-label="" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="button" id="newsletter">Subscribe</button>
                    </form>

                </div>

            </div>
        </div>
    </section>

    </div>
</main>

@include('models')
@include('footer')
<script>
    $(document).ready(function() {
        var checkin = "";
        // get room data
        $.ajax({
            url: "{{ url('rooms') }}",
            type: "get",
            success: function(response) {
                $('.room_filter_block').html(response)
            }
        });


        //submit ask a question section
        $('.submitAskquestion').click(function() {
            var validation = $('#submitAskQuestion').validationEngine('validate')

            if (validation == true) {
                $('#submitAskQuestion').submit()
            }

        })

        //get success message of submit a ask form 
        if ("<?php echo Session::has('success') ?>") {

            Swal.fire({
                title: "",
                text: "{{ Session::get('success') }}",
                icon: "success"
            });

        }

        if ("<?php echo Session::has('newsletter-failure') ?>") {

            Swal.fire({
                title: "",
                text: "{{ Session::get('newsletter-failure') }}",
                icon: "error",
            });

        }

        if ("<?php echo Session::has('newsletter-success') ?>") {

            Swal.fire({
                title: "",
                text: "{{ Session::get('newsletter-success') }}",
                icon: "success"
            });

        }

        $(document).on('click', '#newsletter', function() {
            var is_validate = $('#newsletter_form').validationEngine('validate');
            if (is_validate) {
                $('#newsletter_form').submit();
            }
        });



        //get room detail according to their category
        // get-room-category
        checkRoomAvailability(checkin);

        $(document).on("click", '.search-room, .check-availability', function() {

            var enddate = $('.check-out').val()
            var startdate = $('.check-in').val()

            if (startdate < moment().format('YYYY-MM-DD') || startdate > moment().add(2, 'months').format('YYYY-MM-DD')) {
                $('.check-in-error').show()
                $('.check-in-error').text("Start Date cannot be before Today Date.").css({
                    'display': 'block',
                    'font-size': '13px',
                    'color': 'red'
                }).delay(800).fadeOut(1000);
            } else if (enddate <= startdate || enddate > moment().add(2, 'months').add(1, 'days').format('YYYY-MM-DD')) {
                $('.check-out-error').text("End Date cannot be before or equal to Start Date.").css({
                    'display': 'block',
                    'font-size': '13px',
                    'color': 'red'
                }).delay(800).fadeOut(1000);
            } else {
                checkRoomAvailability(startdate);
                window.location.href = '/book.thetradefair/public/#RoomReservation';
            }
        });


    });

    function setCheckInDate(value) {
        $('.check-in-error').hide()
        $('.check-in').val(value)
    }

    function setCheckOutDate(value) {
        $('.check-out-error').hide()
        $('.check-out').val(value)
    }

    function checkRoomAvailability(checkin) {
        $.ajax({
            url: "{{ url('check-room-availability') }}/" + checkin,
            type: "get",
            success: function(response) {
                // $(document).scrollTop(1500);
                $('.room-reserve-table').html(response)
            }
        })
    }

    var $temp = $("<input>");
    var $url = $(location).attr('href');

    $('.clipboard').on('click', function() {
        $("body").append($temp);
        $temp.val($url).select();
        document.execCommand("copy");
        $temp.remove();
        $('#copyText').addClass('text-success').text('Copied');
        setTimeout(function() {
            $('#copyText').removeClass('text-success').text('Copy link');
        }, 3000);

    })
   
</script>
@endsection