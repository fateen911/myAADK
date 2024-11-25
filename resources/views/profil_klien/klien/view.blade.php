@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}

    <!-- SweetAlert (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <!-- jQuery (required for Select2) -->
    {{-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js (required for Bootstrap dropdowns) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> --}}

    <!-- Bootstrap (required for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Flexbox settings for the wrapper */
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* Centered form settings */
        .centered-form {
            width: 100%;
            padding-left: 50px; 
            padding-right: 50px;
            box-sizing: border-box; 
            flex-direction: column;
            align-items: center; 
        }

        /* General styles for input, textarea, and select */
        input.form-control.form-control-solid,
        textarea.form-control.form-control-solid {
            background-color: #e0e0e0;
            color: #45505b;
        }

        /* Focus state for input, textarea, and select */
        input.form-control.form-control-solid:focus,
        textarea.form-control.form-control-solid:focus {
            background-color: #d0d0d0;
            color: #333333;
            box-shadow: none;
        }

        .form-select.custom-select {
            background-color: #e0e0e0 !important;
            color: #222222 !important;
        }

        .form-select.custom-select option {
            background-color: #f5f5f5 !important;
            color: #222222 !important;
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
            background-color: #faf5d6;
            color: #ffbd07;
            padding: 0.75rem 0.75rem;
            border-radius: 0.25rem;
            display: inline-block;
            text-align: center;
            margin-left: 10px;
        }

        .btn-light-warning:hover,
        .btn-light-warning:focus,
        .btn-light-warning:active {
            background-color: #faf5d6;
            color: #ffbd07; 
        }

        .scrollable-container {
            max-height: 375px; 
            overflow-y: auto;
        }

        .nav-link.active {
            font-weight: bold;
            color: #007bff !important;
        }

        .select2-container {
            z-index: 9999 !important; /* Higher than the modal z-index */
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
                <li class="breadcrumb-item text-muted">Pengurusan</li>
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
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <!--end::primary button-->
        </div>    
        <!--end::Actions-->
    </div>

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid d-flex justify-content-center align-items-center">
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
                        <!--begin:::Tab pane Peribadi-->
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
                                        <span class="fs-6 form-control-plaintext">{{$butiranKlien->nama}}</span>
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
                                        <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp}}</span>
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
                                            <span class="fs-6 form-control-plaintext">{{ $butiranKlien->jantina == 'L' ? 'LELAKI' : 'PEREMPUAN' }}</span>
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
                                            @php
                                                $agamaKlien = DB::table('senarai_agama')->where('id', $butiranKlien->agama)->value('senarai_agama.agama');
                                            @endphp
                                            <span class="fs-6 form-control-plaintext">{{$agamaKlien}}</span>
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
                                            @php
                                                $bangsaKlien = DB::table('senarai_bangsa')->where('id', $butiranKlien->bangsa)->value('senarai_bangsa.bangsa');
                                            @endphp
                                            <span class="fs-6 form-control-plaintext">{{$bangsaKlien}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row">
                                    <div class="col-md-5 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Penyakit</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-7">
                                        <!--begin::Input-->
                                        @php
                                            $penyakitKlien = DB::table('senarai_penyakit')->where('id', $butiranKlien->penyakit)->value('senarai_penyakit.penyakit');
                                        @endphp
                                        <span class="fs-6 form-control-plaintext">{{$penyakitKlien}}</span>
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
                                        <span class="fs-6 form-control-plaintext">{{$butiranKlien->status_oku}}</span>
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
                                        <span class="fs-6 form-control-plaintext">
                                            {{$butiranKlien->skor_ccri}}
                                            @if($butiranKlien->skor_ccri < 40)
                                                (TIDAK MEMUASKAN)
                                            @elseif($butiranKlien->skor_ccri >= 40 && $butiranKlien->skor_ccri <= 60)
                                                (MEMUASKAN)
                                            @elseif($butiranKlien->skor_ccri >= 61 && $butiranKlien->skor_ccri <= 79)
                                                (BAIK)
                                            @elseif($butiranKlien->skor_ccri >= 80)
                                                (CEMERLANG)
                                            @endif
                                        </span>
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
                                        <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel}}</span>
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
                                        <span class="fs-6 form-control-plaintext">{{$butiranKlien->emel}}</span>
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
                                        <span class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_rumah}}</span>
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
                                            <span id="poskod_klien" class="fs-6 form-control-plaintext">{{$butiranKlien->poskod}}</span>
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
                                        @php
                                            $pendidikan = DB::table('senarai_pendidikan')->where('id', $butiranKlien->tahap_pendidikan)->value('senarai_pendidikan.pendidikan');
                                        @endphp
                                        <span class="fs-6 form-control-plaintext">{{$pendidikan}}</span>
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
                                            <form id="peribadiKlienForm" method="POST" action="{{ route('klien.requestUpdate') }}">
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
                                                        <span id="jantina" class="fs-6 form-control-plaintext">{{ $butiranKlien->jantina == 'L' ? 'LELAKI' : 'PEREMPUAN' }}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Agama</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        @php
                                                            $agamaKlien = DB::table('senarai_agama')->where('id', $butiranKlien->agama)->value('senarai_agama.agama');
                                                        @endphp
                                                        <span id="agama" class="fs-6 form-control-plaintext">{{$agamaKlien}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Bangsa</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        @php
                                                            $bangsaKlien = DB::table('senarai_bangsa')->where('id', $butiranKlien->bangsa)->value('senarai_bangsa.bangsa');
                                                        @endphp
                                                        <span id="bangsa" class="fs-6 form-control-plaintext">{{$bangsaKlien}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Penyakit</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @php
                                                            $penyakitKlien = DB::table('senarai_penyakit')->where('id', $butiranKlien->penyakit)->value('senarai_penyakit.penyakit');
                                                        @endphp
                                                        <span id="penyakit" class="fs-6 form-control-plaintext">{{$penyakitKlien}}</span>
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
                                                        <span id="skor_ccri" class="fs-6 form-control-plaintext">
                                                            {{$butiranKlien->skor_ccri}}
                                                            @if($butiranKlien->skor_ccri < 40)
                                                                (TIDAK MEMUASKAN)
                                                            @elseif($butiranKlien->skor_ccri >= 40 && $butiranKlien->skor_ccri <= 60)
                                                                (MEMUASKAN)
                                                            @elseif($butiranKlien->skor_ccri >= 61 && $butiranKlien->skor_ccri <= 79)
                                                                (BAIK)
                                                            @elseif($butiranKlien->skor_ccri >= 80)
                                                                (CEMERLANG)
                                                            @endif
                                                        </span>
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
                                                        <input type="text" class="form-control form-control-solid" id="poskod" name="poskod" value="{{ $butiranKlien->poskod }}" inputmode="numeric"/>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-select form-select-solid custom-select" id="negeri" name="negeri" data-control="select2">
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
                                                        <select class="form-select form-select-solid custom-select" id="daerah" name="daerah" data-control="select2">
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
                                                        <select class="form-select form-select-solid custom-select" id="tahap_pendidikan" name="tahap_pendidikan" data-control="select2">
                                                            @foreach ($tahapPendidikan as $item)
                                                                <option value="{{ $item->id }}" {{ $butiranKlien->tahap_pendidikan == $item->id ? 'selected' : '' }}>{{ $item->pendidikan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row fv-row mb-2">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <button type="submit" id="submitBtnKlien" class="btn btn-primary">Hantar</button>
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
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Status Kerja</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <span id="status_kerja" class="fs-6 form-control-plaintext">{{$butiranKlien->status_kerja}}</span>
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!-- Fields to display when status is BEKERJA -->
                                <div id="bekerjaFields">
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Bidang Pekerjaan</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            @php
                                                $bidangPekerjaan = DB::table('senarai_bidang_pekerjaan')->where('id', $butiranKlien->bidang_kerja)->value('senarai_bidang_pekerjaan.bidang');
                                            @endphp
                                            <span class="fs-6 form-control-plaintext">{{$bidangPekerjaan}}</span>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Nama Pekerjaan</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            @php
                                                $namaPekerjaan = DB::table('senarai_pekerjaan')->where('id', $butiranKlien->nama_kerja)->value('senarai_pekerjaan.pekerjaan');
                                            @endphp
                                            <span class="fs-6 form-control-plaintext">{{$namaPekerjaan}}</span>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Pendapatan Bulanan (RM)</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            @php
                                                $pendapatanKlien = DB::table('senarai_pendapatan')->where('id', $butiranKlien->pendapatan)->value('senarai_pendapatan.pendapatan');
                                            @endphp
                                            <span class="fs-6 form-control-plaintext">{{$pendapatanKlien}}</span>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Kategori Majikan</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->kategori_majikan}}</span>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Nama Majikan</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            @php
                                                $namaMajikan = DB::table('senarai_majikan')->where('id', $butiranKlien->nama_majikan)->value('senarai_majikan.majikan');
                                            @endphp
                                            <span id="nama_majikan_non_modal" class="fs-6 form-control-plaintext">{{$namaMajikan}}</span>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div id="lainLainMajikanNonModal">
                                        <div class="row fv-row">
                                            <div class="col-md-4 text-md-start">
                                                <label class="fs-6 fw-semibold form-label mt-3">Nama Majikan (Lain-lain)</label>
                                            </div>
                                            <div class="col-md-8">
                                                <span class="fs-6 form-control-plaintext">{{$butiranKlien->lain_lain_majikan}}</span>
                                            </div>
                                        </div>   
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Nombor Telefon Majikan</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_majikan}}</span>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Alamat Tempat Kerja</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_kerja}}</span>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Poskod</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="w-100">
                                                <span class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_kerja}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Negeri</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="w-100">
                                                @php
                                                    $negeriKerjaKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_kerja )->value('senarai_negeri.negeri');
                                                @endphp
                                                <span class="fs-6 form-control-plaintext">{{ $negeriKerjaKlien }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Daerah</span>
                                            </label>
                                        </div>
                                    
                                        <div class="col-md-8">
                                            <div class="w-100">
                                                @php
                                                    $daerahKerjaKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_kerja )->value('senarai_daerah.daerah');
                                                @endphp
                                                <span class="fs-6 form-control-plaintext">{{ $daerahKerjaKlien }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>

                                <!-- Field for "Status Tidak Bekerja" -->
                                <div id="tidakBekerjaFields" style="display:none;">
                                    <div class="row fv-row">
                                        <div class="col-md-4 text-md-start">
                                            <label class="fs-6 fw-semibold form-label mt-3">Alasan Tidak Bekerja</label>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->alasan_tidak_kerja}}</span>
                                        </div>
                                    </div>
                                </div>

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
                                            <form id="pekerjaanKlienForm" method="POST" action="{{ route('pekerjaanKlien.requestUpdate') }}">
                                                @csrf
                            
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Status Kerja</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-select form-select-solid custom-select" id="status_kerja_modal" name="status_kerja" data-control="select2" data-hide-search="true">
                                                            <option value="BEKERJA" {{ $butiranKlien->status_kerja == 'BEKERJA' ? 'selected' : '' }}>BEKERJA</option>
                                                            <option value="TIDAK BEKERJA" {{ $butiranKlien->status_kerja == 'TIDAK BEKERJA' ? 'selected' : '' }}>TIDAK BEKERJA</option>
                                                        </select>
                                                    </div>
                                                </div>
                            
                                                <!-- Fields to display when status is BEKERJA -->
                                                <div id="bekerjaFieldsModal">
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Bidang Pekerjaan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid custom-select" id="bidang_kerja" name="bidang_kerja"  data-control="select2" data-hide-search="false" >
                                                                <option value="" disabled selected hidden>Pilih Bidang Pekerjaan</option>
                                                                @foreach ($bidangKerja as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->bidang_kerja == $item->id ? 'selected' : '' }}>{{ $item->bidang }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nama Pekerjaan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid custom-select" id="nama_kerja" name="nama_kerja" data-control="select2" data-hide-search="false" >
                                                                <option value="" disabled selected hidden>Pilih Nama Pekerjaan</option>
                                                                @foreach ($namaKerja as $item2)
                                                                    <option value="{{ $item2->id }}" {{ $butiranKlien->nama_kerja == $item2->id ? 'selected' : '' }}>{{ $item2->pekerjaan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Pendapatan (RM)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid custom-select" id="pendapatan" name="pendapatan" data-control="select2" data-hide-search="false">
                                                                <option value="" disabled selected hidden>Pilih Julat Pendapatan</option>
                                                                @foreach ($pendapatan as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->pendapatan == $item->id ? 'selected' : '' }}>{{ $item->pendapatan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Kategori Majikan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid custom-select" id="kategori_majikan" name="kategori_majikan" data-control="select2" data-hide-search="false">
                                                                <option value="" disabled selected hidden>Pilih Kategori Majikan</option>
                                                                <option value="SENDIRI" {{ $butiranKlien->kategori_majikan == 'SENDIRI' ? 'selected' : '' }}>SENDIRI</option>
                                                                <option value="SWASTA" {{ $butiranKlien->kategori_majikan == 'SWASTA' ? 'selected' : '' }}>SWASTA</option>
                                                                <option value="KERAJAAN" {{ $butiranKlien->kategori_majikan == 'KERAJAAN' ? 'selected' : '' }}>KERAJAAN</option>
                                                                <option value="BADAN BERKANUN" {{ $butiranKlien->kategori_majikan == 'BADAN BERKANUN' ? 'selected' : '' }}>BADAN BERKANUN</option>
                                                                <option value="LAIN-LAIN" {{ $butiranKlien->kategori_majikan == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nama Majikan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid custom-select" id="nama_majikan" name="nama_majikan" data-control="select2" onchange="LainMajikanModal() ">
                                                                <option disabled selected hidden>Pilih Nama Majikan</option>
                                                                @foreach ($majikan as $item)
                                                                    <option value="{{ $item->id }}" {{ $butiranKlien->nama_majikan == $item->id ? 'selected' : '' }}>{{ $item->majikan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="lainLainMajikanModal">
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nama Majikan (Lain-lain)</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid" id="lain_lain_nama_majikan" name="lain_lain_nama_majikan" value="{{$butiranKlien->lain_lain_majikan}}" style="text-transform: uppercase;"/>
                                                            </div>
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
                                                            <select class="form-select form-select-solid custom-select" id="negeri_kerja" name="negeri_kerja" data-control="select2">
                                                                <option value="" disabled selected hidden>Pilih Negeri</option>
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
                                                            <select class="form-select form-select-solid custom-select" id="daerah_kerja" name="daerah_kerja" data-control="select2">
                                                                <option value="" disabled selected hidden>Pilih Daerah</option>
                                                                @foreach ($daerahKerja as $daerahK)
                                                                    <option value="{{ $daerahK->id }}" {{ $butiranKlien->daerah_kerja == $daerahK->id ? 'selected' : '' }}>{{ $daerahK->daerah }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                            
                                                <!-- New field for "Status Tidak Bekerja" -->
                                                <div id="tidakBekerjaFieldsModal" style="display:none;">
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Alasan Tidak Bekerja</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select form-select-solid custom-select" id="alasan_tidak_kerja" name="alasan_tidak_kerja" data-control="select2" data-hide-search="false">
                                                                <option>Pilih Alasan</option>
                                                                <option value="PENGANGGUR" {{ $butiranKlien->alasan_tidak_kerja == 'PENGANGGUR' ? 'selected' : '' }}>PENGANGGUR</option>
                                                                <option value="PELAJAR" {{ $butiranKlien->alasan_tidak_kerja == 'PELAJAR' ? 'selected' : '' }}>PELAJAR</option>
                                                                <option value="PESAKIT" {{ $butiranKlien->alasan_tidak_kerja == 'PESAKIT' ? 'selected' : '' }}>PESAKIT</option>
                                                                <option value="SURI RUMAH TANGGA" {{ $butiranKlien->alasan_tidak_kerja == 'SURI RUMAH TANGGA' ? 'selected' : '' }}>SURI RUMAH TANGGA</option>
                                                                <option value="LAIN-LAIN" {{ $butiranKlien->alasan_tidak_kerja == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                            
                                                <div class="row fv-row mb-2">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <button type="submit" id="submitBtnPekerjaan" class="btn btn-primary">Hantar</button>
                                                        </div>
                                                    </div>
                                                </div>   
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form">
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
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->nama_bapa}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>No Kad Pengenalan</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp_bapa}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Nombor Telefon</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_bapa}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Status</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->status_bapa}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Alamat Rumah</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_bapa}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Poskod</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="w-100">
                                                                <span class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_bapa}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Negeri</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="w-100">
                                                                @php
                                                                    $negeriBapaKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_bapa )->value('senarai_negeri.negeri');
                                                                @endphp
                                                                <span class="fs-6 form-control-plaintext">{{ $negeriBapaKlien }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Daerah</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="w-100">
                                                                @php
                                                                    $daerahBapaKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_bapa )->value('senarai_daerah.daerah');
                                                                @endphp
                                                                <span class="fs-6 form-control-plaintext">{{ $daerahBapaKlien }}</span>
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
                                                <form method="GET" id="kt_ecommerce_settings_general_form" class="form centered-form">
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
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->nama_ibu}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Nombor Kad Pengenalan</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp_ibu}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Nombor Telefon</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_ibu}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Status</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->status_ibu}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Alamat Rumah</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_ibu}}</span>
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
                                                                <span class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_ibu}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Negeri</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="w-100">
                                                                @php
                                                                    $negeriIbuKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_ibu )->value('senarai_negeri.negeri');
                                                                @endphp
                                                                <span class="fs-6 form-control-plaintext">{{ $negeriIbuKlien }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Daerah</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="w-100">
                                                                @php
                                                                    $daerahIbuKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_ibu )->value('senarai_daerah.daerah');
                                                                @endphp
                                                                <span class="fs-6 form-control-plaintext">{{ $daerahIbuKlien }}</span>
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
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->hubungan_penjaga}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Nama</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->nama_penjaga}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Nombor Kad Pengenalan</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_kp_penjaga}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Nombor Telefon</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_penjaga}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Status</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->status_penjaga}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Alamat Rumah</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_penjaga}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Poskod</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="w-100">
                                                                <span class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_penjaga}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Negeri</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="w-100">
                                                                @php
                                                                    $negeriPenjagaKlien = DB::table('senarai_negeri')->where('id', $butiranKlien->negeri_penjaga )->value('senarai_negeri.negeri');
                                                                @endphp
                                                                <span class="fs-6 form-control-plaintext">{{ $negeriPenjagaKlien }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                                <span>Daerah</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="w-100">
                                                                @php
                                                                    $daerahPenjagaKlien = DB::table('senarai_daerah')->where('id', $butiranKlien->daerah_penjaga )->value('senarai_daerah.daerah');
                                                                @endphp
                                                                <span class="fs-6 form-control-plaintext">{{ $daerahPenjagaKlien }}</span>
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
                                                    <form id="bapaKlienForm" method="POST" action="{{ route('bapaKlien.requestUpdate') }}">
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
                                                                <select class="form-select form-select-solid custom-select" id="status_bapa" name="status_bapa" data-control="select2" data-hide-search="true">
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
                                                                <select class="form-select form-select-solid custom-select" id="negeri_b" name="negeri_bapa" data-control="select2">
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
                                                                <select class="form-select form-select-solid custom-select" id="daerah_b" name="daerah_bapa" data-control="select2">
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
                                                                    <button type="submit" id="submitBtnBapa" class="btn btn-primary">Hantar</button>
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
                                                    <form id="ibuKlienForm" method="POST" action="{{ route('ibuKlien.requestUpdate') }}">
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
                                                                <select class="form-select form-select-solid custom-select" id="status_ibu" name="status_ibu" data-control="select2" data-hide-search="true">
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
                                                                <select class="form-select form-select-solid custom-select" id="negeri_i" name="negeri_ibu" data-control="select2">
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
                                                                <select class="form-select form-select-solid custom-select" id="daerah_i" name="daerah_ibu" data-control="select2">
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
                                                                    <button type="submit" id="submitBtnIbu" class="btn btn-primary">Hantar</button>
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
                                                    <form id="penjagaKlienForm" method="POST" action="{{ route('penjagaKlien.requestUpdate') }}">
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
                                                                <select class="form-select form-select-solid custom-select" id="status_penjaga" name="status_penjaga" data-control="select2" data-hide-search="true">
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
                                                                <select class="form-select form-select-solid custom-select" id="negeri_p" name="negeri_penjaga" data-control="select2">
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
                                                                <select class="form-select form-select-solid custom-select" id="daerah_p" name="daerah_penjaga" data-control="select2">
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
                                                                    <button type="submit" id="submitBtnPenjaga" class="btn btn-primary">Hantar</button>
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
                                        <span class="fs-6 form-control-plaintext">{{$butiranKlien->status_perkahwinan}}</span>
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
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->nama_pasangan}}</span>
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
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->no_tel_pasangan}}</span>
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
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->bilangan_anak}}</span>
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
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_pasangan}}</span>
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
                                                <span class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_pasangan}}</span>
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
                                                <span class="fs-6 form-control-plaintext">{{ $negeriPasanganKlien }}</span>
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
                                                <span class="fs-6 form-control-plaintext">{{ $daerahPasanganKlien }}</span>
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
                                            <span class="fs-6 form-control-plaintext">{{$butiranKlien->alamat_kerja_pasangan}}</span>
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
                                                <span class="fs-6 form-control-plaintext">{{$butiranKlien->poskod_kerja_pasangan}}</span>
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
                                                <span class="fs-6 form-control-plaintext">{{ $negeriKerjaPasanganKlien }}</span>
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
                                                <span class="fs-6 form-control-plaintext">{{ $daerahKerjaPasanganKlien }}</span>
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
                                            <form id="keluargaKlienForm" method="POST" action="{{ route('pasanganKlien.requestUpdate') }}">
                                                @csrf

                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-5 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Status Perkahwinan</label>
                                                    </div> 
                                                    <div class="col-md-7">
                                                        <!--begin::Select2-->
                                                        <select class="form-select form-select-solid custom-select" id="status_perkahwinan" name="status_perkahwinan" data-control="select2" data-hide-search="true">
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
                                                        <select class="form-select form-select-solid custom-select" id="negeri_partner" name="negeri_pasangan" data-control="select2">
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
                                                        <select class="form-select form-select-solid custom-select" id="daerah_partner" name="daerah_pasangan" data-control="select2">
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
                                                        <select class="form-select form-select-solid custom-select" id="negeri_kerja_pasangan" name="negeri_kerja_pasangan" data-control="select2">
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
                                                        <select class="form-select form-select-solid custom-select" id="daerah_kerja_pasangan" name="daerah_kerja_pasangan" data-control="select2">
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
                                                            <button type="submit" id="submitBtnKeluarga" class="btn btn-primary">Hantar</button>
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

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
    {{-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Select2 JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    {{-- Script for select2 --}}
    <script>
        $(document).ready(function() {
            // Initialize Select2 and set dropdown parent to the modal
            $("#negeri, #daerah, #tahap_pendidikan").select2({
                dropdownParent: $("#requestPeribadiKlien"),
                width: '100%'
            });
    
            // Fix for Bootstrap modal and Select2 input focus issue
            $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        });

        $(".select2").on("select2:open", function () {
            $(".select2-dropdown").position({
                my: "left top",
                at: "left bottom",
                of: $(this)
            });
        });
    </script>
    
    {{-- <script>
        $(document).ready(function() {
			$('.js-example-basic-single').select2();
		});
    </script> --}}
    
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

            // Check if there is a flash error message
            @if(session('errorProfil'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Berjaya!',
                    text: '{!! session('errorProfil') !!}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

    {{-- Display daerah based on negeri klien --}}     
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
                        alert('Daerah tidak keluar');
                    }
                });
            }
        });
    </script>

    {{-- Display daerah based on negeri pekerjaan klien --}}     
    <script>
        $(document).ready(function () {
            var previousIdNegeri = $('#negeri_kerja').val();

            // Initial AJAX request
            getBandarData(previousIdNegeri);

            $('#negeri_kerja').on('change', function () {
                var idnegeri = $(this).val();

                // Update the previous value
                previousIdNegeri = idnegeri;

                // Clear existing options
                $("#daerah_kerja").empty();
                $('#poskod_kerja').val('');


                // Trigger AJAX request
                getBandarData(idnegeri);
            });

            function getBandarData(idnegeri) {
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
                            var selectedValue = $("#daerah_kerja").val();

                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var daerah = response['data'][i].daerah;

                                var isSelected = (id == selectedValue);

                                var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + daerah + "</option>";

                                $("#daerah_kerja").append(option);
                            }
                        }
                    },
                    error: function () {
                        alert('Daerah kerja tidak keluar');
                    }
                });
            }
        });
    </script>

    {{-- Display daerah based on negeri bapa klien --}}     
    <script>
        $(document).ready(function () {
            var previousIdNegeri = $('#negeri_b').val();

            // Initial AJAX request
            getBandarData(previousIdNegeri);

            $('#negeri_b').on('change', function () {
                var idnegeri = $(this).val();

                // Update the previous value
                previousIdNegeri = idnegeri;

                // Clear existing options
                $("#daerah_b").empty();
                $('#poskod_b').val('');


                // Trigger AJAX request
                getBandarData(idnegeri);
            });

            function getBandarData(idnegeri) {
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
                            var selectedValue = $("#daerah_b").val();

                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var daerah = response['data'][i].daerah;

                                var isSelected = (id == selectedValue);

                                var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + daerah + "</option>";

                                $("#daerah_b").append(option);
                            }
                        }
                    },
                    error: function () {
                        alert('Daerah bapa tidak keluar');
                    }
                });
            }
        });
    </script>

    {{-- Display daerah based on negeri ibu klien --}}     
    <script>
        $(document).ready(function () {
            var previousIdNegeri = $('#negeri_i').val();

            // Initial AJAX request
            getBandarData(previousIdNegeri);

            $('#negeri_i').on('change', function () {
                var idnegeri = $(this).val();

                // Update the previous value
                previousIdNegeri = idnegeri;

                // Clear existing options
                $("#daerah_i").empty();
                $('#poskod_i').val('');


                // Trigger AJAX request
                getBandarData(idnegeri);
            });

            function getBandarData(idnegeri) {
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
                            var selectedValue = $("#daerah_i").val();

                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var daerah = response['data'][i].daerah;

                                var isSelected = (id == selectedValue);

                                var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + daerah + "</option>";

                                $("#daerah_i").append(option);
                            }
                        }
                    },
                    error: function () {
                        alert('Daerah ibu tidak keluar');
                    }
                });
            }
        });
    </script>

    {{-- Display daerah based on negeri penjaga klien --}}     
    <script>
        $(document).ready(function () {
            var previousIdNegeri = $('#negeri_p').val();

            // Initial AJAX request
            getBandarData(previousIdNegeri);

            $('#negeri_p').on('change', function () {
                var idnegeri = $(this).val();

                // Update the previous value
                previousIdNegeri = idnegeri;

                // Clear existing options
                $("#daerah_p").empty();
                $('#poskod_p').val('');


                // Trigger AJAX request
                getBandarData(idnegeri);
            });

            function getBandarData(idnegeri) {
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
                            var selectedValue = $("#daerah_p").val();

                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var daerah = response['data'][i].daerah;

                                var isSelected = (id == selectedValue);

                                var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + daerah + "</option>";

                                $("#daerah_p").append(option);
                            }
                        }
                    },
                    error: function () {
                        alert('Daerah penjaga tidak keluar');
                    }
                });
            }
        });
    </script>

    {{-- Display daerah based on negeri pasangan klien --}}     
    <script>
        $(document).ready(function () {
            var previousIdNegeri = $('#negeri_partner').val();

            // Initial AJAX request
            getBandarData(previousIdNegeri);

            $('#negeri_partner').on('change', function () {
                var idnegeri = $(this).val();

                // Update the previous value
                previousIdNegeri = idnegeri;

                // Clear existing options
                $("#daerah_partner").empty();
                $('#poskod_partner').val('');


                // Trigger AJAX request
                getBandarData(idnegeri);
            });

            function getBandarData(idnegeri) {
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
                            var selectedValue = $("#daerah_partner").val();

                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var daerah = response['data'][i].daerah;

                                var isSelected = (id == selectedValue);

                                var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + daerah + "</option>";

                                $("#daerah_partner").append(option);
                            }
                        }
                    },
                    error: function () {
                        alert('Daerah pasangan tidak keluar');
                    }
                });
            }
        });
    </script>

    {{-- Display daerah based on negeri tempat kerja pasangan klien --}}     
    <script>
        $(document).ready(function () {
            var previousIdNegeri = $('#negeri_kerja_pasangan').val();

            // Initial AJAX request
            getBandarData(previousIdNegeri);

            $('#negeri_kerja_pasangan').on('change', function () {
                var idnegeri = $(this).val();

                // Update the previous value
                previousIdNegeri = idnegeri;

                // Clear existing options
                $("#daerah_kerja_pasangan").empty();
                $('#poskod_kerja_pasangan').val('');


                // Trigger AJAX request
                getBandarData(idnegeri);
            });

            function getBandarData(idnegeri) {
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
                            var selectedValue = $("#daerah_kerja_pasangan").val();

                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var daerah = response['data'][i].daerah;

                                var isSelected = (id == selectedValue);

                                var option = "<option value='" + id + "'" + (isSelected ? " selected" : "") + ">" + daerah + "</option>";

                                $("#daerah_kerja_pasangan").append(option);
                            }
                        }
                    },
                    error: function () {
                        alert('Daerah tempat kerja pasangan tidak keluar');
                    }
                });
            }
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
            var klien_poskod = document.getElementById("poskod_klien");

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
            var klien_poskod = document.getElementById("poskod_klien");

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
            var klien_poskod = document.getElementById("poskod_klien");

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
                    $(negeri_penjaga).val(initialNegeriPenjaga).trigger('change.select2');
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
            var klien_poskod = document.getElementById("poskod_klien");

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
    
    {{-- Display field bekerja atau tidakBekerja based on statusKerja --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusKerja = document.getElementById('status_kerja');
            const bekerjaFields = document.getElementById('bekerjaFields');
            const tidakBekerjaFields = document.getElementById('tidakBekerjaFields');
    
            function toggleFieldsNonModal() 
            {
                const statusKerjaValue = statusKerja.textContent.trim(); // Get the text inside the span
                console.log('Status Kerja (Non-Modal):', statusKerjaValue); // Debugging

                if (statusKerjaValue === 'BEKERJA') {
                    bekerjaFields.style.display = 'block';
                    tidakBekerjaFields.style.display = 'none';
                } else if (statusKerjaValue === 'TIDAK BEKERJA') {
                    bekerjaFields.style.display = 'none';
                    tidakBekerjaFields.style.display = 'block';
                } else {
                    bekerjaFields.style.display = 'none';
                    tidakBekerjaFields.style.display = 'none';
                }
            }

            // Initial check for non-modal
            toggleFieldsNonModal();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const statusKerja = $('#status_kerja_modal');
            const bekerjaFields = document.getElementById('bekerjaFieldsModal');
            const tidakBekerjaFields = document.getElementById('tidakBekerjaFieldsModal');

            // Function to show or hide fields based on status_kerja
            function toggleFields() {
                const value = statusKerja.val(); // Use val() for Select2
                if (value === 'BEKERJA') {
                    bekerjaFields.style.display = 'block';
                    tidakBekerjaFields.style.display = 'none';
                } else if (value === 'TIDAK BEKERJA') {
                    bekerjaFields.style.display = 'none';
                    tidakBekerjaFields.style.display = 'block';
                }
            }
    
            // Initial check
            toggleFields();
    
            // Add event listener for Select2 change event
            statusKerja.on('change.select2', function() {
                toggleFields();
            });
        });
    </script>

    {{-- Compare original data with updated data --}}
    <script>
        document.getElementById('submitBtnKlien').addEventListener('click', function (e) {
            // Get original data (fetched from server/database)
            const originalDataKlien = {
                no_tel: "{{ $butiranKlien->no_tel }}",
                emel: "{{ $butiranKlien->emel }}",
                alamat_rumah: "{{ $butiranKlien->alamat_rumah }}",
                poskod: "{{ $butiranKlien->poskod }}",
                negeri: "{{ $butiranKlien->negeri }}",
                daerah: "{{ $butiranKlien->daerah }}",
                tahap_pendidikan: "{{ $butiranKlien->tahap_pendidikan }}",
            };
    
            // Get current data (input values from form)
            const currentDataKlien = {
                no_tel: document.getElementById('no_tel').value,
                emel: document.getElementById('emel').value,
                alamat_rumah: document.getElementById('alamat_rumah').value,
                poskod: document.getElementById('poskod').value,
                negeri: document.getElementById('negeri').value,
                daerah: document.getElementById('daerah').value,
                tahap_pendidikan: document.getElementById('tahap_pendidikan').value,
            };
    
            // Handle poskod as a string for comparison, but check if the field is defined
            if (originalDataKlien.poskod !== null && originalDataKlien.poskod !== undefined) {
                originalDataKlien.poskod = originalDataKlien.poskod.toString();
            }
            if (currentDataKlien.poskod !== null && currentDataKlien.poskod !== undefined) {
                currentDataKlien.poskod = currentDataKlien.poskod.toString();
            }
    
            let isChanged = false;
    
            console.log("Checking field comparisons...");
    
            // Compare all fields except emel (case-insensitive comparison)
            Object.keys(originalDataKlien).forEach(key => {
                if (key !== 'emel') {
                    let originalValue = originalDataKlien[key] ? originalDataKlien[key].toUpperCase() : '';  
                    let currentValue = currentDataKlien[key] ? currentDataKlien[key].toUpperCase() : '';   
    
                    console.log(`Comparing ${key}: Original Value: ${originalValue} | Current Value: ${currentValue}`);
    
                    if (originalValue !== currentValue) {
                        isChanged = true;  // Mark as changed
                        console.log(`${key} has changed.`);
                    }
                }
            });
    
            // Compare email case-sensitively
            console.log(`Comparing emel: Original Value: ${originalDataKlien.emel} | Current Value: ${currentDataKlien.emel}`);
            if (originalDataKlien.emel !== currentDataKlien.emel) {
                isChanged = true;  // Mark as changed if email differs (case-sensitive)
                console.log("Email has changed.");
            }
    
            if (!isChanged) {
                // Display alert if no changes are detected
                alert("Data yang dikemaskini adalah sama dengan data asal");
                // Stop form submission
                e.preventDefault(); 
                return;
            } else {
                // Allow form submission if changes are detected
                console.log("Data has changed. Submitting the form.");
                document.getElementById('peribadiKlienForm').submit();
            }
        });
    </script>
    
    <script>
        document.getElementById('submitBtnPekerjaan').addEventListener('click', function (e) {
            // Get original data (fetched from server/database)
            const originalData = {
                status_kerja: "{{ $butiranKlien->status_kerja }}",
                bidang_kerja: "{{ $butiranKlien->bidang_kerja }}",
                nama_kerja: "{{ $butiranKlien->nama_kerja }}",
                pendapatan: "{{ $butiranKlien->pendapatan }}",
                kategori_majikan: "{{ $butiranKlien->kategori_majikan }}",
                nama_majikan: "{{ $butiranKlien->nama_majikan }}",
                lain_lain_majikan: "{{ $butiranKlien->lain_lain_majikan }}",
                no_tel_majikan: "{{ $butiranKlien->no_tel_majikan }}",
                alamat_kerja: "{{ $butiranKlien->alamat_kerja }}",
                poskod_kerja: "{{ $butiranKlien->poskod_kerja }}",
                negeri_kerja: "{{ $butiranKlien->negeri_kerja }}",
                daerah_kerja: "{{ $butiranKlien->daerah_kerja }}",
                alasan_tidak_kerja: "{{ $butiranKlien->alasan_tidak_kerja }}"  // This could be null
            };
    
            // Get current form data
            let alasan_tidak_kerja = document.getElementById('alasan_tidak_kerja') ? document.getElementById('alasan_tidak_kerja').value : '';
            if (alasan_tidak_kerja === 'Pilih Alasan') {
                alasan_tidak_kerja = null;  // Treat "Pilih Alasan" as null
            }
    
            const currentData = {
                status_kerja: document.getElementById('status_kerja_modal').value,
                bidang_kerja: document.getElementById('bidang_kerja').value,
                nama_kerja: document.getElementById('nama_kerja').value,
                pendapatan: document.getElementById('pendapatan').value,
                kategori_majikan: document.getElementById('kategori_majikan').value,
                nama_majikan: document.getElementById('nama_majikan').value,
                lain_lain_majikan: document.getElementById('lain_lain_nama_majikan').value,
                no_tel_majikan: document.getElementById('no_tel_majikan').value,
                alamat_kerja: document.getElementById('alamat_kerja').value,
                poskod_kerja: document.getElementById('poskod_kerja').value,
                negeri_kerja: document.getElementById('negeri_kerja').value,
                daerah_kerja: document.getElementById('daerah_kerja').value,
                alasan_tidak_kerja: alasan_tidak_kerja  // Use the updated value
            };
    
            // Handle poskod_kerja as a string for comparison
            if (originalData.poskod_kerja !== null) {
                originalData.poskod_kerja = originalData.poskod_kerja.toString();
            }
            if (currentData.poskod_kerja !== null) {
                currentData.poskod_kerja = currentData.poskod_kerja.toString();
            }

            let isChanged = false;
    
            // Compare all fields
            Object.keys(originalData).forEach(key => {
                let originalValue = originalData[key] ? originalData[key].toUpperCase() : '';  
                let currentValue = currentData[key] ? currentData[key].toUpperCase() : '';   
    
                if (originalValue !== currentValue) {
                    isChanged = true;  // Mark as changed
                }
            });
    
            if (!isChanged) {
                // Display alert
                alert("Data yang dikemaskini adalah sama dengan data asal");
                // Stop form submission if no changes are detected
                e.preventDefault(); 
                return;
            } 
            else {
                // Allow form submission
                document.getElementById('pekerjaanKlienForm').submit();
            }
        });
    </script>

    <script>
        document.getElementById('submitBtnKeluarga').addEventListener('click', function (e) {
            // Get original data (fetched from server/database)
            const originalData = {
                status_perkahwinan: "{{ $butiranKlien->status_perkahwinan }}",
                nama_pasangan: "{{ $butiranKlien->nama_pasangan }}",
                no_tel_pasangan: "{{ $butiranKlien->no_tel_pasangan }}",
                bilangan_anak: "{{ $butiranKlien->bilangan_anak }}",
                alamat_partner: "{{ $butiranKlien->alamat_partner }}",
                poskod_partner: "{{ $butiranKlien->poskod_partner }}",
                negeri_partner: "{{ $butiranKlien->negeri_partner }}",
                daerah_partner: "{{ $butiranKlien->daerah_partner }}",
                alamat_kerja_pasangan: "{{ $butiranKlien->alamat_kerja_pasangan }}",
                poskod_kerja_pasangan: "{{ $butiranKlien->poskod_kerja_pasangan }}",
                negeri_kerja_pasangan: "{{ $butiranKlien->negeri_kerja_pasangan }}",
                daerah_kerja_pasangan: "{{ $butiranKlien->daerah_kerja_pasangan }}"
            };

            let negeri_partner = document.getElementById('negeri_partner') ? document.getElementById('negeri_partner').value : '';
            if (negeri_partner === 'Pilih Negeri') {
                negeri_partner = null;  // Treat as null
            }

            let daerah_partner = document.getElementById('daerah_partner') ? document.getElementById('daerah_partner').value : '';
            if (daerah_partner === 'Pilih Daerah') {
                daerah_partner = null;  // Treat as null
            }

            let negeri_kerja_pasangan = document.getElementById('negeri_kerja_pasangan') ? document.getElementById('negeri_kerja_pasangan').value : '';
            if (negeri_kerja_pasangan === 'Pilih Negeri') {
                negeri_kerja_pasangan = null;  // Treat as null
            }

            let daerah_kerja_pasangan = document.getElementById('daerah_kerja_pasangan') ? document.getElementById('daerah_kerja_pasangan').value : '';
            if (daerah_kerja_pasangan === 'Pilih Daerah') {
                daerah_kerja_pasangan = null;  // Treat as null
            }

            const currentData = {
                status_perkahwinan: document.getElementById('status_perkahwinan').value,
                nama_pasangan: document.getElementById('nama_pasangan').value,
                no_tel_pasangan: document.getElementById('no_tel_pasangan').value,
                bilangan_anak: document.getElementById('bilangan_anak').value,
                alamat_partner: document.getElementById('alamat_partner').value,
                poskod_partner: document.getElementById('poskod_partner').value,
                negeri_partner: negeri_partner,
                daerah_partner: daerah_partner,
                alamat_kerja_pasangan: document.getElementById('alamat_kerja_pasangan').value,
                poskod_kerja_pasangan: document.getElementById('poskod_kerja_pasangan').value,
                negeri_kerja_pasangan: daerah_kerja_pasangan,
                daerah_kerja_pasangan: daerah_kerja_pasangan,
            };

            // Handle poskod_partner as a string for comparison
            if (originalData.poskod_partner !== null) {
                originalData.poskod_partner = originalData.poskod_partner.toString();
            }
            if (currentData.poskod_partner !== null) {
                currentData.poskod_partner = currentData.poskod_partner.toString();
            }

            // Handle poskod_kerja_pasangan as a string for comparison
            if (originalData.poskod_kerja_pasangan !== null) {
                originalData.poskod_kerja_pasangan = originalData.poskod_kerja_pasangan.toString();
            }
            if (currentData.poskod_kerja_pasangan !== null) {
                currentData.poskod_kerja_pasangan = currentData.poskod_kerja_pasangan.toString();
            }

            // Handle bilangan_anak as a string for comparison
            if (originalData.bilangan_anak !== null) {
                originalData.bilangan_anak = originalData.bilangan_anak.toString();
            }
            if (currentData.bilangan_anak !== null) {
                currentData.bilangan_anak = currentData.bilangan_anak.toString();
            }

            let isChanged = false;

            // Compare all fields
            Object.keys(originalData).forEach(key => {
                let originalValue = originalData[key] ? originalData[key].toUpperCase() : '';  
                let currentValue = currentData[key] ? currentData[key].toUpperCase() : '';   

                if (originalValue !== currentValue) {
                    isChanged = true;  // Mark as changed
                }
            });

            if (!isChanged) {
                // Display alert
                alert("Data yang dikemaskini adalah sama dengan data asal");
                // Stop form submission if no changes are detected
                e.preventDefault(); 
                return;
            } 
            else {
                // Allow form submission
                document.getElementById('keluargaKlienForm').submit();
            }
        });
    </script>

    <script>
        document.getElementById('submitBtnBapa').addEventListener('click', function (e) {
            // Get original data (fetched from server/database)
            const originalData = {
                nama_bapa: "{{ $butiranKlien->nama_bapa }}",
                no_kp_bapa: "{{ $butiranKlien->no_kp_bapa }}",
                no_tel_bapa: "{{ $butiranKlien->no_tel_bapa }}",
                status_bapa: "{{ $butiranKlien->status_bapa }}",
                alamat_b: "{{ $butiranKlien->alamat_bapa }}",
                poskod_b: "{{ $butiranKlien->poskod_bapa }}",
                negeri_b: "{{ $butiranKlien->negeri_bapa }}",
                daerah_b: "{{ $butiranKlien->daerah_bapa }}",
            };

            // Get current form data
            let negeri_b = document.getElementById('negeri_b') ? document.getElementById('negeri_b').value : '';
            if (negeri_b === 'Pilih Negeri') {
                negeri_b = null;  // Treat as null
            }

            let daerah_b = document.getElementById('daerah_b') ? document.getElementById('daerah_b').value : '';
            if (daerah_b === 'Pilih Daerah') {
                daerah_b = null;  // Treat as null
            }

            let status_bapa = document.getElementById('status_bapa') ? document.getElementById('status_bapa').value : '';
            if (status_bapa === 'Pilih Status Bapa') {
                status_bapa = null;  // Treat as null
            }

            const currentData = {
                nama_bapa: document.getElementById('nama_bapa').value,
                no_kp_bapa: document.getElementById('no_kp_bapa').value,
                no_tel_bapa: document.getElementById('no_tel_bapa').value,
                status_bapa: status_bapa,
                alamat_b: document.getElementById('alamat_b').value,
                poskod_b: document.getElementById('poskod_b').value,
                negeri_b: negeri_b,
                daerah_b: daerah_b,
            };

            // Log the original and current data to debug the issue
            console.log('Original Data:', originalData);
            console.log('Current Data:', currentData);

            // Handle poskod_kerja as a string for comparison
            if (originalData.poskod_b !== null) {
                originalData.poskod_b = originalData.poskod_b.toString();
            }
            if (currentData.poskod_b !== null) {
                currentData.poskod_b = currentData.poskod_b.toString();
            }

            let isChanged = false;

            // Compare all fields
            Object.keys(originalData).forEach(key => {
                let originalValue = originalData[key] ? originalData[key].trim().toUpperCase() : '';  
                let currentValue = currentData[key] ? currentData[key].trim().toUpperCase() : '';

                console.log(`Comparing ${key}: originalValue = '${originalValue}', currentValue = '${currentValue}'`);

                if (originalValue !== currentValue) {
                    isChanged = true;  // Mark as changed
                }
            });

            if (!isChanged) {
                // Display alert
                alert("Data yang dikemaskini adalah sama dengan data asal");
                // Stop form submission if no changes are detected
                e.preventDefault(); 
                return;
            } 
            else {
                // Allow form submission
                document.getElementById('bapaKlienForm').submit();
            }
        });
    </script>
    
    <script>
        document.getElementById('submitBtnIbu').addEventListener('click', function (e) {
            // Get original data (fetched from server/database)
            const originalData = {
                nama_ibu: "{{ $butiranKlien->nama_ibu }}",
                no_kp_ibu: "{{ $butiranKlien->no_kp_ibu }}",
                no_tel_ibu: "{{ $butiranKlien->no_tel_ibu }}",
                status_ibu: "{{ $butiranKlien->status_ibu }}",
                alamat_i: "{{ $butiranKlien->alamat_ibu }}",
                poskod_i: "{{ $butiranKlien->poskod_ibu }}",
                negeri_i: "{{ $butiranKlien->negeri_ibu }}",
                daerah_i: "{{ $butiranKlien->daerah_ibu }}",
            };

            // Get current form data
            let negeri_i = document.getElementById('negeri_i') ? document.getElementById('negeri_i').value : '';
            if (negeri_i === 'Pilih Negeri') {
                negeri_i = null;  // Treat as null
            }

            let daerah_i = document.getElementById('daerah_i') ? document.getElementById('daerah_i').value : '';
            if (daerah_i === 'Pilih Daerah') {
                daerah_i = null;  // Treat as null
            }

            let status_ibu = document.getElementById('status_ibu') ? document.getElementById('status_ibu').value : '';
            if (status_ibu === 'Pilih Status Ibu') {
                status_ibu = null;  // Treat as null
            }

            const currentData = {
                nama_ibu: document.getElementById('nama_ibu').value,
                no_kp_ibu: document.getElementById('no_kp_ibu').value,
                no_tel_ibu: document.getElementById('no_tel_ibu').value,
                status_ibu: status_ibu,
                alamat_i: document.getElementById('alamat_i').value,
                poskod_i: document.getElementById('poskod_i').value,
                negeri_i: negeri_i,
                daerah_i: daerah_i,
            };

            // Log the original and current data to debug the issue
            console.log('Original Data:', originalData);
            console.log('Current Data:', currentData);

            // Handle poskod_kerja as a string for comparison
            if (originalData.poskod_i !== null) {
                originalData.poskod_i = originalData.poskod_i.toString();
            }
            if (currentData.poskod_i !== null) {
                currentData.poskod_i = currentData.poskod_i.toString();
            }

            let isChanged = false;

            // Compare all fields
            Object.keys(originalData).forEach(key => {
                let originalValue = originalData[key] ? originalData[key].trim().toUpperCase() : '';  
                let currentValue = currentData[key] ? currentData[key].trim().toUpperCase() : '';

                console.log(`Comparing ${key}: originalValue = '${originalValue}', currentValue = '${currentValue}'`);

                if (originalValue !== currentValue) {
                    isChanged = true;  // Mark as changed
                }
            });

            if (!isChanged) {
                // Display alert
                alert("Data yang dikemaskini adalah sama dengan data asal");
                // Stop form submission if no changes are detected
                e.preventDefault(); 
                return;
            } 
            else {
                // Allow form submission
                document.getElementById('ibuKlienForm').submit();
            }
        });
    </script>

    <script>
        document.getElementById('submitBtnPenjaga').addEventListener('click', function (e) {
            // Get original data (fetched from server/database)
            const originalData = {
                hubungan_penjaga: "{{ $butiranKlien->hubungan_penjaga }}",
                nama_penjaga: "{{ $butiranKlien->nama_penjaga }}",
                no_kp_penjaga: "{{ $butiranKlien->no_kp_penjaga }}",
                no_tel_penjaga: "{{ $butiranKlien->no_tel_penjaga }}",
                status_penjaga: "{{ $butiranKlien->status_penjaga }}",
                alamat_p: "{{ $butiranKlien->alamat_penjaga }}",
                poskod_p: "{{ $butiranKlien->poskod_penjaga }}",
                negeri_p: "{{ $butiranKlien->negeri_penjaga }}",
                daerah_p: "{{ $butiranKlien->daerah_penjaga }}",
            };

            // Get current form data
            let negeri_p = document.getElementById('negeri_p') ? document.getElementById('negeri_p').value : '';
            if (negeri_p === 'Pilih Negeri') {
                negeri_p = null;  // Treat as null
            }

            let daerah_p = document.getElementById('daerah_p') ? document.getElementById('daerah_p').value : '';
            if (daerah_p === 'Pilih Daerah') {
                daerah_p = null;  // Treat as null
            }

            let status_penjaga = document.getElementById('status_penjaga') ? document.getElementById('status_penjaga').value : '';
            if (status_penjaga === 'Pilih Status Penjaga') {
                status_penjaga = null;  // Treat as null
            }

            const currentData = {
                hubungan_penjaga: document.getElementById('hubungan_penjaga').value,
                nama_penjaga: document.getElementById('nama_penjaga').value,
                no_kp_penjaga: document.getElementById('no_kp_penjaga').value,
                no_tel_penjaga: document.getElementById('no_tel_penjaga').value,
                status_penjaga: status_penjaga,
                alamat_p: document.getElementById('alamat_p').value,
                poskod_p: document.getElementById('poskod_p').value,
                negeri_p: negeri_p,
                daerah_p: daerah_p,
            };

            // Log the original and current data to debug the issue
            console.log('Original Data:', originalData);
            console.log('Current Data:', currentData);

            // Handle poskod_kerja as a string for comparison
            if (originalData.poskod_p !== null) {
                originalData.poskod_p = originalData.poskod_p.toString();
            }
            if (currentData.poskod_p !== null) {
                currentData.poskod_p = currentData.poskod_p.toString();
            }

            let isChanged = false;

            // Compare all fields
            Object.keys(originalData).forEach(key => {
                let originalValue = originalData[key] ? originalData[key].trim().toUpperCase() : '';  
                let currentValue = currentData[key] ? currentData[key].trim().toUpperCase() : '';

                console.log(`Comparing ${key}: originalValue = '${originalValue}', currentValue = '${currentValue}'`);

                if (originalValue !== currentValue) {
                    isChanged = true;  // Mark as changed
                }
            });


            if (!isChanged) {
                // Display alert
                alert("Data yang dikemaskini adalah sama dengan data asal");
                // Stop form submission if no changes are detected
                e.preventDefault(); 
                return;
            } 
            else {
                // Allow form submission
                document.getElementById('penjagaKlienForm').submit();
            }
        });
    </script>

    {{-- Lain-lain majikan Modal --}}
    <script>
        function LainMajikanModal() 
        {
            const namaMajikanDropdown = document.getElementById('nama_majikan');
            const lainLainNamaMajikanModal = document.getElementById('lainLainMajikanModal');
            const lainLainNamaMajikanInput = document.getElementById('lain_lain_nama_majikan');

            if (namaMajikanDropdown.value === '829') { // Check if value matches ID 829 (LAIN-LAIN)
                lainLainNamaMajikanModal.style.display = 'block';
                // lainLainNamaMajikanInput.setAttribute('required', 'required');
            } 
            else {
                lainLainNamaMajikanModal.style.display = 'none';
                // lainLainNamaMajikanInput.removeAttribute('required');
                // lainLainNamaMajikanInput.value = ''; // Clear input value
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Call toggleFields on page load to set initial state
            LainMajikanModal();
        });
    </script>

    {{-- Lain-lain majikan Non Modal --}}
    <script>
        function LainMajikanNonModal() {
            const namaMajikanNonModal = document.getElementById('nama_majikan_non_modal');
            const lainLainNamaMajikanNonModal = document.getElementById('lainLainMajikanNonModal');

            // Use innerText or textContent to get the displayed value
            if (namaMajikanNonModal.innerText === 'LAIN-LAIN' || namaMajikanNonModal.textContent === 'LAIN-LAIN') { 
                lainLainNamaMajikanNonModal.style.display = 'block';
            } else {
                lainLainNamaMajikanNonModal.style.display = 'none';
            }
        }

        // Call the function on page load
        document.addEventListener('DOMContentLoaded', function() {
            LainMajikanNonModal();
        });
    </script>
</body>
@endsection