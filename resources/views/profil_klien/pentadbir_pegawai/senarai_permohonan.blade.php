@extends('layouts._default')

@section('content')
    <head>
        <!--begin::Vendor Stylesheets(used for this page only)-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="/assets/lang/Malay.json"></script>

        <!-- Custom AADK CSS -->
		<link rel="stylesheet" href="/assets/css/customAADK.css">

        <style>
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
            <li class="breadcrumb-item text-muted">Permohonan Kemaskini Profil Klien</li>
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
                    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist" style="margin-left: 20px;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="belumSelesai-tab" data-toggle="tab" data-target="#belumSelesai" type="button" role="tab" aria-controls="belumSelesai" aria-selected="true">Permohonan Kemaskini Belum Selesai</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button" role="tab" aria-controls="selesai" aria-selected="true">Permohonan Kemaskini Selesai</button>
                        </li>
                    </ul>	

                    <div class="tab-content mt-0" id="myTabContent">
                        <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                            <div class="header row align-items-center">
                                <div class="col">
                                    <h2>Senarai Permohonan Klien yang Telah Selesai Kemaskini Profil<br><small>Klik pada nama klien untuk mengemaskini maklumat peribadi mereka.</small></h2>
                                </div>
                            </div>

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable"  data-url="{{ route('permohonan-selesai.' . auth()->user()->tahap_pengguna) }}">
                                    <thead>
                                        <tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
                                            <th style="width:25% !important;">Nama</th>
                                            <th style="width:15% !important; text-align: center;">No. Kad Pengenalan</th>
                                            <th style="width:20% !important; text-align: center;">Pejabat AADK Daerah</th>
                                            <th style="width:15% !important; text-align: center;">AADK Negeri</th>
                                            <th style="width:15% !important; text-align: center;">Pengemaskini</th> 
                                            <th style="width:10% !important; text-align: center;">Tindakan</th>
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

                        <div class="tab-pane fade show active" id="belumSelesai" role="tabpanel" aria-labelledby="belumSelesai-tab">
                            <div class="header row align-items-center">
                                <div class="col">
                                    <h2>Senarai Permohonan Klien yang Belum Selesai Kemaskini Profil<br><small>Klik pada nama klien untuk mengemaskini maklumat peribadi mereka.</small></h2>
                                </div>
                            </div>

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable"  data-url="{{ route('permohonan-belum-selesai.' . auth()->user()->tahap_pengguna) }}">
                                    <thead>
                                        <tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
                                            <th class="min-w-150px">Nama</th>
                                            <th class="min-w-70px" style="text-align: center;">No. Kad Pengenalan</th>
                                            <th class="min-w-100px" style="text-align: center;">Pejabat AADK Daerah</th>
                                            <th class="min-w-100px" style="text-align: center;">AADK Negeri</th>
                                            <th class="min-w-30px" style="text-align: center;">Tindakan</th></th>
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
        $(document).ready(function () {
            function fetchData() {
                let routeUrl = $("#sortTable2").data("url"); // Get route from table data attribute

                $.ajax({
                    url: routeUrl, // Use dynamic route
                    method: "GET",
                    dataType: 'json',
                    
                    success: function (response) {
                        console.log(response); // Check if data is being retrieved in the browser console
                        let tableBody = $("#table-body2");
                        tableBody.empty();

                        let rows = "";
                        $.each(response.data, function (index, row) {
                            rows += `
                                <tr>
                                    <td><a href="/pentadbir-pegawai/maklumat-klien/${row.id}">${row.nama}</a></td>
                                    <td style="text-align: center;">${row.no_kp}</td>
                                    <td style="text-align: center;">${row.negeri}</td>
                                    <td style="text-align: center;">${row.daerah}</td>
                                    <td style="text-align: center;">
                                        <a href="/pentadbir-pegawai/maklumat-klien/${row.id}">
                                            <i class="fas fa-pencil" style="color:blueviolet; padding-right:18px; font-size:18px;"></i>
                                        </a>

                                        <a href="/muat-turun/PDF/profil-klien/${row.id}">
                                            <i class="fas fa-file-pdf" style="color:blueviolet; font-size:18px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });

                        tableBody.html(rows);

                        // Destroy existing DataTable before reinitializing
                        if ($.fn.DataTable.isDataTable("#sortTable2")) {
                            $('#sortTable2').DataTable().destroy();
                        }

                        // Reinitialize DataTable
                        $('#sortTable2').DataTable({
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
                    },
                    error: function () {
                        alert("Error retrieving data.");
                    }
                });
            }
            // Fetch data on page load
            fetchData();
        });
    </script>

    <script>
        $(document).ready(function () {
            function fetchData() {
                let routeUrl = $("#sortTable1").data("url"); // Get route from table data attribute

                $.ajax({
                    url: routeUrl, // Use dynamic route
                    method: "GET",
                    dataType: 'json',
                    
                    success: function (response) {
                        console.log(response); // Check if data is being retrieved in the browser console
                        let tableBody = $("#table-body1");
                        tableBody.empty();

                        let rows = "";
                        $.each(response.data, function (index, row) {
                            rows += `
                                <tr>
                                    <td><a href="/pentadbir-pegawai/maklumat-klien/${row.id}">${row.nama}</a></td>
                                    <td style="text-align: center;">${row.no_kp}</td>
                                    <td style="text-align: center;">${row.negeri}</td>
                                    <td style="text-align: center;">${row.daerah}</td>
                                    <td style="text-align: center;">${row.nama_pengemaskini}</td>
                                    <td style="text-align: center;">
                                        <a href="/pentadbir-pegawai/maklumat-klien/${row.id}">
                                            <i class="fas fa-pencil" style="color:blueviolet; padding-right:18px; font-size:18px;"></i>
                                        </a>

                                        <a href="/muat-turun/PDF/profil-klien/${row.id}">
                                            <i class="fas fa-file-pdf" style="color:blueviolet; font-size:18px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });

                        tableBody.html(rows);

                        // Destroy existing DataTable before reinitializing
                        if ($.fn.DataTable.isDataTable("#sortTable1")) {
                            $('#sortTable1').DataTable().destroy();
                        }

                        // Reinitialize DataTable
                        $('#sortTable1').DataTable({
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
                    },
                    error: function () {
                        alert("Error retrieving data.");
                    }
                });
            }
            // Fetch data on page load
            fetchData();
        });
    </script>
@endsection