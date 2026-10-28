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
                    <h5 class="m-b-10">Freelance Category</h5>
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
                        <form id="moduleForm" action="{{ route('submit.edit.freelance.category.form', ['id' => $freelance->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $freelance->title }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Language <span class="text-danger">*</span></label>
                                        <input type="text" name="language" class="form-control" placeholder="language" value="{{ $freelance->language }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                                        <img alt="{{ $freelance->thumbnail }}" src="@if($freelance->thumbnail) {{ $freelance->thumbnail }} @endif" height="100" width="100" />
                                    </div>
                                </div>
                                <input type="hidden" name="existing_thumbnail" value="{{ $freelance->thumbnail }}">

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Video Link <span class="text-danger">*</span></label>
                                        <input type="text" name="video_link" class="form-control" placeholder="TP Stream Video Link" value="{{ $freelance->video_link }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Comunity Link <span class="text-danger">*</span></label>
                                        <input type="text" name="comunity_link" class="form-control" placeholder="What's App Comunity Link" value="{{ $freelance->comunity_link }}" required>
                                    </div>
                                </div>

                                <hr class="my-0"> <br />
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection 