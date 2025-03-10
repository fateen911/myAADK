@extends('layouts._default')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--begin::Vendor Stylesheets(used for this page only)-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="/assets/lang/Malay.json"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <!-- Custom AADK CSS -->
        <link rel="stylesheet" href="/assets/css/customAADK.css">

        <style>
            .scrollable-container {
                max-width: 1100px; /* Adjust the height as needed */
                overflow-x: auto;
            }

            .nav{
                margin-left: 22px!important;
            }

            /* Base styles for all tabs */
            .nav-tabs .nav-item {
                margin-bottom: -1px; /* Prevent bottom margin */
            }

            .nav-link {
                font-size: 14px;
                color: #6c757d; 
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

            @media (max-width: 768px) {
                table.dataTable td, table.dataTable th {
                    font-size: 12px; /* Adjust font size for mobile */
                    padding: 5px; /* Reduce padding for better fit */
                }

                .badge {
                    font-size: 10px;
                    padding: 3px 6px;
                }
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
            <li class="breadcrumb-item text-muted">Pelaporan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Modal Kepulihan</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <!--begin::Body-->
	<div class="card shadow-sm mx-w-300 mx-w-450 mw-r-700">
		<div class="table-responsive">
			<!--begin::Content-->
			<div id="kt_app_content" class="app-content flex-column-fluid">
				<!--begin::Content container-->
				<div id="kt_app_content_container" class="app-container container-xxl">
                    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button" role="tab" aria-controls="selesai" aria-selected="true">Selesai</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="belumSelesai-tab" data-toggle="tab" data-target="#belumSelesai" type="button" role="tab" aria-controls="belumSelesai" aria-selected="true">Belum Selesai Menjawab</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tidakMenjawabLebih6-tab" data-toggle="tab" data-target="#tidakMenjawabLebih6" type="button" role="tab" aria-controls="tidakMenjawabLebih6" aria-selected="true">Tidak Menjawab Melebihi 6 Bulan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tidakPernahMenjawab-tab" data-toggle="tab" data-target="#tidakPernahMenjawab" type="button" role="tab" aria-controls="tidakPernahMenjawab" aria-selected="true">Tidak Pernah Menjawab</button>
                        </li>
                    </ul>	

                    <div class="tab-content mt-0" id="myTabContent">
                        {{-- SELESAI MENJAWAB --}}
                        <div class="tab-pane fade show active" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                            <!--begin::Card header-->
                            <div class="header d-flex justify-content-between align-items-center" style="padding-left: 10px;">
                                <h2>
                                    Senarai Klien Selesai Menjawab Soal Selidik Modal Kepulihan Dalam Tempoh Enam (6) Bulan Terkini
                                    <br><small>Sila klik pada nama klien atau ikon mata pada kolum 'Sejarah Menjawab' untuk lihat butirannya.</small>
                                </h2>
                                
                                <a href="{{ route('exportAnalisisMKNegeri.pdf') }}" class="btn btn-info">
                                    <i class="fas fa-file-pdf"></i> Analisis Modal Kepulihan
                                </a>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Filter Section-->
                            <div class="filter-section" style="padding-left: 30px; padding-bottom: 20px;">
                                <form id="filter-form">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="from_date_s">Tarikh Mula:</label>
                                            <input type="date" id="from_date_s" name="from_date_s" class="form-control" value="{{ request('from_date_s') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="to_date_s">Tarikh Akhir:</label>
                                            <input type="date" id="to_date_s" name="to_date_s" class="form-control" value="{{ request('to_date_s') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="tahap_kepulihan_id">Tahap Kepulihan:</label>
                                            <select id="tahap_kepulihan_id" name="tahap_kepulihan_id" class="form-control">
                                                <option value="">Semua Tahap</option>
                                                @foreach($tahap_kepulihan_list as $tk)
                                                    <option value="{{ $tk->id }}" {{ request('tahap_kepulihan_id') == $tk->id ? 'selected' : '' }}>
                                                        {{ $tk->tahap }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="aadk_daerah_s">AADK Daerah:</label>
                                            <select id="aadk_daerah_s" name="aadk_daerah_s" class="form-control">
                                                <option value="">Semua Daerah</option>
                                                @foreach($aadk_daerah as $d1)
                                                    <option value="{{ $d1->kod }}" {{ request('aadk_daerah_s') == $d1->kod ? 'selected' : '' }}>
                                                        {{ $d1->daerah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <br>
                                            <button type="submit" class="btn btn-primary"> 
                                                <i class="fas fa-filter"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2">
                                            <br>
                                            <a href="{{ route('selesai.pdf.negeri', [
                                                'from_date_s' => request('from_date_s'), 
                                                'to_date_s' => request('to_date_s'), 
                                                'tahap_kepulihan_id' => request('tahap_kepulihan_id'),
                                                'aadk_daerah_s' => request('aadk_daerah_s')]) }}" 
                                                class="btn btn-info">
                                                <i class="fas fa-file-pdf"></i> Senarai Klien
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Filter Section-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable" style="width: 100%; table-layout: auto;">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7">
                                            <th style="width: 30%;">Nama</th>
                                            <th style="text-align: center; width: 12%;">No. Kad Pengenalan</th>
                                            <th style="text-align: center; width: 20%;">AADK Daerah</th>
                                            <th style="text-align: center; width: 10%;">Tarikh Terakhir Menjawab</th> 
                                            <th style="text-align: center; width: 20%;">Tahap Kepulihan</th>  
                                            <th style="text-align: center; width: 8%;">Sejarah Menjawab</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach($selesai_menjawab as $response1)
                                            @php
                                                $tahap_kepulihan = DB::table('tahap_kepulihan')->where('id', $response1->tahap_kepulihan_id)->value('tahap_kepulihan.tahap');
                                                $daerah = DB::table('senarai_daerah_pejabat')->where('kod', $response1->daerah_pejabat)->value('senarai_daerah_pejabat.daerah');
                                            @endphp
                                            <tr>
                                                <td style="width: 30%;">
                                                    <a href="{{ route('sejarah.soal.selidik.klien', $response1->klien_id) }}">
                                                        {{ $response1->nama }}
                                                    </a>
                                                </td>
                                                <td style="width: 12%; text-align: center;">{{ $response1->no_kp }}</td>
                                                <td style="width: 20%; text-align: center;">{{ $daerah }}</td>
                                                <td style="width: 10%; text-align: center;">{{ isset($response1->updated_at) ? Carbon::parse($response1->updated_at)->format('d/m/Y') : 'N/A' }}</td>
                                                <td style="width: 20%; text-align: center;">   
                                                    @if ($response1->tahap_kepulihan_id)
                                                        @if ($response1->tahap_kepulihan_id == 1)
                                                            <badge class="badge text-white" style="background-color: red; padding:10px; width:200px; display: inline-block; text-align: center;">{{ $tahap_kepulihan }}</badge>
                                                        @elseif ($response1->tahap_kepulihan_id == 2)
                                                            <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:200px; display: inline-block; text-align: center;">{{ $tahap_kepulihan }}</badge>
                                                        @elseif ($response1->tahap_kepulihan_id == 3)
                                                            <badge class="badge text-white bg-warning" style="padding:10px; width:200px; display: inline-block; text-align: center;">{{ $tahap_kepulihan }}</badge>   
                                                        @else
                                                            <badge class="badge text-white" style="background-color: green; padding:10px; width:200px; display: inline-block; text-align: center;">{{ $tahap_kepulihan }}</badge>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td style="width: 8%; text-align: center;">
                                                    <a href="{{ route('sejarah.soal.selidik.klien', $response1->klien_id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                
                                <!--end::Table-->
                            </div>                    
                            <!--end::Card body-->
                        </div>

                        {{-- BELUM SELESAI MENJAWAB --}}
                        <div class="tab-pane fade" id="belumSelesai" role="tabpanel" aria-labelledby="belumSelesai-tab">
                            <!--begin::Card header-->
                            <div class="header" style="padding-left: 10px;">
                                <h2>Senarai Klien Belum Selesai Menjawab Soal Selidik Modal Kepulihan Dalam Tempoh Enam (6) Bulan Terkini
                                    <br><small>Sila klik pada nama klien atau ikon mata pada kolum 'Sejarah Menjawab' untuk lihat butirannya.</small>
                                </h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Filter Section-->
                            <div class="filter-section" style="padding-left: 30px; padding-bottom: 20px;">
                                <form id="filter-form">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="from_date_bs">Tarikh Mula:</label>
                                            <input type="date" id="from_date_bs" name="from_date_bs" class="form-control" value="{{ request('from_date_bs') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="to_date_bs">Tarikh Akhir:</label>
                                            <input type="date" id="to_date_bs" name="to_date_bs" class="form-control" value="{{ request('to_date_bs') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="aadk_daerah_bs">AADK Daerah:</label>
                                            <select id="aadk_daerah_bs" name="aadk_daerah_bs" class="form-control">
                                                <option value="">Semua</option>
                                                @foreach($aadk_daerah as $d2)
                                                    <option value="{{ $d2->kod }}" {{ request('aadk_daerah_bs') == $d2->kod ? 'selected' : '' }}>
                                                        {{ $d2->daerah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <br>
                                            <button type="submit" class="btn btn-primary"> 
                                                <i class="fas fa-filter"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <a href="{{ route('belum_selesai.pdf.negeri', [
                                                'from_date_bs' => request('from_date_bs'), 
                                                'to_date_bs' => request('to_date_bs'),
                                                'aadk_daerah_bs' => request('aadk_daerah_bs')]) }}" 
                                                class="btn btn-info">
                                                <i class="fas fa-file-pdf"></i> Senarai Klien
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Filter Section-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable" style="width: 100%; table-layout: auto;">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7">
                                            <th style="width: 40%;">Nama</th>
                                            <th style="text-align: center; width: 15%;">No. Kad Pengenalan</th>
                                            <th style="text-align: center; width: 25%;">AADK Daerah</th>
                                            <th style="text-align: center; width: 10%;">Tarikh Terakhir Menjawab</th> 
                                            <th style="text-align: center; width: 10%;">Sejarah Menjawab</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach($belum_selesai_menjawab as $response2)
                                            @php
                                                $tahap_kepulihan = DB::table('tahap_kepulihan')->where('id', $response2->tahap_kepulihan_id)->value('tahap_kepulihan.tahap');
                                                $daerah = DB::table('senarai_daerah_pejabat')->where('kod', $response2->daerah_pejabat)->value('senarai_daerah_pejabat.daerah');
                                            @endphp
                                            <tr>
                                                <td style="width: 40%;">
                                                    <a href="{{ route('sejarah.soal.selidik.klien', $response2->klien_id) }}">
                                                        {{ $response2->nama }}
                                                    </a>
                                                </td>
                                                <td style="width: 15%; text-align: center;">{{ $response2->no_kp }}</td>
                                                <td style="width: 25%; text-align: center;">{{ $daerah }}</td>
                                                <td style="width: 10%; text-align: center;">{{ isset($response2->updated_at) ? Carbon::parse($response2->updated_at)->format('d/m/Y') : 'N/A' }}</td>
                                                <td style="width: 10%; text-align: center;">
                                                    <a href="{{ route('sejarah.soal.selidik.klien', $response2->klien_id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                
                                <!--end::Table-->
                            </div>                    
                            <!--end::Card body-->
                        </div>

                        {{-- TIDAK MENJAWAB MELEBIHI 6 BULAN --}}
                        <div class="tab-pane fade" id="tidakMenjawabLebih6" role="tabpanel" aria-labelledby="tidakMenjawabLebih6-tab">
                            <!--begin::Card header-->
                            <div class="header" style="padding-left: 10px;">
                                <h2>Senarai Klien Tidak Menjawab Soal Selidik Modal Kepulihan Melebihi 6 Bulan
                                    <br><small>Sila klik pada nama klien atau ikon mata pada kolum 'Sejarah Menjawab' untuk lihat butirannya.</small>
                                </h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Filter Section-->
                            <div class="filter-section" style="padding-left: 30px; padding-bottom: 20px;">
                                <form id="filter-form">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="from_date_tm6">Tarikh Mula:</label>
                                            <input type="date" id="from_date_tm6" name="from_date_tm6" class="form-control" value="{{ request('from_date_tm6') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="to_date_tm6">Tarikh Akhir:</label>
                                            <input type="date" id="to_date_tm6" name="to_date_tm6" class="form-control" value="{{ request('to_date_tm6') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="aadk_daerah_tm6">AADK Daerah:</label>
                                            <select id="aadk_daerah_tm6" name="aadk_daerah_tm6" class="form-control">
                                                <option value="">Semua Daerah</option>
                                                @foreach($aadk_daerah as $d3)
                                                    <option value="{{ $d3->kod }}" {{ request('aadk_daerah_tm6') == $d3->kod ? 'selected' : '' }}>
                                                        {{ $d3->daerah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <br>
                                            <button type="submit" class="btn btn-primary"> 
                                                <i class="fas fa-filter"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <a href="{{ route('tidak_menjawab6.pdf.negeri', [
                                                'from_date_tm6' => request('from_date_tm6'), 
                                                'to_date_tm6' => request('to_date_tm6'),
                                                'aadk_daerah_tm6' => request('aadk_daerah_tm6')]) }}" 
                                                class="btn btn-info">
                                                <i class="fas fa-file-pdf"></i> Senarai Klien
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Filter Section-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable3" class="table table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7 gs-0">
                                            <th class="min-w-150px">Nama</th>
                                            <th class="min-w-50px" style="text-align: center;">No. Kad Pengenalan</th>
                                            <th class="min-w-100px" style="text-align: center;">AADK Daerah</th>
                                            <th class="min-w-70px" style="text-align: center;">Tarikh Terakhir Menjawab</th> 
                                            <th class="min-w-30px" style="text-align: center;">Sejarah Menjawab</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach($tidak_menjawab_lebih_6bulan as $response3)
                                            @php
                                                $daerah = DB::table('senarai_daerah_pejabat')->where('kod', $response3->daerah_pejabat)->value('senarai_daerah_pejabat.daerah');
                                            @endphp

                                            <tr>
                                                <td>{{ $response3->nama }}</td>
                                                <td style="text-align: center;">{{ $response3->no_kp }}</td>
                                                <td style="text-align: center;">{{ $daerah }}</td>
                                                <td style="text-align: center">{{ isset($response3->updated_at) ? Carbon::parse($response3->updated_at)->format('d/m/Y') : 'N/A' }}</td>
                                                <td style="text-align: center;">
                                                    @if ($response3->updated_at !== NULL)
                                                        <a href="{{ route('sejarah.soal.selidik.klien', $response3->klien_id) }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                               
                                <!--end::Table-->
                            </div>                    
                            <!--end::Card body-->
                        </div>

                        {{-- TIDAK PERNAH MENJAWAB --}}
                        <div class="tab-pane fade" id="tidakPernahMenjawab" role="tabpanel" aria-labelledby="tidakPernahMenjawab-tab">
                            <!--begin::Card header-->
                            <div class="header d-flex justify-content-between align-items-center" style="padding-left: 10px;">
                                <h2>Senarai Klien Tidak Pernah Menjawab Soal Selidik Modal Kepulihan</h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Filter Section-->
                            <div class="filter-section" style="padding-left: 30px; padding-bottom: 20px;">
                                <form id="filter-form">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="aadk_daerah_tpm">AADK Daerah:</label>
                                            <select id="aadk_daerah_tpm" name="aadk_daerah_tpm" class="form-control">
                                                <option value="">Semua Daerah</option>
                                                @foreach($aadk_daerah as $d4)
                                                    <option value="{{ $d4->kod }}" {{ request('aadk_daerah_tpm') == $d4->kod ? 'selected' : '' }}>
                                                        {{ $d4->daerah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <br>
                                            <button type="submit" class="btn btn-primary"> 
                                                <i class="fas fa-filter"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-8">
                                            <br>
                                            <a href="{{ route('tidak_pernah_menjawab.pdf.negeri', [
                                                'aadk_daerah_tpm' => request('aadk_daerah_tpm')]) }}" 
                                                class="btn btn-info">
                                                <i class="fas fa-file-pdf"></i> Senarai Klien
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Filter Section-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable4" class="table table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7 gs-0">
                                            <th class="min-w-250px">Nama</th>
                                            <th class="min-w-50px" style="text-align: center;">No. Kad Pengenalan</th>
                                            <th class="min-w-150px" style="text-align: center;">AADK Daerah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach($tidak_pernah_menjawab as $response4)
                                            @php
                                                $daerah = DB::table('senarai_daerah_pejabat')->where('kod', $response4->daerah_pejabat)->value('senarai_daerah_pejabat.daerah');
                                            @endphp

                                            <tr>
                                                <td>{{ $response4->nama }}</td>
                                                <td style="text-align: center;">{{ $response4->no_kp }}</td>
                                                <td style="text-align: center;">{{ $daerah }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>                    
                            <!--end::Card body-->
                        </div>
                    </div>
				</div>
				<!--end::Content container-->
			</div>
			<!--end::Content-->
		</div>
	</div>

    <!--begin::Javascript-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<!--end::Javascript-->
    
    <script>
        $('#sortTable1').DataTable({
                ordering: true, 
                order: [], 
                language: {
                    url: "/assets/lang/Malay.json"
                }
        });

        $('#sortTable2').DataTable({
                ordering: true, 
                order: [], 
                language: {
                    url: "/assets/lang/Malay.json"
                }
        });

        $('#sortTable3').DataTable({
                ordering: true, 
                order: [], 
                language: {
                    url: "/assets/lang/Malay.json"
                }
        });

        $('#sortTable4').DataTable({
                ordering: true, 
                order: [], 
                language: {
                    url: "/assets/lang/Malay.json"
                }
        });
    </script>
@endsection