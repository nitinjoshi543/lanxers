@forelse($conversations as $conversation)
@php
$photo = auth()->id() == $conversation->employer_id
? $conversation->freelancer_profile_photo
: $conversation->employer_profile_photo;
@endphp

<div class="single conversation-item {{ $conversation->unread_count > 0 ? 'unread' : '' }}" data-id="{{ $conversation->id }}">
    <div class="image">
        <img src="{{ $photo ?: 'https://idpdefault.s3.ap-south-1.amazonaws.com/6a5f2ca8a9aca.jpg' }}" alt="d" />
    </div>
    <div class="text">
        @if(auth()->id() == $conversation->employer_id)
        <h2>{{ $conversation->freelancer_name }}</h2>
        @else
        <h2>{{ $conversation->employer_name }}</h2>
        @endif
        @if(!empty($conversation->title))
        <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <g clip-path="url(#clip0_998_4813)">
                    <path d="M1.83301 6.6654C1.83301 6.53279 1.78033 6.40562 1.68656 6.31185C1.59279 6.21808 1.46562 6.1654 1.33301 6.1654C1.2004 6.1654 1.07322 6.21808 0.979455 6.31185C0.885687 6.40562 0.833009 6.53279 0.833009 6.6654H1.83301ZM14.1663 9.33207C14.1663 9.46468 14.219 9.59185 14.3128 9.68562C14.4066 9.77939 14.5337 9.83207 14.6663 9.83207C14.799 9.83207 14.9261 9.77939 15.0199 9.68562C15.1137 9.59185 15.1663 9.46468 15.1663 9.33207H14.1663ZM0.903009 3.95007C0.890101 4.08206 0.930155 4.21377 1.01436 4.31623C1.09856 4.41868 1.22002 4.48349 1.35201 4.4964C1.484 4.50931 1.61571 4.46925 1.71817 4.38505C1.82062 4.30085 1.88543 4.17939 1.89834 4.0474L0.903009 3.95007ZM15.0963 12.0474C15.1027 11.982 15.0962 11.9161 15.0771 11.8532C15.058 11.7904 15.0267 11.732 14.985 11.6812C14.9433 11.6305 14.892 11.5885 14.8341 11.5576C14.7762 11.5267 14.7127 11.5075 14.6473 11.5011C14.582 11.4947 14.516 11.5012 14.4532 11.5203C14.3904 11.5394 14.3319 11.5707 14.2812 11.6124C14.1787 11.6966 14.1139 11.8181 14.101 11.9501L15.0963 12.0474ZM9.33301 14.1654H6.66634V15.1654H9.33301V14.1654ZM1.83301 9.33207V6.6654H0.833009V9.33207H1.83301ZM14.1663 9.04073V9.33207H15.1663V9.04073H14.1663ZM9.92701 3.07274L12.5663 5.44807L13.235 4.70407L10.5963 2.32873L9.92701 3.07274ZM15.1663 9.04073C15.1663 7.91473 15.1763 7.2014 14.893 6.56407L13.979 6.9714C14.1563 7.37007 14.1663 7.82673 14.1663 9.04073H15.1663ZM12.5663 5.44807C13.4683 6.26007 13.8017 6.5734 13.979 6.9714L14.893 6.56407C14.609 5.92607 14.0723 5.4574 13.235 4.70407L12.5663 5.44807ZM6.68634 1.83207C7.74101 1.83207 8.13901 1.84007 8.49301 1.97607L8.85168 1.04274C8.28368 0.824068 7.66501 0.832068 6.68634 0.832068V1.83207ZM10.5963 2.3294C9.87234 1.67807 9.41967 1.26007 8.85168 1.04274L8.49368 1.97607C8.84834 2.11207 9.14701 2.37074 9.92701 3.07274L10.5963 2.3294ZM6.66634 14.1654C5.39501 14.1654 4.49234 14.1641 3.80634 14.0721C3.13634 13.9821 2.74968 13.8127 2.46768 13.5307L1.76101 14.2374C2.25968 14.7374 2.89234 14.9581 3.67368 15.0634C4.44034 15.1667 5.42368 15.1654 6.66634 15.1654V14.1654ZM0.833009 9.33207C0.833009 10.5747 0.831675 11.5574 0.935009 12.3247C1.04034 13.1061 1.26168 13.7387 1.76034 14.2381L2.46701 13.5314C2.18568 13.2487 2.01634 12.8621 1.92634 12.1914C1.83434 11.5067 1.83301 10.6034 1.83301 9.33207H0.833009ZM9.33301 15.1654C10.5757 15.1654 11.5583 15.1667 12.3257 15.0634C13.107 14.9581 13.7397 14.7367 14.239 14.2381L13.5323 13.5314C13.2497 13.8127 12.863 13.9821 12.1923 14.0721C11.5077 14.1641 10.6043 14.1654 9.33301 14.1654V15.1654ZM6.68634 0.832068C5.43634 0.832068 4.44901 0.830735 3.67901 0.934068C2.89434 1.0394 2.25968 1.26074 1.76034 1.7594L2.46701 2.46607C2.74968 2.18474 3.13701 2.0154 3.81168 1.9254C4.50034 1.8334 5.40834 1.83207 6.68634 1.83207V0.832068ZM1.89834 4.0474C1.97901 3.22474 2.15301 2.78073 2.46768 2.46674L1.76101 1.76007C1.20368 2.31607 0.992342 3.0394 0.903009 3.95007L1.89834 4.0474ZM14.101 11.9501C14.0203 12.7727 13.8457 13.2167 13.5317 13.5307L14.2383 14.2374C14.7957 13.6814 15.007 12.9581 15.0963 12.0474L14.101 11.9501Z" fill="#00A148" />
                    <path d="M8.66602 1.66406V3.33073C8.66602 4.90206 8.66602 5.68806 9.15402 6.17606C9.64202 6.66406 10.428 6.66406 11.9993 6.66406H14.666" stroke="#00A148" stroke-width="1.5" />
                </g>
                <defs>
                    <clipPath id="clip0_998_4813">
                        <rect width="16" height="16" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span>{{ $conversation->title }}</span>
        </h3>
        @endif
        <!-- <p>{{ $conversation->last_message ?? 'No messages yet.' }}</p> -->
        <h6>{{ $conversation->message_time ? \Carbon\Carbon::parse($conversation->message_time)->diffForHumans() : '' }}</h6>
    </div>
    <div class="badge">
        @if($conversation->unread_count > 0)
        <div class="counter">{{ $conversation->unread_count }}</div>
        @endif
    </div>
</div>
<hr />
@empty
<div class="notconvotyet">
    <div class="image">
        <img src="./assets/images/nocovo.png" alt="nocovo" />
    </div>
    <h4>No conversation yet !</h4>
    <p>Once you start connecting , You will get the messages here.</p>
</div>
@endforelse


<script>
    $(document).on("click", "#chatmenu .chatslist .single", function() {

        $("#chatscreen").addClass("show");
        $("#chatmenu").removeClass("show");

    });

    // Back button (works even after AJAX)
    document.addEventListener('click', function(e) {

        if (e.target.closest('#openchatscreen')) {

            chatmenu.classList.add('show');
            chatscreen.classList.remove('show');

        }

    });

    $(document).on("click", ".chat-filter", function(e) {

        e.preventDefault();

        $(".chat-filter").removeClass("active");
        $(this).addClass("active");

        let filter = $(this).data("filter");

        if (filter === "all") {

            $(".conversation-item").show();
            $(".chatslist hr").show();

        } else if (filter === "unread") {

            $(".conversation-item").hide();
            $(".chatslist hr").hide();

            $(".conversation-item.unread").show();
            $(".conversation-item.unread").next("hr").show();

        }

    });
</script>