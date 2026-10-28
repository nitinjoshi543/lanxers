@extends('adminend/layouts.main')

@section('main-section')
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">External Job</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('external.jobs.list') }}">External Jobs</a></li>
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
                                        <img src="{{ !empty($job->organization_logo) ? $job->organization_logo : asset('admin/images/avatar/1.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <a href="javascript:void(0);" class="fs-14 fw-bold d-block">{{ $job->title }}</a>
                                    <a href="javascript:void(0);" class="fs-12 fw-normal text-muted d-block">{{ $job->organization }}</a>
                                </div>
                                <div class="mb-3">
                                    @if($job->computed_status === 'Active')
                                        <span class="badge bg-success px-3 py-2">Active</span>
                                    @elseif($job->computed_status === 'Expired')
                                        <span class="badge bg-danger px-3 py-2">Expired</span>
                                    @else
                                        <span class="badge bg-warning px-3 py-2">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-map-pin"></i>Location</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $job->locations ?? '-' }}</a>
                                </li>
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-briefcase"></i>Employment Type</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $job->employment_type ?? '-' }}</a>
                                </li>
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-award"></i>Seniority</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $job->seniority ?? '-' }}</a>
                                </li>
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-calendar"></i>Posted On</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $job->date_posted ? \Carbon\Carbon::parse($job->date_posted)->format('d M Y, h:i A') : '-' }}</a>
                                </li>
                                <li class="hstack justify-content-between mb-0">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-clock"></i>Valid Through</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $job->date_valid_through ? \Carbon\Carbon::parse($job->date_valid_through)->format('d M Y, h:i A') : '-' }}</a>
                                </li>
                            </ul>
                            <div class="d-flex gap-2 text-center pt-4">
                                <a href="{{ $job->url }}" target="_blank" class="w-100 btn btn-primary">
                                    <i class="feather-external-link me-2"></i>
                                    <span>View on LinkedIn</span>
                                </a>
                            </div>
                            <div class="d-flex gap-2 text-center pt-2">
                                <button type="button"
                                    id="toggleApplicationStatusBtn"
                                    class="w-100 btn {{ $job->is_accepting_applications == 1 ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                    data-job-id="{{ $job->id }}"
                                    data-current-status="{{ $job->is_accepting_applications }}">
                                    <i class="feather-{{ $job->is_accepting_applications == 1 ? 'x-circle' : 'check-circle' }} me-2"></i>
                                    <span>
                                        {{ $job->is_accepting_applications == 1 ? 'No Longer Accepting Applications' : 'Reopen Applications' }}
                                    </span>
                                </button>
                            </div>
                            <div class="d-flex gap-2 text-center pt-2">
                                <button type="button"
                                    id="toggleActiveStatusBtn"
                                    class="w-100 btn {{ $job->is_active == 1 ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                    data-job-id="{{ $job->id }}"
                                    data-current-status="{{ $job->is_active }}">
                                    <i class="feather-{{ $job->is_active == 1 ? 'eye-off' : 'eye' }} me-2"></i>
                                    <span>
                                        {{ $job->is_active == 1 ? 'Deactivate Job' : 'Activate Job' }}
                                    </span>
                                </button>
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
                                    <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab" role="tab">Description</a>
                                </li>
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#skillsTab" role="tab">AI Insights</a>
                                </li>
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#companyTab" role="tab">Company Info</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                <div class="profile-details mb-3">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">Job Description:</h5>
                                    </div>
                                    <div class="fs-14" style="white-space: pre-line;">
                                        {{ $job->description_text ?? 'No description available.' }}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade p-4" id="skillsTab" role="tabpanel">
                                <div class="profile-details mb-5">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">AI-Extracted Insights:</h5>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Experience Level:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $job->ai_experience_level ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Work Arrangement:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $job->ai_work_arrangement ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Office Days:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $job->ai_work_arrangement_office_days ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-12 text-muted mb-2">Key Skills:</div>
                                        <div class="col-sm-12">
                                            @php
                                                $skills = json_decode($job->ai_key_skills ?? '[]', true);
                                            @endphp
                                            @if(!empty($skills))
                                                @foreach($skills as $skill)
                                                    <span class="badge bg-light-brand text-dark me-1 mb-1 p-2">{{ $skill }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade p-4" id="companyTab" role="tabpanel">
                                <div class="profile-details mb-5">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">Company Details:</h5>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Organization:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $job->organization ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Website:</div>
                                        <div class="col-sm-6 fw-semibold">
                                            @if($job->org_linkedin_website)
                                                <a href="{{ $job->org_linkedin_website }}" target="_blank">{{ $job->org_linkedin_website }}</a>
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Company Size:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $job->org_linkedin_size ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Industry:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $job->org_linkedin_industry ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Slogan:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $job->org_linkedin_slogan ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-0">
                                        <div class="col-sm-12 text-muted mb-2">About:</div>
                                        <div class="col-sm-12 fs-14" style="white-space: pre-line;">
                                            {{ $job->org_linkedin_description ?? '-' }}
                                        </div>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#toggleApplicationStatusBtn').on('click', function () {
            const btn = $(this);
            const jobId = btn.data('job-id');
            const currentStatus = btn.data('current-status');

            const confirmMsg = currentStatus == 1
                ? 'Mark this job as no longer accepting applications?'
                : 'Reopen this job for applications?';

            if (!confirm(confirmMsg)) return;

            btn.prop('disabled', true);

            $.ajax({
                url: '{{ url("/admin/toggle-external-job-status") }}/' + jobId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        const isAccepting = data.status == 1;
                        btn.data('current-status', data.status);
                        btn.attr('data-current-status', data.status);

                        btn.removeClass('btn-outline-danger btn-outline-success');
                        btn.addClass(isAccepting ? 'btn-outline-danger' : 'btn-outline-success');

                        btn.find('span').text(
                            isAccepting ? 'No Longer Accepting Applications' : 'Reopen Applications'
                        );

                        btn.find('i').attr('class',
                            isAccepting ? 'feather-x-circle me-2' : 'feather-check-circle me-2'
                        );
                    } else {
                        alert(data.message || 'Something went wrong.');
                    }
                },
                error: function () {
                    alert('Request failed.');
                },
                complete: function () {
                    btn.prop('disabled', false);
                }
            });
        });

        $('#toggleActiveStatusBtn').on('click', function () {
            const btn = $(this);
            const jobId = btn.data('job-id');
            const currentStatus = btn.data('current-status');
            const newStatus = currentStatus == 1 ? 0 : 1;

            const confirmMsg = currentStatus == 1
                ? 'Deactivate this job? It will stop showing on the frontend.'
                : 'Activate this job? It will start showing on the frontend.';

            if (!confirm(confirmMsg)) return;

            btn.prop('disabled', true);

            $.ajax({
                url: '{{ route("external.jobs.setstatus") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: jobId,
                    status: newStatus
                },
                success: function (response) {
                    // controller plain status echo karta hai (0 ya 1), JSON nahi
                    const isActive = response == 1 || response == '1';

                    btn.data('current-status', isActive ? 1 : 0);
                    btn.attr('data-current-status', isActive ? 1 : 0);

                    btn.removeClass('btn-outline-warning btn-outline-success');
                    btn.addClass(isActive ? 'btn-outline-warning' : 'btn-outline-success');

                    btn.find('span').text(isActive ? 'Deactivate Job' : 'Activate Job');
                    btn.find('i').attr('class', isActive ? 'feather-eye-off me-2' : 'feather-eye me-2');
                },
                error: function () {
                    alert('Request failed.');
                },
                complete: function () {
                    btn.prop('disabled', false);
                }
            });
        });

    });
</script>
@endsection