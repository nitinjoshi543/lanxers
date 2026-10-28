@extends('layouts.main')

@section('main-section')

<link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}?v={{ filemtime(public_path('frontend/css/auth.css')) }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/authresponsive.css') }}?v={{ filemtime(public_path('frontend/css/authresponsive.css')) }}" media="(max-width: 990px)" />

<section class="employeer-signup">
    <div class="container">
        <div class="signup-page">
            <div class="smart-hiring">
                <h2>Smart hiring <br> <span> Smarter</span> Today.</h2>
                <p>Create your account and connect with skilled professionals in minutes.</p>

                <div class="features-wrapper">

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M15.7031 6.5625C15.5886 8.15117 14.4101 9.375 13.1249 9.375C11.8398 9.375 10.6593 8.15156 10.5468 6.5625C10.4296 4.90977 11.5769 3.75 13.1249 3.75C14.673 3.75 15.8202 4.93984 15.7031 6.5625Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.1251 11.875C10.5794 11.875 8.13134 13.1395 7.51806 15.602C7.43681 15.9277 7.6411 16.25 7.97587 16.25H18.2747C18.6095 16.25 18.8126 15.9277 18.7325 15.602C18.1192 13.1 15.6712 11.875 13.1251 11.875Z" stroke="white" stroke-miterlimit="10" />
                                <path d="M7.81238 7.26328C7.72098 8.53203 6.76863 9.53125 5.74207 9.53125C4.71551 9.53125 3.7616 8.53242 3.67176 7.26328C3.5784 5.94336 4.50535 5 5.74207 5C6.97879 5 7.90574 5.96758 7.81238 7.26328Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.04677 11.9531C7.34169 11.6301 6.56513 11.5059 5.74208 11.5059C3.71083 11.5059 1.7538 12.5156 1.26357 14.4824C1.19911 14.7426 1.36239 15 1.62958 15H6.01552" stroke="white" stroke-miterlimit="10" stroke-linecap="round" />
                            </svg>
                        </div>

                        <div class="feature-content">
                            <h3>Verified professionals</h3>
                            <p>Access a global network of skilled and verified talent.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M9.99992 1.66675L3.33325 4.58341V10.0001C3.33325 12.9167 6.24992 16.6667 9.99992 18.3334C13.7499 17.5001 16.6666 12.9167 16.6666 10.0001V4.58341L9.99992 1.66675Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <div class="feature-content">
                            <h3>Verified professionals</h3>
                            <p>Access a global network of skilled and verified talent.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1179_3986)">
                                    <path d="M10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0ZM10 1.395C7.71781 1.395 5.5291 2.3016 3.91535 3.91535C2.3016 5.5291 1.395 7.71781 1.395 10C1.395 12.2822 2.3016 14.4709 3.91535 16.0847C5.5291 17.6984 7.71781 18.605 10 18.605C12.2822 18.605 14.4709 17.6984 16.0847 16.0847C17.6984 14.4709 18.605 12.2822 18.605 10C18.605 7.71781 17.6984 5.5291 16.0847 3.91535C14.4709 2.3016 12.2822 1.395 10 1.395ZM12.048 3.488C12.6981 3.7338 13.3061 4.07926 13.85 4.512C13.9747 4.608 14.0957 4.71033 14.213 4.819C14.2343 4.83767 14.255 4.85767 14.275 4.879C14.603 5.182 14.901 5.523 15.165 5.889L15.275 6.036C15.3383 6.13067 15.3997 6.22733 15.459 6.326C15.507 6.40333 15.5533 6.482 15.598 6.562C15.6487 6.65133 15.6973 6.74233 15.744 6.835C15.796 6.93833 15.8457 7.04367 15.893 7.151C15.926 7.224 15.963 7.299 15.993 7.377C16.0657 7.55833 16.1313 7.74233 16.19 7.929L16.242 8.119C16.3423 8.47508 16.4142 8.83856 16.457 9.206C16.464 9.272 16.474 9.342 16.479 9.407C16.4997 9.62233 16.5107 9.839 16.512 10.057C16.5117 10.483 16.4726 10.9081 16.395 11.327L16.355 11.544C16.315 11.7333 16.2683 11.92 16.215 12.104C15.706 11.871 15.108 11.528 14.952 11.151C14.668 10.471 13.912 10.131 13.604 9.255C13.097 7.805 13.77 7.843 13.864 6.943C13.908 6.521 13.604 6.433 13.203 6.605C12.267 6.998 11.95 6.847 11.761 6.142C11.572 5.439 11.761 5.243 11.761 5.243C11.123 5.313 11.099 4.536 11.43 4.34C11.66 4.208 11.855 3.803 12.048 3.488ZM9.374 7.797C9.964 7.527 10.509 7.43 10.437 6.966C10.367 6.507 10.201 6.165 9.279 6.165C8.357 6.165 8.759 7.43 8.003 6.675C7.247 5.925 8.168 6.119 8.546 5.948C8.925 5.776 9.303 5.071 8.641 5.021C7.98 4.974 8.121 5.313 7.601 5.121C7.081 4.925 6.845 5.8 6.513 5.678C6.295 5.596 5.71 5.146 5.322 4.703C4.53027 5.39163 3.90348 6.24945 3.488 7.213C3.601 8.52 4.292 9.206 4.292 9.206C4.292 9.206 4.647 10.057 6.775 11.103C6.775 11.103 7.175 11.127 6.703 10.642C6.231 10.155 5.71 9.547 6.301 9.232C6.891 8.913 7.058 8.94 7.2 9.525C7.341 10.109 7.815 9.765 7.861 9.206C7.909 8.649 8.783 8.067 9.374 7.797ZM8.924 10.736C9.942 10.736 9.847 11.053 10.651 11.761C11.454 12.465 11.029 13.17 10.626 13.706C10.225 14.24 9.87 14.846 9.681 15.944C9.491 17.038 8.995 16.258 8.831 15.991C8.665 15.722 8.405 15.48 8.477 14.361C8.547 13.243 7.79 13.901 7.531 12.441C7.271 10.983 7.909 10.737 8.925 10.737M13.902 11.701C14.173 11.528 14.822 11.979 14.682 12.454C14.539 12.929 14.091 12.661 13.866 12.454C13.641 12.248 13.629 11.871 13.902 11.701Z" fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1179_3986">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>

                        <div class="feature-content">
                            <h3>Verified professionals</h3>
                            <p>Access a global network of skilled and verified talent.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-card">
                <h1 class="title">Forgot Password</h1>
                <p class="login-line">Don’t worry we will help you out.</p>

                <div class="icon-wrap">
                    <img src="{{ asset('frontend/images/hire-talent1.png') }}" alt="Hire Talent">
                </div>

                <meta name="csrf-token" content="{{ csrf_token() }}">

                <form id="resetForm" action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="field" id="emailField">
                        <label>New Password</label>
                        <div class="input-wrap">
                            <input type="password" name="password" id="password" placeholder="New password" required>
                        </div>
                    </div>

                    <div class="field" id="emailField">
                        <label>New Password</label>
                        <div class="input-wrap">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required>
                        </div>
                    </div>

                    <div id="statusMsg" class="status-msg"></div>
                    <button id="submitBtn" type="submit" class="submit-btn">Update Password</button>
                </form>

            </div>
        </div>

    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const resetForm = document.getElementById("resetForm");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("password_confirmation");
        const submitBtn = document.getElementById("submitBtn");
        const statusMsg = document.getElementById("statusMsg");

        function showError(message) {
            statusMsg.className = "status-msg error";
            statusMsg.innerHTML = message;
        }

        function showSuccess(message) {
            statusMsg.className = "status-msg success";
            statusMsg.innerHTML = message;
        }

        function clearMessage() {
            statusMsg.className = "status-msg";
            statusMsg.innerHTML = "";
        }

        function validateForm() {

            clearMessage();

            let pwd = password.value.trim();
            let cpwd = confirmPassword.value.trim();

            if (pwd === "") {
                showError("Please enter a password.");
                password.focus();
                return false;
            }

            if (pwd.length < 8) {
                showError("Password must be at least 8 characters.");
                password.focus();
                return false;
            }

            if (!/[A-Z]/.test(pwd)) {
                showError("Password must contain at least one uppercase letter.");
                password.focus();
                return false;
            }

            if (!/[a-z]/.test(pwd)) {
                showError("Password must contain at least one lowercase letter.");
                password.focus();
                return false;
            }

            if (!/[0-9]/.test(pwd)) {
                showError("Password must contain at least one number.");
                password.focus();
                return false;
            }

            if (!/[!@#$%^&*(),.?":{}|<>_\-+=~`[\]\\\/]/.test(pwd)) {
                showError("Password must contain at least one special character.");
                password.focus();
                return false;
            }

            if (cpwd === "") {
                showError("Please confirm your password.");
                confirmPassword.focus();
                return false;
            }

            if (pwd !== cpwd) {
                showError("Passwords do not match.");
                confirmPassword.focus();
                return false;
            }

            return true;
        }

        resetForm.addEventListener("submit", async function(e) {

            e.preventDefault();

            if (!validateForm()) {
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = "Updating...";

            clearMessage();

            try {

                const response = await fetch(this.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    },
                    body: new FormData(this)
                });

                const data = await response.json();

                if (!response.ok) {

                    if (data.errors) {

                        let html = "";

                        Object.values(data.errors).forEach(function(error) {
                            html += "<div>" + error[0] + "</div>";
                        });

                        showError(html);

                    } else {

                        showError(data.message || "Something went wrong.");

                    }

                    submitBtn.disabled = false;
                    submitBtn.innerHTML = "Update Password";
                    return;
                }

                showSuccess(data.message);

                submitBtn.innerHTML = "Redirecting...";

                setTimeout(function() {
                    window.location.href = data.redirect;
                }, 1500);

            } catch (error) {

                console.log(error);

                showError("Something went wrong. Please try again.");

                submitBtn.disabled = false;
                submitBtn.innerHTML = "Update Password";
            }

        });

    });
</script>

@endsection