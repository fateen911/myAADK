@extends('layouts._default')

@section('content')
    <head>
        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="/assets/lang/Malay.json"></script>
        <!-- Include jQuery from CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Include Select2 CSS from CDN -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Include Select2 JS from CDN -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Custom AADK CSS -->
        <link rel="stylesheet" href="/assets/css/customAADK.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <style>
            .btn-icon {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .d-none {
                display: none;
            }
        </style>
    </head>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pelaporan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Pelaporan</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Aktiviti</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Rekod Aktiviti</li>
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
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="header p-0 m-0 w-100">
                            <h2>Senarai Kehadiran<br></h2><small>Berikut merupakan senarai kehadiran bagi aktiviti ini.</small>
                            <br>
                            <div class="mt-8 d-md-flex w-100">
                                <div class="w-77 text-uppercase">
                                    Nama Aktiviti: {{strtoupper($program->nama)}} <br>
                                    Tarikh/Masa Mula: {{date('d/m/Y, h:iA', strtotime($program->tarikh_mula))}} <br>
                                    Tarikh/Masa Tamat: {{date('d/m/Y, h:iA', strtotime($program->tarikh_tamat))}} <br>
                                    Tempat: {{$program->tempat}} <br>
                                    @if($program->penganjur!=null)
                                        Penganjur: {{strtoupper($program->penganjur)}} <br>
                                    @endif
                                    Pegawai AADK: {{strtoupper($program->nama_pegawai)}} <br>
                                    Sila Hubungi: {{$program->no_tel_dihubungi}} <br>
                                    <input type="hidden" id="programId" value="{{$program->id}}">
                                </div>
                                <div class="pt-md-20 ps-md-10 pt-5">
                                    <div class="d-flex gap-2 mt-md-7 mb-3 justify-content-md-end">
                                        <a href="{{url('/pengurusan-program/pdf-perekodan/'.$program->id)}}" class="btn btn-sm btn-danger btn-active-color-danger">
                                            PDF &nbsp; <i class="bi bi-file-pdf"></i>
                                        </a>
                                        <a href="{{url('/pengurusan-program/excel-perekodan/'.$program->id)}}" class="btn btn-sm btn-success btn-active-color-success">
                                            Excel &nbsp; <i class="bi bi-file-earmark-spreadsheet"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="body">
                        <hr>
                        <!--begin::Table-->
                        <table class="table table-row-dashed fs-6 gy-5 my-0" id="perekodanTable">
                            <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-50">Nama</th>
                                <th class="w-25">No. Kad Pengenalan</th>
                                <th class="w-25">Tarikh/Masa</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
    </div>

    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/assets/js/custom/apps/customers/list/export.js"></script>
    <script src="/assets/js/custom/apps/customers/list/list.js"></script>
    <script src="/assets/js/custom/apps/customers/add.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!--end::Javascript-->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!--perekodan-->
    <script>
        $(document).ready(function(){
            fetchItems();

            function fetchItems() {
                var id = $('#programId').val();
                $.ajax({
                    url: '/perekodan/' + id,
                    method: 'GET',
                    success: function(response) {
                        $('#perekodanTable').DataTable().destroy();
                        let rows = '';
                        $.each(response, function(index, perekodan) {
                            let formattedDate = moment(perekodan.tarikh_perekodan).format('DD-MM-YYYY HH:mm:ss');
                            rows += '<tr>';
                            rows += '<td class="text-uppercase">' + perekodan.klien.nama + '</td>';
                            rows += '<td class="text-uppercase">' + perekodan.klien.no_kp + '</td>';
                            rows += '<td>' + formattedDate + '</td>';
                            rows += '</tr>';
                        });
                        $('#perekodanTable tbody').html(rows);
                        $('#perekodanTable').DataTable({
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
                    }
                });
            }
        });
    </script>

@endsection
