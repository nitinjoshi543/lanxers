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
                    <h5 class="m-b-10">International KYC User</h5>
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
                        @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(119, explode(',', $userData->sub_modules))))
                        @if($user->status == 2)
                        <a href="javascript:void(0)" class="btn btn-success">
                            <span>Approved</span>
                        </a>
                        @elseif($user->status == 3)
                        <a href="javascript:void(0)" class="btn btn-danger">
                            <span>Rejected</span>
                        </a>
                        @else
                        <a href="javascript:void(0)" class="btn btn-success" onclick="resetKyc('{{ $user->users_id }}', 2);">
                            <span>Approve KYC</span>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="resetKyc('{{ $user->users_id }}', 0);">
                            <span>Reject KYC</span>
                        </a>
                        @endif
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
                                        <h5 class="fw-bold mb-0">Documents:</h5>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Bank Proof:</div>
                                        <div class="col-sm-6 fw-semibold"><img class="img-fluid kyc-img" src="{{ $user->kyc_image }}" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#imageModal" data-src="{{ $user->kyc_image }}"></div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Local ID:</div>
                                        <div class="col-sm-6 fw-semibold"><img class="img-fluid kyc-img" src="{{ $user->kyc_image1 }}" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#imageModal" data-src="{{ $user->kyc_image1 }}"></div>
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

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body p-0">
        <img src="" id="modalImage" class="img-fluid w-100" alt="KYC Image">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    function resetKyc(users_id, status) {
        var url = "{{ route('user.internationalkyc.approvedisapprove') }}?users_id=" + users_id + "&status=" + status;

        $.ajax({ 
            url: url,
            type: "GET",
            success: function(response) {
                location.reload();
            }
        });
    }

    document.querySelectorAll('.kyc-img').forEach(function(img) {
        img.addEventListener('click', function() {
            document.getElementById('modalImage').src = this.dataset.src;
        });
    });
</script>
@endsection