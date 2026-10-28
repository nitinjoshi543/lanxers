@extends('adminend/layouts.main')

@section('main-section')
@php
$userData = session('user_data');
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
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
<div id="loader" style="display:none;">
    <p>Please wait...</p>
</div>
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Creator</h5>
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
                    <!-- <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('sunday.blockbuster.add') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>&nbsp;&nbsp;
                            <span> Add New </span>
                        </a>
                    </div> -->
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                                    <input type="text" id="searchQuery" name="searchQuery" placeholder="Enter email">
                                    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                                    <button id="searchBtn">Search</button>
                                </div>
                                <table class="table table-hover" id="userList">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Resume</th>
                                            <th>Project Link</th>
                                            <th>Status</th>
                                            <th class="align-items-center justify-content-center">Action</th>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var baseUrl = "{{ url('/') }}";
        var table = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.creator.list') }}", // Route to fetch data
                type: "GET",
                data: function(d) {
                    d.searchQuery = $('#searchQuery').val(); // Pass search value manually
                }
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1 + (table.page() * table.page.len()); // Correct S. No. with pagination
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'resume',
                    render: function(data, type, row) {
                        return `<a href="${row.resume}" target="_blank">
                                <p>Click Here to View Resume</p>
                            </a>`;
                    }
                },
                {
                    data: 'portfolio_link',
                    render: function(data, type, row) {

                        if (!row.portfolio_link) {
                            return '';
                        }

                        let links = row.portfolio_link;

                        try {
                            links = JSON.parse(links);
                        } catch (e) {
                            // Ignore parsing error
                        }

                        // If single string, make it an array
                        if (typeof links === 'string') {
                            links = links.split(',');
                        }

                        // If object, convert values to array
                        if (!Array.isArray(links) && typeof links === 'object') {
                            links = Object.values(links);
                        }

                        // Final safety check
                        if (!Array.isArray(links)) {
                            return '';
                        }

                        return links.map(link => `
            <a href="${link.trim()}" target="_blank">
                Click Here to View Project Link
            </a>
        `).join('<br>');
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        if (data === 0) {
                            return `<button class="btn btn-success");">No Action Taken</button>`;
                        } else {
                            return `<button class="btn btn-danger");">Accepted</button>`;
                        }
                    }
                },
                {
                    data: 'null',
                    render: function(data, type, row) {
                        return `
                            <div class="d-flex align-items-center justify-content-center">

                                <button class="btn btn-success btn-sm approveBtn"
                                    data-id="${row.users_id}"
                                    data-name="${row.name}"
                                    data-email="${row.email}"
                                    data-status="approved">
                                    Approve
                                </button>

                                <span class="mx-2 fw-bold">|</span>

                                <button class="btn btn-danger btn-sm disapproveBtn"
                                    data-id="${row.users_id}"
                                    data-name="${row.name}"
                                    data-email="${row.email}"
                                    data-status="disapproved">
                                    Disapprove
                                </button>

                            </div>
                        `;
                    }
                }
            ]
        });

        // Handle Search Button Click
        $('#searchBtn').click(function() {
            var searchQuery = $('#searchQuery').val();
            if (searchQuery.length >= 2) {
                table.ajax.reload(); // Reload DataTable with new search filter
            } else {
                alert('Please enter at least 2 characters to search.');
            }
        });
    });
</script>

<script>
    $(document).on('click', '.approveBtn, .disapproveBtn', function() {

        let btn = $(this);

        btn.prop('disabled', true).text('Processing...');
        $('#loader').show();

        $.ajax({
            url: "/admin/creator-approval",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                user_id: btn.data('id'),
                name: btn.data('name'),
                email: btn.data('email'),
                status: btn.data('status')
            },
            success: function(response) {
                location.reload();
            },
            error: function() {
                $('#loader').hide();
                btn.prop('disabled', false).text(btn.data('status') == 'approved' ? 'Approve' : 'Disapprove');
                alert('Something went wrong.');
            }
        });

    });
</script>
@endsection