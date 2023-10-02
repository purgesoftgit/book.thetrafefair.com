@extends('layouts.login-layout')

@section('content')

<script type="text/javascript" src="{{asset('js/jquery.star-rating-svg.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/star-rating-svg.css')}}">

@include('layouts.header1')

<main class="web-main">
    <div class="bottom-gap">
        <div class="container">
            @include('dashboard.banner')

            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-12">
                    <!-- Profile Side Nav Content section start-->
                    <button type="button" class="side-menu-button"><i class="fa fa-bars"></i> ORDERING & ENQUIRY</button>

                    <!-- navbar -->
                    @include('dashboard.navbar')
                    <!-- navbar -->
                </div>
                <div class="col-xxl-8 col-xl-8 col-lg-12">
                    <div class="screen-gap">

                        <h2 class="inner-title">Room Booking History</h2>

                        <div class="room-filter-block">
                            <select name="room_filter" id="roomFilter">
                                <option value="" selected="" disabled="">Select Filter</option>
                                <option value="D">Approve</option>
                                <option value="ROOM_CANCELLED">Cancelled</option>
                            </select>
                            <button type="button" class="btn btn-primary clear-btn">Clear</button>
                        </div>

                        <div class="table-responsive room-booking-table">
                            <table class="table table table-striped" id="transactionHistory">
                                <thead>
                                    <tr>
                                        <th width="42">S. No.</th>
                                        <th>User Details</th>
                                        <th>Room Detail</th>
                                        <th>Booked At</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($room_order_history as $key => $d)

                                    <?php $checkoutdata = json_decode($d['checkout_form_data'], true); ?>
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <b>Name : </b> {{$checkoutdata['customerName']}}<br>
                                            <b>Email : </b> {{$checkoutdata['customerEmail']}}<br>
                                            <b>Phone : </b> +91{{$checkoutdata['customerPhone']}}</br>
                                            @if(array_key_exists('food_items',$checkoutdata))
                                            <b style="text-transform:uppercase;">Add On Services :</b></br>
                                            @foreach($checkoutdata['food_items'] as $food)
                                            <b>{{$food['key']}} : </b> &#8377;{{$food['value']}}</br>
                                            @endforeach
                                            @endif
                                        </td>

                                        <td>
                                            <?php
                                            $item_id = 0; ?>
                                            <?php $room_category = ""; ?>
                                            @foreach($checkoutdata['item'] as $key1 => $value)
                                            @if($key1 == 'room_id')

                                            <?php $is_already_exists = isset($d['is_already_exists']) ? $d['is_already_exists'] : 0;
                                            $item_id = $value;
                                            ?>
                                            @endif
                                            @if($key1 == 'room_category')
                                            <?php $room_category =  ucwords(str_replace("_", " ", $value)); ?>
                                            @endif

                                            @if($key1 == 'per_shift_price')
                                            <strong><?php echo $room_category; ?> Shift Price : </strong>&#8377;{{$value}}<br>
                                            @endif

                                            @if($key1 == 'room')
                                            <strong>Room : </strong>{{ucfirst($value)}}&nbsp;&nbsp;&nbsp;
                                            @endif

                                            @if($key1 == 'guest')
                                            <strong>Guest : </strong>{{ucfirst($value)}}<br>
                                            @endif

                                            @endforeach

                                            <strong>InPerson Checkin Time : </strong>{{date('d M, Y',strtotime($d->inperson_checkin_time ?? $checkoutdata['checkin']))}} 12:00 PM<br>
                                            <strong>Checkout : </strong>{{date('d M, Y',strtotime($checkoutdata['checkout']))}} 11:00 AM<br>
                                            <strong>Transaction ID : </strong>{{$d->txnid}}<br>
                                            <strong>Total Amount : </strong> &#8377;{{$checkoutdata['totalAmount']}} <br>
                                            {{-- <strong>Status : </strong></strong>@if($d->status == 'P') <span class="incomplete">Pending</span> @elseif($d->status == 'D') <span class="delivered">Approved</span> @else <span class="reject">Cancelled</span> @endif --}}

                                        </td>
                                        <td>
                                            <strong>Date : </strong>{{ date('d F, Y',strtotime($d->created_at)) }}<br>
                                            <strong>Time : </strong>{{ date('H:i A',strtotime($d->created_at)) }}<br>

                                            @if($is_already_exists == 0 && $d->status != 'ROOM_CANCELLED')
                                            <span class="my_item_id new_item_id{{$key}}" data-index="{{$key}}" style="display:none;"><?php echo $item_id; ?></span>
                                            <div class="review-link" id="writereview"><button type="button" class="btn btn-primary btn-small review-btn">Write a Review</button></div>
                                            @endif

                                            @if($d->f_status == 'U' && $d->status != 'ROOM_CANCELLED')
                                            <div class="cancell-rooms mt-2"> <a class="btn btn-danger btn-small cancel-reservation" data-txnid="{{$d->txnid}}" style="font-size: 11px;">Cancel Booking</a> </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                    @if(count($room_order_history) == 0)
                                    <tr>
                                        <td colspan="8">
                                            <h6 class="text-center">Room Booking History not available.</h6>
                                        </td>
                                    </tr>
                                    @endif


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>



<!-- Modal Review start-->
<div class="modal fade write-review-popup" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewModalLabel">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="rating-and-review">
                    <div class="circle-user"><i class="fa fa-user" aria-hidden="true"></i></div>
                    <h4>Rate your Experience</h4>
                    <div class="my-rating"></div>
                </div>
                <hr>
                <div class="review-form">
                    <form method="POST" action="{{ url('save-review')}}" id="review_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="rating" class="rating" value="">
                        <input type="hidden" name="item_id" class="item_id" value="">
                        <input type="hidden" name="item_type" class="item_type" value="room">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Review Category</label>
                                    <select class="form-select room-category" name="category">
                                        @if(isset($category))
                                        @foreach($category as $value)
                                        <option value="<?php echo strtolower(str_replace(' ', '_', $value->name)); ?>">{{$value->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="likecomment" id="likecomment" class="form-control" placeholder="Title">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Write Your Review</label>
                                    <textarea name="message" id="message" class="form-control" placeholder="Write Your Review" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label">Select Images</label>
                            <input type="file" name="fileUpload[]" multiple />
                            <p>
                                <sub>(You can upload multiple images by selecting <b>ctrl+</b>)</sub>
                            </p>
                            <!-- <div class="input-images"></div> -->
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" id="addnews" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Review end-->

@include('messages')
@include('layouts.footer')
<script>
    $(document).ready(function() {
        

        $('.review-btn').click(function() {
            console.log("review btn click");
            var room_index = $('.my_item_id').data("index");
            $('#review_form .item_id').val($('.new_item_id' + room_index).text())
            $('#addReviewModal').modal("show");
        });


        $('.cancel-reservation').click(function() {
            var txnid = $(this).data("txnid")

            $.ajax({
                url: "{{ url('cancelReservation') }}",
                type: "POST",
                data: {
                    txnid: txnid
                },
                success: function(response) {
                    const obj = JSON.parse(response)
                    if (obj.status == "success") {
                        $('#success-popups .successmessage').text(obj.message + ' Please Wait a minute.');
                        $('#success-popups').modal('show');

                        setTimeout(() => {
                            window.location = "{{ url('/') }}";
                        }, 5000);
                    }

                    if (obj.status == "error") {
                        $('#unsuccess-popups .errormessage').text(obj.message);
                        $('#unsuccess-popups').modal('show');
                    }

                }
            })
        });


        if (localStorage.getItem("room_order_filter") != null) {
            $('#roomFilter option[value="' + localStorage.getItem("room_order_filter") + '"]').prop('selected', true)
        }

        var total_count = "<?php echo count($room_order_history); ?>";
        if (total_count == 0) {
            localStorage.removeItem("room_order_filter");
        }

        var issuccess = "<?php if (Session::get('success')) {
                                echo true;
                            } else {
                                echo false;
                            } ?>";
        if (issuccess == 1) {
            $('#review-success-popups .successmessage').text("We appreciate that you've taken a time to write review. We will back to you very soon.")
            $('#review-success-popups').modal('show')
        }

        $("#review_form").validate({
            rules: {
                likecomment: "required",
                message: "required",
            },
            // Specify validation error messages
            messages: {
                likecomment: "Title is required.",
                message: "Message is required.",
            },
            submitHandler: function(form) {
                $('#review_form').submit();

            }
        });

        $('#roomFilter').change(function() {
            localStorage.setItem("room_order_filter", $(this).val());
            window.location = "{{ url('room-order-history') }}/" + $(this).val()
        });


        $('.clear-btn').click(function() {
            localStorage.removeItem("room_order_filter");
            window.location = "{{ url('room-order-history') }}";
        });

        $('.rating').val(0);
        $(".my-rating").starRating({
            // initialRating: 5,
            starSize: 25,
            disableAfterRate: false,
            callback: function(currentRating, $el) {
                $('.rating').val(currentRating);
            },

        });

        $('#transactionHistory').dataTable({
            "order": [
                [0, 'asc']
            ]
        });
    })
</script>
@endsection