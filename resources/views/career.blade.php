@extends('layouts.layout')
@section('content')
    @include('layouts.header')

    <main class="web-main">

        <!-- Page Title Section Start -->
        <section class="page-title-section" style="background-image:url(img/career-banner-img.jpg);">
            <div class="container">
                <div class="page-title">Current Openings</div>
            </div>
        </section>
        <!-- Page Title Section End -->

        <!-- Vacancies Listing Section Start -->
        <section class="vacancies-listing-section">
            <div class="container">

                <!-- Vacancies List Start -->
                @foreach ($career as $item)
                    @if (count($career) == 0)
                        <div class="vacancies-list">
                            <div class="vacancies-list-left">
                                <div class="vacancies-name">No Openings Available</div>
                            </div>
                        </div>
                    @else
                        @if ($item->selected_website == 1)
                            <div class="vacancies-list">
                                <div class="vacancies-list-left">
                                    <div class="vacancies-name">{{ $item->job_title }}</div>
                                    <div class="vacancies-position">{{ $item->department }}</div>
                                    <div class="vacancies-loc-time">
                                        <span>{{ $item->experience }}</span>
                                        <span>{{ $item->location }}</span>
                                    </div>
                                         
                                    <?php $des_text = strip_tags($item->description); ?>
                                    @if(strlen($des_text) > 101 && $item['room_category'] != "suite")
                                    {!! substr($des_text,0,101) !!}
                                    <span class="read-more-show hide_content">  Read More</span>
                                    <span class="read-more-content">{!! substr($des_text,101,strlen($des_text))!!} 
                                    <span class="read-more-hide hide_content">  Less </span>
                                    @else
                                    {{$des_text}}
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
                <!-- Vacancies List End -->

                <div class="please-contact">
                    <p>If you have any more questions, for further inquiries please contact :- <a
                            href="mailto:{{ $settings['tradefair_email'] ?? '' }}">{{ $settings['tradefair_email'] ?? '' }}</span></a>
                    </p>
                </div>
            </div>
        </section>
        <!-- Vacancies Listing Section End -->

    </main>

@include('layouts.footer')
<script src="{{ asset('js/custom.js') }}"></script>
@endsection


