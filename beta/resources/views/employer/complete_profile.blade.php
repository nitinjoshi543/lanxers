@extends('employer.layouts.main')

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
            <h1>Start your <span>Employeer Journey</span></h1>
            <p>Launch your independent career: find clients, build skills, earn on your terms.</p>
        </div>

        <form action="{{ route('employer.profile.complete.store') }}" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf

            @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
            @endif

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
                            <path d="M7 1.75V8.75" stroke="#1E293B" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.91683 4.66667L7.00016 1.75L4.0835 4.66667" stroke="#1E293B" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.25 8.75V11.0833C12.25 11.3928 12.1271 11.6895 11.9083 11.9083C11.6895 12.1271 11.3928 12.25 11.0833 12.25H2.91667C2.60725 12.25 2.3105 12.1271 2.09171 11.9083C1.87292 11.6895 1.75 11.3928 1.75 11.0833V8.75" stroke="#1E293B" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
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
                        <label>
                            {{ $profile->employer_type == 0 ? 'Company Name *' : 'Name *' }}
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $profile->employer_type == 0 ? $profile->company_name : $profile->user_name) }}" readonly>
                    </div>

                    <div class="field">
                        <label>Email Address *</label>
                        <input id="fEmail"
                            type="email"
                            name="email"
                            value="{{ $profile->email }}"
                            readonly>
                    </div>

                     <div class="field">
                        <label>Phone Number *</label>
                        <input id="fPhone"
                            type="text"
                            name="phone"
                            placeholder="9874563210" value="{{ old('phone', $profile->phone) }}" required>
                        @error('phone')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>


                </div>

                <div class="input-row-select">
                   
                    <div class="field">
                        <label>Location</label>
                        <input id="fLocation" type="text" value="{{ $profile->country_name ?? 'Not set' }}" readonly>
                    </div>

                    <div class="field">
                        <label>Company Website</label>
                        <input id="fPortfolio" name="website" type="text" placeholder="e.g., www.domain.com" value="{{ old('website', $profile->website) }}">
                        @error('website')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="input-row-select">
                    <div class="field">
                        <label>Industry Type</label>
                        @php
                        $industries = [
                        'Information Technology' => 'Information Technology (IT)',
                        'Software Development' => 'Software Development',
                        'Artificial Intelligence' => 'Artificial Intelligence (AI)',
                        'Digital Marketing' => 'Digital Marketing',
                        'E-Commerce' => 'E-Commerce',
                        'Education' => 'Education',
                        'Healthcare' => 'Healthcare',
                        'Finance & Banking' => 'Finance & Banking',
                        'Insurance' => 'Insurance',
                        'Real Estate' => 'Real Estate',
                        'Construction' => 'Construction',
                        'Manufacturing' => 'Manufacturing',
                        'Retail' => 'Retail',
                        'Telecommunications' => 'Telecommunications',
                        'Logistics & Supply Chain' => 'Logistics & Supply Chain',
                        'Hospitality' => 'Hospitality',
                        'Travel & Tourism' => 'Travel & Tourism',
                        'Media & Entertainment' => 'Media & Entertainment',
                        'Legal Services' => 'Legal Services',
                        'Consulting' => 'Consulting',
                        'Human Resources' => 'Human Resources',
                        'Government' => 'Government',
                        'NGO' => 'NGO / Non-Profit',
                        'Agriculture' => 'Agriculture',
                        'Other' => 'Other',
                        ];
                        @endphp

                        <select name="industry" required>
                            <option value="">Select Industry</option>
                            @foreach($industries as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('industry', $profile->industry) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('industry')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label>Company Size</label>
                        @php
                        $companySizes = [
                        '1-10' => '1-10 Employees',
                        '11-50' => '11-50 Employees',
                        '51-200' => '51-200 Employees',
                        '201-500' => '201-500 Employees',
                        '501-1000' => '501-1000 Employees',
                        '1001-5000' => '1001-5000 Employees',
                        '5000+' => '5000+ Employees',
                        ];
                        @endphp

                        <select name="company_size" required>
                            <option value="">Select Company Size</option>

                            @foreach($companySizes as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('company_size', $profile->company_size) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('company_size')
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
                    <span>About Company</span>
                </div>

                <div class="input-row2">
                    <div class="field">
                        <label>About me *</label>
                        <textarea name="about" id="fAbout" placeholder="Tell us about your Company..." required>{{ old('about', $profile->about) }}</textarea>
                        @error('about')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="divider">

                <div class="field-group-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M10.5 1.16602H3.50001C2.85568 1.16602 2.33334 1.68835 2.33334 2.33268V11.666C2.33334 12.3103 2.85568 12.8327 3.50001 12.8327H10.5C11.1443 12.8327 11.6667 12.3103 11.6667 11.666V2.33268C11.6667 1.68835 11.1443 1.16602 10.5 1.16602Z" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5.25 12.8333V10.5H8.75V12.8333" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.66666 3.5H4.67249" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.33334 3.5H9.33918" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 3.5H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 5.83398H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 8.16602H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.33334 5.83398H9.33918" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.33334 8.16602H9.33918" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.66666 5.83398H4.67249" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.66666 8.16602H4.67249" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Business Details </span>
                </div>

                <div class="input-row-select">
                    @if($profile->employer_type == 0)
                    <div class="field">
                        <label>GST Number *</label>
                        <input id="fLocation" type="text" name="gst_number" value="{{ old('gst_number', $profile->gst_number) }}" placeholder="Enter GST Number">
                        @error('gst_number')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                    <div class="field">
                        <label>Pan card *</label>
                        <input id="fLocation" name="pan_card" type="text" value="{{ old('pan_card', $profile->pan_card) }}" placeholder="Enter PAN Card">
                        @error('pan_card')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="divider">

                <div class="field-group-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M10.5 1.16602H3.50001C2.85568 1.16602 2.33334 1.68835 2.33334 2.33268V11.666C2.33334 12.3103 2.85568 12.8327 3.50001 12.8327H10.5C11.1443 12.8327 11.6667 12.3103 11.6667 11.666V2.33268C11.6667 1.68835 11.1443 1.16602 10.5 1.16602Z" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5.25 12.8333V10.5H8.75V12.8333" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.66666 3.5H4.67249" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.33334 3.5H9.33918" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 3.5H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 5.83398H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 8.16602H7.00583" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.33334 5.83398H9.33918" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.33334 8.16602H9.33918" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.66666 5.83398H4.67249" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.66666 8.16602H4.67249" stroke="#00A148" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Company Documents</span>
                </div>

                <div class="upload-wrap">
                    <div class="dropzone" id="dropzone">
                        <div class="drop-icon">
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
                        </div>

                        <div class="drop-text">Drag and Drop Company Documents here to upload.</div>

                        <button type="button" class="upload-btn" id="uploadBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M5 16.6667C4.54167 16.6667 4.14944 16.5036 3.82333 16.1775C3.49722 15.8514 3.33389 15.4589 3.33333 15V13.3333C3.33333 13.0972 3.41333 12.8995 3.57333 12.74C3.73333 12.5806 3.93111 12.5006 4.16667 12.5C4.40222 12.4995 4.60028 12.5795 4.76083 12.74C4.92139 12.9006 5.00111 13.0983 5 13.3333V15H15V13.3333C15 13.0972 15.08 12.8995 15.24 12.74C15.4 12.5806 15.5978 12.5006 15.8333 12.5C16.0689 12.4995 16.2669 12.5795 16.4275 12.74C16.5881 12.9006 16.6678 13.0983 16.6667 13.3333V15C16.6667 15.4583 16.5036 15.8508 16.1775 16.1775C15.8514 16.5042 15.4589 16.6672 15 16.6667H5ZM9.16667 6.54168L7.60417 8.10418C7.4375 8.27085 7.23972 8.35085 7.01083 8.34418C6.78194 8.33751 6.58389 8.25057 6.41667 8.08335C6.26389 7.91668 6.18389 7.72224 6.17667 7.50001C6.16944 7.27779 6.24944 7.08335 6.41667 6.91668L9.41667 3.91668C9.5 3.83335 9.59028 3.77446 9.6875 3.74001C9.78472 3.70557 9.88889 3.68807 10 3.68751C10.1111 3.68696 10.2153 3.70446 10.3125 3.74001C10.4097 3.77557 10.5 3.83446 10.5833 3.91668L13.5833 6.91668C13.75 7.08335 13.83 7.27779 13.8233 7.50001C13.8167 7.72224 13.7367 7.91668 13.5833 8.08335C13.4167 8.25001 13.2189 8.33696 12.99 8.34418C12.7611 8.3514 12.5631 8.2714 12.3958 8.10418L10.8333 6.54168V12.5C10.8333 12.7361 10.7533 12.9342 10.5933 13.0942C10.4333 13.2542 10.2356 13.3339 10 13.3333C9.76444 13.3328 9.56667 13.2528 9.40667 13.0933C9.24667 12.9339 9.16667 12.7361 9.16667 12.5V6.54168Z" fill="#5A5A5A" />
                            </svg>
                            Upload Document
                        </button>
                        <input type="file" id="fileInputDoc" name="company_documents[]" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                        <div class="hint">Supported formats: PDF, JPG, PNG, DOC — Max 10MB per file</div>
                        <div class="file-list" id="fileList"></div>
                    </div>



                </div>
                @error('company_documents')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                @error('company_documents.*')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="submit-row">
                    <button class="submit-btn" type="submit" id="submitBtn"> <span>Submit</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path d="M12.4903 7.14195L3.44025 2.27195C2.68025 1.86195 1.80025 2.57195 2.04025 3.40195L3.28025 7.74195C3.33025 7.92195 3.33025 8.10195 3.28025 8.28195L2.04025 12.6219C1.80025 13.4519 2.68025 14.1619 3.44025 13.7519L12.4903 8.88195C12.6446 8.79759 12.7735 8.67322 12.8632 8.5219C12.953 8.37058 13.0004 8.19789 13.0004 8.02195C13.0004 7.84601 12.953 7.67332 12.8632 7.52199C12.7735 7.37067 12.6446 7.24631 12.4903 7.16195V7.14195Z" fill="white" />
                        </svg>
                    </button>
                </div>
            </div>

        </form>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>


<!-- ====== Profile Crop and Upload Option ====== -->
<script>
  let cropper;
  const fileInput = document.getElementById('fileInput');
  const cropModal = document.getElementById('cropModal');
  const cropImage = document.getElementById('cropImage');
  const preview = document.getElementById('preview');

  fileInput.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
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

  document.getElementById('cropBtn').addEventListener('click', function () {
    if (!cropper) return;

    const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
    preview.src = canvas.toDataURL('image/jpeg');
    preview.style.display = 'block';

    closeModal();
  });

  document.getElementById('cancelBtn').addEventListener('click', closeModal);

  function closeModal() {
    cropModal.style.display = 'none';
    // fileInput.value = '';
    if (cropper) {
      cropper.destroy();
      cropper = null;
    }
  }
</script>
<!-- ====== Profile Crop and Upload Option ====== -->

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
    // fileInputDoc.value = ''; // allow re-selecting same file
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
<!-- ====== Company Documents Upload JS ====== -->

<script>
    document.getElementById('profileForm').addEventListener('submit', function() {

        const btn = document.getElementById('submitBtn');

        btn.disabled = true;

        btn.innerHTML = `
        <span>
            <i class="fa fa-spinner fa-spin"></i>
            Submitting...
        </span>
    `;
    });
</script>
@endsection