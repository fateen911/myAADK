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
            <li class="breadcrumb-item text-muted">Pengurusan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Maklum Balas</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Soal Selidik</li>
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
                                    <br><small>Sila klik pada nama klien atau ikon mata pada kolum 'Sejarah Menjawab' untuk lihat butirannya.</small>
                                </h2>
                            </div>                            
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable" 
                                data-url="{{ route('selesai-menjawab.' . auth()->user()->tahap_pengguna) }}" style="width: 100%; table-layout: auto;">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7">
                                            <th style="width: 22%;">Nama</th>
                                            <th style="text-align: center; width: 12%;">No. Kad Pengenalan</th>
                                            <th style="text-align: center; width: 18%;">AADK Daerah</th>
                                            <th style="text-align: center; width: 10%;">AADK Negeri</th>
                                            <th style="text-align: center; width: 10%;">Tarikh Terakhir Menjawab</th> 
                                            <th style="text-align: center; width: 20%;">Tahap Kepulihan</th>  
                                            <th style="text-align: center; width: 8%;">Sejarah Menjawab</th>
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
                                    <br><small>Sila klik pada nama klien atau ikon mata pada kolum 'Sejarah Menjawab' untuk lihat butirannya.</small>
                                </h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable" 
                                data-url="{{ route('belum-selesai-menjawab.' . auth()->user()->tahap_pengguna) }}" style="width: 100%; table-layout: auto;">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7">
                                            <th style="width: 27%;">Nama</th>
                                            <th style="text-align: center; width: 12%;">No. Kad Pengenalan</th>
                                            <th style="text-align: center; width: 20%;">AADK Daerah</th>
                                            <th style="text-align: center; width: 18%;">AADK Negeri</th>
                                            <th style="text-align: center; width: 15%;">Tarikh Terakhir Menjawab</th> 
                                            <th style="text-align: center; width: 8%;">Sejarah Menjawab</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table-body2">
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

                        {{-- TIDAK MENJAWAB MELEBIHI 6 BULAN --}}
                        <div class="tab-pane fade" id="tidakMenjawabLebih6" role="tabpanel" aria-labelledby="tidakMenjawabLebih6-tab">
                            <!--begin::Card header-->
                            <div class="header" style="padding-left: 10px;">
                                <h2>Senarai Klien Tidak Menjawab Soal Selidik Modal Kepulihan Melebihi 6 Bulan
                                    <br><small>Sila klik pada nama klien atau ikon mata pada kolum 'Sejarah Menjawab' untuk lihat butirannya.</small>
                                </h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable3" class="table table-striped table-hover dataTable js-exportable" 
                                data-url="{{ route('tidak-menjawab-lebih-6Bulan.' . auth()->user()->tahap_pengguna) }}" style="width: 100%; table-layout: auto;">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7 gs-0">
                                            <th class="min-w-150px">Nama</th>
                                            <th class="min-w-30px" style="text-align: center;">No. Kad Pengenalan</th>
                                            <th class="min-w-50px" style="text-align: center;">AADK Daerah</th>
                                            <th class="min-w-50px" style="text-align: center;">AADK Negeri</th>
                                            <th class="min-w-70px" style="text-align: center;">Tarikh Terakhir Menjawab</th> 
                                            <th class="min-w-50px" style="text-align: center;">Sejarah Menjawab</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body3">
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

                        {{-- TIDAK PERNAH MENJAWAB --}}
                        <div class="tab-pane fade" id="tidakPernahMenjawab" role="tabpanel" aria-labelledby="tidakPernahMenjawab-tab">
                            <!--begin::Card header-->
                            <div class="header" style="padding-left: 10px;">
                                <h2>Senarai Klien Tidak Pernah Menjawab Soal Selidik Modal Kepulihan</h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable4" class="table table-striped table-hover dataTable js-exportable" 
                                data-url="{{ route('tidak-pernah-menjawab.' . auth()->user()->tahap_pengguna) }}" style="width: 100%; table-layout: auto;">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7 gs-0">
                                            <th class="min-w-150px">Nama</th>
                                            <th class="min-w-50px" style="text-align: center;">No. Kad Pengenalan</th>
                                            <th class="min-w-100px" style="text-align: center;">AADK Daerah</th>
                                            <th class="min-w-100px" style="text-align: center;">AADK Negeri</th>
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

    {{-- AJAX SELESAI MENJAWAB --}}
    <script>
        $(document).ready(function () {
            let routeUrl = $("#sortTable1").data("url"); // Get route from data attribute
            let tahapKepulihanId = "{{ request('tahap_kepulihan_id') }}"; 
    
            // Initialize DataTable
            let table = $("#sortTable1").DataTable({
                serverSide: true,  // Enable server-side processing for large datasets
                order: [], // Default order
                ajax: {
                    url: routeUrl,
                    type: "GET",
                    data: function (d) {
                        d.tahap_kepulihan_id = tahapKepulihanId; // Pass parameter to controller
                    },
                    error: function () {
                        alert("Error retrieving data.");
                    }
                },
                language: {
                    url: "/assets/lang/Malay.json"
                },
                dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                     '<"row"<"col-sm-12 my-0"tr>>' +
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                columns: [
                    { data: "nama", render: function (data, type, row) {
                            return `<a href="/sejarah/modul-kepulihan/klien/${row.klien_id}">${data}</a>`;
                        }
                    },
                    { data: "no_kp", className: "text-center" },
                    { data: "negeri", className: "text-center" },
                    { data: "daerah", className: "text-center" },
                    { data: "updated_at", className: "text-center", render: function (data) {
                            return data ? new Date(data).toLocaleDateString('en-GB') : 'N/A';
                        }
                    },
                    { data: "tahap", className: "text-center align-middle", render: function (data) {
                            let badgeColor = data === 'SANGAT TIDAK MEMUASKAN' ? 'red' :
                                             data === 'KURANG MEMUASKAN' ? 'darkorange' :
                                             data === 'MEMUASKAN' ? '#ffc107' : 'green';
                            return `<span class="badge text-white p-3 w-100" 
                                        style="background-color:${badgeColor}; display: inline-block;">
                                        ${data ? data : 'N/A'}
                                    </span>`;
                        }
                    },
                    { data: "klien_id", className: "text-center", orderable: false, render: function (data) {
                            return `<a href="/sejarah/modul-kepulihan/klien/${data}"><i class="fas fa-eye"></i></a>`;
                        }
                    }
                ]
            });
    
            // Function to reload DataTable when filters change (if needed)
            function reloadTable() {
                table.ajax.reload();
            }
        });
    </script>    
    
    {{-- AJAX BELUM SELESAI MENJAWAB --}}
    <script>
        $(document).ready(function () {
            // Initialize DataTable for 'Belum Selesai Menjawab'
            $('#sortTable2').DataTable({
                serverSide: true,
                ajax: $('#sortTable2').data('url'), // Get route URL from the table's data attribute
                columns: [
                    { data: 'nama', render: function (data, type, row) {
                        return `<a href="/sejarah/modul-kepulihan/klien/${row.klien_id}">${data}</a>`;
                    }},
                    { data: 'no_kp', className: "text-center" },
                    { data: 'nama_negeri', className: "text-center" },
                    { data: 'nama_daerah', className: "text-center" },
                    { data: 'updated_at', className: "text-center", render: function (data) {
                        return data ? new Date(data).toLocaleDateString('en-GB') : 'N/A';
                    }},
                    { data: 'klien_id', orderable: false, searchable: false, className: "text-center",
                        render: function (data) {
                            return `<a href="/sejarah/modul-kepulihan/klien/${data}">
                                        <i class="fas fa-eye"></i>
                                    </a>`;
                        }
                    }
                ],
                language: { url: "/assets/lang/Malay.json" },
                dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            });
        });
    </script>

    {{-- AJAX TIDAK MENJAWAB LEBIH 6 BULAN --}}
    <script>
        $(document).ready(function () {
            // Initialize DataTable for 'Tidak Menjawab Lebih 6 Bulan'
            $('#sortTable3').DataTable({
                serverSide: true,
                ajax: $('#sortTable3').data('url'), // Get route URL from the table's data attribute
                columns: [
                    { data: 'nama', render: function (data, type, row) {
                        return `<a href="/sejarah/modul-kepulihan/klien/${row.klien_id}">${data}</a>`;
                    }},
                    { data: 'no_kp', className: "text-center" },
                    { data: 'negeri', className: "text-center" },
                    { data: 'daerah', className: "text-center" },
                    { data: 'updated_at', className: "text-center", render: function (data) {
                        return data ? new Date(data).toLocaleDateString('en-GB') : 'N/A';
                    }},
                    { data: 'klien_id', orderable: false, searchable: false, className: "text-center",
                        render: function (data) {
                            return `<a href="/sejarah/modul-kepulihan/klien/${data}">
                                        <i class="fas fa-eye"></i>
                                    </a>`;
                        }
                    }
                ],
                language: { url: "/assets/lang/Malay.json" },
                dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            });
        });
    </script>

    {{-- AJAX TIDAK PERNAH MENJAWAB --}}
    <script>
        $(document).ready(function () {
            let table = $('#sortTable4').DataTable({
                processing: true,
                serverSide: true,
                ajax: $("#sortTable4").data("url"), // Get route from table data attribute
                columns: [
                    { data: 'nama', name: 'nama' },
                    { data: 'no_kp', name: 'no_kp', className: 'text-center' },
                    { data: 'negeri', name: 'negeri', className: 'text-center' },
                    { data: 'daerah', name: 'daerah', className: 'text-center' }
                ],
                ordering: true,
                order: [],
                language: {
                    url: "/assets/lang/Malay.json"
                },
                dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                responsive: true
            });
        });
    </script>
@endsection