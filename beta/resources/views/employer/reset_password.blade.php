@extends('employer.layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/singup-login.css') }}?v={{ filemtime(public_path('frontend/css/singup-login.css')) }}" />

<section class="login-signup">
    <div class="signup-page">
        <div class="form-card">
            @if(!$valid)
                <h1 class="title">Link Expired</h1>
                <div class="linebar"></div>
                <p>{{ $message ?? 'This password reset link is invalid or has expired.' }}</p>
                
                <a href="{{ route('employer.password.forgot') }}" class="submit-btn forgot-btn" style="display:inline-flex; text-decoration:none;">
                    Request a new link
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            @else
                <h1 class="title">Set New Password</h1>
                <div class="linebar"></div>
                <p>Choose a strong new password for your account.</p>

                <meta name="csrf-token" content="{{ csrf_token() }}">
                <form id="resetForm" novalidate>
                     <input type="hidden" id="resetEmail" value="{{ $email }}">
                    <input type="hidden" id="resetToken" value="{{ $token }}">
                    
                    <div class="field" id="passwordField">
                        <label>New Password</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M10.7917 6.41406H3.20833C2.40292 6.41406 1.75 7.06698 1.75 7.8724V11.3724C1.75 12.1778 2.40292 12.8307 3.20833 12.8307H10.7917C11.5971 12.8307 12.25 12.1778 12.25 11.3724V7.8724C12.25 7.06698 11.5971 6.41406 10.7917 6.41406Z" stroke="#D6D3D1" stroke-width="1.10833" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.0835 6.41406V4.08073C4.0835 3.30718 4.39079 2.56532 4.93777 2.01833C5.48475 1.47135 6.22661 1.16406 7.00016 1.16406C7.77371 1.16406 8.51558 1.47135 9.06256 2.01833C9.60954 2.56532 9.91683 3.30718 9.91683 4.08073V6.41406" stroke="#D6D3D1" stroke-width="1.10833" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <input type="password" id="password" placeholder="Enter new password...">
                            <button type="button" class="toggle-pass" id="togglePass1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeOpen1">
                                    <path d="M14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 12C3.6 7.903 7.336 5 12 5C16.664 5 20.4 7.903 22 12C20.4 16.097 16.664 19 12 19C7.336 19 3.6 16.097 2 12Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeClosed1" style="display:none;">
                                    <path d="M9.88 9.88C9.34 10.42 9 11.17 9 12C9 13.66 10.34 15 12 15C12.83 15 13.58 14.66 14.12 14.12" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.61 6.61C4.5 8.02 2.93 10 2 12C3.6 16.097 7.336 19 12 19C13.68 19 15.26 18.61 16.66 17.92" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.51 5.36C13.71 5.13 12.87 5 12 5C16.664 5 20.4 7.903 22 12C21.53 13.2 20.86 14.3 20.03 15.24" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 1L23 23" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="error-msg" id="passwordError">Min 8 characters, with upper &amp; lower case, a number and a symbol.</div>
                    </div>

                    <div class="field" id="confirmField">
                        <label>Confirm Password</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M10.7917 6.41406H3.20833C2.40292 6.41406 1.75 7.06698 1.75 7.8724V11.3724C1.75 12.1778 2.40292 12.8307 3.20833 12.8307H10.7917C11.5971 12.8307 12.25 12.1778 12.25 11.3724V7.8724C12.25 7.06698 11.5971 6.41406 10.7917 6.41406Z" stroke="#D6D3D1" stroke-width="1.10833" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.0835 6.41406V4.08073C4.0835 3.30718 4.39079 2.56532 4.93777 2.01833C5.48475 1.47135 6.22661 1.16406 7.00016 1.16406C7.77371 1.16406 8.51558 1.47135 9.06256 2.01833C9.60954 2.56532 9.91683 3.30718 9.91683 4.08073V6.41406" stroke="#D6D3D1" stroke-width="1.10833" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <input type="password" id="passwordConfirm" placeholder="Re-enter new password...">
                            <button type="button" class="toggle-pass" id="togglePass2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeOpen2">
                                    <path d="M14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 12C3.6 7.903 7.336 5 12 5C16.664 5 20.4 7.903 22 12C20.4 16.097 16.664 19 12 19C7.336 19 3.6 16.097 2 12Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeClosed2" style="display:none;">
                                    <path d="M9.88 9.88C9.34 10.42 9 11.17 9 12C9 13.66 10.34 15 12 15C12.83 15 13.58 14.66 14.12 14.12" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.61 6.61C4.5 8.02 2.93 10 2 12C3.6 16.097 7.336 19 12 19C13.68 19 15.26 18.61 16.66 17.92" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.51 5.36C13.71 5.13 12.87 5 12 5C16.664 5 20.4 7.903 22 12C21.53 13.2 20.86 14.3 20.03 15.24" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 1L23 23" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="error-msg" id="confirmError">Passwords do not match.</div>
                    </div>

                    <div class="status-msg" id="statusMsg"></div>

                    <button type="submit" class="submit-btn forgot-btn" id="submitBtn" disabled>Set Password
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            @endif
        </div>

        <div class="smart-hiring">
            <img src="{{ asset('frontend/images/right-img.png') }}" alt="">
        </div>
    </div>
</section>

@if($valid)
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("resetForm");
        const password = document.getElementById("password");
        const passwordConfirm = document.getElementById("passwordConfirm");
        const passwordField = document.getElementById("passwordField");
        const confirmField = document.getElementById("confirmField");
        const submitBtn = document.getElementById("submitBtn");
        const statusMsg = document.getElementById("statusMsg");
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        const resetEmail = document.getElementById("resetEmail").value;
        const resetToken = document.getElementById("resetToken").value;

        // Same complexity the server enforces — min 8, upper, lower, number, symbol.
        const strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/;

        function setButton(enabled) {
            submitBtn.disabled = !enabled;
            submitBtn.classList.toggle("enabled", enabled);
        }

        function validate() {
            const pwValid = strongRegex.test(password.value);
            const matchValid = password.value !== "" && password.value === passwordConfirm.value;

            passwordField.classList.toggle("error", password.value !== "" && !pwValid);
            confirmField.classList.toggle("error", passwordConfirm.value !== "" && !matchValid);

            const ok = pwValid && matchValid;
            setButton(ok);
            return ok;
        }

        password.addEventListener("input", validate);
        passwordConfirm.addEventListener("input", validate);

        function wireToggle(btnId, inputEl, openId, closedId) {
            const btn = document.getElementById(btnId);
            const eyeOpen = document.getElementById(openId);
            const eyeClosed = document.getElementById(closedId);
            btn.addEventListener("click", function() {
                if (inputEl.type === "password") {
                    inputEl.type = "text";
                    eyeOpen.style.display = "none";
                    eyeClosed.style.display = "block";
                } else {
                    inputEl.type = "password";
                    eyeOpen.style.display = "block";
                    eyeClosed.style.display = "none";
                }
            });
        }
        wireToggle("togglePass1", password, "eyeOpen1", "eyeClosed1");
        wireToggle("togglePass2", passwordConfirm, "eyeOpen2", "eyeClosed2");

        // --- Idle expiry countdown ---
        // Mirrors the server-side session window so the user sees "link
        // expired" proactively instead of hitting a surprise failed submit
        // after sitting on this page too long.
        let secondsLeft = {{ (int) $expiresInSeconds }};
        const countdownTimer = setInterval(function() {
            secondsLeft--;
            if (secondsLeft <= 0) {
                clearInterval(countdownTimer);
                setButton(false);
                statusMsg.textContent = "This link has expired. Please request a new password reset link.";
                statusMsg.className = "status-msg error";
                form.querySelectorAll("input, button").forEach(el => el.disabled = true);
            }
        }, 1000);

        form.addEventListener("submit", async function(e) {
            e.preventDefault();
            if (!validate()) return;

            setButton(false);
            statusMsg.textContent = "Saving...";
            statusMsg.className = "status-msg";

            try {
                const res = await fetch("{{ route('employer.password.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json",
                    },
                    body: JSON.stringify({
                        email: resetEmail,
                        token: resetToken,
                        password: password.value,
                        password_confirmation: passwordConfirm.value,
                    }),
                });

                const data = await res.json();
                statusMsg.textContent = data.message;
                statusMsg.className = "status-msg " + (res.ok ? "success" : "error");

                if (res.ok && data.redirect) {
                    clearInterval(countdownTimer);
                    setTimeout(() => { window.location.href = data.redirect; }, 1500);
                } else {
                    setButton(validate());
                }
            } catch (err) {
                statusMsg.textContent = "Something went wrong. Please try again.";
                statusMsg.className = "status-msg error";
                setButton(validate());
            }
        });
    });
</script>
@endif

@endsection