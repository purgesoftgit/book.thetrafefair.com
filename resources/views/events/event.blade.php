@extends('layouts.layout')
@section('content')
    @include('layouts.header')
    <style>
        label.error {
            color: red;
            font-size: 13px;
        }
    </style>

    <main class="web-main">

        <!-- Page Title Section Start -->
        <section class="page-title-section" style="background-image:url(img/event-banner-img.jpg);">
            <div class="container">
                <div class="page-title">Banquets &amp; Meetings</div>
            </div>
        </section>
        <!-- Page Title Section End -->

        <!-- Vacancies Listing Section Start -->
        <section class="vacancies-listing-section">
            <div class="container">

                <ul class="nav justify-content-center nav-pills maintab-design" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="choose-destination-tab" data-bs-toggle="tab"
                            data-bs-target="#choose-destination-tab-pane" type="button" role="tab"
                            aria-controls="choose-destination-tab-pane" aria-selected="true">Choose Destination</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="request-book-tab" data-bs-toggle="tab"
                            data-bs-target="#request-book-tab-pane" type="button" role="tab"
                            aria-controls="request-book-tab-pane" aria-selected="false">Request to Book</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="choose-destination-tab-pane" role="tabpanel"
                        aria-labelledby="choose-destination-tab" tabindex="0">


                        @foreach ($event as $item)
                            @if (count($event) == 0)
                                <div class="event-list">
                                    <div class="event-list-cont">
                                        <div class="tab-content">No Event Available</div>
                                    </div>
                                </div>
                            @else
                                @if ($item->selected_website == 1)
                                    <div class="event-list">
                                        <a href="javascript:void(0)" class="event-list-img">
                                            @if (!is_null($item->image))
                                                <img src="{{ env('BACKEND_URL') . 'show-images/' . $item->image }}"
                                                    alt="Img" class="img-fluid">
                                            @else
                                                <img src="img/dummy.png" alt="Default Image" class="img-fluid">
                                            @endif
                                        </a>
                                        <div class="event-list-cont">
                                            <div class="event-date">
                                                <span>{{ Carbon\Carbon::parse($item->start_datetime)->format('D') }}</span>
                                                <strong>{{ Carbon\Carbon::parse($item->start_datetime)->format('d') }}</strong>
                                            </div>
                                            <div class="event-list-inner">
                                                <div class="event-timing">
                                                    {{ Carbon\Carbon::parse($item->start_datetime)->format('F d, Y') }} -
                                                    {{ Carbon\Carbon::parse($item->end_datetime)->format('F d, Y') }}</div>
                                                <a href="javascript:void(0)" class="event-name">{{ $item->location }}</a>

                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="TTF-lagoon-tab-pane"
                                                        role="tabpanel" aria-labelledby="TTF-lagoon-tab" tabindex="0">
                                                        <p>{!! Illuminate\Support\Str::words($item->description, 50) !!}</p>
                                                        <a href="{{ url('event-detail', $item->slug) }}"
                                                            class="success">View
                                                            Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach

                    </div>

                    @if (session('status') == 200)
                        <div id="initialMessage">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="tab-pane fade" id="request-book-tab-pane" role="tabpanel" aria-labelledby="request-book-tab"
                        tabindex="0">

                        <div class="reservation-box request-book-form">

                            <form id="eventRequest" class="ttf_form" action="{{ route('eventStore') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="step-btns">

                                    <button class="acc-step-btn active">
                                        <div class="step-icon">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                        <span>Account</span>
                                    </button>

                                    <button class="personal-step-btn">
                                        <div class="step-icon">
                                            <img src="img/user-icon.png" alt="image">
                                        </div>
                                        <span>Personal Detail</span>
                                    </button>

                                </div>

                                <!-- EVENTS DETAILS Step Start -->
                                <div class="step-first">

                                    <div class="reservation-title mb-5">EVENTS DETAILS</div>

                                    <div class="mb-4">
                                        <label for="select-hotel-field" class="form-label">Select Hotel
                                            <sup>*</sup></label>
                                        <input type="text" class="form-control" id="select-hotel-field" name="hotel"
                                            value="The Trade International" readonly>
                                    </div>

                                    <div class="mb-4">
                                        <label for="event-name-field" class="form-label">Event Name <sup>*</sup></label>
                                        <input type="text" class="form-control" id="event-name-field" name="event_name">
                                        @if ($errors->has('event_name'))
                                            <span class="text-danger"> {{ $errors->first('event_name') }} </span>
                                        @endif
                                    </div>

                                    <div class="mb-4">
                                        <label for="number-guest-field" class="form-label">Number of Guest
                                            <sup>*</sup></label>
                                        <input type="text" class="form-control" id="number-guest-field"
                                            name="guest_number">
                                        @if ($errors->has('guest_number'))
                                            <span class="text-danger"> {{ $errors->first('guest_number') }} </span>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 mb-4">
                                            <label for="sdate-field" class="form-label">Event Start Date
                                                <sup>*</sup></label>
                                            <input type="datetime-local" class="form-control sdate" id="sdate-field" name=start_date min="<?php echo date('Y-m-d'); ?>" onkeydown="return false" value="<?php echo date('Y-m-d'); ?>">
                                            @if ($errors->has('start_date'))
                                                <span class="text-danger"> {{ $errors->first('start_date') }} </span>
                                            @endif
                                        </div>

                                        <div class="col-sm-6 mb-4">
                                            <label for="edate-field" class="form-label">Event End Date
                                                <sup>*</sup></label>
                                            <input type="datetime-local" class="form-control edate" id="edate-field" name="end_date" min="<?php echo date('Y-m-d'); ?>" onkeydown="return false" value="<?php echo date('Y-m-d'); ?>">
                                            @if ($errors->has('end_date'))
                                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Seating Style</label>
                                        <div>
                                            <div class="form-check seating-style-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios"
                                                    id="exampleRadios1" value="Classroom" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    <img src="img/classroom-icon.png" alt="Image">
                                                    <span>Classroom</span>
                                                </label>
                                            </div>

                                            <div class="form-check seating-style-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios"
                                                    id="exampleRadios2" value="Theatre">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    <img src="img/theatre-icon.png" alt="Image">
                                                    <span>Theatre</span>
                                                </label>
                                            </div>

                                            <div class="form-check seating-style-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios"
                                                    id="exampleRadios3" value="Sitdown">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    <img src="img/sitdown-icon.png" alt="Image">
                                                    <span>Sitdown</span>
                                                </label>
                                            </div>

                                            <div class="form-check seating-style-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios"
                                                    id="exampleRadios4" value="Cocktail">
                                                <label class="form-check-label" for="exampleRadios4">
                                                    <img src="img/cocktail-icon.png" alt="Image">
                                                    <span>Cocktail</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-5">
                                        <button type="button" class="btn btn-primary next-btn"
                                            style="min-width:170px;">Next</button>
                                    </div>
                                </div>
                                <!-- EVENTS DETAILS Step End -->

                                <!-- PERSONAL DETAILS Step Start -->
                                <div class="step-second" style="display:none;">

                                    <div class="reservation-title mb-5">PERSONAL DETAILS</div>

                                    <div class="mb-4">
                                        <label for="full-name-field" class="form-label">Full Name <sup>*</sup></label>
                                        <input type="text" class="form-control" id="full-name-field"
                                            name="full_name">
                                        @if ($errors->has('full_name'))
                                            <span class="text-danger">{{ $errors->first('full_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-4">
                                        <label for="phone-field" class="form-label">Phone <sup>*</sup></label>
                                        <input type="text" class="form-control" id="phone-field" name="phone">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-4">
                                        <label for="email-field" class="form-label">Email <sup>*</sup></label>
                                        <input type="email" class="form-control" id="email-field" name="email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <p><strong>Note :</strong> Green ticks on the previous steps means your form has
                                        been filled out correctly.</p>

                                    <div class="text-center mt-5">
                                        <button type="submit" class="btn btn-primary"
                                            style="min-width:170px;">Submit</button>
                                    </div>
                                </div>
                                <!-- PERSONAL DETAILS Step End -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Vacancies Listing Section End -->

    </main>

    @include('layouts.footer')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            //update end date
            // $('.sdate').on('change',function(){
            //     startdate = $(this).val() 
            //     $('.edate').val(moment(startdate).add(1, 'days').format("YYYY-MM-DD"))
            //     $('.edate').attr("min",moment(startdate).add(1, 'days').format("YYYY-MM-DD"));
            // });
            $("#eventRequest").validate({
                rules: {
                    event_name: {
                        required: true,
                        minlength: 3
                    },
                    guest_number: {
                        required: true,
                        number: true,
                    },
                    start_date: "required",
                    end_date: "required",
                    full_name: {
                        required: true,
                        minlength: 3
                    },
                    phone: {
                        required: true,
                        digits: true,
                        rangelength: [10, 10]
                    },
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    event_name: {
                        required: " Please enter an event name",
                        minlength: "Please enter at least 3 characters"
                    },
                    guest_number: {
                        required: "Please enter the number of guests",
                        number: "Please enter a number"
                    },
                    start_date: "Please enter the event start date",
                    end_date: "Please enter the event end date",
                    full_name: {
                        required: "Please enter your full name",
                        minlength: "Please enter at least 3 characters"
                    },
                    phone: {
                        required: "Please enter your phone number",
                        digits: "Please enter a number",
                        rangelength: "Please enter a valid phone number"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email"
                    }

                },
                submitHandler: function(form) {
                    Swal.fire({
                        title: '',
                        text: 'Please wait while processing...',
                        icon: 'info',
                        timer: 3000, // Show this message for 3 seconds
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(function () {
                        form.submit();
                    });

                    

                } 
            });

            $('.next-btn').on("click", function() {
                //hide or show tabs class on stepper btn 
                if ($("#eventRequest").valid()) {
                    $('.step-second').show();
                    $('.step-first').hide();

                    //remove or add active class on stepper btn 
                    $('.personal-step-btn').addClass('active');
                }
            });
            
        });
    </script>


@endsection
