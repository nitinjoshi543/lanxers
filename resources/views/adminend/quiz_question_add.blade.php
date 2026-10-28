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
                    <h5 class="m-b-10">Quiz Question</h5>
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
                        <form id="editorForm" action="{{ route('submit.quiz.question.add.form') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Quiz <span class="text-danger">*</span></label>
                                        <select class="form-control" name="quiz_id" data-select2-selector="default">
                                            <option value=""> Select Quiz</option>
                                            @foreach($quiz_category as $category)
                                            <option value="{{ $category->quiz_id }}">{{ $category->quiz_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Question <span class="text-danger">*</span></label>
                                        <input type="text" name="question" class="form-control" placeholder="Enter Your Question Here">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Option 1 <span class="text-danger">*</span></label>
                                        <input type="text" name="option_1" class="form-control" placeholder="Option 1">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Option 2 <span class="text-danger">*</span></label>
                                        <input type="text" name="option_2" class="form-control" placeholder="Option 2">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Option 3 <span class="text-danger">*</span></label>
                                        <input type="text" name="option_3" class="form-control" placeholder="Option 3">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Option 4 <span class="text-danger">*</span></label>
                                        <input type="text" name="option_4" class="form-control" placeholder="Option 4">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <div class="form-group">
                                            Correct Answer :
                                            <input type="radio" name="answer" value="option_1" id="option_1" class="with-gap">
                                            <label for="option_1">Option 1</label>

                                            <input type="radio" name="answer" value="option_2" id="option_2" class="with-gap">
                                            <label for="option_2" class="m-l-20">Option 2</label>

                                            <input type="radio" name="answer" value="option_3" id="option_3" class="with-gap">
                                            <label for="option_3" class="m-l-20">Option 3</label>

                                            <input type="radio" name="answer" value="option_4" id="option_4" class="with-gap">
                                            <label for="option_4" class="m-l-20">Option 4</label>
                                        </div>
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