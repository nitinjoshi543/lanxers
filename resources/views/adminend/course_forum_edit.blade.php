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
                    <h5 class="m-b-10">Course Forum</h5>
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
                        <form id="editorForm" action="{{ route('submit.edit.course.forum', ['id' => $course_forum->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Question <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="question" id="question" placeholder="Enter question" value="{{ $course_forum->question }}" required>
                                        <input type="hidden" class="form-control" name="users_id" id="users_id" placeholder="users_id" value="{{ $course_forum->users_id }}" required>
                                        <input type="hidden" class="form-control" name="course_id" id="course_id" placeholder="course_id" value="{{ $course_forum->course_id }}" required>
                                        <!-- <p>{{ $course_forum->question }}</p> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Question Images <span class="text-danger">*</span></label>
                                        <br />
                                        @if(!empty($course_forum->qus_img))
                                        @php
                                        // Split by comma (handles both single & multiple)
                                        $images = explode(',', $course_forum->qus_img);
                                        @endphp

                                        @foreach($images as $img)
                                        @if(!empty(trim($img)))
                                        <img src="{{ $img }}"
                                            alt="Question Image"
                                            class="img-fluid me-2 mb-2"
                                            style="max-width:200px; border:1px solid #ddd; padding:4px; border-radius:6px;">
                                        @endif
                                        @endforeach
                                        @else
                                        <p>No image uploaded</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                                        <input type="hidden" name="answer" id="editorContent">
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
                                        <label class="form-label">Answer Image <span class="text-danger">(upload only jpg)</span></label>
                                        <input type="file" class="form-control" name="ans_img[]" id="ans_img" multiple>
                                        @if(!empty($course_forum->ans_img))
                                        @php
                                        // Handle both single and multiple (comma separated)
                                        $ansImages = explode(',', $course_forum->ans_img);
                                        @endphp

                                        <div class="mt-3">
                                            @foreach($ansImages as $img)
                                            @if(!empty(trim($img)))
                                            <img src="{{ $img }}"
                                                alt="Answer Image"
                                                class="img-fluid me-2 mb-2"
                                                style="max-width:200px; border:1px solid #ddd; padding:4px; border-radius:6px;">
                                            @endif
                                            @endforeach
                                        </div>
                                        @else
                                        <p>No answer image uploaded</p>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="ans_img" value="{{ $course_forum->ans_img }}">

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
            let descriptionValue3 = `{!! $course_forum->answer !!}`;
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

        // Submit the form
        this.submit();
    });
</script>
@endsection