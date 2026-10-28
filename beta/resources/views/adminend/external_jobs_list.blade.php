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
        height: 40px;
        padding: 5px 10px;
        font-size: 16px;
    }

    #searchBtn {
        height: 40px;
        padding: 0 20px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    #searchBtn:hover {
        background-color: #0056b3;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">External Jobs (LinkedIn)</h5>
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
                                    <input type="text" id="searchQuery" name="searchQuery" placeholder="Enter Title / Organization / Location">
                                    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                                    <button id="searchBtn">Search</button>
                                </div>
                                <table class="table table-hover" id="userList">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Title</th>
                                            <th>Organization</th>
                                            <th>Location</th>
                                            <th>Employment Type</th>
                                            <th>Posted On</th>
                                            <th>Valid Through</th>
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
                url: "{{ route('get.external.jobs.list') }}",
                type: "GET",
                data: function(d) {
                    d.searchQuery = $('#searchQuery').val();
                }
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1 + (table.page() * table.page.len());
                    }
                },
                {
                    data: 'title',
                    render: function(data, type, row) {
                        return data ? data : '-';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        var logo = row.organization_logo
                            ? `<img src="${row.organization_logo}" alt="logo" width="24" height="24" style="border-radius:4px;margin-right:6px;">`
                            : '';
                        return `${logo}${row.organization ? row.organization : '-'}`;
                    }
                },
                {
                    data: 'locations',
                    render: function(data, type, row) {
                        return data ? data : '-';
                    }
                },
                {
                    data: 'employment_type',
                    render: function(data, type, row) {
                        return data ? data : '-';
                    }
                },
                {
                    data: 'date_posted',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        var d = new Date(data);
                        return d.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
                    }
                },
                {
                    data: 'date_valid_through',
                    render: function(data, type, row) {
                        if (!data) return '-';
                        var d = new Date(data);
                        return d.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
                    }
                },
                {
                    data: 'computed_status',
                    render: function(data, type, row) {
                        var badgeClass = 'btn-secondary';
                        if (data === 'Active') badgeClass = 'btn-success';
                        else if (data === 'Expired') badgeClass = 'btn-danger';
                        else if (data === 'Inactive') badgeClass = 'btn-warning';

                        return `<button class="btn ${badgeClass}" style="cursor:default;" disabled>${data}</button>`;
                    }
                },
                {
                    data: null,
                    defaultContent: "",
                    render: function(data, type, row) {
                        return `<a href="${baseUrl}/admin/external-jobs-view/${row.id}" target="_blank">
                                <p class="fa fa-eye fa-lg nav_icon" title="View"></p>
                            </a>
                            <a href="${baseUrl}/admin/edit-external-jobs-employer/${row.id}" class="ms-2">
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
                table.ajax.reload();
            } else {
                alert('Please enter at least 2 characters to search.');
            }
        });
    });
</script>
@endsection