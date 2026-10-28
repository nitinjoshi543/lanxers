@extends('adminend/layouts.main')

@section('main-section')

<style>
    .check_list {
        flex-wrap: wrap;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Add Raw Folder</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Add</li>
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
                <div class="col-12">
                    <div class="card stretch stretch-full">
                        <form id="moduleForm" action="{{ route('submit.add.form.raw.folder') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Choose Influencer<span class="text-danger">*</span></label>
                                        <select class="form-control" name="influencer_id" data-select2-selector="default">
                                            @foreach($influencer_list as $list)
                                            <option value="{{ $list->influencer_id }}">{{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Title">
                                    </div>
                                </div>

                                <hr class="my-0"> <br />
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection