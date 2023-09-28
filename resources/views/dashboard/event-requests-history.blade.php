@extends('layouts.login-layout')

@section('content')
<style>
    .seating_style{
        color: green
    }
</style>
<script type="text/javascript" src="{{asset('js/jquery.star-rating-svg.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/star-rating-svg.css')}}">

@include('layouts.header1')

<main class="web-main">
    <div class="bottom-gap">
        <div class="container">
            @include('dashboard.banner')

            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <!-- Profile Side Nav Content section start-->
                    <button type="button" class="side-menu-button"><i class="fa fa-bars"></i> Side Menu</button>

                    <!-- navbar -->
                    @include('dashboard.navbar')
                    <!-- navbar -->
                </div>
                <div class="col-xxl-8 col-xl-8 col-lg-8">

                    <h2 class="inner-title">Event Request History</h2>

                    {{-- <div class="room-filter-block">
                        <select name="room_filter" id="roomFilter">
                            <option value="" selected="" disabled="">Select Filter</option>
                            <option value="D">Approve</option>
                            <option value="ROOM_CANCELLED">Cancelled</option>
                        </select>
                        <button type="button" class="btn btn-primary clear-btn">Clear</button>
                    </div> --}}

                    <div class="table-responsive">
                        <table class="table table table-striped" id="transactionHistory">
                            <thead>
                                <tr>
                                    <th width="15%">Person</th>
                                    <th width="15%">Event Name</th>
                                    <th width="10%">Guest Numbers</th></th>                          
                                    <th width="15%">Start Date</th>
                                    <th width="15%">End Date</th>
                                    <th width="10%">Seating Style</th>
                                    <th width="10%">Status</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @if(count($category) == 0)
                                <tr>
                                    <td colspan="8">
                                        <h6 class="text-center">Event Request History not available.</h6>
                                    </td>
                                </tr>
                               @else
                                @foreach($category as $key => $d)
                                
                               <tr>
                                 <td style="vertical-aligb: top">
                                   <strong>Name : </strong>{{$d->full_name}}</br>
                                   <strong>Email : </strong>{{$d->email}}</br>
                                   <strong>Phone : </strong>{{$d->phone}}</br>
                                 </td>
                                 <td style="vertical-align: top" >{{$d->event_name}}</td>
                                 <td style="vertical-align: top" >{{$d->guest_number}}</td>
                                 <td style="vertical-align: top" >{{date('d F, Y', strtotime($d->start_date))}}</td>
                                 <td style="vertical-align: top" >{{date('d F, Y', strtotime($d->end_date))}}</td>
                                 <td style="vertical-align: top" >
                                   @if($d->seating_style == "Theatre")
                                   <span class="seating_style">Theatre</span>
                                   @elseif($d->seating_style == "Classroom")
                                   <span class="seating_style">Classroom</span>
                                   @elseif($d->seating_style == "Sitdown")
                                   <span class="seating_style">Sitdown</span>
                                   @else
                                   <span class="seating_style">Cocktail</span>
                                   @endif
                                 </td>
                                 <td>{{$d->status == 0 ? 'Pending':'Approved'}}</td>
                
                               </tr>
                               @endforeach
                               @endif 
                               
                               
                               
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
