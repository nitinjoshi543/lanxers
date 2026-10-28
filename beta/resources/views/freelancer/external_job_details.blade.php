@extends('layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/looking-employe.css') }}?v={{ filemtime(public_path('frontend/css/looking-employe.css')) }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/homepage.css') }}?v={{ filemtime(public_path('frontend/css/homepage.css')) }}" />

<section class="lookingemployee">
    <div class="container-fluid">
        <div class="freelanceJob">
            <div class="employeDescription">
                <div class="budgetInfo">
                    <div class="text">
                        <p>Posted {{ $job->posted_ago }} · via {{ ucfirst($job->source) }}</p>
                        <h4>{{ $job->title }}</h4>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_2431_9680)">
                                    <path d="M9.17258 17.5H8.00425C5.01675 17.5 3.52341 17.5 2.59508 16.5542C1.66675 15.6083 1.66675 14.0858 1.66675 11.0417C1.66675 7.99751 1.66675 6.47501 2.59508 5.52918C3.52341 4.58334 5.01675 4.58334 8.00425 4.58334H11.1734C14.1609 4.58334 15.6551 4.58334 16.5834 5.52918C17.2976 6.25668 17.4617 7.32584 17.5001 9.16668" stroke="#838383" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M13.3335 4.58334L13.2502 4.32501C12.8377 3.04167 12.6318 2.40001 12.141 2.03334C11.6493 1.66667 10.9977 1.66667 9.69183 1.66667H9.47266C8.1685 1.66667 7.516 1.66667 7.02516 2.03334C6.5335 2.40001 6.32766 3.04167 5.91516 4.32501L5.8335 4.58334M14.2593 11.0458C14.4135 10.9042 14.4902 10.8333 14.5835 10.8333C14.6768 10.8333 14.7535 10.9042 14.9077 11.0458L15.5018 11.5933C15.5735 11.6592 15.6093 11.6925 15.6535 11.7083C15.6985 11.725 15.7468 11.7233 15.8452 11.7192L16.6468 11.6875C16.8535 11.6792 16.9568 11.6758 17.0277 11.735C17.0985 11.7942 17.1127 11.8967 17.1402 12.1017L17.2502 12.9233C17.2635 13.0183 17.2693 13.065 17.2927 13.1067C17.316 13.1467 17.3535 13.1758 17.4285 13.235L18.0752 13.7433C18.2352 13.87 18.3152 13.9325 18.331 14.0225C18.3468 14.1125 18.2927 14.1992 18.186 14.3725L17.7477 15.0783C17.6977 15.1592 17.6727 15.2 17.6643 15.245C17.656 15.29 17.666 15.3375 17.686 15.4308L17.8602 16.2458C17.9018 16.4458 17.9235 16.5458 17.8777 16.6258C17.8318 16.7058 17.7343 16.7375 17.5402 16.8008L16.7685 17.0517C16.6768 17.0817 16.6302 17.0967 16.5943 17.1267C16.5585 17.1575 16.536 17.2008 16.4918 17.2867L16.1152 18.0125C16.0193 18.1983 15.971 18.2908 15.8835 18.3225C15.796 18.3542 15.7002 18.3142 15.5068 18.2342L14.7668 17.9275C14.676 17.89 14.631 17.8708 14.5835 17.8708C14.536 17.8708 14.491 17.89 14.4002 17.9275L13.6602 18.2342C13.4668 18.3142 13.371 18.3542 13.2835 18.3225C13.196 18.2908 13.1477 18.1975 13.0518 18.0125L12.6752 17.2867C12.6302 17.2008 12.6085 17.1575 12.5727 17.1275C12.5368 17.0975 12.4902 17.0817 12.3985 17.0525L11.6268 16.8008C11.4327 16.7375 11.3352 16.7058 11.2893 16.6258C11.2435 16.5458 11.2643 16.4467 11.3068 16.2458L11.4818 15.4308C11.501 15.3375 11.511 15.2908 11.5027 15.2458C11.4856 15.1856 11.4573 15.129 11.4193 15.0792L10.9818 14.3725C10.8735 14.1992 10.8202 14.1125 10.836 14.0225C10.8518 13.9325 10.9318 13.87 11.0918 13.7442L11.7385 13.2358C11.8135 13.1758 11.851 13.1467 11.8743 13.1058C11.8977 13.065 11.9035 13.0183 11.916 12.9225L12.0268 12.1017C12.0543 11.8975 12.0685 11.7942 12.1393 11.735C12.2102 11.6758 12.3135 11.6792 12.5202 11.6875L13.3227 11.7192C13.4202 11.7233 13.4685 11.725 13.5135 11.7083C13.5577 11.6917 13.5935 11.6592 13.6652 11.5933L14.2593 11.0458Z" stroke="#838383" stroke-width="1.5" />
                                </g>
                                <defs><clipPath id="clip0_2431_9680"><rect width="20" height="20" fill="white" /></clipPath></defs>
                            </svg>
                            {{ $job->ai_work_arrangement ? ucfirst($job->ai_work_arrangement) : ($job->employment_type ?? 'Not specified') }}
                        </span>
                    </div>
                    <div class="applyBudget">
                        <span>Salary</span>
                        <p>{{ $job->salary ?: 'Not disclosed' }}</p>

                        {{-- No native proposal/wallet flow for external jobs — goes straight to source --}}
                        <!-- <a href="{{ $job->url }}" target="_blank" rel="noopener" class="aplNow applyNow">
                            Apply on {{ ucfirst($job->source) }}
                        </a> -->

                        <a href="#"
                            class="aplNow applyNow"
                            data-bs-toggle="modal"
                            data-bs-target="#GetStarted"
                            data-job-id="{{ $job->id }}"
                            data-job-url="{{ $job->url }}">
                                Apply on {{ ucfirst($job->source) }}
                        </a>

                        {{-- No chat button — no internal employer account to chat with --}}
                    </div>
                </div>

                <div class="showJObInfo">
                    <div class="textMore">
                        <h5>Job Description</h5>
                        {!! nl2br(e($job->description_text)) !!}
                    </div>

                    <a href="#" class="showMore d-none">
                        Show More
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47124 10.4713C8.34622 10.5963 8.17668 10.6665 7.9999 10.6665C7.82313 10.6665 7.65359 10.5963 7.52857 10.4713L3.75724 6.69999C3.69356 6.6385 3.64277 6.56493 3.60784 6.4836C3.5729 6.40226 3.55451 6.31478 3.55374 6.22626C3.55297 6.13774 3.56983 6.04996 3.60336 5.96803C3.63688 5.88609 3.68638 5.81166 3.74897 5.74906C3.81157 5.68647 3.886 5.63697 3.96793 5.60345C4.04986 5.56993 4.13765 5.55306 4.22617 5.55383C4.31469 5.5546 4.40217 5.57299 4.48351 5.60793C4.56484 5.64287 4.63841 5.69365 4.6999 5.75733L7.9999 9.05733L11.2999 5.75733C11.4256 5.63589 11.594 5.56869 11.7688 5.57021C11.9436 5.57173 12.1108 5.64184 12.2344 5.76545C12.3581 5.88905 12.4282 6.05626 12.4297 6.23106C12.4312 6.40586 12.364 6.57426 12.2426 6.69999L8.47124 10.4713Z" fill="#00A148" />
                        </svg>
                    </a>
                </div>

                @if(!empty($job->key_skills))
                <div class="SkillsRequired">
                    <h5>Skills Required</h5>
                    <ul>
                        @foreach($job->key_skills as $skill)
                        <li>{{ trim($skill) }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- No attachments block — external_jobs has no job_attachments relation --}}

                @if($job->ai_experience_level || $job->employment_type)
                <div class="SkillsRequired">
                    <h5>Job Details</h5>
                    <ul>
                        @if($job->ai_experience_level)
                            <li>{{ ucfirst($job->ai_experience_level) }}</li>
                        @endif
                        @if($job->employment_type)
                            <li>{{ $job->employment_type }}</li>
                        @endif
                        @if($job->ai_work_arrangement_office_days)
                            <li>{{ $job->ai_work_arrangement_office_days }}</li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>

            <div class="aboutClient">
                <div class="detailClient">
                    <h5>About the Company</h5>
                    <div class="picture">
                        <div class="images">
                            <div class="image">
                                <img src="{{ $job->organization_logo ?: 'https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg' }}"
                                    onerror="this.onerror=null; this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg';"
                                    alt="Company Logo">
                            </div>
                        </div>
                        <div class="text">
                            <p>{{ $job->organization }}</p>
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                    <path d="M10.8329 5.41523C10.8329 8.11977 7.83263 10.9364 6.82513 11.8064C6.73128 11.8769 6.61703 11.9151 6.49959 11.9151C6.38216 11.9151 6.26791 11.8769 6.17405 11.8064C5.16655 10.9364 2.16626 8.11977 2.16626 5.41523C2.16626 4.26596 2.62281 3.16376 3.43546 2.3511C4.24812 1.53844 5.35032 1.08189 6.49959 1.08189C7.64886 1.08189 8.75106 1.53844 9.56372 2.3511C10.3764 3.16376 10.8329 4.26596 10.8329 5.41523Z" stroke="#6A7282" stroke-width="0.684692" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.49951 7.04143C7.39697 7.04143 8.12451 6.31389 8.12451 5.41643C8.12451 4.51896 7.39697 3.79143 6.49951 3.79143C5.60205 3.79143 4.87451 4.51896 4.87451 5.41643C4.87451 6.31389 5.60205 7.04143 6.49951 7.04143Z" stroke="#6A7282" stroke-width="0.684692" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ $job->address_locality ?? $job->locations ?? 'Location not specified' }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="clientDesc">
                        @php $about = $job->org_linkedin_description ?? ''; @endphp
                        <p>
                            {{ \Illuminate\Support\Str::words($about, 70, '...') }}
                        </p>
                    </div>
                    <div class="viewCompany">
                        @if($job->org_linkedin_website)
                        <a class="ViewProfile" href="{{ $job->org_linkedin_website }}" target="_blank" rel="noopener">
                            Visit Company Website
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Similar Jobs section omitted — controller doesn't currently query
                     similar external jobs. See note below. --}}
            </div>
        </div>
    </div>
</section>

    <div class="modal fade " id="GetStarted" tabindex="-1" aria-labelledby="GetStartedLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="content">
                            <div class="text">
                                <h4>Let's Get You Started</h4>
                                <form action="" id="getStartedForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="job_id" id="getStartedJobId">

                                    <div class="formArea">
                                        <div class="form-group">
                                            <label for="Name">Name <span>*</span></label>
                                            <input type="text" maxlength="30" name="name" id="name" class="form-control"
                                                placeholder="Enter your name here...">
                                            <span class="error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="mail">
                                                E-mail <span>*</span>
                                            </label>

                                            <input type="email" maxlength="70" name="email" id="mail" class="form-control"
                                                placeholder="Enter your e-mail here...">

                                            <a href="#" class="verify" id="sendOtp"> Send OTP</a>

                                            <span class="error"></span>
                                            <!-- OTP SECTION -->
                                            <div id="otpSection" class="otp-section">
                                                <p class="otp-title">Enter the OTP sent to your email</p>

                                                <div class="otp-container">
                                                    <input class="otp-input" type="text" inputmode="numeric" maxlength="1">
                                                    <input class="otp-input" type="text" inputmode="numeric" maxlength="1">
                                                    <input class="otp-input" type="text" inputmode="numeric" maxlength="1">
                                                    <input class="otp-input" type="text" inputmode="numeric" maxlength="1">
                                                    <input class="otp-input" type="text" inputmode="numeric" maxlength="1">
                                                    <input class="otp-input" type="text" inputmode="numeric" maxlength="1">
                                                </div>

                                                <button type="button" id="verifyOtp" class="verify-otp" disabled>
                                                    Verify OTP
                                                </button>

                                                <p id="otpMessage" class="otp-message"></p>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Number">Phone Number <span>*</span></label>
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                placeholder="Enter your phone number here...">
                                            <span class="error"></span>
                                        </div>

                                        <div class="dropdown roleDropdown">
                                            <p>Role <span>*</span></p>
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Dropdown button
                                            </button>
                                            <span class="error"></span>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">UI UX Designer</a></li>
                                                <li><a class="dropdown-item" href="#">UX Designer</a></li>
                                                <li><a class="dropdown-item" href="#">UI Designer</a></li>
                                                <li><a class="dropdown-item" href="#">Graphic Designer</a></li>
                                                <li><a class="dropdown-item" href="#">UI UX Developer</a></li>
                                            </ul>
                                            <input type="hidden" name="role" id="role">
                                        </div>
                                        <div class="resumeUpload">
                                            <input type="file" id="resumeFile" name="resume" accept=".pdf,.doc,.docx">
                                            <label for="resumeFile" class="uploadBox">
                                                <div class="uploadIcon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        viewBox="0 0 30 30" fill="none">
                                                        <path
                                                            d="M18 13.1053C17.0452 13.1053 16.1295 12.706 15.4544 11.9954C14.7793 11.2847 14.4 10.3208 14.4 9.31579V4.26316H9.6C8.96348 4.26316 8.35303 4.52932 7.90294 5.0031C7.45286 5.47687 7.2 6.11945 7.2 6.78947V23.2105C7.2 23.8805 7.45286 24.5231 7.90294 24.9969C8.35303 25.4707 8.96348 25.7368 9.6 25.7368H20.4C21.0365 25.7368 21.647 25.4707 22.0971 24.9969C22.5471 24.5231 22.8 23.8805 22.8 23.2105V13.1053H18ZM15.6 9.31579C15.6 9.98581 15.8529 10.6284 16.3029 11.1022C16.753 11.5759 17.3635 11.8421 18 11.8421H22.308L15.6 4.78105V9.31579ZM9.6 3H15.6L24 11.8421V23.2105C24 24.2156 23.6207 25.1794 22.9456 25.8901C22.2705 26.6008 21.3548 27 20.4 27H9.6C8.64522 27 7.72955 26.6008 7.05442 25.8901C6.37928 25.1794 6 24.2156 6 23.2105V6.78947C6 5.78444 6.37928 4.82058 7.05442 4.10991C7.72955 3.39925 8.64522 3 9.6 3Z"
                                                            fill="#777777" />
                                                    </svg>
                                                </div>

                                                <h5>Upload Your Resume</h5>
                                                <p class="uploadText">
                                                    Upload your resume to highlight your experience and
                                                    help employers discover your profile faster.
                                                </p>
                                                <span class="error"></span>
                                                <span class="uploadButton">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                        viewBox="0 0 12 12" fill="none">
                                                        <g clip-path="url(#clip0_4357_22589)">
                                                            <path
                                                                d="M6 1.5V7.5M3.5 4L6 1.5L8.5 4M10.5 7.5V9.5C10.5 9.76522 10.3946 10.0196 10.2071 10.2071C10.0196 10.3946 9.76522 10.5 9.5 10.5H2.5C2.23478 10.5 1.98043 10.3946 1.79289 10.2071C1.60536 10.0196 1.5 9.76522 1.5 9.5V7.5"
                                                                stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_4357_22589">
                                                                <rect width="12" height="12" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    Upload file
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="registerNow">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const showMoreBtn = document.querySelector(".showMore");
        const textMore = document.querySelector(".textMore");
        if (!showMoreBtn || !textMore) return;

        if (textMore.scrollHeight > 120) {
            showMoreBtn.classList.remove("d-none");
        }

        showMoreBtn.addEventListener("click", function(e) {
            e.preventDefault();
            textMore.classList.toggle("active");
            this.textContent = textMore.classList.contains("active") ? "Show Less" : "Show More";
        });
    });
</script>

<script>
        const jobIdInput = document.getElementById("getStartedJobId");
        const jobUrlInput = document.getElementById("getStartedJobUrl");

        document.querySelectorAll(".applyNow").forEach(function (button) {

            button.addEventListener("click", function () {

                const jobId = this.dataset.jobId;
                const jobUrl = this.dataset.jobUrl;

                jobIdInput.value = jobId || "";

                // Store URL temporarily for redirect after successful submission
                sessionStorage.setItem("getstarted_job_url", jobUrl || "");
                sessionStorage.setItem("getstarted_job_id", jobId || "");
            });

        });

        const form = document.getElementById("getStartedForm");

        const nameInput = document.querySelector('input[name="name"]');
        const emailInput = document.querySelector('input[name="email"]');
        const phoneInput = document.querySelector('input[name="phone"]');

        const roleDropdown = document.querySelector(".roleDropdown");
        const roleButton = roleDropdown.querySelector(".dropdown-toggle");
        const roleInput = document.getElementById("role");

        const resumeInput = document.getElementById("resumeFile");
        const resumeError = document.querySelector(".resumeUpload .error");
        const uploadText = document.querySelector(".resumeUpload .uploadText");

        const sendOtp = document.getElementById("sendOtp");
        const otpSection = document.getElementById("otpSection");
        const otpInputs = document.querySelectorAll(".otp-input");
        const verifyOtp = document.getElementById("verifyOtp");
        const otpMessage = document.getElementById("otpMessage");

        let otpVerified = false;

        roleDropdown.querySelectorAll(".dropdown-item").forEach(item => {
            item.addEventListener("click", function (e) {
                e.preventDefault();   // ✅ stops the href="#" jump

                const selectedRole = this.textContent.trim();
                roleButton.textContent = selectedRole;
                roleInput.value = selectedRole;

                const error = roleDropdown.querySelector(".error");
                if (error) {
                    error.textContent = "";
                }
            });
        });

        nameInput.addEventListener("input", function () {

            this.value = this.value.replace(/[^a-zA-Z\s]/g, "");
            const error = this.parentElement.querySelector(".error");

            if (this.value.trim() !== "") {
                error.textContent = "";
            }

        });

        emailInput.addEventListener("input", function () {

            const error = this.parentElement.querySelector(".error");
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            otpVerified = false;

            if (this.value.trim() === "") {
                error.textContent = "";
                return;
            }

            if (emailRegex.test(this.value.trim())) {
                error.textContent = "";
            }

        });

        sendOtp.addEventListener("click", function (e) {
            e.preventDefault();

            const email = emailInput.value.trim();
            const emailError = emailInput.parentElement.querySelector(".error");
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email === "") {
                emailError.textContent = "Please enter your email.";
                emailInput.focus();
                return;
            }

            if (!emailRegex.test(email)) {
                emailError.textContent = "Please enter a valid email.";
                emailInput.focus();
                return;
            }

            emailError.textContent = "";

            const token = form.querySelector('input[name="_token"]').value;
            sendOtp.textContent = "Sending...";

            fetch("{{ route('getstarted.sendOtp') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({ email: email })
            })
            .then(res => res.json().then(data => ({ ok: res.ok, data })))
            .then(({ ok, data }) => {
                sendOtp.textContent = "Send OTP";

                if (!ok || !data.status) {
                    emailError.textContent = data.message || "Unable to send OTP.";
                    return;
                }

                if (data.verified) {
                    otpVerified = true;

                    emailInput.readOnly = true;
                    emailInput.classList.add("verified-locked");

                    sendOtp.style.display = "none";

                    otpSection.classList.remove("show");
                    otpMessage.textContent = "";

                    // Sirf verified icon/text email ke paas dikhao (verifyOtp success jaisa)
                    const emailError = emailInput.parentElement.querySelector(".error");
                    emailError.innerHTML = `
                    <span style="color:#00A148; display:inline-flex; align-items:center; gap:4px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 17 17" fill="none">
                            <path d="M15.1407 9.29886C14.6095 11.9551 12.6068 14.4558 9.79561 15.015C6.98447 15.5742 4.13178 14.2666 2.72039 11.7719C1.309 9.27736 1.65743 6.15868 3.58458 4.03706C5.51174 1.91543 8.76572 1.33012 11.422 2.39262"
                                stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.10938 8.23438L8.76562 10.8906L15.1406 3.98438"
                                stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Email verified
                    </span>`;

                    return;
                }

                otpSection.classList.add("show");
                sendOtp.style.display = "none";
                otpInputs.forEach(input => input.value = "");
                otpVerified = false;
                verifyOtp.disabled = true;
                otpMessage.textContent = "";
                otpInputs[0].focus();
            })
            .catch(() => {
                sendOtp.textContent = "Send OTP";
                emailError.textContent = "Something went wrong. Please try again.";
            });
        });

        otpInputs.forEach(function (input, index) {

            input.addEventListener("input", function () {
                this.value = this.value.replace(/\D/g, "");

                if (this.value !== "") {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                }
                checkOtp();
            });

            input.addEventListener("keydown", function (event) {
                if (event.key === "Backspace") {
                    if (this.value === "" && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                }
            });

        });

        function checkOtp() {

            let otp = "";
            otpInputs.forEach(function (input) {
                otp += input.value;
            });

            if (otp.length === 6) {
                verifyOtp.disabled = false;
            } else {
                verifyOtp.disabled = true;
            }
        }

        verifyOtp.addEventListener("click", function () {
            let otp = "";
            otpInputs.forEach(function (input) { otp += input.value; });

            if (otp.length !== 6) {
                otpMessage.textContent = "Please enter complete OTP.";
                return;
            }

            const token = form.querySelector('input[name="_token"]').value;
            verifyOtp.disabled = true;
            verifyOtp.textContent = "Verifying...";

            fetch("{{ route('getstarted.verifyOtp') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({ email: emailInput.value.trim(), otp: otp })
            })
            .then(res => res.json().then(data => ({ ok: res.ok, data })))
            .then(({ ok, data }) => {
                verifyOtp.textContent = "Verify OTP";

                if (!ok || !data.status) {
                    otpVerified = false;
                    verifyOtp.disabled = false;
                    otpMessage.textContent = data.message || "Invalid OTP.";
                    return;
                }

                otpVerified = true;

                // OTP section hide back to original state
                otpSection.classList.remove("show");
                otpMessage.textContent = "";

                // Email field lock kar do — ab edit nahi kar sakte
                emailInput.readOnly = true;
                emailInput.classList.add("verified-locked");
                sendOtp.style.display = "none"; // send otp link bhi hide

                // Verified badge dikhao
                const emailError = emailInput.parentElement.querySelector(".error");
                emailError.innerHTML = `
                <span style="color:#00A148; display:inline-flex; align-items:center; gap:4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 17 17" fill="none">
                        <path d="M15.1407 9.29886C14.6095 11.9551 12.6068 14.4558 9.79561 15.015C6.98447 15.5742 4.13178 14.2666 2.72039 11.7719C1.309 9.27736 1.65743 6.15868 3.58458 4.03706C5.51174 1.91543 8.76572 1.33012 11.422 2.39262"
                            stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.10938 8.23438L8.76562 10.8906L15.1406 3.98438"
                            stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Email verified
                </span>`;
            })
            .catch(() => {
                verifyOtp.textContent = "Verify OTP";
                verifyOtp.disabled = false;
                otpMessage.textContent = "Something went wrong. Please try again.";
            });
        });

        phoneInput.addEventListener("input", function () {

            this.value = this.value.replace(/\D/g, "");
            this.value = this.value.slice(0, 10);

            const error = this.parentElement.querySelector(".error");
            if (this.value.length === 10) {
                error.textContent = "";
            }

        });

        resumeInput.addEventListener("change", function () {

            if (!this.files.length) {

                resumeError.textContent = "";
                uploadText.textContent = "";

                return;
            }

            const file = this.files[0];
            const allowedExtensions = [
                "pdf",
                "doc",
                "docx"
            ];

            const extension = file.name
                .split(".")
                .pop()
                .toLowerCase();

            const maxSize = 2 * 1024 * 1024;

            if (!allowedExtensions.includes(extension)) {

                resumeError.textContent =
                    "Only PDF, DOC or DOCX files are allowed.";

                this.value = "";
                uploadText.textContent = "";

                return;
            }

            if (file.size > maxSize) {
                resumeError.textContent =
                    "Resume size must be 2 MB or less.";
                this.value = "";
                uploadText.textContent = "";
                return;
            }

            resumeError.textContent = "";
            uploadText.textContent = file.name;

        });

        form.addEventListener("submit", function (e) {
            e.preventDefault();
            let isValid = true;

            const nameError =
                nameInput.parentElement.querySelector(".error");

            if (nameInput.value.trim() === "") {
                nameError.textContent =
                    "Please enter your name.";
                isValid = false;

            } else if (!/^[a-zA-Z\s]+$/.test(nameInput.value.trim())) {

                nameError.textContent =
                    "Name can contain only letters.";
                isValid = false;

            } else {
                nameError.textContent = "";
            }

            const emailError =
                emailInput.parentElement.querySelector(".error");
            const emailRegex =
                /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailInput.value.trim() === "") {
                emailError.textContent =
                    "Please enter your email.";
                isValid = false;

            } else if (!emailRegex.test(emailInput.value.trim())) {

                emailError.textContent =
                    "Please enter a valid email.";
                isValid = false;

            } else {
                emailError.textContent = "";
            }

            if (!otpVerified) {
                otpMessage.textContent =
                    "Please verify your email with OTP.";
                isValid = false;
            } else {
                otpMessage.textContent = "";
            }

            const phoneError =
                phoneInput.parentElement.querySelector(".error");

            if (phoneInput.value.trim() === "") {
                phoneError.textContent =
                    "Please enter your phone number.";
                isValid = false;
            } else if (!/^\d{10}$/.test(phoneInput.value)) {
                phoneError.textContent =
                    "Phone number must be exactly 10 digits.";
                isValid = false;
            } else {
                phoneError.textContent = "";
            }

            const roleError =
                roleDropdown.querySelector(".error");

            if (roleInput.value.trim() === "") {
                roleError.textContent =
                    "Please select your role.";
                isValid = false;
            } else {
                roleError.textContent = "";
            }

            if (!resumeInput.files.length) {
                resumeError.textContent =
                    "Please upload your resume.";
                isValid = false;

            } else {
                const file = resumeInput.files[0];
                const allowedExtensions = [
                    "pdf",
                    "doc",
                    "docx"
                ];

                const extension = file.name
                    .split(".")
                    .pop()
                    .toLowerCase();

                const maxSize = 2 * 1024 * 1024;

                if (!allowedExtensions.includes(extension)) {
                    resumeError.textContent =
                        "Only PDF, DOC or DOCX files are allowed.";
                    isValid = false;
                } else if (file.size > maxSize) {
                    resumeError.textContent =
                        "Resume size must be 2 MB or less.";
                    isValid = false;
                } else {
                    resumeError.textContent = "";
                }
            }

            if (isValid) {
                const submitBtn = form.querySelector(".registerNow");
                const originalBtnText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = "Submitting...";

                // Manually build FormData with lowercase keys matching controller validation
                const formData = new FormData();
                formData.append('name', nameInput.value.trim());
                formData.append('email', emailInput.value.trim());
                formData.append('phone', phoneInput.value.trim());
                formData.append('role', roleInput.value.trim());

                formData.append(
                    'job_id',
                    document.getElementById('getStartedJobId').value
                );

                if (resumeInput.files.length) {
                    formData.append('resume', resumeInput.files[0]);
                }
                formData.append('_token', form.querySelector('input[name="_token"]').value);

                fetch("{{ route('getstarted.store') }}", {
                    method: "POST",
                    headers: { "Accept": "application/json" },
                    body: formData
                })
                .then(res => res.json().then(data => ({ ok: res.ok, data })))
                .then(({ ok, data }) => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;

                    if (!ok || !data.status) {
                        if (data.errors) {
                            // ab keys lowercase hongi — mapping bhi lowercase honi chahiye
                            const fieldMap = {
                                'name': nameInput,
                                'email': emailInput,
                                'phone': phoneInput,
                                'role': roleInput,
                                'resume': resumeInput
                            };
                            Object.keys(data.errors).forEach(key => {
                                const el = fieldMap[key];
                                if (el) {
                                    const errEl = el.parentElement.querySelector(".error")
                                        || (el.closest('.resumeUpload') && el.closest('.resumeUpload').querySelector(".error"))
                                        || (el.closest('.roleDropdown') && el.closest('.roleDropdown').querySelector(".error"));
                                    if (errEl) errEl.textContent = data.errors[key][0];
                                }
                            });
                        }
                        alert(data.message || "Something went wrong. Please try again.");
                        return;
                    }

                    alert(data.message);

                    var modalEl = document.getElementById('GetStarted');
                    if (modalEl) {
                        var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInstance.hide();
                    }

                    localStorage.setItem('lx_lead_registered', '1');

                    form.reset();
                    otpSection.classList.remove("show");
                    sendOtp.style.display = "";
                    otpVerified = false;
                    roleButton.textContent = "Dropdown button";
                    emailInput.readOnly = false; // reset lock bhi kar do fresh submit ke liye
                    emailInput.classList.remove("verified-locked");

                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    }
                })
                .catch(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                    alert("Something went wrong. Please try again.");
                });
            }
        });
</script>
@endsection