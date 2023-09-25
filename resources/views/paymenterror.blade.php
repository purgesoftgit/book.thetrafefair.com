@extends('layouts.layout')
@section('content')
<!-- Header Section Start -->
@include('layouts.header')    
<!-- Header Section End -->
<!-- Mid Section Start -->
<main class="web-main">
    <!-- 404 Start -->
    <div class="failure-page">
      <div class="container">

        <div class="failure-img">
          <img src="{{asset('img/failure-img.png')}}" alt="Img" class="img-fluid">
        </div>

        <div class="row">
          <div class="col-lg-5 col-md-12">
            <div class="col-inner-center">
              <h1>PAYMENT FAILED</h1>
              <p>An error occurred while processing your payment.<br>Please try again later</p>
              <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
              <!-- <button type="button" class="btn btn-dark" onclick="history.back()">Go Back</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 404 End -->
    
</main>
<!-- Footer Section Start -->
@include('layouts.footer')
@endsection