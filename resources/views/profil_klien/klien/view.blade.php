@extends('layouts._default')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
            padding-left: 120px; /* Add some padding for better appearance */
            box-sizing: border-box; /* Ensure padding doesn't increase form size */
            flex-direction: column;
            align-items: center; /* Center contents horizontally */
        }
    </style>
</head>

<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pengurusan</h1>
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
            <li class="breadcrumb-item text-muted">Lihat Profil Peribadi</li>
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
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_products">
                            <i class="ki-duotone ki-pulse fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Maklumat Rawatan
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
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_ecommerce_settings_store">
                            <i class="ki-duotone ki-profile-user fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Maklumat Pasangan</a>
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
                            </i>Maklumat Keluarga</a>
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
                            <div class="row mb-7">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Kemaskini Maklumat Peribadi</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                            
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nama Penuh</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid readonly-input" id="nama" name="nama" value="{{$butiranKlien->nama}}" readonly/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group--> 
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nombor Kad Pengenalan</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor kad pengenalan tanpa '-'">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
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
                                    <input type="text" class="form-control form-control-solid readonly-input" maxlength="12" id="no_kp" name="no_kp" value="{{$butiranKlien->no_kp}}" readonly/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Umur</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid readonly-input" id="umur" name="umur" readonly/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <label class="fs-6 fw-semibold form-label mt-3"><span class="required">Nombor Telefon</span></label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-solid" maxlength="11" id="no_tel" name="no_tel" value="{{ old('no_tel', $butiranKlien->no_tel) }}" readonly />
                                </div>
                            </div>
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Alamat E-mel</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan alamat emel yang aktif.">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
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
                                    <input type="text" class="form-control form-control-solid" id="emel" name="emel" value="{{$butiranKlien->emel}}" readonly/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Jantina</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <input type="text" class="form-control form-control-solid" id="jantina" name="jantina" value="{{$butiranKlien->jantina}}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Agama</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <input type="text" class="form-control form-control-solid" id="agama" name="agama" value="{{$butiranKlien->agama}}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-3 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Bangsa</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <input type="text" class="form-control form-control-solid" id="bangsa" name="bangsa" value="{{$butiranKlien->bangsa}}" readonly/>
                                    </div>
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
                                    <textarea class="form-control form-control-solid" id="alamat_rumah" name="alamat_rumah" disabled>{{$butiranKlien->alamat_rumah}}</textarea>
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
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod" name="poskod" placeholder="" value="{{$butiranKlien->poskod}}" readonly/>
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
                                        <select class="form-select form-select-solid" id="daerah" name="daerah" data-control="select2" data-hide-search="true" disabled>
                                            <option>Pilih Daerah</option>
                                            @foreach ($daerah as $item)
                                                <option value="{{ $item->id }}" {{ $butiranKlien->daerah == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
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
                                        <select class="form-select form-select-solid" id="negeri" name="negeri" data-control="select2" data-hide-search="true" disabled>
                                            <option>Pilih Negeri</option>
                                            @foreach ($negeri as $item)
                                                <option value="{{ $item->id }}" {{ $butiranKlien->negeri == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
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
                                        <input type="text" class="form-control form-control-solid" id="tahap_pendidikan" name="tahap_pendidikan" value="{{$butiranKlien->tahap_pendidikan}}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Action buttons-->
                            <div class="row py-5">
                                <div class="col-md-9 offset-md-3">
                                    <div class="d-flex">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-primary modal-trigger" id="requestModalPeribadiKlien" data-target="#requestPeribadiKlien">
                                            Mohon Kemaskini
                                        </button>
                                        <!--end::Button-->
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

                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nama</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="nama" name="nama" value="{{ $butiranKlien->nama }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">No Kad Pengenalan</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="no_kp" name="no_kp" value="{{ $butiranKlien->no_kp }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Umur</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="modal_umur" name="umur" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Nombor Telefon</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="no_tel" name="no_tel" value="{{ old('no_tel', $butiranKlien->no_tel) }}" />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Emel</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="emel" name="emel" value="{{ $butiranKlien->emel }}" />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Jantina</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="jantina" name="jantina" value="{{ $butiranKlien->jantina }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Agama</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="agama" name="agama" value="{{ $butiranKlien->agama }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Bangsa</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="bangsa" name="bangsa" value="{{ $butiranKlien->bangsa }}" readonly />
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Rumah</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <textarea class="form-control form-control-solid" id="alamat_rumah" name="alamat_rumah">{{ $butiranKlien->alamat_rumah }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Poskod</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control form-control-solid" id="poskod" name="poskod" value="{{ $butiranKlien->poskod }}"/>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Daerah</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-select form-select-solid" id="daerah" name="daerah" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Daerah</option>
                                                        @foreach ($daerah as $item)
                                                            <option value="{{ $item->id }}" {{ $butiranKlien->daerah == $item->id ? 'selected' : '' }}>{{ $item->daerah }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Negeri</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-select form-select-solid" id="negeri" name="negeri" data-control="select2" data-hide-search="true">
                                                        <option>Pilih Negeri</option>
                                                        @foreach ($negeri as $item)
                                                            <option value="{{ $item->id }}" {{ $butiranKlien->negeri == $item->id ? 'selected' : '' }}>{{ $item->negeri }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-3 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Tahap Pendidikan</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-select form-select-solid" id="tahap_pendidikan" name="tahap_pendidikan" data-control="select2" data-hide-search="true" >
                                                        <option>Pilih Tahap Pendidikan</option>
                                                        <option value="PENDIDIKAN RENDAH" {{ $butiranKlien->tahap_pendidikan == 'PENDIDIKAN RENDAH' ? 'selected' : '' }}>PENDIDIKAN RENDAH</option>
                                                        <option value="PENDIDIKAN MENENGAH" {{ $butiranKlien->tahap_pendidikan == 'PENDIDIKAN MENENGAH' ? 'selected' : '' }}>PENDIDIKAN MENENGAH</option>
                                                        <option value="PENGAJIAN TINGGI" {{ $butiranKlien->tahap_pendidikan == 'PENGAJIAN TINGGI' ? 'selected' : '' }}>PENGAJIAN TINGGI</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3"></label>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="d-flex">
                                                        <button type="submit" class="btn btn-primary text-center">Simpan</button>
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


                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_products" role="tabpanel">
                        <!--begin::Form-->
                        <form method="POST" id="kt_ecommerce_settings_general_form" class="form centered-form" action="{{ route('rawatanKlien.requestUpdate') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="row mb-7">
                                <div class="col-md-9 offset-md-4">
                                    <h2>Kemaskini Maklumat Rawatan</h2>
                                </div>
                            </div>
                            <!--end::Heading-->
                           
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Status Kesihatan Mental</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="status_kesihatan_mental" name="status_kesihatan_mental" value="{{$butiranKlien->status_kesihatan_mental}}"/>
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
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="status_oku" name="status_oku" value="{{$butiranKlien->status_oku}}"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Seksyen OKP (Perintah/Sukarela)</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="seksyen_okp" name="seksyen_okp" value="{{$butiranKlien->seksyen_okp}}" readonly/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Tarikh Tamat Program Rawatan dan Pemulihan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <input type="date" class="form-control form-control-solid" id="tarikh_tamat_pengawasan" name="tarikh_tamat_pengawasan" value="{{$butiranKlien->tarikh_tamat_pengawasan}}" readonly/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <div class="col-md-4 text-md-start">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Skor CCRI</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Input-->
                                    <input type="number" class="form-control form-control-solid" id="skor_ccri" name="skor_ccri" step="0.01" value="{{$butiranKlien->skor_ccri}}"  required />
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->

                             <!--begin::Action buttons-->
                             <div class="row py-5">
                                <div class="col-md-6 offset-md-4">
                                    <div class="d-flex">
                                        <!--begin::Button-->
                                        <button type="submit" class="btn btn-primary">Mohon Kemaskini</button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_customers" role="tabpanel">
                        <!--begin::Form-->
                        <form method="POST" id="kt_ecommerce_settings_general_form" class="form centered-form" action="{{ route('pekerjaanKlien.requestUpdate') }}">
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
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
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
                                    <input type="text" class="form-control form-control-solid" id="pekerjaan" name="pekerjaan" value="{{$butiranKlien->pekerjaan}}"/>
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
                                    <input type="text" class="form-control form-control-solid" id="bidang_kerja" name="bidang_kerja" value="{{$butiranKlien->bidang_kerja}}"/>
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
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
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
                                    <input type="number" class="form-control form-control-solid" id="pendapatan" name="pendapatan" value="{{$butiranKlien->pendapatan}}"/>
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
                                    <textarea class="form-control form-control-solid" id="alamat_kerja" name="alamat_kerja">{{$butiranKlien->alamat_kerja}}</textarea>
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
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_kerja" name="poskod_kerja" value="{{$butiranKlien->poskod_kerja}}"/>
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
                                {{-- @php
                                    dd($daerah);
                                @endphp --}}
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="daerah_kerja" name="daerah_kerja" data-control="select2">
                                            <option>Pilih Daerah</option>
                                            @foreach ($daerahKerja as $daerahK)
                                                <option value="{{ $daerahK->id }}" {{ $butiranKlien->daerah_kerja == $daerahK->id ? 'selected' : '' }}>{{ $daerahK->daerah }}</option>
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
                                        <select class="form-select form-select-solid" id="negeri_kerja" name="negeri_kerja" data-control="select2" data-hide-search="true">
                                            <option>Pilih Negeri</option>
                                            @foreach ($negeriKerja as $negeriK)
                                                <option value="{{ $negeriK->id }}" {{ $butiranKlien->negeri_kerja == $negeriK->id ? 'selected' : '' }}>{{ $negeriK->negeri }}</option>
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
                                    <input type="text" class="form-control form-control-solid" id="nama_majikan" name="nama_majikan" value="{{$butiranKlien->nama_majikan}}"/>
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
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
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
                                    <input type="text" class="form-control form-control-solid" id="no_tel_majikan" name="no_tel_majikan" value="{{$butiranKlien->no_tel_majikan}}" maxlength="11"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->

                             <!--begin::Action buttons-->
                             <div class="row py-5">
                                <div class="col-md-9 offset-md-3">
                                    <div class="d-flex">
                                        <!--begin::Button-->
                                        <button type="submit" class="btn btn-primary">Mohon Kemaskini</button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_localization" role="tabpanel">
                        <!--begin::Form-->
                        <form method="POST" id="kt_ecommerce_settings_general_form" class="form centered-form" action="{{ route('warisKlien.requestUpdate') }}">
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
                                    <input type="text" class="form-control form-control-solid" id="nama_waris" name="nama_waris" value="{{$butiranKlien->nama_waris}}"/>
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
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
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
                                    <input type="text" class="form-control form-control-solid" id="no_tel_waris" name="no_tel_waris" value="{{$butiranKlien->no_tel_waris}}" maxlength="11"/>
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
                                    <textarea class="form-control form-control-solid" id="alamat_waris" name="alamat_waris">{{$butiranKlien->alamat_waris}}</textarea>
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
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_waris" name="poskod_waris" value="{{$butiranKlien->poskod_waris}}"/>
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
                                        <select class="form-select form-select-solid" id="daerah_waris" name="daerah_waris" data-control="select2" data-hide-search="true">
                                            <option>Pilih Daerah</option>
                                            @foreach ($daerahWaris as $daerahW)
                                                <option value="{{ $daerahW->id }}" {{ $butiranKlien->daerah_waris == $daerahW->id ? 'selected' : '' }}>{{ $daerahW->daerah }}</option>
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
                                        <select class="form-select form-select-solid" id="negeri_waris" name="negeri_waris" data-control="select2" data-hide-search="true">
                                            <option>Pilih Negeri</option>
                                            @foreach ($negeriWaris as $negeriW)
                                                <option value="{{ $negeriW->id }}" {{ $butiranKlien->negeri_waris == $negeriW->id ? 'selected' : '' }}>{{ $negeriW->negeri }}</option>
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
                                        <!--begin::Button-->
                                        <button type="submit" class="btn btn-primary">Mohon Kemaskini</button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                        <!--begin::Form-->
                        <form method="POST" id="kt_ecommerce_settings_general_form" class="form centered-form" action="{{ route('pasanganKlien.requestUpdate') }}">
                            @csrf
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
                                            <option value="BUJANG" {{ $butiranKlien->status_perkahwinan == 'BUJANG' ? 'selected' : '' }}>BUJANG</option>
                                            <option value="BERKAHWIN" {{ $butiranKlien->status_perkahwinan == 'BERKAHWIN' ? 'selected' : '' }}>BERKAHWIN</option>
                                            <option value="BERCERAI" {{ $butiranKlien->status_perkahwinan == 'BERCERAI' ? 'selected' : '' }}>BERCERAI</option>
                                            <option value="JANDA" {{ $butiranKlien->status_perkahwinan == 'JANDA' ? 'selected' : '' }}>JANDA</option>
                                            <option value="DUDA" {{ $butiranKlien->status_perkahwinan == 'DUDA' ? 'selected' : '' }}>DUDA</option>
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
                                        <span>Nama Pasangan</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" id="nama_pasangan" name="nama_pasangan" value="{{$butiranKlien->nama_pasangan}}"/>
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
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
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
                                    <input type="text" class="form-control form-control-solid" id="no_tel_pasangan" name="no_tel_pasangan" value="{{$butiranKlien->no_tel_pasangan}}" maxlength="11"/>
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
                                    <textarea class="form-control form-control-solid" id="alamat_pasangan" name="alamat_pasangan">{{$butiranKlien->alamat_pasangan}}</textarea>
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
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_pasangan" name="poskod_pasangan" value="{{$butiranKlien->poskod_pasangan}}"/>
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
                                        <select class="form-select form-select-solid" id="daerah_pasangan" name="daerah_pasangan" data-control="select2" data-hide-search="true">
                                            <option>Pilih Daerah</option>
                                            @foreach ($daerahPasangan as $daerahP)
                                                <option value="{{ $daerahP->id }}" {{ $butiranKlien->daerah_pasangan == $daerahP->id ? 'selected' : '' }}>{{ $daerahP->daerah }}</option>
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
                                        <select class="form-select form-select-solid" id="negeri_pasangan" name="negeri_pasangan" data-control="select2" data-hide-search="true">
                                            <option>Pilih Negeri</option>
                                            @foreach ($negeriPasangan as $negeriP)
                                                <option value="{{ $negeriP->id }}" {{ $butiranKlien->negeri_pasangan == $negeriP->id ? 'selected' : '' }}>{{ $negeriP->negeri }}</option>
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
                                    <textarea class="form-control form-control-solid" id="alamat_kerja_pasangan" name="alamat_kerja_pasangan">{{$butiranKlien->alamat_kerja_pasangan}}</textarea>
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
                                        <input type="text" maxlength="5" class="form-control form-control-solid" id="poskod_kerja_pasangan" name="poskod_kerja_pasangan" value="{{$butiranKlien->poskod_kerja_pasangan}}"/>
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
                                        <select class="form-select form-select-solid" id="daerah_kerja_pasangan" name="daerah_kerja_pasangan" data-control="select2" data-hide-search="true">
                                            <option>Pilih Daerah</option>
                                            @foreach ($daerahKerjaPasangan as $daerahKP)    
                                                <option value="{{ $daerahKP->id }}" {{ $butiranKlien->daerah_kerja_pasangan == $daerahKP->id ? 'selected' : '' }}>{{ $daerahKP->daerah }}</option>
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
                                        <select class="form-select form-select-solid" id="negeri_kerja_pasangan" name="negeri_kerja_pasangan" data-control="select2" data-hide-search="true">
                                            <option>Pilih Negeri</option>
                                            @foreach ($negeriKerjaPasangan as $negeriKP)
                                                <option value="{{ $negeriKP->id }}" {{ $butiranKlien->negeri_kerja_pasangan == $negeriKP->id ? 'selected' : '' }}>{{ $negeriKP->negeri }}</option>
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
                                        <!--begin::Button-->
                                        <button type="submit" class="btn btn-primary">Mohon Kemaskini</button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
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
        const icNumber = document.getElementById('no_kp').value;
        if (icNumber.length !== 12) {
            alert("Nombor Kad Pengenalan harus mempunyai 12 digit.");
            return;
        }

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

        document.getElementById('umur').value = age;
        document.getElementById('modal_umur').value = age;
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
@endsection