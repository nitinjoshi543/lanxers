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
                    <h5 class="m-b-10">Gamified User Details</h5>
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
                        @if($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(122, explode(',', $userData->sub_modules))))
                        @if($user->status == 0)
                        <a href="javascript:void(0)" class="btn btn-success" onclick="updateStatus('{{ $user->id }}', 2);">
                            <span>Update Status</span>
                        </a>
                        @else
                        <a href="javascript:void(0)" class="btn btn-success">
                            <span>Sended</span>
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
                                    <a href="javascript:void(0);" class="fs-12 fw-normal text-muted d-block">{{ $user->phone }}, {{ $user->alternate_mobile }}</a>
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
                                <div class="row g-0 mb-1">
                                    <div class="col-sm-6 text-muted">Milestone</div>
                                    <div class="col-sm-6 fw-semibold">{{ $user->milestone }}</div>
                                </div>
                            </div>
                            @if($user->milestone == '5 Lakh')
                            <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                <div class="row g-0 mb-1">
                                    <div class="col-sm-6 text-muted">T-Shirt Size</div>
                                    <div class="col-sm-6 fw-semibold">{{ $user->tshirt_size }}</div>
                                </div>
                            </div>
                            @endif
                            <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                <div class="row g-0 mb-1">
                                    <div class="col-sm-6 text-muted">Address</div>
                                    <div class="col-sm-6 fw-semibold">{{ $user->address }}</div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                <div class="row g-0 mb-1">
                                    <div class="col-sm-6 text-muted">Pincode</div>
                                    <div class="col-sm-6 fw-semibold">{{ $user->pincode }}</div>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-info" onclick="printUserDetails();">
                                <span>Print / Download</span>
                            </a>
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
    function updateStatus(id) {
        $.ajax({
            url: "{{ route('gamified.gift.user.setstatus') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message || 'Status updated successfully!');
                    location.reload();
                } else {
                    alert(response.message || 'Failed to update status.');
                }
            },
            error: function() {
                alert('Something went wrong. Please try again.');
            }
        });
    }

    function printUserDetails() {
        var name = "{{ $user->name }}";
        var address = "{{ $user->address }}";
        var pincode = "{{ $user->pincode }}";
        var mobile = "{{ $user->phone ?? '' }}";
        var alternatemobile = "{{ $user->alternate_mobile ?? '' }}";

        // Split address by comma into multiple lines
        var addressParts = address.split(',').map(part => part.trim()).join('<br>');

        var content = `
        <div style="font-size:18px; line-height:1.8; font-family:Arial, sans-serif;">
            <h2 style="text-align:left; font-size:22px; margin-bottom:10px;">To</h2>
            <p><strong>${name}</strong></p>
            <p><strong>Address:</strong><br> ${addressParts}, ${pincode}</p>
            <p><strong>Mobile:</strong> ${mobile}</p>
            <p><strong>Mobile:</strong> ${alternatemobile}</p>
        </div>
    `;

        var myWindow = window.open('', '', 'width=800,height=600');
        myWindow.document.write('<html><head><title>User Details</title>');
        myWindow.document.write('<style> body { font-size:18px; font-family:Arial, sans-serif; line-height:1.6; } </style>');
        myWindow.document.write('</head><body>');
        myWindow.document.write(content);
        myWindow.document.write('</body></html>');
        myWindow.document.close();
        myWindow.print();
    }
</script>
@endsection