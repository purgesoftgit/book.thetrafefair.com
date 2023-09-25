@extends('layouts.layout')
@section('content')
@include('layouts.header')

<main class="web-main">

    <!-- Banner Section Start -->
    <section class="banner-section">
        <div class="owl-carousel owl-theme" id="banner-slider">
            <!-- 1 -->
            <div class="item" style="background-image: url({{ asset('img/banner-img.jpg') }});">
                <div class="slider-text">
                    <div class="welcome-title">Welcome to</div>
                    <div class="banner-title">The Trade Fair</div>
                    <a href="{{ url('rooms')}}" class="btn btn-lg btn-dark">Book Now</a>
                </div>
            </div>
            <!-- 1 -->
            <!-- 2 -->
            <div class="item" style="background-image:url({{ asset('img/banner-img.jpg')}});">
                <div class="slider-text">
                    <div class="welcome-title">Welcome to</div>
                    <div class="banner-title">The Trade Fair</div>
                    <a href="{{ url('rooms')}}" class="btn btn-lg btn-dark">Book Now</a>
                </div>
            </div>
            <!-- 2 -->
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Destinations Section Start -->
    <section class="destinations-section">
        <div class="container-fluid">
            <div class="sub-title">Perfectly Located</div>
            <div class="section-title">Destinations</div>

            <div class="destinations-inner">
                <article>
                    <a href="javascript:void(0)">
                        <img src="{{asset('img/destinations-img.webp')}}" alt="Image" class="img-fluid">
                        <span>Hawa Mahal</span>
                    </a>
                </article>

                <article>
                    <a href="javascript:void(0)">
                        <img src="{{ asset('img/destinations-img2.webp')}}" alt="Image" class="img-fluid">
                        <span>Jal Mahal</span>
                    </a>
                </article>

                <article>
                    <a href="javascript:void(0)">
                        <img src="{{ asset('img/destinations-img3.webp')}}" alt="Image" class="img-fluid">
                        <span>Albert Hall Museum</span>
                    </a>
                </article>

                <article>
                    <a href="javascript:void(0)">
                        <img src="{{ asset('img/destinations-img4.webp')}}" alt="Image" class="img-fluid">
                        <span>Amer Fort</span>
                    </a>
                </article>
<!-- 
                <article>
                    <a href="javascript:void(0)">
                        <img src="{{ asset('img/destinations-img5.jpg')}}" alt="Image" class="img-fluid">
                        <span>Heritage Puri</span>
                    </a>
                </article>

                <article>
                    <a href="javascript:void(0)">
                        <img src="{{ asset('img/destinations-img6.jpg')}}" alt="Image" class="img-fluid">
                        <span>Waves Puri</span>
                    </a>
                </article>

                <article>
                    <a href="javascript:void(0)">
                        <img src="{{ asset('img/destinations-img7.jpg')}}" alt="Image" class="img-fluid">
                        <span>Rourkela</span>
                    </a>
                </article>

                <article>
                    <a href="javascript:void(0)">
                        <img src="{{ asset('img/destinations-img8.jpg')}}" alt="Image" class="img-fluid">
                        <span>Lagoon Bhubaneswar</span>
                    </a>
                </article> -->
            </div>

        </div>
    </section>
    <!-- Destinations Section End -->

    <!-- Hotel Service Section Start -->
    <section class="hotel-service-section">
        <div class="container">

            <!-- Box 1 -->
            <div class="hotel-service-box">
                <div class="row gx-0 align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="owl-carousel owl-theme" id="rooms-suites-images-slider">
                            <div class="item">
                                <img src="{{ asset('img/room-photo.jpg')}}" alt="Rooms and Suites">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/room-photo2.jpg')}}" alt="Rooms and Suites">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/room-photo3.jpg')}}" alt="Rooms and Suites">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="hotel-service-box-inner">
                            <div class="hotel-service-title">Rooms and Suites</div>
                            <p>Enveloped in the lap of nature's breath-taking marvels, your stay with us is one of peace
                                and unmatched privacy and plush comfort. Rooms are appointed keeping in mind the needs
                                of the modern day traveller and luxury that our guests have always been accustomed to.
                            </p>
                            <a href="{{ url('rooms') }}"  class="btn btn-primary">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Box 1 -->


            <!-- Box 2 -->
            <div class="hotel-service-box">
                <div class="row gx-0 align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-12 order-lg-last">
                        <div class="owl-carousel owl-theme" id="restaurants-images-slider">
                            <div class="item">
                                <img src="{{ asset('img/restaurants-image.jpg')}}" alt="Restaurants">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/restaurants-image2.jpg')}}" alt="Restaurants">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/restaurants-image3.jpg')}}" alt="Restaurants">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="hotel-service-box-inner">
                            <div class="hotel-service-title">Restaurants</div>
                            <p>Each dining space at The Trade Fair has been designed keeping in mind an overall
                                scintillating experience and gastronomic excellence. From cosy, comfortable spots to
                                refined, fine dining options, at each The Trade Fair you will find the right restaurant
                                to suit your every occasion.</p>
                            <a href="{{env('RESTAURANT_URL')}}" target="_blank" class="btn btn-primary">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Box 2 -->


            <!-- Box 3 -->
            <div class="hotel-service-box">
                <div class="row gx-0 align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="owl-carousel owl-theme" id="meetings-events-images-slider">
                            <div class="item">
                                <img src="{{ asset('img/meetings-events-image.jpg')}}" alt="Image">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/meetings-events-image2.jpg')}}" alt="Image">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/meetings-events-image3.jpg')}}" alt="Image">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="hotel-service-box-inner">
                            <div class="hotel-service-title">Meetings & Events</div>
                            <p>Render the magical The Trade Fair touch to your events, conferences and meetings. The
                                beautifully detailed convention spaces, banquet halls, conference rooms and meeting
                                lounges speak of sophistication and attention to detail to ensure each event planned
                                with us is a success at every stage.</p>
                            <a href="{{ url('corporte-meeting-halls') }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Box 3 -->


            <!-- Box 4 -->
            <div class="hotel-service-box">
                <div class="row gx-0 align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-12 order-lg-last">
                        <div class="owl-carousel owl-theme" id="spa-wellness-slider">
                            <div class="item">
                                <img src="{{ asset('img/spa-wellness-image.jpg')}}" alt="Image">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/spa-wellness-image2.jpg')}}" alt="Image">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/spa-wellness-image3.jpg')}}" alt="Image">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="hotel-service-box-inner">
                            <div class="hotel-service-title">SPA and Wellness</div>
                            <p>The soothing ambience at each of the The Trade Fair Spas will transport you to a world of
                                calm and peace as you relax and have our expert therapists heal, balance and restore
                                your energy.</p>
                            <a href="{{ url('spa') }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Box 4 -->


            <!-- Box 4 -->
            <div class="hotel-service-box">
                <div class="row gx-0 align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="owl-carousel owl-theme" id="wedding-hall-slider">
                            <div class="item">
                                <img src="{{ asset('img/wedding-hall-image.jpg')}}" alt="Image">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/wedding-hall-image2.jpg')}}" alt="Image">
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/wedding-hall-image3.jpg')}}" alt="Image">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="hotel-service-box-inner">
                            <div class="hotel-service-title">Wedding Hall</div>
                            <p>Holiday Inn Jaipur City center is a 5-star property located in the Pink City of India.
                                Just few minutes drive to Railway Station, Bus Stand and Airport.</p>
                            <a href="{{ url('wedding') }}" class="btn btn-primary">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Box 4 -->

        </div>
    </section>
    <!-- Hotel Service Section End -->

    <div class="container">
        <!-- Art and Artefacts Section Start -->
        <section class="art-artefacts-section">
            <div class="owl-carousel owl-theme" id="art-artefacts-slider">
                <!-- Dynamic Art and Artefacts -->
                @foreach ($artefact as $item)
                @if (count($artefact) == 0)
                <div class="vacancies-list">
                    <div class="vacancies-list-left">
                        <div class="vacancies-name">No Artefacts for now</div>
                    </div>
                </div>
                @else
                @if ($item->selected_website == 1)
                <div class="item">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <a href="javascript:void(0)" class="art-artefacts-img">
                                @if (!is_null($item->image))
                                <img src="{{ env('BACKEND_URL') . 'show-images/' . $item->image }}" alt="Img" class="img-fluid">
                                @else
                                <img src="{{ asset('img/dummy.png')}}" alt="Default Image" class="img-fluid">
                                @endif
                            </a>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="art-artefacts-text">
                                <a href="javascript:void(0)" class="art-artefacts-title text-primary">{{ $item->title }}</a>
                                <p class="mb-0">{!! Illuminate\Support\Str::words($item->description,100) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @endforeach
                <!-- End of Art and Artefact -->
            </div>
        </section>
        <!-- Art and Artefacts Section End -->
    </div>

    <section class="verdance-section" style="background-image:url('img/verdance-bg.jpg')">
        <div class="verdance-box">
            <div class="verdance-box-title text-primary">The impressions of verdance</div>
            <p>In the winding corridors of The Trade Fair and its palatial walls, you can find beautifully placed art
                and artefacts. With finely carved sculptures and ornate paintings inspired from the age old history of
                Odisha when merchants and travelers brought cultural influences from different parts of SouthEast Asia
                adorning its halls, Mayfair speaks of history wrapped in magnificence.</p>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            <div class="sub-title">Testimonials</div>
            <div class="section-title">words from People</div>

            <div class="owl-carousel owl-theme" id="testimonials-slider">

                @foreach ($data as $item)
                @if ($item->selected_website == 1)
                <div class="item">
                    <div class="tes-message-box">
                        <p>{{ Illuminate\Support\Str::words($item->review,100)}}</p>
                    </div>
                    <div class="tes-author-box">
                        <div class="tes-author-img">

                            @if(!is_null(json_decode($item->image)))
                            <img src="{{ env('BACKEND_URL') . 'show-images/' . json_decode($item->image)[0] }}" alt="{{ $item->author_name }}">
                            @else
                            <img src="{{ asset('img/dummy.png')}}" alt="Default Image">
                            @endif
                        </div>
                        <div class="author-name text-primary">{{ $item->author_name }}</div>
                    </div>
                </div>
                @endif
                @endforeach

            </div>

        </div>
    </section>

    <section class="tag-thetradefair">
        <div class="container">
            <div class="tag-thetradefair-title text-primary">#thetradefair</div>

            <div class="tag-thetradefair-message">
                <i class="fa fa-camera text-primary" aria-hidden="true"></i>
                Discover our destinations through the eyes of our guests. Share your experience with<br>
                #thetradefair and mention @thetradefairhotels for a chance to be featured.
            </div>
        </div>

    </section>

</main>


@include('messages')
@include('layouts.footer')


<script>
    $(document).ready(function() {
        var success_contact = "<?php if (Session::has('message')) {
                                    echo Session::get('message');
                                } else {
                                    echo 'no';
                                } ?>";

        if (success_contact != "no") {
            Swal.fire({
                title: 'Success!',
                text: success_contact,
                icon: 'success',
                timer: 3000,
            });
        }

    })
</script>

@endsection