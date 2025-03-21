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
                            <button class="nav-link active" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button" role="tab" aria-controls="selesai" aria-selected="true">Selesai Menjawab</button>
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
                                    <br><small>Sila klik pada nama klien untuk lihat butirannya.</small>
                                </h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Filter Section-->
                            <div class="filter-section" style="padding-left: 30px; padding-bottom: 20px;">
                                <form id="filter-form1">
                                    <div class="row align-items-center">
                                        <!-- Date Range -->
                                        <div class="col-md-2">
                                            <input type="date" id="from_date_s" name="from_date_s" class="form-control" value="{{ request('from_date_s') }}">
                                        </div>
                                        <span class="col-auto">-</span> <!-- Dash centered between inputs -->
                                        <div class="col-md-2">
                                            <input type="date" id="to_date_s" name="to_date_s" class="form-control" value="{{ request('to_date_s') }}">
                                        </div>
                                
                                        <!-- Tahap Kepulihan -->
                                        <div class="col-md-2">
                                            <select id="tahap_kepulihan_id" name="tahap_kepulihan_id" class="form-control">
                                                <option value="">Pilih Tahap Kepulihan</option>
                                                @foreach($tahap_kepulihan_list as $tk)
                                                    <option value="{{ $tk->id }}" {{ request('tahap_kepulihan_id') == $tk->id ? 'selected' : '' }}>
                                                        {{ $tk->tahap }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- AADK Negeri -->
                                        <div class="col-md-2">
                                            <select id="aadk_negeri_s" class="form-select" name="aadk_negeri_s">
                                                <option value="">Pilih AADK Negeri</option>
                                                @foreach($aadk_negeri as $item)
                                                    <option value="{{$item->id}}" {{ request('aadk_negeri_s') == $item->id ? 'selected' : '' }}>{{$item->negeri}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- AADK Daerah -->
                                        <div class="col-md-2" style="width: 280px;">
                                            <select id="aadk_daerah_s" class="form-select" name="aadk_daerah_s">
                                                <option value="">Pilih AADK Daerah</option>
                                                @foreach($aadk_daerah as $d1)
                                                    <option value="{{ $d1->kod }}" {{ request('aadk_daerah_s') == $d1->kod ? 'selected' : '' }}>
                                                        {{ $d1->daerah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- Filter Button -->
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-filter"></i>
                                            </button>
                                        </div>

                                        {{-- Export PDF & EXCEL --}}
                                        <div class="col-md-3 mt-5">
                                            <h5>
                                                Senarai Rekod Klien:
                                                <a href="#" id="export-pdf1" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                
                                                <a href="#" id="export-excel1" class="btn btn-sm btn-success">
                                                    <i class="fas fa-file-excel"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="col-md-4 mt-5">
                                            <h5>
                                                Analisis Modal Kepulihan:
                                                <a href="#" id="export-pdf2" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>

                                                <a href="#" id="export-excel2" class="btn btn-sm btn-success">
                                                    <i class="fas fa-file-excel"></i>
                                                </a>
                                            </h5>
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
                                            <th style="width: 25%;">Nama</th>
                                            <th style="text-align: center; width: 10%;">No. Kad Pengenalan</th>
                                            <th style="text-align: center; width: 15%;">AADK Negeri</th>
                                            <th style="text-align: center; width: 20%;">AADK Daerah</th>
                                            <th style="text-align: center; width: 10%;">Tarikh Terakhir Menjawab</th> 
                                            <th style="text-align: center; width: 20%;">Tahap Kepulihan</th>  
                                        </tr>
                                    </thead>

                                    <tbody id="table-body1">
                                        <tr>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                        </tr>
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
                                    <br><small>Sila klik pada nama klien untuk lihat butirannya.</small>
                                </h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Filter Section-->
                            <div class="filter-section" style="padding-left: 30px; padding-bottom: 20px;">
                                <form id="filter-form2">
                                    <div class="row align-items-center">
                                        <!-- Date Range -->
                                        <div class="col-md-2">
                                            <input type="date" id="from_date_bs" name="from_date_bs" class="form-control" value="{{ request('from_date_bs') }}">
                                        </div>
                                        <span class="col-auto">-</span> <!-- Dash centered between inputs -->
                                        <div class="col-md-2">
                                            <input type="date" id="to_date_bs" name="to_date_bs" class="form-control" value="{{ request('to_date_bs') }}">
                                        </div>
                                
                                        <!-- AADK Negeri -->
                                        <div class="col-md-3">
                                            <select id="aadk_negeri_bs" class="form-select" name="aadk_negeri_bs">
                                                <option value="">Pilih AADK Negeri</option>
                                                @foreach($aadk_negeri as $item)
                                                    <option value="{{$item->id}}" {{ request('aadk_negeri_bs') == $item->id ? 'selected' : '' }}>{{$item->negeri}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- AADK Daerah -->
                                        <div class="col-md-3">
                                            <select id="aadk_daerah_bs" class="form-select" name="aadk_daerah_bs">
                                                <option value="">Pilih AADK Daerah</option>
                                                @foreach($aadk_daerah as $d1)
                                                    <option value="{{ $d1->kod }}" {{ request('aadk_daerah_bs') == $d1->kod ? 'selected' : '' }}>
                                                        {{ $d1->daerah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- Filter Button -->
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-filter"></i>
                                            </button>
                                        </div>

                                        {{-- Export PDF & EXCEL --}}
                                        <div class="col-md-3 mt-5">
                                            <h5>
                                                Senarai Rekod Klien:
                                                <a href="#" id="export-pdf3" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                
                                                <a href="#" id="export-excel3" class="btn btn-sm btn-success">
                                                    <i class="fas fa-file-excel"></i>
                                                </a>
                                            </h5>
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
                                            <th style="width: 30%;">Nama</th>
                                            <th style="text-align: center; width: 15%;">No. Kad Pengenalan</th>
                                            <th style="text-align: center; width: 15%;">AADK Negeri</th>
                                            <th style="text-align: center; width: 20%;">AADK Daerah</th>
                                            <th style="text-align: center; width: 20%;">Tarikh Terakhir Menjawab</th> 
                                        </tr>
                                    </thead>

                                    <tbody id="table-body2">
                                        <tr>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                        </tr>
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
                                <form id="filter-form3">
                                    <div class="row align-items-center">
                                        <!-- Date Range -->
                                        <div class="col-md-2">
                                            <input type="date" id="from_date_tm6" name="from_date_tm6" class="form-control" value="{{ request('from_date_tm6') }}">
                                        </div>
                                        <span class="col-auto">-</span> <!-- Dash centered between inputs -->
                                        <div class="col-md-2">
                                            <input type="date" id="to_date_tm6" name="to_date_tm6" class="form-control" value="{{ request('to_date_tm6') }}">
                                        </div>
                                
                                        <!-- AADK Negeri -->
                                        <div class="col-md-3">
                                            <select id="aadk_negeri_tm6" class="form-select" name="aadk_negeri_tm6">
                                                <option value="">Pilih AADK Negeri</option>
                                                @foreach($aadk_negeri as $item)
                                                    <option value="{{$item->id}}" {{ request('aadk_negeri_tm6') == $item->id ? 'selected' : '' }}>{{$item->negeri}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- AADK Daerah -->
                                        <div class="col-md-3">
                                            <select id="aadk_daerah_tm6" class="form-select" name="aadk_daerah_tm6">
                                                <option value="">Pilih AADK Daerah</option>
                                                @foreach($aadk_daerah as $d1)
                                                    <option value="{{ $d1->kod }}" {{ request('aadk_daerah_tm6') == $d1->kod ? 'selected' : '' }}>
                                                        {{ $d1->daerah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- Filter Button -->
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-filter"></i>
                                            </button>
                                        </div>

                                        {{-- Export PDF & EXCEL --}}
                                        <div class="col-md-3 mt-5">
                                            <h5>
                                                Senarai Rekod Klien:
                                                <a href="#" id="export-pdf4" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                
                                                <a href="#" id="export-excel4" class="btn btn-sm btn-success">
                                                    <i class="fas fa-file-excel"></i>
                                                </a>
                                            </h5>
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
                                            <th class="min-w-50px" style="text-align: center;">AADK Negeri</th>
                                            <th class="min-w-100px" style="text-align: center;">AADK Daerah</th>
                                            <th class="min-w-70px" style="text-align: center;">Tarikh Terakhir Menjawab</th> 
                                        </tr>
                                    </thead>
                                    <tbody id="table-body3">
                                        <tr>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                        </tr>
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
                                <form id="filter-form4">
                                    <div class="row align-items-center">
                                        <!-- AADK Negeri -->
                                        <div class="col-md-3">
                                            <select id="aadk_negeri_tpm" class="form-select" name="aadk_negeri_tpm">
                                                <option value="">Pilih AADK Negeri</option>
                                                @foreach($aadk_negeri as $item)
                                                    <option value="{{$item->id}}" {{ request('aadk_negeri_tpm') == $item->id ? 'selected' : '' }}>{{$item->negeri}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- AADK Daerah -->
                                        <div class="col-md-4">
                                            <select id="aadk_daerah_tpm" class="form-select" name="aadk_daerah_tpm">
                                                <option value="">Pilih AADK Daerah</option>
                                                @foreach($aadk_daerah as $d1)
                                                    <option value="{{ $d1->kod }}" {{ request('aadk_daerah_tpm') == $d1->kod ? 'selected' : '' }}>
                                                        {{ $d1->daerah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        <!-- Filter Button -->
                                        <div class="col-md-5">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-filter"></i>
                                            </button>
                                        </div>

                                        {{-- Export PDF & EXCEL --}}
                                        <div class="col-md-4 mt-5">
                                            <h5>
                                                Senarai Rekod Klien:
                                                <a href="#" id="export-pdf5" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                
                                                <a href="#" id="export-excel5" class="btn btn-sm btn-success">
                                                    <i class="fas fa-file-excel"></i>
                                                </a>
                                            </h5>
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
                                            <th class="min-w-150px">Nama</th>
                                            <th class="min-w-50px" style="text-align: center;">No. Kad Pengenalan</th>
                                            <th class="min-w-100px" style="text-align: center;">AADK Negeri</th>
                                            <th class="min-w-150px" style="text-align: center;">AADK Daerah</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body4">
                                        <tr>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                        </tr>
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

    <!--filter negeri daerah-->
    <script>
        $(document).ready(function() {
            $('#aadk_negeri_s').change(function() {
                var negeriId = $(this).val();
                if (negeriId) {
                    $.ajax({
                        url: '/daerah/' + negeriId,
                        type: 'GET',
                        success: function(response) {
                            $('#aadk_daerah_s').empty();
                            $('#aadk_daerah_s').append('<option value="">Pilih AADK Daerah</option>');
                            $.each(response, function(key, daerah) {
                                $('#aadk_daerah_s').append('<option value="' + daerah.kod + '">' + daerah.daerah + '</option>');
                            });
                        }
                    });
                } else {
                    $('#aadk_daerah_s').empty();
                    $('#aadk_daerah_s').append('<option value="">Pilih AADK Daerah</option>');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#aadk_negeri_bs').change(function() {
                var negeriId = $(this).val();
                if (negeriId) {
                    $.ajax({
                        url: '/daerah/' + negeriId,
                        type: 'GET',
                        success: function(response) {
                            $('#aadk_daerah_bs').empty();
                            $('#aadk_daerah_bs').append('<option value="">Pilih AADK Daerah</option>');
                            $.each(response, function(key, daerah) {
                                $('#aadk_daerah_bs').append('<option value="' + daerah.kod + '">' + daerah.daerah + '</option>');
                            });
                        }
                    });
                } else {
                    $('#aadk_daerah_bs').empty();
                    $('#aadk_daerah_bs').append('<option value="">Pilih AADK Daerah</option>');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#aadk_negeri_tm6').change(function() {
                var negeriId = $(this).val();
                if (negeriId) {
                    $.ajax({
                        url: '/daerah/' + negeriId,
                        type: 'GET',
                        success: function(response) {
                            $('#aadk_daerah_tm6').empty();
                            $('#aadk_daerah_tm6').append('<option value="">Pilih AADK Daerah</option>');
                            $.each(response, function(key, daerah) {
                                $('#aadk_daerah_tm6').append('<option value="' + daerah.kod + '">' + daerah.daerah + '</option>');
                            });
                        }
                    });
                } else {
                    $('#aadk_daerah_tm6').empty();
                    $('#aadk_daerah_tm6').append('<option value="">Pilih AADK Daerah</option>');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#aadk_negeri_tpm').change(function() {
                var negeriId = $(this).val();
                if (negeriId) {
                    $.ajax({
                        url: '/daerah/' + negeriId,
                        type: 'GET',
                        success: function(response) {
                            $('#aadk_daerah_tpm').empty();
                            $('#aadk_daerah_tpm').append('<option value="">Pilih AADK Daerah</option>');
                            $.each(response, function(key, daerah) {
                                $('#aadk_daerah_tpm').append('<option value="' + daerah.kod + '">' + daerah.daerah + '</option>');
                            });
                        }
                    });
                } else {
                    $('#aadk_daerah_tpm').empty();
                    $('#aadk_daerah_tpm').append('<option value="">Pilih AADK Daerah</option>');
                }
            });
        });
    </script>

    {{-- AJAX SELESAI MENJAWAB --}}
    <script>
        $(document).ready(function () {
            let table1 = $('#sortTable1').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ route('ajax-senarai-selesai-menjawab') }}",
                    data: function (d) {
                        d.from_date_s = $('#from_date_s').val();
                        d.to_date_s = $('#to_date_s').val();
                        d.tahap_kepulihan_id = $('#tahap_kepulihan_id').val();
                        d.aadk_negeri_s = $('#aadk_negeri_s').val();
                        d.aadk_daerah_s = $('#aadk_daerah_s').val();
                    }
                },
                columns: [
                    { data: "nama", render: function(data, type, row) {
                        return `<a href="/sejarah/modul-kepulihan/klien/${row.klien_id}">${data}</a>`;
                    }},
                    { data: "no_kp", className: "text-center" },
                    { data: "negeri", className: "text-center" },
                    { data: "daerah", className: "text-center" },
                    { data: "updated_at", className: "text-center", render: function (data) {
                        return data ? new Date(data).toLocaleDateString('en-GB') : 'N/A';
                    }},
                    { data: "tahap", className: "text-center", render: function (data) {
                        let badgeColor;
                        switch (data) {
                            case 'SANGAT TIDAK MEMUASKAN': badgeColor = 'red'; break;
                            case 'KURANG MEMUASKAN': badgeColor = 'darkorange'; break;
                            case 'MEMUASKAN': badgeColor = '#ffc107'; break;
                            default: badgeColor = 'green';
                        }
                        return `<span class="badge text-white" style="padding:10px; width:100%; display:inline-block; background-color:${badgeColor}">${data ? data : 'N/A'}</span>`;
                    }}
                ],
                language: {
                    url: "/assets/lang/Malay.json"
                },
                dom:'<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' + // Move "Papar rekod" and "Carian" to the top
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>', // Keep pagination and info below
            });

            // Fetch data when filter form is submitted
            $("#filter-form1").submit(function (e) {
                e.preventDefault();
                table1.ajax.reload(); // Reload DataTables with new filter data
            });
        });

        $(document).ready(function () {
            $("#export-excel1").click(function (e) {
                e.preventDefault();

                var fromDate = $("#from_date_s").val();
                var toDate = $("#to_date_s").val();
                var tahap = $("#tahap_kepulihan_id").val();
                var negeri = $("#aadk_negeri_s").val();
                var daerah = $("#aadk_daerah_s").val();

                var query = $.param({
                    from_date_s: fromDate,
                    to_date_s: toDate,
                    tahap_kepulihan_id: tahap,
                    aadk_negeri_s: negeri,
                    aadk_daerah_s: daerah
                });

                window.location.href = "/pelaporan/excel/selesai-menjawab?" + query; // Added '?' before query
            });


            $('#export-pdf1').on('click', function (e) {
                e.preventDefault();
                let filterData = $('#filter-form1').serialize(); // Get filtered values
                window.open("{{ route('pelaporan.selesai-menjawab.pdf') }}?" + filterData, '_blank');
            });
        });

        $(document).ready(function () {
            $("#export-excel2").click(function (e) {
                e.preventDefault();

                var fromDate = $("#from_date_s").val();
                var toDate = $("#to_date_s").val();
                var tahap = $("#tahap_kepulihan_id").val();
                var negeri = $("#aadk_negeri_s").val();
                var daerah = $("#aadk_daerah_s").val();

                var query = $.param({
                    from_date_s: fromDate,
                    to_date_s: toDate,
                    tahap_kepulihan_id: tahap,
                    aadk_negeri_s: negeri,
                    aadk_daerah_s: daerah
                });

                window.location.href = "/pelaporan/excel/analisis-mk?" + query; // Added '?' before query
            });

            $('#export-pdf2').on('click', function (e) {
                e.preventDefault();
                let filterData = $('#filter-form1').serialize(); // Get filtered values
                window.open("{{ route('pelaporan.analisisMK.pdf') }}?" + filterData, '_blank');
            });
        });
    </script>

    {{-- AJAX BELUM SELESAI MENJAWAB --}}
    <script>
        $(document).ready(function () {
            let table = $('#sortTable2').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ route('ajax-senarai-belum-selesai-menjawab') }}",
                    type: "GET",
                    data: function (d) {
                        d.from_date_bs = $("#from_date_bs").val();
                        d.to_date_bs = $("#to_date_bs").val();
                        d.aadk_negeri_bs = $("#aadk_negeri_bs").val();
                        d.aadk_daerah_bs = $("#aadk_daerah_bs").val();
                    }
                },
                columns: [
                    { data: "nama", render: function (data, type, row) {
                        return `<a href="/sejarah/modul-kepulihan/klien/${row.klien_id}">${data}</a>`;
                    }},
                    { data: "no_kp", className: "text-center" },
                    { data: "nama_negeri", className: "text-center" },
                    { data: "nama_daerah", className: "text-center" },
                    { data: "updated_at", className: "text-center", render: function (data) {
                        return data ? new Date(data).toLocaleDateString('en-GB') : 'N/A';
                    }}
                ],
                order: [],
                language: {
                    url: "/assets/lang/Malay.json"
                },
                dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                responsive: true
            });

            // Fetch data on form submission (reloading DataTable with new filters)
            $("#filter-form2").submit(function (e) {
                e.preventDefault();
                table.ajax.reload();
            });

            // Export Excel
            $("#export-excel3").click(function (e) {
                e.preventDefault();
                let query = $.param({
                    from_date_bs: $("#from_date_bs").val(),
                    to_date_bs: $("#to_date_bs").val(),
                    aadk_negeri_bs: $("#aadk_negeri_bs").val(),
                    aadk_daerah_bs: $("#aadk_daerah_bs").val()
                });
                window.location.href = "/pelaporan/excel/belum-selesai-menjawab?" + query;
            });

            // Export PDF
            $("#export-pdf3").click(function (e) {
                e.preventDefault();
                let filterData = $("#filter-form2").serialize();
                window.open("{{ route('pelaporan.belum-selesai-menjawab.pdf') }}?" + filterData, '_blank');
            });
        });
    </script>

    {{-- AJAX TIDAK MENJAWAB LEBIH 6 BULAN --}}
    <script>
        $(document).ready(function () {
            let table = $('#sortTable3').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ route('ajax-senarai-tidak-menjawab-lebih-6Bulan') }}",
                    type: "GET",
                    data: function (d) {
                        d.from_date_tm6 = $("#from_date_tm6").val();
                        d.to_date_tm6 = $("#to_date_tm6").val();
                        d.aadk_negeri_tm6 = $("#aadk_negeri_tm6").val();
                        d.aadk_daerah_tm6 = $("#aadk_daerah_tm6").val();
                    }
                },
                columns: [
                    { data: "nama", render: function (data, type, row) {
                        return `<a href="/sejarah/modul-kepulihan/klien/${row.klien_id}">${data}</a>`;
                    }},
                    { data: "no_kp", className: "text-center" },
                    { data: "negeri", className: "text-center" },
                    { data: "daerah", className: "text-center" },
                    { data: "updated_at", className: "text-center", render: function (data) {
                        return data ? new Date(data).toLocaleDateString('en-GB') : 'N/A';
                    }}
                ],
                order: [],
                language: {
                    url: "/assets/lang/Malay.json"
                },
                dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                responsive: true
            });

            // Fetch data on form submission (reloading DataTable with new filters)
            $("#filter-form3").submit(function (e) {
                e.preventDefault();
                table.ajax.reload();
            });

            // Export Excel
            $("#export-excel4").click(function (e) {
                e.preventDefault();
                let query = $.param({
                    from_date_tm6: $("#from_date_tm6").val(),
                    to_date_tm6: $("#to_date_tm6").val(),
                    aadk_negeri_tm6: $("#aadk_negeri_tm6").val(),
                    aadk_daerah_tm6: $("#aadk_daerah_tm6").val()
                });
                window.location.href = "/pelaporan/excel/tidak-menjawab-lebih-6Bulan?" + query;
            });

            // Export PDF
            $("#export-pdf4").click(function (e) {
                e.preventDefault();
                let filterData = $("#filter-form3").serialize();
                window.open("{{ route('pelaporan.tidak-menjawab-lebih-6Bulan.pdf') }}?" + filterData, '_blank');
            });
        });
    </script>

    {{-- AJAX TIDAK PERNAH MENJAWAB --}}
    <script>
        $(document).ready(function () {
            let table4 = $('#sortTable4').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('ajax-senarai-tidak-pernah-menjawab') }}",
                    type: "GET",
                    data: function (d) {
                        d.aadk_negeri_tpm = $('#aadk_negeri_tpm').val();
                        d.aadk_daerah_tpm = $('#aadk_daerah_tpm').val();
                    }
                },
                columns: [
                    { data: "nama", name: "nama" },
                    { data: "no_kp", name: "no_kp", className: "text-center" },
                    { data: "negeri", name: "negeri", className: "text-center" },
                    { data: "daerah", name: "daerah", className: "text-center" }
                ],
                dom:'<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' + // Move "Papar rekod" and "Carian" to the top
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>', // Keep pagination and info below
                language: {
                    url: "/assets/lang/Malay.json"
                }
            });

            // Apply filter on button click
            $('#filter-form4').submit(function (e) {
                e.preventDefault();
                table4.ajax.reload();
            });
        });

        $(document).ready(function () {
            $("#export-excel5").click(function (e) {
                e.preventDefault();

                var negeri = $("#aadk_negeri_tpm").val();
                var daerah = $("#aadk_daerah_tpm").val();

                var query = $.param({
                    aadk_negeri_tpm: negeri,
                    aadk_daerah_tpm: daerah
                });

                window.location.href = "/pelaporan/excel/tidak-pernah-menjawab?" + query; // Added '?' before query
            });

            $('#export-pdf5').on('click', function (e) {
                e.preventDefault();
                let filterData = $('#filter-form4').serialize(); // Get filtered values
                window.open("{{ route('pelaporan.tidak-pernah-menjawab.pdf') }}?" + filterData, '_blank');
            });
        });
    </script>
@endsection