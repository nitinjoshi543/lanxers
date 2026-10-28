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
                <img src="{{ asset('admin/images/idp_short.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="auth-cover-sidebar-inner">
        <div class="auth-cover-card-wrapper">
            <div class="auth-cover-card p-sm-5">
                <div class="wd-50 mb-5">
                    <img src="{{ asset('admin/images/idp_short.png') }}" alt="" class="img-fluid">
                </div>
                <h2 class="fs-20 fw-bolder mb-4">Login</h2>
                <h4 class="fs-13 fw-bold mb-2">Login to your account</h4>
                <p class="fs-12 fw-medium text-muted">Thank you for get back <strong>Nelel</strong> web applications, let's access our the best recommendation for you.</p>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('admin.verify.otp') }}" method="POST" class="w-100 mt-4 pt-2">
                    @csrf
                    <div class="mb-4 position-relative">
                        <input type="email" name="email" id="emailInput" class="form-control pe-5" placeholder="Email id" required>
                        <button type="button" class="btn btn-primary position-absolute end-0 top-0 h-100" id="getOTPButton">Get OTP</button>
                    </div>
                    <div class="mb-3 d-none" id="otpSection">
                        <input type="tel" name="otp" id="otpInput" class="form-control" placeholder="Enter OTP" required>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-lg btn-primary w-100" id="loginButton" disabled>Login</button>
                    </div>
                </form>
                <!-- <div class="w-100 mt-5 text-center mx-auto">
                    <div class="mb-4 border-bottom position-relative"><span class="small py-1 px-3 text-uppercase text-muted bg-white position-absolute translate-middle">or</span></div>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <a href="javascript:void(0);" class="btn btn-light-brand flex-fill" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Login with Facebook">
                            <i class="feather-facebook"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-light-brand flex-fill" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Login with Twitter">
                            <i class="feather-twitter"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-light-brand flex-fill" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Login with Github">
                            <i class="feather-github text"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-5 text-muted">
                    <span> Don't have an account?</span>
                    <a href="auth-register-cover.html" class="fw-bold">Create an Account</a>
                </div> -->
            </div>
        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#getOTPButton').click(function() {
            let email = $('#emailInput').val().trim();

            if (email === '') {
                alert('Please enter an email ID');
                return;
            }
                $('#page-loader').css('visibility', 'visible');

            // Simulate AJAX OTP request
            $.ajax({
                url: '{{ route("login.otp.send") }}',
                type: 'POST',
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#otpSection').removeClass('d-none');
                        $('#loginButton').prop('disabled', false);
                        $('#page-loader').css('visibility', 'hidden');
                        alert(response.message);
                    } else {
                        alert('Failed to send OTP. Try again!');
                    }
                },
                error: function() {
                    alert('Error sending OTP. Please try again.');
                    $('#page-loader').css('visibility', 'hidden');
                }
            });
        });
    });
</script>
@endsection