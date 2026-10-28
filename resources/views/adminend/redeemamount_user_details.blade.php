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
                    <h5 class="m-b-10">User Redeem Amount Details</h5>
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

        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">

                                    <thead class="table-light">
                                        <tr>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Redeem Date</th>
                                            <th>Referral Amount</th>
                                            <th>Referral Name</th>
                                            <th>Referral Email</th>
                                            <th>Referral Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($user as $row)
                                        <tr>

                                            <!-- User Info -->
                                            <td>
                                                <strong>{{ $row->name }}</strong><br>
                                                <small class="text-muted">{{ $row->email }}</small>
                                            </td>

                                            <!-- Amount -->
                                            <td>
                                                ₹{{ number_format($row->riamount, 2) }}
                                            </td>

                                            <!-- Status -->
                                            <td>
                                                @if($row->ristatus == 1)
                                                <span class="badge bg-success">Paid</span>
                                                @elseif($row->ristatus == 3)
                                                <span class="badge bg-warning text-dark">Processing</span>
                                                @else
                                                <span class="badge bg-secondary">Pending</span>
                                                @endif
                                            </td>

                                            <!-- Date -->
                                            <td>
                                                {{ date('d M Y h:i A', strtotime($row->ricreated_on)) }}
                                            </td>

                                            <td>{{ $row->referral_amount }}

                                            <td>{{ $row->purchasing_user_name }}</td>
                                            <td>{{ $row->purchasing_user_email }}</td>
                                            <td>{{ $row->referral_date }}</td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                No Redeem Data Found
                                            </td>
                                        </tr>
                                        @endforelse

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

@endsection