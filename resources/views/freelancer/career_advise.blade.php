@extends('freelancer.layouts.main')

@section('main-section')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css" />

<link rel="stylesheet" href="{{ asset('frontend/css/career_advices.css') }}?v={{ filemtime(public_path('frontend/css/career_advices.css')) }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/homepage.css') }}?v={{ filemtime(public_path('frontend/css/homepage.css')) }}" />

<!-- Start Banner  -->
<section class="career-banner">
    <img class="real-people" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa90204241d5.jpg" alt="img1">
    <img class="learn-apply" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa902150bb7f.jpg" alt="img2">

    <div class="container-fluid">
        <div class="trusted">
            <div class="avatars">
                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa9023ca6512.jpg" alt="img3">
                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa902511fe00.jpg" alt="img4">
                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa90268b1e03.jpg" alt="img5">
                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa9027b906e0.jpg" alt="img6">
            </div>
            <div class="label">Trusted by 125K+ Job Seekers</div>
        </div>
        <div class="heading">
            <h1>Career Advice to Help You <span> Grow</span></h1>
        </div>
        <div class="para">
            <p>Get useful career tips on job searching, career advice, and guidance to build your skills, find opportunities, and grow your career.</p>
        </div>
    
        <div class="career-advice">
            <div class="career-step">
                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa90291d5f02.jpg" alt="img7">
            </div>

            <div class="video-wrapper position-relative overflow-hidden">
                <iframe class="w-100 h-100 d-block" src="https://app.tpstreams.com/embed/n3j46e/6mRSAXr2SZt/?access_token=438daca5-b7ad-45dd-a8fb-3bb783f861a2&autoplay=1&mute=1" allow="autoplay; fullscreen; accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy" frameborder="0" title="Video Player" poster="assets/images/video-poster.png"></iframe>
            </div>

            <div class="career-step">
                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa90291d5f02.jpg" alt="img7">
            </div>
        </div>

    </div>
</section>
<!-- End Banner  -->

<!-- Start User Section -->
<section class="user-section">
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
            <span>Choose what fits you best ?</span>
        </div>

        <div class="heading">
            <h1>Career advice for <br>  <span>Every Stage</span></h1>
            <p>Your hiring needs depend on what your business is trying to achieve. Choose the right model based on the role, the work, and the kind of talent you want to bring on board.</p>
        </div>

        <div class="swiper userSlider" id="swiperSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="user-card">
                        <div class="user-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa902e935434.jpg" alt="img8">
                        </div>
                        
                        <div class="user-content">
                            <h3>Starting your career</h3>
                            <p>Build a strong foundation for your career. Get advice on developing your skills, creating your first profile or resume, finding your strengths, and getting started professionally.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="user-card">
                        <div class="user-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa902e935434.jpg" alt="img8">
                        </div>
                        
                        <div class="user-content">
                            <h3>Looking for work</h3>
                            <p>Make your job search more effective. Learn how to find the right opportunities, improve your applications, prepare for interviews, and stand out to employers.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="user-card">
                        <div class="user-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa902e935434.jpg" alt="img8">
                        </div>
                        
                        <div class="user-content">
                            <h3>Growing your career</h3>
                            <p>Take your career to the next level. Explore advice on building new skills, finding better opportunities, growing professionally, and reaching your career goals.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="user-card">
                        <div class="user-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa902e935434.jpg" alt="img8">
                        </div>
                        
                        <div class="user-content">
                            <h3>Freelancing</h3>
                            <p>Build and grow your freelance career. Learn how to find the right projects, present your skills, work with clients, build your reputation, and grow your income.</p>
                        </div>
                    </div>
                </div>

            </div>     
        </div>
    </div>
</section>
<!-- End User Section -->

<!-- Start Real Progres -->
<section class="real-progress">
    <img class="leftimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa9031979751.jpg" alt="img9">
    <img class="rightimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f380d6dd5.jpg" alt="img10">
    <div class="container-fluid">    
        <div class="realflex">
            <div>
                <div class="header-top">
                    <div class="heading">
                        <h1><span>Popular</span> <br> career topics</h1>
                    </div>
                    <div class="des">
                        Explore career advice on the topics people search for most, from finding opportunities and preparing for interviews to building skills and growing their careers.
                    </div>
                </div>

                <div class="real-box bigcard">
                    <div class="real-content">
                        <div class="tag-box tag-bg1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M11.1997 2.19961C11.1997 2.04048 11.2629 1.88787 11.3755 1.77535C11.488 1.66282 11.6406 1.59961 11.7997 1.59961H13.7997C13.9589 1.59961 14.1115 1.66282 14.224 1.77535C14.3365 1.88787 14.3997 2.04048 14.3997 2.19961V4.19961C14.3997 4.35874 14.3365 4.51135 14.224 4.62387C14.1115 4.7364 13.9589 4.79961 13.7997 4.79961C13.6406 4.79961 13.488 4.7364 13.3755 4.62387C13.2629 4.51135 13.1997 4.35874 13.1997 4.19961V3.64761L9.62373 7.22361C9.51123 7.33597 9.35873 7.39908 9.19973 7.39908C9.04073 7.39908 8.88823 7.33597 8.77573 7.22361L6.79973 5.24761L3.42373 8.62361C3.3688 8.68256 3.30256 8.72984 3.22896 8.76263C3.15536 8.79543 3.07591 8.81306 2.99535 8.81448C2.91479 8.8159 2.83476 8.80108 2.76005 8.77091C2.68534 8.74073 2.61748 8.69581 2.5605 8.63884C2.50353 8.58186 2.45861 8.514 2.42843 8.43929C2.39826 8.36458 2.38344 8.28455 2.38486 8.20399C2.38628 8.12343 2.40391 8.04398 2.43671 7.97038C2.4695 7.89678 2.51678 7.83054 2.57573 7.77561L6.37573 3.97561C6.48823 3.86325 6.64073 3.80014 6.79973 3.80014C6.95873 3.80014 7.11123 3.86325 7.22373 3.97561L9.19973 5.95161L12.3517 2.79961H11.7997C11.6406 2.79961 11.488 2.7364 11.3755 2.62387C11.2629 2.51135 11.1997 2.35874 11.1997 2.19961ZM2.99973 11.1996C3.15886 11.1996 3.31147 11.2628 3.424 11.3753C3.53652 11.4879 3.59973 11.6405 3.59973 11.7996V13.7996C3.59973 13.9587 3.53652 14.1114 3.424 14.2239C3.31147 14.3364 3.15886 14.3996 2.99973 14.3996C2.8406 14.3996 2.68799 14.3364 2.57547 14.2239C2.46295 14.1114 2.39973 13.9587 2.39973 13.7996V11.7996C2.39973 11.6405 2.46295 11.4879 2.57547 11.3753C2.68799 11.2628 2.8406 11.1996 2.99973 11.1996ZM6.79973 9.39961C6.79973 9.24048 6.73652 9.08787 6.624 8.97535C6.51147 8.86282 6.35886 8.79961 6.19973 8.79961C6.0406 8.79961 5.88799 8.86282 5.77547 8.97535C5.66295 9.08787 5.59973 9.24048 5.59973 9.39961V13.7996C5.59973 13.9587 5.66295 14.1114 5.77547 14.2239C5.88799 14.3364 6.0406 14.3996 6.19973 14.3996C6.35886 14.3996 6.51147 14.3364 6.624 14.2239C6.73652 14.1114 6.79973 13.9587 6.79973 13.7996V9.39961ZM9.39973 10.3996C9.55886 10.3996 9.71147 10.4628 9.824 10.5753C9.93652 10.6879 9.99973 10.8405 9.99973 10.9996V13.7996C9.99973 13.9587 9.93652 14.1114 9.824 14.2239C9.71147 14.3364 9.55886 14.3996 9.39973 14.3996C9.2406 14.3996 9.08799 14.3364 8.97547 14.2239C8.86295 14.1114 8.79973 13.9587 8.79973 13.7996V10.9996C8.79973 10.8405 8.86295 10.6879 8.97547 10.5753C9.08799 10.4628 9.2406 10.3996 9.39973 10.3996ZM13.1997 7.79961C13.1997 7.64048 13.1365 7.48787 13.024 7.37535C12.9115 7.26282 12.7589 7.19961 12.5997 7.19961C12.4406 7.19961 12.288 7.26282 12.1755 7.37535C12.0629 7.48787 11.9997 7.64048 11.9997 7.79961V13.7996C11.9997 13.9587 12.0629 14.1114 12.1755 14.2239C12.288 14.3364 12.4406 14.3996 12.5997 14.3996C12.7589 14.3996 12.9115 14.3364 13.024 14.2239C13.1365 14.1114 13.1997 13.9587 13.1997 13.7996V7.79961Z" fill="#A9490D"/>
                            </svg>
                            <span>Career Growth</span>
                        </div>
                        <h3>Find the <br> right job opportunities</h3>
                    </div>

                    <div class="illustration">
                        <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa90351bb3db.jpg" alt="img12">
                    </div>
                </div>
            </div>        

            <div class="realflexmini">
                <div class="real-box card-w2">
                    <div class="real-content">
                        <div class="tag-box tag-bg2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M11.1997 2.19961C11.1997 2.04048 11.2629 1.88787 11.3755 1.77535C11.488 1.66282 11.6406 1.59961 11.7997 1.59961H13.7997C13.9589 1.59961 14.1115 1.66282 14.224 1.77535C14.3365 1.88787 14.3997 2.04048 14.3997 2.19961V4.19961C14.3997 4.35874 14.3365 4.51135 14.224 4.62387C14.1115 4.7364 13.9589 4.79961 13.7997 4.79961C13.6406 4.79961 13.488 4.7364 13.3755 4.62387C13.2629 4.51135 13.1997 4.35874 13.1997 4.19961V3.64761L9.62373 7.22361C9.51123 7.33597 9.35873 7.39908 9.19973 7.39908C9.04073 7.39908 8.88823 7.33597 8.77573 7.22361L6.79973 5.24761L3.42373 8.62361C3.3688 8.68256 3.30256 8.72984 3.22896 8.76263C3.15536 8.79543 3.07591 8.81306 2.99535 8.81448C2.91479 8.8159 2.83476 8.80108 2.76005 8.77091C2.68534 8.74073 2.61748 8.69581 2.5605 8.63884C2.50353 8.58186 2.45861 8.514 2.42843 8.43929C2.39826 8.36458 2.38344 8.28455 2.38486 8.20399C2.38628 8.12343 2.40391 8.04398 2.43671 7.97038C2.4695 7.89678 2.51678 7.83054 2.57573 7.77561L6.37573 3.97561C6.48823 3.86325 6.64073 3.80014 6.79973 3.80014C6.95873 3.80014 7.11123 3.86325 7.22373 3.97561L9.19973 5.95161L12.3517 2.79961H11.7997C11.6406 2.79961 11.488 2.7364 11.3755 2.62387C11.2629 2.51135 11.1997 2.35874 11.1997 2.19961ZM2.99973 11.1996C3.15886 11.1996 3.31147 11.2628 3.424 11.3753C3.53652 11.4879 3.59973 11.6405 3.59973 11.7996V13.7996C3.59973 13.9587 3.53652 14.1114 3.424 14.2239C3.31147 14.3364 3.15886 14.3996 2.99973 14.3996C2.8406 14.3996 2.68799 14.3364 2.57547 14.2239C2.46295 14.1114 2.39973 13.9587 2.39973 13.7996V11.7996C2.39973 11.6405 2.46295 11.4879 2.57547 11.3753C2.68799 11.2628 2.8406 11.1996 2.99973 11.1996ZM6.79973 9.39961C6.79973 9.24048 6.73652 9.08787 6.624 8.97535C6.51147 8.86282 6.35886 8.79961 6.19973 8.79961C6.0406 8.79961 5.88799 8.86282 5.77547 8.97535C5.66295 9.08787 5.59973 9.24048 5.59973 9.39961V13.7996C5.59973 13.9587 5.66295 14.1114 5.77547 14.2239C5.88799 14.3364 6.0406 14.3996 6.19973 14.3996C6.35886 14.3996 6.51147 14.3364 6.624 14.2239C6.73652 14.1114 6.79973 13.9587 6.79973 13.7996V9.39961ZM9.39973 10.3996C9.55886 10.3996 9.71147 10.4628 9.824 10.5753C9.93652 10.6879 9.99973 10.8405 9.99973 10.9996V13.7996C9.99973 13.9587 9.93652 14.1114 9.824 14.2239C9.71147 14.3364 9.55886 14.3996 9.39973 14.3996C9.2406 14.3996 9.08799 14.3364 8.97547 14.2239C8.86295 14.1114 8.79973 13.9587 8.79973 13.7996V10.9996C8.79973 10.8405 8.86295 10.6879 8.97547 10.5753C9.08799 10.4628 9.2406 10.3996 9.39973 10.3996ZM13.1997 7.79961C13.1997 7.64048 13.1365 7.48787 13.024 7.37535C12.9115 7.26282 12.7589 7.19961 12.5997 7.19961C12.4406 7.19961 12.288 7.26282 12.1755 7.37535C12.0629 7.48787 11.9997 7.64048 11.9997 7.79961V13.7996C11.9997 13.9587 12.0629 14.1114 12.1755 14.2239C12.288 14.3364 12.4406 14.3996 12.5997 14.3996C12.7589 14.3996 12.9115 14.3364 13.024 14.2239C13.1365 14.1114 13.1997 13.9587 13.1997 13.7996V7.79961Z" fill="#2C5FF9"/>
                            </svg>
                            <span>Job Search</span>
                        </div>
                        <h3>Build a stronger resume and profile</h3>
                        <p>Create a resume and professional profile that clearly communicate your skills, experience, achievements, and what you can bring to an employer.</p>
                    </div>
                    <div class="illustration">
                        <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa9036c251ba.jpg" alt="img13">
                    </div>
                </div>

                <div class="right-box-side">
                    <div class="real-box card-w1" style="background: #E9F7EF;">
                        <div class="real-content">
                            <div class="tag-box tag-bg3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M11.1997 2.19961C11.1997 2.04048 11.2629 1.88787 11.3755 1.77535C11.488 1.66282 11.6406 1.59961 11.7997 1.59961H13.7997C13.9589 1.59961 14.1115 1.66282 14.224 1.77535C14.3365 1.88787 14.3997 2.04048 14.3997 2.19961V4.19961C14.3997 4.35874 14.3365 4.51135 14.224 4.62387C14.1115 4.7364 13.9589 4.79961 13.7997 4.79961C13.6406 4.79961 13.488 4.7364 13.3755 4.62387C13.2629 4.51135 13.1997 4.35874 13.1997 4.19961V3.64761L9.62373 7.22361C9.51123 7.33597 9.35873 7.39908 9.19973 7.39908C9.04073 7.39908 8.88823 7.33597 8.77573 7.22361L6.79973 5.24761L3.42373 8.62361C3.3688 8.68256 3.30256 8.72984 3.22896 8.76263C3.15536 8.79543 3.07591 8.81306 2.99535 8.81448C2.91479 8.8159 2.83476 8.80108 2.76005 8.77091C2.68534 8.74073 2.61748 8.69581 2.5605 8.63884C2.50353 8.58186 2.45861 8.514 2.42843 8.43929C2.39826 8.36458 2.38344 8.28455 2.38486 8.20399C2.38628 8.12343 2.40391 8.04398 2.43671 7.97038C2.4695 7.89678 2.51678 7.83054 2.57573 7.77561L6.37573 3.97561C6.48823 3.86325 6.64073 3.80014 6.79973 3.80014C6.95873 3.80014 7.11123 3.86325 7.22373 3.97561L9.19973 5.95161L12.3517 2.79961H11.7997C11.6406 2.79961 11.488 2.7364 11.3755 2.62387C11.2629 2.51135 11.1997 2.35874 11.1997 2.19961ZM2.99973 11.1996C3.15886 11.1996 3.31147 11.2628 3.424 11.3753C3.53652 11.4879 3.59973 11.6405 3.59973 11.7996V13.7996C3.59973 13.9587 3.53652 14.1114 3.424 14.2239C3.31147 14.3364 3.15886 14.3996 2.99973 14.3996C2.8406 14.3996 2.68799 14.3364 2.57547 14.2239C2.46295 14.1114 2.39973 13.9587 2.39973 13.7996V11.7996C2.39973 11.6405 2.46295 11.4879 2.57547 11.3753C2.68799 11.2628 2.8406 11.1996 2.99973 11.1996ZM6.79973 9.39961C6.79973 9.24048 6.73652 9.08787 6.624 8.97535C6.51147 8.86282 6.35886 8.79961 6.19973 8.79961C6.0406 8.79961 5.88799 8.86282 5.77547 8.97535C5.66295 9.08787 5.59973 9.24048 5.59973 9.39961V13.7996C5.59973 13.9587 5.66295 14.1114 5.77547 14.2239C5.88799 14.3364 6.0406 14.3996 6.19973 14.3996C6.35886 14.3996 6.51147 14.3364 6.624 14.2239C6.73652 14.1114 6.79973 13.9587 6.79973 13.7996V9.39961ZM9.39973 10.3996C9.55886 10.3996 9.71147 10.4628 9.824 10.5753C9.93652 10.6879 9.99973 10.8405 9.99973 10.9996V13.7996C9.99973 13.9587 9.93652 14.1114 9.824 14.2239C9.71147 14.3364 9.55886 14.3996 9.39973 14.3996C9.2406 14.3996 9.08799 14.3364 8.97547 14.2239C8.86295 14.1114 8.79973 13.9587 8.79973 13.7996V10.9996C8.79973 10.8405 8.86295 10.6879 8.97547 10.5753C9.08799 10.4628 9.2406 10.3996 9.39973 10.3996ZM13.1997 7.79961C13.1997 7.64048 13.1365 7.48787 13.024 7.37535C12.9115 7.26282 12.7589 7.19961 12.5997 7.19961C12.4406 7.19961 12.288 7.26282 12.1755 7.37535C12.0629 7.48787 11.9997 7.64048 11.9997 7.79961V13.7996C11.9997 13.9587 12.0629 14.1114 12.1755 14.2239C12.288 14.3364 12.4406 14.3996 12.5997 14.3996C12.7589 14.3996 12.9115 14.3364 13.024 14.2239C13.1365 14.1114 13.1997 13.9587 13.1997 13.7996V7.79961Z" fill="#0B8B57"/>
                                </svg>
                                <span>Personal Development</span>
                            </div>
                            <h3>Prepare for better job interviews</h3>
                            <ul>
                                <li>Understand what employers look for</li>
                                <li>Research the company and role</li>
                                <li>Prepare for common questions</li>
                                <li>Practice answers beforehand</li>
                                <li>Highlight your skills and experience</li>
                                <li>Communicate your strengths clearly</li>
                                <li>Make a strong first impression</li>
                                <li>Build confidence before the interview</li>
                            </ul>
                        </div>
                        <div class="testmin">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa9038dc7a60.jpg" alt="img14">
                            <div>
                                <h4>Progess not perfection.</h4>
                                <p>- Lanxers</p>
                            </div>
                        </div>
                    </div>

                    <div class="right-box">
                        <div class="real-box card-w3" style="background: #EBEBFD;">
                            <div class="real-content">
                                <div class="tag-box tag-bg4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M11.1997 2.19961C11.1997 2.04048 11.2629 1.88787 11.3755 1.77535C11.488 1.66282 11.6406 1.59961 11.7997 1.59961H13.7997C13.9589 1.59961 14.1115 1.66282 14.224 1.77535C14.3365 1.88787 14.3997 2.04048 14.3997 2.19961V4.19961C14.3997 4.35874 14.3365 4.51135 14.224 4.62387C14.1115 4.7364 13.9589 4.79961 13.7997 4.79961C13.6406 4.79961 13.488 4.7364 13.3755 4.62387C13.2629 4.51135 13.1997 4.35874 13.1997 4.19961V3.64761L9.62373 7.22361C9.51123 7.33597 9.35873 7.39908 9.19973 7.39908C9.04073 7.39908 8.88823 7.33597 8.77573 7.22361L6.79973 5.24761L3.42373 8.62361C3.3688 8.68256 3.30256 8.72984 3.22896 8.76263C3.15536 8.79543 3.07591 8.81306 2.99535 8.81448C2.91479 8.8159 2.83476 8.80108 2.76005 8.77091C2.68534 8.74073 2.61748 8.69581 2.5605 8.63884C2.50353 8.58186 2.45861 8.514 2.42843 8.43929C2.39826 8.36458 2.38344 8.28455 2.38486 8.20399C2.38628 8.12343 2.40391 8.04398 2.43671 7.97038C2.4695 7.89678 2.51678 7.83054 2.57573 7.77561L6.37573 3.97561C6.48823 3.86325 6.64073 3.80014 6.79973 3.80014C6.95873 3.80014 7.11123 3.86325 7.22373 3.97561L9.19973 5.95161L12.3517 2.79961H11.7997C11.6406 2.79961 11.488 2.7364 11.3755 2.62387C11.2629 2.51135 11.1997 2.35874 11.1997 2.19961ZM2.99973 11.1996C3.15886 11.1996 3.31147 11.2628 3.424 11.3753C3.53652 11.4879 3.59973 11.6405 3.59973 11.7996V13.7996C3.59973 13.9587 3.53652 14.1114 3.424 14.2239C3.31147 14.3364 3.15886 14.3996 2.99973 14.3996C2.8406 14.3996 2.68799 14.3364 2.57547 14.2239C2.46295 14.1114 2.39973 13.9587 2.39973 13.7996V11.7996C2.39973 11.6405 2.46295 11.4879 2.57547 11.3753C2.68799 11.2628 2.8406 11.1996 2.99973 11.1996ZM6.79973 9.39961C6.79973 9.24048 6.73652 9.08787 6.624 8.97535C6.51147 8.86282 6.35886 8.79961 6.19973 8.79961C6.0406 8.79961 5.88799 8.86282 5.77547 8.97535C5.66295 9.08787 5.59973 9.24048 5.59973 9.39961V13.7996C5.59973 13.9587 5.66295 14.1114 5.77547 14.2239C5.88799 14.3364 6.0406 14.3996 6.19973 14.3996C6.35886 14.3996 6.51147 14.3364 6.624 14.2239C6.73652 14.1114 6.79973 13.9587 6.79973 13.7996V9.39961ZM9.39973 10.3996C9.55886 10.3996 9.71147 10.4628 9.824 10.5753C9.93652 10.6879 9.99973 10.8405 9.99973 10.9996V13.7996C9.99973 13.9587 9.93652 14.1114 9.824 14.2239C9.71147 14.3364 9.55886 14.3996 9.39973 14.3996C9.2406 14.3996 9.08799 14.3364 8.97547 14.2239C8.86295 14.1114 8.79973 13.9587 8.79973 13.7996V10.9996C8.79973 10.8405 8.86295 10.6879 8.97547 10.5753C9.08799 10.4628 9.2406 10.3996 9.39973 10.3996ZM13.1997 7.79961C13.1997 7.64048 13.1365 7.48787 13.024 7.37535C12.9115 7.26282 12.7589 7.19961 12.5997 7.19961C12.4406 7.19961 12.288 7.26282 12.1755 7.37535C12.0629 7.48787 11.9997 7.64048 11.9997 7.79961V13.7996C11.9997 13.9587 12.0629 14.1114 12.1755 14.2239C12.288 14.3364 12.4406 14.3996 12.5997 14.3996C12.7589 14.3996 12.9115 14.3364 13.024 14.2239C13.1365 14.1114 13.1997 13.9587 13.1997 13.7996V7.79961Z" fill="#3469F8"/>
                                    </svg>
                                    <span>Get Started</span>
                                </div>
                                <h3>Develop skills for career growth</h3>
                                <p>Develop your skills, stay competitive, and continue growing in your career.</p>
                            </div>
                            <div class="illustration1">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa903aaf0f25.jpg" alt="img15">
                            </div>
                        </div>
                        <div class="real-box card-w3" style="background: #181818;">
                            <div class="real-content">
                                <h3 style="color: #fff;margin-top: 0;">Make better <span style="color: #00A148;">career  decisions</span> <br> for your future.</h3>
                            </div>
                            <div class="illustration2">
                                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa903bebb0b7.jpg" alt="img16">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>    
    </div>
</section>
<!-- End Real Progres -->

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
            <h1>Curious about <span> Lanxers?</span></h1>
            <p>Find quick answers to the most common questions about Lanxers and how it works.</p>
        </div>

        <div class="gov-accordion-box">
            <div class="row">
                <div class="col-md-6">
                    <div class="accordion" id="faqLeft">
                        <div class="faq-item active">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn" type="button" data-bs-toggle="collapse" data-bs-target="#left1">
                                    <span class="faq-index">01</span>
                                    <span class="faq-question-text">How do I find opportunities?</span>
                                    <span class="faq-chevron">
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="left1" class="collapse show" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Browse available jobs, freelance projects, and internships based on your skills and interests. You can search by skill, job title, company, location, and other relevant criteria.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#left2">
                                <span class="faq-index">02</span>
                                <span class="faq-question-text">How do I apply?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="left2" class="collapse" data-bs-parent="#faqRight">
                                <div class="faq-answer-body">Find an opportunity that matches your skills and submit your application through Lanxers. Employers can then review your profile and application.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#left3">
                                <span class="faq-index">03</span>
                                <span class="faq-question-text">Can I apply for multiple opportunities?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="left3" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Yes. You can apply to multiple opportunities that match your skills and experience. Choose the ones that are relevant to your goals and apply directly.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#left4">
                                <span class="faq-index">04</span>
                                <span class="faq-question-text">How do employers evaluate talent?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="left4" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Employers can review the profiles of applicants, including their experience, skills, portfolio, and other relevant information. This helps them identify the right fit for their requirements.</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="accordion" id="faqRight">
                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right1">
                                <span class="faq-index">05</span>
                                <span class="faq-question-text">Is Lanxers free for talent?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right1" class="collapse" data-bs-parent="#faqRight">
                                <div class="faq-answer-body">Yes, talent can create a profile, explore opportunities, and apply to opportunities on Lanxers without platform fees.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right2">
                                <span class="faq-index">06</span>
                                <span class="faq-question-text">Can employers view my profile?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right2" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Employers can view your profile when you apply to their opportunities. They can use your profile and application to assess whether you’re a good fit.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right3">
                                <span class="faq-index">07</span>
                                <span class="faq-question-text">How will I know if I’m selected?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right3" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">You’ll be notified when an employer selects you for an opportunity, along with the relevant details and next steps.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right4">
                                <span class="faq-index">08</span>
                                <span class="faq-question-text">What happens if I’m not selected?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right4" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">You can continue exploring and applying to other opportunities that match your skills, experience, and interests. </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ===== Faw Wrapper Gov===== -->

<!-- Start CTA -->
<section class="cta">
    <div class="container-fluid">
        <div class="wrapper">
            <h6>Ready for your next career move?</h6>
            <a href="{{ route('jobseekers.find.work') }}">
                Find Opportunities
            </a>
        </div>
    </div>
</section>
<!-- End CTA -->

<script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>

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
    const userSlider = new Swiper("#swiperSlider", {
    loop: true,
    speed: 700,
    slidesPerView: "auto",

    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        pauseOnMouseEnter: false,
    },

});
</script>

@endsection