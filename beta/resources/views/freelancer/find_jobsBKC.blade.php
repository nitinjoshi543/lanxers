@extends('freelancer.layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/job-display.css') }}?v={{ filemtime(public_path('frontend/css/job-display.css')) }}" />

<section class="jobPosted">
    <button type="button" class="filterShowDetails" id="filterShowDetails">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
            <path
                d="M26.5625 14.9994H11.1188M5.6675 14.9994H3.4375M5.6675 14.9994C5.6675 14.2767 5.9546 13.5835 6.46563 13.0725C6.97667 12.5615 7.66979 12.2744 8.3925 12.2744C9.11522 12.2744 9.80833 12.5615 10.3194 13.0725C10.8304 13.5835 11.1175 14.2767 11.1175 14.9994C11.1175 15.7221 10.8304 16.4152 10.3194 16.9262C9.80833 17.4373 9.11522 17.7244 8.3925 17.7244C7.66979 17.7244 6.97667 17.4373 6.46563 16.9262C5.9546 16.4152 5.6675 15.7221 5.6675 14.9994ZM26.5625 23.2581H19.3775M19.3775 23.2581C19.3775 23.981 19.0897 24.6749 18.5786 25.1861C18.0674 25.6972 17.3741 25.9844 16.6513 25.9844C15.9285 25.9844 15.2354 25.696 14.7244 25.185C14.2133 24.674 13.9262 23.9808 13.9262 23.2581M19.3775 23.2581C19.3775 22.5352 19.0897 21.8426 18.5786 21.3314C18.0674 20.8203 17.3741 20.5331 16.6513 20.5331C15.9285 20.5331 15.2354 20.8202 14.7244 21.3313C14.2133 21.8423 13.9262 22.5354 13.9262 23.2581M13.9262 23.2581H3.4375M26.5625 6.74063H22.6813M17.23 6.74063H3.4375M17.23 6.74063C17.23 6.01791 17.5171 5.3248 18.0281 4.81376C18.5392 4.30272 19.2323 4.01563 19.955 4.01563C20.3129 4.01562 20.6672 4.08611 20.9978 4.22305C21.3284 4.36 21.6288 4.56072 21.8819 4.81376C22.1349 5.0668 22.3356 5.3672 22.4726 5.69781C22.6095 6.02842 22.68 6.38277 22.68 6.74063C22.68 7.09848 22.6095 7.45283 22.4726 7.78344C22.3356 8.11405 22.1349 8.41445 21.8819 8.66749C21.6288 8.92053 21.3284 9.12125 20.9978 9.2582C20.6672 9.39514 20.3129 9.46562 19.955 9.46562C19.2323 9.46562 18.5392 9.17853 18.0281 8.66749C17.5171 8.15645 17.23 7.46334 17.23 6.74063Z"
                stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
        </svg>
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
                <button type="button" class="resetAll">Reset All
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path
                            d="M8.6665 2C7.07521 2 5.54908 2.63214 4.42386 3.75736C3.29865 4.88258 2.6665 6.4087 2.6665 8H0.666504L3.33317 10.66L5.99984 8H3.99984C3.99984 5.42 6.0865 3.33333 8.6665 3.33333C11.2465 3.33333 13.3332 5.42 13.3332 8C13.3332 10.58 11.2465 12.6667 8.6665 12.6667C7.37984 12.6667 6.21317 12.14 5.37317 11.2933L4.4265 12.24C4.98203 12.7988 5.64272 13.242 6.37046 13.5441C7.0982 13.8462 7.87856 14.0011 8.6665 14C10.2578 14 11.7839 13.3679 12.9091 12.2426C14.0344 11.1174 14.6665 9.5913 14.6665 8C14.6665 6.4087 14.0344 4.88258 12.9091 3.75736C11.7839 2.63214 10.2578 2 8.6665 2ZM7.99984 5.33333V8.66667L10.8332 10.3467L11.3465 9.49333L8.99984 8.1V5.33333H7.99984Z"
                            fill="#00A148" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="accordion" id="accordionExample">

            {{-- Job Title Search --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <g clip-path="url(#clip0_758_14875)">
                                    <path
                                        d="M1.3335 8C1.3335 8.70133 1.4535 9.37467 1.67483 10M1.67483 10H7.3335M1.67483 10C2.08852 11.1701 2.85488 12.1831 3.86832 12.8995C4.88176 13.6159 6.09242 14.0004 7.3335 14C6.30416 14 5.45616 11.6667 5.3455 8.66667M8.67616 6H14.3348M14.6668 7.66667C14.6348 7.08533 14.5202 6.526 14.3348 6C13.9211 4.8299 13.1548 3.81688 12.1413 3.1005C11.1279 2.38411 9.91724 1.99963 8.67616 2C9.74283 2 10.6155 4.508 10.6728 7.66667"
                                        stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M1.3335 3.53003C1.3335 2.7987 1.3335 2.43203 1.45816 2.14803C1.5915 1.8467 1.8195 1.6047 2.1035 1.4647C2.3715 1.33203 2.71683 1.33203 3.40683 1.33203H4.00016C5.2575 1.33203 5.8855 1.33203 6.27616 1.74536C6.66683 2.1607 6.66683 2.82536 6.66683 4.1587V5.6647C6.66683 6.24536 6.66683 6.53603 6.49083 6.63603C6.31483 6.73603 6.08683 6.5747 5.63083 6.25203L5.56083 6.20336C5.2275 5.96736 5.06083 5.85003 4.8715 5.78936C4.68283 5.7287 4.48216 5.7287 4.0815 5.7287H3.40816C2.71683 5.7287 2.3715 5.7287 2.1035 5.59603C1.81471 5.45124 1.58621 5.20929 1.45816 4.9127C1.3335 4.6287 1.3335 4.2627 1.3335 3.53003ZM14.6668 11.53C14.6668 10.798 14.6668 10.432 14.5422 10.148C14.4141 9.85144 14.1856 9.60949 13.8968 9.4647C13.6288 9.33203 13.2835 9.33203 12.5935 9.33203H12.0002C10.7428 9.33203 10.1148 9.33203 9.72416 9.74536C9.3335 10.1607 9.3335 10.8254 9.3335 12.1587V13.6647C9.3335 14.2454 9.3335 14.536 9.5095 14.636C9.6855 14.736 9.9135 14.5747 10.3695 14.252L10.4395 14.2034C10.7728 13.9674 10.9395 13.85 11.1288 13.7894C11.3175 13.7287 11.5182 13.7287 11.9188 13.7287H12.5922C13.2835 13.7287 13.6288 13.7287 13.8968 13.596C14.1808 13.456 14.4095 13.214 14.5422 12.9127C14.6668 12.6287 14.6668 12.2627 14.6668 11.53Z"
                                        stroke="#00A148" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_758_14875"><rect width="16" height="16" fill="white" /></clipPath>
                                </defs>
                            </svg>
                        </span>
                        Job Title
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="skill-filter">
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none">
                                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#0BA84A" stroke-width="2" />
                                    <path d="M21 21L17 17" stroke="#0BA84A" stroke-width="2" stroke-linecap="round" />
                                </svg>
                                <input type="text" id="jobTitleSearch" placeholder="Search Job Title">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Job Location --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJobLocation" aria-expanded="true" aria-controls="collapseJobLocation">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_758_14875)">
                                <path d="M1.3335 8C1.3335 8.70133 1.4535 9.37467 1.67483 10M1.67483 10H7.3335M1.67483 10C2.08852 11.1701 2.85488 12.1831 3.86832 12.8995C4.88176 13.6159 6.09242 14.0004 7.3335 14C6.30416 14 5.45616 11.6667 5.3455 8.66667M8.67616 6H14.3348M14.6668 7.66667C14.6348 7.08533 14.5202 6.526 14.3348 6C13.9211 4.8299 13.1548 3.81688 12.1413 3.1005C11.1279 2.38411 9.91724 1.99963 8.67616 2C9.74283 2 10.6155 4.508 10.6728 7.66667" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1.3335 3.53003C1.3335 2.7987 1.3335 2.43203 1.45816 2.14803C1.5915 1.8467 1.8195 1.6047 2.1035 1.4647C2.3715 1.33203 2.71683 1.33203 3.40683 1.33203H4.00016C5.2575 1.33203 5.8855 1.33203 6.27616 1.74536C6.66683 2.1607 6.66683 2.82536 6.66683 4.1587V5.6647C6.66683 6.24536 6.66683 6.53603 6.49083 6.63603C6.31483 6.73603 6.08683 6.5747 5.63083 6.25203L5.56083 6.20336C5.2275 5.96736 5.06083 5.85003 4.8715 5.78936C4.68283 5.7287 4.48216 5.7287 4.0815 5.7287H3.40816C2.71683 5.7287 2.3715 5.7287 2.1035 5.59603C1.81471 5.45124 1.58621 5.20929 1.45816 4.9127C1.3335 4.6287 1.3335 4.2627 1.3335 3.53003ZM14.6668 11.53C14.6668 10.798 14.6668 10.432 14.5422 10.148C14.4141 9.85144 14.1856 9.60949 13.8968 9.4647C13.6288 9.33203 13.2835 9.33203 12.5935 9.33203H12.0002C10.7428 9.33203 10.1148 9.33203 9.72416 9.74536C9.3335 10.1607 9.3335 10.8254 9.3335 12.1587V13.6647C9.3335 14.2454 9.3335 14.536 9.5095 14.636C9.6855 14.736 9.9135 14.5747 10.3695 14.252L10.4395 14.2034C10.7728 13.9674 10.9395 13.85 11.1288 13.7894C11.3175 13.7287 11.5182 13.7287 11.9188 13.7287H12.5922C13.2835 13.7287 13.6288 13.7287 13.8968 13.596C14.1808 13.456 14.4095 13.214 14.5422 12.9127C14.6668 12.6287 14.6668 12.2627 14.6668 11.53Z" stroke="#00A148" />
                            </g>
                            <defs>
                                <clipPath id="clip0_758_14875"><rect width="16" height="16" fill="white" /></clipPath>
                            </defs>
                        </svg>
                    </span>
                    Job Location
                    </button>
                </h2>

                <div id="collapseJobLocation" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="skill-filter">
                            <div class="location-multiselect">
                                <div class="location-select-box" id="locationSelectBox">
                                    <div class="selected-locations" id="selectedLocations">
                                    </div>
                                    <input type="text" id="jobLocationSearch" class="location-search" placeholder="Search Location" autocomplete="off">
                                </div>
                                <div class="location-dropdown" id="jobLocationDropdown">
                                    @forelse($jobLocations as $location)
                                    <div class="location-option" data-value="{{ $location->job_location }}">
                                        <span class="location-name">{{ $location->job_location }}</span>
                                        <span class="location-count">{{ $location->jobs_count }}</span>
                                    </div>
                                    @empty
                                        <p class="no-filter-results">No locations available</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Price --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path
                                    d="M12.6667 4.66667V2.66667C12.6667 2.48986 12.5964 2.32029 12.4714 2.19526C12.3464 2.07024 12.1768 2 12 2H3.33333C2.97971 2 2.64057 2.14048 2.39052 2.39052C2.14048 2.64057 2 2.97971 2 3.33333C2 3.68696 2.14048 4.02609 2.39052 4.27614C2.64057 4.52619 2.97971 4.66667 3.33333 4.66667H13.3333C13.5101 4.66667 13.6797 4.7369 13.8047 4.86193C13.9298 4.98695 14 5.15652 14 5.33333V8M14 8H12C11.6464 8 11.3072 8.14048 11.0572 8.39052C10.8071 8.64057 10.6667 8.97971 10.6667 9.33333C10.6667 9.68696 10.8071 10.0261 11.0572 10.2761C11.3072 10.5262 11.6464 10.6667 12 10.6667H14C14.1768 10.6667 14.3464 10.5964 14.4714 10.4714C14.5964 10.3464 14.6667 10.1768 14.6667 10V8.66667C14.6667 8.48986 14.5964 8.32029 14.4714 8.19526C14.3464 8.07024 14.1768 8 14 8Z"
                                    stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M2 3.33203V12.6654C2 13.019 2.14048 13.3581 2.39052 13.6082C2.64057 13.8582 2.97971 13.9987 3.33333 13.9987H13.3333C13.5101 13.9987 13.6797 13.9285 13.8047 13.8034C13.9298 13.6784 14 13.5088 14 13.332V10.6654"
                                    stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        Price
                    </button>
                </h2>
                <div id="collapsePrice" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="price-filter">
                            <div class="price-fields">
                                <div class="field">
                                    <label>Minimum</label>
                                    <div class="value-box">
                                        <span class="currency">₹</span>
                                        <span id="minValue">{{ request('min_budget', 0) }}</span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Maximum</label>
                                    <div class="value-box">
                                        <span class="currency">₹</span>
                                        <span id="maxValue">{{ request('max_budget', 100000) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-wrapper">
                                <div class="slider-track"></div>
                                <div class="slider-progress"></div>
                                <input type="range" id="minRange" min="0" max="100000" value="{{ request('min_budget', 0) }}" step="1000">
                                <input type="range" id="maxRange" min="0" max="100000" value="{{ request('max_budget', 100000) }}" step="1000">
                            </div>
                            <div class="amount">
                                <p>₹ 0</p>
                                <p>₹ 1,00,000+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Skills --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <g clip-path="url(#clip0_758_14875)">
                                    <path
                                        d="M1.3335 8C1.3335 8.70133 1.4535 9.37467 1.67483 10M1.67483 10H7.3335M1.67483 10C2.08852 11.1701 2.85488 12.1831 3.86832 12.8995C4.88176 13.6159 6.09242 14.0004 7.3335 14C6.30416 14 5.45616 11.6667 5.3455 8.66667M8.67616 6H14.3348M14.6668 7.66667C14.6348 7.08533 14.5202 6.526 14.3348 6C13.9211 4.8299 13.1548 3.81688 12.1413 3.1005C11.1279 2.38411 9.91724 1.99963 8.67616 2C9.74283 2 10.6155 4.508 10.6728 7.66667"
                                        stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M1.3335 3.53003C1.3335 2.7987 1.3335 2.43203 1.45816 2.14803C1.5915 1.8467 1.8195 1.6047 2.1035 1.4647C2.3715 1.33203 2.71683 1.33203 3.40683 1.33203H4.00016C5.2575 1.33203 5.8855 1.33203 6.27616 1.74536C6.66683 2.1607 6.66683 2.82536 6.66683 4.1587V5.6647C6.66683 6.24536 6.66683 6.53603 6.49083 6.63603C6.31483 6.73603 6.08683 6.5747 5.63083 6.25203L5.56083 6.20336C5.2275 5.96736 5.06083 5.85003 4.8715 5.78936C4.68283 5.7287 4.48216 5.7287 4.0815 5.7287H3.40816C2.71683 5.7287 2.3715 5.7287 2.1035 5.59603C1.81471 5.45124 1.58621 5.20929 1.45816 4.9127C1.3335 4.6287 1.3335 4.2627 1.3335 3.53003ZM14.6668 11.53C14.6668 10.798 14.6668 10.432 14.5422 10.148C14.4141 9.85144 14.1856 9.60949 13.8968 9.4647C13.6288 9.33203 13.2835 9.33203 12.5935 9.33203H12.0002C10.7428 9.33203 10.1148 9.33203 9.72416 9.74536C9.3335 10.1607 9.3335 10.8254 9.3335 12.1587V13.6647C9.3335 14.2454 9.3335 14.536 9.5095 14.636C9.6855 14.736 9.9135 14.5747 10.3695 14.252L10.4395 14.2034C10.7728 13.9674 10.9395 13.85 11.1288 13.7894C11.3175 13.7287 11.5182 13.7287 11.9188 13.7287H12.5922C13.2835 13.7287 13.6288 13.7287 13.8968 13.596C14.1808 13.456 14.4095 13.214 14.5422 12.9127C14.6668 12.6287 14.6668 12.2627 14.6668 11.53Z"
                                        stroke="#00A148" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_758_14875"><rect width="16" height="16" fill="white" /></clipPath>
                                </defs>
                            </svg>
                        </span>
                        Skills
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="skill-filter">
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none">
                                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#0BA84A" stroke-width="2" />
                                    <path d="M21 21L17 17" stroke="#0BA84A" stroke-width="2" stroke-linecap="round" />
                                </svg>
                                <input type="text" id="skillSearch" placeholder="Search Skill">
                            </div>

                            <div class="skill-list" id="skillList">
                                @forelse($skills as $skill)
                                <label class="skill-item">
                                    <input type="checkbox" name="skills[]" value="{{ $skill->id }}"
                                        {{ in_array($skill->id, (array) request('skills', [])) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    <span class="skill-name">{{ $skill->name }}</span>
                                    <span class="count">{{ $skill->jobs_count }}</span>
                                </label>
                                @empty
                                <p class="no-filter-results">No skills available</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Location Type --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseLocationType"
                        aria-expanded="true"
                        aria-controls="collapseLocationType">

                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <g clip-path="url(#clip0_758_14875)">
                                    <path
                                        d="M1.3335 8C1.3335 8.70133 1.4535 9.37467 1.67483 10M1.67483 10H7.3335M1.67483 10C2.08852 11.1701 2.85488 12.1831 3.86832 12.8995C4.88176 13.6159 6.09242 14.0004 7.3335 14C6.30416 14 5.45616 11.6667 5.3455 8.66667M8.67616 6H14.3348M14.6668 7.66667C14.6348 7.08533 14.5202 6.526 14.3348 6C13.9211 4.8299 13.1548 3.81688 12.1413 3.1005C11.1279 2.38411 9.91724 1.99963 8.67616 2C9.74283 2 10.6155 4.508 10.6728 7.66667"
                                        stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M1.3335 3.53003C1.3335 2.7987 1.3335 2.43203 1.45816 2.14803C1.5915 1.8467 1.8195 1.6047 2.1035 1.4647C2.3715 1.33203 2.71683 1.33203 3.40683 1.33203H4.00016C5.2575 1.33203 5.8855 1.33203 6.27616 1.74536C6.66683 2.1607 6.66683 2.82536 6.66683 4.1587V5.6647C6.66683 6.24536 6.66683 6.53603 6.49083 6.63603C6.31483 6.73603 6.08683 6.5747 5.63083 6.25203L5.56083 6.20336C5.2275 5.96736 5.06083 5.85003 4.8715 5.78936C4.68283 5.7287 4.48216 5.7287 4.0815 5.7287H3.40816C2.71683 5.7287 2.3715 5.7287 2.1035 5.59603C1.81471 5.45124 1.58621 5.20929 1.45816 4.9127C1.3335 4.6287 1.3335 4.2627 1.3335 3.53003ZM14.6668 11.53C14.6668 10.798 14.6668 10.432 14.5422 10.148C14.4141 9.85144 14.1856 9.60949 13.8968 9.4647C13.6288 9.33203 13.2835 9.33203 12.5935 9.33203H12.0002C10.7428 9.33203 10.1148 9.33203 9.72416 9.74536C9.3335 10.1607 9.3335 10.8254 9.3335 12.1587V13.6647C9.3335 14.2454 9.3335 14.536 9.5095 14.636C9.6855 14.736 9.9135 14.5747 10.3695 14.252L10.4395 14.2034C10.7728 13.9674 10.9395 13.85 11.1288 13.7894C11.3175 13.7287 11.5182 13.7287 11.9188 13.7287H12.5922C13.2835 13.7287 13.6288 13.7287 13.8968 13.596C14.1808 13.456 14.4095 13.214 14.5422 12.9127C14.6668 12.6287 14.6668 12.2627 14.6668 11.53Z"
                                        stroke="#00A148" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_758_14875"><rect width="16" height="16" fill="white" /></clipPath>
                                </defs>
                            </svg>
                        </span>
                        Location Type
                    </button>
                </h2>

                <div id="collapseLocationType" class="accordion-collapse collapse show">
                    <div class="accordion-body">

                        <div class="skill-filter">
                            <div class="skill-list" id="locationTypeList">
                                @foreach($locationTypes as $locationType)
                                    <label class="skill-item">
                                        <input type="checkbox" name="location_type[]" value="{{ $locationType->location_type }}"
                                            {{ in_array($locationType->location_type, (array) request('location_type', [])) ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                        <span class="skill-name"> {{ ucfirst($locationType->location_type) }}</span>
                                        <span class="count">{{ $locationType->jobs_count }}</span>
                                    </label>
                                @endforeach
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
                <defs><clipPath id="clip0_796_7599"><rect width="30" height="30" fill="white" /></clipPath></defs>
            </svg>
        </button>
    </div>

    <div class="jobflex">
        <div class="joblist-section">
            {{-- ============ LEFT: JOB LIST ============ --}}
            <div class="list-panel" id="listPanel">
                <div class="list-panel-header">
                    <h5>
                        <span class="icon-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.6665 10.225C3.79868 11.0545 6.04878 11.5411 8.33318 11.6667V13.3333H11.6665V11.6667C13.9454 11.5239 16.1913 11.0495 18.3332 10.2583V16.6667H1.6665V10.225ZM12.4998 2.5L13.3332 3.33332V5H18.3332V9.34168C15.778 10.2957 13.0771 10.8004 10.3498 10.8333H9.74982C6.98599 10.8034 4.2493 10.2843 1.6665 9.3V5H6.6665V3.33332L7.49982 2.5H12.4998ZM11.6665 4.16668H8.33318V5H11.6665V4.16668Z" fill="#00A148"></path>
                            </svg>
                        </span> Job Listings
                    </h5>
                    <div class="sort-wrap">
                        <button class="sort-btn" id="sortBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-down w-4 h-4"><path d="m21 16-4 4-4-4"></path><path d="M17 20V4"></path><path d="m3 8 4-4 4 4"></path><path d="M7 4v16"></path></svg>
                        </button>
                        <div class="sort-menu" id="sortMenu">
                            <div class="sort-menu-title">Sort Jobs</div>
                            <div class="sort-menu-list" id="sortMenuList">
                                <div class="sort-item selected" data-sort="date" data-dir="desc">Date Posted (Newest)</div>
                                <div class="sort-item" data-sort="date" data-dir="asc">Date Posted (Oldest)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="jobListWrap" style="position:relative;">
                    <div id="jobList"></div>
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

            {{-- ============ RIGHT: DETAIL (AJAX-loaded) ============ --}}
            <div class="detail-panel show bottom-sheet" id="detailPanel">
                <button class="mobile-back" id="backBtn"><i class="bi bi-arrow-left"></i> Back to listings</button>

                <div id="jobDetailWrap" style="position:relative;">
                    <div id="jobDetailContainer">
                        <div class="job-detail-empty"><p>No job selected.</p></div>
                    </div>
                    <div id="detailLoader" class="js-loader" style="display:none;">Loading…</div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal bottom-sheet fade" id="applyModal" tabindex="-1" aria-labelledby="applyModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="drag-handle"></div>
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="applied-img">
                    <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6ab4ca67f15fe.jpg" alt="">
                </div>
                <div class="applied-content">
                    <h2>
                        You have successfully
                        <span>applied for this job!</span>
                    </h2>
                    <p>Thank you for showing interest. Our team will review your application and get back to you soon.</p>
                    <a href="{{ route('jobseekers.find.work') }}" class="applied-btn">Explore More Jobs</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Server-rendered initial data, split into #jobList by JS below.
     A <template> tag never renders and reuses the exact same markup/partial the AJAX
     endpoint returns, so initial load and every later refresh go through one code path. --}}
<template id="initialJobsData">
@include('freelancer.ajax_find_jobs', compact('jobs'))
</template>

{{-- Minimal loader styling --}}
<style>
.js-loader{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.7);font-size:14px;color:#00A148;font-weight:600;z-index:5;}
</style>

<script>
    document.addEventListener('click', function (e) {

        const btn = e.target.closest('.icon-copy-btn');
        if (!btn) return;

        const url = btn.getAttribute('data-url');
        const tooltip = btn.querySelector('.copy-tooltip');

        function showCopied() {
            if (!tooltip) return;
            const original = tooltip.textContent;
            tooltip.textContent = 'Copied!';
            tooltip.classList.add('show');
            setTimeout(function () {
                tooltip.textContent = original;
                tooltip.classList.remove('show');
            }, 1500);
        }

        function fallbackCopy() {
            const input = document.createElement('input');
            input.value = url;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            showCopied();
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url).then(showCopied).catch(fallbackCopy);
        } else {
            fallbackCopy();
        }
    });
</script>


<script>
(function () {
    const listPanel          = document.getElementById('listPanel');
    const detailPanel        = document.getElementById('detailPanel');
    const jobListEl          = document.getElementById('jobList');
    const jobDetailContainer = document.getElementById('jobDetailContainer');
    const listLoader         = document.getElementById('listLoader');
    const loadMoreTrigger    = document.getElementById('loadMoreTrigger');

    let currentPage   = 1;
    let lastPage      = {{ $jobs->lastPage() }};
    let isLoadingMore = false;
    let currentSortDir = 'desc';

    const detailLoader  = document.getElementById('detailLoader');
    const sortBtn       = document.getElementById('sortBtn');
    const sortMenu      = document.getElementById('sortMenu');
    const filterBtn     = document.getElementById('filterShowDetails');
    const filterDetails = document.querySelector('.filterDetails');
    const filterHideBtn = document.getElementById('filterHideDetails');
    const resetAllBtn   = document.querySelector('.resetAll');
    const minRange      = document.getElementById('minRange');
    const maxRange      = document.getElementById('maxRange');
    const minValue      = document.getElementById('minValue');
    const maxValue      = document.getElementById('maxValue');
    const progress      = document.querySelector('.slider-progress');

    const findWorkUrl = "{{ route('jobseekers.find.work') }}";

    const jobShowUrlTemplate =
        "{{ route('jobseekers.job.show', ['id' => '__ID__']) }}";

    const favouriteUrlTemplate =
        "{{ route('jobseekers.job.favourite', ['job' => '__ID__']) }}";

    const csrfToken =
        document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    const maxPrice = 100000;
    const gap = 1000;
    const LOADER_DELAY_MS = 250;


    /* ---------------------------------------------------------
       Loader
    --------------------------------------------------------- */

    function withDelayedLoader(loaderEl, promiseFn) {
        let shown = false;

        const timer = setTimeout(() => {
            shown = true;
            loaderEl.style.display = 'flex';
        }, LOADER_DELAY_MS);

        return promiseFn().finally(() => {
            clearTimeout(timer);

            if (shown) {
                loaderEl.style.display = 'none';
            }
        });
    }


    /* ---------------------------------------------------------
       Filter drawer open / close
    --------------------------------------------------------- */

    filterBtn.addEventListener('click', function () {
        filterDetails.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    filterHideBtn.addEventListener('click', function () {
        filterDetails.classList.remove('active');
        document.body.style.overflow = 'initial';
    });


    /* ---------------------------------------------------------
       Price slider
    --------------------------------------------------------- */

    function updateSlider(changedEl) {
        let min = parseInt(minRange.value);
        let max = parseInt(maxRange.value);

        if (max - min <= gap) {

            if (changedEl === minRange) {
                minRange.value = max - gap;
            } else {
                maxRange.value = min + gap;
            }

            min = parseInt(minRange.value);
            max = parseInt(maxRange.value);
        }

        progress.style.left = (min / maxPrice) * 100 + '%';
        progress.style.right = 100 - (max / maxPrice) * 100 + '%';

        minValue.textContent = Number(min).toLocaleString('en-IN');
        maxValue.textContent = Number(max).toLocaleString('en-IN');
    }

    minRange.addEventListener('input', () => {
        updateSlider(minRange);
    });

    maxRange.addEventListener('input', () => {
        updateSlider(maxRange);
    });

    minRange.addEventListener('change', () => {
        applyFilters();
    });

    maxRange.addEventListener('change', () => {
        applyFilters();
    });

    updateSlider();

    const jobTitleSearch = document.getElementById('jobTitleSearch');

    if (jobTitleSearch) {

        let jobTitleTimer;

        jobTitleSearch.addEventListener('input', function () {

            clearTimeout(jobTitleTimer);

            jobTitleTimer = setTimeout(function () {
                applyFilters();
            }, 400);

        });
    }


    /* ---------------------------------------------------------
       Skill search box
    --------------------------------------------------------- */

    document.getElementById('skillSearch').addEventListener('keyup', function () {
        const value = this.value.toLowerCase();

        document.querySelectorAll('#skillList .skill-item').forEach(item => {
            const text = item.querySelector('.skill-name').innerText.toLowerCase();

            item.style.display = text.includes(value) ? 'flex' : 'none';
        });
    });


    /* ---------------------------------------------------------
       Filter checkboxes -> AJAX reload
    --------------------------------------------------------- */

    document.addEventListener('change', function (e) {

        if (
            e.target.matches(
                '#skillList input[type="checkbox"],' +
                '#categoryList input[type="checkbox"],' +
                '#locationTypeList input[type="checkbox"]'
            )
        ) {
            applyFilters();
        }
    });

    document.addEventListener('jobLocationFilterChanged', function () {
        applyFilters();
    });


    /* ---------------------------------------------------------
       Reset filters
    --------------------------------------------------------- */

    resetAllBtn.addEventListener('click', function () {

        document
            .querySelectorAll(
                '#skillList input[type="checkbox"],' +
                '#categoryList input[type="checkbox"],' +
                '#locationTypeList input[type="checkbox"]'
            )
            .forEach(cb => {
                cb.checked = false;
            });

        // Reset Job Title
        const jobTitleSearch = document.getElementById('jobTitleSearch');

        if (jobTitleSearch) {
            jobTitleSearch.value = '';
        }

        // Reset Job Location
        const selectedLocations = document.getElementById('selectedLocations');

        if (selectedLocations) {
            selectedLocations.innerHTML = '';
        }

        minRange.value = 0;
        maxRange.value = 100000;

        updateSlider();

        applyFilters();
    });


    /* ---------------------------------------------------------
       Build filter params
    --------------------------------------------------------- */

    function buildFilterParams() {

        const params = new URLSearchParams();

        // Job Title
        const jobTitle = document
            .getElementById('jobTitleSearch')
            ?.value
            .trim();

        if (jobTitle) {
            params.set('keyword', jobTitle);
        }

        document
            .querySelectorAll('#categoryList input[type="checkbox"]:checked')
            .forEach(cb => {
                params.append('category[]', cb.value);
            });

        document
            .querySelectorAll('#skillList input[type="checkbox"]:checked')
            .forEach(cb => {
                params.append('skills[]', cb.value);
            });

        document
            .querySelectorAll('#locationTypeList input[type="checkbox"]:checked')
            .forEach(cb => {
                params.append('location_type[]', cb.value);
            });

        document
            .querySelectorAll('#selectedLocations input[name="job_location[]"]')
            .forEach(input => {
                params.append('job_location[]', input.value);
            });

        if (minRange.value > 0) {
            params.set('min_budget', minRange.value);
        }

        if (maxRange.value < maxPrice) {
            params.set('max_budget', maxRange.value);
        }

        if (currentSortDir) {
            params.set('sort_dir', currentSortDir);
        }

        return params;
    }


    function applyFilters() {

        currentPage = 1;

        fetchJobList(buildFilterParams(), 1, false);
    }


    /* ---------------------------------------------------------
       Split AJAX response
    --------------------------------------------------------- */

    function splitAndPlace(html, append = false) {

        const doc = new DOMParser().parseFromString(html, 'text/html');

        const cardsChunk = doc.getElementById('jobCardsChunk');

        if (!cardsChunk) {
            return;
        }

        if (append) {
            jobListEl.insertAdjacentHTML('beforeend', cardsChunk.innerHTML);
        } else {
            jobListEl.innerHTML = cardsChunk.innerHTML;
        }

        // Update pagination information
        const meta = doc.getElementById('jobPaginationMeta');

        if (meta) {
            lastPage = parseInt(meta.dataset.lastPage || '1', 10);
        }
    }


    /* ---------------------------------------------------------
       Fetch job list
    --------------------------------------------------------- */

    function fetchJobList(params, page = 1, append = false) {

        if (append && isLoadingMore) {
            return Promise.resolve();
        }

        if (append) {
            isLoadingMore = true;

            // Stop observing while current page is being appended,
            // otherwise the trigger may stay "intersecting" and
            // IntersectionObserver won't fire for the next page.
            if (loadMoreTrigger) {
                loadMoreObserver.unobserve(loadMoreTrigger);
            }
        }

        params.set('page', page);

        return withDelayedLoader(listLoader, () =>
            fetch(
                findWorkUrl + '?' + params.toString(),
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            )
            .then(res => {

                if (!res.ok) {
                    throw new Error('HTTP ' + res.status);
                }

                return res.text();
            })
            .then(html => {

                splitAndPlace(html, append);

                currentPage = page;

                // Only open first job when the list is replaced.
                // While scrolling (append), don't reload the detail panel.
                if (!append) {
                    loadFirstJobDetail();
                }
            })
            .catch(error => {

                console.error('Job loading error:', error);

                if (!append) {
                    jobListEl.innerHTML =
                        '<p class="no-filter-results">' +
                        'Could not load jobs. Please try again.' +
                        '</p>';
                }
            })
            .finally(() => {

                if (append) {
                    isLoadingMore = false;

                    // Observe again after page has been appended.
                    if (loadMoreTrigger && currentPage < lastPage) {
                        loadMoreObserver.observe(loadMoreTrigger);
                    }
                }
            })
        );
    }


    /* ---------------------------------------------------------
       Infinite Scroll
    --------------------------------------------------------- */

    const loadMoreObserver = new IntersectionObserver(
        function (entries) {

            const entry = entries[0];

            if (!entry.isIntersecting) {
                return;
            }

            if (isLoadingMore) {
                return;
            }

            if (currentPage >= lastPage) {
                return;
            }

            const nextPage = currentPage + 1;

            fetchJobList(buildFilterParams(), nextPage, true);
        },
        {
            root: null,
            rootMargin: '300px 0px',
            threshold: 0
        }
    );

    if (loadMoreTrigger) {
        loadMoreObserver.observe(loadMoreTrigger);
    }


    /* ---------------------------------------------------------
       Sort menu
    --------------------------------------------------------- */

    sortBtn.addEventListener('click', (e) => {

        e.stopPropagation();

        sortMenu.classList.toggle('open');
    });

    document.addEventListener('click', (e) => {

        if (
            !sortMenu.contains(e.target) &&
            e.target !== sortBtn
        ) {
            sortMenu.classList.remove('open');
        }
    });

    document.querySelectorAll('.sort-item').forEach(item => {

        item.addEventListener('click', () => {

            document
                .querySelectorAll('.sort-item')
                .forEach(i => i.classList.remove('selected'));

            item.classList.add('selected');

            sortMenu.classList.remove('open');

            currentSortDir = item.dataset.dir;

            applyFilters();
        });
    });


    /* ---------------------------------------------------------
       Job card click (Mobile + Desktop)
    --------------------------------------------------------- */

    jobListEl.addEventListener('click', function (e) {

        const card = e.target.closest('.job-card');

        if (
            !card ||
            card.classList.contains('no-results-card')
        ) {
            return;
        }

        selectCard(card);

        loadJobDetail(card.dataset.jobId);
    });


    /* ---------------------------------------------------------
       Select card
    --------------------------------------------------------- */

    function selectCard(card) {

        jobListEl
            .querySelectorAll('.job-card')
            .forEach(c => {
                c.classList.remove('active');
            });

        card.classList.add('active');
    }


    /* ---------------------------------------------------------
       Load job detail
    --------------------------------------------------------- */

    function loadJobDetail(id) {

        const url = jobShowUrlTemplate.replace('__ID__', id);

        return withDelayedLoader(detailLoader, () =>

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })

            .then(res => {

                if (!res.ok) {
                    throw new Error('HTTP ' + res.status);
                }

                return res.text();
            })

            .then(html => {

                jobDetailContainer.innerHTML = html;

                // Address bar ka link hamesha current job ka rahe (page reload nahi hota)
                history.replaceState(null, '', '#job-' + id);

                // MOBILE: click ke baad list hide aur detail show
                if (window.innerWidth <= 991) {

                    listPanel.classList.add('hide');

                    detailPanel.classList.add('show');
                }
            })

            .catch(() => {

                jobDetailContainer.innerHTML =
                    '<p class="job-detail-empty">' +
                    'Could not load this job. Please try again.' +
                    '</p>';
            })
        );
    }


    /* ---------------------------------------------------------
       Open job from URL hash  (find-work#job-53)
    --------------------------------------------------------- */

    function getHashJobId() {
        const match = window.location.hash.match(/^#job-(\d+)$/);
        return match ? match[1] : null;
    }

    // URL mein #job-ID ho to wahi job kholo. true = hash wali job khuli.
    function openJobFromHash() {

        const id = getHashJobId();

        if (!id) {
            return false;
        }

        const card = jobListEl.querySelector('.job-card[data-job-id="' + id + '"]');

        if (card) {
            selectCard(card);
            card.scrollIntoView({ block: 'nearest' });
        } else {
            // Job list ke pehle page mein nahi hai, tab bhi detail khulegi
            jobListEl.querySelectorAll('.job-card').forEach(c => c.classList.remove('active'));
        }

        loadJobDetail(id);

        return true;
    }


    /* ---------------------------------------------------------
       FIRST JOB DETAIL

       Desktop  -> First job active by default
       Mobile   -> No job active by default
    --------------------------------------------------------- */

    function loadFirstJobDetail() {

        const firstCard =
            jobListEl.querySelector('.job-card:not(.no-results-card)');

        // No jobs found
        if (!firstCard) {

            jobDetailContainer.innerHTML = `
                <div class="job-detail-empty">
                    <div class="images">
                        <img src="https://lanxers.com/public/frontend/images/no-job.png" alt="">
                    </div>
                    <div class="text">
                        <h4>No Job Found</h4>
                        <p>We couldn't find any job matching your search. Try adjusting your filters or search with different keywords.</p>
                    </div>
                </div>
            `;

            return;
        }

        // MOBILE: do NOT select first card, do NOT load detail, do NOT hide list
        if (window.innerWidth <= 991) {

            jobListEl
                .querySelectorAll('.job-card')
                .forEach(card => {
                    card.classList.remove('active');
                });

            listPanel.classList.remove('hide');

            detailPanel.classList.remove('show');

            jobDetailContainer.innerHTML =
                '<p class="job-detail-empty">' +
                'Select a job to view details.' +
                '</p>';

            return;
        }

        // DESKTOP: first job active + detail open
        selectCard(firstCard);

        loadJobDetail(firstCard.dataset.jobId);
    }


    /* ---------------------------------------------------------
       Read More
    --------------------------------------------------------- */

    document.addEventListener('click', function (e) {

        const btn = e.target.closest('.read-more-btn');

        if (!btn) {
            return;
        }

        const card  = btn.closest('.read-more-card');
        const text  = btn.querySelector('.read-more-text');
        const arrow = btn.querySelector('.read-more-arrow');

        const expanded = card.classList.toggle('expanded');

        text.textContent  = expanded ? 'Read Less' : 'Read More';
        arrow.textContent = expanded ? '↑' : '↓';
    });




    /* ---------------------------------------------------------
       Share job
    --------------------------------------------------------- */

    document.addEventListener('click', function (e) {

        const btn = e.target.closest('#shareJobBtn');

        if (!btn) {
            return;
        }

        const url   = btn.dataset.url;
        const title = btn.dataset.title || 'Job';

        if (navigator.share) {

            navigator.share({ title, url }).catch(() => {});

        } else {

            navigator.clipboard
                ?.writeText(url)
                .catch(() => {});
        }
    });


    /* ---------------------------------------------------------
       Favourite toggle
    --------------------------------------------------------- */

    document.addEventListener('click', function (e) {

        const btn = e.target.closest('.js-favourite-toggle');

        if (!btn) {
            return;
        }

        const id  = btn.dataset.jobId;
        const url = favouriteUrlTemplate.replace('__ID__', id);

        fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })

        .then(res => {

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            return res.json();
        })

        .then(data => {

            const svg = btn.querySelector('svg');

            if (data.favourited) {

                btn.classList.add('is-saved');

                svg.setAttribute('fill', '#f00');

            } else {

                btn.classList.remove('is-saved');

                svg.setAttribute('fill', 'none');
            }
        })

        .catch(() => {});
    });


    /* ---------------------------------------------------------
       Apply button
    --------------------------------------------------------- */

    $(document).on('click', '.js-apply-btn', function () {

        const button = $(this);

        const jobId = button.data('job-id');

        applyForJob(jobId, button);
    });

    function applyForJob(jobId, button) {

        let formData = new FormData();

        formData.append('_token', '{{ csrf_token() }}');
        formData.append('job_id', jobId);

        showLoder();

        $.ajax({
            url: "{{ route('jobseekers.job.apply') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            beforeSend: function () {
                $('.js-apply-btn').prop('disabled', true);
            },

            success: function (response) {

                if (response.status) {

                    // Hide application/form modal if you have one
                    $('#applyJobModal').modal('hide');

                    // Show success modal
                    $('#applyModal').modal('show');

                    // Update Apply button
                    button
                        .prop('disabled', true)
                        .text('APPLIED');

                } else {
                    alert(response.message);
                }
            },

            error: function (xhr) {

                if (xhr.status === 403 && xhr.responseJSON?.profile_incomplete) {

                    alert(xhr.responseJSON.message);

                    // Send them directly to profile completion
                    window.location.href = "{{ route('jobseekers.profile') }}";

                    return;
                }

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (field, messages) {
                        alert(messages[0]);
                    });

                } else {

                    alert(
                        xhr.responseJSON?.message ||
                        'Something went wrong.'
                    );
                }
            },

            complete: function () {
                $('.js-apply-btn').prop('disabled', false);
                hideLoder();
            }
        });
    }


    /* ---------------------------------------------------------
       Mobile back button
    --------------------------------------------------------- */

    document
        .getElementById('backBtn')
        .addEventListener('click', () => {

            listPanel.classList.remove('hide');

            detailPanel.classList.remove('show');

            if (window.innerWidth <= 991) {

                jobListEl
                    .querySelectorAll('.job-card')
                    .forEach(card => {
                        card.classList.remove('active');
                    });
            }
        });


    
    /* ---------------------------------------------------------
       Responsive panel switch
    --------------------------------------------------------- */

    const mq = window.matchMedia('(min-width: 992px)');

        function applyLayout() {
            if (mq.matches) {
                // DESKTOP
                listPanel.classList.remove('hide');
                detailPanel.classList.add('show');
            } else {
                // MOBILE
                detailPanel.classList.remove('show');
                listPanel.classList.remove('hide');
            }
        }

        mq.addEventListener('change', applyLayout);

        applyLayout(); // initial


    /* ---------------------------------------------------------
       Initial render
    --------------------------------------------------------- */

    const initialTemplate = document.getElementById('initialJobsData');

    if (initialTemplate) {
        splitAndPlace(initialTemplate.innerHTML);
    }

    // Desktop: first job automatically active.
    // Mobile: no job active until user clicks a card.
    // Hash wali job ho to wahi kholo, warna pehli job (desktop)
    if (!openJobFromHash()) {
        loadFirstJobDetail();
    }

    // Same page par hash badle (link paste karke Enter) to bhi kaam kare
    window.addEventListener('hashchange', openJobFromHash);

})();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchInput       = document.getElementById('jobLocationSearch');
        const dropdown          = document.getElementById('jobLocationDropdown');
        const selectBox         = document.getElementById('locationSelectBox');
        const selectedContainer = document.getElementById('selectedLocations');

        if (!searchInput || !dropdown) return;


        // Open dropdown
        searchInput.addEventListener('focus', function () {
            filterLocations();
            dropdown.classList.add('show');
        });


        // Search
        searchInput.addEventListener('input', function () {
            filterLocations();
            dropdown.classList.add('show');
        });


        function filterLocations() {

            const searchValue = searchInput.value.trim().toLowerCase();

            const selectedValues = Array.from(
                selectedContainer.querySelectorAll('.location-tag')
            ).map(tag => tag.dataset.value.toLowerCase());

            let found = false;

            dropdown.querySelectorAll('.location-option')
                .forEach(function (option) {

                    const value      = option.dataset.value;
                    const valueLower = value.toLowerCase();

                    const matchesSearch   = valueLower.includes(searchValue);
                    const alreadySelected = selectedValues.includes(valueLower);

                    if (matchesSearch && !alreadySelected) {

                        option.style.display = 'flex';
                        found = true;

                    } else {

                        option.style.display = 'none';
                    }
                });

            let noLocation = dropdown.querySelector('.no-location');

            if (!found) {

                if (!noLocation) {

                    noLocation = document.createElement('div');

                    noLocation.className = 'no-location';

                    noLocation.textContent = 'No locations found';

                    dropdown.appendChild(noLocation);
                }

                noLocation.style.display = 'block';

            } else if (noLocation) {

                noLocation.style.display = 'none';
            }
        }


        // Select location
        dropdown.addEventListener('click', function (e) {

            const option = e.target.closest('.location-option');

            if (!option) return;

            const value = option.dataset.value;

            addLocation(value);

            searchInput.value = '';

            filterLocations();

            searchInput.focus();

            document.dispatchEvent(new CustomEvent('jobLocationFilterChanged'));
        });


        // Add selected location
        function addLocation(value) {

            const existing = Array.from(
                selectedContainer.querySelectorAll('.location-tag')
            ).some(tag =>
                tag.dataset.value.toLowerCase() === value.toLowerCase()
            );

            if (existing) return;


            const tag = document.createElement('span');

            tag.className = 'location-tag';

            tag.dataset.value = value;

            tag.innerHTML = `
                ${escapeHtml(value)}

                <button type="button" class="remove-location">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>

                <input type="hidden" name="job_location[]" value="${escapeHtml(value)}">`;

            selectedContainer.appendChild(tag);
        }


        // Remove selected location
        selectedContainer.addEventListener('click', function (e) {

            const removeButton = e.target.closest('.remove-location');

            if (!removeButton) return;

            const tag = removeButton.closest('.location-tag');

            if (tag) {
                tag.remove();
            }

            filterLocations();

            searchInput.focus();

            document.dispatchEvent(new CustomEvent('jobLocationFilterChanged'));
        });


        // Click select box
        selectBox.addEventListener('click', function (e) {

            if (e.target.closest('.remove-location')) {
                return;
            }

            searchInput.focus();

            dropdown.classList.add('show');
        });


        // Close dropdown
        document.addEventListener('click', function (e) {

            if (!e.target.closest('.location-multiselect')) {

                dropdown.classList.remove('show');
            }
        });


        // Escape HTML
        function escapeHtml(value) {

            const div = document.createElement('div');

            div.textContent = value;

            return div.innerHTML;
        }

    });

    document.addEventListener('wheel', function (e) {
        const inner = e.target.closest(
            '.list-panel,.detail-panel, .filterDetails, .skill-list'
        );

        if (!inner) return;

        const atTop = inner.scrollTop <= 0;
        const atBottom =
            inner.scrollTop + inner.clientHeight >= inner.scrollHeight - 1;

        // Scroll the outer page when the inner scroll reaches its limit
        if (
            (e.deltaY > 0 && atBottom) ||
            (e.deltaY < 0 && atTop)
        ) {
            e.preventDefault();
            window.scrollBy({
                top: e.deltaY,
                behavior: 'auto'
            });
        }
    }, { passive: false });
</script>

@endsection