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
                    <h5 class="m-b-10">Webinar</h5>
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
                        <form id="editorForm" action="{{ route('submit.edit.webinar.form', ['id' => $webinar->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_5" id="commentSwitch" <?= ($webinar->product_5 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Standard</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_1" id="commentSwitch" <?= ($webinar->product_1 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Elite</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_2" id="commentSwitch" <?= ($webinar->product_2 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Pro</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_3" id="commentSwitch" <?= ($webinar->product_3 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Supreme</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_6" id="commentSwitch" <?= ($webinar->product_6 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Premium</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_4" id="commentSwitch" <?= ($webinar->product_4 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Plus</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_7" id="commentSwitch" <?= ($webinar->product_7 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Premium Plus</label>
                                        </div>
                                    </section>

                                    <br/><br/>
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $webinar->title }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <input type="text" name="description" class="form-control" placeholder="Description" value="{{ $webinar->description }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Start Date (YYYY-MM-DD HH:MM:SS) <span class="text-danger">*</span></label>
                                        <input type="text" name="start_date" class="form-control" placeholder="Start Date" value="{{ $webinar->start_date }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Join URL <span class="text-danger">*</span></label>
                                        <input type="text" name="join_url" class="form-control" placeholder="Join URL" value="{{ $webinar->join_url }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Embedded URL<span class="text-danger">*</span></label>
                                        <input type="text" name="embedded_url" class="form-control" placeholder="Embedded URL" value="{{ $webinar->embedded_url }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Image <span class="text-danger">* Only JPG</span></label>
                                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                                        <img alt="{{ $webinar->image }}" src="@if($webinar->image) {{ $webinar->image }} @endif" height="100" width="100" />
                                    </div>
                                </div>

                                <input type="hidden" name="existing_image" value="{{ $webinar->image }}">

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