@extends('layouts.dashboard-layout')
@section('content')
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" href="#">
            <i class="fas fa-bars"></i>
        </a>
        @include('dashboard.navbar')

        <main class="page-content">
            <!-- top bar -->
            @include('dashboard.header')
            <div class="card">
            <form method="POST" action="{{ url('save-facility') }}" id="blogpost_form" class="form-validate"
                enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="row">
                    <div class="col-md-6">
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
                    <div class="col-md-8">
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
                        <button type="submit" id="addnews" class="btn btn-primary success-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        </main>

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
