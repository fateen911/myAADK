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
                        <form method="post" id="kt_ecommerce_settings_general_form" class="form centered-form" action="{{ route('kemaskini.maklumat.peribadi.klien', ['id' => $klien->id]) }}">
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
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nama Penuh</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="nama" class="fs-6 form-control-plaintext">{{$klien->nama}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nombor Kad Pengenalan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-2">
                                    <!--begin::Input-->
                                    <span id="no_kp" class="fs-6 form-control-plaintext">{{$klien->no_kp}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Umur</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="umur" class="fs-6 form-control-plaintext"></span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Jantina</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <span id="jantina" class="fs-6 form-control-plaintext">{{$klien->jantina}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Agama</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <span id="agama" class="fs-6 form-control-plaintext">{{$klien->agama}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Bangsa</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <span id="bangsa" class="fs-6 form-control-plaintext">{{$klien->bangsa}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Skor CCRI</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <span id="skor_ccri" class="fs-6 form-control-plaintext">{{$klien->skor_ccri}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nombor Telefon</span>
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
                                    <input type="text" class="form-control form-control-solid" maxlength="11" id="no_tel" name="no_tel" value="{{$klien->no_tel}}"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">E-mel</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan alamat emel yang aktif.">
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
                                    <input type="text" class="form-control form-control-solid" id="emel" name="emel" value="{{$klien->emel}}"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Alamat Rumah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid" id="alamat_rumah_klien" name="alamat_rumah_klien">{{$klien->alamat_rumah}}</textarea>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Poskod</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_klien" name="poskod_klien" value="{{$klien->poskod}}" />
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
                                        <span class="required">Negeri</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="negeri_klien" name="negeri_klien" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                            <option>Pilih Negeri</option>
                                            @foreach ($negeri as $item)
                                                <option value="{{ $item->id }}" {{ $klien->negeri == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
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
                                        <span class="required">Daerah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="daerah_klien" name="daerah_klien" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
                                            <option>Pilih Daerah</option>
                                            @foreach ($daerah as $item)
                                                <option value="{{ $item->id }}" {{ $klien->daerah == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
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
                                        <span class="required">Tahap Pendidikan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="tahap_pendidikan" name="tahap_pendidikan" data-control="select2" data-hide-search="true" data-placeholder="Pilih Tahap Pendidikan">
                                            <option>Pilih Tahap Pendidikan</option>
                                            <option value="PRA SEKOLAH" {{ $klien->tahap_pendidikan == 'PRA SEKOLAH' ? 'selected' : '' }}>PRA SEKOLAH</option>
                                            <option value="PENDIDIKAN RENDAH" {{ $klien->tahap_pendidikan == 'PENDIDIKAN RENDAH' ? 'selected' : '' }}>PENDIDIKAN RENDAH</option>
                                            <option value="PENDIDIKAN MENENGAH" {{ $klien->tahap_pendidikan == 'PENDIDIKAN MENENGAH' ? 'selected' : '' }}>PENDIDIKAN MENENGAH</option>
                                            <option value="PENGAJIAN TINGGI" {{ $klien->tahap_pendidikan == 'PENGAJIAN TINGGI' ? 'selected' : '' }}>PENGAJIAN TINGGI</option>
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
                                        <span class="required">Status Kesihatan Mental</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="status_kesihatan_mental" name="status_kesihatan_mental" value="{{$klien->status_kesihatan_mental}}"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Status Orang Kurang Upaya (OKU)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8 position-relative">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="status_oku" name="status_oku" value="{{$klien->status_oku}}"/>
                                    <!--end::Input-->
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
                                        <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
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
                                                @endphp
                                        
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="nama" class="fs-6 form-control-plaintext">{{$klien->nama}}</span>
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
                                                        <span id="jantina" class="fs-6 form-control-plaintext">{{$klien->jantina}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Agama</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="agama" class="fs-6 form-control-plaintext">{{$klien->agama}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-2">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Bangsa</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="bangsa" class="fs-6 form-control-plaintext">{{$klien->bangsa}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-2">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Skor CCRI</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span id="skor_ccri" class="fs-6 form-control-plaintext">{{$klien->skor_ccri}}</span>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
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
                                                    <div class="col-md-8">
                                                        <!-- Use a conditional class to highlight changes -->
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataKlien['no_tel'] != $klien->no_tel ? 'border-primary' : '' }}" name="no_tel" value="{{ $requestedDataKlien['no_tel'] }}" readonly />
                                                        
                                                        <!-- Add an icon to indicate change if there's a discrepancy -->
                                                        @if ($requestedDataKlien['no_tel'] != $klien->no_tel)
                                                            <i class="ki-duotone ki-warning-2 text-danger fs-6 position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);" data-bs-toggle="tooltip" title="This field has been modified by the client."></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">E-mel
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
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataKlien['emel'] != $klien->emel ? 'border-primary' : '' }}" name="emel" value="{{ $requestedDataKlien['emel'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Alamat Rumah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control form-control-solid {{ $requestedDataKlien['alamat_rumah'] != $klien->alamat_rumah ? 'border-primary' : '' }}" name="alamat_rumah" readonly>{{ $requestedDataKlien['alamat_rumah'] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Poskod</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataKlien['poskod'] != $klien->poskod ? 'border-primary' : '' }}" name="poskod" value="{{ $requestedDataKlien['poskod'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedNegeriRumahKlien != $negeriRumahKlien ? 'border-primary' : '' }}" name="negeri" value="{{ $requestedNegeriRumahKlien }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Daerah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDaerahRumahKlien != $daerahRumahKlien ? 'border-primary' : '' }}" name="daerah" value="{{ $requestedDaerahRumahKlien }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Tahap Pendidikan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataKlien['tahap_pendidikan'] != $klien->tahap_pendidikan ? 'border-primary' : '' }}" name="tahap_pendidikan" value="{{ $requestedDataKlien['tahap_pendidikan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Status Kesihatan Mental</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataKlien['status_kesihatan_mental'] != $klien->status_kesihatan_mental ? 'border-primary' : '' }}" name="status_kesihatan_mental" value="{{ $requestedDataKlien['status_kesihatan_mental'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3 required">Status Orang Kurang Upaya (OKU)</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataKlien['status_oku'] != $klien->status_oku ? 'border-primary' : '' }}" name="status_oku" value="{{ $requestedDataKlien['status_oku'] }}" readonly />
                                                    </div>
                                                </div>
                                                
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="d-flex">
                                                            <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Lulus</button>
                                                            <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button>
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
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Pekerjaan-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_customers" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="kt_ecommerce_settings_general_form" class="form centered-form" action="{{ route('kemaskini.maklumat.pekerjaan.klien', ['id' => $klien->id]) }}">
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
                                    <select class="form-select form-select-solid" id="status_kerja" name="status_kerja" data-control="select2" data-hide-search="true">
                                        <option value="BEKERJA" {{ $pekerjaan->status_kerja == 'BEKERJA' ? 'selected' : '' }}>BEKERJA</option>
                                        <option value="TIDAK BEKERJA" {{ $pekerjaan->status_kerja == 'TIDAK BEKERJA' ? 'selected' : '' }}>TIDAK BEKERJA</option>
                                        <option value="MENGANGGUR" {{ $pekerjaan->status_kerja == 'MENGANGGUR' ? 'selected' : '' }}>MENGANGGUR</option>
                                        <option value="BELAJAR" {{ $pekerjaan->status_kerja == 'BELAJAR' ? 'selected' : '' }}>BELAJAR</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Bidang Pekerjaan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-solid" id="bidang_kerja" name="bidang_kerja" value="{{$pekerjaan->bidang_kerja}}"/>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nama Pekerjaan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-solid" id="nama_kerja" name="nama_kerja" value="{{$pekerjaan->nama_kerja}}"/>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Pendapatan (RM)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-9">
                                    <!--begin::Input-->
                                    <select class="form-select form-select-solid" id="pendapatan" name="pendapatan" data-control="select2" data-hide-search="true">
                                        <option>Pilih Julat Pendapatan</option>
                                        <option value="RM0-RM999" {{ $pekerjaan->pendapatan == 'RM0-RM999' ? 'selected' : '' }}>RM0-RM999</option>
                                        <option value="RM1000-RM1999" {{ $pekerjaan->pendapatan == 'RM1000-RM1999' ? 'selected' : '' }}>RM1000-RM1999</option>
                                        <option value="RM2000-RM2999" {{ $pekerjaan->pendapatan == 'RM2000-RM2999' ? 'selected' : '' }}>RM2000-RM2999</option>
                                        <option value="RM3000-RM3999" {{ $pekerjaan->pendapatan == 'RM3000-RM3999' ? 'selected' : '' }}>RM3000-RM3999</option>
                                        <option value="RM4000-RM4999" {{ $pekerjaan->pendapatan == 'RM4000-RM4999' ? 'selected' : '' }}>RM4000-RM4999</option>
                                        <option value="Lebih RM5000" {{ $pekerjaan->pendapatan == 'Lebih RM5000' ? 'selected' : '' }}>Lebih RM5000</option>
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
                                    <select class="form-select form-select-solid" id="kategori_majikan" name="kategori_majikan" data-control="select2" data-hide-search="true">
                                        <option>Pilih Kategori Majikan</option>
                                        <option value="KERAJAAN" {{ $pekerjaan->kategori_majikan == 'KERAJAAN' ? 'selected' : '' }}>KERAJAAN</option>
                                        <option value="SWASTA" {{ $pekerjaan->kategori_majikan == 'SWASTA' ? 'selected' : '' }}>SWASTA</option>
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
                                    <input type="text" class="form-control form-control-solid" id="nama_majikan" name="nama_majikan" value="{{$pekerjaan->nama_majikan}}" />
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
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
                                <div class="col-md-9">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="no_tel_majikan" name="no_tel_majikan" value="{{$pekerjaan->no_tel_majikan}}" maxlength="11"/>
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
                                    <textarea class="form-control form-control-solid" id="alamat_kerja" name="alamat_kerja">{{$pekerjaan->alamat_kerja}}</textarea>
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
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_kerja" name="poskod_kerja" value="{{$pekerjaan->poskod_kerja}}" />
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
                                        <select class="form-select form-select-solid" id="negeri_kerja" name="negeri_kerja" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
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
                                        <select class="form-select form-select-solid" id="daerah_kerja" name="daerah_kerja" data-control="select2">
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

                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-9 offset-md-3">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
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
                                                @endphp
                                        
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Status Kerja</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['status_kerja'] != $pekerjaan->status_kerja ? 'border-primary' : '' }}" name="status_kerja" value="{{ $requestedDataPekerjaan['status_kerja'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Bidang Pekerjaan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['bidang_kerja'] != $pekerjaan->bidang_kerja ? 'border-primary' : '' }}" name="bidang_kerja" value="{{ $requestedDataPekerjaan['bidang_kerja'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Nama Pekerjaan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['nama_kerja'] != $pekerjaan->nama_kerja ? 'border-primary' : '' }}" name="nama_kerja" value="{{ $requestedDataPekerjaan['nama_kerja'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Pendapatan (RM)</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['pendapatan'] != $pekerjaan->pendapatan ? 'border-primary' : '' }}" name="pendapatan" value="{{ $requestedDataPekerjaan['pendapatan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Kategori Majikan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['kategori_majikan'] != $pekerjaan->kategori_majikan ? 'border-primary' : '' }}" name="kategori_majikan" value="{{ $requestedDataPekerjaan['kategori_majikan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Nama Majikan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['nama_majikan'] != $pekerjaan->nama_majikan ? 'border-primary' : '' }}" name="nama_majikan" value="{{ $requestedDataPekerjaan['nama_majikan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">No Telefon Majikan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['no_tel_majikan'] != $pekerjaan->no_tel_majikan ? 'border-primary' : '' }}" name="no_tel_majikan" value="{{ $requestedDataPekerjaan['no_tel_majikan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Alamat</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control form-control-solid {{ $requestedDataPekerjaan['alamat_kerja'] != $pekerjaan->alamat_kerja ? 'border-primary' : '' }}" name="alamat_kerja" readonly>{{ $requestedDataPekerjaan['alamat_kerja'] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPekerjaan['poskod_kerja'] != $pekerjaan->poskod_kerja ? 'border-primary' : '' }}" name="poskod_kerja" value="{{ $requestedDataPekerjaan['poskod_kerja'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedNegeriKerja != $negeriKerja ? 'border-primary' : '' }}" name="negeri_kerja" value="{{ $requestedNegeriKerja }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDaerahKerja != $daerahKerja ? 'border-primary' : '' }}" name="daerah_kerja" value="{{ $requestedDaerahKerja }}" readonly />
                                                    </div>
                                                </div>

                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="d-flex">
                                                            <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                            <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button>
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
                                            <form method="post" style="padding-left: 50px;" action="{{ route('kemaskini.bapa.klien', ['id' => $klien->id]) }}">
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
                                                            <span class="required">Nama</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
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
                                                            <span class="required">Nombor Kad Pengenalan</span>
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
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_kp_bapa" name="no_kp_bapa" maxlength="12" value="{{$waris->no_kp_bapa}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Nombor Telefon</span>
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
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_bapa" name="no_tel_bapa" maxlength="11" value="{{$waris->no_tel_bapa}}" maxlength="11"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Status</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <select class="form-select form-select-solid" id="status_bapa" name="status_bapa" data-control="select2" data-hide-search="true">
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
                                                            <span class="required">Alamat Rumah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <div class="d-flex flex-stack">
                                                            <div class="me-5">
                                                                <input class="form-check-input-sm" id="alamat_bapa_sama" name="alamat_bapa_sama" onclick="alamatBapa()" type="checkbox" value="1" />
                                                                <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                            </div>
                                                        </div>
                                                        <textarea class="form-control form-control-solid" id="alamat_bapa" name="alamat_bapa">{{$waris->alamat_bapa}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Poskod</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_bapa" name="poskod_bapa" value="{{$waris->poskod_bapa}}" />
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
                                                            <span class="required">Negeri</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid" id="negeri_bapa" name="negeri_bapa" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
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
                                                            <span class="required">Daerah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid" id="daerah_bapa" name="daerah_bapa" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
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
                                                
                                                <!--begin::Action buttons-->
                                                <div class="row py-5">
                                                    <div class="col-md-8 offset-md-4">
                                                        <div class="d-flex">
                                                            <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
                                                            @if($requestedDataBapa)
                                                                @if($statusBapa == 'Kemaskini')
                                                                    <button type="submit" class="btn btn-secondary modal-trigger" id="approvalModalBapa" data-target="#approvalBapa" style="background-color:#ffc107; color: white;">
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
                    
                                        <!-- Maklumat Ibu -->
                                        <div class="tab-pane" id="maklumatIbu">
                                            <form method="post" style="padding-left: 50px;" action="{{ route('kemaskini.ibu.klien', ['id' => $klien->id]) }}">
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
                                                            <span class="required">Nama</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="nama_ibu" name="nama_ibu" value="{{$waris->nama_ibu}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Nombor Kad Pengenalan</span>
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
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_kp_ibu" name="no_kp_ibu" maxlength="12" value="{{$waris->no_kp_ibu}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Nombor Telefon</span>
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
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_ibu" name="no_tel_ibu" maxlength="11" value="{{$waris->no_tel_ibu}}" maxlength="11"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Status</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <select class="form-select form-select-solid" id="status_ibu" name="status_ibu" data-control="select2" data-hide-search="true">
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
                                                            <span class="required">Alamat Rumah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <div class="d-flex flex-stack">
                                                            <div class="me-5">
                                                                <input class="form-check-input-sm" id="alamat_ibu_sama" name="alamat_ibu_sama" onclick="alamatIbu()" type="checkbox" value="1" />
                                                                <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                            </div>
                                                        </div>
                                                        <textarea class="form-control form-control-solid" id="alamat_ibu" name="alamat_ibu">{{$waris->alamat_ibu}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Poskod</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_ibu" name="poskod_ibu" value="{{$waris->poskod_ibu}}" />
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
                                                            <span class="required">Negeri</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid" id="negeri_ibu" name="negeri_ibu" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
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
                                                            <span class="required">Daerah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid" id="daerah_ibu" name="daerah_ibu" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
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
                                                            <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
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
                                            <form method="post" style="padding-left: 50px;" action="{{ route('kemaskini.penjaga.klien', ['id' => $klien->id]) }}">
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
                                                            <span class="required">Hubungan</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="hubungan_penjaga" name="hubungan_penjaga" value="{{$waris->hubungan_penjaga}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Nama</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="nama_penjaga" name="nama_penjaga" value="{{$waris->nama_penjaga}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Nombor Kad Pengenalan</span>
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
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_kp_penjaga" name="no_kp_penjaga" maxlength="12" value="{{$waris->no_kp_penjaga}}" />
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Nombor Telefon</span>
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
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" id="no_tel_penjaga" name="no_tel_penjaga" maxlength="11" value="{{$waris->no_tel_penjaga}}" maxlength="11"/>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Status</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <select class="form-select form-select-solid" id="status_penjaga" name="status_penjaga" data-control="select2" data-hide-search="true">
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
                                                            <span class="required">Alamat Rumah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <div class="d-flex flex-stack">
                                                            <div class="me-5">
                                                                <input class="form-check-input-sm" id="alamat_penjaga_sama" name="alamat_penjaga_sama" onclick="alamatPenjaga()" type="checkbox" value="1" />
                                                                <label class="form-label fs-7">Sama seperti Alamat Rumah Klien</label>
                                                            </div>
                                                        </div>
                                                        <textarea class="form-control form-control-solid" id="alamat_penjaga" name="alamat_penjaga">{{$waris->alamat_penjaga}}</textarea>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row fv-row mb-5">
                                                    <div class="col-md-4 text-md-start">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold form-label mt-3">
                                                            <span class="required">Poskod</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_penjaga" name="poskod_penjaga" value="{{$waris->poskod_penjaga}}" />
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
                                                            <span class="required">Negeri</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid" id="negeri_penjaga" name="negeri_penjaga" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                                                <option>Pilih negeri</option>
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
                                                            <span class="required">Daerah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="w-100">
                                                            <!--begin::Select2-->
                                                            <select class="form-select form-select-solid" id="daerah_penjaga" name="daerah_penjaga" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
                                                                <option>Pilih daerah</option>
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
                                                            <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
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
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['nama_bapa'] != $waris->nama_bapa ? 'border-primary' : '' }}" name="nama_bapa" value="{{ $requestedDataBapa['nama_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nombor Kad Pengenalan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['no_kp_bapa'] != $waris->no_kp_bapa ? 'border-primary' : '' }}" name="no_kp_bapa" value="{{ $requestedDataBapa['no_kp_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['no_tel_bapa'] != $waris->no_tel_bapa ? 'border-primary' : '' }}" name="no_tel_bapa" value="{{ $requestedDataBapa['no_tel_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['status_bapa'] != $waris->status_bapa ? 'border-primary' : '' }}" name="status_bapa" value="{{ $requestedDataBapa['status_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control form-control-solid {{ $requestedDataBapa['alamat_bapa'] != $waris->alamat_bapa ? 'border-primary' : '' }}" name="alamat_bapa" readonly>{{ $requestedDataBapa['alamat_bapa'] }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataBapa['poskod_bapa'] != $waris->poskod_bapa ? 'border-primary' : '' }}" name="poskod_bapa" value="{{ $requestedDataBapa['poskod_bapa'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedNegeriBapa != $negeriBapa ? 'border-primary' : '' }}" name="negeri_bapa" value="{{ $requestedNegeriBapa }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDaerahBapa != $daerahBapa ? 'border-primary' : '' }}" name="daerah_bapa" value="{{ $requestedDaerahBapa }}" readonly />
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="d-flex">
                                                                    <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                                    <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button>
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
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['nama_ibu'] != $waris->nama_ibu ? 'border-primary' : '' }}" name="nama_ibu" value="{{ $requestedDataIbu['nama_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nombor Kad Pengenalan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['no_kp_ibu'] != $waris->no_kp_ibu ? 'border-primary' : '' }}" name="no_kp_ibu" value="{{ $requestedDataIbu['no_kp_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['no_tel_ibu'] != $waris->no_tel_ibu ? 'border-primary' : '' }}" name="no_tel_ibu" value="{{ $requestedDataIbu['no_tel_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['status_ibu'] != $waris->status_ibu ? 'border-primary' : '' }}" name="status_ibu" value="{{ $requestedDataIbu['status_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control form-control-solid {{ $requestedDataIbu['alamat_ibu'] != $waris->alamat_ibu ? 'border-primary' : '' }}" name="alamat_ibu" readonly>{{ $requestedDataIbu['alamat_ibu'] }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataIbu['poskod_ibu'] != $waris->poskod_ibu ? 'border-primary' : '' }}" name="poskod_ibu" value="{{ $requestedDataIbu['poskod_ibu'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedNegeriIbu != $negeriIbu ? 'border-primary' : '' }}" name="negeri_ibu" value="{{ $requestedNegeriIbu }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDaerahIbu != $daerahIbu ? 'border-primary' : '' }}" name="daerah_ibu" value="{{ $requestedDaerahIbu }}" readonly />
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="d-flex">
                                                                    <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                                    <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button>
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
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['hubungan_penjaga'] != $waris->hubungan_penjaga ? 'border-primary' : '' }}" name="hubungan_penjaga" value="{{ $requestedDataPenjaga['hubungan_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['nama_penjaga'] != $waris->nama_penjaga ? 'border-primary' : '' }}" name="nama_penjaga" value="{{ $requestedDataPenjaga['nama_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nombor Kad Pengenalan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['no_kp_penjaga'] != $waris->no_kp_penjaga ? 'border-primary' : '' }}" name="no_kp_penjaga" value="{{ $requestedDataPenjaga['no_kp_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['no_tel_penjaga'] != $waris->no_tel_penjaga ? 'border-primary' : '' }}" name="no_tel_penjaga" value="{{ $requestedDataPenjaga['no_tel_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Status</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['status_penjaga'] != $waris->status_penjaga ? 'border-primary' : '' }}" name="status_penjaga" value="{{ $requestedDataPenjaga['status_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control form-control-solid {{ $requestedDataPenjaga['alamat_penjaga'] != $waris->alamat_penjaga ? 'border-primary' : '' }}" name="alamat_penjaga" readonly>{{ $requestedDataPenjaga['alamat_penjaga'] }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDataPenjaga['poskod_penjaga'] != $waris->poskod_penjaga ? 'border-primary' : '' }}" name="poskod_penjaga" value="{{ $requestedDataPenjaga['poskod_penjaga'] }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedNegeriPenjaga != $negeriPenjaga ? 'border-primary' : '' }}" name="negeri_penjaga" value="{{ $requestedNegeriPenjaga }}" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control form-control-solid {{ $requestedDaerahPenjaga != $daerahPenjaga ? 'border-primary' : '' }}" name="daerah_penjaga" value="{{ $requestedDaerahPenjaga }}" readonly />
                                                            </div>
                                                        </div>
    
                                                        <div class="row fv-row mb-7">
                                                            <div class="col-md-4 text-md-start">
                                                                <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="d-flex">
                                                                    <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                                    <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button>
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
                            </div>
                        </div>
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Keluarga-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="kt_ecommerce_settings_general_products"  class="form centered-form" action="{{ route('kemaskini.maklumat.pasangan.klien', ['id' => $klien->id]) }}">
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
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Status Perkahwinan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex mt-3">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="status_perkahwinan" name="status_perkahwinan" data-control="select2" data-hide-search="true">
                                            <option>Pilih Status Perkahwinan</option>
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
                                        <input type="text" class="form-control form-control-solid" id="nama_pasangan" name="nama_pasangan" value="{{$pasangan->nama_pasangan}}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row fv-row mb-7">
                                    <div class="col-md-4 text-md-start">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Nombor Telefon Pasangan</span>
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
                                        <input type="text" class="form-control form-control-solid" id="no_tel_pasangan" name="no_tel_pasangan" value="{{$pasangan->no_tel_pasangan}}" maxlength="11"/>
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
                                        <textarea class="form-control form-control-solid" id="alamat_pasangan" name="alamat_pasangan">{{$pasangan->alamat_pasangan}}</textarea>
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
                                            <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_pasangan" name="poskod_pasangan" value="{{$pasangan->poskod_pasangan}}" />
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
                                            <select class="form-select form-select-solid" id="negeri_pasangan" name="negeri_pasangan" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
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
                                            <select class="form-select form-select-solid" id="daerah_pasangan" name="daerah_pasangan" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
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
                                        <textarea class="form-control form-control-solid" id="alamat_kerja_pasangan" name="alamat_kerja_pasangan">{{$pasangan->alamat_kerja_pasangan}}</textarea>
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
                                            <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_kerja_pasangan" name="poskod_kerja_pasangan" value="{{$pasangan->poskod_kerja_pasangan}}" />
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
                                            <select class="form-select form-select-solid" id="negeri_kerja_pasangan" name="negeri_kerja_pasangan" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
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
                                            <select class="form-select form-select-solid" id="daerah_kerja_pasangan" name="daerah_kerja_pasangan" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
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
                                        <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
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

                        <!--begin::Modal Pasangan-->
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
                                                        <label class="fs-6 fw-semibold form-label mt-3">Status Perkahwinan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['status_perkahwinan'] != $pasangan->status_perkahwinan ? 'border-primary' : '' }}" name="status_perkahwinan" value="{{ $requestedDataPasangan['status_perkahwinan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Nama Pasangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['nama_pasangan'] != $pasangan->nama_pasangan ? 'border-primary' : '' }}" name="nama_pasangan" value="{{ $requestedDataPasangan['nama_pasangan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon Pasangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['no_tel_pasangan'] != $pasangan->no_tel_pasangan ? 'border-primary' : '' }}" name="no_tel_pasangan" value="{{ $requestedDataPasangan['no_tel_pasangan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Bilangan Anak</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['bilangan_anak'] != $pasangan->bilangan_anak ? 'border-primary' : '' }}" name="bilangan_anak" value="{{ $requestedDataPasangan['bilangan_anak'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah Pasangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control form-control-solid {{ $requestedDataPasangan['alamat_pasangan'] != $pasangan->alamat_pasangan ? 'border-primary' : '' }}" name="alamat_pasangan" readonly>{{ $requestedDataPasangan['alamat_pasangan'] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDataPasangan['poskod_pasangan'] != $pasangan->poskod_pasangan ? 'border-primary' : '' }}" name="poskod_pasangan" value="{{ $requestedDataPasangan['poskod_pasangan'] }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedNegeriPasangan != $negeriPasangan ? 'border-primary' : '' }}" name="negeri_pasangan" value="{{ $requestedNegeriPasangan }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDaerahPasangan != $daerahPasangan ? 'border-primary' : '' }}" name="daerah_pasangan" value="{{ $requestedDaerahPasangan }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Alamat Tempat Kerja Pasangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control form-control-solid {{ $requestedDataPasangan['alamat_kerja_pasangan'] != $pasangan->alamat_kerja_pasangan ? 'border-primary' : '' }}" name="alamat_kerja_pasangan" readonly>{{ $requestedDataPasangan['alamat_kerja_pasangan'] }}</textarea>
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
                                                        <input type="text" class="form-control form-control-solid {{ $requestedNegeriKerjaPasangan != $negeriKerjaPasangan ? 'border-primary' : '' }}" name="negeri_kerja_pasangan" value="{{ $requestedNegeriKerjaPasangan }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control form-control-solid {{ $requestedDaerahKerjaPasangan != $daerahKerjaPasangan ? 'border-primary' : '' }}" name="daerah_kerja_pasangan" value="{{ $requestedDaerahKerjaPasangan }}" readonly />
                                                    </div>
                                                </div>

                                                <div class="row fv-row mb-7">
                                                    <div class="col-md-4 text-md-start">
                                                        <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="d-flex">
                                                            <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                            <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button>
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
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Seksyen (Perintah/Sukarela)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-4">
                                    <!--begin::Input-->
                                    <span id="seksyen_okp" class="fs-6 form-control-plaintext">{{$rawatan->seksyen}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Pusat Penjara (PUSPEN)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-4">
                                    <!--begin::Input-->
                                    <span id="puspen" class="fs-6 form-control-plaintext">{{$rawatan->puspen}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Pejabat Pengawasan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-4">
                                    <!--begin::Input-->
                                    <span id="pejabat" class="fs-6 form-control-plaintext">{{$rawatan->pejabat}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Tarikh Perintah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-4">
                                    <!--begin::Input-->
                                    @php
                                        $formattedDatePerintah = Carbon::parse($rawatan->tkh_perintah)->format('d-m-Y');
                                    @endphp
                                    <span id="tkh_perintah" class="fs-6 form-control-plaintext">{{$formattedDatePerintah}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Tarikh Mula Pengawasan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-4">
                                    <!--begin::Input-->
                                    @php
                                        $formattedDateMula = Carbon::parse($rawatan->tkh_mula_pengawasan)->format('d-m-Y');
                                    @endphp
                                    <span id="tkh_mula_pengawasan" class="fs-6 form-control-plaintext">{{$formattedDateMula}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Tarikh Tamat Pengawasan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-4">
                                    <!--begin::Input-->
                                    @php
                                        $formattedDateTamat = Carbon::parse($rawatan->tkh_tamat_pengawasan)->format('d-m-Y');
                                    @endphp
                                    <span id="tkh_tamat_pengawasan" class="fs-6 form-control-plaintext">{{$formattedDateTamat}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal Rawatan-->
                        {{-- <div class="modal fade" id="approvalRawatan" tabindex="-1" aria-labelledby="luluskanPermohonanRawatanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="luluskanPermohonanRawatanLabel">Luluskan Permintaan Kemaskini Maklumat Rawatan Klien</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('approve.update.rawatan', ['id' => $updateRequestRawatan->klien_id]) }}">
                                            @csrf
                                            @method('PATCH')

                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Status Kesihatan Mental</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="status_kesihatan_mental" value="{{ $requestedDataRawatan['status_kesihatan_mental'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Status Orang Kurang Upaya (OKU)</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="status_oku" value="{{ $requestedDataRawatan['status_oku'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Status OKP</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="seksyen_okp" value="{{ $requestedDataRawatan['seksyen_okp'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Tarikh Tamat Rawatan dan Pemulihan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    @php
                                                        $formattedDate = Carbon::parse($requestedDataRawatan['tarikh_tamat_pengawasan'])->format('d-m-Y');
                                                    @endphp
                                                    <input type="text" class="form-control form-control-solid" name="tarikh_tamat_pengawasan" value="{{ $formattedDate }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Skor CCRI</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="skor_ccri" value="{{ $requestedDataRawatan['skor_ccri'] }}" readonly />
                                                </div>
                                            </div>

                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Keputusan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="d-flex">
                                                        <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Luluskan</button>
                                                        <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
    <!--end::Content-->

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

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

    <script>
        $(document).ready(function() {
            // Get the client address fields
            const clientAddress = $('#alamat_rumah_klien').text().trim();
            const clientPoskod = $('#poskod_klien').text().trim();
            const clientDaerah = $('#daerah_klien').text().trim();
            const clientNegeri = $('#negeri_klien').text().trim();

            console.log('Client Address:', clientAddress);
            console.log('Client Poskod:', clientPoskod);
            console.log('Client Daerah:', clientDaerah);
            console.log('Client Negeri:', clientNegeri);
        
            // Function to copy address fields for Bapa
            function alamatBapa() {
                const checkbox = $('#alamat_bapa_sama');
                if (checkbox.is(':checked')) {
                    $('#alamat_bapa').val(clientAddress);
                    $('#poskod_bapa').val(clientPoskod);
                    $('#daerah_bapa').val(clientDaerah);
                    $('#negeri_bapa').val(clientNegeri);
                } else {
                    // Clear the fields if the checkbox is unchecked
                    $('#alamat_bapa').val('');
                    $('#poskod_bapa').val('');
                    $('#daerah_bapa').val('');
                    $('#negeri_bapa').val('');
                }
            }
        
            // Function to copy address fields for Ibu
            function alamatIbu() {
                const checkbox = $('#alamat_ibu_sama');
                if (checkbox.is(':checked')) {
                    $('#alamat_ibu').val(clientAddress);
                    $('#poskod_ibu').val(clientPoskod);
                    $('#daerah_ibu').val(clientDaerah);
                    $('#negeri_ibu').val(clientNegeri);
                } else {
                    // Clear the fields if the checkbox is unchecked
                    $('#alamat_ibu').val('');
                    $('#poskod_ibu').val('');
                    $('#daerah_ibu').val('');
                    $('#negeri_ibu').val('');
                }
            }
        
            // Function to copy address fields for Penjaga
            function alamatPenjaga() {
                const checkbox = $('#alamat_penjaga_sama');
                if (checkbox.is(':checked')) {
                    $('#alamat_penjaga').val(clientAddress);
                    $('#poskod_penjaga').val(clientPoskod);
                    $('#daerah_penjaga').val(clientDaerah);
                    $('#negeri_penjaga').val(clientNegeri);
                } else {
                    // Clear the fields if the checkbox is unchecked
                    $('#alamat_penjaga').val('');
                    $('#poskod_penjaga').val('');
                    $('#daerah_penjaga').val('');
                    $('#negeri_penjaga').val('');
                }
            }
        
            // Add event listeners for the checkboxes
            document.getElementById('alamat_bapa_sama').addEventListener('change', alamatBapa);
            document.getElementById('alamat_ibu_sama').addEventListener('change', alamatIbu);
            document.getElementById('alamat_penjaga_sama').addEventListener('change', alamatPenjaga);
        });
    </script>    
</body>     
@endsection