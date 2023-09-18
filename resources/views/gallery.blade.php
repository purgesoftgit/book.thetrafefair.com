@extends('layouts.layout')
@section('content')
@include('layouts.header')

<main class="web-main">

<!-- Page Title Section Start -->
<section class="page-title-section" style="background-image:url(img/career-banner-img.jpg);">
  <div class="container">
    <div class="page-title">Gallery</div>
  </div>
</section>
<!-- Page Title Section End -->

<!-- Gallery Page Section Start -->
<section class="gallery-page-section">
  <div class="container">

    <div class="row" id="my-gallery-container">
      <div class="item" data-order="1">
        <img src="https://i.pinimg.com/originals/93/b9/13/93b9136084abb5256edf925a131a3c01.jpg" alt="">
      </div>
      <div class="item" data-order="2">
        <img src="https://s.abcnews.com/images/Lifestyle/ht_suite_week_st_regis_governors_08_jc_141120_3x4_1600.jpg?w=1600" alt="">
      </div>
      <div class="item" data-order="3">
        <img src="https://i.pinimg.com/originals/70/7c/31/707c31a293ceea607f733524bc8a01b7.jpg" alt="">
      </div>
      <div class="item" data-order="4">
        <img src="https://images-na.ssl-images-amazon.com/images/I/81cO8Rz0gjL._AC_SL1500_.jpg" alt="">
      </div>
      <div class="item" data-order="5">
        <img src="https://pbs.twimg.com/media/DgmCYzYW4AAsSSE?format=jpg&name=large" alt="">
      </div>
      <div class="item" data-order="6">
        <img src="https://i.pinimg.com/originals/31/d4/63/31d463216b574128c0b0f0c2f62b3971.jpg" alt="">
      </div>
      <div class="item" data-order="7">
        <img src="https://i.pinimg.com/originals/4d/a3/b5/4da3b5366b4171859183ae57e58f9534.jpg" alt="">
      </div>
      <div class="item" data-order="8">
        <img src="https://i.pinimg.com/736x/ea/8b/68/ea8b6821a564aae5c29815e99d09b4cf.jpg" alt="">
      </div>
    </div>

    <!-- <div class="text-center mt-5">
      <button type="button" class="btn btn-primary">Load More</button>
    </div> -->

  </div>
</section>
<!-- Gallery Page Section End -->

</main>

@include('layouts.footer')

<script type="text/javascript">
    jQuery(document).ready(function ( $ ) {
      $("#my-gallery-container").mpmansory(
      {
          childrenClass: 'item', // default is a div
          columnClasses: 'padding', //add classes to items
          breakpoints:{
            xl: 4, 
            lg: 4, 
            md: 6, 
            sm: 6
          },
          distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
          onload: function (items) {
            //make somthing with items
          } 
        }
        );
    });
  </script>

@endsection

