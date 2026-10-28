@extends('layouts.main')

@section('main-section')

<link rel="stylesheet" href="{{ asset('frontend/css/register.css') }}?v={{ filemtime(public_path('frontend/css/register.css')) }}" />

<section class="register-page">
    <img src="{{ asset('frontend/images/bg-img1.png') }}" class="bg-img1" alt="">
    <img src="{{ asset('frontend/images/bg-img2.png') }}" class="bg-img2" alt="">
    <img src="{{ asset('frontend/images/bg-img3.png') }}" class="bg-img3" alt="">

    <div class="container">
        <div class="profile-header">
            <div class="letget">
                <img src="{{ asset('frontend/images/handimg.svg') }}" alt="">
                lets get Started !
            </div>
            <h1>Start Your <span>Hiring Journey</span></h1>
            <p>Find skilled professionals, connect with the right talent,and build your team with confidence.</p>
        </div>

        <div class="step-panel">
            <form method="POST" action="{{ route('hire.submit') }}" id="indexForm">
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
                    <h2>Post Job/Internship</h2>
                    <p>Hire early talent with work experience up to 2 years</p>
                </div>

                <div class="profile-infom">
                    <label>What are you looking for? <span class="req">*</span></label>
                    <div class="opportunity-box">

                        <label class="radio-option">
                            <input type="radio" name="looking_for" value="job">
                            <span>Full time Job</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="looking_for" value="internship">
                            <span>Internship</span>
                        </label>

                        <label class="radio-option">
                            <input type="radio" name="looking_for" value="freelancer">
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
                            <input name="name" id="name" type="text" placeholder="Enter Your Name">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="input-row">
                        <div class="col-12">
                            <label>Email <span class="req">*</span></label>

                            <div class="email-otp-wrap">
                                <input
                                    name="email"
                                    id="email"
                                    type="email"
                                    placeholder="Enter Your Email">

                                <button
                                    type="button"
                                    class="otp-btn"
                                    id="sendOtpBtn">
                                    Send OTP
                                </button>
                            </div>

                            <div
                                class="error-msg"
                                id="emailError"
                                style="display:none;">
                            </div>
                        </div>
                    </div>


                    {{-- OTP --}}
                    <div
                        class="input-row"
                        id="otpField"
                        style="display:none;">

                        <div class="col-12">

                            <label>Email OTP <span class="req">*</span></label>

                            <div class="email-otp-wrap">

                                <input
                                    type="text"
                                    id="otp"
                                    maxlength="6"
                                    inputmode="numeric"
                                    placeholder="Enter 6 digit OTP">

                                <button
                                    type="button"
                                    class="otp-btn"
                                    id="verifyOtpBtn">
                                    Verify
                                </button>

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
                    </div>


                    <input
                        type="hidden"
                        id="emailVerified"
                        name="email_verified"
                        value="0">

                    <div class="input-row">
                        <div class="col-12">
                            <label>Contact Number <span class="req">*</span></label>
                            <input name="phone" id="phone" type="text" placeholder="Enter Your Contact Number">
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="col-12">
                            <label>Educational Qualification <span class="req">*</span></label>
                            <select
                                name="qualification"
                                id="qualification"
                                class="form-select">
                                <option value="" selected disabled>
                                    Select your Educational Qualification
                                </option>
                                <option value="10th">10th</option>
                                <option value="12th">12th</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Graduate">Graduate</option>
                                <option value="Post Graduate">Post Graduate</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-row">
                        <label>
                            Skills <span class="req">*</span>
                        </label>

                        <div class="ac-input-wrap">
                            <input
                                type="text"
                                id="skillInput"
                                placeholder="Select your skills"
                                autocomplete="off">

                            <span class="ac-clear" id="skillClear" style="display:none;">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="14"
                                    height="14"
                                    viewBox="0 0 14 14"
                                    fill="none">
                                    <path
                                        d="M10.5 3.5L3.5 10.5"
                                        stroke="currentColor"
                                        stroke-width="1.3"
                                        stroke-linecap="round" />
                                    <path
                                        d="M3.5 3.5L10.5 10.5"
                                        stroke="currentColor"
                                        stroke-width="1.3"
                                        stroke-linecap="round" />
                                </svg>
                            </span>
                        </div>

                        {{-- Skill Suggestions --}}
                        <ul class="ac-list" id="skillsSuggestions" style="display:none;">
                            <li data-skill="Digital Marketing">Digital Marketing</li>
                            <li data-skill="SEO">SEO</li>
                            <li data-skill="Marketing">Marketing</li>
                            <li data-skill="Video Editing">Video Editing</li>
                            <li data-skill="Sales">Sales</li>
                            <li data-skill="Graphic Designing">Graphic Designing</li>
                            <li data-skill="Social Media Management">Social Media Management</li>
                            <li data-skill="Influencer Management">Influencer Management</li>
                        </ul>

                        {{-- Selected Skills --}}
                        <div class="skills-tags" id="jobTags"></div>

                        <div class="error-msg" id="skillsError" style="display:none;"></div>
                    </div>

                </div>

                <div class="footer-btn">
                    <button
                        type="submit"
                        class="post-btn"
                        id="submitBtn"
                        disabled>
                        <span>Submit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const skillInput = document.getElementById('skillInput');
    const skillsSuggestions = document.getElementById('skillsSuggestions');
    const jobTags = document.getElementById('jobTags');
    const skillClear = document.getElementById('skillClear');

    let selectedSkills = [];


    /*
     * Show skills
     */
    skillInput.addEventListener('focus', function() {
        filterSkills();
    });


    /*
     * Search skills
     */
    skillInput.addEventListener('input', function() {
        filterSkills();
    });


    function filterSkills() {

        const search = skillInput.value.toLowerCase().trim();

        let hasResult = false;

        skillsSuggestions.querySelectorAll('li').forEach(function(item) {

            const skill = item.dataset.skill.toLowerCase();

            if (
                skill.includes(search) &&
                !selectedSkills.includes(item.dataset.skill)
            ) {
                item.style.display = 'block';
                hasResult = true;
            } else {
                item.style.display = 'none';
            }

        });

        skillsSuggestions.style.display = hasResult ? 'block' : 'none';
    }


    /*
     * Select skill
     */
    skillsSuggestions.querySelectorAll('li').forEach(function(item) {

        item.addEventListener('click', function() {

            const skill = this.dataset.skill;

            if (!selectedSkills.includes(skill)) {

                selectedSkills.push(skill);

                addSkillTag(skill);

                skillInput.value = '';

                filterSkills();
            }

        });

    });


    /*
     * Add selected skill tag
     */
    function addSkillTag(skill) {

        const tag = document.createElement('span');

        tag.className = 'skilltag';

        tag.innerHTML = `
        ${skill}

        <input
            type="hidden"
            name="skills[]"
            value="${skill}">

        <button
            type="button"
            class="tag-remove"
            data-skill="${skill}">

            <svg xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none">

                <path
                    d="M10.5 3.5L3.5 10.5"
                    stroke="white"
                    stroke-width="1.77083"
                    stroke-linecap="round"
                    stroke-linejoin="round" />

                <path
                    d="M3.5 3.5L10.5 10.5"
                    stroke="white"
                    stroke-width="1.77083"
                    stroke-linecap="round"
                    stroke-linejoin="round" />

            </svg>

        </button>
    `;

        jobTags.appendChild(tag);

        skillClear.style.display = 'block';
    }


    /*
     * Remove skill
     */
    jobTags.addEventListener('click', function(e) {

        const button = e.target.closest('.tag-remove');

        if (!button) {
            return;
        }

        const skill = button.dataset.skill;

        selectedSkills = selectedSkills.filter(function(item) {
            return item !== skill;
        });

        button.closest('.skilltag').remove();

        filterSkills();

        if (selectedSkills.length === 0) {
            skillClear.style.display = 'none';
        }
    });


    /*
     * Clear input
     */
    skillClear.addEventListener('click', function() {

        skillInput.value = '';

        skillInput.focus();

        filterSkills();
    });


    /*
     * Close suggestions when clicking outside
     */
    document.addEventListener('click', function(e) {

        if (!e.target.closest('.ac-input-wrap') &&
            !e.target.closest('#skillsSuggestions')) {

            skillsSuggestions.style.display = 'none';
        }

    });

    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('indexForm');

        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const phone = document.getElementById('phone');

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
                url: "{{ route('hire.send.otp') }}",
                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                    email: emailValue
                },

                success: function(response) {

                    if (response.status) {

                        otpField.style.display = 'block';

                        emailVerified.value = '0';

                        submitBtn.disabled = true;

                        otp.value = '';

                        otpError.style.display = 'none';
                        otpSuccess.style.display = 'none';

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
                },

                complete: function() {

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
                url: "{{ route('hire.verify.otp') }}",
                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                    email: emailValue,
                    otp: otpValue
                },

                success: function(response) {

                    if (response.status) {

                        emailVerified.value = '1';

                        otpSuccess.innerText = response.message;
                        otpSuccess.style.display = 'block';

                        otpError.style.display = 'none';

                        email.readOnly = true;
                        otp.readOnly = true;

                        verifyOtpBtn.disabled = true;
                        sendOtpBtn.disabled = true;

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
                .slice(0, 12);

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

            const qualification = document.getElementById('qualification');

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
            else if (!/^\d{8,12}$/.test(phone.value.trim())) {

                alert('Please enter a valid phone number between 8 and 12 digits.');
                phone.focus();

                valid = false;
            }


            /*
             * Educational Qualification
             */
            else if (!qualification.value) {

                alert('Please select your educational qualification.');
                qualification.focus();

                valid = false;
            }


            /*
             * Skills
             */
            else if (selectedSkills.length === 0) {

                alert('Please select at least one skill.');
                skillInput.focus();

                valid = false;
            }


            if (!valid) {
                e.preventDefault();
                return false;
            }

        });

    });
</script>

@endsection