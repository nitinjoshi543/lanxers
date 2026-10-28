@extends('freelancer.layouts.main')

@section('main-section')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/css/profile-page.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">

@php
    // ---- Normalize dynamic data (adjust relation/column names to match your models) ----
    $languages   = json_decode($freelancer->languages ?? '{}', true) ?: [];
    $experiences = $experiences ?? collect();
    $skills      = $skills ?? collect();
    $educations  = $educations ?? collect();
    $projects    = $projects ?? collect();
    $socialLinks = $socialLinks ?? collect();
    $preferredTitles    = $preferredTitles ?? collect();
    $preferredLocations = $preferredLocations ?? collect();
    $resume      = $resume ?? null;
    
    $personalDetailsCompleted =
        !empty($freelancer->name) &&
        !empty($freelancer->gender) &&
        !empty($freelancer->profile_photo) &&
        !empty($freelancer->total_experience) &&
        !empty($freelancer->salary) &&
        !empty($freelancer->dob) &&
        !empty($freelancer->city);

    $profileSummaryCompleted = !empty($freelancer->bio);
    $resumeCompleted          = !empty($freelancer->resume);
    $experienceCompleted      = $experiences->isNotEmpty();
    $skillsCompleted          = $skills->isNotEmpty();
    $educationCompleted       = $educations->isNotEmpty();
    $jobPreferencesCompleted =
        $preferredTitles->isNotEmpty() &&
        $preferredLocations->isNotEmpty();
    $projectsCompleted        = $projects->isNotEmpty();
    $socialLinksCompleted     = $socialLinks->isNotEmpty();
    $languagesCompleted       = !empty($languages);

    $profileScore = 0;

    if ($personalDetailsCompleted) $profileScore += 5;
    if ($profileSummaryCompleted) $profileScore += 10;
    if ($resumeCompleted) $profileScore += 25;
    if ($experienceCompleted) $profileScore += 10;
    if ($skillsCompleted) $profileScore += 10;
    if ($educationCompleted) $profileScore += 10;
    if ($jobPreferencesCompleted) $profileScore += 10;
    if ($projectsCompleted) $profileScore += 10;
    if ($socialLinksCompleted) $profileScore += 5;
    if ($languagesCompleted) $profileScore += 5;
    
    updateProfileComplete($profileScore);

@endphp

<section class="profile-user-page">
    <img src="{{ asset('frontend/images/bg-img1.png') }}" class="bg-img1" alt="">
    <img src="{{ asset('frontend/images/bg-img2.png') }}" class="bg-img2" alt="">
    <img src="{{ asset('frontend/images/bg-img3.png') }}" class="bg-img3" alt="">
    
    <div class="profile-inner-box">
        <!-- ===== SIDEBAR ===== -->
        <aside>
            <div class="side-card" id="personaldetails">
                <div class="profile-head">
                    <div class="avatar">
                        <img src="{{ $freelancer->profile_photo ?: 'https://idpdefault.s3.ap-south-1.amazonaws.com/6aa904db5b674.jpg' }}"
                             alt="{{ $freelancer->name }}"
                             onerror="this.onerror=null;this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6aa904db5b674.jpg'">
                    </div>
                    <div class="freenlan-info">
                        <h2>{{ $freelancer->name }}</h2>
                        <div class="role">{{ $freelancer->job_title }}</div>
                        @if($experiences->isNotEmpty())
                            @php $currentExp = $experiences->first(); @endphp
                            <div class="company">{{ $currentExp->company ?? $currentExp->company_name ?? '' }}</div>
                            <div class="duration">
                                {{ \Carbon\Carbon::parse($currentExp->start_date)->format('M Y') }} ·
                                {{ $currentExp->end_date ? \Carbon\Carbon::parse($currentExp->end_date)->format('M Y') : 'Present' }}
                            </div>
                        @endif
                        <div class="city">{{ $freelancer->city ?? $freelancer->state_name }}</div>
                    </div>
                    <button class="edit-btn" type="button" id="editBasicDetailsBtn" data-bs-toggle="modal" data-bs-target="#editModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_4046_4263)">
                                <path d="M14.1161 4.54419C14.4686 4.19181 14.6666 3.71384 14.6667 3.21543C14.6668 2.71702 14.4688 2.239 14.1165 1.88652C13.7641 1.53405 13.2861 1.336 12.7877 1.33594C12.2893 1.33587 11.8113 1.53381 11.4588 1.88619L2.56145 10.7855C2.40667 10.9399 2.29219 11.1299 2.22812 11.3389L1.34745 14.2402C1.33022 14.2978 1.32892 14.3591 1.34369 14.4174C1.35845 14.4758 1.38873 14.529 1.43132 14.5715C1.4739 14.614 1.5272 14.6442 1.58556 14.6589C1.64392 14.6736 1.70516 14.6722 1.76279 14.6549L4.66479 13.7749C4.87357 13.7114 5.06357 13.5976 5.21812 13.4435L14.1161 4.54419Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs><clipPath id="clip0_4046_4263"><rect width="16" height="16" fill="white"/></clipPath></defs>
                        </svg>
                    </button>
                </div>

                <div class="linebar"></div>

                <div class="stats-row">
                    <div>
                        <div class="stat-label">Total exp</div>
                        <div class="stat-value">
                            {{ $freelancer->total_experience ?? 0 }} yrs
                        </div>
                    </div>
                    <div>
                        <div class="stat-label">Salary</div>
                        <div class="stat-value">{{ $freelancer->salary ?? '—' }}</div>
                        <div class="stat-sub">(LPA)</div>
                    </div>
                    <div>
                        <div class="stat-label">Date Of Birth</div>
                        <div class="stat-value">
                            {{ $freelancer->dob
                                ? \Carbon\Carbon::parse($freelancer->dob)->format('d M Y')
                                : '—'
                            }}
                        </div>
                    </div>
                </div>

                <div class="linebar"></div>

                <div class="updated-line">
                    <span class="dot"></span> Profile last updated on:
                    {{ $freelancer->updated_at ? \Carbon\Carbon::parse($freelancer->updated_at)->format('d M, Y') : '—' }}
                </div>

                <div class="contact-line">
                    <div class="sapdiv">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M14.6665 11.2827V13.2827C14.6672 13.4683 14.6292 13.6521 14.5548 13.8222C14.4804 13.9924 14.3713 14.1451 14.2345 14.2706C14.0977 14.3961 13.9362 14.4917 13.7603 14.5511C13.5844 14.6106 13.398 14.6327 13.2131 14.616C11.1617 14.3931 9.19113 13.6921 7.45979 12.5693C5.84901 11.5458 4.48335 10.1801 3.45979 8.56934C2.33311 6.83014 1.63195 4.85 1.41313 2.78934C1.39647 2.60498 1.41838 2.41918 1.47746 2.24375C1.53654 2.06833 1.63151 1.90713 1.7563 1.77042C1.8811 1.6337 2.033 1.52448 2.20232 1.44968C2.37164 1.37489 2.55469 1.33618 2.73979 1.336H4.73979C5.06333 1.33282 5.37699 1.44739 5.6223 1.65836C5.86761 1.86933 6.02784 2.1623 6.07313 2.48267C6.15754 3.12271 6.31409 3.75115 6.53979 4.356C6.62949 4.59462 6.6489 4.85395 6.59573 5.10326C6.54256 5.35257 6.41903 5.58141 6.23979 5.76267L5.39313 6.60934C6.34216 8.27837 7.7241 9.6603 9.39313 10.6093L10.2398 9.76267C10.4211 9.58343 10.6499 9.4599 10.8992 9.40673C11.1485 9.35356 11.4078 9.37297 11.6465 9.46267C12.2513 9.68837 12.8797 9.84492 13.5198 9.92934C13.8436 9.97502 14.1394 10.1381 14.3508 10.3877C14.5622 10.6372 14.6746 10.9557 14.6665 11.2827Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ $freelancer->phone }}</span>
                    </div>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#contactModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_4046_4263b)">
                                <path d="M14.1161 4.54419C14.4686 4.19181 14.6666 3.71384 14.6667 3.21543C14.6668 2.71702 14.4688 2.239 14.1165 1.88652C13.7641 1.53405 13.2861 1.336 12.7877 1.33594C12.2893 1.33587 11.8113 1.53381 11.4588 1.88619L2.56145 10.7855C2.40667 10.9399 2.29219 11.1299 2.22812 11.3389L1.34745 14.2402C1.33022 14.2978 1.32892 14.3591 1.34369 14.4174C1.35845 14.4758 1.38873 14.529 1.43132 14.5715C1.4739 14.614 1.5272 14.6442 1.58556 14.6589C1.64392 14.6736 1.70516 14.6722 1.76279 14.6549L4.66479 13.7749C4.87357 13.7114 5.06357 13.5976 5.21812 13.4435L14.1161 4.54419Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs><clipPath id="clip0_4046_4263b"><rect width="16" height="16" fill="white"/></clipPath></defs>
                        </svg>
                    </button>
                </div>

                <div class="contact-line">
                    <div class="sapdiv">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M13.3335 2.66406H2.66683C1.93045 2.66406 1.3335 3.26102 1.3335 3.9974V11.9974C1.3335 12.7338 1.93045 13.3307 2.66683 13.3307H13.3335C14.0699 13.3307 14.6668 12.7338 14.6668 11.9974V3.9974C14.6668 3.26102 14.0699 2.66406 13.3335 2.66406Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.6668 4.66406L8.68683 8.46406C8.48101 8.59301 8.24304 8.6614 8.00016 8.6614C7.75728 8.6614 7.51931 8.59301 7.3135 8.46406L1.3335 4.66406" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ $freelancer->email }}</span>
                    </div>
                </div>

                <button class="profile-score" data-bs-toggle="modal" data-bs-target="#profileScore">
                    <p><strong>{{ $profileScore }}%</strong> of your Profile has been completed !</p>
                </button>
            </div>

            <div class="side-card desk-none">
                <div class="score-card">
                    <div class="score-ring">{{ $profileScore }}%</div>
                    <div>
                        <h3>Profile score</h3>
                        <p>Recruiters seek 100% profiles - complete yours to stand out!</p>
                    </div>
                </div>

                <div class="pending-title">Pending action</div>

                @php                        
                    $pendingActions = [
                        ['anchor' => 'personaldetails', 'label' => 'Personal details', 'weight' => 5,  'done' => $personalDetailsCompleted],
                        ['anchor' => 'profilesummary',  'label' => 'Profile Summary',  'weight' => 10, 'done' => $profileSummaryCompleted],
                        ['anchor' => 'resume',          'label' => 'Resume',           'weight' => 25, 'done' => $resumeCompleted],
                        ['anchor' => 'workexperience',  'label' => 'Work experience',  'weight' => 10, 'done' => $experienceCompleted],
                        ['anchor' => 'skills',          'label' => 'Skills',           'weight' => 10, 'done' => $skillsCompleted],
                        ['anchor' => 'education',       'label' => 'Education',        'weight' => 10, 'done' => $educationCompleted],
                        ['anchor' => 'jobpreferences',  'label' => 'Job Preferences',  'weight' => 10, 'done' => $jobPreferencesCompleted],
                        ['anchor' => 'projects',        'label' => 'Projects',         'weight' => 10, 'done' => $projectsCompleted],
                        ['anchor' => 'sociallinks',     'label' => 'Social Links',     'weight' => 5,  'done' => $socialLinksCompleted],
                        ['anchor' => 'languages',       'label' => 'Languages',        'weight' => 5,  'done' => $languagesCompleted],
                    ];
                @endphp

                @foreach($pendingActions as $action)
                    @if(!$action['done'])
                    <a href="#{{ $action['anchor'] }}">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ $action['label'] }}
                            </div>
                            <span class="badge">+{{ $action['weight'] }}%</span>
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
        </aside>
        <!-- ===== SIDEBAR ===== -->

        <div class="aside-right-box">
            <div class="navtabs">
                <a href="#profilesummary" class="active">Profile summary</a>
                <a href="#resume">Resume</a>
                <a href="#workexperience">Work experience</a>
                <a href="#skills">Skills</a>
                <a href="#education">Education</a>
                <a href="#jobpreferences">Job preferences</a>
                <a href="#projects">Projects</a>
                <a href="#sociallinks">Social Links</a>
                <a href="#languages">Languages</a>
            </div>

            <!-- Profile summary -->
            <div class="profile-summary" id="profilesummary">
                <div class="card-head">
                    <h3>Profile summary</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#profileSummaryModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_ps)">
                                <path d="M14.1161 4.54419C14.4686 4.19181 14.6666 3.71384 14.6667 3.21543C14.6668 2.71702 14.4688 2.239 14.1165 1.88652C13.7641 1.53405 13.2861 1.336 12.7877 1.33594C12.2893 1.33587 11.8113 1.53381 11.4588 1.88619L2.56145 10.7855C2.40667 10.9399 2.29219 11.1299 2.22812 11.3389L1.34745 14.2402C1.33022 14.2978 1.32892 14.3591 1.34369 14.4174C1.35845 14.4758 1.38873 14.529 1.43132 14.5715C1.4739 14.614 1.5272 14.6442 1.58556 14.6589C1.64392 14.6736 1.70516 14.6722 1.76279 14.6549L4.66479 13.7749C4.87357 13.7114 5.06357 13.5976 5.21812 13.4435L14.1161 4.54419Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs><clipPath id="clip0_ps"><rect width="16" height="16" fill="white"/></clipPath></defs>
                        </svg>
                    </button>
                </div>
                <p class="summary-text">
                    {{ $freelancer->bio ?? 'No profile summary added yet.' }}
                </p>
                <!--<button class="ai-btn" type="button" data-bs-toggle="modal" data-bs-target="#aiSummaryModal">-->
                <!--    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">-->
                <!--        <g clip-path="url(#clip0_ai)">-->
                <!--            <path d="M6.62479 10.3361C6.56527 10.1054 6.44502 9.89484 6.27653 9.72636C6.10805 9.55788 5.8975 9.43762 5.66679 9.3781L1.57679 8.32344C1.50701 8.30363 1.4456 8.26161 1.40186 8.20373C1.35813 8.14586 1.33447 8.07531 1.33447 8.00277C1.33447 7.93024 1.35813 7.85968 1.40186 7.80181C1.4456 7.74394 1.50701 7.70191 1.57679 7.6821L5.66679 6.62677C5.89742 6.56731 6.10792 6.44715 6.27639 6.2788C6.44486 6.11044 6.56517 5.90003 6.62479 5.66944L7.67946 1.57944C7.69906 1.50938 7.74105 1.44766 7.799 1.4037C7.85696 1.35974 7.92771 1.33594 8.00046 1.33594C8.0732 1.33594 8.14395 1.35974 8.20191 1.4037C8.25987 1.44766 8.30185 1.50938 8.32146 1.57944L9.37546 5.66944C9.43497 5.90015 9.55523 6.1107 9.72371 6.27918C9.89219 6.44766 10.1027 6.56792 10.3335 6.62744L14.4235 7.68144C14.4938 7.70084 14.5558 7.74278 14.6 7.80082C14.6442 7.85887 14.6682 7.92981 14.6682 8.00277C14.6682 8.07573 14.6442 8.14667 14.6 8.20472C14.5558 8.26276 14.4938 8.3047 14.4235 8.3241L10.3335 9.3781C10.1027 9.43762 9.89219 9.55788 9.72371 9.72636C9.55523 9.89484 9.43497 10.1054 9.37546 10.3361L8.32079 14.4261C8.30118 14.4962 8.2592 14.5579 8.20124 14.6018C8.14328 14.6458 8.07254 14.6696 7.99979 14.6696C7.92704 14.6696 7.85629 14.6458 7.79834 14.6018C7.74038 14.5579 7.69839 14.4962 7.67879 14.4261L6.62479 10.3361Z" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
                <!--            <path d="M13.3335 2V4.66667" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
                <!--            <path d="M14.6667 3.33594H12" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
                <!--            <path d="M2.6665 11.3359V12.6693" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
                <!--            <path d="M3.33333 12H2" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
                <!--        </g>-->
                <!--        <defs><clipPath id="clip0_ai"><rect width="16" height="16" fill="white"/></clipPath></defs>-->
                <!--    </svg>-->
                <!--    Generate by AI-->
                <!--</button>-->
            </div>

            <!-- Resume -->
            <div class="profile-summary" id="resume">
                <div class="card-head">
                    <h3>Resume</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#UploadResumeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                @if($freelancer->resume)
                <div class="resume-row" id="resumeRow">
                    <div class="info-row">
                        <span class="pdf-badge">PDF</span>
                        <span class="name">Resume</span>
                    </div>
                    <div class="button-doc">
                        <a href="{{ $freelancer->resume }}" class="eye-btn" title="Eye document" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10Z" fill="#00A148"/>
                                <path d="M15.4698 7.83C14.8817 6.30882 13.8608 4.99331 12.5332 4.04604C11.2056 3.09878 9.62953 2.56129 7.99979 2.5C6.37005 2.56129 4.79398 3.09878 3.46639 4.04604C2.1388 4.99331 1.11787 6.30882 0.529787 7.83C0.490071 7.93985 0.490071 8.06015 0.529787 8.17C1.11787 9.69118 2.1388 11.0067 3.46639 11.954C4.79398 12.9012 6.37005 13.4387 7.99979 13.5C9.62953 13.4387 11.2056 12.9012 12.5332 11.954C13.8608 11.0067 14.8817 9.69118 15.4698 8.17C15.5095 8.06015 15.5095 7.93985 15.4698 7.83ZM7.99979 11.25C7.357 11.25 6.72864 11.0594 6.19418 10.7023C5.65972 10.3452 5.24316 9.83758 4.99718 9.24372C4.75119 8.64986 4.68683 7.99639 4.81224 7.36596C4.93764 6.73552 5.24717 6.15642 5.70169 5.7019C6.15621 5.24738 6.73531 4.93785 7.36574 4.81245C7.99618 4.68705 8.64965 4.75141 9.24351 4.99739C9.83737 5.24338 10.3449 5.65994 10.7021 6.1944C11.0592 6.72886 11.2498 7.35721 11.2498 8C11.2485 8.86155 10.9056 9.68743 10.2964 10.2966C9.68722 10.9058 8.86133 11.2487 7.99979 11.25Z" fill="#00A148"/>
                            </svg>
                        </a>

                        <button type="button" class="deleted-btn" id="deleteResumeBtn" data-id="{{ $freelancer->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M2 4H14" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12.6663 4V13.3333C12.6663 14 11.9997 14.6667 11.333 14.6667H4.66634C3.99967 14.6667 3.33301 14 3.33301 13.3333V4" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.33301 4.0026V2.66927C5.33301 2.0026 5.99967 1.33594 6.66634 1.33594H9.33301C9.99967 1.33594 10.6663 2.0026 10.6663 2.66927V4.0026" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.66699 7.33594V11.3359" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.33301 7.33594V11.3359" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @else
                <p class="empty-text">No resume uploaded yet.</p>
                @endif
            </div>

            <!-- Work experience -->
            <div class="profile-summary" id="workexperience">
                <div class="card-head">
                    <h3>Work experience</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                @if($experiences->isNotEmpty())
                    @php
                        $earliest = $experiences->min(fn($e) => \Carbon\Carbon::parse($e->start_date)->timestamp);
                        $latest   = $experiences->max(fn($e) => $e->end_date ? \Carbon\Carbon::parse($e->end_date)->timestamp : now()->timestamp);
                        $span     = max($latest - $earliest, 1);
                    @endphp

                    <div class="timeline-labels">
                        @foreach($experiences as $exp)
                            @php $pos = round((\Carbon\Carbon::parse($exp->start_date)->timestamp - $earliest) / $span * 100); @endphp
                            <span style="left: {{ $pos }}%;">{{ \Carbon\Carbon::parse($exp->start_date)->format("M 'y") }}</span>
                        @endforeach
                        <span style="left: 100%;">Till date</span>
                    </div>

                    <div class="timeline-bar">
                        @foreach($experiences as $exp)
                            @php $pos = round((\Carbon\Carbon::parse($exp->start_date)->timestamp - $earliest) / $span * 100); @endphp
                            <span class="node" style="left: {{ $pos }}%;"></span>
                        @endforeach
                        <span class="node" style="left: 100%;"></span>
                    </div>

                    @foreach($experiences as $experience)
                    <div class="exp-item">
                        <div class="exp-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <g clip-path="url(#clip0_exp{{ $loop->index }})">
                                    <path d="M3.75 13.75V2.5C3.75 2.16848 3.8817 1.85054 4.11612 1.61612C4.35054 1.3817 4.66848 1.25 5 1.25H10C10.3315 1.25 10.6495 1.3817 10.8839 1.61612C11.1183 1.85054 11.25 2.16848 11.25 2.5V13.75H3.75Z" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.75 7.5H2.5C2.16848 7.5 1.85054 7.6317 1.61612 7.86612C1.3817 8.10054 1.25 8.41848 1.25 8.75V12.5C1.25 12.8315 1.3817 13.1495 1.61612 13.3839C1.85054 13.6183 2.16848 13.75 2.5 13.75H3.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.25 5.625H12.5C12.8315 5.625 13.1495 5.7567 13.3839 5.99112C13.6183 6.22554 13.75 6.54348 13.75 6.875V12.5C13.75 12.8315 13.6183 13.1495 13.3839 13.3839C13.1495 13.6183 12.8315 13.75 12.5 13.75H11.25" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.25 3.75H8.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.25 6.25H8.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.25 8.75H8.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.25 11.25H8.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs><clipPath id="clip0_exp{{ $loop->index }}"><rect width="15" height="15" fill="white"/></clipPath></defs>
                            </svg>
                        </div>
                        <div>
                            <div class="role">{{ $experience->company ?? $experience->company_name ?? '' }}</div>
                            <div class="role">{{ $experience->position }}
                                <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addExperienceModal" data-experience-id="{{ $experience->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_expedit{{ $loop->index }})">
                                            <path d="M14.1161 4.54419C14.4686 4.19181 14.6666 3.71384 14.6667 3.21543C14.6668 2.71702 14.4688 2.239 14.1165 1.88652C13.7641 1.53405 13.2861 1.336 12.7877 1.33594C12.2893 1.33587 11.8113 1.53381 11.4588 1.88619L2.56145 10.7855C2.40667 10.9399 2.29219 11.1299 2.22812 11.3389L1.34745 14.2402C1.33022 14.2978 1.32892 14.3591 1.34369 14.4174C1.35845 14.4758 1.38873 14.529 1.43132 14.5715C1.4739 14.614 1.5272 14.6442 1.58556 14.6589C1.64392 14.6736 1.70516 14.6722 1.76279 14.6549L4.66479 13.7749C4.87357 13.7114 5.06357 13.5976 5.21812 13.4435L14.1161 4.54419Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs><clipPath id="clip0_expedit{{ $loop->index }}"><rect width="16" height="16" fill="white"/></clipPath></defs>
                                    </svg>
                                </button>
                            </div>
                            <div class="des">
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} -
                                {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                                @if($experience->employment_type) · {{ $experience->employment_type }} @endif
                                @if($experience->industry) Industry: {{ $experience->industry }} @endif
                                @if($experience->salary) Salary: {{ $experience->salary }} @endif
                                @if($experience->notice_period) Notice Period: {{ $experience->notice_period }} @endif
                            </div>
                            @if($experience->description)
                            <div class="note experience-description">{{ $experience->description }}</div>
                            <button type="button" class="see-more-btn">See More</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                <p class="empty-text">No Experience Found. You haven't added any experience.</p>
                <!-- <div class="content">
                    <div class="images">
                        <img src="{{ asset('frontend/images/no-recent-job.png') }}" alt="">
                    </div>
                    <div class="text">
                        <h4>No Experience Found</h4>
                        <p>You haven't added any experience.</p>
                    </div>
                </div> -->
                @endif
            </div>

            <!-- Skills -->
            <div class="profile-summary" id="skills">
                <div class="card-head">
                    <h3>Skills</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addSkillsModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div class="chip-row">
                    @forelse($skills as $skill)
                        <span class="chip">{{ $skill->name }}</span>
                    @empty
                        <p class="empty-text">No skills added yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Education -->
            <div class="profile-summary" id="education">
                <div class="card-head">
                    <h3>Education</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                @forelse($educations as $education)
                <div class="edu-item">
                    <span class="edu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M16.0651 8.19177C16.1994 8.13254 16.3133 8.03522 16.3928 7.91187C16.4723 7.78852 16.5139 7.64456 16.5123 7.49782C16.5108 7.35108 16.4663 7.20801 16.3843 7.08633C16.3022 6.96465 16.1863 6.86971 16.0508 6.81327L9.62259 3.88527C9.42717 3.79613 9.21488 3.75 9.00009 3.75C8.7853 3.75 8.57301 3.79613 8.37759 3.88527L1.95009 6.81027C1.81657 6.86875 1.70298 6.96487 1.62322 7.08688C1.54346 7.20889 1.50098 7.3515 1.50098 7.49727C1.50098 7.64304 1.54346 7.78565 1.62322 7.90766C1.70298 8.02967 1.81657 8.12579 1.95009 8.18427L8.37759 11.1153C8.57301 11.2044 8.7853 11.2505 9.00009 11.2505C9.21488 11.2505 9.42717 11.2044 9.62259 11.1153L16.0651 8.19177Z" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16.5 7.5V12" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.5 9.375V12C4.5 12.5967 4.97411 13.169 5.81802 13.591C6.66193 14.0129 7.80653 14.25 9 14.25C10.1935 14.25 11.3381 14.0129 12.182 13.591C13.0259 13.169 13.5 12.5967 13.5 12V9.375" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <h4>{{ $education->degree ?? '' }}
                            <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addEducationModal" data-education-id="{{ $education->id ?? '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M14.1156 4.54419C14.4681 4.19181 14.6662 3.71384 14.6662 3.21543C14.6663 2.71702 14.4683 2.239 14.116 1.88652C13.7636 1.53405 13.2856 1.336 12.7872 1.33594C12.2888 1.33587 11.8108 1.53381 11.4583 1.88619L2.56096 10.7855C2.40618 10.9399 2.29171 11.1299 2.22763 11.3389L1.34696 14.2402C1.32973 14.2978 1.32843 14.3591 1.3432 14.4174C1.35796 14.4758 1.38824 14.529 1.43083 14.5715C1.47341 14.614 1.52671 14.6442 1.58507 14.6589C1.64343 14.6736 1.70467 14.6722 1.7623 14.6549L4.6643 13.7749C4.87308 13.7114 5.06308 13.5976 5.21763 13.4435L14.1156 4.54419Z" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </h4>
                        <div class="school">{{ $education->institute ?? '' }}</div>
                        <div class="year">
                            {{ $education->passing_year ?? '' }}

                            @if($education->education_type)
                                · {{ $education->education_type }}
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p class="empty-text">No education added yet.</p>
                @endforelse
            </div>

            <!-- Job Preferences -->
            <div class="profile-summary" id="jobpreferences">
                <div class="card-head">
                    <h3>Job Preferences</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#jobPreferenceModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M14.1156 4.54419C14.4681 4.19181 14.6662 3.71384 14.6662 3.21543C14.6663 2.71702 14.4683 2.239 14.116 1.88652C13.7636 1.53405 13.2856 1.336 12.7872 1.33594C12.2888 1.33587 11.8108 1.53381 11.4583 1.88619L2.56096 10.7855C2.40618 10.9399 2.29171 11.1299 2.22763 11.3389L1.34696 14.2402C1.32973 14.2978 1.32843 14.3591 1.3432 14.4174C1.35796 14.4758 1.38824 14.529 1.43083 14.5715C1.47341 14.614 1.52671 14.6442 1.58507 14.6589C1.64343 14.6736 1.70467 14.6722 1.7623 14.6549L4.6643 13.7749C4.87308 13.7114 5.06308 13.5976 5.21763 13.4435L14.1156 4.54419Z" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div class="pref-grid">
                    <div>
                        <div class="label">Preferred Job Title</div>
                        <div class="value">
                            {{ $preferredTitles->isNotEmpty() ? $preferredTitles->pluck('title')->implode(', ') : '—' }}
                        </div>
                    </div>
                    <div>
                        <div class="label">Preferred Location</div>
                        <div class="value">
                            {{ $preferredLocations->isNotEmpty() ? $preferredLocations->pluck('location')->implode(', ') : '—' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects -->
            <div class="profile-summary" id="projects">
                <div class="card-head">
                    <h3>Projects</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                @forelse($projects as $project)
                <div class="project-block">
                    <div class="p-head">
                        <h4>{{ $project->title ?? '' }}</h4>
                        <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addProjectModal" data-project-id="{{ $project->id ?? '' }}" data-project-title="{{ $project->title }}" data-project-description="{{ $project->description }}">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.1156 4.54419C14.4681 4.19181 14.6662 3.71384 14.6662 3.21543C14.6663 2.71702 14.4683 2.239 14.116 1.88652C13.7636 1.53405 13.2856 1.336 12.7872 1.33594C12.2888 1.33587 11.8108 1.53381 11.4583 1.88619L2.56096 10.7855C2.40618 10.9399 2.29171 11.1299 2.22763 11.3389L1.34696 14.2402C1.32973 14.2978 1.32843 14.3591 1.3432 14.4174C1.35796 14.4758 1.38824 14.529 1.43083 14.5715C1.47341 14.614 1.52671 14.6442 1.58507 14.6589C1.64343 14.6736 1.70467 14.6722 1.7623 14.6549L4.6643 13.7749C4.87308 13.7114 5.06308 13.5976 5.21763 13.4435L14.1156 4.54419Z" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                    </div>
                    <p>{!! nl2br(e($project->description ?? '')) !!}</p>
                </div>
                @empty
                <p class="empty-text">No projects added yet.</p>
                @endforelse
            </div>

            <!-- Social Links -->
            <div class="profile-summary" id="sociallinks">
                <div class="card-head">
                    <h3>Social Links</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addSocialModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="social-box">
                    @forelse($socialLinks as $link)
                        @php $platform = strtolower($link->platform ?? ''); @endphp
                        @if($platform === 'linkedin')
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="social-item">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M16 8C17.5913 8 19.1174 8.63214 20.2426 9.75736C21.3679 10.8826 22 12.4087 22 14V21H18V14C18 13.4696 17.7893 12.9609 17.4142 12.5858C17.0391 12.2107 16.5304 12 16 12C15.4696 12 14.9609 12.2107 14.5858 12.5858C14.2107 12.9609 14 13.4696 14 14V21H10V14C10 12.4087 10.6321 10.8826 11.7574 9.75736C12.8826 8.63214 14.4087 8 16 8Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6 9H2V21H6V9Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M4 6C5.10457 6 6 5.10457 6 4C6 2.89543 5.10457 2 4 2C2.89543 2 2 2.89543 2 4C2 5.10457 2.89543 6 4 6Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    
                                    <span>Linkedin</span> 
                                </div>
                            </a>
                        @elseif($platform === 'facebook')
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="social-item">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <g clip-path="url(#clip0_4060_6132)">
                                                <path d="M10.0219 23.8781C4.32188 22.8609 0 17.9391 0 12C0 5.4 5.4 0 12 0C18.6 0 24 5.4 24 12C24 17.9391 19.6781 22.8609 13.9781 23.8781L13.3172 23.3391H10.6781L10.0219 23.8781Z" fill="#0866FF" />
                                                <path d="M16.6783 15.3578L17.2174 11.9969H14.0393V9.65781C14.0393 8.69688 14.4002 7.97969 15.8393 7.97969H17.4002V4.91875C16.5611 4.79687 15.6002 4.67969 14.7611 4.67969C12.0002 4.67969 10.083 6.35781 10.083 9.35781V11.9969H7.08301V15.3578H10.083V23.8188C10.7439 23.9406 11.4049 23.9969 12.0611 23.9969C12.7221 23.9969 13.383 23.9359 14.0393 23.8188V15.3578H16.6783Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_4060_6132">
                                                    <rect width="24" height="24" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    
                                    <span>Facebook</span> 
                                </div>
                            </a>
                        @elseif($platform === 'instagram')
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="social-item">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <g clip-path="url(#clip0_4060_6126)">
                                                <path d="M18.375 0H5.625C2.5184 0 0 2.5184 0 5.625V18.375C0 21.4816 2.5184 24 5.625 24H18.375C21.4816 24 24 21.4816 24 18.375V5.625C24 2.5184 21.4816 0 18.375 0Z" fill="url(#paint0_radial_4060_6126)" />
                                                <path d="M18.375 0H5.625C2.5184 0 0 2.5184 0 5.625V18.375C0 21.4816 2.5184 24 5.625 24H18.375C21.4816 24 24 21.4816 24 18.375V5.625C24 2.5184 21.4816 0 18.375 0Z" fill="url(#paint1_radial_4060_6126)" />
                                                <path d="M12.0008 2.625C9.45478 2.625 9.13519 2.63616 8.13525 2.68163C7.13719 2.72738 6.45591 2.88534 5.85984 3.11719C5.24316 3.35662 4.72013 3.67697 4.19906 4.19822C3.67753 4.71937 3.35719 5.24241 3.117 5.85881C2.8845 6.45506 2.72634 7.13662 2.68144 8.13422C2.63672 9.13425 2.625 9.45394 2.625 12.0001C2.625 14.5463 2.63625 14.8648 2.68163 15.8647C2.72756 16.8628 2.88553 17.5441 3.11719 18.1402C3.35681 18.7568 3.67716 19.2799 4.19841 19.8009C4.71938 20.3225 5.24241 20.6436 5.85862 20.883C6.45516 21.1148 7.13653 21.2728 8.13441 21.3186C9.13444 21.364 9.45375 21.3752 11.9997 21.3752C14.5461 21.3752 14.8646 21.364 15.8646 21.3186C16.8626 21.2728 17.5447 21.1148 18.1412 20.883C18.7576 20.6436 19.2799 20.3225 19.8007 19.8009C20.3223 19.2799 20.6425 18.7568 20.8828 18.1404C21.1133 17.5441 21.2715 16.8626 21.3184 15.8649C21.3633 14.865 21.375 14.5463 21.375 12.0001C21.375 9.45394 21.3633 9.13444 21.3184 8.13441C21.2715 7.13634 21.1133 6.45516 20.8828 5.85909C20.6425 5.24241 20.3223 4.71937 19.8007 4.19822C19.2793 3.67678 18.7578 3.35644 18.1406 3.11728C17.543 2.88534 16.8613 2.72728 15.8632 2.68163C14.8632 2.63616 14.5448 2.625 11.9979 2.625H12.0008ZM11.1598 4.31447C11.4095 4.31409 11.688 4.31447 12.0008 4.31447C14.5041 4.31447 14.8007 4.32347 15.7892 4.36838C16.7032 4.41019 17.1994 4.56291 17.5298 4.69125C17.9674 4.86112 18.2793 5.06428 18.6072 5.3925C18.9353 5.72062 19.1384 6.03309 19.3088 6.47062C19.4371 6.80062 19.59 7.29675 19.6316 8.21081C19.6765 9.19913 19.6863 9.49594 19.6863 11.9979C19.6863 14.4999 19.6765 14.7968 19.6316 15.7851C19.5898 16.6991 19.4371 17.1952 19.3088 17.5253C19.1389 17.9629 18.9353 18.2744 18.6072 18.6023C18.2791 18.9305 17.9676 19.1335 17.5298 19.3035C17.1997 19.4324 16.7032 19.5848 15.7892 19.6266C14.8009 19.6715 14.5041 19.6812 12.0008 19.6812C9.49753 19.6812 9.20081 19.6715 8.21259 19.6266C7.29853 19.5844 6.80241 19.4317 6.47166 19.3033C6.03422 19.1333 5.72166 18.9303 5.39353 18.6022C5.06541 18.274 4.86234 17.9623 4.692 17.5246C4.56366 17.1945 4.41075 16.6984 4.36913 15.7843C4.32422 14.796 4.31522 14.4992 4.31522 11.9956C4.31522 9.492 4.32422 9.19678 4.36913 8.20847C4.41094 7.29441 4.56366 6.79828 4.692 6.46781C4.86197 6.03028 5.06541 5.71781 5.39363 5.38969C5.72184 5.06156 6.03422 4.85841 6.47175 4.68816C6.80222 4.55925 7.29853 4.40691 8.21259 4.36491C9.07744 4.32581 9.41259 4.31409 11.1598 4.31212V4.31447ZM17.0052 5.87109C16.3841 5.87109 15.8802 6.37453 15.8802 6.99572C15.8802 7.61681 16.3841 8.12072 17.0052 8.12072C17.6263 8.12072 18.1302 7.61681 18.1302 6.99572C18.1302 6.37463 17.6263 5.87072 17.0052 5.87072V5.87109ZM12.0008 7.18556C9.34209 7.18556 7.18641 9.34125 7.18641 12.0001C7.18641 14.6589 9.34209 16.8136 12.0008 16.8136C14.6597 16.8136 16.8146 14.6589 16.8146 12.0001C16.8146 9.34134 14.6595 7.18556 12.0007 7.18556H12.0008ZM12.0008 8.87503C13.7267 8.87503 15.1259 10.2741 15.1259 12.0001C15.1259 13.7259 13.7267 15.1252 12.0008 15.1252C10.275 15.1252 8.87588 13.7259 8.87588 12.0001C8.87588 10.2741 10.2749 8.87503 12.0008 8.87503Z" fill="white" />
                                            </g>
                                            <defs>
                                                <radialGradient id="paint0_radial_4060_6126" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(6.375 25.8485) rotate(-90) scale(23.7858 22.1227)">
                                                    <stop stop-color="#FFDD55" />
                                                    <stop offset="0.1" stop-color="#FFDD55" />
                                                    <stop offset="0.5" stop-color="#FF543E" />
                                                    <stop offset="1" stop-color="#C837AB" />
                                                </radialGradient>
                                                <radialGradient id="paint1_radial_4060_6126" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(-4.02008 1.7289) rotate(78.68) scale(10.6324 43.827)">
                                                    <stop stop-color="#3771C8" />
                                                    <stop offset="0.128" stop-color="#3771C8" />
                                                    <stop offset="1" stop-color="#6600FF" stop-opacity="0" />
                                                </radialGradient>
                                                <clipPath id="clip0_4060_6126">
                                                    <rect width="24" height="24" fill="white" />
                                                </clipPath>
                                            </defs>
                                    </svg>
                                    </span>
                                    
                                    <span>Instagram</span> 
                                </div>
                            </a>
                        @elseif($platform === 'twitter' || $platform === 'x')
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="social-item">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <g clip-path="url(#clip0_4320_14479)">
                                                <mask id="mask0_4320_14479" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                                                    <path d="M0 0H14V14H0V0Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_4320_14479)">
                                                    <path d="M11.025 0.65625H13.172L8.482 6.03025L14 13.3442H9.68L6.294 8.90925L2.424 13.3442H0.275L5.291 7.59425L0 0.65725H4.43L7.486 4.71025L11.025 0.65625ZM10.27 12.0562H11.46L3.78 1.87725H2.504L10.27 12.0562Z" fill="black" />
                                                </g>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_4320_14479">
                                                    <rect width="14" height="14" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    
                                    <span>X</span> 
                                </div>
                            </a>
                        @endif
                        @empty
                        <p class="empty-text">No social links added yet.</p>
                    @endforelse
                </div>
                
            </div>

            <!-- Languages -->
            <div class="profile-summary" id="languages">
                <div class="card-head">
                    <h3>Languages</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addLanguageModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div class="lang-grid">
                    @forelse($languages as $lang => $level)
                    <div class="lang-card">
                        <div class="name">{{ ucfirst($lang) }}</div>
                        <div class="level">{{ ucfirst($level) }}</div>
                        <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addLanguageModal" data-language="{{ $lang }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                <g clip-path="url(#clip0_lang{{ $loop->index }})">
                                    <path d="M11.4694 3.69264C11.7558 3.40633 11.9167 3.01798 11.9167 2.61302C11.9168 2.20807 11.756 1.81967 11.4696 1.53329C11.1833 1.24691 10.795 1.08599 10.39 1.08594C9.98507 1.08589 9.59668 1.24671 9.31029 1.53302L2.08121 8.76373C1.95545 8.88912 1.86244 9.04352 1.81038 9.21331L1.09484 11.5706C1.08084 11.6175 1.07978 11.6672 1.09178 11.7146C1.10377 11.762 1.12838 11.8053 1.16298 11.8399C1.19757 11.8744 1.24088 11.8989 1.2883 11.9109C1.33571 11.9228 1.38547 11.9216 1.43229 11.9076L3.79017 11.1926C3.9598 11.141 4.11418 11.0485 4.23975 10.9234L11.4694 3.69264Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.125 2.71094L10.2917 4.8776" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs><clipPath id="clip0_lang{{ $loop->index }}"><rect width="13" height="13" fill="white"/></clipPath></defs>
                            </svg>
                        </button>
                    </div>
                    @empty
                    <p class="empty-text">No languages added yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!----- profile-score Popup ----->
<div class="modal bottom-sheet fade" id="profileScore" tabindex="-1" aria-labelledby="profileScoreModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered profile-card">
        <div class="modal-content modal-content1">
            <div class="modal-body">
                <div class="side-card">
                    <h3>Profile score</h3>
                    <p>Recruiters seek 100% profiles - complete yours to stand out!</p>
                    <div class="pending-title">Pending action</div>

                    @foreach($pendingActions as $action)
                        @if(!$action['done'])
                        <a href="#{{ $action['anchor'] }}">
                            <div class="pending-item">
                                <div class="left">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ $action['label'] }}
                                </div>
                                <span class="badge">+{{ $action['weight'] }}%</span>
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

        

<!----- jobPostModal Popup-------->
    <div class="modal fade" id="profileuploaddocumentmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content1">

                <div class="modal-body">
                    <div class="profileuploaddocumentmodalwrapper">
                        <div class="letget">
                            <img src="{{ asset('frontend/images/image 82.png')}}" alt="image 82" />
                            Complete your Profile !
                        </div>
                        <h1>Let’s<span> Understand you better !</span></h1>

                        <p>Upload your resume to automatically populate your profile with AI-powered data extraction, or complete your profile manually at your own pace. Your information is securely processed and can be reviewed before saving.</p>


                        <div class="job-row">
                            <div class="job-card">
                                <div class="icon-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">
                                        <path d="M25.6673 44.3307H30.334V34.5891L34.0673 38.3224L37.334 34.9974L28.0007 25.6641L18.6673 34.9974L21.9923 38.2641L25.6673 34.5891V44.3307ZM14.0007 51.3307C12.7173 51.3307 11.6191 50.8742 10.706 49.9611C9.79287 49.048 9.33554 47.949 9.33398 46.6641V9.33073C9.33398 8.0474 9.79132 6.94917 10.706 6.03606C11.6207 5.12295 12.7189 4.66562 14.0007 4.66406H32.6673L46.6673 18.6641V46.6641C46.6673 47.9474 46.2108 49.0464 45.2976 49.9611C44.3845 50.8757 43.2855 51.3323 42.0006 51.3307H14.0007ZM30.334 20.9974V9.33073H14.0007V46.6641H42.0006V20.9974H30.334Z" fill="#00A148"/>
                                    </svg>
                                </div>
                                <h2>Upload Documents</h2>
                                <p class="desc">We’ll Fill the details for you.</p>
                                <ul class="feature-list">
                                    <li>
                                        <span class="check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        Upload your resume or Document.
                                    </li>

                                    <li>
                                        <span class="check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        Our Ai will extract the information.
                                    </li>


                                    <li>
                                        <span class="check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        Save time and effort.
                                    </li>

                                </ul>
                                <div class="resume-upload1">
                                    <label class="change-photo-btn1" id="resumeBtn">
                                        Upload Document
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M4.86506 8.44531C3.0305 8.8816 1.66602 10.531 1.66602 12.4991C1.66602 14.8002 3.53149 16.6657 5.83268 16.6657C6.22743 16.6657 6.60935 16.6109 6.97122 16.5083" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.0222 8.44531C16.8568 8.8816 18.2212 10.531 18.2212 12.4991C18.2212 14.8002 16.3558 16.6657 14.0546 16.6657C13.6598 16.6657 13.2779 16.6109 12.916 16.5083" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15 8.33594C15 5.57452 12.7614 3.33594 10 3.33594C7.23858 3.33594 5 5.57452 5 8.33594" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.10938 11.6177L9.99875 8.71875L12.9704 11.6673" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 15.8362V10.1953" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </label>
                                    <input type="file" id="resumeInput" accept=".pdf,.doc,.docx">
                                    <!--<div class="file-list" id="fileList"></div>-->
                                </div>
                            </div>

                            <div class="job-card">
                                <div class="icon-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">
                                        <path d="M25.6673 44.3307H30.334V34.5891L34.0673 38.3224L37.334 34.9974L28.0007 25.6641L18.6673 34.9974L21.9923 38.2641L25.6673 34.5891V44.3307ZM14.0007 51.3307C12.7173 51.3307 11.6191 50.8742 10.706 49.9611C9.79287 49.048 9.33554 47.949 9.33398 46.6641V9.33073C9.33398 8.0474 9.79132 6.94917 10.706 6.03606C11.6207 5.12295 12.7189 4.66562 14.0007 4.66406H32.6673L46.6673 18.6641V46.6641C46.6673 47.9474 46.2108 49.0464 45.2976 49.9611C44.3845 50.8757 43.2855 51.3323 42.0006 51.3307H14.0007ZM30.334 20.9974V9.33073H14.0007V46.6641H42.0006V20.9974H30.334Z" fill="#00A148"/>
                                    </svg>
                                </div>
                                <h2>Fill Manually</h2>
                                <p class="desc">Enter Details Step by Step.</p>
                                <ul class="feature-list">
                                    <li>
                                        <span class="check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        Fill your information Manually.
                                    </li>

                                    <li>
                                        <span class="check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        Add your skills and Experience.
                                    </li>


                                    <li>
                                        <span class="check">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        Complete Each Section.
                                    </li>

                                </ul>
                                <button class="btn-green" type="button" data-bs-dismiss="modal">Fill Manually 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M8.3775 4.80917C8.63417 4.0575 9.6975 4.0575 9.95417 4.80917L10.6258 6.77583C10.8314 7.37841 11.1724 7.92585 11.6225 8.37613C12.0727 8.82641 12.62 9.16754 13.2225 9.37333L15.1892 10.045C15.9417 10.3017 15.9417 11.365 15.1892 11.6217L13.2225 12.2933C12.6201 12.499 12.0728 12.84 11.6227 13.2902C11.1725 13.7403 10.8315 14.2876 10.6258 14.89L9.95417 16.8567C9.6975 17.6092 8.63417 17.6092 8.3775 16.8567L7.70583 14.89C7.50013 14.2876 7.15912 13.7403 6.70899 13.2902C6.25887 12.84 5.71159 12.499 5.10917 12.2933L3.1425 11.6217C2.39 11.365 2.39 10.3017 3.1425 10.045L5.10917 9.37333C5.71159 9.16763 6.25887 8.82662 6.70899 8.37649C7.15912 7.92637 7.50013 7.37909 7.70583 6.77667L8.3775 4.80917ZM15.8325 2.5L16.2575 3.74167L17.4992 4.16667L16.2575 4.59167L15.8325 5.83333L15.4075 4.59167L14.1658 4.16667L15.4075 3.74167L15.8325 2.5Z" stroke="white" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="modal-footer1">
                    <div class="footer-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 22.4984C12 22.4984 20.9986 19.4988 20.9986 12" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.9986 11.9984V2.99977C20.9986 2.99977 17.9991 1.5 12 1.5" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.0006 22.4984C12.0006 22.4984 3.00195 19.4988 3.00195 12" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.00195 11.9984V2.99977C3.00195 2.99977 6.00149 1.5 12.0006 1.5" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18.0003 6C12.0013 10.4993 10.5015 16.4984 10.5015 16.4984C10.5015 16.4984 9.00172 14.7082 7.50195 13.4988" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="footer-text">
                            <h2>Your information is safe with us !</h2>
                            <p>we use encryption to protect your data and never share it with everyone,</p>
                        </div>
                    </div>
                    <div class="link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41" fill="none">
                            <g opacity="0.5" clip-path="url(#clip0_4313_13934)">
                                <path d="M15.2459 14.5747L16.4959 12.4097C16.7088 12.0409 16.9471 11.6973 17.2108 11.379M28.2363 22.0747L29.4863 19.9097C30.2481 18.5904 30.5901 17.0703 30.4667 15.5519C30.3433 14.0335 29.7605 12.5886 28.7957 11.4096C27.8309 10.2305 26.5299 9.3733 25.0659 8.95189C23.6019 8.53049 22.0443 8.56491 20.6003 9.05059M13.1586 30.6901L9.91097 28.8151C6.84957 27.0476 5.31779 26.1632 4.9167 24.6629C4.51391 23.1631 5.39828 21.6313 7.16578 18.5699C8.93328 15.5085 9.81766 13.9767 11.318 13.5756C12.8178 13.1728 14.3496 14.0572 17.411 15.8247L26.0712 20.8247C29.1326 22.5922 30.6644 23.4766 31.0655 24.9769C31.4683 26.4767 30.5839 28.0085 28.8164 31.0699C27.0489 34.1313 26.1645 35.6631 24.6642 36.0642C23.1644 36.467 21.6326 35.5826 18.5712 33.8151L17.4887 33.1901" stroke="#00A148" stroke-width="1.5" stroke-linecap="round"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_4313_13934">
                                <rect width="30" height="30" fill="white" transform="translate(15) rotate(30)"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!----- jobPostModal Popup-------->

<!----- Basic Details Popup ----->
<div class="modal bottom-sheet fade" id="editModal" tabindex="-1" aria-labelledby="basicDetailsLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered basic-details">
    <div class="modal-content">
      <div class="drag-handle"></div>
      <div class="modal-header">
        <h5 class="modal-title" id="basicDetailsLabel">Basic Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
      </div>
      <div class="modal-body">
        <form id="basicDetailsForm"
                action="{{ route('jobseekers.profile.basic-details.update') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf

            <div class="upload-box">
                <div class="upload-avatar">
                    <img id="preview" src="{{ $freelancer->profile_photo ?: 'https://idpdefault.s3.ap-south-1.amazonaws.com/6aa904db5b674.jpg' }}" alt="avatar">
                </div>
                <div>
                    <h6>Upload Your Profile Photo</h6>
                    <p>Add a professional profile photo to build trust with employers and make your profile stand out.</p>
                    <label class="change-photo-btn" for="fileInput">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <g clip-path="url(#clip0_upload)">
                                <path d="M6 1.5V7.5M3.5 4L6 1.5L8.5 4M10.5 7.5V9.5C10.5 9.76522 10.3946 10.0196 10.2071 10.2071C10.0196 10.3946 9.76522 10.5 9.5 10.5H2.5C2.23478 10.5 1.98043 10.3946 1.79289 10.2071C1.60536 10.0196 1.5 9.76522 1.5 9.5V7.5" stroke="#00A148" stroke-width="2" stroke-linecap="round"/>
                            </g>
                            <defs><clipPath id="clip0_upload"><rect width="12" height="12" fill="white"/></clipPath></defs>
                        </svg> Upload File
                    </label>
                </div>
                <input type="file" name="profile_photo" id="fileInput" accept="image/jpeg,image/png" hidden>
            </div>

            <div class="input-row">
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label">Name <span class="req">*</span></label>
                        <input type="text" name="name" id="editName" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Job Title <span class="req">*</span></label>
                        <input type="text" name="job_title" id="job_title" class="form-control">
                    </div>
                </div>
            </div>

            <div class="input-row">
                <label class="form-label d-block">Gender <span class="req">*</span></label>
                <div class="gender-group" id="genderGroup">

                    <div class="gender-btn"
                        data-value="male">
                        Male
                    </div>

                    <div class="gender-btn"
                        data-value="female">
                        Female
                    </div>

                    <div class="gender-btn"
                        data-value="other">
                        Prefer not to say
                    </div>
                </div>
                <input type="hidden" name="gender" id="genderInput">
            </div>

            <div class="input-row">
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label d-block">Total Experience <span class="req">*</span></label>
                        <select class="form-select" name="experience_range" id="editExperienceRange">
                            <option value="" disabled {{ empty($freelancer->total_experience) ? 'selected' : '' }}>
                                Select experience
                            </option>
                            <option value="0" {{ ($freelancer->total_experience ?? '') === '0' ? 'selected' : '' }}>
                                Fresher
                            </option>
                            <option value="0-1" {{ ($freelancer->total_experience ?? '') === '0-1' ? 'selected' : '' }}>
                                Less than 1 year
                            </option>
                            <option value="1-2" {{ ($freelancer->total_experience ?? '') === '1-2' ? 'selected' : '' }}>
                                1 - 2 years
                            </option>
                            <option value="2-3" {{ ($freelancer->total_experience ?? '') === '2-3' ? 'selected' : '' }}>
                                2 - 3 years
                            </option>
                            <option value="3-5" {{ ($freelancer->total_experience ?? '') === '3-5' ? 'selected' : '' }}>
                                3 - 5 years
                            </option>
                            <option value="5-8" {{ ($freelancer->total_experience ?? '') === '5-8' ? 'selected' : '' }}>
                                5 - 8 years
                            </option>
                            <option value="8-12" {{ ($freelancer->total_experience ?? '') === '8-12' ? 'selected' : '' }}>
                                8 - 12 years
                            </option>
                            <option value="12-15" {{ ($freelancer->total_experience ?? '') === '12-15' ? 'selected' : '' }}>
                                12 - 15 years
                            </option>
                            <option value="15+" {{ ($freelancer->total_experience ?? '') === '15+' ? 'selected' : '' }}>
                                15+ years
                            </option>
                        </select>
                    </div>
                    <div class="col-6">
                    <label class="form-label d-block">Salary (LPA) <span class="req">*</span></label>
                    <input type="text" name="salary" id="editSalary" placeholder="Enter Salary">
                </div>
                </div>
            </div>

            <div class="row input-row g-2">
                <div class="col-6">
                    <label class="form-label">Date of Birth <span class="req">*</span></label>
                    <input type="date" name="dob" id="editDob" class="form-control">
                </div>
                <div class="col-6">
                    <label class="form-label">Current Location <span class="req">*</span></label>
                    <input type="text" name="city" id="editCity" placeholder="Search city">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!----- Contact Info Popup ----->
<div class="modal bottom-sheet fade" id="contactModal" tabindex="-1" aria-labelledby="contactDetails" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="drag-handle"></div>
      <div class="modal-header">
        <h5 class="modal-title" id="basicDetailsLabel">Contact Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
      </div>
      <div class="modal-body">
        <form id="contactDetailsForm" action="#" method="POST">
            @csrf
            @method('PUT')

            <div class="input-row">
                <label>Phone Number <span class="req">*</span></label>
                <div class="contact-row">
                    <div class="input-wrap">
                        <span class="prefix">+91</span>
                        <input type="tel" name="phone" class="input-left" id="phone" 
                            placeholder="Enter number here..." 
                            value="{{ $freelancer->phone }}" maxlength="10">
                    </div>
                    <button type="button" class="verifybtn" id="savePhoneBtn">Save</button>
                </div>
                <span class="field-error" id="phoneError" style="display:none; color:red; font-size:12px;"></span>
            </div>

            <div class="input-row">
                <label>E-mail <span class="req">*</span></label>
                <div class="contact-row">
                    <div class="input-wrap">
                        <input type="email" name="email" id="email" placeholder="Enter new Email" value="{{ $freelancer->email }}" disabled>
                    </div>
                    @if($freelancer->email_verified_at)
                        <button type="button" class="verifybtn verified-btn" id="sendOtpEmailBtn" disabled>
                            Verified
                        </button>
                    @else
                        <button type="button" class="verifybtn" id="sendOtpEmailBtn">
                            Send OTP
                        </button>
                    @endif
                </div>
            </div>

            @unless($freelancer->email_verified_at)
            <div class="input-row" id="otpRow">
                <label>Enter OTP <span class="req">*</span></label>
                <div class="contact-row">
                    <div class="input-wrap">
                        <input type="text" id="otpEmail" placeholder="Enter OTP here...." maxlength="6">
                    </div>
                    <button type="button" class="verifybtn" id="verifyEmailBtn" disabled>Verify</button>
                </div>
            </div>
            @endunless
        </form>
      </div>
    </div>
  </div>
</div>

<!----- Profile Summary Popup ----->
<div class="modal bottom-sheet fade" id="profileSummaryModal" tabindex="-1" aria-labelledby="profileSummary" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="drag-handle"></div>
      <div class="modal-header">
        <h5 class="modal-title" id="profileSummary">Profile Summary</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
      </div>
      <div class="modal-body">
        <form id="profileSummaryForm"
                action="{{ route('jobseekers.profile.summary.save') }}"
                method="POST">
            @csrf
            <div class="input-row">
                <textarea name="bio" class="profile-summary-input" placeholder="Enter Profile Summary here...">{{ $freelancer->bio }}</textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!----- AI Summary Generator Popup ----->
<div class="modal bottom-sheet fade" id="aiSummaryModal" tabindex="-1" aria-labelledby="AiSummary" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AiSummary">AI Summary Generator</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="input-row">
                <textarea id="aiSummaryOutput" class="profile-summary-input" placeholder="Enter Profile Summary here...">{{ $freelancer->bio }}</textarea>
            </div>
            <div id="aiSummaryError"
                class="text-danger mt-2"
                style="display:none;">
            </div>
        </div>
        <div class="modal-footer">
            <button class="ai-btn" type="button" id="generateAiSummaryBtn" data-url="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M6.62479 10.3361C6.56527 10.1054 6.44502 9.89484 6.27653 9.72636C6.10805 9.55788 5.8975 9.43762 5.66679 9.3781L1.57679 8.32344C1.50701 8.30363 1.4456 8.26161 1.40186 8.20373C1.35813 8.14586 1.33447 8.07531 1.33447 8.00277C1.33447 7.93024 1.35813 7.85968 1.40186 7.80181C1.4456 7.74394 1.50701 7.70191 1.57679 7.6821L5.66679 6.62677C5.89742 6.56731 6.10792 6.44715 6.27639 6.2788C6.44486 6.11044 6.56517 5.90003 6.62479 5.66944L7.67946 1.57944C7.69906 1.50938 7.74105 1.44766 7.799 1.4037C7.85696 1.35974 7.92771 1.33594 8.00046 1.33594C8.0732 1.33594 8.14395 1.35974 8.20191 1.4037C8.25987 1.44766 8.30185 1.50938 8.32146 1.57944L9.37546 5.66944C9.43497 5.90015 9.55523 6.1107 9.72371 6.27918C9.89219 6.44766 10.1027 6.56792 10.3335 6.62744L14.4235 7.68144C14.4938 7.70084 14.5558 7.74278 14.6 7.80082C14.6442 7.85887 14.6682 7.92981 14.6682 8.00277C14.6682 8.07573 14.6442 8.14667 14.6 8.20472C14.5558 8.26276 14.4938 8.3047 14.4235 8.3241L10.3335 9.3781C10.1027 9.43762 9.89219 9.55788 9.72371 9.72636C9.55523 9.89484 9.43497 10.1054 9.37546 10.3361L8.32079 14.4261C8.30118 14.4962 8.2592 14.5579 8.20124 14.6018C8.14328 14.6458 8.07254 14.6696 7.99979 14.6696C7.92704 14.6696 7.85629 14.6458 7.79834 14.6018C7.74038 14.5579 7.69839 14.4962 7.67879 14.4261L6.62479 10.3361Z" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Generate by AI
            </button>
            <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
            <button
                class="btn-save"
                type="button"
                id="saveAiSummaryBtn">

                Save
            </button>
        </div>
    </div>
  </div>
</div>

<!----- Upload Resume Popup ----->
<div class="modal bottom-sheet fade" id="UploadResumeModal" tabindex="-1" aria-labelledby="UploadResume" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="UploadResume">Upload Resume</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <form id="resumeUploadForm"
            action="{{ route('jobseekers.profile.resume.save') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            <div class="modal-body">
                <div class="resume-upload" id="dropzone">
                    <div class="upload-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M18 13.1053C17.0452 13.1053 16.1295 12.706 15.4544 11.9954C14.7793 11.2847 14.4 10.3208 14.4 9.31579V4.26316H9.6C8.96348 4.26316 8.35303 4.52932 7.90294 5.0031C7.45286 5.47687 7.2 6.11945 7.2 6.78947V23.2105C7.2 23.8805 7.45286 24.5231 7.90294 24.9969C8.35303 25.4707 8.96348 25.7368 9.6 25.7368H20.4C21.0365 25.7368 21.647 25.4707 22.0971 24.9969C22.5471 24.5231 22.8 23.8805 22.8 23.2105V13.1053H18ZM15.6 9.31579C15.6 9.98581 15.8529 10.6284 16.3029 11.1022C16.753 11.5759 17.3635 11.8421 18 11.8421H22.308L15.6 4.78105V9.31579ZM9.6 3H15.6L24 11.8421V23.2105C24 24.2156 23.6207 25.1794 22.9456 25.8901C22.2705 26.6008 21.3548 27 20.4 27H9.6C8.64522 27 7.72955 26.6008 7.05442 25.8901C6.37928 25.1794 6 24.2156 6 23.2105V6.78947C6 5.78444 6.37928 4.82058 7.05442 4.10991C7.72955 3.39925 8.64522 3 9.6 3Z" fill="#777777"></path>
                        </svg>
                    </div>
                    <div>
                        <h6>Upload Your Resume</h6>
                        <p>Upload your resume to highlight your experience and help employers discover your profile faster.</p>
                        <label class="change-photo-btn" id="uploadBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M6 1.5V7.5M3.5 4L6 1.5L8.5 4M10.5 7.5V9.5C10.5 9.76522 10.3946 10.0196 10.2071 10.2071C10.0196 10.3946 9.76522 10.5 9.5 10.5H2.5C2.23478 10.5 1.98043 10.3946 1.79289 10.2071C1.60536 10.0196 1.5 9.76522 1.5 9.5V7.5" stroke="#00A148" stroke-width="2" stroke-linecap="round"></path>
                            </svg> Upload File
                        </label>
                    </div>
                    <input type="file" name="resume" id="fileInputDoc" accept=".pdf,.doc,.docx">
                    <div class="file-list" id="fileList"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!----- Add Experience Modal Popup ----->
<div class="modal bottom-sheet fade" id="addExperienceModal" tabindex="-1" aria-labelledby="AddExperience" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddExperience">Add Experience</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <form id="experienceForm" action="{{ route('jobseekers.experience.save') }}" method="POST">
            @csrf
            <input type="hidden" name="experience_id" id="experienceId">
            <div class="modal-body">
                <div class="input-row">
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label">Job Title <span class="req">*</span></label>
                            <input type="text" name="position" id="experiencePosition" class="form-control" placeholder="Search job title">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Company <span class="req">*</span></label>
                            <input type="text" name="company" id="experienceCompany" class="form-control" placeholder="Enter your company name">
                        </div>
                    </div>
                </div>

                <div class="working-checkbox">
                    <input type="checkbox" name="currently_working" id="currentlyWorking" value="1">
                    <label for="currentlyWorking">Currently Working here...</label>
                </div>

                <div class="input-row">
                    <div class="row g-2">
                        <div class="col-6 date-field">
                            <label class="form-label">Start Date <span class="req">*</span></label>
                            <input type="date" name="start_date" id="experienceStartDate" class="form-control">
                        </div>
                        <div class="col-6 date-field">
                            <label class="form-label">End Date <span class="req">*</span></label>
                            <input type="date" name="end_date" id="experienceEndDate" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="input-row">
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label">Current Salary <span class="req">*</span></label>
                            <input type="text" name="salary" id="experienceSalary" class="form-control" placeholder="Enter your Current salary here...">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Notice Period <span class="req">*</span></label>
                            <select class="form-select" name="notice_period" id="experienceNoticePeriod">
                                <option selected disabled>Select Notice Period</option>
                                <option value="15 Days">15 Days</option>
                                <option value="1 Months">1 Months</option>
                                <option value="3 Months">3 Months</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="input-row">
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label">Industry <span class="req">*</span></label>
                            <select class="form-select" name="industry" id="experienceIndustry">
                                <option selected disabled>Enter or Select your industry</option>
                                <option value="IT">IT</option>
                                <option value="Finance">Finance</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Employment Type <span class="req">*</span></label>
                            <select class="form-select" name="employment_type" id="experienceEmploymentType">
                                <option selected disabled>Select Employment Type</option>
                                <option value="Full time">Full time</option>
                                <option value="Part time">Part time</option>
                                <option value="Internship">Internship</option>
                                <option value="Contract">Contract</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="input-row">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="experienceDescription" class="profile-summary-input1" placeholder="Describe your work..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!----- Add Skills Popup ----->
<div class="modal bottom-sheet fade" id="addSkillsModal" tabindex="-1" aria-labelledby="Add Skills" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddSkills">Add Skills</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <form id="skillsForm" action="{{ route('jobseekers.profile.skills.update') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="input-row">
                    <label class="form-label">Add Skills <span class="req">*</span></label>
                    <div class="ac-input-wrap">
                        <input type="text" id="skillSearchInput" placeholder="Search skill">
                        <!-- <span class="ac-clear">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M10.5 3.5L3.5 10.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                <path d="M3.5 3.5L10.5 10.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                            </svg>
                        </span> -->
                    </div>
                    <ul class="ac-list d-none" id="skillsSuggestions"></ul>

                    <div class="skills-tags" id="skillsTags">
                        @foreach($skills as $skill)
                        <span class="skilltag">{{ $skill->name }}
                            <input type="hidden" name="skills[]" value="{{ $skill->name }}">
                            <button type="button" class="tag-remove" onclick="this.closest('.skilltag').remove()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M10.5 3.5L3.5 10.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.5 3.5L10.5 10.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!----- Add Education Popup ----->
<div class="modal bottom-sheet fade" id="addEducationModal" tabindex="-1" aria-labelledby="AddEducation" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddEducationLabel">Add Education</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <form id="educationForm" action="{{ route('jobseekers.education.save') }}" method="POST">
            @csrf
            <input type="hidden" name="education_id" id="educationId" value="">
            <div class="modal-body">
                <div class="input-row">
                    <label>Degree <span class="req">*</span></label>
                    <select class="form-select" name="degree" id="educationDegree">
                        <option selected disabled>Select your Degree</option>
                        <option value="" selected disabled>
                            Select your Degree
                        </option>

                        <option value="10th Class (X)">
                            10th Class (X)
                        </option>

                        <option value="12th Class (XII)">
                            12th Class (XII)
                        </option>

                        <option value="Diploma">
                            Diploma
                        </option>

                        <option value="Bachelor's Degree">
                            Bachelor's Degree
                        </option>

                        <option value="Master's Degree">
                            Master's Degree
                        </option>

                    </select>
                </div>

                <div class="input-row">
                    <label>University/Institute <span class="req">*</span></label>
                    <input type="text" name="institute" id="educationInstitute" class="form-control" placeholder="Select your University">
                </div>

                <div class="row input-row g-2">
                    <div class="col-6">
                        <label>Passing year <span class="req">*</span></label>
                        <select class="form-select" name="passing_year" id="educationPassingYear">
                            <option selected disabled>Year</option>
                            @for($y = date('Y'); $y >= 1980; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label>Education Type <span class="req">*</span></label>
                        <select class="form-select" name="education_type" id="educationType">
                            <option value="" selected disabled>
                                Select Education Type
                            </option>
                            <option value="Full Time">
                                Full Time
                            </option>

                            <option value="Part Time">
                                Part Time
                            </option>

                            <option value="Distance Learning">
                                Distance Learning
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!----- Job Preference Popup ----->
<div class="modal bottom-sheet fade" id="jobPreferenceModal" tabindex="-1" aria-labelledby="JobPreference" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="JobPreference">Job Preference</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <form id="jobPreferenceForm" action="{{ route('jobseekers.profile.job-preference.update') }}" method="POST">
            @csrf

            <div class="modal-body">
                <div class="input-row">
                    <label class="form-label">Preferred Job Title <span class="req">*</span></label>
                    <div class="ac-input-wrap">
                        <input type="text" id="jobTitleInput" placeholder="Enter your preferred Job Title">
                    </div>
                    <ul class="ac-list d-none" id="jobTitleSuggestions"></ul>

                    <div class="skills-tags" id="jobTags">
                        @foreach($preferredTitles as $title)
                        <span class="skilltag">{{ $title->title ?? '' }}
                            <input type="hidden" name="preferred_titles[]" value="{{ $title->title ?? '' }}">
                            <button type="button" class="tag-remove" onclick="this.closest('.skilltag').remove()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M10.5 3.5L3.5 10.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.5 3.5L10.5 10.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </span>
                        @endforeach
                    </div>
                </div>

                <div class="input-row">
                    <label class="form-label">Preferred Job Location <span class="req">*</span></label>
                    <div class="ac-input-wrap">
                        <input type="text" id="jobLocationInput" placeholder="Enter your preferred Job Location">
                    </div>
                    <ul class="ac-list d-none" id="jobLocationSuggestions"></ul>

                    <div class="skills-tags" id="joblocation">
                        @foreach($preferredLocations as $loc)
                        <span class="skilltag">{{ $loc->location ?? '' }}
                            <input type="hidden" name="preferred_locations[]" value="{{ $loc->location ?? '' }}">
                            <button type="button" class="tag-remove" onclick="this.closest('.skilltag').remove()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M10.5 3.5L3.5 10.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.5 3.5L10.5 10.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!----- Add Project Popup ----->
<div class="modal bottom-sheet fade" id="addProjectModal" tabindex="-1" aria-labelledby="AddProject" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddProject">Add Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <form id="projectForm" action="{{ route('jobseekers.profile.project.save') }}" method="POST">
            @csrf
            <input type="hidden" name="project_id" id="projectId" value="">
            <div class="modal-body">
                <div class="input-row">
                    <label>Title <span class="req">*</span></label>
                    <input type="text" name="title" id="projectTitle" placeholder="Enter project title">
                </div>
                <div class="input-row">
                    <label>Description</label>
                    <textarea name="description" id="projectDescription" class="profile-summary-input" placeholder="Describe your work..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!----- Add Social Links Popup ----->
<div class="modal bottom-sheet fade" id="addSocialModal" tabindex="-1" aria-labelledby="AddSocialLinks" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Social Links</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        @php
            $socialByPlatform = $socialLinks->keyBy(fn($l) => strtolower($l->platform));
        @endphp

        <form id="socialLinksForm" action="{{ route('jobseekers.profile.social-links.update') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="input-row">
                    <label>Enter URL <span class="req">*</span></label>

                    <div class="social-input">
                        <span class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip0_4060_6132)">
                                    <path d="M10.0219 23.8781C4.32188 22.8609 0 17.9391 0 12C0 5.4 5.4 0 12 0C18.6 0 24 5.4 24 12C24 17.9391 19.6781 22.8609 13.9781 23.8781L13.3172 23.3391H10.6781L10.0219 23.8781Z" fill="#0866FF"></path>
                                    <path d="M16.6783 15.3578L17.2174 11.9969H14.0393V9.65781C14.0393 8.69688 14.4002 7.97969 15.8393 7.97969H17.4002V4.91875C16.5611 4.79687 15.6002 4.67969 14.7611 4.67969C12.0002 4.67969 10.083 6.35781 10.083 9.35781V11.9969H7.08301V15.3578H10.083V23.8188C10.7439 23.9406 11.4049 23.9969 12.0611 23.9969C12.7221 23.9969 13.383 23.9359 14.0393 23.8188V15.3578H16.6783Z" fill="white"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_4060_6132">
                                    <rect width="24" height="24" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <input type="url" name="social[facebook]" class="input-left" placeholder="Facebook URL" value="{{ $socialByPlatform['facebook']->url ?? '' }}" autocomplete="off">
                    </div>

                    <div class="social-input">
                        <span class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M16 8C17.5913 8 19.1174 8.63214 20.2426 9.75736C21.3679 10.8826 22 12.4087 22 14V21H18V14C18 13.4696 17.7893 12.9609 17.4142 12.5858C17.0391 12.2107 16.5304 12 16 12C15.4696 12 14.9609 12.2107 14.5858 12.5858C14.2107 12.9609 14 13.4696 14 14V21H10V14C10 12.4087 10.6321 10.8826 11.7574 9.75736C12.8826 8.63214 14.4087 8 16 8Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M6 9H2V21H6V9Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M4 6C5.10457 6 6 5.10457 6 4C6 2.89543 5.10457 2 4 2C2.89543 2 2 2.89543 2 4C2 5.10457 2.89543 6 4 6Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <input type="url" name="social[linkedin]" class="input-left" placeholder="LinkedIn URL" value="{{ $socialByPlatform['linkedin']->url ?? '' }}" autocomplete="off">
                    </div>

                    <div class="social-input">
                        <span class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip0_4060_6126)">
                                    <path d="M18.375 0H5.625C2.5184 0 0 2.5184 0 5.625V18.375C0 21.4816 2.5184 24 5.625 24H18.375C21.4816 24 24 21.4816 24 18.375V5.625C24 2.5184 21.4816 0 18.375 0Z" fill="url(#paint0_radial_4060_6126)"></path>
                                    <path d="M18.375 0H5.625C2.5184 0 0 2.5184 0 5.625V18.375C0 21.4816 2.5184 24 5.625 24H18.375C21.4816 24 24 21.4816 24 18.375V5.625C24 2.5184 21.4816 0 18.375 0Z" fill="url(#paint1_radial_4060_6126)"></path>
                                    <path d="M12.0008 2.625C9.45478 2.625 9.13519 2.63616 8.13525 2.68163C7.13719 2.72738 6.45591 2.88534 5.85984 3.11719C5.24316 3.35662 4.72013 3.67697 4.19906 4.19822C3.67753 4.71937 3.35719 5.24241 3.117 5.85881C2.8845 6.45506 2.72634 7.13662 2.68144 8.13422C2.63672 9.13425 2.625 9.45394 2.625 12.0001C2.625 14.5463 2.63625 14.8648 2.68163 15.8647C2.72756 16.8628 2.88553 17.5441 3.11719 18.1402C3.35681 18.7568 3.67716 19.2799 4.19841 19.8009C4.71938 20.3225 5.24241 20.6436 5.85862 20.883C6.45516 21.1148 7.13653 21.2728 8.13441 21.3186C9.13444 21.364 9.45375 21.3752 11.9997 21.3752C14.5461 21.3752 14.8646 21.364 15.8646 21.3186C16.8626 21.2728 17.5447 21.1148 18.1412 20.883C18.7576 20.6436 19.2799 20.3225 19.8007 19.8009C20.3223 19.2799 20.6425 18.7568 20.8828 18.1404C21.1133 17.5441 21.2715 16.8626 21.3184 15.8649C21.3633 14.865 21.375 14.5463 21.375 12.0001C21.375 9.45394 21.3633 9.13444 21.3184 8.13441C21.2715 7.13634 21.1133 6.45516 20.8828 5.85909C20.6425 5.24241 20.3223 4.71937 19.8007 4.19822C19.2793 3.67678 18.7578 3.35644 18.1406 3.11728C17.543 2.88534 16.8613 2.72728 15.8632 2.68163C14.8632 2.63616 14.5448 2.625 11.9979 2.625H12.0008ZM11.1598 4.31447C11.4095 4.31409 11.688 4.31447 12.0008 4.31447C14.5041 4.31447 14.8007 4.32347 15.7892 4.36838C16.7032 4.41019 17.1994 4.56291 17.5298 4.69125C17.9674 4.86112 18.2793 5.06428 18.6072 5.3925C18.9353 5.72062 19.1384 6.03309 19.3088 6.47062C19.4371 6.80062 19.59 7.29675 19.6316 8.21081C19.6765 9.19913 19.6863 9.49594 19.6863 11.9979C19.6863 14.4999 19.6765 14.7968 19.6316 15.7851C19.5898 16.6991 19.4371 17.1952 19.3088 17.5253C19.1389 17.9629 18.9353 18.2744 18.6072 18.6023C18.2791 18.9305 17.9676 19.1335 17.5298 19.3035C17.1997 19.4324 16.7032 19.5848 15.7892 19.6266C14.8009 19.6715 14.5041 19.6812 12.0008 19.6812C9.49753 19.6812 9.20081 19.6715 8.21259 19.6266C7.29853 19.5844 6.80241 19.4317 6.47166 19.3033C6.03422 19.1333 5.72166 18.9303 5.39353 18.6022C5.06541 18.274 4.86234 17.9623 4.692 17.5246C4.56366 17.1945 4.41075 16.6984 4.36913 15.7843C4.32422 14.796 4.31522 14.4992 4.31522 11.9956C4.31522 9.492 4.32422 9.19678 4.36913 8.20847C4.41094 7.29441 4.56366 6.79828 4.692 6.46781C4.86197 6.03028 5.06541 5.71781 5.39363 5.38969C5.72184 5.06156 6.03422 4.85841 6.47175 4.68816C6.80222 4.55925 7.29853 4.40691 8.21259 4.36491C9.07744 4.32581 9.41259 4.31409 11.1598 4.31212V4.31447ZM17.0052 5.87109C16.3841 5.87109 15.8802 6.37453 15.8802 6.99572C15.8802 7.61681 16.3841 8.12072 17.0052 8.12072C17.6263 8.12072 18.1302 7.61681 18.1302 6.99572C18.1302 6.37463 17.6263 5.87072 17.0052 5.87072V5.87109ZM12.0008 7.18556C9.34209 7.18556 7.18641 9.34125 7.18641 12.0001C7.18641 14.6589 9.34209 16.8136 12.0008 16.8136C14.6597 16.8136 16.8146 14.6589 16.8146 12.0001C16.8146 9.34134 14.6595 7.18556 12.0007 7.18556H12.0008ZM12.0008 8.87503C13.7267 8.87503 15.1259 10.2741 15.1259 12.0001C15.1259 13.7259 13.7267 15.1252 12.0008 15.1252C10.275 15.1252 8.87588 13.7259 8.87588 12.0001C8.87588 10.2741 10.2749 8.87503 12.0008 8.87503Z" fill="white"></path>
                                </g>
                                <defs>
                                    <radialGradient id="paint0_radial_4060_6126" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(6.375 25.8485) rotate(-90) scale(23.7858 22.1227)">
                                    <stop stop-color="#FFDD55"></stop>
                                    <stop offset="0.1" stop-color="#FFDD55"></stop>
                                    <stop offset="0.5" stop-color="#FF543E"></stop>
                                    <stop offset="1" stop-color="#C837AB"></stop>
                                    </radialGradient>
                                    <radialGradient id="paint1_radial_4060_6126" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(-4.02008 1.7289) rotate(78.68) scale(10.6324 43.827)">
                                    <stop stop-color="#3771C8"></stop>
                                    <stop offset="0.128" stop-color="#3771C8"></stop>
                                    <stop offset="1" stop-color="#6600FF" stop-opacity="0"></stop>
                                    </radialGradient>
                                    <clipPath id="clip0_4060_6126">
                                    <rect width="24" height="24" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <input type="url" name="social[instagram]" class="input-left" placeholder="Instagram URL" value="{{ $socialByPlatform['instagram']->url ?? '' }}" autocomplete="off">
                    </div>

                    <div class="social-input">
                        <span class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <g clip-path="url(#clip0_4320_14479)">
                                    <mask id="mask0_4320_14479" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                                    <path d="M0 0H14V14H0V0Z" fill="white"></path>
                                    </mask>
                                    <g mask="url(#mask0_4320_14479)">
                                    <path d="M11.025 0.65625H13.172L8.482 6.03025L14 13.3442H9.68L6.294 8.90925L2.424 13.3442H0.275L5.291 7.59425L0 0.65725H4.43L7.486 4.71025L11.025 0.65625ZM10.27 12.0562H11.46L3.78 1.87725H2.504L10.27 12.0562Z" fill="black"></path>
                                    </g>
                                </g>
                                <defs>
                                    <clipPath id="clip0_4320_14479">
                                    <rect width="14" height="14" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <input type="url" name="social[twitter]" class="input-left" placeholder="Twitter / X URL" value="{{ $socialByPlatform['twitter']->url ?? '' }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!----- Add Language Popup ----->
<div class="modal bottom-sheet fade" id="addLanguageModal" tabindex="-1" aria-labelledby="AddLanguage" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Language</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <form id="languageForm" action="{{ route('jobseekers.profile.languages.update') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="input-row">
                    <div class="lang-add-row">
                        <select id="langSelect">
                            <option value="">Select Language</option>
                            <option value="english">English</option>
                            <option value="hindi">Hindi</option>
                            <option value="bengali">Bengali</option>
                            <option value="tamil">Tamil</option>
                            <option value="japanese">Japanese</option>
                            <option value="arabic">Arabic</option>
                        </select>
                        <select id="langLevel">
                            <option value="Basic">Basic</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Fluent">Fluent</option>
                            <option value="Native">Native</option>
                        </select>
                        <button type="button" class="icon-square-btn" id="addLanguageBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M2.9165 7H11.0832" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 2.91797V11.0846" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>

                    <div class="lang-list" id="langList">
                    @foreach($languages as $lang => $level)
                    @php
                        $normalizedLang = strtolower(trim($lang));
                    @endphp

                    <div class="lang-row" data-language="{{ $normalizedLang }}">
                        <span>{{ ucfirst($normalizedLang) }}</span>

                        <input type="hidden"
                            name="languages[{{ $normalizedLang }}]"
                            value="{{ $level }}">

                        <span class="level-chip level-{{ strtolower($level) }}">
                            {{ ucfirst($level) }}

                            <button type="button"
                                    class="lang-remove-btn"
                                    onclick="this.closest('.lang-row').remove()">
                                ✕
                            </button>
                        </span>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-save">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Crop popup -->
<div class="photo-crop-overlay" id="cropModal">
    <div class="photo-crop-modal">
        <div class="photo-crop-header">
            <div>
                <h2 class="photo-crop-title">Edit Profile Photo</h2>
                <p class="photo-crop-subtitle">Crop your photo for your perfect fit !</p>
            </div>
            <button class="photo-crop-close" id="cancelBtn" type="button" aria-label="Close">✕</button>
        </div>
        <div class="photo-crop-body">
            <img id="cropImage">
        </div>
        <div class="photo-crop-footer">
            <button class="photo-crop-save-btn" id="cropBtn" type="button">Save Photo</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $('.navtabs a').on('click', function() {
        $('.navtabs a').removeClass('active');
        $(this).addClass('active');
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const savePhoneBtn = document.getElementById('savePhoneBtn');
        const phoneInput    = document.getElementById('phone');
        const phoneError    = document.getElementById('phoneError');

        if (!savePhoneBtn) return;

        savePhoneBtn.addEventListener('click', function() {

            const phone = phoneInput.value.trim();

            phoneError.style.display = 'none';
            phoneError.textContent = '';

            if (!/^[6-9]\d{9}$/.test(phone)) {
                phoneError.textContent = 'Please enter a valid 10-digit phone number.';
                phoneError.style.display = 'block';
                phoneInput.focus();
                return;
            }

            savePhoneBtn.disabled = true;
            const originalText = savePhoneBtn.textContent;
            savePhoneBtn.textContent = 'Saving...';

            const formData = new FormData();
            formData.append('phone', phone);
            formData.append('_token', document.querySelector('#contactDetailsForm input[name="_token"]').value);
            formData.append('_method', 'PUT');

            fetch("{{ route('jobseekers.profile.updatePhone') }}", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) throw { status: response.status, data: data };
                    return data;
                })
                .then(data => {
                    if (data.status === true) {

                        alert(data.message);

                        const modalEl = document.getElementById('contactModal');
                        const modalInstance = bootstrap.Modal.getInstance(modalEl) 
                            || bootstrap.Modal.getOrCreateInstance(modalEl);

                        // ✅ Modal fully close hone ke baad hi reload
                        modalEl.addEventListener('hidden.bs.modal', function () {
                            location.reload();
                        }, { once: true });

                        modalInstance.hide();

                    } else {
                        throw { data: data };
                    }
                })
                .catch(error => {
                    console.error('Save Phone Error:', error);

                    let message = 'Unable to save phone number. Please try again.';

                    if (error.data) {
                        if (error.data.errors) {
                            message = Object.values(error.data.errors).flat().join('\n');
                        } else if (error.data.message) {
                            message = error.data.message;
                        }
                    }

                    phoneError.textContent = message;
                    phoneError.style.display = 'block';

                    savePhoneBtn.disabled = false;
                    savePhoneBtn.textContent = originalText;
                });
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const sendOtpEmailBtn = document.getElementById('sendOtpEmailBtn');
        const verifyEmailBtn = document.getElementById('verifyEmailBtn');

        const emailInput = document.getElementById('email');
        const otpEmailInput = document.getElementById('otpEmail');

        if (!sendOtpEmailBtn || !verifyEmailBtn) {
            return;
        }

        // ==========================
        // SEND EMAIL OTP
        // ==========================
        sendOtpEmailBtn.addEventListener('click', function() {

            const email = emailInput.value.trim();

            if (!email) {
                alert('Please enter your email address.');
                emailInput.focus();
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address.');
                emailInput.focus();
                return;
            }

            sendOtpEmailBtn.disabled = true;
            sendOtpEmailBtn.textContent = 'Sending...';

            const formData = new FormData();
            formData.append('email', email);

            const csrfToken = document.querySelector(
                '#contactDetailsForm input[name="_token"]'
            ).value;

            fetch("{{ route('jobseekers.sendOtp') }}", {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },

                    body: formData
                })
                .then(async response => {

                    const data = await response.json();

                    if (!response.ok) {
                        throw {
                            status: response.status,
                            data: data
                        };
                    }

                    return data;
                })
                .then(data => {

                    // console.log('Send OTP Response:', data);

                    // IMPORTANT: Controller returns "status", not "success"
                    if (data.status === true) {

                        alert(data.message);

                        // Enable Verify button
                        verifyEmailBtn.disabled = false;

                        // Focus OTP input
                        otpEmailInput.focus();

                        // Change Send OTP button
                        sendOtpEmailBtn.textContent = 'OTP Sent';

                    } else {

                        throw {
                            data: data
                        };
                    }
                })
                .catch(error => {

                    console.error('Send OTP Error:', error);

                    let message = 'Unable to send OTP. Please try again.';

                    if (error.data) {

                        if (error.data.errors) {

                            message = Object.values(error.data.errors)
                                .flat()
                                .join('\n');

                        } else if (error.data.message) {

                            message = error.data.message;
                        }
                    }

                    alert(message);

                    // Reset Send OTP button
                    sendOtpEmailBtn.disabled = false;
                    sendOtpEmailBtn.textContent = 'Send OTP';

                    // Keep Verify disabled
                    verifyEmailBtn.disabled = true;
                });

        });


        // ==========================
        // VERIFY EMAIL OTP
        // ==========================
        verifyEmailBtn.addEventListener('click', function() {

            const email = emailInput.value.trim();
            const otp = otpEmailInput.value.trim();

            if (!email) {
                alert('Please enter your email address.');
                return;
            }

            if (!otp) {
                alert('Please enter the OTP.');
                otpEmailInput.focus();
                return;
            }

            if (otp.length !== 6) {
                alert('Please enter a valid 6-digit OTP.');
                otpEmailInput.focus();
                return;
            }

            verifyEmailBtn.disabled = true;
            verifyEmailBtn.textContent = 'Verifying...';

            const formData = new FormData();

            formData.append('email', email);
            formData.append('otp', otp);

            const csrfToken = document.querySelector(
                '#contactDetailsForm input[name="_token"]'
            ).value;

            fetch("{{ route('jobseekers.verifyOtp') }}", {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },

                    body: formData
                })
                .then(async response => {

                    const data = await response.json();

                    if (!response.ok) {
                        throw {
                            status: response.status,
                            data: data
                        };
                    }

                    return data;
                })
                .then(data => {

                    // console.log('Verify OTP Response:', data);

                    // IMPORTANT: Controller returns "status"
                    if (data.status === true) {

                        alert(data.message);

                        verifyEmailBtn.textContent = 'Verified';
                        verifyEmailBtn.disabled = true;

                        emailInput.readOnly = true;

                    } else {

                        throw {
                            data: data
                        };
                    }
                })
                .catch(error => {

                    console.error('Verify OTP Error:', error);

                    let message = 'OTP verification failed.';

                    if (error.data) {

                        if (error.data.errors) {

                            message = Object.values(error.data.errors)
                                .flat()
                                .join('\n');

                        } else if (error.data.message) {

                            message = error.data.message;
                        }
                    }

                    alert(message);

                    verifyEmailBtn.disabled = false;
                    verifyEmailBtn.textContent = 'Verify';
                });

        });

    });
</script>

<script>
  // ---- Gender toggle ----
  document.querySelectorAll('.gender-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.gender-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      document.getElementById('genderInput').value = this.dataset.value;
    });
  });

  // ---- Profile photo crop & upload ----
  let cropper;
  const fileInput = document.getElementById('fileInput');
  const cropModal = document.getElementById('cropModal');
  const cropImage = document.getElementById('cropImage');
  const preview = document.getElementById('preview');

  if (fileInput) {
    fileInput.addEventListener('change', function () {
      const file = this.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function (e) {
        cropImage.src = e.target.result;
        cropModal.style.display = 'flex';

        if (cropper) cropper.destroy();
        cropper = new Cropper(cropImage, {
          aspectRatio: 1,
          viewMode: 1,
          background: false,
          autoCropArea: 1
        });
      };
      reader.readAsDataURL(file);
    });
  }

  document.getElementById('cropBtn')?.addEventListener('click', function () {
    if (!cropper) return;
    const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
    preview.src = canvas.toDataURL('image/jpeg');
    preview.style.display = 'block';
    cropModal.style.display = 'none';

    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
  });

  document.getElementById('cancelBtn')?.addEventListener(
        'click',
        function () {

            cropModal.style.display = 'none';

            // Only clear file when CANCEL is clicked
            fileInput.value = '';

            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }
    );
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll(".exp-item").forEach(function (box) {

            const content = box.querySelector(".note");
            const button = box.querySelector(".see-more-btn");

            if (!content || !button) {
                return;
            }

            // Get the CSS max-height in pixels
            const styles = window.getComputedStyle(content);
            const maxHeight = parseFloat(styles.maxHeight);

            // Temporarily remove max-height to get the full text height
            content.style.maxHeight = "none";

            const fullHeight = content.scrollHeight;

            // Restore CSS max-height
            content.style.maxHeight = "";

            // Show See More only if content is actually taller
            if (fullHeight > maxHeight + 1) {
                button.style.display = "flex";
            } else {
                button.style.display = "none";
            }

            // See More / See Less
            button.addEventListener("click", function () {

                if (content.classList.contains("show")) {

                    content.classList.remove("show");
                    button.textContent = "See More";

                } else {

                    content.classList.add("show");
                    button.textContent = "See Less";

                }

            });

        });

    });
</script>

<script>
  // ---- OTP verify enable ----
  function bindOtpVerify(otpInputId, verifyBtnId) {
    const otpInput = document.getElementById(otpInputId);
    const verifyBtn = document.getElementById(verifyBtnId);
    otpInput.addEventListener('input', () => {
      verifyBtn.disabled = otpInput.value.trim().length === 0;
    });
  }
  bindOtpVerify('otpPhone', 'verifyPhoneBtn');
  bindOtpVerify('otpEmail', 'verifyEmailBtn');
</script>

<script>
  // ---- Resume upload (drag & drop) ----
  const dropzone = document.getElementById('dropzone');
  const fileInputDoc = document.getElementById('fileInputDoc');
  const uploadBtn = document.getElementById('uploadBtn');
  const fileList = document.getElementById('fileList');

  if (dropzone) {
    uploadBtn.addEventListener('click', (e) => { e.stopPropagation(); fileInputDoc.click(); });
    dropzone.addEventListener('click', () => fileInputDoc.click());

    ['dragenter', 'dragover'].forEach(evt => {
      dropzone.addEventListener(evt, (e) => { e.preventDefault(); e.stopPropagation(); dropzone.classList.add('dragover'); });
    });
    ['dragleave', 'drop'].forEach(evt => {
      dropzone.addEventListener(evt, (e) => { e.preventDefault(); e.stopPropagation(); dropzone.classList.remove('dragover'); });
    });
    dropzone.addEventListener('drop', (e) => handleFiles(e.dataTransfer.files));
    fileInputDoc.addEventListener('change', (e) => { handleFiles(e.target.files); });
  }

  function formatSize(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
  }

  function fileIconSVG(name) {
    const ext = name.split('.').pop().toLowerCase();
    if (ext === 'pdf') {
      return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2h9l5 5v15H6z"/><path d="M15 2v5h5"/></svg>';
    }
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>';
  }

  const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 MB
    
    function handleFiles(files) {
        fileList.innerHTML = '';
    
        if (!files || !files.length) {
            return;
        }
    
        const file = files[0];
    
        // Check file type
        if (!file.name.toLowerCase().endsWith('.pdf')) {
            alert('Only PDF files are allowed.');
            fileInputDoc.value = '';
            return;
        }
    
        // Check file size
        if (file.size > MAX_FILE_SIZE) {
            alert('Resume size must not exceed 5 MB.');
    
            fileInputDoc.value = '';
            fileList.innerHTML = '';
            return;
        }
    
        createFileItem(file);
    }

  function createFileItem(file) {
    const item = document.createElement('div');
    item.className = 'file-item';
    item.innerHTML = `
      <div class="file-top">
        <div class="file-icon">${fileIconSVG(file.name)}</div>
        <div class="file-info">
          <div class="file-name">${file.name}</div>
          <div class="file-size">${formatSize(file.size)}</div>
        </div>
        <button type="button" class="file-remove" title="Remove">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>
      <div class="progress-track"><div class="progress-fill"></div></div>
      <div class="progress-bottom">
        <span class="progress-status">Uploading...</span>
        <span class="progress-percent">0%</span>
      </div>`;

    fileList.prepend(item);

    const fill = item.querySelector('.progress-fill');
    const percentLabel = item.querySelector('.progress-percent');
    const statusLabel = item.querySelector('.progress-status');
    item.querySelector('.file-remove').addEventListener('click', () => item.remove());

    let progress = 0;
    fill.style.width = '0%';
    percentLabel.textContent = '0%';
    statusLabel.textContent = 'Ready to upload';
  }
</script>

<script>
  // ---- Add language row dynamically ----
    document.getElementById('addLanguageBtn')?.addEventListener('click', function () {
        const lang = document.getElementById('langSelect').value;
        const level = document.getElementById('langLevel').value;
        if (!lang) return;

        const row = document.createElement('div');
        row.className = 'lang-row';
        row.innerHTML = `
        <span>${lang}</span>
        <input type="hidden" name="languages[${lang.toLowerCase()}]" value="${level}">
        <span class="level-chip level-${level.toLowerCase()}">${level}
            <button type="button" class="lang-remove-btn" onclick="this.closest('.lang-row').remove()">✕</button>
        </span>`;
        document.getElementById('langList').appendChild(row);
    });

    $(document).on('click', '[data-bs-target="#addExperienceModal"]', function () {

        let experienceId = $(this).data('experience-id');

        // ==========================
        // ADD EXPERIENCE
        // ==========================

        if (!experienceId) {

            $('#AddExperience').text('Add Experience');

            $('#experienceForm')[0].reset();

            $('#experienceId').val('');

            $('#experienceEndDate')
                .prop('disabled', false);

            $('#currentlyWorking')
                .prop('checked', false);

            return;
        }


        // ==========================
        // EDIT EXPERIENCE
        // ==========================

        $('#AddExperience').text('Edit Experience');

        $('#experienceId').val(experienceId);

        $.ajax({

            url: "{{ route('jobseekers.get.experience', ':id') }}".replace(':id', experienceId),

            type: "GET",

            success: function (response) {

                if (!response.status) {
                    alert(response.message);
                    return;
                }

                let experience = response.experience;


                $('#experiencePosition')
                    .val(experience.position ?? '');


                $('#experienceCompany')
                    .val(experience.company ?? '');


                $('#experienceStartDate')
                    .val(experience.start_date ?? '');


                $('#experienceEndDate')
                    .val(experience.end_date ?? '');


                $('#experienceSalary')
                    .val(experience.salary ?? '');


                $('#experienceNoticePeriod')
                    .val(experience.notice_period ?? '');


                $('#experienceIndustry')
                    .val(experience.industry ?? '');


                $('#experienceEmploymentType')
                    .val(experience.employment_type ?? '');


                $('#experienceDescription')
                    .val(experience.description ?? '');


                // Currently working
                if (!experience.end_date) {

                    $('#currentlyWorking')
                        .prop('checked', true);

                    $('#experienceEndDate')
                        .val('')
                        .prop('disabled', true);

                } else {

                    $('#currentlyWorking')
                        .prop('checked', false);

                    $('#experienceEndDate')
                        .prop('disabled', false);
                }

            },

            error: function (xhr) {

                console.log(xhr.responseText);

                alert('Unable to load experience.');

            }

        });

    });

    $('#currentlyWorking').on('change', function () {

        if ($(this).is(':checked')) {

            $('#experienceEndDate')
                .val('')
                .prop('disabled', true);

        } else {

            $('#experienceEndDate')
                .prop('disabled', false);

        }

    });

    $('#experienceForm').on('submit', function(e) {

        e.preventDefault();

        let form = this;
        let formData = new FormData(form);

        let saveButton = $(form).find('.btn-save');

        saveButton
            .prop('disabled', true)
            .text('Saving...');

        $.ajax({

            url: $(form).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {

                if (response.status) {
                    alert(response.message);
                    // Close modal
                    $('#addExperienceModal').modal('hide');

                    // Reload page
                    window.location.reload();

                } else {

                    alert(response.message || 'Something went wrong.');

                }
            },

            error: function(xhr) {

                console.log(xhr.responseText);

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    // Remove old errors
                    $('.text-danger.experience-error').remove();

                    $.each(errors, function(field, messages) {

                        let input = $('[name="' + field + '"]');

                        input.after(
                            '<span class="text-danger experience-error">'
                            + messages[0] +
                            '</span>'
                        );

                    });

                } else {

                    alert('Something went wrong while saving experience.');

                }

            },

            complete: function() {

                saveButton
                    .prop('disabled', false)
                    .text('Save');

            }

        });

    });
</script>

<script>
    $(document).ready(function () {

        // =========================
        // ADD EDUCATION
        // =========================

        $('.add-education-btn').on('click', function () {

            $('#educationForm')[0].reset();

            $('#educationId').val('');

            $('#educationDegree').val('');
            $('#educationInstitute').val('');
            $('#educationPassingYear').val('');
            $('#educationType').val('');

            $('#AddEducationLabel').text('Add Education');

        });


        // =========================
        // EDIT EDUCATION
        // =========================

        $(document).on('click', '.edit-btn[data-education-id]', function () {

            let educationId = $(this).data('education-id');

            if (!educationId) {
                return;
            }

            $.ajax({
                url: "{{ route('jobseekers.get.education', ':id') }}".replace(':id', educationId),

                type: "GET",

                success: function (response) {

                    if (response.status) {

                        let education = response.education;

                        $('#educationId').val(education.id);

                        $('#educationDegree')
                            .val(education.degree);

                        $('#educationInstitute')
                            .val(education.institute);

                        $('#educationPassingYear')
                            .val(education.passing_year);

                        $('#educationType')
                            .val(education.education_type);

                        $('#AddEducationLabel')
                            .text('Edit Education');

                    }

                },

                error: function (xhr) {

                    alert(
                        xhr.responseJSON?.message ||
                        'Unable to load education.'
                    );

                }

            });

        });


        // =========================
        // SAVE EDUCATION
        // =========================

        $('#educationForm').on('submit', function (e) {

            e.preventDefault();

            let form = this;

            let formData = new FormData(form);

            let saveButton = $(form).find('.btn-save');

            saveButton
                .prop('disabled', true)
                .text('Saving...');


            $.ajax({

                url: $(form).attr('action'),

                type: "POST",

                data: formData,

                processData: false,

                contentType: false,


                success: function (response) {

                    if (response.status) {

                        alert(response.message);

                        $('#addEducationModal').modal('hide');

                        window.location.reload();

                    }

                },


                error: function (xhr) {

                    if (xhr.status === 422) {

                        let errors = xhr.responseJSON.errors;

                        let messages = [];

                        $.each(errors, function (field, error) {
                            messages.push(error[0]);
                        });

                        alert(messages.join("\n"));

                    } else {

                        alert(
                            xhr.responseJSON?.message ||
                            'Something went wrong while saving education.'
                        );

                    }

                },


                complete: function () {

                    saveButton
                        .prop('disabled', false)
                        .text('Save');

                }

            });

        });

    });
</script>

<script>
    document.getElementById('profileSummaryForm').addEventListener('submit', function(e) {

        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const button = form.querySelector('.btn-save');

        button.disabled = true;
        button.innerText = 'Saving...';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {

            if (data.status) {

                alert(data.message);

                $('#profileSummaryModal').modal('hide');

                    window.location.reload();

            } else {
                alert(data.message || 'Something went wrong.');
            }

        })
        .catch(error => {
            console.error(error);
            alert('Something went wrong while saving.');
        })
        .finally(() => {
            button.disabled = false;
            button.innerText = 'Save';
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const generateBtn = document.getElementById('generateAiSummaryBtn');
        const saveBtn = document.getElementById('saveAiSummaryBtn');
        const textarea = document.getElementById('aiSummaryOutput');
        const errorBox = document.getElementById('aiSummaryError');

        const csrfToken = document.getElementById('csrfToken').value;

        // =========================
        // GENERATE BY AI
        // =========================
        generateBtn.addEventListener('click', function () {

            generateBtn.disabled = true;
            generateBtn.innerHTML = 'Generating...';

            errorBox.style.display = 'none';

            fetch("{{ route('jobseekers.profile.summary.generate') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    current_bio: textarea.value
                })
            })
            .then(response => response.json())
            .then(data => {

                if (data.status) {

                    textarea.value = data.summary;

                } else {

                    errorBox.innerText = data.message || 'Unable to generate summary.';
                    errorBox.style.display = 'block';

                }

            })
            .catch(error => {

                console.error(error);

                errorBox.innerText = 'Something went wrong.';
                errorBox.style.display = 'block';

            })
            .finally(() => {

                generateBtn.disabled = false;
                generateBtn.innerHTML = 'Generate by AI';

            });

        });


        // =========================
        // SAVE BIO
        // =========================
        saveBtn.addEventListener('click', function () {

            const bio = textarea.value.trim();

            if (!bio) {
                alert('Please enter profile summary.');
                return;
            }

            saveBtn.disabled = true;
            saveBtn.innerHTML = 'Saving...';

            fetch("{{ route('jobseekers.profile.summary.save') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    bio: bio,
                    profile_id: "{{ $freelancer->id }}"
                })
            })
            .then(response => response.json())
            .then(data => {

                if (data.status) {

                    // Update profile summary on page
                    document.querySelector('.summary-text').innerText = bio;

                    alert(data.message);

                    $('#aiSummaryModal').modal('hide');

                        window.location.reload();

                } else {

                    alert(data.message || 'Unable to save summary.');

                }

            })
            .catch(error => {

                console.error(error);
                alert('Something went wrong while saving.');

            })
            .finally(() => {

                saveBtn.disabled = false;
                saveBtn.innerHTML = 'Save';

            });

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('resumeUploadForm');
        const fileInput = document.getElementById('fileInputDoc');
        const saveBtn = form.querySelector('.btn-save');
        
        const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 MB
        
        // Check file size immediately when selected
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
    
            if (!file) return;
    
            if (file.size > MAX_FILE_SIZE) {
                alert('Resume size must not exceed 5 MB.');
                this.value = '';
            }
        });

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            if (!fileInput.files.length) {
                alert('Please select a resume.');
                return;
            }
            
            const file = fileInput.files[0];
    
            // Check file size again before uploading
            if (file.size > MAX_FILE_SIZE) {
                alert('Resume size must not exceed 5 MB.');
                fileInput.value = '';
                return;
            }
    
            // Check PDF extension
            if (!file.name.toLowerCase().endsWith('.pdf')) {
                alert('Only PDF files are allowed.');
                fileInput.value = '';
                return;
            }

            const formData = new FormData(form);
            const item = document.querySelector('#fileList .file-item');
            
            const xhr = new XMLHttpRequest();
            
            saveBtn.disabled = true;
            saveBtn.innerHTML = 'Uploading...';
            
            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.setRequestHeader('Accept', 'application/json');
            
            // Actual upload progress
            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable && item) {
                    const percent = Math.min(
                        99,
                        Math.floor((e.loaded / e.total) * 100)
                    );
            
                    item.querySelector('.progress-fill').style.width = percent + '%';
                    item.querySelector('.progress-percent').textContent = percent + '%';
                    item.querySelector('.progress-status').textContent = 'Uploading...';
                }
            });
            
            // Server response
            xhr.onload = function () {
                let data = {};
            
                try {
                    data = JSON.parse(xhr.responseText);
                } catch (error) {
                    console.error('Invalid response:', xhr.responseText);
                }
            
                if (xhr.status >= 200 && xhr.status < 300 && data.status === true) {
                    if (item) {
                        item.querySelector('.progress-fill').style.width = '100%';
                        item.querySelector('.progress-percent').textContent = '100%';
                        item.querySelector('.progress-status').textContent = 'Uploaded';
                    }
            
                    alert(data.message);
                    $('#UploadResumeModal').modal('hide');
                    window.location.reload();
                } else {
                    if (item) {
                        item.querySelector('.progress-status').textContent = 'Upload failed';
                    }
            
                    const message = data.errors
                        ? Object.values(data.errors).flat().join('\n')
                        : (data.message || 'Upload failed.');
            
                    alert(message);
                }
            };
            
            xhr.onerror = function () {
                if (item) {
                    item.querySelector('.progress-status').textContent = 'Upload failed';
                }
                alert('Network error while uploading resume.');
            };
            
            xhr.onloadend = function () {
                saveBtn.disabled = false;
                saveBtn.innerHTML = 'Save';
            };
            
            xhr.send(formData);

        });

    });
</script>

<script>
    document.getElementById('deleteResumeBtn')?.addEventListener('click', function () {

        if (!confirm('Are you sure you want to delete your resume?')) {
            return;
        }

        fetch("{{ route('jobseekers.resume.delete') }}", {
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Unable to delete resume');
            }

            alert('Resume deleted successfully');

            location.reload();
        })
        .catch(error => {
            console.error(error);
            alert(error.message || 'Something went wrong');
        });
    });
</script>

<script>
    document.getElementById('basicDetailsForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const saveBtn = form.querySelector('.btn-save');

        saveBtn.disabled = true;
        saveBtn.textContent = 'Saving...';

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {

            if (data.status) {
                alert(data.message);

                $('#editModal').modal('hide');

                window.location.reload();
            }
        })
        .catch(error => {

            console.error(error);

            if (error.errors) {
                let messages = [];

                Object.values(error.errors).forEach(errors => {
                    messages.push(...errors);
                });

                alert(messages.join('\n'));
            } else {
                alert(error.message || 'Something went wrong.');
            }
        })
        .finally(() => {
            saveBtn.disabled = false;
            saveBtn.textContent = 'Save';
        });
    });
</script>

<script>
    document.getElementById('editBasicDetailsBtn').addEventListener('click', function () {

        fetch("{{ route('jobseekers.profile.basic-details') }}", {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(async response => {

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(response => {

            if (!response.status || !response.data) {
                return;
            }

            const data = response.data;

            // Name
            document.getElementById('editName').value =
                data.name ?? '';
            
            document.getElementById('job_title').value =
                data.job_title ?? '';

            // Gender
            document.getElementById('genderInput').value =
                data.gender ?? '';

            // Experience years
            document.getElementById('editExperienceRange').value =
                data.total_experience ?? '';

            // DOB
            document.getElementById('editDob').value =
                data.dob ?? '';

            // City
            document.getElementById('editSalary').value =
                data.salary ?? '';

            // City
            document.getElementById('editCity').value =
                data.city ?? '';

            // Profile photo
            document.getElementById('preview').src =
                data.profile_photo ||
                "{{ asset('frontend/images/default-avatar.png') }}";


            // Update gender button UI
            document.querySelectorAll('.gender-btn').forEach(btn => {

                btn.classList.remove('active');

                if (btn.dataset.value === data.gender) {
                    btn.classList.add('active');
                }
            });

        })
        .catch(error => {

            console.error(error);

            alert(
                error.message ||
                'Unable to load basic details.'
            );
        });

    });
</script>

<script>
    document.querySelectorAll('.gender-btn')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                document.querySelectorAll('.gender-btn')
                    .forEach(function (btn) {
                        btn.classList.remove('active');
                    });

                this.classList.add('active');

                document.getElementById('genderInput').value =
                    this.dataset.value;

            });

        });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const titleInput = document.getElementById('jobTitleInput');
        const locationInput = document.getElementById('jobLocationInput');

        const titleSuggestions = document.getElementById('jobTitleSuggestions');
        const locationSuggestions = document.getElementById('jobLocationSuggestions');

        const jobTags = document.getElementById('jobTags');
        const jobLocations = document.getElementById('joblocation');

        const searchUrl = "{{ route('jobseekers.profile.job-preference.search') }}";


        titleSuggestions.classList.add('d-none');
        locationSuggestions.classList.add('d-none');


        let titleRequest = null;

        titleInput.addEventListener('input', function () {

            const value = this.value.trim();

            // Always hide initially
            titleSuggestions.innerHTML = '';
            titleSuggestions.classList.add('d-none');

            if (value.length < 2) {
                return;
            }

            if (titleRequest) {
                titleRequest.abort();
            }

            titleRequest = new AbortController();

            fetch(
                `${searchUrl}?type=title&search=${encodeURIComponent(value)}`,
                {
                    headers: {
                        'Accept': 'application/json'
                    },
                    signal: titleRequest.signal
                }
            )
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to search job titles.');
                }

                return response.json();
            })
            .then(results => {

                titleSuggestions.innerHTML = '';

                if (!results.length) {
                    titleSuggestions.classList.add('d-none');
                    return;
                }

                results.forEach(title => {

                    const li = document.createElement('li');

                    li.textContent = title;

                    li.addEventListener('click', function () {

                        addJobTitle(title);

                        titleSuggestions.innerHTML = '';
                        titleSuggestions.classList.add('d-none');

                        titleInput.value = '';
                    });

                    titleSuggestions.appendChild(li);
                });

                // SHOW DROPDOWN
                titleSuggestions.classList.remove('d-none');

            })
            .catch(error => {

                if (error.name === 'AbortError') {
                    return;
                }

                console.error('Job title search error:', error);

                titleSuggestions.innerHTML = '';
                titleSuggestions.classList.add('d-none');
            });
        });

        let locationRequest = null;

        locationInput.addEventListener('input', function () {

            const value = this.value.trim();

            // Always hide initially
            locationSuggestions.innerHTML = '';
            locationSuggestions.classList.add('d-none');

            if (value.length < 2) {
                return;
            }

            if (locationRequest) {
                locationRequest.abort();
            }

            locationRequest = new AbortController();

            fetch(
                `${searchUrl}?type=location&search=${encodeURIComponent(value)}`,
                {
                    headers: {
                        'Accept': 'application/json'
                    },
                    signal: locationRequest.signal
                }
            )
            .then(response => {

                if (!response.ok) {
                    throw new Error('Failed to search locations.');
                }

                return response.json();
            })
            .then(results => {

                locationSuggestions.innerHTML = '';

                if (!results.length) {
                    locationSuggestions.classList.add('d-none');
                    return;
                }

                results.forEach(location => {

                    const li = document.createElement('li');

                    li.textContent = location;

                    li.addEventListener('click', function () {

                        addJobLocation(location);

                        locationSuggestions.innerHTML = '';
                        locationSuggestions.classList.add('d-none');

                        locationInput.value = '';
                    });

                    locationSuggestions.appendChild(li);
                });

                // SHOW DROPDOWN
                locationSuggestions.classList.remove('d-none');

            })
            .catch(error => {

                if (error.name === 'AbortError') {
                    return;
                }

                console.error('Job location search error:', error);

                locationSuggestions.innerHTML = '';
                locationSuggestions.classList.add('d-none');
            });
        });

        function addJobTitle(value) {

            value = value.trim();

            if (!value) {
                return;
            }

            const exists = [
                ...jobTags.querySelectorAll(
                    'input[name="preferred_titles[]"]'
                )
            ].some(input =>
                input.value.toLowerCase() === value.toLowerCase()
            );

            if (exists) {
                titleInput.value = '';
                return;
            }

            const tag = document.createElement('span');

            tag.className = 'skilltag';

            tag.innerHTML = `
                ${escapeHtml(value)}

                <input type="hidden"
                    name="preferred_titles[]"
                    value="${escapeHtml(value)}">

                <button type="button"
                        class="tag-remove"
                        aria-label="Remove ${escapeHtml(value)}">
                    ×
                </button>
            `;

            jobTags.appendChild(tag);

            titleInput.value = '';
        }

        function addJobLocation(value) {

            value = value.trim();

            if (!value) {
                return;
            }

            const exists = [
                ...jobLocations.querySelectorAll(
                    'input[name="preferred_locations[]"]'
                )
            ].some(input =>
                input.value.toLowerCase() === value.toLowerCase()
            );

            if (exists) {
                locationInput.value = '';
                return;
            }

            const tag = document.createElement('span');

            tag.className = 'skilltag';

            tag.innerHTML = `
                ${escapeHtml(value)}

                <input type="hidden"
                    name="preferred_locations[]"
                    value="${escapeHtml(value)}">

                <button type="button"
                        class="tag-remove"
                        aria-label="Remove ${escapeHtml(value)}">
                    ×
                </button>
            `;

            jobLocations.appendChild(tag);

            locationInput.value = '';
        }
        
        window.addJobLocation = addJobLocation;

        jobTags.addEventListener('click', function (e) {

            const button = e.target.closest('.tag-remove');

            if (!button) {
                return;
            }

            button.closest('.skilltag').remove();
        });


        jobLocations.addEventListener('click', function (e) {

            const button = e.target.closest('.tag-remove');

            if (!button) {
                return;
            }

            button.closest('.skilltag').remove();
        });


        titleInput.addEventListener('keydown', function (e) {

            if (e.key === 'Enter') {

                e.preventDefault();

                addJobTitle(this.value);

                titleSuggestions.innerHTML = '';
                titleSuggestions.classList.add('d-none');
            }

        });


        locationInput.addEventListener('keydown', function (e) {

            if (e.key === 'Enter') {

                e.preventDefault();

                addJobLocation(this.value);

                locationSuggestions.innerHTML = '';
                locationSuggestions.classList.add('d-none');
            }

        });

        document.addEventListener('click', function (e) {

            if (!titleInput.contains(e.target) &&
                !titleSuggestions.contains(e.target)) {

                titleSuggestions.innerHTML = '';
                titleSuggestions.classList.add('d-none');
            }

            if (!locationInput.contains(e.target) &&
                !locationSuggestions.contains(e.target)) {

                locationSuggestions.innerHTML = '';
                locationSuggestions.classList.add('d-none');
            }

        });

        function escapeHtml(value) {

            const div = document.createElement('div');

            div.textContent = value;

            return div.innerHTML;
        }

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const projectModal = document.getElementById('addProjectModal');

        const projectForm = document.getElementById('projectForm');
        const projectId = document.getElementById('projectId');
        const projectTitle = document.getElementById('projectTitle');
        const projectDescription = document.getElementById('projectDescription');

        const modalTitle = document.getElementById('AddProject');

        projectModal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;

            // ADD PROJECT
            if (!button.hasAttribute('data-project-id')) {

                projectForm.reset();

                projectId.value = '';

                modalTitle.textContent = 'Add Project';

                return;
            }

            // EDIT PROJECT
            const id = button.getAttribute('data-project-id');
            const title = button.getAttribute('data-project-title') || '';
            const description = button.getAttribute('data-project-description') || '';

            projectId.value = id;
            projectTitle.value = title;
            projectDescription.value = description;

            modalTitle.textContent = 'Edit Project';
        });


        projectForm.addEventListener('submit', function (e) {

            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const saveBtn = form.querySelector('.btn-save');

            saveBtn.disabled = true;
            saveBtn.textContent = 'Saving...';

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(async response => {

                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })
            .then(data => {

                if (data.status) {

                    alert(data.message);

                    $('#addProjectModal').modal('hide');

                    window.location.reload();
                }
            })
            .catch(error => {

                console.error(error);

                if (error.errors) {

                    let messages = [];

                    Object.values(error.errors).forEach(errors => {
                        messages.push(...errors);
                    });

                    alert(messages.join('\n'));

                } else {

                    alert(
                        error.message ||
                        'Something went wrong.'
                    );
                }
            })
            .finally(() => {

                saveBtn.disabled = false;
                saveBtn.textContent = 'Save';

            });

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const skillInput = document.getElementById('skillSearchInput');
        const suggestions = document.getElementById('skillsSuggestions');
        const skillsTags = document.getElementById('skillsTags');

        const searchUrl =
            "{{ route('jobseekers.profile.skills.search') }}";

        skillInput.addEventListener('input', function () {

            const value = this.value.trim();

            // Hide initially / when less than 2 characters
            if (value.length < 2) {

                suggestions.innerHTML = '';
                suggestions.classList.add('d-none');

                return;
            }


            fetch(
                `${searchUrl}?search=${encodeURIComponent(value)}`,
                {
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            )
            .then(response => response.json())
            .then(results => {

                suggestions.innerHTML = '';

                if (!results.length) {

                    suggestions.classList.add('d-none');

                    return;
                }


                results.forEach(skill => {

                    const li = document.createElement('li');

                    li.textContent = skill;

                    li.addEventListener('click', function () {

                        addSkill(skill);

                        skillInput.value = '';

                        suggestions.innerHTML = '';
                        suggestions.classList.add('d-none');

                    });

                    suggestions.appendChild(li);

                });


                suggestions.classList.remove('d-none');

            })
            .catch(error => {

                console.error('Skill search error:', error);

                suggestions.innerHTML = '';
                suggestions.classList.add('d-none');

            });

        });

        function addSkill(skillName)
        {
            skillName = skillName.trim();

            if (!skillName) {
                return;
            }


            // Check duplicate
            const exists = [
                ...skillsTags.querySelectorAll(
                    'input[name="skills[]"]'
                )
            ].some(input =>
                input.value.toLowerCase() === skillName.toLowerCase()
            );


            if (exists) {
                return;
            }


            const tag = document.createElement('span');

            tag.className = 'skilltag';

            tag.innerHTML = `
                ${escapeHtml(skillName)}

                <input type="hidden"
                    name="skills[]"
                    value="${escapeHtml(skillName)}">

                <button type="button"
                        class="tag-remove">
                    ×
                </button>
            `;


            skillsTags.appendChild(tag);
        }

        skillsTags.addEventListener('click', function (e) {

            const removeButton =
                e.target.closest('.tag-remove');

            if (!removeButton) {
                return;
            }

            removeButton
                .closest('.skilltag')
                .remove();

        });

        skillInput.addEventListener('keydown', function (e) {

            if (e.key !== 'Enter') {
                return;
            }

            e.preventDefault();

            const value = this.value.trim();

            if (!value) {
                return;
            }

            addSkill(value);

            this.value = '';

            suggestions.innerHTML = '';
            suggestions.classList.add('d-none');

        });

        function escapeHtml(value)
        {
            const div = document.createElement('div');

            div.textContent = value;

            return div.innerHTML;
        }

        document.addEventListener('click', function (e) {

            if (
                !skillInput.contains(e.target) &&
                !suggestions.contains(e.target)
            ) {
                suggestions.innerHTML = '';
                suggestions.classList.add('d-none');
            }

        });

    });
</script>

<script>
    document.getElementById('skillsForm').addEventListener('submit', function (e) {

        e.preventDefault();

        const form = this;

        const formData = new FormData(form);

        const saveBtn = form.querySelector('.btn-save');


        saveBtn.disabled = true;
        saveBtn.textContent = 'Saving...';


        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })

        .then(async response => {

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;

        })

        .then(data => {

            if (data.status) {

                alert(data.message);

                $('#addSkillsModal').modal('hide');

                window.location.reload();
            }

        })

        .catch(error => {

            console.error(error);

            if (error.errors) {

                let messages = [];

                Object.values(error.errors).forEach(errors => {
                    messages.push(...errors);
                });

                alert(messages.join('\n'));

            } else {

                alert(
                    error.message ||
                    'Something went wrong.'
                );

            }

        })

        .finally(() => {

            saveBtn.disabled = false;
            saveBtn.textContent = 'Save';

        });

    });
</script>

<script>
    document.getElementById('socialLinksForm').addEventListener('submit', function (e) {

        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const saveBtn = form.querySelector('.btn-save');

        saveBtn.disabled = true;
        saveBtn.textContent = 'Saving...';

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(async response => {

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {

            if (data.status) {

                alert(data.message);

                $('#addSocialModal').modal('hide');

                window.location.reload();
            }
        })
        .catch(error => {

            console.error(error);

            if (error.errors) {

                let messages = [];

                Object.values(error.errors).forEach(errors => {
                    messages.push(...errors);
                });

                alert(messages.join('\n'));

            } else {

                alert(error.message || 'Something went wrong.');
            }
        })
        .finally(() => {

            saveBtn.disabled = false;
            saveBtn.textContent = 'Save';
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const langSelect = document.getElementById('langSelect');
        const langLevel = document.getElementById('langLevel');
        const addLanguageBtn = document.getElementById('addLanguageBtn');
        const langList = document.getElementById('langList');
        const languageForm = document.getElementById('languageForm');

        /*
        |--------------------------------------------------------------------------
        | Add / Update Language
        |--------------------------------------------------------------------------
        */
        addLanguageBtn.addEventListener('click', function () {

            const language = langSelect.value.toLowerCase().trim();
            const languageText =
                langSelect.options[langSelect.selectedIndex]?.text;

            const level = langLevel.value;

            if (!language) {
                alert('Please select a language.');
                return;
            }

            if (!level) {
                alert('Please select language level.');
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Check existing language
            |--------------------------------------------------------------------------
            */
            const existingRow = [...langList.querySelectorAll('.lang-row')]
            .find(row =>
                row.dataset.language.toLowerCase() === language.toLowerCase()
            );

            if (existingRow) {

                /*
                |--------------------------------------------------------------------------
                | Update existing language
                |--------------------------------------------------------------------------
                */

                const hiddenInput = existingRow.querySelector(
                    'input[name^="languages["]'
                );

                hiddenInput.value = level;

                const levelChip = existingRow.querySelector('.level-chip');

                levelChip.className =
                    'level-chip level-' + level.toLowerCase();

                levelChip.innerHTML = `
                    ${escapeHtml(capitalize(level))}

                    <button type="button"
                            class="lang-remove-btn">
                        ✕
                    </button>
                `;

            } else {

                /*
                |--------------------------------------------------------------------------
                | Add new language
                |--------------------------------------------------------------------------
                */

                const row = document.createElement('div');

                row.className = 'lang-row';

                row.dataset.language = language;

                row.innerHTML = `
                    <span>${escapeHtml(languageText)}</span>

                    <input type="hidden"
                        name="languages[${escapeHtml(language)}]"
                        value="${escapeHtml(level)}">

                    <span class="level-chip level-${level.toLowerCase()}">
                        ${escapeHtml(capitalize(level))}

                        <button type="button"
                                class="lang-remove-btn">
                            ✕
                        </button>
                    </span>
                `;

                langList.appendChild(row);
            }

            /*
            |--------------------------------------------------------------------------
            | Reset
            |--------------------------------------------------------------------------
            */

            langSelect.value = '';
            langLevel.value = 'Basic';
        });


        /*
        |--------------------------------------------------------------------------
        | Remove Language
        |--------------------------------------------------------------------------
        */

        langList.addEventListener('click', function (e) {

            const removeBtn = e.target.closest('.lang-remove-btn');

            if (!removeBtn) {
                return;
            }

            const row = removeBtn.closest('.lang-row');

            if (row) {
                row.remove();
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Edit Language
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll(
            '#languages .lang-card .edit-btn'
        ).forEach(function (button) {

            button.addEventListener('click', function () {

                const language = this.dataset.language;

                const row = Array.from(
                    langList.querySelectorAll('.lang-row')
                ).find(row => row.dataset.language === language);

                if (!row) {
                    return;
                }

                const hiddenInput = row.querySelector(
                    'input[name^="languages["]'
                );

                if (!hiddenInput) {
                    return;
                }

                langSelect.value = language;
                langLevel.value = hiddenInput.value;
            });
        });


        /*
        |--------------------------------------------------------------------------
        | Submit
        |--------------------------------------------------------------------------
        */

        languageForm.addEventListener('submit', function (e) {

            e.preventDefault();

            const form = this;
            const saveBtn = form.querySelector('.btn-save');

            /*
            |--------------------------------------------------------------------------
            | Check at least one language
            |--------------------------------------------------------------------------
            */

            const languageInputs = langList.querySelectorAll(
                'input[name^="languages["]'
            );

            if (languageInputs.length === 0) {

                alert('Please add at least one language.');

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | FormData
            |--------------------------------------------------------------------------
            */

            const formData = new FormData(form);

            console.log(
                'Languages:',
                [...formData.entries()]
            );

            saveBtn.disabled = true;
            saveBtn.textContent = 'Saving...';

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async response => {

                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })
            .then(data => {

                if (data.status) {

                    alert(data.message);

                    $('#addLanguageModal').modal('hide');

                    window.location.reload();
                }
            })
            .catch(error => {

                console.error(error);

                if (error.errors) {

                    let messages = [];

                    Object.values(error.errors).forEach(errors => {
                        messages.push(...errors);
                    });

                    alert(messages.join('\n'));

                } else {

                    alert(
                        error.message ||
                        'Something went wrong.'
                    );
                }
            })
            .finally(() => {

                saveBtn.disabled = false;
                saveBtn.textContent = 'Save';
            });
        });


        /*
        |--------------------------------------------------------------------------
        | Helpers
        |--------------------------------------------------------------------------
        */

        function capitalize(value) {

            return value.charAt(0).toUpperCase() +
                value.slice(1);
        }


        function escapeHtml(value) {

            const div = document.createElement('div');

            div.textContent = value;

            return div.innerHTML;
        }

    });
</script>

<script>
    window.initLocationAutocomplete = async function () {
        const input = document.getElementById('jobLocationInput');
        const suggestionsList = document.getElementById('jobLocationSuggestions');
    
        if (!input || !suggestionsList) {
            console.error('Location input or suggestions list not found');
            return;
        }
    
        try {
            const { AutocompleteSuggestion } =
                await google.maps.importLibrary('places');
    
            let debounceTimer;
            let requestId = 0;
    
            input.addEventListener('input', () => {
                clearTimeout(debounceTimer);
    
                const query = input.value.trim();
                const currentRequest = ++requestId;
    
                suggestionsList.innerHTML = '';
                suggestionsList.classList.add('d-none');
    
                if (query.length < 2) return;
    
                debounceTimer = setTimeout(async () => {
                    try {
                        const { suggestions = [] } =
                            await AutocompleteSuggestion
                                .fetchAutocompleteSuggestions({
                                    input: query
                                });
    
                        // Ignore outdated responses.
                        if (currentRequest !== requestId) return;
    
                        suggestionsList.innerHTML = '';
    
                        suggestions.forEach((suggestion) => {
                            const prediction = suggestion.placePrediction;
                            if (!prediction) return;
    
                            const li = document.createElement('li');
                            li.textContent = prediction.text.toString();
                            li.style.cursor = 'pointer';
    
                            li.addEventListener('click', async () => {
                                try {
                                    const place = prediction.toPlace();
    
                                    await place.fetchFields({
                                        fields: [
                                            'displayName',
                                            'formattedAddress'
                                        ]
                                    });
    
                                    const locationName =
                                        place.formattedAddress ||
                                        place.displayName;
    
                                    if (locationName) {
                                        input.value = locationName;
    
                                        if (typeof window.addJobLocation === 'function') {
                                            window.addJobLocation(locationName);
                                        }
                                    }
    
                                    suggestionsList.innerHTML = '';
                                    suggestionsList.classList.add('d-none');
                                } catch (error) {
                                    console.error('Place selection error:', error);
                                }
                            });
    
                            suggestionsList.appendChild(li);
                        });
    
                        suggestionsList.classList.toggle(
                            'd-none',
                            suggestionsList.children.length === 0
                        );
                    } catch (error) {
                        console.error('Autocomplete error:', error);
                    }
                }, 300);
            });
    
            // Hide suggestions when clicking outside.
            document.addEventListener('click', (event) => {
                if (
                    !input.contains(event.target) &&
                    !suggestionsList.contains(event.target)
                ) {
                    suggestionsList.classList.add('d-none');
                }
            });
    
        } catch (error) {
            console.error('Google Places initialization error:', error);
        }
    };
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const titleInput = document.getElementById('jobTitleInput');
        const locationInput = document.getElementById('jobLocationInput');

        const jobTags = document.getElementById('jobTags');
        const jobLocations = document.getElementById('joblocation');


        // ==========================================
        // ADD JOB TITLE
        // ==========================================

        function addJobTitle(value) {

            value = value.trim();

            if (!value) {
                return;
            }

            // Prevent duplicate
            let existing = [...jobTags.querySelectorAll('input[name="preferred_titles[]"]')]
                .some(input => input.value.toLowerCase() === value.toLowerCase());

            if (existing) {
                titleInput.value = '';
                return;
            }

            const tag = document.createElement('span');

            tag.className = 'skilltag';

            tag.innerHTML = `
                ${escapeHtml(value)}

                <input type="hidden"
                    name="preferred_titles[]"
                    value="${escapeHtml(value)}">

                <button type="button"
                        class="tag-remove">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="14"
                        height="14"
                        viewBox="0 0 14 14"
                        fill="none">

                        <path d="M10.5 3.5L3.5 10.5"
                            stroke="white"
                            stroke-width="1.77083"
                            stroke-linecap="round"/>

                        <path d="M3.5 3.5L10.5 10.5"
                            stroke="white"
                            stroke-width="1.77083"
                            stroke-linecap="round"/>

                    </svg>
                </button>
            `;

            jobTags.appendChild(tag);

            titleInput.value = '';
        }


        // ==========================================
        // ADD JOB LOCATION
        // ==========================================

        function addJobLocation(value) {

            value = value.trim();

            if (!value) {
                return;
            }

            // Prevent duplicate
            let existing = [...jobLocations.querySelectorAll('input[name="preferred_locations[]"]')]
                .some(input => input.value.toLowerCase() === value.toLowerCase());

            if (existing) {
                locationInput.value = '';
                return;
            }

            const tag = document.createElement('span');

            tag.className = 'skilltag';

            tag.innerHTML = `
                ${escapeHtml(value)}

                <input type="hidden"
                    name="preferred_locations[]"
                    value="${escapeHtml(value)}">

                <button type="button"
                        class="tag-remove">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="14"
                        height="14"
                        viewBox="0 0 14 14"
                        fill="none">

                        <path d="M10.5 3.5L3.5 10.5"
                            stroke="white"
                            stroke-width="1.77083"
                            stroke-linecap="round"/>

                        <path d="M3.5 3.5L10.5 10.5"
                            stroke="white"
                            stroke-width="1.77083"
                            stroke-linecap="round"/>

                    </svg>
                </button>
            `;

            jobLocations.appendChild(tag);

            locationInput.value = '';
        }


        // ==========================================
        // ENTER KEY
        // ==========================================

        titleInput.addEventListener('keydown', function (e) {

            if (e.key === 'Enter') {

                e.preventDefault();

                addJobTitle(this.value);
            }

        });


        locationInput.addEventListener('keydown', function (e) {

            if (e.key === 'Enter') {

                e.preventDefault();

                addJobLocation(this.value);
            }

        });


        // ==========================================
        // CLICK REMOVE
        // ==========================================

        jobTags.addEventListener('click', function (e) {

            const button = e.target.closest('.tag-remove');

            if (button) {
                button.closest('.skilltag').remove();
            }

        });


        jobLocations.addEventListener('click', function (e) {

            const button = e.target.closest('.tag-remove');

            if (button) {
                button.closest('.skilltag').remove();
            }

        });


        // ==========================================
        // HTML ESCAPE
        // ==========================================

        function escapeHtml(value) {

            const div = document.createElement('div');

            div.textContent = value;

            return div.innerHTML;
        }


        // ==========================================
        // FORM SUBMIT
        // ==========================================

        document.getElementById('jobPreferenceForm')
            .addEventListener('submit', function (e) {

                e.preventDefault();

                const form = this;

                const saveBtn = form.querySelector('.btn-save');

                // ----------------------------------
                // Check titles
                // ----------------------------------

                const titles = form.querySelectorAll(
                    'input[name="preferred_titles[]"]'
                );

                // ----------------------------------
                // Check locations
                // ----------------------------------

                const locations = form.querySelectorAll(
                    'input[name="preferred_locations[]"]'
                );


                if (titles.length === 0) {

                    alert('Please add at least one preferred job title.');

                    titleInput.focus();

                    return;
                }


                if (locations.length === 0) {

                    alert('Please add at least one preferred job location.');

                    locationInput.focus();

                    return;
                }


                // ----------------------------------
                // Submit
                // ----------------------------------

                const formData = new FormData(form);

                saveBtn.disabled = true;
                saveBtn.textContent = 'Saving...';


                fetch(form.action, {

                    method: 'POST',

                    body: formData,

                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute('content')
                    }

                })

                .then(async response => {

                    const data = await response.json();

                    if (!response.ok) {
                        throw data;
                    }

                    return data;

                })

                .then(data => {

                    if (data.status) {

                        alert(data.message);

                        $('#jobPreferenceModal').modal('hide');

                        window.location.reload();
                    }

                })

                .catch(error => {

                    console.error(error);

                    if (error.errors) {

                        let messages = [];

                        Object.values(error.errors).forEach(errors => {

                            messages.push(...errors);

                        });

                        alert(messages.join('\n'));

                    } else {

                        alert(
                            error.message ||
                            'Something went wrong.'
                        );
                    }

                })

                .finally(() => {

                    saveBtn.disabled = false;
                    saveBtn.textContent = 'Save';

                });

            });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    
        const input = document.getElementById('resumeInput');
        const btn = document.getElementById('resumeBtn');
        
        console.log('Resume script loaded');
        console.log('Input:', input);
        console.log('Button:', btn);
        
             if (!input || !btn) {
            console.error('Resume input or upload button not found');
            return;
        } 
    
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            input.click();
        });
    
        input.addEventListener('change', function () {
            
            console.log('File input changed');
    
            if (!this.files || !this.files.length) {
                console.log('No file selected');
                return;
            }
    
            const file = this.files[0];
            
            console.log('Selected file:', file.name);
            console.log('File size:', file.size);
            console.log('File type:', file.type);
    
            const fd = new FormData();
            fd.append('resume', file);
    
            btn.disabled = true;
            showLoder();
    
            fetch("{{ route('jobseekers.profile.upload.resume') }}", {
                method: 'POST',
                credentials: 'same-origin',
    
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
    
                body: fd
            })
            .then(async response => {
    
                const data = await response.json();
    
                if (!response.ok) {
                    throw new Error(
                        data.message || 'Resume upload failed.'
                    );
                }
    
                return data;
            })
            .then(data => {
    
                btn.disabled = false;
                hideLoder();
    
                if (data.status === true || data.status === 'success') {
    
                    // Close upload modal
                    const modalEl = document.getElementById(
                        'profileuploaddocumentmodal'
                    );
    
                    if (modalEl) {
    
                        const modal =
                            bootstrap.Modal.getInstance(modalEl);
    
                        if (modal) {
                            modal.hide();
                        }
                    }
    
                    // Optional:
                    // Reload page so all extracted profile details
                    // become visible immediately.
                    window.location.reload();
    
                } else {
    
                    alert(
                        data.message ||
                        'Resume parsing failed.'
                    );
                }
            })
            .catch(error => {
    
                btn.disabled = false;
                hideLoder();
    
                console.error('Resume Upload Error:', error);
    
                alert(
                    error.message ||
                    'Something went wrong while uploading your resume.'
                );
            });
    
            // Clear file input
            this.value = '';
        });
    
    });
</script>

<script>
    (function () {
    const MONTHS = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
    const GAP = 8; 

    const fmt = d =>
        d.toLocaleString('en', { month: 'short' }) + " '" + String(d.getFullYear()).slice(2);

    function parseRange(text) {
        const m = text.match(/([A-Za-z]{3})[a-z]*\s+(\d{4})\s*-\s*(?:([A-Za-z]{3})[a-z]*\s+(\d{4})|Present)/i);
        if (!m) return null;
        const start = new Date(+m[2], MONTHS.indexOf(m[1].toLowerCase()), 1);
        const end = m[3] ? new Date(+m[4], MONTHS.indexOf(m[3].toLowerCase()), 1) : null;
        return { start, end };
    }

    function renderTimeline(root) {
        const labelsEl = root.querySelector('.timeline-labels');
        const barEl = root.querySelector('.timeline-bar');
        if (!labelsEl || !barEl) return;

        // 1. Saari experiences se dates collect karo
        const now = new Date();
        const today = new Date(now.getFullYear(), now.getMonth(), 1);
        const points = new Map(); // key: month index -> {date, label}

        const add = (date, label) => {
        const key = date.getFullYear() * 12 + date.getMonth();
        const p = points.get(key);
        if (!p) points.set(key, { date, label: label || fmt(date) });
        else if (label) p.label = label; // "Till date" ko priority
        };

        root.querySelectorAll('.exp-item .des').forEach(des => {
        const r = parseRange(des.textContent);
        if (!r) return;
        add(r.start);
        r.end ? add(r.end) : add(today, 'Till date');
        });

        const list = [...points.values()].sort((a, b) => a.date - b.date);
        if (!list.length) return;

        const min = list[0].date.getTime();
        const max = list[list.length - 1].date.getTime();
        const range = Math.max(max - min, 1);
        list.forEach(p => (p.pct = ((p.date.getTime() - min) / range) * 100));

        // 2. DOM banao
        labelsEl.innerHTML = '';
        barEl.innerHTML = '';
        list.forEach(p => {
        const s = document.createElement('span');
        s.textContent = p.label;
        labelsEl.appendChild(s);

        const n = document.createElement('span');
        n.className = 'node';
        n.style.left = p.pct + '%';
        barEl.appendChild(n);
        });

        // 3. Labels ki position + overlap hide
        const spans = [...labelsEl.children];
        const W = labelsEl.clientWidth;
        const lastIdx = spans.length - 1;

        const box = spans.map((s, i) => {
        const w = s.offsetWidth;
        const x = (list[i].pct / 100) * W;
        const left = Math.min(Math.max(x - w / 2, 0), Math.max(W - w, 0));
        s.style.transform = 'none';          // <-- ye add karo
        s.style.left = left + 'px';
        return { left, right: left + w };
        });

        let lastRight = -Infinity;
        spans.forEach((s, i) => {
        let show;
        if (i === lastIdx) {
            show = true; // last label hamesha dikhega
        } else {
            show = box[i].left >= lastRight + GAP &&
                box[i].right + GAP <= box[lastIdx].left;
        }
        s.style.visibility = show ? 'visible' : 'hidden';
        if (show) lastRight = box[i].right;
        });
    }

    function init() {
        const root = document.querySelector('#workexperience');
        if (!root) return;
        renderTimeline(root);
        let t;
        window.addEventListener('resize', () => {
        clearTimeout(t);
        t = setTimeout(() => renderTimeline(root), 100);
        });
        window.renderWorkTimeline = () => renderTimeline(root); // experience add/edit/delete ke baad call karo
    }

    document.readyState === 'loading'
        ? document.addEventListener('DOMContentLoaded', init)
        : init();
    })();
</script>

@if($freelancer->profile_complete == 0 && empty($freelancer->resume))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const profileModal = new bootstrap.Modal(
                document.getElementById('profileuploaddocumentmodal')
            );
        
            profileModal.show();
        });
    </script>
@endif

<script async
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&loading=async&libraries=places&callback=initLocationAutocomplete&v=weekly">
</script>
@endsection