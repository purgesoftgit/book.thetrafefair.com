@extends('layouts.layout')
@section('content')

    {{-- @include('layouts.header')
    <main class="web-main">

        <!-- Page Title Section Start -->
        <section class="page-title-section" style="background-image:url(img/event-banner-img.jpg);">
            <div class="container">
                <div class="page-title">Profile</div>
            </div>
        </section> --}}
        <!-- Page Title Section End -->

        <!-- Rooms Page Section Start -->
        <section class="rooms-page-section">
            <div class="container">
                <div class="shadow-lg p-5 mb-5 bg-body rounded">
                    <div class="fs-1 text-center pb-2">Edit Profile</div>
                    <form method="POST" action="{{ url('profile/update') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="firstname"
                                    value="{{ $userProfile->first_name }}">
                                @error('first_name')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="lastname"
                                    value="{{ $userProfile->last_name }}">
                                @error('last_name')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="phone"
                                    value=" {{ str_replace('+91', '', $userProfile->phone_number) }}">
                                @error('phone_number')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="Email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ $userProfile->email }}">
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- Rooms Page Section End -->
    </main>

    {{-- @include('layouts.footer') --}}
@endsection
