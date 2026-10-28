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
                    <h5 class="m-b-10">Sunday Blockbuster</h5>
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
                        <form id="editorForm" action="{{ route('submit.edit.sunday.blockbuster.form', ['id' => $sunday_blockbuster->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $sunday_blockbuster->title }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Trainer Name <span class="text-danger">*</span></label>
                                        <input type="text" name="trainer_name" class="form-control" placeholder="Trainer Name" value="{{ $sunday_blockbuster->trainer_name }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <input type="text" name="description" class="form-control" placeholder="Description" value="{{ $sunday_blockbuster->trainer_desc }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Full Description <span class="text-danger">*</span></label>
                                        <input type="text" name="description1" class="form-control" placeholder="Full Description" value="{{ $sunday_blockbuster->trainer_desc1 }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Skill will learn <span class="text-danger">*</span></label>
                                        <input type="text" name="skills" class="form-control" placeholder="Skill will learn" value="{{ $sunday_blockbuster->skill_learn }}">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Insutructor Image <span class="text-danger">* Only JPG</span></label>
                                        <input type="file" class="form-control" name="image1" id="image1">
                                        <img class="w-100" alt="{{ $sunday_blockbuster->trainer_photo }}" src="@if($sunday_blockbuster->trainer_photo) {{ $sunday_blockbuster->trainer_photo }} @endif"/>
                                    </div>
                                </div>
                                <input type="hidden" name="existing_image" value="{{ $sunday_blockbuster->trainer_photo }}">                             

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Sunday Blockbuster Thumbnail <span class="text-danger">* Only JPG</span></label>
                                        <input type="file" class="form-control" name="image2" id="image2">
                                        <img class="w-100" alt="{{ $sunday_blockbuster->event_thumbnail }}" src="@if($sunday_blockbuster->event_thumbnail) {{ $sunday_blockbuster->event_thumbnail }} @endif"/>
                                    </div>
                                </div>
                                <input type="hidden" name="existing_image1" value="{{ $sunday_blockbuster->event_thumbnail }}">

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Sunday Blockbuster Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="datetime" class="form-control" placeholder="Sunday Blockbuster Date & Time" value="{{ $sunday_blockbuster->event_datetime }}">
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
@endsection