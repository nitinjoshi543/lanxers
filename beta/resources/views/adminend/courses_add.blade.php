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

    .document-editor__toolbar{
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
                    <h5 class="m-b-10">Course</h5>
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
                        <form id="editorForm" action="{{ route('submit.courses.add.form') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Category Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="plan_type" data-select2-selector="default">
                                            <option value="0" {{ old('plan_type') == 0 ? 'selected' : '' }}>Paid</option>
                                            <option value="1" {{ old('plan_type') == 1 ? 'selected' : '' }}>Free</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Parent Category <span class="text-danger">*</span></label>
                                        <select class="form-control" name="parent_id" data-select2-selector="default">
                                            @foreach($parent_category as $category)
                                            <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Instructor <span class="text-danger">*</span></label>
                                        <select class="form-control" name="Instructor_id" data-select2-selector="default">
                                            @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}" {{ old('Instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                                

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="course_title" class="form-control" placeholder="Title" value="{{ old('course_title') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Indi price <span class="text-danger">*</span></label>
                                        <input type="text" name="indi_price" class="form-control" placeholder="Indi price" value="{{ old('indi_price') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Commission price <span class="text-danger">*</span></label>
                                        <input type="text" name="commission_price" class="form-control" placeholder="Commission price" value="{{ old('commission_price') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Total Hour <span class="text-danger">*</span></label>
                                        <input type="text" name="total_hour" class="form-control" placeholder="Total Hour" value="{{ old('total_hour') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Total Lesson (only in number) <span class="text-danger">*</span></label>
                                        <input type="text" name="total_lesson" class="form-control" placeholder="Total Lesson (only in number)" value="{{ old('total_lesson') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <input type="hidden" name="description" id="editorContent" value="{{ old('description') }}">
                                        <div class="document-editor">
                                            <div class="document-editor__toolbar"></div>
                                            <div class="document-editor__editable-container">
                                                <div id="editor">{!! old('description') !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Thumbnail (16:9) <span class="text-danger">*only jpg</span></label>
                                        <input type="file" class="form-control" name="thumbnail_1" id="thumbnail_1">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Thumbnail (1x1) <span class="text-danger">*only jpg</span></label>
                                        <input type="file" class="form-control" name="thumbnail_2" id="thumbnail_2">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Thumbnail (9:16) <span class="text-danger">*only jpg</span></label>
                                        <input type="file" class="form-control" name="thumbnail_3" id="thumbnail_3">
                                    </div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Thumbnail (sort) <span class="text-danger">*only jpg</span></label>
                                        <input type="file" class="form-control" name="thumbnail_4" id="thumbnail_4">
                                    </div>
                                </div> -->
                                
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Requirements <span class="text-danger">*</span></label>
                                        <input type="text" name="requirements" class="form-control" placeholder="Requirements" value="{{ old('requirements') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Software Required <span class="text-danger">*</span></label>
                                        <input type="text" name="software_required" class="form-control" placeholder="vs code editor, xampp" value="{{ old('software_required') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ old('meta_title') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Keyword <span class="text-danger">*</span></label>
                                        <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keyword" value="{{ old('meta_keyword') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Description <span class="text-danger">*</span></label>
                                        <input type="text" name="meta_description" class="form-control" placeholder="Meta Description" value="{{ old('meta_description') }}">
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

             // Load old value into CKEditor
            editor.setData(document.getElementById('editorContent').value);
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