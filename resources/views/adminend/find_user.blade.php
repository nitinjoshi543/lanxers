@extends('adminend/layouts.main')

@section('main-section')
<style>
    .check_list {
        flex-wrap: wrap;
    }

    .document-editor,
    .document-editor2,
    .document-editor3 {
        border: 1px solid #ccc;
        /* max-width: 900px; */
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
    }

    .document-editor__toolbar,
    .document-editor__toolbar2,
    .document-editor__toolbar3 {
        border-bottom: 1px solid #ddd;
        background: #fff;
        padding: 10px;
    }

    .document-editor__editable-container,
    .document-editor__editable-container2,
    .document-editor__editable-container3 {
        padding: 10px;
        background: white;
    }

    #editor,
    #editor2,
    #editor3 {
        height: 300px !important;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Find User</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">list</li>
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
                        <form id="editorForm" action="{{ route('submit.find.user.form') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Enter User's Number <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" placeholder="Enter Users Number">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Enter User's Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" class="form-control" placeholder="Enter Users Email">
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