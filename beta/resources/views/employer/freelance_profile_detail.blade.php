@extends('layouts.main')

@section('main-section')

<link rel="stylesheet" href="{{ asset('frontend/css/applicants-profile-post.css') }}" />

<section class="applicantProfilePost">
    <div class="container-fluid">

        <div class="backBUtton">
            <a href="{{ route('employer.find.talent') }}" class="backToPage">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <g clip-path="url(#clip0_1559_7985)">
                        <path
                            d="M3.63599 11.2927C3.44852 11.4802 3.3432 11.7345 3.3432 11.9997C3.3432 12.2648 3.44852 12.5191 3.63599 12.7067L9.29299 18.3637C9.38523 18.4592 9.49558 18.5353 9.61758 18.5878C9.73959 18.6402 9.87081 18.6678 10.0036 18.6689C10.1364 18.6701 10.268 18.6448 10.3909 18.5945C10.5138 18.5442 10.6255 18.4699 10.7194 18.3761C10.8133 18.2822 10.8875 18.1705 10.9378 18.0476C10.9881 17.9247 11.0134 17.793 11.0122 17.6603C11.0111 17.5275 10.9835 17.3963 10.9311 17.2743C10.8787 17.1522 10.8025 17.0419 10.707 16.9497L6.75699 12.9997L20 12.9997C20.2652 12.9997 20.5196 12.8943 20.7071 12.7068C20.8946 12.5192 21 12.2649 21 11.9997C21 11.7344 20.8946 11.4801 20.7071 11.2926C20.5196 11.105 20.2652 10.9997 20 10.9997L6.75699 10.9997L10.707 7.04966C10.8891 6.86105 10.9899 6.60845 10.9877 6.34626C10.9854 6.08406 10.8802 5.83325 10.6948 5.64784C10.5094 5.46243 10.2586 5.35726 9.99639 5.35498C9.73419 5.3527 9.48159 5.4535 9.29299 5.63566L3.63599 11.2927Z"
                            fill="#414141" />
                    </g>
                    <defs>
                        <clipPath id="clip0_1559_7985">
                            <rect width="24" height="24" fill="white" transform="matrix(0 -1 1 0 0 24)" />
                        </clipPath>
                    </defs>
                </svg>
                Back to Freelancers
            </a>
        </div>
        <div class="freelanceJob">
            <div class="aboutInfo">
                <div class="companyDetails">
                    <div class="images">
                        <img src="{{ $freelancer->profile_photo ? : 'https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg' }}" alt="{{ $freelancer->name }}"
                            onerror="this.onerror=null;this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg'">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"
                                fill="none">
                                <path
                                    d="M13.4633 6.25537C13.7454 7.65681 13.5444 9.1138 12.8939 10.3834C12.2434 11.6529 11.1827 12.6583 9.88874 13.2318C8.59477 13.8054 7.14572 13.9124 5.78324 13.5351C4.42075 13.1578 3.22719 12.319 2.4016 11.1585C1.57601 9.99796 1.16829 8.58595 1.24643 7.15789C1.32457 5.72984 1.88386 4.37207 2.83102 3.31102C3.77818 2.24997 5.05595 1.54976 6.45127 1.32717C7.84658 1.10459 9.27508 1.37307 10.4986 2.08786"
                                    stroke="#00C950" stroke-width="1.24279" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M5.55603 6.87893L7.40864 8.75478L13.584 2.50195" stroke="#00C950"
                                    stroke-width="1.24279" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <div class="text">
                        <h5>{{ $freelancer->name }}</h5>
                        <span>{{ $freelancer->job_title }}</span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path
                                    d="M13.3376 6.66567C13.3376 9.99434 9.6449 13.461 8.4049 14.5317C8.28938 14.6185 8.14876 14.6655 8.00423 14.6655C7.8597 14.6655 7.71908 14.6185 7.60356 14.5317C6.36356 13.461 2.6709 9.99434 2.6709 6.66567C2.6709 5.25118 3.2328 3.89463 4.233 2.89443C5.23319 1.89424 6.58974 1.33234 8.00423 1.33234C9.41872 1.33234 10.7753 1.89424 11.7755 2.89443C12.7757 3.89463 13.3376 5.25118 13.3376 6.66567Z"
                                    stroke="#6A7282" stroke-width="0.621397" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M8.00635 8.66626C9.11092 8.66626 10.0063 7.77083 10.0063 6.66626C10.0063 5.56169 9.11092 4.66626 8.00635 4.66626C6.90178 4.66626 6.00635 5.56169 6.00635 6.66626C6.00635 7.77083 6.90178 8.66626 8.00635 8.66626Z"
                                    stroke="#6A7282" stroke-width="0.621397" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            {{ $freelancer->state_name }}, {{ $freelancer->country_name }}
                        </span>
                        <p><span></span> Available now</p>
                    </div>
                </div>

                <div class="companyContact">
                    <!-- <div class="contactDtailes">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path
                                    d="M14.6629 4.66739L8.66892 8.48539C8.46552 8.60353 8.23448 8.66576 7.99926 8.66576C7.76403 8.66576 7.53299 8.60353 7.32959 8.48539L1.32959 4.66739"
                                    stroke="#555555" stroke-width="0.776746" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M13.3296 2.66546H2.66292C1.92654 2.66546 1.32959 3.26242 1.32959 3.9988V11.9988C1.32959 12.7352 1.92654 13.3321 2.66292 13.3321H13.3296C14.066 13.3321 14.6629 12.7352 14.6629 11.9988V3.9988C14.6629 3.26242 14.066 2.66546 13.3296 2.66546Z"
                                    stroke="#555555" stroke-width="0.776746" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text">
                            <span>Email</span>
                            <p></p>
                        </div>
                    </div> -->

                    <!-- <div class="contactDtailes">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path
                                    d="M13.0002 14.6667C13.2654 14.6667 13.5197 14.5613 13.7073 14.3738C13.8948 14.1862 14.0002 13.9319 14.0002 13.6667V11.3333C14.0002 11.0681 13.8948 10.8138 13.7073 10.6262C13.5197 10.4387 13.2654 10.3333 13.0002 10.3333C12.2202 10.3333 11.4535 10.2133 10.7202 9.96667C10.5448 9.91133 10.3577 9.90506 10.1791 9.94854C10.0004 9.99203 9.83711 10.0836 9.70683 10.2133L8.74683 11.1733C7.08832 10.2683 5.72522 8.90517 4.82016 7.24667L5.7735 6.29333C6.04683 6.03333 6.14683 5.64667 6.02683 5.27333C5.78683 4.54667 5.66683 3.78 5.66683 3C5.66683 2.73478 5.56147 2.48043 5.37394 2.29289C5.1864 2.10536 4.93205 2 4.66683 2H2.3335C2.06828 2 1.81393 2.10536 1.62639 2.29289C1.43885 2.48043 1.3335 2.73478 1.3335 3C1.3335 9.43333 6.56683 14.6667 13.0002 14.6667ZM2.3335 2.66667H4.66683C4.75523 2.66667 4.84002 2.70179 4.90253 2.7643C4.96504 2.82681 5.00016 2.91159 5.00016 3C5.00016 3.85333 5.1335 4.68667 5.3935 5.48C5.42683 5.57333 5.42016 5.70667 5.3135 5.81333L4.00016 7.12C5.10016 9.27333 6.7135 10.8867 8.8735 12L10.1735 10.6867C10.2668 10.5933 10.3935 10.5667 10.5135 10.6C11.3135 10.8667 12.1468 11 13.0002 11C13.0886 11 13.1734 11.0351 13.2359 11.0976C13.2984 11.1601 13.3335 11.2449 13.3335 11.3333V13.6667C13.3335 13.7551 13.2984 13.8399 13.2359 13.9024C13.1734 13.9649 13.0886 14 13.0002 14C6.9335 14 2.00016 9.06667 2.00016 3C2.00016 2.91159 2.03528 2.82681 2.09779 2.7643C2.16031 2.70179 2.24509 2.66667 2.3335 2.66667Z"
                                    fill="#555555" />
                            </svg>
                        </div>
                        <div class="text">
                            <span>Phone</span>
                            <p></p>
                        </div>
                    </div> -->

                    <div class="contactDtailes">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path
                                    d="M8.00016 14.1667C9.63566 14.1667 11.2042 13.517 12.3607 12.3605C13.5171 11.204 14.1668 9.6355 14.1668 8C14.1668 6.3645 13.5171 4.79598 12.3607 3.63951C11.2042 2.48304 9.63566 1.83334 8.00016 1.83334M14.1668 8H1.8335M8.00016 14.1667C6.36466 14.1667 4.79615 13.517 3.63967 12.3605C2.4832 11.204 1.8335 9.6355 1.8335 8C1.8335 6.3645 2.4832 4.79598 3.63967 3.63951C4.79615 2.48304 6.36466 1.83334 8.00016 1.83334M8.00016 1.83334C7.66683 1.83334 5.3335 4.594 5.3335 8C5.3335 11.406 7.66683 14.1667 8.00016 14.1667M8.00016 1.83334C8.3335 1.83334 10.6668 4.594 10.6668 8C10.6668 11.406 8.3335 14.1667 8.00016 14.1667"
                                    stroke="#555555" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text">
                            <span>Portfolio Link</span>
                            <p>{{ $freelancer->portfolio }}</p>
                        </div>
                    </div>
                </div>

                <div class="languages">
                    <div class="title">
                        <h5>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                fill="none">
                                <path d="M3.33249 5.33301L7.33249 9.33301" stroke="#00A148" stroke-width="0.776746"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.66537 9.33106L6.66537 5.33105L7.99871 3.33105" stroke="#00A148"
                                    stroke-width="0.776746" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1.33112 3.33105H9.33112" stroke="#00A148" stroke-width="0.776746"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4.66675 1.3291H5.33341" stroke="#00A148" stroke-width="0.776746"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.6658 14.6667L11.3325 8L7.99918 14.6667" stroke="#00A148"
                                    stroke-width="0.776746" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.33344 11.9971H13.3334" stroke="#00A148" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Languages
                        </h5>
                    </div>
                    <div class="allLang">
                        @php
                        $languages = json_decode($freelancer->languages ?? '{}', true) ?: [];
                        @endphp

                        @forelse($languages as $lang => $level)
                        <div class="eng">
                            <p>{{ ucfirst($lang) }}</p>
                            <span>{{ ucfirst($level) }}</span>
                        </div>
                        @empty
                        <p>No languages added.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="aboutCompany">
                <div class="companyDesc">
                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M19.0014 21.001V19.001C19.0014 17.9401 18.58 16.9227 17.8298 16.1726C17.0797 15.4224 16.0623 15.001 15.0014 15.001H9.0014C7.94054 15.001 6.92312 15.4224 6.17297 16.1726C5.42283 16.9227 5.0014 17.9401 5.0014 19.001V21.001"
                                stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M11.9997 10.998C14.2089 10.998 15.9997 9.20719 15.9997 6.99805C15.9997 4.78891 14.2089 2.99805 11.9997 2.99805C9.79057 2.99805 7.99971 4.78891 7.99971 6.99805C7.99971 9.20719 9.79057 10.998 11.9997 10.998Z"
                                stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        About
                    </h4>
                    <button type="button" class="aplNow chat chatBtn" data-freelancer-id="{{ $freelancer->user_id }}">Chat</button>
                    <hr>
                    <p>{{ $freelancer->bio ?? 'No information available.' }}</p>

                    <h5>Skills</h5>
                    <ul>
                        @foreach($skills as $skill)
                        <li>{{ $skill->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="expDetails">
                    <div class="title">
                        <h5>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M2 11.9998C2 12.3998 2.11 12.7598 2.29 13.0798L5.79 19.1398C6.15 19.7498 6.69 20.2598 7.38 20.4798C8.68 20.9098 10.09 20.3698 10.77 19.2198L11.6 17.7398L8.28 11.9598L11.82 5.85984L12.65 4.41984C12.9 3.98984 13.23 3.62984 13.62 3.33984H8.2C7.26 3.33984 6.36 3.84984 5.89 4.67984L2.28 10.9298C2.1 11.2498 1.99 11.6198 1.99 12.0098L2 11.9998Z"
                                    fill="#00A148" />
                                <path
                                    d="M22 11.9997C22 11.5997 21.89 11.2397 21.71 10.9197L18.17 4.77965C17.48 3.58965 16.08 3.07965 14.78 3.51965C14.09 3.73965 13.55 4.23965 13.19 4.85965L12.36 6.22965L15.72 12.0097L12.18 18.1097L11.35 19.5897C11.1 20.0197 10.77 20.3797 10.38 20.6697H15.83C16.77 20.6697 17.67 20.1597 18.14 19.3297L21.75 13.0797C21.89 12.7597 22 12.3897 22 11.9997Z"
                                    fill="#00A148" />
                            </svg>
                            Experience
                        </h5>
                    </div>
                    <hr>
                    <div class="showExp">
                        @forelse($experiences as $experience)
                        <div class="details">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M6.0059 21.9941V3.99414C6.0059 3.46371 6.21661 2.955 6.59169 2.57993C6.96676 2.20485 7.47547 1.99414 8.0059 1.99414H16.0059C16.5363 1.99414 17.045 2.20485 17.4201 2.57993C17.7952 2.955 18.0059 3.46371 18.0059 3.99414V21.9941H6.0059Z"
                                        stroke="#00A148" stroke-width="0.776746" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M6.00313 11.9912H4.00313C3.47269 11.9912 2.96399 12.2019 2.58891 12.577C2.21384 12.9521 2.00313 13.4608 2.00313 13.9912V19.9912C2.00313 20.5216 2.21384 21.0304 2.58891 21.4054C2.96399 21.7805 3.47269 21.9912 4.00313 21.9912H6.00313"
                                        stroke="#00A148" stroke-width="0.776746" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M18.0046 8.99805H20.0046C20.535 8.99805 21.0437 9.20876 21.4188 9.58383C21.7939 9.95891 22.0046 10.4676 22.0046 10.998V19.998C22.0046 20.5285 21.7939 21.0372 21.4188 21.4123C21.0437 21.7873 20.535 21.998 20.0046 21.998H18.0046"
                                        stroke="#00A148" stroke-width="0.776746" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M10.0039 5.99512H14.0039" stroke="#00A148" stroke-width="0.776746"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.0039 9.99512H14.0039" stroke="#00A148" stroke-width="0.776746"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.0039 14.001H14.0039" stroke="#00A148" stroke-width="0.776746"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.0039 17.9971H14.0039" stroke="#00A148" stroke-width="0.776746"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>

                            <div class="textArea">
                                <div class="titleDetail">

                                    <div class="text">
                                        <h5>{{ $experience->position }}</h5>
                                        <p>
                                            <!-- <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M3.50621 12.8317V2.33171C3.50621 2.02229 3.62913 1.72554 3.84792 1.50675C4.06671 1.28796 4.36346 1.16504 4.67288 1.16504H9.33955C9.64896 1.16504 9.94571 1.28796 10.1645 1.50675C10.3833 1.72554 10.5062 2.02229 10.5062 2.33171V12.8317H3.50621Z"
                                                        stroke="#6A7282" stroke-width="0.621397"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M3.50319 7H2.33652C2.0271 7 1.73036 7.12292 1.51157 7.34171C1.29277 7.5605 1.16986 7.85725 1.16986 8.16667V11.6667C1.16986 11.9761 1.29277 12.2728 1.51157 12.4916C1.73036 12.7104 2.0271 12.8333 2.33652 12.8333H3.50319"
                                                        stroke="#6A7282" stroke-width="0.621397"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M10.5048 5.24707H11.6714C11.9808 5.24707 12.2776 5.36999 12.4964 5.58878C12.7152 5.80757 12.8381 6.10432 12.8381 6.41374V11.6637C12.8381 11.9732 12.7152 12.2699 12.4964 12.4887C12.2776 12.7075 11.9808 12.8304 11.6714 12.8304H10.5048"
                                                        stroke="#6A7282" stroke-width="0.621397"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M5.83555 3.50098H8.16889" stroke="#6A7282"
                                                        stroke-width="0.621397" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M5.83555 5.83594H8.16889" stroke="#6A7282"
                                                        stroke-width="0.621397" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M5.83555 8.16699H8.16889" stroke="#6A7282"
                                                        stroke-width="0.621397" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M5.83555 10.499H8.16889" stroke="#6A7282"
                                                        stroke-width="0.621397" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                TechCorp Solutions
                                            </span> -->
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path d="M4.66307 1.16504V3.49837" stroke="#6A7282"
                                                        stroke-width="0.621397" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M9.33578 1.16504V3.49837" stroke="#6A7282"
                                                        stroke-width="0.621397" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M11.0812 2.33301H2.91456C2.27023 2.33301 1.74789 2.85534 1.74789 3.49967V11.6663C1.74789 12.3107 2.27023 12.833 2.91456 12.833H11.0812C11.7256 12.833 12.2479 12.3107 12.2479 11.6663V3.49967C12.2479 2.85534 11.7256 2.33301 11.0812 2.33301Z"
                                                        stroke="#6A7282" stroke-width="0.621397"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M1.74789 5.83594H12.2479" stroke="#6A7282"
                                                        stroke-width="0.621397" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($experience->start_date)->format('Y') }} - {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('Y') : 'Present' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="duration">
                                        <p>{{ $experience->employment_type }}</p>
                                    </div>
                                </div>

                                <div class="expDesc">
                                    <p>{!! $experience->description !!}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="content">
                            <div class="images">
                                <img src="{{ asset('frontend/images/no-recent-job.png') }}" alt="">
                            </div>
                            <div class="text">
                                <h4>No Experience Found</h4>
                                <p>You haven't Added any Experience.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    const csrfToken = "{{ csrf_token() }}";

    $(document).on('click', '.chatBtn', function() {

        let button = $(this);
        let freelancer_id = button.data('freelancer-id');

        button.prop('disabled', true);
        showLoder();

        $.ajax({
            url: "{{ route('chat.create') }}",
            type: "POST",
            data: {
                _token: csrfToken,
                freelancer_id: freelancer_id
            },
            success: function(response) {

                button.prop('disabled', false);
                hideLoder();

                if (response.status) {
                    window.location.href = response.redirect;
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {

                button.prop('disabled', false);
                hideLoder();

                alert(xhr.responseJSON?.message ?? 'Something went wrong.');
            }
        });

    });
</script>

@endsection