@extends('adminend/layouts.main')

@section('main-section')

<style>
    .check_list {
        flex-wrap: wrap;
    }

    .description-editor {
        border: 1px solid #ccc;
        /* max-width: 900px; */
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
    }

    .description-editor__toolbar {
        border-bottom: 1px solid #ddd;
        background: #fff;
        padding: 10px;
    }

    .description-editor__editable-container {
        padding: 10px;
        background: white;
    }

    #description_editor {
        height: 300px !important;
    }
</style>
<style>
    .check_list {
        flex-wrap: wrap;
    }

    .document-editor1 {
        border: 1px solid #ccc;
        /* max-width: 900px; */
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
    }

    .document-editor__toolbar1 {
        border-bottom: 1px solid #ddd;
        background: #fff;
        padding: 10px;
    }

    .document-editor__editable-container1 {
        padding: 10px;
        background: white;
    }

    #editor1 {
        height: 300px !important;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Influencer</h5>
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
                        <form id="editorForm" action="{{ route('submit.influencer.add.form') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Influencer Category <span class="text-danger">*</span></label>
                                        <select class="form-control" name="cat_id" data-select2-selector="default">
                                            @foreach($influencer_category as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Title">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Profession <span class="text-danger">*</span></label>
                                        <input type="text" name="profession" class="form-control" placeholder="Profession">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                        <input type="text" name="short_description" class="form-control" placeholder="Short Description">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <input type="hidden" name="description" id="description" value="{{ old('description') }}">
                                        <div class="description-editor">
                                            <div class="description-editor__toolbar"></div>
                                            <div class="description-editor__editable-container">
                                                <div id="description_editor">{!! old('description') !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Rules <span class="text-danger">*</span></label>
                                        <input type="hidden" name="rules" id="editorContent1" value="{{ old('rules') }}">
                                        <div class="document-editor1">
                                            <div class="document-editor__toolbar1"></div>
                                            <div class="document-editor__editable-container1">
                                                <div id="editor1">{!! old('rules') !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Profile Link <span class="text-danger">*</span></label>
                                        <input type="text" name="profile_link" class="form-control" placeholder="Instagram Profile link">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Followers <span class="text-danger">*</span></label>
                                        <input type="text" name="followers" class="form-control" placeholder="followers">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Image <span class="text-danger">* Only JPG</span></label>
                                        <input type="file" name="fileToUpload" class="form-control" placeholder="Image">
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
    let descriptionEditorInstance;

    DecoupledEditor
        .create(document.querySelector('#description_editor'), {
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
        .then(description_editor => {
            descriptionEditorInstance = description_editor;
            document.querySelector('.description-editor__toolbar').appendChild(description_editor.ui.view.toolbar.element);

            // Load old value into CKEditor
            description_editor.setData(document.getElementById('description').value);
        })
        .catch(error => {
            console.error(error);
        });

    // Capture form submission
    document.getElementById('editorForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get data from CKEditor
        document.getElementById('description').value = descriptionEditorInstance.getData();

        // Submit the form
        this.submit();
    });
</script>
<script>
    let editorInstance1;

    DecoupledEditor
        .create(document.querySelector('#editor1'), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'underline', 'fontColor', 'fontSize',
                    '|', 'bulletedList', 'numberedList', 'alignment', '|',
                    'insertTable', 'imageUpload', 'mediaEmbed', '|',
                    'undo', 'redo'
                ]
            },
            ckfinder: {
                uploadUrl1: ''
            }
        })
        .then(editor1 => {
            editorInstance1 = editor1;
            document.querySelector('.document-editor__toolbar1').appendChild(editor1.ui.view.toolbar.element);

            // Load old value into CKEditor
            editor1.setData(document.getElementById('editorContent1').value);
        })
        .catch(error => {
            console.error(error);
        });

    // Capture form submission
    document.getElementById('editorForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get data from CKEditor
        document.getElementById('editorContent1').value = editorInstance1.getData();

        // Submit the form
        this.submit();
    });
</script>
@endsection