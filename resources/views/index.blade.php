@extends('layouts.layout')
@section('content')
@include('header')

<main class="main-div">
    <div class="container">
        <div class="row">

            <div class="col-xl-3 col-lg-3">
                <div class="light-primary">
                    <button type="button" class="price-match-btn" data-bs-toggle="modal" data-bs-target="#we-price-match"><img src="img/price-icon.png" alt="Image">We Price Match</button>
                </div>

                <!-- filter form start-->
                <!-- @include('room-filter') -->
                <div class="room_filter_block"></div>
                <!-- filter form end-->

                <div class="map-box" style="background-image:url(img/google-map.jpg);">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#google-map-popup">Show on map</button>
                </div>

            </div>

            <div class="col-xl-9 col-lg-9">
                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Info & prices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Facilities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">House rules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">No reviews yet</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="row">

                    <div class="col-xl-3 col-lg-3 order-lg-last">
                        <div class="reserve-btns-div">
                            <!-- <button class="normal-link" title="Save" type="button"><img src="img/heart-icon.png" alt="Image"></button> -->

                            <div class="dropdown share-drop">
                                <button type="button" class="normal-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"><img src="img/share-icon.png" alt="Image"></button>
                                <div class="dropdown-menu dropdown-menu-end p-3 w-100">
                                    <div class="share-drop-title">Share this property</div>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-copy"></i> Copy link</a></li>
                                        <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i> X (formerly Twitter)</a></li>
                                    </ul>

                                </div>
                            </div>

                            <button class="btn btn-primary" type="button">Reserve</button>
                            <div class="price-match-div">
                                <button type="button" class="price-match-btn" data-bs-toggle="modal" data-bs-target="#we-price-match"><img src="img/price-icon.png" alt="Image">We Price Match</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-9">
                        <div class="tags-list">
                            <span class="bg-primary">New to Bookingengine.com</span>
                            <span>Airport shuttle</span>
                            <span class="bg-greenlight"><img src="img/leaf-icon.png" alt="Image"> <img src="img/leaf-icon.png" alt="Image"> <img src="img/leaf-icon.png" alt="Image"> Travel Sustainable Level 3</span>
                        </div>
                        <div class="resort-title">The trade Fair - Resort and Spa</div>

                        <address class="address-tag"><img src="img/location-icon.png" alt="Image"> Ajmer-Jaipur Expressway Near RIICO(Bagru), Jaipur, Rajsthan, 303007 Dahmi, India – <button class="showmap-link" data-bs-toggle="modal" data-bs-target="#google-map-popup">Show map</button></address>
                    </div>
                </div>



                <div class="photography-div" data-bs-toggle="modal" data-bs-target="#gallery-popup">
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="height-photo mb-10">
                                <img src="img/gallery-1.jpg" alt="image1" class="img-fluid">
                            </div>

                            <div class="height-photo">
                                <img src="img/gallery-2.jpg" alt="image1" class="img-fluid">
                            </div>

                        </div>
                        <div class="col-xl-8">
                            <div class="height-photo2">
                                <img src="img/gallery-3.jpg" alt="image1" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="flex-photo">
                        <div>
                            <img src="img/gallery-4.jpg" alt="image1" class="img-fluid">
                        </div>
                        <div>
                            <img src="img/gallery-5.jpg" alt="image1" class="img-fluid">
                        </div>
                        <div>
                            <img src="img/gallery-6.jpg" alt="image1" class="img-fluid">
                        </div>
                        <div>
                            <img src="img/gallery-7.jpg" alt="image1" class="img-fluid">
                        </div>
                        <div style="position: relative;">
                            <div class="photos-remain">
                                <span>+14 Photos</span>
                            </div>
                            <img src="img/gallery-8.jpg" alt="image1" class="img-fluid">
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <section class="main-facilities">

            <div class="main-facilities-list">
                <img src="img/main-ame-icon.png" alt="Image">
                <span>Breakfast</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon2.png" alt="Image">
                <span>Outdoor swimming pool</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon3.png" alt="Image">
                <span>Restaurant</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon4.png" alt="Image">
                <span>Free parking</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon5.png" alt="Image">
                <span>Private bathroom</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon6.png" alt="Image">
                <span>Balcony</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon7.png" alt="Image">
                <span>Balcony</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon8.png" alt="Image">
                <span>Spa and wellness centre</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon9.png" alt="Image">
                <span>View</span>
            </div>

            <div class="main-facilities-list">
                <img src="img/main-ame-icon10.png" alt="Image">
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
                                <big><img src="img/most-ame-icon.png" alt="Image"></big>
                                <span>Outdoor swimming pool</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon2.png" alt="Image"></big>
                                <span>Free parking</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon3.png" alt="Image"></big>
                                <span>Airport shuttle (free)</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon4.png" alt="Image"></big>
                                <span>Room Service</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon5.png" alt="Image"></big>
                                <span>Spa and wellness centre</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon6.png" alt="Image"></big>
                                <span>Restaurant</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon7.png" alt="Image"></big>
                                <span>Free WiFi</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon8.png" alt="Image"></big>
                                <span>Tea/coffee maker in all rooms</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon9.png" alt="Image"></big>
                                <span>Bar</span>
                            </div>

                            <div class="most-facilities-list">
                                <big><img src="img/most-ame-icon10.png" alt="Image"></big>
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
                            <img src="img/parking-icon.png" alt="image">
                            <span>Free private parking available on-site</span>
                        </div>

                        <div class="pro-hig-box-subtitle">Activities:</div>
                        <p>Tennis court</p>
                        <p>Fitness centre</p>
                        <p>Golf course (within 3 km)</p>

                        <div class="d-grid mt-4">
                            <button class="btn btn-secondary">Reserve</button>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="availability-section">
            <div class="row" id="availability-section">

                <div class="col-lg-8 col-md-9">
                    <div class="section-title">Availability</div>
                    <div class="info-aree">
                        <img src="img/info-icon2.png" align="image">
                        <span>Select dates to see this property's availability and prices</span>
                    </div>
                </div>

                <div class="col-lg-4 col-md-3 text-end">
                    <button type="button" class="price-match-btn" data-bs-toggle="modal" data-bs-target="#we-price-match"><img src="img/price-icon.png" alt="Image">We Price Match</button>
                </div>

            </div>

            <!-- <div class="row">
                <div class="col-xl-9">

                    <div class="form-box">
                        <div>
                            <div class="control-datepiker">
                                <input type="datepiker" class="form-control control-calendar-icon" placeholder="Check-in & Check-out Date">
                            </div>
                        </div>

                        <div class="dropdown">
                            <button type="button" class="control-user form-dropdown dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">15 adults · 0 children · 1 room</button>
                            <div class="dropdown-menu p-3 w-100">

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
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>

                    </div>

                </div>
            </div> -->



            <div class="table-sec">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Room type</th>
                                <th width="300">Number of guests</th>
                                <th width="180"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#" class="bold-under">Double Room with Pool View</a>
                                    <p class="mb-0">1 double bed <img src="img/bed-icon.png" alt="image"></p>
                                </td>
                                <td>
                                    <img src="img/user-icon2.png" alt="User">
                                    <img src="img/user-icon2.png" alt="User">
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Show prices</button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="bold-under">Double Room with Garden View</a>
                                    <p class="mb-0">1 double bed <img src="img/bed-icon.png" alt="image"></p>
                                </td>
                                <td>
                                    <img src="img/user-icon2.png" alt="User">
                                    <img src="img/user-icon2.png" alt="User">
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Show prices</button>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="bold-under">Twin Room with Balcony</a>
                                    <p class="mb-0">2 double bed <img src="img/bed-icon.png" alt="image"></p>
                                </td>
                                <td>
                                    <img src="img/user-icon2.png" alt="User">
                                    <img src="img/user-icon2.png" alt="User">
                                    <img src="img/user-icon2.png" alt="User">
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Show prices</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>

            <div class="bordshad-div">
                <div class="card-div">
                    <img src="img/card-img.png" alt="Image">
                    <strong>No credit card needed to book.</strong> We'll send you an email confirming your reservation.
                </div>
            </div>


            <div class="bordshad-div">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-md-10">
                        <div class="level-div">
                            <img src="img/leaf-icon2.png" alt="Image">
                            <img src="img/leaf-icon2.png" alt="Image">
                            <img src="img/leaf-icon2.png" alt="Image">
                            <span>Event Sustainable Level 3</span>
                        </div>

                        <p class="fn-14  mb-0">This property has told us they’re making large investments and efforts towards sustainability by taking steps that can have environmental and social impact. We’ve worked with experts including Travalyst and Sustainalize to create the Event Sustainable programme – making it easier for you to experience the world more sustainably.</p>

                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="learn-div">
                            <a href="#">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bordshad-div">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-md-10">
                        <div class="chat-div">
                            <div class="chat-img"><img src="img/chat-icon.png" alt="Image"></div>
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
                        <img src="img/nearby-icon.png" alt="Image">
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
                        <img src="img/restaurants-cafes-icon.png" alt="Image">
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
                            <img src="img/public-transport-icon.png" alt="Image">
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
                        <img src="img/closest-airports-icon.png" alt="Image">
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

            <div class="mission-div fn-14">
                <span>Missing some information?</span>
                <button type="button">Yes</button>/<button type="button">No</button>
            </div>
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

        <section class="resort-facilities-sec">
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
                        <big><img src="img/most-ame-icon.png" alt="Image"></big>
                        <span>Outdoor swimming pool</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon2.png" alt="Image"></big>
                        <span>Free parking</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon3.png" alt="Image"></big>
                        <span>Airport shuttle (free)</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon4.png" alt="Image"></big>
                        <span>Room Service</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon5.png" alt="Image"></big>
                        <span>Spa and wellness centre</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon6.png" alt="Image"></big>
                        <span>Restaurant</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon7.png" alt="Image"></big>
                        <span>Free WiFi</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon8.png" alt="Image"></big>
                        <span>Tea/coffee maker in all rooms</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon9.png" alt="Image"></big>
                        <span>Bar</span>
                    </div>

                    <div class="most-facilities-list">
                        <big><img src="img/most-ame-icon10.png" alt="Image"></big>
                        <span>Breakfast</span>
                    </div>

                </div>
            </div>

            <div class="row">

                <!-- Col Start -->
                <div class="col-lg-4 col-md-4 col-sm-6">

                    <div class="resort-facilities-list">
                        <div class="surroundings-title">
                            <img src="img/bathroom-icon.png" alt="Image">
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
                            <img src="img/bedroom-icon.png" alt="Image">
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
                            <img src="img/view-icon.png" alt="Image">
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
                            <img src="img/outdoors-icon.png" alt="Image">
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
                            <img src="img/kitchen-icon.png" alt="Image">
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
                            <img src="img/room-amenities-icon.png" alt="Image">
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
                            <img src="img/pets-icon.png" alt="Image">
                            <span>Pets</span>
                        </div>
                        <p>Pets are allowed on request. Charges may be applicable.</p>
                    </div>


                    <div class="resort-facilities-list">
                        <div class="surroundings-title">
                            <img src="img/activities-icon.png" alt="Image">
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
                            <img src="img/living-area-icon.png" alt="Image">
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
                            <img src="img/media-icon.png" alt="Image">
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
                            <img src="img/food-drink-icon.png" alt="Image">
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
                            <img src="img/internet-icon.png" alt="Image">
                            <span>Internet</span>
                        </div>
                        <p>WiFi is available in all areas and is free of charge.</p>
                    </div>

                    <div class="resort-facilities-list">
                        <div class="surroundings-title">
                            <img src="img/parking-icon2.png" alt="Image">
                            <span>Parking</span>
                        </div>
                        <p>Free private parking is possible on site (reservation is not needed).</p>

                        <ul class="dark-ul-check">
                            <li>Electric vehicle charging station</li>
                        </ul>
                    </div>

                    <div class="resort-facilities-list">
                        <div class="surroundings-title">
                            <img src="img/transport-icon.png" alt="Image">
                            <span>Transport</span>
                        </div>

                        <ul class="dark-ul-check">
                            <li>Public transport tickets <span class="gray-bg">Additional charge</span></li>
                        </ul>
                    </div>

                    <div class="resort-facilities-list">
                        <div class="surroundings-title">
                            <img src="img/reception-services-icon.png" alt="Image">
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
                            <img src="img/entertainment-icon.png" alt="Image">
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
                            <img src="img/cleaning-services-icon.png" alt="Image">
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
                            <img src="img/business-facilities-icon.png" alt="Image">
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
                            <img src="img/safety-icon.png" alt="Image">
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
                            <img src="img/general-icon.png" alt="Image">
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
                            <img src="img/accessibility-img.png" alt="Image">
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
                            <img src="img/swimming-img.png" alt="Image">
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
                            <img src="img/wellness-icon.png" alt="Image">
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
                            <img src="img/languages-icon.png" alt="Image">
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


            <div class="mission-div fn-14">
                <span>Missing some information?</span>
                <button type="button">Yes</button>/<button type="button">No</button>
            </div>
        </section>


        <section class="house-rules-sec">
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
                        <img src="img/checkin-icon.png" alt="Image">
                        <span>Check-in</span>
                    </div>
                    <div class="house-rules-right">
                        <p>Available 24 hours</p>
                    </div>
                </div>

                <div class="house-rules-list">
                    <div class="house-rules-left">
                        <img src="img/checkout-icon.png" alt="Image">
                        <span>Check-out</span>
                    </div>
                    <div class="house-rules-right">
                        <p>From 00:00 to 10:00</p>
                    </div>
                </div>

                <div class="house-rules-list">
                    <div class="house-rules-left">
                        <img src="img/info-icon3.png" alt="Image">
                        <span>Cancellation/prepayment</span>
                    </div>
                    <div class="house-rules-right">
                        <p>Cancellation and prepayment policies vary according to accommodation type. <a href="#" class="text-primary"><b>Please enter the dates of your stay</b></a> and check the conditions of your required room.</p>
                    </div>
                </div>

                <div class="house-rules-list">
                    <div class="house-rules-left">
                        <img src="img/children-beds-icon.png" alt="Image">
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
                        <img src="img/restriction-icon.png" alt="Image">
                        <span>No age restriction</span>
                    </div>
                    <div class="house-rules-right">
                        <p>There is no age requirement for check-in</p>
                    </div>
                </div>

                <div class="house-rules-list">
                    <div class="house-rules-left">
                        <img src="img/pets-icon2.png" alt="Image">
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


                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button  collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        What type of room can I book at THE TRADE FAIR - RESORT AND SPA?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>Room options at THE TRADE FAIR - RESORT AND SPA include:</p>
                                        <ul>
                                            <li>Double</li>
                                            <li>Twin</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How far is THE TRADE FAIR - RESORT AND SPA from the centre of Dahmi?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>THE TRADE FAIR - RESORT AND SPA is 2.2 km from the centre of Dahmi. All distances are measured in straight lines. Actual travel distances may vary.</p>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        What are the check-in and check-out times at THE TRADE FAIR - RESORT AND SPA?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>Check-in at THE TRADE FAIR - RESORT AND SPA is from 12:00, and check-out is until 10:00.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        What is there to do at THE TRADE FAIR - RESORT AND SPA?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>THE TRADE FAIR - RESORT AND SPA offers the following activities / services (charges may apply):</p>
                                        <ul>
                                            <li>Spa and wellness centre</li>
                                            <li>Fitness centre</li>
                                            <li>Hot tub/Jacuzzi</li>
                                            <li>Sauna</li>
                                            <li>Massage</li>
                                            <li>Cycling</li>
                                            <li>Children's playground</li>
                                            <li>Games room</li>
                                            <li>Table tennis</li>
                                            <li>Tennis court</li>
                                            <li>Karaoke</li>
                                            <li>Mini golf</li>
                                            <li>Golf course (within 3 km)</li>
                                            <li>Evening entertainment</li>
                                            <li>Kids' club</li>
                                            <li>Water park</li>
                                            <li>Open-air bath</li>
                                            <li>Hot spring bath</li>
                                            <li>Bicycle rental</li>
                                            <li>Themed dinner nights</li>
                                            <li>Swimming Pool</li>
                                            <li>Personal trainer</li>
                                            <li>Tennis equipment</li>
                                            <li>Walking tours</li>
                                            <li>Live sport events (broadcast)</li>
                                            <li>Temporary art galleries</li>
                                            <li>Horse riding</li>
                                            <li>Tour or class about local culture</li>
                                            <li>Public Bath</li>
                                            <li>Water sport facilities on site</li>
                                            <li>Badminton equipment</li>
                                            <li>Stand-up comedy</li>
                                            <li>Beauty Services</li>
                                            <li>Pub crawls</li>
                                            <li>Facial treatments</li>
                                            <li>Happy hour</li>
                                            <li>Waxing services</li>
                                            <li>Bike tours</li>
                                            <li>Make up services</li>
                                            <li>Live music/performance</li>
                                            <li>Hair treatments</li>
                                            <li>Movie nights</li>
                                            <li>Manicure</li>
                                            <li>Pedicure</li>
                                            <li>Hair cut</li>
                                            <li>Hair colouring</li>
                                            <li>Hair styling</li>
                                            <li>Body treatments</li>
                                            <li>Body scrub</li>
                                            <li>Body wrap</li>
                                            <li>Light therapy</li>
                                            <li>Spa facilities</li>
                                            <li>Steam room</li>
                                            <li>Spa lounge/relaxation area</li>
                                            <li>Foot bath</li>
                                            <li>Spa/wellness packages</li>
                                            <li>Back massage</li>
                                            <li>Neck massage</li>
                                            <li>Foot massage</li>
                                            <li>Couples massage</li>
                                            <li>Head massage</li>
                                            <li>Hand massage</li>
                                            <li>Full body massage</li>
                                            <li>Massage chair</li>
                                            <li>Entertainment staff</li>
                                            <li>Fitness</li>
                                            <li>Nightclub/DJ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Does THE TRADE FAIR - RESORT AND SPA have a hot tub for its guests?
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>Yes, there is a hot tub. You can find out more about this and the other facilities at THE TRADE FAIR - RESORT AND SPA on this page.</p>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        Does THE TRADE FAIR - RESORT AND SPA have a restaurant on site?
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>THE TRADE FAIR - RESORT AND SPA has 1 restaurant:</p>
                                        <ul>
                                            <li>THE TRADE BITE</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        How much does it cost to stay at THE TRADE FAIR - RESORT AND SPA?
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>The prices at THE TRADE FAIR - RESORT AND SPA may vary depending on your stay (e.g. dates you select, hotel's policy etc.). See the prices by entering your dates.</p>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        Is THE TRADE FAIR - RESORT AND SPA popular with families?
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>Yes, THE TRADE FAIR - RESORT AND SPA is popular with guests booking family stays.</p>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                        Does THE TRADE FAIR - RESORT AND SPA have a pool?
                                    </button>
                                </h2>
                                <div id="collapseNine" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <p>Yes, this hotel has a pool. Find out the details about the pool and other facilities on this page.</p>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

            <div class="secondary-bg dark-secondary">
                <div class="fn-24">The best of Dahmi</div>
                <p>Click here to see more properties near popular landmarks in Dahmi</p>
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
                        <input type="email" class="form-control" placeholder="Your email address" aria-label="" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="button" id="button-addon2">Subscribe</button>
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

        //get room data
        $.ajax({
            url: "{{ url('rooms') }}",
            type: "get",
            success: function(response) {
                $('.room_filter_block').html(response)
            }
        });

       
    })
</script>
@endsection