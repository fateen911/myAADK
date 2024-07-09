@extends('layouts._default')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/sekretariat.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

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
        <li class="breadcrumb-item text-muted">Pegawai BRPP AADK</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->

<!--begin::Content-->
<div class="card shadow-sm p-5">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            {{-- top nav bar --}}
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profilKlien-tab" data-toggle="tab" data-target="#profilKlien" type="button" role="tab" aria-controls="profilKlien" aria-selected="true">Profil Klien</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="soalSelidik-tab" data-toggle="tab" data-target="#soalSelidik" type="button" role="tab" aria-controls="soalSelidik" aria-selected="true">Soal Selidik</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                {{-- Profil Klien --}}
                <div class="tab-pane fade show active" id="profilKlien" role="tabpanel" aria-labelledby="profilKlien-tab">
                    <!--Permohonan-->
                    <div class="header pt-5 mb-5">
                        <h2>Status Permohonan Kemaskini Profil Klien</h2>
                    </div>
                    <div class="body">
                        <!--begin::First Row-->
                        <div class="row g-3 g-lg-6" style="text-align: center;">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-list-ol text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baharu</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-klien') }}">
                                            <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanIPTS">3</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:mediumvioletred">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Semakan</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-klien') }}">
                                            <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafIPTS">2</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <!--begin::Second Row-->
                        <div class="row g-3 g-lg-6 pt-5" style="text-align: center;">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:lightseagreen">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-list-ol text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Lulus</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-klien') }}">
                                            <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanIPTS">1</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-info">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Ditolak</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-klien') }}">
                                            <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafIPTS">0</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>

                {{-- Soal Selidik --}}
                <div class="tab-pane fade" id="soalSelidik" role="tabpanel" aria-labelledby="soalSelidik-tab">
                    <!--Permohonan-->
                    <div class="header pt-5 mb-5">
                        <h2>Status Soal Selidik Kepulihan Klien</h2>
                    </div>
                    <div class="body">
                        <!--begin::First Row-->
                        <div class="row g-3 g-lg-6" style="text-align: center;">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:darkgray">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-list-ol text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Jumlah Keseluruhan</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href={{route('maklum.balas.kepulihan')}}>
                                            <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanIPTS">10</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:indianred">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-list-ol text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Menjawab</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href={{route('maklum.balas.kepulihan')}}>
                                            <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanIPTS">5</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <!--begin::Second Row-->
                        <div class="row g-3 g-lg-6  pt-5" style="text-align: center;">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:cadetblue">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-list-ol text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Selesai Menjawab</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href={{route('maklum.balas.kepulihan')}}>
                                            <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 keseluruhanIPTS">4</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:cornflowerblue">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Belum Selesai Menjawab</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href={{route('maklum.balas.kepulihan')}}>
                                            <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1 derafIPTS">1</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
{{-- <div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row gx-5 gx-xl-10">
            <!--begin::Col-->
            <div class="col-xxl-12 mb-5 mb-xl-10">
                <!--begin::Chart widget 8-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Modal Kepulihan</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Paparan maklumat berdasarkan kategori status model kepulihan (merah, oren, kuning, hijau).</span>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <ul class="nav" id="kt_chart_widget_8_tabs">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1" data-bs-toggle="tab" id="kt_chart_widget_8_week_toggle" href="#kt_chart_widget_8_week_tab">Month</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active" data-bs-toggle="tab" id="kt_chart_widget_8_month_toggle" href="#kt_chart_widget_8_month_tab">Week</a>
                                </li>
                            </ul>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-6">
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_chart_widget_8_week_tab" role="tabpanel">
                                <!--begin::Statistics-->
                                <div class="mb-5">
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="fs-1 fw-semibold text-gray-400 me-1 mt-n1">$</span>
                                        <span class="fs-3x fw-bold text-gray-800 me-2 lh-1 ls-n2">18,89</span>
                                        <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>4,8%</span>
                                    </div>
                                    <!--end::Statistics-->
                                    <!--begin::Description-->
                                    <span class="fs-6 fw-semibold text-gray-400">Avarage cost per interaction</span>
                                    <!--end::Description-->
                                </div>
                                <!--end::Statistics-->
                                <!--begin::Chart-->
                                <div id="kt_chart_widget_8_week_chart" class="ms-n5 min-h-auto" style="height: 275px"></div>
                                <!--end::Chart-->
                                <!--begin::Items-->
                                <div class="d-flex flex-wrap pt-5">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-column me-7 me-lg-16 pt-sm-3 pt-6">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-primary me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Social Campaigns</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-danger me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-&lt;gray-600 fs-6">Google Ads</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                    </div>
                                    <!--ed::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-column me-7 me-lg-16 pt-sm-3 pt-6">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-success me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Email Newsletter</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-warning me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Courses</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                    </div>
                                    <!--ed::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-column pt-sm-3 pt-6">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-info me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">TV Campaign</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-success me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Radio</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                    </div>
                                    <!--ed::Item-->
                                </div>
                                <!--ed::Items-->
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade active show" id="kt_chart_widget_8_month_tab" role="tabpanel">
                                <!--begin::Statistics-->
                                <div class="mb-5">
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="fs-1 fw-semibold text-gray-400 me-1 mt-n1">$</span>
                                        <span class="fs-3x fw-bold text-gray-800 me-2 lh-1 ls-n2">8,55</span>
                                        <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>2.2%</span>
                                    </div>
                                    <!--end::Statistics-->
                                    <!--begin::Description-->
                                    <span class="fs-6 fw-semibold text-gray-400">Avarage cost per interaction</span>
                                    <!--end::Description-->
                                </div>
                                <!--end::Statistics-->
                                <!--begin::Chart-->
                                <div id="kt_chart_widget_8_month_chart" class="ms-n5 min-h-auto" style="height: 275px"></div>
                                <!--end::Chart-->
                                <!--begin::Items-->
                                <div class="d-flex flex-wrap pt-5">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-column me-7 me-lg-16 pt-sm-3 pt-6">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-primary me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Social Campaigns</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-danger me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Google Ads</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                    </div>
                                    <!--ed::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-column me-7 me-lg-16 pt-sm-3 pt-6">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-success me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Email Newsletter</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-warning me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Courses</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                    </div>
                                    <!--ed::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-column pt-sm-3 pt-6">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-3 mb-sm-6">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-info me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">TV Campaign</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Bullet-->
                                            <span class="bullet bullet-dot bg-success me-2 h-10px w-10px"></span>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <span class="fw-bold text-gray-600 fs-6">Radio</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--ed::Item-->
                                    </div>
                                    <!--ed::Item-->
                                </div>
                                <!--ed::Items-->
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 8-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        {{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::Chart widget 36-->
                <div class="card card-flush overflow-hidden h-lg-100">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Performance</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">1,046 Inbound Calls today</span>
                        </h3>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                            <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" data-kt-daterangepicker-range="today" class="btn btn-sm btn-light d-flex align-items-center px-4">
                                <!--begin::Display range-->
                                <div class="text-gray-600 fw-bold">Loading date range...</div>
                                <!--end::Display range-->
                                <i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </div>
                            <!--end::Daterangepicker-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end p-0">
                        <!--begin::Chart-->
                        <div id="kt_charts_widget_36" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Chart widget 36-->
            </div>
            <!--end::Col-->
        </div> 
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
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
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div> --}}
<!--end::Content-->
@endsection
