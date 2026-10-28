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
                    <h5 class="m-b-10">Freelancer</h5>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Qualification</th>
                                            <th>Resume</th>
                                            <th>Project Link</th>
                                            <th>Skills</th>
                                            <th>Action</th>
                                            <th>Created on</th>
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

<div class="modal fade" id="vd_popup2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="details-form" action="{{ route('freelancer.reject.mail') }}">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="name" id="name_request2">
                    <input type="hidden" name="email" id="email_request2">

                    <div class="form-group" style="margin-bottom:8px;">
                        <!-- <input type="text" placeholder="Message:" required class="form-control" name="message"> -->
                        <textarea class="form-control" name="msg" cols="30" rows="10" placeholder="Message:"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var baseUrl = "{{ url('/') }}";
        var table = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.freelancer.list') }}", // Route to fetch data
                type: "GET",
                data: function(d) {
                    d.searchQuery = $('#searchQuery').val(); // Pass search value manually
                }
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'qualification'
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
                    data: 'project_link',
                    render: function(data, type, row) {
                        if (!row.project_link) return '';

                        let links = [];

                        try {
                            // Parse JSON if stored as JSON string
                            links = JSON.parse(row.project_link);
                        } catch (e) {
                            // If parsing fails, fallback to comma-separated
                            links = row.project_link.split(',');
                        }

                        return links.map(link => {
                            return `<a href="${link.trim()}" target="_blank">
                        <p>Click Here to View Project Link</p>
                    </a>`;
                        }).join('');
                    }
                },
                {
                    data: 'skills'
                },
                {
                    data: 'null',
                    render: function(data, type, row) {
                        return `<p onclick="setUserToRequestForm2('${row.email}', '${row.name}')" class="fa fa-envelope fa-lg nav_icon" title="Message"></p>`;
                    }
                },
                {
                    data: 'created_on'
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
    function setUserToRequestForm2(email, name) {
        //alert(user_id);;
        $('#name_request2').val(name);
        $('#email_request2').val(email);
        $('#vd_popup2').modal('show');
    }
</script>
@endsection