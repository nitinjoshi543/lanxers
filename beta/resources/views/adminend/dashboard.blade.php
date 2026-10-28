@extends('adminend/layouts.main')

@section('main-section')
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Dashboard</li>
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
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row justify-content-center pt-5">
                <div class="col-md-10">
                    <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6a6998929741e.jpg" alt="" class="w-100 logo logo-sm" />
                </div>
                <div class="col-md-10 pt-5">
                    <h3 class="text-center">"Success is not final, failure is not fatal: it is the courage to continue that counts." – Winston Churchill</h3>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

</main>
@endsection