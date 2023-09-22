@extends('layouts.layout')
@section('content')
@include('layouts.header')
<main class="web-main">
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <img src="{{asset('img/check.png')}}"/>
            <div class="mt-5">
                <h4>Thank You!</h4>
                <p class="mt-3">Thank You For Contacting with The Trade Fair. We will be touch you shortly.</p>
            </div>
            <div class="mt-3">
                <a class="btn btn-primary" href="{{ url('/') }}">RETURN TO HOME</a>
            </div>
        </div>
    </div>
</main>
@include('layouts.footer')
@endsection