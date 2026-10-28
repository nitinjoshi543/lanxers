@extends('freelancer.layouts.main')

@section('main-section')
    <link rel="stylesheet" href="https://lanxers.com/beta/public/frontend/css/find-job.css">
    <div class="topTitle">
        <div class="text">
            <h4>Find <span>Jobs</span></h4>
            <p>Internships, freelance projects and full-time jobs, matched to your skills.</p>
        </div>

        <form action="" method="">
            <div class="searchCompanies">
                <div class="form-group">
                    <input type="text" name="" id="" placeholder="Job Title, skill or Company">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M11.9872 12.8725C10.8639 13.7701 9.43948 14.2035 8.00656 14.0837C6.57365 13.9638 5.24101 13.2999 4.28236 12.2281C3.3237 11.1564 2.8118 9.7583 2.85179 8.32094C2.89178 6.88358 3.48062 5.51609 4.49738 4.49933C5.51414 3.48257 6.88163 2.89373 8.31899 2.85374C9.75635 2.81375 11.1545 3.32565 12.2262 4.28431C13.2979 5.24297 13.9619 6.5756 14.0817 8.00852C14.2015 9.44143 13.7682 10.8658 12.8706 11.9892L17.1672 16.285C17.2287 16.3423 17.2779 16.4113 17.3121 16.4879C17.3462 16.5646 17.3646 16.6473 17.3661 16.7313C17.3676 16.8152 17.3521 16.8985 17.3207 16.9764C17.2892 17.0542 17.2425 17.1249 17.1831 17.1842C17.1238 17.2436 17.0531 17.2904 16.9752 17.3218C16.8974 17.3532 16.8141 17.3687 16.7301 17.3672C16.6462 17.3657 16.5635 17.3473 16.4868 17.3132C16.4101 17.279 16.3411 17.2298 16.2839 17.1684L11.9872 12.8725ZM5.38308 11.5709C4.77145 10.9592 4.35488 10.1799 4.18601 9.33151C4.01714 8.48313 4.10356 7.60373 4.43434 6.80445C4.76512 6.00517 5.32542 5.32189 6.04443 4.84095C6.76343 4.36002 7.60887 4.10302 8.47389 4.10244C9.33891 4.10186 10.1847 4.35772 10.9043 4.83768C11.624 5.31765 12.1852 6.00018 12.5171 6.79901C12.8489 7.59785 12.9365 8.47713 12.7688 9.32574C12.6011 10.1743 12.1856 10.9542 11.5747 11.5667L11.5706 11.5709L11.5664 11.5742C10.7457 12.3931 9.63344 12.8526 8.47406 12.852C7.31468 12.8514 6.20296 12.3906 5.38308 11.5709Z"
                            fill-rule="evenodd" clip-rule="evenodd" fill="#00A148" />
                    </svg>
                </div>
                <span class="line"></span>

                <div class="form-group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M12.5 8.33203C12.5 9.71274 11.3807 10.832 10 10.832C8.61929 10.832 7.5 9.71274 7.5 8.33203C7.5 6.95132 8.61929 5.83203 10 5.83203C11.3807 5.83203 12.5 6.95132 12.5 8.33203Z"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#00A148" />
                        <path
                            d="M9.99967 1.66602C8.23156 1.66602 6.53587 2.36839 5.28563 3.61864C4.03539 4.86888 3.33301 6.56457 3.33301 8.33268C3.33301 9.90935 3.66801 10.941 4.58301 12.0827L9.99967 18.3327L15.4163 12.0827C16.3313 10.941 16.6663 9.90935 16.6663 8.33268C16.6663 6.56457 15.964 4.86888 14.7137 3.61864C13.4635 2.36839 11.7678 1.66602 9.99967 1.66602Z"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#00A148" />
                    </svg>
                    <input type="text" name="" id="" placeholder="City or remote">

                </div>
                <button type="button" class="search">Search</button>
            </div>
        </form>
    </div>

    <section class="jobPosted">
        <button type="button" class="filterShowDetails" id="filterShowDetails">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path
                    d="M26.5625 14.9994H11.1188M5.6675 14.9994H3.4375M5.6675 14.9994C5.6675 14.2767 5.9546 13.5835 6.46563 13.0725C6.97667 12.5615 7.66979 12.2744 8.3925 12.2744C9.11522 12.2744 9.80833 12.5615 10.3194 13.0725C10.8304 13.5835 11.1175 14.2767 11.1175 14.9994C11.1175 15.7221 10.8304 16.4152 10.3194 16.9262C9.80833 17.4373 9.11522 17.7244 8.3925 17.7244C7.66979 17.7244 6.97667 17.4373 6.46563 16.9262C5.9546 16.4152 5.6675 15.7221 5.6675 14.9994ZM26.5625 23.2581H19.3775M19.3775 23.2581C19.3775 23.981 19.0897 24.6749 18.5786 25.1861C18.0674 25.6972 17.3741 25.9844 16.6513 25.9844C15.9285 25.9844 15.2354 25.696 14.7244 25.185C14.2133 24.674 13.9262 23.9808 13.9262 23.2581M19.3775 23.2581C19.3775 22.5352 19.0897 21.8426 18.5786 21.3314C18.0674 20.8203 17.3741 20.5331 16.6513 20.5331C15.9285 20.5331 15.2354 20.8202 14.7244 21.3313C14.2133 21.8423 13.9262 22.5354 13.9262 23.2581M13.9262 23.2581H3.4375M26.5625 6.74063H22.6813M17.23 6.74063H3.4375M17.23 6.74063C17.23 6.01791 17.5171 5.3248 18.0281 4.81376C18.5392 4.30272 19.2323 4.01563 19.955 4.01563C20.3129 4.01562 20.6672 4.08611 20.9978 4.22305C21.3284 4.36 21.6288 4.56072 21.8819 4.81376C22.1349 5.0668 22.3356 5.3672 22.4726 5.69781C22.6095 6.02842 22.68 6.38277 22.68 6.74063C22.68 7.09848 22.6095 7.45283 22.4726 7.78344C22.3356 8.11405 22.1349 8.41445 21.8819 8.66749C21.6288 8.92053 21.3284 9.12125 20.9978 9.2582C20.6672 9.39514 20.3129 9.46562 19.955 9.46562C19.2323 9.46562 18.5392 9.17853 18.0281 8.66749C17.5171 8.15645 17.23 7.46334 17.23 6.74063Z"
                    stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
            </svg>
            <span>2</span>
            Filters
        </button>

        <div class="filterDetails">
            <div class="allFilter">
                <div class="text">
                    <p>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path
                                    d="M15.9375 9.00041H6.67125M3.4005 9.00041H2.0625M3.4005 9.00041C3.4005 8.56678 3.57276 8.15091 3.87938 7.84429C4.186 7.53766 4.60187 7.36541 5.0355 7.36541C5.46913 7.36541 5.885 7.53766 6.19162 7.84429C6.49824 8.15091 6.6705 8.56678 6.6705 9.00041C6.6705 9.43404 6.49824 9.8499 6.19162 10.1565C5.885 10.4631 5.46913 10.6354 5.0355 10.6354C4.60187 10.6354 4.186 10.4631 3.87938 10.1565C3.57276 9.8499 3.4005 9.43404 3.4005 9.00041ZM15.9375 13.9557H11.6265M11.6265 13.9557C11.6265 14.3894 11.4538 14.8057 11.1471 15.1124C10.8404 15.4191 10.4245 15.5914 9.99075 15.5914C9.55712 15.5914 9.14125 15.4184 8.83463 15.1118C8.52801 14.8052 8.35575 14.3893 8.35575 13.9557M11.6265 13.9557C11.6265 13.5219 11.4538 13.1063 11.1471 12.7996C10.8404 12.493 10.4245 12.3207 9.99075 12.3207C9.55712 12.3207 9.14125 12.4929 8.83463 12.7995C8.52801 13.1062 8.35575 13.522 8.35575 13.9557M8.35575 13.9557H2.0625M15.9375 4.04516H13.6088M10.338 4.04516H2.0625M10.338 4.04516C10.338 3.61153 10.5103 3.19566 10.8169 2.88904C11.1235 2.58241 11.5394 2.41016 11.973 2.41016C12.1877 2.41016 12.4003 2.45245 12.5987 2.53461C12.7971 2.61678 12.9773 2.73721 13.1291 2.88904C13.2809 3.04086 13.4014 3.2211 13.4835 3.41947C13.5657 3.61784 13.608 3.83045 13.608 4.04516C13.608 4.25987 13.5657 4.47248 13.4835 4.67084C13.4014 4.86921 13.2809 5.04945 13.1291 5.20128C12.9773 5.3531 12.7971 5.47353 12.5987 5.5557C12.4003 5.63787 12.1877 5.68016 11.973 5.68016C11.5394 5.68016 11.1235 5.5079 10.8169 5.20128C10.5103 4.89465 10.338 4.47879 10.338 4.04516Z"
                                    stroke="#00A148" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                            </svg>
                        </span>
                        Filter
                    </p>
                    <button type="button" class="resetAll">Reset all</button>
                </div>
            </div>

            <div class="accordion" id="accordionExample">


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Job type
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="skill-filter">
                                <div class="skill-list" id="jobType">
                                    <label class="skill-item">
                                        <input type="radio" name="skills" value="114">
                                        <span class="checkmark"></span>
                                        <span class="skill-name">All jobs</span>
                                        <span class="count">6</span>
                                    </label>

                                    <label class="skill-item">
                                        <input type="radio" name="skills" value="116">
                                        <span class="checkmark"></span>
                                        <span class="skill-name">Full-Time</span>
                                        <span class="count">6</span>
                                    </label>

                                    <label class="skill-item">
                                        <input type="radio" name="skills" value="112">
                                        <span class="checkmark"></span>
                                        <span class="skill-name">Internship</span>
                                        <span class="count">6</span>
                                    </label>

                                    <label class="skill-item">
                                        <input type="radio" name="skills" value="112">
                                        <span class="checkmark"></span>
                                        <span class="skill-name">Freelance</span>
                                        <span class="count">6</span>
                                    </label>

                                    <!-- Baaki sabhi skill items mein bhi same change karein -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseJobLocation" aria-expanded="true" aria-controls="collapseJobLocation">
                            work mode
                        </button>
                    </h2>

                    <div id="collapseJobLocation" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="skill-filter">
                                <div class="skill-list" id="locationTypeList">
                                    <label class="skill-item">
                                        <input type="checkbox" name="location_type[]" value="onsite">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Onsite</span>
                                    </label>
                                    <label class="skill-item">
                                        <input type="checkbox" name="location_type[]" value="hybrid">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Hybrid</span>
                                    </label>
                                    <label class="skill-item">
                                        <input type="checkbox" name="location_type[]" value="onsite">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Remote</span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Experience
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <input type="text" id="experienceValue" hidden>
                            <ul>
                                <li>Fresher</li>
                                <li>1-3 yrs</li>
                                <li>3-5 yrs</li>
                                <li>5+ yrs</li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseLocationType" aria-expanded="true"
                            aria-controls="collapseLocationType">
                            Skills
                        </button>
                    </h2>

                    <div id="collapseLocationType" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="skill-filter">
                                <div class="search-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                            stroke="#0BA84A" stroke-width="2" />
                                        <path d="M21 21L17 17" stroke="#0BA84A" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                    <input type="text" id="skillSearch" placeholder="Search Skill">
                                </div>

                            </div>
                            <div class="skill-filter">
                                <div class="skill-list" id="skillTypeList">
                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> B2B-sales</span>

                                    </label>
                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Lead Generation</span>
                                    </label>

                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Excel</span>
                                    </label>

                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> B2B-sales</span>

                                    </label>
                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Lead Generation</span>
                                    </label>

                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Excel</span>
                                    </label>

                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> B2B-sales</span>

                                    </label>
                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Lead Generation</span>
                                    </label>

                                    <label class="skill-item">
                                        <input type="checkbox" name="" value="">
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> Excel</span>
                                    </label>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <button type="button" class="filterHideDetails" id="filterHideDetails">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <g clip-path="url(#clip0_796_7599)">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.8839 19.6344C15.6495 19.8688 15.3316 20.0004 15.0002 20.0004C14.6687 20.0004 14.3508 19.8688 14.1164 19.6344L7.04518 12.5632C6.9258 12.4479 6.83057 12.3099 6.76506 12.1574C6.69955 12.0049 6.66506 11.8409 6.66362 11.6749C6.66218 11.509 6.69381 11.3444 6.75666 11.1907C6.81951 11.0371 6.91233 10.8975 7.02969 10.7802C7.14706 10.6628 7.28662 10.57 7.44024 10.5071C7.59386 10.4443 7.75846 10.4127 7.92444 10.4141C8.09041 10.4156 8.25443 10.45 8.40694 10.5155C8.55944 10.5811 8.69738 10.6763 8.81268 10.7957L15.0002 16.9832L21.1877 10.7957C21.4234 10.568 21.7392 10.442 22.0669 10.4448C22.3947 10.4477 22.7082 10.5791 22.94 10.8109C23.1717 11.0427 23.3032 11.3562 23.306 11.6839C23.3089 12.0117 23.1829 12.3274 22.9552 12.5632L15.8839 19.6344Z"
                            fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_796_7599">
                            <rect width="30" height="30" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </button>
        </div>

        <div class="jobflex">
            <div class="joblist-section">

                <div class="list-panel" id="listPanel">

                    <div id="jobListWrap" style="position:relative;">
                        <div id="jobList">
                            <div class="job-card active" data-job-id="87" data-date="2026-10-13 11:28:31"
                                data-title="Video Editor" data-employer="Build Your Own Brand by IDP"
                                data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">VIDEO EDITOR</p>
                                        <p class="job-company">Build Your Own Brand by IDP</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="86" data-date="2026-10-13 11:22:36"
                                data-title="Customer Support Executive" data-employer="Build Your Own Brand by IDP"
                                data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">CUSTOMER SUPPORT EXECUTIVE</p>
                                        <p class="job-company">Build Your Own Brand by IDP</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="85" data-date="2026-10-13 11:19:07"
                                data-title="Graphic Designer" data-employer="Build Your Own Brand by IDP"
                                data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">GRAPHIC DESIGNER</p>
                                        <p class="job-company">Build Your Own Brand by IDP</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="84" data-date="2026-10-13 11:15:14"
                                data-title="Sales Development Executive" data-employer="Build Your Own Brand by IDP"
                                data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">SALES DEVELOPMENT EXECUTIVE</p>
                                        <p class="job-company">Build Your Own Brand by IDP</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">

                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="83" data-date="2026-10-13 11:11:54"
                                data-title="Market Research Analyst" data-employer="Build Your Own Brand by IDP"
                                data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">MARKET RESEARCH ANALYST</p>
                                        <p class="job-company">Build Your Own Brand by IDP</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="82" data-date="2026-10-12 13:53:29"
                                data-title="Social Media Manager" data-employer="Trivaidh" data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">SOCIAL MEDIA MANAGER</p>
                                        <p class="job-company">Trivaidh</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="81" data-date="2026-10-12 13:45:52" data-title="Data Analyst"
                                data-employer="Trivaidh" data-location="hybrid">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">DATA ANALYST</p>
                                        <p class="job-company">Trivaidh</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="80" data-date="2026-10-12 13:41:35"
                                data-title="Business Development Executive" data-employer="Trivaidh" data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">BUSINESS DEVELOPMENT EXECUTIVE</p>
                                        <p class="job-company">Trivaidh</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="79" data-date="2026-10-12 13:36:38"
                                data-title="Customer Support Executive" data-employer="Trivaidh" data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">CUSTOMER SUPPORT EXECUTIVE</p>
                                        <p class="job-company">Trivaidh</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">

                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                            <div class="job-card" data-job-id="78" data-date="2026-10-12 13:32:53"
                                data-title="Content Writer &amp; Copywriter" data-employer="Trivaidh"
                                data-location="onsite">
                                <div class="job-card-top">
                                    <div class="job-thumb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                            <path d="M10 6h4"></path>
                                            <path d="M10 10h4"></path>
                                            <path d="M10 14h4"></path>
                                            <path d="M10 18h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="job-title">CONTENT WRITER &amp; COPYWRITER</p>
                                        <p class="job-company">Trivaidh</p>
                                    </div>

                                    <span class="match-pill">2d ago</span>
                                </div>
                                <div class="job-meta">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                            fill="none">
                                            <path
                                                d="M5.84375 5.3125C5.70285 5.3125 5.56773 5.36847 5.4681 5.4681C5.36847 5.56773 5.3125 5.70285 5.3125 5.84375V7.96875C5.3125 8.10965 5.36847 8.24477 5.4681 8.3444C5.56773 8.44403 5.70285 8.5 5.84375 8.5H11.1562C11.2971 8.5 11.4323 8.44403 11.5319 8.3444C11.6315 8.24477 11.6875 8.10965 11.6875 7.96875V5.84375C11.6875 5.70285 11.6315 5.56773 11.5319 5.4681C11.4323 5.36847 11.2971 5.3125 11.1562 5.3125H5.84375ZM6.375 7.4375V6.375H10.625V7.4375H6.375ZM4.78125 2.125C4.07677 2.125 3.40114 2.40485 2.903 2.903C2.40485 3.40114 2.125 4.07677 2.125 4.78125V12.2188C2.125 12.9232 2.40485 13.5989 2.903 14.097C3.40114 14.5951 4.07677 14.875 4.78125 14.875H12.2188C12.9232 14.875 13.5989 14.5951 14.097 14.097C14.5951 13.5989 14.875 12.9232 14.875 12.2188V4.78125C14.875 4.07677 14.5951 3.40114 14.097 2.903C13.5989 2.40485 12.9232 2.125 12.2188 2.125H4.78125ZM3.1875 4.78125C3.1875 4.35856 3.35541 3.95318 3.6543 3.6543C3.95318 3.35541 4.35856 3.1875 4.78125 3.1875H12.2188C12.6414 3.1875 13.0468 3.35541 13.3457 3.6543C13.6446 3.95318 13.8125 4.35856 13.8125 4.78125V12.2188C13.8125 12.6414 13.6446 13.0468 13.3457 13.3457C13.0468 13.6446 12.6414 13.8125 12.2188 13.8125H4.78125C4.35856 13.8125 3.95318 13.6446 3.6543 13.3457C3.35541 13.0468 3.1875 12.6414 3.1875 12.2188V4.78125Z"
                                                fill="#363636" />
                                        </svg>
                                        FULL TIME
                                    </span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3">
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                            </path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        DELHI
                                    </span>


                                </div>
                            </div>
                        </div>
                        <div id="listLoader" class="js-loader" style="display:none;">
                            <div class="infinite-loader">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                        <div id="loadMoreTrigger"></div>
                    </div>
                </div>


                <div class="detail-panel bottom-sheet show" id="detailPanel">
                    <!-- <button class="mobile-back" id="backBtn"><i class="bi bi-arrow-left"></i> Back to listings</button> -->

                    <div id="jobDetailWrap" style="position:relative;">
                        <div id="jobDetailContainer">
                            <div class="job-detail" id="job-87" style="display:block;">

                                <div class="hero-card">
                                    <div class="abtJob">
                                        <div class="jobInfo">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    viewBox="0 0 30 30" fill="none">
                                                    <path
                                                        d="M10.125 9.75C10.4234 9.75 10.7095 9.63147 10.9205 9.4205C11.1315 9.20952 11.25 8.92337 11.25 8.625C11.25 8.32663 11.1315 8.04048 10.9205 7.8295C10.7095 7.61853 10.4234 7.5 10.125 7.5C9.82663 7.5 9.54048 7.61853 9.3295 7.8295C9.11853 8.04048 9 8.32663 9 8.625C9 8.92337 9.11853 9.20952 9.3295 9.4205C9.54048 9.63147 9.82663 9.75 10.125 9.75ZM11.25 13.125C11.25 13.4234 11.1315 13.7095 10.9205 13.9205C10.7095 14.1315 10.4234 14.25 10.125 14.25C9.82663 14.25 9.54048 14.1315 9.3295 13.9205C9.11853 13.7095 9 13.4234 9 13.125C9 12.8266 9.11853 12.5405 9.3295 12.3295C9.54048 12.1185 9.82663 12 10.125 12C10.4234 12 10.7095 12.1185 10.9205 12.3295C11.1315 12.5405 11.25 12.8266 11.25 13.125ZM10.125 18.75C10.2727 18.75 10.419 18.7209 10.5555 18.6644C10.692 18.6078 10.816 18.525 10.9205 18.4205C11.025 18.316 11.1078 18.192 11.1644 18.0555C11.2209 17.919 11.25 17.7727 11.25 17.625C11.25 17.4773 11.2209 17.331 11.1644 17.1945C11.1078 17.058 11.025 16.934 10.9205 16.8295C10.816 16.725 10.692 16.6422 10.5555 16.5856C10.419 16.5291 10.2727 16.5 10.125 16.5C9.82663 16.5 9.54048 16.6185 9.3295 16.8295C9.11853 17.0405 9 17.3266 9 17.625C9 17.9234 9.11853 18.2095 9.3295 18.4205C9.54048 18.6315 9.82663 18.75 10.125 18.75ZM15.75 8.625C15.75 8.92337 15.6315 9.20952 15.4205 9.4205C15.2095 9.63147 14.9234 9.75 14.625 9.75C14.3266 9.75 14.0405 9.63147 13.8295 9.4205C13.6185 9.20952 13.5 8.92337 13.5 8.625C13.5 8.32663 13.6185 8.04048 13.8295 7.8295C14.0405 7.61853 14.3266 7.5 14.625 7.5C14.9234 7.5 15.2095 7.61853 15.4205 7.8295C15.6315 8.04048 15.75 8.32663 15.75 8.625ZM14.625 14.25C14.9234 14.25 15.2095 14.1315 15.4205 13.9205C15.6315 13.7095 15.75 13.4234 15.75 13.125C15.75 12.8266 15.6315 12.5405 15.4205 12.3295C15.2095 12.1185 14.9234 12 14.625 12C14.3266 12 14.0405 12.1185 13.8295 12.3295C13.6185 12.5405 13.5 12.8266 13.5 13.125C13.5 13.4234 13.6185 13.7095 13.8295 13.9205C14.0405 14.1315 14.3266 14.25 14.625 14.25ZM15.75 17.625C15.75 17.9234 15.6315 18.2095 15.4205 18.4205C15.2095 18.6315 14.9234 18.75 14.625 18.75C14.3266 18.75 14.0405 18.6315 13.8295 18.4205C13.6185 18.2095 13.5 17.9234 13.5 17.625C13.5 17.3266 13.6185 17.0405 13.8295 16.8295C14.0405 16.6185 14.3266 16.5 14.625 16.5C14.9234 16.5 15.2095 16.6185 15.4205 16.8295C15.6315 17.0405 15.75 17.3266 15.75 17.625ZM19.125 18.75C19.2727 18.75 19.419 18.7209 19.5555 18.6644C19.692 18.6078 19.816 18.525 19.9205 18.4205C20.025 18.316 20.1078 18.192 20.1644 18.0555C20.2209 17.919 20.25 17.7727 20.25 17.625C20.25 17.4773 20.2209 17.331 20.1644 17.1945C20.1078 17.058 20.025 16.934 19.9205 16.8295C19.816 16.725 19.692 16.6422 19.5555 16.5856C19.419 16.5291 19.2727 16.5 19.125 16.5C18.8266 16.5 18.5405 16.6185 18.3295 16.8295C18.1185 17.0405 18 17.3266 18 17.625C18 17.9234 18.1185 18.2095 18.3295 18.4205C18.5405 18.6315 18.8266 18.75 19.125 18.75ZM6.75 27C6.55109 27 6.36032 26.921 6.21967 26.7803C6.07902 26.6397 6 26.4489 6 26.25V5.25C6 4.65326 6.23705 4.08097 6.65901 3.65901C7.08097 3.23705 7.65326 3 8.25 3H17.25C17.8467 3 18.419 3.23705 18.841 3.65901C19.2629 4.08097 19.5 4.65326 19.5 5.25V12H21.75C22.3467 12 22.919 12.2371 23.341 12.659C23.7629 13.081 24 13.6533 24 14.25V26.25C24 26.4489 23.921 26.6397 23.7803 26.7803C23.6397 26.921 23.4489 27 23.25 27H6.75ZM7.5 5.25V25.5H10.5V21.75C10.5 21.5511 10.579 21.3603 10.7197 21.2197C10.8603 21.079 11.0511 21 11.25 21H18.75C18.9489 21 19.1397 21.079 19.2803 21.2197C19.421 21.3603 19.5 21.5511 19.5 21.75V25.5H22.5V14.25C22.5 14.0511 22.421 13.8603 22.2803 13.7197C22.1397 13.579 21.9489 13.5 21.75 13.5H18.75C18.5511 13.5 18.3603 13.421 18.2197 13.2803C18.079 13.1397 18 12.9489 18 12.75V5.25C18 5.05109 17.921 4.86032 17.7803 4.71967C17.6397 4.57902 17.4489 4.5 17.25 4.5H8.25C8.05109 4.5 7.86032 4.57902 7.71967 4.71967C7.57902 4.86032 7.5 5.05109 7.5 5.25ZM18 22.5H15.75V25.5H18V22.5ZM14.25 22.5H12V25.5H14.25V22.5Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <div class="text">
                                                <h4>Video Editor</h4>
                                                <h5>Build your Own Brand by IDP</h5>
                                                <p>Posted 2 days ago. <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16" fill="none">
                                                            <path
                                                                d="M5.78125 4H12.7188C13.7025 4 14.5 4.79749 14.5 5.78125V12.7188C14.5 13.7025 13.7025 14.5 12.7188 14.5H5.78125C4.79749 14.5 4 13.7025 4 12.7188V5.78125C4 4.79749 4.79749 4 5.78125 4Z"
                                                                stroke-linejoin="round" stroke="#00A148" />
                                                            <path
                                                                d="M11.9844 4L12 3.25C11.9987 2.78628 11.8139 2.34192 11.486 2.01402C11.1581 1.68612 10.7137 1.50132 10.25 1.5H3.5C2.97005 1.50157 2.46225 1.71278 2.08752 2.08752C1.71278 2.46225 1.50157 2.97005 1.5 3.5V10.25C1.50132 10.7137 1.68612 11.1581 2.01402 11.486C2.34192 11.8139 2.78628 11.9987 3.25 12H4"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke="#00A148" />
                                                        </svg></span></p>
                                            </div>
                                        </div>

                                        <div class="directions">
                                            <button type="button" class="aplNOw">Apply Now
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10"
                                                    viewBox="0 0 13 10" fill="none">
                                                    <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke="white" />
                                                </svg>
                                            </button>

                                            <button type="button" class="saveJOb">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M3.00033 4.0874C2.79366 4.2074 2.66699 4.4274 2.66699 4.6674L2.66699 14.0007C2.66699 14.2407 2.79366 14.4607 3.00033 14.5741C3.20699 14.6941 3.46033 14.6941 3.66699 14.5741L8.00033 12.0941L12.3337 14.5741C12.4347 14.6324 12.5493 14.6632 12.666 14.6634C12.7827 14.6636 12.8974 14.6331 12.9986 14.5751C13.0998 14.517 13.184 14.4334 13.2428 14.3327C13.3016 14.2319 13.333 14.1174 13.3337 14.0007L13.3337 4.6674C13.3337 4.4274 13.207 4.2074 13.0003 4.0874L8.33366 1.42073C8.12699 1.30073 7.88033 1.30073 7.67366 1.42073L3.00699 4.0874L3.00033 4.0874ZM12.0003 5.05406L12.0003 12.8541L8.33366 10.7541C8.12699 10.6341 7.88033 10.6341 7.67366 10.7541L4.00699 12.8541L4.00699 5.05406L8.00699 2.7674L12.007 5.05406L12.0003 5.05406Z"
                                                        fill="#5E5E5E" />
                                                </svg>
                                                Save</button>

                                        </div>
                                    </div>
                                </div>

                                <div class="details-card quickinfo-card">
                                    <!-- <div class="section-heading">
                                            <div class="title-bar">
                                                <span class="dot-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-briefcase w-3.5 h-3.5 text-brand-600">
                                                        <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                                        <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                                                    </svg>
                                                </span> Quick Info
                                            </div>
                                        </div> -->
                                    <div class="qi-grid">
                                        <div class="qi-box">
                                            <div class="qi-label">Experience</div>
                                            <div class="qi-value">2 - 3 YEARS</div>
                                        </div>
                                        <div class="qi-box">
                                            <div class="qi-label">Job Type</div>
                                            <div class="qi-value">FULL TIME</div>
                                        </div>
                                        <div class="qi-box">
                                            <div class="qi-label">Work Mode</div>
                                            <div class="qi-value">ONSITE</div>
                                        </div>
                                        <div class="qi-box">
                                            <div class="qi-label">Budget</div>
                                            <div class="qi-value">
                                                NOT DISCLOSED
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="details-card content-card read-more-card">
                                    <div class="seeOverView">
                                        <div class="section-heading">
                                            <div class="title-bar">
                                                <span class="dot-icon bg-blue">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20" fill="none">
                                                        <g clip-path="url(#clip0_8226_21145)">
                                                            <path
                                                                d="M17.5276 17.3581C17.9342 17.121 18.2801 16.7925 18.5378 16.3987C18.7956 16.0048 18.9581 15.5564 19.0126 15.0889C19.1257 14.1734 18.9568 13.2451 18.5285 12.4281C18.1326 11.6746 17.5155 11.0603 16.7601 10.6681C15.9846 10.2839 15.0981 10.1865 14.2576 10.3931C13.5645 10.541 12.8999 10.7999 12.2893 11.1597C11.8643 11.4164 11.491 11.7506 11.1885 12.1447C10.8807 12.5963 10.6668 13.1051 10.5593 13.6409C10.4518 14.1766 10.4529 14.7286 10.5626 15.2639C10.6435 15.7993 10.8417 16.3103 11.1431 16.7602C11.4445 17.2101 11.8416 17.5878 12.306 17.8664C12.8207 18.1368 13.3929 18.2797 13.9743 18.2831C14.7909 18.2876 15.6035 18.1696 16.3851 17.9331C16.4137 17.9281 16.4406 17.9165 16.4638 17.8991C16.487 17.8817 16.5057 17.8591 16.5185 17.8331C16.6268 18.0747 16.7268 18.3081 16.8601 18.5414C16.9285 18.6725 17.009 18.795 17.1018 18.9089C17.1851 19.0172 17.2851 19.1256 17.3851 19.2339C17.6185 19.4756 17.8776 19.6931 18.1368 19.9264C18.1678 19.9555 18.2052 19.9768 18.2461 19.9884C18.2869 20.0001 18.3299 20.0019 18.3716 19.9936C18.4133 19.9853 18.4523 19.9671 18.4856 19.9406C18.5188 19.9142 18.5452 19.8801 18.5626 19.8414C18.5837 19.7928 18.5893 19.739 18.5787 19.6871C18.5681 19.6352 18.5418 19.5879 18.5035 19.5514C18.3368 19.2597 18.1868 18.9764 18.0118 18.7172C17.9451 18.6006 17.8618 18.4839 17.7785 18.3672C17.6962 18.2534 17.6069 18.1448 17.511 18.0422C17.3562 17.88 17.195 17.724 17.0276 17.5747C17.2021 17.522 17.3687 17.4497 17.5276 17.3581ZM13.9743 17.7164C13.4959 17.685 13.0309 17.5454 12.6143 17.3081C12.2547 17.0604 11.9535 16.7373 11.7317 16.3612C11.5099 15.9851 11.3728 15.5651 11.3301 15.1306C11.2556 14.7052 11.2666 14.2692 11.3624 13.8481C11.4583 13.427 11.6371 13.0293 11.8885 12.6781C12.1893 12.2956 12.5718 11.9856 13.0068 11.7697C13.4688 11.5418 13.9556 11.3681 14.4576 11.2522C15.1009 11.0846 15.7825 11.1465 16.3851 11.4272C17.0062 11.721 17.5195 12.2022 17.8526 12.8031C18.2543 13.4664 18.4326 14.2414 18.361 15.0139C18.3349 15.3891 18.221 15.7529 18.0285 16.076C17.8359 16.3991 17.5702 16.6724 17.2526 16.8739C17.109 16.9646 16.9548 17.0373 16.7935 17.0906C15.8593 17.3989 15.6843 17.8497 13.991 17.7156L13.9743 17.7164Z"
                                                                fill-rule="evenodd" clip-rule="evenodd" fill="#00A148" />
                                                            <path
                                                                d="M10.4041 17.2833C10.0208 17.2833 9.24494 17.3333 8.3941 17.3333H5.36577L3.69743 17.2917L2.82244 17.1833C2.11327 17.0417 1.84577 16.7575 1.84577 16.3483C2.03591 15.3956 2.31519 14.4629 2.67994 13.5625C2.93327 12.5325 3.10327 11.4833 3.18827 10.4267C3.28827 9.2775 3.28827 8.12167 3.18827 6.97333C3.02993 5.305 2.72994 3.58667 2.4716 1.91C2.46164 1.86461 2.43786 1.82341 2.40354 1.79208C2.36922 1.76074 2.32604 1.7408 2.27994 1.735C3.78077 1.54333 5.30744 1.27667 6.84244 1.10167C7.89607 0.96803 8.95809 0.912046 10.0199 0.934167C10.2449 0.934167 10.8541 0.884167 11.4383 0.8925C11.7133 0.8925 11.9633 0.8925 12.0633 0.959167C12.7308 1.50917 13.4399 2.135 14.0991 2.79417C14.5174 3.23306 14.9122 3.69194 15.2833 4.17083C15.3333 4.22917 15.2833 4.37083 15.2833 4.50417V5.09583L15.2333 9C15.2443 9.0616 15.2766 9.11737 15.3246 9.15753C15.3726 9.1977 15.4332 9.21971 15.4958 9.21971C15.5583 9.21971 15.6189 9.1977 15.6669 9.15753C15.7149 9.11737 15.7472 9.0616 15.7583 9L15.9841 5.105C15.9996 4.82716 15.9996 4.54867 15.9841 4.27083C16.0027 4.0602 15.9592 3.84873 15.8591 3.6625C15.3828 3.0329 14.8643 2.43626 14.3074 1.87667C13.7694 1.31256 13.2014 0.777889 12.6058 0.275C12.3317 0.0999409 12.0143 0.00471299 11.6891 0C11.0799 0 10.2791 0.05 10.0199 0C9.18169 0.0204781 8.34584 0.0984389 7.51827 0.233333C5.5991 0.491667 3.69743 0.975833 1.84577 1.2925C1.79166 1.31116 1.74559 1.34781 1.71526 1.39635C1.68492 1.44488 1.67216 1.50235 1.6791 1.55917C1.68918 1.62052 1.72252 1.67562 1.77218 1.71303C1.82185 1.75043 1.88402 1.76725 1.94577 1.76H2.11243C2.06873 1.77786 2.03206 1.8095 2.00799 1.85011C1.98392 1.89073 1.97378 1.93809 1.9791 1.985C2.16243 3.65333 2.38743 5.32167 2.46243 6.99C2.5241 8.10333 2.48743 9.21917 2.3541 10.3267C2.29577 10.835 2.22077 11.3433 2.1291 11.8442C2.03744 12.3442 1.9041 12.845 1.78743 13.3458C1.53743 14.3883 0.954102 15.5058 0.954102 16.3483C0.954102 17.1908 1.34577 17.7667 2.6216 18.0167L3.64743 18.0917H5.3166C5.84994 18.0917 7.16827 18.0417 8.3616 17.9917C9.19493 17.9917 10.0291 17.9167 10.4049 17.8667C10.4396 17.8646 10.4736 17.8555 10.5047 17.84C10.5358 17.8245 10.5635 17.8029 10.5861 17.7764C10.6086 17.75 10.6256 17.7192 10.636 17.6861C10.6464 17.6529 10.65 17.6179 10.6466 17.5833C10.6512 17.5476 10.6486 17.5114 10.6388 17.4767C10.6291 17.4421 10.6124 17.4098 10.5898 17.3817C10.5672 17.3537 10.5392 17.3305 10.5074 17.3136C10.4757 17.2967 10.44 17.2864 10.4041 17.2833Z"
                                                                fill-rule="evenodd" clip-rule="evenodd" fill="#00A148" />
                                                            <path
                                                                d="M12.9396 9.52458C13.0034 9.52109 13.0637 9.49485 13.1098 9.45063C13.1558 9.40641 13.1845 9.34714 13.1905 9.28359C13.1966 9.22004 13.1796 9.15643 13.1428 9.10432C13.1059 9.0522 13.0516 9.01504 12.9896 8.99958C12.5396 8.93291 12.0888 8.89958 11.6379 8.87458H11.4629C11.4565 8.52493 11.4061 8.17747 11.3129 7.84041C11.2677 7.6871 11.2062 7.53904 11.1296 7.39875C11.058 7.25241 10.9654 7.11737 10.8546 6.99791C10.7101 6.87416 10.5535 6.76527 10.3871 6.67291C10.5741 6.45759 10.7167 6.20747 10.8068 5.93691C10.8969 5.66635 10.9327 5.38067 10.9121 5.09625C10.918 4.83305 10.8712 4.57134 10.7745 4.32649C10.6778 4.08164 10.5331 3.8586 10.3489 3.67047C10.1648 3.48235 9.94484 3.33295 9.7021 3.23104C9.45937 3.12914 9.19871 3.07679 8.93545 3.07708C8.37585 3.06076 7.83227 3.26506 7.42195 3.64592C7.01163 4.02677 6.76746 4.55365 6.74211 5.11291C6.73496 5.43924 6.81546 5.76152 6.97522 6.04616C7.13498 6.33079 7.36816 6.56738 7.65045 6.73125C7.43489 6.8368 7.23211 6.96458 7.04211 7.11458C6.81527 7.29169 6.62315 7.50924 6.47545 7.75625C6.2109 8.17855 6.12123 8.68728 6.22545 9.17458C5.79128 9.25791 5.39045 9.35791 4.94045 9.47458C4.91067 9.47957 4.88219 9.4905 4.85672 9.50673C4.83126 9.52295 4.80931 9.54414 4.79221 9.56902C4.7751 9.5939 4.76318 9.62198 4.75715 9.65156C4.75112 9.68115 4.75111 9.71165 4.75711 9.74125C4.76903 9.79886 4.80226 9.84984 4.85016 9.88399C4.89807 9.91814 4.9571 9.93294 5.01545 9.92541C5.47378 9.86708 5.93211 9.83375 6.39961 9.80041C6.86711 9.76708 7.47628 9.80041 8.01795 9.80041C8.55961 9.80041 9.10211 9.75041 9.68628 9.74208C10.4446 9.68375 11.2213 9.60041 11.9888 9.56708C12.3054 9.53708 12.6221 9.52319 12.9388 9.52541M8.95128 3.97041C9.26731 3.96321 9.57343 4.08101 9.80311 4.29821C10.0328 4.51541 10.1675 4.81447 10.1779 5.13041C10.4529 7.38208 7.34961 6.79875 7.50045 5.13041C7.54786 4.78811 7.72473 4.47702 7.99464 4.26122C8.26455 4.04541 8.60693 3.94133 8.95128 3.97041ZM9.63545 8.82541C9.01045 8.82541 8.37628 8.82541 7.75045 8.92541C7.42545 8.92541 7.10045 9.01708 6.78295 9.06708C6.81461 8.84791 6.89795 8.63958 7.02461 8.45875C7.09961 8.35875 7.18295 8.26708 7.26628 8.16708L7.64961 7.70791C7.88378 7.44958 8.09211 7.19041 8.29211 6.97375C9.45211 7.20708 9.46045 7.19041 9.85211 7.01541C9.94378 7.14875 10.0354 7.27375 10.1104 7.40708C10.1854 7.54041 10.1938 7.57375 10.2438 7.64875C10.2938 7.72375 10.3771 7.89041 10.4521 8.00791C10.6121 8.2768 10.7541 8.55458 10.8779 8.84125L9.63545 8.82541ZM10.0613 11.2521C10.0624 11.2175 10.0565 11.183 10.0441 11.1507C10.0316 11.1183 10.0127 11.0889 9.98863 11.064C9.96453 11.0391 9.93567 11.0193 9.90377 11.0058C9.87187 10.9923 9.83758 10.9854 9.80295 10.9854C9.30295 10.9271 8.82711 10.8604 8.33545 10.8187H7.68461C7.27628 10.8187 6.85045 10.8604 6.45795 10.9187C5.85795 11.0104 5.28295 11.1687 4.68128 11.2437C4.6194 11.2437 4.56005 11.2683 4.51629 11.3121C4.47253 11.3558 4.44795 11.4152 4.44795 11.4771C4.44795 11.539 4.47253 11.5983 4.51629 11.6421C4.56005 11.6858 4.6194 11.7104 4.68128 11.7104C5.29461 11.766 5.90906 11.7882 6.52461 11.7771C6.92461 11.7771 7.35878 11.7104 7.71795 11.6937L9.77795 11.5437C9.8169 11.5479 9.85629 11.5431 9.89313 11.5298C9.92997 11.5165 9.9633 11.495 9.9906 11.4669C10.0179 11.4388 10.0384 11.4048 10.0507 11.3676C10.0629 11.3304 10.0666 11.2909 10.0613 11.2521ZM7.25878 12.7862H6.60878C6.39545 12.7996 6.18406 12.8246 5.97461 12.8612C5.48295 12.9529 5.02378 13.0946 4.54795 13.1946C4.48666 13.2009 4.43011 13.2304 4.38984 13.277C4.34956 13.3236 4.32862 13.3839 4.33128 13.4454C4.33339 13.4761 4.34154 13.506 4.35527 13.5335C4.36899 13.5611 4.38801 13.5856 4.41125 13.6057C4.43448 13.6258 4.46146 13.6412 4.49064 13.6509C4.51982 13.6605 4.55062 13.6643 4.58128 13.6621C5.13128 13.6621 5.69128 13.7287 6.24961 13.7037C6.56628 13.7037 6.89128 13.6537 7.20878 13.6371C7.68297 13.586 8.16126 13.586 8.63545 13.6371C8.70373 13.6499 8.77434 13.6364 8.83309 13.5993C8.89184 13.5622 8.93436 13.5043 8.95211 13.4371C8.9607 13.4031 8.96229 13.3678 8.95678 13.3332C8.95127 13.2986 8.93878 13.2654 8.92008 13.2358C8.90137 13.2062 8.87683 13.1807 8.84796 13.1609C8.81908 13.141 8.78647 13.1273 8.75211 13.1204C8.27113 12.9442 7.76903 12.8321 7.25878 12.7871"
                                                                fill-rule="evenodd" clip-rule="evenodd" fill="#00A148" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_8226_21145">
                                                                <rect width="20" height="20" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span> Job Description
                                            </div>
                                            <button type="button" class="read-more-btn"><span class="read-more-text">Read
                                                    More</span><span class="read-more-arrow">↓</span></button>
                                        </div>


                                        <div class="companyList">
                                            <p>UI/UX Designer</p>
                                            <p>Company: [Company Name]</p>
                                            <p>Location: Remote / Hybrid / On-site</p>
                                            <p>Job Type: Full-time</p>
                                            <p>Experience: 1–3 Years</p>
                                            <p>Salary: ₹4–8 LPA (Depending on experience)</p>
                                        </div>

                                        <h5>About the Role</h5>
                                        <p>We are looking for a creative and user-focused UI/UX Designer to design
                                            intuitive, engaging and visually appealing digital experiences. You will
                                            work closely with developers, product managers and other stakeholders to
                                            transform ideas into user-friendly digital products.</p>
                                        <p>Key Responsibilities</p>
                                        <ul>
                                            <li>Design user interfaces for websites, mobile applications and digital
                                                products.</li>
                                            <li>Create wireframes, user flows, prototypes and high-fidelity designs.
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="details-card requirements-card">
                                    <div class="skills">
                                        <div class="skill">
                                            <h4>Skills</h4>
                                        </div>

                                        <ul>
                                            <li>After Effect</li>
                                            <li>Premiere Pro</li>
                                            <li>Color grading </li>
                                            <li>Motion Graphics</li>
                                            <li>UI & UX Design</li>
                                            <li>Color grading </li>
                                            <li>Premiere Pro</li>
                                            <li>Motion Graphics</li>
                                            <li>After Effect</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="details-card key-respons read-more-card">
                                    <div class="byob">
                                        <div class="byobTop">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    viewBox="0 0 30 30" fill="none">
                                                    <path
                                                        d="M10.125 9.75C10.4234 9.75 10.7095 9.63147 10.9205 9.4205C11.1315 9.20952 11.25 8.92337 11.25 8.625C11.25 8.32663 11.1315 8.04048 10.9205 7.8295C10.7095 7.61853 10.4234 7.5 10.125 7.5C9.82663 7.5 9.54048 7.61853 9.3295 7.8295C9.11853 8.04048 9 8.32663 9 8.625C9 8.92337 9.11853 9.20952 9.3295 9.4205C9.54048 9.63147 9.82663 9.75 10.125 9.75ZM11.25 13.125C11.25 13.4234 11.1315 13.7095 10.9205 13.9205C10.7095 14.1315 10.4234 14.25 10.125 14.25C9.82663 14.25 9.54048 14.1315 9.3295 13.9205C9.11853 13.7095 9 13.4234 9 13.125C9 12.8266 9.11853 12.5405 9.3295 12.3295C9.54048 12.1185 9.82663 12 10.125 12C10.4234 12 10.7095 12.1185 10.9205 12.3295C11.1315 12.5405 11.25 12.8266 11.25 13.125ZM10.125 18.75C10.2727 18.75 10.419 18.7209 10.5555 18.6644C10.692 18.6078 10.816 18.525 10.9205 18.4205C11.025 18.316 11.1078 18.192 11.1644 18.0555C11.2209 17.919 11.25 17.7727 11.25 17.625C11.25 17.4773 11.2209 17.331 11.1644 17.1945C11.1078 17.058 11.025 16.934 10.9205 16.8295C10.816 16.725 10.692 16.6422 10.5555 16.5856C10.419 16.5291 10.2727 16.5 10.125 16.5C9.82663 16.5 9.54048 16.6185 9.3295 16.8295C9.11853 17.0405 9 17.3266 9 17.625C9 17.9234 9.11853 18.2095 9.3295 18.4205C9.54048 18.6315 9.82663 18.75 10.125 18.75ZM15.75 8.625C15.75 8.92337 15.6315 9.20952 15.4205 9.4205C15.2095 9.63147 14.9234 9.75 14.625 9.75C14.3266 9.75 14.0405 9.63147 13.8295 9.4205C13.6185 9.20952 13.5 8.92337 13.5 8.625C13.5 8.32663 13.6185 8.04048 13.8295 7.8295C14.0405 7.61853 14.3266 7.5 14.625 7.5C14.9234 7.5 15.2095 7.61853 15.4205 7.8295C15.6315 8.04048 15.75 8.32663 15.75 8.625ZM14.625 14.25C14.9234 14.25 15.2095 14.1315 15.4205 13.9205C15.6315 13.7095 15.75 13.4234 15.75 13.125C15.75 12.8266 15.6315 12.5405 15.4205 12.3295C15.2095 12.1185 14.9234 12 14.625 12C14.3266 12 14.0405 12.1185 13.8295 12.3295C13.6185 12.5405 13.5 12.8266 13.5 13.125C13.5 13.4234 13.6185 13.7095 13.8295 13.9205C14.0405 14.1315 14.3266 14.25 14.625 14.25ZM15.75 17.625C15.75 17.9234 15.6315 18.2095 15.4205 18.4205C15.2095 18.6315 14.9234 18.75 14.625 18.75C14.3266 18.75 14.0405 18.6315 13.8295 18.4205C13.6185 18.2095 13.5 17.9234 13.5 17.625C13.5 17.3266 13.6185 17.0405 13.8295 16.8295C14.0405 16.6185 14.3266 16.5 14.625 16.5C14.9234 16.5 15.2095 16.6185 15.4205 16.8295C15.6315 17.0405 15.75 17.3266 15.75 17.625ZM19.125 18.75C19.2727 18.75 19.419 18.7209 19.5555 18.6644C19.692 18.6078 19.816 18.525 19.9205 18.4205C20.025 18.316 20.1078 18.192 20.1644 18.0555C20.2209 17.919 20.25 17.7727 20.25 17.625C20.25 17.4773 20.2209 17.331 20.1644 17.1945C20.1078 17.058 20.025 16.934 19.9205 16.8295C19.816 16.725 19.692 16.6422 19.5555 16.5856C19.419 16.5291 19.2727 16.5 19.125 16.5C18.8266 16.5 18.5405 16.6185 18.3295 16.8295C18.1185 17.0405 18 17.3266 18 17.625C18 17.9234 18.1185 18.2095 18.3295 18.4205C18.5405 18.6315 18.8266 18.75 19.125 18.75ZM6.75 27C6.55109 27 6.36032 26.921 6.21967 26.7803C6.07902 26.6397 6 26.4489 6 26.25V5.25C6 4.65326 6.23705 4.08097 6.65901 3.65901C7.08097 3.23705 7.65326 3 8.25 3H17.25C17.8467 3 18.419 3.23705 18.841 3.65901C19.2629 4.08097 19.5 4.65326 19.5 5.25V12H21.75C22.3467 12 22.919 12.2371 23.341 12.659C23.7629 13.081 24 13.6533 24 14.25V26.25C24 26.4489 23.921 26.6397 23.7803 26.7803C23.6397 26.921 23.4489 27 23.25 27H6.75ZM7.5 5.25V25.5H10.5V21.75C10.5 21.5511 10.579 21.3603 10.7197 21.2197C10.8603 21.079 11.0511 21 11.25 21H18.75C18.9489 21 19.1397 21.079 19.2803 21.2197C19.421 21.3603 19.5 21.5511 19.5 21.75V25.5H22.5V14.25C22.5 14.0511 22.421 13.8603 22.2803 13.7197C22.1397 13.579 21.9489 13.5 21.75 13.5H18.75C18.5511 13.5 18.3603 13.421 18.2197 13.2803C18.079 13.1397 18 12.9489 18 12.75V5.25C18 5.05109 17.921 4.86032 17.7803 4.71967C17.6397 4.57902 17.4489 4.5 17.25 4.5H8.25C8.05109 4.5 7.86032 4.57902 7.71967 4.71967C7.57902 4.86032 7.5 5.05109 7.5 5.25ZM18 22.5H15.75V25.5H18V22.5ZM14.25 22.5H12V25.5H14.25V22.5Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <div class="text">
                                                <h4>Build your Own Brand by IDP</h4>
                                                <p>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                            viewBox="0 0 17 17" fill="none">
                                                            <path
                                                                d="M10.625 7.08594C10.625 8.25954 9.6736 9.21094 8.5 9.21094C7.32639 9.21094 6.375 8.25954 6.375 7.08594C6.375 5.91233 7.32639 4.96094 8.5 4.96094C9.6736 4.96094 10.625 5.91233 10.625 7.08594Z"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke="#363636" />
                                                            <path
                                                                d="M8.49967 1.41797C6.99678 1.41797 5.55544 2.01499 4.49274 3.0777C3.43003 4.1404 2.83301 5.58174 2.83301 7.08464C2.83301 8.4248 3.11776 9.30172 3.89551 10.2721L8.49967 15.5846L13.1038 10.2721C13.8816 9.30172 14.1663 8.4248 14.1663 7.08464C14.1663 5.58174 13.5693 4.1404 12.5066 3.0777C11.4439 2.01499 10.0026 1.41797 8.49967 1.41797Z"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke="#363636" />
                                                        </svg>
                                                    </span>
                                                    Delhi
                                                </p>
                                            </div>
                                        </div>

                                        <div class="byobBottom">
                                            <p>We are looking for a creative and user-focused UI/UX Designer to design
                                                intuitive, engaging and visually appealing digital experiences. You will
                                                work closely with developers, product managers and other stakeholders to
                                                transform ideas into user-friendly digital products.</p>
                                            <p>Key Responsibilities</p>
                                            <ul>
                                                <li>Design user interfaces for websites, mobile applications and digital
                                                    products.</li>
                                                <li>Create wireframes, user flows, prototypes and high-fidelity designs.
                                                </li>
                                                <li>Conduct user research and usability testing to improve user
                                                    experience.</li>
                                                <li>Maintain consistent design systems and visual guidelines.</li>
                                                <li>Collaborate with developers to ensure accurate design
                                                    implementation.</li>
                                                <li>Improve existing interfaces based on feedback and user behaviour.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="action-buttons">
                                    <button class="btn-close" id="backBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none">
                                            <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div id="detailLoader" class="js-loader" style="display:none;">Loading…</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script> document.addEventListener('click', function (e) {
            const btn = e.target.closest('.read-more-btn');

            if (!btn) {
                return;
            }

            const overview = btn.closest('.seeOverView');
            const text = btn.querySelector('.read-more-text');
            const arrow = btn.querySelector('.read-more-arrow');

            const expanded = overview.classList.toggle('expanded');

            text.textContent = expanded ? 'Read Less' : 'Read More';
            arrow.textContent = expanded ? '↑' : '↓';
        });
    </script>
@endsection