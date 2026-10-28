@forelse($jobs as $job)
<div class="jobDesc" data-job-type="{{ $job->job_type }}">
    <div class="descTitle">
        <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M1.6665 10.225C3.79868 11.0545 6.04878 11.5411 8.33318 11.6667V13.3333H11.6665V11.6667C13.9454 11.5239 16.1913 11.0495 18.3332 10.2583V16.6667H1.6665V10.225ZM12.4998 2.5L13.3332 3.33332V5H18.3332V9.34168C15.778 10.2957 13.0771 10.8004 10.3498 10.8333H9.74982C6.98599 10.8034 4.2493 10.2843 1.6665 9.3V5H6.6665V3.33332L7.49982 2.5H12.4998ZM11.6665 4.16668H8.33318V5H11.6665V4.16668Z"
                    fill="#00A148" />
            </svg>
        </div>
        <div class="text">
            {{-- CHANGED: created_at -> sort_date (union alias) --}}
            <span>Posted {{ \Carbon\Carbon::parse($job->sort_date)->diffForHumans(null, true) }} ago</span>
            <p>{{ $job->title }}</p>

            {{-- NEW: source badge for external jobs --}}
            @if($job->job_type === 'external')
                <span class="ext-badge">{{ ucfirst($job->source) }}</span>
            @endif
        </div>
        {{-- CHANGED: favourite button now gated on job_type === 'native' too --}}
        @auth
        @if(auth()->user()->role === 'freelancer' && $job->job_type === 'native')
        <button type="button" class="favourite btn ms-auto d-block {{ $job->is_favourited ? 'is-saved' : '' }}" data-job-id="{{ $job->id }}" data-job-type="native" aria-label="{{ $job->is_favourited ? 'Remove from saved' : 'Save this job' }}">
            @if($job->is_favourited)
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f00" class="bi bi-heart-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
            </svg>
            @else
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
            </svg>
            @endif
        </button>
        @endif
        @endauth
    </div>
    <div class="whoPosted">
        <div class="user">
            <div class="images">
                {{-- CHANGED: profile_photo -> company_logo (unified alias from controller) --}}
                <img src="{{ $job->company_logo ?: 'https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg' }}" alt="{{ $job->company_name }}"
                    onerror="this.onerror=null;this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg'">
            </div>
            <div class="text">
                <p>{{ $job->company_name }}</p>
            </div>
        </div>
        <div class="skiils">
            <p>Skills</p>
            <ul>
                @forelse($job->skills->take(5) as $skill)
                {{-- CHANGED: native skills are objects ({{ $skill->name }}), external skills
                     (if you added ai_key_skills to controller SELECT) are decoded as plain strings.
                     This ternary handles both without erroring. --}}
                <li>{{ is_object($skill) ? $skill->name : $skill }}</li>
                @empty
                <li class="muted">No skills listed</li>
                @endforelse

                @if($job->skills->count() > 5)
                <li>{{ $job->skills->count() - 5 }}+</li>
                @endif
            </ul>
        </div>
        <div class="payment">
            {{-- CHANGED: native shows structured budget_min, external has none (NULL from union)
                 -> fallback to salary text if you add it to SELECT, else generic label --}}
            @if($job->job_type === 'native')
                <p>₹ {{ number_format($job->budget_min) }}</p>
            @else
                <p>{{ $job->salary ?? 'View on LinkedIn' }}</p>
            @endif

            {{-- CHANGED: slug-based route doesn't exist for external jobs —
                 must use the source-prefixed job_url built in the controller --}}
            <a class="know" href="{{ $job->job_url }}"
               @if($job->job_type === 'external') target="_blank" rel="noopener" @endif>
               Know More
            </a>
        </div>
    </div>
    <div class="abtDesc">
        <p>{{ Str::limit(html_entity_decode(strip_tags($job->description)), 300) }}</p>
    </div>
</div>
@empty
<div class="jobDesc">
    <div class="content">
        <div class="images">
            <img src="{{ asset('frontend/images/no-job.png') }}" alt="">
        </div>
        <div class="text">
            <h4>No Job Found</h4>
            <p>We couldn't find any job matching your search.Try adjusting your filters or search with
                different keywords.</p>
        </div>
    </div>
</div>
@endforelse

{{-- pagination block unchanged --}}
@if($jobs->hasPages())
<div class="paginationC">
    <ul>

        {{-- Previous --}}
        <li>
            @if($jobs->onFirstPage())
            <span class="disabled">
                <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                    <path d="M4 8L4.94 7.06L1.88667 4L4.94 0.94L4 0L0 4L4 8Z" fill="black" />
                </svg>
            </span>
            @else
            <a href="{{ $jobs->previousPageUrl() }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                    <path d="M4 8L4.94 7.06L1.88667 4L4.94 0.94L4 0L0 4L4 8Z" fill="black" />
                </svg>
            </a>
            @endif
        </li>

        {{-- Page Numbers --}}
        @for($i = 1; $i <= $jobs->lastPage(); $i++)
            <li>
                <a href="{{ $jobs->url($i) }}"
                    class="{{ $jobs->currentPage() == $i ? 'active' : '' }}">
                    {{ $i }}
                </a>
            </li>
            @endfor

            {{-- Next --}}
            <li>
                @if($jobs->hasMorePages())
                <a href="{{ $jobs->nextPageUrl() }}">
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