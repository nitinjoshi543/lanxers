@extends('adminend/layouts.main')

@section('main-section')
<style>
    .check_list {
        flex-wrap: wrap;
    }

    .document-editor {
        border: 1px solid #ccc;
        /* max-width: 900px; */
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
    }

    .document-editor__toolbar {
        border-bottom: 1px solid #ddd;
        background: #fff;
        padding: 10px;
    }

    .document-editor__editable-container {
        padding: 10px;
        background: white;
    }

    #editor {
        height: 300px !important;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Freelance Trainning</h5>
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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="main-content">
            <div class="row">
                <div class="col-12">
                    <div class="card stretch stretch-full">
                        <form id="editorForm" action="{{ route('submit.edit.freelance.trainning.form', ['id' => $ten_days->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Training Category <span class="text-danger">*</span></label>
                                        <select class="form-control" name="parent" data-select2-selector="default">
                                            <option value=""> Select </option>
                                            @foreach($ten_days_trainning as $category)
                                            @php
                                            if($category->lang == 0){
                                                $lang = 'Hindi';
                                            }else if($category->lang == 1){
                                                $lang = 'Tamil';
                                            }else if($category->lang == 2){
                                                $lang = 'English';
                                            }
                                            @endphp
                                            <option value="{{ $category->id }}" @if($ten_days->parent == $category->id) selected @endif>{{ $category->title }} ({{ $lang }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $ten_days->title }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Language <span class="text-danger">*</span></label>
                                        <select class="form-control" name="lang" data-select2-selector="default">
                                            <option value="0" @if($ten_days->lang == 0) selected @endif>Hindi</option>
										    <option value="1" @if($ten_days->lang == 1) selected @endif>Tamil</option>
                                            <option value="2" @if($ten_days->lang == 2) selected @endif>English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Image <span class="text-danger">* Only JPG</span></label>
                                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                                        <img alt="{{ $ten_days->image }}" src="@if($ten_days->image) {{ $ten_days->image }} @endif" height="100" width="100" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Youtube / Vimeo URL <span class="text-danger">*</span></label>
                                        <input type="text" name="image3" class="form-control" placeholder="Youtube / Vimeo URL" value="{{ $ten_days->youtube_playlist }}">
                                    </div>
                                </div>

                                <input type="hidden" name="existing_image" value="{{ $ten_days->image }}">

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