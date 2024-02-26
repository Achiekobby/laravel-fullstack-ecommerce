{{-- @extends('layout.app') --}}
@extends('client_layout.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Register</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Register</span>
        </h2>
        <div class="col-lg-12">
            <div class="row px-xl-5">
                <div class="col-lg-6 mb-5">
                    <div class="contact-form bg-light p-30" style="height: 90%;">
                        <form method="POST" action="{{ route('user.signup') }}" enctype="multipart/form-data"
                            class="mt-5">
                            @csrf
                            <div class="control-group mb-3">
                                <input type="text" class="form-control" id="email" name="first_name"
                                    placeholder="Your First Name" required="required"
                                    data-validation-required-message="Please enter your firstname" />
                                @error('first_name')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Your Last Name" required="required"
                                    data-validation-required-message="Please enter your lastname" />
                                @error('last_name')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <input type="tel" class="form-control" id="email" name="phone_number"
                                    placeholder="Your Phone Number" required="required"
                                    data-validation-required-message="Please enter your phone number" />
                                @error('phone_number')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Your Email" required="required"
                                    data-validation-required-message="Please enter your email" />
                                @error('email')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Your Password" required="required"
                                    data-validation-required-message="Please enter your password" />
                                @error('password')
                                    <p class="help-block text-danger">{{ $message }}<br></p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <input type="password" class="form-control" id="password" name="password_confirmation"
                                    placeholder="Enter Password Again" required="required"
                                    data-validation-required-message="This is required" />
                                @error('password_confirmation')
                                    <p class="help-block text-danger">{{ $message }}<br></p>
                                @enderror
                            </div>

                            <div class="mb-3 pb-3">
                                <button class="btn btn-primary py-2 px-4" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="bg-light">
                        {{-- <img style="height: 100%; object-fit:contain;" src="{{ asset('assets/imgs/login.png') }}"> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
