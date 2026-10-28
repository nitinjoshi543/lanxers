@extends('adminend/layouts.main')

@section('main-section')

<style>
    .document-editor {
        border: 1px solid #ccc;
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
    #descriptionEditor, #aboutEditor {
        min-height: 250px;
    }
</style>

<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">External Job</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('external.jobs.list') }}">External Jobs</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ul>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
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
                            <form id="editorForm" action="{{ route('submit.edit.external.jobs.employer.form', ['id' => $job->id]) }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <h6 class="fw-bold mb-3">Job Details</h6>
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Organization</label>
                                        <input type="text" name="organization" class="form-control" value="{{ old('organization', $job->organization) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Organization Logo URL</label>
                                        <input type="text" name="organization_logo" class="form-control" value="{{ old('organization_logo', $job->organization_logo) }}">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Job URL</label>
                                        <input type="text" name="url" class="form-control" value="{{ old('url', $job->url) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Location</label>
                                        <input type="text" name="locations" class="form-control" value="{{ old('locations', $job->locations) }}">
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Employment Type</label>
                                        <input type="text" name="employment_type" class="form-control" value="{{ old('employment_type', $job->employment_type) }}">
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Seniority</label>
                                        <input type="text" name="seniority" class="form-control" value="{{ old('seniority', $job->seniority) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Posted On</label>
                                        <input type="datetime-local" name="date_posted" class="form-control"
                                            value="{{ old('date_posted', $job->date_posted ? \Carbon\Carbon::parse($job->date_posted)->format('Y-m-d\TH:i') : '') }}">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Valid Through</label>
                                        <input type="datetime-local" name="date_valid_through" class="form-control"
                                            value="{{ old('date_valid_through', $job->date_valid_through ? \Carbon\Carbon::parse($job->date_valid_through)->format('Y-m-d\TH:i') : '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Job Description</label>
                                        <input type="hidden" name="description_text" id="descriptionEditorContent">
                                        <div class="document-editor">
                                            <div class="document-editor__toolbar" id="descriptionToolbar"></div>
                                            <div class="document-editor__editable-container">
                                                <div id="descriptionEditor">{!! old('description_text', $job->description_text) !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mb-3 mt-2">AI Insights</h6>
                                <div class="row">
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Experience Level</label>
                                        <input type="text" name="ai_experience_level" class="form-control" value="{{ old('ai_experience_level', $job->ai_experience_level) }}">
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Work Arrangement</label>
                                        <input type="text" name="ai_work_arrangement" class="form-control" value="{{ old('ai_work_arrangement', $job->ai_work_arrangement) }}">
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Office Days</label>
                                        <input type="text" name="ai_work_arrangement_office_days" class="form-control" value="{{ old('ai_work_arrangement_office_days', $job->ai_work_arrangement_office_days) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Key Skills <span class="text-muted fs-12">(comma separated)</span></label>
                                        @php
                                            $skillsArr = json_decode($job->ai_key_skills ?? '[]', true) ?: [];
                                        @endphp
                                        <textarea name="ai_key_skills" rows="2" class="form-control">{{ old('ai_key_skills', implode(', ', $skillsArr)) }}</textarea>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mb-3 mt-2">Company Details</h6>
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Website</label>
                                        <input type="text" name="org_linkedin_website" class="form-control" value="{{ old('org_linkedin_website', $job->org_linkedin_website) }}">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Company Size</label>
                                        <input type="text" name="org_linkedin_size" class="form-control" value="{{ old('org_linkedin_size', $job->org_linkedin_size) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Industry</label>
                                        <input type="text" name="org_linkedin_industry" class="form-control" value="{{ old('org_linkedin_industry', $job->org_linkedin_industry) }}">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Slogan</label>
                                        <input type="text" name="org_linkedin_slogan" class="form-control" value="{{ old('org_linkedin_slogan', $job->org_linkedin_slogan) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">About</label>
                                        <input type="hidden" name="org_linkedin_description" id="aboutEditorContent">
                                        <div class="document-editor">
                                            <div class="document-editor__toolbar" id="aboutToolbar"></div>
                                            <div class="document-editor__editable-container">
                                                <div id="aboutEditor">{!! old('org_linkedin_description', $job->org_linkedin_description) !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-0"><br>
                                <button type="submit" class="btn btn-primary">Update Job</button>
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
    let aboutEditorInstance;

    // Job Description Editor
    DecoupledEditor
        .create(document.querySelector('#descriptionEditor'), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'underline', 'fontColor', 'fontSize',
                    '|', 'bulletedList', 'numberedList', 'alignment', '|',
                    'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo'
                ]
            }
        })
        .then(editor => {
            descriptionEditorInstance = editor;
            document.querySelector('#descriptionToolbar').appendChild(editor.ui.view.toolbar.element);
        })
        .catch(error => console.error(error));

    // About / Company Description Editor
    DecoupledEditor
        .create(document.querySelector('#aboutEditor'), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'underline', 'fontColor', 'fontSize',
                    '|', 'bulletedList', 'numberedList', 'alignment', '|',
                    'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo'
                ]
            }
        })
        .then(editor => {
            aboutEditorInstance = editor;
            document.querySelector('#aboutToolbar').appendChild(editor.ui.view.toolbar.element);
        })
        .catch(error => console.error(error));

    // Capture form submission — dono editors ka data hidden fields me daalo
    document.getElementById('editorForm').addEventListener('submit', function(event) {
        event.preventDefault();

        if (descriptionEditorInstance) {
            document.getElementById('descriptionEditorContent').value = descriptionEditorInstance.getData();
        }
        if (aboutEditorInstance) {
            document.getElementById('aboutEditorContent').value = aboutEditorInstance.getData();
        }

        this.submit();
    });
</script>
@endsection