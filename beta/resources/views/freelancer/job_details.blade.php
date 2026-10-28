@extends('layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/looking-employe.css') }}?v={{ filemtime(public_path('frontend/css/looking-employe.css')) }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/popups.css') }}?v={{ filemtime(public_path('frontend/css/popups.css')) }}" />

<section class="lookingemployee">
    <div class="container-fluid">
        <div class="freelanceJob">
            <div class="employeDescription">
                <div class="budgetInfo">
                    <div class="text">
                        <p>Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</p>
                        <h4>{{ $job->title }}</h4>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_2431_9680)">
                                    <path d="M9.17258 17.5H8.00425C5.01675 17.5 3.52341 17.5 2.59508 16.5542C1.66675 15.6083 1.66675 14.0858 1.66675 11.0417C1.66675 7.99751 1.66675 6.47501 2.59508 5.52918C3.52341 4.58334 5.01675 4.58334 8.00425 4.58334H11.1734C14.1609 4.58334 15.6551 4.58334 16.5834 5.52918C17.2976 6.25668 17.4617 7.32584 17.5001 9.16668" stroke="#838383" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M13.3335 4.58334L13.2502 4.32501C12.8377 3.04167 12.6318 2.40001 12.141 2.03334C11.6493 1.66667 10.9977 1.66667 9.69183 1.66667H9.47266C8.1685 1.66667 7.516 1.66667 7.02516 2.03334C6.5335 2.40001 6.32766 3.04167 5.91516 4.32501L5.8335 4.58334M14.2593 11.0458C14.4135 10.9042 14.4902 10.8333 14.5835 10.8333C14.6768 10.8333 14.7535 10.9042 14.9077 11.0458L15.5018 11.5933C15.5735 11.6592 15.6093 11.6925 15.6535 11.7083C15.6985 11.725 15.7468 11.7233 15.8452 11.7192L16.6468 11.6875C16.8535 11.6792 16.9568 11.6758 17.0277 11.735C17.0985 11.7942 17.1127 11.8967 17.1402 12.1017L17.2502 12.9233C17.2635 13.0183 17.2693 13.065 17.2927 13.1067C17.316 13.1467 17.3535 13.1758 17.4285 13.235L18.0752 13.7433C18.2352 13.87 18.3152 13.9325 18.331 14.0225C18.3468 14.1125 18.2927 14.1992 18.186 14.3725L17.7477 15.0783C17.6977 15.1592 17.6727 15.2 17.6643 15.245C17.656 15.29 17.666 15.3375 17.686 15.4308L17.8602 16.2458C17.9018 16.4458 17.9235 16.5458 17.8777 16.6258C17.8318 16.7058 17.7343 16.7375 17.5402 16.8008L16.7685 17.0517C16.6768 17.0817 16.6302 17.0967 16.5943 17.1267C16.5585 17.1575 16.536 17.2008 16.4918 17.2867L16.1152 18.0125C16.0193 18.1983 15.971 18.2908 15.8835 18.3225C15.796 18.3542 15.7002 18.3142 15.5068 18.2342L14.7668 17.9275C14.676 17.89 14.631 17.8708 14.5835 17.8708C14.536 17.8708 14.491 17.89 14.4002 17.9275L13.6602 18.2342C13.4668 18.3142 13.371 18.3542 13.2835 18.3225C13.196 18.2908 13.1477 18.1975 13.0518 18.0125L12.6752 17.2867C12.6302 17.2008 12.6085 17.1575 12.5727 17.1275C12.5368 17.0975 12.4902 17.0817 12.3985 17.0525L11.6268 16.8008C11.4327 16.7375 11.3352 16.7058 11.2893 16.6258C11.2435 16.5458 11.2643 16.4467 11.3068 16.2458L11.4818 15.4308C11.501 15.3375 11.511 15.2908 11.5027 15.2458C11.4856 15.1856 11.4573 15.129 11.4193 15.0792L10.9818 14.3725C10.8735 14.1992 10.8202 14.1125 10.836 14.0225C10.8518 13.9325 10.9318 13.87 11.0918 13.7442L11.7385 13.2358C11.8135 13.1758 11.851 13.1467 11.8743 13.1058C11.8977 13.065 11.9035 13.0183 11.916 12.9225L12.0268 12.1017C12.0543 11.8975 12.0685 11.7942 12.1393 11.735C12.2102 11.6758 12.3135 11.6792 12.5202 11.6875L13.3227 11.7192C13.4202 11.7233 13.4685 11.725 13.5135 11.7083C13.5577 11.6917 13.5935 11.6592 13.6652 11.5933L14.2593 11.0458Z" stroke="#838383" stroke-width="1.5" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_2431_9680">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            {{ $job->category_name }}</span>
                        <!-- <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10.0001 9.58334C9.44755 9.58334 8.91764 9.36384 8.52694 8.97314C8.13624 8.58244 7.91675 8.05254 7.91675 7.5C7.91675 6.94747 8.13624 6.41757 8.52694 6.02687C8.91764 5.63617 9.44755 5.41667 10.0001 5.41667C10.5526 5.41667 11.0825 5.63617 11.4732 6.02687C11.8639 6.41757 12.0834 6.94747 12.0834 7.5C12.0834 7.77359 12.0295 8.0445 11.9248 8.29726C11.8201 8.55002 11.6667 8.77969 11.4732 8.97314C11.2798 9.1666 11.0501 9.32006 10.7973 9.42475C10.5446 9.52945 10.2737 9.58334 10.0001 9.58334ZM10.0001 1.66667C8.45299 1.66667 6.96925 2.28125 5.87529 3.37522C4.78133 4.46918 4.16675 5.95291 4.16675 7.5C4.16675 11.875 10.0001 18.3333 10.0001 18.3333C10.0001 18.3333 15.8334 11.875 15.8334 7.5C15.8334 5.95291 15.2188 4.46918 14.1249 3.37522C13.0309 2.28125 11.5472 1.66667 10.0001 1.66667Z" fill="#838383" />
                            </svg>India , New Delhi
                        </span> -->
                    </div>
                    <div class="applyBudget">
                        <span>Budget</span>
                        @if(($job->budget_type ?? '') === 'not_disclosed')
                            <p>NOT DISCLOSED</p>
                        @else
                            <p>₹ {{ number_format($job->budget_min ?? 0) }} - ₹ {{ number_format($job->budget_max ?? 0) }}</p>
                        @endif
                        @if($alreadyApplied)
                        <button type="button" class="aplNowActive" disabled>
                            Applied
                        </button>
                        @else
                        <button type="button" class="aplNow applyNow" data-job="{{ $job->id }}">
                            Apply Now
                        </button>
                        @endif
                    </div>
                </div>

                <div class="showJObInfo">
                    <div class="textMore">
                        <h5>Job Description</h5>
                        {!! nl2br(e($job->description)) !!}
                    </div>

                    <a href="#" class="showMore d-none">
                        Show More
                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" viewBox="0 0 16 16" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.47124 10.4713C8.34622 10.5963 8.17668 10.6665 7.9999 10.6665C7.82313 10.6665 7.65359 10.5963 7.52857 10.4713L3.75724 6.69999C3.69356 6.6385 3.64277 6.56493 3.60784 6.4836C3.5729 6.40226 3.55451 6.31478 3.55374 6.22626C3.55297 6.13774 3.56983 6.04996 3.60336 5.96803C3.63688 5.88609 3.68638 5.81166 3.74897 5.74906C3.81157 5.68647 3.886 5.63697 3.96793 5.60345C4.04986 5.56993 4.13765 5.55306 4.22617 5.55383C4.31469 5.5546 4.40217 5.57299 4.48351 5.60793C4.56484 5.64287 4.63841 5.69365 4.6999 5.75733L7.9999 9.05733L11.2999 5.75733C11.4256 5.63589 11.594 5.56869 11.7688 5.57021C11.9436 5.57173 12.1108 5.64184 12.2344 5.76545C12.3581 5.88905 12.4282 6.05626 12.4297 6.23106C12.4312 6.40586 12.364 6.57426 12.2426 6.69999L8.47124 10.4713Z"
                                fill="#00A148" />
                        </svg>
                    </a>
                </div>

                <div class="SkillsRequired">
                    <h5>Skills Required</h5>
                    <ul>
                        @foreach(explode(',', $job->skills) as $skill)
                        <li>{{ trim($skill) }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="aboutClient">
                <div class="detailClient">
                    <h5>About the Client</h5>
                    <div class="picture">
                        <div class="images">
                            <div class="image">
                                <img src="{{ $job->image ?: 'https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg' }}"
                                    onerror="this.onerror=null; this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg';"
                                    alt="Company Logo">
                            </div>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none">
                                    <path
                                        d="M17.8802 8.30693C18.2548 10.1681 17.9878 12.1031 17.1239 13.7892C16.26 15.4752 14.8514 16.8104 13.1329 17.5721C11.4144 18.3338 9.49002 18.476 7.68055 17.9749C5.87109 17.4738 4.28596 16.3598 3.18953 14.8186C2.09309 13.2773 1.55161 11.4021 1.65539 9.50554C1.75917 7.60899 2.50193 5.80579 3.75982 4.39665C5.0177 2.9875 6.71467 2.05759 8.56774 1.76198C10.4208 1.46637 12.3179 1.82293 13.9428 2.77221"
                                        stroke="#00C950" stroke-width="1.65051" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M7.37891 9.13579L9.83928 11.627L18.0405 3.32289" stroke="#00C950"
                                        stroke-width="1.65051" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                        <div class="text">
                            <p>{{ $job->employer_type == 0 ? $job->profile_company_name : $job->company_name }}</p>
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13"
                                    fill="none">
                                    <path
                                        d="M10.8329 5.41523C10.8329 8.11977 7.83263 10.9364 6.82513 11.8064C6.73128 11.8769 6.61703 11.9151 6.49959 11.9151C6.38216 11.9151 6.26791 11.8769 6.17405 11.8064C5.16655 10.9364 2.16626 8.11977 2.16626 5.41523C2.16626 4.26596 2.62281 3.16376 3.43546 2.3511C4.24812 1.53844 5.35032 1.08189 6.49959 1.08189C7.64886 1.08189 8.75106 1.53844 9.56372 2.3511C10.3764 3.16376 10.8329 4.26596 10.8329 5.41523Z"
                                        stroke="#6A7282" stroke-width="0.684692" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M6.49951 7.04143C7.39697 7.04143 8.12451 6.31389 8.12451 5.41643C8.12451 4.51896 7.39697 3.79143 6.49951 3.79143C5.60205 3.79143 4.87451 4.51896 4.87451 5.41643C4.87451 6.31389 5.60205 7.04143 6.49951 7.04143Z"
                                        stroke="#6A7282" stroke-width="0.684692" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                {{ $job->employer_state }}, {{ $job->employer_country }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="clientDesc">
                        @php $about = $job->about_employer ?? ''; @endphp

                        <p>
                            {{ \Illuminate\Support\Str::words($about, 70, '...') }}
                            @if(str_word_count($about) > 70)
                            <a href="#">View more</a>
                            @endif
                        </p>
                    </div>
                    <!-- <div class="viewCompany">
                        <a class="ViewProfile" href="#">
                            View Company Profile
                        </a>
                    </div> -->
                </div>

                <div class="SimilarJobs">
                    <div class="title">
                        <p>Job Status</p>
                        <!-- <a href="{{ route('jobseekers.find.work') }}" type="button" class="seeAll">See all ></a> -->
                    </div>

                   <div class="jobstats">
                        <div class="ic">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#1c1c28" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12h5l3-8 4 16 3-8h5"/></svg>
                        </div>
                        <div class="applext">
                            <p>{{ number_format($totalApplicants) }} Applicants on this job</p>
                            <p>{{ number_format($applicationsViewed) }} Applications viewed by recruiters</p>
                        </div>
                    </div>
                    
                    @php
                        $steps = [
                            [
                                'label' => 'Applied',
                                'date' => $proposal->created_at,
                                'completed' => true,
                            ],
                            [
                                'label' => 'Application Sent',
                                'date' => $proposal->created_at,
                                'completed' => true,
                            ],
                            [
                                'label' => 'Application Viewed',
                                'date' => $proposal->profile_viewed_at,
                                'completed' => !empty($proposal->profile_viewed_at),
                            ],
                            [
                                'label' => 'Resume Viewed',
                                'date' => $proposal->cv_downloaded_at,
                                'completed' => !empty($proposal->cv_downloaded_at),
                            ],
                            [
                                'label' => 'Awaiting recruiter action',
                                'date' => null,
                                'completed' => false,
                            ],
                        ];
                    
                        $completedCount = collect($steps)
                            ->filter(fn ($step) => $step['completed'])
                            ->count();
                    
                        $progress = (($completedCount - 1) / (count($steps) - 1)) * 100;
                    @endphp
                    
                    <div class="applystatus">
                        <h2>Your application status</h2>
                        <div class="tl" id="tl">
                            <div class="fill" id="fill"></div>
                            
                            @foreach ($steps as $step)
                                <div class="step {{ $step['completed'] ? 'completed' : '' }}">
                                    <span class="dot">
                                        @if ($step['completed'])
                                            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7"/></svg>
                                        @endif    
                                    </span>
                                    <div class="dottext">
                                        <div class="label">{{ $step['label'] }}
                                            @if (!empty($step['date']))
                                                <small>{{ \Carbon\Carbon::parse($step['date'])->format('d M') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($proposal->status === 'accepted')
                                <!--<p>Your application has been accepted.</p>-->
                            @elseif ($proposal->status === 'rejected')
                                <!--<p>Your application has been rejected.</p>-->
                            @elseif ($proposal->status === 'shortlisted')
                                <!--<p>You have been shortlisted.</p>-->
                            @elseif ($proposal->status === 'pending')
                                <!--<p>Waiting for recruiter action.</p>-->
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="proposalModal" tabindex="-1" aria-labelledby="proposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="heading">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                            <path d="M19.2857 1.04L6.71429 12.4686V18.1829L10.1429 14.7543M1 8.46857L19.2857 1L16.0857 17.6114L1 8.46857Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="text">
                        <h1 id="proposalModalLabel">Send Proposal</h1>
                        <p>Submit your proposal to let the employer know why you're the perfect fit for this project.</p>
                    </div>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="12" fill="#EFF1F2" />
                            <path d="M8.46387 15.5348L15.5359 8.46484M8.46387 8.46484L15.5359 15.5348" stroke="black" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <form id="proposalForm" enctype="multipart/form-data" novalidate>
                    <div class="amount">
                        <label for="proposedAmount">Proposed Amount <span>*</span></label>
                        <div class="input" id="amountInputWrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M4.3335 2.33398H11.6668M4.3335 5.48198H11.6668M9.52816 13.6673L4.3335 8.62998H6.16683C10.2408 8.62998 10.2408 2.33398 6.16683 2.33398" stroke="#575757" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <input type="text" id="proposedAmount" name="proposedAmount" placeholder="Enter your Budget" inputmode="decimal" autocomplete="off" />
                        </div>
                        <div class="field-error" id="amountError">Please enter a valid amount.</div>
                    </div>
                    <div class="descripition">
                        <label for="projectDescription">Project Description <span>*</span></label>
                        <textarea id="projectDescription" name="projectDescription" maxlength="3000" placeholder="Describe your approach, deliverables, and why you're the right fit for this project."></textarea>
                        <div class="infoo">
                            <p>Highlight your skill, Experience and the experience you will use to complete this project.</p>
                            <div class="count" id="descCount">0/3000</div>
                        </div>
                        <div class="field-error" id="descError">Please enter a project description.</div>
                    </div>
                    <div class="fileuploadsection">
                        <label for="proposalFiles">File <span>( optional )</span></label>
                        <div class="uploadwrapper" id="uploadWrapper">
                            <input type="file" id="proposalFiles" class="file-input" name="proposalFiles" multiple accept=".pdf,.doc,.docx,.png,.jpg,.jpeg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png,image/jpeg" />
                            <div class="content" id="uploadDropzone">
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none">
                                    <g opacity="0.5">
                                        <path d="M31.5 3.5H10.5C8.567 3.5 7 5.067 7 7V35C7 36.933 8.567 38.5 10.5 38.5H31.5C33.433 38.5 35 36.933 35 35V7C35 5.067 33.433 3.5 31.5 3.5Z" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.75 38.5V31.5H26.25V38.5" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14 10.5H14.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M28 10.5H28.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21 10.5H21.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21 17.5H21.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21 24.5H21.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M28 17.5H28.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M28 24.5H28.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14 17.5H14.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14 24.5H14.0175" stroke="#181818" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                                <p>Drag and Drop Files here or <span>Click to upload.</span></p>
                            </div>
                            <div class="uploadedfile" id="uploadedFileList">
                                <div class="row" id="uploadedFileRow"></div>
                            </div>
                            <button type="button" class="btn-upload" id="uploadMoreBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M5.00016 16.6667C4.54183 16.6667 4.14961 16.5036 3.8235 16.1775C3.49738 15.8514 3.33405 15.4589 3.3335 15V13.3333C3.3335 13.0972 3.4135 12.8995 3.5735 12.74C3.7335 12.5806 3.93127 12.5006 4.16683 12.5C4.40238 12.4995 4.60044 12.5795 4.761 12.74C4.92155 12.9006 5.00127 13.0983 5.00016 13.3333V15H15.0002V13.3333C15.0002 13.0972 15.0802 12.8995 15.2402 12.74C15.4002 12.5806 15.5979 12.5006 15.8335 12.5C16.0691 12.4995 16.2671 12.5795 16.4277 12.74C16.5882 12.9006 16.6679 13.0983 16.6668 13.3333V15C16.6668 15.4583 16.5038 15.8508 16.1777 16.1775C15.8516 16.5042 15.4591 16.6672 15.0002 16.6667H5.00016ZM9.16683 6.54168L7.60433 8.10418C7.43766 8.27085 7.23989 8.35085 7.011 8.34418C6.78211 8.33751 6.58405 8.25057 6.41683 8.08335C6.26405 7.91668 6.18405 7.72224 6.17683 7.50001C6.16961 7.27779 6.24961 7.08335 6.41683 6.91668L9.41683 3.91668C9.50016 3.83335 9.59044 3.77446 9.68766 3.74001C9.78488 3.70557 9.88905 3.68807 10.0002 3.68751C10.1113 3.68696 10.2154 3.70446 10.3127 3.74001C10.4099 3.77557 10.5002 3.83446 10.5835 3.91668L13.5835 6.91668C13.7502 7.08335 13.8302 7.27779 13.8235 7.50001C13.8168 7.72224 13.7368 7.91668 13.5835 8.08335C13.4168 8.25001 13.2191 8.33696 12.9902 8.34418C12.7613 8.3514 12.5632 8.2714 12.396 8.10418L10.8335 6.54168V12.5C10.8335 12.7361 10.7535 12.9342 10.5935 13.0942C10.4335 13.2542 10.2357 13.3339 10.0002 13.3333C9.76461 13.3328 9.56683 13.2528 9.40683 13.0933C9.24683 12.9339 9.16683 12.7361 9.16683 12.5V6.54168Z" fill="#5A5A5A" />
                                </svg>
                                <span id="uploadBtnLabel">Upload</span>
                            </button>
                        </div>
                        <div class="field-error" id="fileError"></div>
                        <div class="info">Supported Format : PDF, Word, PNG, JPG</div>
                    </div>
                    <div class="modalfooter">
                        <button type="submit">
                            <span>Send Proposal</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                                <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="successmodal">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="12" fill="#EFF1F2" />
                            <path d="M8.46387 15.5348L15.5359 8.46484M8.46387 8.46484L15.5359 15.5348" stroke="black" stroke-linecap="round" />
                        </svg>
                    </button>
                    <img src="{{ asset('frontend/images/image 111.png') }}" alt="">
                    <h4 id="successModalLabel">Proposal sent <span>Successfully.</span></h4>
                    <p>Your proposal has been sent successfully. The employer will review it and get back to you soon.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const showMoreBtn = document.querySelector(".showMore");
        const textMore = document.querySelector(".textMore");

        if (!showMoreBtn || !textMore) return;

        if (textMore.scrollHeight > 120) {
            showMoreBtn.classList.remove("d-none");
        }

        showMoreBtn.addEventListener("click", function(e) {
            e.preventDefault();

            textMore.classList.toggle("active");

            if (textMore.classList.contains("active")) {
                this.textContent = "Show Less";
            } else {
                this.textContent = "Show More";
            }
        });

    });

    let selectedJobId = null;

    $(document).on('click', '.applyNow', function() {

        selectedJobId = $(this).data('job');

        $('#proposalForm')[0].reset();
        $('#uploadedFileRow').html('');
        $('#descCount').text('0/3000');

        $('#proposalModal').modal('show');
    });


    $('#proposalForm').on('submit', function(e) {

        e.preventDefault();

        // Clear previous Laravel errors
        $('.server-error').remove();

        let valid = true;

        if (!validateAmount()) {
            valid = false;
        }

        if (!validateDescription()) {
            valid = false;
        }

        // Stop here if client validation fails
        if (!valid) {
            return;
        }

        let btn = $(this).find('button[type="submit"]');

        // Prevent double click
        if (btn.prop('disabled')) {
            return;
        }

        btn.prop('disabled', true);
        showLoder();

        let formData = new FormData();

        formData.append('_token', '{{ csrf_token() }}');
        formData.append('job_id', selectedJobId);
        formData.append('proposedAmount', $('#proposedAmount').val());
        formData.append('projectDescription', $('#projectDescription').val());

        selectedFiles.forEach(function(file) {
            formData.append('proposalFiles[]', file);
        });

        $.ajax({
            url: "{{ route('jobseekers.job.apply') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {
                btn.prop('disabled', false);
                hideLoder();

                $('#proposalModal').modal('hide');
                $('#successModal').modal('show');

                const applyBtn = document.querySelector('.applyNow[data-job="' + selectedJobId + '"]');

                if (applyBtn) {
                    applyBtn.textContent = 'Applied';
                    applyBtn.disabled = true;
                    applyBtn.classList.remove('applyNow');
                    applyBtn.classList.add('aplNowActive');
                }
            },

            error: function(xhr) {

                btn.prop('disabled', false);
                hideLoder();

                if (xhr.status == 422) {

                    let errors = xhr.responseJSON.errors;

                    // Amount error
                    if (errors.proposedAmount) {
                        $('#amountError')
                            .text(errors.proposedAmount[0])
                            .addClass('show');
                        $('#amountInputWrap').addClass('is-invalid');
                    }

                    // Description error
                    if (errors.projectDescription) {
                        $('#descError')
                            .text(errors.projectDescription[0])
                            .addClass('show');
                        $('#projectDescription').addClass('is-invalid');
                    }

                    $('#fileError').removeClass('show').text('');

                    Object.keys(errors).forEach(function(key) {
                        if (key.startsWith('proposalFiles')) {
                            $('#fileError')
                                .text(errors[key][0])
                                .addClass('show');

                            $('#uploadWrapper').addClass('is-invalid');
                        }
                    });
                }
            }

        });

    });
</script>

<script>
    let selectedFiles = [];

    (function() {
        var DESC_MAX = 3000;
        var ALLOWED_EXT = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg'];

        var form = document.getElementById('proposalForm');
        var amountInput = document.getElementById('proposedAmount');
        var amountWrap = document.getElementById('amountInputWrap');
        var amountError = document.getElementById('amountError');
        var descInput = document.getElementById('projectDescription');
        var descCount = document.getElementById('descCount');
        var descError = document.getElementById('descError');
        var fileInput = document.getElementById('proposalFiles');
        var uploadWrapper = document.getElementById('uploadWrapper');
        var uploadedFileRow = document.getElementById('uploadedFileRow');
        var uploadMoreBtn = document.getElementById('uploadMoreBtn');
        var uploadBtnLabel = document.getElementById('uploadBtnLabel');
        var uploadDropzone = document.getElementById('uploadDropzone');

        function getFileIconSvg(ext) {
            if (ext === 'pdf') {
                return (
                    '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">' +
                    '<rect width="30" height="30" rx="7" fill="#FDECEC"/>' +
                    '<path d="M9 7.5H16.5L21 12V22.5H9V7.5Z" fill="#E53935"/>' +
                    '<path d="M16.5 7.5V12H21" fill="#FF8A80"/>' +
                    '<text x="15" y="20" text-anchor="middle" fill="#fff" font-size="6" font-family="Inter,Arial" font-weight="700">PDF</text>' +
                    '</svg>'
                );
            }
            if (ext === 'docx' || ext === 'doc') {
                return (
                    '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">' +
                    '<rect width="30" height="30" rx="7" fill="#E8F1FB"/>' +
                    '<path d="M9 7.5H16.5L21 12V22.5H9V7.5Z" fill="#2B579A"/>' +
                    '<path d="M16.5 7.5V12H21" fill="#7BA3D4"/>' +
                    '<text x="15" y="20" text-anchor="middle" fill="#fff" font-size="5.5" font-family="Inter,Arial" font-weight="700">DOC</text>' +
                    '</svg>'
                );
            }
            return (
                '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">' +
                '<rect width="30" height="30" rx="7" fill="#E8F8EE"/>' +
                '<path d="M8.5 20.5L12.2 15.8L15.1 19.1L19.2 13.5L21.5 20.5H8.5Z" fill="#00A148"/>' +
                '<circle cx="12" cy="11" r="1.6" fill="#00A148"/>' +
                '<rect x="8" y="8" width="14" height="14" rx="2" stroke="#00A148" stroke-width="1.5" fill="none"/>' +
                '</svg>'
            );
        }

        var removeIconSvg =
            '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">' +
            '<path d="M11.4167 4.75V12.4833C11.4167 12.9077 11.2481 13.3146 10.948 13.6147C10.648 13.9148 10.241 14.0833 9.81667 14.0833H3.68333C3.25899 14.0833 2.85202 13.9148 2.55196 13.6147C2.2519 13.3146 2.08333 12.9077 2.08333 12.4833V4.75M9.41667 2.75V1.55C9.41667 1.11 9.05667 0.75 8.61667 0.75H4.88333C4.44333 0.75 4.08333 1.11 4.08333 1.55V2.75M9.41667 2.75H4.08333M9.41667 2.75H12.75M4.08333 2.75H0.75M6.75 6.75V10.75M8.75 6.75V10.75M4.75 6.75V10.75" stroke="#FE343D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>' +
            '</svg>';

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + 'b';
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1).replace(/\.0$/, '') + 'kb';
            return (bytes / (1024 * 1024)).toFixed(1).replace(/\.0$/, '') + 'mb';
        }

        function getExt(name) {
            var parts = name.toLowerCase().split('.');
            return parts.length > 1 ? parts.pop() : '';
        }

        function isAllowedFile(file) {
            return ALLOWED_EXT.indexOf(getExt(file.name)) !== -1;
        }

        function sanitizeAmount(value) {
            var cleaned = value.replace(/[^0-9.]/g, '');
            var parts = cleaned.split('.');
            if (parts.length > 2) {
                cleaned = parts[0] + '.' + parts.slice(1).join('');
            }
            return cleaned;
        }

        function updateDescCount() {
            var len = descInput.value.length;
            descCount.textContent = len + '/' + DESC_MAX;
            if (len >= DESC_MAX) {
                descCount.classList.add('is-limit');
            } else {
                descCount.classList.remove('is-limit');
            }
        }

        function clearAmountError() {
            amountWrap.classList.remove('is-invalid');
            amountError.classList.remove('show');
        }

        function clearDescError() {
            descInput.classList.remove('is-invalid');
            descError.classList.remove('show');
        }

        window.validateAmount = function() {
            var value = amountInput.value.trim();
            if (!value || isNaN(Number(value)) || Number(value) <= 0) {
                amountWrap.classList.add('is-invalid');
                amountError.classList.add('show');
                return false;
            }
            clearAmountError();
            return true;
        }

        window.validateDescription = function() {
            var value = descInput.value.trim();
            if (!value) {
                descInput.classList.add('is-invalid');
                descError.classList.add('show');
                return false;
            }
            clearDescError();
            return true;
        }

        function updateUploadUI() {
            if (selectedFiles.length > 0) {
                uploadWrapper.classList.add('has-files');
                uploadBtnLabel.textContent = 'Upload more.';
            } else {
                uploadWrapper.classList.remove('has-files');
                uploadBtnLabel.textContent = 'Upload';
            }
        }

        function renderFiles() {
            uploadedFileRow.innerHTML = '';
            selectedFiles.forEach(function(file, index) {
                var col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML =
                    '<div class="single">' +
                    '<div class="icon">' + getFileIconSvg(getExt(file.name)) + '</div>' +
                    '<div class="text">' +
                    '<h2></h2>' +
                    '<p></p>' +
                    '</div>' +
                    '<a href="#" class="remove-file" data-index="' + index + '" title="Remove file">' + removeIconSvg + '</a>' +
                    '</div>';
                col.querySelector('h2').textContent = file.name;
                col.querySelector('p').textContent = formatFileSize(file.size);
                uploadedFileRow.appendChild(col);
            });
            updateUploadUI();
        }

        function addFiles(fileList) {
            Array.prototype.forEach.call(fileList, function(file) {
                if (!isAllowedFile(file)) return;
                var exists = selectedFiles.some(function(f) {
                    return f.name === file.name && f.size === file.size && f.lastModified === file.lastModified;
                });
                if (!exists) selectedFiles.push(file);
            });
            renderFiles();
            fileInput.value = '';
        }

        function openFilePicker() {
            fileInput.click();
        }

        amountInput.addEventListener('input', function() {
            var sanitized = sanitizeAmount(amountInput.value);
            if (amountInput.value !== sanitized) {
                amountInput.value = sanitized;
            }
            if (amountInput.value.trim()) clearAmountError();
        });

        amountInput.addEventListener('keypress', function(e) {
            var char = String.fromCharCode(e.which || e.keyCode);
            if (!/[0-9.]/.test(char)) {
                e.preventDefault();
            }
        });

        descInput.addEventListener('input', function() {
            updateDescCount();
            if (descInput.value.trim()) clearDescError();
        });

        uploadDropzone.addEventListener('click', function(e) {
            e.preventDefault();
            openFilePicker();
        });

        uploadMoreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openFilePicker();
        });

        fileInput.addEventListener('change', function() {
            if (fileInput.files && fileInput.files.length) {
                addFiles(fileInput.files);
            }
            $('#fileError').removeClass('show').text('');
            $('#uploadWrapper').removeClass('is-invalid');
        });

        ['dragenter', 'dragover'].forEach(function(evt) {
            uploadWrapper.addEventListener(evt, function(e) {
                e.preventDefault();
                e.stopPropagation();
                uploadWrapper.classList.add('is-dragover');
            });
        });

        ['dragleave', 'drop'].forEach(function(evt) {
            uploadWrapper.addEventListener(evt, function(e) {
                e.preventDefault();
                e.stopPropagation();
                uploadWrapper.classList.remove('is-dragover');
            });
        });

        uploadWrapper.addEventListener('drop', function(e) {
            var files = e.dataTransfer && e.dataTransfer.files;
            if (files && files.length) addFiles(files);
        });

        uploadedFileRow.addEventListener('click', function(e) {
            var btn = e.target.closest('.remove-file');
            if (!btn) return;
            e.preventDefault();
            var index = parseInt(btn.getAttribute('data-index'), 10);
            if (!isNaN(index)) {
                selectedFiles.splice(index, 1);
                renderFiles();
            }
        });

        updateDescCount();
        updateUploadUI();
    })();
</script>

<script>
(function () {
  var tl = document.getElementById('tl');
  var fill = document.getElementById('fill');
  if (!tl || !fill) return;

  var steps = [].slice.call(tl.querySelectorAll('.step'));
  var STEP_DELAY = 1100;   // ms: ek step se dusre step tak
  var TARGET = 3;          // 4th step (Resume Viewed) tak
  var reached = -1;

  // dot ke center tak line ki height (fill ke top se naapi hui)
  function yFor(i) {
    var dot = steps[i].querySelector('.dot');
    return steps[i].offsetTop + dot.offsetTop + dot.offsetHeight / 2 - fill.offsetTop;
  }

  function run() {
    steps.forEach(function (s) { s.classList.remove('done', 'current'); });
    fill.style.transition = 'none';
    fill.style.height = '0px';
    void fill.offsetHeight;          // reflow
    fill.style.transition = '';      // CSS wali transition wapas
    reached = -1;

    var i = 0;
    function next() {
      if (i > TARGET) return;
      var idx = i, s = steps[idx];
      reached = idx;
      fill.style.height = yFor(idx) + 'px';
      setTimeout(function () {
        s.classList.add(idx === TARGET ? 'current' : 'done');
      }, 900);
      i++;
      setTimeout(next, STEP_DELAY);
    }
    setTimeout(next, 400);
  }

  window.addEventListener('resize', function () {
    if (reached < 0) return;
    fill.style.transition = 'none';
    fill.style.height = yFor(reached) + 'px';
    void fill.offsetHeight;
    fill.style.transition = '';
  });

  run();
})();
</script>

@endsection