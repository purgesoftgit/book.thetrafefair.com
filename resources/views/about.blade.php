@extends('layouts.layout')
@section('content')
@include('layouts.header')
<main class="web-main">

    <!-- Page Title Section Start -->
    <section class="page-title-section" style="background-image:url({{ asset('img/about-banner-img.jpg')}});">
      <div class="container">
        <div class="page-title">About Us</div>
      </div>
    </section>
    <!-- Page Title Section End -->

    <!-- Hotel Service Section Start -->
    <section class="hotel-service-section">
      <div class="container">
        <!-- Box 1 -->
        <div class="hotel-service-box">
          <div class="row gx-0 align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-12">
              <img src="{{ asset('img/about-page-img.jpg')}}" alt="Rooms and Suites" class="img-fluid">
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="hotel-service-box-inner">
                <div class="hotel-service-title">About Us</div>
                <p>Royal Orchid & Regenta Hotels is one of India's fastest-growing hospitality brands, managing a portfolio of over 90+ properties across the country. Founded in 2001 by industry veteran Mr. Chander K Baljee, Royal Orchid & Regenta Hotels is a renowned and trusted brand with a growth plan to reach 100 hotels by 2023.</p>

                <p>We cater to business and leisure travellers who value comfort, great cuisine, distinctly warm Indian hospitality, and value for money. Our modern and fully equipped hotels, resorts, long-stay suites, and inns are what make our guests return time and time again to our properties in metro cities, holiday destinations, pilgrimage sites and wildlife parks. With a Head Office based in the heart of Bengaluru, the team at Royal Orchid & Regenta Hotels is truly passionate about hospitality and driven to deliver immaculate guest experiences. Our success flows from our core values; creating exceptional </p>
              </div>
            </div>
          </div>
        </div>
        <!-- Box 1 -->
      </div>
    </section>
    <!-- Hotel Service Section End -->

    <!-- Counter Section Start -->
    <section class="counter-section">
      <div class="container">
        <article>
          <div class="counter-list-number">{{ $settings['total_resort'] ?? '' }}</div>
          <div class="counter-list-name">Resort</div>
        </article>
        <article>
          <div class="counter-list-number">{{ $settings['total_location'] ?? ''}}</div>
          <div class="counter-list-name">Location</div>
        </article>
        <article>
          <div class="counter-list-number">{{ $settings['ttf_total_rooms'] ?? ''}}</div>
          <div class="counter-list-name">Rooms</div>
        </article>
        <article>
          <div class="counter-list-number">{{ $settings['ttf_total_restaurants'] ?? ''}}</div>
          <div class="counter-list-name">Restaurants</div>
        </article>
      </div>
    </section>
    <!-- Counter Section End -->

    <!-- Hotel Service Section Start -->
    <section class="hotel-service-section evennth">
      <div class="container">

        <!-- Box 1 -->
        <div class="hotel-service-box">
          <div class="row gx-0 align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-12 order-lg-last">
              <img src="{{ asset('img/mission-img.jpg')}}" alt="Restaurants" class="img-fluid">
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="hotel-service-box-inner">
                <div class="hotel-service-title">Our Mission </div>
                <p>Royal Orchid & Regenta Hotels is one of India's fastest-growing hospitality brands, managing a portfolio of over 90+ properties across the country. Founded in 2001 by industry veteran Mr. Chander K Baljee, Royal Orchid & Regenta Hotels is a renowned and trusted brand with a growth plan to reach 100 hotels by 2023.</p>

                <p>We cater to business and leisure travellers who value comfort, great cuisine, distinctly warm Indian hospitality, and value for money. Our modern and fully equipped hotels, resorts, long-stay suites,</p>
                <button type="button" class="btn btn-primary">Learn More</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Box 1 -->


        <!-- Box 2 -->
        <div class="hotel-service-box">
          <div class="row gx-0 align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-12">
              <img src="{{ asset('img/vision-img.jpg')}}" alt="Restaurants" class="img-fluid">
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12">
              <div class="hotel-service-box-inner">
                <div class="hotel-service-title">Our Vision </div>
                <p>Royal Orchid & Regenta Hotels is one of India's fastest-growing hospitality brands, managing a portfolio of over 90+ properties across the country. Founded in 2001 by industry veteran Mr. Chander K Baljee, Royal Orchid & Regenta Hotels is a renowned and trusted brand with a growth plan to reach 100 hotels by 2023.</p>

                <p>We cater to business and leisure travellers who value comfort, great cuisine, distinctly warm Indian hospitality, and value for money. Our modern and fully equipped hotels, resorts, long-stay suites,</p>
                <button type="button" class="btn btn-primary">Learn More</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Box 2 -->
      </div>
    </section>

  </main>
@include('layouts.footer')
@endsection