@extends('layouts._default')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp

    <head>
        <style>
            .scrollable-container {
                max-height: 400px;
                overflow-y: auto;
                margin-right: 10px;
            }
        </style>
    </head>

    <body>
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
                <li class="breadcrumb-item text-muted">Klien</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            {{-- begin --}}
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-7">
                    <!--begin::Lists Widget 19-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Heading-->
                        <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-225px" style="background-color:gray;" data-bs-theme="light">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column text-white pt-10">
                                <span class="fw-bold fs-2x mb-3">Profil Peribadi</span>
                                <div class="fs-4 text-white">
                                    <span class="opacity-75">Status terkini</span>
                                    <span class="position-relative d-inline-block">
                                        <a href="{{ route('pengurusan-profil') }}" class="link-white opacity-75-hover fw-bold d-block mb-1" style="color: darkblue;">profil peribadi</a>
                                    </span>
                                    <span class="opacity-75">anda.</span>
                                </div>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->

                        @php
                            $tarikh_update_klien = $klien->updated_at 
                                                    ? Carbon::parse($klien->updated_at)->format('d-m-Y') 
                                                    : Carbon::parse($klien->created_at)->format('d-m-Y');
                            
                            $tarikh_update_waris = $waris->updated_at 
                                                    ? Carbon::parse($waris->updated_at)->format('d-m-Y') 
                                                    : Carbon::parse($waris->created_at)->format('d-m-Y');
                            
                            $tarikh_update_pekerjaan = $pekerjaan->updated_at 
                                                    ? Carbon::parse($pekerjaan->updated_at)->format('d-m-Y') 
                                                    : Carbon::parse($pekerjaan->created_at)->format('d-m-Y');
                            
                            $tarikh_update_pasangan = $pasangan->updated_at 
                                                    ? Carbon::parse($pasangan->updated_at)->format('d-m-Y') 
                                                    : Carbon::parse($pasangan->created_at)->format('d-m-Y');
                        @endphp

                        <!--begin::Body-->
                        <div class="card-body mt-n20">
                            <div class="mt-n20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-3 g-lg-6">
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol and Text-->
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-3" style="margin-top:20px;"> 
                                                    <span class="symbol-label" style="vertical-align: middle;">
                                                        <i class="ki-solid ki-user-tick fs-1 text-dark">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Title-->
                                                <span class="text-gray-700 fw-semibold fs-3 lh-1">Maklumat Peribadi</span>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Symbol and Text-->
                                            <!--begin::Info-->
                                            <div class="text-center mt-5">
                                                @if ($klien->status_kemaskini == 'Baharu')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @elseif ($klien->status_kemaskini == 'Kemaskini')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Dalam Semakan</span>
                                                @elseif ($klien->status_kemaskini == 'Lulus')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @else
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @endif

                                                <span class="text-gray-400 fw-semibold fs-6">{{  $tarikh_update_klien }}</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol and Text-->
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-3" style="margin-top:20px;"> 
                                                    <span class="symbol-label" style="vertical-align: middle;">
                                                        <i class="ki-solid ki-people fs-1 text-dark">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Title-->
                                                <span class="text-gray-700 fw-semibold fs-3 lh-1">Maklumat Waris</span>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Symbol and Text-->
                                            <!--begin::Info-->
                                            <div class="text-center mt-5">
                                                @if ($waris->status_kemaskini == 'Baharu')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @elseif ($waris->status_kemaskini == 'Kemaskini')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Dalam Semakan</span>
                                                @elseif ($waris->status_kemaskini == 'Lulus')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @else
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @endif

                                                <span class="text-gray-400 fw-semibold fs-6">{{ $tarikh_update_waris }}</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                
                                <!--begin::Row-->
                                <div class="row g-3 g-lg-6 mt-3">
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol and Text-->
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-3" style="margin-top:20px;"> 
                                                    <span class="symbol-label" style="vertical-align: middle;">
                                                        <i class="ki-solid ki-profile-user fs-1 text-dark">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Title-->
                                                <span class="text-gray-700 fw-semibold fs-3 lh-1">Maklumat Keluarga</span>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Symbol and Text-->
                                            <!--begin::Info-->
                                            <div class="text-center mt-5">
                                                @if ($pasangan->status_kemaskini == 'Baharu')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @elseif ($pasangan->status_kemaskini == 'Kemaskini')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Dalam Semakan</span>
                                                @elseif ($pasangan->status_kemaskini == 'Lulus')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @else
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @endif

                                                <span class="text-gray-400 fw-semibold fs-6">{{ $tarikh_update_pasangan }}</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Items-->
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <!--begin::Symbol and Text-->
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-3" style="margin-top:20px;"> 
                                                    <span class="symbol-label" style="vertical-align: middle;">
                                                        <i class="ki-solid ki-brifecase-tick fs-1 mb-8 text-dark"></i>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Title-->
                                                <span class="text-gray-700 fw-semibold fs-3 lh-1">Maklumat Pekerjaan</span>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Symbol and Text-->
                                            <!--begin::Info-->
                                            <div class="text-center mt-5">
                                                @if ($pekerjaan->status_kemaskini == 'Baharu')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @elseif ($pekerjaan->status_kemaskini == 'Kemaskini')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Dalam Semakan</span>
                                                @elseif ($pekerjaan->status_kemaskini == 'Lulus')
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @else
                                                    <span class="text-gray-600 fw-semibold fs-4 d-block">Kemaskini Terakhir</span>
                                                @endif

                                                <span class="text-gray-400 fw-semibold fs-6">{{ $tarikh_update_pekerjaan }}</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                        </div>
                        
                        <!--end::Body-->
                    </div>
                    <!--end::Lists Widget 19-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-5">
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark fs-1">Soal Selidik Modal Kepulihan</span>
                                <span class="text-gray-500 pt-2 fw-semibold fs-6">Status terkini bahagian soal selidik kepulihan.</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body scrollable-container">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-6 fw-bold text-gray-600">
                                            <th class="p-0 min-w-150px d-block pt-3">TARIKH</th>
                                            <th class="text-center min-w-140px pt-3">STATUS</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @if ($tidakMenjawabKepulihan )
                                            <tr>
                                                <td>
                                                    <a href="{{ route('klien.soalSelidik') }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{Carbon::parse($tarikhTidakMenjawabKepulihan)->format('d/m/Y')}}</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('klien.soalSelidik') }}" class="badge badge-light-danger fs-7 fw-bold">Belum Menjawab</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @foreach ($keputusanKepulihan as $kepulihan)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('klien.soalSelidik') }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{Carbon::parse($kepulihan->updated_at)->format('d/m/Y')}}</a>
                                                </td>
                                                @if ($kepulihan->status == 'Selesai')
                                                    <td class="text-center">
                                                        <a href="{{ route('klien.soalSelidik') }}" class="badge badge-light-success fs-7 fw-bold">{{$kepulihan->status}}</a>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <a href="{{ route('klien.soalSelidik') }}" class="badge badge-light-warning fs-7 fw-bold">{{$kepulihan->status}}</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                </div>
                <!--end::Col-->
            </div>
            {{-- end --}}
        </div>
        <!--end::Content-->
    </body>

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

