@extends('adminend/layouts.main')
@php
$userData = session('user_data');
@endphp
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
                                        <img src="{{ !empty($user->profile_photo) ? $user->profile_photo : asset('admin/images/avatar/1.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <a href="javascript:void(0);" class="fs-14 fw-bold d-block">{{ $user->user_name }}</a>
                                    <a href="javascript:void(0);" class="fs-12 fw-normal text-muted d-block">{{ $user->email }}</a>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-map-pin"></i>Location</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->state_name ?? 'N/A' }}{{ !empty($user->country_name) ? ', '.$user->country_name : '' }}</a>
                                </li>
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-phone"></i>Phone</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->phone ?? 'N/A' }}</a>
                                </li>
                                <li class="hstack justify-content-between mb-0">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-mail"></i>Email</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->email }}</a>
                                </li>
                                @if(isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(4, explode(',', $userData->sub_modules)))))
                                <li class="hstack justify-content-between mb-0 mt-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-award"></i>Profile Level</span>
                                    <select class="form-select form-select-sm w-auto" id="profileLevelSelect" data-user-id="{{ $user->user_id }}">
                                        <option value="" {{ empty($user->profile_level) ? 'selected' : '' }} disabled>Select Level</option>
                                        <option value="beginner" {{ $user->profile_level == 'beginner'     ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ $user->profile_level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="expert" {{ $user->profile_level == 'expert'       ? 'selected' : '' }}>Expert</option>
                                    </select>
                                </li>
                                @endif
                                @if(isset($userData) && ($userData->group_id == 1 || (isset($userData->sub_modules) && in_array(3, explode(',', $userData->sub_modules)))))
                                <li class="hstack justify-content-between mb-0 mt-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-shield"></i>Account Status</span>
                                    <select class="form-select form-select-sm w-auto" id="accountStatusSelect" data-user-id="{{ $user->user_id }}">
                                        <option value="" {{ empty($user->account) ? 'selected' : '' }} disabled>Select Status</option>
                                        <option value="approve" {{ $user->account == 'approve'    ? 'selected' : '' }}>Approved</option>
                                        <option value="disapprove" {{ $user->account == 'disapprove' ? 'selected' : '' }}>Disapproved</option>
                                        <option value="suspend" {{ $user->account == 'suspend'    ? 'selected' : '' }}>Suspended</option>
                                    </select>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-6">
                    <div class="card border-top-0">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab" role="tab">Overview</a>
                                </li>
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#skillsTab" role="tab">Skills &amp; Experience</a>
                                </li>
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#walletTab" role="tab">Wallet</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">

                            {{-- OVERVIEW --}}
                            <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                <div class="profile-details mb-5">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">User Details:</h5>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Job Title:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->job_title ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Hourly Rate:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->currency_symbol ?? '' }}{{ $user->hourly_rate ?? '0.00' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Experience (years):</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->experience ?? '0' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Available for Work:</div>
                                        <div class="col-sm-6 fw-semibold">{{ ($user->available_for_work ?? 0) == 1 ? 'Yes' : 'No' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Portfolio:</div>
                                        <div class="col-sm-6 fw-semibold">
                                            @if(!empty($user->portfolio))
                                            <a href="{{ $user->portfolio }}" target="_blank">{{ $user->portfolio }}</a>
                                            @else N/A @endif
                                        </div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Bio:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->bio ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Created On:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->created_at ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>

                            {{-- SKILLS & EXPERIENCE --}}
                            <div class="tab-pane fade p-4" id="skillsTab" role="tabpanel">
                                <div class="profile-details mb-4">
                                    <h5 class="fw-bold mb-3">Skills:</h5>
                                    @forelse($skills as $skill)
                                    <span class="badge bg-primary me-1 mb-1">{{ $skill->skill_name ?? 'N/A' }}</span>
                                    @empty
                                    <p class="text-muted mb-0">No skills added.</p>
                                    @endforelse
                                </div>

                                <div class="profile-details">
                                    <h5 class="fw-bold mb-3">Experience:</h5>
                                    @forelse($experiences as $exp)
                                    <div class="border-bottom py-3">
                                        <strong>{{ $exp->job_title ?? $exp->title ?? 'N/A' }}</strong>
                                        @if(!empty($exp->company)) <span class="text-muted">@ {{ $exp->company }}</span> @endif
                                        <div class="text-muted small">
                                            {{ $exp->from_date ?? $exp->start_date ?? '' }} - {{ $exp->to_date ?? $exp->end_date ?? 'Present' }}
                                        </div>
                                        @if(!empty($exp->description))
                                        <p class="mb-0 mt-1 small">{{ $exp->description }}</p>
                                        @endif
                                    </div>
                                    @empty
                                    <p class="text-muted mb-0">No experience added.</p>
                                    @endforelse
                                </div>
                            </div>

                            {{-- WALLET --}}
                            <div class="tab-pane fade p-4" id="walletTab" role="tabpanel">
                                <div class="profile-details mb-5">
                                    <h5 class="fw-bold mb-4">Wallet Summary:</h5>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Available Balance:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->currency_symbol ?? '' }}{{ $user->available_balance ?? '0.00' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">On Hold:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->currency_symbol ?? '' }}{{ $user->on_hold_balance ?? '0.00' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Total Earned:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->currency_symbol ?? '' }}{{ $user->total_earned ?? '0.00' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Total Spent:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->currency_symbol ?? '' }}{{ $user->total_spent ?? '0.00' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Total Deposited:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->currency_symbol ?? '' }}{{ $user->total_deposited ?? '0.00' }}</div>
                                    </div>
                                    <div class="row g-0 mb-0">
                                        <div class="col-sm-6 text-muted">Total Withdrawn:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->currency_symbol ?? '' }}{{ $user->total_withdrawn ?? '0.00' }}</div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const levelSelect = document.getElementById('profileLevelSelect');
        if (!levelSelect) return;

        levelSelect.addEventListener('change', function() {
            const userId = this.dataset.userId;
            const level = this.value;
            const el = this;

            el.disabled = true; // double-submit rokne ke liye

            fetch("{{ route('freelancer.update.profile.level') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        level: level
                    })
                })
                .then(res => res.json())
                .then(data => {
                    el.disabled = false;
                    if (data.status === 'success') {
                        // apna toast/alert helper yaha lga le
                        console.log('Level updated');
                    } else {
                        alert(data.message || 'Update failed');
                    }
                })
                .catch(() => {
                    el.disabled = false;
                    alert('Something went wrong');
                });
        });
    });

    const statusSelect = document.getElementById('accountStatusSelect');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            const userId = this.dataset.userId;
            const status = this.value;
            const el = this;

            el.disabled = true;

            fetch("{{ route('freelancer.update.account.status') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        status: status
                    })
                })
                .then(res => res.json())
                .then(data => {
                    el.disabled = false;
                    if (data.status === 'success') {
                        console.log('Status updated');
                    } else {
                        alert(data.message || 'Update failed');
                    }
                })
                .catch(() => {
                    el.disabled = false;
                    alert('Something went wrong');
                });
        });
    }
</script>
@endsection