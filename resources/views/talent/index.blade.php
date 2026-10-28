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
            <!-- <div class="profile-header">
            <div class="letget">
                <img src="{{ asset('frontend/images/handimg.svg') }}" alt="">
                Tell Us About Yourself
            </div>
            <h1>Start Your <span>Hiring Journey</span></h1>
            <p>Share your details and discover opportunities that match your skills and goals.</p>
        </div> -->

            <div class="step-panel">
                <form method="POST" action="{{ route('talent.submit') }}" id="indexForm" enctype="multipart/form-data">
                    @csrf
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
                        <label>What are you looking for? <span class="req">*</span></label>
                        <div class="opportunity-box">

                            <label class="radio-option">
                                <input type="radio" name="looking_for" value="job" {{ old('looking_for') == 'job' ? 'checked' : '' }}>
                                <span>Full time Job</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="looking_for" value="internship" {{ old('looking_for') == 'internship' ? 'checked' : '' }}>
                                <span>Internship</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="looking_for" value="freelancer" {{ old('looking_for') == 'freelancer' ? 'checked' : '' }}>
                                <span>Remote Freelance Work</span>
                            </label>

                        </div>

                        <div class="error-msg" id="lookingForError" style="display:none;"></div>
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

                        <div class="input-row">
                            <div class="col-12">
                                <label>Your Current Profile <span class="req">*</span></label>

                                <select
                                    name="current_profile"
                                    id="current_profile"
                                    class="form-select">

                                    <option value="" selected disabled>
                                        Select your Current Profile
                                    </option>

                                    <option value="student_fresher" {{ old('current_profile') == 'student_fresher' ? 'selected' : '' }}>
                                        Student / Fresher
                                    </option>

                                    <option value="freelancer" {{ old('current_profile') == 'freelancer' ? 'selected' : '' }}>
                                        Freelancer
                                    </option>

                                    <option value="working_professional" {{ old('current_profile') == 'working_professional' ? 'selected' : '' }}>
                                        Working Professional
                                    </option>

                                    <option value="not_working" {{ old('current_profile') == 'not_working' ? 'selected' : '' }}>
                                        Not Working
                                    </option>

                                </select>
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="col-12">

                                <label>
                                    Preferred Roles You're Looking For <span class="req">*</span>
                                </label>

                                <div class="ac-input-wrap">
                                    <input
                                        type="text"
                                        name="preferred_roles"
                                        id="preferred_roles"
                                        placeholder="Select your role"
                                        autocomplete="off"
                                        value="{{ old('preferred_roles') }}">

                                    <span class="ac-clear" id="roleClear" style="display:none;">
                                        ×
                                    </span>
                                </div>

                                <ul class="ac-list" id="roleSuggestions" style="display:none;">

                                    <li data-role="Digital Marketing Executive">Digital Marketing Executive</li>
                                    <li data-role="Digital Marketing Manager">Digital Marketing Manager</li>
                                    <li data-role="Marketing Executive">Marketing Executive</li>
                                    <li data-role="Marketing Manager">Marketing Manager</li>

                                    <li data-role="Sales Executive">Sales Executive</li>
                                    <li data-role="Sales Representative">Sales Representative</li>
                                    <li data-role="Sales Manager">Sales Manager</li>
                                    <li data-role="Business Development Executive">Business Development Executive</li>
                                    <li data-role="Business Development Manager">Business Development Manager</li>

                                    <li data-role="HR Executive">HR Executive</li>
                                    <li data-role="HR Generalist">HR Generalist</li>
                                    <li data-role="HR Manager">HR Manager</li>
                                    <li data-role="Recruiter">Recruiter</li>
                                    <li data-role="Technical Recruiter">Technical Recruiter</li>

                                    <li data-role="Video Editor">Video Editor</li>
                                    <li data-role="Senior Video Editor">Senior Video Editor</li>
                                    <li data-role="Reels Editor">Reels Editor</li>
                                    <li data-role="Motion Graphics Designer">Motion Graphics Designer</li>
                                    <li data-role="VFX Artist">VFX Artist</li>

                                    <li data-role="YouTube Channel Manager">YouTube Channel Manager</li>
                                    <li data-role="YouTube Growth Manager">YouTube Growth Manager</li>
                                    <li data-role="YouTube Strategist">YouTube Strategist</li>
                                    <li data-role="YouTube SEO Specialist">YouTube SEO Specialist</li>
                                    <li data-role="YouTube Video Editor">YouTube Video Editor</li>
                                    <li data-role="YouTube Thumbnail Designer">YouTube Thumbnail Designer</li>
                                    <li data-role="Content Creator">Content Creator</li>

                                    <li data-role="Graphic Designer">Graphic Designer</li>
                                    <li data-role="Creative Designer">Creative Designer</li>
                                    <li data-role="UI Designer">UI Designer</li>
                                    <li data-role="UX Designer">UX Designer</li>
                                    <li data-role="UI/UX Designer">UI/UX Designer</li>
                                    <li data-role="Product Designer">Product Designer</li>
                                    <li data-role="Web Designer">Web Designer</li>

                                    <li data-role="Software Developer">Software Developer</li>
                                    <li data-role="Software Engineer">Software Engineer</li>
                                    <li data-role="Frontend Developer">Frontend Developer</li>
                                    <li data-role="Backend Developer">Backend Developer</li>
                                    <li data-role="Full Stack Developer">Full Stack Developer</li>
                                    <li data-role="Web Developer">Web Developer</li>
                                    <li data-role="React Developer">React Developer</li>
                                    <li data-role="Angular Developer">Angular Developer</li>
                                    <li data-role="Vue.js Developer">Vue.js Developer</li>
                                    <li data-role="Node.js Developer">Node.js Developer</li>
                                    <li data-role="Python Developer">Python Developer</li>
                                    <li data-role="Java Developer">Java Developer</li>
                                    <li data-role="PHP Developer">PHP Developer</li>
                                    <li data-role=".NET Developer">.NET Developer</li>
                                    <li data-role="Android Developer">Android Developer</li>
                                    <li data-role="iOS Developer">iOS Developer</li>
                                    <li data-role="Flutter Developer">Flutter Developer</li>
                                    <li data-role="DevOps Engineer">DevOps Engineer</li>
                                    <li data-role="Cloud Engineer">Cloud Engineer</li>
                                    <li data-role="QA Engineer">QA Engineer</li>
                                    <li data-role="Software Tester">Software Tester</li>
                                    <li data-role="Cybersecurity Analyst">Cybersecurity Analyst</li>

                                </ul>

                                <div class="error-msg" id="roleError" style="display:none;"></div>

                            </div>
                        </div>
                        
                        <div class="input-row">
                            <div class="col-12">
                                <label>Portfolio Link <span>(Optional)</span></label>
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
        const roleInput = document.getElementById('preferred_roles');
        const roleSuggestions = document.getElementById('roleSuggestions');
        const roleClear = document.getElementById('roleClear');

        if (roleInput.value.trim() !== '') {
            roleClear.style.display = 'block';
        }

        // Open dropdown when typing/clicking
        roleInput.addEventListener('focus', function() {
            roleSuggestions.style.display = 'block';
            filterRoles();
        });

        roleInput.addEventListener('input', function() {
            roleClear.style.display = this.value.trim() !== '' ? 'block' : 'none';

            roleSuggestions.style.display = 'block';
            filterRoles();
        });

        // Search/filter roles
        function filterRoles() {
            const search = roleInput.value.toLowerCase().trim();
            let hasResult = false;

            roleSuggestions.querySelectorAll('li').forEach(function(item) {
                const role = item.dataset.role.toLowerCase();

                if (role.includes(search)) {
                    item.style.display = 'block';
                    hasResult = true;
                } else {
                    item.style.display = 'none';
                }
            });

            roleSuggestions.style.display = hasResult ? 'block' : 'none';
        }

        // Select role
        roleSuggestions.querySelectorAll('li').forEach(function(item) {
            item.addEventListener('click', function() {
                roleInput.value = this.dataset.role;
                roleClear.style.display = 'block';
                roleSuggestions.style.display = 'none';
            });
        });

        // Clear role
        roleClear.addEventListener('click', function(e) {
            e.stopPropagation();

            roleInput.value = '';
            roleClear.style.display = 'none';

            roleSuggestions.style.display = 'block';
            filterRoles();

            roleInput.focus();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (
                !e.target.closest('.ac-input-wrap') &&
                !e.target.closest('#roleSuggestions')
            ) {
                roleSuggestions.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('indexForm');

            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');

            const city = document.getElementById('city');
            const currentProfile = document.getElementById('current_profile');
            const preferredRoles = document.getElementById('preferred_roles');
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


            /*
             * SEND OTP
             */
            sendOtpBtn.addEventListener('click', function() {

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

                    success: function(response) {

                        if (response.status) {

                            // If email already exists
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

                            // Change Send OTP button
                            sendOtpBtn.disabled = true;
                            sendOtpBtn.innerText = 'Sended';

                            alert(response.message);

                            otp.focus();
                        }
                    },

                    error: function(xhr) {

                        let message = 'Unable to send OTP. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        emailError.innerText = message;
                        emailError.style.display = 'block';

                        // Allow user to try again if sending failed
                        sendOtpBtn.disabled = false;
                        sendOtpBtn.innerText = 'Send OTP';
                    }
                });
            });


            /*
             * VERIFY OTP
             */
            verifyOtpBtn.addEventListener('click', function() {

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

                    success: function(response) {

                        if (response.status) {

                            // Mark email as verified
                            emailVerified.value = '1';

                            // Hide success message completely
                            otpSuccess.style.display = 'none';

                            // Lock email and OTP
                            email.readOnly = true;
                            otp.readOnly = true;

                            // Change button from "Verifying..." to "Verified"
                            verifyOtpBtn.innerText = 'Verified';
                            verifyOtpBtn.disabled = true;

                            // Disable send OTP
                            sendOtpBtn.disabled = true;

                            // Enable submit
                            submitBtn.disabled = false;
                        }
                    },

                    error: function(xhr) {

                        let message = 'Invalid OTP. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        otpError.innerText = message;
                        otpError.style.display = 'block';
                    },

                    complete: function() {

                        if (emailVerified.value !== '1') {
                            verifyOtpBtn.disabled = false;
                            verifyOtpBtn.innerText = 'Verify';
                        }
                    }
                });
            });


            /*
             * OTP ONLY NUMBERS
             */
            otp.addEventListener('input', function() {

                this.value = this.value
                    .replace(/\D/g, '')
                    .slice(0, 6);

            });


            /*
             * PHONE ONLY NUMBERS
             */
            phone.addEventListener('input', function() {

                this.value = this.value
                    .replace(/\D/g, '')
                    .slice(0, 10);

            });


            /*
             * IF EMAIL IS CHANGED AFTER OTP
             * RESET VERIFICATION
             */
            email.addEventListener('input', function() {

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


            /*
             * FINAL FORM VALIDATION
             */
            form.addEventListener('submit', function(e) {

                let valid = true;

                const lookingFor = document.querySelector(
                    'input[name="looking_for"]:checked'
                );

                const currentProfile = document.getElementById('current_profile');

                /*
                 * Name
                 */
                if (name.value.trim() === '') {

                    alert('Please enter your name.');
                    name.focus();

                    valid = false;
                }


                /*
                 * Looking For
                 */
                else if (!lookingFor) {

                    alert('Please select what you are looking for.');

                    valid = false;
                }


                /*
                 * Email
                 */
                else if (emailVerified.value !== '1') {

                    alert('Please verify your email address first.');
                    email.focus();

                    valid = false;
                }


                /*
                 * Phone
                 */
                else if (!/^\d{10}$/.test(phone.value.trim())) {

                    alert('Please enter a valid 10-digit phone number.');
                    phone.focus();

                    valid = false;
                }


                /*
                 * City
                 */
                else if (city.value.trim() === '') {

                    alert('Please enter your city.');
                    city.focus();

                    valid = false;
                }

                /*
                 * Current Profile
                 */
                else if (!currentProfile.value) {

                    alert('Please select your current profile.');
                    currentProfile.focus();

                    valid = false;
                }


                /*
                 * role
                 */
                else if (roleInput.value.trim() === '') {
                    alert('Please select your role.');
                    roleInput.focus();
                    valid = false;
                }

                /*
                 * CV
                 */
                else if (!cv.files || cv.files.length === 0) {

                    alert('Please upload your CV.');
                    cv.focus();

                    valid = false;
                } else if (cv.files[0].size > 5 * 1024 * 1024) {
                    alert('CV size must not be greater than 5 MB.');
                    cv.focus();
                    valid = false;
                }

                if (!valid) {
                    e.preventDefault();
                    return false;
                }

                // Show submitting state
                submitBtn.disabled = true;

                const submitBtnText = document.getElementById('submitBtnText');
                submitBtnText.innerText = 'Submitting...';

                showLoder();
            });

            cv.addEventListener('change', function() {
                const maxSize = 5 * 1024 * 1024; // 5 MB

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