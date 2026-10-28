@extends('employer.layouts.main')

@section('main-section')

@php
$fields = ['id','name'];
$categories = getCategories($fields);
@endphp

<link rel="stylesheet" href="{{ asset('frontend/css/register.css') }}?v={{ filemtime(public_path('frontend/css/register.css')) }}" />

<section class="register-page">
    <img src="{{ asset('frontend/images/bg-img1.png') }}" class="bg-img1" alt="">
    <img src="{{ asset('frontend/images/bg-img2.png') }}" class="bg-img2" alt="">
    <img src="{{ asset('frontend/images/bg-img3.png') }}" class="bg-img3" alt="">

    <div class="container">
        <div class="profile-header">
            <div class="letget">
                <img src="{{ asset('frontend/images/handimg.svg') }}" alt="">
                lets get Started !
            </div>
            <h1>Start your <span>Employeer Journey</span></h1>
            <p>Launch your independent career: find clients, build skills, earn on your terms.</p>
        </div>
                <div class="step-panel">
                    <div class="job-post-title">
                        <h2>Post Job/Internship</h2>
                        <p>Hire early talent with work experience up to 2 years</p>
                    </div>
                    
                    <div class="profile-infom">
                        <label>Opportunity type <span class="req">*</span></label>
                        <div class="opportunity-box">
                            <label class="radio-option">
                                <input type="radio" name="opportunity_type" value="job">
                                <span>Job</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="opportunity_type" value="internship" >
                                <span>Internship</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="opportunity_type" value="freelancer">
                                <span>Freelancer</span>
                            </label>
                        </div>
                    </div>    

                    <div class="profile-infom">
                        <img src="{{ asset('frontend/images/profile-round-top.png') }}" class="profile-top" alt="">

                        <div class="pro-header-extra">
                            <h2>Job details</h2> 
                        </div>
     
                        <div class="input-row">
                            <div class="col-12">
                                <label>Job title <span class="req">*</span></label>
                                <input id="job_title" name="job_title" type="text" placeholder="Human Resources (HR) Executive" value="{{ old('job_title') }}">
                            </div>
                        </div>
                        
                        <div class="input-row">
                            <div class="col-12">
                                <label>Experience <span class="req">*</span></label>
                        
                                <select name="experience" id="experience" class="form-select">
                                    <option value="" {{ old('experience') === null ? 'selected' : '' }} disabled>
                                        Select your Experience
                                    </option>
                        
                                    <option value="fresher" {{ old('experience') == 'fresher' ? 'selected' : '' }}>
                                        Fresher
                                    </option>
                        
                                    <option value="0-1" {{ old('experience') == '0-1' ? 'selected' : '' }}>
                                        0-1 Years
                                    </option>
                        
                                    <option value="2-3" {{ old('experience') == '2-3' ? 'selected' : '' }}>
                                        2-3 Years
                                    </option>
                        
                                    <option value="4-5" {{ old('experience') == '4-5' ? 'selected' : '' }}>
                                        4-5 Years
                                    </option>
                        
                                    <option value="6-10" {{ old('experience') == '6-10' ? 'selected' : '' }}>
                                        6-10 Years
                                    </option>
                        
                                    <option value="10+" {{ old('experience') == '10+' ? 'selected' : '' }}>
                                        10+ Years
                                    </option>
                                </select>
                            </div>
                        </div>

                        <label>Job type <span class="req">*</span></label>
                        <div class="opportunity-box">
                            <label class="radio-option">
                                <input type="radio" name="location_type" value="onsite">
                                <span>In Office</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="location_type" value="hybrid">
                                <span>Hybrid</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="location_type" value="remote">
                                <span>Remote</span>
                            </label>
                        </div>

                        <label>Part-time/Full-time <span class="req">*</span></label>
                        <div class="opportunity-box">
                            <label class="radio-option">
                                <input type="radio" name="job_type" value="part_time">
                                <span>Part-time</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="job_type" value="full_time">
                                <span>Full-time</span>
                            </label>
                        </div>

                        <div class="input-row">
                            <label>Job Location <span class="req">*</span></label>
                        
                            <div class="ac-input-wrap">
                                <input
                                    name="job_location"
                                    id="job_location"
                                    type="text"
                                    placeholder="Enter your preferred Job Location"
                                    value="{{ old('job_location') }}"
                                    autocomplete="off"
                                >
                            </div>
                        
                            <div class="skills-tags" id="locationTags"></div>
                        </div>

                        <div class="input-row">
                            <div class="field">
                                <label>Job description</label>
                                <div class="job-des">
                                     <div class="tip-header1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_3973_5819)">
                                            <path d="M8.00021 10.67V8.00314M8.00021 5.33626H8.00688M14.6674 8.00314C14.6674 11.6853 11.6824 14.6703 8.00021 14.6703C4.31801 14.6703 1.33301 11.6853 1.33301 8.00314C1.33301 4.32094 4.31801 1.33594 8.00021 1.33594C11.6824 1.33594 14.6674 4.32094 14.6674 8.00314Z" stroke="#00A148" stroke-width="2" stroke-linecap="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3973_5819">
                                            <rect width="16" height="16" fill="white"/>
                                            </clipPath>
                                        </defs>
                                        </svg>
                                        <h2>Autopopulated job description. Please proof read and customise it as per your need.</h2> 
                                    </div>
                                
                               
                                    <button type="button" id="aiSuggestBtn" class="ai-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <g clip-path="url(#clip0_4046_4437)">
                                                <path d="M6.62479 10.3361C6.56527 10.1054 6.44502 9.89484 6.27653 9.72636C6.10805 9.55788 5.8975 9.43762 5.66679 9.3781L1.57679 8.32344C1.50701 8.30363 1.4456 8.26161 1.40186 8.20373C1.35813 8.14586 1.33447 8.07531 1.33447 8.00277C1.33447 7.93024 1.35813 7.85968 1.40186 7.80181C1.4456 7.74394 1.50701 7.70191 1.57679 7.6821L5.66679 6.62677C5.89742 6.56731 6.10792 6.44715 6.27639 6.2788C6.44486 6.11044 6.56517 5.90003 6.62479 5.66944L7.67946 1.57944C7.69906 1.50938 7.74105 1.44766 7.799 1.4037C7.85696 1.35974 7.92771 1.33594 8.00046 1.33594C8.0732 1.33594 8.14395 1.35974 8.20191 1.4037C8.25987 1.44766 8.30185 1.50938 8.32146 1.57944L9.37546 5.66944C9.43497 5.90015 9.55523 6.1107 9.72371 6.27918C9.89219 6.44766 10.1027 6.56792 10.3335 6.62744L14.4235 7.68144C14.4938 7.70084 14.5558 7.74278 14.6 7.80082C14.6442 7.85887 14.6682 7.92981 14.6682 8.00277C14.6682 8.07573 14.6442 8.14667 14.6 8.20472C14.5558 8.26276 14.4938 8.3047 14.4235 8.3241L10.3335 9.3781C10.1027 9.43762 9.89219 9.55788 9.72371 9.72636C9.55523 9.89484 9.43497 10.1054 9.37546 10.3361L8.32079 14.4261C8.30118 14.4962 8.2592 14.5579 8.20124 14.6018C8.14328 14.6458 8.07254 14.6696 7.99979 14.6696C7.92704 14.6696 7.85629 14.6458 7.79834 14.6018C7.74038 14.5579 7.69839 14.4962 7.67879 14.4261L6.62479 10.3361Z" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M13.3335 2V4.66667" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M14.6667 3.33594H12" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M2.6665 11.3359V12.6693" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M3.33333 12H2" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_4046_4437">
                                            <rect width="16" height="16" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                        </svg>
                                        AI Suggest
                                    </button>
                                </div>
                                
                                <textarea name="job_description" id="job_description" class="profile-summary-input1" placeholder="please Enter your Job Description here...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="input-row">
                            <label>Skills required <span class="req">*</span></label>
                        
                            <div class="ac-input-wrap">
                                <input
                                    name="skills_input"
                                    id="skills_input"
                                    type="text"
                                    placeholder="Enter skill and press Enter"
                                    autocomplete="off"
                                >
                            </div>
                        
                            <!-- Selected Skills -->
                            <div class="skills-tags" id="skillTags"></div>
                        
                            <!-- Actual value submitted to Laravel -->
                            <input type="hidden" name="skills" id="skills" value="{{ old('skills') }}">
                        </div>

                    </div>

                    <div class="profile-infom">
                        <div class="pro-header-extra">
                            <h2>Salary & perks</h2>
                        </div>

                        <div class="salaryperk">
                            <div class="opportunity-box1">
                                <label class="radio-option">
                                    <input type="radio" name="salary_disclosure" value="disclosed" id="salary_disclosed" checked>
                                    <span>Disclose salary</span>
                                </label>

                                <label class="radio-option">
                                    <input type="radio" name="salary_disclosure" value="not_disclosed" id="salary_not_disclosed">
                                    <span>Not disclosed</span>
                                </label>
                            </div>
                            
                            <div class="input-row">
                                <div class="salary-fields" id="salaryFields">
                                    <div class="salary-input">
                                        <span class="currency">₹</span>
                                        <input type="text" name="budget" id="budget" placeholder="Enter salary" value="{{ old('budget') }}" />
                                    </div>
                                    <span class="year-text">per year</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="footer-btn">
                        <button type="button" class="post-btn" id="goStep3">
                            <span id="submitBtnText">Post job</span>
                        </button>
                    </div>
                </div>          
    </div>
</section>

<!----- Profile Summary Popup-------->
<!--<div class="modal bottom-sheet fade" id="createAIModal" tabindex="-1" aria-labelledby="JobDescription" aria-hidden="true">-->
<!--  <div class="modal-dialog modal-dialog-centered">-->
<!--    <div class="modal-content">-->
<!--      <div class="drag-handle"></div>-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="JobDescription">Job Description</h5>-->
<!--        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">-->
<!--            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">-->
<!--                <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--            </svg>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        <form id="basicDetailsForm">-->
            <!-- Profile Summary -->
<!--            <div class="input-row">-->
<!--                <textarea id="aiJobDescription" placeholder="Describe the job you want to post..."></textarea>-->
<!--            </div>-->

<!--            <div class="modal-footer">-->
<!--                <button class="ai-btn" type="button" id="generateJobBtn">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">-->
<!--                        <g clip-path="url(#clip0_4046_4437)">-->
<!--                            <path d="M6.62479 10.3361C6.56527 10.1054 6.44502 9.89484 6.27653 9.72636C6.10805 9.55788 5.8975 9.43762 5.66679 9.3781L1.57679 8.32344C1.50701 8.30363 1.4456 8.26161 1.40186 8.20373C1.35813 8.14586 1.33447 8.07531 1.33447 8.00277C1.33447 7.93024 1.35813 7.85968 1.40186 7.80181C1.4456 7.74394 1.50701 7.70191 1.57679 7.6821L5.66679 6.62677C5.89742 6.56731 6.10792 6.44715 6.27639 6.2788C6.44486 6.11044 6.56517 5.90003 6.62479 5.66944L7.67946 1.57944C7.69906 1.50938 7.74105 1.44766 7.799 1.4037C7.85696 1.35974 7.92771 1.33594 8.00046 1.33594C8.0732 1.33594 8.14395 1.35974 8.20191 1.4037C8.25987 1.44766 8.30185 1.50938 8.32146 1.57944L9.37546 5.66944C9.43497 5.90015 9.55523 6.1107 9.72371 6.27918C9.89219 6.44766 10.1027 6.56792 10.3335 6.62744L14.4235 7.68144C14.4938 7.70084 14.5558 7.74278 14.6 7.80082C14.6442 7.85887 14.6682 7.92981 14.6682 8.00277C14.6682 8.07573 14.6442 8.14667 14.6 8.20472C14.5558 8.26276 14.4938 8.3047 14.4235 8.3241L10.3335 9.3781C10.1027 9.43762 9.89219 9.55788 9.72371 9.72636C9.55523 9.89484 9.43497 10.1054 9.37546 10.3361L8.32079 14.4261C8.30118 14.4962 8.2592 14.5579 8.20124 14.6018C8.14328 14.6458 8.07254 14.6696 7.99979 14.6696C7.92704 14.6696 7.85629 14.6458 7.79834 14.6018C7.74038 14.5579 7.69839 14.4962 7.67879 14.4261L6.62479 10.3361Z" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M13.3335 2V4.66667" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M14.6667 3.33594H12" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M2.6665 11.3359V12.6693" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <path d="M3.33333 12H2" stroke="#00A148" stroke-width="1.08333" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                        </g>-->
<!--                        <defs>-->
<!--                        <clipPath id="clip0_4046_4437">-->
<!--                        <rect width="16" height="16" fill="white"/>-->
<!--                        </clipPath>-->
<!--                        </defs>-->
<!--                    </svg>-->
<!--                    Generate Job-->
<!--                </button>-->
<!--            </div>  -->
<!--        </form>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!----- Profile Summary Popup-------->

<!----- jobPostModal Popup-------->
<!--<div class="modal fade" id="jobPostModal" tabindex="-1" aria-labelledby="jobPostModalLabel" aria-hidden="true">-->
<!--  <div class="modal-dialog modal-dialog-centered">-->
<!--    <div class="modal-content modal-content1">-->
<!--        <div class="header-close1">-->
<!--            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">-->
<!--                    <path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    <path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.77083" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                </svg>-->
<!--            </button>-->
<!--        </div>-->
<!--        <div class="modal-body">-->
<!--            <div class="letget">-->
<!--                <img src="assets/images/handimg.svg" alt="">-->
<!--                Create Your Job Post-->
<!--            </div>-->
<!--            <h1>Let's Build the Perfect <span>Job Post!</span></h1>-->

<!--            <p>Choose how you'd like to create your job posting. Upload an existing Job Description or let our AI help you craft one in just a few simple steps.</p>-->


<!--            <div class="job-row">-->
<!--                <div class="job-card">-->
<!--                    <div class="icon-circle">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">-->
<!--                            <path d="M25.6673 44.3307H30.334V34.5891L34.0673 38.3224L37.334 34.9974L28.0007 25.6641L18.6673 34.9974L21.9923 38.2641L25.6673 34.5891V44.3307ZM14.0007 51.3307C12.7173 51.3307 11.6191 50.8742 10.706 49.9611C9.79287 49.048 9.33554 47.949 9.33398 46.6641V9.33073C9.33398 8.0474 9.79132 6.94917 10.706 6.03606C11.6207 5.12295 12.7189 4.66562 14.0007 4.66406H32.6673L46.6673 18.6641V46.6641C46.6673 47.9474 46.2108 49.0464 45.2976 49.9611C44.3845 50.8757 43.2855 51.3323 42.0006 51.3307H14.0007ZM30.334 20.9974V9.33073H14.0007V46.6641H42.0006V20.9974H30.334Z" fill="#00A148"/>-->
<!--                        </svg>-->
<!--                    </div>-->
<!--                    <h2>Upload Job Description</h2>-->
<!--                    <p class="desc">We'll extract the important details from your job description automatically.</p>-->
<!--                    <ul class="feature-list">-->
<!--                        <li>-->
<!--                            <span class="check">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">-->
<!--                                    <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                </svg>-->
<!--                            </span>-->
<!--                            Upload your resume or Document.-->
<!--                        </li>-->

<!--                        <li>-->
<!--                            <span class="check">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">-->
<!--                                    <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                </svg>-->
<!--                            </span>-->
<!--                            AI extracts skills, requirements.-->
<!--                        </li>-->


<!--                        <li>-->
<!--                            <span class="check">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">-->
<!--                                    <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                </svg>-->
<!--                            </span>-->
<!--                            Save time and post jobs faster.-->
<!--                        </li>-->

<!--                    </ul>-->
<!--                    <div class="resume-upload" id="dropzone">-->
<!--                        <label class="change-photo-btn" class="upload-btn" id="uploadBtn">-->
<!--                            Upload Document-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">-->
<!--                                <path d="M4.86506 8.44531C3.0305 8.8816 1.66602 10.531 1.66602 12.4991C1.66602 14.8002 3.53149 16.6657 5.83268 16.6657C6.22743 16.6657 6.60935 16.6109 6.97122 16.5083" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                <path d="M15.0222 8.44531C16.8568 8.8816 18.2212 10.531 18.2212 12.4991C18.2212 14.8002 16.3558 16.6657 14.0546 16.6657C13.6598 16.6657 13.2779 16.6109 12.916 16.5083" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                <path d="M15 8.33594C15 5.57452 12.7614 3.33594 10 3.33594C7.23858 3.33594 5 5.57452 5 8.33594" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                <path d="M7.10938 11.6177L9.99875 8.71875L12.9704 11.6673" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                <path d="M10 15.8362V10.1953" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            </svg>-->
<!--                        </label>-->
<!--                        <input type="file" id="fileInputDoc" accept=".pdf,.doc,.docx">-->
<!--                        <div class="file-list" id="fileList"></div>-->
<!--                    </div>-->
<!--                </div>-->

                <!-- Create with AI card -->
<!--                <div class="job-card">-->
<!--                    <div class="icon-circle">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">-->
<!--                            <path d="M25.6673 44.3307H30.334V34.5891L34.0673 38.3224L37.334 34.9974L28.0007 25.6641L18.6673 34.9974L21.9923 38.2641L25.6673 34.5891V44.3307ZM14.0007 51.3307C12.7173 51.3307 11.6191 50.8742 10.706 49.9611C9.79287 49.048 9.33554 47.949 9.33398 46.6641V9.33073C9.33398 8.0474 9.79132 6.94917 10.706 6.03606C11.6207 5.12295 12.7189 4.66562 14.0007 4.66406H32.6673L46.6673 18.6641V46.6641C46.6673 47.9474 46.2108 49.0464 45.2976 49.9611C44.3845 50.8757 43.2855 51.3323 42.0006 51.3307H14.0007ZM30.334 20.9974V9.33073H14.0007V46.6641H42.0006V20.9974H30.334Z" fill="#00A148"/>-->
<!--                        </svg>-->
<!--                    </div>-->
<!--                    <h2>Create with AI</h2>-->
<!--                    <p class="desc">Answer a few simple questions, and our AI will generate a professional jobs.</p>-->
<!--                    <ul class="feature-list">-->
<!--                        <li>-->
<!--                            <span class="check">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">-->
<!--                                    <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                </svg>-->
<!--                            </span>-->
<!--                            Upload your resume or Document.-->
<!--                        </li>-->

<!--                        <li>-->
<!--                            <span class="check">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">-->
<!--                                    <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                </svg>-->
<!--                            </span>-->
<!--                            AI extracts skills, requirements.-->
<!--                        </li>-->


<!--                        <li>-->
<!--                            <span class="check">-->
<!--                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">-->
<!--                                    <path d="M2.40625 7.65625L5.46875 10.7188L11.5938 4.15625" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                                </svg>-->
<!--                            </span>-->
<!--                            Save time and post jobs faster.-->
<!--                        </li>-->

<!--                    </ul>-->
<!--                    <button class="btn-green" type="button" data-bs-toggle="modal" data-bs-target="#createAIModal">Create with AI -->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">-->
<!--                            <path d="M8.3775 4.80917C8.63417 4.0575 9.6975 4.0575 9.95417 4.80917L10.6258 6.77583C10.8314 7.37841 11.1724 7.92585 11.6225 8.37613C12.0727 8.82641 12.62 9.16754 13.2225 9.37333L15.1892 10.045C15.9417 10.3017 15.9417 11.365 15.1892 11.6217L13.2225 12.2933C12.6201 12.499 12.0728 12.84 11.6227 13.2902C11.1725 13.7403 10.8315 14.2876 10.6258 14.89L9.95417 16.8567C9.6975 17.6092 8.63417 17.6092 8.3775 16.8567L7.70583 14.89C7.50013 14.2876 7.15912 13.7403 6.70899 13.2902C6.25887 12.84 5.71159 12.499 5.10917 12.2933L3.1425 11.6217C2.39 11.365 2.39 10.3017 3.1425 10.045L5.10917 9.37333C5.71159 9.16763 6.25887 8.82662 6.70899 8.37649C7.15912 7.92637 7.50013 7.37909 7.70583 6.77667L8.3775 4.80917ZM15.8325 2.5L16.2575 3.74167L17.4992 4.16667L16.2575 4.59167L15.8325 5.83333L15.4075 4.59167L14.1658 4.16667L15.4075 3.74167L15.8325 2.5Z" stroke="white" stroke-linejoin="round"/>-->
<!--                        </svg>-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="modal-footer1">-->
<!--            <div class="footer-left">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
<!--                    <path d="M12 22.4984C12 22.4984 20.9986 19.4988 20.9986 12" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    <path d="M20.9986 11.9984V2.99977C20.9986 2.99977 17.9991 1.5 12 1.5" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    <path d="M12.0006 22.4984C12.0006 22.4984 3.00195 19.4988 3.00195 12" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    <path d="M3.00195 11.9984V2.99977C3.00195 2.99977 6.00149 1.5 12.0006 1.5" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    <path d="M18.0003 6C12.0013 10.4993 10.5015 16.4984 10.5015 16.4984C10.5015 16.4984 9.00172 14.7082 7.50195 13.4988" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                </svg>-->
<!--                <div class="footer-text">-->
<!--                    <h2>Your information is safe with us !</h2>-->
<!--                    <p>we use encryption to protect your data and never share it with everyone,</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="link-icon">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41" fill="none">-->
<!--                    <g opacity="0.5" clip-path="url(#clip0_4313_13934)">-->
<!--                        <path d="M15.2459 14.5747L16.4959 12.4097C16.7088 12.0409 16.9471 11.6973 17.2108 11.379M28.2363 22.0747L29.4863 19.9097C30.2481 18.5904 30.5901 17.0703 30.4667 15.5519C30.3433 14.0335 29.7605 12.5886 28.7957 11.4096C27.8309 10.2305 26.5299 9.3733 25.0659 8.95189C23.6019 8.53049 22.0443 8.56491 20.6003 9.05059M13.1586 30.6901L9.91097 28.8151C6.84957 27.0476 5.31779 26.1632 4.9167 24.6629C4.51391 23.1631 5.39828 21.6313 7.16578 18.5699C8.93328 15.5085 9.81766 13.9767 11.318 13.5756C12.8178 13.1728 14.3496 14.0572 17.411 15.8247L26.0712 20.8247C29.1326 22.5922 30.6644 23.4766 31.0655 24.9769C31.4683 26.4767 30.5839 28.0085 28.8164 31.0699C27.0489 34.1313 26.1645 35.6631 24.6642 36.0642C23.1644 36.467 21.6326 35.5826 18.5712 33.8151L17.4887 33.1901" stroke="#00A148" stroke-width="1.5" stroke-linecap="round"/>-->
<!--                    </g>-->
<!--                    <defs>-->
<!--                        <clipPath id="clip0_4313_13934">-->
<!--                        <rect width="30" height="30" fill="white" transform="translate(15) rotate(30)"/>-->
<!--                        </clipPath>-->
<!--                    </defs>-->
<!--                </svg>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!----- jobPostModal Popup-------->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- ====== Company Documents Upload JS ====== -->
<script>
  const dropzone = document.getElementById('dropzone');
  const fileInputDoc = document.getElementById('fileInputDoc');
  const uploadBtn = document.getElementById('uploadBtn');
  const fileList = document.getElementById('fileList');
 
  // click button or dropzone opens file picker
  uploadBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    fileInputDoc.click();
  });
  dropzone.addEventListener('click', () => fileInputDoc.click());
 
  // drag events
  ['dragenter','dragover'].forEach(evt=>{
    dropzone.addEventListener(evt, (e)=>{
      e.preventDefault();
      e.stopPropagation();
      dropzone.classList.add('dragover');
    });
  });
 
  ['dragleave','drop'].forEach(evt=>{
    dropzone.addEventListener(evt, (e)=>{
      e.preventDefault();
      e.stopPropagation();
      dropzone.classList.remove('dragover');
    });
  });
 
  dropzone.addEventListener('drop', (e)=>{
    const files = e.dataTransfer.files;
    handleFiles(files);
  });
 
  fileInputDoc.addEventListener('change', (e)=>{
    handleFiles(e.target.files);
    fileInputDoc.value = ''; // allow re-selecting same file
  });
 
  function formatSize(bytes){
    if(bytes < 1024) return bytes + ' B';
    if(bytes < 1024*1024) return (bytes/1024).toFixed(1) + ' KB';
    return (bytes/(1024*1024)).toFixed(1) + ' MB';
  }
 
  function fileIconSVG(name){
    const ext = name.split('.').pop().toLowerCase();
    if(ext === 'pdf'){
      return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2h9l5 5v15H6z"/><path d="M15 2v5h5"/></svg>';
    }
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>';
  }
 
  function handleFiles(files){
    [...files].forEach(file => {
      createFileItem(file);
    });
  }
 
  function createFileItem(file){
    const item = document.createElement('div');
    item.className = 'file-item';
    item.innerHTML = `
      <div class="file-top">
        <div class="file-icon">${fileIconSVG(file.name)}</div>
        <div class="file-info">
          <div class="file-name">${file.name}</div>
          <div class="file-size">${formatSize(file.size)}</div>
        </div>
        <button class="file-remove" title="Remove">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>
      <div class="progress-track">
        <div class="progress-fill"></div>
      </div>
      <div class="progress-bottom">
        <span class="progress-status">Uploading...</span>
        <span class="progress-percent">0%</span>
      </div>
    `;
 
    fileList.prepend(item);
 
    const fill = item.querySelector('.progress-fill');
    const percentLabel = item.querySelector('.progress-percent');
    const statusLabel = item.querySelector('.progress-status');
    const removeBtn = item.querySelector('.file-remove');
 
    removeBtn.addEventListener('click', () => item.remove());
 
    // simulate upload progress
    let progress = 0;
    const interval = setInterval(() => {
      progress += Math.random() * 18 + 6;
      if(progress >= 100){
        progress = 100;
        clearInterval(interval);
        statusLabel.innerHTML = `
          <span class="status-done">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
            Uploaded
          </span>`;
      }
      fill.style.width = progress + '%';
      percentLabel.textContent = Math.floor(progress) + '%';
    }, 250);
  }
</script>

<script>
    // ==========================================
    // GLOBAL SKILLS DATA
    // ==========================================

    let selectedSkills = [];


    // ==========================================
    // RENDER SKILLS
    // ==========================================

    function renderSkills() {

        const container = $('#skillTags');

        container.empty();

        selectedSkills.forEach(function (skill, index) {

            const safeSkill = $('<div>')
                .text(skill)
                .html();

            container.append(`
                <span class="skilltag" data-index="${index}">
                    ${safeSkill}

                    <button
                        type="button"
                        class="tag-remove skill-remove"
                        data-index="${index}"
                        aria-label="Remove skill">
                        &times;
                    </button>
                </span>
            `);
        });

        // Update hidden input
        $('#skills').val(selectedSkills.join(','));
    }


    // ==========================================
    // ADD SKILL WITH ENTER
    // ==========================================

    $(document).on('keydown', '#skills_input', function (e) {

        if (e.key !== 'Enter') {
            return;
        }

        e.preventDefault();

        let skill = $(this).val().trim();

        if (!skill) {
            return;
        }

        // Support comma-separated input also
        let newSkills = skill
            .split(',')
            .map(item => item.trim())
            .filter(item => item !== '');

        newSkills.forEach(function (newSkill) {

            // Maximum 10 skills
            if (selectedSkills.length >= 10) {
                return;
            }

            // Prevent duplicate
            const alreadyExists = selectedSkills.some(function (existingSkill) {
                return existingSkill.toLowerCase() === newSkill.toLowerCase();
            });

            if (!alreadyExists) {
                selectedSkills.push(newSkill);
            }
        });

        // Clear input
        $(this).val('');

        // Render tags
        renderSkills();
    });


    // ==========================================
    // REMOVE SKILL
    // ==========================================

    $(document).on('click', '.skill-remove', function (e) {

        e.preventDefault();

        const index = $(this).data('index');

        selectedSkills.splice(index, 1);

        renderSkills();
    });


    // ==========================================
    // LOAD OLD SKILLS
    // ==========================================

    $(document).ready(function () {

        const oldSkills = $('#skills').val();

        if (oldSkills) {

            selectedSkills = oldSkills
                .split(',')
                .map(skill => skill.trim())
                .filter(skill => skill !== '');

            renderSkills();
        }

    });
</script>

<script>
$('#generateJobBtn').on('click', function () {

    const description = $('#aiJobDescription').val().trim();

    if (!description) {
        alert('Please describe the job first.');
        return;
    }

    const btn = $(this);

    btn.prop('disabled', true);
    btn.text('Generating...');

    $.ajax({
        url: "{{ route('employer.ai.job.description') }}",
        type: "POST",

        data: {
            _token: "{{ csrf_token() }}",
            description: description
        },

        success: function (response) {

            console.log('AI Response:', response);

            if (response.status === 'success' && response.data) {

                // Job Description
                $('#job_description').val(
                    response.data.project_description || ''
                );

                // Skills
                if (Array.isArray(response.data.skills)) {
                
                    const skills = response.data.skills;
                
                    // Set input value
                    $('#skills_input').val(skills.join(', '));
                
                    // Skill tags
                    const skillsContainer = $('#skillTags');
                    skillsContainer.empty();
                
                    skills.forEach(function (skill) {
                
                        skillsContainer.append(`
                            <span class="skilltag" data-skill="${$('<div>').text(skill).html()}">
                                ${$('<div>').text(skill).html()}
                                <button type="button" class="tag-remove skill-remove">
                                    ×
                                </button>
                            </span>
                        `);
                
                    });
                }

                // Close AI modal
                const aiModalElement = document.getElementById('createAIModal');
                const aiModal = bootstrap.Modal.getInstance(aiModalElement);

                if (aiModal) {
                    aiModal.hide();
                }

                // Close parent modal
                const jobModalElement = document.getElementById('jobPostModal');
                const jobModal = bootstrap.Modal.getInstance(jobModalElement);

                if (jobModal) {
                    jobModal.hide();
                }

            } else {

                alert(response.message || 'Unable to generate job.');
            }
        },

        error: function (xhr) {

            console.log('AI Error:', xhr.responseText);

            alert('Something went wrong while generating the job.');
        },

        complete: function () {

            btn.prop('disabled', false);

            btn.html(`
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="16"
                     height="16"
                     viewBox="0 0 16 16"
                     fill="none">
                </svg>
                Generate Job
            `);
        }
    });
    
});
</script>

<script>
$(document).ready(function () {

    $('#goStep3').on('click', function (e) {

        e.preventDefault();

        const submitBtn = document.getElementById('goStep3');
        const submitBtnText = document.getElementById('submitBtnText');

        /*
        |--------------------------------------------------------------------------
        | Get all form values
        |--------------------------------------------------------------------------
        */

        const jobTitle = $('#job_title').val().trim();
        const experience = $('#experience').val();
        const locationType = $('input[name="location_type"]:checked').val();
        const jobType = $('input[name="job_type"]:checked').val();
        const jobLocation = $('#job_location').val().trim();
        const description = $('#job_description').val().trim();
        const skills = $('#skills').val().trim();
        const salaryDisclosure = $('input[name="salary_disclosure"]:checked').val();
        const budget = $('#budget').val().trim();

        /*
        |--------------------------------------------------------------------------
        | Opportunity Type
        |--------------------------------------------------------------------------
        |
        | Your current HTML has different names:
        | job / internship / freelancer
        |
        */

        const opportunityType = $('input[name="opportunity_type"]:checked').val();

        /*
        |--------------------------------------------------------------------------
        | Category
        |--------------------------------------------------------------------------
        |
        | Make sure you have:
        | <select name="category" id="category">
        |
        */

        // const category = $('#category').val();

        /*
        |--------------------------------------------------------------------------
        | Duration
        |--------------------------------------------------------------------------
        |
        | Make sure you have:
        | <input name="duration" id="duration">
        |
        */

        // const duration = $('#duration').val();

        /*
        |--------------------------------------------------------------------------
        | Basic frontend validation
        |--------------------------------------------------------------------------
        */

        if (!opportunityType) {
            alert('Please select Opportunity Type.');
            return;
        }

        if (!jobTitle) {
            alert('Please enter Job Title.');
            $('#job_title').focus();
            return;
        }

        if (!experience) {
            alert('Please select Experience.');
            $('#experience').focus();
            return;
        }
        
        if (!locationType) {
            alert('Please select Job Type.');
            return;
        }

        if (!jobType) {
            alert('Please select Part-time or Full-time.');
            return;
        }

        if (!jobLocation) {
            alert('Please enter Job Location.');
            $('#job_location').focus();
            return;
        }

        if (!description) {
            alert('Please enter Job Description.');
            $('#job_description').focus();
            return;
        }

        if (!skills) {
            alert('Please enter at least one skill.');
            $('#skills_input').focus();
            return;
        }
        
        if (!salaryDisclosure) {
            alert('Please select salary disclosure option.');
            return;
        }
        
        if (salaryDisclosure === 'disclosed' && !budget) {
            alert('Please enter salary.');
            $('#budget').focus();
            return;
        }


        // if (!category) {
        //     alert('Please select Category.');
        //     $('#category').focus();
        //     return;
        // }

        // if (!duration) {
        //     alert('Please select Duration.');
        //     $('#duration').focus();
        //     return;
        // }

        /*
        |--------------------------------------------------------------------------
        | Create FormData
        |--------------------------------------------------------------------------
        */

        const formData = new FormData();

        formData.append('_token', "{{ csrf_token() }}");

        // Opportunity
        formData.append('opportunity_type', opportunityType);

        // Job details
        formData.append('job_title', jobTitle);
        // formData.append('category', category);
        formData.append('experience', experience);
        formData.append('location_type', locationType);
        formData.append('job_type', jobType);
        formData.append('job_location', jobLocation);

        // Description
        formData.append('description', description);

        // Skills
        formData.append('skills', skills);

        // Salary
        formData.append('salary_disclosure', salaryDisclosure);
        formData.append('budget', salaryDisclosure === 'disclosed' ? budget : '');

        // Duration
        // formData.append('duration', duration);

        /*
        |--------------------------------------------------------------------------
        | Attachment
        |--------------------------------------------------------------------------
        */

        const attachmentInput = document.getElementById('fileInputDoc');

        if (attachmentInput && attachmentInput.files.length > 0) {
            formData.append('attachment', attachmentInput.files[0]);
        }

        /*
        |--------------------------------------------------------------------------
        | Show submitting state
        |--------------------------------------------------------------------------
        */

        submitBtn.disabled = true;

        if (submitBtnText) {
            submitBtnText.innerText = 'Submitting...';
        }

        // Your existing loader
        showLoder();

        /*
        |--------------------------------------------------------------------------
        | Submit AJAX
        |--------------------------------------------------------------------------
        */

        $.ajax({
            url: "{{ route('employer.jobs.store') }}",
            type: "POST",
            data: formData,

            processData: false,
            contentType: false,

            success: function (response) {

                console.log('Job Store Response:', response);

                if (response.status === true) {

                    /*
                    |--------------------------------------------------------------------------
                    | Success
                    |--------------------------------------------------------------------------
                    */

                    alert(response.message || 'Job Posted Successfully.');

                    /*
                    | Optional redirect
                    | Change this route to your actual jobs listing route
                    */

                    window.location.href = "{{ route('employer.my.jobs') }}";

                } else {

                    alert(
                        response.message ||
                        'Unable to post job. Please try again.'
                    );
                }
            },

            error: function (xhr) {

                console.log('Job Store Error:', xhr.responseText);

                /*
                |--------------------------------------------------------------------------
                | Laravel Validation Error
                |--------------------------------------------------------------------------
                */

                if (xhr.status === 422) {

                    const response = xhr.responseJSON;

                    if (response && response.errors) {

                        let errorMessages = [];

                        $.each(response.errors, function (field, messages) {

                            if (Array.isArray(messages)) {
                                errorMessages = errorMessages.concat(messages);
                            } else {
                                errorMessages.push(messages);
                            }

                        });

                        alert(errorMessages.join('\n'));

                    } else {

                        alert(
                            response?.message ||
                            'Please check the required fields.'
                        );
                    }

                } else {

                    const response = xhr.responseJSON;

                    alert(
                        response?.message ||
                        'Something went wrong while posting the job.'
                    );
                }
            },

            complete: function () {

                /*
                |--------------------------------------------------------------------------
                | Restore button
                |--------------------------------------------------------------------------
                */

                submitBtn.disabled = false;

                if (submitBtnText) {
                    submitBtnText.innerText = 'Post job';
                }

                /*
                |--------------------------------------------------------------------------
                | Hide loader
                |--------------------------------------------------------------------------
                |
                | Use your actual hide loader function if available.
                |
                */

                if (typeof hideLoder === 'function') {
                    hideLoder();
                }

            }
        });

    });

});

$(document).ready(function () {

    $('#aiSuggestBtn').on('click', function (e) {
        e.preventDefault();

        const btn = $(this);
        const jobTitle = $('#job_title').val().trim();
        const description = $('#job_description').val().trim();

        if (!jobTitle) {
            alert('Please enter job title.');
            $('#job_title').focus();
            return;
        }

        $.ajax({
            url: "{{ route('employer.ai.job.description') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                job_title: jobTitle,
                description: description
            },

            beforeSend: function () {
                btn.prop('disabled', true);
                btn.find('span').text('Generating...');
            },

            success: function (response) {
            
                if (response.status === 'success' && response.data) {
            
                    // Set generated job description
                    $('#job_description').val(
                        response.data.project_description || ''
                    );
            
                    // Set skills as comma-separated values
                    if (Array.isArray(response.data.skills)) {
                    
                        selectedSkills = response.data.skills
                            .slice(0, 10)
                            .map(skill => skill.trim())
                            .filter(skill => skill !== '');
                    
                        renderSkills();
                    }
            
                    $('#descriptionError').text('');
            
                } else {
                    alert(response.message || 'Unable to generate description.');
                }
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON?.errors || {};
                    const messages = Object.values(errors).flat();
                    alert(messages.join('\n') || 'Please check the input.');
                } else {
                    alert(
                        xhr.responseJSON?.message ||
                        'Unable to generate description.'
                    );
                }
            },

            complete: function () {
                btn.prop('disabled', false);
                btn.find('span').text('AI Suggest');
            }
        });
    });

});

</script>

<script>
    $(document).ready(function () {
    
        $('input[name="salary_disclosure"]').on('change', function () {
    
            if ($('#salary_not_disclosed').is(':checked')) {
    
                $('#salaryFields').hide();
    
                $('#budget').val('');
    
            } else {
    
                $('#salaryFields').show();
    
                $('#budget').focus();
            }
    
        });
    
    });
</script>

<script>
    function initLocationAutocomplete() {

        const input = document.getElementById('job_location');

        if (!input) {
            return;
        }

        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ['geocode'],
            fields: ['formatted_address', 'name', 'geometry']
        });

        autocomplete.addListener('place_changed', function () {

            const place = autocomplete.getPlace();

            if (!place) {
                return;
            }

            // Prefer formatted address
            if (place.formatted_address) {
                input.value = place.formatted_address;
            } else if (place.name) {
                input.value = place.name;
            }

        });
    }
</script>

<script async
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&loading=async&libraries=places&callback=initLocationAutocomplete&v=weekly">
</script>
@endsection