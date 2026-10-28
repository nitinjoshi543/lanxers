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
                    <h5 class="m-b-10">Refund Module</h5>
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

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refund_popup">
    Refund Create
</button>
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
                                            <th>User</th>
                                            <th>Bank Name</th>
                                            <th>Purchase Invoice</th>
                                            <th>Invoice</th>
                                            <th>Refund Amount</th>
                                            <th>TDS</th>
                                            <th>AC No</th>
                                            <th>IFSC</th>
                                            <th>RX Contact</th>
                                            <th>Status</th>
                                            <th>Date</th>
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

<div class="modal fade" id="refund_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User Refund</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="details-form" action="{{ route('refund.request.create') }}">
                 @csrf
                <div class="row modal-body">

                    <div class="row">
                        <div class="col-md-10 form-group" style="margin-bottom:8px;">
                            <input type="text" placeholder="Existing User Email" class="form-control" id="fetchuser">
                        </div>
                        <div class="col-md-2 form-group" style="margin-bottom:8px;">
                            <input type="button" value="Fetch" class="btn btn-primary" onclick="setUserToRefundRequestForm()" id="fetchuserbutton">
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="for_refund_user_details"></div>
                    <hr>
                    <hr>
                    <div class="row reform" style="display:none;">
                        <div class="col-md-12 form-group" style="margin-bottom:8px;text-align: center;">
                            <span class="label label-default" style="font-size: medium;">Refund create form</span>
                        </div>
                        <div class="col-md-6 form-group" style="margin-bottom:8px;">
                            <input type="text" placeholder="Name (as per the bank):" required class="form-control" name="name">
                        </div>

                        <div class="col-md-6 form-group" style="margin-bottom:8px;">
                            <input type="text" placeholder="Phone:" required class="form-control" name="phone">
                        </div>

                        <div class="col-md-6 form-group" style="margin-bottom:8px;">
                            <input type="text" placeholder="Email:" required class="form-control" name="email">
                        </div>

                        <div class="col-md-6 form-group" style="margin-bottom:8px;">
                            <input type="text" placeholder="Amount:" required class="form-control" name="amount">
                        </div>
                        <div class="col-md-12 form-group" style="margin-bottom:8px;">
                            <input type="text" placeholder="Account Number:" required class="form-control" name="account_number">
                        </div>

                        <div class="col-md-12 form-group" style="margin-bottom:8px;">
                            <input type="text" placeholder="IFSC:" required class="form-control" name="ifsc">
                        </div>

                    </div>
                </div>
                <div class="modal-footer reform" style="display:none;">
                    <button type="submit" onclick="return ConfirmDialog2()" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const userData = @json($userData);
</script>
<script>
    $(document).ready(function() {
        var baseUrl = "{{ url('/') }}";
        let columns = [];

        columns.push({
            data: null,
            render: function(data, type, row) {
                return `${row.name} (${row.email})`;
            }
        });

        columns.push({
            data: 'name'
        });

        columns.push({
            data: 'purchase_invoice_no'
        });

        columns.push({
            data: 'refund_invoice_no'
        });

        columns.push({
            data: 'amount'
        });

        columns.push({
            data: 'tds'
        });

        columns.push({
            data: 'account_no'
        });

        columns.push({
            data: 'ifsc'
        });

        columns.push({
            data: 'razorpayx_contact_id'
        });

        columns.push({
            data: 'status',
            render: function(data, type, row) {
                if (data == 1) {
                    return "<p class='btn btn-success btn-sm'>Complete</p>";
                } else {
                    return "<p class='btn btn-warning btn-sm'>Pending</p>";
                }
            }
        });

        columns.push({
            data: 'created_on'
        });


        var table = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.refund.list') }}", // Route to fetch data
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

    function setUserToRefundRequestForm() {
        var refund_user_email = $('#fetchuser').val();
        if (refund_user_email != "") {
            $.ajax({
                type: "POST",
                url: "{{ route('refund.user.search') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "email": refund_user_email
                },
                cache: false,
                success: function(res) {
                    $("#for_refund_user_details").html(res);
                    if (res != "User not found.")
                        $(".reform").show();
                }
            });
        } else {
            alert("User mail is required.");
        }
    }
</script>
@endsection