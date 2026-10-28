@extends('freelancer.layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/myjoblist.css') }}?v={{ filemtime(public_path('frontend/css/myjoblist.css')) }}" />

<link rel="stylesheet" href="{{ asset('frontend/css/sidebar.css') }}?v={{ filemtime(public_path('frontend/css/sidebar.css')) }}" />

<style>
    .view-btn 
    {
        display: flex;
        vertical-align: middle;
        align-items: center;
        justify-content: center;
        gap: 0.5208333333vw;
        border-radius: 0.5208333333vw;
        border: 0.0520833333vw solid var(--Secondry-color, #00A148) !important;
        color: var(--Secondry-color, #00A148);
        font-family: Inter;
        font-size: 0.7291666667vw;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
        text-decoration: none;
        width: 6.3541666667vw;
        height: 2.0833333333vw;
    }
</style>
<section class="myjoblist">
    <div class="container-fluid">
        <div class="heading">
            <div class="title">
                <h1>My Applied Jobs</h1>
                <p>Track and Manage all your project in one place</p>
            </div>
            <div class="postjobsection">
                <img src="{{ asset('frontend/images/user-Icon.png') }}" alt="user-Icon" />
                <p>Post a job to get personal Quotes and proposal from the freelancers.</p>
                <a href="{{ route('jobseekers.find.work') }}"><span>Apply for a Job</span> <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                        <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg></a>
            </div>
        </div>
        <div class="myjoblisttab">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                            <path d="M18 4H14V2C14 0.89 13.11 0 12 0H8C6.89 0 6 0.89 6 2V4H2C0.89 4 0.00999999 4.89 0.00999999 6L0 17C0 18.11 0.89 19 2 19H18C19.11 19 20 18.11 20 17V6C20 4.89 19.11 4 18 4ZM12 4H8V2H12V4Z" fill="#00A148" />
                        </svg>
                        <span>Applied Jobs</span>
                        <span>{{ $liveJobs->total() }}</span>
                    </a>
                </li>
                <div class="line"></div>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                            <path d="M0 9.024C0 7.392 0.408 5.88 1.216 4.496C2.024 3.112 3.12 2.016 4.504 1.208C5.888 0.4 7.392 0 9.016 0C10.232 0 11.4 0.24 12.512 0.712C13.624 1.184 14.576 1.832 15.384 2.632C16.192 3.432 16.832 4.392 17.304 5.512C17.776 6.632 18.016 7.792 18.016 9.024C18.016 10.24 17.776 11.408 17.304 12.52C16.832 13.632 16.184 14.592 15.384 15.392C14.584 16.192 13.624 16.832 12.512 17.304C11.4 17.776 10.24 18.016 9.016 18.016C7.792 18.016 6.616 17.776 5.504 17.304C4.392 16.832 3.432 16.184 2.624 15.384C1.816 14.584 1.184 13.624 0.704 12.52C0.224 11.416 0 10.248 0 9.024ZM1.984 9.024C1.984 10.92 2.672 12.568 4.056 13.968C5.44 15.352 7.088 16.04 9.016 16.04C10.28 16.04 11.456 15.728 12.528 15.096C13.6 14.464 14.464 13.616 15.096 12.536C15.728 11.456 16.048 10.288 16.048 9.024C16.048 7.76 15.728 6.584 15.096 5.504C14.464 4.424 13.608 3.568 12.528 2.936C11.448 2.304 10.28 1.992 9.016 1.992C7.752 1.992 6.576 2.304 5.504 2.936C4.432 3.568 3.568 4.424 2.928 5.504C2.288 6.584 1.984 7.76 1.984 9.024ZM8.32 9.024V3.696C8.32 3.512 8.384 3.352 8.512 3.224C8.64 3.096 8.8 3.032 8.984 3.032C9.168 3.032 9.328 3.096 9.456 3.224C9.584 3.352 9.648 3.512 9.648 3.696V8.352H12.672C12.856 8.352 13.016 8.416 13.144 8.544C13.272 8.672 13.336 8.832 13.336 9.016C13.336 9.192 13.272 9.352 13.144 9.488C13.016 9.624 12.856 9.688 12.672 9.688H9.12C9.096 9.696 9.048 9.696 8.976 9.696C8.88805 9.69761 8.8007 9.6812 8.71932 9.64779C8.63795 9.61438 8.56427 9.56467 8.50282 9.50172C8.44137 9.43878 8.39345 9.36392 8.36201 9.28177C8.33057 9.19961 8.31628 9.11189 8.32 9.024Z" fill="#105BFB" />
                        </svg>
                        <span>On Going jobs</span>
                        <span>{{ $ongoingJobs->total() }}</span>
                    </a>
                </li>
                <div class="line"></div>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 0C4.5 0 0 4.5 0 10C0 15.5 4.5 20 10 20C15.5 20 20 15.5 20 10C20 4.5 15.5 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18ZM14.59 5.58L8 12.17L5.41 9.59L4 11L8 15L16 7L14.59 5.58Z" fill="#9C3AED" />
                        </svg>
                        <span>Previous Jobs</span>
                        <span>{{ $previousJobs->total() }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="myjoblisttabview">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <div class="tabviewwrapper">
                        @forelse($liveJobs as $job)
                        @php
                            $activities = array_filter([
                                'Applied'      => $job->applied_at ?? null,
                                'Profile View' => $job->profile_viewed_at ?? null,
                                'CV Download'  => $job->cv_downloaded_at ?? null,
                            ]);

                            $latestLabel = 'Applied';
                            $latestTime  = null;

                            foreach ($activities as $label => $time) {
                                $t = \Carbon\Carbon::parse($time);

                                if ($latestTime === null || $t->greaterThanOrEqualTo($latestTime)) {
                                    $latestTime  = $t;
                                    $latestLabel = $label;
                                }
                            }
                        @endphp
                        <div class="single">
                            <div class="title">
                                <h2>{{ $job->title }}</h2>
                                <p>{{ $job->company_name }}</p>
                            </div>
                            <div class="info">
                                <p>Posted On</p>
                                <h6>{{ \Carbon\Carbon::parse($job->created_at)->format('d M Y') }}</h6>
                            </div>
                            <div class="info">
                               <p>Location</p>
                               <h6>{{ $job->job_location }}</h6>
                            </div>
                            <div class="info">
                                <p>Salary</p>
                                <h6> 
                                    @if($job->budget_type === 'not_disclosed')
                                        Not Disclosed
                                    @else
                                        ₹ {{ $job->budget_max }}
                                    @endif
                                </h6>
                            </div>
                            <div class="status">
                                <p>Status</p>
                                <span class="live"> 
                                    {{ $job->status == 'open' ? 'Live' : ucfirst($job->status) }} 
                                </span>
                            </div>
                            <div class="status">
                                <p>Action</p>
                                <span class="live"> 
                                    {{ $latestLabel }}
                                </span>
                            </div>
                            <a href="{{ route('jobseekers.job.detail.page', ['slug' => $job->slug]) }}">View Job</a>
                            <!-- <button class="view-btn" data-url="{{ route('jobseekers.job.detail.ajax', ['native', $job->id]) }}">View Job</button> -->
                        </div>
                        @empty
                        <div class="nojob-state">
                            <div class="job-illustration">
                                <img src="{{ asset('frontend/images/no-job-new.png') }}" alt="">
                            </div> 
                            <h3>No Jobs Posted Yet</h3>
                            <p>You haven’t posted any jobs yet. Post a job to get personal quotes and proposals from talented freelancers.</p>
                            <button class="nojobbtn">
                                <span>Post a Job</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                                    <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        @endforelse
                    </div>
                    @if($liveJobs->hasPages())
                    <div class="paginationC">
                        <ul>

                            {{-- Previous --}}
                            <li>
                                @if($liveJobs->onFirstPage())
                                <span class="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                        <path d="M4 8L4.94 7.06L1.88667 4L4.94 0.94L4 0L0 4L4 8Z" fill="black" />
                                    </svg>
                                </span>
                                @else
                                <a href="{{ $liveJobs->previousPageUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                        <path d="M4 8L4.94 7.06L1.88667 4L4.94 0.94L4 0L0 4L4 8Z" fill="black" />
                                    </svg>
                                </a>
                                @endif
                            </li>

                            {{-- Page Numbers --}}
                            @for($i = 1; $i <= $liveJobs->lastPage(); $i++)
                                <li>
                                    <a href="{{ $liveJobs->url($i) }}"
                                        class="{{ $liveJobs->currentPage() == $i ? 'active' : '' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                                @endfor

                                {{-- Next --}}
                                <li>
                                    @if($liveJobs->hasMorePages())
                                    <a href="{{ $liveJobs->nextPageUrl() }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                            <path d="M0.94 0L0 0.94L3.05333 4L0 7.06L0.94 8L4.94 4L0.94 0Z" fill="black" />
                                        </svg>
                                    </a>
                                    @else
                                    <span class="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                            <path d="M0.94 0L0 0.94L3.05333 4L0 7.06L0.94 8L4.94 4L0.94 0Z" fill="black" />
                                        </svg>
                                    </span>
                                    @endif
                                </li>

                        </ul>
                    </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="menu1">

                    <div class="tabviewwrapper">
                        @forelse($ongoingJobs as $job)
                        <div class="single">
                            <div class="title">
                                <h2>{{ $job->title }}</h2>
                                @php
                                $skills = array_filter(array_map('trim', explode(',', $job->skills)));
                                $visibleSkills = array_slice($skills, 0, 3);
                                @endphp
                                <ul>
                                    @foreach($visibleSkills as $skill)
                                    <li>{{ $skill }}</li>
                                    @endforeach

                                    @if(count($skills) > 3)
                                    <li>+{{ count($skills) - 3 }}</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="info">
                                <p>Posted On</p>
                                <h6>{{ \Carbon\Carbon::parse($job->created_at)->format('d M Y') }}</h6>
                            </div>
                            <div class="info">
                                <p>Expected delivery</p>
                                <h6>{{ str_replace('_',' ', $job->duration) }}</h6>
                            </div>
                            <div class="info">
                                <p>Budget</p>
                                <h6>₹ {{ $job->budget_min }}</h6>
                            </div>
                            <div class="status">
                                <p>Status</p>
                                <span class="live">On Going</span>
                            </div>
                            <!--<a href="{{ route('jobseekers.job.detail.page', $job->slug) }}">View Job</a>-->
                            <button class="view-btn" data-url="{{ route('jobseekers.job.detail.ajax', ['native', $job->id]) }}">View Job</button>
                        </div>
                        @empty

                        <div class="nojob-state">
                            <div class="job-illustration">
                                <img src="{{ asset('frontend/images/no-job-new.png') }}" alt="">
                            </div> 
                            <h3>No On Going Jobs Found</h3>
                            <p>You haven’t posted any jobs yet. Post a job to get personal quotes and proposals from talented freelancers.</p>
                            <button class="nojobbtn">
                                <span>Jobs Found</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                                    <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        @endforelse
                    </div>
                    @if($ongoingJobs->hasPages())
                    <div class="paginationC">
                        <ul>

                            {{-- Previous --}}
                            <li>
                                @if($ongoingJobs->onFirstPage())
                                <span class="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                        <path d="M4 8L4.94 7.06L1.88667 4L4.94 0.94L4 0L0 4L4 8Z" fill="black" />
                                    </svg>
                                </span>
                                @else
                                <a href="{{ $ongoingJobs->previousPageUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                        <path d="M4 8L4.94 7.06L1.88667 4L4.94 0.94L4 0L0 4L4 8Z" fill="black" />
                                    </svg>
                                </a>
                                @endif
                            </li>

                            {{-- Page Numbers --}}
                            @for($i = 1; $i <= $ongoingJobs->lastPage(); $i++)
                                <li>
                                    <a href="{{ $ongoingJobs->url($i) }}"
                                        class="{{ $ongoingJobs->currentPage() == $i ? 'active' : '' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                                @endfor

                                {{-- Next --}}
                                <li>
                                    @if($ongoingJobs->hasMorePages())
                                    <a href="{{ $ongoingJobs->nextPageUrl() }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                            <path d="M0.94 0L0 0.94L3.05333 4L0 7.06L0.94 8L4.94 4L0.94 0Z" fill="black" />
                                        </svg>
                                    </a>
                                    @else
                                    <span class="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                            <path d="M0.94 0L0 0.94L3.05333 4L0 7.06L0.94 8L4.94 4L0.94 0Z" fill="black" />
                                        </svg>
                                    </span>
                                    @endif
                                </li>

                        </ul>
                    </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="menu2">

                    <div class="tabviewwrapper">
                        @forelse($previousJobs as $job)
                        <div class="single">
                            <div class="title">
                                <h2>{{ $job->title }}</h2>
                                @php
                                $skills = array_filter(array_map('trim', explode(',', $job->skills)));
                                $visibleSkills = array_slice($skills, 0, 3);
                                @endphp
                                <ul>
                                    @foreach($visibleSkills as $skill)
                                    <li>{{ $skill }}</li>
                                    @endforeach

                                    @if(count($skills) > 3)
                                    <li>+{{ count($skills) - 3 }}</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="info">
                                <p>Posted On</p>
                                <h6>{{ \Carbon\Carbon::parse($job->created_at)->format('d M Y') }}</h6>
                            </div>
                            <div class="info">
                                <p>Expected delivery</p>
                                <h6>{{ str_replace('_',' ', $job->duration) }}</h6>
                            </div>
                            <div class="info">
                                <p>Budget</p>
                                <h6>₹ {{ $job->budget_min }}</h6>
                            </div>
                            <div class="status">
                                <p>Status</p>
                                <span class="live">Previous Jobs</span>
                            </div>
                            <!--<a href="{{ route('jobseekers.job.detail.page', $job->slug) }}">View Job</a>-->
                            <button class="view-btn" data-url="{{ route('jobseekers.job.detail.ajax', ['native', $job->id]) }}">View Job</button>
                        </div>
                        @empty
                        <div class="nojob-state">
                            <div class="job-illustration">
                                <img src="{{ asset('frontend/images/no-job-new.png') }}" alt="">
                            </div> 
                            <h3>No Previous Jobs Found</h3>
                            <p>You haven’t posted any jobs yet. Post a job to get personal quotes and proposals from talented freelancers.</p>
                            <button class="nojobbtn">
                                <span>Previous Jobs</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                                    <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        @endforelse
                    </div>
                    @if($previousJobs->hasPages())
                    <div class="paginationC">
                        <ul>

                            {{-- Previous --}}
                            <li>
                                @if($previousJobs->onFirstPage())
                                <span class="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                        <path d="M4 8L4.94 7.06L1.88667 4L4.94 0.94L4 0L0 4L4 8Z" fill="black" />
                                    </svg>
                                </span>
                                @else
                                <a href="{{ $previousJobs->previousPageUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                        <path d="M4 8L4.94 7.06L1.88667 4L4.94 0.94L4 0L0 4L4 8Z" fill="black" />
                                    </svg>
                                </a>
                                @endif
                            </li>

                            {{-- Page Numbers --}}
                            @for($i = 1; $i <= $previousJobs->lastPage(); $i++)
                                <li>
                                    <a href="{{ $previousJobs->url($i) }}"
                                        class="{{ $previousJobs->currentPage() == $i ? 'active' : '' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                                @endfor

                                {{-- Next --}}
                                <li>
                                    @if($previousJobs->hasMorePages())
                                    <a href="{{ $previousJobs->nextPageUrl() }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                            <path d="M0.94 0L0 0.94L3.05333 4L0 7.06L0.94 8L4.94 4L0.94 0Z" fill="black" />
                                        </svg>
                                    </a>
                                    @else
                                    <span class="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                                            <path d="M0.94 0L0 0.94L3.05333 4L0 7.06L0.94 8L4.94 4L0.94 0Z" fill="black" />
                                        </svg>
                                    </span>
                                    @endif
                                </li>

                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="scrim" id="scrim"></div>
    
    <aside class="drawer" id="drawer" aria-hidden="true">
      <div class="drawer-head">
        <h2>Job Details</h2>
        <button class="close-btn" id="closeDrawer" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 6L18 18M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
      </div>
    
        <div class="detail-panel show" id="detailPanel">
            <div class="text-center p-5">
                Select a job to view details.
            </div>
        </div>
    
    </aside>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const params = new URLSearchParams(window.location.search);

        let tab = '#home';

        if (params.has('ongoing_page')) {
            tab = '#menu1';
        } else if (params.has('previous_page')) {
            tab = '#menu2';
        }

        const trigger = document.querySelector(`a[href="${tab}"]`);

        if (trigger) {
            new bootstrap.Tab(trigger).show();
        }

    });
</script>

<script>
    document.querySelectorAll('.read-more-card').forEach(card => {
    const button = card.querySelector('.read-more-btn');
    const text = button.querySelector('.read-more-text');
    const arrow = button.querySelector('.read-more-arrow');

    if (!button) return;

    button.addEventListener('click', () => {
        const expanded = card.classList.toggle('expanded');

        text.textContent = expanded ? 'Read Less' : 'Read More';
        arrow.textContent = expanded ? '↑' : '↓';
    });
});
</script>

<script>
  // Read More / Read Less toggle
  document.querySelectorAll('.read-more-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.read-more-card');
      card.classList.toggle('expanded');
      const label = btn.querySelector('.read-more-text');
      const arrow = btn.querySelector('.read-more-arrow');
      const expanded = card.classList.contains('expanded');
      label.textContent = expanded ? 'Read Less' : 'Read More';
      arrow.textContent = expanded ? '↑' : '↓';
    });
  });
  
  $(document).on('click', '.view-btn', function () {
    
        let url = $(this).data('url');
    
        const drawer = document.getElementById('drawer');
        const scrim = document.getElementById('scrim');
        const detailPanel = document.getElementById('detailPanel');
    
        // Open drawer immediately
        drawer.classList.add('open');
        scrim.classList.add('open');
        drawer.setAttribute('aria-hidden', 'false');
    
        // Loading
        detailPanel.innerHTML = `
            <div class="text-center p-5">
                Loading job details...
            </div>
        `;
    
        $.ajax({
            url: url,
            type: 'GET',
    
            success: function (response) {
    
                if (response.status) {
    
                    detailPanel.innerHTML = response.html;
    
                } else {
    
                    detailPanel.innerHTML = `
                        <div class="text-center p-5">
                            <p>${response.message || 'Unable to load job details.'}</p>
                        </div>
                    `;
                }
            },
    
            error: function (xhr) {
    
                console.log(xhr.responseText);
    
                detailPanel.innerHTML = `
                    <div class="text-center p-5">
                        <p>Unable to load job details.</p>
                    </div>
                `;
            }
        });
    });
    
    
    // Close drawer
    $(document).on('click', '#closeDrawer, #scrim', function () {
    
        const drawer = document.getElementById('drawer');
        const scrim = document.getElementById('scrim');
    
        drawer.classList.remove('open');
        scrim.classList.remove('open');
    
        drawer.setAttribute('aria-hidden', 'true');
    });
    
    
    // ESC key
    $(document).on('keydown', function (e) {
    
        if (e.key === 'Escape') {
    
            const drawer = document.getElementById('drawer');
            const scrim = document.getElementById('scrim');
    
            drawer.classList.remove('open');
            scrim.classList.remove('open');
    
            drawer.setAttribute('aria-hidden', 'true');
        }
    });
</script>
<script>
    $(document).on('click', '.read-more-btn', function (e) {
        e.preventDefault();
    
        const $button = $(this);
        const $card = $button.closest('.read-more-card');
    
        const $shortDescription = $card.find('.short-description');
        const $fullDescription = $card.find('.full-description');
    
        if (!$fullDescription.length) {
            return;
        }
    
        if ($fullDescription.is(':visible')) {
    
            $fullDescription.hide();
            $shortDescription.show();
    
            $button.find('.read-more-text').text('Read More');
            $button.find('.read-more-arrow').text('↓');
    
        } else {
    
            $shortDescription.hide();
            $fullDescription.show();
    
            $button.find('.read-more-text').text('Read Less');
            $button.find('.read-more-arrow').text('↑');
        }
    });
</script>
@endsection