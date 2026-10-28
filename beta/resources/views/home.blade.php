    @php

    if (Auth::check()) {
        $user = Auth::user();
        $user_id = $user->id;
        $role = $user->role;

        $fields = ['name', 'email', 'phone', 'profile_photo'];
        $userDetails = getUserDetails($user_id, $fields);
    } else {
        $user_id = null;
        $role = null;
        $userDetails = null;
    }

    $fields1 = ['id', 'name', 'description', 'slug', 'icon'];
    $getCate = getCategories($fields1);

@endphp


@extends('layouts.main')

@section('main-section')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />

<link rel="stylesheet" href="{{ asset('frontend/css/newhomepage.css') }}?v={{ filemtime(public_path('frontend/css/newhomepage.css')) }}" />
<!-- <link rel="stylesheet" href="https://lanxers.com/public/frontend/css/global.css?v=1788952325"> -->
<style>
        .bannerLogoSwiper .splide__list {
            align-items: center;
            justify-content: flex-start;
            height: auto !important;
        }
        .bannerLogoSwiper .splide__slide {
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            flex-shrink: 0;
        }
        .testimonials .testimonialSwiper .splide__list,
        .testimonials .testimonialSwiper2 .splide__list {
            padding: 0.625vw 0;
        }
        .testimonials .splide__slide {
            flex-shrink: 0;
            height: auto;
        }
        @media (max-width: 990px) {
            .testimonials .testimonialSwiper .splide__list,
            .testimonials .testimonialSwiper2 .splide__list {
                padding: 3.0769230769vw 0;
            }
            .testimonials .splide__slide {
                box-sizing: border-box;
                padding: 0 1.2820512821vw;
            }
        }
        .jobcardsection .jobcardSwiper1 .splide__list,
        .jobcardsection .jobcardSwiper2 .splide__list {
            padding: 0.625vw 0;
        }
        .jobcardsection .splide__slide {
            flex-shrink: 0;
            height: auto;
            box-sizing: border-box;
            padding: 0 0.520833vw;
        }
        @media (max-width: 990px) {
            .testimonials .testimonialSwiper,
            .testimonials .testimonialSwiper2,
            .jobcardsection .jobcardSwiper1,
            .jobcardsection .jobcardSwiper2 {
                padding-left: 0;
                padding-right: 0;
            }
            .testimonials .testimonialSwiper2 .splide__track {
                padding-left: 50px !important;
                padding-right: 0 !important;
            }
            .jobcardsection .jobcardSwiper1 .splide__list,
            .jobcardsection .jobcardSwiper2 .splide__list {
                padding: 3.0769230769vw 0;
            }
            .jobcardsection .splide__slide {
                padding: 0;
            }
        }
    </style>


<!-- Start Banner  -->
<section class="videobanner">
    <div class="hero__media">
        <div class="hero__media">
            <video class="hero__video desktop-video" autoplay muted loop playsinline>
                <source src="{{ asset('frontend/images/freelance-video.mp4') }}" type="video/mp4">
            </video>

            <video class="hero__video mobile-video" autoplay muted loop playsinline>
                <source src="{{ asset('frontend/videos/freelance_phone_video.mp4') }}" type="video/mp4">
            </video>
        </div>
    </div>
    <div class="container-fluid">
        <div class="hero__content">
            <div class="pills">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <circle cx="7" cy="7" r="7" fill="#5CFFA5"/>
                </svg>
                <span>Jobs . Internships . Freelance projects</span>
            </div>
            
            <h1>Find All Kinds of <br> <span>Opportunities</span></h1>
            <p class="para">One place for whatever you're looking for</p>
        </div>


        <div class="search-wrapper">
            <form class="search-bar">
                <div class="field" data-field="skills">
                    <span class="field-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M8.25 13.875C11.3566 13.875 13.875 11.3566 13.875 8.25C13.875 5.1434 11.3566 2.625 8.25 2.625C5.1434 2.625 2.625 5.1434 2.625 8.25C2.625 11.3566 5.1434 13.875 8.25 13.875Z" stroke="#00A148" stroke-width="1.35"/>
                            <path d="M12.75 12.75L15.75 15.75" stroke="#00A148" stroke-width="1.35" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Search by Skills, Company or Job Title" autocomplete="off">
                    <div class="suggestions"></div>
                </div>

                <div class="divider"></div>

                <div class="field location-text" data-field="location">
                    <span class="field-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M9 0.898438C6.2055 0.898438 3.9375 2.91444 3.9375 5.39844C3.9375 8.77344 9 17.0984 9 17.0984C9 17.0984 14.0625 8.77344 14.0625 5.39844C14.0625 2.91444 11.7945 0.898438 9 0.898438Z" stroke="#00A148" stroke-width="1.53" stroke-linejoin="round"/>
                            <path d="M8.99961 7.20156C10.118 7.20156 11.0246 6.39567 11.0246 5.40156C11.0246 4.40745 10.118 3.60156 8.99961 3.60156C7.88123 3.60156 6.97461 4.40745 6.97461 5.40156C6.97461 6.39567 7.88123 7.20156 8.99961 7.20156Z" stroke="#00A148" stroke-width="1.53"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Location" autocomplete="off">
                    <div class="suggestions"></div>
                </div>

                <div class="divider"></div>

                <div class="field expe-text" data-field="experience">
                    <span class="field-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                            <g clip-path="url(#clip0_5207_14973)">
                                <path d="M15.5456 4.72656H2.45472C1.55098 4.72656 0.818359 5.45919 0.818359 6.36293V12.9084C0.818359 13.8121 1.55098 14.5447 2.45472 14.5447H15.5456C16.4494 14.5447 17.182 13.8121 17.182 12.9084V6.36293C17.182 5.45919 16.4494 4.72656 15.5456 4.72656Z" stroke="#00A148" stroke-width="1.39091"></path>
                                <path d="M5.72754 4.72372V3.90554C5.72754 3.03756 6.07234 2.20513 6.6861 1.59137C7.29985 0.977617 8.13229 0.632813 9.00027 0.632812C9.86825 0.632813 10.7007 0.977617 11.3144 1.59137C11.9282 2.20513 12.273 3.03756 12.273 3.90554V4.72372" stroke="#00A148" stroke-width="1.39091" stroke-linecap="round"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_5207_14973">
                                <rect width="18" height="16" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    <select class="experience_level" name="experience_level">
                        <option value="">Experience</option>
                        <option value="entry">Entry Level</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="expert">Expert</option>
                    </select>
                </div>

                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>
    </div>
</section>
<!-- End Banner  -->
 <!-- Logo Slider -->
<div class="bannerLogoSwiperdiv">

    <div class="heading">
        <h1>Featured <span>company</span> </h1>
        <!-- <p>Explore opportunities that match what you do best. Choose your skills and discover jobs built around your expertise. </p> -->
    </div>
    <div class="splide bannerLogoSwiper" aria-label="Logos">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad8910485372.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e38f422a6.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e3a28ef9e.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad891a5b5c46.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e3b42d847.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e3c76dcd9.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e40ac224c.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad8910485372.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e38f422a6.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e3a28ef9e.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad891a5b5c46.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e3b42d847.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e3c76dcd9.jpg" alt=""></li>
                <li class="splide__slide"><img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ad5e40ac224c.jpg" alt=""></li>

            </ul>
        </div>
    </div>
</div>
<!-- Logo Slider -->


<section class="skills-section">
    <div class="heading">
        <h1>Opportunities for <span>Every Skill</span> </h1>
        <!-- <p>Explore opportunities that match what you do best. Choose your skills and discover jobs built around your expertise. </p> -->
    </div>
    <div class="skills__rows">
        @php
            $skills = collect($getSkills)->map(function ($s) {
                $name = is_string($s) ? $s : data_get($s, 'name');
                if (!$name) return null;

                return [
                    'name' => $name,
                    'slug' => (is_string($s) ? null : data_get($s, 'slug')) ?: \Illuminate\Support\Str::slug($name),
                ];
            })
            ->filter()
            ->unique('slug')
            ->values();

            $rows = [
                ['reverse' => false, 'multiplier' => 1.0],
                ['reverse' => true,  'multiplier' => 1.2],
                ['reverse' => false, 'multiplier' => 1.1],
            ];

            $minPerRow = 10;
            $pxPerSecond = 40;
        @endphp

        @if ($skills->isNotEmpty())
            @foreach ($rows as $row)
                @php
                    $items = $skills->shuffle();
                    while ($items->count() < $minPerRow) {
                        $items = $items->concat($skills->shuffle());
                    }

                    $duration = max(30, (int) round(($items->count() * 190) / $pxPerSecond));
                @endphp

                <div class="marquee {{ $row['reverse'] ? 'marquee--reverse' : '' }}" style="--speed:{{ $duration }}s">
                    <div class="marquee__track">
                        <div class="marquee__set">
                            @foreach ($items as $skill)
                                <a class="pill" href="{{ route('jobseekers.find.work', ['slug' => $skill['slug']]) }}" data-skill="{{ $skill['name'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M6.14582 13.9842L7.18748 12.6825L3.83415 10L7.18748 7.31753L6.14582 6.01586L1.97915 9.34919C1.88152 9.42726 1.80271 9.52629 1.74854 9.63896C1.69438 9.75162 1.66626 9.87502 1.66626 10C1.66626 10.125 1.69438 10.2484 1.74854 10.3611C1.80271 10.4738 1.88152 10.5728 1.97915 10.6509L6.14582 13.9842ZM13.8542 6.01586L12.8125 7.31753L16.1658 10L12.8125 12.6825L13.8542 13.9842L18.0208 10.6509C18.1184 10.5728 18.1973 10.4738 18.2514 10.3611C18.3056 10.2484 18.3337 10.125 18.3337 10C18.3337 9.87502 18.3056 9.75162 18.2514 9.63896C18.1973 9.52629 18.1184 9.42726 18.0208 9.34919L13.8542 6.01586ZM12.48 2.68003L9.14665 17.68L7.51915 17.3184L10.8525 2.31836L12.48 2.68003Z" fill="#00A148"/>
                                    </svg>
                                    {{ $skill['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>


<!-- Start Why Choose Lanxers -->
<section class="interfree">
    <div class="container-fluid">
        <div class="row">
        <div class="opp-card--intro">
                        <!-- <div class="opp-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10.0837 15.4583L10.0003 15.5417L9.90866 15.4583C5.95033 11.8667 3.33366 9.49167 3.33366 7.08333C3.33366 5.41667 4.58366 4.16667 6.25033 4.16667C7.53366 4.16667 8.78366 5 9.22533 6.13333H10.7753C11.217 5 12.467 4.16667 13.7503 4.16667C15.417 4.16667 16.667 5.41667 16.667 7.08333C16.667 9.49167 14.0503 11.8667 10.0837 15.4583ZM13.7503 2.5C12.3003 2.5 10.9087 3.175 10.0003 4.23333C9.09199 3.175 7.70033 2.5 6.25033 2.5C3.68366 2.5 1.66699 4.50833 1.66699 7.08333C1.66699 10.225 4.50033 12.8 8.79199 16.6917L10.0003 17.7917L11.2087 16.6917C15.5003 12.8 18.3337 10.225 18.3337 7.08333C18.3337 4.50833 16.317 2.5 13.7503 2.5Z" fill="#00A148"/>
                            </svg>
                            <span>Opportunities for every Stage</span>
                        </div> -->
        
                        <h2 class="opp-title">
                            Jobs, Internships and Freelance projects <span>All in one place</span>
                        </h2>
        
                        <p class="opp-desc">
                            Gain experience through internships, work independently through freelance projects, or grow with a full-time role. Find them all on Lanxers.
                        </p>
        
                        <a href="{{ route('jobseekers.find.work') }}" class="opp-btn">
                            Explore All 
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                                <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>

            <div class="swiper oppSwiper">
                <div class="swiper-wrapper">
                    <!-- Slide 2 -->
                    <div class="swiper-slide opp-card opp-card--img" style="background-image: url('https://idpdefault.s3.ap-south-1.amazonaws.com/6acdcc7e5b602.jpg');">
                        <div class="opp-card__body">
                            <h3 class="opp-card__title">Jobs</h3>
                            <p class="opp-card__text">Find job roles that match your skills, experience, and career goals.
                            </p>
                        </div>
                    </div>
            
                    <!-- Slide 3 -->
                    <div class="swiper-slide opp-card opp-card--img" style="background-image: url('https://idpdefault.s3.ap-south-1.amazonaws.com/6acdcca9d6ee7.jpg');">
                        <div class="opp-card__body">
                            <h3 class="opp-card__title">Internship</h3>
                            <p class="opp-card__text">Get hands-on experience, build your skills, and take your first step into the industry.</p>
                        </div>
                    </div>
            
                    <!-- Slide 4 -->
                    <div class="swiper-slide opp-card opp-card--img" style="background-image: url('https://idpdefault.s3.ap-south-1.amazonaws.com/6acdcce7057bd.jpg');">
                        <div class="opp-card__body">
                            <h3 class="opp-card__title">Freelance</h3>
                            <p class="opp-card__text">Work on real projects, build your portfolio, and earn on your own terms.</p>
                        </div>
                    </div>
            
                </div>
                <div class="swiper-pagination"></div>

            </div>

        </div>
    </div>
</section>
<!-- End Why Choose Lanxers -->


<!-- Start Why Choose Lanxers -->
<section class="whychoose-lanxers">
        <img class="leftimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6a9e5b1a397c4.jpg" alt="">
        <img class="rightimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6a9e5ac5293a9.jpg" alt="">
        <div class="container-fluid">
                <div class="pills">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                        <g clip-path="url(#clip0_3601_11317)">
                            <path d="M4.17773 8.24744V4.75229C4.17782 4.59407 4.21833 4.4385 4.29543 4.30033C4.37252 4.16217 4.48364 4.04599 4.61824 3.96283C4.75285 3.87967 4.90647 3.83228 5.06453 3.82516C5.22259 3.81804 5.37984 3.85143 5.52138 3.92215L9.01652 5.66972C9.17055 5.74692 9.30007 5.86546 9.39058 6.01206C9.48109 6.15867 9.52903 6.32757 9.52903 6.49987C9.52903 6.67216 9.48109 6.84106 9.39058 6.98767C9.30007 7.13428 9.17055 7.25281 9.01652 7.33001L5.52138 9.07758C5.37984 9.1483 5.22259 9.18169 5.06453 9.17457C4.90647 9.16745 4.75285 9.12007 4.61824 9.0369C4.48364 8.95374 4.37252 8.83757 4.29543 8.6994C4.21833 8.56123 4.17782 8.40566 4.17773 8.24744Z" fill="#00A148" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.51215 0.0786955C7.32966 0.0501279 7.1433 0.0952233 6.99406 0.204061C6.84482 0.3129 6.74493 0.476565 6.71636 0.659053C6.68779 0.841541 6.73289 1.0279 6.84173 1.17714C6.95056 1.32638 7.11423 1.42627 7.29672 1.45484C8.56353 1.65883 9.70719 2.33203 10.5004 3.34062C11.2936 4.34922 11.6782 5.61935 11.5778 6.89854C11.4775 8.17774 10.8994 9.37232 9.95861 10.2448C9.0178 11.1174 7.78312 11.6039 6.5 11.6078C5.47592 11.6083 4.47535 11.3008 3.62821 10.7254C2.78107 10.15 2.12648 9.3332 1.74943 8.38105C1.67771 8.21481 1.54406 8.08303 1.37683 8.01366C1.20959 7.94428 1.02191 7.94276 0.853572 8.00942C0.685234 8.07608 0.549473 8.20568 0.475069 8.37074C0.400665 8.5358 0.393467 8.72335 0.455002 8.89362C1.01286 10.299 2.04305 11.4659 3.36835 12.1938C4.69365 12.9216 6.23117 13.1648 7.7164 12.8815C9.20162 12.5982 10.5417 11.8061 11.506 10.6415C12.4703 9.47694 12.9986 8.0127 13 6.5007C13.0003 4.95199 12.4476 3.45406 11.4415 2.27668C10.4354 1.09931 9.04196 0.319851 7.51215 0.0786955ZM5.22229 1.46227C5.39301 1.40928 5.53683 1.29267 5.62396 1.13658C5.71108 0.980494 5.73486 0.796879 5.69035 0.623748C5.64585 0.450617 5.53647 0.301229 5.38487 0.20651C5.23327 0.111791 5.05105 0.0789946 4.87593 0.11491C4.57909 0.19144 4.28803 0.288873 4.00493 0.406481C3.92049 0.4416 3.84379 0.493008 3.77921 0.55777C3.71463 0.622531 3.66344 0.699378 3.62856 0.783923C3.55812 0.954668 3.5584 1.1464 3.62932 1.31695C3.66444 1.40139 3.71585 1.47809 3.78061 1.54267C3.84537 1.60724 3.92222 1.65843 4.00676 1.69331C4.17751 1.76375 4.36924 1.76348 4.53979 1.69255C4.76017 1.60093 4.98767 1.52479 5.22229 1.46412M2.94357 2.74462C3.06929 2.61461 3.1395 2.44078 3.13935 2.25992C3.13919 2.07906 3.06869 1.90536 2.94275 1.77556C2.8168 1.64575 2.64531 1.57004 2.46453 1.56442C2.28376 1.55881 2.1079 1.62374 1.97414 1.74548C1.53368 2.17176 1.15572 2.65819 0.851502 3.19034C0.80614 3.26978 0.776869 3.35739 0.765362 3.44814C0.753855 3.5389 0.760337 3.63103 0.784437 3.71929C0.808537 3.80754 0.849784 3.89018 0.905822 3.96249C0.96186 4.0348 1.03159 4.09537 1.11104 4.14073C1.19048 4.18609 1.27808 4.21536 1.36884 4.22687C1.4596 4.23838 1.55173 4.2319 1.63999 4.2078C1.72824 4.1837 1.81088 4.14245 1.88319 4.08641C1.9555 4.03037 2.01607 3.96064 2.06143 3.8812C2.301 3.46148 2.59815 3.07891 2.94357 2.74462ZM1.443 5.69005C1.45753 5.59873 1.45373 5.50543 1.43182 5.41559C1.40991 5.32575 1.37033 5.24118 1.31538 5.1668C1.26044 5.09242 1.19123 5.02973 1.1118 4.98239C1.03237 4.93504 0.944302 4.90399 0.852741 4.89104C0.761181 4.87809 0.667959 4.88351 0.578514 4.90697C0.489069 4.93044 0.405192 4.97148 0.331778 5.0277C0.258363 5.08393 0.196881 5.15421 0.150919 5.23445C0.104956 5.31469 0.0754336 5.40328 0.0640735 5.49505C0.0211694 5.79835 -0.000241101 6.1043 2.04777e-06 6.41062C2.04777e-06 6.59533 0.0733756 6.77247 0.203981 6.90307C0.334587 7.03368 0.511726 7.10705 0.696431 7.10705C0.881135 7.10705 1.05827 7.03368 1.18888 6.90307C1.31949 6.77247 1.39286 6.59533 1.39286 6.41062C1.39286 6.16548 1.40957 5.92529 1.443 5.69005Z" fill="#00A148" />
                        </g>
                        <defs>
                            <clipPath id="clip0_3601_11317">
                                <rect width="13" height="13" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>Why thousands Choose Lanxers ?</span>
                </div>

                <div class="heading">
                    <h1>What You Get As a <span>Talent</span></h1>
                    <p>Make better hiring decisions with access to experienced professionals and role-specific talent. </p>
                </div>

                <div class="boxgrid">

                    <div class="card card-w1">
                        <div class="card-content">
                            <div class="icon-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                    <path d="M28.7316 5.95933C28.7998 6.12374 28.8178 6.3047 28.7832 6.47932C28.7486 6.65394 28.663 6.81437 28.5372 6.94033L24.9372 10.5403C24.8535 10.6239 24.7541 10.6901 24.6448 10.7351C24.5354 10.7802 24.4183 10.8033 24.3 10.8031H19.2726L16.8372 13.2385C17.1117 13.8133 17.1742 14.4665 17.0137 15.0829C16.8531 15.6993 16.4798 16.239 15.9598 16.6068C15.4397 16.9745 14.8064 17.1466 14.1718 17.0925C13.5372 17.0385 12.9421 16.7618 12.4917 16.3115C12.0413 15.8611 11.7646 15.266 11.7106 14.6313C11.6566 13.9967 11.8286 13.3634 12.1964 12.8434C12.5641 12.3233 13.1039 11.95 13.7202 11.7895C14.3366 11.6289 14.9899 11.6914 15.5646 11.9659L18 9.53053V4.50313C17.9998 4.38486 18.0229 4.26771 18.068 4.15838C18.1131 4.04904 18.1793 3.94967 18.2628 3.86593L21.8628 0.265931C21.9887 0.139739 22.1492 0.0537629 22.324 0.0189026C22.4988 -0.0159576 22.68 0.00186798 22.8446 0.0701195C23.0093 0.138371 23.15 0.253975 23.2488 0.402275C23.3477 0.550576 23.4003 0.724894 23.4 0.903131V5.40313H27.9C28.0781 5.40316 28.2522 5.45603 28.4002 5.55503C28.5482 5.65404 28.6636 5.79475 28.7316 5.95933ZM25.7274 7.20313H22.5C22.2613 7.20313 22.0324 7.10831 21.8636 6.93953C21.6948 6.77074 21.6 6.54183 21.6 6.30313V3.07573L19.8 4.87573V9.00313H23.9274L25.7274 7.20313ZM28.0926 9.93013C28.5516 11.3377 28.8 12.8425 28.8 14.4031C28.7993 17.445 27.8354 20.4086 26.0464 22.8688C24.2575 25.329 21.7354 27.1595 18.8418 28.0978C15.9483 29.0361 12.8319 29.034 9.93961 28.0918C7.04733 27.1496 4.52771 25.3156 2.74208 22.853C0.956455 20.3903 -0.00345398 17.4255 9.33876e-06 14.3836C0.00347266 11.3417 0.970131 8.37906 2.76136 5.92049C4.55259 3.46192 7.07638 1.63373 9.9708 0.698096C12.8652 -0.237538 15.9816 -0.232555 18.873 0.712331L17.4186 2.16673C14.7467 1.50792 11.9325 1.74199 9.40613 2.83318C6.87975 3.92437 4.78009 5.81266 3.42796 8.20954C2.07583 10.6064 1.54559 13.3801 1.91827 16.1067C2.29095 18.8333 3.54604 21.3629 5.49178 23.309C7.43752 25.2551 9.9669 26.5107 12.6934 26.8839C15.42 27.2571 18.1937 26.7275 20.5909 25.3758C22.988 24.0241 24.8767 21.9248 25.9684 19.3987C27.0601 16.8725 27.2947 14.0584 26.6364 11.3863L28.0926 9.93013ZM23.22 12.6031C23.34 13.1863 23.4 13.7863 23.4 14.4031C23.3996 16.2603 22.8247 18.0719 21.7541 19.5895C20.6835 21.107 19.1696 22.2562 17.4201 22.8794C15.6706 23.5027 13.7711 23.5694 11.9822 23.0704C10.1933 22.5715 8.6025 21.5314 7.42805 20.0927C6.2536 18.654 5.55299 16.8872 5.42231 15.0346C5.29162 13.182 5.73727 11.3343 6.69811 9.74501C7.65896 8.15569 9.08796 6.90253 10.7891 6.15741C12.4903 5.41229 14.3803 5.21169 16.2 5.58313V7.42993C14.6708 7.03545 13.0544 7.15465 11.5997 7.76918C10.1449 8.38371 8.93257 9.45949 8.14935 10.8308C7.36613 12.2021 7.05548 13.7929 7.26526 15.3581C7.47504 16.9233 8.19361 18.3762 9.31028 19.4928C10.427 20.6095 11.8798 21.3281 13.445 21.5379C15.0102 21.7476 16.601 21.437 17.9723 20.6538C19.3436 19.8706 20.4194 18.6582 21.0339 17.2035C21.6485 15.7487 21.7677 14.1323 21.3732 12.6031H23.22Z" fill="white"/>
                                </svg>
                            </div>
                            <h3>Professional profile</h3>
                            <p>Present your skills, experience, education, and work through one professional profile</p>
                        </div>
                        <span class="illustration1">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab2047a1fe30.jpg" alt="">
                        </span>
                    </div>

                    <div class="card card-w2">
                        <div class="card-content w1">
                            <div class="icon-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                    <path d="M28.7316 5.95933C28.7998 6.12374 28.8178 6.3047 28.7832 6.47932C28.7486 6.65394 28.663 6.81437 28.5372 6.94033L24.9372 10.5403C24.8535 10.6239 24.7541 10.6901 24.6448 10.7351C24.5354 10.7802 24.4183 10.8033 24.3 10.8031H19.2726L16.8372 13.2385C17.1117 13.8133 17.1742 14.4665 17.0137 15.0829C16.8531 15.6993 16.4798 16.239 15.9598 16.6068C15.4397 16.9745 14.8064 17.1466 14.1718 17.0925C13.5372 17.0385 12.9421 16.7618 12.4917 16.3115C12.0413 15.8611 11.7646 15.266 11.7106 14.6313C11.6566 13.9967 11.8286 13.3634 12.1964 12.8434C12.5641 12.3233 13.1039 11.95 13.7202 11.7895C14.3366 11.6289 14.9899 11.6914 15.5646 11.9659L18 9.53053V4.50313C17.9998 4.38486 18.0229 4.26771 18.068 4.15838C18.1131 4.04904 18.1793 3.94967 18.2628 3.86593L21.8628 0.265931C21.9887 0.139739 22.1492 0.0537629 22.324 0.0189026C22.4988 -0.0159576 22.68 0.00186798 22.8446 0.0701195C23.0093 0.138371 23.15 0.253975 23.2488 0.402275C23.3477 0.550576 23.4003 0.724894 23.4 0.903131V5.40313H27.9C28.0781 5.40316 28.2522 5.45603 28.4002 5.55503C28.5482 5.65404 28.6636 5.79475 28.7316 5.95933ZM25.7274 7.20313H22.5C22.2613 7.20313 22.0324 7.10831 21.8636 6.93953C21.6948 6.77074 21.6 6.54183 21.6 6.30313V3.07573L19.8 4.87573V9.00313H23.9274L25.7274 7.20313ZM28.0926 9.93013C28.5516 11.3377 28.8 12.8425 28.8 14.4031C28.7993 17.445 27.8354 20.4086 26.0464 22.8688C24.2575 25.329 21.7354 27.1595 18.8418 28.0978C15.9483 29.0361 12.8319 29.034 9.93961 28.0918C7.04733 27.1496 4.52771 25.3156 2.74208 22.853C0.956455 20.3903 -0.00345398 17.4255 9.33876e-06 14.3836C0.00347266 11.3417 0.970131 8.37906 2.76136 5.92049C4.55259 3.46192 7.07638 1.63373 9.9708 0.698096C12.8652 -0.237538 15.9816 -0.232555 18.873 0.712331L17.4186 2.16673C14.7467 1.50792 11.9325 1.74199 9.40613 2.83318C6.87975 3.92437 4.78009 5.81266 3.42796 8.20954C2.07583 10.6064 1.54559 13.3801 1.91827 16.1067C2.29095 18.8333 3.54604 21.3629 5.49178 23.309C7.43752 25.2551 9.9669 26.5107 12.6934 26.8839C15.42 27.2571 18.1937 26.7275 20.5909 25.3758C22.988 24.0241 24.8767 21.9248 25.9684 19.3987C27.0601 16.8725 27.2947 14.0584 26.6364 11.3863L28.0926 9.93013ZM23.22 12.6031C23.34 13.1863 23.4 13.7863 23.4 14.4031C23.3996 16.2603 22.8247 18.0719 21.7541 19.5895C20.6835 21.107 19.1696 22.2562 17.4201 22.8794C15.6706 23.5027 13.7711 23.5694 11.9822 23.0704C10.1933 22.5715 8.6025 21.5314 7.42805 20.0927C6.2536 18.654 5.55299 16.8872 5.42231 15.0346C5.29162 13.182 5.73727 11.3343 6.69811 9.74501C7.65896 8.15569 9.08796 6.90253 10.7891 6.15741C12.4903 5.41229 14.3803 5.21169 16.2 5.58313V7.42993C14.6708 7.03545 13.0544 7.15465 11.5997 7.76918C10.1449 8.38371 8.93257 9.45949 8.14935 10.8308C7.36613 12.2021 7.05548 13.7929 7.26526 15.3581C7.47504 16.9233 8.19361 18.3762 9.31028 19.4928C10.427 20.6095 11.8798 21.3281 13.445 21.5379C15.0102 21.7476 16.601 21.437 17.9723 20.6538C19.3436 19.8706 20.4194 18.6582 21.0339 17.2035C21.6485 15.7487 21.7677 14.1323 21.3732 12.6031H23.22Z" fill="white"/>
                                </svg>
                            </div>
                            <h3>Relevant opportunities</h3>
                            <p>Explore opportunities that match your skills and interests</p>
                        </div>
                        <span class="illustration">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab2049b71cd7.jpg" alt="">
                        </span>
                    </div>

                    <div class="card card-w3">
                        <div class="card-content w1">
                            <div class="icon-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                    <path d="M28.7316 5.95933C28.7998 6.12374 28.8178 6.3047 28.7832 6.47932C28.7486 6.65394 28.663 6.81437 28.5372 6.94033L24.9372 10.5403C24.8535 10.6239 24.7541 10.6901 24.6448 10.7351C24.5354 10.7802 24.4183 10.8033 24.3 10.8031H19.2726L16.8372 13.2385C17.1117 13.8133 17.1742 14.4665 17.0137 15.0829C16.8531 15.6993 16.4798 16.239 15.9598 16.6068C15.4397 16.9745 14.8064 17.1466 14.1718 17.0925C13.5372 17.0385 12.9421 16.7618 12.4917 16.3115C12.0413 15.8611 11.7646 15.266 11.7106 14.6313C11.6566 13.9967 11.8286 13.3634 12.1964 12.8434C12.5641 12.3233 13.1039 11.95 13.7202 11.7895C14.3366 11.6289 14.9899 11.6914 15.5646 11.9659L18 9.53053V4.50313C17.9998 4.38486 18.0229 4.26771 18.068 4.15838C18.1131 4.04904 18.1793 3.94967 18.2628 3.86593L21.8628 0.265931C21.9887 0.139739 22.1492 0.0537629 22.324 0.0189026C22.4988 -0.0159576 22.68 0.00186798 22.8446 0.0701195C23.0093 0.138371 23.15 0.253975 23.2488 0.402275C23.3477 0.550576 23.4003 0.724894 23.4 0.903131V5.40313H27.9C28.0781 5.40316 28.2522 5.45603 28.4002 5.55503C28.5482 5.65404 28.6636 5.79475 28.7316 5.95933ZM25.7274 7.20313H22.5C22.2613 7.20313 22.0324 7.10831 21.8636 6.93953C21.6948 6.77074 21.6 6.54183 21.6 6.30313V3.07573L19.8 4.87573V9.00313H23.9274L25.7274 7.20313ZM28.0926 9.93013C28.5516 11.3377 28.8 12.8425 28.8 14.4031C28.7993 17.445 27.8354 20.4086 26.0464 22.8688C24.2575 25.329 21.7354 27.1595 18.8418 28.0978C15.9483 29.0361 12.8319 29.034 9.93961 28.0918C7.04733 27.1496 4.52771 25.3156 2.74208 22.853C0.956455 20.3903 -0.00345398 17.4255 9.33876e-06 14.3836C0.00347266 11.3417 0.970131 8.37906 2.76136 5.92049C4.55259 3.46192 7.07638 1.63373 9.9708 0.698096C12.8652 -0.237538 15.9816 -0.232555 18.873 0.712331L17.4186 2.16673C14.7467 1.50792 11.9325 1.74199 9.40613 2.83318C6.87975 3.92437 4.78009 5.81266 3.42796 8.20954C2.07583 10.6064 1.54559 13.3801 1.91827 16.1067C2.29095 18.8333 3.54604 21.3629 5.49178 23.309C7.43752 25.2551 9.9669 26.5107 12.6934 26.8839C15.42 27.2571 18.1937 26.7275 20.5909 25.3758C22.988 24.0241 24.8767 21.9248 25.9684 19.3987C27.0601 16.8725 27.2947 14.0584 26.6364 11.3863L28.0926 9.93013ZM23.22 12.6031C23.34 13.1863 23.4 13.7863 23.4 14.4031C23.3996 16.2603 22.8247 18.0719 21.7541 19.5895C20.6835 21.107 19.1696 22.2562 17.4201 22.8794C15.6706 23.5027 13.7711 23.5694 11.9822 23.0704C10.1933 22.5715 8.6025 21.5314 7.42805 20.0927C6.2536 18.654 5.55299 16.8872 5.42231 15.0346C5.29162 13.182 5.73727 11.3343 6.69811 9.74501C7.65896 8.15569 9.08796 6.90253 10.7891 6.15741C12.4903 5.41229 14.3803 5.21169 16.2 5.58313V7.42993C14.6708 7.03545 13.0544 7.15465 11.5997 7.76918C10.1449 8.38371 8.93257 9.45949 8.14935 10.8308C7.36613 12.2021 7.05548 13.7929 7.26526 15.3581C7.47504 16.9233 8.19361 18.3762 9.31028 19.4928C10.427 20.6095 11.8798 21.3281 13.445 21.5379C15.0102 21.7476 16.601 21.437 17.9723 20.6538C19.3436 19.8706 20.4194 18.6582 21.0339 17.2035C21.6485 15.7487 21.7677 14.1323 21.3732 12.6031H23.22Z" fill="white"/>
                                </svg>
                            </div>
                            <h3>Direct employer connection</h3>
                            <p>Connect with employers directly through the opportunities you apply for</p>
                        </div>
                        <span class="illustration">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab204af2bb1d.jpg" alt="">
                        </span>
                    </div>

                </div>    

                <div class="boxgrid">    

                    <div class="card card-w3">
                        <div class="card-content w1">
                            <div class="icon-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                    <path d="M28.7316 5.95933C28.7998 6.12374 28.8178 6.3047 28.7832 6.47932C28.7486 6.65394 28.663 6.81437 28.5372 6.94033L24.9372 10.5403C24.8535 10.6239 24.7541 10.6901 24.6448 10.7351C24.5354 10.7802 24.4183 10.8033 24.3 10.8031H19.2726L16.8372 13.2385C17.1117 13.8133 17.1742 14.4665 17.0137 15.0829C16.8531 15.6993 16.4798 16.239 15.9598 16.6068C15.4397 16.9745 14.8064 17.1466 14.1718 17.0925C13.5372 17.0385 12.9421 16.7618 12.4917 16.3115C12.0413 15.8611 11.7646 15.266 11.7106 14.6313C11.6566 13.9967 11.8286 13.3634 12.1964 12.8434C12.5641 12.3233 13.1039 11.95 13.7202 11.7895C14.3366 11.6289 14.9899 11.6914 15.5646 11.9659L18 9.53053V4.50313C17.9998 4.38486 18.0229 4.26771 18.068 4.15838C18.1131 4.04904 18.1793 3.94967 18.2628 3.86593L21.8628 0.265931C21.9887 0.139739 22.1492 0.0537629 22.324 0.0189026C22.4988 -0.0159576 22.68 0.00186798 22.8446 0.0701195C23.0093 0.138371 23.15 0.253975 23.2488 0.402275C23.3477 0.550576 23.4003 0.724894 23.4 0.903131V5.40313H27.9C28.0781 5.40316 28.2522 5.45603 28.4002 5.55503C28.5482 5.65404 28.6636 5.79475 28.7316 5.95933ZM25.7274 7.20313H22.5C22.2613 7.20313 22.0324 7.10831 21.8636 6.93953C21.6948 6.77074 21.6 6.54183 21.6 6.30313V3.07573L19.8 4.87573V9.00313H23.9274L25.7274 7.20313ZM28.0926 9.93013C28.5516 11.3377 28.8 12.8425 28.8 14.4031C28.7993 17.445 27.8354 20.4086 26.0464 22.8688C24.2575 25.329 21.7354 27.1595 18.8418 28.0978C15.9483 29.0361 12.8319 29.034 9.93961 28.0918C7.04733 27.1496 4.52771 25.3156 2.74208 22.853C0.956455 20.3903 -0.00345398 17.4255 9.33876e-06 14.3836C0.00347266 11.3417 0.970131 8.37906 2.76136 5.92049C4.55259 3.46192 7.07638 1.63373 9.9708 0.698096C12.8652 -0.237538 15.9816 -0.232555 18.873 0.712331L17.4186 2.16673C14.7467 1.50792 11.9325 1.74199 9.40613 2.83318C6.87975 3.92437 4.78009 5.81266 3.42796 8.20954C2.07583 10.6064 1.54559 13.3801 1.91827 16.1067C2.29095 18.8333 3.54604 21.3629 5.49178 23.309C7.43752 25.2551 9.9669 26.5107 12.6934 26.8839C15.42 27.2571 18.1937 26.7275 20.5909 25.3758C22.988 24.0241 24.8767 21.9248 25.9684 19.3987C27.0601 16.8725 27.2947 14.0584 26.6364 11.3863L28.0926 9.93013ZM23.22 12.6031C23.34 13.1863 23.4 13.7863 23.4 14.4031C23.3996 16.2603 22.8247 18.0719 21.7541 19.5895C20.6835 21.107 19.1696 22.2562 17.4201 22.8794C15.6706 23.5027 13.7711 23.5694 11.9822 23.0704C10.1933 22.5715 8.6025 21.5314 7.42805 20.0927C6.2536 18.654 5.55299 16.8872 5.42231 15.0346C5.29162 13.182 5.73727 11.3343 6.69811 9.74501C7.65896 8.15569 9.08796 6.90253 10.7891 6.15741C12.4903 5.41229 14.3803 5.21169 16.2 5.58313V7.42993C14.6708 7.03545 13.0544 7.15465 11.5997 7.76918C10.1449 8.38371 8.93257 9.45949 8.14935 10.8308C7.36613 12.2021 7.05548 13.7929 7.26526 15.3581C7.47504 16.9233 8.19361 18.3762 9.31028 19.4928C10.427 20.6095 11.8798 21.3281 13.445 21.5379C15.0102 21.7476 16.601 21.437 17.9723 20.6538C19.3436 19.8706 20.4194 18.6582 21.0339 17.2035C21.6485 15.7487 21.7677 14.1323 21.3732 12.6031H23.22Z" fill="white"/>
                                </svg>
                            </div>
                            <h3>Build practical experience</h3>
                            <p>Gain valuable experience and work on real projects</p>
                        </div>
                        <span class="illustration">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab204c6952f4.jpg" alt="">
                        </span>
                    </div>

                    <div class="card card-w2 card-extra">
                        <div class="card-content w1">
                            <div class="icon-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                    <path d="M28.7316 5.95933C28.7998 6.12374 28.8178 6.3047 28.7832 6.47932C28.7486 6.65394 28.663 6.81437 28.5372 6.94033L24.9372 10.5403C24.8535 10.6239 24.7541 10.6901 24.6448 10.7351C24.5354 10.7802 24.4183 10.8033 24.3 10.8031H19.2726L16.8372 13.2385C17.1117 13.8133 17.1742 14.4665 17.0137 15.0829C16.8531 15.6993 16.4798 16.239 15.9598 16.6068C15.4397 16.9745 14.8064 17.1466 14.1718 17.0925C13.5372 17.0385 12.9421 16.7618 12.4917 16.3115C12.0413 15.8611 11.7646 15.266 11.7106 14.6313C11.6566 13.9967 11.8286 13.3634 12.1964 12.8434C12.5641 12.3233 13.1039 11.95 13.7202 11.7895C14.3366 11.6289 14.9899 11.6914 15.5646 11.9659L18 9.53053V4.50313C17.9998 4.38486 18.0229 4.26771 18.068 4.15838C18.1131 4.04904 18.1793 3.94967 18.2628 3.86593L21.8628 0.265931C21.9887 0.139739 22.1492 0.0537629 22.324 0.0189026C22.4988 -0.0159576 22.68 0.00186798 22.8446 0.0701195C23.0093 0.138371 23.15 0.253975 23.2488 0.402275C23.3477 0.550576 23.4003 0.724894 23.4 0.903131V5.40313H27.9C28.0781 5.40316 28.2522 5.45603 28.4002 5.55503C28.5482 5.65404 28.6636 5.79475 28.7316 5.95933ZM25.7274 7.20313H22.5C22.2613 7.20313 22.0324 7.10831 21.8636 6.93953C21.6948 6.77074 21.6 6.54183 21.6 6.30313V3.07573L19.8 4.87573V9.00313H23.9274L25.7274 7.20313ZM28.0926 9.93013C28.5516 11.3377 28.8 12.8425 28.8 14.4031C28.7993 17.445 27.8354 20.4086 26.0464 22.8688C24.2575 25.329 21.7354 27.1595 18.8418 28.0978C15.9483 29.0361 12.8319 29.034 9.93961 28.0918C7.04733 27.1496 4.52771 25.3156 2.74208 22.853C0.956455 20.3903 -0.00345398 17.4255 9.33876e-06 14.3836C0.00347266 11.3417 0.970131 8.37906 2.76136 5.92049C4.55259 3.46192 7.07638 1.63373 9.9708 0.698096C12.8652 -0.237538 15.9816 -0.232555 18.873 0.712331L17.4186 2.16673C14.7467 1.50792 11.9325 1.74199 9.40613 2.83318C6.87975 3.92437 4.78009 5.81266 3.42796 8.20954C2.07583 10.6064 1.54559 13.3801 1.91827 16.1067C2.29095 18.8333 3.54604 21.3629 5.49178 23.309C7.43752 25.2551 9.9669 26.5107 12.6934 26.8839C15.42 27.2571 18.1937 26.7275 20.5909 25.3758C22.988 24.0241 24.8767 21.9248 25.9684 19.3987C27.0601 16.8725 27.2947 14.0584 26.6364 11.3863L28.0926 9.93013ZM23.22 12.6031C23.34 13.1863 23.4 13.7863 23.4 14.4031C23.3996 16.2603 22.8247 18.0719 21.7541 19.5895C20.6835 21.107 19.1696 22.2562 17.4201 22.8794C15.6706 23.5027 13.7711 23.5694 11.9822 23.0704C10.1933 22.5715 8.6025 21.5314 7.42805 20.0927C6.2536 18.654 5.55299 16.8872 5.42231 15.0346C5.29162 13.182 5.73727 11.3343 6.69811 9.74501C7.65896 8.15569 9.08796 6.90253 10.7891 6.15741C12.4903 5.41229 14.3803 5.21169 16.2 5.58313V7.42993C14.6708 7.03545 13.0544 7.15465 11.5997 7.76918C10.1449 8.38371 8.93257 9.45949 8.14935 10.8308C7.36613 12.2021 7.05548 13.7929 7.26526 15.3581C7.47504 16.9233 8.19361 18.3762 9.31028 19.4928C10.427 20.6095 11.8798 21.3281 13.445 21.5379C15.0102 21.7476 16.601 21.437 17.9723 20.6538C19.3436 19.8706 20.4194 18.6582 21.0339 17.2035C21.6485 15.7487 21.7677 14.1323 21.3732 12.6031H23.22Z" fill="white"/>
                                </svg>
                            </div>
                            <h3>Easy application process</h3>
                            <p>Apply to opportunities through a simple, straightforward process</p>
                        </div>
                        <span class="illustration">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab204d4e452c.jpg" alt="">
                        </span>
                    </div>

                    <div class="card card-w1 card-extra">
                        <div class="card-content">
                            <div class="icon-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                    <path d="M28.7316 5.95933C28.7998 6.12374 28.8178 6.3047 28.7832 6.47932C28.7486 6.65394 28.663 6.81437 28.5372 6.94033L24.9372 10.5403C24.8535 10.6239 24.7541 10.6901 24.6448 10.7351C24.5354 10.7802 24.4183 10.8033 24.3 10.8031H19.2726L16.8372 13.2385C17.1117 13.8133 17.1742 14.4665 17.0137 15.0829C16.8531 15.6993 16.4798 16.239 15.9598 16.6068C15.4397 16.9745 14.8064 17.1466 14.1718 17.0925C13.5372 17.0385 12.9421 16.7618 12.4917 16.3115C12.0413 15.8611 11.7646 15.266 11.7106 14.6313C11.6566 13.9967 11.8286 13.3634 12.1964 12.8434C12.5641 12.3233 13.1039 11.95 13.7202 11.7895C14.3366 11.6289 14.9899 11.6914 15.5646 11.9659L18 9.53053V4.50313C17.9998 4.38486 18.0229 4.26771 18.068 4.15838C18.1131 4.04904 18.1793 3.94967 18.2628 3.86593L21.8628 0.265931C21.9887 0.139739 22.1492 0.0537629 22.324 0.0189026C22.4988 -0.0159576 22.68 0.00186798 22.8446 0.0701195C23.0093 0.138371 23.15 0.253975 23.2488 0.402275C23.3477 0.550576 23.4003 0.724894 23.4 0.903131V5.40313H27.9C28.0781 5.40316 28.2522 5.45603 28.4002 5.55503C28.5482 5.65404 28.6636 5.79475 28.7316 5.95933ZM25.7274 7.20313H22.5C22.2613 7.20313 22.0324 7.10831 21.8636 6.93953C21.6948 6.77074 21.6 6.54183 21.6 6.30313V3.07573L19.8 4.87573V9.00313H23.9274L25.7274 7.20313ZM28.0926 9.93013C28.5516 11.3377 28.8 12.8425 28.8 14.4031C28.7993 17.445 27.8354 20.4086 26.0464 22.8688C24.2575 25.329 21.7354 27.1595 18.8418 28.0978C15.9483 29.0361 12.8319 29.034 9.93961 28.0918C7.04733 27.1496 4.52771 25.3156 2.74208 22.853C0.956455 20.3903 -0.00345398 17.4255 9.33876e-06 14.3836C0.00347266 11.3417 0.970131 8.37906 2.76136 5.92049C4.55259 3.46192 7.07638 1.63373 9.9708 0.698096C12.8652 -0.237538 15.9816 -0.232555 18.873 0.712331L17.4186 2.16673C14.7467 1.50792 11.9325 1.74199 9.40613 2.83318C6.87975 3.92437 4.78009 5.81266 3.42796 8.20954C2.07583 10.6064 1.54559 13.3801 1.91827 16.1067C2.29095 18.8333 3.54604 21.3629 5.49178 23.309C7.43752 25.2551 9.9669 26.5107 12.6934 26.8839C15.42 27.2571 18.1937 26.7275 20.5909 25.3758C22.988 24.0241 24.8767 21.9248 25.9684 19.3987C27.0601 16.8725 27.2947 14.0584 26.6364 11.3863L28.0926 9.93013ZM23.22 12.6031C23.34 13.1863 23.4 13.7863 23.4 14.4031C23.3996 16.2603 22.8247 18.0719 21.7541 19.5895C20.6835 21.107 19.1696 22.2562 17.4201 22.8794C15.6706 23.5027 13.7711 23.5694 11.9822 23.0704C10.1933 22.5715 8.6025 21.5314 7.42805 20.0927C6.2536 18.654 5.55299 16.8872 5.42231 15.0346C5.29162 13.182 5.73727 11.3343 6.69811 9.74501C7.65896 8.15569 9.08796 6.90253 10.7891 6.15741C12.4903 5.41229 14.3803 5.21169 16.2 5.58313V7.42993C14.6708 7.03545 13.0544 7.15465 11.5997 7.76918C10.1449 8.38371 8.93257 9.45949 8.14935 10.8308C7.36613 12.2021 7.05548 13.7929 7.26526 15.3581C7.47504 16.9233 8.19361 18.3762 9.31028 19.4928C10.427 20.6095 11.8798 21.3281 13.445 21.5379C15.0102 21.7476 16.601 21.437 17.9723 20.6538C19.3436 19.8706 20.4194 18.6582 21.0339 17.2035C21.6485 15.7487 21.7677 14.1323 21.3732 12.6031H23.22Z" fill="white"/>
                                </svg>
                            </div>
                            <h3>More ways to grow</h3>
                            <p>Take meaningful steps toward your career goals with opportunities that fit your ambitions</p>
                        </div>
                        <span class="illustration1">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab204e3a5f0b.jpg" alt="">
                        </span>
                    </div>

                </div>

                <button type="button" class="boxgrid-toggle">
                    <span>View more</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                        <path d="M7.75 0.75L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
        </div>
</section>
<!-- End Why Choose Lanxers -->



<!-- Start Your Job Card Section-->  
<section class="jobcardsection">
    <div class="container-fluid">
        <div class="pills">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10.0832 15.4583L9.99984 15.5417L9.90817 15.4583C5.94984 11.8667 3.33317 9.49167 3.33317 7.08333C3.33317 5.41667 4.58317 4.16667 6.24984 4.16667C7.53317 4.16667 8.78317 5 9.22484 6.13333H10.7748C11.2165 5 12.4665 4.16667 13.7498 4.16667C15.4165 4.16667 16.6665 5.41667 16.6665 7.08333C16.6665 9.49167 14.0498 11.8667 10.0832 15.4583ZM13.7498 2.5C12.2998 2.5 10.9082 3.175 9.99984 4.23333C9.0915 3.175 7.69984 2.5 6.24984 2.5C3.68317 2.5 1.6665 4.50833 1.6665 7.08333C1.6665 10.225 4.49984 12.8 8.7915 16.6917L9.99984 17.7917L11.2082 16.6917C15.4998 12.8 18.3332 10.225 18.3332 7.08333C18.3332 4.50833 16.3165 2.5 13.7498 2.5Z" fill="#00A148"/>
            </svg>
            <span>Opportunities for every career</span>
        </div>

        <div class="heading">
            <h1>Your Next Work <span>Could Be Here</span> </h1>
            <!-- <p>Whether you’re starting out, freelancing, or ready for your next career move, discover opportunities that match your skills and goals</p> -->
        </div>
    </div>

    @foreach ([1, 2] as $swiperNo)
        @php
            $rowJobs = $getActiveJob->shuffle();
            while ($rowJobs->isNotEmpty() && $rowJobs->count() < 8) {
                $rowJobs = $rowJobs->concat($getActiveJob->shuffle());
            }
        @endphp

        <div class="splide jobcardSwiper{{ $swiperNo }}" aria-label="Jobs">
            <div class="splide__track">
            <ul class="splide__list">
                @forelse ($rowJobs as $job)
                    @php
                        $typeLabel  = ucwords(str_replace(['_', '-'], ' ', $job->opportunity_type ?? ''));
                        $locLabel   = ucwords(str_replace(['_', '-'], ' ', $job->location_type ?? ''));
                        $jobUrl     = route('jobseekers.find.work') . '#job-' . $job->id;

                        $typeKey = strtolower(str_replace([' ', '-'], '_', $job->opportunity_type ?? ''));
                        $colorClass = match (true) {
                            str_contains($typeKey, 'intern')    => 'internship',
                            str_contains($typeKey, 'freelance') => 'freelance',
                            default                             => 'job',
                        };
                    @endphp

                    <li class="splide__slide">
                        <a href="{{ $jobUrl }}" class="job-card" id="job-{{ $job->id }}">
                            <div class="job-card__top">
                                <div class="company-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M8.10005 7.80039C8.33874 7.80039 8.56766 7.70557 8.73644 7.53679C8.90523 7.368 9.00005 7.13909 9.00005 6.90039C9.00005 6.6617 8.90523 6.43278 8.73644 6.26399C8.56766 6.09521 8.33874 6.00039 8.10005 6.00039C7.86135 6.00039 7.63244 6.09521 7.46365 6.26399C7.29487 6.43278 7.20005 6.6617 7.20005 6.90039C7.20005 7.13909 7.29487 7.368 7.46365 7.53679C7.63244 7.70557 7.86135 7.80039 8.10005 7.80039ZM9.00005 10.5004C9.00005 10.7391 8.90523 10.968 8.73644 11.1368C8.56766 11.3056 8.33874 11.4004 8.10005 11.4004C7.86135 11.4004 7.63244 11.3056 7.46365 11.1368C7.29487 10.968 7.20005 10.7391 7.20005 10.5004C7.20005 10.2617 7.29487 10.0328 7.46365 9.864C7.63244 9.69521 7.86135 9.60039 8.10005 9.60039C8.33874 9.60039 8.56766 9.69521 8.73644 9.864C8.90523 10.0328 9.00005 10.2617 9.00005 10.5004ZM8.10005 15.0004C8.21824 15.0004 8.33527 14.9771 8.44446 14.9319C8.55366 14.8867 8.65287 14.8204 8.73644 14.7368C8.82002 14.6532 8.88631 14.554 8.93154 14.4448C8.97677 14.3356 9.00005 14.2186 9.00005 14.1004C9.00005 13.9822 8.97677 13.8652 8.93154 13.756C8.88631 13.6468 8.82002 13.5476 8.73644 13.464C8.65287 13.3804 8.55366 13.3141 8.44446 13.2689C8.33527 13.2237 8.21824 13.2004 8.10005 13.2004C7.86135 13.2004 7.63244 13.2952 7.46365 13.464C7.29487 13.6328 7.20005 13.8617 7.20005 14.1004C7.20005 14.3391 7.29487 14.568 7.46365 14.7368C7.63244 14.9056 7.86135 15.0004 8.10005 15.0004ZM12.6 6.90039C12.6 7.13909 12.5052 7.368 12.3364 7.53679C12.1677 7.70557 11.9387 7.80039 11.7 7.80039C11.4614 7.80039 11.2324 7.70557 11.0637 7.53679C10.8949 7.368 10.8 7.13909 10.8 6.90039C10.8 6.6617 10.8949 6.43278 11.0637 6.26399C11.2324 6.09521 11.4614 6.00039 11.7 6.00039C11.9387 6.00039 12.1677 6.09521 12.3364 6.26399C12.5052 6.43278 12.6 6.6617 12.6 6.90039ZM11.7 11.4004C11.9387 11.4004 12.1677 11.3056 12.3364 11.1368C12.5052 10.968 12.6 10.7391 12.6 10.5004C12.6 10.2617 12.5052 10.0328 12.3364 9.864C12.1677 9.69521 11.9387 9.60039 11.7 9.60039C11.4614 9.60039 11.2324 9.69521 11.0637 9.864C10.8949 10.0328 10.8 10.2617 10.8 10.5004C10.8 10.7391 10.8949 10.968 11.0637 11.1368C11.2324 11.3056 11.4614 11.4004 11.7 11.4004ZM12.6 14.1004C12.6 14.3391 12.5052 14.568 12.3364 14.7368C12.1677 14.9056 11.9387 15.0004 11.7 15.0004C11.4614 15.0004 11.2324 14.9056 11.0637 14.7368C10.8949 14.568 10.8 14.3391 10.8 14.1004C10.8 13.8617 10.8949 13.6328 11.0637 13.464C11.2324 13.2952 11.4614 13.2004 11.7 13.2004C11.9387 13.2004 12.1677 13.2952 12.3364 13.464C12.5052 13.6328 12.6 13.8617 12.6 14.1004ZM15.3 15.0004C15.4182 15.0004 15.5353 14.9771 15.6445 14.9319C15.7537 14.8867 15.8529 14.8204 15.9364 14.7368C16.02 14.6532 16.0863 14.554 16.1315 14.4448C16.1768 14.3356 16.2 14.2186 16.2 14.1004C16.2 13.9822 16.1768 13.8652 16.1315 13.756C16.0863 13.6468 16.02 13.5476 15.9364 13.464C15.8529 13.3804 15.7537 13.3141 15.6445 13.2689C15.5353 13.2237 15.4182 13.2004 15.3 13.2004C15.0614 13.2004 14.8324 13.2952 14.6637 13.464C14.4949 13.6328 14.4 13.8617 14.4 14.1004C14.4 14.3391 14.4949 14.568 14.6637 14.7368C14.8324 14.9056 15.0614 15.0004 15.3 15.0004ZM5.40005 21.6004C5.24092 21.6004 5.08831 21.5372 4.97578 21.4247C4.86326 21.3121 4.80005 21.1595 4.80005 21.0004V4.20039C4.80005 3.723 4.98969 3.26516 5.32726 2.9276C5.66482 2.59003 6.12266 2.40039 6.60005 2.40039H13.8C14.2774 2.40039 14.7353 2.59003 15.0728 2.9276C15.4104 3.26516 15.6 3.723 15.6 4.20039V9.60039H17.4C17.8774 9.60039 18.3353 9.79003 18.6728 10.1276C19.0104 10.4652 19.2 10.923 19.2 11.4004V21.0004C19.2 21.1595 19.1368 21.3121 19.0243 21.4247C18.9118 21.5372 18.7592 21.6004 18.6 21.6004H5.40005ZM6.00005 4.20039V20.4004H8.40005V17.4004C8.40005 17.2413 8.46326 17.0886 8.57578 16.9761C8.68831 16.8636 8.84092 16.8004 9.00005 16.8004H15C15.1592 16.8004 15.3118 16.8636 15.4243 16.9761C15.5368 17.0886 15.6 17.2413 15.6 17.4004V20.4004H18V11.4004C18 11.2413 17.9368 11.0886 17.8243 10.9761C17.7118 10.8636 17.5592 10.8004 17.4 10.8004H15C14.8409 10.8004 14.6883 10.7372 14.5758 10.6247C14.4633 10.5121 14.4 10.3595 14.4 10.2004V4.20039C14.4 4.04126 14.3368 3.88865 14.2243 3.77613C14.1118 3.6636 13.9592 3.60039 13.8 3.60039H6.60005C6.44092 3.60039 6.28831 3.6636 6.17578 3.77613C6.06326 3.88865 6.00005 4.04126 6.00005 4.20039ZM14.4 18.0004H12.6V20.4004H14.4V18.0004ZM11.4 18.0004H9.60005V20.4004H11.4V18.0004Z" fill="#2C2C2C"/>
                                    </svg>
                                </div>

                                <div class="job-card__info">
                                    <h3>{{ $job->title }}</h3>
                                    <p>{{ $job->company_name ?: 'Hiring Company' }}</p>
                                </div>

                                {{-- <div class="job-card__percentage">0%</div> --}}
                            </div>

                            <div class="job-card__details">
                                @if ($locLabel)
                                    <div class="detail-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M10.6666 6.66667C10.6666 5.19333 9.47325 4 7.99992 4C6.52659 4 5.33325 5.19333 5.33325 6.66667C5.33325 8.14 6.52659 9.33333 7.99992 9.33333C9.47325 9.33333 10.6666 8.14 10.6666 6.66667ZM6.66659 6.66667C6.66659 5.93333 7.26659 5.33333 7.99992 5.33333C8.73325 5.33333 9.33325 5.93333 9.33325 6.66667C9.33325 7.4 8.73325 8 7.99992 8C7.26659 8 6.66659 7.4 6.66659 6.66667Z" fill="#2C2C2C"/>
                                            <path d="M7.61323 14.5395C7.72657 14.6195 7.86657 14.6662 7.9999 14.6662C8.13323 14.6662 8.27323 14.6262 8.38657 14.5395C8.58657 14.3928 13.3532 10.9595 13.3332 6.65951C13.3332 3.71951 10.9399 1.32617 7.9999 1.32617C5.0599 1.32617 2.66657 3.71951 2.66657 6.65951C2.64657 10.9528 7.41323 14.3928 7.61323 14.5395ZM7.9999 2.66617C10.2066 2.66617 11.9999 4.45951 11.9999 6.66617C12.0132 9.62617 9.07323 12.2862 7.9999 13.1595C6.92657 12.2862 3.98657 9.63284 3.9999 6.66617C3.9999 4.45951 5.79323 2.66617 7.9999 2.66617Z" fill="#2C2C2C"/>
                                        </svg>
                                        <span>{{ $locLabel }}</span>
                                    </div>
                                @endif

                                <div class="detail-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M11.9999 2.66797H3.99992C2.52716 2.66797 1.33325 3.86188 1.33325 5.33464V12.0013C1.33325 13.4741 2.52716 14.668 3.99992 14.668H11.9999C13.4727 14.668 14.6666 13.4741 14.6666 12.0013V5.33464C14.6666 3.86188 13.4727 2.66797 11.9999 2.66797Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.33325 1.33398V4.00065M10.6666 1.33398V4.00065M1.33325 6.66732H14.6666" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($job->created_at)->format('m/d/Y') }}</span>
                                </div>
                            </div>

                            <div class="job-card__bottom">
                                <div class="job-type {{ $colorClass }}">{{ $typeLabel }}</div>

                                <span class="job-arrow" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_7252_2871)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.8263 4.90626C13.8542 4.80219 13.8396 4.6913 13.7857 4.59799C13.7319 4.50468 13.6431 4.43659 13.539 4.40871L8.83016 3.14696C8.72609 3.11908 8.6152 3.13368 8.52189 3.18755C8.42858 3.24142 8.36049 3.33015 8.33261 3.43423C8.30472 3.5383 8.31932 3.64919 8.37319 3.7425C8.42706 3.83581 8.5158 3.90389 8.61987 3.93178L12.3815 4.9397L2.28436 10.7686C2.2381 10.7953 2.19756 10.8309 2.16504 10.8733C2.13252 10.9156 2.10867 10.964 2.09484 11.0156C2.08102 11.0672 2.07749 11.121 2.08446 11.174C2.09144 11.2269 2.10877 11.278 2.13548 11.3243C2.16219 11.3705 2.19775 11.4111 2.24012 11.4436C2.2825 11.4761 2.33087 11.5 2.38247 11.5138C2.43406 11.5276 2.48788 11.5311 2.54084 11.5242C2.5938 11.5172 2.64487 11.4999 2.69113 11.4731L12.7877 5.64324L11.7798 9.40486C11.7519 9.50893 11.7665 9.61982 11.8203 9.71313C11.8742 9.80644 11.9629 9.87452 12.067 9.90241C12.1711 9.9303 12.282 9.9157 12.3753 9.86183C12.4686 9.80795 12.5367 9.71922 12.5646 9.61515L13.8263 4.90626Z" fill="#00A148"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_7252_2871">
                                                <rect width="13" height="13" fill="white" transform="translate(3.36475) rotate(15)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="splide__slide">
                        <p>No active jobs right now.</p>
                    </li>
                @endforelse
            </ul>
            </div>
        </div>
    @endforeach
</section>
<!-- End Your Job Card Section-->



<!-- Start Testimonials -->
<section class="testimonials">
    <div class="container-fluid">
        <div class="pills">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
            </svg>
            <span>Loved by experts</span>
        </div>
        <div class="heading">
            <h4>See why people choose <span>Lanxers</span></h4>
            <p>Hear from people who are finding opportunities, gaining experience, and moving forward with Lanxers.</p>
        </div>

        <div class="splide testimonialSwiper" aria-label="Testimonials">
            <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>I uploaded my resume and found a role at a mid-sized product company pretty quickly. I’m three months in now, and the whole process was really easy.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Karthik Reddy</h5>
                                <p>Software Engineer</p>
                                <p>Chennai</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab9fbd364366.jpg" alt="Karthik Reddy" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>I was switching industries and applying to pretty much everything, but hardly hearing back. Lanxers helped me focus on roles that actually made sense for my background, and I started getting more responses.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Sanya Kapoor</h5>
                                <p>Marketing Professional</p>
                                <p>Delhi</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab9fc2ecb0dc.jpg" alt="Sanya Kapoor" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>This was my first internship application, so I was pretty nervous about doing it right. But adding my portfolio and skills made it much easier. Two weeks later, I got a UI/UX internship at a small studio.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Aditi Rao</h5>
                                <p>Design Student</p>
                                <p>Pune</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aba022f21c0c.jpg" alt="Aditi Rao" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>I didn’t want just any internship. I wanted something in development, so I searched by skill and found a startup working on a product I was interested in. I’ve been there for three months now, and they’ve asked me to stay part-time during the semester. </p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Yash Thakur</h5>
                                <p>Engineering Student</p>
                                <p>Jaipur</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aba0297470ee.jpg" alt="Yash Thakur" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>I built a booking website for a client I found on Lanxers. The project took three months, and I received the full payment without any commission being deducted. That’s something I really appreciate, especially after using other platforms.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Ishaan Verma</h5>
                                <p>Web Developer</p>
                                <p>Bengaluru</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aba081ae69e0.jpg" alt="Ishaan Verma" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>Two of my repeat clients came through Lanxers. One of them has been sending me work for almost a year now. Being able to chat directly from the start helped us build a good working relationship.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Nishant Gupta</h5>
                                <p>Content Writer</p>
                                <p>Hyderabad</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aba088d9e1cc.jpg" alt="Nishant Gupta" />
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
            </div>
        </div>

        <div class="splide testimonialSwiper2" aria-label="Testimonials">
            <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>What I liked about Lanxers was not having to keep five different tabs open. I could find listings from different sites in one place and apply without having to search for the same role again. It saved me a lot of time.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Naveen Pillai</h5>
                                <p>Finance Analyst</p>
                                <p>Hyderabad</p>
                            </div> 
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab9fc7579605.jpg" alt="Naveen Pillai" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>The AI profile builder helped me describe my experience in a way I wouldn’t have thought of myself. During the interview, they actually mentioned my resume, which was a nice surprise</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Ritika Sen</h5>
                                <p>HR Professional</p>
                                <p>Kolkata</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab9fdb9a31ad.jpg" alt="Ritika Sen" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>I applied for a content internship between classes and honestly didn’t expect much. I heard back in two days, which was a nice surprise. The person hiring even messaged me directly instead of sending everything through an HR form.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Meher Kaur</h5>
                                <p>Journalism Student</p>
                                <p>Chandigarh</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aba02f6060a4.jpg" alt="Meher Kaur" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>I needed something remote so I could manage it with college. I found a digital marketing internship, applied without paying anything, and got a call that same week.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Rohan D'Souza</h5>
                                <p>Marketing Student</p>
                                <p>Goa</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aba03543d721.jpg" alt="Rohan D'Souza" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>I used the AI assistant to create my profile using my resume, and it actually helped. I got a reply to one of my proposals the very next day. I also like that I can apply to projects without worrying about running out of application credits.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Aarav Malhotra</h5>
                                <p>UI/UX Designer</p>
                                <p>Mumbai</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aba08a6cd7d8.jpg" alt="Aarav Malhotra" />
                            </div>
                        </div>
                    </div>
                </li>

                <li class="splide__slide">
                    <div class="single">
                        <div class="descripition">
                            <p>On other platforms, I had to be careful about how many proposals I sent because credits cost money. On Lanxers, I can apply to projects that fit my skills without worrying about that. I found two clients in my first month.</p>
                        </div>
                        <div class="user">
                            <div class="name">
                                <h5>Priyanka Das</h5>
                                <p>Digital Marketing Freelancer</p>
                                <p>Kolkata</p>
                            </div>
                            <div class="image">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aba09000de4e.jpg" alt="Priyanka Das" />
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            </div>
        </div>

    </div>
</section>
<!-- End Testimonials -->

<!-- ===== Faw Wrapper Gov===== -->                                
        <section class="faq-wrapper-gov ">
            <div class="container-fluid">
                <div class="pills">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                        <g clip-path="url(#clip0_3601_11317)">
                            <path d="M4.17773 8.24744V4.75229C4.17782 4.59407 4.21833 4.4385 4.29543 4.30033C4.37252 4.16217 4.48364 4.04599 4.61824 3.96283C4.75285 3.87967 4.90647 3.83228 5.06453 3.82516C5.22259 3.81804 5.37984 3.85143 5.52138 3.92215L9.01652 5.66972C9.17055 5.74692 9.30007 5.86546 9.39058 6.01206C9.48109 6.15867 9.52903 6.32757 9.52903 6.49987C9.52903 6.67216 9.48109 6.84106 9.39058 6.98767C9.30007 7.13428 9.17055 7.25281 9.01652 7.33001L5.52138 9.07758C5.37984 9.1483 5.22259 9.18169 5.06453 9.17457C4.90647 9.16745 4.75285 9.12007 4.61824 9.0369C4.48364 8.95374 4.37252 8.83757 4.29543 8.6994C4.21833 8.56123 4.17782 8.40566 4.17773 8.24744Z" fill="#00A148" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.51215 0.0786955C7.32966 0.0501279 7.1433 0.0952233 6.99406 0.204061C6.84482 0.3129 6.74493 0.476565 6.71636 0.659053C6.68779 0.841541 6.73289 1.0279 6.84173 1.17714C6.95056 1.32638 7.11423 1.42627 7.29672 1.45484C8.56353 1.65883 9.70719 2.33203 10.5004 3.34062C11.2936 4.34922 11.6782 5.61935 11.5778 6.89854C11.4775 8.17774 10.8994 9.37232 9.95861 10.2448C9.0178 11.1174 7.78312 11.6039 6.5 11.6078C5.47592 11.6083 4.47535 11.3008 3.62821 10.7254C2.78107 10.15 2.12648 9.3332 1.74943 8.38105C1.67771 8.21481 1.54406 8.08303 1.37683 8.01366C1.20959 7.94428 1.02191 7.94276 0.853572 8.00942C0.685234 8.07608 0.549473 8.20568 0.475069 8.37074C0.400665 8.5358 0.393467 8.72335 0.455002 8.89362C1.01286 10.299 2.04305 11.4659 3.36835 12.1938C4.69365 12.9216 6.23117 13.1648 7.7164 12.8815C9.20162 12.5982 10.5417 11.8061 11.506 10.6415C12.4703 9.47694 12.9986 8.0127 13 6.5007C13.0003 4.95199 12.4476 3.45406 11.4415 2.27668C10.4354 1.09931 9.04196 0.319851 7.51215 0.0786955ZM5.22229 1.46227C5.39301 1.40928 5.53683 1.29267 5.62396 1.13658C5.71108 0.980494 5.73486 0.796879 5.69035 0.623748C5.64585 0.450617 5.53647 0.301229 5.38487 0.20651C5.23327 0.111791 5.05105 0.0789946 4.87593 0.11491C4.57909 0.19144 4.28803 0.288873 4.00493 0.406481C3.92049 0.4416 3.84379 0.493008 3.77921 0.55777C3.71463 0.622531 3.66344 0.699378 3.62856 0.783923C3.55812 0.954668 3.5584 1.1464 3.62932 1.31695C3.66444 1.40139 3.71585 1.47809 3.78061 1.54267C3.84537 1.60724 3.92222 1.65843 4.00676 1.69331C4.17751 1.76375 4.36924 1.76348 4.53979 1.69255C4.76017 1.60093 4.98767 1.52479 5.22229 1.46412M2.94357 2.74462C3.06929 2.61461 3.1395 2.44078 3.13935 2.25992C3.13919 2.07906 3.06869 1.90536 2.94275 1.77556C2.8168 1.64575 2.64531 1.57004 2.46453 1.56442C2.28376 1.55881 2.1079 1.62374 1.97414 1.74548C1.53368 2.17176 1.15572 2.65819 0.851502 3.19034C0.80614 3.26978 0.776869 3.35739 0.765362 3.44814C0.753855 3.5389 0.760337 3.63103 0.784437 3.71929C0.808537 3.80754 0.849784 3.89018 0.905822 3.96249C0.96186 4.0348 1.03159 4.09537 1.11104 4.14073C1.19048 4.18609 1.27808 4.21536 1.36884 4.22687C1.4596 4.23838 1.55173 4.2319 1.63999 4.2078C1.72824 4.1837 1.81088 4.14245 1.88319 4.08641C1.9555 4.03037 2.01607 3.96064 2.06143 3.8812C2.301 3.46148 2.59815 3.07891 2.94357 2.74462ZM1.443 5.69005C1.45753 5.59873 1.45373 5.50543 1.43182 5.41559C1.40991 5.32575 1.37033 5.24118 1.31538 5.1668C1.26044 5.09242 1.19123 5.02973 1.1118 4.98239C1.03237 4.93504 0.944302 4.90399 0.852741 4.89104C0.761181 4.87809 0.667959 4.88351 0.578514 4.90697C0.489069 4.93044 0.405192 4.97148 0.331778 5.0277C0.258363 5.08393 0.196881 5.15421 0.150919 5.23445C0.104956 5.31469 0.0754336 5.40328 0.0640735 5.49505C0.0211694 5.79835 -0.000241101 6.1043 2.04777e-06 6.41062C2.04777e-06 6.59533 0.0733756 6.77247 0.203981 6.90307C0.334587 7.03368 0.511726 7.10705 0.696431 7.10705C0.881135 7.10705 1.05827 7.03368 1.18888 6.90307C1.31949 6.77247 1.39286 6.59533 1.39286 6.41062C1.39286 6.16548 1.40957 5.92529 1.443 5.69005Z" fill="#00A148" />
                        </g>
                        <defs>
                            <clipPath id="clip0_3601_11317">
                                <rect width="13" height="13" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>FAQS</span>
                </div>

                <div class="heading">
                    <h1>Curious about <span>Lanxers?</span></h1>
                    <p>Find quick answers to the most common questions</p>
                </div>

                    <div class="gov-accordion-box">
                        <div class="accordion">
                    
                            <!-----FAQ1------>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <span class="question-text">How do I find opportunities?</span>
                                    <div class="toggle-icon"><span>+</span></div>
                                </div>
                                
                                <div class="accordion-content">
                                    <p>Browse jobs, freelance projects, and internships based on your skills and interests. Search by job title, skill, company, location, and other relevant criteria.</p>
                                </div>
                            </div>
                            
                            <!-----FAQ2------>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <span class="question-text">How do I apply?</span>
                                    <div class="toggle-icon"><span>+</span></div>
                                </div>
                                
                                <div class="accordion-content">
                                    <p>Find an opportunity that matches your skills and submit your application through Lanxers. The employer can then review your profile and application.</p>
                                </div>
                            </div>
                            
                            <!-----FAQ3------>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <span class="question-text">Can I apply for multiple opportunities?</span>
                                    <div class="toggle-icon"><span>+</span></div>
                                </div>
                                
                                <div class="accordion-content">
                                    <p>Yes. You can apply to multiple opportunities that match your skills, experience, and career goals.</p>
                                </div>
                            </div>

                            <!-----FAQ4------>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <span class="question-text">Is Lanxers free for talent?</span>
                                    <div class="toggle-icon"><span>+</span></div>
                                </div>
                                
                                <div class="accordion-content">
                                    <p>Yes. You can create a profile, explore opportunities, and apply through Lanxers without platform fees.</p>
                                </div>
                            </div>

                            <!-----FAQ5------>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <span class="question-text">Can employers view my profile?</span>
                                    <div class="toggle-icon"><span>+</span></div>
                                </div>
                                
                                <div class="accordion-content">
                                    <p>Employers can view your profile when you apply to their opportunities. They can review your skills, experience, portfolio, and other relevant details.</p>
                                </div>
                            </div>

                            <!-----FAQ6------>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <span class="question-text">How will I know if I'm selected?</span>
                                    <div class="toggle-icon"><span>+</span></div>
                                </div>
                                
                                <div class="accordion-content">
                                    <p>You'll be notified when an employer selects you for an opportunity, along with the relevant details and next steps.</p>
                                </div>
                            </div>

                            <!-----FAQ7------>
                            
                                
                        </div>
                    </div>
                </div>
        </section>
        <!-- ===== Faw Wrapper Gov===== --> 

<!-- Start CTA -->
<section class="cta">
    <div class="container-fluid">
        <div class="wrapper">
            <h6>Ready to put your skills to work?</h6>
            <a href="{{ route('jobseekers.find.work') }}">Find Jobs</a>
        </div>
    </div>
</section>
<!-- End CTA -->
        

<script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>
<script src="asset('frontend/js/homepage.js')"></script>

<script>
    function bindInstantPause(swiper) {
        swiper.el.addEventListener('mouseenter', function () {
            if (swiper.autoplay) swiper.autoplay.stop();
        });
        swiper.el.addEventListener('mouseleave', function () {
            if (!swiper.autoplay) return;
            swiper.animating = false;
            swiper.autoplay.paused = false;
            swiper.autoplay.start();
        });
    }
</script>

<script>
    var oppSwiper = new Swiper(".oppSwiper", {
        loop: true,
        roundLengths: true,
        speed: 500,
        slidesPerView: "auto",
        slidesPerGroup: 1,
        longSwipes: false,
        spaceBetween: 15,
        // slidesOffsetBefore: 15,
        watchOverflow: true,
        pagination: {
            el: ".oppSwiper .swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            991: {
                slidesPerView: 3,
                spaceBetween: 20,
                // slidesOffsetBefore: 0,
                pagination: { enabled: false },
            },
        },
    });
</script>

<script>
    document.querySelectorAll('.whychoose-lanxers').forEach(function (section) {
        var btn = section.querySelector('.boxgrid-toggle');
        if (!btn) return;
        var label = btn.querySelector('span');
        btn.addEventListener('click', function () {
            var open = section.classList.toggle('is-expanded');
            label.textContent = open ? 'View less' : 'View more';
        });
    });
</script>

<script>
  (function () {
    var canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    function marqueeDuration(marquee) {
      var seconds = parseFloat(getComputedStyle(marquee).getPropertyValue('--speed'));
      return seconds > 0 ? seconds : 40;
    }

    function wrapX(value, distance) {
      var mod = value % distance;
      if (mod > 0) mod -= distance;
      return mod;
    }

    function playMarquee(marquee, x) {
      var track = marquee._track;
      var distance = marquee._distance;
      var reverse = marquee._reverse;
      if (!track || !distance) return;

      x = wrapX(typeof x === 'number' ? x : 0, distance);
      if (marquee._gsapTween) marquee._gsapTween.kill();
      gsap.set(track, { x: x });

      var tween = gsap.fromTo(track,
        { x: reverse ? -distance : 0 },
        {
          x: reverse ? 0 : -distance,
          duration: marquee._duration,
          ease: 'none',
          repeat: -1
        }
      );
      var progress = reverse ? (x + distance) / distance : -x / distance;
      if (progress >= 1 || progress < 0) progress = 0;
      tween.progress(progress);
      marquee._gsapTween = tween;
    }

    function startMarquee(marquee) {
      var track = marquee.querySelector('.marquee__track');
      var set = track && track.querySelector('.marquee__set');
      if (!track || !set || typeof gsap === 'undefined') return;

      if (!track.querySelector('.marquee__set[aria-hidden="true"]')) {
        var copy = set.cloneNode(true);
        copy.setAttribute('aria-hidden', 'true');
        track.appendChild(copy);
      }

      var distance = set.offsetWidth;
      if (!distance) return;

      var current = 0;
      if (marquee._gsapTween) current = marquee._gsapTween.progress();

      marquee._track = track;
      marquee._distance = distance;
      marquee._reverse = marquee.classList.contains('marquee--reverse');
      marquee._duration = marqueeDuration(marquee);

      var x = marquee._reverse ? -distance + current * distance : -current * distance;
      playMarquee(marquee, x);
      bindDrag(marquee);
    }

    function bindDrag(marquee) {
      if (marquee._dragBound) return;
      marquee._dragBound = true;

      var dragging = false;
      var pointerId = null;
      var startClientX = 0;
      var startX = 0;
      var moved = 0;

      marquee.addEventListener('pointerdown', function (event) {
        if (!marquee._track || !marquee._distance) return;
        if (event.pointerType === 'mouse' && event.button !== 0) return;
        dragging = true;
        pointerId = event.pointerId;
        startClientX = event.clientX;
        startX = gsap.getProperty(marquee._track, 'x') || 0;
        moved = 0;
        if (marquee._gsapTween) marquee._gsapTween.pause();
        marquee.setPointerCapture(event.pointerId);
      });

      marquee.addEventListener('pointermove', function (event) {
        if (!dragging || event.pointerId !== pointerId) return;
        var dx = event.clientX - startClientX;
        moved = Math.max(moved, Math.abs(dx));
        gsap.set(marquee._track, { x: wrapX(startX + dx, marquee._distance) });
      });

      function endDrag(event) {
        if (!dragging || event.pointerId !== pointerId) return;
        dragging = false;
        playMarquee(marquee, gsap.getProperty(marquee._track, 'x') || 0);
      }

      marquee.addEventListener('pointerup', endDrag);
      marquee.addEventListener('pointercancel', endDrag);

      marquee.addEventListener('click', function (event) {
        if (moved <= 8) return;
        event.preventDefault();
        event.stopPropagation();
        moved = 0;
      }, true);
    }

    function startAll() {
      document.querySelectorAll('.skills-section .marquee').forEach(startMarquee);
    }

    startAll();

    if (canHover) {
      document.querySelectorAll('.skills-section .marquee').forEach(function (marquee) {
        marquee.addEventListener('mouseenter', function () {
          if (marquee._gsapTween) marquee._gsapTween.pause();
        });
        marquee.addEventListener('mouseleave', function () {
          if (marquee._gsapTween) marquee._gsapTween.play();
        });
      });
    }

    var resizeTimer;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(startAll, 150);
    });
  })();
</script>

<script>
    document.querySelectorAll('.testimonials .descripition').forEach(function (block) {
        if (block.querySelector('.read-more')) return;
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'read-more';
        btn.textContent = 'Read more';
        btn.setAttribute('aria-expanded', 'false');
        block.appendChild(btn);
    });

    function testimonialExceedsFourLines(paragraph) {
        var style = window.getComputedStyle(paragraph);
        var lineHeight = parseFloat(style.lineHeight);
        if (!lineHeight) lineHeight = parseFloat(style.fontSize) * 1.2;
        var probe = paragraph.cloneNode(true);
        probe.style.cssText = 'position:absolute;visibility:hidden;pointer-events:none;height:auto;max-height:none;overflow:visible;display:block;-webkit-line-clamp:unset;width:' + paragraph.getBoundingClientRect().width + 'px;';
        paragraph.parentNode.appendChild(probe);
        var over = probe.scrollHeight > lineHeight * 4 + 1;
        probe.remove();
        return over;
    }

    function syncTestimonialReadMore() {
        document.querySelectorAll('.testimonials .descripition').forEach(function (block) {
            var paragraph = block.querySelector('p');
            var btn = block.querySelector('.read-more');
            var single = block.closest('.single');
            if (!paragraph || !btn || !single) return;
            if (!paragraph.getBoundingClientRect().width) return;
            var expanded = single.classList.contains('is-expanded');
            if (expanded) single.classList.remove('is-expanded');
            var over = testimonialExceedsFourLines(paragraph);
            btn.classList.toggle('is-visible', over);
            if (!over) {
                btn.textContent = 'Read more';
                btn.setAttribute('aria-expanded', 'false');
                return;
            }
            if (expanded) single.classList.add('is-expanded');
        });
    }

    document.querySelectorAll('.testimonials').forEach(function (section) {
        section.addEventListener('click', function (event) {
            var btn = event.target.closest('.read-more');
            if (!btn || !btn.classList.contains('is-visible')) return;
            event.preventDefault();
            var single = btn.closest('.single');
            var open = single.classList.toggle('is-expanded');
            btn.textContent = open ? 'Read less' : 'Read more';
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    });

    syncTestimonialReadMore();
    window.addEventListener('load', syncTestimonialReadMore);
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(syncTestimonialReadMore);
    window.addEventListener('resize', syncTestimonialReadMore);

    function mountTestimonialSplide(selector, speed, reverseOnPhone) {
        var splide = new Splide(selector, {
            type: 'loop',
            arrows: false,
            pagination: false,
            gap: 10,
            drag: false,
            fixedWidth: 'calc((100% - 30px) / 4.4)',
            padding: reverseOnPhone ? { left: 'calc((100% - 30px) / 22)' } : 0,
            autoplay: false,
            autoScroll: {
                speed: speed,
                pauseOnHover: true,
                pauseOnFocus: false,
            },
            breakpoints: {
                990: {
                    fixedWidth: reverseOnPhone ? '100%' : 'calc(100% - 50px)',
                    gap: 10,
                    padding: reverseOnPhone
                        ? { left: '50px', right: '0px' }
                        : { left: '0px', right: '0px' },
                    perMove: 1,
                    drag: true,
                    snap: true,
                    speed: 600,
                    autoScroll: false,
                    autoplay: !reverseOnPhone,
                    interval: 2500,
                },
            },
        });
        splide.mount(window.splide.Extensions);

        var desktop = window.matchMedia('(min-width: 991px)');
        var autoScroll = splide.Components && splide.Components.AutoScroll;
        function resumeTestimonialScroll() {
            splide.refresh();
            autoScroll = splide.Components && splide.Components.AutoScroll;
            if (desktop.matches && autoScroll && autoScroll.isPaused()) autoScroll.play();
        }
        if (document.readyState === 'complete') resumeTestimonialScroll();
        else window.addEventListener('load', resumeTestimonialScroll);
        if (desktop.matches && autoScroll && autoScroll.isPaused()) autoScroll.play();

        if (reverseOnPhone) {
            var phoneTimer = null;
            var phone = window.matchMedia('(max-width: 990px)');
            function syncPhoneReverse() {
                if (phone.matches && !phoneTimer) {
                    phoneTimer = setInterval(function () {
                        if (phone.matches) splide.go('<');
                    }, 2500);
                } else if (!phone.matches && phoneTimer) {
                    clearInterval(phoneTimer);
                    phoneTimer = null;
                }
            }
            syncPhoneReverse();
            phone.addEventListener('change', syncPhoneReverse);
        }
    }

    mountTestimonialSplide('.testimonialSwiper', 0.7, false);
    mountTestimonialSplide('.testimonialSwiper2', -0.7, true);

    function mountJobcardSplide(selector, reverse) {
        if (!document.querySelector(selector)) return null;
        var desktopWidth = 'calc((100% - 50px) / 6.2)';
        var desktopPeek = 'calc(0.8 * (100% - 50px) / 6.2)';
        var splide = new Splide(selector, {
            type: 'loop',
            arrows: false,
            pagination: false,
            gap: 10,
            drag: false,
            speed: 600,
            fixedWidth: desktopWidth,
            padding: reverse ? { left: desktopPeek } : 0,
            autoplay: false,
            autoScroll: {
                speed: reverse ? -0.4 : 0.4,
                pauseOnHover: true,
                pauseOnFocus: false,
            },
            breakpoints: {
                990: {
                    fixedWidth: reverse ? '100%' : 'calc(100% - 50px)',
                    gap: 10,
                    padding: reverse
                        ? { left: '50px', right: '0px' }
                        : { left: '0px', right: '0px' },
                    perMove: 1,
                    drag: true,
                    snap: true,
                    speed: 600,
                    autoScroll: false,
                    autoplay: !reverse,
                    interval: 2500,
                },
            },
        });
        splide.mount(window.splide.Extensions);

        var desktop = window.matchMedia('(min-width: 991px)');
        var desktopSlideWidth = 0;
        function syncDesktopWidth() {
            if (!desktop.matches) {
                desktopSlideWidth = 0;
                return;
            }
            var width = (splide.root.clientWidth - 50) / 6.2;
            if (width < 1 || Math.abs(width - desktopSlideWidth) < 0.5) return;
            desktopSlideWidth = width;
            var peek = width * 0.8;
            splide.options = {
                fixedWidth: width,
                padding: reverse ? { left: peek, right: 0 } : { left: 0, right: 0 },
            };
        }
        function syncJobcardScroll() {
            if (!desktop.matches || !splide.options.autoScroll) return;
            var slide = (splide.root.clientWidth - 50) / 6.2;
            if (!slide) return;
            splide.options.autoScroll.speed = (reverse ? -1 : 1) * (slide / 600);
        }
        var autoScroll = splide.Components && splide.Components.AutoScroll;
        function resumeJobcardScroll() {
            splide.refresh();
            syncDesktopWidth();
            syncJobcardScroll();
            autoScroll = splide.Components && splide.Components.AutoScroll;
            if (desktop.matches && autoScroll && autoScroll.isPaused()) autoScroll.play();
        }
        syncDesktopWidth();
        syncJobcardScroll();
        splide.on('resized', syncDesktopWidth);
        splide.on('resized', syncJobcardScroll);
        window.addEventListener('load', syncDesktopWidth);
        if (document.readyState === 'complete') resumeJobcardScroll();
        else window.addEventListener('load', resumeJobcardScroll);
        if (desktop.matches && autoScroll && autoScroll.isPaused()) autoScroll.play();

        if (reverse) {
            var phoneTimer = null;
            var phone = window.matchMedia('(max-width: 990px)');
            function syncPhoneReverse() {
                if (phone.matches && !phoneTimer) {
                    phoneTimer = setInterval(function () {
                        if (phone.matches) splide.go('<');
                    }, 2500);
                } else if (!phone.matches && phoneTimer) {
                    clearInterval(phoneTimer);
                    phoneTimer = null;
                }
            }
            syncPhoneReverse();
            phone.addEventListener('change', syncPhoneReverse);
        }

        return splide;
    }

    mountJobcardSplide('.jobcardSwiper1', false);
    mountJobcardSplide('.jobcardSwiper2', true);

    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        bindInstantPause(oppSwiper);
    }

</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const headers = document.querySelectorAll('.accordion-header');

    headers.forEach(header => {
      header.addEventListener('click', () => {
        const currentItem = header.parentElement;

        document.querySelectorAll('.accordion-item').forEach(item => {
          if (item !== currentItem) {
            item.classList.remove('active');
            item.querySelector('.toggle-icon span').textContent = '+';
          }
        });

        currentItem.classList.toggle('active');

        const icon = currentItem.querySelector('.toggle-icon span');
        icon.textContent = currentItem.classList.contains('active') ? '×' : '+';
      });
    });
  });
</script>

<script>
    const data = {
        skills: [
            "React JS Developer",
            "Node.js Developer",
            "Python Developer",
            "UI/UX Designer",
            "Digital Marketing",
            "Content Writer",
            "Data Analyst",
            "Graphic Designer",
            "Java Developer",
            "Product Manager",
            "HR Executive",
            "Sales Executive",
            "Google",
            "Amazon",
            "Microsoft",
            "TCS",
            "Infosys"
        ],

        location: [
            "Delhi",
            "Mumbai",
            "Bangalore",
            "Hyderabad",
            "Pune",
            "Chennai",
            "Kolkata",
            "Ahmedabad",
            "Noida",
            "Gurgaon",
            "Remote"
        ],

        experience: [
            "Fresher",
            "0-1 years",
            "1-3 years",
            "3-5 years",
            "5-8 years",
            "8+ years"
        ]
    };

    document.querySelectorAll('.field').forEach(field => {
        const key = field.dataset.field;
        const input = field.querySelector('input');
        const box = field.querySelector('.suggestions');

        let activeIndex = -1;

        function renderList(items, query) {
            box.innerHTML = "";

            if (items.length === 0) {
                box.innerHTML = `
                    <div class="suggestion-empty">
                        No matches found
                    </div>
                `;

                box.classList.add('show');
                return;
            }

            items.forEach((item) => {
                const div = document.createElement('div');

                div.className = 'suggestion-item';

                let highlighted = item;

                if (query) {
                    const escapedQuery = query.replace(
                        /[.*+?^${}()|[\]\\]/g,
                        '\\$&'
                    );

                    highlighted = item.replace(
                        new RegExp(`(${escapedQuery})`, 'gi'),
                        '<mark>$1</mark>'
                    );
                }

                div.innerHTML = `
                    <span>${highlighted}</span>
                `;

                div.addEventListener('mousedown', (e) => {
                    e.preventDefault();

                    input.value = item;

                    box.classList.remove('show');

                    activeIndex = -1;
                });

                box.appendChild(div);
            });

            box.classList.add('show');
        }

        function showAll() {
            renderList(data[key], "");
        }

        function filter(query) {
            const value = query.trim().toLowerCase();

            if (!value) {
                showAll();
                return;
            }

            const matches = data[key].filter(item =>
                item.toLowerCase().includes(value)
            );

            renderList(matches, query);
        }

        // Focus - show all suggestions
        input.addEventListener('focus', () => {
            filter(input.value);
        });

        // Search while typing
        input.addEventListener('input', () => {
            activeIndex = -1;
            filter(input.value);
        });

        // Keyboard navigation
        input.addEventListener('keydown', (e) => {
            const items = box.querySelectorAll('.suggestion-item');

            if (!items.length) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();

                activeIndex =
                    (activeIndex + 1) % items.length;

            } else if (e.key === 'ArrowUp') {
                e.preventDefault();

                activeIndex =
                    (activeIndex - 1 + items.length) %
                    items.length;

            } else if (e.key === 'Enter') {

                if (activeIndex >= 0) {
                    e.preventDefault();

                    input.value =
                        items[activeIndex].textContent.trim();

                    box.classList.remove('show');

                    activeIndex = -1;
                }

                return;

            } else {
                return;
            }

            items.forEach(item => {
                item.classList.remove('highlighted');
            });

            items[activeIndex].classList.add('highlighted');

            items[activeIndex].scrollIntoView({
                block: 'nearest'
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!field.contains(e.target)) {
                box.classList.remove('show');
                activeIndex = -1;
            }
        });
    });
</script>


<script>
  // Only one FAQ open at a time across BOTH columns (left + right combined).
  const allCollapses = Array.from(document.querySelectorAll('.faq-item .collapse'));

  allCollapses.forEach(collapseEl => {
    const item = collapseEl.closest('.faq-item');

    collapseEl.addEventListener('show.bs.collapse', () => {
      // close every other open accordion item on the page (both columns)
      allCollapses.forEach(other => {
        if (other !== collapseEl) {
          bootstrap.Collapse.getOrCreateInstance(other, { toggle: false }).hide();
        }
      });
      item.classList.add('active');
    });

    collapseEl.addEventListener('hide.bs.collapse', () => {
      item.classList.remove('active');
    });
  });
</script>


<script>
    var logoSplide = new Splide('.bannerLogoSwiper', {
        type: 'loop',
        autoWidth: true,
        gap: 60,
        arrows: false,
        pagination: false,
        drag: false,
        autoScroll: {
            speed: 1,
            pauseOnHover: true,
            pauseOnFocus: false,
        },
    });
    logoSplide.mount(window.splide.Extensions);
    var autoScroll = logoSplide.Components && logoSplide.Components.AutoScroll;
    function resumeLogoScroll() {
        logoSplide.refresh();
        if (autoScroll && autoScroll.isPaused()) autoScroll.play();
    }
    if (document.readyState === 'complete') resumeLogoScroll();
    else window.addEventListener('load', resumeLogoScroll);
    if (autoScroll && autoScroll.isPaused()) autoScroll.play();
</script>

@endsection