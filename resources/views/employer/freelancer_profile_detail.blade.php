@extends('employer.layouts.main')

@section('main-section')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/css/profile-page.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">

@php
    $languages   = json_decode($freelancer->languages ?? '{}', true) ?: [];
@endphp
<section class="profile-user-page">
    <img src="{{ asset('frontend/images/bg-img1.png') }}" class="bg-img1" alt="">
    <img src="{{ asset('frontend/images/bg-img2.png') }}" class="bg-img2" alt="">
    <img src="{{ asset('frontend/images/bg-img3.png') }}" class="bg-img3" alt="">

    <div class="profile-inner-box">
        <!-- ===== SIDEBAR ===== -->
        <aside>
            <div class="side-card" id="personaldetails">
                <div class="profile-head">
                    <div class="avatar">
                        <img src="{{ $freelancer->profile_photo ?: 'https://idpdefault.s3.ap-south-1.amazonaws.com/6aa904db5b674.jpg' }}"
                             alt="{{ $freelancer->name }}"
                             onerror="this.onerror=null;this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6aa904db5b674.jpg'">
                    </div>
                    <div class="freenlan-info">
                        <h2>{{ $freelancer->name }}</h2>
                        <div class="role">{{ $freelancer->job_title }}</div>
                        @if($experiences->isNotEmpty())
                            @php $currentExp = $experiences->first(); @endphp
                            <div class="company">{{ $currentExp->company ?? $currentExp->company_name ?? '' }}</div>
                            <div class="duration">
                                {{ \Carbon\Carbon::parse($currentExp->start_date)->format('M Y') }} ·
                                {{ $currentExp->end_date ? \Carbon\Carbon::parse($currentExp->end_date)->format('M Y') : 'Present' }}
                            </div>
                        @endif
                        <div class="city">{{ $freelancer->city ?? $freelancer->state_name }}</div>
                    </div>
                </div>

                <div class="linebar"></div>

                <div class="stats-row">
                    <div>
                        <div class="stat-label">Total exp</div>
                        <div class="stat-value">
                            {{ $freelancer->total_experience ?? 0 }} yrs
                        </div>
                    </div>
                    <div>
                        <div class="stat-label">Salary</div>
                        <div class="stat-value">{{ $freelancer->salary ?? '—' }}</div>
                        <div class="stat-sub">(LPA)</div>
                    </div>
                    <div>
                        <div class="stat-label">Date Of Birth</div>
                        <div class="stat-value">
                            {{ $freelancer->dob
                                ? \Carbon\Carbon::parse($freelancer->dob)->format('d M Y')
                                : '—'
                            }}
                        </div>
                    </div>
                </div>

                <div class="linebar"></div>

                <div class="updated-line">
                    <span class="dot"></span> Profile last updated on:
                    {{ $freelancer->updated_at ? \Carbon\Carbon::parse($freelancer->updated_at)->format('d M, Y') : '—' }}
                </div>

                <div class="contact-line">
                    <div class="sapdiv">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M14.6665 11.2827V13.2827C14.6672 13.4683 14.6292 13.6521 14.5548 13.8222C14.4804 13.9924 14.3713 14.1451 14.2345 14.2706C14.0977 14.3961 13.9362 14.4917 13.7603 14.5511C13.5844 14.6106 13.398 14.6327 13.2131 14.616C11.1617 14.3931 9.19113 13.6921 7.45979 12.5693C5.84901 11.5458 4.48335 10.1801 3.45979 8.56934C2.33311 6.83014 1.63195 4.85 1.41313 2.78934C1.39647 2.60498 1.41838 2.41918 1.47746 2.24375C1.53654 2.06833 1.63151 1.90713 1.7563 1.77042C1.8811 1.6337 2.033 1.52448 2.20232 1.44968C2.37164 1.37489 2.55469 1.33618 2.73979 1.336H4.73979C5.06333 1.33282 5.37699 1.44739 5.6223 1.65836C5.86761 1.86933 6.02784 2.1623 6.07313 2.48267C6.15754 3.12271 6.31409 3.75115 6.53979 4.356C6.62949 4.59462 6.6489 4.85395 6.59573 5.10326C6.54256 5.35257 6.41903 5.58141 6.23979 5.76267L5.39313 6.60934C6.34216 8.27837 7.7241 9.6603 9.39313 10.6093L10.2398 9.76267C10.4211 9.58343 10.6499 9.4599 10.8992 9.40673C11.1485 9.35356 11.4078 9.37297 11.6465 9.46267C12.2513 9.68837 12.8797 9.84492 13.5198 9.92934C13.8436 9.97502 14.1394 10.1381 14.3508 10.3877C14.5622 10.6372 14.6746 10.9557 14.6665 11.2827Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ $freelancer->phone }}</span>
                    </div>
                </div>

                <div class="contact-line">
                    <div class="sapdiv">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M13.3335 2.66406H2.66683C1.93045 2.66406 1.3335 3.26102 1.3335 3.9974V11.9974C1.3335 12.7338 1.93045 13.3307 2.66683 13.3307H13.3335C14.0699 13.3307 14.6668 12.7338 14.6668 11.9974V3.9974C14.6668 3.26102 14.0699 2.66406 13.3335 2.66406Z" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.6668 4.66406L8.68683 8.46406C8.48101 8.59301 8.24304 8.6614 8.00016 8.6614C7.75728 8.6614 7.51931 8.59301 7.3135 8.46406L1.3335 4.66406" stroke="#9CA3AF" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ $freelancer->email }}</span>
                    </div>
                </div>
                
                <!-- Accept / Reject -->
                <div class="contact-actions">
                
                    @if($proposalData->status === 'shortlisted')
                
                        <button type="button"
                                class="btn-accept"
                                disabled>
                            Shortlisted
                        </button>
                
                    @elseif($proposalData->status === 'rejected')
                
                        <button type="button"
                                class="btn-reject"
                                disabled>
                            Rejected
                        </button>
                
                    @else
                
                        <button type="button"
                                class="btn-accept"
                                id="acceptCandidate"
                                data-url="{{ route('employer.proposal.shortlist', $proposalData->id) }}">
                            Accept
                        </button>
                
                        <button type="button"
                                class="btn-reject"
                                id="rejectCandidate"
                                data-url="{{ route('employer.proposal.reject', $proposalData->id) }}">
                            Reject
                        </button>
                
                    @endif
                
                </div>
            </div>

        </aside>
        <!-- ===== SIDEBAR ===== -->

        <div class="aside-right-box">
            <div class="navtabs">
                <a href="#profilesummary" class="active">Profile summary</a>
                <a href="#resume">Resume</a>
                <a href="#workexperience">Work experience</a>
                <a href="#skills">Skills</a>
                <a href="#education">Education</a>
                <a href="#jobpreferences">Job preferences</a>
                <a href="#projects">Projects</a>
                <a href="#sociallinks">Social Links</a>
                <a href="#languages">Languages</a>
            </div>

            <!-- Profile summary -->
            <div class="profile-summary" id="profilesummary">
                <div class="card-head">
                    <h3>Profile summary</h3>
                </div>
                <p class="summary-text">
                    {{ $freelancer->bio ?? 'No profile summary added yet.' }}
                </p>
            </div>

            <!-- Resume -->
            <div class="profile-summary" id="resume">
                <div class="card-head">
                    <h3>Resume</h3>
                </div>

                @if($freelancer->resume)
                <div class="resume-row" id="resumeRow">
                    <div class="info-row">
                        <span class="pdf-badge">PDF</span>
                        <span class="name">Resume</span>
                    </div>
                    <div class="button-doc">
                        <a href="{{ $freelancer->resume }}" class="eye-btn" title="Eye document" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10Z" fill="#00A148"/>
                                <path d="M15.4698 7.83C14.8817 6.30882 13.8608 4.99331 12.5332 4.04604C11.2056 3.09878 9.62953 2.56129 7.99979 2.5C6.37005 2.56129 4.79398 3.09878 3.46639 4.04604C2.1388 4.99331 1.11787 6.30882 0.529787 7.83C0.490071 7.93985 0.490071 8.06015 0.529787 8.17C1.11787 9.69118 2.1388 11.0067 3.46639 11.954C4.79398 12.9012 6.37005 13.4387 7.99979 13.5C9.62953 13.4387 11.2056 12.9012 12.5332 11.954C13.8608 11.0067 14.8817 9.69118 15.4698 8.17C15.5095 8.06015 15.5095 7.93985 15.4698 7.83ZM7.99979 11.25C7.357 11.25 6.72864 11.0594 6.19418 10.7023C5.65972 10.3452 5.24316 9.83758 4.99718 9.24372C4.75119 8.64986 4.68683 7.99639 4.81224 7.36596C4.93764 6.73552 5.24717 6.15642 5.70169 5.7019C6.15621 5.24738 6.73531 4.93785 7.36574 4.81245C7.99618 4.68705 8.64965 4.75141 9.24351 4.99739C9.83737 5.24338 10.3449 5.65994 10.7021 6.1944C11.0592 6.72886 11.2498 7.35721 11.2498 8C11.2485 8.86155 10.9056 9.68743 10.2964 10.2966C9.68722 10.9058 8.86133 11.2487 7.99979 11.25Z" fill="#00A148"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @else
                <p class="empty-text">No resume uploaded yet.</p>
                @endif
            </div>

            <!-- Work experience -->
            <div class="profile-summary" id="workexperience">
                <div class="card-head">
                    <h3>Work experience</h3>
                </div>

                @if($experiences->isNotEmpty())
                    @php
                        $earliest = $experiences->min(fn($e) => \Carbon\Carbon::parse($e->start_date)->timestamp);
                        $latest   = $experiences->max(fn($e) => $e->end_date ? \Carbon\Carbon::parse($e->end_date)->timestamp : now()->timestamp);
                        $span     = max($latest - $earliest, 1);
                    @endphp

                    <div class="timeline-labels">
                        @foreach($experiences as $exp)
                            @php $pos = round((\Carbon\Carbon::parse($exp->start_date)->timestamp - $earliest) / $span * 100); @endphp
                            <span style="left: {{ $pos }}%;">{{ \Carbon\Carbon::parse($exp->start_date)->format("M 'y") }}</span>
                        @endforeach
                        <span style="left: 100%;">Till date</span>
                    </div>

                    <div class="timeline-bar">
                        @foreach($experiences as $exp)
                            @php $pos = round((\Carbon\Carbon::parse($exp->start_date)->timestamp - $earliest) / $span * 100); @endphp
                            <span class="node" style="left: {{ $pos }}%;"></span>
                        @endforeach
                        <span class="node" style="left: 100%;"></span>
                    </div>

                    @foreach($experiences as $experience)
                    <div class="exp-item">
                        <div class="exp-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <g clip-path="url(#clip0_exp{{ $loop->index }})">
                                    <path d="M3.75 13.75V2.5C3.75 2.16848 3.8817 1.85054 4.11612 1.61612C4.35054 1.3817 4.66848 1.25 5 1.25H10C10.3315 1.25 10.6495 1.3817 10.8839 1.61612C11.1183 1.85054 11.25 2.16848 11.25 2.5V13.75H3.75Z" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.75 7.5H2.5C2.16848 7.5 1.85054 7.6317 1.61612 7.86612C1.3817 8.10054 1.25 8.41848 1.25 8.75V12.5C1.25 12.8315 1.3817 13.1495 1.61612 13.3839C1.85054 13.6183 2.16848 13.75 2.5 13.75H3.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.25 5.625H12.5C12.8315 5.625 13.1495 5.7567 13.3839 5.99112C13.6183 6.22554 13.75 6.54348 13.75 6.875V12.5C13.75 12.8315 13.6183 13.1495 13.3839 13.3839C13.1495 13.6183 12.8315 13.75 12.5 13.75H11.25" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.25 3.75H8.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.25 6.25H8.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.25 8.75H8.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.25 11.25H8.75" stroke="#6B7280" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs><clipPath id="clip0_exp{{ $loop->index }}"><rect width="15" height="15" fill="white"/></clipPath></defs>
                            </svg>
                        </div>
                        <div>
                            <div class="role">{{ $experience->company ?? $experience->company_name ?? '' }}</div>
                            <div class="role">{{ $experience->position }}
                                
                            </div>
                            <div class="des">
                                {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} -
                                {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                                @if($experience->employment_type) · {{ $experience->employment_type }} @endif
                                @if($experience->industry) Industry: {{ $experience->industry }} @endif
                                @if($experience->salary) Salary: {{ $experience->salary }} @endif
                                @if($experience->notice_period) Notice Period: {{ $experience->notice_period }} @endif
                            </div>
                            @if($experience->description)
                            <div class="note experience-description">{{ $experience->description }}</div>
                            <button type="button" class="see-more-btn">See More</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                <p class="empty-text">No Experience Found. You haven't added any experience.</p>
                
                @endif
            </div>

            <!-- Skills -->
            <div class="profile-summary" id="skills">
                <div class="card-head">
                    <h3>Skills</h3>
                    
                </div>

                <div class="chip-row">
                    @forelse($skills as $skill)
                        <span class="chip">{{ $skill->name }}</span>
                    @empty
                        <p class="empty-text">No skills added yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Education -->
            <div class="profile-summary" id="education">
                <div class="card-head">
                    <h3>Education</h3>
                    
                </div>

                @forelse($educations as $education)
                <div class="edu-item">
                    <span class="edu-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M16.0651 8.19177C16.1994 8.13254 16.3133 8.03522 16.3928 7.91187C16.4723 7.78852 16.5139 7.64456 16.5123 7.49782C16.5108 7.35108 16.4663 7.20801 16.3843 7.08633C16.3022 6.96465 16.1863 6.86971 16.0508 6.81327L9.62259 3.88527C9.42717 3.79613 9.21488 3.75 9.00009 3.75C8.7853 3.75 8.57301 3.79613 8.37759 3.88527L1.95009 6.81027C1.81657 6.86875 1.70298 6.96487 1.62322 7.08688C1.54346 7.20889 1.50098 7.3515 1.50098 7.49727C1.50098 7.64304 1.54346 7.78565 1.62322 7.90766C1.70298 8.02967 1.81657 8.12579 1.95009 8.18427L8.37759 11.1153C8.57301 11.2044 8.7853 11.2505 9.00009 11.2505C9.21488 11.2505 9.42717 11.2044 9.62259 11.1153L16.0651 8.19177Z" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16.5 7.5V12" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.5 9.375V12C4.5 12.5967 4.97411 13.169 5.81802 13.591C6.66193 14.0129 7.80653 14.25 9 14.25C10.1935 14.25 11.3381 14.0129 12.182 13.591C13.0259 13.169 13.5 12.5967 13.5 12V9.375" stroke="#5A5A5A" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <div>
                        <h4>{{ $education->degree ?? '' }}
                            
                        </h4>
                        <div class="school">{{ $education->institute ?? '' }}</div>
                        <div class="year">
                            {{ $education->passing_year ?? '' }}

                            @if($education->education_type)
                                · {{ $education->education_type }}
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p class="empty-text">No education added yet.</p>
                @endforelse
            </div>

            <!-- Job Preferences -->
            <div class="profile-summary" id="jobpreferences">
                <div class="card-head">
                    <h3>Job Preferences</h3>
                    
                </div>

                <div class="pref-grid">
                    <div>
                        <div class="label">Preferred Job Title</div>
                        <div class="value">
                            {{ $preferredTitles->isNotEmpty() ? $preferredTitles->pluck('title')->implode(', ') : '—' }}
                        </div>
                    </div>
                    <div>
                        <div class="label">Preferred Location</div>
                        <div class="value">
                            {{ $preferredLocations->isNotEmpty() ? $preferredLocations->pluck('location')->implode(', ') : '—' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects -->
            <div class="profile-summary" id="projects">
                <div class="card-head">
                    <h3>Projects</h3>
                    
                </div>

                @forelse($projects as $project)
                <div class="project-block">
                    <div class="p-head">
                        <h4>{{ $project->title ?? '' }}</h4>
                        
                    </div>
                    <p>{!! nl2br(e($project->description ?? '')) !!}</p>
                </div>
                @empty
                <p class="empty-text">No projects added yet.</p>
                @endforelse
            </div>

            <!-- Social Links -->
            <div class="profile-summary" id="sociallinks">
                <div class="card-head">
                    <h3>Social Links</h3>
                    
                </div>
                <div class="social-box">
                    @forelse($socialLinks as $link)
                        @php $platform = strtolower($link->platform ?? ''); @endphp
                        @if($platform === 'linkedin')
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="social-item">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M16 8C17.5913 8 19.1174 8.63214 20.2426 9.75736C21.3679 10.8826 22 12.4087 22 14V21H18V14C18 13.4696 17.7893 12.9609 17.4142 12.5858C17.0391 12.2107 16.5304 12 16 12C15.4696 12 14.9609 12.2107 14.5858 12.5858C14.2107 12.9609 14 13.4696 14 14V21H10V14C10 12.4087 10.6321 10.8826 11.7574 9.75736C12.8826 8.63214 14.4087 8 16 8Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6 9H2V21H6V9Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M4 6C5.10457 6 6 5.10457 6 4C6 2.89543 5.10457 2 4 2C2.89543 2 2 2.89543 2 4C2 5.10457 2.89543 6 4 6Z" stroke="#0A66C2" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    
                                    <span>Linkedin</span> 
                                </div>
                            </a>
                        @elseif($platform === 'facebook')
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="social-item">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <g clip-path="url(#clip0_4060_6132)">
                                                <path d="M10.0219 23.8781C4.32188 22.8609 0 17.9391 0 12C0 5.4 5.4 0 12 0C18.6 0 24 5.4 24 12C24 17.9391 19.6781 22.8609 13.9781 23.8781L13.3172 23.3391H10.6781L10.0219 23.8781Z" fill="#0866FF" />
                                                <path d="M16.6783 15.3578L17.2174 11.9969H14.0393V9.65781C14.0393 8.69688 14.4002 7.97969 15.8393 7.97969H17.4002V4.91875C16.5611 4.79687 15.6002 4.67969 14.7611 4.67969C12.0002 4.67969 10.083 6.35781 10.083 9.35781V11.9969H7.08301V15.3578H10.083V23.8188C10.7439 23.9406 11.4049 23.9969 12.0611 23.9969C12.7221 23.9969 13.383 23.9359 14.0393 23.8188V15.3578H16.6783Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_4060_6132">
                                                    <rect width="24" height="24" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    
                                    <span>Facebook</span> 
                                </div>
                            </a>
                        @elseif($platform === 'instagram')
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="social-item">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <g clip-path="url(#clip0_4060_6126)">
                                                <path d="M18.375 0H5.625C2.5184 0 0 2.5184 0 5.625V18.375C0 21.4816 2.5184 24 5.625 24H18.375C21.4816 24 24 21.4816 24 18.375V5.625C24 2.5184 21.4816 0 18.375 0Z" fill="url(#paint0_radial_4060_6126)" />
                                                <path d="M18.375 0H5.625C2.5184 0 0 2.5184 0 5.625V18.375C0 21.4816 2.5184 24 5.625 24H18.375C21.4816 24 24 21.4816 24 18.375V5.625C24 2.5184 21.4816 0 18.375 0Z" fill="url(#paint1_radial_4060_6126)" />
                                                <path d="M12.0008 2.625C9.45478 2.625 9.13519 2.63616 8.13525 2.68163C7.13719 2.72738 6.45591 2.88534 5.85984 3.11719C5.24316 3.35662 4.72013 3.67697 4.19906 4.19822C3.67753 4.71937 3.35719 5.24241 3.117 5.85881C2.8845 6.45506 2.72634 7.13662 2.68144 8.13422C2.63672 9.13425 2.625 9.45394 2.625 12.0001C2.625 14.5463 2.63625 14.8648 2.68163 15.8647C2.72756 16.8628 2.88553 17.5441 3.11719 18.1402C3.35681 18.7568 3.67716 19.2799 4.19841 19.8009C4.71938 20.3225 5.24241 20.6436 5.85862 20.883C6.45516 21.1148 7.13653 21.2728 8.13441 21.3186C9.13444 21.364 9.45375 21.3752 11.9997 21.3752C14.5461 21.3752 14.8646 21.364 15.8646 21.3186C16.8626 21.2728 17.5447 21.1148 18.1412 20.883C18.7576 20.6436 19.2799 20.3225 19.8007 19.8009C20.3223 19.2799 20.6425 18.7568 20.8828 18.1404C21.1133 17.5441 21.2715 16.8626 21.3184 15.8649C21.3633 14.865 21.375 14.5463 21.375 12.0001C21.375 9.45394 21.3633 9.13444 21.3184 8.13441C21.2715 7.13634 21.1133 6.45516 20.8828 5.85909C20.6425 5.24241 20.3223 4.71937 19.8007 4.19822C19.2793 3.67678 18.7578 3.35644 18.1406 3.11728C17.543 2.88534 16.8613 2.72728 15.8632 2.68163C14.8632 2.63616 14.5448 2.625 11.9979 2.625H12.0008ZM11.1598 4.31447C11.4095 4.31409 11.688 4.31447 12.0008 4.31447C14.5041 4.31447 14.8007 4.32347 15.7892 4.36838C16.7032 4.41019 17.1994 4.56291 17.5298 4.69125C17.9674 4.86112 18.2793 5.06428 18.6072 5.3925C18.9353 5.72062 19.1384 6.03309 19.3088 6.47062C19.4371 6.80062 19.59 7.29675 19.6316 8.21081C19.6765 9.19913 19.6863 9.49594 19.6863 11.9979C19.6863 14.4999 19.6765 14.7968 19.6316 15.7851C19.5898 16.6991 19.4371 17.1952 19.3088 17.5253C19.1389 17.9629 18.9353 18.2744 18.6072 18.6023C18.2791 18.9305 17.9676 19.1335 17.5298 19.3035C17.1997 19.4324 16.7032 19.5848 15.7892 19.6266C14.8009 19.6715 14.5041 19.6812 12.0008 19.6812C9.49753 19.6812 9.20081 19.6715 8.21259 19.6266C7.29853 19.5844 6.80241 19.4317 6.47166 19.3033C6.03422 19.1333 5.72166 18.9303 5.39353 18.6022C5.06541 18.274 4.86234 17.9623 4.692 17.5246C4.56366 17.1945 4.41075 16.6984 4.36913 15.7843C4.32422 14.796 4.31522 14.4992 4.31522 11.9956C4.31522 9.492 4.32422 9.19678 4.36913 8.20847C4.41094 7.29441 4.56366 6.79828 4.692 6.46781C4.86197 6.03028 5.06541 5.71781 5.39363 5.38969C5.72184 5.06156 6.03422 4.85841 6.47175 4.68816C6.80222 4.55925 7.29853 4.40691 8.21259 4.36491C9.07744 4.32581 9.41259 4.31409 11.1598 4.31212V4.31447ZM17.0052 5.87109C16.3841 5.87109 15.8802 6.37453 15.8802 6.99572C15.8802 7.61681 16.3841 8.12072 17.0052 8.12072C17.6263 8.12072 18.1302 7.61681 18.1302 6.99572C18.1302 6.37463 17.6263 5.87072 17.0052 5.87072V5.87109ZM12.0008 7.18556C9.34209 7.18556 7.18641 9.34125 7.18641 12.0001C7.18641 14.6589 9.34209 16.8136 12.0008 16.8136C14.6597 16.8136 16.8146 14.6589 16.8146 12.0001C16.8146 9.34134 14.6595 7.18556 12.0007 7.18556H12.0008ZM12.0008 8.87503C13.7267 8.87503 15.1259 10.2741 15.1259 12.0001C15.1259 13.7259 13.7267 15.1252 12.0008 15.1252C10.275 15.1252 8.87588 13.7259 8.87588 12.0001C8.87588 10.2741 10.2749 8.87503 12.0008 8.87503Z" fill="white" />
                                            </g>
                                            <defs>
                                                <radialGradient id="paint0_radial_4060_6126" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(6.375 25.8485) rotate(-90) scale(23.7858 22.1227)">
                                                    <stop stop-color="#FFDD55" />
                                                    <stop offset="0.1" stop-color="#FFDD55" />
                                                    <stop offset="0.5" stop-color="#FF543E" />
                                                    <stop offset="1" stop-color="#C837AB" />
                                                </radialGradient>
                                                <radialGradient id="paint1_radial_4060_6126" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(-4.02008 1.7289) rotate(78.68) scale(10.6324 43.827)">
                                                    <stop stop-color="#3771C8" />
                                                    <stop offset="0.128" stop-color="#3771C8" />
                                                    <stop offset="1" stop-color="#6600FF" stop-opacity="0" />
                                                </radialGradient>
                                                <clipPath id="clip0_4060_6126">
                                                    <rect width="24" height="24" fill="white" />
                                                </clipPath>
                                            </defs>
                                    </svg>
                                    </span>
                                    
                                    <span>Instagram</span> 
                                </div>
                            </a>
                        @elseif($platform === 'twitter' || $platform === 'x')
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="social-item">
                                    <span class="social-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <g clip-path="url(#clip0_4320_14479)">
                                                <mask id="mask0_4320_14479" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                                                    <path d="M0 0H14V14H0V0Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_4320_14479)">
                                                    <path d="M11.025 0.65625H13.172L8.482 6.03025L14 13.3442H9.68L6.294 8.90925L2.424 13.3442H0.275L5.291 7.59425L0 0.65725H4.43L7.486 4.71025L11.025 0.65625ZM10.27 12.0562H11.46L3.78 1.87725H2.504L10.27 12.0562Z" fill="black" />
                                                </g>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_4320_14479">
                                                    <rect width="14" height="14" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    
                                    <span>X</span> 
                                </div>
                            </a>
                        @endif
                        @empty
                        <p class="empty-text">No social links added yet.</p>
                    @endforelse
                </div>
                
            </div>

            <!-- Languages -->
            <div class="profile-summary" id="languages">
                <div class="card-head">
                    <h3>Languages</h3>
                    
                </div>

                <div class="lang-grid">
                    @forelse($languages as $lang => $level)
                    <div class="lang-card">
                        <div class="name">{{ ucfirst($lang) }}</div>
                        <div class="level">{{ ucfirst($level) }}</div>
                        
                    </div>
                    @empty
                    <p class="empty-text">No languages added yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $('.navtabs a').on('click', function() {
        $('.navtabs a').removeClass('active');
        $(this).addClass('active');
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll(".exp-item").forEach(function (box) {

            const content = box.querySelector(".note");
            const button = box.querySelector(".see-more-btn");

            if (!content || !button) {
                return;
            }

            // Get the CSS max-height in pixels
            const styles = window.getComputedStyle(content);
            const maxHeight = parseFloat(styles.maxHeight);

            // Temporarily remove max-height to get the full text height
            content.style.maxHeight = "none";

            const fullHeight = content.scrollHeight;

            // Restore CSS max-height
            content.style.maxHeight = "";

            // Show See More only if content is actually taller
            if (fullHeight > maxHeight + 1) {
                button.style.display = "flex";
            } else {
                button.style.display = "none";
            }

            // See More / See Less
            button.addEventListener("click", function () {

                if (content.classList.contains("show")) {

                    content.classList.remove("show");
                    button.textContent = "See More";

                } else {

                    content.classList.add("show");
                    button.textContent = "See Less";

                }

            });

        });

    });
</script>

<script>
    // Accept / Shortlist
    $(document).on('click', '#acceptCandidate', function () {

        const button = $(this);
        const url = button.data('url');

        if (!confirm('Are you sure you want to shortlist this candidate?')) {
            return;
        }

        button.prop('disabled', true).text('Processing...');

        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },

            success: function (response) {

                alert(response.message);

                button.text('Shortlisted');

                $('#rejectCandidate')
                    .prop('disabled', true);
            },

            error: function (xhr) {

                button.prop('disabled', false)
                      .text('Accept');

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    alert(xhr.responseJSON.message);
                } else {
                    alert('Something went wrong.');
                }
            }
        });

    });


    // Reject
    $(document).on('click', '#rejectCandidate', function () {

        const button = $(this);
        const url = button.data('url');

        if (!confirm('Are you sure you want to reject this candidate?')) {
            return;
        }

        button.prop('disabled', true).text('Processing...');

        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },

            success: function (response) {

                alert(response.message);

                button.text('Rejected');

                $('#acceptCandidate')
                    .prop('disabled', true);
            },

            error: function (xhr) {

                button.prop('disabled', false)
                      .text('Reject');

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    alert(xhr.responseJSON.message);
                } else {
                    alert('Something went wrong.');
                }
            }
        });

    });
</script>
@endsection