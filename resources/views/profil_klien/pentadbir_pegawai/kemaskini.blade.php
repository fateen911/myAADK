@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
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
            padding-left: 100px; /* Add some padding for better appearance */
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
    
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="card card-flush">
            <!--begin::Card body-->
            <div class="card-body">
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
                            <i class="ki-duotone ki-profile-user fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>Maklumat Keluarga
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
                            </i>Maklumat Pasangan
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
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_products">
                            <i class="ki-duotone ki-pulse fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Maklumat Rawatan
                        </a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->

                
                <!--begin:::Tab content-->
                <div class="tab-content" id="myTabContent">
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="kt_ecommerce_settings_general_form" class="form centered-form" action="{{ route('kemaskini.maklumat.peribadi.klien', ['id' => $klien->id]) }}">
                        @csrf
                            <!--begin::Heading-->
                            <div class="row mb-7">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Kemaskini Maklumat Peribadi</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                            
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nama Penuh</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <span id="nama" class="fs-6 form-control-plaintext">:{{$klien->nama}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nombor Kad Pengenalan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-2">
                                    <!--begin::Input-->
                                    <span id="no_kp" class="fs-6 form-control-plaintext">:{{$klien->no_kp}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Umur</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <span id="umur" class="fs-6 form-control-plaintext"></span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row fv-row mb-2">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Jantina</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <span id="jantina" class="fs-6 form-control-plaintext">:{{$klien->jantina}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Agama</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <span id="agama" class="fs-6 form-control-plaintext">:{{$klien->agama}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-2">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Bangsa</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <span id="bangsa" class="fs-6 form-control-plaintext">:{{$klien->bangsa}}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
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
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" maxlength="11" id="no_tel" name="no_tel" value="{{$klien->no_tel}}"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Alamat E-mel</span>
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
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="emel" name="emel" value="{{$klien->emel}}"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Alamat Rumah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid" id="alamat_rumah" name="alamat_rumah">{{$klien->alamat_rumah}}</textarea>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Poskod</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod" name="poskod" placeholder="" value="{{$klien->poskod}}" />
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
                                        <span class="required">Daerah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="daerah" name="daerah" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
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
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Negeri</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="negeri" name="negeri" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
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
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Tahap Pendidikan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                            
                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-9 offset-md-3">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
                                        @if($requestKlien)
                                            <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalPeribadiKlien" data-target="#approvalPeribadiKlien" style="background-color:darkblue; color: white;">
                                                Luluskan Permohonan Kemaskini
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
                                        <h5 class="modal-title" id="luluskanPermohonanPeribadiKlienLabel">Luluskan Permintaan Kemaskini Maklumat Peribadi Klien</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('approve.update.klien', ['id' => $updateRequestKlien->klien_id]) }}">
                                            @csrf
                                            @method('PATCH')

                                            @php
                                                $daerahRumahKlien = DB::table('senarai_daerah')->where('id', $requestedDataKlien['daerah'])->value('senarai_daerah.daerah');
                                                $negeriRumahKlien = DB::table('senarai_negeri')->where('id', $requestedDataKlien['negeri'])->value('senarai_negeri.negeri');
                                            @endphp
                                    
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="nama" class="fs-6 form-control-plaintext">:{{$klien->nama}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">No Kad Pengenalan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="no_kp" class="fs-6 form-control-plaintext">:{{$klien->no_kp}}</span>
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
                                                    <span id="jantina" class="fs-6 form-control-plaintext">:{{$klien->jantina}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Agama</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="agama" class="fs-6 form-control-plaintext">:{{$klien->agama}}</span>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-2">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Bangsa</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span id="bangsa" class="fs-6 form-control-plaintext">:{{$klien->bangsa}}</span>
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
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Alamat Emel
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
                                                    <input type="text" class="form-control form-control-solid" name="emel" value="{{ $requestedDataKlien['emel'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Alamat Rumah</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control form-control-solid" name="alamat_rumah" readonly>{{ $requestedDataKlien['alamat_rumah'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Poskod</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="poskod" value="{{ $requestedDataKlien['poskod'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Daerah</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $daerahRumahKlien }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Negeri</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $negeriRumahKlien }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3 required">Tahap Pendidikan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="tahap_pendidikan" value="{{ $requestedDataKlien['tahap_pendidikan'] }}" readonly />
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
                                <div class="col-md-9 offset-md-4">
                                    <h2>Kemaskini Maklumat Rawatan</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                           
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Status Kesihatan Mental</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <span id="status_kesihatan_mental" class="fs-6 form-control-plaintext">:{{$rawatan->status_kesihatan_mental}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Status Orang Kurang Upaya (OKU)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <span id="status_oku" class="fs-6 form-control-plaintext">:{{$rawatan->status_oku}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Seksyen OKP (Perintah/Sukarela)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <span id="seksyen_okp" class="fs-6 form-control-plaintext">:{{$rawatan->seksyen_okp}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Tarikh Tamat Rawatan dan Pemulihan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    @php
                                        $formattedDate = Carbon::parse($rawatan->tarikh_tamat_pengawasan)->format('d-m-Y');
                                    @endphp
                                    <span id="tarikh_tamat_pengawasan" class="fs-6 form-control-plaintext">:{{$formattedDate}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-4">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Skor CCRI</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <span id="skor_ccri" class="fs-6 form-control-plaintext">:{{$rawatan->skor_ccri}}</span>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->

                             <!--begin::Action buttons-->
                             <div class="row py-5">
                                <div class="col-md-9 offset-md-4">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
                                        {{-- @if($requestRawatan)
                                            <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalRawatan" data-target="#approvalRawatan" style="background-color:darkblue; color: white;">
                                                Luluskan Permohonan Kemaskini
                                            </button>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
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
                        </div>                                                 --}}
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
                                        <span class="required">Pekerjaan</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Jawatan pekerjaan / Status pekerjaan">
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
                                    <input type="text" class="form-control form-control-solid" id="pekerjaan" name="pekerjaan" value="{{$pekerjaan->pekerjaan}}" />
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Pendapatan (RM)</span>
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
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="number" class="form-control form-control-solid" id="pendapatan" name="pendapatan" value="{{$pekerjaan->pendapatan}}" />
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Bidang Perkerjaan </span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="bidang_kerja" name="bidang_kerja" value="{{$pekerjaan->bidang_kerja}}" />
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Alamat Tempat Bekerja</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                                <div class="col-md-7">
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
                                        <span>Daerah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                             <!--begin::Input group-->
                             <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Negeri Tempat Bekerja</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                                        <span>Nama Majikan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="no_tel_majikan" name="no_tel_majikan" value="{{$pekerjaan->no_tel_majikan}}" maxlength="11"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-9 offset-md-3">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
                                        @if($requestPekerjaan)
                                            <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalPekerjaan" data-target="#approvalPekerjaan" style="background-color:darkblue; color: white;">
                                                Luluskan Permohonan Kemaskini
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
                                        <h5 class="modal-title" id="luluskanPermohonanPekerjaanLabel">Luluskan Permintaan Kemaskini Maklumat Pekerjaan Klien</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('approve.update.pekerjaan', ['id' => $updateRequestPekerjaan->klien_id]) }}">
                                            @csrf
                                            @method('PATCH')

                                            @php
                                                $daerahKerja = DB::table('senarai_daerah')->where('id', $requestedDataPekerjaan['daerah_kerja'])->value('senarai_daerah.daerah');
                                                $negeriKerja = DB::table('senarai_negeri')->where('id', $requestedDataPekerjaan['negeri_kerja'])->value('senarai_negeri.negeri');
                                            @endphp
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Pekerjaan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="pekerjaan" value="{{ $requestedDataPekerjaan['pekerjaan'] }}" readonly />
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Pendapatan (RM)</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="pendapatan" value="{{ $requestedDataPekerjaan['pendapatan'] }}" readonly />
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Bidang Pekerjaan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="bidang_kerja" value="{{ $requestedDataPekerjaan['bidang_kerja'] }}" readonly />
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Tempat Kerja</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control form-control-solid" name="alamat_kerja" readonly>{{ $requestedDataPekerjaan['alamat_kerja'] }}</textarea>
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Poskod Tempat Kerja</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="poskod_kerja" value="{{ $requestedDataPekerjaan['poskod_kerja'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Daerah Tempat Kerja</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $daerahKerja }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Negeri Kerja</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $negeriKerja }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama Majikan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="nama_majikan" value="{{ $requestedDataPekerjaan['nama_majikan'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">No Telefon Majikan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="no_tel_majikan" value="{{ $requestedDataPekerjaan['no_tel_majikan'] }}" readonly />
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
                        </div>                                                
                        <!--end::Modal-->
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Waris-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_localization" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="kt_ecommerce_settings_general_form" class="form centered-form" action="{{ route('kemaskini.maklumat.waris.klien', ['id' => $klien->id]) }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="row mb-7">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Kemaskini Maklumat Waris</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                            
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Hubungan Waris</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <select id="hubungan_waris" name="hubungan_waris" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih">
                                        <option>Pilih hubungan waris</option>
                                        <option value="IBU" {{ $waris->hubungan_waris == 'IBU' ? 'selected' : '' }}>IBU</option>
                                        <option value="BAPA" {{ $waris->hubungan_waris == 'BAPA' ? 'selected' : '' }}>BAPA</option>
                                        <option value="PENJAGA" {{ $waris->hubungan_waris == 'PENJAGA' ? 'selected' : '' }}>PENJAGA</option>
                                        <option value="SAUDARA KANDUNG" {{ $waris->hubungan_waris == 'SAUDARA KANDUNG' ? 'selected' : '' }}>SAUDARA KANDUNG</option>
                                        <option value="LAIN-LAIN" {{ $waris->hubungan_waris == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                    </select>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nama Waris</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="nama_waris" name="nama_waris" value="{{$waris->nama_waris}}" />
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nombor Telefon Waris</span>
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
                                    <input type="text" class="form-control form-control-solid" id="no_tel_waris" name="no_tel_waris" value="{{$waris->no_tel_waris}}" maxlength="11"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Alamat Waris</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid" id="alamat_waris" name="alamat_waris">{{$waris->alamat_waris}}</textarea>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Poskod</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_waris" name="poskod_waris" value="{{$waris->poskod_waris}}" />
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
                                        <span class="required">Daerah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="daerah_waris" name="daerah_waris" data-control="select2" data-hide-search="true" data-placeholder="Pilih daerah">
                                            <option>Pilih daerah</option>
                                            @foreach ($daerahWaris as $daerahW)
                                                <option value="{{ $daerahW->id }}" {{ $waris->daerah_waris == $daerahW->id ? 'selected' : '' }}>{{ $daerahW->daerah }}</option>
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
                                        <span class="required">Negeri</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="negeri_waris" name="negeri_waris" data-control="select2" data-hide-search="true" data-placeholder="Pilih negeri">
                                            <option>Pilih negeri</option>
                                            @foreach ($negeriWaris as $negeriW)
                                                <option value="{{ $negeriW->id }}" {{ $waris->negeri_waris == $negeriW->id ? 'selected' : '' }}>{{ $negeriW->negeri }}</option>
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
                                        @if($requestWaris)
                                            <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalWaris" data-target="#approvalWaris" style="background-color:darkblue; color: white;">
                                                Luluskan Permohonan Kemaskini
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal Waris-->
                        <div class="modal fade" id="approvalWaris" tabindex="-1" aria-labelledby="luluskanPermohonanWarisLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="luluskanPermohonanWarisLabel">Luluskan Permintaan Kemaskini Maklumat Waris Klien</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('approve.update.waris', ['id' => $updateRequestWaris->klien_id]) }}">
                                            @csrf
                                            @method('PATCH')

                                            @php
                                                $daerahWaris = DB::table('senarai_daerah')->where('id', $requestedDataWaris['daerah_waris'])->value('senarai_daerah.daerah');
                                                $negeriWaris = DB::table('senarai_negeri')->where('id', $requestedDataWaris['negeri_waris'])->value('senarai_negeri.negeri');
                                            @endphp
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Hubungan Waris</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="hubungan_waris" value="{{ $requestedDataWaris['hubungan_waris'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama Waris</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="nama_waris" value="{{ $requestedDataWaris['nama_waris'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon Waris</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="no_tel_waris" value="{{ $requestedDataWaris['no_tel_waris'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah Waris</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control form-control-solid" name="alamat_waris" readonly>{{ $requestedDataWaris['alamat_waris'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="poskod_waris" value="{{ $requestedDataWaris['poskod_waris'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $daerahWaris }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $negeriWaris }}" readonly />
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
                        </div>                                                
                        <!--end::Modal-->
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane Pasangan-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                        <!--begin::Form-->
                        <form method="post" id="kt_ecommerce_settings_general_products"  class="form centered-form" action="{{ route('kemaskini.maklumat.pasangan.klien', ['id' => $klien->id]) }}">
                            <!--begin::Heading-->
                            <div class="row mb-7">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Kemaskini Maklumat Pasangan</h2>
                                </div>
                            </div>
                            <!--end::Heading-->

                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Status Perkahwinan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="d-flex mt-3">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="status_perkahwinan" name="status_perkahwinan" data-control="select2" data-hide-search="true">
                                            <option>Status Perkahwinan</option>
                                            <option value="BUJANG" {{ $pasangan->status_perkahwinan == 'BUJANG' ? 'selected' : '' }}>BUJANG</option>
                                            <option value="BERKAHWIN" {{ $pasangan->status_perkahwinan == 'BERKAHWIN' ? 'selected' : '' }}>BERKAHWIN</option>
                                            <option value="BERCERAI" {{ $pasangan->status_perkahwinan == 'BERCERAI' ? 'selected' : '' }}>BERCERAI</option>
                                            <option value="JANDA" {{ $pasangan->status_perkahwinan == 'JANDA' ? 'selected' : '' }}>JANDA</option>
                                            <option value="DUDA" {{ $pasangan->status_perkahwinan == 'DUDA' ? 'selected' : '' }}>DUDA</option>
                                        </select>
                                        <!--end::Select2-->

                                        <!--begin::Radio-->
                                        {{-- <div class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="radio" value="" name="category_product_count" id="category_product_count_yes" checked="checked" />
                                            <label class="form-check-label" for="category_product_count_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="" name="category_product_count" id="category_product_count_no" />
                                            <label class="form-check-label" for="category_product_count_no">No</label>
                                        </div> --}}
                                        <!--end::Radio-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Nama Pasangan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="nama_pasangan" name="nama_pasangan" value="{{$pasangan->nama_pasangan}}" />
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
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
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="no_tel_pasangan" name="no_tel_pasangan" value="{{$pasangan->no_tel_pasangan}}" maxlength="11"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Alamat Pasangan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid" id="alamat_pasangan" name="alamat_pasangan">{{$pasangan->alamat_pasangan}}</textarea>
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
                                <div class="col-md-7">
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
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Daerah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Negeri</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Alamat Tempat Pasangan Bekerja</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid" id="alamat_kerja_pasangan" name="alamat_kerja_pasangan">{{$pasangan->alamat_kerja_pasangan}}</textarea>
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
                                <div class="col-md-7">
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
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Daerah</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                             <!--begin::Input group-->
                             <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Negeri</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
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
                            
                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-9 offset-md-3">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
                                        @if($requestPasangan)
                                            <button type="button" class="btn btn-secondary modal-trigger" id="approvalModalPasangan" data-target="#approvalPasangan" style="background-color:darkblue; color: white;">
                                                Luluskan Permohonan Kemaskini
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
                                        <h5 class="modal-title" id="luluskanPermohonanPasanganLabel">Luluskan Permintaan Kemaskini Maklumat Pasangan Klien</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('approve.update.pasangan', ['id' => $updateRequestPasangan->klien_id]) }}">
                                            @csrf
                                            @method('PATCH')

                                            @php
                                                $daerahPasangan = DB::table('senarai_daerah')->where('id', $requestedDataPasangan['daerah_pasangan'])->value('senarai_daerah.daerah');
                                                $negeriPasangan = DB::table('senarai_negeri')->where('id', $requestedDataPasangan['negeri_pasangan'])->value('senarai_negeri.negeri');
                                                $daerahKerjaPasangan = DB::table('senarai_daerah')->where('id', $requestedDataPasangan['daerah_kerja_pasangan'])->value('senarai_daerah.daerah');
                                                $negeriKerjaPasangan = DB::table('senarai_negeri')->where('id', $requestedDataPasangan['negeri_kerja_pasangan'])->value('senarai_negeri.negeri');
                                            @endphp
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Status Perkahwinan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="status_perkahwinan" value="{{ $requestedDataPasangan['status_perkahwinan'] }}" readonly />
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama Pasangan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="nama_pasangan" value="{{ $requestedDataPasangan['nama_pasangan'] }}" readonly />
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon Pasangan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="no_tel_pasangan" value="{{ $requestedDataPasangan['no_tel_pasangan'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Pasangan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control form-control-solid" name="alamat_pasangan" readonly>{{ $requestedDataPasangan['alamat_pasangan'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" name="poskod_pasangan" value="{{ $requestedDataPasangan['poskod_pasangan'] }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $daerahPasangan }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $negeriPasangan }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Kerja Pasangan</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control form-control-solid" name="alamat_kerja_pasangan" readonly>{{ $requestedDataPasangan['alamat_kerja_pasangan'] }}</textarea>
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
                                                    <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $daerahKerjaPasangan }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-4 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Negeri Kerja</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control form-control-solid" value="{{ $negeriKerjaPasangan }}" readonly />
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

        document.getElementById('umur').textContent = `:${age}`; // Update the text content of the span
        document.getElementById('modal_umur').textContent = `:${age}`; 
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
</script>

@endsection