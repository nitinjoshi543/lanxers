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
                    <h5 class="m-b-10">Freelance Testimony</h5>
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
                        <form id="moduleForm" action="{{ route('submit.edit.freelance.testimony.form', ['id' => $freelance->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $freelance->name }}" disabled>
                                        <input type="hidden" name="users_id" class="form-control" placeholder="users_id" value="{{ $freelance->users_id }}" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" class="form-control" placeholder="email" value="{{ $freelance->email }}" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">
                                            Content Type <span class="text-danger">*</span>
                                        </label>

                                        <!-- Hidden field for submission -->
                                        <input type="hidden" name="content_type" 
                                            value="{{ old('content_type', $freelance->type ?? '') }}">

                                        <!-- Disabled select for display only -->
                                        <select class="form-control" disabled>
                                            <option value="">Select Content Type</option>

                                            <option value="text"
                                                {{ old('content_type', $freelance->type ?? '') == 'text' ? 'selected' : '' }}>
                                                Text
                                            </option>

                                            <option value="video"
                                                {{ old('content_type', $freelance->type ?? '') == 'video' ? 'selected' : '' }}>
                                                Video
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                @if($freelance->type == 'text')
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label class="form-label">Content<span class="text-danger">( Max 200 Characters )*</span>
                                            </label>
                                            <textarea name="content" class="form-control" placeholder="Content" rows="4" required>{{ old('content', $freelance->content ?? '') }}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label class="form-label">Content <span class="text-danger">( Plese insert tp stream Link only )*</span></label>
                                            <input type="text" name="content" class="form-control" placeholder="TP Stream Video Link" value="{{ $freelance->content }}" required>
                                        </div>
                                    </div>
                                @endif

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