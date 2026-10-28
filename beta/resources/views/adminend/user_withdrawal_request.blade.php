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
                        
                        <a href="javascript:void(0)" class="btn btn-primary">
                            <i class="fa fa-inr fa-lg"></i>&nbsp;&nbsp;
                            <span> {{ $total_amount }} </span>
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
        @php
        $userData = session('user_data');
        @endphp
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
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(21, explode(',', $userData->sub_modules))))
                                            <th>KYC</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(22, explode(',', $userData->sub_modules))))
                                            <th>Link Kyc</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(23, explode(',', $userData->sub_modules))))
                                            <th>Create</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(24, explode(',', $userData->sub_modules))))
                                            <th>User</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(25, explode(',', $userData->sub_modules))))
                                            <th>Bank Name</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(26, explode(',', $userData->sub_modules))))
                                            <th>PAN</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(27, explode(',', $userData->sub_modules))))
                                            <th>Pending Amount</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(28, explode(',', $userData->sub_modules))))
                                            <th>Request Amount</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(29, explode(',', $userData->sub_modules))))
                                            <th>AC no</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(30, explode(',', $userData->sub_modules))))
                                            <th>IFSC</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(31, explode(',', $userData->sub_modules))))
                                            <th>RX Contact</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && count(array_intersect([32, 33, 35, 36], explode(',', $userData->sub_modules))) > 0))
                                            <th>Action</th>
                                            @endif
                                            @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(34, explode(',', $userData->sub_modules))))
                                            <th>Date</th>
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

        // Conditionally add columns based on userData
        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(21))) {
            columns.push({
                data: 'kyc_status',
                render: function(data) {
                    return data === 2 ?
                        '<p class="fa fa-check-circle text-success"></p>' :
                        '<p class="fa fa-times-circle text-danger"></p>';
                }
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(22))) {
            columns.push({
                data: 'is_tax',
                render: function(data) {
                    return data === 1 ?
                        '<p class="fa fa-check-circle text-success"></p>' :
                        '<p class="fa fa-times-circle text-danger"></p>';
                }
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(23))) {
            columns.push({
                data: 'self_create',
                render: function(data) {
                    return data === 1 ?
                        '<p>Self</p>' :
                        '<p>Auto</p>';
                }
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(24))) {
            columns.push({
                data: null,
                render: function(data, type, row) {
                    return `${row.name} (${row.email})`;
                }
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(25))) {
            columns.push({
                data: 'usernamebank'
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(26))) {
            columns.push({
                data: 'tax_cre'
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(27))) {
            columns.push({
                data: 'pending_amount'
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(28))) {
            columns.push({
                data: 'amount'
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(29))) {
            columns.push({
                data: 'account_number'
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(30))) {
            columns.push({
                data: 'ifsc'
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(31))) {
            columns.push({
                data: 'razorpayx_contact_id'
            });
        }


        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.length > 0)) {
            columns.push({
                data: 'actions',
                title: 'Actions',
                orderable: false,
                searchable: false
            });
        }

        if (userData.group_id === 1 || (userData.sub_modules && userData.sub_modules.includes(34))) {
            columns.push({
                data: 'created_on'
            });
        }

        var table = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.user.withdrawal.list') }}", // Route to fetch data
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
    });
</script>

<script type="text/javascript">
    function ConfirmDialog() {
        return confirm("Are you sure to pay this user? You need to enter the transaction details for the coming form, so be sure to confirm this OK button. Before clicking OK, please take a screenshot and note the transaction ID. The status of this request will be changed and never reflected again.");
    }

    function ConfirmDialogCancel() {
        return confirm("Are you sure to cancel this request? The status of this request will be changed and the request will never show again.");
    }
</script>
@endsection