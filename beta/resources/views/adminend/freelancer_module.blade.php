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

    .loader {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #007bff;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        animation: spin 1s linear infinite;
        display: none;
        margin: 0 auto;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
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
                                    <input type="text" id="searchQuery" name="searchQuery" placeholder="Enter User Email OR Phone">
                                    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                                    <button id="searchBtn">Search</button>
                                </div>
                                <table class="table table-hover" id="userList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Profile Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Profile Status</th>
                                            <th>Account</th>
                                            <th>Role</th>

                                            <th class="text-end">Actions</th>
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
        let table;

        $("#searchBtn").click(function() {
            let searchValue = $('#searchQuery').val().trim();
            var baseUrl = "{{ url('/') }}";

            if (searchValue.length >= 5) {
                if (table && $.fn.DataTable.isDataTable("#userList")) {
                    table.clear().destroy();
                }

                let thCount = $("#userList th").length;

                let columns = [{
                        data: 'id',
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'profile_photo',
                        orderable: false,
                        render: function(data) {
                            return data ?
                                `<img src="${data}" width="40" height="40" style="border-radius:50%;object-fit:cover">` :
                                'N/A';
                        },
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'name',
                        render: data => `<p>${data || 'N/A'}</p>`,
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'email',
                        render: data => `<p>${data || 'N/A'}</p>`,
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'phone',
                        render: function(data) {
                            if (!data) return `<p>N/A</p>`;
                            const last4 = data.slice(-4);
                            return `<p>${'*'.repeat(Math.max(data.length - 4, 0)) + last4}</p>`;
                        },
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'profile_complete',
                        render: data => data == 1 ?
                            '<span class="badge bg-success">Complete</span>' : '<span class="badge bg-danger">Incomplete</span>',
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'account',
                        render: data => {
                            const map = {
                                approve:    '<span class="badge bg-success">Approved</span>',
                                disapprove: '<span class="badge bg-danger">Disapproved</span>',
                                suspend:    '<span class="badge bg-warning text-dark">Suspended</span>'
                            };
                            return map[data] || '<span class="badge bg-secondary">N/A</span>';
                        },
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'role',
                        render: data => `<p>${data || 'N/A'}</p>`,
                        defaultContent: 'N/A'
                    },
                    {
                        data: 'actions',
                        orderable: false,
                        render: function(data, type, row) {
                            let actions = '';

                            // View Details — module 2 (ya jo bhi tumhe chahiye)
                            @if(isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(2, explode(',', $userData->sub_modules)))))
                                actions += `<a href="${baseUrl}/admin/freelancer-details/${row.users_id_hash || ''}" target="_blank"><p class="fa fa-eye fa-lg nav_icon" title="View Details"></p></a> `;
                            @endif

                            // Edit — module 17
                            @if(isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(17, explode(',', $userData->sub_modules)))))
                                actions += `| <a href="${baseUrl}/admin/user-edit/${row.users_id_hash || ''}" target="_blank"><p class="fa fa-pencil fa-lg nav_icon" title="Edit User"></p></a> `;
                            @endif

                            // Pay Request — module 18
                            @if(isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(18, explode(',', $userData->sub_modules)))))
                                actions += `| <p title="Pay Request" class="fa-solid fa-money-bill fa-lg nav_icon" onclick="setUserToRequestForm('${row.users_id_hash || ''}')"></p> `;
                            @endif

                            // Message — module 19
                            @if(isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(19, explode(',', $userData->sub_modules)))))
                                actions += `| <p title="Message" class="fa fa-envelope fa-lg nav_icon" onclick="setUserToRequestForm2('${row.phone || ''}')"></p>`;
                            @endif

                            return actions;
                        },
                        defaultContent: 'N/A'
                    }
                ];

                table = $("#userList").DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    lengthChange: false,
                    paging: false,
                    info: true,
                    dom: 'rt',
                    rowId: 'users_id',
                    language: {
                        emptyTable: "No data found for the given search criteria.",
                        zeroRecords: "No matching records found",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries found"
                    },
                    ajax: {
                        url: "{{ route('freelancer.module.search') }}",
                        type: "POST",
                        data: function(d) {
                            d.searchQuery = searchValue;
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf_token').val()
                        },
                        beforeSend: function() {
                            $("#userList tbody").html('<tr><td colspan="' + thCount + '" class="text-center">Loading...</td></tr>');
                        },
                        error: function(xhr, status, error) {
                            let errorMessage = 'Error loading data. Please try again.';
                            if (xhr.status === 403) {
                                errorMessage = 'You do not have permission to perform this action.';
                            } else if (xhr.status === 419) {
                                errorMessage = 'Session expired. Please refresh the page and try again.';
                            }
                            $("#userList tbody").html('<tr><td colspan="' + thCount + '" class="text-center">' + errorMessage + '</td></tr>');
                        },
                        dataSrc: 'data',
                    },
                    columns: columns,
                    drawCallback: function(settings) {
                        if (!settings.json || !settings.json.data || settings.json.data.length === 0) {
                            $("#userList tbody").html('<tr><td colspan="' + thCount + '" class="text-center">No data found for the given search criteria.</td></tr>');
                        }
                    }
                });
            } else {
                alert("Please enter at least 5 characters for the search.");
            }
        });

        $("#searchQuery").on("keypress", function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $("#searchBtn").click();
            }
        });
    });
</script>
@endsection