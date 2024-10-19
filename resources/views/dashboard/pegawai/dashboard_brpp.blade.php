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

    <style>
        /* Base styles for all tabs */
		.nav-tabs .nav-item {
			margin-bottom: -1px; /* Prevent bottom margin */
		}

		.nav-link {
			font-size: 16px !important;
			color: #6c757d !important; 
			background-color: none;
			border: 1px solid transparent; 
			padding: 10px 15px;
			font-family: 'Poppins', sans-serif;
		}

		/* Inactive tabs (flat) */
		.nav-link {
			background-color: transparent;
			color: gray;
			border: none;
			border-bottom: 2px solid transparent;
		}

		/* Active tab with color and shadow */
		.nav-link.active {
			color: darkslateblue !important;
    		box-shadow: 0 -4px 12px rgba(0, 123, 255, 0.2); 
			background-color: whitesmoke !important; /* Light blue background for active tab */
			color: #8800ff; /* Bold blue font for active tab */
			border-bottom: 2px solid darkslateblue !important; /* Blue underline for active tab */
			font-weight: bold; /* Make font bold */
			border-radius: 4px 4px 0 0; /* Slight rounding at top of active tab */
		}

		/* Add hover effect to inactive tabs */
		.nav-link:hover {
			border-bottom: 2px solid lightgray;
			color: #007bff;
		}

		/* Remove default border */
		.nav-tabs {
			border-bottom: 2px solid lightgray; /* Bottom border for tab container */
		}
    </style>
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
        <li class="breadcrumb-item text-muted">Laman Utama</li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Pegawai Ibu Pejabat AADK</li>
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
                    <!--Keseluruhan-->
                    <div class="header pt-5 mb-5">
                        <h2>Bilangan Klien yang Mengemaskini Profil</h2>
                    </div>
                    <div class="body">
                        <!--begin::First Row-->
                        <div class="row g-3 g-lg-6" style="text-align: center;">
                            <!--begin::Col-->
                            <div class="col-4">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #1b4268;">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-users text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Jumlah Klien</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-klien') }}">
                                            <span id="belumKemaskiniCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$jumlah1}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-4">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #581378;">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-users text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Telah Kemaskini</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-klien') }}">
                                            <span id="belumKemaskiniCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$sedangKemaskini}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-4">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #be0991;">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fa-solid fa-users text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Belum Kemaskini</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-klien') }}">
                                            <span id="mohonKemaskiniCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$belumKemaskini}}</span>
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

                    <div class="header pt-10 mb-5">
                        <h2>Bilangan Status Permohonan Kemaskini Profil</h2>
                    </div>
                    <div class="body">
                        <!--begin::First Row-->
                        <div class="row g-3 g-lg-6" style="text-align: center;">
                            <!--begin::Col-->
                            <div class="col-4">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #138aca;">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-users text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Jumlah Permohonan</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-permohonan-klien-brpp') }}">
                                            <span id="belumKemaskiniCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$jumlah2}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-4">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #a013ca;">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-users text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Selesai</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-permohonan-klien-brpp') }}">
                                            <span id="belumKemaskiniCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$selesai}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-4">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #df1bba;">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fa-solid fa-users text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Belum Selesai</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('senarai-permohonan-klien-brpp') }}">
                                            <span id="mohonKemaskiniCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$belumSelesai}}</span>
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
                     <!--Status Menjawab-->
                     <div class="header pt-5 mb-5">
                        <h2>Status Klien Menjawab Soal Selidik Kepulihan</h2>
                    </div>
                    <div class="body">
                        <!--begin::First Row-->
                        <div class="row g-3 g-lg-6" style="text-align: center;">
                            <!--begin::Col-->
                            <div class="col-4">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:cadetblue">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Selesai Menjawab</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('maklum.balas.kepulihan.brpp', ['status' => 'Selesai']) }}">
                                            <span id="selesaiMenjawabCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$selesai_menjawab}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-4">
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
                                        <a href="{{ route('maklum.balas.kepulihan.brpp', ['status' => 'Belum Selesai']) }}">
                                            <span id="belumSelesaiMenjawabCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$belum_selesai_menjawab}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-4">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:maroon">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Menjawab</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href={{route('maklum.balas.kepulihan.brpp')}}>
                                            <span id="tidakMenjawabCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidak_menjawab}}</span>
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

                    <!--Keputusan Soal Selidik-->
                    <div class="header pt-10 mb-5">
                        <h2>Keputusan Soal Selidik Kepulihan Klien</h2>
                    </div>
                    <div class="body">
                        <!--begin::First Row-->
                        <div class="row g-3 g-lg-6" style="text-align: center;">
                            <!--begin::Col-->
                            <div class="col-3">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: green !important;">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Cemerlang</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('maklum.balas.kepulihan.brpp', ['status' => 'Selesai', 'tahap_kepulihan_id' => '4']) }}">
                                            <span id="cemerlangCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$cemerlang}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-3">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-warning">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Baik</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('maklum.balas.kepulihan.brpp', ['status' => 'Selesai', 'tahap_kepulihan_id' => '3']) }}">
                                            <span id="baikCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$baik}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-3">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color:darkorange">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fas fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Memuaskan</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('maklum.balas.kepulihan.brpp', ['status' => 'Selesai', 'tahap_kepulihan_id' => '2']) }}">
                                            <span id="memuaskanCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$memuaskan}}</span>
                                            <span class="text-white fw-bold fs-7">Klik untuk Lihat</span>
                                        </a>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-3">
                                <!--begin::Items-->
                                <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: red;">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-0 mb-5">
                                            <i class="fa-solid fa-file-lines text-light" style="font-size: 20px;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tidak Memuaskan</span>
                                            </i>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <a href="{{ route('maklum.balas.kepulihan.brpp', ['status' => 'Selesai', 'tahap_kepulihan_id' => '1']) }}">
                                            <span id="tidakMemuaskanCount" class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 mb-1">{{$tidak_memuaskan}}</span>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        
            @if(session('passwordUpdateError'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: '{{ session('passwordUpdateError') }}',
                confirmButtonText: 'OK'
            });
        @endif
        });
    </script>
@endsection
