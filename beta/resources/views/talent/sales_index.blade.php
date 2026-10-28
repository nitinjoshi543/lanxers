<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lanxers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/global.css') }}?v={{ filemtime(public_path('frontend/css/global.css')) }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .ms-wrap { position: relative; }
        .ms-box {
            display: flex; flex-wrap: wrap; align-items: center; gap: 6px;
            min-height: 48px; padding: 6px 12px;
            background: #fff; border: 1px solid #d0d5dd; border-radius: 10px; cursor: text;
        }
        .ms-box:focus-within { border-color: #4f46e5; }
        .ms-chips { display: contents; }
        .ms-box input {
            flex: 1; min-width: 140px; width: auto;
            border: 0 !important; outline: 0 !important; box-shadow: none !important;
            background: transparent !important; padding: 6px 0 !important; height: auto !important;
        }
        .role-chip {
            display: inline-flex; align-items: center; gap: 6px;
            background: #eef2ff; color: #3730a3; font-size: 13px;
            padding: 4px 6px 4px 10px; border-radius: 999px;
        }
        .role-chip .chip-x {
            width: 18px; height: 18px; line-height: 17px; text-align: center;
            border-radius: 50%; background: #c7d2fe; font-size: 14px; cursor: pointer;
        }
        .role-chip .chip-x:hover { background: #ef4444; color: #fff; }
        .ms-list {
            position: absolute; left: 0; right: 0; top: calc(100% + 4px); z-index: 50;
            max-height: 240px; overflow-y: auto; margin: 0; padding: 6px 0; list-style: none;
            background: #fff; border: 1px solid #d0d5dd; border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,.12);
        }
        .ms-list li { padding: 9px 14px; cursor: pointer; }
        .ms-list li:hover { background: #f3f4f6; }
        .ms-list li.hidden { display: none; }
    </style>
</head>

<body>

    <link rel="stylesheet" href="{{ asset('frontend/css/register.css') }}?v={{ filemtime(public_path('frontend/css/register.css')) }}" />

    <section id="globalLoader">
        <div class="wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="76" height="76" viewBox="0 0 76 76" fill="none">
                <g filter="url(#filter0_d_1854_11094)">
                    <rect x="35" y="5.83398" width="5.83333" height="8.75" rx="2.91667" fill="white" />
                    <rect x="46.3828" y="6.9375" width="5.83333" height="8.75" rx="2.91667" transform="rotate(22.5 46.3828 6.9375)" fill="white" />
                    <rect x="56.4766" y="12.3125" width="5.83333" height="8.75" rx="2.91667" transform="rotate(45 56.4766 12.3125)" fill="white" />
                    <rect x="57.8945" y="29.8809" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-112.5 57.8945 29.8809)" fill="white" />
                    <rect x="58.332" y="37.916" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-90 58.332 37.916)" fill="white" />
                    <rect x="55.6621" y="45.5078" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-67.5 55.6621 45.5078)" fill="white" />
                    <rect x="50.291" y="51.498" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-45 50.291 51.498)" fill="white" />
                    <rect x="43.0352" y="54.9785" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-22.5 43.0352 54.9785)" fill="white" />
                    <rect x="35" y="55.416" width="5.83333" height="8.75" rx="2.91667" fill="white" />
                    <rect x="27.4082" y="52.7461" width="5.83333" height="8.75" rx="2.91667" transform="rotate(22.5 27.4082 52.7461)" fill="white" />
                    <rect x="21.418" y="47.375" width="5.83333" height="8.75" rx="2.91667" transform="rotate(45 21.418 47.375)" fill="white" />
                    <rect x="12.0859" y="48.8555" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-112.5 12.0859 48.8555)" fill="white" />
                    <rect x="8.75" y="37.916" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-90 8.75 37.916)" fill="white" />
                    <rect x="9.85352" y="26.5332" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-67.5 9.85352 26.5332)" fill="white" />
                    <rect x="15.2285" y="16.4395" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-45 15.2285 16.4395)" fill="white" />
                    <rect x="24.0605" y="9.16992" width="5.83333" height="8.75" rx="2.91667" transform="rotate(-22.5 24.0605 9.16992)" fill="white" />
                </g>
            </svg>
        </div>
    </section>

    <section class="register-page">
        <img src="{{ asset('frontend/images/bg-img1.png') }}" class="bg-img1" alt="">
        <img src="{{ asset('frontend/images/bg-img2.png') }}" class="bg-img2" alt="">
        <img src="{{ asset('frontend/images/bg-img3.png') }}" class="bg-img3" alt="">

        <div class="container">
            <div class="step-panel">
                <form method="POST" action="{{ route('abc.sales.submit') }}" id="indexForm" enctype="multipart/form-data">
                    @csrf
                    <div style="position:absolute;left:-9999px" aria-hidden="true">
                        <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                    </div>
                    @if ($errors->any())
                    <div style="
                    background:#ffe5e5;
                    border:1px solid #ff4d4d;
                    color:#b30000;
                    padding:15px;
                    margin-bottom:20px;
                    border-radius:8px;
                ">
                        <strong>Validation Errors:</strong>

                        <ul style="margin:10px 0 0 20px;">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('error'))
                    <div style="
        background:#ffe5e5;
        border:1px solid #ff4d4d;
        color:#b30000;
        padding:15px;
        margin-bottom:20px;
        border-radius:8px;
    ">
                        <strong>Error:</strong>
                        {{ session('error') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div style="
        background:#e5ffe5;
        border:1px solid #28a745;
        color:#16702b;
        padding:15px;
        margin-bottom:20px;
        border-radius:8px;
    ">
                        <strong>Success:</strong>
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="job-post-title">
                        <h2>Tell Us About Yourself</h2>
                        <p>Share your details and discover opportunities that match your skills and goals.</p>
                    </div>

                    <div class="profile-infom">
                        <img src="{{ asset('frontend/images/profile-round-top.png') }}" class="profile-top" alt="">

                        <div class="pro-header-extra">
                            <h2>Your details</h2>
                        </div>

                        <div class="input-row">
                            <div class="col-12">
                                <label>Name <span class="req">*</span></label>
                                <input name="name" id="name" type="text" placeholder="Enter Your Name" value="{{ old('name') }}">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="input-row">
                            <label>Email <span class="req">*</span></label>
                            <div class="contact-row">
                                <div class="input-wrap">
                                    <input
                                        name="email"
                                        id="email"
                                        type="email"
                                        placeholder="Enter Your Email" value="{{ old('email') }}">
                                </div>
                                <button class="verifybtn" id="sendOtpBtn" type="button">Send OTP</button>
                            </div>
                            <div
                                class="error-msg"
                                id="emailError"
                                style="display:none;">
                            </div>
                        </div>

                        <div class="input-row" id="otpField" style="display:none;">
                            <label>Enter OTP <span class="req">*</span></label>
                            <div class="contact-row">
                                <div class="input-wrap">
                                    <input type="text" id="otp" maxlength="6" inputmode="numeric" placeholder="Enter 6 digit OTP">
                                </div>
                                <button class="verifybtn" id="verifyOtpBtn" type="button">Verify</button>
                            </div>

                            <div
                                class="error-msg"
                                id="otpError"
                                style="display:none;">
                            </div>

                            <div
                                id="otpSuccess"
                                style="display:none; color:green; margin-top:6px;">
                            </div>

                        </div>


                        <input
                            type="hidden"
                            id="emailVerified"
                            name="email_verified"
                            value="0">

                        <div class="input-row">
                            <div class="col-12">
                                <label>Contact Number <span class="req">*</span></label>
                                <input name="phone" id="phone" type="text" placeholder="Enter Your Contact Number" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="col-12">
                                <label>City <span class="req">*</span></label>

                                <input
                                    name="city"
                                    id="city"
                                    type="text"
                                    placeholder="Enter Your City" value="{{ old('city') }}">
                            </div>
                        </div>

                        @php
                            $roleOptions = [
                                'Client Service Manager',
                                'Business Development Manager',
                                'Sales Manager',
                                'Sales Development Representative',
                                'Sales Team Lead',
                                'Sales Consultant'
                            ];
                        @endphp

                        <div class="input-row">
                            <div class="col-12">
                                <label>Preferred Roles You're Looking For <span class="req">*</span></label>

                                <div class="ms-wrap" id="roleWrap" data-max="7">
                                    <div class="ms-box" id="roleBox">
                                        <div class="ms-chips" id="roleChips"></div>
                                        <input type="text" id="roleSearch" placeholder="Select your role" autocomplete="off">
                                    </div>

                                    {{-- Ye DB me jayega: "PHP Developer,Backend Developer" --}}
                                    <input type="hidden" name="preferred_roles" id="preferred_roles" value="{{ old('preferred_roles') }}">

                                    <ul class="ms-list" id="roleSuggestions" style="display:none;">
                                        @foreach ($roleOptions as $role)
                                            <li data-role="{{ $role }}">{{ $role }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="error-msg" id="roleError" style="display:none;"></div>
                            </div>
                        </div>
                        
                        <div class="input-row">
                            <div class="col-12">
                                <label>Linkedin Profile Link <span>(Optional)</span></label>
                                <input 
                                    name="portfolio_link" 
                                    id="portfolio_link" 
                                    type="url" 
                                    placeholder="https://yourportfolio.com" 
                                    value="{{ old('portfolio_link') }}"
                                >
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="col-12">

                                <label>
                                    Upload CV
                                    <span class="req">*</span>
                                </label>

                                <input
                                    type="file"
                                    name="cv"
                                    id="cv"
                                    accept=".pdf,.doc,.docx">

                                <small>
                                    Accepted formats: PDF / DOC / DOCX<br>
                                    Maximum file size: 5 MB
                                </small>

                                <div
                                    class="error-msg"
                                    id="cvError"
                                    style="display:none;">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="footer-btn">
                        <button
                            type="submit"
                            class="post-btn"
                            id="submitBtn"
                            disabled>
                            <span id="submitBtnText">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.15.0/gsap.min.js"></script>

    <script src="{{ asset('frontend/js/global.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('indexForm');
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const city = document.getElementById('city');
            const cv = document.getElementById('cv');

            const sendOtpBtn = document.getElementById('sendOtpBtn');
            const verifyOtpBtn = document.getElementById('verifyOtpBtn');
            const otpField = document.getElementById('otpField');
            const otp = document.getElementById('otp');
            const emailVerified = document.getElementById('emailVerified');
            const submitBtn = document.getElementById('submitBtn');
            const emailError = document.getElementById('emailError');
            const otpError = document.getElementById('otpError');
            const otpSuccess = document.getElementById('otpSuccess');

            /* =========================
            * MULTI SELECT ROLES
            * ========================= */
            const roleWrap = document.getElementById('roleWrap');
            const roleBox = document.getElementById('roleBox');
            const roleChips = document.getElementById('roleChips');
            const roleSearch = document.getElementById('roleSearch');
            const roleHidden = document.getElementById('preferred_roles');
            const roleList = document.getElementById('roleSuggestions');
            const roleError = document.getElementById('roleError');
            const roleItems = [...roleList.querySelectorAll('li')];
            const ROLE_MAX = parseInt(roleWrap.dataset.max) || 7;

            // sirf static list ki values allowed (old() values bhi filter hongi)
            const validRoles = roleItems.map(li => li.dataset.role);
            let selectedRoles = (roleHidden.value ? roleHidden.value.split(',') : [])
                .map(s => s.trim())
                .filter(v => validRoles.includes(v));

            function renderRoles() {
                roleHidden.value = selectedRoles.join(',');
                roleChips.innerHTML = '';

                selectedRoles.forEach(function (role) {
                    const chip = document.createElement('span');
                    chip.className = 'role-chip';

                    const label = document.createElement('span');
                    label.textContent = role;

                    const x = document.createElement('span');
                    x.className = 'chip-x';
                    x.title = 'Remove';
                    x.innerHTML = '&times;';
                    x.addEventListener('click', function (e) {
                        e.stopPropagation();
                        selectedRoles = selectedRoles.filter(r => r !== role);
                        renderRoles();
                        filterRoles();
                    });

                    chip.appendChild(label);
                    chip.appendChild(x);
                    roleChips.appendChild(chip);
                });

                roleSearch.placeholder = selectedRoles.length ? '' : 'Select your role';
                if (selectedRoles.length) roleError.style.display = 'none';
            }

            function filterRoles() {
                const q = roleSearch.value.trim().toLowerCase();
                let visible = 0;

                roleItems.forEach(function (li) {
                    const role = li.dataset.role;
                    const show = !selectedRoles.includes(role) && role.toLowerCase().includes(q);
                    li.classList.toggle('hidden', !show);
                    if (show) visible++;
                });

                roleList.style.display = visible ? 'block' : 'none';
            }

            roleItems.forEach(function (li) {
                li.addEventListener('click', function () {
                    if (selectedRoles.length >= ROLE_MAX) {
                        roleError.innerText = 'You can select up to ' + ROLE_MAX + ' roles.';
                        roleError.style.display = 'block';
                        return;
                    }
                    selectedRoles.push(li.dataset.role);
                    roleSearch.value = '';
                    renderRoles();
                    filterRoles();
                    roleSearch.focus();
                });
            });

            roleBox.addEventListener('click', () => roleSearch.focus());
            roleSearch.addEventListener('focus', filterRoles);
            roleSearch.addEventListener('input', filterRoles);

            roleSearch.addEventListener('keydown', function (e) {
                // Enter se form submit na ho
                if (e.key === 'Enter') e.preventDefault();

                // empty input pe Backspace = last chip remove
                if (e.key === 'Backspace' && !roleSearch.value && selectedRoles.length) {
                    selectedRoles.pop();
                    renderRoles();
                    filterRoles();
                }
            });

            document.addEventListener('click', function (e) {
                if (!roleWrap.contains(e.target)) roleList.style.display = 'none';
            });

            renderRoles();


            /* =========================
            * SEND OTP
            * ========================= */
            sendOtpBtn.addEventListener('click', function () {

                const emailValue = email.value.trim();

                emailError.style.display = 'none';
                emailError.innerText = '';

                if (!emailValue) {
                    emailError.innerText = 'Please enter your email address.';
                    emailError.style.display = 'block';
                    email.focus();
                    return;
                }

                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
                    emailError.innerText = 'Please enter a valid email address.';
                    emailError.style.display = 'block';
                    email.focus();
                    return;
                }

                sendOtpBtn.disabled = true;
                sendOtpBtn.innerText = 'Sending...';

                $.ajax({
                    url: "{{ route('talent.send.otp') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: emailValue
                    },

                    success: function (response) {
                        if (response.status) {

                            if (response.existing_user) {
                                emailVerified.value = '1';
                                email.readOnly = true;
                                sendOtpBtn.disabled = true;
                                sendOtpBtn.innerText = 'Verified';
                                submitBtn.disabled = false;
                                otpField.style.display = 'none';
                                return;
                            }

                            otpField.style.display = 'block';
                            emailVerified.value = '0';
                            submitBtn.disabled = true;
                            otp.value = '';
                            otpError.style.display = 'none';
                            otpSuccess.style.display = 'none';

                            sendOtpBtn.disabled = true;
                            sendOtpBtn.innerText = 'Sent';

                            alert(response.message);
                            otp.focus();
                        }
                    },

                    error: function (xhr) {
                        let message = 'Unable to send OTP. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        emailError.innerText = message;
                        emailError.style.display = 'block';

                        sendOtpBtn.disabled = false;
                        sendOtpBtn.innerText = 'Send OTP';
                    }
                });
            });


            /* =========================
            * VERIFY OTP
            * ========================= */
            verifyOtpBtn.addEventListener('click', function () {

                const emailValue = email.value.trim();
                const otpValue = otp.value.trim();

                otpError.style.display = 'none';
                otpError.innerText = '';

                if (!/^\d{6}$/.test(otpValue)) {
                    otpError.innerText = 'Please enter a valid 6-digit OTP.';
                    otpError.style.display = 'block';
                    otp.focus();
                    return;
                }

                verifyOtpBtn.disabled = true;
                verifyOtpBtn.innerText = 'Verifying...';

                $.ajax({
                    url: "{{ route('talent.verify.otp') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: emailValue,
                        otp: otpValue
                    },

                    success: function (response) {
                        if (response.status) {
                            emailVerified.value = '1';
                            otpSuccess.style.display = 'none';

                            email.readOnly = true;
                            otp.readOnly = true;

                            verifyOtpBtn.innerText = 'Verified';
                            verifyOtpBtn.disabled = true;
                            sendOtpBtn.disabled = true;
                            submitBtn.disabled = false;
                        }
                    },

                    error: function (xhr) {
                        let message = 'Invalid OTP. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        otpError.innerText = message;
                        otpError.style.display = 'block';
                    },

                    complete: function () {
                        if (emailVerified.value !== '1') {
                            verifyOtpBtn.disabled = false;
                            verifyOtpBtn.innerText = 'Verify';
                        }
                    }
                });
            });


            /* OTP only numbers */
            otp.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').slice(0, 6);
            });

            /* Phone only numbers */
            phone.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
            });

            /* Email change => reset verification */
            email.addEventListener('input', function () {
                if (emailVerified.value === '1') {
                    emailVerified.value = '0';
                    otpSuccess.style.display = 'none';
                    otpField.style.display = 'none';
                    submitBtn.disabled = true;

                    sendOtpBtn.disabled = false;
                    sendOtpBtn.innerText = 'Send OTP';

                    otp.readOnly = false;
                    verifyOtpBtn.disabled = false;
                    verifyOtpBtn.innerText = 'Verify';
                }
            });


            /* =========================
            * FINAL FORM VALIDATION
            * ========================= */
            form.addEventListener('submit', function (e) {

                let valid = true;

                if (name.value.trim() === '') {
                    alert('Please enter your name.');
                    name.focus();
                    valid = false;
                }
                else if (emailVerified.value !== '1') {
                    alert('Please verify your email address first.');
                    email.focus();
                    valid = false;
                }
                else if (!/^\d{10}$/.test(phone.value.trim())) {
                    alert('Please enter a valid 10-digit phone number.');
                    phone.focus();
                    valid = false;
                }
                else if (city.value.trim() === '') {
                    alert('Please enter your city.');
                    city.focus();
                    valid = false;
                }
                else if (selectedRoles.length === 0) {
                    roleError.innerText = 'Please select at least one role.';
                    roleError.style.display = 'block';
                    roleBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    roleSearch.focus();
                    valid = false;
                }
                else if (!cv.files || cv.files.length === 0) {
                    alert('Please upload your CV.');
                    cv.focus();
                    valid = false;
                }
                else if (cv.files[0].size > 5 * 1024 * 1024) {
                    alert('CV size must not be greater than 5 MB.');
                    cv.focus();
                    valid = false;
                }

                if (!valid) {
                    e.preventDefault();
                    return false;
                }

                submitBtn.disabled = true;
                document.getElementById('submitBtnText').innerText = 'Submitting...';

                showLoder();
            });


            /* CV file check */
            cv.addEventListener('change', function () {
                const maxSize = 5 * 1024 * 1024;

                if (this.files.length > 0) {
                    const file = this.files[0];

                    if (file.size > maxSize) {
                        alert('CV size must not be greater than 5 MB.');
                        this.value = '';
                        return;
                    }

                    const allowedTypes = [
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ];

                    if (!allowedTypes.includes(file.type)) {
                        alert('Please upload a PDF, DOC, or DOCX file.');
                        this.value = '';
                    }
                }
            });

        });
    </script>

</body>

</html>