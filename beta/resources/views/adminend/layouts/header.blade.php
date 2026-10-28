<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Idigitalprenur || Dashboard</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/images/idp_short.png') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/daterangepicker.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/theme.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tagify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tagify-data.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/quill.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/select2-theme.min.css') }}">

</head>

<body>
    @php
    $userData = session('user_data');
    @endphp

    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="#" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6a6998929741e.jpg" alt="" class="logo logo-lg" />
                    <img src="{{ asset('admin/images/idp_short.png') }}" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <!-- <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li> -->
                    <li class="nxl-item">
                        <a class="nxl-link" href="{{ route('admin.dashboard') }}">
                            <span class="nxl-micon"><i class="feather-home"></i></span>
                            <span class="nxl-mtext">Dashboards</span>
                        </a>
                    </li>
                    @if($userData->group_id == 1)
                    <li class="nxl-item {{ Route::is('subadmin.add','subadmin.edit') ? 'active' : '' }}">
                        <a class="nxl-link" href="{{ route('subadmin.module') }}">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Sub Admin Module</span>
                        </a>
                    </li>
                    @endif

                    @if($userData->group_id == 1 || (isset($userData->parent_modules) && count(array_intersect([1], explode(',', $userData->parent_modules))) > 0))
                    <li class="nxl-item nxl-hasmenu {{ Route::is('user.details','user.edit') ? 'active nxl-trigger' : '' }}">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Freelance Modual</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            @if($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(1, explode(',', $userData->parent_modules))))
                            <li class="nxl-item {{ Route::is('user.details','user.edit') ? 'active' : '' }}"><a class="nxl-link" href="{{ route('freelancer.module') }}">Freelance User</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if($userData->group_id == 1 || (isset($userData->parent_modules) && count(array_intersect([5], explode(',', $userData->parent_modules))) > 0))
                    <li class="nxl-item nxl-hasmenu {{ Route::is('jobs.list','jobs.create','jobs.show','jobs.edit') ? 'active nxl-trigger' : '' }}">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Job Portal</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            @if($userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))
                            <li class="nxl-item {{ Route::is('jobs.category.list') ? 'active' : '' }}"><a class="nxl-link" href="{{ route('jobs.category.list') }}">Job Category</a></li>
                            <li class="nxl-item {{ Route::is('jobs.employer.list') ? 'active' : '' }}"><a class="nxl-link" href="{{ route('jobs.employer.list') }}">Employer List</a></li>
                            <li class="nxl-item {{ Route::is('jobs.list') ? 'active' : '' }}"><a class="nxl-link" href="{{ route('jobs.list') }}">Job List</a></li>
                            <li class="nxl-item {{ Route::is('external.jobs.list') ? 'active' : '' }}"><a class="nxl-link" href="{{ route('external.jobs.list') }}">External Job List</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if($userData->group_id == 1 || (isset($userData->parent_modules) && count(array_intersect([6], explode(',', $userData->parent_modules))) > 0))
                    <li class="nxl-item {{ Route::is('talent.form.list') ? 'active' : '' }}">
                        <a class="nxl-link" href="{{ route('talent.form.list') }}">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Talent Form</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <header class="nxl-header">
        <div class="header-wrapper">
            <div class="header-left d-flex align-items-center gap-4">
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
                <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                    <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
                        <i class="feather-align-left"></i>
                    </a>
                </div>
                <div class="nxl-drp-link nxl-lavel-mega-menu">
                    <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                        <a href="javascript:void(0)" id="nxl-lavel-mega-menu-hide">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>

                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside">
                            <img src="{{ asset('admin/images/avatar/1.png') }}" alt="user-image" class="img-fluid user-avtar me-0" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('admin/images/avatar/1.png') }}" alt="user-image" class="img-fluid user-avtar" />
                                    <div>
                                        <h6 class="text-dark mb-0">{{ $userData->user_name }}</h6>
                                        <!-- <span class="fs-12 fw-medium text-muted">alex.della@outlook.com</span> -->
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('admin.logout') }}" class="dropdown-item">
                                <i class="feather-log-out"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>