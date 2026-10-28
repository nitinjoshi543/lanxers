@extends('adminend/layouts.main')

@section('main-section')
@php
$userData = session('user_data');
@endphp
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Find User</h5>
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
                                <table class="table table-hover" id="proposalList">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Current Plan</th>
                                            <th>Individual Course</th>
                                            <th>Sponser</th>
                                            <th>Account Created</th>
                                            <th>Link</th>
                                        </tr>
                                    </thead>
                                    <tbody id="proposalBody">
                                        @php
                                        $i = 1;
                                        @endphp

                                        @if (!empty($user))
                                        <tr class="single-item">
                                            <td>{{ $i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ empty($user->current_plan) ? 'No Plan' : $user->current_plan }}</td>
                                            <td>{{ isset($indi_course_name) ? $indi_course_name->course_title : 'N/A' }}</td>
                                            <td>{{ isset($sponser_detail) ? $sponser_detail->name : 'N/A' }}</td>
                                            <td>{{ $user->created_on }}</td>
                                            <td>
                                                <a href="{{ route('find.user.view', ['id' => $user->users_id]) }}" class="fa fa-eye fa-lg nav_icon" target="_blank"></a> |
                                                <a href="{{ route('find.user.delete', ['id' => $user->users_id]) }}" class="fa fa-trash fa-lg nav_icon"></a>
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <h1>No data found</h1>
                                            </td>
                                        </tr>
                                        @endif
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
@endsection