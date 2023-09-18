@extends('layouts.layout')
@section('content')
    @include('layouts.header')
    <style>
        .room-detail-page{
            background-image: url('http://34.83.47.170/thetradeinternational/public/img/room-banner.jpg') ;
        }
    </style>
    <main class="web-main">
         <!-- Page Title Section Start -->
         <section class="page-title-section room-detail-page">
            <div class="container">
                <div class="page-title">Rooms</div>
            </div>
        </section>
        <div class="container pt-3">
            <div class="row">
                <div class="col-xl-8 col-lg-7 order-lg-first">
                    <div class="room-list">
                        <div class="room-list-img">
                            <a href="javascript:void(0)" class="room-list-img">
                                @if (!is_null(json_decode($data->image)))
                                    <img src="{{ env('BACKEND_URL') . 'show-images/' . json_decode($data->image)[0] }}"
                                        alt="Image">
                                @else
                                    <img src="{{ asset('img/dummy.png') }}" alt="Default Image">
                                @endif
                            </a>
                            <div class="web-logo"><img src="{{ asset('img/logo-blog.png') }}" alt="Logo"></div>
                            <div class="room-offers">
                                <big>{{ $data->off_percentage }}<sup>%</sup></big>
                                <span>Off</span>
                            </div>
                        </div>
        
                        <div class="room-list-detail">
                            <div class="room-list-title"><a href="javascript:void(0)">{{ $data->title }}</a></div>
                            <p>{{ strip_tags(\Illuminate\Support\Str::words($data->description, 50)) }}</p>
                            <div class="room-list-bottom">
                                <big>₹ {{ $data->price }}</big>
                                <s>₹ {{ $data->old_price }}</s>
                            </div>
        
                            <a href="javascript:void(0)" class="room-detail-btn"><span>Room Details</span></a>
                        </div>
        
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@include('layouts.footer')
@endsection