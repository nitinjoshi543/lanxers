@php
$otherUserName = auth()->id() == $conversation->employer_id
? $conversation->freelancer_name
: $conversation->employer_name;
@endphp

<div class="proposalnotice">
    <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
            <path d="M30.3 13.4015L23.2 20.5015C22.7166 20.9815 22.4766 21.2232 22.27 21.4882C22.0255 21.8015 21.8178 22.1382 21.6466 22.4982C21.5016 22.8015 21.395 23.1232 21.18 23.7682L20.4916 25.8348L20.2683 26.5032L20.0466 27.1732C19.995 27.3287 19.9877 27.4955 20.0254 27.6549C20.0631 27.8144 20.1445 27.9602 20.2604 28.0761C20.3762 28.192 20.5221 28.2733 20.6815 28.3111C20.841 28.3488 21.0078 28.3415 21.1633 28.2898L21.8316 28.0665L22.5 27.8432L24.5666 27.1548C25.2116 26.9398 25.5333 26.8332 25.8366 26.6882C26.1966 26.517 26.5333 26.3093 26.8466 26.0648C27.1116 25.8582 27.3516 25.6182 27.835 25.1348L34.935 18.0348L35.7066 17.2615C36.3211 16.6468 36.6662 15.8133 36.666 14.9442C36.6658 14.0752 36.3205 13.2417 35.7058 12.6273C35.0912 12.0129 34.2576 11.6678 33.3886 11.668C32.5195 11.6681 31.6861 12.0135 31.0716 12.6282L30.3 13.4015ZM30.3 13.4015C30.3 13.4015 30.3966 15.0415 31.845 16.4898C33.2933 17.9382 34.935 18.0348 34.935 18.0348M20.2683 26.5032L21.8316 28.0665" stroke="#00A148" stroke-width="2" />
            <path d="M13.3333 21.6673H17.5M13.3333 15.0007H24.1667M13.3333 28.334H15.8333M33.0467 5.28732C31.095 3.33398 27.9517 3.33398 21.6667 3.33398H18.3333C12.0483 3.33398 8.905 3.33398 6.95333 5.28732C5.00167 7.24065 5 10.3823 5 16.6673V23.334C5 29.619 5 32.7623 6.95333 34.714C8.90667 36.6656 12.0483 36.6673 18.3333 36.6673H21.6667C27.9517 36.6673 31.095 36.6673 33.0467 34.714C34.62 33.1423 34.925 30.8007 34.985 26.6673" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
        </svg>
    </div>
    <div class="line"></div>
    <div class="text">
        <h4><span>{{ $conversation->freelancer_name }}</span> has send you the proposal </h4>
        <p>He believes he is the right fit for this job.</p>
    </div>
    <button data-bs-toggle="modal" data-bs-target="#proposalModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M6.00004 2.97272C6.64674 2.76726 7.32149 2.66379 8.00004 2.66605C10.788 2.66605 12.6854 4.33272 13.8167 5.80205C14.3834 6.53939 14.6667 6.90672 14.6667 7.99939C14.6667 9.09272 14.3834 9.46005 13.8167 10.1967C12.6854 11.6661 10.788 13.3327 8.00004 13.3327C5.21204 13.3327 3.31471 11.6661 2.18337 10.1967C1.61671 9.46072 1.33337 9.09205 1.33337 7.99939C1.33337 6.90605 1.61671 6.53872 2.18337 5.80205C2.52904 5.3506 2.91387 4.93053 3.33337 4.54672" stroke="white" stroke-width="1.5" stroke-linecap="round" />
            <path d="M10 8C10 8.53043 9.78929 9.03914 9.41421 9.41421C9.03914 9.78929 8.53043 10 8 10C7.46957 10 6.96086 9.78929 6.58579 9.41421C6.21071 9.03914 6 8.53043 6 8C6 7.46957 6.21071 6.96086 6.58579 6.58579C6.96086 6.21071 7.46957 6 8 6C8.53043 6 9.03914 6.21071 9.41421 6.58579C9.78929 6.96086 10 7.46957 10 8Z" stroke="white" stroke-width="1.5" />
        </svg>
        <span>View Proposal</span>
    </button>
</div>


<div class="modal fade" id="proposalModal" data-bs-backdrop="false" tabindex="-1" aria-labelledby="proposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="heading">
                    <div class="text">
                        <h1 id="proposalModalLabel">Proposal Detail</h1>
                        @if(auth()->id() == $conversation->employer_id)
                        <p>Review the proposal submitted by Freelancer.</p>
                        @else
                        <p>Review the proposal submitted by Freelancer.</p>
                        @endif
                    </div>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" rx="12" fill="#EFF1F2" />
                            <path d="M8.46387 15.5348L15.5359 8.46484M8.46387 8.46484L15.5359 15.5348" stroke="black" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <div class="freelancercard">
                    <div class="image">
                        <img src="{{ $proposal->profile_photo ?: 'https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg' }}" alt="" />
                    </div>
                    <div class="text">
                        <h2>{{ $proposal->freelancer_name }}</h2>
                        <h6>{{ $proposal->job_title }}</h6>

                    </div>
                    <div class="amount">
                        <h6>Proposed Budget</h6>
                        <h5>₹ {{ number_format($proposal->bid_amount) }}</h5>
                    </div>
                </div>
                <div class="projectdescripition">
                    <h4>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_2904_24687)">
                                    <path d="M5.71125 16.1763C6.86875 16.2192 8.29167 16.25 10 16.25C13.0712 16.25 15.2187 16.1508 16.5633 16.0571C17.6258 15.9833 18.4546 15.19 18.5475 14.1292C18.65 12.9667 18.75 11.2021 18.75 8.75C18.75 6.29792 18.65 4.53292 18.5475 3.37083C18.4546 2.31 17.6258 1.51667 16.5633 1.44292C15.2187 1.34917 13.0717 1.25 10 1.25C6.92833 1.25 4.78125 1.34917 3.43667 1.44292C2.37417 1.51667 1.54542 2.31 1.4525 3.37083C1.35 4.53333 1.25 6.29792 1.25 8.75V18.1883C1.25 18.9 2.085 19.2842 2.62583 18.8208L5.71125 16.1763Z" stroke="#9E00BA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M13.0916 9.19667C13.0175 10.1517 12.5416 10.7142 11.6175 11.23C11.4175 11.3417 11.332 11.5879 11.455 11.7812C11.5695 11.9608 11.7258 12.1767 11.9083 12.3512C12.0654 12.5012 12.295 12.5321 12.5029 12.4679C13.98 12.0138 15.2837 10.9621 15.407 9.19708H15.4166V7.10167C15.4166 6.62417 15.4104 6.24958 15.402 5.96C15.387 5.43792 15.0108 5.04167 14.4891 5.02083C14.1995 5.00833 13.8216 5 13.3333 5C12.845 5 12.467 5.00875 12.1775 5.02042C11.6558 5.04208 11.2795 5.43792 11.2645 5.95958C11.2562 6.25167 11.25 6.63042 11.25 7.11375C11.2495 7.47629 11.2538 7.83882 11.2629 8.20125C11.2775 8.75542 11.6925 9.17125 12.2466 9.18542C12.5282 9.19214 12.8099 9.19589 13.0916 9.19667Z" stroke="#9E00BA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.42495 9.19667C6.35079 10.1517 5.87495 10.7142 4.95079 11.23C4.75079 11.3417 4.66537 11.5879 4.78829 11.7812C4.90287 11.9608 5.05912 12.1767 5.24162 12.3512C5.3987 12.5012 5.62829 12.5321 5.8362 12.4679C7.31329 12.0138 8.61704 10.9621 8.74037 9.19708H8.74995V7.10167C8.74995 6.62417 8.7437 6.24958 8.73537 5.96C8.72037 5.43792 8.34412 5.04167 7.82245 5.02083C7.53287 5.00833 7.15495 5 6.66662 5C6.17829 5 5.80037 5.00875 5.51079 5.02042C4.98912 5.04208 4.61287 5.43792 4.59787 5.95958C4.58954 6.25167 4.58329 6.63042 4.58329 7.11375C4.58281 7.47629 4.58712 7.83882 4.5962 8.20125C4.61079 8.75542 5.02579 9.17125 5.57995 9.18542C5.86157 9.19214 6.14326 9.19589 6.42495 9.19667Z" stroke="#9E00BA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_2904_24687">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <span>Project Description</span>
                    </h4>
                    <div class="descripition">
                        <p>{{ $proposal->cover_letter }}</p>
                    </div>
                </div>
                <div class="attachment">
                    <h4>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="17" viewBox="0 0 15 17" fill="none">
                                <path d="M13.7178 7.16457L6.94137 13.941C5.63912 15.2433 3.52958 15.2433 2.22733 13.941C0.925074 12.6388 0.925074 10.5292 2.22733 9.22696L9.59302 1.86127C9.98373 1.47057 10.5136 1.25107 11.0662 1.25107C11.6187 1.25107 12.1486 1.47057 12.5393 1.86127C12.93 2.25197 13.1495 2.78187 13.1495 3.3344C13.1495 3.88694 12.93 4.41684 12.5393 4.80754L6.35212 10.9947C6.02803 11.3188 5.4977 11.3188 5.17361 10.9947C4.84952 10.6706 4.84952 10.1403 5.17361 9.81622L10.7715 4.21829L9.88765 3.33441L4.28972 8.93233C3.89902 9.32303 3.67953 9.85294 3.67953 10.4055C3.67953 10.958 3.89902 11.4879 4.28972 11.8786C4.68042 12.2693 5.21033 12.4888 5.76286 12.4888C6.3154 12.4888 6.8453 12.2693 7.236 11.8786L13.4232 5.69143C14.7254 4.38917 14.7254 2.27964 13.4232 0.977383C12.1209 -0.324873 10.0114 -0.324872 8.70914 0.977382L1.34345 8.34308C-0.447892 10.1344 -0.447892 13.0336 1.34345 14.8249C3.13478 16.6162 6.03392 16.6162 7.82526 14.8249L14.6017 8.04845L13.7178 7.16457Z" fill="#105BFB" />
                            </svg>
                        </span>
                        <span>Attachment ({{ count($proposal->attachments) }})</span>
                    </h4>
                    <div class="uploadedfile">
                        <div class="row">
                            @forelse($proposal->attachments as $attachment)
                            @php
                            $fileExt = strtolower(pathinfo($attachment->file_name, PATHINFO_EXTENSION));
                            @endphp
                            <div class="col-4">
                                <div class="single">
                                    <div class="icon">
                                        @if($fileExt === 'pdf')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <rect width="30" height="30" rx="7" fill="#FDECEC" />
                                            <path d="M9 7.5H16.5L21 12V22.5H9V7.5Z" fill="#E53935" />
                                            <path d="M16.5 7.5V12H21" fill="#FF8A80" />
                                            <text x="15" y="20" text-anchor="middle" fill="#fff" font-size="6" font-family="Inter,Arial" font-weight="700">PDF</text>
                                        </svg>
                                        @elseif(in_array($fileExt, ['doc', 'docx'], true))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <rect width="30" height="30" rx="7" fill="#E8F1FB" />
                                            <path d="M9 7.5H16.5L21 12V22.5H9V7.5Z" fill="#2B579A" />
                                            <path d="M16.5 7.5V12H21" fill="#7BA3D4" />
                                            <text x="15" y="20" text-anchor="middle" fill="#fff" font-size="5.5" font-family="Inter,Arial" font-weight="700">DOC</text>
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <rect width="30" height="30" rx="7" fill="#E8F8EE" />
                                            <path d="M8.5 20.5L12.2 15.8L15.1 19.1L19.2 13.5L21.5 20.5H8.5Z" fill="#00A148" />
                                            <circle cx="12" cy="11" r="1.6" fill="#00A148" />
                                            <rect x="8" y="8" width="14" height="14" rx="2" stroke="#00A148" stroke-width="1.5" fill="none" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="text">
                                        <h2>{{ $attachment->file_name }}</h2>
                                        <p>{{ number_format($attachment->file_size / 1024, 2) }} KB</p>
                                    </div>
                                    <a href="{{ $attachment->file_path }}" target="_blank" class="download-file" data-index="0" title="download file">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M4 14H12M8 2V11.3333M4.66667 8L8 11.3333L11.3333 8" stroke="#00A148" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @empty

                            <div class="col-12">
                                <p class="text-muted">No attachments uploaded.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>


                <div class="modalfooter">
                    @if(auth()->id() == $conversation->employer_id)

                    @if($proposal->status == 'pending')
                    <a href="javascript:void(0)"
                        class="proposal-action"
                        data-id="{{ $proposal->id }}"
                        data-action="rejected">
                        Reject
                    </a>

                    <a href="javascript:void(0)"
                        class="proposal-action"
                        data-id="{{ $proposal->id }}"
                        data-action="accepted">
                        <span>Accept Proposal</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10" fill="none">
                            <path d="M7.75 0.749999L11.75 4.75L7.75 8.75M11.75 4.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    @elseif($proposal->status == 'accepted')

                    <span class="badge bg-success">Accepted</span>

                    @elseif($proposal->status == 'rejected')

                    <span class="badge bg-danger">Rejected</span>

                    @endif
                    @else

                    @if($proposal->status == 'pending')
                    <span class="badge bg-warning">Waiting for employer response</span>
                    @elseif($proposal->status == 'accepted')
                    <span class="badge bg-success">Proposal Accepted</span>
                    @elseif($proposal->status == 'rejected')
                    <span class="badge bg-danger">Proposal Rejected</span>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const proposalStatusUrl = "{{ route('employer.proposal.status', ['proposal' => '__ID__']) }}";
</script>

<script>
    $(document).on('click', '.proposal-action', function(e) {
        e.preventDefault();

        let proposalId = $(this).data('id');
        let action = $(this).data('action');

        if (!confirm(`Are you sure you want to ${action} this proposal?`)) {
            return;
        }

        showLoder();
        const csrfToken = "{{ csrf_token() }}";

        let url = proposalStatusUrl.replace('__ID__', proposalId);

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                 _token: csrfToken,
                action: action
            },
            success: function(res) {
                if (res.status) {
                    alert(res.message);
                    location.reload();
                } else {
                    hideLoder();
                    alert(res.message);
                }
            },
            error: function(xhr) {
                hideLoder();
                if (xhr.responseJSON) {
                    alert(xhr.responseJSON.message);
                } else {
                    alert('Something went wrong.');
                }
            }
        });
    });
</script>