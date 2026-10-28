
        <div class="job-detail" id="job-1">
          <div class="hero-card">
            <div class="details-card hero-card-inner">
              
              <div class="hero-det">
                <div class="hero-title">{{ $job->title }}</div>
                <div class="hero-share">
                  <div class="icon-round-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"></line><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"></line></svg>
                  </div>
                  <div class="icon-round-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
                  </div>
                </div>
              </div>
              <div class="hero-sub">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                  NOC: 82030
                </span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  {{ $job->location_type ?? $job->ai_work_arrangement ?? 'Remote' }}
                </span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>{{ \Carbon\Carbon::parse($job->sort_date ?? $job->created_at)->format('n/j/Y') }}
                </span>
              </div>
              <span class="tag-agri">
                    {{ $job->category_name ?? 'General' }}
              </span>
            </div>
          </div>
    
          <div class="details-card quickinfo-card">
            <div class="section-heading">
              <div class="title-bar">
                <span class="dot-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
                </span> Quick Info
              </div>
            </div>
            <div class="qi-grid">
              <div class="qi-box"><div class="qi-label">Experience</div><div class="qi-value">{{ $job->job_type === 'native' ? ($job->experience_level ?? 'Not specified') : ($job->ai_experience_level ?? 'Not specified') }}</div></div>
              <div class="qi-box"><div class="qi-label">Type</div><div class="qi-value">{{ $job->job_type === 'native' ? ($job->budget_type ?? 'Not specified') : 'External Listing' }}</div></div>
              <div class="qi-box"><div class="qi-label">Work Mode</div><div class="qi-value">{{ $job->location_type ?? $job->ai_work_arrangement ?? 'N/A' }}</div></div>
              <div class="qi-box">
                  <div class="qi-label">{{ $job->job_type === 'native' ? 'Budget' : 'Salary' }}</div>
                    <div class="qi-value">
                        @if($job->job_type === 'native')
                            ₹ {{ number_format($job->budget_min) }} - ₹ {{ number_format($job->budget_max) }}
                        @else
                            {{ $job->salary ?? 'Not disclosed' }}
                        @endif
                    </div>
              </div>
            </div>
          </div>
    
          <div class="details-card content-card read-more-card">
            <div class="section-heading">
              <div class="title-bar">
                <span class="dot-icon bg-blue">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
                </span> Overview
              </div>
              <button type="button" class="read-more-btn"><span class="read-more-text">Read More</span><span class="read-more-arrow">↓</span></button>
            </div>
            @php
                $description = html_entity_decode(
                    strip_tags($job->description ?? $job->description_text ?? '')
                );
        
                $words = preg_split('/\s+/', trim($description));
        
                $shortDescription = implode(' ', array_slice($words, 0, 100));
                $hasMore = count($words) > 100;
            @endphp
        
            <div class="overview-content">
                <p class="short-description">
                    {!! nl2br(e($shortDescription)) !!}
                    @if($hasMore)
                        ...
                    @endif
                </p>
        
                @if($hasMore)
                    <p class="full-description" style="display:none;">
                        {!! nl2br(e($description)) !!}
                    </p>
                @endif
            </div>
            <!--<p>{!! nl2br(e(html_entity_decode(strip_tags($job->description ?? $job->description_text ?? '')))) !!}</p>-->
          </div>
    
          <div class="details-card requirements-card">
            <div class="section-heading">
              <div class="title-bar">
                <span class="dot-icon bg-red">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg>
                </span> Requirements
              </div>
            </div>
            @php $exp = $job->job_type === 'native' ? ($job->experience_level ?? null) : ($job->ai_experience_level ?? null); @endphp
            <ul>
                {{-- No "Education" field exists on either job table — omitted rather than faked --}}
                <li>Experience: {{ $exp ?? 'Not specified' }}</li>
            </ul>
          </div>
    
          <div class="details-card key-respons read-more-card">
            <div class="section-heading">
              <div class="title-bar">
                <span class="dot-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
                </span>Key Responsibilities
              </div>
              <button type="button" class="read-more-btn"><span class="read-more-text">Read More</span><span class="read-more-arrow">↓</span></button>
            </div>
            <ul class="responsibility-list">
                @php $skillList = $job->job_type === 'native' ? ($job->skills ?? collect()) : collect($job->key_skills ?? []); @endphp
                @forelse($skillList as $skill)
                    <li>{{ is_object($skill) ? $skill->name : $skill }}</li>
                @empty
                    <li>No specific requirements listed</li>
                @endforelse
            </ul>
          </div>
        </div>
      
     