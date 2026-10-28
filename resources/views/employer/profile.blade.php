@extends('employer.layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/company-profile-page.css') }}?v={{ filemtime(public_path('frontend/css/company-profile-page.css')) }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">

@php
$documents = $documents ?? collect();

$services = $services ?? collect();

$teamMembers = $teamMembers ?? collect();

$socialLinks = $socialLinks ?? collect();

$languages = $languages ?? collect();

$recentJobs = $recentJobs ?? collect();

$hiringPreferences = $hiringPreferences ?? null;

$personalDetailsCompleted =
!empty($company->company_name) &&
!empty($company->profile_photo) &&
!empty($company->website) &&
!empty($company->city) &&
!empty($company->state) &&
!empty($company->country);


$companyOverviewCompleted =
!empty($company->description);


$documentsCompleted =
$documents->isNotEmpty();


$servicesCompleted =
$services->isNotEmpty();


$teamCompleted =
$teamMembers->isNotEmpty();


$hiringCompleted =
!empty($hiringPreferences);


$liveJobsCompleted =
$recentJobs->isNotEmpty();


$socialLinksCompleted =
$socialLinks->isNotEmpty();


$languagesCompleted =
$languages->isNotEmpty();

$profileScore = 0;


if ($personalDetailsCompleted) {
$profileScore += 5;
}

if ($companyOverviewCompleted) {
$profileScore += 20;
}

if ($documentsCompleted) {
$profileScore += 25;
}

if ($servicesCompleted) {
$profileScore += 10;
}

if ($teamCompleted) {
$profileScore += 10;
}

if ($hiringCompleted) {
$profileScore += 10;
}

if ($liveJobsCompleted) {
$profileScore += 10;
}

if ($socialLinksCompleted) {
$profileScore += 5;
}

if ($languagesCompleted) {
$profileScore += 5;
}

@endphp

<section class="company-user-page">
    <img src="{{ asset('frontend/images/bg-img1.png') }}" class="bg-img1" alt="">
    <img src="{{ asset('frontend/images/bg-img2.png') }}" class="bg-img2" alt="">
    <img src="{{ asset('frontend/images/bg-img3.png') }}" class="bg-img3" alt="">

    <div class="profile-inner-box">
        <!-- ===== SIDEBAR ===== -->
        <aside>
            <div class="side-card" id="personaldetails">
                <div class="profile-head">
                    <div class="avatar">
                        <img
                            src="{{ $company->profile_photo ?: asset('frontend/images/default-avatar.png') }}"
                            alt="{{ $company->company_name }}"
                            onerror="this.onerror=null;this.src='{{ asset('frontend/images/default-avatar.png') }}'">
                    </div>
                    <div class="freenlan-info">
                        <h2>{{ $company->company_name }}</h2>
                        <div class="website-link">
                            @if(!empty($company->website))
                            <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer">
                                {{ parse_url($company->website, PHP_URL_HOST) ?: $company->website }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M9 7L14 2M10.6667 2H14V5.33333M14 9.33333V12.6667C14 13.0203 13.8595 13.3594 13.6095 13.6095C13.3594 13.8595 13.0203 14 12.6667 14H3.33333C2.97971 14 2.64057 13.8595 2.39052 13.6095C2.14048 13.3594 2 13.0203 2 12.6667V3.33333C2 2.97971 2.14048 2.64057 2.39052 2.39052C2.64057 2.14048 2.97971 2 3.33333 2H6.66667" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            @endif
                        </div>
                        @if(!empty($company->established_date))
                        <div class="duration">
                            Est. {{ \Carbon\Carbon::parse($company->established_date)->format('Y') }}
                        </div>
                        @endif
                        <div class="city">{{ $company->city }}, {{ $company->state_name }}</div>
                    </div>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#editModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_4046_4263)">
                                <path d="M14.1161 4.54419C14.4686 4.19181 14.6666 3.71384 14.6667 3.21543C14.6668 2.71702 14.4688 2.239 14.1165 1.88652C13.7641 1.53405 13.2861 1.336 12.7877 1.33594C12.2893 1.33587 11.8113 1.53381 11.4588 1.88619L2.56145 10.7855C2.40667 10.9399 2.29219 11.1299 2.22812 11.3389L1.34745 14.2402C1.33022 14.2978 1.32892 14.3591 1.34369 14.4174C1.35845 14.4758 1.38873 14.529 1.43132 14.5715C1.4739 14.614 1.5272 14.6442 1.58556 14.6589C1.64392 14.6736 1.70516 14.6722 1.76279 14.6549L4.66479 13.7749C4.87357 13.7114 5.06357 13.5976 5.21812 13.4435L14.1161 4.54419Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_4046_4263">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>

                <div class="linebar"></div>

                <div class="stats-row">
                    <div>
                        <div class="stat-label">City</div>
                        <div class="stat-value">{{ $company->city ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="stat-label">Industry</div>
                        <div class="stat-value">{{ $company->industry ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="stat-label">Employees</div>
                        <div class="stat-value">{{ $company->company_size ?? '—' }}</div>
                    </div>
                </div>

                <div class="linebar"></div>

                <div class="updated-line">
                    <span class="dot"></span> Profile last updated on: {{ \Carbon\Carbon::parse($company->updated_at)->format('j M, Y') }}
                </div>

                <div class="contact-line">
                    <div class="sapdiv">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M14.6665 11.2827V13.2827C14.6672 13.4683 14.6292 13.6521 14.5548 13.8222C14.4804 13.9924 14.3713 14.1451 14.2345 14.2706C14.0977 14.3961 13.9362 14.4917 13.7603 14.5511C13.5844 14.6106 13.398 14.6327 13.2131 14.616C11.1617 14.3931 9.19113 13.6921 7.45979 12.5693C5.84901 11.5458 4.48335 10.1801 3.45979 8.56934C2.33311 6.83014 1.63195 4.85 1.41313 2.78934C1.39647 2.60498 1.41838 2.41918 1.47746 2.24375C1.53654 2.06833 1.63151 1.90713 1.7563 1.77042C1.8811 1.6337 2.033 1.52448 2.20232 1.44968C2.37164 1.37489 2.55469 1.33618 2.73979 1.336H4.73979C5.06333 1.33282 5.37699 1.44739 5.6223 1.65836C5.86761 1.86933 6.02784 2.1623 6.07313 2.48267C6.15754 3.12271 6.31409 3.75115 6.53979 4.356C6.62949 4.59462 6.6489 4.85395 6.59573 5.10326C6.54256 5.35257 6.41903 5.58141 6.23979 5.76267L5.39313 6.60934C6.34216 8.27837 7.7241 9.6603 9.39313 10.6093L10.2398 9.76267C10.4211 9.58343 10.6499 9.4599 10.8992 9.40673C11.1485 9.35356 11.4078 9.37297 11.6465 9.46267C12.2513 9.68837 12.8797 9.84492 13.5198 9.92934C13.8436 9.97502 14.1394 10.1381 14.3508 10.3877C14.5622 10.6372 14.6746 10.9557 14.6665 11.2827Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>{{ $company->phone ?? '—' }}</span>
                    </div>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#contactModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_4046_4263)">
                                <path d="M14.1161 4.54419C14.4686 4.19181 14.6666 3.71384 14.6667 3.21543C14.6668 2.71702 14.4688 2.239 14.1165 1.88652C13.7641 1.53405 13.2861 1.336 12.7877 1.33594C12.2893 1.33587 11.8113 1.53381 11.4588 1.88619L2.56145 10.7855C2.40667 10.9399 2.29219 11.1299 2.22812 11.3389L1.34745 14.2402C1.33022 14.2978 1.32892 14.3591 1.34369 14.4174C1.35845 14.4758 1.38873 14.529 1.43132 14.5715C1.4739 14.614 1.5272 14.6442 1.58556 14.6589C1.64392 14.6736 1.70516 14.6722 1.76279 14.6549L4.66479 13.7749C4.87357 13.7114 5.06357 13.5976 5.21812 13.4435L14.1161 4.54419Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_4046_4263">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>

                <div class="contact-line">
                    <div class="sapdiv">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M13.3335 2.66406H2.66683C1.93045 2.66406 1.3335 3.26102 1.3335 3.9974V11.9974C1.3335 12.7338 1.93045 13.3307 2.66683 13.3307H13.3335C14.0699 13.3307 14.6668 12.7338 14.6668 11.9974V3.9974C14.6668 3.26102 14.0699 2.66406 13.3335 2.66406Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.6668 4.66406L8.68683 8.46406C8.48101 8.59301 8.24304 8.6614 8.00016 8.6614C7.75728 8.6614 7.51931 8.59301 7.3135 8.46406L1.3335 4.66406" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>{{ $company->email ?? '—' }}</span>
                    </div>
                </div>

                <button class="profile-score" data-bs-toggle="modal" data-bs-target="#profileScore">
                    <p>
                        <strong>{{ $profileScore }}%</strong>
                        of your Profile has been completed !
                    </p>
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

                [
                'anchor' => 'personaldetails',
                'label' => 'Personal details',
                'weight' => 5,
                'done' => $personalDetailsCompleted
                ],

                [
                'anchor' => 'companyoverview',
                'label' => 'Company Overview',
                'weight' => 20,
                'done' => $companyOverviewCompleted
                ],

                [
                'anchor' => 'documents',
                'label' => 'Company Documents',
                'weight' => 25,
                'done' => $documentsCompleted
                ],

                [
                'anchor' => 'services',
                'label' => 'Services Offered',
                'weight' => 10,
                'done' => $servicesCompleted
                ],

                [
                'anchor' => 'teammember',
                'label' => 'Key Team Members',
                'weight' => 10,
                'done' => $teamCompleted
                ],

                [
                'anchor' => 'hiringpreferences',
                'label' => 'Hiring Preferences',
                'weight' => 10,
                'done' => $hiringCompleted
                ],

                [
                'anchor' => 'livejobposting',
                'label' => 'Live Job Postings',
                'weight' => 10,
                'done' => $liveJobsCompleted
                ],

                [
                'anchor' => 'sociallinks',
                'label' => 'Social Links',
                'weight' => 5,
                'done' => $socialLinksCompleted
                ],

                [
                'anchor' => 'languages',
                'label' => 'Languages',
                'weight' => 5,
                'done' => $languagesCompleted
                ],

                ];

                @endphp

                @foreach($pendingActions as $action)

                @if(!$action['done'])

                <a href="#{{ $action['anchor'] }}">
                    <div class="pending-item">
                        <div class="left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            {{ $action['label'] }}
                        </div>
                        <span class="badge"> +{{ $action['weight'] }}%</span>
                    </div>
                </a>

                @endif

                @endforeach
            </div>
        </aside>
        <!-- ===== SIDEBAR ===== -->

        <div class="aside-right-box">
            <div class="navtabs">
                <a href="#companyoverview" class="active">Company Overview</a>
                <a href="#documents">Documents</a>
                <a href="#services">Services</a>
                <a href="#teammember">Team</a>
                <a href="#hiringpreferences">Hiring</a>
                <a href="#livejobposting">Live Job</a>
                <a href="#sociallinks">Social Links</a>
                <a href="#languages">Languages</a>
            </div>

            <div class="profile-summary" id="companyoverview">
                <div class="card-head">
                    <h3>Company Overview</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#companyoverviewModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_4046_4263)">
                                <path d="M14.1161 4.54419C14.4686 4.19181 14.6666 3.71384 14.6667 3.21543C14.6668 2.71702 14.4688 2.239 14.1165 1.88652C13.7641 1.53405 13.2861 1.336 12.7877 1.33594C12.2893 1.33587 11.8113 1.53381 11.4588 1.88619L2.56145 10.7855C2.40667 10.9399 2.29219 11.1299 2.22812 11.3389L1.34745 14.2402C1.33022 14.2978 1.32892 14.3591 1.34369 14.4174C1.35845 14.4758 1.38873 14.529 1.43132 14.5715C1.4739 14.614 1.5272 14.6442 1.58556 14.6589C1.64392 14.6736 1.70516 14.6722 1.76279 14.6549L4.66479 13.7749C4.87357 13.7114 5.06357 13.5976 5.21812 13.4435L14.1161 4.54419Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_4046_4263">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
                <p class="summary-text">
                    {{ $company->about ?? 'No company overview added yet.' }}
                </p>
                <!--<button class="ai-btn" type="button" data-bs-toggle="modal" data-bs-target="#aiSummaryModal">-->
                <!--    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">-->
                <!--        <g clip-path="url(#clip0_4046_4437)">-->
                <!--            <path d="M6.62479 10.3361C6.56527 10.1054 6.44502 9.89484 6.27653 9.72636C6.10805 9.55788 5.8975 9.43762 5.66679 9.3781L1.57679 8.32344C1.50701 8.30363 1.4456 8.26161 1.40186 8.20373C1.35813 8.14586 1.33447 8.07531 1.33447 8.00277C1.33447 7.93024 1.35813 7.85968 1.40186 7.80181C1.4456 7.74394 1.50701 7.70191 1.57679 7.6821L5.66679 6.62677C5.89742 6.56731 6.10792 6.44715 6.27639 6.2788C6.44486 6.11044 6.56517 5.90003 6.62479 5.66944L7.67946 1.57944C7.69906 1.50938 7.74105 1.44766 7.799 1.4037C7.85696 1.35974 7.92771 1.33594 8.00046 1.33594C8.0732 1.33594 8.14395 1.35974 8.20191 1.4037C8.25987 1.44766 8.30185 1.50938 8.32146 1.57944L9.37546 5.66944C9.43497 5.90015 9.55523 6.1107 9.72371 6.27918C9.89219 6.44766 10.1027 6.56792 10.3335 6.62744L14.4235 7.68144C14.4938 7.70084 14.5558 7.74278 14.6 7.80082C14.6442 7.85887 14.6682 7.92981 14.6682 8.00277C14.6682 8.07573 14.6442 8.14667 14.6 8.20472C14.5558 8.26276 14.4938 8.3047 14.4235 8.3241L10.3335 9.3781C10.1027 9.43762 9.89219 9.55788 9.72371 9.72636C9.55523 9.89484 9.43497 10.1054 9.37546 10.3361L8.32079 14.4261C8.30118 14.4962 8.2592 14.5579 8.20124 14.6018C8.14328 14.6458 8.07254 14.6696 7.99979 14.6696C7.92704 14.6696 7.85629 14.6458 7.79834 14.6018C7.74038 14.5579 7.69839 14.4962 7.67879 14.4261L6.62479 10.3361Z" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />-->
                <!--            <path d="M13.3335 2V4.66667" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />-->
                <!--            <path d="M14.6667 3.33594H12" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />-->
                <!--            <path d="M2.6665 11.3359V12.6693" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />-->
                <!--            <path d="M3.33333 12H2" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />-->
                <!--        </g>-->
                <!--        <defs>-->
                <!--            <clipPath id="clip0_4046_4437">-->
                <!--                <rect width="16" height="16" fill="white" />-->
                <!--            </clipPath>-->
                <!--        </defs>-->
                <!--    </svg>-->
                <!--    Enhance by AI-->
                <!--</button>-->
            </div>

            <div class="profile-summary" id="documents">
                <div class="card-head">
                    <h3>Company Documents</h3>
                    <button class="edit-btn d-none" type="button" data-bs-toggle="modal" data-bs-target="#UploadResumeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_4046_4263)">
                                <path d="M14.1161 4.54419C14.4686 4.19181 14.6666 3.71384 14.6667 3.21543C14.6668 2.71702 14.4688 2.239 14.1165 1.88652C13.7641 1.53405 13.2861 1.336 12.7877 1.33594C12.2893 1.33587 11.8113 1.53381 11.4588 1.88619L2.56145 10.7855C2.40667 10.9399 2.29219 11.1299 2.22812 11.3389L1.34745 14.2402C1.33022 14.2978 1.32892 14.3591 1.34369 14.4174C1.35845 14.4758 1.38873 14.529 1.43132 14.5715C1.4739 14.614 1.5272 14.6442 1.58556 14.6589C1.64392 14.6736 1.70516 14.6722 1.76279 14.6549L4.66479 13.7749C4.87357 13.7114 5.06357 13.5976 5.21812 13.4435L14.1161 4.54419Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_4046_4263">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>

                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#UploadResumeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="doc-comp">
                    @forelse($documents as $document)
                    <div class="companydoc-row">
                        <div class="info-row">
                            <span class="pdf-badge">PDF</span>
                            <span class="name">{{ $document->document_name }}</span>
                        </div>
                        <div class="button-doc">
                            <button type="button" class="eye-btn" title="Eye document">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10Z" fill="#00A148"/>
                                    <path d="M15.4698 7.83C14.8817 6.30882 13.8608 4.99331 12.5332 4.04604C11.2056 3.09878 9.62953 2.56129 7.99979 2.5C6.37005 2.56129 4.79398 3.09878 3.46639 4.04604C2.1388 4.99331 1.11787 6.30882 0.529787 7.83C0.490071 7.93985 0.490071 8.06015 0.529787 8.17C1.11787 9.69118 2.1388 11.0067 3.46639 11.954C4.79398 12.9012 6.37005 13.4387 7.99979 13.5C9.62953 13.4387 11.2056 12.9012 12.5332 11.954C13.8608 11.0067 14.8817 9.69118 15.4698 8.17C15.5095 8.06015 15.5095 7.93985 15.4698 7.83ZM7.99979 11.25C7.357 11.25 6.72864 11.0594 6.19418 10.7023C5.65972 10.3452 5.24316 9.83758 4.99718 9.24372C4.75119 8.64986 4.68683 7.99639 4.81224 7.36596C4.93764 6.73552 5.24717 6.15642 5.70169 5.7019C6.15621 5.24738 6.73531 4.93785 7.36574 4.81245C7.99618 4.68705 8.64965 4.75141 9.24351 4.99739C9.83737 5.24338 10.3449 5.65994 10.7021 6.1944C11.0592 6.72886 11.2498 7.35721 11.2498 8C11.2485 8.86155 10.9056 9.68743 10.2964 10.2966C9.68722 10.9058 8.86133 11.2487 7.99979 11.25Z" fill="#00A148"/>
                                </svg>
                            </button>

                            <button type="button" class="deleted-btn delete-document-btn" data-id="{{ $document->id }}" title="Delete document">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M2 4H14" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12.6663 4V13.3333C12.6663 14 11.9997 14.6667 11.333 14.6667H4.66634C3.99967 14.6667 3.33301 14 3.33301 13.3333V4" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5.33301 4.0026V2.66927C5.33301 2.0026 5.99967 1.33594 6.66634 1.33594H9.33301C9.99967 1.33594 10.6663 2.0026 10.6663 2.66927V4.0026" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.66699 7.33594V11.3359" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.33301 7.33594V11.3359" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @empty

                    <p class="empty-text">
                        No company documents uploaded yet.
                    </p>

                    @endforelse
                </div>
            </div>

            <div class="profile-summary" id="services">
                <div class="card-head">
                    <h3>Services Offered</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addSkillsModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="chip-row">
                    @forelse($services as $service)

                    <span class="chip">
                        {{ $service->service_name }}
                    </span>

                    @empty

                    <p class="empty-text">
                        No services added yet.
                    </p>

                    @endforelse
                </div>
            </div>

            <div class="profile-summary" id="teammember">
                <div class="card-head">
                    <h3>Key Team Members</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                @forelse($teamMembers as $member)
                <div class="edu-item">
                    <span class="edu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M16.0651 8.19177C16.1994 8.13254 16.3133 8.03522 16.3928 7.91187C16.4723 7.78852 16.5139 7.64456 16.5123 7.49782C16.5108 7.35108 16.4663 7.20801 16.3843 7.08633C16.3022 6.96465 16.1863 6.86971 16.0508 6.81327L9.62259 3.88527C9.42717 3.79613 9.21488 3.75 9.00009 3.75C8.7853 3.75 8.57301 3.79613 8.37759 3.88527L1.95009 6.81027C1.81657 6.86875 1.70298 6.96487 1.62322 7.08688C1.54346 7.20889 1.50098 7.3515 1.50098 7.49727C1.50098 7.64304 1.54346 7.78565 1.62322 7.90766C1.70298 8.02967 1.81657 8.12579 1.95009 8.18427L8.37759 11.1153C8.57301 11.2044 8.7853 11.2505 9.00009 11.2505C9.21488 11.2505 9.42717 11.2044 9.62259 11.1153L16.0651 8.19177Z" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16.5 7.5V12" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.5 9.375V12C4.5 12.5967 4.97411 13.169 5.81802 13.591C6.66193 14.0129 7.80653 14.25 9 14.25C10.1935 14.25 11.3381 14.0129 12.182 13.591C13.0259 13.169 13.5 12.5967 13.5 12V9.375" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <div>
                        <h4>{{ $member->name }}
                            <button class="edit-btn" type="button" data-id="{{ $member->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M14.1156 4.54419C14.4681 4.19181 14.6662 3.71384 14.6662 3.21543C14.6663 2.71702 14.4683 2.239 14.116 1.88652C13.7636 1.53405 13.2856 1.336 12.7872 1.33594C12.2888 1.33587 11.8108 1.53381 11.4583 1.88619L2.56096 10.7855C2.40618 10.9399 2.29171 11.1299 2.22763 11.3389L1.34696 14.2402C1.32973 14.2978 1.32843 14.3591 1.3432 14.4174C1.35796 14.4758 1.38824 14.529 1.43083 14.5715C1.47341 14.614 1.52671 14.6442 1.58507 14.6589C1.64343 14.6736 1.70467 14.6722 1.7623 14.6549L4.6643 13.7749C4.87308 13.7114 5.06308 13.5976 5.21763 13.4435L14.1156 4.54419Z" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </h4>
                        <div class="school">{{ $member->designation }}</div>
                        <div class="year">
                            @if($member->joining_year)
                            {{ $member->joining_year }}
                            @endif

                            @if($member->employment_type)
                            · {{ $member->employment_type }}
                            @endif
                        </div>
                    </div>
                </div>

                @empty

                <p class="empty-text">
                    No team members added yet.
                </p>

                @endforelse
            </div>

            @php
            $preferredRoles = is_string($hiringPreferences->preferred_roles ?? null)
            ? (json_decode($hiringPreferences->preferred_roles, true) ?: [])
            : ($hiringPreferences->preferred_roles ?? []);

            $workModes = is_string($hiringPreferences->work_modes ?? null)
            ? (json_decode($hiringPreferences->work_modes, true) ?: [])
            : ($hiringPreferences->work_modes ?? []);

            $preferredLocations = is_string($hiringPreferences->preferred_locations ?? null)
            ? (json_decode($hiringPreferences->preferred_locations, true) ?: [])
            : ($hiringPreferences->preferred_locations ?? []);
            @endphp

            <div class="profile-summary" id="hiringpreferences">
                <div class="card-head">
                    <h3>Hiring Preferences</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#jobPreferenceModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M14.1156 4.54419C14.4681 4.19181 14.6662 3.71384 14.6662 3.21543C14.6663 2.71702 14.4683 2.239 14.116 1.88652C13.7636 1.53405 13.2856 1.336 12.7872 1.33594C12.2888 1.33587 11.8108 1.53381 11.4583 1.88619L2.56096 10.7855C2.40618 10.9399 2.29171 11.1299 2.22763 11.3389L1.34696 14.2402C1.32973 14.2978 1.32843 14.3591 1.3432 14.4174C1.35796 14.4758 1.38824 14.529 1.43083 14.5715C1.47341 14.614 1.52671 14.6442 1.58507 14.6589C1.64343 14.6736 1.70467 14.6722 1.7623 14.6549L4.6643 13.7749C4.87308 13.7114 5.06308 13.5976 5.21763 13.4435L14.1156 4.54419Z" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10 3.33594L12.6667 6.0026" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="pref-grid">
                    <div>
                        <div class="label">Roles Currently Hiring</div>
                        <div class="value">{{ implode(', ', $preferredRoles) ?: '—' }}</div>
                    </div>
                    <div>
                        <div class="label">Preferred Work Mode</div>
                        <div class="value">
                            {{ implode(' / ', $workModes) }}

                            @if(!empty($preferredLocations))
                            — {{ implode(', ', $preferredLocations) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-summary" id="livejobposting">
                <div class="card-head">
                    <h3>Live Job Postings</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="transaction-card">
                    <div class="wallet-grid referral-header">
                        <div class="cell">Job Title</div>
                        <div class="cell">Type</div>
                        <div class="cell">Location</div>
                        <div class="cell">Experience</div>
                        <div class="cell">Salary</div>
                        <div class="cell">Applications</div>
                    </div>

                    @forelse($recentJobs as $job)
                    <div class="wallet-grid referral-table">
                        <div class="cell job-name">
                            <h4>{{ $job->title }}</h4>
                            @if(!empty($job->skills))

                            <div class="skillstags">

                                @foreach($job->skills as $skill)

                                <span class="stag">
                                    {{ $skill }}
                                </span>

                                @endforeach

                            </div>

                            @endif
                        </div>

                        <div class="cell full-time">
                            <span class="completed status">{{ $job->job_type ?? $job->type ?? '-' }}</span>
                        </div>

                        <div class="cell job-city-type"> {{ $job->job_location ?? '-' }}
                            @if(!empty($job->location_type))
                            / {{ $job->location_type }}
                            @endif
                        </div>

                        <div class="cell job-exp">
                            <svg class="calender-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M11.3333 1.33333H10V0.666667C10 0.489856 9.92976 0.320286 9.80474 0.195262C9.67971 0.0702379 9.51014 0 9.33333 0C9.15652 0 8.98695 0.0702379 8.86193 0.195262C8.7369 0.320286 8.66667 0.489856 8.66667 0.666667V1.33333H4.66667V0.666667C4.66667 0.489856 4.59643 0.320286 4.4714 0.195262C4.34638 0.0702379 4.17681 0 4 0C3.82319 0 3.65362 0.0702379 3.5286 0.195262C3.40357 0.320286 3.33333 0.489856 3.33333 0.666667V1.33333H2C1.46957 1.33333 0.960859 1.54405 0.585786 1.91912C0.210714 2.29419 0 2.8029 0 3.33333V11.3333C0 11.8638 0.210714 12.3725 0.585786 12.7475C0.960859 13.1226 1.46957 13.3333 2 13.3333H11.3333C11.8638 13.3333 12.3725 13.1226 12.7475 12.7475C13.1226 12.3725 13.3333 11.8638 13.3333 11.3333V3.33333C13.3333 2.8029 13.1226 2.29419 12.7475 1.91912C12.3725 1.54405 11.8638 1.33333 11.3333 1.33333ZM12 11.3333C12 11.5101 11.9298 11.6797 11.8047 11.8047C11.6797 11.9298 11.5101 12 11.3333 12H2C1.82319 12 1.65362 11.9298 1.5286 11.8047C1.40357 11.6797 1.33333 11.5101 1.33333 11.3333V6.66667H12V11.3333ZM12 5.33333H1.33333V3.33333C1.33333 3.15652 1.40357 2.98695 1.5286 2.86193C1.65362 2.7369 1.82319 2.66667 2 2.66667H3.33333V3.33333C3.33333 3.51014 3.40357 3.67971 3.5286 3.80474C3.65362 3.92976 3.82319 4 4 4C4.17681 4 4.34638 3.92976 4.4714 3.80474C4.59643 3.67971 4.66667 3.51014 4.66667 3.33333V2.66667H8.66667V3.33333C8.66667 3.51014 8.7369 3.67971 8.86193 3.80474C8.98695 3.92976 9.15652 4 9.33333 4C9.51014 4 9.67971 3.92976 9.80474 3.80474C9.92976 3.67971 10 3.51014 10 3.33333V2.66667H11.3333C11.5101 2.66667 11.6797 2.7369 11.8047 2.86193C11.9298 2.98695 12 3.15652 12 3.33333V5.33333Z" fill="#848484" />
                            </svg> {{ $job->experience ?? '-' }}
                        </div>

                        <div class="cell job-lpa">
                            @if($job->budget_min !== null && $job->budget_max !== null)
                            ₹{{ rtrim(rtrim(number_format($job->budget_min / 100000, 2), '0'), '.') }}
                            – {{ rtrim(rtrim(number_format($job->budget_max / 100000, 2), '0'), '.') }} LPA
                            @else
                            -
                            @endif
                        </div>

                        <div class="cell jop-apply">
                            <span class="dot"></span> {{ $job->total_proposals }}
                        </div>

                        <div class="cell deleted-box">
                            <button class="edit-btn edit-job-btn" type="button" data-bs-toggle="modal" data-bs-target="#addExperienceModal" data-id="{{ $job->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M14.1156 4.54419C14.4681 4.19181 14.6662 3.71384 14.6662 3.21543C14.6663 2.71702 14.4683 2.239 14.116 1.88652C13.7636 1.53405 13.2856 1.336 12.7872 1.33594C12.2888 1.33587 11.8108 1.53381 11.4583 1.88619L2.56096 10.7855C2.40618 10.9399 2.29171 11.1299 2.22763 11.3389L1.34696 14.2402C1.32973 14.2978 1.32843 14.3591 1.3432 14.4174C1.35796 14.4758 1.38824 14.529 1.43083 14.5715C1.47341 14.614 1.52671 14.6442 1.58507 14.6589C1.64343 14.6736 1.70467 14.6722 1.7623 14.6549L4.6643 13.7749C4.87308 13.7114 5.06308 13.5976 5.21763 13.4435L14.1156 4.54419Z" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10 3.33594L12.6667 6.0026" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <button type="button" class="deleted-btn delete-job-btn" data-id="{{ $job->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M2 4H14" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12.6663 4V13.3333C12.6663 14 11.9997 14.6667 11.333 14.6667H4.66634C3.99967 14.6667 3.33301 14 3.33301 13.3333V4" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5.33301 4.0026V2.66927C5.33301 2.0026 5.99967 1.33594 6.66634 1.33594H9.33301C9.99967 1.33594 10.6663 2.0026 10.6663 2.66927V4.0026" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.66699 7.33594V11.3359" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.33301 7.33594V11.3359" stroke="#9CA3AF" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @empty

                    <div class="empty-state">
                        No live job postings found.
                    </div>

                    @endforelse
                </div>

                <div class="viewall-post">
                    <a href="#">
                        View all postings
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="M13 6L19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>

            </div>

            <div class="profile-summary" id="sociallinks">
                <div class="card-head">
                    <h3>Social Links</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addSocialModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="social-box">
                     @forelse($socialLinks as $social) 
                     {{ ucfirst($social->platform) }} {{ $social->url }} 
                     
                        <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">
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

                        <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">
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

                        <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">
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

                        <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer">
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
                        
                    @empty 
                    <p class="empty-text">
                        No social links added yet.
                    </p>
                    @endforelse
                </div>
                
            </div>


            <div class="profile-summary" id="languages">
                <div class="card-head">
                    <h3>Languages</h3>
                    <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addLanguageModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33301 8H12.6663" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 3.33594V12.6693" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="lang-grid">
                    @forelse($languages as $language)
                    <div class="lang-card">
                        <div class="name">{{ ucfirst($language->language) }}</div>
                        <div class="level">{{ ucfirst($language->proficiency ?? '') }}</div>
                        <button class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#addLanguageModal" data-id="{{ $language->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                <g clip-path="url(#clip0_4060_6257)">
                                    <path d="M11.4694 3.69264C11.7558 3.40633 11.9167 3.01798 11.9167 2.61302C11.9168 2.20807 11.756 1.81967 11.4696 1.53329C11.1833 1.24691 10.795 1.08599 10.39 1.08594C9.98507 1.08589 9.59668 1.24671 9.31029 1.53302L2.08121 8.76373C1.95545 8.88912 1.86244 9.04352 1.81038 9.21331L1.09484 11.5706C1.08084 11.6175 1.07978 11.6672 1.09178 11.7146C1.10377 11.762 1.12838 11.8053 1.16298 11.8399C1.19757 11.8744 1.24088 11.8989 1.2883 11.9109C1.33571 11.9228 1.38547 11.9216 1.43229 11.9076L3.79017 11.1926C3.9598 11.141 4.11418 11.0485 4.23975 10.9234L11.4694 3.69264Z" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.125 2.71094L10.2917 4.8776" stroke="#9CA3AF" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_4060_6257">
                                        <rect width="13" height="13" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </div>
                    @empty

                    <p class="empty-text">
                        No languages added yet.
                    </p>

                    @endforelse
                </div>

            </div>

        </div>
    </div>
</section>


<!----- profile-score Popup-------->
<div class="modal bottom-sheet fade" id="profileScore" tabindex="-1" aria-labelledby="profileScoreModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered profile-card">
        <div class="modal-content">
            <div class="modal-body">
                <div class="side-card">
                    <h3>Profile score</h3>
                    <p>Recruiters seek 100% profiles - complete yours to stand out!</p>

                    <div class="pending-title">Pending action</div>

                    <a href="#personaldetails">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Upload Company Logo
                            </div>
                            <span class="badge">+5%</span>
                        </div>
                    </a>

                    <a href="#companyoverview">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Company Overview
                            </div>
                            <span class="badge">+10%</span>
                        </div>
                    </a>

                    <a href="#documents">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Documents
                            </div>
                            <span class="badge">+25%</span>
                        </div>
                    </a>

                    <a href="#services">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Services
                            </div>
                            <span class="badge">+10%</span>
                        </div>
                    </a>

                    <a href="#teammember">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Key Team Members
                            </div>
                            <span class="badge">+10%</span>
                        </div>
                    </a>

                    <a href="#hiringpreferences">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Hiring Preferences
                            </div>
                            <span class="badge">+10%</span>
                        </div>
                    </a>

                    <a href="#livejobposting">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Live Job Postings
                            </div>
                            <span class="badge">+10%</span>
                        </div>
                    </a>

                    <a href="#sociallinks">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Social Links
                            </div>
                            <span class="badge">+5%</span>
                        </div>
                    </a>

                    <a href="#languages">
                        <div class="pending-item">
                            <div class="left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M5.66683 9.66667C6.10886 9.66667 6.53278 9.49107 6.84534 9.17851C7.1579 8.86595 7.3335 8.44203 7.3335 8C7.3335 7.08 7.00016 6.66667 6.66683 6C5.95216 4.57133 6.5175 3.29733 8.00016 2C8.3335 3.66667 9.3335 5.26667 10.6668 6.33333C12.0002 7.4 12.6668 8.66667 12.6668 10C12.6668 10.6128 12.5461 11.2197 12.3116 11.7859C12.0771 12.352 11.7333 12.8665 11.3 13.2998C10.8667 13.7332 10.3522 14.0769 9.78602 14.3114C9.21983 14.546 8.613 14.6667 8.00016 14.6667C7.38733 14.6667 6.78049 14.546 6.21431 14.3114C5.64812 14.0769 5.13367 13.7332 4.70033 13.2998C4.26699 12.8665 3.92325 12.352 3.68872 11.7859C3.4542 11.2197 3.3335 10.6128 3.3335 10C3.3335 9.23133 3.62216 8.47067 4.00016 8C4.00016 8.44203 4.17576 8.86595 4.48832 9.17851C4.80088 9.49107 5.2248 9.66667 5.66683 9.66667Z" stroke="#F97316" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Languages
                            </div>
                            <span class="badge">+5%</span>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
<!----- profile-score Popup-------->

<!----- User Popup-------->
<div class="modal bottom-sheet fade" id="editModal" tabindex="-1" aria-labelledby="basicDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered basic-details">
        <div class="modal-content">
            <div class="drag-handle"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="basicDetailsLabel">Basic Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="basicDetailsForm"
                    action="{{ route('employer.profile.basic-details') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="upload-box">
                        <div class="upload-avatar">
                            <img id="preview" src="{{ !empty($company->profile_photo) ? $company->profile_photo : asset('assets/images/profile-userimg.png') }}" alt="avatar">
                        </div>

                        <div>
                            <h6>Upload Your Company Logo</h6>
                            <p>Add a professional profile photo to build trust with employers and make your profile stand out.</p>
                            <label class="change-photo-btn" for="fileInput">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <g clip-path="url(#clip0_4151_5396)">
                                        <path d="M6 1.5V7.5M3.5 4L6 1.5L8.5 4M10.5 7.5V9.5C10.5 9.76522 10.3946 10.0196 10.2071 10.2071C10.0196 10.3946 9.76522 10.5 9.5 10.5H2.5C2.23478 10.5 1.98043 10.3946 1.79289 10.2071C1.60536 10.0196 1.5 9.76522 1.5 9.5V7.5" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4151_5396">
                                            <rect width="12" height="12" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg> Upload File
                            </label>
                        </div>
                        <span class="error-message">The avatar field is required.</span>
                        <input type="file" name="profile_photo" id="fileInput" accept="image/jpeg,image/png" hidden>
                    </div>

                    <div class="input-row">
                        <label class="form-label">Company Name <span class="req">*</span></label>
                        <input type="text" name="company_name" class="form-control" vvalue="{{ old('company_name', $company->company_name ?? '') }}" placeholder="Enter company name" required>
                    </div>

                    <div class="input-row">
                        <label class="form-label d-block">Company Url <span class="req">*</span></label>
                        <input type="url" name="website" class="form-control" value="{{ old('website', $company->website ?? '') }}" placeholder="https://technovasolutions.com" required>
                    </div>

                    <div class="row input-row g-2">
                        <div class="col-6">
                            <label class="form-label">Company Est <span class="req">*</span></label>
                            <input type="date" name="established_date" class="form-control" value="{{ old('established_date', $company->established_date ?? '') }}" required>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Current Location <span class="req">*</span></label>
                            <div class="ac-input-wrap">
                                <input type="text" name="city" placeholder="Search city" value="{{ old('city', $company->city ?? '') }}" required>
                                <!--<span class="ac-clear">-->
                                <!--    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">-->
                                <!--        <path d="M10.5 3.5L3.5 10.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />-->
                                <!--        <path d="M3.5 3.5L10.5 10.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />-->
                                <!--    </svg>-->
                                <!--</span>-->
                            </div>
                            <!--<ul class="ac-list">-->
                            <!--    <li>Delhi</li>-->
                            <!--</ul>-->
                        </div>
                    </div>

                    <div class="input-row row g-2">
                        <div class="col-6">
                            <label class="form-label d-block">Industry <span class="req">*</span></label>
                            <select name="industry" class="form-select" id="industry">
                                <option value="">Select industry</option>
                            
                                <option value="IT"
                                    {{ old('industry', $company->industry ?? '') == 'IT' ? 'selected' : '' }}>
                                    IT
                                </option>
                            
                                <option value="Finance"
                                    {{ old('industry', $company->industry ?? '') == 'Finance' ? 'selected' : '' }}>
                                    Finance
                                </option>
                            
                                <option value="Education"
                                    {{ old('industry', $company->industry ?? '') == 'Education' ? 'selected' : '' }}>
                                    Education
                                </option>
                            
                                <option value="Healthcare"
                                    {{ old('industry', $company->industry ?? '') == 'Healthcare' ? 'selected' : '' }}>
                                    Healthcare
                                </option>
                            
                                <option value="Marketing"
                                    {{ old('industry', $company->industry ?? '') == 'Marketing' ? 'selected' : '' }}>
                                    Marketing
                                </option>
                            
                                <option value="Other"
                                    {{ old('industry', $company->industry ?? '') == 'Other' ? 'selected' : '' }}>
                                    Other
                                </option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label d-block">Company Size <span class="req">*</span></label>
                            <select name="company_size" class="form-select">
                                <option value="">Select Company Size</option>

                                <option value="1-10"
                                    {{ old('company_size', $company->company_size ?? '') == '1-10' ? 'selected' : '' }}>
                                    1-10
                                </option>

                                <option value="11-50"
                                    {{ old('company_size', $company->company_size ?? '') == '11-50' ? 'selected' : '' }}>
                                    11-50
                                </option>

                                <option value="51-200"
                                    {{ old('company_size', $company->company_size ?? '') == '51-200' ? 'selected' : '' }}>
                                    51-200
                                </option>

                                <option value="201-500"
                                    {{ old('company_size', $company->company_size ?? '') == '201-500' ? 'selected' : '' }}>
                                    201-500
                                </option>

                                <option value="500+"
                                    {{ old('company_size', $company->company_size ?? '') == '500+' ? 'selected' : '' }}>
                                    500+
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-save" id="basicDetailsSubmitBtn"><span id="basicDetailsSubmitText">Save</span></button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<!----- User Popup-------->

<!----- Contact Info Popup-------->
<div class="modal bottom-sheet fade" id="contactModal" tabindex="-1" aria-labelledby="contactDetails" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="drag-handle"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="basicDetailsLabel">Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="contactDetailsForm" action="{{ route('employer.profile.contact') }}" method="POST">
                    @csrf
                    <!-- Phone Number -->
                    <div class="input-row">
                        <label>Change Phone Number <span class="req">*</span></label>
                        <div class="contact-row">
                            <div class="input-wrap">
                                <span class="prefix">+91</span>
                                <input type="tel" class="input-left" name="phone" id="phone" placeholder="Enter number here..." maxlength="10" autocomplete="off">
                            </div>
                            <!--<button type="button" class="verifybtn" id="sendOtpPhoneBtn">Send OTP</button>-->
                        </div>
                    </div>

                    <!-- OTP for phone -->
                    <!--<div class="input-row">-->
                    <!--    <label>Enter OTP <span class="req">*</span></label>-->
                    <!--    <div class="contact-row">-->
                    <!--        <div class="input-wrap">-->
                    <!--            <input type="text" id="otpPhone" placeholder="Enter OTP here...." maxlength="6">-->
                    <!--        </div>-->
                    <!--        <button type="button" class="verifybtn" id="verifyPhoneBtn" disabled>Verify</button>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!-- Email -->
                    <div class="input-row">
                        <label>Change E-mail <span class="req">*</span></label>
                        <div class="contact-row">
                            <div class="input-wrap">
                                <input type="email" name="email" id="email" placeholder="Enter new Email" autocomplete="off">
                            </div>
                            <button type="button" class="verifybtn" id="sendOtpEmailBtn">Send OTP</button>
                        </div>
                    </div>

                    <!-- OTP for email -->
                    <div class="input-row">
                        <label>Enter OTP <span class="req">*</span></label>
                        <div class="contact-row">
                            <div class="input-wrap">
                                <input type="text" id="otpEmail" name="otp_email" placeholder="Enter OTP here...." maxlength="6">
                            </div>
                            <button type="button" class="verifybtn" id="verifyEmailBtn" disabled>Verify</button>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="contactSubmitBtn" class="btn-save"><span id="contactSubmitText">Save</span></button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<!----- Contact Info Popup ----->

<!----- Company Overview Popup-------->
<div class="modal bottom-sheet fade" id="companyoverviewModal" tabindex="-1" aria-labelledby="companyoverview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="drag-handle"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="companyoverview">Company Overview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="companyOverviewForm" action="{{ route('employer.profile.overview') }}" method="POST">
                    @csrf
                    <!-- Company Overview -->
                    <div class="input-row">
                        <textarea class="profile-summary-input" name="about" id="companyOverviewInput" placeholder="Enter Company Overview here..." maxlength="5000" required>{{ $company->about ?? '' }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-save" id="companyOverviewSubmitBtn"><span id="companyOverviewSubmitText">Save</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!----- Company Overview Popup-------->

<!----- Enhance with AI Popup-------->
<div class="modal bottom-sheet fade" id="aiSummaryModal" tabindex="-1" aria-labelledby="AiSummary" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AiSummary">Enhance with AI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <!-- Enhance with AI -->
            <div class="modal-body">
                <div class="input-row">
                    <textarea class="profile-summary-input" placeholder="Enter Company Overview here..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="ai-btn" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <g clip-path="url(#clip0_4046_4437)">
                            <path d="M6.62479 10.3361C6.56527 10.1054 6.44502 9.89484 6.27653 9.72636C6.10805 9.55788 5.8975 9.43762 5.66679 9.3781L1.57679 8.32344C1.50701 8.30363 1.4456 8.26161 1.40186 8.20373C1.35813 8.14586 1.33447 8.07531 1.33447 8.00277C1.33447 7.93024 1.35813 7.85968 1.40186 7.80181C1.4456 7.74394 1.50701 7.70191 1.57679 7.6821L5.66679 6.62677C5.89742 6.56731 6.10792 6.44715 6.27639 6.2788C6.44486 6.11044 6.56517 5.90003 6.62479 5.66944L7.67946 1.57944C7.69906 1.50938 7.74105 1.44766 7.799 1.4037C7.85696 1.35974 7.92771 1.33594 8.00046 1.33594C8.0732 1.33594 8.14395 1.35974 8.20191 1.4037C8.25987 1.44766 8.30185 1.50938 8.32146 1.57944L9.37546 5.66944C9.43497 5.90015 9.55523 6.1107 9.72371 6.27918C9.89219 6.44766 10.1027 6.56792 10.3335 6.62744L14.4235 7.68144C14.4938 7.70084 14.5558 7.74278 14.6 7.80082C14.6442 7.85887 14.6682 7.92981 14.6682 8.00277C14.6682 8.07573 14.6442 8.14667 14.6 8.20472C14.5558 8.26276 14.4938 8.3047 14.4235 8.3241L10.3335 9.3781C10.1027 9.43762 9.89219 9.55788 9.72371 9.72636C9.55523 9.89484 9.43497 10.1054 9.37546 10.3361L8.32079 14.4261C8.30118 14.4962 8.2592 14.5579 8.20124 14.6018C8.14328 14.6458 8.07254 14.6696 7.99979 14.6696C7.92704 14.6696 7.85629 14.6458 7.79834 14.6018C7.74038 14.5579 7.69839 14.4962 7.67879 14.4261L6.62479 10.3361Z" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.3335 2V4.66667" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.6667 3.33594H12" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2.6665 11.3359V12.6693" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3.33333 12H2" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_4046_4437">
                                <rect width="16" height="16" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    Enhance with AI
                </button>
            </div>
        </div>
    </div>
</div>
<!----- AI Summary Generator Popup-------->

<!----- Upload Company Doc Popup-------->
<div class="modal bottom-sheet fade" id="UploadResumeModal" tabindex="-1" aria-labelledby="UploadResume" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UploadResume">Upload Company Doc</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="companyDocumentForm" action="{{ route('employer.profile.documents') }}" method="POST"
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
                            <h6>Upload Company Doc</h6>
                            <p>Upload your company doc to highlight your industry experience and help peple discover faster.</p>
                            <label class="change-photo-btn upload-btn" for="fileInputDoc">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <g clip-path="url(#clip0_4151_5396)">
                                        <path d="M6 1.5V7.5M3.5 4L6 1.5L8.5 4M10.5 7.5V9.5C10.5 9.76522 10.3946 10.0196 10.2071 10.2071C10.0196 10.3946 9.76522 10.5 9.5 10.5H2.5C2.23478 10.5 1.98043 10.3946 1.79289 10.2071C1.60536 10.0196 1.5 9.76522 1.5 9.5V7.5" stroke="#00A148" stroke-width="2" stroke-linecap="round"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4151_5396">
                                            <rect width="12" height="12" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg> Upload File
                            </label>
                        </div>
                        <input type="file" name="documents[]" id="fileInputDoc" multiple accept=".pdf,.doc,.docx">
                        <div class="file-list" id="fileList"></div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-save" id="documentsSubmitBtn"><span id="documentsSubmitText">Save</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!----- Upload Resume Popup-------->

<!----- Post New Job Popup-------->
<div class="modal bottom-sheet fade" id="addExperienceModal" tabindex="-1" aria-labelledby="AddExperience" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddExperience">Post New Job.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="basicDetailsForm">
                <div class="modal-body">

                    <div class="input-row">
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label">Experience <span class="req">*</span></label>
                                <select class="form-select">
                                    <option selected disabled>Select Experience</option>
                                    <option>1–3 Years</option>
                                    <option>3–5 Years</option>
                                    <option>5–7 Years</option>
                                    <option>7–10 Years</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Type of Employment <span class="req">*</span></label>
                                <select class="form-select">
                                    <option selected disabled>Select of Employment Type</option>
                                    <option>15 Days</option>
                                    <option>1 Months</option>
                                    <option>3 Months</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="input-row">
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label">Job Title <span class="req">*</span></label>
                            <input type="text" class="form-control" placeholder="Search job title">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Company <span class="req">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your company name">
                        </div>
                    </div>
                </div> -->


                    <div class="input-row row g-2">
                        <div class="col-lg-6 col-md-6 col-12">
                            <label class="form-label">Notice Period <span class="req">*</span></label>
                            <select class="form-select">
                                <option selected disabled>Select Notice Period</option>
                                <option>15 Days</option>
                                <option>1 Months</option>
                                <option>3 Months</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <label>Fixed pay <span class="req">*</span></label>
                            <div class="salary-fields">
                                <div class="salary-input">
                                    <span class="currency">₹</span>
                                    <input type="text" placeholder="300000" />
                                </div>
                                <span class="to-text">to</span>
                                <div class="salary-input">
                                    <span class="currency">₹</span>
                                    <input type="text" placeholder="500000" />
                                </div>
                                <span class="year-text">per year</span>
                            </div>
                        </div>
                    </div>

                    <div class="input-row">
                        <label class="form-label">Requirements <span class="req">*</span></label>
                        <textarea class="profile-summary-input1" placeholder="Describe your work..."></textarea>
                    </div>

                    <div class="input-row row g-2">
                        <div class="col-6">
                            <label class="form-label">Additional info <span class="req">*</span></label>
                            <textarea class="profile-summary-input2" placeholder="Additional info..."></textarea>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Overview<span class="req">*</span></label>
                            <textarea class="profile-summary-input2" placeholder="Overview..."></textarea>
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
<!----- Post New Job Popup-------->

<!----- Services Offered Popup-------->
<div class="modal bottom-sheet fade" id="addSkillsModal" tabindex="-1" aria-labelledby="Add Skills" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddSkills">Services Offered</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="servicesForm" action="{{ route('employer.profile.services') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-row">
                        <label class="form-label">Services Offered <span class="req">*</span></label>
                        <div class="ac-input-wrap">
                            <input type="text" id="serviceSearchInput" placeholder="Search service" autocomplete="off">
                            <span class="ac-clear">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M10.5 3.5L3.5 10.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                                    <path d="M3.5 3.5L10.5 10.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                                </svg>
                            </span>
                        </div>
                        <ul class="ac-list" id="skillsSuggestions" style="display:none;">

                        </ul>

                        <!-- Selected Tags -->
                        <div class="skills-tags" id="skillsTags" style="{{ $services->isNotEmpty() ? 'display:flex;' : 'display:none;' }}">
                            @foreach($services as $service)
                            <span class="skilltag">
                                <span class="skill-name">{{ $service->service_name }}</span>

                                <button type="button"
                                    class="tag-remove"
                                    onclick="removeSkill(this)"
                                    aria-label="Remove service">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="14"
                                        height="14"
                                        viewBox="0 0 14 14"
                                        fill="none">
                                        <path d="M10.5 3.5L3.5 10.5"
                                            stroke="white"
                                            stroke-width="1.77083"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M3.5 3.5L10.5 10.5"
                                            stroke="white"
                                            stroke-width="1.77083"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                </button>
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-save" id="servicesSubmitBtn"><span id="servicesSubmitText">Save</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!----- Add Services Offered Popup-------->

<!----- Add Key Team Members Popup-------->
<div class="modal bottom-sheet fade" id="addEducationModal" tabindex="-1" aria-labelledby="AddEducation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Key Team Members">Key Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="teamMemberForm" action="{{ route('employer.profile.team') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-row">
                        <label>Members Name <span class="req">*</span></label>
                        <input type="text" name="name" id="teamMemberName" placeholder="Enter Name" value="" required>
                    </div>

                    <div class="input-row">
                        <label>Designation <span class="req">*</span></label>
                        <input type="text" name="designation" id="teamMemberDesignation" placeholder="Enter Designation" value="" required>
                    </div>


                    <div class="row input-row g-2">
                        <div class="col-6">
                            <label>Joining Year <span class="req">*</span></label>
                            <input type="number" name="joining_year" class="form-control" placeholder="2020" min="1900" max="{{ date('Y') }}" required>
                        </div>
                        <div class="col-6">
                            <label>Job Type <span class="req">*</span></label>
                            <select name="employment_type" id="teamMemberEmploymentType" class="form-select" required>
                                <option value="" selected disabled>
                                    Select Job Type
                                </option>

                                <option value="Full Time">
                                    Full Time
                                </option>

                                <option value="Part Time">
                                    Part Time
                                </option>

                                <option value="Hybrid">
                                    Hybrid
                                </option>

                                <option value="Remote">
                                    Remote
                                </option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-save" id="teamMemberSubmitBtn">
                        <span id="teamMemberSubmitText">
                            Save
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!----- Add Key Team Members Popup-------->

<!----- Hiring Preferences Popup-------->
<div class="modal bottom-sheet fade" id="jobPreferenceModal" tabindex="-1" aria-labelledby="JobPreference" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="JobPreference">Hiring Preferences</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="hiringPreferencesForm" action="{{ route('employer.profile.hiring-preferences') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-row">
                        <label class="form-label">Roles Currently Hiring <span class="req">*</span></label>
                        <div class="ac-input-wrap">
                            <input type="text" id="roleSearchInput" placeholder="Enter your roles" autocomplete="off">
                            <span class="ac-clear" id="roleClearBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M10.5 3.5L3.5 10.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                                    <path d="M3.5 3.5L10.5 10.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" />
                                </svg>
                            </span>
                        </div>

                        <ul class="ac-list"
                            id="roleSuggestions"
                            style="display:none;">
                        </ul>

                        <!-- Selected Tags -->
                        <div class="skills-tags" id="jobTags">
                            @if(!empty($hiringPreferences?->preferred_roles))
                            @foreach($hiringPreferences->preferred_roles as $role)

                            <span class="skilltag">{{ $role }}
                                <button class="tag-remove" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M10.5 3.5L3.5 10.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3.5 3.5L10.5 10.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </span>
                            @endforeach

                            @endif
                        </div>
                    </div>

                    <div class="input-row row g-2">
                        @php
                        $savedLocations = $hiringPreferences?->preferred_locations ?? [];
                        $savedWorkModes = $hiringPreferences?->work_modes ?? [];
                        @endphp
                        <div class="col-6">
                            <label>Location <span class="req">*</span></label>
                            <select name="preferred_locations[]"
                                id="preferredLocations"
                                class="form-select"
                                multiple>

                                <option value="Delhi"
                                    {{ in_array('Delhi', $savedLocations) ? 'selected' : '' }}>
                                    Delhi
                                </option>

                                <option value="Pune"
                                    {{ in_array('Pune', $savedLocations) ? 'selected' : '' }}>
                                    Pune
                                </option>

                                <option value="Mumbai"
                                    {{ in_array('Mumbai', $savedLocations) ? 'selected' : '' }}>
                                    Mumbai
                                </option>

                                <option value="Noida"
                                    {{ in_array('Noida', $savedLocations) ? 'selected' : '' }}>
                                    Noida
                                </option>

                            </select>
                        </div>

                        <div class="col-6">
                            <label>Job Type <span class="req">*</span></label>
                            <select name="work_modes[]"
                                id="workModes"
                                class="form-select"
                                multiple>

                                <option value="Full Time"
                                    {{ in_array('Full Time', $savedWorkModes) ? 'selected' : '' }}>
                                    Full Time
                                </option>

                                <option value="Part Time"
                                    {{ in_array('Part Time', $savedWorkModes) ? 'selected' : '' }}>
                                    Part Time
                                </option>

                                <option value="Hybrid"
                                    {{ in_array('Hybrid', $savedWorkModes) ? 'selected' : '' }}>
                                    Hybrid
                                </option>

                                <option value="Remote"
                                    {{ in_array('Remote', $savedWorkModes) ? 'selected' : '' }}>
                                    Remote
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-save" id="hiringPreferencesSubmitBtn"><span id="hiringPreferencesSubmitText">Save</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!----- Hiring Preferences Popup-------->

<!-----Add Social Links Popup-------->
<div class="modal bottom-sheet fade" id="addSocialModal" tabindex="-1" aria-labelledby="AddSocialLinks" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Social Links</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="socialLinksForm" action="{{ route('employer.profile.social-links') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-row">
                        <label>Enter URL <span class="req">*</span></label>
                        <div class="social-input">
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
                            <input type="url"
                                name="facebook"
                                id="facebookUrl"
                                class="input-left"
                                placeholder="Enter your Facebook URL..."
                                autocomplete="off"
                                value="{{ $socialLinks->firstWhere('platform', 'facebook')->url ?? '' }}">

                        </div>

                        <div class="social-input">
                            <span class="social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M16 8C17.5913 8 19.1174 8.63214 20.2426 9.75736C21.3679 10.8826 22 12.4087 22 14V21H18V14C18 13.4696 17.7893 12.9609 17.4142 12.5858C17.0391 12.2107 16.5304 12 16 12C15.4696 12 14.9609 12.2107 14.5858 12.5858C14.2107 12.9609 14 13.4696 14 14V21H10V14C10 12.4087 10.6321 10.8826 11.7574 9.75736C12.8826 8.63214 14.4087 8 16 8Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6 9H2V21H6V9Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4 6C5.10457 6 6 5.10457 6 4C6 2.89543 5.10457 2 4 2C2.89543 2 2 2.89543 2 4C2 5.10457 2.89543 6 4 6Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <input type="url"
                                name="linkedin"
                                id="linkedinUrl"
                                class="input-left"
                                placeholder="Enter your LinkedIn URL..."
                                autocomplete="off"
                                value="{{ $socialLinks->firstWhere('platform', 'linkedin')->url ?? '' }}">

                        </div>

                        <div class="social-input">
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
                            <input type="url"
                                name="instagram"
                                id="instagramUrl"
                                class="input-left"
                                placeholder="Enter your Instagram URL..."
                                autocomplete="off"
                                value="{{ $socialLinks->firstWhere('platform', 'instagram')->url ?? '' }}">

                        </div>

                        <div class="social-input">
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
                            <input type="url"
                                name="x"
                                id="xUrl"
                                class="input-left"
                                placeholder="Enter your X URL..."
                                autocomplete="off"
                                value="{{ $socialLinks->firstWhere('platform', 'x')->url ?? '' }}">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-save" id="socialLinksSubmitBtn"><span id="socialLinksSubmitText">Save</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!----- Add Social Links Popup-------->

<!----- Add Language Popup-------->
<div class="modal bottom-sheet fade" id="addLanguageModal" tabindex="-1" aria-labelledby="AddLanguage" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Language</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="languagesForm" action="{{ route('employer.profile.languages') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="input-row">
                        <div class="lang-add-row">
                            <select id="langSelect">
                                <option value="">Select Language</option>

                                <option value="Hindi">Hindi</option>
                                <option value="Bengali">Bengali</option>
                                <option value="Tamil">Tamil</option>
                                <option value="Japanese">Japanese</option>
                                <option value="Arabic">Arabic</option>
                            </select>
                            <select id="langLevel">
                                <option value="Basic">Basic</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Fluent">Fluent</option>
                                <option value="Native">Native</option>
                            </select>
                            <button type="button" class="icon-square-btn" onclick="addLanguage()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M2.9165 7H11.0832" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 2.91797V11.0846" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>

                        <div class="lang-list" id="langList">
                            @foreach($languages as $language)
                            @php
                            $proficiency = $language->proficiency ?: 'Basic';

                            $levelClass = match($proficiency) {
                            'Intermediate' => 'level-intermediate',
                            'Fluent' => 'level-fluent',
                            'Native' => 'level-native',
                            default => 'level-basic',
                            };
                            @endphp
                            <div class="lang-row"
                                data-language="{{ $language->language }}"
                                data-proficiency="{{ $proficiency }}">

                                <span>
                                    {{ $language->language }}
                                </span>

                                <span class="level-chip {{ $levelClass }}">
                                    {{ $proficiency }}

                                    <button type="button"
                                        class="lang-remove-btn"
                                        onclick="removeLanguage(this)">
                                        ✕
                                    </button>
                                </span>

                            </div>
                            @endforeach
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-save" id="languagesSubmitBtn"><span id="languagesSubmitText">Save</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!----- Add Language Popup-------->

<!----- Add Blank Popup-------->
<div class="modal bottom-sheet fade" id="addBlankModal" tabindex="-1" aria-labelledby="AddBlank" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Blank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="languagesForm1">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!----- Add Blank Popup-------->

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
<!-- Crop Modal -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

<script>
    $('.navtabs a').on('click', function() {
    $('.navtabs a').removeClass('active');
    $(this).addClass('active');
});
</script>
<!-- ====== Profile Crop and Upload Option ====== -->
<script>
    let cropper;
    const fileInput = document.getElementById('fileInput');
    const cropModal = document.getElementById('cropModal');
    const cropImage = document.getElementById('cropImage');
    const preview = document.getElementById('preview');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
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

    document.getElementById('cropBtn').addEventListener('click', function() {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300
        });
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
        function() {

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
<!-- ====== Profile Crop and Upload Option ====== -->

<script>
    document.querySelectorAll(".exp-item").forEach(function(box) {

        const content = box.querySelector(".note");
        const button = box.querySelector(".see-more-btn");

        // Check original content height
        const contentHeight = content.scrollHeight;

        // Show button only if content is greater than 50px
        if (contentHeight > 50) {
            button.style.display = "inline-block";
        } else {
            button.style.display = "none";
        }

        // See More / See Less
        button.addEventListener("click", function() {

            content.classList.toggle("show");

            if (content.classList.contains("show")) {
                button.textContent = "See Less";
            } else {
                button.textContent = "See More";
            }

        });

    });
</script>

<!---- "Verify" OTP input script ---->
<script>
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
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('basicDetailsForm');

        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('basicDetailsSubmitBtn');
            const submitText = document.getElementById('basicDetailsSubmitText');

            // Prevent double submit
            if (submitBtn.disabled) {
                return;
            }

            // Show submitting state
            submitBtn.disabled = true;
            submitText.textContent = 'Submitting...';

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
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

                    if (data.success) {

                        alert(data.message || 'Basic details saved successfully.');

                        // Reload page after successful save
                        window.location.reload();

                    } else {
                        throw {
                            status: 422,
                            data: data
                        };
                    }
                })
                .catch(error => {

                    console.error('AJAX Error:', error);

                    let message = 'Something went wrong. Please try again.';

                    // Laravel validation errors
                    if (
                        error.data &&
                        error.data.errors
                    ) {
                        message = Object.values(error.data.errors)
                            .flat()
                            .join('\n');
                    } else if (
                        error.data &&
                        error.data.message
                    ) {
                        message = error.data.message;
                    }

                    alert(message);

                    // Enable button again
                    submitBtn.disabled = false;
                    submitText.textContent = 'Save';
                });

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('contactDetailsForm');

        if (!form) {
            return;
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('contactSubmitBtn');
            const submitText = document.getElementById('contactSubmitText');

            // Prevent double submit
            if (submitBtn.disabled) {
                return;
            }

            // Show submitting state
            submitBtn.disabled = true;
            submitText.textContent = 'Submitting...';

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
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

                    if (data.success) {

                        alert(
                            data.message ||
                            'Contact details updated successfully.'
                        );

                        // Reload page after successful save
                        window.location.reload();

                    } else {

                        throw {
                            status: 422,
                            data: data
                        };
                    }
                })
                .catch(error => {

                    console.error('Contact Details AJAX Error:', error);

                    let message = 'Something went wrong. Please try again.';

                    // Laravel validation errors
                    if (
                        error.data &&
                        error.data.errors
                    ) {
                        message = Object.values(error.data.errors)
                            .flat()
                            .join('\n');
                    }

                    // Laravel message
                    else if (
                        error.data &&
                        error.data.message
                    ) {
                        message = error.data.message;
                    }

                    alert(message);

                    // Enable button again
                    submitBtn.disabled = false;
                    submitText.textContent = 'Save';
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

            fetch("{{ route('employer.sendOtp') }}", {
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

            fetch("{{ route('employer.verifyOtp') }}", {
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
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('companyOverviewForm');

        if (!form) {
            return;
        }

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            const submitBtn = document.getElementById(
                'companyOverviewSubmitBtn'
            );

            const submitText = document.getElementById(
                'companyOverviewSubmitText'
            );

            // Prevent double submit
            if (submitBtn.disabled) {
                return;
            }

            // Submitting state
            submitBtn.disabled = true;
            submitText.textContent = 'Submitting...';

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',

                    headers: {
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

                    if (data.success === true) {

                        alert(
                            data.message ||
                            'Company overview saved successfully.'
                        );

                        window.location.reload();

                    } else {

                        throw {
                            data: data
                        };
                    }
                })
                .catch(error => {

                    console.error(
                        'Company Overview AJAX Error:',
                        error
                    );

                    let message =
                        'Something went wrong. Please try again.';

                    if (error.data) {

                        if (error.data.errors) {

                            message = Object.values(
                                    error.data.errors
                                )
                                .flat()
                                .join('\n');

                        } else if (error.data.message) {

                            message = error.data.message;
                        }
                    }

                    alert(message);

                    // Enable button again
                    submitBtn.disabled = false;
                    submitText.textContent = 'Save';
                });

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('servicesForm');
        const searchInput = document.getElementById('serviceSearchInput');
        const suggestions = document.getElementById('skillsSuggestions');
        const skillsTags = document.getElementById('skillsTags');

        if (!form || !searchInput || !suggestions || !skillsTags) {
            return;
        }

        const availableServices = [
            'Web Development',
            'UI Development',
            'UX Design',
            'Frontend Development',
            'Backend Development',
            'Full Stack Development',
            'Mobile App Development',
            'Android Development',
            'iOS Development',
            'Software Development',
            'Website Development',
            'E-commerce Development',
            'WordPress Development',
            'PHP Development',
            'Laravel Development',
            'React Development',
            'Vue.js Development',
            'Angular Development',
            'Node.js Development',
            'Graphic Design',
            'UI/UX Design',
            'Logo Design',
            'Digital Marketing',
            'SEO',
            'Social Media Marketing',
            'Content Writing',
            'Copywriting',
            'Video Editing',
            'Animation',
            'Data Entry',
            'MS-Office',
            'Consulting'
        ];


        /*
        |--------------------------------------------------------------------------
        | Get Existing / Selected Services
        |--------------------------------------------------------------------------
        */

        function getSelectedServices() {

            const selected = [];

            skillsTags.querySelectorAll('.skilltag').forEach(function(tag) {

                const nameElement = tag.querySelector('.skill-name');

                if (nameElement) {

                    const name = nameElement.textContent.trim();

                    if (name) {
                        selected.push(name);
                    }
                }
            });

            return selected;
        }


        /*
        |--------------------------------------------------------------------------
        | Show / Hide Tags
        |--------------------------------------------------------------------------
        */

        function updateTagsVisibility() {

            const count = skillsTags.querySelectorAll('.skilltag').length;

            skillsTags.style.display = count > 0 ? 'flex' : 'none';
        }


        /*
        |--------------------------------------------------------------------------
        | Add Service
        |--------------------------------------------------------------------------
        */

        function addService(service) {

            service = service.trim();

            if (!service) {
                return;
            }

            const selectedServices = getSelectedServices();

            const exists = selectedServices.some(function(selected) {
                return selected.toLowerCase() === service.toLowerCase();
            });

            if (exists) {

                searchInput.value = '';

                suggestions.innerHTML = '';
                suggestions.style.display = 'none';

                return;
            }


            const tag = document.createElement('span');

            tag.className = 'skilltag';

            tag.innerHTML = `
            <span class="skill-name"></span>

            <button type="button"
                    class="tag-remove"
                    aria-label="Remove service">
                ×
            </button>
        `;


            tag.querySelector('.skill-name').textContent = service;


            tag.querySelector('.tag-remove').addEventListener(
                'click',
                function() {

                    tag.remove();

                    updateTagsVisibility();

                }
            );


            skillsTags.appendChild(tag);

            updateTagsVisibility();


            /*
            | Clear search
            */

            searchInput.value = '';

            suggestions.innerHTML = '';
            suggestions.style.display = 'none';

            searchInput.focus();
        }


        /*
        |--------------------------------------------------------------------------
        | SEARCH SERVICES WHILE TYPING
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener('input', function() {

            const search = this.value.trim().toLowerCase();

            suggestions.innerHTML = '';


            if (!search) {

                suggestions.style.display = 'none';

                return;
            }


            const selectedServices = getSelectedServices();


            const filteredServices = availableServices.filter(function(service) {

                const matchesSearch =
                    service.toLowerCase().includes(search);

                const alreadySelected =
                    selectedServices.some(function(selected) {
                        return selected.toLowerCase() === service.toLowerCase();
                    });

                return matchesSearch && !alreadySelected;
            });


            /*
            | No result
            */

            if (filteredServices.length === 0) {

                suggestions.innerHTML = `
                <li style="color:#999;">
                    No services found
                </li>
            `;

                suggestions.style.display = 'block';

                return;
            }


            /*
            | Show results
            */

            filteredServices.forEach(function(service) {

                const li = document.createElement('li');

                li.textContent = service;

                li.style.cursor = 'pointer';


                li.addEventListener('click', function() {

                    addService(service);

                });


                suggestions.appendChild(li);
            });


            suggestions.style.display = 'block';
        });


        /*
        |--------------------------------------------------------------------------
        | Enter key
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener('keydown', function(e) {

            if (e.key === 'Enter') {

                e.preventDefault();

                const firstSuggestion =
                    suggestions.querySelector('li');

                if (
                    firstSuggestion &&
                    firstSuggestion.textContent !== 'No services found'
                ) {

                    addService(firstSuggestion.textContent);
                }
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Clear Search Button
        |--------------------------------------------------------------------------
        */

        const clearButton = form.querySelector('.ac-clear');

        if (clearButton) {

            // Initially hide
            clearButton.style.display = 'none';

            // Input me typing/search
            searchInput.addEventListener('input', function () {
                if (this.value.trim() !== '') {
                    clearButton.style.display = 'block';
                } else {
                    clearButton.style.display = 'none';
                }
            });

            // Clear button click
            clearButton.addEventListener('click', function () {

                searchInput.value = '';

                suggestions.innerHTML = '';
                suggestions.style.display = 'none';

                clearButton.style.display = 'none';

                searchInput.focus();
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Submit Form AJAX
        |--------------------------------------------------------------------------
        */

        form.addEventListener('submit', function(e) {

            e.preventDefault();


            const submitBtn =
                document.getElementById('servicesSubmitBtn');

            const submitText =
                document.getElementById('servicesSubmitText');


            if (submitBtn.disabled) {
                return;
            }


            /*
            | Get selected services
            */

            const services = getSelectedServices();


            /*
            | Validation
            */

            if (services.length === 0) {

                alert('Please select at least one service.');

                return;
            }


            /*
            | Submitting state
            */

            submitBtn.disabled = true;

            submitText.textContent = 'Submitting...';


            /*
            | FormData
            */

            const formData = new FormData(form);

            formData.delete('services[]');


            services.forEach(function(service) {

                formData.append(
                    'services[]',
                    service
                );

            });


            /*
            | AJAX
            */

            fetch(form.action, {

                    method: 'POST',

                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },

                    body: formData

                })

                .then(async function(response) {

                    const data = await response.json();

                    if (!response.ok) {

                        throw {
                            status: response.status,
                            data: data
                        };

                    }

                    return data;

                })

                .then(function(data) {

                    if (data.success === true) {

                        alert(
                            data.message ||
                            'Services saved successfully.'
                        );

                        window.location.reload();

                    } else {

                        throw {
                            data: data
                        };

                    }

                })

                .catch(function(error) {

                    console.error(
                        'Services AJAX Error:',
                        error
                    );


                    let message =
                        'Something went wrong. Please try again.';


                    if (error.data) {

                        if (error.data.errors) {

                            message =
                                Object.values(error.data.errors)
                                .flat()
                                .join('\n');

                        } else if (error.data.message) {

                            message =
                                error.data.message;

                        }

                    }


                    alert(message);


                    submitBtn.disabled = false;

                    submitText.textContent = 'Save';

                });

        });


        function removeSkill(button) {
            const tag = button.closest('.skilltag');

            if (tag) {
                tag.remove();
            }

            updateTagsVisibility();
        }


        /*
        |--------------------------------------------------------------------------
        | Initial state
        |--------------------------------------------------------------------------
        */

        updateTagsVisibility();

    });

    function removeSkill(button) {
        const tag = button.closest('.skilltag');

        if (tag) {
            tag.remove();
        }

        updateTagsVisibility();
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('teamMemberForm');

        if (!form) {
            return;
        }

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            const submitBtn = document.getElementById('teamMemberSubmitBtn');
            const submitText = document.getElementById('teamMemberSubmitText');

            // Prevent double submit
            if (submitBtn.disabled) {
                return;
            }

            // Submitting state
            submitBtn.disabled = true;
            submitText.textContent = 'Submitting...';

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',

                    headers: {
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

                    if (data.success === true) {

                        alert(
                            data.message ||
                            'Team member saved successfully.'
                        );

                        window.location.reload();

                    } else {

                        throw {
                            data: data
                        };
                    }
                })

                .catch(error => {

                    console.error(
                        'Team Member AJAX Error:',
                        error
                    );

                    let message =
                        'Something went wrong. Please try again.';

                    if (error.data) {

                        if (error.data.errors) {

                            message = Object.values(
                                    error.data.errors
                                )
                                .flat()
                                .join('\n');

                        } else if (error.data.message) {

                            message = error.data.message;
                        }
                    }

                    alert(message);

                    // Enable button again
                    submitBtn.disabled = false;
                    submitText.textContent = 'Save';
                });

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const roleInput = document.getElementById('roleSearchInput');
        const suggestions = document.getElementById('roleSuggestions');
        const jobTags = document.getElementById('jobTags');
        const clearBtn = document.getElementById('roleClearBtn');

        if (!roleInput || !suggestions || !jobTags) {
            return;
        }


        function getSelectedRoles() {

            const roles = [];

            jobTags.querySelectorAll('.skilltag').forEach(function(tag) {

                const name = tag.querySelector('.skill-name');

                if (name) {

                    const value = name.textContent.trim();

                    if (value) {
                        roles.push(value);
                    }
                }
            });

            return roles;
        }


        function removeRole(button) {

            const tag = button.closest('.skilltag');

            if (tag) {
                tag.remove();
            }

            updateTagsVisibility();
        }


        function updateTagsVisibility() {

            const count =
                jobTags.querySelectorAll('.skilltag').length;

            jobTags.style.display =
                count > 0 ? 'flex' : 'none';
        }


        function addRole(role) {

            const selectedRoles = getSelectedRoles();

            const exists = selectedRoles.some(function(selected) {

                return selected.toLowerCase() ===
                    role.toLowerCase();

            });

            if (exists) {
                return;
            }


            const tag = document.createElement('span');

            tag.className = 'skilltag';

            tag.innerHTML = `
            <span class="skill-name"></span>

            <button type="button"
                    class="tag-remove"
                    aria-label="Remove role">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="14"
                     height="14"
                     viewBox="0 0 14 14"
                     fill="none">

                    <path d="M10.5 3.5L3.5 10.5"
                          stroke="white"
                          stroke-width="1.77083"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>

                    <path d="M3.5 3.5L10.5 10.5"
                          stroke="white"
                          stroke-width="1.77083"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>

                </svg>

            </button>
        `;


            tag.querySelector('.skill-name')
                .textContent = role;


            tag.querySelector('.tag-remove')
                .addEventListener('click', function() {

                    removeRole(this);

                });


            jobTags.appendChild(tag);

            updateTagsVisibility();

            roleInput.value = '';

            suggestions.innerHTML = '';

            suggestions.style.display = 'none';

            roleInput.focus();
        }


        /*
         * Existing role suggestions
         *
         * Replace this array with your existing
         * database/API role source if you already
         * have one.
         */
        const availableRoles = [
            'Frontend Developer',
            'Backend Developer',
            'Full Stack Developer',
            'Web Developer',
            'Software Developer',
            'PHP Developer',
            'Laravel Developer',
            'React Developer',
            'Vue Developer',
            'Angular Developer',
            'Node.js Developer',
            'UI Designer',
            'UX Designer',
            'UI/UX Designer',
            'Graphic Designer',
            'Product Designer',
            'Mobile App Developer',
            'Android Developer',
            'iOS Developer',
            'DevOps Engineer',
            'QA Engineer',
            'Data Analyst',
            'Project Manager',
            'Business Analyst'
        ];


        roleInput.addEventListener('input', function() {

            const search =
                this.value.trim().toLowerCase();

            suggestions.innerHTML = '';

            if (!search) {

                suggestions.style.display = 'none';

                return;
            }


            const selectedRoles = getSelectedRoles();


            const filteredRoles =
                availableRoles.filter(function(role) {

                    const matches =
                        role.toLowerCase().includes(search);

                    const alreadySelected =
                        selectedRoles.some(function(selected) {

                            return selected.toLowerCase() ===
                                role.toLowerCase();

                        });

                    return matches && !alreadySelected;
                });


            if (filteredRoles.length === 0) {

                suggestions.innerHTML =
                    '<li style="color:#999;">No roles found</li>';

                suggestions.style.display = 'block';

                return;
            }


            filteredRoles.forEach(function(role) {

                const li = document.createElement('li');

                li.textContent = role;

                li.style.cursor = 'pointer';


                li.addEventListener('click', function() {

                    addRole(role);

                });


                suggestions.appendChild(li);
            });


            suggestions.style.display = 'block';

        });


        /*
         * Remove existing dynamically rendered tags
         */
        jobTags.querySelectorAll('.tag-remove')
            .forEach(function(button) {

                button.addEventListener('click', function() {

                    removeRole(this);

                });

            });


        /*
         * Clear input
         */
        if (clearBtn) {

            clearBtn.addEventListener('click', function() {

                roleInput.value = '';

                suggestions.innerHTML = '';

                suggestions.style.display = 'none';

                roleInput.focus();

            });

        }


        /*
         * Hiring Preferences AJAX Submit
         */
        const form =
            document.getElementById('hiringPreferencesForm');

        const submitBtn =
            document.getElementById(
                'hiringPreferencesSubmitBtn'
            );

        const submitText =
            document.getElementById(
                'hiringPreferencesSubmitText'
            );


        if (!form) {
            return;
        }


        form.addEventListener('submit', function(e) {

            e.preventDefault();


            if (submitBtn.disabled) {
                return;
            }


            const roles = getSelectedRoles();


            const locations =
                Array.from(
                    document.getElementById(
                        'preferredLocations'
                    ).selectedOptions
                ).map(function(option) {

                    return option.value;

                });


            const workModes =
                Array.from(
                    document.getElementById(
                        'workModes'
                    ).selectedOptions
                ).map(function(option) {

                    return option.value;

                });


            if (roles.length === 0) {

                alert(
                    'Please select at least one role.'
                );

                return;
            }


            if (locations.length === 0) {

                alert(
                    'Please select at least one location.'
                );

                return;
            }


            if (workModes.length === 0) {

                alert(
                    'Please select at least one job type.'
                );

                return;
            }


            submitBtn.disabled = true;

            submitText.textContent = 'Submitting...';


            const formData = new FormData(form);


            /*
             * Remove default array values
             */
            formData.delete('preferred_roles[]');
            formData.delete('preferred_locations[]');
            formData.delete('work_modes[]');


            /*
             * Add roles
             */
            roles.forEach(function(role) {

                formData.append(
                    'preferred_roles[]',
                    role
                );

            });


            /*
             * Add locations
             */
            locations.forEach(function(location) {

                formData.append(
                    'preferred_locations[]',
                    location
                );

            });


            /*
             * Add work modes
             */
            workModes.forEach(function(mode) {

                formData.append(
                    'work_modes[]',
                    mode
                );

            });


            fetch(form.action, {

                    method: 'POST',

                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },

                    body: formData

                })

                .then(async function(response) {

                    const data =
                        await response.json();

                    if (!response.ok) {

                        throw {
                            status: response.status,
                            data: data
                        };

                    }

                    return data;

                })

                .then(function(data) {

                    if (data.success === true) {

                        alert(
                            data.message ||
                            'Hiring preferences saved successfully.'
                        );

                        window.location.reload();

                    } else {

                        throw {
                            data: data
                        };

                    }

                })

                .catch(function(error) {

                    console.error(
                        'Hiring Preferences AJAX Error:',
                        error
                    );


                    let message =
                        'Something went wrong. Please try again.';


                    if (error.data) {

                        if (error.data.errors) {

                            message =
                                Object.values(
                                    error.data.errors
                                )
                                .flat()
                                .join('\n');

                        } else if (error.data.message) {

                            message =
                                error.data.message;
                        }
                    }


                    alert(message);


                    submitBtn.disabled = false;

                    submitText.textContent = 'Save';

                });

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('socialLinksForm');

        if (!form) {
            return;
        }

        const submitBtn =
            document.getElementById('socialLinksSubmitBtn');

        const submitText =
            document.getElementById('socialLinksSubmitText');


        form.addEventListener('submit', function(e) {

            e.preventDefault();
            if (submitBtn.disabled) {
                return;
            }
            const facebook =
                document.getElementById('facebookUrl').value.trim();

            const linkedin =
                document.getElementById('linkedinUrl').value.trim();

            const instagram =
                document.getElementById('instagramUrl').value.trim();

            const x =
                document.getElementById('xUrl').value.trim();

            if (
                !facebook &&
                !linkedin &&
                !instagram &&
                !x
            ) {

                alert(
                    'Please enter at least one social media URL.'
                );

                return;
            }

            submitBtn.disabled = true;
            submitText.textContent = 'Submitting...';

            const formData = new FormData(form);


            fetch(form.action, {

                    method: 'POST',

                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },

                    body: formData

                })

                .then(async function(response) {

                    const data = await response.json();

                    if (!response.ok) {

                        throw {
                            status: response.status,
                            data: data
                        };

                    }

                    return data;

                })

                .then(function(data) {

                    if (data.success === true) {

                        alert(
                            data.message ||
                            'Social links saved successfully.'
                        );

                        window.location.reload();

                    } else {

                        throw {
                            data: data
                        };

                    }

                })

                .catch(function(error) {

                    console.error(
                        'Social Links AJAX Error:',
                        error
                    );


                    let message =
                        'Something went wrong. Please try again.';


                    if (error.data) {

                        if (error.data.errors) {

                            message =
                                Object.values(
                                    error.data.errors
                                )
                                .flat()
                                .join('\n');

                        } else if (error.data.message) {

                            message =
                                error.data.message;
                        }

                    }


                    alert(message);

                    submitBtn.disabled = false;
                    submitText.textContent = 'Save';

                });
        });

    });
</script>

<script>
    let languages = [];

    document.querySelectorAll('#langList .lang-row').forEach(row => {

        const language = row.dataset.language;
        const proficiency = row.dataset.proficiency;

        if (language) {
            languages.push({
                language: language,
                proficiency: proficiency
            });
        }
    });


    /*
    |--------------------------------------------------------------------------
    | Add Language
    |--------------------------------------------------------------------------
    */
    function addLanguage() {

        const langSelect = document.getElementById('langSelect');
        const langLevel = document.getElementById('langLevel');

        const language = langSelect.value;
        const proficiency = langLevel.value;

        if (!language) {
            alert('Please select a language.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate language
        |--------------------------------------------------------------------------
        */
        const alreadyExists = languages.some(item =>
            item.language.toLowerCase() === language.toLowerCase()
        );

        if (alreadyExists) {
            alert('This language has already been added.');
            return;
        }

        languages.push({
            language: language,
            proficiency: proficiency
        });

        renderLanguages();

        /*
        |--------------------------------------------------------------------------
        | Reset language selector
        |--------------------------------------------------------------------------
        */
        langSelect.value = '';
        langLevel.value = 'Basic';
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Language
    |--------------------------------------------------------------------------
    */
    function removeLanguage(button) {

        const row = button.closest('.lang-row');

        if (!row) {
            return;
        }

        const language = row.dataset.language;

        languages = languages.filter(item =>
            item.language.toLowerCase() !== language.toLowerCase()
        );

        renderLanguages();
    }


    /*
    |--------------------------------------------------------------------------
    | Render Language List
    |--------------------------------------------------------------------------
    */
    function renderLanguages() {

        const langList = document.getElementById('langList');

        langList.innerHTML = '';

        languages.forEach(item => {

            let levelClass = 'level-basic';

            if (item.proficiency === 'Intermediate') {
                levelClass = 'level-intermediate';
            } else if (item.proficiency === 'Fluent') {
                levelClass = 'level-fluent';
            } else if (item.proficiency === 'Native') {
                levelClass = 'level-native';
            }

            const row = document.createElement('div');

            row.className = 'lang-row';

            row.dataset.language = item.language;
            row.dataset.proficiency = item.proficiency;

            row.innerHTML = `
            <span>${escapeHtml(item.language)}</span>

            <span class="level-chip ${levelClass}">
                ${escapeHtml(item.proficiency)}

                <button type="button"
                        class="lang-remove-btn">
                    ✕
                </button>
            </span>
        `;

            row.querySelector('.lang-remove-btn')
                .addEventListener('click', function() {
                    removeLanguage(this);
                });

            langList.appendChild(row);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */
    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;
    }


    /*
    |--------------------------------------------------------------------------
    | Save Languages - AJAX
    |--------------------------------------------------------------------------
    */
    document.getElementById('languagesForm').addEventListener('submit', async function(e) {

        e.preventDefault();

        const form = this;

        const submitBtn = document.getElementById('languagesSubmitBtn');
        const submitBtnText = document.getElementById('languagesSubmitText');

        /*
        |--------------------------------------------------------------------------
        | At least one language
        |--------------------------------------------------------------------------
        */
        if (languages.length === 0) {
            alert('Please add at least one language.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Submitting state
        |--------------------------------------------------------------------------
        */
        submitBtn.disabled = true;
        submitBtnText.textContent = 'Submitting...';

        try {

            const formData = new FormData(form);

            /*
            |--------------------------------------------------------------------------
            | Remove any old languages[]
            |--------------------------------------------------------------------------
            */
            formData.delete('languages[]');

            /*
            |--------------------------------------------------------------------------
            | Add current language list
            |--------------------------------------------------------------------------
            */
            languages.forEach(item => {

                formData.append(
                    'languages[]',
                    JSON.stringify({
                        language: item.language,
                        proficiency: item.proficiency
                    })
                );

            });

            const response = await fetch(form.action, {

                method: 'POST',

                body: formData,

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }

            });

            const data = await response.json();

            /*
            |--------------------------------------------------------------------------
            | Success
            |--------------------------------------------------------------------------
            */
            if (data.success === true) {

                alert(
                    data.message || 'Languages saved successfully.'
                );

                window.location.reload();

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Validation errors
            |--------------------------------------------------------------------------
            */
            if (data.errors) {

                let errors = [];

                Object.values(data.errors).forEach(errorArray => {

                    errorArray.forEach(error => {
                        errors.push(error);
                    });

                });

                alert(errors.join('\n'));

            } else {

                alert(
                    data.message || 'Unable to save languages.'
                );
            }

        } catch (error) {

            console.error('Languages Error:', error);

            alert('Something went wrong. Please try again.');

        } finally {

            submitBtn.disabled = false;
            submitBtnText.textContent = 'Save';
        }

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('companyDocumentForm');
        const fileInput = document.getElementById('fileInputDoc');
        const fileList = document.getElementById('fileList');
        const dropzone = document.getElementById('dropzone');

        const submitBtn = document.getElementById('documentsSubmitBtn');
        const submitText = document.getElementById('documentsSubmitText');

        if (!form || !fileInput || !fileList || !submitBtn) {
            console.error('Company document elements not found.');
            return;
        }

        let selectedDocuments = [];


        /* =========================================================
           OPEN FILE PICKER
        ========================================================= */

        fileInput.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        const uploadBtn = document.getElementById('uploadBtn');

        if (uploadBtn) {
            uploadBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                fileInput.click();
            });
        }


        /* =========================================================
           DROPZONE CLICK
        ========================================================= */

        if (dropzone) {

            dropzone.addEventListener('click', function(e) {

                // Don't open picker when clicking file item/remove button
                if (e.target.closest('.file-item')) {
                    return;
                }

                // Don't trigger twice when clicking Upload File
                if (e.target.closest('#uploadBtn')) {
                    return;
                }

                fileInput.click();
            });


            /* =====================================================
               DRAG & DROP
            ===================================================== */

            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();

                dropzone.classList.add('dragover');
            });


            dropzone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();

                dropzone.classList.remove('dragover');
            });


            dropzone.addEventListener('drop', function(e) {

                e.preventDefault();
                e.stopPropagation();

                dropzone.classList.remove('dragover');

                handleFiles(e.dataTransfer.files);
            });
        }


        /* =========================================================
           FILE INPUT CHANGE
        ========================================================= */

        fileInput.addEventListener('change', function(e) {

            // console.log('Files selected:', e.target.files);

            handleFiles(e.target.files);

            // Allow selecting same file again
            fileInput.value = '';
        });


        /* =========================================================
           HANDLE FILES
        ========================================================= */

        function handleFiles(files) {

            if (!files || files.length === 0) {
                return;
            }

            Array.from(files).forEach(function(file) {

                // console.log('Selected file:', file.name, file.type, file.size);


                /* -------------------------------------------------
                   EXTENSION VALIDATION
                ------------------------------------------------- */

                const extension = file.name
                    .split('.')
                    .pop()
                    .toLowerCase();

                const allowedExtensions = [
                    'pdf',
                    'doc',
                    'docx'
                ];

                if (!allowedExtensions.includes(extension)) {

                    alert(
                        file.name +
                        '\n\nOnly PDF, DOC and DOCX files are allowed.'
                    );

                    return;
                }


                /* -------------------------------------------------
                   SIZE VALIDATION
                ------------------------------------------------- */

                if (file.size > 10 * 1024 * 1024) {

                    alert(
                        file.name +
                        '\n\nMaximum file size is 10 MB.'
                    );

                    return;
                }


                /* -------------------------------------------------
                   DUPLICATE CHECK
                ------------------------------------------------- */

                const duplicate = selectedDocuments.some(function(existingFile) {

                    return (
                        existingFile.name === file.name &&
                        existingFile.size === file.size &&
                        existingFile.lastModified === file.lastModified
                    );

                });

                if (duplicate) {
                    return;
                }


                /* -------------------------------------------------
                   STORE FILE
                ------------------------------------------------- */

                selectedDocuments.push(file);


                /* -------------------------------------------------
                   SHOW FILE
                ------------------------------------------------- */

                addFileToList(file);

            });

            // console.log(
            //     'selectedDocuments:',
            //     selectedDocuments
            // );
        }


        /* =========================================================
           ADD FILE TO LIST
        ========================================================= */

        function addFileToList(file) {

            const item = document.createElement('div');

            item.className = 'file-item';


            item.innerHTML = `
            <div class="file-top">

                <div class="file-icon">
                    ${getFileIcon(file.name)}
                </div>

                <div class="file-info">

                    <div class="file-name">
                        ${escapeHtml(file.name)}
                    </div>

                    <div class="file-size">
                        ${formatFileSize(file.size)}
                    </div>

                </div>

                <button
                    type="button"
                    class="file-remove"
                    title="Remove file">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">

                        <path d="M18 6L6 18"/>
                        <path d="M6 6l12 12"/>

                    </svg>

                </button>

            </div>

            <div class="progress-track">

                <div
                    class="progress-fill"
                    style="width:100%;">
                </div>

            </div>

            <div class="progress-bottom">

                <span class="progress-status">
                    Ready to upload
                </span>

                <span class="progress-percent">
                    100%
                </span>

            </div>
        `;


            fileList.appendChild(item);


            /* =====================================================
               REMOVE FILE
            ===================================================== */

            const removeBtn =
                item.querySelector('.file-remove');


            removeBtn.addEventListener('click', function(e) {

                e.preventDefault();
                e.stopPropagation();


                const index =
                    selectedDocuments.findIndex(function(selectedFile) {

                        return (
                            selectedFile.name === file.name &&
                            selectedFile.size === file.size &&
                            selectedFile.lastModified === file.lastModified
                        );

                    });


                if (index !== -1) {

                    selectedDocuments.splice(index, 1);

                }


                item.remove();


                // console.log(
                //     'Remaining files:',
                //     selectedDocuments
                // );

            });

        }


        /* =========================================================
           FILE ICON
        ========================================================= */

        function getFileIcon(filename) {

            const extension = filename
                .split('.')
                .pop()
                .toLowerCase();


            if (extension === 'pdf') {

                return `
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">

                    <path d="M6 2h9l5 5v15H6z"/>
                    <path d="M15 2v5h5"/>

                </svg>
            `;
            }


            return `
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <rect
                    x="3"
                    y="3"
                    width="18"
                    height="18"
                    rx="2"/>

                <path d="M21 15l-5-5L5 21"/>

            </svg>
        `;
        }


        /* =========================================================
           FILE SIZE
        ========================================================= */

        function formatFileSize(bytes) {

            if (bytes < 1024) {
                return bytes + ' B';
            }

            if (bytes < 1024 * 1024) {
                return (bytes / 1024).toFixed(1) + ' KB';
            }

            return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
        }


        /* =========================================================
           ESCAPE HTML
        ========================================================= */

        function escapeHtml(value) {

            const div = document.createElement('div');

            div.textContent = value;

            return div.innerHTML;
        }


        /* =========================================================
           SUBMIT AJAX
        ========================================================= */

        form.addEventListener('submit', async function(e) {

            e.preventDefault();
            e.stopPropagation();


            // console.log(
            //     'Submitting files:',
            //     selectedDocuments
            // );


            /* -----------------------------------------------------
               CHECK FILES
            ----------------------------------------------------- */

            if (selectedDocuments.length === 0) {

                alert(
                    'Please select at least one company document.'
                );

                return;
            }


            /* -----------------------------------------------------
               BUTTON LOADING
            ----------------------------------------------------- */

            submitBtn.disabled = true;
            submitText.textContent = 'Submitting...';


            try {

                const formData = new FormData();


                /* -------------------------------------------------
                   CSRF
                ------------------------------------------------- */

                const csrf =
                    form.querySelector('input[name="_token"]');

                if (csrf) {

                    formData.append(
                        '_token',
                        csrf.value
                    );

                }


                /* -------------------------------------------------
                   FILES
                ------------------------------------------------- */

                selectedDocuments.forEach(function(file) {

                    formData.append(
                        'documents[]',
                        file,
                        file.name
                    );

                });


                // console.log(
                //     'Sending request to:',
                //     form.action
                // );


                /* -------------------------------------------------
                   FETCH
                ------------------------------------------------- */

                const response = await fetch(
                    form.action, {
                        method: 'POST',

                        body: formData,

                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }
                );


                // console.log(
                //     'HTTP status:',
                //     response.status
                // );


                const data = await response.json();


                // console.log(
                //     'Server response:',
                //     data
                // );


                /* =================================================
                   SUCCESS
                ================================================= */

                if (
                    response.ok &&
                    data.success === true
                ) {

                    alert(
                        data.message ||
                        'Company documents uploaded successfully.'
                    );


                    window.location.reload();

                    return;
                }


                /* =================================================
                   VALIDATION ERROR
                ================================================= */

                if (data.errors) {

                    const errors = [];

                    Object.values(data.errors).forEach(
                        function(errorArray) {

                            if (Array.isArray(errorArray)) {

                                errorArray.forEach(
                                    function(error) {

                                        errors.push(error);

                                    }
                                );

                            }

                        }
                    );


                    alert(
                        errors.join('\n')
                    );

                } else {

                    alert(
                        data.message ||
                        'Unable to upload company documents.'
                    );

                }


            } catch (error) {

                console.error(
                    'Company Document AJAX Error:',
                    error
                );


                alert(
                    'Something went wrong. Please try again.'
                );


            } finally {

                submitBtn.disabled = false;

                submitText.textContent = 'Save';

            }

        });

        /* =========================================================
        DELETE COMPANY DOCUMENT
        ========================================================= */

        document.querySelectorAll('.delete-document-btn').forEach(function(button) {

            button.addEventListener('click', async function() {

                const documentId = this.dataset.id;

                if (!documentId) {
                    alert('Invalid document.');
                    return;
                }


                /* -----------------------------------------------------
                   CONFIRM
                ----------------------------------------------------- */

                const confirmed = confirm(
                    'Are you sure you want to delete this document?'
                );

                if (!confirmed) {
                    return;
                }


                /* -----------------------------------------------------
                   BUTTON STATE
                ----------------------------------------------------- */

                const deleteBtn = this;

                deleteBtn.disabled = true;


                try {

                    /* -------------------------------------------------
                       CSRF
                    ------------------------------------------------- */

                    const csrfToken = document.querySelector(
                        '#companyDocumentForm input[name="_token"]'
                    )?.value || '';


                    /* -------------------------------------------------
                       REQUEST
                    ------------------------------------------------- */

                    const response = await fetch(
                        "{{ route('employer.profile.documents.delete', ':id') }}"
                        .replace(':id', documentId), {
                            method: 'DELETE',

                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',

                                'X-CSRF-TOKEN': csrfToken || ''
                            }
                        }
                    );


                    /* -------------------------------------------------
                       RESPONSE
                    ------------------------------------------------- */

                    const data = await response.json();


                    // console.log(
                    //     'Delete document response:',
                    //     data
                    // );


                    /* -------------------------------------------------
                       SUCCESS
                    ------------------------------------------------- */

                    if (
                        response.ok &&
                        data.success === true
                    ) {

                        alert(
                            data.message ||
                            'Company document deleted successfully.'
                        );

                        window.location.reload();

                        return;
                    }


                    /* -------------------------------------------------
                       ERROR
                    ------------------------------------------------- */

                    alert(
                        data.message ||
                        'Unable to delete company document.'
                    );


                } catch (error) {

                    console.error(
                        'Delete Document Error:',
                        error
                    );


                    alert(
                        'Something went wrong. Please try again.'
                    );


                } finally {

                    deleteBtn.disabled = false;

                }

            });

        });

    });
</script>
@endsection