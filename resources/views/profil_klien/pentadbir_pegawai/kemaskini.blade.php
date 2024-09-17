@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
            align-items: start; 
            min-height: 100vh; 
        }

        /* Centered form settings */
        .centered-form {
            width: 100%;
            padding-left: 100px; 
            padding-right: 100px;
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

        .request-update-icon {
            color: #ffc107 !important; 
            font-size: 1rem !important;
            position: relative;
            top: -8px; 
            margin-left: 4px;
        }

        .nav-link.active .request-update-icon {
            color: #ffc107 !important; 
        }

        .nav-link.active {
            font-weight: bold;
            color: #007bff !important;
        }
    </style>
</head>

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
        <li class="breadcrumb-item text-muted">Kemaskini Profil Klien</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
    
<body>
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Card-->
        <div class="card card-flush">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin:::Tabs-->
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-10">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#kt_ecommerce_settings_general">
                            <i class="ki-duotone ki-user-tick fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Maklumat Peribadi
                            @if($requestKlien)
                                <span class="ms-1" data-bs-toggle="tooltip" title="Sila semak dan luluskan permohonan klien untuk kemaskini.">
                                    <i class="fas fa-exclamation-circle request-update-icon" aria-hidden="true"></i>
                                </span>
                            @endif
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
                            @if($requestWaris)
                                <span class="ms-1" data-bs-toggle="tooltip" title="Sila semak dan luluskan permohonan klien untuk kemaskini.">
                                    <i class="fas fa-exclamation-circle request-update-icon" aria-hidden="true"></i>
                                </span>
                            @endif
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
                            @if($requestPasangan)
                                <span class="ms-1" data-bs-toggle="tooltip" title="Sila semak dan luluskan permohonan klien untuk kemaskini.">
                                    <i class="fas fa-exclamation-circle request-update-icon" aria-hidden="true"></i>
                                </span>
                            @endif
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
                            @if($requestPekerjaan)
                                <span class="ms-1" data-bs-toggle="tooltip" title="Sila semak dan luluskan permohonan klien untuk kemaskini.">
                                    <i class="fas fa-exclamation-circle request-update-icon" aria-hidden="true"></i>
                                </span>
                            @endif
                        </a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_products">
                            <i class="ki-duotone ki-pulse fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Maklumat RPDK/RPDI
                        </a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                
                <!--begin:::Tab content-->
                <div class="tab-content" id="myTabContent">
                    <!--begin:::Tab pane Klien-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="peribadiKlienForm" class="form centered-form" action="{{ route('kemaskini.maklumat.peribadi.klien', ['id' => $klien->id]) }}">
                            @csrf

                            <!--begin::Heading-->
                            <div class="row mb-7">
                                <div class="col-md-8 offset-md-4">
                                    <h2>Kemaskini Maklumat Peribadi</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                            
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nama Penuh</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="nama" class="fs-6 form-control-plaintext">{{$klien->nama}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>No. Kad Pengenalan</span>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <span id="no_kp" class="fs-6 form-control-plaintext">{{$klien->no_kp}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Umur</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="umur" class="fs-6 form-control-plaintext"></span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Jantina</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <span id="jantina" class="fs-6 form-control-plaintext">{{$klien->jantina == 'L' ? 'LELAKI' : 'PEREMPUAN'}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Agama</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        @php
                                            $agamaKlien = DB::table('senarai_agama')->where('id', $klien->agama)->value('senarai_agama.agama');
                                        @endphp
                                        <span id="agama" class="fs-6 form-control-plaintext">{{$agamaKlien}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Bangsa</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        @php
                                            $bangsaKlien = DB::table('senarai_bangsa')->where('id', $klien->bangsa)->value('senarai_bangsa.bangsa');
                                        @endphp
                                        <span id="bangsa" class="fs-6 form-control-plaintext">{{$bangsaKlien}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Skor CCRI</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <span id="skor_ccri" class="fs-6 form-control-plaintext">
                                        {{$klien->skor_ccri}}
                                        @if($klien->skor_ccri < 40)
                                            (TIDAK MEMUASKAN)
                                        @elseif($klien->skor_ccri >= 40 && $klien->skor_ccri <= 60)
                                            (MEMUASKAN)
                                        @elseif($klien->skor_ccri >= 61 && $klien->skor_ccri <= 79)
                                            (BAIK)
                                        @elseif($klien->skor_ccri >= 80)
                                            (CEMERLANG)
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>No. Telefon</span>
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
                                    <input type="text" class="form-control form-control-solid" id="no_tel" name="no_tel" value="{{$klien->no_tel}}" inputmode="numeric"/>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>E-mel</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan alamat emel yang aktif.">
                                            <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-solid" id="emel" name="emel" value="{{$klien->emel}}"/>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Alamat Rumah</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-solid" id="alamat_rumah_klien" name="alamat_rumah_klien" style="text-transform: uppercase;">{{$klien->alamat_rumah}}</textarea>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Poskod</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_k" name="poskod_klien" value="{{$klien->poskod}}" inputmode="numeric"/>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Negeri</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <select class="form-select form-select-solid custom-select" id="negeri_klien" name="negeri_klien"  data-control="select2" data-hide-search="true">
                                            @foreach ($negeri as $item)
                                                <option value="{{ $item->id }}" {{ $klien->negeri == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Daerah</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <select class="form-select form-select-solid custom-select" id="daerah_klien" name="daerah_klien"  data-control="select2" data-hide-search="true">
                                            @foreach ($daerah as $item)
                                                <option value="{{ $item->id }}" {{ $klien->daerah == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Tahap Pendidikan</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <select class="form-select form-select-solid custom-select" id="tahap_pendidikan" name="tahap_pendidikan"  data-control="select2" data-hide-search="true" >
                                            @foreach ($tahapPendidikan as $item)
                                                <option value="{{ $item->id }}" {{ $klien->tahap_pendidikan == $item->id ? 'selected' : '' }}>{{ $item->pendidikan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Penyakit</span>
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-select form-select-solid custom-select" id="penyakit" name="penyakit"  data-control="select2" data-hide-search="true" >
                                        @foreach ($penyakit as $item)
                                            <option value="{{ $item->id }}" {{ $klien->penyakit == $item->id ? 'selected' : '' }}>{{ $item->penyakit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Status Orang Kurang Upaya (OKU)</span>
                                    </label>
                                </div>
                                <div class="col-md-8 position-relative">
                                    <input type="text" class="form-control form-control-solid" id="status_oku" name="status_oku" value="{{$klien->status_oku}}"/>
                                    <div class="position-absolute top-10 end-0 mt-3 me-2">
                                        <label class="form-label fs-6 mb-0 fst-italic">** Klik <a href="https://oku.jkm.gov.my/semakan_oku" class="text-primary">di sini</a> untuk semakan OKU</label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-8 offset-md-4">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="submitBtnKlien">Kemaskini</button>
                                        @if($requestKlien)
                                            <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalPeribadiKlien" data-target="#approvalPeribadiKlien" style="background-color:#ffc107; color: white;">
                                                Semak Permohonan Kemaskini
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal PeribadiKlien-->
                        <div class="modal fade" id="approvalPeribadiKlien" tabindex="-1" aria-labelledby="luluskanPermohonanPeribadiKlienLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="luluskanPermohonanPeribadiKlienLabel">Luluskan Permohonan Kemaskini Maklumat Peribadi Klien</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($updateRequestKlien)
                                            <form method="post" action="{{ route('approve.update.klien', ['id' => $updateRequestKlien->klien_id]) }}">
                                                @csrf
                                                @method('PATCH')

                                                @php
                                                    $requestedDaerahRumahKlien = DB::table('senarai_daerah')->where('id', $requestedDataKlien['daerah'])->value('senarai_daerah.daerah');
                                                    $requestedNegeriRumahKlien = DB::table('senarai_negeri')->where('id', $requestedDataKlien['negeri'])->value('senarai_negeri.negeri');
                                                    $daerahRumahKlien = DB::table('senarai_daerah')->where('id', $klien->daerah)->value('senarai_daerah.daerah');
                                                    $negeriRumahKlien = DB::table('senarai_negeri')->where('id', $klien->negeri)->value('senarai_negeri.negeri');
                                                    $bangsaKlien = DB::table('senarai_bangsa')->where('id', $klien->bangsa)->value('senarai_bangsa.bangsa');
                                                    $agamaKlien = DB::table('senarai_agama')->where('id', $klien->agama)->value('senarai_agama.agama');
                                                    $penyakitKlien = DB::table('senarai_penyakit')->where('id', $klien->penyakit)->value('senarai_penyakit.penyakit');
                                                    $requestedPendidikan = DB::table('senarai_pendidikan')->where('id', $requestedDataKlien['tahap_pendidikan'])->value('senarai_pendidikan.pendidikan');
                                                    $pendidikanKlien = DB::table('senarai_pendidikan')->where('id', $klien->tahap_pendidikan)->value('senarai_pendidikan.pendidikan');
                                                @endphp
                                        
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span class="fs-6 form-control-plaintext">{{$klien->nama}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">No Kad Pengenalan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="no_kp" class="fs-6 form-control-plaintext">{{$klien->no_kp}}</span>
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
                                                        <span class="fs-6 form-control-plaintext">{{$klien->jantina == 'L' ? 'LELAKI' : 'PEREMPUAN'}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Agama</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span class="fs-6 form-control-plaintext">{{$agamaKlien}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-2">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Bangsa</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span class="fs-6 form-control-plaintext">{{$bangsaKlien}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-2">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Skor CCRI</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span class="fs-6 form-control-plaintext">
                                                            {{$klien->skor_ccri}}
                                                            @if($klien->skor_ccri < 40)
                                                                (TIDAK MEMUASKAN)
                                                            @elseif($klien->skor_ccri >= 40 && $klien->skor_ccri <= 60)
                                                                (MEMUASKAN)
                                                            @elseif($klien->skor_ccri >= 61 && $klien->skor_ccri <= 79)
                                                                (BAIK)
                                                            @elseif($klien->skor_ccri >= 80)
                                                                (CEMERLANG)
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-2">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Penyakit</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span class="fs-6 form-control-plaintext">{{$penyakitKlien}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Status Orang Kurang Upaya</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span class="fs-6 form-control-plaintext">{{$klien->status_oku}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">No. Telefon
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
                                                        <input type="text" class="form-control form-control-solid {{ ($requestedDataKlien['no_tel'] ?? '') != $klien->no_tel ? 'border-danger' : '' }}" name="no_tel" value="{{ $requestedDataKlien['no_tel'] ?? '' }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">E-mel
                                                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan alamat emel yang aktif.">
                                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataKlien['emel'] != $klien->emel ? 'border-danger' : '' }}" name="emel" value="{{ $requestedDataKlien['emel'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Alamat Rumah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control form-control-solid {{ $requestedDataKlien['alamat_rumah'] != $klien->alamat_rumah ? 'border-danger' : '' }}" name="alamat_rumah" readonly>{{ $requestedDataKlien['alamat_rumah'] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Poskod</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataKlien['poskod'] != $klien->poskod ? 'border-danger' : '' }}" name="poskod" value="{{ $requestedDataKlien['poskod'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedNegeriRumahKlien != $negeriRumahKlien ? 'border-danger' : '' }}" name="negeri" value="{{ $requestedNegeriRumahKlien }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Daerah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDaerahRumahKlien != $daerahRumahKlien ? 'border-danger' : '' }}" name="daerah" value="{{ $requestedDaerahRumahKlien }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Tahap Pendidikan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedPendidikan != $pendidikanKlien ? 'border-danger' : '' }}" name="tahap_pendidikan" value="{{ $requestedPendidikan }}" readonly />
                                                    </div>
                                                </div>
                                                
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="d-flex">
                                                            <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Lulus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_klien_ditolak{{$updateRequestKlien->klien_id}}">Ditolak</button>
                                                            {{-- <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>                                                
                        <!--end::Modal-->

                        @if ($updateRequestKlien)
                            <!--begin::Modal Permohonan Kemaskini Klien Ditolak-->
                            <div class="modal fade" id="modal_kemaskini_klien_ditolak{{$updateRequestKlien->klien_id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 style="text-align: center !important;">Permohonan Kemaskini Maklumat Klien Ditolak</h2>
                                            <div id="kt_modal_add_customer_close" data-bs-dismiss="modal">
                                                <i class="ki-solid ki-cross-circle fs-1"></i>
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            <form id="kemaskini_klien_ditolak_form_{{$updateRequestKlien->klien_id}}" action="{{ route('tolak.update.klien', ['id' => $updateRequestKlien->klien_id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Ditolak">
                                                <input type="hidden" name="id" value="{{ $updateRequestKlien->klien_id }}">
                            
                                                <!-- Begin Rejection Reasons Input -->
                                                <div id="dynamicFields">
                                                    <label class="fs-6 fw-semibold mb-2">Nyatakan alasan permohonan ditolak:</label>
                                                    <div class="input-group mb-2 catatan-row">
                                                        <textarea class="form-control" name="alasan_ditolak" placeholder="Contoh: Sila semak alamat emel, Semak tahap pendidikan"></textarea>
                                                    </div>
                                                </div>
                                                <!-- End Rejection Reasons Input -->
                            
                                                <!-- Form actions -->
                                                <div class="text-center pt-3">
                                                    <button type="submit" class="btn btn-primary">Hantar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal Ditolak-->
                        @endif
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Pekerjaan-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_customers" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="pekerjaanKlienForm" class="form centered-form" action="{{ route('kemaskini.maklumat.pekerjaan.klien', ['id' => $klien->id]) }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="row mb-7">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Kemaskini Maklumat Pekerjaan</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                    
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Status Kerja</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-9">
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid custom-select" id="status_kerja" name="status_kerja" data-control="select2" data-hide-search="true">
                                        <option value="BEKERJA" {{ $pekerjaan->status_kerja == 'BEKERJA' ? 'selected' : '' }}>BEKERJA</option>
                                        <option value="TIDAK BEKERJA" {{ $pekerjaan->status_kerja == 'TIDAK BEKERJA' ? 'selected' : '' }}>TIDAK BEKERJA</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!-- Fields to display when status is BEKERJA -->
                            <div id="bekerjaFields">
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Bidang Pekerjaan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-select form-select-solid custom-select" id="bidang_kerja" name="bidang_kerja"  data-control="select2" data-hide-search="true" >
                                            @foreach ($bidangKerja as $item)
                                                <option value="{{ $item->id }}" {{ $pekerjaan->bidang_kerja == $item->id ? 'selected' : '' }}>{{ $item->bidang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nama Pekerjaan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-select form-select-solid custom-select" id="nama_kerja" name="nama_kerja" data-control="select2" data-hide-search="true" >
                                            @foreach ($namaKerja as $item)
                                                <option value="{{ $item->id }}" {{ $pekerjaan->nama_kerja == $item->id ? 'selected' : '' }}>{{ $item->pekerjaan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Pendapatan (RM)</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid custom-select" id="pendapatan" name="pendapatan" data-control="select2" data-hide-search="true">
                                            <option>Pilih Julat Pendapatan</option>
                                            @foreach ($pendapatan as $item)
                                                <option value="{{ $item->id }}" {{ $pekerjaan->pendapatan == $item->id ? 'selected' : '' }}>{{ $item->pendapatan }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Kategori Majikan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid custom-select" id="kategori_majikan" name="kategori_majikan" data-control="select2" data-hide-search="true">
                                            <option>Pilih Kategori Majikan</option>
                                            <option value="SENDIRI" {{ $pekerjaan->kategori_majikan == 'SENDIRI' ? 'selected' : '' }}>SENDIRI</option>
                                            <option value="SWASTA" {{ $pekerjaan->kategori_majikan == 'SWASTA' ? 'selected' : '' }}>SWASTA</option>
                                            <option value="KERAJAAN" {{ $pekerjaan->kategori_majikan == 'KERAJAAN' ? 'selected' : '' }}>KERAJAAN</option>
                                            <option value="BADAN BERKANUN" {{ $pekerjaan->kategori_majikan == 'BADAN BERKANUN' ? 'selected' : '' }}>BADAN BERKANUN</option>
                                            <option value="LAIN-LAIN" {{ $pekerjaan->kategori_majikan == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nama Majikan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid custom-select" id="nama_majikan" name="nama_majikan"  data-control="select2" data-hide-search="true" >
                                            @foreach ($majikan as $item)
                                                <option value="{{ $item->id }}" {{ $pekerjaan->nama_majikan == $item->id ? 'selected' : '' }}>{{ $item->majikan }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>No. Telefon Majikan</span>
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
                                    <div class="col-md-9">
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" id="no_tel_majikan" name="no_tel_majikan" value="{{$pekerjaan->no_tel_majikan}}" inputmode="numeric"/>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Alamat Tempat Kerja</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" id="alamat_kerja" name="alamat_kerja" style="text-transform: uppercase;">{{$pekerjaan->alamat_kerja}}</textarea>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Poskod</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <input type="text" class="form-control form-control-solid" id="poskod_kerja" name="poskod_kerja" value="{{$pekerjaan->poskod_kerja}}" inputmode="numeric"/>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Negeri</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid custom-select" id="negeri_kerja" name="negeri_kerja" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                                <option>Pilih negeri</option>
                                                @foreach ($negeriKerja as $negeriK)
                                                    <option value="{{ $negeriK->id }}" {{ $pekerjaan->negeri_kerja == $negeriK->id ? 'selected' : '' }}>{{ $negeriK->negeri }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Daerah</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-9">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid custom-select" id="daerah_kerja" name="daerah_kerja" data-control="select2">
                                                <option>Pilih daerah</option>
                                                @foreach ($daerahKerja as $daerahK)
                                                    <option value="{{ $daerahK->id }}" {{ $pekerjaan->daerah_kerja == $daerahK->id ? 'selected' : '' }}>{{ $daerahK->daerah }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>

                            <!-- New field for status is TIDAK BEKERJA -->
                            <div id="tidakBekerjaFields" style="display:none;">
                                <div class="row fv-row mb-7">
                                    <div class="col-md-3 text-md-start">
                                        <label class="fs-6 fw-semibold form-label mt-3">Alasan Tidak Bekerja</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-select form-select-solid custom-select" id="alasan_tidak_kerja" name="alasan_tidak_kerja" data-control="select2" data-hide-search="true">
                                            <option>Pilih Alasan</option>
                                            <option value="PENGANGGUR" {{ $pekerjaan->alasan_tidak_kerja == 'PENGANGGUR' ? 'selected' : '' }}>PENGANGGUR</option>
                                            <option value="PELAJAR" {{ $pekerjaan->alasan_tidak_kerja == 'PELAJAR' ? 'selected' : '' }}>PELAJAR</option>
                                            <option value="PESAKIT" {{ $pekerjaan->alasan_tidak_kerja == 'PESAKIT' ? 'selected' : '' }}>PESAKIT</option>
                                            <option value="SURI RUMAH TANGGA" {{ $pekerjaan->alasan_tidak_kerja == 'SURI RUMAH TANGGA' ? 'selected' : '' }}>SURI RUMAH TANGGA</option>
                                            <option value="LAIN-LAIN" {{ $pekerjaan->alasan_tidak_kerja == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-9 offset-md-3">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="submitBtnPekerjaan">Kemaskini</button>
                                        @if($requestPekerjaan)
                                            <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalPekerjaan" data-target="#approvalPekerjaan" style="background-color:#ffc107; color: white;">
                                                Semak Permohonan Kemaskini
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal Pekerjaan-->
                        <div class="modal fade" id="approvalPekerjaan" tabindex="-1" aria-labelledby="luluskanPermohonanPekerjaanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="luluskanPermohonanPekerjaanLabel">Luluskan Permohonan Kemaskini Maklumat Pekerjaan Klien</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($updateRequestPekerjaan)
                                            <form method="post" action="{{ route('approve.update.pekerjaan', ['id' => $updateRequestPekerjaan->klien_id]) }}">
                                                @csrf
                                                @method('PATCH')

                                                @php
                                                    $requestedDaerahKerja = DB::table('senarai_daerah')->where('id', $requestedDataPekerjaan['daerah_kerja'])->value('senarai_daerah.daerah');
                                                    $requestedNegeriKerja = DB::table('senarai_negeri')->where('id', $requestedDataPekerjaan['negeri_kerja'])->value('senarai_negeri.negeri');
                                                    $daerahKerja = DB::table('senarai_daerah')->where('id', $pekerjaan->daerah_kerja)->value('senarai_daerah.daerah');
                                                    $negeriKerja = DB::table('senarai_negeri')->where('id', $pekerjaan->negeri_kerja)->value('senarai_negeri.negeri');
                                                    $requestedPendapatan = DB::table('senarai_pendapatan')->where('id', $requestedDataPekerjaan['pendapatan'])->value('senarai_pendapatan.pendapatan');
                                                    $pendapatan = DB::table('senarai_pendapatan')->where('id', $pekerjaan->pendapatan)->value('senarai_pendapatan.pendapatan');
                                                    $requestedBidangKerja = DB::table('senarai_bidang_pekerjaan')->where('id', $requestedDataPekerjaan['bidang_kerja'])->value('senarai_bidang_pekerjaan.bidang');
                                                    $bidangKerja = DB::table('senarai_bidang_pekerjaan')->where('id', $pekerjaan->bidang_kerja)->value('senarai_bidang_pekerjaan.bidang');
                                                    $requestedNamaMajikan = DB::table('senarai_majikan')->where('id', $requestedDataPekerjaan['nama_majikan'])->value('senarai_majikan.majikan');
                                                    $namaMajikan = DB::table('senarai_majikan')->where('id', $pekerjaan->nama_majikan)->value('senarai_majikan.majikan');
                                                    $requestedNamaKerja = DB::table('senarai_pekerjaan')->where('id', $requestedDataPekerjaan['nama_kerja'])->value('senarai_pekerjaan.pekerjaan');
                                                    $namaKerja = DB::table('senarai_pekerjaan')->where('id', $pekerjaan->nama_kerja)->value('senarai_pekerjaan.pekerjaan');
                                                @endphp
                                        
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Status Kerja</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="status_kerja_modal" class="form-control form-control-solid {{ $requestedDataPekerjaan['status_kerja'] != $pekerjaan->status_kerja ? 'border-danger' : '' }}" name="status_kerja" value="{{ $requestedDataPekerjaan['status_kerja'] }}" readonly />
                                                    </div>
                                                </div>

                                                <!-- Fields to display when status is BEKERJA -->
                                                <div id="bekerjaFieldsModal">
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Bidang Pekerjaan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedBidangKerja != $bidangKerja ? 'border-danger' : '' }}" name="bidang_kerja" value="{{ $requestedBidangKerja }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nama Pekerjaan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedNamaKerja != $namaKerja ? 'border-danger' : '' }}" name="nama_kerja" value="{{ $requestedNamaKerja }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Pendapatan (RM)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedPendapatan != $pendapatan ? 'border-danger' : '' }}" name="pendapatan" value="{{ $requestedPendapatan }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Kategori Majikan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['kategori_majikan'] != $pekerjaan->kategori_majikan ? 'border-danger' : '' }}" name="kategori_majikan" value="{{ $requestedDataPekerjaan['kategori_majikan'] }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Nama Majikan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedNamaMajikan != $namaMajikan ? 'border-danger' : '' }}" name="nama_majikan" value="{{ $requestedNamaMajikan }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">No. Telefon Majikan</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['no_tel_majikan'] != $pekerjaan->no_tel_majikan ? 'border-danger' : '' }}" name="no_tel_majikan" value="{{ $requestedDataPekerjaan['no_tel_majikan'] }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Alamat</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control form-control-solid {{ $requestedDataPekerjaan['alamat_kerja'] != $pekerjaan->alamat_kerja ? 'border-danger' : '' }}" name="alamat_kerja" readonly>{{ $requestedDataPekerjaan['alamat_kerja'] }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['poskod_kerja'] != $pekerjaan->poskod_kerja ? 'border-danger' : '' }}" name="poskod_kerja" value="{{ $requestedDataPekerjaan['poskod_kerja'] }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedNegeriKerja != $negeriKerja ? 'border-danger' : '' }}" name="negeri_kerja" value="{{ $requestedNegeriKerja }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedDaerahKerja != $daerahKerja ? 'border-danger' : '' }}" name="daerah_kerja" value="{{ $requestedDaerahKerja }}" readonly />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- New field for status is TIDAK BEKERJA -->
                                                <div id="tidakBekerjaFieldsModal" style="display:none;">
                                                    <div class="row fv-row mb-7">
                                                        <div class="col-md-4 text-md-start">
                                                            <label class="fs-6 fw-semibold form-label mt-3">Alasan Tidak Bekerja</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['alasan_tidak_kerja'] != $pekerjaan->alasan_tidak_kerja ? 'border-danger' : '' }}" name="alasan_tidak_kerja" value="{{ $requestedDataPekerjaan['alasan_tidak_kerja'] }}" readonly />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="d-flex">
                                                            <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_pekerjaan_ditolak{{$updateRequestPekerjaan->klien_id}}">Ditolak</button>
                                                            {{-- <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>                                                
                        <!--end::Modal-->

                        @if ($updateRequestPekerjaan)
                            <!--begin::Modal Permohonan Kemaskini Pekerjaan Klien Ditolak-->
                            <div class="modal fade" id="modal_kemaskini_pekerjaan_ditolak{{$updateRequestPekerjaan->klien_id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 style="text-align: center !important;">Permohonan Kemaskini Maklumat Pekerjaan Klien Ditolak</h2>
                                            <div id="kt_modal_add_customer_close" data-bs-dismiss="modal">
                                                <i class="ki-solid ki-cross-circle fs-1"></i>
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            <form id="kemaskini_pekerjaan_ditolak_form_{{$updateRequestPekerjaan->klien_id}}" action="{{ route('tolak.update.pekerjaan', ['id' => $updateRequestPekerjaan->klien_id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Ditolak">
                                                <input type="hidden" name="id" value="{{ $updateRequestPekerjaan->klien_id }}">
                            
                                                <!-- Begin Rejection Reasons Input -->
                                                <div id="dynamicFields">
                                                    <label class="fs-6 fw-semibold mb-2">Nyatakan alasan permohonan ditolak:</label>
                                                    <div class="input-group mb-2 catatan-row">
                                                        <textarea class="form-control" name="alasan_ditolak" placeholder="Contoh: Poskod tempat kerja salah, Isi maklumat majikan"></textarea>
                                                    </div>
                                                </div>
                                                <!-- End Rejection Reasons Input -->
                            
                                                <!-- Form actions -->
                                                <div class="text-center pt-3">
                                                    <button type="submit" class="btn btn-primary">Hantar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal Ditolak-->
                        @endif
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
                                                <a class="nav-link active fs-4 d-flex justify-content-between align-items-center" href="#maklumatBapa" data-toggle="tab" style="display: flex; justify-content: space-between; align-items: center;">
                                                    Maklumat Bapa
                                                    @if($requestedDataBapa && $statusBapa == 'Kemaskini')
                                                        <span class="ms-1" data-bs-toggle="tooltip" title="Sila semak dan luluskan permohonan klien untuk kemaskini.">
                                                            <i class="fas fa-exclamation-circle request-update-icon" aria-hidden="true"></i>
                                                        </span>
                                                    @endif
                                                </a>
                                            </li>
                                            <li class="nav-item border">
                                                <a class="nav-link fs-4 d-flex justify-content-between align-items-center" href="#maklumatIbu" data-toggle="tab" style="display: flex; justify-content: space-between; align-items: center;">
                                                    Maklumat Ibu
                                                    @if($requestedDataIbu && $statusIbu == 'Kemaskini')
                                                        <span class="ms-1" data-bs-toggle="tooltip" title="Sila semak dan luluskan permohonan klien untuk kemaskini.">
                                                            <i class="fas fa-exclamation-circle request-update-icon" aria-hidden="true"></i>
                                                        </span>
                                                    @endif
                                                </a>
                                            </li>
                                            <li class="nav-item border">
                                                <a class="nav-link fs-4 d-flex justify-content-between align-items-center" href="#maklumatPenjaga" data-toggle="tab" style="display: flex; justify-content: space-between; align-items: center;">
                                                    Maklumat Penjaga
                                                    @if($requestedDataPenjaga && $statusPenjaga == 'Kemaskini')
                                                        <span class="ms-1" data-bs-toggle="tooltip" title="Sila semak dan luluskan permohonan klien untuk kemaskini.">
                                                            <i class="fas fa-exclamation-circle request-update-icon" aria-hidden="true"></i>
                                                        </span>
                                                    @endif
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
                                            <form id="bapaKlienForm" method="post" style="padding-left: 50px;" action="{{ route('kemaskini.bapa.klien', ['id' => $klien->id]) }}">
                                                @csrf
                                                <!--begin::Heading-->
                                                <div class="row mb-5">
                                                    <div class="col-md-8 offset-md-4">
                                                        <h2>Kemaskini Maklumat Bapa</h2>
                                                    </div>
                                                </div>
                                                <!--end::Heading-->
                                                
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nama</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="nama_bapa" name="nama_bapa" value="{{$waris->nama_bapa}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>No. Kad Pengenalan</span>
                                                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor kad pengenalan tanpa simbol '-'">
                                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_kp_bapa" name="no_kp_bapa" value="{{$waris->no_kp_bapa}}" inputmode="numeric"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>No. Telefon</span>
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
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_bapa" name="no_tel_bapa" value="{{$waris->no_tel_bapa}}" inputmode="numeric"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Status</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <select class="form-select form-select-solid custom-select" id="status_bapa" name="status_bapa" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Status Bapa</option>
                                                            <option value="HIDUP" {{ $waris->status_bapa == 'HIDUP' ? 'selected' : '' }}>HIDUP</option>
                                                            <option value="MENINGGAL DUNIA" {{ $waris->status_bapa == 'MENINGGAL DUNIA' ? 'selected' : '' }}>MENINGGAL DUNIA</option>
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Alamat Rumah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <div class="d-flex flex-stack">
                                                            <div class="me-5">
                                                                <input class="form-check-input-sm" id="alamat_bapa_sama" name="alamat_bapa_sama" onclick="alamatBapa()" type="checkbox" value="1" />
                                                                <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                            </div>
                                                        </div>
                                                        <textarea class="form-control form-control-solid" id="alamat_b" name="alamat_bapa" style="text-transform: uppercase;">{{$waris->alamat_bapa}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Poskod</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <input type="text" class="form-control form-control-solid" id="poskod_b" name="poskod_bapa" value="{{$waris->poskod_bapa}}" inputmode="numeric"/>
                                                            <!--end::Select2-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Negeri</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid custom-select" id="negeri_b" name="negeri_bapa" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                                                <option>Pilih negeri</option>
                                                                @foreach ($negeriWaris as $negeriW)
                                                                    <option value="{{ $negeriW->id }}" {{ $waris->negeri_bapa == $negeriW->id ? 'selected' : '' }}>{{ $negeriW->negeri }}</option>
                                                                @endforeach
                                                            </select>
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
                                                            <span>Daerah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid custom-select" id="daerah_b" name="daerah_bapa" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
                                                                <option>Pilih daerah</option>
                                                                @foreach ($daerahWaris as $daerahW)
                                                                    <option value="{{ $daerahW->id }}" {{ $waris->daerah_bapa == $daerahW->id ? 'selected' : '' }}>{{ $daerahW->daerah }}</option>
                                                                @endforeach
                                                            </select>
                                                            <!--end::Select2-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                
                                                <!-- begin::Action buttons -->
                                                <div class="row py-5">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="d-flex">
                                                            <button type="submit" class="btn btn-primary me-3" id="submitBtnBapa">Kemaskini</button>

                                                            @if($requestedDataBapa)
                                                                @if($statusBapa == 'Kemaskini')
                                                                    <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalBapa" data-target="#approvalBapa" style="background-color:#ffc107; color: white;">
                                                                        Semak Permohonan Kemaskini
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end::Action buttons -->
                                            </form>
                                        </div>
                    
                                        <!-- Maklumat Ibu -->
                                        <div class="tab-pane" id="maklumatIbu">
                                            <form id="ibuKlienForm" method="post" style="padding-left: 50px;" action="{{ route('kemaskini.ibu.klien', ['id' => $klien->id]) }}">
                                                @csrf
                                                <!--begin::Heading-->
                                                <div class="row mb-5">
                                                    <div class="col-md-8 offset-md-4">
                                                        <h2>Kemaskini Maklumat Ibu</h2>
                                                    </div>
                                                </div>
                                                <!--end::Heading-->
                                                
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nama</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="nama_ibu" name="nama_ibu" value="{{$waris->nama_ibu}}" style="text-transform: uppercase;"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>No. Kad Pengenalan</span>
                                                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor kad pengenalan tanpa simbol '-'">
                                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_kp_ibu" name="no_kp_ibu" value="{{$waris->no_kp_ibu}}" inputmode="numeric"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>No. Telefon</span>
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
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_ibu" name="no_tel_ibu" value="{{$waris->no_tel_ibu}}" inputmode="numeric"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Status</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <select class="form-select form-select-solid custom-select" id="status_ibu" name="status_ibu" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Status Ibu</option>
                                                            <option value="HIDUP" {{ $waris->status_ibu == 'HIDUP' ? 'selected' : '' }}>HIDUP</option>
                                                            <option value="MENINGGAL DUNIA" {{ $waris->status_ibu == 'MENINGGAL DUNIA' ? 'selected' : '' }}>MENINGGAL DUNIA</option>
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Alamat Rumah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <div class="d-flex flex-stack">
                                                            <div class="me-5">
                                                                <input class="form-check-input-sm" id="alamat_ibu_sama" name="alamat_ibu_sama" onclick="alamatIbu()" type="checkbox" value="1" />
                                                                <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                            </div>
                                                        </div>
                                                        <textarea class="form-control form-control-solid" id="alamat_i" name="alamat_ibu" style="text-transform: uppercase;">{{$waris->alamat_ibu}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Poskod</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <input type="text" class="form-control form-control-solid" id="poskod_i" name="poskod_ibu" value="{{$waris->poskod_ibu}}" inputmode="numeric"/>
                                                            <!--end::Select2-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Negeri</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid custom-select" id="negeri_i" name="negeri_ibu" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                                                <option>Pilih negeri</option>
                                                                @foreach ($negeriWaris as $negeriW)
                                                                    <option value="{{ $negeriW->id }}" {{ $waris->negeri_ibu == $negeriW->id ? 'selected' : '' }}>{{ $negeriW->negeri }}</option>
                                                                @endforeach
                                                            </select>
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
                                                            <span>Daerah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid custom-select" id="daerah_i" name="daerah_ibu" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
                                                                <option>Pilih daerah</option>
                                                                @foreach ($daerahWaris as $daerahW)
                                                                    <option value="{{ $daerahW->id }}" {{ $waris->daerah_ibu == $daerahW->id ? 'selected' : '' }}>{{ $daerahW->daerah }}</option>
                                                                @endforeach
                                                            </select>
                                                            <!--end::Select2-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                
                                                <!--begin::Action buttons-->
                                                <div class="row py-5">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="d-flex">
                                                            <button type="submit" class="btn btn-primary me-3" id="submitBtnIbu">Kemaskini</button>
                                                            @if($requestedDataIbu)
                                                                @if($statusIbu == 'Kemaskini')
                                                                    <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalIbu" data-target="#approvalIbu" style="background-color:#ffc107; color: white;">
                                                                        Semak Permohonan Kemaskini
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Action buttons-->
                                            </form>
                                        </div>
                    
                                        <!-- Maklumat Penjaga -->
                                        <div class="tab-pane" id="maklumatPenjaga">
                                            <form id="penjagaKlienForm" method="post" style="padding-left: 50px;" action="{{ route('kemaskini.penjaga.klien', ['id' => $klien->id]) }}">
                                                @csrf
                                                <!--begin::Heading-->
                                                <div class="row mb-5">
                                                    <div class="col-md-8 offset-md-4">
                                                        <h2>Kemaskini Maklumat Penjaga</h2>
                                                    </div>
                                                </div>
                                                <!--end::Heading-->
                                                
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Hubungan</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="hubungan_penjaga" name="hubungan_penjaga" value="{{$waris->hubungan_penjaga}}" style="text-transform: uppercase;"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Nama</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="nama_penjaga" name="nama_penjaga" value="{{$waris->nama_penjaga}}" style="text-transform: uppercase;"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>No. Kad Pengenalan</span>
                                                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor kad pengenalan tanpa simbol '-'">
                                                                <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_kp_penjaga" name="no_kp_penjaga" value="{{$waris->no_kp_penjaga}}" inputmode="numeric"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>No. Telefon</span>
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
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_penjaga" name="no_tel_penjaga" value="{{$waris->no_tel_penjaga}}" inputmode="numeric"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Status</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <select class="form-select form-select-solid custom-select" id="status_penjaga" name="status_penjaga" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Status Penjaga</option>
                                                            <option value="HIDUP" {{ $waris->status_penjaga == 'HIDUP' ? 'selected' : '' }}>HIDUP</option>
                                                            <option value="MENINGGAL DUNIA" {{ $waris->status_penjaga == 'MENINGGAL DUNIA' ? 'selected' : '' }}>MENINGGAL DUNIA</option>
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Alamat Rumah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <!--begin::Input-->
                                                        <div class="d-flex flex-stack">
                                                            <div class="me-5">
                                                                <input class="form-check-input-sm" id="alamat_penjaga_sama" name="alamat_penjaga_sama" onclick="alamatPenjaga()" type="checkbox" value="1" />
                                                                <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                            </div>
                                                        </div>
                                                        <textarea class="form-control form-control-solid" id="alamat_p" name="alamat_penjaga" style="text-transform: uppercase;">{{$waris->alamat_penjaga}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Poskod</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_p" name="poskod_penjaga" value="{{$waris->poskod_penjaga}}" inputmode="numeric"/>
                                                            <!--end::Select2-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row  mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span>Negeri</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid custom-select" id="negeri_p" name="negeri_penjaga" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                                                <option>Pilih Negeri</option>
                                                                @foreach ($negeriWaris as $negeriW)
                                                                    <option value="{{ $negeriW->id }}" {{ $waris->negeri_penjaga == $negeriW->id ? 'selected' : '' }}>{{ $negeriW->negeri }}</option>
                                                                @endforeach
                                                            </select>
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
                                                            <span>Daerah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid custom-select" id="daerah_p" name="daerah_penjaga" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
                                                                <option>Pilih Daerah</option>
                                                                @foreach ($daerahWaris as $daerahW)
                                                                    <option value="{{ $daerahW->id }}" {{ $waris->daerah_penjaga == $daerahW->id ? 'selected' : '' }}>{{ $daerahW->daerah }}</option>
                                                                @endforeach
                                                            </select>
                                                            <!--end::Select2-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                
                                                <!--begin::Action buttons-->
                                                <div class="row py-5">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="d-flex">
                                                            <button type="submit" class="btn btn-primary me-3" id="submitBtnPenjaga">Kemaskini</button>
                                                            @if($requestedDataPenjaga)
                                                                @if($statusPenjaga == 'Kemaskini')
                                                                    <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalPenjaga" data-target="#approvalPenjaga" style="background-color:#ffc107; color: white;">
                                                                        Semak Permohonan Kemaskini
                                                                    </button>
                                                                @endif
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
                                <div class="modal fade" id="approvalBapa" tabindex="-1" aria-labelledby="luluskanPermohonanBapaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="luluskanPermohonanBapaLabel">Luluskan Permintaan Kemaskini Maklumat Bapa Klien</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if($updateRequestBapa)
                                                    <form method="post" action="{{ route('approve.update.bapa', ['id' => $updateRequestBapa->klien_id]) }}">
                                                        @csrf
                                                        @method('PATCH')
    
                                                        @php
                                                            $requestedDaerahBapa = DB::table('senarai_daerah')->where('id', $requestedDataBapa['daerah_bapa'])->value('senarai_daerah.daerah');
                                                            $requestedNegeriBapa = DB::table('senarai_negeri')->where('id', $requestedDataBapa['negeri_bapa'])->value('senarai_negeri.negeri');
                                                            $daerahBapa = DB::table('senarai_daerah')->where('id', $waris->daerah_bapa)->value('senarai_daerah.daerah');
                                                            $negeriBapa = DB::table('senarai_negeri')->where('id', $waris->negeri_bapa)->value('senarai_negeri.negeri');
                                                        @endphp
                                                
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['nama_bapa'] != $waris->nama_bapa ? 'border-danger' : '' }}" name="nama_bapa" value="{{ $requestedDataBapa['nama_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">No. Kad Pengenalan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['no_kp_bapa'] != $waris->no_kp_bapa ? 'border-danger' : '' }}" name="no_kp_bapa" value="{{ $requestedDataBapa['no_kp_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">No. Telefon</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['no_tel_bapa'] != $waris->no_tel_bapa ? 'border-danger' : '' }}" name="no_tel_bapa" value="{{ $requestedDataBapa['no_tel_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['status_bapa'] != $waris->status_bapa ? 'border-danger' : '' }}" name="status_bapa" value="{{ $requestedDataBapa['status_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control form-control-solid {{ $requestedDataBapa['alamat_bapa'] != $waris->alamat_bapa ? 'border-danger' : '' }}" name="alamat_bapa" readonly>{{ $requestedDataBapa['alamat_bapa'] }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['poskod_bapa'] != $waris->poskod_bapa ? 'border-danger' : '' }}" name="poskod_bapa" value="{{ $requestedDataBapa['poskod_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedNegeriBapa != $negeriBapa ? 'border-danger' : '' }}" name="negeri_bapa" value="{{ $requestedNegeriBapa }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDaerahBapa != $daerahBapa ? 'border-danger' : '' }}" name="daerah_bapa" value="{{ $requestedDaerahBapa }}" readonly />
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="d-flex">
                                                                    <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_bapa_ditolak{{$updateRequestBapa->klien_id}}">Ditolak</button>
                                                                    {{-- <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
    
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                  
                                <!--end::Modal BapaKlien-->

                                @if($updateRequestBapa)
                                    <!--begin::Modal Permohonan Kemaskini Bapa Klien Ditolak-->
                                    <div class="modal fade" id="modal_kemaskini_bapa_ditolak{{$updateRequestBapa->klien_id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 style="text-align: center !important;">Permohonan Kemaskini Maklumat Bapa Klien Ditolak</h2>
                                                    <div id="kt_modal_add_customer_close" data-bs-dismiss="modal">
                                                        <i class="ki-solid ki-cross-circle fs-1"></i>
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form id="kemaskini_bapa_ditolak_form_{{$updateRequestBapa->klien_id}}" action="{{ route('tolak.update.bapa', ['id' => $updateRequestBapa->klien_id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Ditolak">
                                                        <input type="hidden" name="id" value="{{ $updateRequestBapa->klien_id }}">
                                    
                                                        <!-- Begin Rejection Reasons Input -->
                                                        <div id="dynamicFields">
                                                            <label class="fs-6 fw-semibold mb-2">Nyatakan alasan permohonan ditolak:</label>
                                                            <div class="input-group mb-2 catatan-row">
                                                                <textarea class="form-control" name="alasan_ditolak" placeholder="Contoh: Sila pilih status bapa, Poskod salah"></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- End Rejection Reasons Input -->
                                    
                                                        <!-- Form actions -->
                                                        <div class="text-center pt-3">
                                                            <button type="submit" class="btn btn-primary">Hantar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Modal Ditolak-->
                                @endif

                                <!--begin::Modal IbuKlien-->
                                <div class="modal fade" id="approvalIbu" tabindex="-1" aria-labelledby="luluskanPermohonanIbuLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="luluskanPermohonanIbuLabel">Luluskan Permintaan Kemaskini Maklumat Ibu Klien</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if($updateRequestIbu)
                                                    <form method="post" action="{{ route('approve.update.ibu', ['id' => $updateRequestIbu->klien_id]) }}">
                                                        @csrf
                                                        @method('PATCH')
    
                                                        @php
                                                            $requestedDaerahIbu = DB::table('senarai_daerah')->where('id', $requestedDataIbu['daerah_ibu'])->value('senarai_daerah.daerah');
                                                            $requestedNegeriIbu = DB::table('senarai_negeri')->where('id', $requestedDataIbu['negeri_ibu'])->value('senarai_negeri.negeri');
                                                            $daerahIbu = DB::table('senarai_daerah')->where('id', $waris->daerah_ibu)->value('senarai_daerah.daerah');
                                                            $negeriIbu = DB::table('senarai_negeri')->where('id', $waris->negeri_ibu)->value('senarai_negeri.negeri');
                                                        @endphp
                                                
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['nama_ibu'] != $waris->nama_ibu ? 'border-danger' : '' }}" name="nama_ibu" value="{{ $requestedDataIbu['nama_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">No. Kad Pengenalan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['no_kp_ibu'] != $waris->no_kp_ibu ? 'border-danger' : '' }}" name="no_kp_ibu" value="{{ $requestedDataIbu['no_kp_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">No. Telefon</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['no_tel_ibu'] != $waris->no_tel_ibu ? 'border-danger' : '' }}" name="no_tel_ibu" value="{{ $requestedDataIbu['no_tel_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['status_ibu'] != $waris->status_ibu ? 'border-danger' : '' }}" name="status_ibu" value="{{ $requestedDataIbu['status_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control form-control-solid {{ $requestedDataIbu['alamat_ibu'] != $waris->alamat_ibu ? 'border-danger' : '' }}" name="alamat_ibu" readonly>{{ $requestedDataIbu['alamat_ibu'] }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['poskod_ibu'] != $waris->poskod_ibu ? 'border-danger' : '' }}" name="poskod_ibu" value="{{ $requestedDataIbu['poskod_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedNegeriIbu != $negeriIbu ? 'border-danger' : '' }}" name="negeri_ibu" value="{{ $requestedNegeriIbu }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDaerahIbu != $daerahIbu ? 'border-danger' : '' }}" name="daerah_ibu" value="{{ $requestedDaerahIbu }}" readonly />
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="d-flex">
                                                                    <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_ibu_ditolak{{$updateRequestIbu->klien_id}}">Ditolak</button>
                                                                    {{-- <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
    
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <!--end::Modal IbuKlien-->

                                @if($updateRequestIbu)
                                    <!--begin::Modal Permohonan Kemaskini Ibu Klien Ditolak-->
                                    <div class="modal fade" id="modal_kemaskini_ibu_ditolak{{$updateRequestIbu->klien_id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 style="text-align: center !important;">Permohonan Kemaskini Maklumat Ibu Klien Ditolak</h2>
                                                    <div id="kt_modal_add_customer_close" data-bs-dismiss="modal">
                                                        <i class="ki-solid ki-cross-circle fs-1"></i>
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form id="kemaskini_ibu_ditolak_form_{{$updateRequestIbu->klien_id}}" action="{{ route('tolak.update.ibu', ['id' => $updateRequestIbu->klien_id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Ditolak">
                                                        <input type="hidden" name="id" value="{{ $updateRequestIbu->klien_id }}">
                                    
                                                        <!-- Begin Rejection Reasons Input -->
                                                        <div id="dynamicFields">
                                                            <label class="fs-6 fw-semibold mb-2">Nyatakan alasan permohonan ditolak:</label>
                                                            <div class="input-group mb-2 catatan-row">
                                                                <textarea class="form-control" name="alasan_ditolak" placeholder="Contoh: Sila pilih status ibu, Poskod salah"></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- End Rejection Reasons Input -->
                                    
                                                        <!-- Form actions -->
                                                        <div class="text-center pt-3">
                                                            <button type="submit" class="btn btn-primary">Hantar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Modal Ditolak-->
                                @endif

                                <!--begin::Modal PenjagaKlien-->
                                <div class="modal fade" id="approvalPenjaga" tabindex="-1" aria-labelledby="luluskanPermohonanPenjagaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="luluskanPermohonanPenjagaLabel">Luluskan Permintaan Kemaskini Maklumat Penjaga Klien</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if($updateRequestPenjaga)
                                                    <form method="post" action="{{ route('approve.update.penjaga', ['id' => $updateRequestPenjaga->klien_id]) }}">
                                                        @csrf
                                                        @method('PATCH')
    
                                                        @php
                                                            $requestedDaerahPenjaga = DB::table('senarai_daerah')->where('id', $requestedDataPenjaga['daerah_penjaga'])->value('senarai_daerah.daerah');
                                                            $requestedNegeriPenjaga = DB::table('senarai_negeri')->where('id', $requestedDataPenjaga['negeri_penjaga'])->value('senarai_negeri.negeri');
                                                            $daerahPenjaga = DB::table('senarai_daerah')->where('id', $waris->daerah_penjaga)->value('senarai_daerah.daerah');
                                                            $negeriPenjaga = DB::table('senarai_negeri')->where('id', $waris->negeri_penjaga)->value('senarai_negeri.negeri');
                                                        @endphp
                                                
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Hubungan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['hubungan_penjaga'] != $waris->hubungan_penjaga ? 'border-danger' : '' }}" name="hubungan_penjaga" value="{{ $requestedDataPenjaga['hubungan_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['nama_penjaga'] != $waris->nama_penjaga ? 'border-danger' : '' }}" name="nama_penjaga" value="{{ $requestedDataPenjaga['nama_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">No. Kad Pengenalan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['no_kp_penjaga'] != $waris->no_kp_penjaga ? 'border-danger' : '' }}" name="no_kp_penjaga" value="{{ $requestedDataPenjaga['no_kp_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">No. Telefon</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['no_tel_penjaga'] != $waris->no_tel_penjaga ? 'border-danger' : '' }}" name="no_tel_penjaga" value="{{ $requestedDataPenjaga['no_tel_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['status_penjaga'] != $waris->status_penjaga ? 'border-danger' : '' }}" name="status_penjaga" value="{{ $requestedDataPenjaga['status_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control form-control-solid {{ $requestedDataPenjaga['alamat_penjaga'] != $waris->alamat_penjaga ? 'border-danger' : '' }}" name="alamat_penjaga" readonly>{{ $requestedDataPenjaga['alamat_penjaga'] }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['poskod_penjaga'] != $waris->poskod_penjaga ? 'border-danger' : '' }}" name="poskod_penjaga" value="{{ $requestedDataPenjaga['poskod_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedNegeriPenjaga != $negeriPenjaga ? 'border-danger' : '' }}" name="negeri_penjaga" value="{{ $requestedNegeriPenjaga }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDaerahPenjaga != $daerahPenjaga ? 'border-danger' : '' }}" name="daerah_penjaga" value="{{ $requestedDaerahPenjaga }}" readonly />
                                                            </div>
                                                        </div>
    
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="d-flex">
                                                                    <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_penjaga_ditolak{{$updateRequestPenjaga->klien_id}}">Ditolak</button>
                                                                    {{-- <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
    
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <!--end::Modal PenjagaKlien-->

                                @if($updateRequestPenjaga)
                                    <!--begin::Modal Permohonan Kemaskini Penjaga Klien Ditolak-->
                                    <div class="modal fade" id="modal_kemaskini_penjaga_ditolak{{$updateRequestPenjaga->klien_id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 style="text-align: center !important;">Permohonan Kemaskini Maklumat Keluarga Klien Ditolak</h2>
                                                    <div id="kt_modal_add_customer_close" data-bs-dismiss="modal">
                                                        <i class="ki-solid ki-cross-circle fs-1"></i>
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form id="kemaskini_penjaga_ditolak_form_{{$updateRequestPenjaga->klien_id}}" action="{{ route('tolak.update.penjaga', ['id' => $updateRequestPenjaga->klien_id]) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Ditolak">
                                                        <input type="hidden" name="id" value="{{ $updateRequestPenjaga->klien_id }}">
                                    
                                                        <!-- Begin Rejection Reasons Input -->
                                                        <div id="dynamicFields">
                                                            <label class="fs-6 fw-semibold mb-2">Nyatakan alasan permohonan ditolak:</label>
                                                            <div class="input-group mb-2 catatan-row">
                                                                <textarea class="form-control" name="alasan_ditolak" placeholder="Contoh: Sila masukkan hubungan penjaga, Poskod salah"></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- End Rejection Reasons Input -->
                                    
                                                        <!-- Form actions -->
                                                        <div class="text-center pt-3">
                                                            <button type="submit" class="btn btn-primary">Hantar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Modal Ditolak-->
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Keluarga-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="keluargaKlienForm"  class="form centered-form" action="{{ route('kemaskini.maklumat.pasangan.klien', ['id' => $klien->id]) }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="row mb-7">
                                <div class="col-md-8 offset-md-4">
                                    <h2>Kemaskini Maklumat Keluarga</h2>
                                </div>
                            </div>
                            <!--end::Heading-->

                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3 required">
                                        <span>Status Perkahwinan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex mt-3">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid custom-select" id="status_perkahwinan" name="status_perkahwinan" data-control="select2" data-hide-search="true">
                                            <option value="BUJANG" {{ $pasangan->status_perkahwinan == 'BUJANG' ? 'selected' : '' }}>BUJANG</option>
                                            <option value="BERKAHWIN" {{ $pasangan->status_perkahwinan == 'BERKAHWIN' ? 'selected' : '' }}>BERKAHWIN</option>
                                            <option value="DUDA/JANDA/BALU" {{ $pasangan->status_perkahwinan == 'DUDA/JANDA/BALU' ? 'selected' : '' }}>DUDA/JANDA/BALU</option>
                                        </select>
                                        <!--end::Select2-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!-- Fields to hide/show -->
                            <div id="pasangan-fields">
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nama Pasangan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" id="nama_pasangan" name="nama_pasangan" value="{{$pasangan->nama_pasangan}}" style="text-transform: uppercase;"/>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>No. Telefon Pasangan</span>
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
                                        <input type="text" class="form-control form-control-solid" id="no_tel_pasangan" name="no_tel_pasangan" value="{{$pasangan->no_tel_pasangan}}" inputmode="numeric"/>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Bilangan Anak</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <input type="number" class="form-control form-control-solid" id="bilangan_anak" name="bilangan_anak" value="{{$pasangan->bilangan_anak}}" min="0"/>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Alamat Rumah Pasangan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <div class="d-flex flex-stack">
                                            <div class="me-5">
                                                <input class="form-check-input-sm" id="alamat_pasangan_sama" name="alamat_pasangan_sama" onclick="alamatPasangan()" type="checkbox" value="1" />
                                                <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                            </div>
                                        </div>
                                        <textarea class="form-control form-control-solid" id="alamat_partner" name="alamat_pasangan" style="text-transform: uppercase;">{{$pasangan->alamat_pasangan}}</textarea>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
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
                                            <input type="text" class="form-control form-control-solid" id="poskod_partner" name="poskod_pasangan" value="{{$pasangan->poskod_pasangan}}" inputmode="numeric"/>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Negeri</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid custom-select" id="negeri_partner" name="negeri_pasangan" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                                <option>Pilih Negeri</option>
                                                @foreach ($negeriPasangan as $negeriP)
                                                    <option value="{{ $negeriP->id }}" {{ $pasangan->negeri_pasangan == $negeriP->id ? 'selected' : '' }}>{{ $negeriP->negeri }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Daerah</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid custom-select" id="daerah_partner" name="daerah_pasangan" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
                                                <option>Pilih Daerah</option>
                                                @foreach ($daerahPasangan as $daerahP)
                                                    <option value="{{ $daerahP->id }}" {{ $pasangan->daerah_pasangan == $daerahP->id ? 'selected' : '' }}>{{ $daerahP->daerah }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Alamat Tempat Kerja Pasangan</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" id="alamat_kerja_pasangan" name="alamat_kerja_pasangan" style="text-transform: uppercase;">{{$pasangan->alamat_kerja_pasangan}}</textarea>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
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
                                            <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_kerja_pasangan" name="poskod_kerja_pasangan" value="{{$pasangan->poskod_kerja_pasangan}}" inputmode="numeric"/>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Negeri</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid custom-select" id="negeri_kerja_pasangan" name="negeri_kerja_pasangan" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                                <option>Pilih Negeri</option>
                                                @foreach ($negeriKerjaPasangan as $negeriKP)
                                                    <option value="{{ $negeriKP->id }}" {{ $pasangan->negeri_kerja_pasangan == $negeriKP->id ? 'selected' : '' }}>{{ $negeriKP->negeri }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Daerah</span>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="w-100">
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid custom-select" id="daerah_kerja_pasangan" name="daerah_kerja_pasangan" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
                                                <option>Pilih Daerah</option>
                                                @foreach ($daerahKerjaPasangan as $daerahKP)    
                                                    <option value="{{ $daerahKP->id }}" {{ $pasangan->daerah_kerja_pasangan == $daerahKP->id ? 'selected' : '' }}>{{ $daerahKP->daerah }}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select2-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            
                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-8 offset-md-4">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="submitBtnKeluarga">Kemaskini</button>
                                        @if($requestPasangan)
                                            <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalPasangan" data-target="#approvalPasangan" style="background-color:#ffc107; color: white;">
                                                Semak Permohonan Kemaskini
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal Keluarga-->
                        <div class="modal fade" id="approvalPasangan" tabindex="-1" aria-labelledby="luluskanPermohonanPasanganLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="luluskanPermohonanPasanganLabel">Luluskan Permohonan Kemaskini Maklumat Pasangan Klien</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if($updateRequestPasangan)
                                            <form method="post" action="{{ route('approve.update.pasangan', ['id' => $updateRequestPasangan->klien_id]) }}">
                                                @csrf
                                                @method('PATCH')

                                                @php
                                                    $requestedDaerahPasangan = DB::table('senarai_daerah')->where('id', $requestedDataPasangan['daerah_pasangan'])->value('senarai_daerah.daerah');
                                                    $requestedNegeriPasangan = DB::table('senarai_negeri')->where('id', $requestedDataPasangan['negeri_pasangan'])->value('senarai_negeri.negeri');
                                                    $requestedDaerahKerjaPasangan = DB::table('senarai_daerah')->where('id', $requestedDataPasangan['daerah_kerja_pasangan'])->value('senarai_daerah.daerah');
                                                    $requestedNegeriKerjaPasangan = DB::table('senarai_negeri')->where('id', $requestedDataPasangan['negeri_kerja_pasangan'])->value('senarai_negeri.negeri');
                                                    
                                                    $daerahPasangan = DB::table('senarai_daerah')->where('id', $pasangan->daerah_pasangan)->value('senarai_daerah.daerah');
                                                    $negeriPasangan = DB::table('senarai_negeri')->where('id', $pasangan->negeri_pasangan)->value('senarai_negeri.negeri');
                                                    $daerahKerjaPasangan = DB::table('senarai_daerah')->where('id', $pasangan->daerah_kerja_pasangan)->value('senarai_daerah.daerah');
                                                    $negeriKerjaPasangan = DB::table('senarai_negeri')->where('id', $pasangan->negeri_kerja_pasangan)->value('senarai_negeri.negeri');
                                                @endphp
                                        
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Status Perkahwinan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['status_perkahwinan'] != $pasangan->status_perkahwinan ? 'border-danger' : '' }}" name="status_perkahwinan" value="{{ $requestedDataPasangan['status_perkahwinan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Nama Pasangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['nama_pasangan'] != $pasangan->nama_pasangan ? 'border-danger' : '' }}" name="nama_pasangan" value="{{ $requestedDataPasangan['nama_pasangan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">No. Telefon Pasangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['no_tel_pasangan'] != $pasangan->no_tel_pasangan ? 'border-danger' : '' }}" name="no_tel_pasangan" value="{{ $requestedDataPasangan['no_tel_pasangan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Bilangan Anak</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['bilangan_anak'] != $pasangan->bilangan_anak ? 'border-danger' : '' }}" name="bilangan_anak" value="{{ $requestedDataPasangan['bilangan_anak'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah Pasangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control form-control-solid {{ $requestedDataPasangan['alamat_pasangan'] != $pasangan->alamat_pasangan ? 'border-danger' : '' }}" name="alamat_pasangan" readonly>{{ $requestedDataPasangan['alamat_pasangan'] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['poskod_pasangan'] != $pasangan->poskod_pasangan ? 'border-danger' : '' }}" name="poskod_pasangan" value="{{ $requestedDataPasangan['poskod_pasangan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedNegeriPasangan != $negeriPasangan ? 'border-danger' : '' }}" name="negeri_pasangan" value="{{ $requestedNegeriPasangan }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDaerahPasangan != $daerahPasangan ? 'border-danger' : '' }}" name="daerah_pasangan" value="{{ $requestedDaerahPasangan }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Alamat Tempat Kerja Pasangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control form-control-solid {{ $requestedDataPasangan['alamat_kerja_pasangan'] != $pasangan->alamat_kerja_pasangan ? 'border-danger' : '' }}" name="alamat_kerja_pasangan" readonly>{{ $requestedDataPasangan['alamat_kerja_pasangan'] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid" name="poskod_kerja_pasangan" value="{{ $requestedDataPasangan['poskod_kerja_pasangan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedNegeriKerjaPasangan != $negeriKerjaPasangan ? 'border-danger' : '' }}" name="negeri_kerja_pasangan" value="{{ $requestedNegeriKerjaPasangan }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDaerahKerjaPasangan != $daerahKerjaPasangan ? 'border-danger' : '' }}" name="daerah_kerja_pasangan" value="{{ $requestedDaerahKerjaPasangan }}" readonly />
                                                    </div>
                                                </div>

                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="d-flex">
                                                            <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_keluarga_ditolak{{$updateRequestPasangan->klien_id}}">Ditolak</button>
                                                            {{-- <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>                                                
                        <!--end::Modal-->

                        @if($updateRequestPasangan)
                            <!--begin::Modal Permohonan Keluarga Klien Ditolak-->
                            <div class="modal fade" id="modal_kemaskini_keluarga_ditolak{{$updateRequestPasangan->klien_id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 style="text-align: center !important;">Permohonan Kemaskini Maklumat Keluarga Klien Ditolak</h2>
                                            <div id="kt_modal_add_customer_close" data-bs-dismiss="modal">
                                                <i class="ki-solid ki-cross-circle fs-1"></i>
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            <form id="kemaskini_keluarga_ditolak_form_{{$updateRequestPasangan->klien_id}}" action="{{ route('tolak.update.pasangan', ['id' => $updateRequestPasangan->klien_id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Ditolak">
                                                <input type="hidden" name="id" value="{{ $updateRequestPasangan->klien_id }}">
                            
                                                <!-- Begin Rejection Reasons Input -->
                                                <div id="dynamicFields">
                                                    <label class="fs-6 fw-semibold mb-2">Nyatakan alasan permohonan ditolak:</label>
                                                    <div class="input-group mb-2 catatan-row">
                                                        <textarea class="form-control" name="alasan_ditolak" placeholder="Contoh: Masukkan no.telefon peribadi pasangan, Poskod salah"></textarea>
                                                    </div>
                                                </div>
                                                <!-- End Rejection Reasons Input -->
                            
                                                <!-- Form actions -->
                                                <div class="text-center pt-3">
                                                    <button type="submit" class="btn btn-primary">Hantar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal Ditolak-->
                        @endif
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Rawatan-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_products" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="kt_ecommerce_settings_general_store" class="form centered-form" action="{{ route('kemaskini.maklumat.rawatan.klien', ['id' => $klien->id]) }}">
                            <!--begin::Heading-->
                            <div class="row mb-7">
                                <div class="col-md-8 offset-md-4">
                                    <h2>Maklumat Rawatan RPDK/RPDI</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                        
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Seksyen (Perintah/Sukarela)</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <span class="fs-6 form-control-plaintext">{{$rawatan->seksyen}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>PUSPEN</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $puspen = DB::table('senarai_puspen')->where('id', $rawatan->puspen)->value('senarai_puspen.puspen');
                                    @endphp
                                    <span class="fs-6 form-control-plaintext">{{$puspen}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>AADK Daerah</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $daerah_pejabat = DB::table('senarai_daerah_pejabat')->where('kod', $rawatan->pejabat)->value('senarai_daerah_pejabat.daerah');
                                    @endphp
                                    <span class="fs-6 form-control-plaintext">{{$daerah_pejabat}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Tarikh Perintah</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $formattedDatePerintah = Carbon::parse($rawatan->tkh_perintah)->format('d-m-Y');
                                    @endphp
                                    <span id="tkh_perintah" class="fs-6 form-control-plaintext">{{$formattedDatePerintah}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Tarikh Mula Pengawasan</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $formattedDateMula = Carbon::parse($rawatan->tkh_mula_pengawasan)->format('d-m-Y');
                                    @endphp
                                    <span id="tkh_mula_pengawasan" class="fs-6 form-control-plaintext">{{$formattedDateMula}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Tarikh Tamat Pengawasan</span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    @php
                                        $formattedDateTamat = Carbon::parse($rawatan->tkh_tamat_pengawasan)->format('d-m-Y');
                                    @endphp
                                    <span id="tkh_tamat_pengawasan" class="fs-6 form-control-plaintext">{{$formattedDateTamat}}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end:::Tab pane-->
                </div>
                <!--end:::Tab content-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content-->

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Script for select2 --}}
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
            
            const year = parseInt(icNumber.substring(0, 2), 10);
            const month = parseInt(icNumber.substring(2, 4), 10);
            const day = parseInt(icNumber.substring(4, 6), 10);

            const currentYear = new Date().getFullYear();
            const currentMonth = new Date().getMonth() + 1;
            const currentDay = new Date().getDate();

            let birthYear = year < (currentYear % 100) ? 2000 + year : 1900 + year;

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

        document.getElementById('approvalPeribadiKlien').addEventListener('click', (event) => {
            calculateAgeFromIC();
        });
    </script>

    {{-- Success / Error Message --}}
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

    {{-- Open modal nased on data-target --}}
    <script>
        document.querySelectorAll('.modal-trigger').forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var target = this.getAttribute('data-target');
                var modal = new bootstrap.Modal(document.querySelector(target));
                modal.show();
            });
        });

        $(document).ready(function(){
            $('[data-bs-toggle="tooltip"]').tooltip(); 
        });
    </script>

    {{-- Checkbox alamat --}}
    <script>
        // Store initial values in variables
        var initialAlamatBapa = document.getElementById("alamat_b").value;
        var initialNegeriBapa = document.getElementById("negeri_b").value;
        var initialDaerahBapa = document.getElementById("daerah_b").value;
        var initialPoskodBapa = document.getElementById("poskod_b").value;

        function alamatBapa() {
            
            var checkBox = document.getElementById("alamat_bapa_sama");
            var alamat_klien = document.getElementById("alamat_rumah_klien");
            var klien_negeri = document.getElementById("negeri_klien");
            var klien_daerah = document.getElementById("daerah_klien");
            var klien_poskod = document.getElementById("poskod_k");

            var alamat_bapa = document.getElementById("alamat_b");
            var negeri_bapa = document.getElementById("negeri_b");
            var daerah_bapa = document.getElementById("daerah_b");
            var poskod_bapa = document.getElementById("poskod_b");

            if (checkBox.checked) {
                // Copy values
                alamat_bapa.value = alamat_klien.innerText;
                poskod_bapa.value = klien_poskod.value;
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

    <script>
        // Store initial values in variables
        var initialAlamatIbu = document.getElementById("alamat_i").value;
        var initialNegeriIbu = document.getElementById("negeri_i").value;
        var initialDaerahIbu = document.getElementById("daerah_i").value;
        var initialPoskodIbu = document.getElementById("poskod_i").value;

        function alamatIbu() {
            
            var checkBox = document.getElementById("alamat_ibu_sama");
            var alamat_klien = document.getElementById("alamat_rumah_klien");
            var klien_negeri = document.getElementById("negeri_klien");
            var klien_daerah = document.getElementById("daerah_klien");
            var klien_poskod = document.getElementById("poskod_k");

            var alamat_ibu = document.getElementById("alamat_i");
            var negeri_ibu = document.getElementById("negeri_i");
            var daerah_ibu = document.getElementById("daerah_i");
            var poskod_ibu = document.getElementById("poskod_i");

            if (checkBox.checked) {
                // Copy values
                alamat_ibu.value = alamat_klien.innerText;
                poskod_ibu.value = klien_poskod.value;
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

    <script>
        // Store initial values in variables
        var initialAlamatPenjaga = document.getElementById("alamat_p").value;
        var initialNegeriPenjaga = document.getElementById("negeri_p").value;
        var initialDaerahPenjaga = document.getElementById("daerah_p").value;
        var initialPoskodPenjaga = document.getElementById("poskod_p").value;

        function alamatPenjaga() {
            
            var checkBox = document.getElementById("alamat_penjaga_sama");
            var alamat_klien = document.getElementById("alamat_rumah_klien");
            var klien_negeri = document.getElementById("negeri_klien");
            var klien_daerah = document.getElementById("daerah_klien");
            var klien_poskod = document.getElementById("poskod_k");

            var alamat_penjaga = document.getElementById("alamat_p");
            var negeri_penjaga = document.getElementById("negeri_p");
            var daerah_penjaga = document.getElementById("daerah_p");
            var poskod_penjaga = document.getElementById("poskod_p");

            if (checkBox.checked) {
                // Copy values
                alamat_penjaga.value = alamat_klien.innerText;
                poskod_penjaga.value = klien_poskod.value;
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

    <script>
        // Store initial values in variables
        var initialAlamatPasangan = document.getElementById("alamat_partner").value;
        var initialNegeriPasangan = document.getElementById("negeri_partner").value;
        var initialDaerahPasangan = document.getElementById("daerah_partner").value;
        var initialPoskodPasangan = document.getElementById("poskod_partner").value;

        function alamatPasangan() {
            
            var checkBox = document.getElementById("alamat_pasangan_sama");
            var alamat_klien = document.getElementById("alamat_rumah_klien");
            var klien_negeri = document.getElementById("negeri_klien");
            var klien_daerah = document.getElementById("daerah_klien");
            var klien_poskod = document.getElementById("poskod_k");

            var alamat_partner = document.getElementById("alamat_partner");
            var negeri_partner = document.getElementById("negeri_partner");
            var daerah_partner = document.getElementById("daerah_partner");
            var poskod_partner = document.getElementById("poskod_partner");

            if (checkBox.checked) {
                // Copy values
                alamat_partner.value = alamat_klien.innerText;
                poskod_partner.value = klien_poskod.value;
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
                'poskod_klien': 5,
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
        document.addEventListener('DOMContentLoaded', function() {
            const statusKerja = $('#status_kerja');
            const bekerjaFields = document.getElementById('bekerjaFields');
            const tidakBekerjaFields = document.getElementById('tidakBekerjaFields');

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

            // Trigger the function when the page loads
            toggleFields();

            // Add event listener for Select2 change event
            statusKerja.on('change.select2', function() {
                toggleFields();
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const statusKerjaModal = document.getElementById('status_kerja_modal');
            const bekerjaFields = document.getElementById('bekerjaFieldsModal');
            const tidakBekerjaFields = document.getElementById('tidakBekerjaFieldsModal');
    
            function toggleFields() 
            {
                console.log('Status Kerja Modal:', statusKerjaModal.value); // Debugging

                if (statusKerjaModal.value === 'BEKERJA') {
                    bekerjaFields.style.display = 'block';
                    tidakBekerjaFields.style.display = 'none';
                } else if (statusKerjaModal.value === 'TIDAK BEKERJA') {
                    bekerjaFields.style.display = 'none';
                    tidakBekerjaFields.style.display = 'block';
                } else {
                    bekerjaFields.style.display = 'none';
                    tidakBekerjaFields.style.display = 'none';
                }
            }
    
            // Initial check
            toggleFields();
        });
    </script>
    
    {{-- Compare original data with updated data --}}
    <script>
        document.getElementById('submitBtnKlien').addEventListener('click', function (e) {
            // Get original data (fetched from server/database)
            const originalDataKlien = {
                no_tel: "{{ $klien->no_tel }}",
                emel: "{{ $klien->emel }}",
                alamat_rumah_klien: "{{ $klien->alamat_rumah }}",
                poskod_k: "{{ $klien->poskod }}",
                negeri_klien: "{{ $klien->negeri }}",
                daerah_klien: "{{ $klien->daerah }}",
                tahap_pendidikan: "{{ $klien->tahap_pendidikan }}",
                penyakit: "{{ $klien->penyakit }}",
                status_oku: "{{ $klien->status_oku }}",
            };
    
            // Get current data (input values from form)
            const currentDataKlien = {
                no_tel: document.getElementById('no_tel').value,
                emel: document.getElementById('emel').value,
                alamat_rumah_klien: document.getElementById('alamat_rumah_klien').value,
                poskod_k: document.getElementById('poskod_k').value,
                negeri_klien: document.getElementById('negeri_klien').value,
                daerah_klien: document.getElementById('daerah_klien').value,
                tahap_pendidikan: document.getElementById('tahap_pendidikan').value,
                penyakit: document.getElementById('penyakit').value,
                status_oku: document.getElementById('status_oku').value,
            };
    
            // Handle poskod_k as a string for comparison, but check if the field is defined
            if (originalDataKlien.poskod_k !== null && originalDataKlien.poskod_k !== undefined) {
                originalDataKlien.poskod_k = originalDataKlien.poskod_k.toString();
            }
            if (currentDataKlien.poskod_k !== null && currentDataKlien.poskod_k !== undefined) {
                currentDataKlien.poskod_k = currentDataKlien.poskod_k.toString();
            }
    
            let isChanged = false;
        
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
                status_kerja: "{{ $pekerjaan->status_kerja }}",
                bidang_kerja: "{{ $pekerjaan->bidang_kerja }}",
                nama_kerja: "{{ $pekerjaan->nama_kerja }}",
                pendapatan: "{{ $pekerjaan->pendapatan }}",
                kategori_majikan: "{{ $pekerjaan->kategori_majikan }}",
                nama_majikan: "{{ $pekerjaan->nama_majikan }}",
                no_tel_majikan: "{{ $pekerjaan->no_tel_majikan }}",
                alamat_kerja: "{{ $pekerjaan->alamat_kerja }}",
                poskod_kerja: "{{ $pekerjaan->poskod_kerja }}",
                negeri_kerja: "{{ $pekerjaan->negeri_kerja }}",
                daerah_kerja: "{{ $pekerjaan->daerah_kerja }}",
                alasan_tidak_kerja: "{{ $pekerjaan->alasan_tidak_kerja }}"  // This could be null
            };

            // Get current form data
            let alasan_tidak_kerja = document.getElementById('alasan_tidak_kerja') ? document.getElementById('alasan_tidak_kerja').value : '';
            if (alasan_tidak_kerja === 'Pilih Alasan') {
                alasan_tidak_kerja = null;  // Treat "Pilih Alasan" as null
            }

            const currentData = {
                status_kerja: document.getElementById('status_kerja').value,
                bidang_kerja: document.getElementById('bidang_kerja').value,
                nama_kerja: document.getElementById('nama_kerja').value,
                pendapatan: document.getElementById('pendapatan').value,
                kategori_majikan: document.getElementById('kategori_majikan').value,
                nama_majikan: document.getElementById('nama_majikan').value,
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
                status_perkahwinan: "{{ $pasangan->status_perkahwinan }}",
                nama_pasangan: "{{ $pasangan->nama_pasangan }}",
                no_tel_pasangan: "{{ $pasangan->no_tel_pasangan }}",
                bilangan_anak: "{{ $pasangan->bilangan_anak }}",
                alamat_partner: "{{ $pasangan->alamat_pasangan }}",
                poskod_partner: "{{ $pasangan->poskod_pasangan }}",
                negeri_partner: "{{ $pasangan->negeri_pasangan }}",
                daerah_partner: "{{ $pasangan->daerah_pasangan }}",
                alamat_kerja_pasangan: "{{ $pasangan->alamat_kerja_pasangan }}",
                poskod_kerja_pasangan: "{{ $pasangan->poskod_kerja_pasangan }}",
                negeri_kerja_pasangan: "{{ $pasangan->negeri_kerja_pasangan }}",
                daerah_kerja_pasangan: "{{ $pasangan->daerah_kerja_pasangan }}"
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
                nama_bapa: "{{ $waris->nama_bapa }}",
                no_kp_bapa: "{{ $waris->no_kp_bapa }}",
                no_tel_bapa: "{{ $waris->no_tel_bapa }}",
                status_bapa: "{{ $waris->status_bapa }}",
                alamat_b: "{{ $waris->alamat_bapa }}",
                poskod_b: "{{ $waris->poskod_bapa }}",
                negeri_b: "{{ $waris->negeri_bapa }}",
                daerah_b: "{{ $waris->daerah_bapa }}",
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
                nama_ibu: "{{ $waris->nama_ibu }}",
                no_kp_ibu: "{{ $waris->no_kp_ibu }}",
                no_tel_ibu: "{{ $waris->no_tel_ibu }}",
                status_ibu: "{{ $waris->status_ibu }}",
                alamat_i: "{{ $waris->alamat_ibu }}",
                poskod_i: "{{ $waris->poskod_ibu }}",
                negeri_i: "{{ $waris->negeri_ibu }}",
                daerah_i: "{{ $waris->daerah_ibu }}",
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
                hubungan_penjaga: "{{ $waris->hubungan_penjaga }}",
                nama_penjaga: "{{ $waris->nama_penjaga }}",
                no_kp_penjaga: "{{ $waris->no_kp_penjaga }}",
                no_tel_penjaga: "{{ $waris->no_tel_penjaga }}",
                status_penjaga: "{{ $waris->status_penjaga }}",
                alamat_p: "{{ $waris->alamat_penjaga }}",
                poskod_p: "{{ $waris->poskod_penjaga }}",
                negeri_p: "{{ $waris->negeri_penjaga }}",
                daerah_p: "{{ $waris->daerah_penjaga }}",
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
</body>     
@endsection