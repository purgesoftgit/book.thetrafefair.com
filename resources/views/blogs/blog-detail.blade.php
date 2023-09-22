@extends('layouts.layout')
@section('content')
@include('layouts.header')

<!-- Header Section End -->
<main class="web-main">

  <!-- Page Title Section Start -->
  <section class="page-title-section" style="background-image:url({{asset("img/blog-banner-img.jpg")}});">
    <div class="container">
      @if($blog_detail)
      <div class="page-title">{{$blog_detail->title}}</div>
      @endif

    </div>
  </section>
  <!-- Page Title Section End -->

  <!-- Blog Page Start -->
  <section class="blog-page-section">
    <div class="container">
      <div class="row">

        <!-- Col 8 Start -->
        @if($blog_detail)
        <div class="col-xl-8 col-lg-8">
          <div class="blog-detail">
            <div class="blog-img">
              <img src="{{ env('BACKEND_URL') . 'show-images/' . $blog_detail->image }}" alt="Image" class="img-fluid">
            </div>
            <div class="blog-date-simple">
              {{ Carbon\Carbon::parse($blog_detail->created_at)->format('F d, Y') }}
            </div>
            {{-- <p style="text-align:justify;">{!!$blog_detail->description!!}</p> --}}
            <p style="text-align:justify;">{{ strip_tags($blog_detail->description) }}</p>

          </div>
        </div>
        @else
        <div class="col-xl-8 col-lg-8">
          <div class="blog-detail">
            <h2>Blog Not Found</h2>
          </div>
        </div>
        @endif
        <!-- Col 8 End -->

        <!-- Col 4 Start -->
        <div class="col-xl-4 col-lg-4">

          <div class="blog-sidebar">

            {{-- <div class="search-box">
                <form action="" method="GET">
                  <input type="text" name="search" class="form-control" placeholder="Search">
                </form>
              </div> --}}


            <div class="sidebar-box-list">
              <div class="sidebar-heading">Find Us</div>

              <div>
                <div id="share"></div>
                <!-- <a href="#" class="side-social fa fa-facebook"></a>
                  <a href="#" class="side-social fa fa-twitter"></a>
                  <a href="#" class="side-social fa fa-instagram"></a>
                  <a href="#" class="side-social fa fa-linkedin"></a>
                  <a href="#" class="side-social fa fa-youtube"></a> -->
              </div>

            </div>

            <div class="sidebar-box-list">
              <div class="sidebar-heading">Latest Blog</div>
              <div>

                @foreach ($latest_blog as $item)
                @if ($item->type == 1)
                <div class="latest-blog-list">
                  <div class="latest-blog-img">
                    @if (!is_null($item->image))
                    <img src="{{ env('BACKEND_URL') . 'show-images/' . $item->image }}" alt="Img" class="img-fluid">
                    @else
                    <img src="img/dummy.png" alt="Default Image" class="img-fluid">
                    @endif
                  </div>
                  <div class="latest-blog-content">
                    <div class="latest-blog-title">
                      <a href="{{ url('blog-detail', ['id' => $item->slug]) }}">{{$item->title}}</a>
                    </div>
                    <div class="latest-blog-date">
                      <span>{!! Illuminate\Support\Str::words($item->description, 10) !!}</span>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>



              <div class="sidebar-box-list">
                <div class="sidebar-heading">Categories</div>
                <div>
                  @foreach ($categories as $item)
                  <a href="{{ route('blog',['category' => $item->slug])}}" class="categories-list">{{ $item->category }}</a>
                  @endforeach
                </div>
              </div>
              <!-- Col 4 End -->

              @if(count($tagsArray) > 0 && !empty($blog_detail->tags))
              <div class="sidebar-box-list">
                <div class="sidebar-heading">Tags</div>

                <div>

                  @foreach($tagsArray as $tag)
                  <a href="javascript:void(0)" class="tags-list">{{$tag}}</a>
                  @endforeach

                </div>

              </div>
              @endif
              <!-- Col 4 End -->

            </div>
          </div>
  </section>
  <!-- Blog Page End -->

</main>

@include('layouts.footer')

<script>
  $(document).ready(function() {
    $("#share").jsSocials({
      showLabel: false,
      showCount: false,
      shares: ["twitter", "facebook", "linkedin", "whatsapp"]
    });
  })
</script>

@endsection