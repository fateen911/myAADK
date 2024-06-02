@extends('layouts._default')

@section('content')
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
    </style>
</head>

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
                                    <input type="text" class="form-control form-control-solid readonly-input" id="nama" name="nama" value="{{$klien->nama}}" readonly/>
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
                                    <input type="text" class="form-control form-control-solid readonly-input" maxlength="12" id="no_kp" name="no_kp" value="{{$klien->no_kp}}" readonly/>
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
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nombor Telefon</span>
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
                                        <span class="required">Jantina</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <input type="text" class="form-control form-control-solid" id="jantina" name="jantina" value="{{$klien->jantina}}" readonly/>
                                        <!--begin::Select2-->
                                        {{-- <select class="form-select form-select-solid" id="jantina" name="jantina" data-control="select2" data-hide-search="true" disabled>
                                            <option>Pilih Jantina</option>
                                            <option value="LELAKI" {{ $klien->jantina == 'LELAKI' ? 'selected' : '' }}>LELAKI</option>
                                            <option value="PEREMPUAN" {{ $klien->jantina == 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN</option>
                                        </select> --}}
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
                                        <span class="required">Agama</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <input type="text" class="form-control form-control-solid" id="agama" name="agama" value="{{$klien->agama}}" readonly/>
                                        <!--begin::Select2-->
                                        {{-- <select class="form-select form-select-solid" id="agama" name="agama" data-control="select2" data-hide-search="true" data-placeholder="Pilih agama" disabled>
                                            <option>Pilih Agama</option>
                                            <option value="ISLAM" {{ $klien->agama == 'ISLAM' ? 'selected' : '' }}>ISLAM</option>
                                            <option value="CINA" {{ $klien->agama == 'CINA' ? 'selected' : '' }}>CINA</option>
                                            <option value="INDIA" {{ $klien->agama == 'INDIA' ? 'selected' : '' }}>INDIA</option>
                                            <option value="KRISTIAN" {{ $klien->agama == 'KRISTIAN' ? 'selected' : '' }}>KRISTIAN</option>
                                            <option value="BUDHA" {{ $klien->agama == 'BUDHA' ? 'selected' : '' }}>BUDHA</option>
                                            <option value="SIKH" {{ $klien->agama == 'SIKH' ? 'selected' : '' }}>SIKH</option>
                                            <option value="LAIN-LAIN" {{ $klien->agama == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                        </select> --}}
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
                                        <span class="required">Bangsa</span>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-7">
                                    <div class="w-100">
                                        <input type="text" class="form-control form-control-solid" id="bangsa" name="bangsa" value="{{$klien->bangsa}}" readonly/>
                                        <!--begin::Select2-->
                                        {{-- <select class="form-select form-select-solid" id="bangsa" name="bangsa" data-control="select2" data-hide-search="true" data-placeholder="Pilih bangsa" disabled>
                                            <option>Pilih Bangsa</option>
                                            <option value="MELAYU" {{ $klien->bangsa == 'MELAYU' ? 'selected' : '' }}>MELAYU</option>
                                            <option value="CINA" {{ $klien->bangsa == 'CINA' ? 'selected' : '' }}>CINA</option>
                                            <option value="INDIA" {{ $klien->bangsa == 'INDIA' ? 'selected' : '' }}>INDIA</option>
                                            <option value="KRISTIAN" {{ $klien->bangsa == 'KRISTIAN' ? 'selected' : '' }}>KRISTIAN</option>
                                            <option value="BUDHA" {{ $klien->bangsa == 'BUDHA' ? 'selected' : '' }}>BUDHA</option>
                                        </select> --}}
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
                                        @if($updateRequestKlien)
                                            <button type="button" class="btn btn-secondary" id="luluskanPermohonanKlien" style="background-color:darkblue; color: white;">Luluskan Permohonan Kemaskini</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal-->
                        <div class="modal fade" id="luluskanPermohonanKlien" tabindex="-1" aria-labelledby="luluskanPermohonanKlienLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="luluskanPermohonanKlienLabel">Maklumat Kemaskini</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Nama: <span id="modalNama"></span></p>
                                        <p>No. KP: <span id="modalNoKP"></span></p>
                                        <p>Umur: <span id="modalUmur"></span></p>
                                        <p>No. Tel: <span id="modalNoTel"></span></p>
                                        <p>E-mel: <span id="modalEmel"></span></p>
                                        <p>Alamat Rumah: <span id="modalAlamatRumah"></span></p>
                                        <p>Poskod: <span id="modalPoskod"></span></p>
                                        <p>Daerah: <span id="modalDaerah"></span></p>
                                        <p>Negeri: <span id="modalNegeri"></span></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary">Luluskan</button>
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
                        <form method="post" id="kt_ecommerce_settings_general_store" class="form centered-form" action="{{ route('kemaskini.maklumat.rawatan.klien', ['id' => $klien->id]) }}">
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
                                    <input type="text" class="form-control form-control-solid" id="status_kesihatan_mental" name="status_kesihatan_mental" value="{{$rawatan->status_kesihatan_mental}}" readonly/>
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
                                    <input type="text" class="form-control form-control-solid" id="status_oku" name="status_oku" value="{{$rawatan->status_oku}}" readonly/>
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
                                    <input type="text" class="form-control form-control-solid" id="seksyen_okp" name="seksyen_okp" value="{{$rawatan->seksyen_okp}}" readonly/>
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
                                    <input type="date" class="form-control form-control-solid" id="tarikh_tamat_pengawasan" name="tarikh_tamat_pengawasan" value="{{$rawatan->tarikh_tamat_pengawasan}}" readonly/>
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
                                    <input type="number" class="form-control form-control-solid" id="skor_ccri" name="skor_ccri" value="{{$rawatan->skor_ccri}}" readonly/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <!--end::Input group-->

                             <!--begin::Action buttons-->
                             <div class="row py-5">
                                <div class="col-md-9 offset-md-4">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-3" id="kt_ecommerce_settings_save">Kemaskini</button>
                                        @if($updateRequestRawatan)
                                            <button type="button" class="btn btn-secondary" id="luluskanPermohonanRawatan" style="background-color:darkblue; color: white;">Luluskan Permohonan Kemaskini</button>
                                        @endif
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
                                {{-- @php
                                    dd($daerah);
                                @endphp --}}
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
                                        @if($updateRequestPekerjaan)
                                            <button type="button" class="btn btn-secondary" id="modalApprovalPekerjaan" style="background-color:darkblue; color: white;">Luluskan Permohonan Kemaskini</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Modal-->
                        <div class="modal fade" id="approvalModalPekerjaan" tabindex="-1" aria-labelledby="luluskanPermohonanPekerjaanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="luluskanPermohonanPekerjaanLabel">Luluskan Permintaan Kemaskini Maklumat Pekerjaan Klien</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('pegawai.approveUpdate', ['id' => $updateRequestPekerjaan->klien_id]) }}">
                                            @csrf
                                            @method('PATCH')
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Pekerjaan</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-solid" name="pekerjaan" value="{{ $requestedDataPekerjaan['pekerjaan'] }}" />
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Pendapatan (RM)</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-solid" name="pendapatan" value="{{ $requestedDataPekerjaan['pendapatan'] }}" />
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Bidang Pekerjaan</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-solid" name="bidang_kerja" value="{{ $requestedDataPekerjaan['bidang_kerja'] }}" />
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Alamat Tempat Kerja</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <textarea class="form-control form-control-solid" name="alamat_kerja">{{ $requestedDataPekerjaan['alamat_kerja'] }}</textarea>
                                                </div>
                                            </div>
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Poskod Tempat Keja</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control form-control-solid" name="poskod_kerja" value="{{ $requestedDataPekerjaan['poskod_kerja'] }}" />
                                                </div>
                                            </div>
                                            <!--begin::Input group-->
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span class="required">Daerah Tempat Kerja</span>
                                                    </label>
                                                    <!--end::Label-->
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="w-100">
                                                        <!--begin::Select2-->
                                                        <select class="form-select form-select-solid" id="daerah_kerja" name="daerah_kerja" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Daerah Kerja</option>
                                                            @foreach ($daerahKerja as $item)
                                                                <option value="{{ $item->id }}" {{ $requestedDataPekerjaan['daerah_kerja'] == $item->id ? 'selected' : '' }}>{{ $item->daerah_kerja }}</option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Select2-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                             <!--begin::Input group-->
                                             <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span class="required">Negeri Kerja</span>
                                                    </label>
                                                    <!--end::Label-->
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="w-100">
                                                        <!--begin::Select2-->
                                                        <select class="form-select form-select-solid" id="negeri_kerja" name="negeri_kerja" data-control="select2" data-hide-search="true">
                                                            <option>Pilih Negeri Kerja</option>
                                                            @foreach ($negeriKerja as $item)
                                                                <option value="{{ $item->id }}" {{ $requestedDataPekerjaan['negeri_kerja'] == $item->id ? 'selected' : '' }}>{{ $item->negeri_kerja }}</option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Select2-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span class="required">Nama Majikan</span>
                                                    </label>
                                                    <!--end::Label-->
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="w-100">
                                                        <input type="text" class="form-control form-control-solid" name="nama_majikan" value="{{ $requestedDataPekerjaan['nama_majikan'] }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold form-label mt-3">
                                                        <span class="required">No Telefon Majikan</span>
                                                    </label>
                                                    <!--end::Label-->
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="w-100">
                                                        <input type="text" class="form-control form-control-solid" name="no_tel_majikan" value="{{ $requestedDataPekerjaan['no_tel_majikan'] }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                    
                                            <div class="row fv-row mb-7">
                                                <div class="col-md-5 text-md-start">
                                                    <label class="fs-6 fw-semibold form-label mt-3">Status Maklumat Kemaskini</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <select class="form-select form-select-solid" name="status">
                                                        <option value="Lulus" {{ $updateRequestPekerjaan->status == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                                                        <option value="Ditolak" {{ $updateRequestPekerjaan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                    </select>
                                                </div>
                                            </div>
                                    
                                            <div class="row py-5">
                                                <div class="col-md-9 offset-md-3">
                                                    <div class="d-flex">
                                                        <button type="reset" class="btn btn-light me-3">Ditolak</button>
                                                        <button type="button" class="btn btn-primary">Luluskan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Simpan</span>
                                            <span class="indicator-progress">Sila tunggu...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <!--end::Modal-->
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane-->
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
                                        @if($updateRequestWaris)
                                            <button type="button" class="btn btn-secondary" id="luluskanPermohonanWaris" style="background-color:darkblue; color: white;">Luluskan Permohonan Kemaskini</button>
                                        @endif
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
                                        @if($updateRequestPasangan)
                                            <button type="button" class="btn btn-secondary" id="luluskanPermohonanPasangan" style="background-color:darkblue; color: white;">Luluskan Permohonan Kemaskini</button>
                                        @endif
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
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        calculateAgeFromIC();
    });
</script>

<!--begin::Script-->
<script>
    document.getElementById('luluskanPermohonanKlienButton').addEventListener('click', function() {
        document.getElementById('modalNama').innerText = document.getElementById('nama').value;
        document.getElementById('modalNoKP').innerText = document.getElementById('no_kp').value;
        document.getElementById('modalUmur').innerText = document.getElementById('umur').value;
        document.getElementById('modalNoTel').innerText = document.getElementById('no_tel').value;
        document.getElementById('modalEmel').innerText = document.getElementById('emel').value;
        document.getElementById('modalAlamatRumah').innerText = document.getElementById('alamat_rumah').value;
        document.getElementById('modalPoskod').innerText = document.getElementById('poskod').value;
        document.getElementById('modalDaerah').innerText = document.getElementById('daerah').options[document.getElementById('daerah').selectedIndex].text;
        document.getElementById('modalNegeri').innerText = document.getElementById('negeri').options[document.getElementById('negeri').selectedIndex].text;
        var modal = new bootstrap.Modal(document.getElementById('luluskanPermohonanKlien'));
        modal.show();
    });
</script>

<script>
    document.getElementById('modalApprovalPekerjaan').addEventListener('click', function() {
        // document.getElementById('modalNama').innerText = document.getElementById('nama').value;
        // document.getElementById('modalNoKP').innerText = document.getElementById('no_kp').value;
        // document.getElementById('modalUmur').innerText = document.getElementById('umur').value;
        // document.getElementById('modalNoTel').innerText = document.getElementById('no_tel').value;
        // document.getElementById('modalEmel').innerText = document.getElementById('emel').value;
        // document.getElementById('modalAlamatRumah').innerText = document.getElementById('alamat_rumah').value;
        // document.getElementById('modalPoskod').innerText = document.getElementById('poskod').value;
        // document.getElementById('modalDaerah').innerText = document.getElementById('daerah').options[document.getElementById('daerah').selectedIndex].text;
        // document.getElementById('modalNegeri').innerText = document.getElementById('negeri').options[document.getElementById('negeri').selectedIndex].text;
        var modal = new bootstrap.Modal(document.getElementById('approvalModalPekerjaan'));
        modal.show();
    });
</script>
<!--end::Script-->
@endsection