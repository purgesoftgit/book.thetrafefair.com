@extends('layouts.dashboard-layout')
@section('content')

 <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" href="#">
      <i class="fas fa-bars"></i>
    </a>
  <!--Navbar Start-->
   @include('dashboard.navbar')
  <!--EndNavbar Start-->
   <!-- sidebar-wrapper  -->
    <main class="page-content">
        
      <!-- top bar -->
     @include('dashboard.header')

      <div class="midsection">
        <div class="container-fluid">

          <div class="row">
            <!-- <div class="col-md-2 col-lg-2">&nbsp;</div> -->
            <div class="col-lg-12 col-xl-12">
              <div class="row rightgape">
            <div class="col-lg-12">          
              <div class="whbox">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('get-upcoming-checkin-checkout')}}">Home</a></li>
                <li class="breadcrumb-item">/</li>
                <li class="breadcrumb-item active" aria-current="page">Asked Questions</li>
              </ol>
            </nav>
            <div class="clearfix"><hr/></div>
             {{-- @if ($message = Session::get('success'))
           <div class="alert alert-success alert-dismissible fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{$message}}
          </div>
              @endif --}}
            <div class="clearfix">&nbsp;</div>

                <div class="row pagetop-title">
                  <div class="col-lg-6 col-md-4 col-sm-4"><h3>Asked Questions</h3></div>
                  <div class="col-lg-6 col-md-8 col-sm-8 add-blogpost-right">
                  <button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button></div>
                </div>

                <br>
                
                <div class="row">
                  <div class="col-lg-6"> </div>
                </div>
                  <div class="row rightgape">
                    <div class="col-lg-12">          
                      <div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="table-responsive">
                              <table class="table table-striped medium-table" id="myTable">
                                <thead>
                                <tr>
                                  <th ><input name="select_all" value="1" type="checkbox"></th>
                                  <th width="8%" class="d-none"></th>
                                  <th width="35%">Email</th>
                                  <th width="50%">Question</th>
                                </tr>
                            </thead>

                            <tbody>
                              @if(empty($asked_questions))
                              <tr>
                                <td colspan="7"><h6 class="text-center">No Questions yet.</h6></td>
                              </tr>
                              @else
                                @foreach($asked_questions as $key => $d)
                                  <tr>
                                    <td></td>
                                    <td class="d-none">{{$d->id}}</td>
                                    <td style="vertical-align: top" ><a href="mailto:{{ $d->email }}">{{ $d->email }}</a></td>
                                    <td style="vertical-align: top" >{{$d->question}}</td>
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
                    
                  </div>
              </div>
            </div>
          </div>
              <!-- Client Section End -->
          <div class="d-none append-all-ids"></div>
        </div>
      </div>
    </div>
  </div>
  </main>
</div>
@endsection
