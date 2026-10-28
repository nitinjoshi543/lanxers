<div id="jobCardsChunk">
@forelse($jobs as $job)
<div class="job-card"
     data-job-id="{{ $job->id }}"
     data-date="{{ $job->sort_date }}"
     data-title="{{ $job->title }}"
     data-employer="{{ $job->company_name }}"
     data-location="{{ $job->location_type ?? '' }}">
    <div class="job-card-top">
        <div class="job-thumb">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
        </div>
        <div>
            <p class="job-title">{{ strtoupper($job->title) }}</p>
            <p class="job-company">{{ ucfirst($job->company_name) }}</p>
        </div>
        {{-- Match % — placeholder until scoring logic exists --}}
        <span class="match-pill">0%</span>
    </div>
    <div class="job-meta">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-3 h-3"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
            @if(!empty($job->job_location))
                {{ strtoupper($job->job_location) }}
            @endif
        </span>
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-3 h-3"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
            {{ strtoupper([
                'full_time'  => 'Full Time',
                'part_time'  => 'Part Time',
                'internship' => 'Internship',
                'contract'   => 'Contract',
            ][$job->job_type ?? ''] ?? 'Not specified') }}
        </span>
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>{{ \Carbon\Carbon::parse($job->sort_date)->format('M j Y') }}
        </span>
    </div>
</div>
@empty
<div class="job-card no-results-card">
    <div class="content">
        <div class="images"><img src="{{ asset('frontend/images/no-job.png') }}" alt=""></div>
        <div class="text">
            <h4>No Job Found</h4>
            <p>We couldn't find any job matching your search. Try adjusting your filters or search with different keywords.</p>
        </div>
    </div>
</div>
@endforelse
</div>

{{-- Infinite scroll JS isko padhta hai --}}
<div
    id="jobPaginationMeta"
    data-current-page="{{ $jobs->currentPage() }}"
    data-last-page="{{ $jobs->lastPage() }}"
    style="display:none;">
</div>