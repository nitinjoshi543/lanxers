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
                    <h5 class="m-b-10">Gift Task</h5>
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
                        <form id="editorForm" action="{{ route('submit.gift.task.add.form') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product[]" id="commentSwitch" value="1">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Elite</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product[]" id="commentSwitch" value="2">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Pro</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product[]" id="commentSwitch" value="3">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Supreme</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product[]" id="commentSwitch" value="5">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Standard</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product[]" id="commentSwitch" value="4">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Premium</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-2">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product[]" id="commentSwitch" value="6">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Premium Plus</label>
                                        </div>
                                    </section>
                                </div>
                                <br /><br />
                                <div class="row">
                                    <label class="form-label">Plan Product for Sale (Optional. In case of blank for all.) <span class="text-danger">*</span></label>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_plan[]" id="commentSwitch" value="1">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Elite</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_plan[]" id="commentSwitch" value="2">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Pro</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_plan[]" id="commentSwitch" value="3">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Supreme</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_plan[]" id="commentSwitch" value="5">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Standard</label>
                                        </div>
                                    </section>
                                    <section class="col col-md-1">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_plan[]" id="commentSwitch" value="4">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Premium</label>
                                        </div>
                                    </section>

                                    <section class="col col-md-2">
                                        <div class="form-check form-switch form-switch-sm ps-5">
                                            <input class="form-check-input c-pointer" type="checkbox" name="product_plan[]" id="commentSwitch" value="6">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Premium Plus</label>
                                        </div>
                                    </section>
                                </div>
                                <br /><br />
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Minimum Joining Eligibility Date(User Joining date for eligible) <span class="text-danger">*</span></label>
                                        <input type="date" name="eligibility_date" class="form-control" placeholder="">
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
                                        <label class="form-label">Task Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="task_image" id="image1">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Task Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="task_type" data-select2-selector="default">
                                            <option value="0">Referral</option>
                                            <option value="1">Amount</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Task Range <span class="text-danger">*</span></label>
                                        <input type="text" name="task_range" class="form-control" placeholder="Task Range">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Gift Title <span class="text-danger">*</span></label>
                                        <input type="text" name="gift_title" class="form-control" placeholder="Gift Title">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Gift Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="gift_image" id="image1">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Task Duration(in days) <span class="text-danger">*</span></label>
                                        <input type="text" name="task_duration" class="form-control" placeholder="Task Duration(in days)">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Task End date <span class="text-danger">*</span></label>
                                        <input type="date" name="task_end_date" class="form-control" placeholder="Task End date">
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