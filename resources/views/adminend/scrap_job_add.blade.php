@extends('adminend/layouts.main')

@section('main-section')

<style>

    .skill-tag {
    background: #e8f8ea;
    color: #2e7d32;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    }

    .skill-tag .remove-skill {
        cursor: pointer;
        font-weight: bold;
    }

    #skillSuggestions .list-group-item {
        cursor: pointer;
    }

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
                    <h5 class="m-b-10">Add Job</h5>
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
                        <form id="editorForm" action="{{ route('jobs.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Jobs Category <span class="text-danger">*</span></label>
                                        <select class="form-control" name="cat_id" data-select2-selector="default">
                                            @foreach($job_category as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Choose Employer <span class="text-danger">*</span></label>
                                        <select class="form-control" name="emp_id" data-select2-selector="default">
                                            @foreach($employer as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->employer_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Job Title">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Description -->
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
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Skills and Expertise <span class="text-danger">*</span></label>

                                        <div style="position: relative;">
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                <input
                                                    type="text"
                                                    id="skillInputBox"
                                                    class="form-control"
                                                    placeholder="Add a skill (e.g., React, UI Design, Python)"
                                                    autocomplete="off"
                                                    style="border-radius: 8px; padding: 10px 15px;">

                                                <button
                                                    type="button"
                                                    id="addSkillBtn"
                                                    style="background:#8ee69b; border:none; border-radius:8px; width:45px; height:45px; font-size:22px; color:#1b5e20; flex-shrink:0;">
                                                    +
                                                </button>
                                            </div>

                                            <!-- Suggestions dropdown -->
                                            <div id="skillSuggestions" class="list-group" style="position: absolute; top: 100%; left: 0; right: 60px; z-index: 999; display: none; max-height: 180px; overflow-y: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"></div>
                                        </div>

                                        <!-- Selected skill tags -->
                                        <div id="selectedSkillsWrapper" class="d-flex flex-wrap mt-3" style="gap: 10px;"></div>

                                        <!-- Hidden inputs jo form submit ke sath skills[] bhejenge -->
                                        <div id="hiddenSkillInputs"></div>

                                        @error('skills')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Budget Min / Max -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Budget Min <span class="text-danger">*</span></label>
                                        <input type="number" name="budget_min" value="{{ old('budget_min') }}" class="form-control" placeholder="Minimum Budget">
                                        @error('budget_min')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Budget Max <span class="text-danger">*</span></label>
                                        <input type="number" name="budget_max" value="{{ old('budget_max') }}" class="form-control" placeholder="Maximum Budget">
                                        @error('budget_max')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Experience Level -->
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Experience Level <span class="text-danger">*</span></label>
                                        <select class="form-control" name="experience_level" data-select2-selector="default">
                                            <option value="">Select Experience Level</option>
                                            <option value="fresher" {{ old('experience_level') == 'fresher' ? 'selected' : '' }}>Fresher</option>
                                            <option value="1-3" {{ old('experience_level') == '1-3' ? 'selected' : '' }}>1 - 3 Years</option>
                                            <option value="3-5" {{ old('experience_level') == '3-5' ? 'selected' : '' }}>3 - 5 Years</option>
                                            <option value="5-10" {{ old('experience_level') == '5-10' ? 'selected' : '' }}>5 - 10 Years</option>
                                            <option value="10+" {{ old('experience_level') == '10+' ? 'selected' : '' }}>10+ Years</option>
                                        </select>
                                        @error('experience_level')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Location Type -->
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Location Type <span class="text-danger">*</span></label>
                                        <div class="check_list d-flex align-items-center">
                                            <div class="form-check me-4">
                                                <input class="form-check-input location-type-radio" type="radio" name="location_type" id="locationRemote" value="remote" {{ old('location_type') == 'remote' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="locationRemote">Remote</label>
                                            </div>
                                            <div class="form-check me-4">
                                                <input class="form-check-input location-type-radio" type="radio" name="location_type" id="locationHybrid" value="hybrid" {{ old('location_type') == 'hybrid' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="locationHybrid">Hybrid</label>
                                            </div>
                                            <div class="form-check me-4">
                                                <input class="form-check-input location-type-radio" type="radio" name="location_type" id="locationOnsite" value="on-site" {{ old('location_type') == 'on-site' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="locationOnsite">On-site</label>
                                            </div>
                                        </div>
                                        @error('location_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Location (conditional) -->
                                <div class="row" id="locationFieldWrapper" style="display: none;">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" name="location" id="locationInput" value="{{ old('location') }}" class="form-control" placeholder="Enter Location (City, State, Country)">
                                        @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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

    // Toggle location input based on location_type selection
    function toggleLocationField() {
        const selected = document.querySelector('input[name="location_type"]:checked');
        const wrapper = document.getElementById('locationFieldWrapper');
        const input = document.getElementById('locationInput');

        if (selected && (selected.value === 'hybrid' || selected.value === 'on-site')) {
            wrapper.style.display = 'flex';
            input.setAttribute('required', 'required');
        } else {
            wrapper.style.display = 'none';
            input.removeAttribute('required');
            input.value = '';
        }
    }

    document.querySelectorAll('.location-type-radio').forEach(function(radio) {
        radio.addEventListener('change', toggleLocationField);
    });

    // Run on page load in case of old() value (validation error reload)
    document.addEventListener('DOMContentLoaded', toggleLocationField);

</script>

<script>
    (function() {
    const skillInput      = document.getElementById('skillInputBox');
    const addBtn           = document.getElementById('addSkillBtn');
    const suggestionsBox  = document.getElementById('skillSuggestions');
    const selectedWrapper = document.getElementById('selectedSkillsWrapper');
    const hiddenWrapper   = document.getElementById('hiddenSkillInputs');

    let selectedSkills = [];
    let debounceTimer;

    // Type hote hi search
    skillInput.addEventListener('input', function() {
        const term = this.value.trim();
        clearTimeout(debounceTimer);

        if (term.length === 0) {
            suggestionsBox.style.display = 'none';
            suggestionsBox.innerHTML = '';
            return;
        }

        debounceTimer = setTimeout(function() {
            fetch(`{{ route('skills.search') }}?q=${encodeURIComponent(term)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                console.log('Skills API response:', data); // debug ke liye — check console
                renderSuggestions(data, term);
            })
            .catch(err => console.error('Skill search error:', err));
        }, 250);
    });

    function renderSuggestions(data, term) {
        suggestionsBox.innerHTML = '';

        const exactMatch = data.some(skill => skill.name.toLowerCase() === term.toLowerCase());

        data.forEach(function(skill) {
            const item = document.createElement('button');
            item.type = 'button'; // IMPORTANT: form submit hone se rokta hai
            item.className = 'list-group-item list-group-item-action';
            item.textContent = skill.name;
            item.addEventListener('click', function() {
                addSkill(skill.name);
            });
            suggestionsBox.appendChild(item);
        });

        if (!exactMatch && term.length > 0) {
            const addNew = document.createElement('button');
            addNew.type = 'button';
            addNew.className = 'list-group-item list-group-item-action text-primary';
            addNew.textContent = `+ Add "${term}" as new skill`;
            addNew.addEventListener('click', function() {
                addSkill(term);
            });
            suggestionsBox.appendChild(addNew);
        }

        suggestionsBox.style.display = 'block';
    }

    // Enter key press
    skillInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();   // yahi line form submit hone se rokti hai
            e.stopPropagation();
            const term = this.value.trim();
            if (term.length > 0) {
                addSkill(term);
            }
        }
    });

    // "+" button click
    addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const term = skillInput.value.trim();
        if (term.length > 0) {
            addSkill(term);
        }
    });

    function addSkill(name) {
        name = name.trim();
        if (name === '' || selectedSkills.includes(name.toLowerCase())) {
            skillInput.value = '';
            suggestionsBox.style.display = 'none';
            return;
        }

        selectedSkills.push(name.toLowerCase());

        const tag = document.createElement('span');
        tag.className = 'skill-tag';
        tag.innerHTML = `${name} <span class="remove-skill">&times;</span>`;

        tag.querySelector('.remove-skill').addEventListener('click', function() {
            selectedSkills = selectedSkills.filter(s => s !== name.toLowerCase());
            tag.remove();
            const hiddenInput = document.getElementById('hidden_skill_' + name.replace(/\s+/g, '_'));
            if (hiddenInput) hiddenInput.remove();
        });

        selectedWrapper.appendChild(tag);

        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'skills[]';
        hiddenInput.value = name;
        hiddenInput.id = 'hidden_skill_' + name.replace(/\s+/g, '_');
        hiddenWrapper.appendChild(hiddenInput);

        skillInput.value = '';
        suggestionsBox.style.display = 'none';
        suggestionsBox.innerHTML = '';
    }

    document.addEventListener('click', function(e) {
        if (!skillInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });

    @if(isset($skills) && count($skills))
        @foreach($skills as $s)
            addSkill(@json($s->name));
        @endforeach
    @endif
})();
</script>
@endsection