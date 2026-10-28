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
                        <div class="card-header p-0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profileTab" role="tab">Profile</a>
                                </li>
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#passwordTab" role="tab">Bank Details</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                                <div class="card-body personal-info">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0 me-4">
                                            <span class="d-block mb-2">User Details:</span>
                                            <!-- <span class="fs-12 fw-normal text-muted text-truncate-1-line">Following information is publicly displayed, be careful! </span> -->
                                        </h5>
                                        <!-- <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Add New</a> -->
                                    </div>
                                    <form method="POST" action="{{ route('user.personal.details.update', ['id' => $user->users_id]) }}">
                                        @csrf
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="fullnameInput" class="fw-semibold">Name: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i></div>
                                                    <input type="text" class="form-control" name="name" id="fullnameInput" placeholder="Name" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="mailInput" class="fw-semibold">Email: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-mail"></i></div>
                                                    <input type="text" class="form-control" name="email" id="mailInput" placeholder="Email" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="phoneInput" class="fw-semibold">Phone: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-phone"></i></div>
                                                    <input type="text" class="form-control" id="phoneInput" name="phone" placeholder="Phone" value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="phoneInput" class="fw-semibold">State: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-map"></i></div>
                                                    <select class="form-control" name="state_id" id="state_id" required>
                                                        <option value="">Select State</option>
                                                        @php
                                                        $states = getStates(['id','name'],$user->country_id);
                                                        @endphp
                                                        @foreach ($states as $state)
                                                        <option value="{{ $state->id }}" data-name="{{ $state->name }}" {{ $user->state_name == $state->name ? 'selected' : '' }}>
                                                            {{ $state->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="state_name" id="state_name" value="{{ $user->state_name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-5">
                                            </div>
                                            <div class="col-lg-5">
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="submit" class="btn btn-primary form-control" value="Update">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- <hr class="my-0"> -->

                            </div>
                            <div class="tab-pane fade" id="passwordTab" role="tabpanel">
                                <div class="card-body pass-info">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0 me-4">
                                            <span class="d-block mb-2">User Bank Information:</span>
                                            <!-- <span class="fs-12 fw-normal text-muted text-truncate-1-line">You can only change your password twice within 24 hours! </span> -->
                                        </h5>
                                        <!-- <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Reset</a> -->
                                    </div>
                                    <form method="POST" action="{{ route('user.bank.details.update', ['id' => $user->users_id]) }}">
                                        @csrf
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="phoneInput" class="fw-semibold">Name: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <!-- <div class="input-group-text"><i class="feather-phone"></i></div> -->
                                                    <input type="text" class="form-control" name="name" placeholder="Name on Bank" value="{{ $user->usernamebank }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="phoneInput" class="fw-semibold">Account number: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <!-- <div class="input-group-text"><i class="feather-phone"></i></div> -->
                                                    <input type="text" class="form-control" name="account_number" placeholder="Account Number" value="{{ $user->account_number }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="phoneInput" class="fw-semibold">Account Type: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="ac_type" placeholder="Account Type" value="{{ $user->ac_type }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="phoneInput" class="fw-semibold">IFSC: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="ifsc" placeholder="IFSC" value="{{ $user->ifsc }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="phoneInput" class="fw-semibold">PAN No: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="tax_cre" placeholder="PAN no" value="{{ $user->tax_cre }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-5">
                                            </div>
                                            <div class="col-lg-5">
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="submit" class="btn btn-primary form-control" value="Update">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#state_id').on('change', function() {
        let stateName = $(this).find(':selected').data('name');
        $('#state_name').val(stateName);
    });
});
</script>
@endsection