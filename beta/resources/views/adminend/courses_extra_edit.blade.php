@extends('adminend/layouts.main')

@section('main-section')
<style>
    .check_list {
        flex-wrap: wrap;
    }

    .document-editor,
    .document-editor2 {
        border: 1px solid #ccc;
        /* max-width: 900px; */
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
    }

    .document-editor__toolbar,
    .document-editor__toolbar2 {
        border-bottom: 1px solid #ddd;
        background: #fff;
        padding: 10px;
    }

    .document-editor__editable-container,
    .document-editor__editable-container2 {
        padding: 10px;
        background: white;
    }

    #editor,
    #editor2 {
        height: 300px !important;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Course Extra Details</h5>
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
                        <form id="editorForm" action="{{ route('submit.edit.courses.extra.form', ['id' => $courses_extra->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Course <span class="text-danger">*</span></label>
                                        <select class="form-control" name="course_id" data-select2-selector="default">
                                            @foreach($courses as $course)
                                            <option value="{{ $course->id }}" @if($courses_extra->course_id  == $course->id) selected @endif>{{ $course->course_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">What you will learn? <span class="text-danger">*</span></label>
                                        <input type="hidden" name="learn" id="editorContent2">
                                        <div class="document-editor2">
                                            <div class="document-editor__toolbar2"></div>
                                            <div class="document-editor__editable-container2">
                                                <div id="editor2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Course Bundle Summary <span class="text-danger">*</span></label>
                                        <input type="hidden" name="skills" id="editorContent">
                                        <div class="document-editor">
                                            <div class="document-editor__toolbar"></div>
                                            <div class="document-editor__editable-container">
                                                <div id="editor"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">FAQ <span class="text-danger">*</span></label>
                                        <input type="text" name="faq_1" class="form-control" placeholder="FAQ 1" value="{{ $courses_extra->faq_1 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                                        <input type="text" name="ans_1" class="form-control" placeholder="FAQ Answer 1" value="{{ $courses_extra->ans_1 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">FAQ <span class="text-danger">*</span></label>
                                        <input type="text" name="faq_2" class="form-control" placeholder="FAQ 2" value="{{ $courses_extra->faq_2 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                                        <input type="text" name="ans_2" class="form-control" placeholder="FAQ Answer 2" value="{{ $courses_extra->ans_2 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">FAQ <span class="text-danger">*</span></label>
                                        <input type="text" name="faq_3" class="form-control" placeholder="FAQ 3" value="{{ $courses_extra->faq_3 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                                        <input type="text" name="ans_3" class="form-control" placeholder="FAQ Answer 3" value="{{ $courses_extra->ans_3 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">FAQ <span class="text-danger">*</span></label>
                                        <input type="text" name="faq_4" class="form-control" placeholder="FAQ 4" value="{{ $courses_extra->faq_4 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                                        <input type="text" name="ans_4" class="form-control" placeholder="FAQ Answer 4" value="{{ $courses_extra->ans_4 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">FAQ <span class="text-danger">*</span></label>
                                        <input type="text" name="faq_5" class="form-control" placeholder="FAQ 5" value="{{ $courses_extra->faq_5 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                                        <input type="text" name="ans_5" class="form-control" placeholder="FAQ Answer 5" value="{{ $courses_extra->ans_5 }}">
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

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/decoupled-document/ckeditor.js"></script>
<script>
    let editorInstance;
    let editorInstance2;

    DecoupledEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'underline', 'fontColor', 'fontSize',
                    '|', 'bulletedList', 'numberedList', 'alignment', '|',
                    'insertTable', 'imageUpload', 'mediaEmbed', '|',
                    'undo', 'redo'
                ]
            },
            ckfinder: {
                uploadUrl: ''
            }
        })
        .then(editor => {
            editorInstance = editor;
            document.querySelector('.document-editor__toolbar').appendChild(editor.ui.view.toolbar.element);
            let descriptionValue3 = `{!! $courses_extra->skills !!}`;
            editor.setData(descriptionValue3);
        })
        .catch(error => {
            console.error(error);
        }); 

    DecoupledEditor
        .create(document.querySelector('#editor2'), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'underline', 'fontColor', 'fontSize',
                    '|', 'bulletedList', 'numberedList', 'alignment', '|',
                    'insertTable', 'imageUpload', 'mediaEmbed', '|',
                    'undo', 'redo'
                ]
            },
            ckfinder: {
                uploadUrl: ''
            }
        })
        .then(editor => {
            editorInstance2 = editor;
            document.querySelector('.document-editor__toolbar2').appendChild(editor.ui.view.toolbar.element);
            let descriptionValue3 = `{!! $courses_extra->learn !!}`;
            editor.setData(descriptionValue3);
        })
        .catch(error => {
            console.error(error);
        });

    // Capture form submission
    document.getElementById('editorForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get data from CKEditor
        document.getElementById('editorContent').value = editorInstance.getData();
        document.getElementById('editorContent2').value = editorInstance2.getData();

        // Submit the form
        this.submit();
    });
</script>
@endsection