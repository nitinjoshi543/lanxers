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
                    <h5 class="m-b-10">Offer</h5>
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
                        <form id="editorForm" action="{{ route('submit.offer.add.form') }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Offer Title <span class="text-danger">*</span></label>
                                        <input type="text" name="offer_title" class="form-control" placeholder="Offer Title">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Offer Start date <span class="text-danger">*</span></label>
                                        <input type="date" name="offer_start_date" class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Offer Close date <span class="text-danger">*</span></label>
                                        <input type="date" name="offer_close_date" class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Discount Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="discount_type" data-select2-selector="default">
                                            <option value="0">Price</option>
                                            <option value="1">Percentage</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Discount <span class="text-danger">*</span></label>
                                        <input type="text" name="discount" class="form-control" placeholder="Discount">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">User Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="user_type" data-select2-selector="default">
                                            <option value="0">All Users</option>
                                            <option value="1">Only for Plus Users</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                        <input type="text" name="quantity" class="form-control" placeholder="Quantity">
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
@endsection