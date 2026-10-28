@extends('adminend/layouts.main')

@section('main-section')

<style>
    .check_list {
        flex-wrap: wrap;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Subamdin</h5>
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
        <div class="main-content">
            <div class="row">
                <div class="col-12">
                    <div class="card stretch stretch-full">
                        <form id="moduleForm" action="{{ route('submit.admin.module.form') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label">User Department <span class="text-danger">*</span></label>
                                        <input type="text" name="user_department" class="form-control" placeholder="User Department">
                                    </div>
                                </div>
                                <hr class="my-0"> <br />
                                @foreach($parent_modules as $parent_module)
                                <div class="row mb-4">
                                    <div class="form-check form-switch form-switch-sm ps-5">
                                        <input class="form-check-input c-pointer parent-switch"
                                            type="checkbox"
                                            id="parentSwitch{{ $parent_module->id }}"
                                            data-parent="{{ $parent_module->id }}"
                                            name="parent_modules[]"
                                            value="{{ $parent_module->id }}">
                                        <label class="form-check-label fw-500 text-dark c-pointer"
                                            for="parentSwitch{{ $parent_module->id }}">{{ $parent_module->module_name }}</label>
                                    </div>
                                </div>

                                <div class="check_list d-flex gap-3 mb-4">
                                    @php
                                    $admin_submodules = getAdminSubmodule($parent_module->id);
                                    @endphp
                                    @foreach($admin_submodules as $admin_submodule)
                                    <div class="form-check form-switch form-switch-sm ps-5">
                                        <input class="form-check-input c-pointer sub-switch"
                                            type="checkbox"
                                            id="subSwitch{{ $admin_submodule->id }}"
                                            data-parent="{{ $parent_module->id }}"
                                            name="sub_modules[]"
                                            value="{{ $admin_submodule->id }}">
                                        <label class="form-check-label fw-500 text-dark c-pointer"
                                            for="subSwitch{{ $admin_submodule->id }}">{{ $admin_submodule->module_name }}</label>
                                    </div>
                                    @endforeach
                                </div>

                                <hr class="my-0"> <br />
                                @endforeach
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to initialize checkbox handlers
        function initCheckboxHandlers() {
            // Handle parent checkbox change
            document.querySelectorAll('.parent-switch').forEach(parentCheckbox => {
                parentCheckbox.addEventListener('change', function() {
                    let parentId = this.getAttribute('data-parent');
                    let isChecked = this.checked;

                    // Check or uncheck all submodules under the parent
                    document.querySelectorAll(`.sub-switch[data-parent="${parentId}"]`).forEach(subCheckbox => {
                        subCheckbox.checked = isChecked;
                    });
                });
            });

            // Handle submodule checkbox change
            document.querySelectorAll('.sub-switch').forEach(subCheckbox => {
                subCheckbox.addEventListener('change', function() {
                    let parentId = this.getAttribute('data-parent');
                    let parentCheckbox = document.querySelector(`#parentSwitch${parentId}`);
                    let allSubmodules = document.querySelectorAll(`.sub-switch[data-parent="${parentId}"]`);
                    let checkedSubmodules = document.querySelectorAll(`.sub-switch[data-parent="${parentId}"]:checked`);

                    // If any submodule is checked, ensure the parent is checked
                    if (checkedSubmodules.length > 0) {
                        parentCheckbox.checked = true;
                    } else {
                        // If all submodules are unchecked, ensure the parent is unchecked
                        parentCheckbox.checked = false;
                    }
                });
            });
        }

        // Initialize checkboxes handlers when the document is ready
        setTimeout(function() {
            initCheckboxHandlers();
        }, 500); // Small delay to ensure the checkboxes exist
    });
</script>
@endsection