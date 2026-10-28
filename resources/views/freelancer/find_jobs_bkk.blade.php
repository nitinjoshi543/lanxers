@extends('layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/job-display.css') }}?v={{ filemtime(public_path('frontend/css/job-display.css')) }}" />

<section class="jobPosted">
    <button type="button" class="filterShowDetails" id="filterShowDetails"><svg xmlns="http://www.w3.org/2000/svg"
            width="30" height="30" viewBox="0 0 30 30" fill="none">
            <path
                d="M26.5625 14.9994H11.1188M5.6675 14.9994H3.4375M5.6675 14.9994C5.6675 14.2767 5.9546 13.5835 6.46563 13.0725C6.97667 12.5615 7.66979 12.2744 8.3925 12.2744C9.11522 12.2744 9.80833 12.5615 10.3194 13.0725C10.8304 13.5835 11.1175 14.2767 11.1175 14.9994C11.1175 15.7221 10.8304 16.4152 10.3194 16.9262C9.80833 17.4373 9.11522 17.7244 8.3925 17.7244C7.66979 17.7244 6.97667 17.4373 6.46563 16.9262C5.9546 16.4152 5.6675 15.7221 5.6675 14.9994ZM26.5625 23.2581H19.3775M19.3775 23.2581C19.3775 23.981 19.0897 24.6749 18.5786 25.1861C18.0674 25.6972 17.3741 25.9844 16.6513 25.9844C15.9285 25.9844 15.2354 25.696 14.7244 25.185C14.2133 24.674 13.9262 23.9808 13.9262 23.2581M19.3775 23.2581C19.3775 22.5352 19.0897 21.8426 18.5786 21.3314C18.0674 20.8203 17.3741 20.5331 16.6513 20.5331C15.9285 20.5331 15.2354 20.8202 14.7244 21.3313C14.2133 21.8423 13.9262 22.5354 13.9262 23.2581M13.9262 23.2581H3.4375M26.5625 6.74063H22.6813M17.23 6.74063H3.4375M17.23 6.74063C17.23 6.01791 17.5171 5.3248 18.0281 4.81376C18.5392 4.30272 19.2323 4.01563 19.955 4.01563C20.3129 4.01562 20.6672 4.08611 20.9978 4.22305C21.3284 4.36 21.6288 4.56072 21.8819 4.81376C22.1349 5.0668 22.3356 5.3672 22.4726 5.69781C22.6095 6.02842 22.68 6.38277 22.68 6.74063C22.68 7.09848 22.6095 7.45283 22.4726 7.78344C22.3356 8.11405 22.1349 8.41445 21.8819 8.66749C21.6288 8.92053 21.3284 9.12125 20.9978 9.2582C20.6672 9.39514 20.3129 9.46562 19.955 9.46562C19.2323 9.46562 18.5392 9.17853 18.0281 8.66749C17.5171 8.15645 17.23 7.46334 17.23 6.74063Z"
                stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
        </svg></button>
    <div class="jobSection">
        <div class="jobDetails">
            <div class="freelancerBanner">
                <div class="text">
                    <h4>Freelancer Plus with new perks</h4>
                    <p>100 monthly Connects and full access to Uma, Upwork's Mindful AI.</p>
                    <a href="">Contact us</a>
                </div>
                <div class="images">
                    <img src="{{ asset('frontend/images/skill.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="searchJobs">
            <div class="form-group">
                <input type="text" class="form-control" id="jobKeyword" placeholder="Search for jobs">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path
                        d="M6.5 0C8.22391 0 9.87721 0.684819 11.0962 1.90381C12.3152 3.12279 13 4.77609 13 6.5C13 8.11 12.41 9.59 11.44 10.73L11.71 11H12.5L17.5 16L16 17.5L11 12.5V11.71L10.73 11.44C9.55037 12.4465 8.05065 12.9996 6.5 13C4.77609 13 3.12279 12.3152 1.90381 11.0962C0.684819 9.87721 0 8.22391 0 6.5C0 4.77609 0.684819 3.12279 1.90381 1.90381C3.12279 0.684819 4.77609 0 6.5 0ZM6.5 2C4 2 2 4 2 6.5C2 9 4 11 6.5 11C9 11 11 9 11 6.5C11 4 9 2 6.5 2Z"
                        fill="#393939" />
                </svg>
            </div>

            <div class="jobTitle">
                <p>Jobs you may like</p>
            </div>

            <div id="job-results">           
            @include('freelancer.ajax_find_jobs')
            </div>

        </div>
    </div>

    <div class="filterDetails">
        <div class="allFilter">
            <div class="text">
                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M15.9375 9.00041H6.67125M3.4005 9.00041H2.0625M3.4005 9.00041C3.4005 8.56678 3.57276 8.15091 3.87938 7.84429C4.186 7.53766 4.60187 7.36541 5.0355 7.36541C5.46913 7.36541 5.885 7.53766 6.19162 7.84429C6.49824 8.15091 6.6705 8.56678 6.6705 9.00041C6.6705 9.43404 6.49824 9.8499 6.19162 10.1565C5.885 10.4631 5.46913 10.6354 5.0355 10.6354C4.60187 10.6354 4.186 10.4631 3.87938 10.1565C3.57276 9.8499 3.4005 9.43404 3.4005 9.00041ZM15.9375 13.9557H11.6265M11.6265 13.9557C11.6265 14.3894 11.4538 14.8057 11.1471 15.1124C10.8404 15.4191 10.4245 15.5914 9.99075 15.5914C9.55712 15.5914 9.14125 15.4184 8.83463 15.1118C8.52801 14.8052 8.35575 14.3893 8.35575 13.9557M11.6265 13.9557C11.6265 13.5219 11.4538 13.1063 11.1471 12.7996C10.8404 12.493 10.4245 12.3207 9.99075 12.3207C9.55712 12.3207 9.14125 12.4929 8.83463 12.7995C8.52801 13.1062 8.35575 13.522 8.35575 13.9557M8.35575 13.9557H2.0625M15.9375 4.04516H13.6088M10.338 4.04516H2.0625M10.338 4.04516C10.338 3.61153 10.5103 3.19566 10.8169 2.88904C11.1235 2.58241 11.5394 2.41016 11.973 2.41016C12.1877 2.41016 12.4003 2.45245 12.5987 2.53461C12.7971 2.61678 12.9773 2.73721 13.1291 2.88904C13.2809 3.04086 13.4014 3.2211 13.4835 3.41947C13.5657 3.61784 13.608 3.83045 13.608 4.04516C13.608 4.25987 13.5657 4.47248 13.4835 4.67084C13.4014 4.86921 13.2809 5.04945 13.1291 5.20128C12.9773 5.3531 12.7971 5.47353 12.5987 5.5557C12.4003 5.63787 12.1877 5.68016 11.973 5.68016C11.5394 5.68016 11.1235 5.5079 10.8169 5.20128C10.5103 4.89465 10.338 4.47879 10.338 4.04516Z" stroke="#00A148" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                        </svg></span> Filter</p>
                <button type="button" class="resetAll" id="resetAll">Reset All
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path
                            d="M8.6665 2C7.07521 2 5.54908 2.63214 4.42386 3.75736C3.29865 4.88258 2.6665 6.4087 2.6665 8H0.666504L3.33317 10.66L5.99984 8H3.99984C3.99984 5.42 6.0865 3.33333 8.6665 3.33333C11.2465 3.33333 13.3332 5.42 13.3332 8C13.3332 10.58 11.2465 12.6667 8.6665 12.6667C7.37984 12.6667 6.21317 12.14 5.37317 11.2933L4.4265 12.24C4.98203 12.7988 5.64272 13.242 6.37046 13.5441C7.0982 13.8462 7.87856 14.0011 8.6665 14C10.2578 14 11.7839 13.3679 12.9091 12.2426C14.0344 11.1174 14.6665 9.5913 14.6665 8C14.6665 6.4087 14.0344 4.88258 12.9091 3.75736C11.7839 2.63214 10.2578 2 8.6665 2ZM7.99984 5.33333V8.66667L10.8332 10.3467L11.3465 9.49333L8.99984 8.1V5.33333H7.99984Z"
                            fill="#00A148" />
                    </svg>
                </button>
            </div>
        </div>

        <form id="filterForm">

            <div class="accordion" id="accordionExample">

                {{-- Price --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M12.6667 4.66667V2.66667C12.6667 2.48986 12.5964 2.32029 12.4714 2.19526C12.3464 2.07024 12.1768 2 12 2H3.33333C2.97971 2 2.64057 2.14048 2.39052 2.39052C2.14048 2.64057 2 2.97971 2 3.33333C2 3.68696 2.14048 4.02609 2.39052 4.27614C2.64057 4.52619 2.97971 4.66667 3.33333 4.66667H13.3333C13.5101 4.66667 13.6797 4.7369 13.8047 4.86193C13.9298 4.98695 14 5.15652 14 5.33333V8M14 8H12C11.6464 8 11.3072 8.14048 11.0572 8.39052C10.8071 8.64057 10.6667 8.97971 10.6667 9.33333C10.6667 9.68696 10.8071 10.0261 11.0572 10.2761C11.3072 10.5262 11.6464 10.6667 12 10.6667H14C14.1768 10.6667 14.3464 10.5964 14.4714 10.4714C14.5964 10.3464 14.6667 10.1768 14.6667 10V8.66667C14.6667 8.48986 14.5964 8.32029 14.4714 8.19526C14.3464 8.07024 14.1768 8 14 8Z" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M2 3.33203V12.6654C2 13.019 2.14048 13.3581 2.39052 13.6082C2.64057 13.8582 2.97971 13.9987 3.33333 13.9987H13.3333C13.5101 13.9987 13.6797 13.9285 13.8047 13.8034C13.9298 13.6784 14 13.5088 14 13.332V10.6654" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></span> Price
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
                                            <span id="minValue">0</span>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>Maximum</label>
                                        <div class="value-box">
                                            <span class="currency">₹</span>
                                            <span id="maxValue">1,00,000</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="slider-wrapper">
                                    <div class="slider-track"></div>
                                    <div class="slider-progress"></div>
                                    <input type="range" name="min_budget" id="minRange" min="0" max="100000" value="{{ request('min_budget', 0) }}" step="1000">
                                    <input type="range" name="max_budget" id="maxRange" min="0" max="100000" value="{{ request('max_budget', 100000) }}" step="1000">
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
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#clip0_758_14875)">
                                        <path d="M1.3335 8C1.3335 8.70133 1.4535 9.37467 1.67483 10M1.67483 10H7.3335M1.67483 10C2.08852 11.1701 2.85488 12.1831 3.86832 12.8995C4.88176 13.6159 6.09242 14.0004 7.3335 14C6.30416 14 5.45616 11.6667 5.3455 8.66667M8.67616 6H14.3348M14.6668 7.66667C14.6348 7.08533 14.5202 6.526 14.3348 6C13.9211 4.8299 13.1548 3.81688 12.1413 3.1005C11.1279 2.38411 9.91724 1.99963 8.67616 2C9.74283 2 10.6155 4.508 10.6728 7.66667" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1.3335 3.53003C1.3335 2.7987 1.3335 2.43203 1.45816 2.14803C1.5915 1.8467 1.8195 1.6047 2.1035 1.4647C2.3715 1.33203 2.71683 1.33203 3.40683 1.33203H4.00016C5.2575 1.33203 5.8855 1.33203 6.27616 1.74536C6.66683 2.1607 6.66683 2.82536 6.66683 4.1587V5.6647C6.66683 6.24536 6.66683 6.53603 6.49083 6.63603C6.31483 6.73603 6.08683 6.5747 5.63083 6.25203L5.56083 6.20336C5.2275 5.96736 5.06083 5.85003 4.8715 5.78936C4.68283 5.7287 4.48216 5.7287 4.0815 5.7287H3.40816C2.71683 5.7287 2.3715 5.7287 2.1035 5.59603C1.81471 5.45124 1.58621 5.20929 1.45816 4.9127C1.3335 4.6287 1.3335 4.2627 1.3335 3.53003ZM14.6668 11.53C14.6668 10.798 14.6668 10.432 14.5422 10.148C14.4141 9.85144 14.1856 9.60949 13.8968 9.4647C13.6288 9.33203 13.2835 9.33203 12.5935 9.33203H12.0002C10.7428 9.33203 10.1148 9.33203 9.72416 9.74536C9.3335 10.1607 9.3335 10.8254 9.3335 12.1587V13.6647C9.3335 14.2454 9.3335 14.536 9.5095 14.636C9.6855 14.736 9.9135 14.5747 10.3695 14.252L10.4395 14.2034C10.7728 13.9674 10.9395 13.85 11.1288 13.7894C11.3175 13.7287 11.5182 13.7287 11.9188 13.7287H12.5922C13.2835 13.7287 13.6288 13.7287 13.8968 13.596C14.1808 13.456 14.4095 13.214 14.5422 12.9127C14.6668 12.6287 14.6668 12.2627 14.6668 11.53Z" stroke="#00A148" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_758_14875">
                                            <rect width="16" height="16" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            Skills
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show">
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
                                    <p class="empty-hint">No skills found</p>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Category --}}
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M2 4.5C2 4.22386 2.22386 4 2.5 4H13.5C13.7761 4 14 4.22386 14 4.5C14 4.77614 13.7761 5 13.5 5H2.5C2.22386 5 2 4.77614 2 4.5ZM2 8C2 7.72386 2.22386 7.5 2.5 7.5H13.5C13.7761 7.5 14 7.72386 14 8C14 8.27614 13.7761 8.5 13.5 8.5H2.5C2.22386 8.5 2 8.27614 2 8ZM2 11.5C2 11.2239 2.22386 11 2.5 11H13.5C13.7761 11 14 11.2239 14 11.5C14 11.7761 13.7761 12 13.5 12H2.5C2.22386 12 2 11.7761 2 11.5Z" stroke="#00A148" stroke-width="1.2" stroke-linecap="round" />
                                </svg>
                            </span>
                            Category
                        </button>
                    </h2>
                    <div id="collapseCategory" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="skill-filter">

                                <div class="search-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none">
                                        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#0BA84A" stroke-width="2" />
                                        <path d="M21 21L17 17" stroke="#0BA84A" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                    <input type="text" id="categorySearch" placeholder="Search Category">
                                </div>

                                <div class="skill-list" id="categoryList">
                                    @forelse($categories as $cat)
                                    <label class="skill-item">
                                        <input type="checkbox" name="category[]" value="{{ $cat->id }}"
                                            {{ in_array($cat->id, (array) request('category', [])) || (isset($activeCategory) && $activeCategory && $activeCategory->id == $cat->id) ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                        <span class="skill-name">{{ $cat->name }}</span>
                                        <span class="count">{{ $cat->jobs_count ?? 0 }}</span>
                                    </label>
                                    @empty
                                    <p class="empty-hint">No categories found</p>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

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

        <button type="button" id="Applyfilterbutton">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                <path d="M5.99065 8.75L14.2407 0.5M14.2407 0.5L0.740653 5.375C0.668847 5.40791 0.607998 5.46074 0.565338 5.52721C0.522678 5.59369 0.5 5.67101 0.5 5.75C0.5 5.82899 0.522678 5.90631 0.565338 5.97279C0.607998 6.03926 0.668847 6.09209 0.740653 6.125L5.99065 8.75L8.61565 14C8.64856 14.0718 8.70139 14.1327 8.76786 14.1753C8.83434 14.218 8.91167 14.2407 8.99065 14.2407C9.06964 14.2407 9.14697 14.218 9.21344 14.1753C9.27992 14.1327 9.33275 14.0718 9.36565 14L14.2407 0.5Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>Apply Now</span>
        </button>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const $ = id => document.getElementById(id);

        const form = $('filterForm');
        const resultsBox = $('job-results');
        const keyword = $('jobKeyword');
        const minRange = $('minRange');
        const maxRange = $('maxRange');
        const minValue = $('minValue');
        const maxValue = $('maxValue');
        const progress = document.querySelector('.slider-progress');

        if (!form || !resultsBox) return;

        const FIND_WORK_URL = "{{ route('jobseekers.find.work') }}";
        const MAX_PRICE = 100000;
        const GAP = 1000;

        let debounceTimer;
        let activeController = null;

        /* ---------- Favourite toggle ---------- */
        const FAV_URL = "{{ route('jobseekers.job.favourite', ['job' => 999999]) }}";
        const CSRF = "{{ csrf_token() }}";
        const IS_AUTH = @json(auth()->check());

        // dono SVG ek jagah define
        const HEART_EMPTY = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/></svg>`;
        const HEART_FILL = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f00" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/></svg>`;

        resultsBox.addEventListener('click', async e => {
            const btn = e.target.closest('.favourite');
            if (!btn) return;
            e.preventDefault();

            if (!IS_AUTH) {
                window.location.href = "{{ route('jobseekers.login') }}";
                return;
            }

            const jobId = btn.dataset.jobId;
            if (!jobId || btn.disabled) return;

            const wasSaved = btn.classList.contains('is-saved');
            // optimistic: class + icon dono flip
            btn.classList.toggle('is-saved');
            btn.innerHTML = wasSaved ? HEART_EMPTY : HEART_FILL;
            btn.disabled = true;

            try {
                const res = await fetch(FAV_URL.replace('999999', jobId), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('HTTP ' + res.status);

                const data = await res.json();
                // server ki final truth pe sync
                btn.classList.toggle('is-saved', data.saved);
                btn.innerHTML = data.saved ? HEART_FILL : HEART_EMPTY;
                btn.setAttribute('aria-label', data.saved ? 'Remove from saved' : 'Save this job');

            } catch (err) {
                console.error('Favourite failed:', err);
                // rollback: class + icon dono
                btn.classList.toggle('is-saved', wasSaved);
                btn.innerHTML = wasSaved ? HEART_FILL : HEART_EMPTY;
            } finally {
                btn.disabled = false;
            }
        });

        /* ---------- Query build ---------- */
        function buildParams(page) {
            const params = new URLSearchParams(new FormData(form));
            if (keyword.value.trim()) params.set('keyword', keyword.value.trim());
            if (page > 1) params.set('page', page);
            return params;
        }

        /* ---------- Fetch ---------- */
        function fetchJobs(page = 1) {
            const params = buildParams(page);

            if (activeController) activeController.abort();
            activeController = new AbortController();

            resultsBox.style.opacity = '0.5';

            fetch(`${FIND_WORK_URL}?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    signal: activeController.signal
                })
                .then(res => {
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    return res.text();
                })
                .then(html => {
                    resultsBox.innerHTML = html;
                    history.replaceState(null, '', `${FIND_WORK_URL}?${params}`);
                })
                .catch(err => {
                    if (err.name === 'AbortError') return; // cancel — ignore
                    console.error('Jobs fetch failed:', err);
                    resultsBox.innerHTML = '<div class="no-results"><p>Kuch galat ho gaya. Dobara try karo.</p></div>';
                })
                .finally(() => {
                    resultsBox.style.opacity = '1';
                });
        }

        const debouncedFetch = () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => fetchJobs(), 400);
        };

        /* ---------- Price slider ---------- */
        function updateSlider(source) {
            let min = parseInt(minRange.value);
            let max = parseInt(maxRange.value);

            if (max - min < GAP) {
                if (source === 'min') {
                    minRange.value = Math.max(0, max - GAP);
                } else {
                    maxRange.value = Math.min(MAX_PRICE, min + GAP);
                }
                min = parseInt(minRange.value);
                max = parseInt(maxRange.value);
            }

            progress.style.left = (min / MAX_PRICE) * 100 + '%';
            progress.style.right = 100 - (max / MAX_PRICE) * 100 + '%';

            minValue.textContent = min.toLocaleString('en-IN');
            maxValue.textContent = max.toLocaleString('en-IN');
        }

        minRange.addEventListener('input', () => {
            updateSlider('min');
            debouncedFetch();
        });
        maxRange.addEventListener('input', () => {
            updateSlider('max');
            debouncedFetch();
        });

        /* ---------- Checkboxes (event delegation) ---------- */
        form.addEventListener('change', e => {
            if (e.target.type === 'checkbox') fetchJobs();
        });

        /* ---------- Keyword ---------- */
        keyword.addEventListener('input', debouncedFetch);

        /* ---------- Reset ---------- */
        $('resetAll').addEventListener('click', () => {

            form.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            form.querySelectorAll('input[type="text"], select').forEach(el => el.value = '');

            keyword.value = '';

            minRange.value = 0;
            maxRange.value = MAX_PRICE;
            updateSlider('min');

            ['skillSearch', 'categorySearch'].forEach(id => {
                const input = $(id);
                if (input) input.value = '';
            });
            document.querySelectorAll('.skill-item').forEach(item => item.style.display = 'flex');

            const basePath = "{{ route('jobseekers.find.work', [], false) }}";
            if (window.location.pathname !== basePath) {
                window.location.href = "{{ route('jobseekers.find.work') }}";
                return;
            }

            fetchJobs();
        });

        /* ---------- Apply (mobile) ---------- */
       $('Applyfilterbutton')?.addEventListener('click', () => {
            drawer.classList.remove('active');
            document.body.classList.remove('filterOpened');
            fetchJobs();
        });
        /* ---------- Pagination (delegation — links replace hote hain) ---------- */
        resultsBox.addEventListener('click', e => {
            const link = e.target.closest('.pagination a');
            if (!link) return;
            e.preventDefault();
            const page = new URL(link.href).searchParams.get('page') || 1;
            fetchJobs(page);
            resultsBox.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

        /* ---------- Skill / Language search (client-side filter) ---------- */
        const liveFilter = (inputId, listId, textSelector) => {
            const input = $(inputId);
            const list = $(listId);
            if (!input || !list) return;

            input.addEventListener('input', function() {
                const v = this.value.toLowerCase();
                list.querySelectorAll('.skill-item').forEach(item => {
                    const text = item.querySelector(textSelector)?.innerText.toLowerCase() || '';
                    item.style.display = text.includes(v) ? 'flex' : 'none';
                });
            });
        };

        liveFilter('skillSearch', 'skillList', '.skill-name');
        liveFilter('categorySearch', 'categoryList', '.skill-name');

        /* ---------- Mobile filter drawer ---------- */
        const drawer = document.querySelector('.filterDetails');
        const body = document.body;
        // Open
        $('filterShowDetails')?.addEventListener('click', () => {
            drawer.classList.add('active');
            body.classList.add('filterOpened');
        });

        // Close
        $('filterHideDetails')?.addEventListener('click', () => {
            drawer.classList.remove('active');
            body.classList.remove('filterOpened');
        });
        /* ---------- Init ---------- */
        updateSlider('min');
    });
</script>

@endsection