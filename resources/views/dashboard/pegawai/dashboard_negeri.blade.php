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
        <li class="breadcrumb-item text-muted">Pegawai Negeri AADK</li>
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
<!--end::Content-->
@endsection
