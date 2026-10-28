@extends('layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/singup-login.css') }}?v={{ filemtime(public_path('frontend/css/singup-login.css')) }}" />

    <section class="login-signup">
        <div class="signup-page">
                <div class="form-card">
                    <h1 class="title">Welcome Back!</h1>
                    <div class="linebar"></div>
                    <p>Log in to your account and continue your journey with Lanxers.</p>        
                    
                    <form method="POST" action="{{ route('jobseekers.login') }}" id="forgotForm" novalidate>
                    @csrf
                            
                        <div class="field" id="emailField">
                            <label>Email Address</label>
                            <div class="input-wrap">
                                <svg class="leading" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <path d="M12.1875 2.5H2.8125C1.94956 2.5 1.25 3.19956 1.25 4.0625V10.9375C1.25 11.8004 1.94956 12.5 2.8125 12.5H12.1875C13.0504 12.5 13.75 11.8004 13.75 10.9375V4.0625C13.75 3.19956 13.0504 2.5 12.1875 2.5Z" stroke="#D6D3D1" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.25 4.6875L7.5 8.75L13.75 4.6875" stroke="#D6D3D1" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
    
                                <input type="text" id="email" name="email" placeholder="Enter your Email here...">
                            </div>
                            @error('email')<div class="error-msg" id="emailError">{{ $message }}</div>@enderror
                        </div>
    
                        <div class="field">
                            <label>Password</label>
                            <div class="input-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M10.7917 6.41406H3.20833C2.40292 6.41406 1.75 7.06698 1.75 7.8724V11.3724C1.75 12.1778 2.40292 12.8307 3.20833 12.8307H10.7917C11.5971 12.8307 12.25 12.1778 12.25 11.3724V7.8724C12.25 7.06698 11.5971 6.41406 10.7917 6.41406Z" stroke="#D6D3D1" stroke-width="1.10833" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4.0835 6.41406V4.08073C4.0835 3.30718 4.39079 2.56532 4.93777 2.01833C5.48475 1.47135 6.22661 1.16406 7.00016 1.16406C7.77371 1.16406 8.51558 1.47135 9.06256 2.01833C9.60954 2.56532 9.91683 3.30718 9.91683 4.08073V6.41406" stroke="#D6D3D1" stroke-width="1.10833" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                    
                                <input type="password" id="password" name="password" placeholder="Enter Password here...">
                                @error('password')<div class="error-msg" id="passwordError">{{ $message }}</div>@enderror
                                <button type="button" class="toggle-pass" id="togglePass">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeOpen">
                                        <path d="M14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M2 12C3.6 7.903 7.336 5 12 5C16.664 5 20.4 7.903 22 12C20.4 16.097 16.664 19 12 19C7.336 19 3.6 16.097 2 12Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
    
                                    <!-- Closed / slashed eye (password visible state) --> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeClosed" style="display:none;">
                                        <path d="M9.88 9.88C9.34 10.42 9 11.17 9 12C9 13.66 10.34 15 12 15C12.83 15 13.58 14.66 14.12 14.12" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.61 6.61C4.5 8.02 2.93 10 2 12C3.6 16.097 7.336 19 12 19C13.68 19 15.26 18.61 16.66 17.92" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.51 5.36C13.71 5.13 12.87 5 12 5C16.664 5 20.4 7.903 22 12C21.53 13.2 20.86 14.3 20.03 15.24" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1 1L23 23" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="error-msg" id="passwordError"></div>   
                        </div>
    
    
                        <div class="terms-row">
                            <div class="check-box"> 
                                <input type="checkbox" id="agree">
                                <label for="agree">Remember me</label> 
                             </div>
                            <div class="forgotpass">
                                <a href="{{ route('jobseekers.password.forgot') }}">Forgot Password?</a>
                            </div>
                        </div>
                        
    
                        <button type="submit" class="submit-btn" id="submitBtn" disabled>Log In 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
    
                    </form>
    
                    <div class="login-line">Didn’t have an account ?
                        <a href="{{ route('jobseekers.register') }}"> Sign up for free 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
    
                <div class="smart-hiring">
                    <img src="{{ asset('frontend/images/right-img.png') }}" alt="">
                </div>
        </div>
    </section>
    
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const form = document.getElementById("forgotForm");
        const email = document.getElementById("email");
        const emailField = document.getElementById("emailField");
        const submitBtn = document.getElementById("submitBtn");


        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Email Validation
        function validateEmail(showError = true) {

            const isValid = emailRegex.test(email.value.trim());

            if (!isValid && email.value.trim() !== "" && showError) {
                emailField.classList.add("error");
            } else {
                emailField.classList.remove("error");
            }

            return isValid;
        }

        // Enable / Disable Button
        function checkFormValid() {

            const emailOk = validateEmail(false);
            const passOk = password.value.trim() !== "";

            if (emailOk && passOk) {
                submitBtn.disabled = false;
                submitBtn.classList.add("enabled");
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.remove("enabled");
            }
        }

        // Email
        email.addEventListener("input", function() {
            validateEmail(true);
            checkFormValid();
        });

        email.addEventListener("blur", function() {
            validateEmail(true);
        });

        // Password
        password.addEventListener("input", function() {
            checkFormValid();
        });

        // Toggle Password
        togglePass.addEventListener("click", function() {

            if (password.type === "password") {
                password.type = "text";
                eyeOpen.style.display = "none";
                eyeClosed.style.display = "block";
            } else {
                password.type = "password";
                eyeOpen.style.display = "block";
                eyeClosed.style.display = "none";
            }

        });

        // Submit
        form.addEventListener("submit", function(e) {

            // dono valid hain to normally submit hone do (Laravel handle karega)
            if (validateEmail(true) && password.value.trim() !== "") {
                return true; // preventDefault mat karo — form server pe jaayega
            }

            // valid nahi to rok do
            e.preventDefault();
            validateEmail(true);
            checkFormValid();
        });

        // Initial Check
        checkFormValid();

    });
</script>


@endsection