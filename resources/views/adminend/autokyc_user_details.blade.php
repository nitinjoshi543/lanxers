@extends('adminend/layouts.main')

@section('main-section')
@php
$userData = session('user_data');
@endphp
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Auto KYC User</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">View</li>
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
                        @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(112, explode(',', $userData->sub_modules))))
                        <a href="javascript:void(0)" class="btn btn-success" onclick="resetKyc('{{ $user->user_id }}');">
                            <span>Reset Bank</span>
                        </a>
                        @endif
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
                <div class="col-xxl-4 col-xl-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="mb-4 text-center">
                                <div class="wd-150 ht-150 mx-auto mb-3 position-relative">
                                    <div class="avatar-image wd-150 ht-150 border border-5 border-gray-3">
                                        <img src="{{ asset('admin/images/avatar/1.png') }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle" style="top: 76%; right: 10px">
                                        <i class="bi bi-patch-check-fill"></i>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <a href="javascript:void(0);" class="fs-14 fw-bold d-block"> {{ $user->name }}</a>
                                    <a href="javascript:void(0);" class="fs-12 fw-normal text-muted d-block">{{ $user->email }}</a>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">DOB</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->dob }}</a>
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">Aadhar</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->aadhar }}</a>
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">PAN</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->pan }}</a>
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">Aadhar KYC Status</span>
                                    @if($user->aadhar_kyc_status == 1)
                                    <button class="btn btn-success">Verified</button>
                                    @else
                                    <button class="btn btn-danger">Not Verified</button>
                                    @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(112, explode(',', $userData->sub_modules))))
                                    <a href="{{ route('mannual.approve.kyc') }}?status=1&type=aadhar_kyc_status&users_id={{ $user->user_id }}" title="Manual Full KYC" class="btn btn-success">Manual Aadhar Approve</a>
                                    @endif
                                    @endif
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">PAN KYC Status</span>
                                    @if($user->pan_kyc_status == 1)
                                    <button class="btn btn-success">Verified</button>
                                    @else
                                    <button class="btn btn-danger">Not Verified</button>
                                    @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(112, explode(',', $userData->sub_modules))))
                                    <a href="{{ route('mannual.approve.kyc') }}?status=1&type=pan_kyc_status&users_id={{ $user->user_id }}" title="Manual Full KYC" class="btn btn-success">Manual PAN Approve</a>
                                    @endif
                                    @endif
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">Bank KYC Status</span>
                                    @if($user->bank_kyc_status == 1)
                                    <button class="btn btn-success">Verified</button>
                                    @else
                                    <button class="btn btn-danger">Not Verified</button>
                                    @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(112, explode(',', $userData->sub_modules))))
                                    <a href="{{ route('mannual.approve.kyc') }}?status=1&type=bank_kyc_status&users_id={{ $user->user_id }}" title="Manual Full KYC" class="btn btn-success">Manual Bank Approve</a>
                                    @endif
                                    @endif
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">Link KYC Status</span>
                                    @if($user->link_kyc_status == 1)
                                    <button class="btn btn-success">Done</button>
                                    @else
                                    <button class="btn btn-danger">Not Done</button>
                                    @endif
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">Full KYC Done</span>
                                    @if($user->fulll_kyc_done == 1)
                                    <button class="btn btn-success">Done</button>
                                    @else
                                    <button class="btn btn-danger">Not Done</button>
                                    @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(112, explode(',', $userData->sub_modules))))
                                    <a href="{{ route('mannual.approve.kyc') }}?status=1&type=fulll_kyc_done&users_id={{ $user->user_id }}" title="Manual Full KYC" class="btn btn-success">Manual Full Approve</a>
                                    @endif
                                    @endif
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">Created On</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->created_on }}</a>
                                </li>
                            </ul>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3">Last Updated On</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->updated_on }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-6">
                    <div class="card border-top-0">
                        <div class="card-header p-0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab" role="tab">Overview</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                <div class="profile-details mb-5">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">API Response Details:</h5>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Aadhar Response:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->aadhar_responce }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Pan Response:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->pan_response }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Bank Response:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->bank_response }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Aadhar Pan Link Response:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->aadhar_pan_link_response }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function resetKyc(users_id) {
        var url = "{{ route('user.autokyc.reset') }}?users_id=" + users_id;

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                location.reload();
            }
        });
    }
</script>
@endsection