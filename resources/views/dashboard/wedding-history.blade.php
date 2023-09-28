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
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <!-- Profile Side Nav Content section start-->
                    <button type="button" class="side-menu-button"><i class="fa fa-bars"></i> Side Menu</button>

                    <!-- navbar -->
                    @include('dashboard.navbar')
                    <!-- navbar -->
                </div>
                <div class="col-xxl-8 col-xl-8 col-lg-8">

                    <h2 class="inner-title">Wedding History</h2>

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
                                  <th width="15%">City</th>                          
                                  <th width="15%">Enquiry Message</th>
                                  <th width="10%">Status</th>
                                </tr>
                              </thead>

                              <tbody>
                               @foreach($wedding as $key => $d)
                               <tr>
                                  <td style="vertical-aligb: top">
                                      <strong>Name : </strong>{{$d->name}}</br>
                                      <strong>Email : </strong>{{$d->email}}</br>
                                      <strong>Phone : </strong>{{$d->phone}}</br>
                                    </td>
                                  <td style="vertical-align: top" >{{ucfirst($d->city)}}</td>
                                  <td style="vertical-align: top" >{!! \Illuminate\Support\Str::limit($d->enquiry, $limit = 100, $end = '...') !!}</td>
                                  <td>{{$d->status == 0 ? 'Pending':'Approved'}}</td>
                                </tr>
                              @endforeach
                              @if(count($wedding) == 0)
                              <tr>
                                <td colspan="7"><h6 class="text-center">Wedding Enquiry not available.</h6></td>
                              </tr>
                              @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
</main>
