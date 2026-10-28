@extends('layouts.main')

@section('main-section')

<link rel="stylesheet" href="{{ asset('frontend/css/browse-freelancer.css') }}?v={{ filemtime(public_path('frontend/css/browse-freelancer.css')) }}">

<section class="browseFreelance">
<div class="container-fluid">
    <button type="button" class="filterShowDetails" id="filterShowDetails"><svg xmlns="http://www.w3.org/2000/svg"
            width="30" height="30" viewBox="0 0 30 30" fill="none">
            <path
                d="M26.5625 14.9994H11.1188M5.6675 14.9994H3.4375M5.6675 14.9994C5.6675 14.2767 5.9546 13.5835 6.46563 13.0725C6.97667 12.5615 7.66979 12.2744 8.3925 12.2744C9.11522 12.2744 9.80833 12.5615 10.3194 13.0725C10.8304 13.5835 11.1175 14.2767 11.1175 14.9994C11.1175 15.7221 10.8304 16.4152 10.3194 16.9262C9.80833 17.4373 9.11522 17.7244 8.3925 17.7244C7.66979 17.7244 6.97667 17.4373 6.46563 16.9262C5.9546 16.4152 5.6675 15.7221 5.6675 14.9994ZM26.5625 23.2581H19.3775M19.3775 23.2581C19.3775 23.981 19.0897 24.6749 18.5786 25.1861C18.0674 25.6972 17.3741 25.9844 16.6513 25.9844C15.9285 25.9844 15.2354 25.696 14.7244 25.185C14.2133 24.674 13.9262 23.9808 13.9262 23.2581M19.3775 23.2581C19.3775 22.5352 19.0897 21.8426 18.5786 21.3314C18.0674 20.8203 17.3741 20.5331 16.6513 20.5331C15.9285 20.5331 15.2354 20.8202 14.7244 21.3313C14.2133 21.8423 13.9262 22.5354 13.9262 23.2581M13.9262 23.2581H3.4375M26.5625 6.74063H22.6813M17.23 6.74063H3.4375M17.23 6.74063C17.23 6.01791 17.5171 5.3248 18.0281 4.81376C18.5392 4.30272 19.2323 4.01563 19.955 4.01563C20.3129 4.01562 20.6672 4.08611 20.9978 4.22305C21.3284 4.36 21.6288 4.56072 21.8819 4.81376C22.1349 5.0668 22.3356 5.3672 22.4726 5.69781C22.6095 6.02842 22.68 6.38277 22.68 6.74063C22.68 7.09848 22.6095 7.45283 22.4726 7.78344C22.3356 8.11405 22.1349 8.41445 21.8819 8.66749C21.6288 8.92053 21.3284 9.12125 20.9978 9.2582C20.6672 9.39514 20.3129 9.46562 19.955 9.46562C19.2323 9.46562 18.5392 9.17853 18.0281 8.66749C17.5171 8.15645 17.23 7.46334 17.23 6.74063Z"
                stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
        </svg></button>
    <div class="pageTitle">
        <div class="text">
            <p>Browse Freelancers</p>
            <span>Explore with the skilled freelancers. Invite and hire for the best fit for your Project.</span>
        </div>
        <div class="rightText">
            <div class="images">
                <img src="{{ asset('frontend/images/user-Icon.png') }}  " alt="">
            </div>
            <p>Post a job to get personal Quotes and proposal from the freelancers.</p>
            <a href="{{ route('employer.post.job') }}" type="button" class="postJob">Post a Job
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                    <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="white" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>

    <div class="searchTopSkill">
        <div class="form-group">
            <input type="text" class="form-control" id="talentKeyword" value="{{ request('keyword') }}" placeholder="Search by Skill Name or Keyword....">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path
                    d="M7.91667 13.3333C6.40278 13.3333 5.12167 12.8089 4.07333 11.76C3.025 10.7111 2.50056 9.43 2.5 7.91667C2.49944 6.40333 3.02389 5.12222 4.07333 4.07333C5.12278 3.02444 6.40389 2.5 7.91667 2.5C9.42944 2.5 10.7108 3.02444 11.7608 4.07333C12.8108 5.12222 13.335 6.40333 13.3333 7.91667C13.3333 8.52778 13.2361 9.10417 13.0417 9.64583C12.8472 10.1875 12.5833 10.6667 12.25 11.0833L16.9167 15.75C17.0694 15.9028 17.1458 16.0972 17.1458 16.3333C17.1458 16.5694 17.0694 16.7639 16.9167 16.9167C16.7639 17.0694 16.5694 17.1458 16.3333 17.1458C16.0972 17.1458 15.9028 17.0694 15.75 16.9167L11.0833 12.25C10.6667 12.5833 10.1875 12.8472 9.64583 13.0417C9.10417 13.2361 8.52778 13.3333 7.91667 13.3333ZM7.91667 11.6667C8.95833 11.6667 9.84389 11.3022 10.5733 10.5733C11.3028 9.84444 11.6672 8.95889 11.6667 7.91667C11.6661 6.87444 11.3017 5.98917 10.5733 5.26083C9.845 4.5325 8.95944 4.16778 7.91667 4.16667C6.87389 4.16556 5.98861 4.53028 5.26083 5.26083C4.53306 5.99139 4.16833 6.87667 4.16667 7.91667C4.165 8.95667 4.52972 9.84222 5.26083 10.5733C5.99195 11.3044 6.87722 11.6689 7.91667 11.6667Z"
                    fill="#524949" />
            </svg>
        </div>
        <div class="topSearches">
            <p>Popular Searches :</p>
            <ul>
                @forelse($skills->where('popular', 1) as $skill)
                <li class="quick-search">{{ $skill->name }}</li>
                @empty
                <li>No popular skills</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="freelanceJob">

        <div class="filterDetails">
            <div class="allFilter">
                <div class="text">
                    <p>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M15.9375 9.00041H6.67125M3.4005 9.00041H2.0625M3.4005 9.00041C3.4005 8.56678 3.57276 8.15091 3.87938 7.84429C4.186 7.53766 4.60187 7.36541 5.0355 7.36541C5.46913 7.36541 5.885 7.53766 6.19162 7.84429C6.49824 8.15091 6.6705 8.56678 6.6705 9.00041C6.6705 9.43404 6.49824 9.8499 6.19162 10.1565C5.885 10.4631 5.46913 10.6354 5.0355 10.6354C4.60187 10.6354 4.186 10.4631 3.87938 10.1565C3.57276 9.8499 3.4005 9.43404 3.4005 9.00041ZM15.9375 13.9557H11.6265M11.6265 13.9557C11.6265 14.3894 11.4538 14.8057 11.1471 15.1124C10.8404 15.4191 10.4245 15.5914 9.99075 15.5914C9.55712 15.5914 9.14125 15.4184 8.83463 15.1118C8.52801 14.8052 8.35575 14.3893 8.35575 13.9557M11.6265 13.9557C11.6265 13.5219 11.4538 13.1063 11.1471 12.7996C10.8404 12.493 10.4245 12.3207 9.99075 12.3207C9.55712 12.3207 9.14125 12.4929 8.83463 12.7995C8.52801 13.1062 8.35575 13.522 8.35575 13.9557M8.35575 13.9557H2.0625M15.9375 4.04516H13.6088M10.338 4.04516H2.0625M10.338 4.04516C10.338 3.61153 10.5103 3.19566 10.8169 2.88904C11.1235 2.58241 11.5394 2.41016 11.973 2.41016C12.1877 2.41016 12.4003 2.45245 12.5987 2.53461C12.7971 2.61678 12.9773 2.73721 13.1291 2.88904C13.2809 3.04086 13.4014 3.2211 13.4835 3.41947C13.5657 3.61784 13.608 3.83045 13.608 4.04516C13.608 4.25987 13.5657 4.47248 13.4835 4.67084C13.4014 4.86921 13.2809 5.04945 13.1291 5.20128C12.9773 5.3531 12.7971 5.47353 12.5987 5.5557C12.4003 5.63787 12.1877 5.68016 11.973 5.68016C11.5394 5.68016 11.1235 5.5079 10.8169 5.20128C10.5103 4.89465 10.338 4.47879 10.338 4.04516Z"
                                    stroke="#00A148" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" />
                            </svg>
                        </span>
                        Filter
                    </p>
                    <button type="button" class="resetAll" id="resetAll">Reset All
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                            fill="none">
                            <path
                                d="M8.6665 2C7.07521 2 5.54908 2.63214 4.42386 3.75736C3.29865 4.88258 2.6665 6.4087 2.6665 8H0.666504L3.33317 10.66L5.99984 8H3.99984C3.99984 5.42 6.0865 3.33333 8.6665 3.33333C11.2465 3.33333 13.3332 5.42 13.3332 8C13.3332 10.58 11.2465 12.6667 8.6665 12.6667C7.37984 12.6667 6.21317 12.14 5.37317 11.2933L4.4265 12.24C4.98203 12.7988 5.64272 13.242 6.37046 13.5441C7.0982 13.8462 7.87856 14.0011 8.6665 14C10.2578 14 11.7839 13.3679 12.9091 12.2426C14.0344 11.1174 14.6665 9.5913 14.6665 8C14.6665 6.4087 14.0344 4.88258 12.9091 3.75736C11.7839 2.63214 10.2578 2 8.6665 2ZM7.99984 5.33333V8.66667L10.8332 10.3467L11.3465 9.49333L8.99984 8.1V5.33333H7.99984Z"
                                fill="#00A148" />
                        </svg>
                    </button>
                </div>
            </div>

            <form id="filterForm">
                <div class="accordion" id="accordionExample">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M15.9375 9.00041H6.67125M3.4005 9.00041H2.0625M3.4005 9.00041C3.4005 8.56678 3.57276 8.15091 3.87938 7.84429C4.186 7.53766 4.60187 7.36541 5.0355 7.36541C5.46913 7.36541 5.885 7.53766 6.19162 7.84429C6.49824 8.15091 6.6705 8.56678 6.6705 9.00041C6.6705 9.43404 6.49824 9.8499 6.19162 10.1565C5.885 10.4631 5.46913 10.6354 5.0355 10.6354C4.60187 10.6354 4.186 10.4631 3.87938 10.1565C3.57276 9.8499 3.4005 9.43404 3.4005 9.00041ZM15.9375 13.9557H11.6265M11.6265 13.9557C11.6265 14.3894 11.4538 14.8057 11.1471 15.1124C10.8404 15.4191 10.4245 15.5914 9.99075 15.5914C9.55712 15.5914 9.14125 15.4184 8.83463 15.1118C8.52801 14.8052 8.35575 14.3893 8.35575 13.9557M11.6265 13.9557C11.6265 13.5219 11.4538 13.1063 11.1471 12.7996C10.8404 12.493 10.4245 12.3207 9.99075 12.3207C9.55712 12.3207 9.14125 12.4929 8.83463 12.7995C8.52801 13.1062 8.35575 13.522 8.35575 13.9557M8.35575 13.9557H2.0625M15.9375 4.04516H13.6088M10.338 4.04516H2.0625M10.338 4.04516C10.338 3.61153 10.5103 3.19566 10.8169 2.88904C11.1235 2.58241 11.5394 2.41016 11.973 2.41016C12.1877 2.41016 12.4003 2.45245 12.5987 2.53461C12.7971 2.61678 12.9773 2.73721 13.1291 2.88904C13.2809 3.04086 13.4014 3.2211 13.4835 3.41947C13.5657 3.61784 13.608 3.83045 13.608 4.04516C13.608 4.25987 13.5657 4.47248 13.4835 4.67084C13.4014 4.86921 13.2809 5.04945 13.1291 5.20128C12.9773 5.3531 12.7971 5.47353 12.5987 5.5557C12.4003 5.63787 12.1877 5.68016 11.973 5.68016C11.5394 5.68016 11.1235 5.5079 10.8169 5.20128C10.5103 4.89465 10.338 4.47879 10.338 4.04516Z" stroke="#00A148" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"></path>
                                    </svg></span> Skills
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="skill-filter">
                                    <div class="search-box">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none">
                                                <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#0BA84A" stroke-width="2"></path>
                                                <path d="M21 21L17 17" stroke="#0BA84A" stroke-width="2" stroke-linecap="round"></path>
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
                                            <span class="count">{{ $skill->users_count }}</span>
                                        </label>
                                        @empty
                                        <p class="empty-hint">No skills found</p>
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

            <button type="submit" id="Applyfilterbutton" fdprocessedid="tdkuj5">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                    <path
                        d="M5.99065 8.75L14.2407 0.5M14.2407 0.5L0.740653 5.375C0.668847 5.40791 0.607998 5.46074 0.565338 5.52721C0.522678 5.59369 0.5 5.67101 0.5 5.75C0.5 5.82899 0.522678 5.90631 0.565338 5.97279C0.607998 6.03926 0.668847 6.09209 0.740653 6.125L5.99065 8.75L8.61565 14C8.64856 14.0718 8.70139 14.1327 8.76786 14.1753C8.83434 14.218 8.91167 14.2407 8.99065 14.2407C9.06964 14.2407 9.14697 14.218 9.21344 14.1753C9.27992 14.1327 9.33275 14.0718 9.36565 14L14.2407 0.5Z"
                        stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>Apply Now</span>
            </button>
        </div>

        <div class="jobsug" id="talent-results">              
            @include('employer.ajax_find_talent')
        </div>

    </div>
</div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const $ = id => document.getElementById(id);

        const form = $('filterForm');
        const resultsBox = $('talent-results');
        const keyword = $('talentKeyword');

        if (!form || !resultsBox) return;

        const TALENT_URL = "{{ route('employer.find.talent') }}";

        let debounceTimer;
        let activeController = null;

        function fetchTalent(page = 1) {
            const params = new URLSearchParams(new FormData(form));
            if (keyword.value.trim()) params.set('keyword', keyword.value.trim());
            if (page > 1) params.set('page', page);

            // purani request cancel — warna slow response nayi ko overwrite karega
            if (activeController) activeController.abort();
            activeController = new AbortController();

            resultsBox.style.opacity = '0.5';

            fetch(`${TALENT_URL}?${params}`, {
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
                    history.replaceState(null, '', `${TALENT_URL}?${params}`);
                })
                .catch(err => {
                    if (err.name === 'AbortError') return;
                    console.error('Talent fetch failed:', err);
                    resultsBox.innerHTML = '<div class="no-results"><p>Kuch galat ho gaya. Dobara try karo.</p></div>';
                })
                .finally(() => {
                    resultsBox.style.opacity = '1';
                });
        }

        const debouncedFetch = () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => fetchTalent(), 400);
        };

        /* ---------- Favourite toggle ---------- */
        const FAV_URL = "{{ route('employer.freelancer.favourite', ['freelancer' => 999999]) }}";
        const CSRF = "{{ csrf_token() }}";

        // dono SVG strings — ek jagah
        const HEART_OUTLINE = `<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" class="heart-outline"><path d="M3.35671 9.69923C3.04369 9.38829 2.79568 9.01816 2.62715 8.61041C2.45861 8.20265 2.37291 7.76544 2.37504 7.32423C2.37504 6.43189 2.72952 5.5761 3.3605 4.94511C3.99149 4.31413 4.84728 3.95965 5.73962 3.95965C6.99046 3.95965 8.08296 4.64048 8.66087 5.65382H9.54754C9.84134 5.13849 10.2665 4.71022 10.7796 4.41262C11.2927 4.11503 11.8756 3.95873 12.4688 3.95965C13.3611 3.95965 14.2169 4.31413 14.8479 4.94511C15.4789 5.5761 15.8334 6.43189 15.8334 7.32423C15.8334 8.25048 15.4375 9.10548 14.8517 9.69923L9.10421 15.4388L3.35671 9.69923ZM15.4059 10.2613C16.158 9.50132 16.625 8.47215 16.625 7.32423C16.625 6.22193 16.1872 5.16477 15.4077 4.38532C14.6283 3.60587 13.5711 3.16798 12.4688 3.16798C11.0834 3.16798 9.85629 3.8409 9.10421 4.8859C8.72033 4.35271 8.21485 3.91873 7.62971 3.61997C7.04457 3.3212 6.39663 3.16626 5.73962 3.16798C4.63732 3.16798 3.58016 3.60587 2.80071 4.38532C2.02126 5.16477 1.58337 6.22193 1.58337 7.32423C1.58337 8.47215 2.05046 9.50132 2.80254 10.2613L9.10421 16.563L15.4059 10.2613Z" fill="#7D7D7D"/></svg>`;

        const HEART_FILLED = `<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" class="heart-filled"><path fill="#FF0000" d="M9.10421 15.4388L3.35671 9.69923C3.04369 9.38829 2.79568 9.01816 2.62715 8.61041C2.45861 8.20265 2.37291 7.76544 2.37504 7.32423C2.37504 6.43189 2.72952 5.5761 3.3605 4.94511C3.99149 4.31413 4.84728 3.95965 5.73962 3.95965C6.99046 3.95965 8.08296 4.64048 8.66087 5.65382C8.95467 5.13849 9.37984 4.71022 9.89296 4.41262C10.4061 4.11503 10.989 3.95873 11.5821 3.95965C12.4745 3.95965 13.3303 4.31413 13.9613 4.94511C14.5922 5.5761 14.9467 6.43189 14.9467 7.32423C14.9467 8.25048 14.5509 9.10548 13.965 9.69923L9.10421 15.4388Z"/></svg>`;

        resultsBox.addEventListener('click', async e => {
            const btn = e.target.closest('.favIcon');
            if (!btn || btn.disabled) return;
            e.preventDefault();

            const id = btn.dataset.freelancerId;
            if (!id) return;

            const wasSaved = btn.classList.contains('is-saved');

            // optimistic UI — class + icon dono flip
            btn.classList.toggle('is-saved');
            btn.innerHTML = wasSaved ? HEART_OUTLINE : HEART_FILLED;
            btn.setAttribute('aria-label', wasSaved ? 'Save this freelancer' : 'Remove from saved');
            btn.disabled = true;

            try {
                const res = await fetch(FAV_URL.replace('999999', id), {
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
                btn.innerHTML = data.saved ? HEART_FILLED : HEART_OUTLINE;
                btn.setAttribute('aria-label', data.saved ? 'Remove from saved' : 'Save this freelancer');

            } catch (err) {
                console.error('Favourite failed:', err);
                // rollback — class + icon dono
                btn.classList.toggle('is-saved', wasSaved);
                btn.innerHTML = wasSaved ? HEART_FILLED : HEART_OUTLINE;
                btn.setAttribute('aria-label', wasSaved ? 'Remove from saved' : 'Save this freelancer');
            } finally {
                btn.disabled = false;
            }
        });

        /* ---------- Filters ---------- */
        form.addEventListener('change', e => {
            if (e.target.type === 'checkbox' && e.target.name) fetchTalent();
        });

        keyword.addEventListener('input', debouncedFetch);

        document.querySelectorAll('.quick-search').forEach(li => {
            li.addEventListener('click', () => {
                keyword.value = li.textContent.trim();
                fetchTalent();
            });
        });

        /* ---------- Reset ---------- */
        $('resetAll').addEventListener('click', () => {
            // form.reset() HTML default pe wapas jaata hai, aur blade
            // checked checkboxes ko HTML me hi render karta hai
            form.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            keyword.value = '';

            ['skillSearch', 'languageSearch'].forEach(id => {
                const input = $(id);
                if (input) input.value = '';
            });
            document.querySelectorAll('.skill-item, .language-item')
                .forEach(item => item.style.display = 'flex');

            fetchTalent();
        });

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
            fetchTalent(page);
            resultsBox.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

        /* ---------- Skill / Language live search ---------- */
        const liveFilter = (inputId, listId, itemSelector, textSelector) => {
            const input = $(inputId);
            const list = $(listId);
            if (!input || !list) return;

            input.addEventListener('input', function() {
                const v = this.value.toLowerCase();
                list.querySelectorAll(itemSelector).forEach(item => {
                    const text = item.querySelector(textSelector)?.innerText.toLowerCase() || '';
                    item.style.display = text.includes(v) ? 'flex' : 'none';
                });
            });
        };

        liveFilter('skillSearch', 'skillList', '.skill-item', '.skill-name');
        liveFilter('languageSearch', 'languageList', '.language-item', '.language');

        /* ---------- Mobile drawer ---------- */
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
    });
</script>

@endsection