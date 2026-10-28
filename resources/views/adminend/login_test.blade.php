@extends('adminend/layouts.main2')

@section('main-section')
<style>
    #page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgb(0 0 0 / 49%);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 1;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    .hidden {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
        border: 0.4rem solid #0b3343;
        border-top: 0.4rem solid #125e7b;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
</style>
<main class="auth-cover-wrapper">
    <div id="page-loader" class="hidden">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="auth-cover-content-inner">
        <div class="auth-cover-content-wrapper">
            <div class="auth-img">
                <img src="{{ asset('frontend/images/favicon.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="auth-cover-sidebar-inner">
        <div class="auth-cover-card-wrapper">
            <div class="auth-cover-card p-sm-5">
                <div class="wd-50 mb-5">
                    <img src="{{ asset('frontend/images/favicon.png') }}" alt="" class="img-fluid">
                </div>
                <h2 class="fs-20 fw-bolder mb-4">Login</h2>
                <h4 class="fs-13 fw-bold mb-2">Login to your account</h4>
                <!-- <p class="fs-12 fw-medium text-muted">Thank you for get back <strong>Nelel</strong> web applications, let's access our the best recommendation for you.</p> -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form id="loginForm" class="w-100 mt-4 pt-2">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4 position-relative">
                        <input type="email"
                            name="email"
                            id="emailInput"
                            class="form-control pe-5"
                            placeholder="Email ID"
                            required>

                        <button type="button"
                            class="btn btn-primary position-absolute end-0 top-0 h-100"
                            id="getOTPButton">
                            Get OTP
                        </button>
                    </div>

                    <!-- Email OTP -->
                    <div class="mb-3 d-none" id="otpSection">
                        <input type="text"
                            id="otpInput"
                            class="form-control"
                            placeholder="Enter Email OTP">
                    </div>

                    <!-- Verify OTP Button -->
                    <div class="mb-3 d-none" id="verifyOtpSection">
                        <button type="button"
                            class="btn btn-warning w-100"
                            id="verifyOtpBtn">
                            Verify OTP
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {

        $('#getOTPButton').click(function() {

            let email = $('#emailInput').val().trim();
            if (email === '') {
                alert('Please enter email');
                return;
            }

            $('#page-loader').css('visibility', 'visible');
            $.ajax({
                url: '{{ route("login.otp.send") }}',
                type: 'POST',
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#page-loader').css('visibility', 'hidden');
                    if (response.success) {
                        $('#otpSection').removeClass('d-none');
                        $('#verifyOtpSection').removeClass('d-none');
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },

                error: function() {
                    $('#page-loader').css('visibility', 'hidden');
                    alert('Unable to send OTP');
                }
            });
        });

        // VERIFY EMAIL OTP + LOGIN
        $('#verifyOtpBtn').click(function() {

            let email = $('#emailInput').val();
            let otp = $('#otpInput').val();

            if (otp === '') {
                alert('Enter OTP');
                return;
            }

            $('#page-loader').removeClass('hidden'); // ← loader fix (pichli baat)

            $.ajax({
                url: '{{ route("admin.verify.otp.test") }}',
                type: 'POST',
                data: {
                    email: email,
                    otp: otp,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#page-loader').addClass('hidden');

                    if (response.success) {
                        window.location.href = response.redirect; // ← seedha login
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    $('#page-loader').addClass('hidden');
                    alert(xhr.responseJSON?.message || 'Verification failed');
                }
            });
        });

    });
</script>
@endsection