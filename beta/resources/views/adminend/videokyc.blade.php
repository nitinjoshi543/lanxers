@extends('adminend/layouts.main')

@section('main-section')
@php
$userData = session('user_data');
@endphp
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
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Video KYC Module</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">

                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div style="margin-top: 10px;">
                                    <input type="text" id="searchQuery" name="searchQuery" placeholder="Enter User Email">
                                    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                                    <button id="searchBtn">Search</button>
                                </div>
                                <table class="table table-hover" id="userList">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Created On</th>
                                            <th>Video</th>
                                            <th class="d-flex align-items-center justify-content-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="proposalBody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Video Preview</h5>

                <button class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <video
                    id="previewVideo"
                    width="100%"
                    controls>

                    <source id="videoSource" src="">
                </video>

            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const userData = @json($userData);
</script>
<script>
    var table;

    $(document).ready(function() {
        var baseUrl = "{{ url('/') }}";
        let columns = [

            {
                data: 'name',
                defaultContent: '-'
            },

            {
                data: 'email',
                defaultContent: '-'
            },

            {
                data: 'phone',
                defaultContent: '-'
            },

            {
                data: 'created_on',
                defaultContent: '-'
            },

            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {

                    return `
                <button
                    class="btn btn-primary btn-sm viewVideo"
                    data-video="${row.s3_video_url}">
                    View Video
                </button>
            `;
                }
            },

            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {

                    return `
            <div class="d-flex align-items-center justify-content-center">
                <button class="btn btn-success btn-sm approveBtn"
                    data-id="${row.user_id}">
                    Approve
                </button>

                <span class="mx-2 fw-bold">|</span>

                <button class="btn btn-danger btn-sm disapproveBtn"
                    data-id="${row.user_id}">
                    Disapprove
                </button>
            </div>
        `;
                }
            }

        ];


        table = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.user.videokyc.list') }}", // Route to fetch data
                type: "GET",
                data: function(d) {
                    d.searchQuery = $('#searchQuery').val(); // Pass search value manually
                }
            },
            columns: columns
        });

        // Handle Search Button Click
        $('#searchBtn').click(function() {
            var searchQuery = $('#searchQuery').val();
            if (searchQuery.length >= 10) {
                table.ajax.reload(); // Reload DataTable with new search filter
            } else {
                alert('Please enter at least 10 characters to search.');
            }
        });

        $("#searchQuery").on("keypress", function(e) {
            if (e.which === 13) { // Enter key
                e.preventDefault();
                $("#searchBtn").click(); // just trigger the click event
            }
        });
    });

    $(document).on('click', '.viewVideo', function() {

        let video = $(this).data('video');

        $('#videoSource').attr('src', video);

        $('#previewVideo')[0].load();

        $('#videoModal').modal('show');

    });

    $('#videoModal').on('hidden.bs.modal', function() {

        $('#previewVideo')[0].pause();

        $('#videoSource').attr('src', '');

        $('#previewVideo')[0].load();

    });

    $(document).on('click', '.approveBtn', function() {

        if (!confirm('Are you sure you want to approve this Video KYC?')) {
            return;
        }

        updateVideoKyc($(this).data('id'), 1);

    });

    $(document).on('click', '.disapproveBtn', function() {

        if (!confirm('Are you sure you want to disapprove this Video KYC?')) {
            return;
        }

        updateVideoKyc($(this).data('id'), 2);

    });

    function updateVideoKyc(userId, status) {
        $.ajax({

            url: "{{ route('mannual.approve.videokyc') }}",

            type: "GET",

            data: {
                users_id: userId,
                status: status
            },

            beforeSend: function() {
                $("#pageLoader").show();
            },

            success: function(response) {

                $("#pageLoader").hide();

                alert(response.message);

                table.ajax.reload(null, false);

            },

            error: function() {

                $("#pageLoader").hide();

                alert("Something went wrong.");

            }

        });
    }
</script>

<div id="pageLoader" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,.7);z-index:99999;">
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
        <div class="spinner-border text-primary"></div>
        <p class="mt-2">Please wait...</p>
    </div>
</div>
@endsection