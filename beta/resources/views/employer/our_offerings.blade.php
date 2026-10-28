@extends('employer.layouts.main')

@section('main-section')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css" />

<link rel="stylesheet" href="{{ asset('frontend/css/homepage.css') }}?v={{ filemtime(public_path('frontend/css/homepage.css')) }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/offerings.css') }}?v={{ filemtime(public_path('frontend/css/offerings.css')) }}" />

<!-- Start Banner  -->
<section class="opport-banner">
    <img class="banner-leftimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa924ad89b14.jpg" alt="">
    <img class="banner-rightimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa924cf91616.jpg" alt="">
    <div class="container-fluid">

        <div class="heading">
            <h1>Post your requirement and meet the right talent for it</h1>
        </div>
        <div class="para">
            <p>Hire a freelancer for a specific project, a full-time professional for a long-term role,or an intern to support your team while gaining valuable experience.</p>
        </div>
        
        <div class="gif-img">
            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa925e8a5a89.jpg" alt="ima100">
            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa925fb025a0.jpg" alt="img101">
        </div>
        
        <div class="btn-box">
            <a href="{{ route('employer.post.job') }}">Post your requirements
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

    </div>
</section>
<!-- End Banner  -->

<!-- Start Hiring Lanxers -->
<section class="what-we-sec">
    <div class="container-fluid">
        <div class="header-top">
            <div class="heading">
                <!-- <div class="pills">
                    <span class="dot"></span>
                    <span>What we provide</span>
                </div> -->
                <h1>Hiring shouldn’t be this difficult</h1>
            </div>
            <div class="des">
                Too many platforms make hiring about finding someone who fits the basic requirements. The real challenge is finding the right person with the skills, experience, and potential to truly contribute to your business.
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
                    <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa9260e8e7b0.jpg" alt="img111">
                </div>
            </div>

            <div class="boxflexmini">
                <div class="card-box card-w1">
                    <div class="card-content">
                        <h4>02</h4>
                        <h3>Every type of hire means starting from scratch</h3>
                        <p>You often have to switch platforms, learn a new process, and start your search all over again.</p>
                    </div>
                    <div class="illustration1">
                        <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa900f20a7df.jpg" alt="">
                    </div>
                </div>

                <div class="card-box card-w1">
                    <div class="card-content">
                        <h4>03</h4>
                        <h3>You can't tell real skill from a well-written resume </h3>
                        <p>Anyone can list the right keywords. You don't find out if they can actually do the work until they're on payroll.</p>
                    </div>
                    <div class="illustration1">
                        <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa900f20a7df.jpg" alt="">
                    </div>
                </div>

                <div class="card-box card-w2">
                    <div class="card-content">
                        <h4>04</h4>
                        <h3>Too much time goes into finding the right application</h3>
                        <p>Instead of focusing on the best candidates, your time gets eaten up filtering out people who were never a good fit.</p>
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

<!--- Star Where Hiring --->
<section class="where-hiring">
    <div class="cicrule-box1"></div>
    <div class="cicrule-box2"></div>
    <div class="cicrule-box3"></div>
    <div class="cicrule-box4"></div>
    <div class="cicrule-box5"></div>
    <div class="cicrule-box6"></div>

    <div class="container-fluid">
        <div class="heading">
            <h1>This is where hiring gets <br>  <span>easier</span></h1>
            <p>Lanxers simplifies the hiring process by helping you find relevant candidates, understand their skills and experience, and choose the right talent for your business.</p>
        </div>

        <div class="getgrid">
            <div class="photo-wrap1">
                <img src="assets/images/kind-of-work.png" alt="">
            </div>

            <div class="col">
                <div class="card">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 4.375L33.125 9.375V21.875C33.125 27.5 28.125 33.125 20 35.625C11.875 33.125 6.875 28.125 6.875 21.875V9.375L20 4.375Z" stroke="#012F1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.375 19.375L18.125 23.125L25.625 14.375" stroke="#012F1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Look beyond rates and ratings</h3>
                    <p>Instead of relying on rates and ratings, review applicants through their skills, experience, portfolio, projects, and professional profile.</p>
                </div>
                <div class="card">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 4.375L33.125 9.375V21.875C33.125 27.5 28.125 33.125 20 35.625C11.875 33.125 6.875 28.125 6.875 21.875V9.375L20 4.375Z" stroke="#012F1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.375 19.375L18.125 23.125L25.625 14.375" stroke="#012F1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Spend less time filtering</h3>
                    <p>Lanxers uses your job requirements to help connect your opportunity with relevant talent, so you spend less time sorting through mismatched applications. 
                    </p>
                </div>
            </div>

            <div class="photo-wrap">
                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa92655a905e.jpg" alt="img200">
            </div>

            <div class="col">
                <div class="card">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M20 4.375L33.125 9.375V21.875C33.125 27.5 28.125 33.125 20 35.625C11.875 33.125 6.875 28.125 6.875 21.875V9.375L20 4.375Z" stroke="#012F1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.375 19.375L18.125 23.125L25.625 14.375" stroke="#012F1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3>See the skills behind the resume</h3>
                <p>Go beyond polished resumes with profiles that showcase real experience, skills, portfolios, and projects.</p>
                </div>
                <div class="card">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M20 4.375L33.125 9.375V21.875C33.125 27.5 28.125 33.125 20 35.625C11.875 33.125 6.875 28.125 6.875 21.875V9.375L20 4.375Z" stroke="#012F1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.375 19.375L18.125 23.125L25.625 14.375" stroke="#012F1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3>One platform for every hiring need</h3>
                <p>Whether you're looking for a freelancer, a full-time employee, or an intern, Lanxers brings all three hiring options together in one place.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--- End Where Hiring --->

<!-- Start Hiring Need -->
<section class="hiring-need" style="background: #F6F6F6;">
    <img class="leftimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f3e4ceb15.jpg" alt="img4">
    <img class="rightimg" src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f3ff83afc.jpg" alt="img5">

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
            <h1>Talent for your every <br>  <span>Hiring Need</span></h1>
            <p>Your hiring needs depend on what your business is trying to achieve. Choose the right model based on the role, the work, and the kind of talent you want to bring on board.</p>
        </div>

        <div class="swiper hiringSlider" id="swiperSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="price-card">
                        <div class="icon-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                <path d="M19.9693 4.35938L22.2842 7.60637L34 4.35938M7.79592 29.644L14.1341 23.4475L10.3204 19.3534M19.0088 4.35938L15.6216 7.41088L21.3194 7.62338M5.84233 4.36079L7.05642 6.85412L13.7629 7.27063M9.43075 17.2893L14.3848 8.04979L0 7.26921M10.0073 17.873L14.6866 22.8993L19.8475 17.8418L21.4483 8.41812L15.1597 8.09512L10.0073 17.873Z" fill="white"/>
                            </svg>
                        </div>
                        <h3>Freelancer</h3>
                        <div class="subtitle">Best for flexible project base work.</div>
                        <div class="divider"></div>
                        
                        <ul class="offers">
                            <div class="offers-label">What it offers:</div>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Specialized skills
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Project-based work
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Portfolio-led evaluation
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                No long-term commitment
                            </li>
                            
                        </ul>
                        <div class="price-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f4215cc7e.jpg" alt="">
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="price-card">
                        <div class="icon-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                <path d="M19.9693 4.35938L22.2842 7.60637L34 4.35938M7.79592 29.644L14.1341 23.4475L10.3204 19.3534M19.0088 4.35938L15.6216 7.41088L21.3194 7.62338M5.84233 4.36079L7.05642 6.85412L13.7629 7.27063M9.43075 17.2893L14.3848 8.04979L0 7.26921M10.0073 17.873L14.6866 22.8993L19.8475 17.8418L21.4483 8.41812L15.1597 8.09512L10.0073 17.873Z" fill="white"/>
                            </svg>
                        </div>
                        <h3>Full-time employees</h3>
                        <div class="subtitle">Best for long term goals</div>
                        <div class="divider"></div>
                        
                        <ul class="offers">
                            <div class="offers-label">What it offers:</div>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Long-term talent
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Role-specific expertise
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Experience-led evaluation
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Dedicated team members
                            </li>
                            
                        </ul>
                        <div class="price-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f4215cc7e.jpg" alt="">
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="price-card">
                        <div class="icon-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                <path d="M19.9693 4.35938L22.2842 7.60637L34 4.35938M7.79592 29.644L14.1341 23.4475L10.3204 19.3534M19.0088 4.35938L15.6216 7.41088L21.3194 7.62338M5.84233 4.36079L7.05642 6.85412L13.7629 7.27063M9.43075 17.2893L14.3848 8.04979L0 7.26921M10.0073 17.873L14.6866 22.8993L19.8475 17.8418L21.4483 8.41812L15.1597 8.09512L10.0073 17.873Z" fill="white"/>
                            </svg>
                        </div>
                        <h3>Interns</h3>
                        <div class="subtitle">Best for building future talent</div>
                        <div class="divider"></div>
                        
                        <ul class="offers">
                            <div class="offers-label">What it offers:</div>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Emerging talent
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Fresh perspectives
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Eager to learn
                            </li>

                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M14.2501 8.75279C13.7501 11.2528 11.8652 13.6064 9.2194 14.1327C6.57362 14.659 3.88874 13.4283 2.56037 11.0804C1.232 8.73256 1.55994 5.79733 3.37373 3.80051C5.18752 1.80368 8.25009 1.2528 10.7501 2.2528" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75L8.25 10.25L14.25 3.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Potential-driven hiring
                            </li>
                            
                        </ul>
                        <div class="price-img">
                            <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa8f4215cc7e.jpg" alt="">
                        </div>
                    </div>
                </div>

            </div>     
        </div>
    </div>
</section>
<!-- End Hiring Need -->

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
            <h1>Got Questions?<span> We’ve Got Answers</span></h1>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page</p>
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
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right1">
                                <span class="faq-index">02</span>
                                <span class="faq-question-text">How do I post an opportunity?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right1" class="collapse" data-bs-parent="#faqRight">
                                <div class="faq-answer-body">Create an opportunity by sharing your requirements, role details, and other relevant information. Once published, interested talent can discover and apply to it.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#left2">
                                <span class="faq-index">03</span>
                                <span class="faq-question-text">How do I find the right talent?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="left2" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">The right talent comes to you through applications to your posted opportunities. Review applicants based on their skills, experience, portfolio, and profile to shortlist the best fit.</div>
                            </div>
                        </div>

                        

                    </div>
                </div>

                <!-- Right column: separate, independent accordion -->
                <div class="col-md-6">
                    <div class="accordion" id="faqRight">
                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#right2">
                                <span class="faq-index">04</span>
                                <span class="faq-question-text">What can I see about applicants?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="right2" class="collapse" data-bs-parent="#faqRight">
                                <div class="faq-answer-body">You can view relevant information from applicants' profiles, including their skills, experience, portfolio, and other details they provide. This helps you make an informed hiring decision.</div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <h2 class="accordion-header">
                                <button class="faq-question-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#left3">
                                <span class="faq-index">05</span>
                                <span class="faq-question-text">Is Lanxers free for employers?</span>
                                <span class="faq-chevron">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                                </button>
                            </h2>
                            <div id="left3" class="collapse" data-bs-parent="#faqLeft">
                                <div class="faq-answer-body">Yes, posting opportunities and finding talent is completely free for employers.</div>
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
            <h6>Find freelancers who can help you build what's next</h6>
            <a href="{{ route('employer.post.job') }}">
                Explore Freelancers
            </a>
        </div>
    </div>
</section>
<!-- End CTA -->

<script src="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="{{ asset('frontend/js/homepage.js') }}?v={{ filemtime(public_path('frontend/js/homepage.js')) }}" />

<script>
    
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