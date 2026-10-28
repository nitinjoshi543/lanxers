@if(!$job)
<div class="job-detail-empty">
    <div class="images">
        <img src="https://lanxers.com/public/frontend/images/no-job.png" alt="">
    </div>
    <div class="text">
        <h4>No Job Found</h4>
        <p>We couldn't find any job matching your search. Try adjusting your filters or search with different keywords.</p>
    </div>
</div>
@else
@php
    $jobTypeLabel = [
        'full_time'  => 'Full Time',
        'part_time'  => 'Part Time',
        'internship' => 'Internship',
        'contract'   => 'Contract',
    ][$job->job_type ?? ''] ?? 'Not specified';


    $expRaw = strtolower(trim($job->experience ?? ''));

    if ($expRaw === 'fresher') {
        $experienceLabel = 'Fresher';
    } elseif (preg_match('/^(\d+)\s*-\s*(\d+)$/', $expRaw, $m)) {
        $experienceLabel = $m[1] . ' - ' . $m[2] . ' Years';
    } else {
        $experienceLabel = 'Not specified';
    }
@endphp

<div class="job-detail" id="job-{{ $job->id }}" style="display:block;">

    <div class="hero-card">
        <div class="details-card hero-card-inner">
            <div class="hero-top">
                <div class="hero-badges">
                    <button type="button" class="icon-copy-btn" id="copyJobBtn" data-url="{{ url('/jobseekers/find-work') }}#job-{{ $job->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy w-2.5 h-2.5"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path></svg>
                        <span class="copy-tooltip">Copy</span>
                    </button>
                </div>

                @auth
                    @if(auth()->user()->role === 'freelancer')
                    <button type="button" class="apply-btn js-apply-btn" data-job-id="{{ $job->id }}" {{ $alreadyApplied ? 'disabled' : '' }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-3.5 h-3.5 mr-1.5"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg> {{ $alreadyApplied ? 'Already Applied' : 'Apply Now' }}
                    </button>
                    @endif
                @endauth
            </div>

            <div class="hero-det">
                <div class="hero-title">{{ strtoupper($job->title) }}</div>
                <div class="hero-share">
                    <div class="icon-round-btn js-favourite-toggle {{ ($isFavourited ?? false) ? 'is-saved' : '' }}"
                         data-job-id="{{ $job->id }}"
                         aria-label="{{ ($isFavourited ?? false) ? 'Remove from saved' : 'Save this job' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="{{ ($isFavourited ?? false) ? '#f00' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3.5 h-3.5"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="hero-sub">
                @if(!empty($job->job_location))
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    {{ strtoupper($job->job_location) }}
                </span>
                @endif
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>{{ \Carbon\Carbon::parse($job->created_at)->format('M j Y') }}
                </span>
            </div>
        </div>
    </div>

    <div class="details-card quickinfo-card">
        <div class="section-heading">
            <div class="title-bar">
                <span class="dot-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-3.5 h-3.5 text-brand-600"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
                </span> Quick Info
            </div>
        </div>
        <div class="qi-grid">
            <div class="qi-box">
                <div class="qi-label">Experience</div>
                <div class="qi-value">{{ strtoupper($experienceLabel) }}</div>
            </div>
            <div class="qi-box">
                <div class="qi-label">Job Type</div>
                <div class="qi-value">{{ strtoupper($jobTypeLabel) }}</div>
            </div>
            <div class="qi-box">
                <div class="qi-label">Work Mode</div>
                <div class="qi-value">{{ strtoupper($job->location_type ?? 'N/A') }}</div>
            </div>
            <div class="qi-box">
                <div class="qi-label">Budget</div>
                <div class="qi-value">
                    @if(($job->budget_type ?? '') === 'not_disclosed')
                        NOT DISCLOSED
                    @else
                        ₹ {{ number_format($job->budget_min ?? 0) }} - ₹ {{ number_format($job->budget_max ?? 0) }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="details-card content-card read-more-card">
        <div class="section-heading">
            <div class="title-bar">
                <span class="dot-icon bg-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-3.5 h-3.5 text-brand-600"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
                </span> Overview
            </div>
            <button type="button" class="read-more-btn"><span class="read-more-text">Read More</span><span class="read-more-arrow">↓</span></button>
        </div>
        <p class="overview-description">{!! nl2br(e(html_entity_decode(strip_tags($job->description ?? '')))) !!}</p>
    </div>

    <div class="details-card requirements-card">
        <div class="section-heading">
            <div class="title-bar">
                <span class="dot-icon bg-red">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-3.5 h-3.5 text-red-600"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg>
                </span> Requirements
            </div>
        </div>
        <ul>
            <li>Experience: {{ strtoupper($experienceLabel) }}</li>
        </ul>
    </div>

    <div class="details-card key-respons read-more-card">
        <div class="section-heading">
            <div class="title-bar">
                <span class="dot-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-3.5 h-3.5 text-green-600"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
                </span>Key Skills
            </div>
            <button type="button" class="read-more-btn"><span class="read-more-text">Read More</span><span class="read-more-arrow">↓</span></button>
        </div>
        <ul class="responsibility-list">
            @forelse($job->skills ?? collect() as $skill)
                <li>{{ is_object($skill) ? $skill->name : $skill }}</li>
            @empty
                <li>No specific requirements listed</li>
            @endforelse
        </ul>
    </div>

    <div class="action-buttons">
        @auth
            @if(auth()->user()->role === 'freelancer')
                <button class="apply-btn js-apply-btn" type="button" data-job-id="{{ $job->id }}" {{ $alreadyApplied ? 'disabled' : '' }}>
                    <span class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9"></circle><path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </span>
                    <span>{{ $alreadyApplied ? 'ALREADY APPLIED' : 'APPLY NOW' }}</span>
                </button>

                <!-- <button class="apply-btn unlock-btn" type="button" disabled title="Coming soon">
                    <span class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="5" y="3" width="14" height="18" rx="2"></rect><path d="M9 3v3h6V3"></path><circle cx="12" cy="13" r="2"></circle><path d="M8.5 18c.8-1.3 2-2 3.5-2s2.7.7 3.5 2"></path>
                        </svg>
                    </span>
                    <span>UNLOCK CONTACT DETAILS</span>
                </button> -->
            @endif
        @else
            <a class="apply-btn" href="{{ route('jobseekers.login') }}">Login to Apply</a>
        @endauth
    </div>
</div>
@endif