@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <style>
        /* body{
            font-size: 12pt !important;
            margin: 0 auto;
        } */

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
            max-height: 400px; /* Adjust the height as needed */
            overflow-y: auto;
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
    
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card body-->
                <div class="card-body" >
                    <!--begin:::Tabs-->
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
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
                        <li class="nav-item">
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
                        <li class="nav-item">
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
                        <li class="nav-item">
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
                    <div class="tab-content scrollable-container" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">
                            <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="">
                                <!--begin::Heading-->
                                <div class="row mb-7">
                                    <div class="col-md-9 offset-md-3">
                                        <h2>Kemaskini Maklumat Peribadi</h2>
                                    </div>
                                </div>
                                <!--end::Heading-->
                                
                                <!--begin::Input group-->
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
                                    <div class="col-md-5 d-flex align-items-center">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3 mb-0">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
                                    <div class="col-md-5 text-md-start">
                                        <label class="fs-6 fw-semibold form-label mt-3"><span>Nombor Telefon</span></label>
                                    </div>
                                    <div class="col-md-7">
                                        <span id="no_tel" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel}}</span>
                                    </div>
                                </div>
                                <!--begin::Input group-->
                                <div class="row fv-row mb-2">
                                    <div class="col-md-5 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Alamat E-mel</span>
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                            <span id="daerah" class="fs-6 form-control-plaintext">{{$daerahKlien}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-2">
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
                                            <span id="negeri" class="fs-6 form-control-plaintext">{{$negeriKlien}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-2">
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
                                                @if ($resultRequestKlien->status != 'Dikemaskini' || $butiranKlien->status_kemaskini != 'Dikemaskini')
                                                    <button type="button" class="btn btn-primary modal-trigger" id="requestModalPeribadiKlien" data-target="#requestPeribadiKlien">
                                                        Mohon Kemaskini
                                                    </button>                                            
                                                @else
                                                    <div class="btn-light-warning">Permohonan Dikemaskini</div>
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
                                            <h5 class="modal-title" id="permohonanPeribadiKlienLabel">Mohon Kemaskini Maklumat Peribadi Klien</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('klien.requestUpdate') }}">
                                                @csrf

                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nama</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="nama" class="fs-6 form-control-plaintext">{{$butiranKlien->nama}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">No Kad Pengenalan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="no_kp" class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Umur</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="modal_umur" class="fs-6 form-control-plaintext"></span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Jantina</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="jantina" class="fs-6 form-control-plaintext">{{$butiranKlien->jantina}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Agama</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="agama" class="fs-6 form-control-plaintext">{{$butiranKlien->agama}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Bangsa</label>
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
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nombor Telefon</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid" id="no_tel" name="no_tel" value="{{ old('no_tel', $butiranKlien->no_tel) }}" />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Alamat E-mel</label>
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
                                                        <textarea class="form-control form-control-solid" id="alamat_rumah" name="alamat_rumah">{{ $butiranKlien->alamat_rumah }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Poskod</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid" id="poskod" name="poskod" value="{{ $butiranKlien->poskod }}"/>
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
                                                                <option value="{{ $item->id }}" {{ $butiranKlien->daerah == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-select form-select-solid" id="negeri" name="negeri" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Negeri</option>
                                                            @foreach ($negeri as $item)
                                                                <option value="{{ $item->id }}" {{ $butiranKlien->negeri == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
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

                                                <div class="row fv-row mb-7">
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
                                <div class="row mb-7">
                                    <div class="col-md-9 offset-md-3">
                                        <h2>Kemaskini Maklumat Pekerjaan</h2>
                                    </div>
                                </div>
                                <!--end::Heading-->
                        
                                <!--begin::Input group-->
                                <div class="row fv-row mb-2">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Status</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <span id="pekerjaan" class="fs-6 form-control-plaintext">{{$butiranKlien->status_kerja}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-2">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Bidang</span>
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
                                <div class="row fv-row mb-2">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nama</span>
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nama Majikan</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Boleh masukkan sehingga dua tempat perpuluhan.">
                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
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
                                <div class="row fv-row mb-2">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nombor Telefon Majikan</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <div class="row fv-row mb-2">
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
                                <!--begin::Input group-->
                                <div class="row fv-row mb-2">
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

                                <!--begin::Action buttons-->
                                <div class="row py-5">
                                    <div class="col-md-8 offset-md-4">
                                        <div class="d-flex">
                                            @if($resultRequestPekerjaan)
                                                @if ($resultRequestPekerjaan->status != 'Dikemaskini' || $butiranKlien->status_kemaskini != 'Dikemaskini')
                                                    <button type="button" class="btn btn-primary modal-trigger" id="requestModalPekerjaanKlien" data-target="#requestPekerjaanKlien">
                                                        Mohon Kemaskini
                                                    </button>
                                                @else
                                                    <div class="btn-light-warning">Permohonan Dikemaskini</div>
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
                                            <h5 class="modal-title" id="permohonanPekerjaanKlienLabel">Mohon Kemaskini Maklumat Pekerjaan Klien</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('pekerjaanKlien.requestUpdate') }}">
                                                @csrf

                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Status</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-select form-select-solid" id="pekerjaan" name="pekerjaan" data-control="select2" data-hide-search="true">
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
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Bidang</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid" id="bidang_kerja" name="bidang_kerja" value="{{$butiranKlien->bidang_kerja}}"/>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nama</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid" id="bidang_kerja" name="bidang_kerja" value="{{$butiranKlien->bidang_kerja}}"/>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Pendapatan (RM)</label>
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
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Kategori Majikan</label>
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
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nama Majikan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid" id="nama_majikan" name="nama_majikan" value="{{ $butiranKlien->nama_majikan }}" />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nombor Telefon Majikan
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
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_majikan" name="no_tel_majikan" value="{{$butiranKlien->no_tel_majikan}}"/>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Alamat Tempat Kerja</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control form-control-solid" id="alamat_kerja" name="alamat_kerja">{{$butiranKlien->alamat_kerja}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Poskod</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid" maxlength="5" id="poskod_kerja" name="poskod_kerja" value="{{$butiranKlien->poskod_kerja}}"/>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Daerah</label>
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
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
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
                            <!--begin::Form-->
                            <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="">
                                @csrf
                                <!--begin::Heading-->
                                <div class="row mb-7">
                                    <div class="col-md-9 offset-md-3">
                                        <h2>Kemaskini Maklumat Waris</h2>
                                    </div>
                                </div>
                                <!--end::Heading-->
                                
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Hubungan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <span id="hubungan_waris" class="fs-6 form-control-plaintext">{{$butiranKlien->hubungan_waris}}</span>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nama</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-7">
                                        <!--begin::Input-->
                                        <span id="nama_waris" class="fs-6 form-control-plaintext">{{$butiranKlien->nama_waris}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nombor Telefon</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-7">
                                        <!--begin::Input-->
                                        <span id="no_tel_waris" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_waris}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Alamat</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-7">
                                        <!--begin::Input-->
                                        <span id="alamat_waris" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_waris}}</span>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Poskod</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-7">
                                        <div class="w-100">
                                            <span id="poskod_waris" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_waris}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Daerah</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-7">
                                        <div class="w-100">
                                            @php
                                                $daerahWarisKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_waris )->value('senarai_daerah.daerah');
                                            @endphp
                                            <span id="daerah_waris" class="fs-6 form-control-plaintext">{{ $daerahWarisKlien }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Negeri</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-7">
                                        <div class="w-100">
                                            @php
                                                $negeriWarisKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_waris )->value('senarai_negeri.negeri');
                                            @endphp
                                            <span id="negeri_waris" class="fs-6 form-control-plaintext">{{ $negeriWarisKlien }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Action buttons-->
                                <div class="row py-5">
                                    <div class="col-md-9 offset-md-3">
                                        <div class="d-flex">
                                            @if($resultRequestWaris)
                                                @if ($resultRequestWaris->status != 'Dikemaskini' || $butiranKlien->status_kemaskini != 'Dikemaskini')
                                                    <button type="button" class="btn btn-primary modal-trigger" id="requestModalWarisKlien" data-target="#requestWarisKlien">
                                                        Mohon Kemaskini
                                                    </button>
                                                @else
                                                    <div class="btn-light-warning">Permohonan Dikemaskini</div>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-primary modal-trigger" id="requestModalWarisKlien" data-target="#requestWarisKlien">
                                                    Mohon Kemaskini
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--end::Action buttons-->
                            </form>
                            <!--end::Form-->

                            <!--begin::Modal WarisKlien-->
                            <div class="modal fade" id="requestWarisKlien" tabindex="-1" aria-labelledby="permohonanWarisKlienLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="permohonanWarisKlienLabel">Mohon Kemaskini Maklumat Waris Klien</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('warisKlien.requestUpdate') }}">
                                                @csrf

                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-3 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Hubungan</label>
                                                    </div> 
                                                    <div class="col-md-9">
                                                        <select id="hubungan_waris" name="hubungan_waris" class="form-select form-select-solid" data-control="select2">
                                                            <option>Pilih hubungan waris</option>
                                                            <option value="IBU" {{ $butiranKlien->hubungan_waris == 'IBU' ? 'selected' : '' }}>IBU</option>
                                                            <option value="BAPA" {{ $butiranKlien->hubungan_waris == 'BAPA' ? 'selected' : '' }}>BAPA</option>
                                                            <option value="PENJAGA" {{ $butiranKlien->hubungan_waris == 'PENJAGA' ? 'selected' : '' }}>PENJAGA</option>
                                                            <option value="SAUDARA KANDUNG" {{ $butiranKlien->hubungan_waris == 'SAUDARA KANDUNG' ? 'selected' : '' }}>SAUDARA KANDUNG</option>
                                                            <option value="LAIN-LAIN" {{ $butiranKlien->hubungan_waris == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-3 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nama</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control form-control-solid" id="nama_waris" name="nama_waris" value="{{ $butiranKlien->nama_waris }}" />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-3 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nombor Telefon
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
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_waris" name="no_tel_waris" value="{{ $butiranKlien->no_tel_waris }}" />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-3 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Alamat</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control form-control-solid" id="alamat_waris" name="alamat_waris">{{ $butiranKlien->alamat_waris }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-3 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Poskod</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control form-control-solid" id="poskod_waris" name="poskod_waris" value="{{ $butiranKlien->poskod_waris }}"/>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-3 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Daerah</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select class="form-select form-select-solid" id="daerah_waris" name="daerah_waris" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Daerah</option>
                                                            @foreach ($daerahWaris as $item)
                                                                <option value="{{ $item->id }}" {{ $butiranKlien->daerah_waris == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-3 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select class="form-select form-select-solid" id="negeri_waris" name="negeri_waris" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Negeri</option>
                                                            @foreach ($negeriWaris as $item)
                                                                <option value="{{ $item->id }}" {{ $butiranKlien->negeri_waris == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row fv-row mb-7">
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


                        <!--begin:::Tab pane Keluarga-->
                        <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                            <!--begin::Form-->
                            <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form" action="">
                                @csrf
                                <!--begin::Heading-->
                                <div class="row mb-7">
                                    <div class="col-md-9 offset-md-3">
                                        <h2>Kemaskini Maklumat Keluarga</h2>
                                    </div>
                                </div>
                                <!--end::Heading-->

                                <!--begin::Input group-->
                                <div class="row fv-row mb-2">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Status Perkahwinan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-7">
                                        <span id="status_perkahwinan" class="fs-6 form-control-plaintext">{{$butiranKlien->status_perkahwinan}}</span>
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <div id="pasangan-fields">
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Nama Pasangan</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <!--begin::Input-->
                                            <span id="nama_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->nama_pasangan}}</span>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Nombor Telefon Pasangan</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <!--begin::Input-->
                                            <span id="no_tel_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_pasangan}}</span>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Bilangan Anak</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <!--begin::Input-->
                                            <span id="bilangan_anak" class="fs-6 form-control-plaintext">{{$butiranKlien->bilangan_anak}}</span>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Alamat Pasangan</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <!--begin::Input-->
                                            <span id="alamat_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_pasangan}}</span>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Poskod</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <div class="w-100">
                                                <!--begin::Select2-->
                                                <span id="poskod_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_pasangan}}</span>
                                                <!--end::Select2-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Daerah</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <div class="w-100">
                                                @php
                                                    $daerahPasanganKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_pasangan )->value('senarai_daerah.daerah');
                                                @endphp
                                                <span id="daerah_waris" class="fs-6 form-control-plaintext">{{ $daerahPasanganKlien }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Negeri</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <div class="w-100">
                                                @php
                                                    $negeriPasanganKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_pasangan )->value('senarai_negeri.negeri');
                                                @endphp
                                                <span id="negeri_waris" class="fs-6 form-control-plaintext">{{ $negeriPasanganKlien }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Alamat Tempat Kerja Pasangan</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <!--begin::Input-->
                                            <span id="alamat_kerja_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_kerja_pasangan}}</span>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Poskod</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <div class="w-100">
                                                <!--begin::Select2-->
                                                <span id="poskod_kerja_pasangan" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_kerja_pasangan}}</span>
                                                <!--end::Select2-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Daerah</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <div class="w-100">
                                                @php
                                                    $daerahKerjaPasanganKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_kerja_pasangan )->value('senarai_daerah.daerah');
                                                @endphp
                                                <span id="daerah_kerja_pasangan" class="fs-6 form-control-plaintext">{{ $daerahKerjaPasanganKlien }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row mb-2">
                                        <div class="col-md-3 text-md-start">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Negeri</span>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <div class="col-md-7">
                                            <div class="w-100">
                                                @php
                                                    $negeriKerjaPasanganKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_kerja_pasangan )->value('senarai_negeri.negeri');
                                                @endphp
                                                <span id="negeri_kerja_pasangan" class="fs-6 form-control-plaintext">{{ $negeriKerjaPasanganKlien }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>

                                <!--begin::Action buttons-->
                                <div class="row py-5">
                                    <div class="col-md-9 offset-md-3">
                                        <div class="d-flex">
                                            @if($resultRequestPasangan)
                                                @if ($resultRequestPasangan->status != 'Dikemaskini' || $butiranKlien->status_kemaskini != 'Dikemaskini')
                                                    <button type="button" class="btn btn-primary modal-trigger" id="requestModalPasanganKlien" data-target="#requestPasanganKlien">
                                                        Mohon Kemaskini
                                                    </button>
                                                @else
                                                    <div class="btn-light-warning">Permohonan Dikemaskini</div>
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

                            <!--begin::Modal PasanganKlien-->
                            <div class="modal fade" id="requestPasanganKlien" tabindex="-1" aria-labelledby="permohonanPasanganKlienLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="permohonanPasanganKlienLabel">Mohon Kemaskini Maklumat Keluarga Klien</h5>
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
                                                            <option value="BERCERAI" {{ $butiranKlien->status_perkahwinan == 'BERCERAI' ? 'selected' : '' }}>BERCERAI</option>
                                                            <option value="JANDA" {{ $butiranKlien->status_perkahwinan == 'JANDA' ? 'selected' : '' }}>JANDA</option>
                                                            <option value="DUDA" {{ $butiranKlien->status_perkahwinan == 'DUDA' ? 'selected' : '' }}>DUDA</option>
                                                        </select>
                                                        <!--end::Select2-->
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nama</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control form-control-solid" id="nama_pasangan" name="nama_pasangan" value="{{ $butiranKlien->nama_pasangan }}" />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Nombor Telefon
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
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_pasangan" name="no_tel_pasangan" value="{{ $butiranKlien->no_tel_pasangan }}" />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Bilangan Anak</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control form-control-solid" id="bilangan_anak" name="bilangan_anak" value="{{ $butiranKlien->bilangan_anak }}" min="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Alamat</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <textarea class="form-control form-control-solid" id="alamat_pasangan" name="alamat_pasangan">{{ $butiranKlien->alamat_pasangan }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Poskod</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control form-control-solid" id="poskod_pasangan" name="poskod_pasangan" value="{{ $butiranKlien->poskod_pasangan }}"/>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Daerah</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-select form-select-solid" id="daerah_pasangan" name="daerah_pasangan" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Daerah</option>
                                                            @foreach ($daerahPasangan as $daerahP)
                                                                <option value="{{ $daerahP->id }}" {{ $butiranKlien->daerah_pasangan == $daerahP->id ? 'selected' : '' }}>{{ $daerahP->daerah }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-select form-select-solid" id="negeri_pasangan" name="negeri_pasangan" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Negeri</option>
                                                            @foreach ($negeriPasangan as $item)
                                                                <option value="{{ $item->id }}" {{ $butiranKlien->negeri_pasangan == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Alamat Tempat Kerja</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <textarea class="form-control form-control-solid" id="alamat_kerja_pasangan" name="alamat_kerja_pasangan">{{ $butiranKlien->alamat_kerja_pasangan }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control form-control-solid" id="poskod_kerja_pasangan" name="poskod_kerja_pasangan" value="{{ $butiranKlien->poskod_kerja_pasangan }}"/>
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
    </div>
    <!--end::Content-->

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there is a flash message
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

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

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

    <script>
        document.querySelectorAll('.modal-trigger').forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var target = this.getAttribute('data-target');
                var modal = new bootstrap.Modal(document.querySelector(target));
                modal.show();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var statusSelect = document.getElementById('status_perkahwinan');
            var pasanganFields = document.getElementById('pasangan-fields');
        
            function togglePasanganFields() {
                console.log('Status Perkahwinan changed to: ', statusSelect.value); // Debugging line
                if (statusSelect.value === 'BERKAHWIN') {
                    pasanganFields.style.display = 'block';
                } else {
                    pasanganFields.style.display = 'none';
                }
            }
        
            // Initialize the visibility on page load
            togglePasanganFields();
        
            // Listen for changes on the status select
            statusSelect.addEventListener('change', function() {
                console.log('Change event detected'); // Debugging line
                togglePasanganFields();
            });
        });
    </script> 
</body>
@endsection