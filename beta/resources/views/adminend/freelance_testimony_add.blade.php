@extends('adminend/layouts.main')

@section('main-section')
<style>
    .dataTables_filter {
        display: none !important;
    }

    .dataTables_length {
        display: none !important;
    }

    #searchQuery {
        width: 300px;
        /* Adjust the width of the input field */
        height: 40px;
        /* Set the height of the input */
        padding: 5px 10px;
        /* Add padding inside the input */
        font-size: 16px;
        /* Adjust font size */
    }

    #searchBtn {
        height: 40px;
        /* Match the height of the button to the input field */
        padding: 0 20px;
        /* Add horizontal padding to the button */
        font-size: 16px;
        /* Adjust font size */
        background-color: #007bff;
        /* Set the button background color */
        color: white;
        /* Set the text color of the button */
        border: none;
        /* Remove default border */
        cursor: pointer;
        /* Change the cursor to pointer on hover */
    }

    #searchBtn:hover {
        background-color: #0056b3;
        /* Change the button color on hover */
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">

        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Freelance Category</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">Add</li>
                </ul>
            </div>
        </div>

        {{-- Success / Error Messages --}}
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="main-content">

            {{-- Search Section --}}
            <div style="margin-top: 10px;">
                <input type="text" id="searchQuery" placeholder="Enter User Email OR Phone">
                <button id="searchBtn">Search</button>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card stretch stretch-full">

                        <form id="moduleForm" action="{{ route('submit.freelance.testimony.add.form') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label"> User Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="user_name" class="form-control" placeholder="Name" readonly>
                                        <input type="hidden" name="users_id" id="users_id">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">
                                            Content Type <span class="text-danger">*</span>
                                        </label>

                                        <select name="content_type" id="content_type" class="form-control" required>
                                            <option value="" selected disabled>Select Content Type</option>
                                            <option value="text">Text</option>
                                            <option value="video">Video</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Text Content --}}
                                <div class="row" id="textContent" style="display:none;">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">
                                            Content <span class="text-danger">(Max 200 Characters)*</span>
                                        </label>
                                        <textarea name="text_content"
                                            id="text_area"
                                            class="form-control"
                                            rows="4"></textarea>
                                    </div>
                                </div>

                                {{-- Video Content --}}
                                <div class="row" id="videoContent" style="display:none;">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">
                                            Content <span class="text-danger">(Insert TP Stream Link only)*</span>
                                        </label>
                                        <input type="text"
                                            name="video_content"
                                            id="video_input"
                                            class="form-control">
                                    </div>
                                </div>



                                <hr>
                                <button type="submit" class="btn btn-primary">Submit</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#searchBtn').click(function() {
        var searchQuery = $('#searchQuery').val();

        if (searchQuery.length < 2) {
            alert('Please enter at least 2 characters to search.');
            return;
        }

        $('#searchResult').html('Searching...');

        $.ajax({
            url: "{{ route('get.freelance.user.record') }}",
            type: "GET",
            data: {
                searchQuery: searchQuery
            },
            success: function(response) {

                if (response.status) {
                    let user = response.data;

                    // Fill inputs
                    $('#user_name').val(user.name);
                    $('#users_id').val(user.users_id);

                } else {
                    $('#searchResult').html(
                        '<div class="alert alert-warning">No user found.</div>'
                    );

                    $('#user_name').val('');
                    $('#users_id').val('');
                }
            },
            error: function() {
                $('#searchResult').html(
                    '<div class="alert alert-danger">Error fetching data.</div>'
                );
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const contentType = document.getElementById("content_type");
    const textContent = document.getElementById("textContent");
    const videoContent = document.getElementById("videoContent");

    const textArea = document.getElementById("text_area");
    const videoInput = document.getElementById("video_input");

    // Disable both initially
    textArea.disabled = true;
    videoInput.disabled = true;

    contentType.addEventListener("change", function() {
        if (this.value === "text") {
            textContent.style.display = "block";
            videoContent.style.display = "none";

            textArea.disabled = false;
            videoInput.disabled = true;

            textArea.required = true;
            videoInput.required = false;
            videoInput.value = "";
        } 
        else if (this.value === "video") {
            textContent.style.display = "none";
            videoContent.style.display = "block";

            textArea.disabled = true;
            videoInput.disabled = false;

            textArea.required = false;
            videoInput.required = true;
            textArea.value = "";
        }
    });
});

</script>


@endsection