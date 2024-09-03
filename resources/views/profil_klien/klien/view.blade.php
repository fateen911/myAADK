@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Flexbox settings for the wrapper */
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* Flexbox settings for the tab content container */
        .tab-pane {
            display: flex;
            justify-content: center;
            align-items: start; /* Change to 'center' if you want vertical centering */
            min-height: 100vh; /* Ensure it takes full viewport height if needed */
        }

        /* Centered form settings */
        .centered-form {
            width: 100%;
            padding-left: 50px; /* Add some padding for better appearance */
            padding-right: 50px;
            box-sizing: border-box; /* Ensure padding doesn't increase form size */
            flex-direction: column;
            align-items: center; /* Center contents horizontally */
        }

        .form-control-plaintext {
            margin-left: 10px;
            display: inline-block;
        }

        .d-flex {
            display: flex;
            align-items: center;
        }

        .btn-light-warning {
            background-color: #faf5d6; /* A light version of the warning color */
            color: #ffbd07; /* Bootstrap warning color */
            padding: 0.75rem 0.75rem; /* Same padding as Bootstrap buttons */
            border-radius: 0.25rem; /* Same border radius as Bootstrap buttons */
            display: inline-block; /* To ensure it behaves like a button */
            text-align: center; /* Center the text */
            margin-left: 10px;
        }

        .btn-light-warning:hover,
        .btn-light-warning:focus,
        .btn-light-warning:active {
            background-color: #faf5d6; /* Same light warning color */
            color: #ffbd07; /* Same warning color for text */
        }

        .scrollable-container {
            max-height: 375px; /* Adjust the height as needed */
            overflow-y: auto;
        }

        .nav-link.active {
            font-weight: bold;
            color: #007bff !important;
        }
    </style>
</head>

<body>
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title flex-column justify-content-center flex-wrap me-3 mb-5">
            <!--begin::Title-->
            <h1 class="page-heading text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pengurusan</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Pengurusan</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Profil Peribadi</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::primary button-->
            <a href="{{ route('export.profil.diri') }}" class="btn btn-sm fw-bold btn-primary">
                <i class="fas fa-download"></i> Muat Turun
            </a>
            <!--end::primary button-->
        </div>    
        <!--end::Actions-->
    </div>
    
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="card card-flush">
            <!--begin::Card body-->
            <div class="card-body" >
                <!--begin:::Tabs-->
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-5">
                    <!--begin:::Tab item-->
                    <li class="nav-item" style="padding-right: 15px; padding-left: 15px;">
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#kt_ecommerce_settings_general">
                            <i class="ki-duotone ki-user-tick fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Maklumat Peribadi
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item" style="padding-right: 15px; padding-left: 15px;">
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_localization">
                            <i class="ki-duotone ki-people fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>Maklumat Waris
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item" style="padding-right: 15px; padding-left: 15px;">
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_store">
                            <i class="ki-duotone ki-profile-user fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Maklumat Keluarga
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item" style="padding-right: 15px; padding-left: 15px;">
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_customers">
                            <i class="ki-duotone ki-brifecase-tick fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Maklumat Pekerjaan
                        </a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                
                <!--begin:::Tab content-->
                <div class="tab-content" id="myTabContent">
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">
                        <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="">
                            <!--begin::Heading-->
                            <div class="row mb-5">
                                <div class="col-md-7 offset-md-5">
                                    <h2>Kemaskini Maklumat Peribadi</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                            
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nama Penuh</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7 d-flex align-items-center">
                                    <!--begin::Text-->
                                    <span id="nama" class="fs-6 form-control-plaintext">{{$butiranKlien->nama}}</span>
                                    <!--end::Text-->
                                </div>
                            </div>
                            <!--end::Input group--> 
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nombor Kad Pengenalan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7 d-flex align-items-center">
                                    <!--begin::Input-->
                                    <span id="no_kp" class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-startr">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Umur</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7 d-flex align-items-center">
                                    <!--begin::Input-->
                                    <span id="umur" class="fs-6 form-control-plaintext"></span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Jantina</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <span id="jantina" class="fs-6 form-control-plaintext">{{$butiranKlien->jantina}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Agama</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <span id="agama" class="fs-6 form-control-plaintext">{{$butiranKlien->agama}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Bangsa</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <span id="bangsa" class="fs-6 form-control-plaintext">{{$butiranKlien->bangsa}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Status Kesihatan Mental</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <span id="status_kesihatan_mental" class="fs-6 form-control-plaintext">{{$butiranKlien->status_kesihatan_mental}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Status Orang Kurang Upaya (OKU)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <span id="status_oku" class="fs-6 form-control-plaintext">{{$butiranKlien->status_oku}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Skor CCRI</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <span id="skor_ccri" class="fs-6 form-control-plaintext">{{$butiranKlien->skor_ccri}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3"><span>Nombor Telefon</span></label>
                                </div>
                                <div class="col-md-7">
                                    <span id="no_tel" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel}}</span>
                                </div>
                            </div>
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>E-mel</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <span id="emel" class="fs-6 form-control-plaintext">{{$butiranKlien->emel}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Alamat Rumah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <span id="alamat_rumah" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_rumah}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Poskod</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <span id="poskod" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod}}</span>
                                        <!--end::Select2-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Negeri</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        @php
                                            $negeriKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri)->value('senarai_negeri.negeri');
                                        @endphp
                                        <span class="fs-6 form-control-plaintext">{{$negeriKlien}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Daerah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        @php
                                            $daerahKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah)->value('senarai_daerah.daerah');
                                        @endphp
                                        <span class="fs-6 form-control-plaintext">{{$daerahKlien}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-5 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Tahap Pendidikan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <span id="tahap_pendidikan" class="fs-6 form-control-plaintext">{{$butiranKlien->tahap_pendidikan}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-7 offset-md-5">
                                    <div class="d-flex">
                                        @if($resultRequestKlien)
                                            @if ($resultRequestKlien->status != "Kemaskini")
                                                <button type="button" class="btn btn-primary modal-trigger" id="requestModalPeribadiKlien" data-target="#requestPeribadiKlien">
                                                    Mohon Kemaskini
                                                </button>                                            
                                            @else
                                                <div class="btn-light-warning">Permohonan Kemaskini Telah Dihantar</div>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-primary modal-trigger" id="requestModalPeribadiKlien" data-target="#requestPeribadiKlien">
                                                Mohon Kemaskini
                                            </button> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!-- ... rest of your form ... -->

                        <!--begin::Modal PeribadiKlien-->
                        <div class="modal fade" id="requestPeribadiKlien" tabindex="-1" aria-labelledby="permohonanPeribadiKlienLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="permohonanPeribadiKlienLabel">Mohon Kemaskini Maklumat Peribadi Klien</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('klien.requestUpdate') }}">
                                            @csrf

                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="nama" class="fs-6 form-control-plaintext">{{$butiranKlien->nama}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">No Kad Pengenalan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="no_kp" class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Umur</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="modal_umur" class="fs-6 form-control-plaintext"></span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Jantina</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="jantina" class="fs-6 form-control-plaintext">{{$butiranKlien->jantina}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Agama</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="agama" class="fs-6 form-control-plaintext">{{$butiranKlien->agama}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Bangsa</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="bangsa" class="fs-6 form-control-plaintext">{{$butiranKlien->bangsa}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Status Kesihatan Mental</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span id="status_kesihatan_mental" class="fs-6 form-control-plaintext">{{$butiranKlien->status_kesihatan_mental}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Status Orang Kurang Upaya (OKU)</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span id="status_oku" class="fs-6 form-control-plaintext">{{$butiranKlien->status_oku}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-4">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Skor CCRI</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span id="skor_ccri" class="fs-6 form-control-plaintext">{{$butiranKlien->skor_ccri}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon</label>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                                                        <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" id="no_tel" name="no_tel" value="{{ $butiranKlien->no_tel }}" inputmode="numeric" maxlength="11"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">E-mel</label>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan alamat emel yang aktif.">
                                                        <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" id="emel" name="emel" value="{{ $butiranKlien->emel }}" />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Alamat Rumah</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control form-control-solid" id="alamat_rumah" name="alamat_rumah" style="text-transform: uppercase;">{{ $butiranKlien->alamat_rumah }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Poskod</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" id="poskod" name="poskod" value="{{ $butiranKlien->poskod }}" inputmode="numeric" maxlength="5"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" id="negeri" name="negeri" data-control="select2" data-hide-search="true">
                                                        <option value="">Pilih Negeri</option>
                                                        @foreach ($negeri as $item)
                                                            <option value="{{ $item->id }}" {{ $butiranKlien->negeri == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Daerah</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" id="daerah" name="daerah" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Daerah</option>
                                                        @foreach ($daerah as $item)
                                                            <option value="{{ $item->id }}" {{ $butiranKlien->daerah == $item->id ? 'selected' : '' }} data-negeri-id="{{ $item->negeri_id }}">{{ $item->daerah }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Tahap Pendidikan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" id="tahap_pendidikan" name="tahap_pendidikan" data-control="select2" data-hide-search="true" >
                                                        <option>Pilih Tahap Pendidikan</option>
                                                        <option value="PRA SEKOLAH" {{ $butiranKlien->tahap_pendidikan == 'PRA SEKOLAH' ? 'selected' : '' }}>PRA SEKOLAH</option>
                                                        <option value="PENDIDIKAN RENDAH" {{ $butiranKlien->tahap_pendidikan == 'PENDIDIKAN RENDAH' ? 'selected' : '' }}>PENDIDIKAN RENDAH</option>
                                                        <option value="PENDIDIKAN MENENGAH" {{ $butiranKlien->tahap_pendidikan == 'PENDIDIKAN MENENGAH' ? 'selected' : '' }}>PENDIDIKAN MENENGAH</option>
                                                        <option value="PENGAJIAN TINGGI" {{ $butiranKlien->tahap_pendidikan == 'PENGAJIAN TINGGI' ? 'selected' : '' }}>PENGAJIAN TINGGI</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row fv-row mb-2">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                    </div>
                                                </div>
                                            </div>   
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                                                
                        <!--end::Modal-->
                    </div>
                    <!--end:::Tab pane-->

                    
                    <!--begin:::Tab pane Pekerjaan-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_customers" role="tabpanel">
                        <!--begin::Form-->
                        <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="#">
                            @csrf
                            <!--begin::Heading-->
                            <div class="row mb-5">
                                <div class="col-md-8 offset-md-4">
                                    <h2>Kemaskini Maklumat Pekerjaan</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                    
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Status Kerja</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="status_kerja" class="fs-6 form-control-plaintext">{{$butiranKlien->status_kerja}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Bidang Pekerjaan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="bidang_kerja" class="fs-6 form-control-plaintext">{{$butiranKlien->bidang_kerja}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nama Pekerjaan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="nama_kerja" class="fs-6 form-control-plaintext">{{$butiranKlien->nama_kerja}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Pendapatan (RM)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="pendapatan" class="fs-6 form-control-plaintext">{{$butiranKlien->pendapatan}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Kategori Majikan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="kategori_majikan" class="fs-6 form-control-plaintext">{{$butiranKlien->kategori_majikan}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nama Majikan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="nama_majikan" class="fs-6 form-control-plaintext">{{$butiranKlien->nama_majikan}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nombor Telefon Majikan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="no_tel_majikan" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_majikan}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Alamat Tempat Kerja</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="alamat_kerja" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_kerja}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Poskod</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <span id="poskod_kerja" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_kerja}}</span>
                                        <!--end::Select2-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Negeri</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        @php
                                            $negeriKerjaKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_kerja )->value('senarai_negeri.negeri');
                                        @endphp
                                        <span id="negeri_kerja" class="fs-6 form-control-plaintext">{{ $negeriKerjaKlien }}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Daerah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                            
                                <div class="col-md-8">
                                    <div class="w-100">
                                        @php
                                            $daerahKerjaKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_kerja )->value('senarai_daerah.daerah');
                                        @endphp
                                        <span id="daerah_kerja" class="fs-6 form-control-plaintext">{{ $daerahKerjaKlien }}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-8 offset-md-4">
                                    <div class="d-flex">
                                        @if($resultRequestPekerjaan)
                                            @if ($resultRequestPekerjaan->status != "Kemaskini")
                                                <button type="button" class="btn btn-primary modal-trigger" id="requestModalPekerjaanKlien" data-target="#requestPekerjaanKlien">
                                                    Mohon Kemaskini
                                                </button>
                                            @else
                                                <div class="btn-light-warning">Permohonan Kemaskini Telah Dihantar</div>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-primary modal-trigger" id="requestModalPekerjaanKlien" data-target="#requestPekerjaanKlien">
                                                Mohon Kemaskini
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal PekerjaanKlien-->
                        <div class="modal fade" id="requestPekerjaanKlien" tabindex="-1" aria-labelledby="permohonanPekerjaanKlienLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="permohonanPekerjaanKlienLabel">Mohon Kemaskini Maklumat Pekerjaan Klien</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('pekerjaanKlien.requestUpdate') }}">
                                            @csrf

                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Status Kerja</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" id="status_kerja" name="status_kerja" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Status</option>
                                                        <option value="BEKERJA" {{ $butiranKlien->status_kerja == 'BEKERJA' ? 'selected' : '' }}>BEKERJA</option>
                                                        <option value="TIDAK BEKERJA" {{ $butiranKlien->status_kerja == 'TIDAK BEKERJA' ? 'selected' : '' }}>TIDAK BEKERJA</option>
                                                        <option value="MENGANGGUR" {{ $butiranKlien->status_kerja == 'MENGANGGUR' ? 'selected' : '' }}>MENGANGGUR</option>
                                                        <option value="BELAJAR" {{ $butiranKlien->status_kerja == 'BELAJAR' ? 'selected' : '' }}>BELAJAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Bidang Pekerjaan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" id="bidang_kerja" name="bidang_kerja" value="{{$butiranKlien->bidang_kerja}}" style="text-transform: uppercase;"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama Pekerjaan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" id="nama_kerja" name="nama_kerja" value="{{$butiranKlien->nama_kerja}}" style="text-transform: uppercase;"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Pendapatan (RM)</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" id="pendapatan" name="pendapatan" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Julat Pendapatan</option>
                                                        <option value="RM0-RM999" {{ $butiranKlien->pendapatan == 'RM0-RM999' ? 'selected' : '' }}>RM0-RM999</option>
                                                        <option value="RM1000-RM1999" {{ $butiranKlien->pendapatan == 'RM1000-RM1999' ? 'selected' : '' }}>RM1000-RM1999</option>
                                                        <option value="RM2000-RM2999" {{ $butiranKlien->pendapatan == 'RM2000-RM2999' ? 'selected' : '' }}>RM2000-RM2999</option>
                                                        <option value="RM3000-RM3999" {{ $butiranKlien->pendapatan == 'RM3000-RM3999' ? 'selected' : '' }}>RM3000-RM3999</option>
                                                        <option value="RM4000-RM4999" {{ $butiranKlien->pendapatan == 'RM4000-RM4999' ? 'selected' : '' }}>RM4000-RM4999</option>
                                                        <option value="Lebih RM5000" {{ $butiranKlien->pendapatan == 'Lebih RM5000' ? 'selected' : '' }}>Lebih RM5000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Kategori Majikan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" id="kategori_majikan" name="kategori_majikan" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Kategori Majikan</option>
                                                        <option value="KERAJAAN" {{ $butiranKlien->kategori_majikan == 'KERAJAAN' ? 'selected' : '' }}>KERAJAAN</option>
                                                        <option value="SWASTA" {{ $butiranKlien->kategori_majikan == 'SWASTA' ? 'selected' : '' }}>SWASTA</option>
                                                        <option value="LAIN-LAIN" {{ $butiranKlien->kategori_majikan == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama Majikan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" id="nama_majikan" name="nama_majikan" value="{{ $butiranKlien->nama_majikan }}" style="text-transform: uppercase;"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon Majikan
                                                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                                                            <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                            </i>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" id="no_tel_majikan" name="no_tel_majikan" value="{{$butiranKlien->no_tel_majikan}}" inputmode="numeric" maxlength="11"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Tempat Kerja</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control form-control-solid" id="alamat_kerja" name="alamat_kerja" style="text-transform: uppercase;">{{$butiranKlien->alamat_kerja}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" id="poskod_kerja" name="poskod_kerja" value="{{$butiranKlien->poskod_kerja}}" inputmode="numeric" maxlength="5"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" id="negeri_kerja" name="negeri_kerja" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Negeri</option>
                                                        @foreach ($negeriKerja as $negeriK)
                                                            <option value="{{ $negeriK->id }}" {{ $butiranKlien->negeri_kerja == $negeriK->id ? 'selected' : '' }}>{{ $negeriK->negeri }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" id="daerah_kerja" name="daerah_kerja" data-control="select2">
                                                        <option>Pilih Daerah</option>
                                                        @foreach ($daerahKerja as $daerahK)
                                                            <option value="{{ $daerahK->id }}" {{ $butiranKlien->daerah_kerja == $daerahK->id ? 'selected' : '' }}>{{ $daerahK->daerah }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row fv-row mb-2">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                    </div>
                                                </div>
                                            </div>   
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                                                
                        <!--end::Modal-->
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Waris-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_localization" role="tabpanel">
                        <div class="container-fluid">
                            <div class="row">
                                {{-- begin::Sidebar --}}
                                <nav class="col-md-2">
                                    <div class="sidebar-sticky">
                                        <ul class="nav flex-column bg-light">
                                            <li class="nav-item border">
                                                <a class="nav-link active fs-4" href="#maklumatBapa" data-toggle="tab">
                                                    Maklumat Bapa
                                                </a>
                                            </li>
                                            <li class="nav-item border">
                                                <a class="nav-link fs-4" href="#maklumatIbu" data-toggle="tab">
                                                    Maklumat Ibu
                                                </a>
                                            </li>
                                            <li class="nav-item border">
                                                <a class="nav-link fs-4" href="#maklumatPenjaga" data-toggle="tab">
                                                    Maklumat Penjaga
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                                {{-- end::Sidebar --}}

                                <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
                                    <div class="tab-content">
                                        <!-- Maklumat Bapa -->
                                        <div class="tab-pane active" id="maklumatBapa">
                                            <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="">
                                                @csrf
                                                <div class="row mb-2">
                                                    <div class="col-md-8 offset-md-4">
                                                        <h2>Kemaskini Maklumat Bapa</h2>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nama</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="nama_bapa" class="fs-6 form-control-plaintext">{{$butiranKlien->nama_bapa}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>No Kad Pengenalan</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="no_kp_bapa" class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp_bapa}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nombor Telefon</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="no_tel_bapa" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_bapa}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Status</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="status_bapa" class="fs-6 form-control-plaintext">{{$butiranKlien->status_bapa}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Alamat Rumah</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="alamat_bapa" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_bapa}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Poskod</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <span id="poskod_bapa" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_bapa}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Negeri</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            @php
                                                                $negeriBapaKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_bapa )->value('senarai_negeri.negeri');
                                                            @endphp
                                                            <span id="negeri_bapa" class="fs-6 form-control-plaintext">{{ $negeriBapaKlien }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Daerah</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            @php
                                                                $daerahBapaKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_bapa )->value('senarai_daerah.daerah');
                                                            @endphp
                                                            <span id="daerah_bapa" class="fs-6 form-control-plaintext">{{ $daerahBapaKlien }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--begin::Action buttons-->
                                                <div class="row py-5">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="d-flex">
                                                            @if($resultRequestBapa)
                                                                @if ($resultRequestBapa->status != "Kemaskini")
                                                                    <button type="button" class="btn btn-primary modal-trigger" id="requestModalBapaKlien" data-target="#requestBapaKlien">
                                                                        Mohon Kemaskini
                                                                    </button>
                                                                @else
                                                                    <div class="btn-light-warning">Permohonan Kemaskini Telah Dihantar</div>
                                                                @endif
                                                            @else
                                                                <button type="button" class="btn btn-primary modal-trigger" id="requestModalBapaKlien" data-target="#requestBapaKlien">
                                                                    Mohon Kemaskini
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Action buttons-->
                                            </form>
                                        </div>
                    
                                        <!-- Maklumat Ibu -->
                                        <div class="tab-pane" id="maklumatIbu">
                                            <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="">
                                                @csrf
                                                <div class="row mb-2">
                                                    <div class="col-md-8 offset-md-4">
                                                        <h2>Kemaskini Maklumat Ibu</h2>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nama</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="nama_ibu" class="fs-6 form-control-plaintext">{{$butiranKlien->nama_ibu}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nombor Kad Pengenalan</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="no_kp_ibu" class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp_ibu}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nombor Telefon</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="no_tel_ibu" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_ibu}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Status</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="status_ibu" class="fs-6 form-control-plaintext">{{$butiranKlien->status_ibu}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Alamat Rumah</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="alamat_ibu" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_ibu}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Poskod</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <span id="poskod_ibu" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_ibu}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Negeri</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            @php
                                                                $negeriIbuKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_ibu )->value('senarai_negeri.negeri');
                                                            @endphp
                                                            <span id="negeri_ibu" class="fs-6 form-control-plaintext">{{ $negeriIbuKlien }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Daerah</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            @php
                                                                $daerahIbuKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_ibu )->value('senarai_daerah.daerah');
                                                            @endphp
                                                            <span id="daerah_ibu" class="fs-6 form-control-plaintext">{{ $daerahIbuKlien }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--begin::Action buttons-->
                                                <div class="row py-5">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="d-flex">
                                                            @if($resultRequestIbu)
                                                                @if ($resultRequestIbu->status != "Kemaskini")
                                                                    <button type="button" class="btn btn-primary modal-trigger" id="requestModalIbuKlien" data-target="#requestIbuKlien">
                                                                        Mohon Kemaskini
                                                                    </button>
                                                                @else
                                                                    <div class="btn-light-warning">Permohonan Kemaskini Telah Dihantar</div>
                                                                @endif
                                                            @else
                                                                <button type="button" class="btn btn-primary modal-trigger" id="requestModalIbuKlien" data-target="#requestIbuKlien">
                                                                    Mohon Kemaskini
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Action buttons-->
                                            </form>
                                        </div>
                    
                                        <!-- Maklumat Penjaga -->
                                        <div class="tab-pane" id="maklumatPenjaga">
                                            <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="">
                                                @csrf
                                                <div class="row mb-2">
                                                    <div class="col-md-8 offset-md-4">
                                                        <h2>Kemaskini Maklumat Penjaga</h2>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Hubungan</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="hubungan_penjaga" class="fs-6 form-control-plaintext">{{$butiranKlien->hubungan_penjaga}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nama</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="nama_penjaga" class="fs-6 form-control-plaintext">{{$butiranKlien->nama_penjaga}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nombor Kad Pengenalan</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="no_kp_penjaga" class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp_penjaga}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nombor Telefon</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="no_tel_penjaga" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_penjaga}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Status</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="status_penjaga" class="fs-6 form-control-plaintext">{{$butiranKlien->status_penjaga}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Alamat Rumah</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span id="alamat_penjaga" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_penjaga}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Poskod</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <span id="poskod_penjaga" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_penjaga}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Negeri</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            @php
                                                                $negeriPenjagaKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_penjaga )->value('senarai_negeri.negeri');
                                                            @endphp
                                                            <span id="negeri_penjaga" class="fs-6 form-control-plaintext">{{ $negeriPenjagaKlien }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Daerah</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            @php
                                                                $daerahPenjagaKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_penjaga )->value('senarai_daerah.daerah');
                                                            @endphp
                                                            <span id="daerah_penjaga" class="fs-6 form-control-plaintext">{{ $daerahPenjagaKlien }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--begin::Action buttons-->
                                                <div class="row py-5">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="d-flex">
                                                            @if($resultRequestPenjaga)
                                                                @if ($resultRequestPenjaga->status != "Kemaskini")
                                                                    <button type="button" class="btn btn-primary modal-trigger" id="requestModalPenjagaKlien" data-target="#requestPenjagaKlien">
                                                                        Mohon Kemaskini
                                                                    </button>
                                                                @else
                                                                    <div class="btn-light-warning">Permohonan Kemaskini Telah Dihantar</div>
                                                                @endif
                                                            @else
                                                                <button type="button" class="btn btn-primary modal-trigger" id="requestModalPenjagaKlien" data-target="#requestPenjagaKlien">
                                                                    Mohon Kemaskini
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Action buttons-->
                                            </form>
                                        </div>
                                    </div>
                                </main>
                    
                                <!--begin::Modal BapaKlien-->
                                <div class="modal fade" id="requestBapaKlien" tabindex="-1" aria-labelledby="permohonanBapaKlienLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="permohonanBapaKlienLabel">Mohon Kemaskini Maklumat Bapa Klien</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('bapaKlien.requestUpdate') }}">
                                                    @csrf

                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid" id="nama_bapa" name="nama_bapa" value="{{ $butiranKlien->nama_bapa }}" style="text-transform: uppercase;"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nombor Kad Pengenalan</label>
                                                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor kad pengenalan tanpa simbol '-'">
                                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid" id="no_kp_bapa" name="no_kp_bapa" value="{{ $butiranKlien->no_kp_bapa }}" inputmode="numeric" maxlength="12"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon
                                                                <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                                                                    <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                    </i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid" id="no_tel_bapa" name="no_tel_bapa" value="{{ $butiranKlien->no_tel_bapa }}" inputmode="numeric" maxlength="11"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid" id="status_bapa" name="status_bapa" data-control="select2" data-hide-search="true">
                                                                <option>Pilih Status Bapa</option>
                                                                <option value="HIDUP" {{ $butiranKlien->status_bapa == 'HIDUP' ? 'selected' : '' }}>HIDUP</option>
                                                                <option value="MENINGGAL DUNIA" {{ $butiranKlien->status_bapa == 'MENINGGAL DUNIA' ? 'selected' : '' }}>MENINGGAL DUNIA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="d-flex flex-stack">
                                                                <div class="me-5">
                                                                    <input class="form-check-input-sm" id="alamat_bapa_sama" name="alamat_bapa_sama" onclick="alamatBapa()" type="checkbox" value="1" />
                                                                    <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                                </div>
                                                            </div>
                                                            <textarea class="form-control form-control-solid" id="alamat_b" name="alamat_bapa" style="text-transform: uppercase;">{{ $butiranKlien->alamat_bapa }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid" id="poskod_b" name="poskod_bapa" value="{{ $butiranKlien->poskod_bapa }}" inputmode="numeric" maxlength="5"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid" id="negeri_b" name="negeri_bapa" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
                                                                <option>Pilih Negeri</option>
                                                                @foreach ($negeriWaris as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->negeri_bapa == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid" id="daerah_b" name="daerah_bapa" data-control="select2" data-hide-search="true" data-placeholder="Pilih">
                                                                <option>Pilih Daerah</option>
                                                                @foreach ($daerahWaris as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->daerah_bapa == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row fv-row mb-2">
                                                        <div class="col-md-12">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <button type="submit" class="btn btn-primary">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div>                                            
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                
                                <!--end::Modal BapaKlien-->

                                <!--begin::Modal IbuKlien-->
                                <div class="modal fade" id="requestIbuKlien" tabindex="-1" aria-labelledby="permohonanIbuKlienLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="permohonanIbuKlienLabel">Mohon Kemaskini Maklumat Ibu Klien</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('ibuKlien.requestUpdate') }}">
                                                    @csrf

                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="nama_ibu" name="nama_ibu" value="{{ $butiranKlien->nama_ibu }}" style="text-transform: uppercase;"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">No Kad Pengenalan</label>
                                                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor kad pengenalan tanpa simbol '-'">
                                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="no_kp_ibu" name="no_kp_ibu" value="{{ $butiranKlien->no_kp_ibu }}" inputmode="numeric" maxlength="12"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon
                                                                <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                                                                    <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                    </i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="no_tel_ibu" name="no_tel_ibu" value="{{ $butiranKlien->no_tel_ibu }}" inputmode="numeric" maxlength="11"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-select-solid" id="status_ibu" name="status_ibu" data-control="select2" data-hide-search="true">
                                                                <option>Pilih Status Ibu</option>
                                                                <option value="HIDUP" {{ $butiranKlien->status_ibu == 'HIDUP' ? 'selected' : '' }}>HIDUP</option>
                                                                <option value="MENINGGAL DUNIA" {{ $butiranKlien->status_ibu == 'MENINGGAL DUNIA' ? 'selected' : '' }}>MENINGGAL DUNIA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Alamat</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="d-flex flex-stack">
                                                                <div class="me-5">
                                                                    <input class="form-check-input-sm" id="alamat_ibu_sama" name="alamat_ibu_sama" onclick="alamatIbu()" type="checkbox" value="1" />
                                                                    <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                                </div>
                                                            </div>
                                                            <textarea class="form-control form-control-solid" id="alamat_i" name="alamat_ibu" style="text-transform: uppercase;">{{ $butiranKlien->alamat_ibu }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="poskod_i" name="poskod_ibu" value="{{ $butiranKlien->poskod_ibu }}" inputmode="numeric" maxlength="5"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-select-solid" id="negeri_i" name="negeri_ibu" data-control="select2" data-hide-search="true">
                                                                <option>Pilih Negeri</option>
                                                                @foreach ($negeriWaris as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->negeri_ibu == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-select-solid" id="daerah_i" name="daerah_ibu" data-control="select2" data-hide-search="true">
                                                                <option>Pilih Daerah</option>
                                                                @foreach ($daerahWaris as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->daerah_ibu == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row fv-row mb-2">
                                                        <div class="col-md-12">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <button type="submit" class="btn btn-primary">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div>                                            
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                
                                <!--end::Modal IbuKlien-->

                                <!--begin::Modal PenjagaKlien-->
                                <div class="modal fade" id="requestPenjagaKlien" tabindex="-1" aria-labelledby="permohonanPenjagaKlienLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="permohonanPenjagaKlienLabel">Mohon Kemaskini Maklumat Penjaga Klien</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('penjagaKlien.requestUpdate') }}">
                                                    @csrf

                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Hubungan</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="hubungan_penjaga" name="hubungan_penjaga" value="{{ $butiranKlien->hubungan_penjaga }}" style="text-transform: uppercase;"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="nama_penjaga" name="nama_penjaga" value="{{ $butiranKlien->nama_penjaga }}" style="text-transform: uppercase;"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">No Kad Pengenalan</label>
                                                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor kad pengenalan tanpa simbol '-'">
                                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="no_kp_penjaga" name="no_kp_penjaga" value="{{ $butiranKlien->no_kp_penjaga }}" inputmode="numeric" maxlength="12"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon
                                                                <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                                                                    <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                    </i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="no_tel_penjaga" name="no_tel_penjaga" value="{{ $butiranKlien->no_tel_penjaga }}" inputmode="numeric" maxlength="11"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-select-solid" id="status_penjaga" name="status_penjaga" data-control="select2" data-hide-search="true">
                                                                <option>Pilih Status Penjaga</option>
                                                                <option value="HIDUP" {{ $butiranKlien->status_penjaga == 'HIDUP' ? 'selected' : '' }}>HIDUP</option>
                                                                <option value="MENINGGAL DUNIA" {{ $butiranKlien->status_penjaga == 'MENINGGAL DUNIA' ? 'selected' : '' }}>MENINGGAL DUNIA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Alamat</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="d-flex flex-stack">
                                                                <div class="me-5">
                                                                    <input class="form-check-input-sm" id="alamat_penjaga_sama" name="alamat_penjaga_sama" onclick="alamatPenjaga()" type="checkbox" value="1" />
                                                                    <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                                </div>
                                                            </div>
                                                            <textarea class="form-control form-control-solid" id="alamat_p" name="alamat_penjaga" style="text-transform: uppercase;">{{ $butiranKlien->alamat_penjaga }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-solid" id="poskod_p" name="poskod_penjaga" value="{{ $butiranKlien->poskod_penjaga }}" inputmode="numeric" maxlength="5"/>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-select-solid" id="negeri_p" name="negeri_penjaga" data-control="select2" data-hide-search="true">
                                                                <option>Pilih Negeri</option>
                                                                @foreach ($negeriWaris as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->negeri_penjaga == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-3 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <select class="form-select form-select-solid" id="daerah_p" name="daerah_penjaga" data-control="select2" data-hide-search="true">
                                                                <option>Pilih Daerah</option>
                                                                @foreach ($daerahWaris as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->daerah_penjaga == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row fv-row mb-2">
                                                        <div class="col-md-12">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <button type="submit" class="btn btn-primary">Hantar</button>
                                                            </div>
                                                        </div>
                                                    </div>                                            
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                
                                <!--end::Modal PenjagaKlien-->
                            </div>
                        </div>
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Keluarga-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                        <!--begin::Form-->
                        <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="">
                            @csrf
                            <!--begin::Heading-->
                            <div class="row mb-5">
                                <div class="col-md-8 offset-md-4">
                                    <h2>Kemaskini Maklumat Keluarga</h2>
                                </div>
                            </div>
                            <!--end::Heading-->

                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Status Perkahwinan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <span id="status_perkahwinan" class="fs-6 form-control-plaintext">{{$butiranKlien->status_perkahwinan}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <div id="pasangan-fields">
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nama Pasangan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <span id="nama_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->nama_pasangan}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nombor Telefon Pasangan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <span id="no_tel_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_pasangan}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Bilangan Anak</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <span id="bilangan_anak" class="fs-6 form-control-plaintext">{{$butiranKlien->bilangan_anak}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Alamat Rumah Pasangan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <span id="alamat_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_pasangan}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Poskod</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <span id="poskod_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_pasangan}}</span>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Negeri</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            @php
                                                $negeriPasanganKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_pasangan )->value('senarai_negeri.negeri');
                                            @endphp
                                            <span id="negeri_pasagan" class="fs-6 form-control-plaintext">{{ $negeriPasanganKlien }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Daerah</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            @php
                                                $daerahPasanganKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_pasangan )->value('senarai_daerah.daerah');
                                            @endphp
                                            <span id="daerah_pasangan" class="fs-6 form-control-plaintext">{{ $daerahPasanganKlien }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Alamat Tempat Kerja Pasangan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <span id="alamat_kerja_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_kerja_pasangan}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Poskod</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <span id="poskod_kerja_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_kerja_pasangan}}</span>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Negeri</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            @php
                                                $negeriKerjaPasanganKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_kerja_pasangan )->value('senarai_negeri.negeri');
                                            @endphp
                                            <span id="negeri_kerja_pasangan" class="fs-6 form-control-plaintext">{{ $negeriKerjaPasanganKlien }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Daerah</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            @php
                                                $daerahKerjaPasanganKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_kerja_pasangan )->value('senarai_daerah.daerah');
                                            @endphp
                                            <span id="daerah_kerja_pasangan" class="fs-6 form-control-plaintext">{{ $daerahKerjaPasanganKlien }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>

                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-8 offset-md-4">
                                    <div class="d-flex">
                                        @if($resultRequestPasangan)
                                            @if ($resultRequestPasangan->status != "Kemaskini")
                                                <button type="button" class="btn btn-primary modal-trigger" id="requestModalPasanganKlien" data-target="#requestPasanganKlien">
                                                    Mohon Kemaskini
                                                </button>
                                            @else
                                                <div class="btn-light-warning">Permohonan Kemaskini Telah Dihantar</div>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-primary modal-trigger" id="requestModalPasanganKlien" data-target="#requestPasanganKlien">
                                                Mohon Kemaskini
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal KeluargaKlien-->
                        <div class="modal fade" id="requestPasanganKlien" tabindex="-1" aria-labelledby="permohonanPasanganKlienLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="permohonanPasanganKlienLabel">Mohon Kemaskini Maklumat Keluarga Klien</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('pasanganKlien.requestUpdate') }}">
                                            @csrf

                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Status Perkahwinan</label>
                                                </div> 
                                                <div class="col-md-7">
                                                    <!--begin::Select2-->
                                                    <select class="form-select form-select-solid" id="status_perkahwinan" name="status_perkahwinan" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Status Perkahwinan</option>
                                                        <option value="BUJANG" {{ $butiranKlien->status_perkahwinan == 'BUJANG' ? 'selected' : '' }}>BUJANG</option>
                                                        <option value="BERKAHWIN" {{ $butiranKlien->status_perkahwinan == 'BERKAHWIN' ? 'selected' : '' }}>BERKAHWIN</option>
                                                        <option value="DUDA/JANDA/BALU" {{ $butiranKlien->status_perkahwinan == 'DUDA/JANDA/BALU' ? 'selected' : '' }}>DUDA/JANDA/BALU</option>
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama Pasangan</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-solid" id="nama_pasangan" name="nama_pasangan" value="{{ $butiranKlien->nama_pasangan }}" style="text-transform: uppercase;"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon
                                                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                                                            <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                            </i>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-solid" id="no_tel_pasangan" name="no_tel_pasangan" value="{{ $butiranKlien->no_tel_pasangan }}" inputmode="numeric" maxlength="11"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Bilangan Anak</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control form-control-solid" id="bilangan_anak" name="bilangan_anak" value="{{ $butiranKlien->bilangan_anak }}" min="0" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="d-flex flex-stack">
                                                        <div class="me-5">
                                                            <input class="form-check-input-sm" id="alamat_pasangan_sama" name="alamat_pasangan_sama" onclick="alamatPasangan()" type="checkbox" value="1" />
                                                            <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                        </div>
                                                    </div>
                                                    <textarea class="form-control form-control-solid" id="alamat_partner" name="alamat_pasangan" style="text-transform: uppercase;">{{ $butiranKlien->alamat_pasangan }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-solid" id="poskod_partner" name="poskod_pasangan" value="{{ $butiranKlien->poskod_pasangan }}" inputmode="numeric" maxlength="5"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-select form-select-solid" id="negeri_partner" name="negeri_pasangan" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Negeri</option>
                                                        @foreach ($negeriPasangan as $item)
                                                            <option value="{{ $item->id }}" {{ $butiranKlien->negeri_pasangan == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-select form-select-solid" id="daerah_partner" name="daerah_pasangan" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Daerah</option>
                                                        @foreach ($daerahPasangan as $daerahP)
                                                            <option value="{{ $daerahP->id }}" {{ $butiranKlien->daerah_pasangan == $daerahP->id ? 'selected' : '' }}>{{ $daerahP->daerah }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Tempat Kerja</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <textarea class="form-control form-control-solid" id="alamat_kerja_pasangan" name="alamat_kerja_pasangan" style="text-transform: uppercase;">{{ $butiranKlien->alamat_kerja_pasangan }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-solid" id="poskod_kerja_pasangan" name="poskod_kerja_pasangan" value="{{ $butiranKlien->poskod_kerja_pasangan }}" inputmode="numeric" maxlength="5"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-select form-select-solid" id="negeri_kerja_pasangan" name="negeri_kerja_pasangan" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Negeri</option>
                                                        @foreach ($negeriKerjaPasangan as $item)
                                                            <option value="{{ $item->id }}" {{ $butiranKlien->negeri_kerja_pasangan == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-select form-select-solid" id="daerah_kerja_pasangan" name="daerah_kerja_pasangan" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Daerah</option>
                                                        @foreach ($daerahKerjaPasangan as $item)
                                                            <option value="{{ $item->id }}" {{ $butiranKlien->daerah_kerja_pasangan == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row fv-row mb-2">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <button type="submit" class="btn btn-primary">Hantar</button>
                                                    </div>
                                                </div>
                                            </div>                                             
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                                                
                        <!--end::Modal-->
                    </div>
                    <!--end:::Tab pane-->
                </div>
                <!--end:::Tab content-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Success / Error Message --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there is a flash success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya!',
                    text: '{!! session('success') !!}',
                    confirmButtonText: 'OK'
                });
            @endif

            // Check if there is a flash error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Berjaya!',
                    text: '{!! session('error') !!}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    {{-- Display daerah based on negeri --}}
    <script>
        $(document).ready(function () {
            var previousIdNegeri = $('#negeri').val();

            // Initial AJAX request
            getBandarData(previousIdNegeri);

            $('#negeri').on('change', function () {
                var idnegeri = $(this).val();

                // Update the previous value
                previousIdNegeri = idnegeri;

                // Clear existing options
                $("#daerah").empty();
                $('#poskod').val('');


                // Trigger AJAX request
                getBandarData(idnegeri);
            });

            function getBandarData(idnegeri) {
                // $("#alamat_tetap_bandar").empty();

                // AJAX request 
                $.ajax({
                    url: '/get-daerah/' + idnegeri,
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            var selectedValue = $("#daerah").val();
                            // alert(selectedValue);

                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var daerah = response['data'][i].daerah;

                                var isSelected = (id == selectedValue);

                                var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + daerah + "</option>";

                                $("#daerah").append(option);
                            }
                        }
                    },
                    error: function () {
                        alert('tak keluar daerah punn');
                    }
                });
            }
        });
    </script>

    {{-- Search in dropdown button --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    {{-- Calculate umur based on IC --}}
    <script>
        function calculateAgeFromIC() {
            let icNumber = document.getElementById('no_kp').textContent.trim();
            icNumber = icNumber.replace(':', '').trim();  // Remove colon and trim whitespace
            console.log("IC Number after trimming: ", icNumber);

            const year = parseInt(icNumber.substring(0, 2), 10);
            const month = parseInt(icNumber.substring(2, 4), 10);
            const day = parseInt(icNumber.substring(4, 6), 10);

            const currentYear = new Date().getFullYear();
            const currentMonth = new Date().getMonth() + 1;
            const currentDay = new Date().getDate();

            const birthYear = year < (currentYear % 100) ? 2000 + year : 1900 + year;

            let age = currentYear - birthYear;
            if (currentMonth < month || (currentMonth === month && currentDay < day)) {
                age--;
            }

            document.getElementById('umur').textContent = `${age}`; // Update the text content of the span
            document.getElementById('modal_umur').textContent = `${age}`; 
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            calculateAgeFromIC();
        });

        document.getElementById('requestModalPeribadiKlien').addEventListener('click', (event) => {
            calculateAgeFromIC();
        });
    </script>

    {{-- Open modal to update profile --}}
    <script>
        document.querySelectorAll('.modal-trigger').forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var target = this.getAttribute('data-target');
                var modal = new bootstrap.Modal(document.querySelector(target));
                modal.show();
            });
        });
    </script>

    {{-- Checkbox alamat bapa --}}
    <script>
        // Store initial values in variables
        var initialAlamatBapa = document.getElementById("alamat_b").value;
        var initialNegeriBapa = document.getElementById("negeri_b").value;
        var initialDaerahBapa = document.getElementById("daerah_b").value;
        var initialPoskodBapa = document.getElementById("poskod_b").value;

        function alamatBapa() {
            
            var checkBox = document.getElementById("alamat_bapa_sama");
            var alamat_klien = document.getElementById("alamat_rumah");
            var klien_negeri = document.getElementById("negeri");
            var klien_daerah = document.getElementById("daerah");
            var klien_poskod = document.getElementById("poskod");

            var alamat_bapa = document.getElementById("alamat_b");
            var negeri_bapa = document.getElementById("negeri_b");
            var daerah_bapa = document.getElementById("daerah_b");
            var poskod_bapa = document.getElementById("poskod_b");

            if (checkBox.checked) {
                // Copy values
                alamat_bapa.value = alamat_klien.innerText;
                poskod_bapa.value = klien_poskod.innerText;
                negeri_bapa.value = klien_negeri.innerText;
                daerah_bapa.value = klien_daerah.innerText;

                // Trigger select2 update if using select2
                if ($(negeri_bapa).data('select2')) {
                    $(negeri_bapa).val(klien_negeri.value).trigger('change.select2');
                }
                if ($(daerah_bapa).data('select2')) {
                    $(daerah_bapa).val(klien_daerah.value).trigger('change.select2');
                }
            } else {
                // Back Initial Value
                alamat_bapa.value = initialAlamatBapa;
                poskod_bapa.value = initialPoskodBapa;
                negeri_bapa.value = initialNegeriBapa;
                daerah_bapa.value = initialDaerahBapa;

                // Trigger select2 update if using select2
                if ($(negeri_bapa).data('select2')) {
                    $(negeri_bapa).val(initialNegeriBapa).trigger('change.select2');
                }
                if ($(daerah_bapa).data('select2')) {
                    $(daerah_bapa).val(initialDaerahBapa).trigger('change.select2');
                }

            }
        }
    </script>

    {{-- Checkbox alamat ibu --}}
    <script>
        // Store initial values in variables
        var initialAlamatIbu = document.getElementById("alamat_i").value;
        var initialNegeriIbu = document.getElementById("negeri_i").value;
        var initialDaerahIbu = document.getElementById("daerah_i").value;
        var initialPoskodIbu = document.getElementById("poskod_i").value;

        function alamatIbu() {
            
            var checkBox = document.getElementById("alamat_ibu_sama");
            var alamat_klien = document.getElementById("alamat_rumah");
            var klien_negeri = document.getElementById("negeri");
            var klien_daerah = document.getElementById("daerah");
            var klien_poskod = document.getElementById("poskod");

            var alamat_ibu = document.getElementById("alamat_i");
            var negeri_ibu = document.getElementById("negeri_i");
            var daerah_ibu = document.getElementById("daerah_i");
            var poskod_ibu = document.getElementById("poskod_i");

            if (checkBox.checked) {
                // Copy values
                alamat_ibu.value = alamat_klien.innerText;
                poskod_ibu.value = klien_poskod.innerText;
                negeri_ibu.value = klien_negeri.innerText;
                daerah_ibu.value = klien_daerah.innerText;

                // Trigger select2 update if using select2
                if ($(negeri_ibu).data('select2')) {
                    $(negeri_ibu).val(klien_negeri.value).trigger('change.select2');
                }
                if ($(daerah_ibu).data('select2')) {
                    $(daerah_ibu).val(klien_daerah.value).trigger('change.select2');
                }
            } else {
                // Back Initial Value
                alamat_ibu.value = initialAlamatIbu;
                poskod_ibu.value = initialPoskodIbu;
                negeri_ibu.value = initialNegeriIbu;
                daerah_ibu.value = initialDaerahIbu;

                // Trigger select2 update if using select2
                if ($(negeri_ibu).data('select2')) {
                    $(negeri_ibu).val(initialNegeriIbu).trigger('change.select2');
                }
                if ($(daerah_ibu).data('select2')) {
                    $(daerah_ibu).val(initialDaerahIbu).trigger('change.select2');
                }

            }
        }
    </script>

    {{-- Checkbox alamat penjaga --}}
    <script>
        // Store initial values in variables
        var initialAlamatPenjaga = document.getElementById("alamat_p").value;
        var initialNegeriPenjaga = document.getElementById("negeri_p").value;
        var initialDaerahPenjaga = document.getElementById("daerah_p").value;
        var initialPoskodPenjaga = document.getElementById("poskod_p").value;

        function alamatPenjaga() {
            
            var checkBox = document.getElementById("alamat_penjaga_sama");
            var alamat_klien = document.getElementById("alamat_rumah");
            var klien_negeri = document.getElementById("negeri");
            var klien_daerah = document.getElementById("daerah");
            var klien_poskod = document.getElementById("poskod");

            var alamat_penjaga = document.getElementById("alamat_p");
            var negeri_penjaga = document.getElementById("negeri_p");
            var daerah_penjaga = document.getElementById("daerah_p");
            var poskod_penjaga = document.getElementById("poskod_p");

            if (checkBox.checked) {
                // Copy values
                alamat_penjaga.value = alamat_klien.innerText;
                poskod_penjaga.value = klien_poskod.innerText;
                negeri_penjaga.value = klien_negeri.innerText;
                daerah_penjaga.value = klien_daerah.innerText;

                // Trigger select2 update if using select2
                if ($(negeri_penjaga).data('select2')) {
                    $(negeri_penjaga).val(klien_negeri.value).trigger('change.select2');
                }
                if ($(daerah_penjaga).data('select2')) {
                    $(daerah_penjaga).val(klien_daerah.value).trigger('change.select2');
                }
            } else {
                // Back Initial Value
                alamat_penjaga.value = initialAlamatPenjaga;
                poskod_penjaga.value = initialPoskodPenjaga;
                negeri_penjaga.value = initialNegeriPenjaga;
                daerah_penjaga.value = initialDaerahPenjaga;

                // Trigger select2 update if using select2
                if ($(negeri_penjaga).data('select2')) {
                    $(negeri_penjaga).val(initialNegeriaPenjaga).trigger('change.select2');
                }
                if ($(daerah_penjaga).data('select2')) {
                    $(daerah_penjaga).val(initialDaerahPenjaga).trigger('change.select2');
                }

            }
        }
    </script>

    {{-- Checkbox alamat pasangan --}}
    <script>
        // Store initial values in variables
        var initialAlamatPasangan = document.getElementById("alamat_partner").value;
        var initialNegeriPasangan = document.getElementById("negeri_partner").value;
        var initialDaerahPasangan = document.getElementById("daerah_partner").value;
        var initialPoskodPasangan = document.getElementById("poskod_partner").value;

        function alamatPasangan() {
            
            var checkBox = document.getElementById("alamat_pasangan_sama");
            var alamat_klien = document.getElementById("alamat_rumah");
            var klien_negeri = document.getElementById("negeri");
            var klien_daerah = document.getElementById("daerah");
            var klien_poskod = document.getElementById("poskod");

            var alamat_partner = document.getElementById("alamat_partner");
            var negeri_partner = document.getElementById("negeri_partner");
            var daerah_partner = document.getElementById("daerah_partner");
            var poskod_partner = document.getElementById("poskod_partner");

            if (checkBox.checked) {
                // Copy values
                alamat_partner.value = alamat_klien.innerText;
                poskod_partner.value = klien_poskod.innerText;
                negeri_partner.value = klien_negeri.innerText;
                daerah_partner.value = klien_daerah.innerText;

                // Trigger select2 update if using select2
                if ($(negeri_partner).data('select2')) {
                    $(negeri_partner).val(klien_negeri.value).trigger('change.select2');
                }
                if ($(daerah_partner).data('select2')) {
                    $(daerah_partner).val(klien_daerah.value).trigger('change.select2');
                }
            } else {
                // Back Initial Value
                alamat_partner.value = initialAlamatPasangan;
                poskod_partner.value = initialPoskodPasangan;
                negeri_partner.value = initialNegeriPasangan;
                daerah_partner.value = initialDaerahPasangan;

                // Trigger select2 update if using select2
                if ($(negeri_partner).data('select2')) {
                    $(negeri_partner).val(initialNegeriPasangan).trigger('change.select2');
                }
                if ($(daerah_partner).data('select2')) {
                    $(daerah_partner).val(initialDaerahPasangan).trigger('change.select2');
                }
            }
        }
    </script>

    {{-- Control input number --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to restrict input to digits and set max length
            function restrictInput(element, maxLength) {
                element.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '');  // Remove non-digit characters
                    if (this.value.length > maxLength) {         // Limit to max length
                        this.value = this.value.slice(0, maxLength);
                    }
                });
            }
        
            // Restrict input to digits for all specified fields
            const maxLengthSettings = {
                'no_tel': 11,
                'poskod': 5,
                'no_tel_majikan': 11,
                'poskod_kerja': 5,
                'no_kp_bapa': 12,
                'no_tel_bapa': 11,
                'poskod_bapa': 5,
                'no_kp_ibu': 12,
                'no_tel_ibu': 11,
                'poskod_ibu': 5,
                'no_kp_penjaga': 12,
                'no_tel_penjaga': 11,
                'poskod_penjaga': 5,
                'no_tel_pasangan': 11,
                'poskod_pasangan': 5,
                'poskod_kerja_pasangan': 5
            };
        
            // Loop through each setting and apply the restriction
            Object.keys(maxLengthSettings).forEach(function(name) {
                document.querySelectorAll('[name="' + name + '"]').forEach(function(element) {
                    restrictInput(element, maxLengthSettings[name]);
                });
            });
        });
    </script>        
    {{-- <script>
		document.addEventListener('DOMContentLoaded', function() {
			// Select all elements with name 'no_kp' and 'no_tel'
			const noKpElements = document.querySelectorAll('[name="no_kp"]');
			const noTelElements = document.querySelectorAll('[name="no_tel"]');

			// Restrict input to digits for 'no_kp' elements
			noKpElements.forEach(function(element) {
				element.addEventListener('input', function (e) {
					this.value = this.value.replace(/\D/g, '');  // Remove non-digit characters
					if (this.value.length > 12) {                // Limit to 12 digits
						this.value = this.value.slice(0, 12);
					}
				});
			});

			// Restrict input to digits for 'no_tel' elements
			noTelElements.forEach(function(element) {
				element.addEventListener('input', function (e) {
					this.value = this.value.replace(/\D/g, '');  // Remove non-digit characters
					if (this.value.length > 11) {                // Limit to 11 digits
						this.value = this.value.slice(0, 11);
					}
				});
			});
		});
	</script> --}}
</body>
@endsection