@extends('layouts.layout')
@section('content')
<!-- Header Section Start -->
@include('layouts.header')    
<!-- Header Section End -->
<!-- Mid Section Start -->
<style>h1{color:#88b04b;font-family:"Nunito Sans","Helvetica Neue",sans-serif;font-weight:900;font-size:40px;margin-bottom:10px}p{color:#404f5e;font-family:"Nunito Sans","Helvetica Neue",sans-serif;font-size:20px;margin:0}span.check{color:#9abc66;font-size:100px;line-height:200px;margin-left:-15px}.card{text-align:center;background:#fff;padding:60px;border-radius:4px;box-shadow:0 2px 3px #c8d0d8;display:inline-block;margin:0 auto}.no-para{font-size: 24px;color: #868685;padding: 30px;} </style>
<div class="mid-section">
  <div class="container">
   
    <div class="row">
      
      <div class="col-xxl-12 col-xl-12 col-lg-12" style="text-align: center;">
        <div class="card">
        <div style="border-radius:200px; height:141px; width:200px; background: #F8FAF5; margin:0 auto;">
          <span class="check">&#10003;</span>
        </div>
          <h1>Success</h1> 
          <p><b>Congratulations!! Your wallet has successfully recharged</b></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Footer Section Start -->
@include('layouts.footer')
 
@endsection