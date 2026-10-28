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
                    <h5 class="m-b-10">Talent Form Module</h5>
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
                                <div class="d-flex align-items-center gap-2 p-3">
                                
                                    <select id="lookingFor" class="form-select" style="width: 220px;">
                                        <option value="">All</option>
                                        <option value="internship">Internship</option>
                                        <option value="job">Job</option>
                                        <option value="freelancer">Freelancer</option>
                                    </select>
                                
                                    <input
                                        type="text"
                                        id="searchQuery"
                                        name="searchQuery"
                                        placeholder="Search..."
                                        class="form-control"
                                        style="width: 300px;"
                                    >
                                
                                    <button id="searchBtn" class="btn btn-primary">
                                        Search
                                    </button>
                                
                                </div>
                                <table class="table table-hover" id="userList">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Looking For</th>
                                            <th>City</th>
                                            <th>Current Profile</th>
                                            <th>Preferred Roles</th>
                                            <th>Portfolio</th>
                                            <th>CV</th>
                                            <th>Created At</th>
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

        var table = $('#userList').DataTable({

            processing: true,
            serverSide: true,
            pageLength: 50,

            ajax: {
                url: "{{ route('get.talent.form.list') }}",
                type: "GET",

                data: function(d) {
                    d.searchQuery = $('#searchQuery').val();
                    d.lookingFor = $('#lookingFor').val();
                }
            },

            columns: [
                {
                    data: 'name',
                    name: 'users.name'
                },

                {
                    data: 'email',
                    name: 'users.email'
                },

                {
                    data: 'phone',
                    name: 'users.phone'
                },

                {
                    data: 'looking_for',
                    name: 'talent_profiles.looking_for'
                },

                {
                    data: 'city',
                    name: 'talent_profiles.city'
                },

                {
                    data: 'current_profile',
                    name: 'talent_profiles.current_profile'
                },

                {
                    data: 'preferred_roles',
                    name: 'talent_profiles.preferred_roles'
                },
                
                {
                    data: 'portfolio_link',
                    name: 'talent_profiles.portfolio_link',
                    render: function(data, type, row) {
                        if (!data) {
                            return '';
                        }
                
                        return '<a href="' + data + '" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">' +
                               'View Portfolio' +
                               '</a>';
                    }
                },

                {
                    data: 'cv',
                    name: 'talent_profiles.cv',

                    orderable: false,

                    render: function(data, type, row) {

                        if (!data) {
                            return '-';
                        }

                        return `
                        <a href="${data}"
                           target="_blank"
                           class="btn btn-sm btn-primary">
                            View CV
                        </a>
                    `;
                    }
                },

                {
                    data: 'created_at',
                    name: 'talent_profiles.created_at'
                }

            ]

        });

        // Search
        $('#searchBtn').click(function() {
            var searchQuery = $('#searchQuery').val().trim();
            if (searchQuery.length >= 2 || searchQuery.length === 0) {
                table.ajax.reload();
            } else {
                alert('Please enter at least 2 characters to search.');
            }
        });
        
        // Looking For Filter
        $('#lookingFor').change(function() {
            table.ajax.reload();
        });

    });
</script>

@endsection