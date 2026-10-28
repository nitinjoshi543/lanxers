<div class="chatside">
    <div class="chatwrapper">

        <div class="heading">
            <div id="openchatscreen">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
                    <path d="M1 5L14 5M5 9L1 5L5 1" stroke="#6A6A6A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <div class="oppositeuser">
                <div class="image">
                    @php
                        $photo = auth()->id() == $conversation->employer_id
                            ? $conversation->freelancer_profile_photo
                            : $conversation->employer_profile_photo;
                    @endphp

                    <img src="{{ $photo ?: "https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg" }}"
                        alt="Profile"
                        onerror="this.onerror=null;this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg';">
                </div>
                <div class="text">
                    @if(auth()->id() == $conversation->employer_id)
                    <h3>{{ $conversation->freelancer_name }}</h3>
                    @else
                    <h3>{{ $conversation->employer_name }}</h3>
                    @endif
                    <p>{{ $conversation->title ?? '' }}</p>
                </div>
            </div>
                            <button type="button" id="openProjectDetails">Project Detail</button>

        </div>
        <div class="messagebox" id="message-list">
            <div class="acceptproject">
                <div class="filename">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M2.75 10.0001C2.75 9.80114 2.67098 9.61038 2.53033 9.46973C2.38968 9.32907 2.19891 9.25006 2 9.25006C1.80109 9.25006 1.61032 9.32907 1.46967 9.46973C1.32902 9.61038 1.25 9.80114 1.25 10.0001H2.75ZM21.25 14.0001C21.25 14.199 21.329 14.3897 21.4697 14.5304C21.6103 14.671 21.8011 14.7501 22 14.7501C22.1989 14.7501 22.3897 14.671 22.5303 14.5304C22.671 14.3897 22.75 14.199 22.75 14.0001H21.25ZM1.355 5.92706C1.33564 6.12504 1.39572 6.32261 1.52203 6.47629C1.64833 6.62998 1.83052 6.72719 2.0285 6.74656C2.22649 6.76592 2.42405 6.70584 2.57774 6.57953C2.73142 6.45322 2.82864 6.27104 2.848 6.07306L1.355 5.92706ZM22.645 18.0731C22.6546 17.975 22.6448 17.8761 22.6161 17.7818C22.5875 17.6876 22.5405 17.5999 22.478 17.5238C22.4154 17.4477 22.3385 17.3847 22.2516 17.3383C22.1647 17.2919 22.0695 17.2631 21.9715 17.2536C21.8735 17.244 21.7745 17.2538 21.6803 17.2824C21.586 17.3111 21.4984 17.358 21.4223 17.4206C21.2686 17.5469 21.1714 17.7291 21.152 17.9271L22.645 18.0731ZM14 21.2501H10V22.7501H14V21.2501ZM2.75 14.0001V10.0001H1.25V14.0001H2.75ZM21.25 13.5631V14.0001H22.75V13.5631H21.25ZM14.891 4.61106L18.85 8.17406L19.853 7.05806L15.895 3.49506L14.891 4.61106ZM22.75 13.5631C22.75 11.8741 22.765 10.8041 22.34 9.84805L20.969 10.4591C21.235 11.0571 21.25 11.7421 21.25 13.5631H22.75ZM18.85 8.17406C20.203 9.39206 20.703 9.86205 20.969 10.4591L22.34 9.84805C21.914 8.89106 21.109 8.18806 19.853 7.05806L18.85 8.17406ZM10.03 2.75006C11.612 2.75006 12.209 2.76206 12.74 2.96606L13.278 1.56606C12.426 1.23806 11.498 1.25006 10.03 1.25006V2.75006ZM15.895 3.49606C14.809 2.51906 14.13 1.89206 13.278 1.56606L12.741 2.96606C13.273 3.17006 13.721 3.55806 14.891 4.61106L15.895 3.49606ZM10 21.2501C8.093 21.2501 6.739 21.2481 5.71 21.1101C4.705 20.9751 4.125 20.7211 3.702 20.2981L2.642 21.3581C3.39 22.1081 4.339 22.4391 5.511 22.5971C6.661 22.7521 8.136 22.7501 10 22.7501V21.2501ZM1.25 14.0001C1.25 15.8641 1.248 17.3381 1.403 18.4891C1.561 19.6611 1.893 20.6101 2.641 21.3591L3.701 20.2991C3.279 19.8751 3.025 19.2951 2.89 18.2891C2.752 17.2621 2.75 15.9071 2.75 14.0001H1.25ZM14 22.7501C15.864 22.7501 17.338 22.7521 18.489 22.5971C19.661 22.4391 20.61 22.1071 21.359 21.3591L20.299 20.2991C19.875 20.7211 19.295 20.9751 18.289 21.1101C17.262 21.2481 15.907 21.2501 14 21.2501V22.7501ZM10.03 1.25006C8.155 1.25006 6.674 1.24806 5.519 1.40306C4.342 1.56106 3.39 1.89306 2.641 2.64106L3.701 3.70106C4.125 3.27906 4.706 3.02506 5.718 2.89006C6.751 2.75206 8.113 2.75006 10.03 2.75006V1.25006ZM2.848 6.07306C2.969 4.83906 3.23 4.17306 3.702 3.70206L2.642 2.64206C1.806 3.47606 1.489 4.56106 1.355 5.92706L2.848 6.07306ZM21.152 17.9271C21.031 19.1611 20.769 19.8271 20.298 20.2981L21.358 21.3581C22.194 20.5241 22.511 19.4391 22.645 18.0731L21.152 17.9271Z" fill="#00A148"></path>
                        <path d="M13 2.5V5C13 7.357 13 8.536 13.732 9.268C14.464 10 15.643 10 18 10H22" stroke="#00A148" stroke-width="1.5"></path>
                    </svg>
                    <span>Mobile App UI design </span>
                </div>

                <div class="info">
                    <p>Expected Budget</p>
                    <h6>₹ 15,000</h6>
                </div>
                <div class="info">
                    <p>Expected Deadline</p>
                    <h6>9 Months</h6>
                </div>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                        <path d="M5.34619 0.751462V9.94385M0.75 5.34766H9.94239" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span>Accept project</span>
                </a>
            </div>
        </div>
        <form id="send-message-form" class="d-flex gap-2">
            @csrf
            <input type="hidden" id="conversation-id" value="{{ $conversation->id }}">

            <input type="hidden" id="reply-message-id" value="">
            
            @if($conversation->status == 'closed')
            <div class="chat-closed-box">
                <div class="d-flex align-items-center justify-content-center py-4">
                    <div class="text-center">
                        <i class="fas fa-lock fs-2 text-danger mb-2"></i>
                        <h5 class="mb-1">Chat Closed</h5>
                        <p class="text-muted mb-0">
                            This conversation has been closed. You can no longer send messages.
                        </p>
                    </div>
                </div>
            </div>
            @else
            <div class="messageinput">

                <div id="upload-progress" class="chat-upload-progress" hidden>
                    <div class="chat-upload-progress__top">
                        <span class="chat-upload-progress__label">Uploading…</span>
                        <span class="chat-upload-progress__percent">0%</span>
                    </div>
                    <div class="chat-upload-progress__track" aria-hidden="true">
                        <div class="chat-upload-progress__bar" style="width: 0%"></div>
                    </div>
                </div>
                @if(auth()->id() == $conversation->employer_id)
                @else
                    @if(auth()->id() == 35)
                        @include('chat.show_ai_suggestions')
                    @endif
                @endif
                <div id="mobileDesktopAIAssistant"></div>
                <div class="pending-attachments" id="pendingAttachments" aria-live="polite" hidden></div>
                <div class="messageinputwrapper">
                    <div class="fileinput" id="chatFileBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="22" viewBox="0 0 11 22" fill="none">
                            <path d="M9.5 5L9.5 16.5C9.5 18.71 7.71 20.5 5.5 20.5C3.29 20.5 1.5 18.71 1.5 16.5L1.5 4C1.5 3.33696 1.76339 2.70107 2.23223 2.23223C2.70107 1.76339 3.33696 1.5 4 1.5C4.66304 1.5 5.29893 1.76339 5.76777 2.23223C6.23661 2.70107 6.5 3.33696 6.5 4L6.5 14.5C6.5 15.05 6.05 15.5 5.5 15.5C4.95 15.5 4.5 15.05 4.5 14.5L4.5 5L3 5L3 14.5C3 15.163 3.26339 15.7989 3.73223 16.2678C4.20107 16.7366 4.83696 17 5.5 17C6.16304 17 6.79893 16.7366 7.26777 16.2678C7.73661 15.7989 8 15.163 8 14.5L8 4C8 1.79 6.21 -2.71448e-07 4 -1.74846e-07C1.79 -7.82434e-08 7.02672e-08 1.79 1.66869e-07 4L7.13262e-07 16.5C8.46144e-07 19.54 2.46 22 5.5 22C8.54 22 11 19.54 11 16.5L11 5L9.5 5Z" fill="#4B4B4B" />
                        </svg>
                        <input type="file" id="attachment-input" name="file" multiple
                            accept=".png,.jpg,.jpeg,.pdf,.docx,image/png,image/jpeg,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                    </div>
                    <textarea id="chatMessageInput" rows="1" placeholder="Type your Message here..."></textarea>
                    @if(auth()->id() == $conversation->employer_id)
                    @else
                        @if(auth()->id() == 35)
                            <button id="aiassistantopenbutton">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                    <path d="M7.58611 6.81437L8.41734 3.90687C8.72882 2.81855 10.2712 2.81855 10.5827 3.90687L11.4129 6.81437C11.4655 6.99829 11.5641 7.16579 11.6993 7.30105C11.8346 7.43631 12.0021 7.53488 12.186 7.58745L15.0934 8.41776C16.1817 8.72924 16.1817 10.2716 15.0934 10.5831L12.186 11.4134C12.0021 11.466 11.8346 11.5646 11.6993 11.6998C11.5641 11.8351 11.4655 12.0026 11.4129 12.1865L10.5827 15.094C10.2712 16.1823 8.72882 16.1823 8.41734 15.094L7.58705 12.1865C7.53448 12.0026 7.43592 11.8351 7.30066 11.6998C7.1654 11.5646 6.99791 11.466 6.81399 11.4134L3.90658 10.5831C2.81829 10.2716 2.81829 8.72924 3.90658 8.41776L6.81399 7.58745C6.99791 7.53488 7.1654 7.43631 7.30066 7.30105C7.43592 7.16579 7.53448 6.99829 7.58705 6.81437M15.2266 13.7289C15.4978 12.938 16.6377 12.9371 16.9079 13.7289L16.9323 13.8106L17.21 14.9251L18.3245 15.2038C19.2252 15.429 19.2252 16.7068 18.3245 16.932L17.21 17.2106L16.9323 18.3252C16.7071 19.2249 15.4284 19.2249 15.2032 18.3252L14.9245 17.2106L13.81 16.932C12.9093 16.7068 12.9093 15.428 13.81 15.2038L14.9245 14.9251L15.2032 13.8106L15.2266 13.7289ZM16.0673 15.8774C16.0133 15.9497 15.9491 16.0139 15.8768 16.0679C15.9491 16.1219 16.0133 16.186 16.0673 16.2583C16.1212 16.186 16.1854 16.1219 16.2577 16.0679C16.1853 16.0136 16.1212 15.9491 16.0673 15.8765M2.09214 0.593134C2.37172 -0.224042 3.57915 -0.196835 3.79775 0.674757L4.07545 1.78934L5.19001 2.06799C6.09066 2.29316 6.09066 3.57099 5.19001 3.79616L4.07545 4.07481L3.79775 5.1894C3.57259 6.08913 2.29385 6.08913 2.06868 5.1894L1.79005 4.07481L0.675489 3.79616C-0.225163 3.57099 -0.225163 2.29222 0.675489 2.06799L1.79005 1.78934L2.06868 0.674757L2.09214 0.593134ZM2.93275 2.74256C2.87868 2.81454 2.81454 2.87837 2.7423 2.93208C2.81468 2.98636 2.87882 3.05082 2.93275 3.12347C2.98667 3.05082 3.05082 2.98636 3.1232 2.93208C3.05088 2.87808 2.98674 2.81487 2.93275 2.74256Z" fill="#00A148" />
                                </svg>
                                <span>Ai Assistant</span>
                            </button>
                            <button class="btn" id="open-ai-writing-assistant-collapse">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                    <path d="M7.58611 6.81437L8.41734 3.90687C8.72882 2.81855 10.2712 2.81855 10.5827 3.90687L11.4129 6.81437C11.4655 6.99829 11.5641 7.16579 11.6993 7.30105C11.8346 7.43631 12.0021 7.53488 12.186 7.58745L15.0934 8.41776C16.1817 8.72924 16.1817 10.2716 15.0934 10.5831L12.186 11.4134C12.0021 11.466 11.8346 11.5646 11.6993 11.6998C11.5641 11.8351 11.4655 12.0026 11.4129 12.1865L10.5827 15.094C10.2712 16.1823 8.72882 16.1823 8.41734 15.094L7.58705 12.1865C7.53448 12.0026 7.43592 11.8351 7.30066 11.6998C7.1654 11.5646 6.99791 11.466 6.81399 11.4134L3.90658 10.5831C2.81829 10.2716 2.81829 8.72924 3.90658 8.41776L6.81399 7.58745C6.99791 7.53488 7.1654 7.43631 7.30066 7.30105C7.43592 7.16579 7.53448 6.99829 7.58705 6.81437M15.2266 13.7289C15.4978 12.938 16.6377 12.9371 16.9079 13.7289L16.9323 13.8106L17.21 14.9251L18.3245 15.2038C19.2252 15.429 19.2252 16.7068 18.3245 16.932L17.21 17.2106L16.9323 18.3252C16.7071 19.2249 15.4284 19.2249 15.2032 18.3252L14.9245 17.2106L13.81 16.932C12.9093 16.7068 12.9093 15.428 13.81 15.2038L14.9245 14.9251L15.2032 13.8106L15.2266 13.7289ZM16.0673 15.8774C16.0133 15.9497 15.9491 16.0139 15.8768 16.0679C15.9491 16.1219 16.0133 16.186 16.0673 16.2583C16.1212 16.186 16.1854 16.1219 16.2577 16.0679C16.1853 16.0136 16.1212 15.9491 16.0673 15.8765M2.09214 0.593134C2.37172 -0.224042 3.57915 -0.196835 3.79775 0.674757L4.07545 1.78934L5.19001 2.06799C6.09066 2.29316 6.09066 3.57099 5.19001 3.79616L4.07545 4.07481L3.79775 5.1894C3.57259 6.08913 2.29385 6.08913 2.06868 5.1894L1.79005 4.07481L0.675489 3.79616C-0.225163 3.57099 -0.225163 2.29222 0.675489 2.06799L1.79005 1.78934L2.06868 0.674757L2.09214 0.593134ZM2.93275 2.74256C2.87868 2.81454 2.81454 2.87837 2.7423 2.93208C2.81468 2.98636 2.87882 3.05082 2.93275 3.12347C2.98667 3.05082 3.05082 2.98636 3.1232 2.93208C3.05088 2.87808 2.98674 2.81487 2.93275 2.74256Z" fill="#00A148" />
                                </svg>
                            </button>
                        @endif
                    @endif
                    <button type="submit" class="sendbutton" id="chatSendBtn">
                        <span>Send</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M13.9266 1.6004C14.27 0.650217 13.3493 -0.270542 12.3992 0.0737485L0.786978 4.27362C-0.166329 4.6187 -0.281616 5.91954 0.595363 6.42762L4.30205 8.57368L7.61199 5.26355C7.76194 5.11871 7.96278 5.03857 8.17125 5.04038C8.37972 5.04219 8.57914 5.12582 8.72655 5.27324C8.87397 5.42066 8.95759 5.62009 8.9594 5.82857C8.96121 6.03705 8.88107 6.2379 8.73624 6.38787L5.4263 9.69799L7.57303 13.4049C8.08029 14.2819 9.38105 14.1658 9.72612 13.2133L13.9266 1.6004Z" fill="white" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif
        </form>
    </div>
</div>
<div class="chatrightside" style="display: none;">
    @if($conversation->project_job_id)
    <div id="projectdetailsview" class="show">
        <div class="projectdetails">
            <div class="heading">Project Details <button type="button" class="btn" id="closeProjectDetails"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect width="24" height="24" rx="12" fill="#EFF1F2" />
                        <path d="M8.46387 15.5348L15.5359 8.46484M8.46387 8.46484L15.5359 15.5348" stroke="black"
                            stroke-linecap="round" />
                    </svg></button></div>
            <div class="projectwrapper">
                <div class="title">{{ $conversation->title }}</div>
                <div class="position">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <g clip-path="url(#clip0_3091_18989)">
                            <path
                                d="M9.17234 17.4987H8.004C5.0165 17.4987 3.52317 17.4987 2.59484 16.5529C1.6665 15.607 1.6665 14.0845 1.6665 11.0404C1.6665 7.9962 1.6665 6.4737 2.59484 5.52786C3.52317 4.58203 5.0165 4.58203 8.004 4.58203H11.1732C14.1607 4.58203 15.6548 4.58203 16.5832 5.52786C17.2973 6.25536 17.4615 7.32453 17.4998 9.16536"
                                stroke="#838383" stroke-width="1.5" stroke-linecap="round" />
                            <path
                                d="M13.333 4.58268L13.2497 4.32435C12.8372 3.04102 12.6313 2.39935 12.1405 2.03268C11.6488 1.66602 10.9972 1.66602 9.69134 1.66602H9.47217C8.16801 1.66602 7.51551 1.66602 7.02467 2.03268C6.53301 2.39935 6.32717 3.04102 5.91467 4.32435L5.83301 4.58268M14.2588 11.0452C14.413 10.9035 14.4897 10.8327 14.583 10.8327C14.6763 10.8327 14.753 10.9035 14.9072 11.0452L15.5013 11.5927C15.573 11.6585 15.6088 11.6918 15.653 11.7077C15.698 11.7243 15.7463 11.7227 15.8447 11.7185L16.6463 11.6868C16.853 11.6785 16.9563 11.6752 17.0272 11.7343C17.098 11.7935 17.1122 11.896 17.1397 12.101L17.2497 12.9227C17.263 13.0177 17.2688 13.0643 17.2922 13.106C17.3155 13.146 17.353 13.1752 17.428 13.2343L18.0747 13.7427C18.2347 13.8693 18.3147 13.9318 18.3305 14.0218C18.3463 14.1118 18.2922 14.1985 18.1855 14.3718L17.7472 15.0777C17.6972 15.1585 17.6722 15.1993 17.6638 15.2443C17.6555 15.2893 17.6655 15.3368 17.6855 15.4302L17.8597 16.2452C17.9013 16.4452 17.923 16.5452 17.8772 16.6252C17.8313 16.7052 17.7338 16.7368 17.5397 16.8002L16.768 17.051C16.6763 17.081 16.6297 17.096 16.5938 17.126C16.558 17.1568 16.5355 17.2002 16.4913 17.286L16.1147 18.0118C16.0188 18.1977 15.9705 18.2902 15.883 18.3218C15.7955 18.3535 15.6997 18.3135 15.5063 18.2335L14.7663 17.9268C14.6755 17.8893 14.6305 17.8702 14.583 17.8702C14.5355 17.8702 14.4905 17.8893 14.3997 17.9268L13.6597 18.2335C13.4663 18.3135 13.3705 18.3535 13.283 18.3218C13.1955 18.2902 13.1472 18.1968 13.0513 18.0118L12.6747 17.286C12.6297 17.2002 12.608 17.1568 12.5722 17.1268C12.5363 17.0968 12.4897 17.081 12.398 17.0518L11.6263 16.8002C11.4322 16.7368 11.3347 16.7052 11.2888 16.6252C11.243 16.5452 11.2638 16.446 11.3063 16.2452L11.4813 15.4302C11.5005 15.3368 11.5105 15.2902 11.5022 15.2452C11.4851 15.1849 11.4568 15.1284 11.4188 15.0785L10.9813 14.3718C10.873 14.1985 10.8197 14.1118 10.8355 14.0218C10.8513 13.9318 10.9313 13.8693 11.0913 13.7435L11.738 13.2352C11.813 13.1752 11.8505 13.146 11.8738 13.1052C11.8972 13.0643 11.903 13.0177 11.9155 12.9218L12.0263 12.101C12.0538 11.8968 12.068 11.7935 12.1388 11.7343C12.2097 11.6752 12.313 11.6785 12.5197 11.6868L13.3222 11.7185C13.4197 11.7227 13.468 11.7243 13.513 11.7077C13.5572 11.691 13.593 11.6585 13.6647 11.5927L14.2588 11.0452Z"
                                stroke="#838383" stroke-width="1.5" />
                        </g>
                        <defs>
                            <clipPath id="clip0_3091_18989">
                                <rect width="20" height="20" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>{{ $conversation->category_name }}</span>
                </div>
                <!-- <div class="location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M9.99984 9.58268C9.4473 9.58268 8.9174 9.36319 8.5267 8.97249C8.136 8.58179 7.9165 8.05188 7.9165 7.49935C7.9165 6.94681 8.136 6.41691 8.5267 6.02621C8.9174 5.63551 9.4473 5.41602 9.99984 5.41602C10.5524 5.41602 11.0823 5.63551 11.473 6.02621C11.8637 6.41691 12.0832 6.94681 12.0832 7.49935C12.0832 7.77294 12.0293 8.04384 11.9246 8.29661C11.8199 8.54937 11.6664 8.77903 11.473 8.97249C11.2795 9.16594 11.0499 9.3194 10.7971 9.4241C10.5443 9.5288 10.2734 9.58268 9.99984 9.58268ZM9.99984 1.66602C8.45274 1.66602 6.96901 2.2806 5.87505 3.37456C4.78109 4.46852 4.1665 5.95225 4.1665 7.49935C4.1665 11.8743 9.99984 18.3327 9.99984 18.3327C9.99984 18.3327 15.8332 11.8743 15.8332 7.49935C15.8332 5.95225 15.2186 4.46852 14.1246 3.37456C13.0307 2.2806 11.5469 1.66602 9.99984 1.66602Z"
                            fill="#838383" />
                    </svg>
                    <span>India , New Delhi</span>
                </div> -->
                <div class="jobdescripition">
                    <h6>Job Description</h6>
                    <p>{{ Str::limit(html_entity_decode(strip_tags($conversation->description)), 300) }}</p>
                </div>
                <div class="skills">
                    <h6>Skills Required</h6>
                    <ul>
                        @foreach($conversation->skill_list as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>
                <a href="#"><span>View Project</span> <svg xmlns="http://www.w3.org/2000/svg" width="15" height="13"
                        viewBox="0 0 15 13" fill="none">
                        <path
                            d="M1.53003 12.5246C2.89753 10.4413 4.58753 9.78708 6.6667 9.62125V10.8188C6.6667 11.2638 6.84003 11.6821 7.15503 11.9971C7.78503 12.6271 8.88587 12.6229 9.50753 12.0013L14.7517 6.82875C14.8304 6.75121 14.893 6.65878 14.9356 6.55685C14.9783 6.45491 15.0003 6.34551 15.0003 6.235C15.0003 6.12449 14.9783 6.01509 14.9356 5.91315C14.893 5.81122 14.8304 5.71879 14.7517 5.64125L9.5117 0.472083C8.88336 -0.157083 7.7842 -0.157917 7.1542 0.472917C6.84003 0.787917 6.6667 1.20625 6.6667 1.65125V3.07125C2.81753 3.84875 3.24249e-05 7.23542 3.24249e-05 11.2346V12.0679C-0.000440598 12.2475 0.0571871 12.4225 0.164313 12.5666C0.271441 12.7108 0.42232 12.8165 0.594429 12.8678C0.766538 12.9192 0.950644 12.9135 1.11927 12.8517C1.28789 12.7898 1.43198 12.6751 1.53003 12.5246ZM7.48087 7.91125C5.6417 7.95792 3.61586 8.23958 1.8492 9.67875C2.16806 8.34535 2.89101 7.14298 3.91919 6.23607C4.94737 5.32916 6.23059 4.76198 7.59337 4.61208C8.01337 4.56542 8.33337 4.56875 8.33337 4.56875V1.65458L12.98 6.23458L8.33337 10.8179V7.90208L7.48087 7.91125Z"
                            fill="#00A148" />
                    </svg></a>
            </div>
        </div>
        @if(auth()->id() == $conversation->employer_id)
            <a href="{{ route('employer.talent.profile', \Vinkla\Hashids\Facades\Hashids::encode($conversation->freelancer_id)) }}" class="freelancerprofile">
                <span>View Freelancer Profile</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M2.66663 12.0007C2.66663 11.2934 2.94758 10.6151 3.44767 10.115C3.94777 9.61494 4.62605 9.33398 5.33329 9.33398H10.6666C11.3739 9.33398 12.0521 9.61494 12.5522 10.115C13.0523 10.6151 13.3333 11.2934 13.3333 12.0007C13.3333 12.3543 13.1928 12.6934 12.9428 12.9435C12.6927 13.1935 12.3536 13.334 12 13.334H3.99996C3.64634 13.334 3.3072 13.1935 3.05715 12.9435C2.8071 12.6934 2.66663 12.3543 2.66663 12.0007Z" stroke="white" stroke-linejoin="round" />
                <path d="M8 6.66699C9.10457 6.66699 10 5.77156 10 4.66699C10 3.56242 9.10457 2.66699 8 2.66699C6.89543 2.66699 6 3.56242 6 4.66699C6 5.77156 6.89543 6.66699 8 6.66699Z" stroke="white" />
                </svg>
            </a>
            <!-- <div id="desktopDesktopAIAssistant">
                @include('chat.desktop_ai_writing_assistant')
            </div> -->
        @else
            <a href="{{ route('jobseekers.company.profile', \Vinkla\Hashids\Facades\Hashids::encode($conversation->employer_id)) }}" class="freelancerprofile">
                <span>View Employer Profile</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M2.66663 12.0007C2.66663 11.2934 2.94758 10.6151 3.44767 10.115C3.94777 9.61494 4.62605 9.33398 5.33329 9.33398H10.6666C11.3739 9.33398 12.0521 9.61494 12.5522 10.115C13.0523 10.6151 13.3333 11.2934 13.3333 12.0007C13.3333 12.3543 13.1928 12.6934 12.9428 12.9435C12.6927 13.1935 12.3536 13.334 12 13.334H3.99996C3.64634 13.334 3.3072 13.1935 3.05715 12.9435C2.8071 12.6934 2.66663 12.3543 2.66663 12.0007Z" stroke="white" stroke-linejoin="round" />
                <path d="M8 6.66699C9.10457 6.66699 10 5.77156 10 4.66699C10 3.56242 9.10457 2.66699 8 2.66699C6.89543 2.66699 6 3.56242 6 4.66699C6 5.77156 6.89543 6.66699 8 6.66699Z" stroke="white" />
                </svg>
            </a>
            @if(auth()->id() == 35)
            <div id="desktopDesktopAIAssistant">
                @include('chat.desktop_ai_writing_assistant')
            </div>
            @endif
        @endif
    </div>
    @else
        <div id="projectdetailsview"  class="show">
            <div class="projectdetails">
                <div class="heading">Direct Conversation</div>

                <div class="projectwrapper">
                    <p>This conversation is not associated with any project.</p>
                </div>
            </div>
        </div>
    @endif
    @if(auth()->id() == $conversation->employer_id)
    @else
        @if(auth()->id() == 35)
            @include('chat.show_ai_suggestions_sideview')
        @endif
    @endif
</div>


<style>
    /* Chat upload progress — page-scoped */
    .messageinput .chat-upload-progress {
        display: none;
        margin-top: 0.52vw;
        padding: 0.52vw 0.73vw;
        border-radius: 0.52vw;
        border: 0.052vw solid #e2e2e2;
        background: #f7faf8;
        width: 100%;
        box-sizing: border-box;
    }

    .messageinput .chat-upload-progress.is-visible {
        display: block;
    }

    .messageinput .chat-upload-progress__top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5vw;
        margin-bottom: 0.42vw;
    }

    .messageinput .chat-upload-progress__label {
        color: #3a3a3a;
        font-family: Inter, sans-serif;
        font-size: 0.68vw;
        font-weight: 500;
        line-height: 1.3;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .messageinput .chat-upload-progress__percent {
        color: #00a148;
        font-family: Inter, sans-serif;
        font-size: 0.68vw;
        font-weight: 600;
        flex-shrink: 0;
    }

    .messageinput .chat-upload-progress__track {
        width: 100%;
        height: 0.31vw;
        min-height: 4px;
        border-radius: 999px;
        background: #dfe8e2;
        overflow: hidden;
    }

    .messageinput .chat-upload-progress__bar {
        height: 100%;
        width: 0%;
        border-radius: inherit;
        background: linear-gradient(90deg, #00a148 0%, #2fc96a 100%);
        transition: width 0.15s ease-out;
    }

    .messageinputwrapper.is-uploading {
        opacity: 0.72;
        pointer-events: none;
    }

    .sendbutton.is-uploading {
        opacity: 0.85;
        cursor: not-allowed;
    }

    @media (max-width: 990px) {
        .messageinput .chat-upload-progress {
            margin-top: 2.56vw;
            padding: 2.56vw 3.08vw;
            border-radius: 2.56vw;
            border-width: 0.26vw;
        }

        .messageinput .chat-upload-progress__top {
            margin-bottom: 2vw;
            gap: 2vw;
        }

        .messageinput .chat-upload-progress__label,
        .messageinput .chat-upload-progress__percent {
            font-size: 3.08vw;
        }

        .messageinput .chat-upload-progress__track {
            height: 1.54vw;
            min-height: 6px;
        }
    }

    /* Auto-grow message textarea */
    .messageinputwrapper.is-multiline {
        border-radius: 1.0416666667vw;
        align-items: flex-end;
    }

    #chatMessageInput {
        color: #787878;
        font-family: Inter, sans-serif;
        font-size: 0.7291666667vw;
        font-weight: 400;
        line-height: 1.35;
        outline: none;
        border: none;
        background: transparent;
        width: calc(100% - 10.4166666667vw);
        padding: 0;
        margin: 0;
        resize: none;
        overflow-y: auto;
        white-space: pre-wrap;
        word-break: break-word;
        overflow-wrap: anywhere;
        min-height: 1.2em;
        max-height: 6.75em;
        height: 1.2em;
        display: block;
        field-sizing: content;
    }

    @media (max-width: 990px) {
        .messageinputwrapper.is-multiline {
            border-radius: 5.1282051282vw;
        }

        #chatMessageInput {
            font-size: 16px;
            width: calc(100% - 3.125vw);
            max-height: 6.75em;
        }

        #chatMessageInput::-moz-placeholder {
            font-size: 14px;
        }

        #chatMessageInput::placeholder {
            font-size: 14px;
        }
    }
</style>

<script>
    const openProjectDetails = document.getElementById('openProjectDetails');
    const projectdetailsview = document.getElementById('projectdetailsview');
    const closeProjectDetails = document.getElementById('closeProjectDetails');
    if (openProjectDetails) {
        openProjectDetails.addEventListener('click', () => {
            projectdetailsview.classList.add('show');
        });
    }

    if (closeProjectDetails) {
        closeProjectDetails.addEventListener('click', () => {
            projectdetailsview.classList.remove('show');
        });
    }
</script>

<script>
    $(function() {

        const conversationId = $('#conversation-id').val();
        const messageList = $('#message-list');
        let currentUserId = {{ auth()->id() }};

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const otherUserPhoto = @json($photo ?: "https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg");
        
        function formatFileSize(bytes) {
            if (!bytes) return '';
        
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        
            if (bytes == 0) return '0 Bytes';
        
            const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        
            return (bytes / Math.pow(1024, i)).toFixed(i == 0 ? 0 : 1) + ' ' + sizes[i];
        }

        function getExt(name) {
            const parts = String(name || '').toLowerCase().split('.');
            return parts.length > 1 ? parts.pop() : '';
        }

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

        function renderMessage(msg) {
            const isMine = Number(msg.sender_id) === Number(currentUserId);
            let attachment = '';
        
            if (msg.message_type === 'file' && msg.file_name) {
                const fileLabel = msg.original_name || msg.file_name;
                const fileExt = getExt(fileLabel);
                attachment = `
                    <div class="attechment">
                        <div class="single">
                            <div class="icon">
                                ${getFileIconSvg(fileExt)}
                            </div>
                            <div class="text">
                                <h2>${$('<div>').text(fileLabel).html()}</h2>
                                <p>${formatFileSize(msg.file_size)}</p>
                            </div>
                            <a href="/chat/download/${msg.id}" class="download-file" title="Download">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M4 14H12M8 2V11.3333M4.66667 8L8 11.3333L11.3333 8" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                `;
            }
        
            const time = new Date(msg.created_at).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
        
            // Returns ONLY the bubble now, not the wrapper
            return `
                <div class="onemessage" data-message-id="${msg.id}">
                    ${msg.message ? `<p>${$('<div>').text(msg.message).html()}</p>` : ''}
                    ${attachment}
                    ${isMine
                        ? `
                            <span>${time}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M1.75 9.75L4.25 12.25M7.75 8.25L10.25 5.75M5.75 9.75L8.25 12.25L14.25 5.75"
                                    stroke="${msg.read_at ? '#00A148' : '#AFAFAF'}"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                        `
                        : `<h6>${time}</h6>`
                    }
                </div>
            `;
        }

        function loadMessages() {
        
            $.get(`/chat/messages/${conversationId}`, function (res) {
        
                if (!res.status) return;
        
                messageList.empty();
        
                if (res.has_proposal && res.proposal_html) {
                    messageList.append(res.proposal_html);
                }
                if (res.show_hire_box) {
                    messageList.append(res.hire_box_html);
                }
                if (res.show_waiting_box) {
                    messageList.append(res.waiting_box_html);
                }
                if (res.show_accept_project) {
                    messageList.append(res.accept_project_html);
                }
        
                let lastDate = "";
                let currentGroup = null;
                let currentSender = null;
        
                $.each(res.messages, function (i, msg) {
        
                    let msgDate = new Date(msg.created_at);
                    let currentDate = msgDate.toLocaleDateString();
        
                    if (currentDate !== lastDate) {
        
                        let heading = currentDate;
                        let today = new Date().toLocaleDateString();
                        let yesterday = new Date(Date.now() - 86400000).toLocaleDateString();
        
                        if (currentDate === today) {
                            heading = "Today";
                        } else if (currentDate === yesterday) {
                            heading = "Yesterday";
                        }
        
                        messageList.append(`
                            <div class="when">
                                <span>${heading}</span>
                            </div>
                        `);
        
                        lastDate = currentDate;
        
                        // Reset grouping when the date changes
                        currentGroup = null;
                        currentSender = null;
                    }
        
                    const isMine = Number(msg.sender_id) === Number(currentUserId);
        
                    // New sender -> start a new wrapper
                    if (currentSender !== msg.sender_id) {
        
                        currentSender = msg.sender_id;
        
                        if (isMine) {
                            currentGroup = $(`<div class="user"></div>`);
                        } else {
                            currentGroup = $(`
                                <div class="oppositeuser">
                                    <div class="image">
                                        <img src="${otherUserPhoto}"
                                             onerror="this.onerror=null;this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg';">
                                    </div>
                                    <div class="message-group"></div>
                                </div>
                            `);
                        }
        
                        messageList.append(currentGroup);
                    }
        
                    // Append the bubble into the current group's wrapper
                    if (isMine) {
                        currentGroup.append(renderMessage(msg));
                    } else {
                        currentGroup.find('.message-group').append(renderMessage(msg));
                    }
        
                });
        
                messageList.scrollTop(messageList[0].scrollHeight);
        
            });
        
        }

        // Pending attachment preview (before send)
        const ALLOWED_EXTS = ['png', 'jpg', 'jpeg', 'pdf', 'docx'];
        const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 MB
        let pendingFiles = [];
        const pendingWrap = document.getElementById('pendingAttachments');

        function isAllowed(file) {
            return ALLOWED_EXTS.indexOf(getExt(file.name)) !== -1;
        }

        const removeIconSvg =
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">' +
            '<path d="M4.5 4.5L11.5 11.5M11.5 4.5L4.5 11.5" stroke="#E53935" stroke-width="1.5" stroke-linecap="round"/>' +
            '</svg>';

        function renderPending() {
            if (!pendingWrap) return;
            pendingWrap.innerHTML = '';
            if (!pendingFiles.length) {
                pendingWrap.classList.remove('has-files');
                pendingWrap.setAttribute('hidden', 'hidden');
                pendingWrap.style.display = 'none';
                return;
            }
            pendingWrap.classList.add('has-files');
            pendingWrap.removeAttribute('hidden');
            pendingWrap.style.display = 'flex';
            pendingFiles.forEach(function (file, index) {
                const ext = getExt(file.name);
                const card = document.createElement('div');
                card.className = 'pending-file';
                card.innerHTML =
                    '<div class="icon">' + getFileIconSvg(ext) + '</div>' +
                    '<div class="text"><h2></h2><p></p></div>' +
                    '<a href="#" class="remove-pending" data-index="' + index + '" title="Remove file">' + removeIconSvg + '</a>';
                card.querySelector('h2').textContent = file.name;
                card.querySelector('p').textContent = formatFileSize(file.size);
                pendingWrap.appendChild(card);
            });
        }

        function addFiles(fileList) {
            let rejectedType = false;
            let rejectedSize = false;
            Array.prototype.forEach.call(fileList, function (file) {
                if (!isAllowed(file)) {
                    rejectedType = true;
                    return;
                }
                if (file.size > MAX_FILE_SIZE) {
                    rejectedSize = true;
                    return;
                }
                const exists = pendingFiles.some(function (f) {
                    return f.name === file.name && f.size === file.size && f.lastModified === file.lastModified;
                });
                if (!exists) pendingFiles.push(file);
            });
            if (rejectedType) {
                alert('Only PNG, JPG, JPEG, PDF and DOCX files are allowed.');
            }
            if (rejectedSize) {
                alert('Maximum file size allowed is 5 MB.');
            }
            renderPending();
            $('#attachment-input').val('');
        }

        if (pendingWrap) {
            pendingWrap.addEventListener('click', function (e) {
                const btn = e.target.closest('.remove-pending');
                if (!btn) return;
                e.preventDefault();
                const index = parseInt(btn.getAttribute('data-index'), 10);
                if (!isNaN(index)) {
                    pendingFiles.splice(index, 1);
                    renderPending();
                }
            });
        }

        // Tests: POST /chat/send

        $('#send-message-form').on('submit', function(e) {

            e.preventDefault();

            const text = $('#chatMessageInput').val().trim();
            const filesToSend = pendingFiles.slice();

            if (filesToSend.length) {
                uploadPendingFiles(filesToSend, text);
                return;
            }

            if (!text) return;

            $.post("{{ route('chat.send') }}", {

                _token: "{{ csrf_token() }}",

                conversation_id: conversationId,

                message: text,

                reply_message_id: $('#reply-message-id').val() || null

            }, function(res) {

                if (res.status) {

                    $('#chatMessageInput').val('');
                    autoResizeMessageInput();

                    $('#reply-message-id').val('');

                    $('#reply-preview').addClass('d-none');

                    loadMessages();

                } else {

                    alert(res.message || 'Failed to send message.');

                }

            }).fail(function(xhr) {

                alert('Send failed: ' + xhr.status);

            });

        });


        // Tests: POST /chat/upload

        function showUploadProgress(label, percent) {
            const $wrap = $('#upload-progress');
            const pct = Math.max(0, Math.min(100, percent || 0));
            $wrap
                .removeAttr('hidden')
                .addClass('is-visible');
            $wrap.find('.chat-upload-progress__label').text(label || 'Uploading…');
            $wrap.find('.chat-upload-progress__percent').text(pct + '%');
            $wrap.find('.chat-upload-progress__bar').css('width', pct + '%');
        }

        function hideUploadProgress() {
            const $wrap = $('#upload-progress');
            $wrap
                .attr('hidden', 'hidden')
                .removeClass('is-visible');
            $wrap.find('.chat-upload-progress__label').text('Uploading…');
            $wrap.find('.chat-upload-progress__percent').text('0%');
            $wrap.find('.chat-upload-progress__bar').css('width', '0%');
            $('.messageinputwrapper').removeClass('is-uploading');
            $('#chatSendBtn').removeClass('is-uploading');
        }

        function setUploadingState(isUploading) {
            const sendBtn = $('#chatSendBtn');
            sendBtn.prop('disabled', !!isUploading);
            if (isUploading) {
                $('.messageinputwrapper').addClass('is-uploading');
                sendBtn.addClass('is-uploading');
            } else {
                $('.messageinputwrapper').removeClass('is-uploading');
                sendBtn.removeClass('is-uploading');
            }
        }

        function uploadAttachment(file, message, options) {
            options = options || {};
            const index = options.index || 1;
            const total = options.total || 1;
            const reload = options.reload !== false;

            const formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('conversation_id', conversationId);
            formData.append('file', file);

            if (message) {
                formData.append('message', message);
            }

            setUploadingState(true);

            const baseLabel = total > 1
                ? ('Uploading file ' + index + ' of ' + total)
                : 'Uploading file';

            showUploadProgress(baseLabel, 0);

            return new Promise(function (resolve, reject) {
                $.ajax({

                    url: "{{ route('chat.upload') }}",

                    type: "POST",

                    data: formData,

                    processData: false,

                    contentType: false,

                    xhr: function () {

                        let xhr = new window.XMLHttpRequest();

                        xhr.upload.addEventListener("progress", function (e) {

                            if (e.lengthComputable) {

                                let percent = Math.round((e.loaded / e.total) * 100);
                                showUploadProgress(baseLabel, percent);

                            }

                        });

                        return xhr;

                    },

                    success: function (res) {

                        if (res.status) {
                            resolve(res);
                        } else {
                            reject(new Error(res.message || 'Upload failed.'));
                        }

                    },

                    error: function (xhr) {

                        let msg = 'Upload failed.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        reject(new Error(msg));

                    },

                    complete: function () {
                        if (reload) {
                            hideUploadProgress();
                            setUploadingState(false);
                        }
                    }

                });
            }).then(function (res) {
                if (reload) {
                    $('#chatMessageInput').val('');
                    autoResizeMessageInput();
                    $('#reply-message-id').val('');
                    $('#attachment-input').val('');
                    $('#reply-preview').addClass('d-none');
                    pendingFiles = [];
                    renderPending();
                    loadMessages();
                }
                return res;
            }).catch(function (err) {
                if (reload) {
                    $('#attachment-input').val('');
                }
                alert(err.message || 'Upload failed.');
                throw err;
            });
        }

        async function uploadPendingFiles(files, message) {
            setUploadingState(true);

            try {
                for (let i = 0; i < files.length; i++) {
                    const isLast = i === files.length - 1;
                    const textForFile = i === 0 ? message : '';
                    await uploadAttachment(files[i], textForFile, {
                        index: i + 1,
                        total: files.length,
                        reload: false
                    });
                    if (isLast) {
                        showUploadProgress('Upload complete', 100);
                        $('#chatMessageInput').val('');
                        autoResizeMessageInput();
                        $('#reply-message-id').val('');
                        $('#attachment-input').val('');
                        $('#reply-preview').addClass('d-none');
                        pendingFiles = [];
                        renderPending();
                        loadMessages();
                    }
                }
            } catch (err) {
                // error already alerted in uploadAttachment
            } finally {
                hideUploadProgress();
                setUploadingState(false);
            }
        }

        // Tests: POST /chat/read

        function markRead() {

            $.post("{{ route('chat.read') }}", {
                _token: "{{ csrf_token() }}",
                conversation_id: conversationId
            });

        }

        // Click a bubble to reply to it

        messageList.on('click', '[data-message-id]', function() {

            const id = $(this).data('message-id');

            const text = $(this).find('div').eq(2).text();

            $('#reply-message-id').val(id);

            $('#reply-preview-text').text(text.substring(0, 60));

            $('#reply-preview').removeClass('d-none');

        });

        $('#cancel-reply').on('click', function(e) {

            e.preventDefault();

            $('#reply-message-id').val('');

            $('#reply-preview').addClass('d-none');

        });

        $('#attachment-input').on('change', function () {
            if (!this.files || !this.files.length) return;
            addFiles(this.files);
        });

        function autoResizeMessageInput() {
            const messageInput = document.getElementById('chatMessageInput');
            if (!messageInput) return;
            const wrapper = messageInput.closest('.messageinputwrapper');
            messageInput.style.height = 'auto';
            let next = messageInput.scrollHeight;
            const max = parseFloat(window.getComputedStyle(messageInput).maxHeight) || next;
            if (next > max) next = max;
            messageInput.style.height = next + 'px';
            if (wrapper) {
                if (messageInput.value.indexOf('\n') !== -1 || messageInput.scrollHeight > messageInput.clientHeight + 2 || next > 28) {
                    wrapper.classList.add('is-multiline');
                } else {
                    const lineH = parseFloat(window.getComputedStyle(messageInput).lineHeight) || 20;
                    if (next > lineH * 1.4) wrapper.classList.add('is-multiline');
                    else wrapper.classList.remove('is-multiline');
                }
            }
        }

        $('#chatMessageInput').on('input', autoResizeMessageInput);
        $('#chatMessageInput').on('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                $('#send-message-form').trigger('submit');
            }
        });
        autoResizeMessageInput();

        // Load old messages

        loadMessages();

        // Mark conversation as read

        markRead();

        // Subscribe to websocket

        window.Echo.leave('conversation.' + conversationId);
        
        window.Echo
            .private('conversation.' + conversationId)
            .listen('.message.sent', function (e) {
            
                const msg = e.message;
            
                // Don't append if message already exists
                if (messageList.find(`[data-message-id="${msg.id}"]`).length) {
                    return;
                }
            
                const isMine = Number(msg.sender_id) === Number(currentUserId);
            
                if (isMine) return;
            
                const bubble = renderMessage(msg);
                const lastGroup = messageList.children().last();
            
                if (lastGroup.length && lastGroup.hasClass('oppositeuser')) {
                    lastGroup.find('.text').append(bubble);
                } else {
                    messageList.append(`
                        <div class="oppositeuser">
                            <div class="image">
                                <img src="${otherUserPhoto}"
                                    onerror="this.onerror=null;this.src='https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg';">
                            </div>
                            <div class="message-group">${bubble}</div>
                        </div>
                    `);
                }
            
                messageList.scrollTop(messageList[0].scrollHeight);
                markRead();
            });
    });

    $(function() {
        var ALLOWED = ['png', 'jpg', 'jpeg', 'pdf', 'docx'];
        var pendingFiles = [];
        var fileBtn = document.getElementById('AIchatFileBtn');
        var fileInput = document.getElementById('aiChatFileInput');
        var pendingWrap = document.getElementById('aiPendingAttachments');
        var messageInput = document.getElementById('AIchatMessageInput');
        var sendBtn = document.getElementById('aiChatSendBtn');
        var messageBox = document.querySelector('#aiassistant .aichatwrapper');

        if (!fileInput || !pendingWrap) {
            console.warn('AI attachment UI missing');
            return;
        }

        function getExt(name) {
            var parts = String(name || '').toLowerCase().split('.');
            return parts.length > 1 ? parts.pop() : '';
        }

        function isAllowed(file) {
            return ALLOWED.indexOf(getExt(file.name)) !== -1;
        }

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + 'b';
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1).replace(/\.0$/, '') + 'kb';
            return (bytes / (1024 * 1024)).toFixed(1).replace(/\.0$/, '') + 'mb';
        }

        function getCurrentTime() {
            var d = new Date();
            var h = d.getHours();
            var m = d.getMinutes();
            var ampm = h >= 12 ? 'pm' : 'am';
            h = h % 12 || 12;
            return h + ':' + (m < 10 ? '0' + m : m) + ' ' + ampm;
        }

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
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">' +
            '<path d="M4.5 4.5L11.5 11.5M11.5 4.5L4.5 11.5" stroke="#E53935" stroke-width="1.5" stroke-linecap="round"/>' +
            '</svg>';

        var downloadIconSvg =
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">' +
            '<path d="M4 14H12M8 2V11.3333M4.66667 8L8 11.3333L11.3333 8" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round"/>' +
            '</svg>';

        var tickSvg =
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">' +
            '<path d="M1.75 9.75L4.25 12.25M7.75 8.25L10.25 5.75M5.75 9.75L8.25 12.25L14.25 5.75" stroke="#00A148" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>' +
            '</svg>';

        function renderPending() {
            pendingWrap.innerHTML = '';
            if (!pendingFiles.length) {
                pendingWrap.classList.remove('has-files');
                pendingWrap.setAttribute('hidden', 'hidden');
                pendingWrap.style.display = 'none';
                return;
            }
            pendingWrap.classList.add('has-files');
            pendingWrap.removeAttribute('hidden');
            pendingWrap.style.display = 'flex';
            pendingFiles.forEach(function(file, index) {
                var ext = getExt(file.name);
                var card = document.createElement('div');
                card.className = 'pending-file';
                card.innerHTML =
                    '<div class="icon">' + getFileIconSvg(ext) + '</div>' +
                    '<div class="text"><h2></h2><p></p></div>' +
                    '<a href="#" class="remove-pending" data-index="' + index + '" title="Remove file">' + removeIconSvg + '</a>';
                card.querySelector('h2').textContent = file.name;
                card.querySelector('p').textContent = formatFileSize(file.size);
                pendingWrap.appendChild(card);
            });
        }

        function addFiles(fileList) {
            Array.prototype.forEach.call(fileList, function(file) {
                if (!isAllowed(file)) return;
                var exists = pendingFiles.some(function(f) {
                    return f.name === file.name && f.size === file.size && f.lastModified === file.lastModified;
                });
                if (!exists) pendingFiles.push(file);
            });
            renderPending();
            fileInput.value = '';
        }

        function appendTextMessage(text) {
            if (!messageBox) return;
            var wrap = document.createElement('div');
            wrap.className = 'userside';
            wrap.innerHTML =
                '<p></p>' +
                '<div class="time"><span></span>' + tickSvg + '</div>';
            wrap.querySelector('p').textContent = text;
            wrap.querySelector('span').textContent = getCurrentTime();
            messageBox.appendChild(wrap);
        }

        function appendAttachmentMessage(file) {
            if (!messageBox) return;
            var ext = getExt(file.name);
            var wrap = document.createElement('div');
            wrap.className = 'userside';
            wrap.innerHTML =
                '<div class="attechment"><div class="single">' +
                '<div class="icon">' + getFileIconSvg(ext) + '</div>' +
                '<div class="text"><h2></h2><p></p></div>' +
                '<a href="#" class="download-file" title="download file">' + downloadIconSvg + '</a>' +
                '</div></div>' +
                '<div class="time"><span></span>' + tickSvg + '</div>';
            wrap.querySelector('h2').textContent = file.name;
            wrap.querySelector('.text p').textContent = formatFileSize(file.size);
            wrap.querySelector('.time span').textContent = getCurrentTime();
            messageBox.appendChild(wrap);
        }

        function scrollChatToBottom() {
            if (!messageBox) return;
            messageBox.scrollTop = messageBox.scrollHeight;
        }

        function autoResizeMessageInput() {
            if (!messageInput) return;
            var wrapper = messageInput.closest('.messageinputwrapper');
            messageInput.style.height = 'auto';
            var next = messageInput.scrollHeight;
            var max = parseFloat(window.getComputedStyle(messageInput).maxHeight) || next;
            if (next > max) next = max;
            messageInput.style.height = next + 'px';
            if (wrapper) {
                if (messageInput.value.indexOf('\n') !== -1 || messageInput.scrollHeight > messageInput.clientHeight + 2 || next > 28) {
                    wrapper.classList.add('is-multiline');
                } else {
                    var lineH = parseFloat(window.getComputedStyle(messageInput).lineHeight) || 20;
                    if (next > lineH * 1.4) wrapper.classList.add('is-multiline');
                    else wrapper.classList.remove('is-multiline');
                }
            }
        }

        function sendMessage() {
            var text = messageInput ? (messageInput.value || '').trim() : '';
            var filesToSend = pendingFiles.slice();
            if (!text && !filesToSend.length) return;

            if (text) appendTextMessage(text);
            filesToSend.forEach(function(file) {
                appendAttachmentMessage(file);
            });

            if (messageInput) {
                messageInput.value = '';
                autoResizeMessageInput();
            }
            pendingFiles = [];
            renderPending();
            scrollChatToBottom();
        }

        if (fileBtn) {
            fileBtn.addEventListener('pointerdown', function() {
                fileBtn.classList.add('is-pressed');
            });

            function clearPress() {
                fileBtn.classList.remove('is-pressed');
            }
            fileBtn.addEventListener('pointerup', clearPress);
            fileBtn.addEventListener('pointerleave', clearPress);
            fileBtn.addEventListener('pointercancel', clearPress);
        }

        fileInput.setAttribute('multiple', 'multiple');
        fileInput.addEventListener('change', function() {
            if (fileInput.files && fileInput.files.length) {
                addFiles(fileInput.files);
            }
        });

        pendingWrap.addEventListener('click', function(e) {
            var btn = e.target.closest('.remove-pending');
            if (!btn) return;
            e.preventDefault();
            var index = parseInt(btn.getAttribute('data-index'), 10);
            if (!isNaN(index)) {
                pendingFiles.splice(index, 1);
                renderPending();
            }
        });

        // if (sendBtn) {
        //     sendBtn.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         sendMessage();
        //     });
        // }

        if (messageInput) {
            messageInput.addEventListener('input', autoResizeMessageInput);
            messageInput.addEventListener('keydown', function(e) {
                // if (e.key === 'Enter' && !e.shiftKey) {
                //     e.preventDefault();
                //     sendMessage();
                // }
            });
            autoResizeMessageInput();
        }

        renderPending();
    });
</script>


<script>
    (function () {
        const POPUPS = {
            writingAssistant: 'writingAssistant',
            aiAssistant: 'aiAssistant',
            sideview: 'sideview',
            mobileSummary: 'mobileSummary',
            categoryDetail: 'categoryDetail'
        };

        const popupStack = [];

        const aiChatWrapper = document.getElementById('ai-writing-assistant-collapse');
        const aiassistant = document.getElementById('aiassistant');
        const showAiSuggestionsWrapper = document.getElementById('show-ai-suggestions');
        const showAiSuggestionsSideview = document.getElementById('show-ai-suggestions-sideview');
        const showAiSuggestionsCategory = document.getElementById('ai-suggestions-category');
        const showAiSuggestionsCategoryview = document.getElementById('ai-suggestions-categoryview');
        const openAIChatButton = document.getElementById('open-ai-writing-assistant-collapse');
        const closeAIChatButton = document.getElementById('close-ai-writing-assistant-collapse');
        const openAIAssistant = document.getElementById('openAIAssistant');
        const showAISuggestion = document.getElementById('showAISuggestion');
        const openChatSummary = document.getElementById('openChatSummary');
        const openAiSuggestionsSideviewBtn = document.getElementById('open-ai-suggestions-sideview');
        const backToCategory = document.getElementById('backToCategory');
        const aiassistantopenbutton = document.getElementById('aiassistantopenbutton');
        const closeaiassistant = document.getElementById('closeaiassistant');
        const projectdetailsview = document.getElementById('projectdetailsview');

        function setBodyPopup(open) {
            document.body.classList.toggle('popupopned', !!open);
        }

        function hidePanel(name) {
            if (name === POPUPS.writingAssistant && aiChatWrapper) {
                aiChatWrapper.classList.remove('show');
            }
            if (name === POPUPS.aiAssistant && aiassistant) {
                aiassistant.classList.remove('show');
            }
            if (name === POPUPS.sideview && showAiSuggestionsSideview) {
                showAiSuggestionsSideview.classList.remove('show');
                if (showAiSuggestionsCategoryview) showAiSuggestionsCategoryview.classList.remove('show');
                if (showAiSuggestionsCategory) showAiSuggestionsCategory.classList.add('show');
            }
            if (name === POPUPS.mobileSummary && showAiSuggestionsWrapper) {
                showAiSuggestionsWrapper.classList.remove('show');
            }
            if (name === POPUPS.categoryDetail) {
                if (showAiSuggestionsCategoryview) showAiSuggestionsCategoryview.classList.remove('show');
                if (showAiSuggestionsCategory) showAiSuggestionsCategory.classList.add('show');
            }
        }

        function showPanel(name) {
            if (name === POPUPS.writingAssistant && aiChatWrapper) {
                aiChatWrapper.classList.add('show');
                setBodyPopup(true);
            }
            if (name === POPUPS.aiAssistant && aiassistant) {
                aiassistant.classList.add('show');
                setBodyPopup(true);
            }
            if (name === POPUPS.sideview && showAiSuggestionsSideview) {
                showAiSuggestionsSideview.classList.add('show');
                if (showAiSuggestionsCategory) showAiSuggestionsCategory.classList.add('show');
                if (showAiSuggestionsCategoryview) showAiSuggestionsCategoryview.classList.remove('show');
                if (showAiSuggestionsWrapper) showAiSuggestionsWrapper.classList.remove('ai-suggestions-inline');
                setBodyPopup(true);
            }
            if (name === POPUPS.mobileSummary && showAiSuggestionsWrapper) {
                showAiSuggestionsWrapper.classList.add('show');
                setBodyPopup(true);
            }
            if (name === POPUPS.categoryDetail) {
                if (showAiSuggestionsCategory) showAiSuggestionsCategory.classList.remove('show');
                if (showAiSuggestionsCategoryview) showAiSuggestionsCategoryview.classList.add('show');
            }
        }

        function openPopup(name, hidePrevious) {
            const current = popupStack[popupStack.length - 1];
            if (current === name) return;
            if (hidePrevious && current) {
                hidePanel(current);
            }
            popupStack.push(name);
            showPanel(name);
        }

        function closeCurrentAndRestorePrevious() {
            if (!popupStack.length) return;
            const current = popupStack.pop();
            hidePanel(current);

            if (current === POPUPS.categoryDetail) {
                const parent = popupStack[popupStack.length - 1];
                if (parent === POPUPS.sideview) {
                    showPanel(POPUPS.sideview);
                }
                return;
            }

            const previous = popupStack[popupStack.length - 1];
            if (previous) {
                showPanel(previous);
            } else {
                setBodyPopup(false);
            }
        }

        function closeAllAiPopups() {
            while (popupStack.length) {
                hidePanel(popupStack.pop());
            }
            setBodyPopup(false);
        }

        function copyTextToClipboard(text) {
            const value = (text || '').trim();
            if (!value) return Promise.resolve(false);
            if (navigator.clipboard && window.isSecureContext) {
                return navigator.clipboard.writeText(value).then(() => true).catch(() => false);
            }
            const temp = document.createElement('textarea');
            temp.value = value;
            temp.style.position = 'fixed';
            temp.style.opacity = '0';
            document.body.appendChild(temp);
            temp.focus();
            temp.select();
            let ok = false;
            try {
                ok = document.execCommand('copy');
            } catch (err) {
                ok = false;
            }
            document.body.removeChild(temp);
            return Promise.resolve(ok);
        }

        function flashCopied(el) {
            if (!el) return;
            el.classList.add('copied');
            const prev = el.getAttribute('data-prev-label');
            if (el.tagName === 'BUTTON' && !prev) {
                el.setAttribute('data-prev-label', el.textContent);
                el.textContent = 'Copied';
            }
            setTimeout(() => {
                el.classList.remove('copied');
                const original = el.getAttribute('data-prev-label');
                if (original) {
                    el.textContent = original;
                    el.removeAttribute('data-prev-label');
                }
            }, 1500);
        }

        // --- Open / close buttons ---
        if (openAIChatButton && aiChatWrapper) {
            openAIChatButton.addEventListener('click', () => {
                openPopup(POPUPS.writingAssistant, false);
            });
        }

        if (closeAIChatButton) {
            closeAIChatButton.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                closeAllAiPopups();
            });
        }

        if (openAIAssistant) {
            openAIAssistant.addEventListener('click', () => {
                openPopup(POPUPS.aiAssistant, true);
            });
        }

        if (aiassistantopenbutton) {
            aiassistantopenbutton.addEventListener('click', () => {
                openPopup(POPUPS.aiAssistant, true);
            });
        }

        if (closeaiassistant) {
            closeaiassistant.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                if (popupStack[popupStack.length - 1] === POPUPS.aiAssistant) {
                    closeCurrentAndRestorePrevious();
                } else {
                    hidePanel(POPUPS.aiAssistant);
                }
            });
        }

        if (showAISuggestion) {
            showAISuggestion.addEventListener('click', () => {
                openPopup(POPUPS.sideview, true);
            });
        }

        if (openChatSummary) {
            openChatSummary.addEventListener('click', () => {
                if (window.innerWidth <= 990) {
                    openPopup(POPUPS.mobileSummary, true);
                } else {
                    openPopup(POPUPS.sideview, true);
                    if (projectdetailsview) projectdetailsview.classList.remove('show');
                }
            });
        }

        if (openAiSuggestionsSideviewBtn) {
            openAiSuggestionsSideviewBtn.addEventListener('click', () => {
                openPopup(POPUPS.sideview, true);
                if (projectdetailsview) projectdetailsview.classList.remove('show');
            });
        }

        document.querySelectorAll('#ai-suggestions-category .list .single').forEach((single) => {
            single.addEventListener('click', () => {
                if (popupStack[popupStack.length - 1] !== POPUPS.categoryDetail) {
                    popupStack.push(POPUPS.categoryDetail);
                }
                showPanel(POPUPS.categoryDetail);
            });
        });

        if (backToCategory) {
            backToCategory.addEventListener('click', (e) => {
                e.preventDefault();
                if (popupStack[popupStack.length - 1] === POPUPS.categoryDetail) {
                    closeCurrentAndRestorePrevious();
                } else {
                    showPanel(POPUPS.sideview);
                }
            });
        }

        // --- Backdrop / free-space clicks ---
        if (aiChatWrapper) {
            aiChatWrapper.addEventListener('click', (e) => {
                if (e.target !== aiChatWrapper) return;
                closeAllAiPopups();
            });
        }

        if (aiassistant) {
            aiassistant.addEventListener('click', (e) => {
                if (e.target !== aiassistant) return;
                if (popupStack[popupStack.length - 1] === POPUPS.aiAssistant) {
                    closeCurrentAndRestorePrevious();
                } else {
                    hidePanel(POPUPS.aiAssistant);
                    setBodyPopup(popupStack.length > 0);
                }
            });
        }

        if (showAiSuggestionsSideview) {
            showAiSuggestionsSideview.addEventListener('click', (e) => {
                if (e.target !== showAiSuggestionsSideview) return;
                const top = popupStack[popupStack.length - 1];
                if (top === POPUPS.categoryDetail) {
                    closeCurrentAndRestorePrevious();
                    return;
                }
                if (top === POPUPS.sideview) {
                    closeCurrentAndRestorePrevious();
                    return;
                }
                hidePanel(POPUPS.sideview);
                const previous = popupStack.filter((p) => p !== POPUPS.sideview && p !== POPUPS.categoryDetail);
                popupStack.length = 0;
                previous.forEach((p) => popupStack.push(p));
                if (popupStack.length) {
                    showPanel(popupStack[popupStack.length - 1]);
                } else {
                    setBodyPopup(false);
                }
            });
        }

        if (showAiSuggestionsWrapper) {
            showAiSuggestionsWrapper.addEventListener('click', (e) => {
                if (e.target !== showAiSuggestionsWrapper) return;
                if (popupStack[popupStack.length - 1] === POPUPS.mobileSummary) {
                    closeCurrentAndRestorePrevious();
                }
            });
        }

        // --- Clipboard copy ---
        document.querySelectorAll('#aiassistant .copyresponse').forEach((btn) => {
            btn.style.cursor = 'pointer';
            btn.addEventListener('click', () => {
                const side = btn.closest('.aiside');
                if (!side) return;
                const paragraphs = side.querySelectorAll('.airesponse > p');
                const text = Array.from(paragraphs).map((p) => p.textContent.trim()).filter(Boolean).join('\n');
                copyTextToClipboard(text).then((ok) => {
                    if (ok) flashCopied(btn);
                });
            });
        });

        const regenerate = document.getElementById('regenerate');
        if (regenerate) {
            regenerate.addEventListener('click', (e) => e.preventDefault());
        }

        // Suggested messages → insert into chat input (row click, not icon)
        document.querySelectorAll('#innertabview .list .single').forEach((row) => {
            row.style.cursor = 'pointer';
            row.addEventListener('click', (e) => {
                if (e.target.closest('.icon')) return;
                const textEl = row.querySelector('.text');
                const text = textEl ? textEl.textContent.trim() : '';
                const messageInput = document.getElementById('chatMessageInput');
                if (!messageInput || !text) return;
                messageInput.value = text;
                messageInput.dispatchEvent(new Event('input', { bubbles: true }));
                messageInput.focus();
                copyTextToClipboard(text);
            });
        });

        // --- Shared / mobile helpers ---
        function isPhone() {
            return window.innerWidth <= 990;
        }

        const desktopAIAssistant = document.getElementById('desktopAIAssistant');
        const desktopAIAssistantCollapse = document.getElementById('desktopAIAssistantCollapse');
        const desktopAIAssistantHeading = desktopAIAssistant
            ? desktopAIAssistant.querySelector('.aIAssistantheading')
            : null;

        // Ai Suggestions (Professional) Copy — event delegation (survives moveAiSuggestions)
        if (desktopAIAssistant) {
            desktopAIAssistant.addEventListener('click', (e) => {
                const btn = e.target.closest('.professionAi .single button, .Otheroptions .single button');
                if (!btn || btn.tagName !== 'BUTTON') return;
                const single = btn.closest('.single');
                const textEl = single && single.querySelector('.text p');
                const text = textEl ? textEl.textContent : '';
                if (!text.trim()) return;
                copyTextToClipboard(text).then((ok) => {
                    if (ok) flashCopied(btn);
                });
            });
        }

        function stripSideviewFromStack() {
            for (let i = popupStack.length - 1; i >= 0; i--) {
                if (popupStack[i] === POPUPS.sideview || popupStack[i] === POPUPS.categoryDetail) {
                    popupStack.splice(i, 1);
                }
            }
        }

        function closeSideviewRestoreDetails() {
            if (showAiSuggestionsSideview) showAiSuggestionsSideview.classList.remove('show');
            if (showAiSuggestionsCategoryview) showAiSuggestionsCategoryview.classList.remove('show');
            if (showAiSuggestionsCategory) showAiSuggestionsCategory.classList.add('show');
            if (showAiSuggestionsWrapper) showAiSuggestionsWrapper.classList.remove('ai-suggestions-inline');
            if (projectdetailsview) projectdetailsview.classList.add('show');
            stripSideviewFromStack();
            if (!popupStack.length) setBodyPopup(false);
        }

        function hideWritingAssistantPhone() {
            if (!isPhone() || !desktopAIAssistant) return;
            desktopAIAssistant.classList.add('ai-wa-hidden');
        }

        function showWritingAssistantPhone() {
            if (!desktopAIAssistant) return;
            desktopAIAssistant.classList.remove('ai-wa-hidden');
        }

        function activateAiAssistantTab() {
            const aiPane = document.getElementById('AiAssistant');
            const chatPane = document.getElementById('ChatSummary');
            const aiTab = document.querySelector('#show-ai-suggestions .nav-link[href="#AiAssistant"]');
            const chatTab = document.getElementById('open-ai-suggestions-sideview');

            if (chatPane) {
                chatPane.classList.remove('active', 'show');
                chatPane.classList.add('fade');
            }
            if (aiPane) {
                aiPane.classList.remove('fade');
                aiPane.classList.add('active', 'show');
            }
            if (chatTab) {
                chatTab.classList.remove('active');
                chatTab.setAttribute('aria-selected', 'false');
            }
            if (aiTab) {
                aiTab.classList.add('active');
                aiTab.setAttribute('aria-selected', 'true');
            }
        }

        function activateChatSummaryTab() {
            const aiPane = document.getElementById('AiAssistant');
            const chatPane = document.getElementById('ChatSummary');
            const aiTab = document.querySelector('#show-ai-suggestions .nav-link[href="#AiAssistant"]');
            const chatTab = document.getElementById('open-ai-suggestions-sideview');

            if (aiPane) {
                aiPane.classList.remove('active', 'show');
                aiPane.classList.add('fade');
            }
            if (chatPane) {
                chatPane.classList.remove('fade');
                chatPane.classList.add('active', 'show');
            }
            if (aiTab) {
                aiTab.classList.remove('active');
                aiTab.setAttribute('aria-selected', 'false');
            }
            if (chatTab) {
                chatTab.classList.add('active');
                chatTab.setAttribute('aria-selected', 'true');
            }
            if (isPhone()) {
                hideWritingAssistantPhone();
            }
        }

        function fillSummaryFromKnowMore(btn) {
            const single = btn && btn.closest('.single');
            const copycontent = single && single.querySelector('.copycontent');
            const summarytext = document.querySelector('#ChatSummary .summarytext');
            if (copycontent && summarytext) {
                summarytext.innerHTML = copycontent.innerHTML;
            }
        }

        function closeAllAiPanelsPhone() {
            if (showAiSuggestionsWrapper) {
                showAiSuggestionsWrapper.classList.remove('show', 'ai-suggestions-inline');
            }
            if (showAiSuggestionsSideview) showAiSuggestionsSideview.classList.remove('show');
            if (aiChatWrapper) aiChatWrapper.classList.remove('show');
            if (aiassistant) aiassistant.classList.remove('show');
            if (showAiSuggestionsCategoryview) showAiSuggestionsCategoryview.classList.remove('show');
            if (showAiSuggestionsCategory) showAiSuggestionsCategory.classList.add('show');

            activateAiAssistantTab();

            if (desktopAIAssistantCollapse) desktopAIAssistantCollapse.classList.remove('show');
            if (desktopAIAssistantHeading) desktopAIAssistantHeading.classList.add('collapsed');
            showWritingAssistantPhone();

            const innerTabsWrapper = document.getElementById('innertabs');
            const innerTabsViewWrapper = document.getElementById('innertabview');
            if (innerTabsViewWrapper) innerTabsViewWrapper.classList.add('d-none');
            if (innerTabsWrapper) innerTabsWrapper.classList.remove('d-none');

            closeAllAiPopups();
        }

        function insertSuggestionText(row) {
            const textEl = row && row.querySelector('.text');
            const text = textEl ? textEl.textContent.trim() : '';
            const messageInput = document.getElementById('chatMessageInput');
            if (!messageInput || !text) return;
            messageInput.value = text;
            messageInput.dispatchEvent(new Event('input', { bubbles: true }));
            messageInput.focus();
            copyTextToClipboard(text);
        }

        // BudgetDiscussion / suggested msg icon+SVG → insert text (all viewports); phone also closes AI panels
        document.querySelectorAll('#innertabview .list .single .icon').forEach((icon) => {
            icon.style.cursor = 'pointer';
            icon.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const row = icon.closest('.single');
                if (isPhone()) closeAllAiPanelsPhone();
                insertSuggestionText(row);
            });
        });

        // Desktop (+ shared): tab / collapse close sideview
        const aiAssistantTabShared = document.querySelector('#show-ai-suggestions .nav-link[href="#AiAssistant"]');
        if (aiAssistantTabShared) {
            aiAssistantTabShared.addEventListener('shown.bs.tab', () => {
                closeSideviewRestoreDetails();
            });
            aiAssistantTabShared.addEventListener('click', () => {
                setTimeout(() => {
                    if (aiAssistantTabShared.classList.contains('active')) {
                        closeSideviewRestoreDetails();
                    }
                }, 0);
            });
        }

        if (showAiSuggestionsWrapper) {
            showAiSuggestionsWrapper.addEventListener('hidden.bs.collapse', () => {
                closeSideviewRestoreDetails();
                showAiSuggestionsWrapper.classList.remove('ai-suggestions-inline');
            });
        }

        // Know more + Copy Summary (desktop + phone)
        document.querySelectorAll('#ai-suggestions-categoryview .list .single h5 button').forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                fillSummaryFromKnowMore(btn);
                activateChatSummaryTab();

                if (isPhone()) {
                    if (showAiSuggestionsSideview) showAiSuggestionsSideview.classList.remove('show');
                    if (showAiSuggestionsCategoryview) showAiSuggestionsCategoryview.classList.remove('show');
                    if (showAiSuggestionsCategory) showAiSuggestionsCategory.classList.add('show');
                    stripSideviewFromStack();

                    if (showAiSuggestionsWrapper) {
                        showAiSuggestionsWrapper.classList.add('show');
                        showAiSuggestionsWrapper.classList.add('ai-suggestions-inline');
                    }
                    setBodyPopup(false);
                }
                // Desktop: keep sideview open; only fill Overview + switch Chat Summary tab
            });
        });

        const copyChatSummaryBtn = document.getElementById('copyChatSummaryBtn');
        if (copyChatSummaryBtn) {
            copyChatSummaryBtn.addEventListener('click', () => {
                const summarytext = document.querySelector('#ChatSummary .summarytext');
                const text = summarytext ? summarytext.textContent : '';
                copyTextToClipboard(text).then((ok) => {
                    if (!ok) return;
                    flashCopied(copyChatSummaryBtn);

                    if (isPhone()) {
                        if (showAiSuggestionsWrapper) {
                            showAiSuggestionsWrapper.classList.remove('show', 'ai-suggestions-inline');
                        }
                        activateAiAssistantTab();
                        showWritingAssistantPhone();
                        setBodyPopup(false);
                    }
                });
            });
        }

        let mobileUiBound = false;
        function syncMobileUi() {
            if (!isPhone()) return;

            if (mobileUiBound) return;
            mobileUiBound = true;

            if (projectdetailsview) projectdetailsview.classList.remove('show');

            const innerTabsWrapper = document.getElementById('innertabs');
            const innerTabsViewWrapper = document.getElementById('innertabview');
            const innerTabs = document.querySelectorAll('#innertabs ul li a');
            if (innerTabsViewWrapper) innerTabsViewWrapper.classList.add('d-none');

            innerTabs.forEach((innerTab) => {
                innerTab.addEventListener('click', () => {
                    if (innerTabsWrapper) innerTabsWrapper.classList.add('d-none');
                    if (innerTabsViewWrapper) innerTabsViewWrapper.classList.remove('d-none');
                });
            });

            const messageInput = document.getElementById('chatMessageInput');

            if (messageInput) {

                messageInput.addEventListener('input', () => {

                    const sendBtn = document.getElementById('chatSendBtn');

                    /*
                    |--------------------------------------------------------------------------
                    | Message has text
                    |--------------------------------------------------------------------------
                    */

                    if (messageInput.value.trim().length > 0) {

                        /*
                        |--------------------------------------------------------------------------
                        | Mobile only
                        | Open AI Writing Assistant automatically
                        |--------------------------------------------------------------------------
                        */

                        if (isPhone()) {

                            // Show AI Writing Assistant
                            showWritingAssistantPhone();

                            // Open the AI Writing Assistant collapse
                            if (desktopAIAssistantCollapse) {
                                desktopAIAssistantCollapse.classList.add('show');
                            }

                            // Remove Bootstrap collapsed state
                            if (desktopAIAssistantHeading) {
                                desktopAIAssistantHeading.classList.remove('collapsed');
                                desktopAIAssistantHeading.setAttribute(
                                    'aria-expanded',
                                    'true'
                                );
                            }

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Send button
                        |--------------------------------------------------------------------------
                        */

                        if (openAIChatButton) {
                            openAIChatButton.classList.add('d-none');
                            openAIChatButton.classList.remove('d-flex');
                        }

                        if (sendBtn) {
                            sendBtn.classList.add('d-flex');
                            sendBtn.classList.remove('d-none');
                        }

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Message empty
                    |--------------------------------------------------------------------------
                    */

                    else {

                        if (openAIChatButton) {
                            openAIChatButton.classList.remove('d-none');
                            openAIChatButton.classList.add('d-flex');
                        }

                        if (sendBtn) {
                            sendBtn.classList.add('d-none');
                            sendBtn.classList.remove('d-flex');
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Do NOT automatically close AI assistant
                        |--------------------------------------------------------------------------
                        | It will remain open after the user has typed.
                        |--------------------------------------------------------------------------
                        */

                    }

                });

            }

        }

        syncMobileUi();
        window.addEventListener('resize', syncMobileUi);

        // --- Move desktop AI assistant between containers ---
        const desktopContainer = document.getElementById('desktopDesktopAIAssistant');
        const mobileContainer = document.getElementById('mobileDesktopAIAssistant');

        function moveAiSuggestions() {
            if (!desktopAIAssistant || !desktopContainer || !mobileContainer) return;
            if (window.innerWidth <= 991) {
                if (!mobileContainer.contains(desktopAIAssistant)) {
                    mobileContainer.appendChild(desktopAIAssistant);
                }
            } else if (!desktopContainer.contains(desktopAIAssistant)) {
                desktopContainer.appendChild(desktopAIAssistant);
            }
        }

        moveAiSuggestions();
        window.addEventListener('resize', moveAiSuggestions);
    })();
</script>
