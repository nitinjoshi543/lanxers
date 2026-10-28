@extends('adminend/layouts.main')

@section('main-section')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">User</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Edit</li>
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
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-top-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                                <div class="card-body personal-info">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0 me-4">
                                            <span class="d-block mb-2">Weekly User Earners</span>
                                            <!-- <span class="fs-12 fw-normal text-muted text-truncate-1-line">Following information is publicly displayed, be careful! </span> -->
                                        </h5>
                                        <!-- <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Add New</a> -->
                                    </div>
                                    <form method="POST" action="{{ route('weekly.earners.download') }}">
                                        @csrf
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="fullnameInput" class="fw-semibold">Select Type: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <select name="select_type" class="form-control" required>
                                                        <option value="1">Weekly Earners</option>
                                                        <option value="2">Weekly Purchase</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="mailInput" class="fw-semibold">From: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="from" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="mailInput" class="fw-semibold">To: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="to" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-5">
                                            </div>
                                            <div class="col-lg-5">
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="submit" class="btn btn-primary form-control" value="Download">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- <hr class="my-0"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection