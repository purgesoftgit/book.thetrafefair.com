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

                    <h2 class="inner-title">Spa Reservation History</h2>

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
                                    <th width="20%">Person</th>
                                    <th width="25%">Start Date & Time</th></th>                          
                                    <th width="25%">End Date & Time</th>
                                    <th width="10%">Total Persons</th>
                                    <th width="10%">Message</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
          
                            <tbody>
                                @if(count($spa_reservation) == 0)
                                <tr>
                                  <td colspan="7"><h6 class="text-center">No Bookings Yet.</h6></td>
                                </tr>
                                @else
                                   @foreach($spa_reservation as $key => $d)
                                  <tr>
                                    <td style="vertical-aligb: top">
                                      <strong>Name : </strong>{{$d->name}}</br>
                                      <strong>Email : </strong>{{$d->email}}</br>
                                    </td>
                                    <td style="vertical-aligb: top">
                                      <strong>Start Date : </strong>{{date('d F, Y', strtotime($d->start_date))}}</br>
                                      <strong>Start Time : </strong>{{date('H:i', strtotime($d->start_time))}}</br>
                                    </td>
                                    <td style="vertical-aligb: top">
                                      <strong>End Date : </strong>{{date('d F, Y', strtotime($d->end_date))}}</br>
                                      <strong>End Time : </strong>{{date('H:i', strtotime($d->end_time))}}</br>
                                    </td>
                                    <td style="vertical-align: top" >{{$d->selectedPeople}}</td>
                                    <td style="vertical-align: top" >{!! \Illuminate\Support\Str::limit($d->request_message, $limit = 80, $end = '...') !!}</td>
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
