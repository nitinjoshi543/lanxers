@extends('employer.layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/singup-login.css') }}?v={{ filemtime(public_path('frontend/css/singup-login.css')) }}" />

<section class="login-signup">
    <div class="signup-page">
        <div class="form-card">
            <h1 class="title">Forgot Password</h1>
            <div class="linebar"></div>
            <p>Don’t Worry we will help you out.</p>

            <meta name="csrf-token" content="{{ csrf_token() }}">
            {{-- NOTE: form id was "signinForm" but the script below looked up
                 "forgotForm" — that mismatch meant the submit listener never
                 attached at all. Fixed the id here. --}}
            <form id="forgotForm" novalidate>
                <div class="field" id="emailField">
                    <label>Email Address</label>
                    <div class="input-wrap">
                        <svg class="leading" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                            <path d="M12.1875 2.5H2.8125C1.94956 2.5 1.25 3.19956 1.25 4.0625V10.9375C1.25 11.8004 1.94956 12.5 2.8125 12.5H12.1875C13.0504 12.5 13.75 11.8004 13.75 10.9375V4.0625C13.75 3.19956 13.0504 2.5 12.1875 2.5Z" stroke="#D6D3D1" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M1.25 4.6875L7.5 8.75L13.75 4.6875" stroke="#D6D3D1" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <input type="text" id="email" placeholder="Enter your Email here...">
                    </div>
                    <div class="error-msg" id="emailError">please add valid credential</div>
                </div>

                {{-- NOTE: script referenced #statusMsg to show the server's
                     success/cooldown/error message, but no such element
                     existed in the markup — added it. --}}
                <div class="status-msg" id="statusMsg"></div>

                <button type="submit" class="submit-btn forgot-btn" id="submitBtn" disabled>Forgot Password
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
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
        const statusMsg = document.getElementById("statusMsg");
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        function setButton(enabled) {
            submitBtn.disabled = !enabled;
            submitBtn.classList.toggle("enabled", enabled);
        }

        function validateEmail() {
            const valid = emailRegex.test(email.value.trim());
            emailField.classList.toggle("error", !valid && email.value.trim() !== "");
            setButton(valid);
            return valid;
        }

        email.addEventListener("input", validateEmail);
        email.addEventListener("blur", validateEmail);
        validateEmail(); // initial state

        form.addEventListener("submit", async function(e) {
            e.preventDefault();
            if (!validateEmail()) return;

            setButton(false);
            statusMsg.textContent = "Sending...";
            statusMsg.className = "status-msg";

            try {
                const res = await fetch("{{ route('employer.password.email') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                        "Accept": "application/json",
                    },
                    body: JSON.stringify({
                        email: email.value.trim()
                    }),
                });

                const data = await res.json();

                // Server's message shown as-is — same wording whether the
                // email exists or not, by design (see controller notes).
                statusMsg.textContent = data.message;
                statusMsg.className = "status-msg " + (res.ok ? "success" : "error");

            } catch (err) {
                statusMsg.textContent = "Something went wrong. Please try again.";
                statusMsg.className = "status-msg error";
            }

            // Re-enable the button if the email is still valid, so the user
            // can request again once any cooldown passes.
            setButton(validateEmail());
        });
    });
</script>

@endsection