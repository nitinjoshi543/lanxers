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
                    <h5 class="m-b-10">Course</h5>
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
                        <form id="editorForm" action="{{ route('submit.edit.courses.form', ['id' => $courses->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_1" id="commentSwitch" <?= ($courses->product_1 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Elite</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_2" id="commentSwitch" <?= ($courses->product_2 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Pro</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_3" id="commentSwitch" <?= ($courses->product_3 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Supreme</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_5" id="commentSwitch" <?= ($courses->product_5 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Standard</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_4" id="commentSwitch" <?= ($courses->product_4 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Premium</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-2">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_6" id="commentSwitch" <?= ($courses->product_6 == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Premium Plus</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="trend" id="commentSwitch" <?= ($courses->trend == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Trending</label>
                                        </div>
                                    </section>

                                    <br /> <br />

                                </div>

                                <!-- 2 row -->
                                <div class="row">
                                <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="finance" id="commentSwitch" <?= ($courses->finance == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Finance</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="status" id="commentSwitch" <?= ($courses->status == 2) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Test</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="hindi" id="commentSwitch" <?= ($courses->hindi == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Hindi</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="english" id="commentSwitch" <?= ($courses->english == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">English</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="tamil" id="commentSwitch" <?= ($courses->tamil == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Tamil</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="telugu" id="commentSwitch" <?= ($courses->telugu == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Telugu</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="kannada" id="commentSwitch" <?= ($courses->kannada == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Kannada</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-2">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="best_seller" id="commentSwitch" <?= ($courses->best_seller == 0) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Best Seller</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-2">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="new_launch" id="commentSwitch" <?= ($courses->new_launch == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">New Launch</label>
                                        </div>
                                    </section>

                                    <br /> <br />

                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Category Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="plan_type" data-select2-selector="default">
                                            <option value="0" @if($courses->plan_type == 0) selected @endif>Paid</option>
                                            <option value="1" @if($courses->plan_type == 1) selected @endif>Free</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- 2 row end -->

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Parent Category <span class="text-danger">*</span></label>
                                        <select class="form-control" name="parent_id" data-select2-selector="default">
                                            @foreach($parent_category as $category)
                                            <option value="{{ $category->id }}" @if($courses->parent_id == $category->id) selected @endif>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Instructor <span class="text-danger">*</span></label>
                                        <select class="form-control" name="Instructor_id" data-select2-selector="default">
                                            @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}" @if($courses->instructor_id == $instructor->id) selected @endif>{{ $instructor->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="course_title" class="form-control" placeholder="Title" value="{{ $courses->course_title }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Indi price <span class="text-danger">*</span></label>
                                        <input type="text" name="indi_price" class="form-control" placeholder="Indi price" value="{{ $courses->indi_price }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Commission price <span class="text-danger">*</span></label>
                                        <input type="text" name="commission_price" class="form-control" placeholder="Commission price" value="{{ $courses->commission_price }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Total Hour <span class="text-danger">*</span></label>
                                        <input type="text" name="total_hour" class="form-control" placeholder="Total Hour" value="{{ $courses->total_hour }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Total Lesson (only in number) <span class="text-danger">*</span></label>
                                        <input type="text" name="total_lesson" class="form-control" placeholder="Total Lesson (only in number)" value="{{ $courses->total_lesson }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <input type="hidden" name="description" id="editorContent">
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
                                        <label class="form-label">Thumbnail (16:9) <span class="text-danger">*only jpg</span></label>
                                        <input type="file" class="form-control" name="thumbnail_1" id="thumbnail_1">
                                        <img class="w-100" alt="{{ $courses->thumbnail_1 }}" src="@if($courses->thumbnail_1) {{ $courses->thumbnail_1 }} @endif"/>
                                    </div>
                                </div>
                                <input type="hidden" name="existing_image_thumbnail_1" value="{{ $courses->thumbnail_1 }}">

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Thumbnail (1x1) <span class="text-danger">*only jpg</span></label>
                                        <input type="file" class="form-control" name="thumbnail_2" id="thumbnail_2">
                                        <img class="w-100" alt="{{ $courses->thumbnail_2 }}" src="@if($courses->thumbnail_2) {{ $courses->thumbnail_2 }} @endif"/>
                                    </div>
                                </div>

                                <input type="hidden" name="existing_image_thumbnail_2" value="{{ $courses->thumbnail_2 }}">

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Thumbnail (9:16) <span class="text-danger">*only jpg</span></label>
                                        <input type="file" class="form-control" name="thumbnail_3" id="thumbnail_3">
                                        <img class="w-100" alt="{{ $courses->thumbnail_3 }}" src="@if($courses->thumbnail_3) {{ $courses->thumbnail_3 }} @endif"/>
                                    </div>
                                </div>

                                <input type="hidden" name="existing_image_thumbnail_3" value="{{ $courses->thumbnail_3 }}">

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Thumbnail (sort) <span class="text-danger">*only jpg</span></label>
                                        <input type="file" class="form-control" name="thumbnail_4" id="thumbnail_4">
                                        <img class="w-100" alt="{{ $courses->thumbnail_4 }}" src="@if($courses->thumbnail_4) {{ $courses->thumbnail_4 }} @endif"/>
                                    </div>
                                </div>

                                <input type="hidden" name="existing_image_thumbnail_4" value="{{ $courses->thumbnail_4 }}">

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Requirements <span class="text-danger">*</span></label>
                                        <input type="text" name="requirements" class="form-control" placeholder="Requirements" value="{{ $courses->requirements }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Software Required <span class="text-danger">*</span></label>
                                        <input type="text" name="software_required" class="form-control" placeholder="vs code editor, xampp" value="{{ $courses->software_required }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Title <span class="text-danger">*</span></label>
                                        <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ $courses->meta_title }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Keyword <span class="text-danger">*</span></label>
                                        <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keyword" value="{{ $courses->meta_keyword }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Meta Description <span class="text-danger">*</span></label>
                                        <input type="text" name="meta_description" class="form-control" placeholder="Meta Description" value="{{ $courses->meta_description }}">
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
            let descriptionValue3 = `{!! $courses->description !!}`;
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