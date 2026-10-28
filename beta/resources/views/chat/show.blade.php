@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="container py-4">



    <a href="{{ route('chat.index') }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to conversations</a>



    <div class="card">

        <div class="card-header">

            <div class="fw-semibold">{{ $conversation->title }}</div>

            <div class="small text-muted">

                @if(auth()->id() == $conversation->employer_id)

                Chat with {{ $conversation->freelancer_name }}

                @else

                Chat with {{ $conversation->employer_name }}

                @endif

            </div>

        </div>



        <div class="card-body" id="message-list" style="height: 420px; overflow-y: auto;">

            <div class="text-muted small" id="loading-msg">Loading messages...</div>

        </div>



        <div class="card-footer">



            {{-- Reply preview --}}

            <div id="reply-preview" class="small text-muted mb-2 d-none">

                Replying to: <span id="reply-preview-text"></span>

                <a href="#" id="cancel-reply" class="ms-2">cancel</a>

            </div>



            {{-- Tests: POST /chat/upload --}}

            <div id="upload-progress" class="small text-muted mb-2 d-none">Uploading...</div>



            <form id="send-message-form" class="d-flex gap-2">

                @csrf

                <input type="hidden" id="conversation-id" value="{{ $conversation->id }}">

                <input type="hidden" id="reply-message-id" value="">



                <label class="btn btn-outline-secondary mb-0" title="Attach file">

                    📎

                    <input type="file" id="attachment-input" class="d-none">

                </label>



                <input type="text"

                    id="message-input"

                    class="form-control"

                    placeholder="Type a message..."

                    maxlength="5000"

                    autocomplete="off">



                <button type="submit" class="btn btn-primary">Send</button>

            </form>

        </div>

    </div>

</div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>



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



        function renderMessage(msg) {

            const isMine = Number(msg.sender_id) === Number(currentUserId);



            const align = isMine

                ?
                'justify-content-end'

                :
                'justify-content-start';



            const bubbleClass = isMine

                ?
                'bg-primary text-black'

                :
                'bg-light';



            let replyHtml = '';

            if (msg.reply_message_id) {

                replyHtml = `<div class="small border-start ps-2 mb-1 opacity-75">Reply to #${msg.reply_message_id}</div>`;

            }



            let attachmentHtml = '';

            if (msg.message_type === 'file' && msg.file_name) {

                attachmentHtml = `

                <div class="mt-1">

                    <a href="/chat/download/${msg.id}" class="small ${isMine ? 'text-white' : ''}">

                        📎 ${msg.original_name} (${Math.round(msg.file_size / 1024)} KB)

                    </a>

                </div>`;

            }



            return `

            <div class="d-flex ${align} mb-2" data-message-id="${msg.id}">

                <div class="p-2 rounded ${bubbleClass}" style="max-width: 70%;">

                    <div class="small fw-semibold">${isMine ? 'You' : msg.name}</div>

                    ${replyHtml}

                    <div>${$('<div>').text(msg.message).html()}</div>

                    ${attachmentHtml}

                    <div class="small opacity-75 text-end">${new Date(msg.created_at).toLocaleTimeString()}</div>

                </div>

            </div>`;

        }



        // Tests: GET /chat/messages/{conversation}

        function loadMessages() {

            $.get(`/chat/messages/${conversationId}`, function(res) {

                $('#loading-msg').remove();

                if (res.status) {

                    messageList.html('');



                    $.each(res.messages, function(index, msg) {



                        messageList.append(renderMessage(msg));



                    });



                    messageList.scrollTop(messageList[0].scrollHeight);

                }

            }).fail(function(xhr) {

                messageList.html(`<div class="text-danger small">Failed to load messages (${xhr.status})</div>`);

            });

        }



        // Tests: POST /chat/send

        $('#send-message-form').on('submit', function(e) {

            e.preventDefault();



            const text = $('#message-input').val().trim();

            const file = $('#attachment-input')[0].files[0];



            if (file) {

                uploadAttachment(file, text);

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

                    $('#message-input').val('');

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

        function uploadAttachment(file, message) {

            const formData = new FormData();

            formData.append('_token', "{{ csrf_token() }}");

            formData.append('conversation_id', conversationId);

            formData.append('file', file);

            if (message) formData.append('message', message);



            $('#upload-progress').removeClass('d-none');



            $.ajax({

                url: "{{ route('chat.upload') }}",

                type: 'POST',

                data: formData,

                processData: false,

                contentType: false,

                success: function(res) {

                    $('#upload-progress').addClass('d-none');

                    if (res.status) {

                        $('#message-input').val('');

                        $('#attachment-input').val('');

                        loadMessages();

                    } else {

                        alert(res.message || 'Upload failed.');

                    }

                },

                error: function(xhr) {

                    $('#upload-progress').addClass('d-none');

                    alert('Upload failed: ' + xhr.status);

                }

            });

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



        $('#attachment-input').on('change', function() {

            if (this.files[0]) {

                $('#message-input').attr('placeholder', 'Attached: ' + this.files[0].name);

            }

        });



        // Load old messages

        loadMessages();



        // Mark conversation as read

        markRead();



        // Subscribe to websocket

        window.Echo
            .private('conversation.' + conversationId)
            .listen('.message.sent', function(e) {
                console.log(e);
                if (Number(e.message.sender_id) !== Number(currentUserId)) {

                    messageList.append(renderMessage(e.message));

                    messageList.scrollTop(messageList[0].scrollHeight);

                }
            });
    });
</script>