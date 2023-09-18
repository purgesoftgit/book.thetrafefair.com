@extends('layouts.layout')
@section('content')
    @include('layouts.header')

    <main class="web-main">
        <section class="page-title-section" style="background-image:url(img/blog-banner-img.jpg);">
            <div class="container">
                <div class="page-title">The Trade Fair Blogs</div>
            </div>
        </section>
        <!-- Page Title Section Start -->
        <!-- Page Title Section End -->

        <!-- Blog Page Start -->
        <section class="blog-page-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        @if($blogs->isEmpty())
                        <div class="blog-title text-center" style="padding-top: 20%;">
                            <div class="shadow-lg p-3 mb-5 bg-body rounded w-75">
                                <h2 class="page-title text-dark fs-4">No blog found for this category</h2>
                            </div>
                        </div>
                        @else
                        @foreach ($blogs as $blog)
                            <div class="blog-listing">
                                <!-- Blog List Start -->
                                <div class="blog-list">
                                    <div class="blog-title"><a href="javascript:void(0)">{{ $blog->title }}</a></div>
                                    <div class="blog-img">
                                        <a href="javascript:void(0)">
                                            @if (!is_null($blog->image))
                                                <img src="{{ env('BACKEND_URL') . 'show-images/' . $blog->image }}"
                                                    alt="Img" class="img-fluid">
                                            @else
                                                <img src="{{ asset('img/dummy.png')}}" alt="Default Image" class="img-fluid">
                                            @endif
                                        </a>
                                        <div class="blog-date">
                                            {{ Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</div>
                                        <div class="web-logo"><img src="{{ asset('img/logo-blog.png') }}" alt="Logo">
                                        </div>
                                    </div>

                                    <div class="blog-text">
                                        <p>{!! Illuminate\Support\Str::words($blog->description, '50') !!}
                                        </p>

                                        <a href="{{ url('blog-detail', $blog->slug) }}" class="btn btn-bordered">Read
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="blog-sidebar">
                            <div class="sidebar-box-list">
                                <div class="sidebar-heading">Latest Blog</div>
                                @foreach ($blogs as $item)
                                    @if ($item->type == 1)
                                        <div class="latest-blog-list">
                                            <div class="latest-blog-img">
                                                @if (!is_null($item->image))
                                                    <img src="{{ env('BACKEND_URL') . 'show-images/' . $item->image }}"
                                                        alt="Img" class="img-fluid">
                                                @else
                                                    <img src="img/dummy.png" alt="Default Image" class="img-fluid">
                                                @endif
                                            </div>
                                            <div class="latest-blog-content">
                                                <div class="latest-blog-title">
                                                    <a
                                                        href="{{ url('blog-detail', ['id' => $item->slug]) }}">{{ $item->title }}</a>
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
                                <div class="sidebar-heading">Categories
                                @if(request()->has('category'))
                                <span><a href="{{url('blog')}}"><i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Reset Category Filter"></i>
                                </a></span>
                                @endif
                            </div>
                                <div>
                                    @foreach ($categories as $item)
                                        <a href="{{ route('blog',['category' => $item->slug])}}" class="categories-list">{{ $item->category }}</a>
                                    @endforeach   
                                </div>
                            </div>
                            
                            <!-- Col 4 End -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    @include('layouts.footer')
@endsection
