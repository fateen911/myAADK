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
                        <div class="header p-0 m-0">
                            <h2>Rekod Aktiviti<br></h2><small>Sila klik pada nama aktiviti untuk melihat maklumat lanjut.</small>
                        </div>
                        <input type="hidden" name="pegawai_id" id="pegawaiId" value="{{$user_id}}">
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="body">
                        <div class="d-flex flex-row">
                            <form method="post" action="{{url('/pelaporan/aktiviti/aktivitiPB/filter-senarai-aktiviti')}}">
                                @csrf
                                <div class="d-flex flex-column flex-row-fluid mb-5">
                                    <div class="d-md-flex flex-row flex-column-fluid gap-5 mt-5">
                                        <div class="w-10 flex-center">
                                            <select id="tahun" class="form-select mt-5" name="tahun">
                                                <option value="">Sila Pilih Tahun</option>
                                                @foreach($years as $year)
                                                    <option value="{{$year}}" {{ $tahun == $year ? 'selected' : '' }}>{{$year}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="w-10 flex-center">
                                            <select id="bulan" class="form-select mt-5" name="bulan">
                                                <option value="">Sila Pilih Bulan</option>
                                                @for($i=1 ; $i<=12 ; $i++)
                                                    <option value="{{$i}}" {{ $bulan == $i ? 'selected' : '' }}>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="flex-center">
                                            <select id="kategori" class="form-select mt-5" name="kategori">
                                                <option value="">Sila Pilih Kategori</option>
                                                @foreach($kategori as $k)
                                                    <option class="text-uppercase" value="{{$k->id}}" {{ $pKategori == $k->id ? 'selected' : '' }}>{{$k->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex-center">
                                            <select id="negeri" class="form-select mt-5" name="negeri">
                                                <option value="">Sila Pilih Negeri</option>
                                                @foreach($negeri as $item)
                                                    <option value="{{$item->id}}" {{ $pNegeri == $item->id ? 'selected' : '' }}>{{$item->negeri}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex-center">
                                            <select id="daerah" class="form-select mt-5" name="daerah">
                                                <option value="">Sila Pilih Daerah</option>
                                                @foreach($daerah as $item)
                                                    <option value="{{$item->kod}}" {{ $pDaerah == $item->kod ? 'selected' : '' }}>{{$item->daerah}}</option>
                                                @endforeach
                                                <!--AJAX-->
                                            </select>
                                        </div>

                                        <div class="flex-center">
                                            <select id="status" class="form-select mt-5" name="status">
                                                <option value="">Sila Pilih Status</option>
                                                <option class="text-uppercase" value="BELUM SELESAI"{{ $status == 'BELUM SELESAI' ? 'selected' : '' }}>BELUM SELESAI</option>
                                                <option class="text-uppercase" value="PINDA"{{ $status == 'PINDA' ? 'selected' : '' }}>PINDA</option>
                                                <option class="text-uppercase" value="SEDANG BERLANGSUNG"{{ $status == 'SEDANG BERLANGSUNG' ? 'selected' : '' }}>SEDANG BERLANGSUNG</option>
                                                <option class="text-uppercase" value="SELESAI"{{ $status == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                                                <option class="text-uppercase" value="BATAL"{{ $status == 'BATAL' ? 'selected' : '' }}>BATAL</option>
                                            </select>
                                        </div>

                                        <div class="flex-center mt-5">
                                            <button class="btn btn-primary btn-icon" type="submit" id="filterBtn"><i class="bi bi-funnel-fill fs-2"></i></button>
                                        </div>

                                        <div class="flex-center mt-5">
                                            <a href="{{route('pelaporan.aktiviti.excel', request()->all())}}">
                                                <button class="btn btn-success btn-icon" type="button" id="excelBtn"><i class="bi bi-file-earmark-spreadsheet fs-2"></i></button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--begin::Table-->
                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr class="text-center text-gray-400 fw-bold fs-7 gs-0 text-uppercase">
                                <th class="min-w-175px">Nama Aktiviti</th>
                                <th class="min-w-40px">ID</th>
                                <th class="min-w-100px">Kategori</th>
                                <th class="min-w-100px">Tempat</th>
                                <th class="min-w-100px">Negeri Bertugas</th>
                                <th class="min-w-100px">Daerah Bertugas</th>
                                <th class="min-w-50px">Status</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
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
    <script>
        $(document).ready(function(){
            var pegawaiId = $('#pegawaiId').val();
            fetchItems();
            function fetchItems() {
                let tahun = $("#tahun").val();
                let bulan = $("#bulan").val();
                let kategori = $("#kategori").val();
                let negeri = $("#negeri").val();
                let daerah = $("#daerah").val();
                let status = $("#status").val();
                $.ajax({
                    url: '/pelaporan/aktiviti/aktivitiPB/json-filter-aktiviti/' + pegawaiId,
                    method: 'GET',
                    data: {
                        tahun: tahun,
                        bulan: bulan,
                        kategori: kategori,
                        negeri: negeri,
                        daerah: daerah,
                        status: status
                    },
                    success: function(response) {
                        $('#sortTable1').DataTable().destroy();
                        let rows = '';
                        let color = '';
                        let btn = '';
                        let btn2 = '';
                        $.each(response, function(index, program) {
                            if(program.status=='SELESAI'){
                                color = "badge-light-success text-seagreen";
                                btn   = " ";
                                btn2   = "disabled";
                            }

                            else if(program.status=='SEDANG BERLANGSUNG'){
                                color = "badge-light-warning text-darkorange";
                                btn   = " ";
                                btn2   = "disabled";
                            }

                            else if(program.status=='BELUM SELESAI'){
                                color = "badge-light-primary text-royalblue";
                                btn   = "disabled";
                                btn2   = " ";
                            }

                            else if(program.status=='BATAL'){
                                color = "badge-light-red text-darkred";
                                btn   = "disabled";
                                btn2   = "disabled";
                            }

                            else if(program.status=='PINDA'){
                                color = "badge-light-yellow text-darkyellow";
                                btn   = " ";
                                btn2   = " ";
                            }

                            rows += '<tr>';
                            rows += '<td class="text-uppercase"><a href="{{url('/pelaporan/aktiviti/senarai-kehadiran')}}/' + program.id + '">' + program.nama + '</a></td>';
                            rows += '<td class="text-uppercase">' +  program.custom_id+ '</td>';
                            rows += '<td class="text-uppercase">' + program.kategori + '</td>';
                            rows += '<td class="text-uppercase">' + program.tempat + '</td>';
                            rows += '<td class="text-uppercase">' + program.negeri + '</td>';
                            rows += '<td class="text-uppercase">' + program.daerah + '</td>';
                            rows += '<td class="text-uppercase">' + '<span class="badge '+color+' fs-7 fw-bold">' + program.status + '</span>' + '</td>';
                            rows += '</tr>';
                        });
                        $('#sortTable1 tbody').html(rows);
                        // Reinitialize DataTable if necessary
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
                    }
                });
            }
        });
    </script>

    <!--filter negeri daerah-->
    <script>
        $(document).ready(function() {
            $('#negeri').change(function() {
                var negeriId = $(this).val();
                if (negeriId) {
                    $.ajax({
                        url: '/daerah/' + negeriId,
                        type: 'GET',
                        success: function(response) {
                            $('#daerah').empty();
                            $('#daerah').append('<option value="">Pilih Daerah</option>');
                            $.each(response, function(key, daerah) {
                                $('#daerah').append('<option value="' + daerah.kod + '">' + daerah.daerah + '</option>');
                            });
                        }
                    });
                } else {
                    $('#daerah').empty();
                    $('#daerah').append('<option value="">Pilih Daerah</option>');
                }
            });
        });
    </script>

@endsection
