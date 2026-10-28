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
                    <h5 class="m-b-10">User Module</h5>
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
                        <!-- <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            <i class="feather-bar-chart"></i>
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 12" data-bs-auto-close="outside">
                                <i class="feather-filter"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-eye me-3"></i>
                                    <span>All</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-send me-3"></i>
                                    <span>Sent</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-book-open me-3"></i>
                                    <span>Open</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-archive me-3"></i>
                                    <span>Draft</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-bell me-3"></i>
                                    <span>Revised</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-shield-off me-3"></i>
                                    <span>Declined</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-check me-3"></i>
                                    <span>Accepted</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-briefcase me-3"></i>
                                    <span>Leads</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-wifi-off me-3"></i>
                                    <span>Expired</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-users me-3"></i>
                                    <span>Customers</span>
                                </a>
                            </div>
                        </div> -->
                        <!-- <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 12" data-bs-auto-close="outside">
                                <i class="feather-paperclip"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-pdf me-3"></i>
                                    <span>PDF</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-csv me-3"></i>
                                    <span>CSV</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-xml me-3"></i>
                                    <span>XML</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-txt me-3"></i>
                                    <span>Text</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-exe me-3"></i>
                                    <span>Excel</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-printer me-3"></i>
                                    <span>Print</span>
                                </a>
                            </div>
                        </div> -->
                        <!-- <a href="javascript:void(0)" class="btn btn-primary">
                            <i class="fa fa-inr fa-lg"></i>&nbsp;&nbsp;
                            <span>  </span>
                        </a> -->
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
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(44, explode(',', $userData->sub_modules))))
                                            <th>User</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(45, explode(',', $userData->sub_modules))))
                                            <th>Aadhar</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(46, explode(',', $userData->sub_modules))))
                                            <th>PAN</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(49, explode(',', $userData->sub_modules))))
                                            <th>DOB</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(50, explode(',', $userData->sub_modules))))
                                            <th>aadhar_kyc_status</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(51, explode(',', $userData->sub_modules))))
                                            <th>pan_kyc_status</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(52, explode(',', $userData->sub_modules))))
                                            <th>bank_kyc_status</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(53, explode(',', $userData->sub_modules))))
                                            <th>link_kyc_status</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(54, explode(',', $userData->sub_modules))))
                                            <th>fulll_kyc_done</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(55, explode(',', $userData->sub_modules))))
                                            <th>created_on</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(56, explode(',', $userData->sub_modules))))
                                            <th>last_updated_on</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(57, explode(',', $userData->sub_modules))))
                                            <th>Action</th>
                                            @endif
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
    const userData = @json($userData);
</script>
<script>
    $(document).ready(function() {
        var baseUrl = "{{ url('/') }}";
        let columns = [];
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(44))) {
            columns.push({
                data: null,
                render: function(data, type, row) {
                    return `(${row.email})`;
                }
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(45))) {
            columns.push({
                data: 'aadhar'
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(46))) {
            columns.push({
                data: 'pan'
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(49))) {
            columns.push({
                data: 'dob'
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(50))) {
            columns.push({
                data: 'aadhar_kyc_status',
                render: function(data, type, row) {
                    if (data === 1) {
                        return '<button class="btn btn-success">Verified</button>';
                    } else {
                        return '<button class="btn btn-danger">Not Verified</button>';
                    }
                }
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(51))) {
            columns.push({
                data: 'pan_kyc_status',
                render: function(data, type, row) {
                    if (data === 1) {
                        return '<button class="btn btn-success">Verified</button>';
                    } else {
                        return '<button class="btn btn-danger">Not Verified</button>';
                    }
                }
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(52))) {
            columns.push({
                data: 'bank_kyc_status',
                render: function(data, type, row) {
                    if (data === 1) {
                        return '<button class="btn btn-success">Verified</button>';
                    } else {
                        return '<button class="btn btn-danger">Not Verified</button>';
                    }
                }
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(53))) {
            columns.push({
                data: 'link_kyc_status',
                render: function(data, type, row) {
                    if (data === 1) {
                        return '<button class="btn btn-success">Done</button>';
                    } else {
                        return '<button class="btn btn-danger">Not Done</button>';
                    }
                }
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(54))) {
            columns.push({
                data: 'fulll_kyc_done',
                render: function(data, type, row) {
                    if (data === 1) {
                        return '<button class="btn btn-success">Done</button>';
                    } else {
                        return '<button class="btn btn-danger">Not Done</button>';
                    }
                }
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(55))) {
            columns.push({
                data: 'created_on'
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(56))) {
            columns.push({
                data: 'updated_on'
            });
        }
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(57))) {
            columns.push({
                data: null,
                defaultContent: "", // Prevent DataTable from breaking
                render: function(data, type, row) {
                    return `<a href="${baseUrl}/admin/autokyc-user-details/${row.user_id}" target="_blank">
                                <p class="fa fa-eye fa-lg nav_icon" title="View Details"></p>
                            </a>`;
                }
            });
        }

        var table = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.user.autokyc.list') }}", // Route to fetch data
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
</script>
@endsection