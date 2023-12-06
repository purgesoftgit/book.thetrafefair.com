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
  <div class="row ">
      <!-- <div class="col-md-2 col-lg-2">
                &nbsp;
                </div> -->
         <div class="col-lg-12 col-xl-12">          
              <div class="whbox formbox">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                  <li class="breadcrumb-item">/</li>
                  <li class="breadcrumb-item"><a href="{{url('facility')}}">Facility</a></li>
                  <li class="breadcrumb-item">/</li>
                  <li class="breadcrumb-item active" aria-current="page">Add Facility</li>
                </ol>
              </nav>
              <div class="clearfix"><hr/></div>
              <div class="clearfix">&nbsp;</div>

                <div class="row pagetop-title">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7"><h3>Add Facility</h3></div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 add-blogpost-right">
                  <button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button></div>
                </div>

                <br>

                <form method="POST" action="{{ url('facility') }}" id="facility_form" class="form-validate"
                enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>Title</label>
                            <input type="text" name="title" id="title" class="form-control validate[required]"
                                placeholder="Title" value="{{old('title')}}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('data') ? ' has-error' : '' }}">
                            <label>Tags</label>
                            <input type="text" name="data" id="data" class="form-control validate[required]"
                                placeholder="Enter comma-seprated tags" value="{{old('data')}}">
                            @if ($errors->has('data'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('data') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="form-label">Select Images</label>
                            <div class="input-images"></div>
                            <input type="file" name="image" id="image" class="form-control validate[required]" />
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <button type="submit" id="facility" class="btn btn-primary success-btn">Submit</button>
                    </div>
                </div>
            </form>
              </div>
            </div>            
            
      </div>

<script>
    $(document).ready(function() {
        $('#facility').(click, function() {
            var isValidate = $('#facility_form').validationEngine('validate')

            if (isValidate == true) {
                $('#facility_form').submit();
            }
        });
    });
</script>
@endsection
