@extends('employer.layouts.main')

@section('main-section')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css" />

<link rel="stylesheet" href="{{ asset('frontend/css/homepage.css') }}?v={{ filemtime(public_path('frontend/css/homepage.css')) }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/offerings.css') }}?v={{ filemtime(public_path('frontend/css/offerings.css')) }}" />

<!-- Start Banner  -->
<section class="howit-banner">
    <img class="banner-leftimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa924ad89b14.jpg" alt="">
    <img class="banner-rightimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa924cf91616.jpg" alt="">

    <div class="container-fluid">
        <div class="heading">
            <h1>A Simple <span>Step-by-Step</span> Process</h1>
        </div>
        <div class="para">
            <p>Understand the whole process and see how easy it is to find the right talent, from posting your requirement to making the right hire.</p>
        </div>
        
        <div class="real-result">
            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f3af49bbe.jpg" alt="img4">
        </div>

        <div class="steps-wrapper" id="stepsWrapper">
            <div class="step">
                <div class="step-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                    <path d="M13.334 2.92188L22.084 6.25521V14.5885C22.084 18.3385 18.7507 22.0885 13.334 23.7552C7.91732 22.0885 4.58398 18.7552 4.58398 14.5885V6.25521L13.334 2.92188Z" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.58398 12.9193L12.084 15.4193L17.084 9.58594" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="step-content">
                    <h3><span>01</span> Post your requirement</h3>
                    <p>Share the role, requirements, skills, & other details you’re looking for.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                    <path d="M13.334 2.92188L22.084 6.25521V14.5885C22.084 18.3385 18.7507 22.0885 13.334 23.7552C7.91732 22.0885 4.58398 18.7552 4.58398 14.5885V6.25521L13.334 2.92188Z" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.58398 12.9193L12.084 15.4193L17.084 9.58594" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="step-content">
                    <h3><span>02</span> Receive applications</h3>
                    <p>Get applications from candidates who are interested and match your requirements.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                    <path d="M13.334 2.92188L22.084 6.25521V14.5885C22.084 18.3385 18.7507 22.0885 13.334 23.7552C7.91732 22.0885 4.58398 18.7552 4.58398 14.5885V6.25521L13.334 2.92188Z" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.58398 12.9193L12.084 15.4193L17.084 9.58594" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="step-content">
                    <h3><span>03</span> Review candidates</h3>
                    <p>Review profiles, skills, experience, education, and portfolios to find the right fit.</p>
                </div>
            </div>

            <div class="step">
                <div class="step-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                    <path d="M13.334 2.92188L22.084 6.25521V14.5885C22.084 18.3385 18.7507 22.0885 13.334 23.7552C7.91732 22.0885 4.58398 18.7552 4.58398 14.5885V6.25521L13.334 2.92188Z" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.58398 12.9193L12.084 15.4193L17.084 9.58594" stroke="#00A148" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="step-content">
                    <h3><span>04</span> Select & get started</h3>
                    <p>Choose the candidate who best fits your needs and move forward with the hiring process.</p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End Banner  -->

<!-- Start Hiring Need -->
<section class="hiring-need">
    <img class="leftimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f3e4ceb15.jpg" alt="">
    <img class="rightimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f3ff83afc.jpg" alt="">

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
            <h1>Choose the <br>  <span>Right candidate</span></h1>
            <p>Use this simple checklist to evaluate applicants and find the candidate who best matches your requirements.</p>
        </div>

        <div class="swiper hiringSlider" id="swiperSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="opport-card">
                        <div class="icon-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.24956 5.46305V6.88305L5.55556 7.02105C4.97359 7.06789 4.42413 7.30851 3.99503 7.70443C3.56593 8.10036 3.28197 8.62872 3.18856 9.20505C3.14722 9.46305 3.10922 9.72139 3.07456 9.98005C3.06678 10.0426 3.07892 10.1061 3.10926 10.1614C3.1396 10.2167 3.18659 10.261 3.24356 10.2881L3.32056 10.3241C8.74956 12.8941 15.2506 12.8941 20.6786 10.3241L20.7556 10.2881C20.8123 10.2608 20.8591 10.2165 20.8893 10.1612C20.9194 10.1059 20.9314 10.0425 20.9236 9.98005C20.8896 9.72119 20.852 9.46283 20.8106 9.20505C20.7171 8.62872 20.4332 8.10036 20.0041 7.70443C19.575 7.30851 19.0255 7.06789 18.4436 7.02105L16.7496 6.88405V5.46405C16.7497 5.0449 16.5993 4.63964 16.3259 4.32197C16.0524 4.0043 15.6741 3.79533 15.2596 3.73305L14.0396 3.55005C12.6871 3.3479 11.312 3.3479 9.95956 3.55005L8.73956 3.73305C8.32523 3.7953 7.94699 4.00413 7.67357 4.32159C7.40015 4.63905 7.2497 5.04408 7.24956 5.46305ZM13.8166 5.03305C12.6119 4.85312 11.3872 4.85312 10.1826 5.03305L8.96256 5.21605C8.90337 5.22491 8.84932 5.25471 8.81023 5.30003C8.77115 5.34536 8.74962 5.4032 8.74956 5.46305V6.77805C10.9145 6.65441 13.0847 6.65441 15.2496 6.77805V5.46305C15.2495 5.4032 15.228 5.34536 15.1889 5.30003C15.1498 5.25471 15.0957 5.22491 15.0366 5.21605L13.8166 5.03305Z" fill="#00A148"/>
                                <path d="M21.1175 12.0706C21.1155 12.0382 21.1057 12.0069 21.0889 11.9792C21.0721 11.9515 21.0488 11.9283 21.0211 11.9115C20.9933 11.8948 20.962 11.8851 20.9296 11.8832C20.8973 11.8813 20.865 11.8872 20.8355 11.9006C15.2645 14.3676 8.73445 14.3676 3.16345 11.9006C3.13394 11.8872 3.10162 11.8813 3.06929 11.8832C3.03695 11.8851 3.00556 11.8948 2.97782 11.9115C2.95008 11.9283 2.92682 11.9515 2.91003 11.9792C2.89324 12.0069 2.88344 12.0382 2.88145 12.0706C2.78017 13.985 2.88309 15.9049 3.18845 17.7976C3.28166 18.3741 3.56553 18.9027 3.99465 19.2988C4.42377 19.6949 4.97334 19.9357 5.55545 19.9826L7.42745 20.1326C10.4705 20.3786 13.5275 20.3786 16.5715 20.1326L18.4435 19.9826C19.0256 19.9357 19.5751 19.6949 20.0043 19.2988C20.4334 18.9027 20.7172 18.3741 20.8105 17.7976C21.1165 15.9026 21.2205 13.9826 21.1175 12.0716" fill="#00A148"/>
                            </svg>
                        </div>
                        <h3>Check their <span>Skills &</span> Expertise</h3>
                        <div class="subtitle">Do they have the key skills and expertise required for the role or project, and can they meet the specific requirements you’ve outlined?</div>
                        
                        <div class="price-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f4215cc7e.jpg" alt="img11">
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="opport-card bg1">
                        <div class="nub-text">
                            275 +
                        </div>
                        
                        <div class="companies">
                            <h4>Review their experience</h4>
                            <p>Does their previous experience demonstrate that they can handle the responsibilities of the opportunity and contribute effectively?</p>
                        </div>
                        
                       
                        <div class="google-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa9009b38815.jpg" alt="img32">
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="opport-card">
                        <div class="icon-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.24956 5.46305V6.88305L5.55556 7.02105C4.97359 7.06789 4.42413 7.30851 3.99503 7.70443C3.56593 8.10036 3.28197 8.62872 3.18856 9.20505C3.14722 9.46305 3.10922 9.72139 3.07456 9.98005C3.06678 10.0426 3.07892 10.1061 3.10926 10.1614C3.1396 10.2167 3.18659 10.261 3.24356 10.2881L3.32056 10.3241C8.74956 12.8941 15.2506 12.8941 20.6786 10.3241L20.7556 10.2881C20.8123 10.2608 20.8591 10.2165 20.8893 10.1612C20.9194 10.1059 20.9314 10.0425 20.9236 9.98005C20.8896 9.72119 20.852 9.46283 20.8106 9.20505C20.7171 8.62872 20.4332 8.10036 20.0041 7.70443C19.575 7.30851 19.0255 7.06789 18.4436 7.02105L16.7496 6.88405V5.46405C16.7497 5.0449 16.5993 4.63964 16.3259 4.32197C16.0524 4.0043 15.6741 3.79533 15.2596 3.73305L14.0396 3.55005C12.6871 3.3479 11.312 3.3479 9.95956 3.55005L8.73956 3.73305C8.32523 3.7953 7.94699 4.00413 7.67357 4.32159C7.40015 4.63905 7.2497 5.04408 7.24956 5.46305ZM13.8166 5.03305C12.6119 4.85312 11.3872 4.85312 10.1826 5.03305L8.96256 5.21605C8.90337 5.22491 8.84932 5.25471 8.81023 5.30003C8.77115 5.34536 8.74962 5.4032 8.74956 5.46305V6.77805C10.9145 6.65441 13.0847 6.65441 15.2496 6.77805V5.46305C15.2495 5.4032 15.228 5.34536 15.1889 5.30003C15.1498 5.25471 15.0957 5.22491 15.0366 5.21605L13.8166 5.03305Z" fill="#00A148"/>
                                <path d="M21.1175 12.0706C21.1155 12.0382 21.1057 12.0069 21.0889 11.9792C21.0721 11.9515 21.0488 11.9283 21.0211 11.9115C20.9933 11.8948 20.962 11.8851 20.9296 11.8832C20.8973 11.8813 20.865 11.8872 20.8355 11.9006C15.2645 14.3676 8.73445 14.3676 3.16345 11.9006C3.13394 11.8872 3.10162 11.8813 3.06929 11.8832C3.03695 11.8851 3.00556 11.8948 2.97782 11.9115C2.95008 11.9283 2.92682 11.9515 2.91003 11.9792C2.89324 12.0069 2.88344 12.0382 2.88145 12.0706C2.78017 13.985 2.88309 15.9049 3.18845 17.7976C3.28166 18.3741 3.56553 18.9027 3.99465 19.2988C4.42377 19.6949 4.97334 19.9357 5.55545 19.9826L7.42745 20.1326C10.4705 20.3786 13.5275 20.3786 16.5715 20.1326L18.4435 19.9826C19.0256 19.9357 19.5751 19.6949 20.0043 19.2988C20.4334 18.9027 20.7172 18.3741 20.8105 17.7976C21.1165 15.9026 21.2205 13.9826 21.1175 12.0716" fill="#00A148"/>
                            </svg>
                        </div>
                        <h3>Look at their <span>Work &</span> Portfolio</h3>
                        <div class="subtitle">Review their portfolio, projects, or past work to see what they can actually deliver and whether their work meets your expectations.</div>
                        
                        <div class="price-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f4215cc7e.jpg" alt="img11">
                        </div>
                    </div>
                </div>

            </div>     
        </div>
    </div>
</section>
<!-- End Hiring Need -->

<!-- Start Hiring Lanxers -->
<section class="what-we-sec">
    <div class="container-fluid">
        <div class="header-top">
            <div class="heading">
                <!-- <div class="pills">
                    <span class="dot"></span>
                    <span>What we provide</span>
                </div> -->
                <h1>What Happens After You Post?</h1>
            </div>
            <div class="des">
               Here’s what happens next and what you can expect as your requirement moves through the process, from receiving applications to selecting the right candidate.
            </div>
        </div>
    
        <div class="boxflex">
            <div class="card-box bigcard">
                <div class="card-content">
                    <h4>01</h4>
                    <h3>Rates and ratings don't tell the whole story</h3>
                    <p>Rates and ratings become the easiest way to compare talent. But neither tells you what someone can actually do for your project.</p>
                </div>

                <div class="illustration">
                    <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa900dd663b0.jpg" alt="img9">
                </div>
            </div>

            <div class="boxflexmini">
                <div class="card-box card-w1">
                    <div class="card-content">
                        <h4>02</h4>
                        <h3>Candidates apply to your job posting</h3>
                        <p>Candidates explore your job posting and review your requirements to see if it matches what they’re looking for. </p>
                    </div>
                    <div class="illustration1">
                        <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa900f20a7df.jpg" alt="">
                    </div>
                </div>

                <div class="card-box card-w1">
                    <div class="card-content">
                        <h4>03</h4>
                        <h3>Interested candidates apply to your job posting </h3>
                        <p>Interested candidates who meet your requirements apply and share their profile with you.</p>
                    </div>
                    <div class="illustration1">
                        <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa900f20a7df.jpg" alt="">
                    </div>
                </div>

                <div class="card-box card-w2">
                    <div class="card-content">
                        <h4>04</h4>
                        <h3>Select and connect with the right candidates</h3>
                        <p>Review the candidates who apply, select the ones who best match your requirements, and connect with them to discuss the next steps.</p>
                    </div>
                    <div class="illustration">
                        <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa901160ea7d.jpg" alt="">
                    </div>
                </div>
            </div>

        </div>    
    </div>
</section>
<!-- End Hiring Lanxers -->


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
            <h1>Curious About <span> Lanxers?</span></h1>
            <p>Find quick answers to the most common questions about hiring talent and how Lanxers works.</p>
        </div>

        <div class="gov-accordion-box">
            <div class="row">
                <!-- Left column: independent accordion -->
                <div class="col-md-6">
                    <div class="accordion" id="faqLeft">
                        <div class="faq-item active">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn" type="button" data-bs-toggle="collapse" data-bs-target="#left1">
                                    <span class="faq-index">01</span>
                                    <span class="faq-question-text">How do I hire talent?</span>
                                    <span class="faq-chevron">
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="left1" class="collapse show" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Post your requirement on Lanxers and receive applications from relevant talent. You can review applicants' profiles, experience, and portfolios to find the right fit.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#left2">
                                <span class="faq-index">02</span>
                                <span class="faq-question-text">How do I post an opportunity?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="left2" class="collapse" data-bs-parent="#faqRight">
                                <div class="faq-answer-body">Create an opportunity by sharing your requirements, role details, and other relevant information. Once published, interested talent can discover and apply to it.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#left3">
                                <span class="faq-index">03</span>
                                <span class="faq-question-text">How do I find the right talent?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="left3" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">The right talent comes to you through applications to your posted opportunities. Review applicants based on their skills, experience, portfolio, and profile to shortlist the best fit.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#left4">
                                <span class="faq-index">04</span>
                                <span class="faq-question-text">What can I see about applicants?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="left4" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">You can view relevant information from applicants' profiles, including their skills, experience, portfolio, and other details they provide. This helps you make an informed hiring decision.</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right column: separate, independent accordion -->
                <div class="col-md-6">
                    <div class="accordion" id="faqRight">
                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right1">
                                <span class="faq-index">05</span>
                                <span class="faq-question-text">Is Lanxers free for employers?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right1" class="collapse" data-bs-parent="#faqRight">
                                <div class="faq-answer-body">Yes, posting opportunities and finding talent is completely free for employers.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right2">
                                <span class="faq-index">06</span>
                                <span class="faq-question-text">Can I contact applicants?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right2" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Yes. You can connect with applicants through Lanxers to discuss the opportunity, clarify requirements, and determine whether they’re the right fit.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right3">
                                <span class="faq-index">07</span>
                                <span class="faq-question-text">How do I select a candidate?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right3" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Review the applications and profiles you receive and select the candidate who best matches your requirements and expectations.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right4">
                                <span class="faq-index">08</span>
                                <span class="faq-question-text">Can I post more than one opportunity?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right4" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Yes. You can post multiple opportunities based on your hiring needs and receive applications for each one. </div>
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
            <h6>Ready to find the right talent?</h6>
            <a href="{{ route('employer.post.job') }}">
                Post your requirements
            </a>
        </div>
    </div>
</section>
<!-- End CTA -->

<script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="{{ asset('frontend/js/homepage.js') }}?v={{ filemtime(public_path('frontend/js/homepage.js')) }}" />



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
    const hiringSlider = new Swiper("#swiperSlider", {
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