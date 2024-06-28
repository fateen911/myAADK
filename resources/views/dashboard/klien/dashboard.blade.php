@extends('layouts._default')

@section('content')
<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laman Utama</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Laman Utama</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Klien</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    {{-- begin --}}
    <div class="row g-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-5">
            <!--begin::Lists Widget 19-->
            <div class="card card-flush h-xl-100">
                <!--begin::Heading-->
                <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-225px" style="background-color:gray;" data-bs-theme="light">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column text-white pt-10">
                        <span class="fw-bold fs-2x mb-3">Profil Peribadi</span>
                        <div class="fs-4 text-white">
                            <span class="opacity-75">Status terikini</span>
                            <span class="position-relative d-inline-block">
                                <a href="{{ route('pengurusan-profil') }}" class="link-white opacity-75-hover fw-bold d-block mb-1" style="color: darkblue;">profil peribadi</a>
                            </span>
                            <span class="opacity-75">anda.</span>
                        </div>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Body-->
                <div class="card-body mt-n20">
                    <div class="mt-n20 position-relative">
                        <!--begin::Row-->
                        <div class="row g-3 g-lg-6">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol and Text-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-3">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-user-tick fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <span class="text-gray-700 fw-semibold fs-3 lh-1">Maklumat Peribadi</span>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Symbol and Text-->
                                    <!--begin::Info-->
                                    <div class="text-center mt-5">
                                        <span class="text-gray-600 fw-semibold fs-6 d-block">Dikemaskini</span>
                                        <span class="text-gray-400 fw-semibold fs-6">26/5/2024</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol and Text-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-3">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-people fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <span class="text-gray-700 fw-semibold fs-3 lh-1">Maklumat Waris</span>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Symbol and Text-->
                                    <!--begin::Info-->
                                    <div class="text-center mt-5">
                                        <span class="text-gray-600 fw-semibold fs-6 d-block">Diluluskan</span>
                                        <span class="text-gray-400 fw-semibold fs-6">25/6/2024</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        
                        <!--begin::Row-->
                        <div class="row g-3 g-lg-6 mt-3">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol and Text-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-3">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-profile-user fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <span class="text-gray-700 fw-semibold fs-3 lh-1">Maklumat Pasangan</span>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Symbol and Text-->
                                    <!--begin::Info-->
                                    <div class="text-center mt-5">
                                        <span class="text-gray-600 fw-semibold fs-6 d-block">Dikemaskini</span>
                                        <span class="text-gray-400 fw-semibold fs-6">24/2/2024</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol and Text-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-3">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-brifecase-tick fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <span class="text-gray-700 fw-semibold fs-3 lh-1">Maklumat Pekerjaan</span>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Symbol and Text-->
                                    <!--begin::Info-->
                                    <div class="text-center mt-5">
                                        <span class="text-gray-600 fw-semibold fs-6 d-block">Ditolak</span>
                                        <span class="text-gray-400 fw-semibold fs-6">26/6/2024</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
                
                <!--end::Body-->
            </div>
            <!--end::Lists Widget 19-->
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-7">
            <div class="card card-flush mb-xxl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-dark">Featured Campaigns</span>
                        <span class="text-gray-400 pt-2 fw-semibold fs-6">75% activity growth</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-1 text-gray-400 me-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Nav-->
                    <ul class="nav nav-pills nav-pills-custom mb-3">
                        <!--begin::Item-->
                        <li class="nav-item mb-3 me-3 me-lg-6">
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden active w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_1">
                                <!--begin::Icon-->
                                <div class="nav-icon">
                                    <img alt="" src="assets/media/svg/brand-logos/beats-electronics.svg" class="" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">Beats</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item mb-3 me-3 me-lg-6">
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_2">
                                <!--begin::Icon-->
                                <div class="nav-icon">
                                    <img alt="Logo" src="assets/media/svg/brand-logos/amazon.svg" class="theme-light-show" />
                                    <img alt="Logo" src="assets/media/svg/brand-logos/amazon-dark.svg" class="theme-dark-show" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">Amazon</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item mb-3 me-3 me-lg-6">
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_3">
                                <!--begin::Icon-->
                                <div class="nav-icon">
                                    <img alt="" src="assets/media/svg/brand-logos/bp-2.svg" class="" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">BP</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item mb-3 me-3 me-lg-6">
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4" data-bs-toggle="pill" href="#kt_stats_widget_1_tab_4">
                                <!--begin::Icon-->
                                <div class="nav-icon">
                                    <img alt="" src="assets/media/svg/brand-logos/slack-icon.svg" class="nav-icon" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">Slack</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item mb-3">
                            <!--begin::Link-->
                            <a class="nav-link d-flex flex-center overflow-hidden w-80px h-85px" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign" href="#">
                                <!--begin::Icon-->
                                <div class="nav-icon">
                                    <i class="ki-duotone ki-plus-square fs-2hx text-gray-400">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Nav-->
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_stats_widget_1_tab_1">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 min-w-150px d-block pt-3">EMAIL TITLE</th>
                                            <th class="text-end min-w-140px pt-3">STATUS</th>
                                            <th class="pe-0 text-end min-w-120px pt-3">CONVERSION</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Rated Headsets of 2022</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-success fs-7 fw-bold">Sent</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">18%(6.4k)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">New Model BS 2000 X</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-primary fs-7 fw-bold">In Draft</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">0.01%(1)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">2022 Spring Conference by Beats</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-success fs-7 fw-bold">Sent</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">37%(247)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Headsets Giveaway</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-warning fs-7 fw-bold">In Queue</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">0%(0)</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_stats_widget_1_tab_2">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 min-w-150px d-block pt-3">EMAIL TITLE</th>
                                            <th class="text-end min-w-140px pt-3">STATUS</th>
                                            <th class="pe-0 text-end min-w-120px pt-3">CONVERSION</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">2022 Spring Conference by Beats</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-success fs-7 fw-bold">Sent</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">37%(247)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Headsets Giveaway</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-warning fs-7 fw-bold">In Queue</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">0%(0)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Rated Headsets of 2022</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-success fs-7 fw-bold">Sent</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">18%(6.4k)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">New Model BS 2000 X</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-primary fs-7 fw-bold">In Draft</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">0.01%(1)</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_stats_widget_1_tab_3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 min-w-150px d-block pt-3">EMAIL TITLE</th>
                                            <th class="text-end min-w-140px pt-3">STATUS</th>
                                            <th class="pe-0 text-end min-w-120px pt-3">CONVERSION</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">New Model BS 2000 X</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-primary fs-7 fw-bold">In Draft</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">0.01%(1)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Rated Headsets of 2022</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-success fs-7 fw-bold">Sent</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">18%(6.4k)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">2022 Spring Conference by Beats</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-success fs-7 fw-bold">Sent</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">37%(247)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Headsets Giveaway</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-warning fs-7 fw-bold">In Queue</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">0%(0)</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_stats_widget_1_tab_4">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 min-w-150px d-block pt-3">EMAIL TITLE</th>
                                            <th class="text-end min-w-140px pt-3">STATUS</th>
                                            <th class="pe-0 text-end min-w-120px pt-3">CONVERSION</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Headsets Giveaway</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-warning fs-7 fw-bold">In Queue</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">0%(0)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Headsets Giveaway</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-success fs-7 fw-bold">Sent</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">37%(247)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Best Rated Headsets of 2022</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-success fs-7 fw-bold">Sent</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">18%(6.4k)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">New Model BS 2000 X</a>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-light-primary fs-7 fw-bold">In Draft</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold d-block fs-6">0.01%(1)</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end: Card Body-->
            </div>
        </div>
        <!--end::Col-->
    </div>
    {{-- end --}}

    <!--begin::Row-->
    {{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">
            <!--begin::Table widget 14-->
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Jana Laporan</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Rumusan statistik boleh dilihat berdasarkan tahun, negeri, daerah</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="../../demo1/dist/apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">History</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-6">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 pb-3 min-w-175px text-start">ITEM</th>
                                <th class="p-0 pb-3 min-w-100px text-end">BUDGET</th>
                                <th class="p-0 pb-3 min-w-100px text-end">PROGRESS</th>
                                <th class="p-0 pb-3 min-w-175px text-end pe-12">STATUS</th>
                                <th class="p-0 pb-3 w-125px text-end pe-7">CHART</th>
                                <th class="p-0 pb-3 w-50px text-end">VIEW</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="assets/media/stock/600x600/img-49.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Mivy App</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Jane Cooper</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$32,400</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>9.2%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                </td>
                                <td class="text-end pe-0">
                                    <div id="kt_table_widget_14_chart_1" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="assets/media/stock/600x600/img-40.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Avionica</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Esther Howard</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$256,910</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-danger fs-base">
                                                <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>0.4%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-warning">On Hold</span>
                                </td>
                                <td class="text-end pe-0">
                                    <div id="kt_table_widget_14_chart_2" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger"></div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="assets/media/stock/600x600/img-39.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Charto CRM</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Jenny Wilson</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$8,220</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>9.2%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                </td>
                                <td class="text-end pe-0">
                                    <div id="kt_table_widget_14_chart_3" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="assets/media/stock/600x600/img-47.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tower Hill</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Cody Fisher</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$74,000</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>9.2%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-success">Complated</span>
                                </td>
                                <td class="text-end pe-0">
                                    <div id="kt_table_widget_14_chart_4" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="assets/media/stock/600x600/img-48.jpg" class="" alt="" />
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">9 Degree</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Savannah Nguyen</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$183,300</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-danger fs-base">
                                                <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>0.4%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                </td>
                                <td class="text-end pe-0">
                                    <div id="kt_table_widget_14_chart_5" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger"></div>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Table widget 14-->
        </div>
        <!--end::Col-->
    </div> --}}
    <!--end::Row-->
</div>
<!--end::Content-->
@endsection

