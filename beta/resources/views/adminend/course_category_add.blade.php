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
                    <h5 class="m-b-10">Course Category</h5>
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
                        <form id="editorForm" action="{{ route('submit.course.category.add.form') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Category Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="type" data-select2-selector="default">
                                            <option value="0">Paid</option>
                                            <option value="1">Free</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Course Language <span class="text-danger">*</span></label>
                                        <select class="form-control" name="course_language" data-select2-selector="default">
                                            <option value="0">Hindi</option>
                                            <option value="1">English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Course Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="c_type" data-select2-selector="default">
                                            <option value="0">IDP</option>
                                            <option value="1">Eduvince</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Eduvince Course Code (Only for eduvince) <span class="text-danger">*</span></label>
                                        <input type="text" name="eduvince_course_code" class="form-control" placeholder="Eduvince Course Code (Only for eduvince)">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Parent Category <span class="text-danger">*</span></label>
                                        <select class="form-control" name="parent" data-select2-selector="default">
                                            @foreach($parent_category as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Instructor <span class="text-danger">*</span></label>
                                        <select class="form-control" name="instructor_id" data-select2-selector="default">
                                            @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}">{{ $instructor->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Indi price <span class="text-danger">*</span></label>
                                        <input type="text" name="indi_price" class="form-control" placeholder="Indi price">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Commission price <span class="text-danger">*</span></label>
                                        <input type="text" name="commission_price" class="form-control" placeholder="Commission price">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Referral percent <span class="text-danger">*</span></label>
                                        <input type="text" name="referral_per" class="form-control" placeholder="Referral percent">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Title">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Level <span class="text-danger">*</span></label>
                                        <input type="text" name="level" class="form-control" placeholder="Level">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Categories <span class="text-danger">*</span></label>
                                        <input type="text" name="cate" class="form-control" placeholder="Categories">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Total Hour <span class="text-danger">*</span></label>
                                        <input type="text" name="total_hour" class="form-control" placeholder="Total Hour">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Total Lesson (only in number) <span class="text-danger">*</span></label>
                                        <input type="text" name="total_lesson" class="form-control" placeholder="Total Lesson (only in number)">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                        <input type="hidden" name="description2" id="editorContent">
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
                                        <label class="form-label">Overview <span class="text-danger">*</span></label>
                                        <input type="hidden" name="description" id="editorContent2">
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
                                        <label class="form-label">Instructors <span class="text-danger">*</span></label>
                                        <input type="hidden" name="description3" id="editorContent3">
                                        <div class="document-editor3">
                                            <div class="document-editor__toolbar3"></div>
                                            <div class="document-editor__editable-container2">
                                                <div id="editor3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" name="page_title" class="form-control" placeholder="Meta Title">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Keyword <span class="text-danger">*</span></label>
                                        <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keyword">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Description <span class="text-danger">*</span></label>
                                        <input type="text" name="meta_description" class="form-control" placeholder="Meta Description">
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

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/decoupled-document/ckeditor.js"></script>
<script>
    let editorInstance;
    let editorInstance2;
    let editorInstance3;

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
        })
        .catch(error => {
            console.error(error);
        });

    DecoupledEditor
        .create(document.querySelector('#editor3'), {
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
            editorInstance3 = editor;
            document.querySelector('.document-editor__toolbar3').appendChild(editor.ui.view.toolbar.element);
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
        document.getElementById('editorContent3').value = editorInstance3.getData();

        // Submit the form
        this.submit();
    });
</script>
@endsection