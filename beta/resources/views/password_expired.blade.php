@extends('layouts.main')

@section('main-section')
<link rel="stylesheet" href="https://lanxers.com/public/frontend/css/passwordExpire.css" />
    <!-- <div class="container py-5 text-center">
        <h2>Password Reset Link</h2>

        <div class="alert alert-danger mt-3">
            {{ $message }}
        </div>

        <a href="{{ route('password.forgot') }}" class="btn btn-primary mt-3">
            Request New Reset Link
        </a>
    </div> -->

    <section class="paymentpage">
        <div class="successmodal" id="paymentsuccessModal">

            <div class="images">
                <img src="{{ asset('frontend/images/password-expire.png') }}" alt="">
            </div>

            <div class="title">
                Password Reset Link Expired.
            </div>
            <div class="divider">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="descripition">
                {{ $message }}
            </div>

            <a href="{{ route('password.forgot') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path
                        d="M8.66675 4.0013L10.0001 2.66797C10.6667 2.0013 12.0001 2.0013 12.6667 2.66797L13.3334 3.33464C14.0001 4.0013 14.0001 5.33464 13.3334 6.0013L10.0001 9.33464C9.33341 10.0013 8.00008 10.0013 7.33341 9.33464M7.33341 12.0013L6.00008 13.3346C5.33341 14.0013 4.00008 14.0013 3.33341 13.3346L2.66675 12.668C2.00008 12.0013 2.00008 10.668 2.66675 10.0013L6.00008 6.66797C6.66675 6.0013 8.00008 6.0013 8.66675 6.66797"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Request New Reset link
            </a>
        </div>
    </section>

@endsection