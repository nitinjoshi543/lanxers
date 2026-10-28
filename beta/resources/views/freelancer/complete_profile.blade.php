@extends('layouts.main')

@section('main-section')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
<link rel="stylesheet" href="{{ asset('frontend/css/employeer-profile-details.css') }}" />

<section class="profile-details">
    <img src="{{ asset('frontend/images/bg-img1.png') }}" class="bg-img1" alt="">
    <img src="{{ asset('frontend/images/bg-img2.png') }}" class="bg-img2" alt="">
    <img src="{{ asset('frontend/images/bg-img3.png') }}" class="bg-img3" alt="">

    <div class="container">
        <div class="profile-header">
            <div class="letget">
                <img src="{{ asset('frontend/images/handimg.svg') }}" alt="">
                lets get Started !
            </div>
            <h1>Start your <span>Freelance Journey</span></h1>
            <p>Launch your independent career: find clients, build skills, earn on your terms.</p>
        </div>

        <!-- <div style="position: relative; z-index: 100;">
            <input type="file" hidden accept=".pdf" id="resumeInput"
                data-user-id="{{ $user->id }}">
            <button type="button" class="btn btn-primary btn-sm" id="resumeBtn">
                <i class="feather-upload"></i> Upload Resume
            </button>
        </div> -->
        <div class="modal fade" id="profileuploaddocumentmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="profileuploaddocumentmodalwrapper">
                            <div class="pills">
                                <img src="{{ asset('frontend/images/image 82.png')}}" alt="image 82" />
                                <span>Complete your Profile !</span>
                            </div>
                            <div class="heading">
                                Let’s
                                <span> Understand you better !</span>
                            </div>
                            <div class="para">
                                Upload your resume to automatically populate your profile with AI-powered data extraction, or complete your profile manually at your own pace. Your information is securely processed and can be reviewed before saving.
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">
                                                <path d="M25.6663 44.3307H30.333V34.5891L34.0663 38.3224L37.333 34.9974L27.9997 25.6641L18.6663 34.9974L21.9913 38.2641L25.6663 34.5891V44.3307ZM13.9997 51.3307C12.7163 51.3307 11.6181 50.8742 10.705 49.9611C9.7919 49.048 9.33456 47.949 9.33301 46.6641V9.33073C9.33301 8.0474 9.79034 6.94917 10.705 6.03606C11.6197 5.12295 12.7179 4.66562 13.9997 4.66406H32.6663L46.6663 18.6641V46.6641C46.6663 47.9474 46.2098 49.0464 45.2967 49.9611C44.3836 50.8757 43.2846 51.3323 41.9997 51.3307H13.9997ZM30.333 20.9974V9.33073H13.9997V46.6641H41.9997V20.9974H30.333Z" fill="#00A148" />
                                            </svg>
                                        </div>
                                        <h4>Upload Documents</h4>
                                        <p>We’ll Fill the details for you.</p>
                                        <ul>
                                            <li>
                                                Upload your resume or Document.
                                            </li>
                                            <li>
                                                Our Ai will extract the information.
                                            </li>
                                            <li>
                                                Save time and effort.
                                            </li>
                                        </ul>
                                        <div class="uploadbutton" id="resumeBtn">
                                            <input type="file"
                                                id="resumeInput"
                                                hidden
                                                accept=".pdf,.doc,.docx"
                                                data-user-id="{{ $user->id }}">
                                            <span>Upload Document</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M4.86603 8.44531C3.03148 8.8816 1.66699 10.531 1.66699 12.4991C1.66699 14.8002 3.53247 16.6657 5.83366 16.6657C6.22841 16.6657 6.61033 16.6109 6.9722 16.5083" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15.0232 8.44531C16.8577 8.8816 18.2222 10.531 18.2222 12.4991C18.2222 14.8002 16.3567 16.6657 14.0555 16.6657C13.6608 16.6657 13.2789 16.6109 12.917 16.5083" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15 8.33594C15 5.57452 12.7614 3.33594 10 3.33594C7.23858 3.33594 5 5.57452 5 8.33594" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.11133 11.6177L10.0007 8.71875L12.9723 11.6673" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M10 15.8362V10.1953" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <h6>PDF , Doc , Docx ( 5 mb )</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 56 56" fill="none">
                                                <path d="M54.2154 25.55H50.1554V47.775H5.84538V11.48H28.0004V7H5.84538C5.27988 7.01774 4.72367 7.14861 4.20959 7.38488C3.69551 7.62116 3.23398 7.95804 2.85226 8.37565C2.47055 8.79326 2.17638 9.28312 1.98712 9.8163C1.79787 10.3495 1.71737 10.9152 1.75038 11.48V47.775C1.73169 48.3312 1.82281 48.8857 2.01854 49.4067C2.21427 49.9276 2.51077 50.4049 2.89109 50.8113C3.2714 51.2176 3.72807 51.5449 4.23499 51.7747C4.74191 52.0044 5.28913 52.1319 5.84538 52.15H50.1554C50.7116 52.1319 51.2588 52.0044 51.7658 51.7747C52.2727 51.5449 52.7294 51.2176 53.1097 50.8113C53.49 50.4049 53.7865 49.9276 53.9822 49.4067C54.1779 48.8857 54.2691 48.3312 54.2504 47.775L54.2154 25.55Z" fill="#00A148" />
                                                <path d="M36.9602 10.0466L21.7702 25.2716L20.2302 26.8116L19.9502 27.0916L14.6302 38.1516C14.2733 38.8616 14.1492 39.6661 14.2757 40.4508C14.4022 41.2354 14.7727 41.9602 15.3347 42.5221C15.8966 43.0841 16.6214 43.4546 17.406 43.5811C18.1906 43.7076 18.9952 43.5835 19.7052 43.2266L30.6952 37.8716L32.5502 36.0166L34.0552 34.5116L49.2452 19.2516L50.8202 17.7116L51.6952 16.8366C53.1229 15.4061 53.9248 13.4676 53.9248 11.4466C53.9248 9.42552 53.1229 7.48704 51.6952 6.05656C50.2715 4.64317 48.3464 3.85048 46.3402 3.85156C44.3242 3.8526 42.3889 4.64429 40.9502 6.05656L38.5002 8.47156L36.9252 10.0116L36.9602 10.0466ZM19.2852 38.5016L23.4152 29.9966L27.7902 34.4066L19.2852 38.5016ZM26.2852 26.7416L39.9352 13.0566L44.4852 17.6416L30.9752 31.5016L26.2852 26.7416ZM46.1652 8.15656C46.5885 8.15316 47.0081 8.23508 47.3989 8.39745C47.7898 8.55981 48.144 8.79928 48.4402 9.10156C49.0451 9.71124 49.3845 10.5353 49.3845 11.3941C49.3845 12.2529 49.0451 13.0769 48.4402 13.6866L47.5652 14.5266L43.0152 9.97656L43.8902 9.10156C44.2061 8.79051 44.5854 8.55131 45.0022 8.4003C45.4189 8.24929 45.8634 8.19002 46.3052 8.22656L46.1652 8.15656Z" fill="#00A148" />
                                            </svg>
                                        </div>
                                        <h4>Fill Manually</h4>
                                        <p>Enter Details Step by Step.</p>
                                        <ul>
                                            <li>
                                                Fill your information Manually.
                                            </li>
                                            <li>
                                                Add your skills and Experience.
                                            </li>
                                            <li>
                                                Complete Each Section.
                                            </li>
                                        </ul>
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <span>Fill Manually</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path d="M2.49968 10L17.083 10" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M11.6667 15.8307L17.5 9.9974L11.6667 4.16406" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="info">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 22.4984C12 22.4984 20.9986 19.4988 20.9986 12" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20.9986 11.9984V2.99977C20.9986 2.99977 17.9991 1.5 12 1.5" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.9996 22.4984C11.9996 22.4984 3.00098 19.4988 3.00098 12" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3.00098 11.9984V2.99977C3.00098 2.99977 6.00051 1.5 11.9996 1.5" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.9984 6C11.9993 10.4993 10.4995 16.4984 10.4995 16.4984C10.4995 16.4984 8.99977 14.7082 7.5 13.4988" stroke="#00A148" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="text">
                                    <h6>Your information is safe with us !</h6>
                                    <p>we use encryption to protect your data and never share it with everyone,</p>
                                </div>
                            </div>
                            <div class="bgicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41" fill="none">
                                    <g opacity="0.5" clip-path="url(#clip0_3800_4728)">
                                        <path d="M15.2449 14.5747L16.4949 12.4097C16.7078 12.0409 16.9461 11.6973 17.2098 11.379M28.2353 22.0747L29.4853 19.9097C30.2471 18.5904 30.5891 17.0703 30.4657 15.5519C30.3424 14.0335 29.7595 12.5886 28.7947 11.4096C27.8299 10.2305 26.529 9.3733 25.0649 8.95189C23.6009 8.53049 22.0433 8.56491 20.5994 9.05059M13.1576 30.6901L9.91 28.8151C6.8486 27.0476 5.31681 26.1632 4.91573 24.6629C4.51293 23.1631 5.3973 21.6313 7.1648 18.5699C8.9323 15.5085 9.81668 13.9767 11.317 13.5756C12.8168 13.1728 14.3486 14.0572 17.41 15.8247L26.0702 20.8247C29.1316 22.5922 30.6634 23.4766 31.0645 24.9769C31.4673 26.4767 30.5829 28.0085 28.8154 31.0699C27.0479 34.1313 26.1636 35.6631 24.6633 36.0642C23.1634 36.467 21.6316 35.5826 18.5702 33.8151L17.4877 33.1901" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_3800_4728">
                                            <rect width="30" height="30" fill="white" transform="translate(15) rotate(30)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="modal-backdrop fade show"></div> -->
        <form action="{{ route('jobseekers.profile.complete.store') }}" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="profile-infom">

                <img src="{{ asset('frontend/images/profile-round-top.png') }}" class="profile-top" alt="">
                <img src="{{ asset('frontend/images/profile-round-bottom.png') }}" class="profile-bottom" alt="">

                <div class="form-section-title">
                    <div class="icon-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M11.0832 12.25V11.0833C11.0832 10.4645 10.8373 9.871 10.3998 9.43342C9.96217 8.99583 9.36868 8.75 8.74984 8.75H5.24984C4.631 8.75 4.03751 8.99583 3.59992 9.43342C3.16234 9.871 2.9165 10.4645 2.9165 11.0833V12.25" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.99984 6.41667C8.2885 6.41667 9.33317 5.372 9.33317 4.08333C9.33317 2.79467 8.2885 1.75 6.99984 1.75C5.71117 1.75 4.6665 2.79467 4.6665 4.08333C4.6665 5.372 5.71117 6.41667 6.99984 6.41667Z" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p>Profile Information</p>
                </div>

                <div class="avatar-row">
                    <div class="avatar">
                        <img id="preview" src="{{ asset('frontend/images/profile-userimg.png') }}" alt="avatar">
                    </div>

                    <div>
                        <label class="change-photo-btn" for="fileInput">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M7 1.75V8.75" stroke="#1E293B" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.91683 4.66667L7.00016 1.75L4.0835 4.66667" stroke="#1E293B" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.25 8.75V11.0833C12.25 11.3928 12.1271 11.6895 11.9083 11.9083C11.6895 12.1271 11.3928 12.25 11.0833 12.25H2.91667C2.60725 12.25 2.3105 12.1271 2.09171 11.9083C1.87292 11.6895 1.75 11.3928 1.75 11.0833V8.75" stroke="#1E293B" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            </svg> Change Photo
                        </label>
                    </div>

                    <small>JPG, PNG or GIF (max. 5MB)</small>
                    @error('profile_photo')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                    <input type="file" name="profile_photo" id="fileInput" accept="image/jpeg,image/png" hidden>
                </div>

                <!-- Crop popup -->
                <div class="photo-crop-overlay" id="cropModal">
                    <div class="photo-crop-modal">
                        <div class="photo-crop-header">
                            <div>
                                <h2 class="photo-crop-title">Edit Profile Photo</h2>
                                <p class="photo-crop-subtitle">Crop your photo for your perfect fit !</p>
                            </div>

                            <button class="photo-crop-close" id="cancelBtn" type="button" aria-label="Close">✕</button>
                        </div>

                        <div class="photo-crop-body">
                            <img id="cropImage">
                        </div>
                        <div class="photo-crop-footer">
                            <button class="photo-crop-save-btn" id="cropBtn" type="button">Save Photo</button>
                        </div>
                    </div>
                </div>
                <!-- Crop Modal -->




                <div class="field-group-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M9.33317 11.668V2.33464C9.33317 2.02522 9.21025 1.72847 8.99146 1.50968C8.77267 1.29089 8.47592 1.16797 8.1665 1.16797H5.83317C5.52375 1.16797 5.22701 1.29089 5.00821 1.50968C4.78942 1.72847 4.6665 2.02522 4.6665 2.33464V11.668" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.6665 3.5H2.33317C1.68884 3.5 1.1665 4.02233 1.1665 4.66667V10.5C1.1665 11.1443 1.68884 11.6667 2.33317 11.6667H11.6665C12.3108 11.6667 12.8332 11.1443 12.8332 10.5V4.66667C12.8332 4.02233 12.3108 3.5 11.6665 3.5Z" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Basic Information</span>
                </div>

                <div class="input-row">
                    <div class="field">
                        <label>Full name *</label>
                        <input id="fName" type="text" value="{{ $user->name }}" readonly class="locked">
                    </div>
                    <div class="field">
                        <label>Professional Designation *</label>
                        <input id="fRole" name="designation" type="text" placeholder="e.g., UI/UX Designer" value="{{ old('designation') }}">
                        @error('designation')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label>Email Address *</label>
                        <input id="fEmail" type="email" value="{{ $user->email }}" readonly class="locked">
                    </div>
                </div>

                <div class="input-row">
                    <div class="field">
                        <label>Phone Number *</label>
                        <input id="fPhone" name="phone" type="text" placeholder="9876543210" value="{{ old('phone') }}">
                        @error('phone')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label>Location</label>
                        <input id="fLocation" type="text" value="{{ $profile->country_name ?? 'Not set' }}" readonly class="locked">
                    </div>
                    <div class="field">
                        <label>Portfolio/Website</label>
                        <input id="fPortfolio" name="portfolio_url" type="url" placeholder="https://yourportfolio.com" value="{{ old('portfolio_url') }}">
                        @error('portfolio_url')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="divider">

                <div class="field-group-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M9.0281 7.51953L9.91185 12.493C9.92175 12.5516 9.91354 12.6118 9.8883 12.6656C9.86307 12.7193 9.82202 12.7641 9.77065 12.7939C9.71928 12.8237 9.66003 12.8371 9.60082 12.8324C9.54162 12.8276 9.48529 12.8049 9.43935 12.7672L7.35102 11.1998C7.25021 11.1245 7.12774 11.0838 7.0019 11.0838C6.87605 11.0838 6.75359 11.1245 6.65277 11.1998L4.56094 12.7666C4.51504 12.8042 4.45877 12.8269 4.39964 12.8317C4.34051 12.8365 4.28133 12.8231 4.22999 12.7934C4.17865 12.7636 4.1376 12.719 4.11231 12.6653C4.08702 12.6116 4.07869 12.5515 4.08844 12.493L4.9716 7.51953" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 8.16797C8.933 8.16797 10.5 6.60097 10.5 4.66797C10.5 2.73497 8.933 1.16797 7 1.16797C5.067 1.16797 3.5 2.73497 3.5 4.66797C3.5 6.60097 5.067 8.16797 7 8.16797Z" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>About & Skills</span>
                </div>

                <div class="input-row2">
                    <div class="field">
                        <label>About me *</label>
                        <textarea id="fAbout" name="about" placeholder="Tell us about yourself, your passion, and what drives you...">{{ old('about') }}</textarea>
                    </div>
                </div>

                <div class="input-row3">
                    <div class="field">
                        <label>Skills and Expertise</label>
                        <div class="skill-add-row">
                            <input id="skillInput" type="text" list="skillOptions" placeholder="Add a skill (e.g., React, UI Design, Python)" autocomplete="off">
                            @error('skills')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                            <datalist id="skillOptions">
                                @foreach($allSkills as $s)
                                <option value="{{ $s->name }}"></option>
                                @endforeach
                            </datalist>
                            <button class="icon-square-btn" type="button" onclick="addSkill()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M2.9165 7H11.0832" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 2.91797V11.0846" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tag-list" id="skillTags"></div>
                <div id="skillInputs"></div>

                <hr class="divider">

                <div class="field-group-title mob-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M2.91699 4.66797L6.41699 8.16797" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2.33301 8.16797L5.83301 4.66797L6.99967 2.91797" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M1.16699 2.91797H8.16699" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.08301 1.16797H4.66634" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.8333 12.8333L9.91667 7L7 12.8333" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.16699 10.5H11.667" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Languages</span>
                </div>

                <div class="field">
                    <div class="lang-add-row">
                        <select id="langSelect">
                            <option value="">Select Language</option>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Bengali">Bengali</option>
                            <option value="Tamil">Tamil</option>
                            <option value="Telugu">Telugu</option>
                            <option value="Marathi">Marathi</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Spanish">Spanish</option>
                            <option value="French">French</option>
                        </select>
                        <select id="langLevel">
                            <option value="Basic">Basic</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Fluent">Fluent</option>
                            <option value="Native">Native</option>
                        </select>
                        <button class="icon-square-btn" type="button" onclick="addLanguage()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M2.9165 7H11.0832" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7 2.91797V11.0846" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    @error('languages')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lang-list" id="langList"></div>
                <div id="langInputs"></div>

                <hr class="divider">

                <div class="exp-header">
                    <div class="field-group-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M10.5002 1.16797H3.50016C2.85583 1.16797 2.3335 1.6903 2.3335 2.33464V11.668C2.3335 12.3123 2.85583 12.8346 3.50016 12.8346H10.5002C11.1445 12.8346 11.6668 12.3123 11.6668 11.668V2.33464C11.6668 1.6903 11.1445 1.16797 10.5002 1.16797Z" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5.25 12.8333V10.5H8.75V12.8333" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.6665 3.5H4.67234" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.3335 3.5H9.33933" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7 3.5H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7 5.83203H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7 8.16797H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.3335 5.83203H9.33933" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.3335 8.16797H9.33933" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.6665 5.83203H4.67234" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.6665 8.16797H4.67234" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Professional Experience</span>
                    </div>
                    <button class="add-exp-btn" type="button" onclick="toggleExpForm()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M2.9165 7H11.0832" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7 2.91797V11.0846" stroke="#5A5A5A" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        </svg> Add Experience
                    </button>
                </div>

                <div id="emptyExpMsg" class="empty-exp">
                    <span class="emoji">
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none">
                            <g opacity="0.5">
                                <path d="M31.5 3.5H10.5C8.567 3.5 7 5.067 7 7V35C7 36.933 8.567 38.5 10.5 38.5H31.5C33.433 38.5 35 36.933 35 35V7C35 5.067 33.433 3.5 31.5 3.5Z" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.75 38.5V31.5H26.25V38.5" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14 10.5H14.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M28 10.5H28.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21 10.5H21.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21 17.5H21.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21 24.5H21.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M28 17.5H28.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M28 24.5H28.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14 17.5H14.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14 24.5H14.0175" stroke="#64748B" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg>
                    </span>
                    <p>No experience added yet. Click "Add Experience" to get started.</p>
                </div>

                <div id="expEntries"></div>
                <div id="expInputs"></div>

                <div id="expForm" class="exp-form" style="display:none;">
                    <h4>Experience #<span id="expNum">1</span></h4>

                    <div class="exp-box">
                        <div class="input-row5">
                            <div class="field">
                                <label>Position/Role *</label>
                                <input id="expRole" type="text" placeholder="eg. Front end Developer">
                            </div>
                            <div class="field">
                                <label>Company Name *</label>
                                <input id="expComName" type="text" placeholder="eg. Company Name">
                            </div>

                            <div class="field">
                                <label>Employment Type</label>
                                <select id="expType">
                                    <option>Full time</option>
                                    <option>Part time</option>
                                    <option>Freelance</option>
                                    <option>Contract</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-row4">
                            <div class="field">
                                <label>Start Date *</label>
                                <div class="date-field">
                                    <input id="expStart" type="date">
                                </div>
                            </div>
                            <div class="field">
                                <label>End Date</label>
                                <div class="date-field">
                                    <input id="expEnd" type="date">

                                    <small>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" checked="">
                                            <label class="form-check-label">Currently working.</label>
                                        </div>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="input-row2">
                            <div class="field" style="margin-bottom:16px;">
                                <label>Project Description</label>
                                <textarea id="expDesc" placeholder="Briefly describe your responsibilities here"></textarea>
                            </div>
                        </div>
                        <button class="add-now-btn" type="button" onclick="addExperience()">Add Now</button>
                    </div>
                </div>
                @error('experiences')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="submit-row">
                <button class="submit-btn" type="submit" id="submitBtn">
                    <span>Submit</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                        <path d="M12.4903 7.14195L3.44025 2.27195C2.68025 1.86195 1.80025 2.57195 2.04025 3.40195L3.28025 7.74195C3.33025 7.92195 3.33025 8.10195 3.28025 8.28195L2.04025 12.6219C1.80025 13.4519 2.68025 14.1619 3.44025 13.7519L12.4903 8.88195C12.6446 8.79759 12.7735 8.67322 12.8632 8.5219C12.953 8.37058 13.0004 8.19789 13.0004 8.02195C13.0004 7.84601 12.953 7.67332 12.8632 7.52199C12.7735 7.37067 12.6446 7.24631 12.4903 7.16195V7.14195Z" fill="white" />
                    </svg>
                </button>
            </div>

        </form>

    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('resumeInput');
        const btn = document.getElementById('resumeBtn');
        if (!input || !btn) return;

        btn.addEventListener('click', () => input.click());

        input.addEventListener('change', function() {
            if (!this.files.length) return;

            const fd = new FormData();
            fd.append('resume', this.files[0]);
            fd.append('user_id', this.dataset.userId);

            btn.disabled = true;
            showLoder();

            fetch("{{ route('jobseekers.profile.upload.resume') }}", {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }, // Content-Type MAT daal
                    body: fd
                })
                .then(res => res.json())
                .then(data => {
                    btn.disabled = false;
                    hideLoder();

                    if (data.status === 'success') {
                        const modalEl = document.getElementById('profileuploaddocumentmodal');
                        const modal = bootstrap.Modal.getInstance(modalEl);

                        if (modal) {
                            modal.hide();
                        }

                        window.autofillFromResume(data.parsed);
                    } else {
                        alert(data.message || 'Parsing failed');
                    }
                })
                .catch(err => {
                    btn.disabled = false;
                    hideLoder();
                    console.log('ERR:', err);
                    alert('Something went wrong');
                });

            this.value = '';
        });

        // ===== yaha API ke actual JSON keys ke hisaab se map karna hai =====
        function autofillForm(d) {
            if (!d) return;
            const set = (id, val) => {
                const el = document.getElementById(id);
                if (el && val != null) el.value = val;
            };
            set('name', d.name);
            set('email', d.email);
            set('phone', d.phone);
            set('skills', Array.isArray(d.skills) ? d.skills.join(', ') : d.skills);
            // ... baaki fields
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const $ = id => document.getElementById(id);

        /* ---------- State ----------
         | old() se — validation fail hone pe user ka kaam na khoye.
         | Ye DB se nahi, session flash se aata hai.
         */
        let skills = @json(old('skills', []));
        let languages = @json(old('languages', []));
        let experiences = @json(old('experiences', []));

        const escapeHtml = str => String(str).replace(/[&<>"']/g, m => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        } [m]));

        /* ---------- Skills ---------- */
        window.addSkill = function() {
            const input = $('skillInput');
            const val = input.value.trim();
            if (!val) return;

            if (skills.some(s => s.toLowerCase() === val.toLowerCase())) {
                alert(val + ' already added.');
                input.value = '';
                return;
            }

            skills.push(val);
            input.value = '';
            renderSkills();
        };

        window.removeSkill = function(i) {
            skills.splice(i, 1);
            renderSkills();
        };

        function renderSkills() {
            $('skillTags').innerHTML = skills.map((s, i) =>
                `<span class="skilltag">${escapeHtml(s)} <button type="button" onclick="removeSkill(${i})">✕</button></span>`
            ).join('');

            // hidden inputs — yahi server tak jaate hain
            $('skillInputs').innerHTML = skills.map(s =>
                `<input type="hidden" name="skills[]" value="${escapeHtml(s)}">`
            ).join('');
        }

        $('skillInput').addEventListener('keydown', e => {
            if (e.key === 'Enter') {
                e.preventDefault();
                addSkill();
            }
        });

        /* ---------- Languages ---------- */
        const levelClass = {
            Native: 'level-native',
            Fluent: 'level-fluent',
            Intermediate: 'level-intermediate',
            Basic: 'level-basic'
        };

        window.addLanguage = function() {
            const name = $('langSelect').value;
            const level = $('langLevel').value;
            if (!name) return;

            if (languages.some(l => l.name === name)) {
                alert(name + ' already added.');
                return;
            }

            languages.push({
                name,
                level
            });
            $('langSelect').value = '';
            renderLanguages();
        };

        window.removeLanguage = function(i) {
            languages.splice(i, 1);
            renderLanguages();
        };

        function renderLanguages() {
            $('langList').innerHTML = languages.map((l, i) => `
            <div class="lang-row">
                <span>${escapeHtml(l.name)}</span>
                <span class="level-chip ${levelClass[l.level]}">${l.level}
                    <button type="button" class="lang-remove-btn" onclick="removeLanguage(${i})">✕</button>
                </span>
            </div>
        `).join('') || '<div class="pv-about-text">No languages added yet.</div>';

            $('langInputs').innerHTML = languages.map((l, i) => `
            <input type="hidden" name="languages[${i}][name]"  value="${escapeHtml(l.name)}">
            <input type="hidden" name="languages[${i}][level]" value="${escapeHtml(l.level)}">
        `).join('');
        }

        /* ---------- Experience ---------- */
        window.toggleExpForm = function() {
            $('expForm').style.display = 'block';
            $('expNum').textContent = experiences.length + 1;
            $('emptyExpMsg').style.display = 'none';
        };

        window.addExperience = function() {
            const position = $('expRole').value.trim();

            if (!position) {
                alert('Position is required');
                return;
            }

            const start = $('expStart').value;
            const end = $('expEnd').value;
            const today = new Date().toISOString().split('T')[0];

            if (!start) {
                alert('Start date is required');
                return;
            }

            if (start > today) {
                alert('Start date cannot be greater than today.');
                return;
            }

            if (end) {
                if (end > today) {
                    alert('End date cannot be greater than today.');
                    return;
                }

                if (end < start) {
                    alert('End date cannot be earlier than start date.');
                    return;
                }
            }

            experiences.push({
                position,
                type: $('expType').value,
                start,
                end: end || '',
                desc: $('expDesc').value.trim()
            });

            ['expRole', 'expStart', 'expEnd', 'expDesc'].forEach(id => $(id).value = '');
            $('expForm').style.display = 'none';
            renderExperience();
        };

        window.removeExperience = function(i) {
            experiences.splice(i, 1);
            renderExperience();
        };

        function renderExperience() {
            $('emptyExpMsg').style.display = experiences.length ? 'none' : 'block';

            $('expEntries').innerHTML = experiences.map((e, i) => `
            <div class="exp-entry">
                <h5>${escapeHtml(e.position)}
                    <button type="button" class="exp-remove-btn" onclick="removeExperience(${i})">✕</button>
                </h5>
                <div class="meta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="#7E7E7E" stroke-width="2"/>
                        <path d="M12 7V12L15.5 14" stroke="#7E7E7E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>${escapeHtml(e.type)}</span> ·
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M6 7.33203H4.66667V8.66536H6V7.33203ZM8.66667 7.33203H7.33333V8.66536H8.66667V7.33203ZM11.3333 7.33203H10V8.66536H11.3333V7.33203ZM12.6667 2.66536H12V1.33203H10.6667V2.66536H5.33333V1.33203H4V2.66536H3.33333C2.59333 2.66536 2.00667 3.26536 2.00667 3.9987L2 13.332C2 13.6857 2.14048 14.0248 2.39052 14.2748C2.64057 14.5249 2.97971 14.6654 3.33333 14.6654H12.6667C13.4 14.6654 14 14.0654 14 13.332V3.9987C14 3.26536 13.4 2.66536 12.6667 2.66536ZM12.6667 13.332H3.33333V5.9987H12.6667V13.332Z" fill="#7E7E7E"/>
                    </svg>
                    <span>${e.start} - ${e.end || 'Present'}</span>
                </div>
                <div class="desc">${escapeHtml(e.desc)}</div>
            </div>
        `).join('');

            $('expInputs').innerHTML = experiences.map((e, i) => `
            <input type="hidden" name="experiences[${i}][position]" value="${escapeHtml(e.position)}">
            <input type="hidden" name="experiences[${i}][type]"     value="${escapeHtml(e.type)}">
            <input type="hidden" name="experiences[${i}][start]"    value="${e.start}">
            <input type="hidden" name="experiences[${i}][end]"      value="${e.end}">
            <input type="hidden" name="experiences[${i}][desc]"     value="${escapeHtml(e.desc)}">
        `).join('');
        }

        /* ---------- Submit guard ---------- */
        $('profileForm').addEventListener('submit', e => {
            if (!skills.length) {
                e.preventDefault();
                alert('Please add at least one skill before continuing.');
                return;
            }
            if ($('fAbout').value.trim().length < 50) {
                e.preventDefault();
                alert('Please enter at least 50 characters in the About Me section.');
                $('fAbout').focus();
                return;
            }
            $('submitBtn').disabled = true; // double-submit guard
        });

        /* ---------- Resume Autofill ---------- */
        window.autofillFromResume = function(resp) {
            const d = (resp && resp.data) ? resp.data : resp;
            if (!d) return;

            const setVal = (id, val) => {
                const el = $(id);
                if (el && val != null && val !== '') el.value = val;
            };

            // Simple text fields
            setVal('fRole', d.designation);
            setVal('fPortfolio', d.portfolio_link);
            setVal('fAbout', d.about_me);

            // Phone — "num1, num2" me se pehla
            if (d.phone_number) {
                setVal('fPhone', String(d.phone_number).split(',')[0].trim());
            }

            // Skills — state replace + render (hidden inputs isse bante hain)
            if (Array.isArray(d.skills)) {
                skills = d.skills.filter(Boolean).map(s => String(s).trim());
                renderSkills();
            }

            // Languages — API level nahi deta, default 'Fluent'
            if (Array.isArray(d.spoken_language)) {
                languages = d.spoken_language.filter(Boolean).map(name => ({
                    name: String(name).trim(),
                    level: 'Fluent'
                }));
                renderLanguages();
            }

            // Experience — duration string parse karke start/end
            if (Array.isArray(d.experience)) {
                experiences = d.experience.map(e => {
                    const {
                        start,
                        end
                    } = parseDuration(e.duration || '');
                    return {
                        position: e.designation || '',
                        company: e.company || '',
                        type: 'Full time',
                        start,
                        end,
                        desc: e.description || ''
                    };
                });
                renderExperience();
            }
        };

        function parseMonthYear(str) {
            if (!str) return '';
            str = str.trim();
            if (/present|current|now|till\s*date/i.test(str)) return '';
            const months = {
                jan: '01',
                feb: '02',
                mar: '03',
                apr: '04',
                may: '05',
                jun: '06',
                jul: '07',
                aug: '08',
                sep: '09',
                oct: '10',
                nov: '11',
                dec: '12'
            };
            const m = str.match(/([A-Za-z]{3,})\s*['`]?\s*(\d{4})/);
            if (m) {
                const mon = months[m[1].slice(0, 3).toLowerCase()];
                if (mon) return `${m[2]}-${mon}-01`;
            }
            const y = str.match(/\d{4}/);
            return y ? `${y[0]}-01-01` : '';
        }

        function parseDuration(dur) {
            if (!dur) return {
                start: '',
                end: ''
            };
            let parts = String(dur).split(/\s+[-–—]\s+/);
            if (parts.length < 2) parts = String(dur).split(/[-–—]/);
            return {
                start: parseMonthYear(parts[0] || ''),
                end: parseMonthYear(parts[1] || '')
            };
        }
        /* ---------- Init ---------- */
        renderSkills();
        renderLanguages();
        renderExperience();
    });
</script>


<!-- ====== Profile Crop and Upload Option ====== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cropper;
        const fileInput = document.getElementById('fileInput');
        const cropModal = document.getElementById('cropModal');
        const cropImage = document.getElementById('cropImage');
        const preview = document.getElementById('preview');

        if (!fileInput || !cropModal) return;

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                cropImage.src = e.target.result;
                cropModal.style.display = 'flex';

                if (cropper) cropper.destroy();
                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    background: false,
                    autoCropArea: 1
                });
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('cropBtn').addEventListener('click', function() {
            if (!cropper) return;

            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });
            preview.src = canvas.toDataURL('image/jpeg');
            preview.style.display = 'block';

            closeModal();
        });

        document.getElementById('cancelBtn').addEventListener('click', closeModal);

        function closeModal() {
            cropModal.style.display = 'none';
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }
    });
</script>
<!-- ====== Profile Crop and Upload Option ====== -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const profileModal = new bootstrap.Modal(document.getElementById('profileuploaddocumentmodal'));
    profileModal.show();
});
</script>



@endsection