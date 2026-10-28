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
                    <h5 class="m-b-10">Instructor</h5>
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
                        <a href="{{ route('instructor.add') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>&nbsp;&nbsp;
                            <span> Add New </span>
                        </a>
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
                                    <input type="text" id="searchQuery" name="searchQuery" placeholder="Enter Title">
                                    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                                    <button id="searchBtn">Search</button>
                                </div>
                                <table class="table table-hover" id="userList">
                                    <thead>
                                        <tr>
                                            <th>Instructor</th>
                                            <th>Title</th>
                                            <th>Designation</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                url: "{{ route('get.instructor.list') }}", // Route to fetch data
                type: "GET",
                data: function(d) {
                    d.searchQuery = $('#searchQuery').val(); // Pass search value manually
                }
            },
            columns: [{
                    data: 'eduvince_instructor_id',
                    render: function(data, type, row) {
                        if (data === 0) {
                            return `<p>IDP</p>`;
                        } else {
                            return `<p>Eduvince</p>`;
                        }
                    }
                },
                {
                    data: 'title'
                },
                {
                    data: 'designation'
                },
                {
                    data: 'image',
                    render: function(data, type, row) {
                        if (data) {
                            return `<img src="${data}" alt="Image" height="100px" width="100px">`;
                        } else {
                            return 'No Image';
                        }
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        if (data === 1) {
                            return `<button class="btn btn-success" onclick="StatusAjax(this, 0, ${row.id});">Enable</button>`;
                        } else {
                            return `<button class="btn btn-danger" onclick="StatusAjax(this, 1, ${row.id});">Disable</button>`;
                        }
                    }
                },
                {
                    data: null,
                    defaultContent: "", // Prevent DataTable from breaking
                    render: function(data, type, row) {
                        return `
                            <a href="${baseUrl}/admin/edit-instructor/${row.id}" target="_blank">
                                <p class="fa fa-pencil fa-lg nav_icon" title="Edit"></p>
                            </a>`;
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
    function StatusAjax(e, status, id) {
        $.ajax({
            type: "POST",
            url: "{{ route('instructor.setstatus') }}",
            data: {
                _token: "{{ csrf_token() }}", // Include CSRF token for security
                status: status,
                id: id,
            },
            success: function(data) {
                var html = '';
                var buttonClass = status === 1 ? 'btn btn-success' : 'btn btn-danger';
                var buttonText = status === 1 ? 'Enable' : 'Disable';

                if (data === '1') {
                    // On success, change the button to "Disable" (i.e. status 1)
                    html = `<button class="${buttonClass}" onclick="StatusAjax(this, 0, ${id});">${buttonText}</button>`;
                } else if (data === '0') {
                    // On success, change the button to "Enable" (i.e. status 0)
                    html = `<button class="${buttonClass}" onclick="StatusAjax(this, 1, ${id});">${buttonText}</button>`;
                }

                // Replace the button in the table
                $(e).replaceWith(html);
            },
            error: function(xhr, status, error) {
                console.log('Error:', error); // Log any errors in the console
            }
        });
    }
</script>
@endsection