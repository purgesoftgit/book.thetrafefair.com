@extends('layouts.dashboard-layout')
@section('content')
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" href="#">
            <i class="fas fa-bars"></i>
        </a>
        @include('dashboard.navbar')

        <main class="page-content">

            @include('dashboard.header')
            <div class="midsection">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-12 col-xl-12">
                            <div class="whbox formbox">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                        <li class="breadcrumb-item">/</li>
                                        <li class="breadcrumb-item"><a href="{{ url('facility') }}">Facility</a></li>
                                        <li class="breadcrumb-item">/</li>
                                        <li class="breadcrumb-item active" aria-current="page">View Facility</li>
                                    </ol>
                                </nav>
                                <div class="clearfix">
                                    <hr />
                                </div>
                                <div class="clearfix">&nbsp;</div>

                                <div class="row pagetop-title">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
                                        <h3>View Facility</h3>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 add-blogpost-right">
                                        <button class="btn btn-dark" onclick="window.history.back();"><i
                                                class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label><strong>Title</strong></label>
                                        <input type="text" name="title" id="title"
                                            class="form-control validate[required]" placeholder="Title"
                                            value="{{ $data->title }}"> <br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label><strong>Tags</strong></label>
                                        @foreach (explode(',', $data->data) as $tag)
                                            <li>{!! $tag !!}</li>
                                        @endforeach
                                        <br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                            <label class="form-label"><strong>Selected Image :</strong></label>
                                            <br>
                                            <img src="{{ url('images/' . $data->image) }}"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
