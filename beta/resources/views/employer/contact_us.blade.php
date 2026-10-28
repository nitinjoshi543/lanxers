@extends('employer.layouts.main')

@section('main-section')

<link rel="stylesheet" href="{{ asset('frontend/css/contact.css') }}" />

<section class="contactus">
    <div class="container-fluid">
        <div class="heading">
            <h1>Contact us</h1>
            <p>We are here to help and answer any question you might have. We look forward to hearing from you!</p>
        </div>
        <div class="features">
            <div class="single">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" viewBox="0 0 14 20" fill="none">
                        <path d="M5.6678 16.0776L10.8428 9.87763H6.8428L7.5678 4.20263L2.9428 10.8776H6.4178L5.6678 16.0776ZM4.1178 12.8776H1.0178C0.617803 12.8776 0.321803 12.6986 0.129803 12.3406C-0.0621971 11.9826 -0.0411973 11.6366 0.192803 11.3026L7.6678 0.552626C7.83447 0.319292 8.05114 0.156959 8.3178 0.0656258C8.58447 -0.0257075 8.85947 -0.0217074 9.1428 0.0776259C9.42614 0.176959 9.63447 0.351959 9.7678 0.602626C9.90114 0.853292 9.95114 1.11996 9.9178 1.40263L9.1178 7.87763H12.9928C13.4261 7.87763 13.7305 8.06929 13.9058 8.45263C14.0811 8.83596 14.0268 9.19429 13.7428 9.52763L5.5178 19.3776C5.33447 19.5943 5.10947 19.736 4.8428 19.8026C4.57614 19.8693 4.3178 19.8443 4.0678 19.7276C3.8178 19.611 3.62214 19.432 3.4808 19.1906C3.33947 18.9493 3.28514 18.6866 3.3178 18.4026L4.1178 12.8776Z" fill="#00A148" />
                    </svg>
                </div>
                <div class="text">
                    <h2>Quick Response</h2>
                    <p>We reply within 24 hours</p>
                </div>
            </div>
            <div class="single">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" viewBox="0 0 14 20" fill="none">
                        <path d="M5.6678 16.0776L10.8428 9.87763H6.8428L7.5678 4.20263L2.9428 10.8776H6.4178L5.6678 16.0776ZM4.1178 12.8776H1.0178C0.617803 12.8776 0.321803 12.6986 0.129803 12.3406C-0.0621971 11.9826 -0.0411973 11.6366 0.192803 11.3026L7.6678 0.552626C7.83447 0.319292 8.05114 0.156959 8.3178 0.0656258C8.58447 -0.0257075 8.85947 -0.0217074 9.1428 0.0776259C9.42614 0.176959 9.63447 0.351959 9.7678 0.602626C9.90114 0.853292 9.95114 1.11996 9.9178 1.40263L9.1178 7.87763H12.9928C13.4261 7.87763 13.7305 8.06929 13.9058 8.45263C14.0811 8.83596 14.0268 9.19429 13.7428 9.52763L5.5178 19.3776C5.33447 19.5943 5.10947 19.736 4.8428 19.8026C4.57614 19.8693 4.3178 19.8443 4.0678 19.7276C3.8178 19.611 3.62214 19.432 3.4808 19.1906C3.33947 18.9493 3.28514 18.6866 3.3178 18.4026L4.1178 12.8776Z" fill="#00A148" />
                    </svg>
                </div>
                <div class="text">
                    <h2>Quick Response</h2>
                    <p>We reply within 24 hours</p>
                </div>
            </div>
            <div class="single">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" viewBox="0 0 14 20" fill="none">
                        <path d="M5.6678 16.0776L10.8428 9.87763H6.8428L7.5678 4.20263L2.9428 10.8776H6.4178L5.6678 16.0776ZM4.1178 12.8776H1.0178C0.617803 12.8776 0.321803 12.6986 0.129803 12.3406C-0.0621971 11.9826 -0.0411973 11.6366 0.192803 11.3026L7.6678 0.552626C7.83447 0.319292 8.05114 0.156959 8.3178 0.0656258C8.58447 -0.0257075 8.85947 -0.0217074 9.1428 0.0776259C9.42614 0.176959 9.63447 0.351959 9.7678 0.602626C9.90114 0.853292 9.95114 1.11996 9.9178 1.40263L9.1178 7.87763H12.9928C13.4261 7.87763 13.7305 8.06929 13.9058 8.45263C14.0811 8.83596 14.0268 9.19429 13.7428 9.52763L5.5178 19.3776C5.33447 19.5943 5.10947 19.736 4.8428 19.8026C4.57614 19.8693 4.3178 19.8443 4.0678 19.7276C3.8178 19.611 3.62214 19.432 3.4808 19.1906C3.33947 18.9493 3.28514 18.6866 3.3178 18.4026L4.1178 12.8776Z" fill="#00A148" />
                    </svg>
                </div>
                <div class="text">
                    <h2>Quick Response</h2>
                    <p>We reply within 24 hours</p>
                </div>
            </div>
        </div>
        <div class="contactwrapper">

            <form id="contactForm" action="{{ route('employer.contact.store') }}" method="POST">
                @csrf
                <div class="formheading">
                    <h2>Send us a message</h2>
                    <p>Fill this form and our team will reply you shortly on time.</p>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="input">
                            <label for="">Name <span>*</span></label>
                            <div class="inputwrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M9.625 7.70833C10.0655 7.70833 10.5016 7.62158 10.9086 7.45301C11.3155 7.28445 11.6853 7.03738 11.9968 6.72592C12.3082 6.41446 12.5553 6.0447 12.7238 5.63775C12.8924 5.2308 12.9792 4.79464 12.9792 4.35417C12.9792 3.91369 12.8924 3.47753 12.7238 3.07058C12.5553 2.66364 12.3082 2.29388 11.9968 1.98241C11.6853 1.67095 11.3155 1.42388 10.9086 1.25532C10.5016 1.08676 10.0655 1 9.625 1C8.73542 1 7.88227 1.35338 7.25325 1.98241C6.62422 2.61144 6.27083 3.46459 6.27083 4.35417C6.27083 5.24375 6.62422 6.09689 7.25325 6.72592C7.88227 7.35495 8.73542 7.70833 9.625 7.70833ZM1 17.675V18.25H18.25V17.675C18.25 15.5283 18.25 14.455 17.8322 13.6347C17.4647 12.9134 16.8783 12.327 16.157 11.9595C15.3367 11.5417 14.2633 11.5417 12.1167 11.5417H7.13333C4.98667 11.5417 3.91333 11.5417 3.093 11.9595C2.37174 12.327 1.78534 12.9134 1.41783 13.6347C1 14.455 1 15.5283 1 17.675Z" fill="#AFAFAF" stroke="#AFAFAF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your Full name here" />
                            </div>
                        </div>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="input">
                            <label for="">Email <span>*</span></label>
                            <div class="inputwrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">
                                    <path d="M19.1667 1.91667C19.1667 0.8625 18.3042 0 17.25 0H1.91667C0.8625 0 0 0.8625 0 1.91667V13.4167C0 14.4708 0.8625 15.3333 1.91667 15.3333H17.25C18.3042 15.3333 19.1667 14.4708 19.1667 13.4167V1.91667ZM17.25 1.91667L9.58333 6.70833L1.91667 1.91667H17.25ZM17.25 13.4167H1.91667V3.83333L9.58333 8.625L17.25 3.83333V13.4167Z" fill="#AFAFAF" />
                                </svg>
                                <input type="text" name="email" value="{{ old('email') }}" placeholder="Enter your Email here" />
                            </div>
                        </div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="input">
                            <label for="">Contact Number <span>*</span></label>
                            <div class="inputwrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M3.46917 7.46542C4.84917 10.1775 7.0725 12.4008 9.78458 13.7808L11.8929 11.6725C12.1612 11.4042 12.535 11.3275 12.8704 11.4329C13.9438 11.7875 15.0938 11.9792 16.2917 11.9792C16.5458 11.9792 16.7896 12.0801 16.9693 12.2599C17.149 12.4396 17.25 12.6833 17.25 12.9375V16.2917C17.25 16.5458 17.149 16.7896 16.9693 16.9693C16.7896 17.149 16.5458 17.25 16.2917 17.25C11.9708 17.25 7.827 15.5336 4.77172 12.4783C1.71644 9.423 0 5.27915 0 0.958333C0 0.704167 0.100967 0.460412 0.280689 0.280689C0.460412 0.100967 0.704167 0 0.958333 0H4.3125C4.56667 0 4.81042 0.100967 4.99014 0.280689C5.16987 0.460412 5.27083 0.704167 5.27083 0.958333C5.27083 2.15625 5.4625 3.30625 5.81708 4.37958C5.9225 4.715 5.84583 5.08875 5.5775 5.35708L3.46917 7.46542Z" fill="#AFAFAF" />
                                </svg>
                                <input type="text" name="phone" maxlength="15" value="{{ old('phone') }}" placeholder="Enter your Contact Number" />
                            </div>
                        </div>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="input">
                            <label for="">Describe issue <span>*</span></label>
                            <div class="inputwrapper textareawrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                    <g clip-path="url(#clip0_1950_4663)">
                                        <path d="M18.2083 17.8161C17.9542 17.8161 17.7104 17.917 17.5307 18.0968C17.351 18.2765 17.25 18.5202 17.25 18.7744V20.8444C17.25 20.9079 17.2248 20.9689 17.1798 21.0138C17.1349 21.0587 17.074 21.084 17.0104 21.084H2.15625C2.09589 21.0842 2.03769 21.0616 1.99327 21.0207C1.94885 20.9799 1.92149 20.9237 1.91667 20.8636V4.5719C1.91667 4.50836 1.94191 4.44742 1.98684 4.40249C2.03177 4.35756 2.09271 4.33232 2.15625 4.33232H3.35417C3.60833 4.33232 3.85209 4.23135 4.03181 4.05163C4.21153 3.87191 4.3125 3.62815 4.3125 3.37398C4.3125 3.11982 4.21153 2.87606 4.03181 2.69634C3.85209 2.51662 3.60833 2.41565 3.35417 2.41565H1.91667C1.40833 2.41565 0.920823 2.61758 0.561379 2.97703C0.201934 3.33647 0 3.82399 0 4.33232L0 21.084C0 21.5923 0.201934 22.0798 0.561379 22.4393C0.920823 22.7987 1.40833 23.0007 1.91667 23.0007H17.25C17.7583 23.0007 18.2458 22.7987 18.6053 22.4393C18.9647 22.0798 19.1667 21.5923 19.1667 21.084V18.7744C19.1667 18.5202 19.0657 18.2765 18.886 18.0968C18.7063 17.917 18.4625 17.8161 18.2083 17.8161ZM15.8125 4.31315H17.0104C17.074 4.31315 17.1349 4.33839 17.1798 4.38332C17.2248 4.42825 17.25 4.48919 17.25 4.55273V5.27148C17.25 5.52565 17.351 5.76941 17.5307 5.94913C17.7104 6.12885 17.9542 6.22982 18.2083 6.22982C18.4625 6.22982 18.7063 6.12885 18.886 5.94913C19.0657 5.76941 19.1667 5.52565 19.1667 5.27148V4.31315C19.1667 3.80482 18.9647 3.31731 18.6053 2.95786C18.2458 2.59842 17.7583 2.39648 17.25 2.39648H15.8125C15.5583 2.39648 15.3146 2.49745 15.1349 2.67717C14.9551 2.8569 14.8542 3.10065 14.8542 3.35482C14.8542 3.60898 14.9551 3.85274 15.1349 4.03246C15.3146 4.21218 15.5583 4.31315 15.8125 4.31315Z" fill="#AFAFAF" />
                                        <path d="M6.70703 5.27083H12.457C12.8383 5.27083 13.2039 5.11938 13.4735 4.8498C13.7431 4.58022 13.8945 4.21458 13.8945 3.83333V3.35417C13.8945 2.97292 13.7431 2.60728 13.4735 2.3377C13.2039 2.06812 12.8383 1.91667 12.457 1.91667H11.4987C11.4987 1.40833 11.2968 0.920823 10.9373 0.561379C10.5779 0.201934 10.0904 0 9.58203 0C9.0737 0 8.58619 0.201934 8.22674 0.561379C7.8673 0.920823 7.66536 1.40833 7.66536 1.91667H6.70703C6.32578 1.91667 5.96015 2.06812 5.69056 2.3377C5.42098 2.60728 5.26953 2.97292 5.26953 3.35417V3.83333C5.26953 4.21458 5.42098 4.58022 5.69056 4.8498C5.96015 5.11938 6.32578 5.27083 6.70703 5.27083ZM3.83203 9.58333C3.83203 9.8375 3.933 10.0813 4.11272 10.261C4.29244 10.4407 4.5362 10.5417 4.79036 10.5417H12.457C12.7112 10.5417 12.955 10.4407 13.1347 10.261C13.3144 10.0813 13.4154 9.8375 13.4154 9.58333C13.4154 9.32917 13.3144 9.08541 13.1347 8.90569C12.955 8.72597 12.7112 8.625 12.457 8.625H4.79036C4.5362 8.625 4.29244 8.72597 4.11272 8.90569C3.933 9.08541 3.83203 9.32917 3.83203 9.58333ZM4.79036 13.4167C4.5362 13.4167 4.29244 13.5176 4.11272 13.6974C3.933 13.8771 3.83203 14.1208 3.83203 14.375C3.83203 14.6292 3.933 14.8729 4.11272 15.0526C4.29244 15.2324 4.5362 15.3333 4.79036 15.3333H9.10286C9.35703 15.3333 9.60079 15.2324 9.78051 15.0526C9.96023 14.8729 10.0612 14.6292 10.0612 14.375C10.0612 14.1208 9.96023 13.8771 9.78051 13.6974C9.60079 13.5176 9.35703 13.4167 9.10286 13.4167H4.79036ZM22.4333 7.89667C22.0742 7.53969 21.5884 7.33931 21.082 7.33931C20.5757 7.33931 20.0899 7.53969 19.7308 7.89667L12.1887 15.4388C12.1416 15.4843 12.1056 15.5401 12.0833 15.6017L10.7224 18.9846C10.6886 19.0719 10.6806 19.1671 10.6992 19.2588C10.7179 19.3505 10.7626 19.435 10.8279 19.5021C10.8936 19.5695 10.9781 19.6156 11.0704 19.6344C11.1627 19.6532 11.2585 19.6438 11.3454 19.6075L14.7379 18.2562C14.7977 18.2306 14.8528 18.1949 14.9008 18.1508L22.4333 10.6087C22.6115 10.4307 22.7529 10.2194 22.8493 9.98668C22.9458 9.754 22.9954 9.50459 22.9954 9.25271C22.9954 9.00083 22.9458 8.75142 22.8493 8.51874C22.7529 8.28606 22.6115 8.07467 22.4333 7.89667Z" fill="#AFAFAF" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1950_4663">
                                            <rect width="23" height="23" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <textarea name="message" type="text" placeholder="Describe the issue you are having.....">{{ old('message') }}</textarea>
                            </div>
                        </div>
                        @error('message')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="notice">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                            </svg>
                            <p>We usually Reply within 24 hrs</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit">
                            <span>Send Message</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.725825 5.81227L9.34707 5.81227L6.70729 8.9803C6.45007 9.28838 6.49222 9.74687 6.8003 10.0034C7.10911 10.2606 7.56687 10.2184 7.82337 9.91036L11.4564 5.55069C11.4848 5.51654 11.4993 5.47658 11.5204 5.43879C11.5378 5.40828 11.5589 5.38212 11.572 5.34869C11.6047 5.26513 11.6243 5.17721 11.6243 5.08857C11.6243 5.08784 11.625 5.08639 11.625 5.08566C11.625 5.08493 11.6243 5.08348 11.6243 5.08275C11.6243 4.99411 11.6047 4.90619 11.572 4.82263C11.5589 4.7892 11.5378 4.76304 11.5204 4.73253C11.4993 4.69474 11.4848 4.65478 11.4564 4.62063L7.82337 0.260958C7.6795 0.0887514 7.47314 -0.00062224 7.26533 -0.000622222C7.10111 -0.000622208 6.93617 0.0546005 6.8003 0.167952C6.49221 0.424446 6.45007 0.882938 6.70729 1.19102L9.34707 4.35905L0.725824 4.35905C0.324735 4.35905 -0.000787261 4.68457 -0.000787226 5.08566C-0.000787191 5.48675 0.324735 5.81227 0.725825 5.81227" fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

            <div class="getintouch">
                <div class="title">
                    <h3>Get in touch</h3>
                    <p>choose the best way to reach us!</p>
                </div>
                <div class="single">
                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                            <path d="M19.4087 2.02174C19.4087 0.909783 18.5353 0 17.4678 0H1.94087C0.873391 0 0 0.909783 0 2.02174V14.1522C0 15.2641 0.873391 16.1739 1.94087 16.1739H17.4678C18.5353 16.1739 19.4087 15.2641 19.4087 14.1522V2.02174ZM17.4678 2.02174L9.70435 7.07609L1.94087 2.02174H17.4678ZM17.4678 14.1522H1.94087V4.04348L9.70435 9.09783L17.4678 4.04348V14.1522Z" fill="#00A148" />
                        </svg></div>
                    <div class="text">
                        <h4>Email</h4>
                        <a href="mailto:hello@lanxers.com">Hello@lanxers.com</a>
                        <p>We will get back to you !</p>
                    </div>
                </div>
                <div class="single">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M3.62 7.79C5.06 10.62 7.38 12.94 10.21 14.38L12.41 12.18C12.69 11.9 13.08 11.82 13.43 11.93C14.55 12.3 15.75 12.5 17 12.5C17.2652 12.5 17.5196 12.6054 17.7071 12.7929C17.8946 12.9804 18 13.2348 18 13.5V17C18 17.2652 17.8946 17.5196 17.7071 17.7071C17.5196 17.8946 17.2652 18 17 18C12.4913 18 8.1673 16.2089 4.97918 13.0208C1.79107 9.8327 0 5.50868 0 1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0H4.5C4.76522 0 5.01957 0.105357 5.20711 0.292893C5.39464 0.48043 5.5 0.734784 5.5 1C5.5 2.25 5.7 3.45 6.07 4.57C6.18 4.92 6.1 5.31 5.82 5.59L3.62 7.79Z" fill="#00A148" />
                        </svg>
                    </div>
                    <div class="text">
                        <h4>Phone</h4>
                        <a href="tel:+919267985887">+91-9267985887</a>
                        <p>Mon - Sat 9:00am to 5:00pm</p>
                    </div>
                </div>
                <div class="single">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20" fill="none">
                            <path d="M8.00009 0C3.59009 0 9.41395e-05 3.59 9.41395e-05 8C-0.0299059 14.44 7.12009 19.6 7.42009 19.82C7.59009 19.94 7.80009 20.01 8.00009 20.01C8.20009 20.01 8.41009 19.95 8.58009 19.82C8.88009 19.6 16.0301 14.45 16.0001 8C16.0001 3.59 12.4101 0 8.00009 0ZM8.00009 12C5.79009 12 4.00009 10.21 4.00009 8C4.00009 5.79 5.79009 4 8.00009 4C10.2101 4 12.0001 5.79 12.0001 8C12.0001 10.21 10.2101 12 8.00009 12Z" fill="#00A148" />
                        </svg>
                    </div>
                    <div class="text">
                        <h4>Office</h4>
                        <a href="#">Lanxers technology pvt. ltd</a>
                        <p>B-23 sector 62 Noida B-23 sector 62 Noida New Delhi 110059</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const form = document.getElementById("contactForm");

        const name = form.querySelector('[name="name"]');
        const email = form.querySelector('[name="email"]');
        const phone = form.querySelector('[name="phone"]');
        const message = form.querySelector('[name="message"]');

        function removeError(input) {
            const error = input.closest('.col-md-6, .col-md-12').querySelector('.js-error');
            if (error) error.remove();
        }

        function showError(input, text) {

            removeError(input);

            let div = document.createElement("div");
            div.className = "text-danger js-error";
            div.innerText = text;

            input.closest('.col-md-6, .col-md-12').appendChild(div);
        }

        function validateName() {

            removeError(name);

            let value = name.value.trim();

            if (value === "") {
                showError(name, "Please enter your name.");
                return false;
            }

            if (!/^[A-Za-z ]+$/.test(value)) {
                showError(name, "Only letters and spaces are allowed.");
                return false;
            }

            if (value.length < 3) {
                showError(name, "Name must be at least 3 characters.");
                return false;
            }

            return true;
        }

        function validateEmail() {

            removeError(email);

            let value = email.value.trim();

            if (value === "") {
                showError(email, "Please enter your email.");
                return false;
            }

            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!regex.test(value)) {
                showError(email, "Please enter a valid email.");
                return false;
            }

            return true;
        }

        function validatePhone() {

            removeError(phone);

            let value = phone.value.trim();

            if (value === "") {
                showError(phone, "Please enter your contact number.");
                return false;
            }

            if (!/^[0-9]+$/.test(value)) {
                showError(phone, "Only digits are allowed.");
                return false;
            }

            if (value.length < 10 || value.length > 15) {
                showError(phone, "Phone number must be between 10 and 15 digits.");
                return false;
            }

            return true;
        }

        function validateMessage() {

            removeError(message);

            let value = message.value.trim();

            if (value === "") {
                showError(message, "Please describe your issue.");
                return false;
            }

            if (value.length < 20) {
                showError(message, "Message should be at least 20 characters.");
                return false;
            }

            return true;
        }

        name.addEventListener("input", validateName);
        email.addEventListener("input", validateEmail);
        phone.addEventListener("input", validatePhone);
        message.addEventListener("input", validateMessage);

        phone.addEventListener("input", function() {
            this.value = this.value.replace(/\D/g, '');
        });

        form.addEventListener("submit", function(e) {

            let valid = true;

            if (!validateName()) valid = false;
            if (!validateEmail()) valid = false;
            if (!validatePhone()) valid = false;
            if (!validateMessage()) valid = false;

            if (!valid) {
                e.preventDefault();
                return;
            }

            if (typeof showLoder === "function") {
                showLoder();
            }

            form.querySelector('button[type="submit"]').disabled = true;
        });

    });
</script>

@endsection