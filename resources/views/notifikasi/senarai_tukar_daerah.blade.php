@extends('layouts._default')

@section('content')
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

        <!-- Custom AADK CSS -->
		<link rel="stylesheet" href="/assets/css/customAADK.css">
        <script src="/assets/lang/Malay.json"></script>
    </head>

    <body>
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Notifikasi</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Notifikasi</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Senarai Klien Bertukar Pejabat Pengawasan</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <div class="card shadow-sm">
            <div class="table-responsive">
                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid d-flex justify-content-center align-items-center">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <ul class="nav nav-tabs pt-5" id="myTab" role="tablist" style="margin-left: 20px;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="masuk-tab" data-toggle="tab" data-target="#masuk" type="button" role="tab" aria-controls="masuk" aria-selected="true">Klien Pindah Masuk</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="keluar-tab" data-toggle="tab" data-target="#keluar" type="button" role="tab" aria-controls="keluar" aria-selected="true">Klien Pindah Keluar</button>
                            </li>
                        </ul>	

                        <div class="tab-content mt-0" id="myTabContent">
                            <!-- Tab for Pindah Masuk -->
                            <div class="tab-pane fade show active" id="masuk" role="tabpanel" aria-labelledby="masuk-tab">
                                <div class="header row align-items-center">
                                    <div class="col">
                                        <h2>Senarai Klien Pindah Masuk<br><small>Klik pada nama klien untuk mengemaskini maklumat peribadi mereka.</small></h2>
                                    </div>
                                </div>

                                <!--begin::Card body-->
                                <div class="body">
                                    <!--begin::Table-->
                                    <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
                                                <th style="width:20% !important; text-align: center;">Nama</th>
                                                <th style="width:15% !important; text-align: center;">No. Kad Pengenalan</th>
                                                <th style="width:15% !important; text-align: center;">Pejabat AADK Daerah Lama</th>
                                                <th style="width:25% !important; text-align: center;">Alamat Rumah Asal</th>
                                                <th style="width:25% !important; text-align: center;">Alamat Rumah Baharu</th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach($klienPindahMasuk as $klien)
                                                @php
                                                    $daerah_lama = DB::table('senarai_daerah_pejabat')->where('kod', $klien->daerah_aadk_asal)->value('senarai_daerah_pejabat.daerah');
                                                    $daerah1 = DB::table('senarai_daerah')->where('id', $klien->daerah_rumah_baru)->value('senarai_daerah.daerah');
                                                    $negeri1 = DB::table('senarai_negeri')->where('id', $klien->negeri_rumah_baru)->value('senarai_negeri.negeri');
                                                    $daerah2 = DB::table('senarai_daerah')->where('id', $klien->daerah_rumah_asal)->value('senarai_daerah.daerah');
                                                    $negeri2 = DB::table('senarai_negeri')->where('id', $klien->negeri_rumah_asal)->value('senarai_negeri.negeri');
                                                    $alamat_rumah_asal1 = $klien->alamat_rumah_asal . ', ' . $klien->poskod_rumah_asal . ', ' . $daerah2 . ', ' . $negeri2;
                                                    $alamat_rumah_baru1 = $klien->alamat_rumah_baru . ', ' . $klien->poskod_rumah_baru . ', ' . $daerah1 . ', ' . $negeri1;
                                                @endphp
                                                <tr>
                                                    <td style="width:20% !important; text-align: center;">{{ $klien->nama }}</td>
                                                    <td style="width:15% !important; text-align: center;">{{ $klien->no_kp }}</td>
                                                    <td style="width:15% !important; text-align: center;">{{ $daerah_lama }}</td>
                                                    <td style="width:25% !important; text-align: center;">{{ $alamat_rumah_asal1 }}</td>
                                                    <td style="width:25% !important; text-align: center;">{{ $alamat_rumah_baru1 }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>

                            <!-- Tab for Pindah Keluar -->
                            <div class="tab-pane fade" id="keluar" role="tabpanel" aria-labelledby="keluar-tab">
                                <div class="header row align-items-center">
                                    <div class="col">
                                        <h2>Senarai Klien Pindah Keluar<br><small>Klik pada nama klien untuk mengemaskini maklumat peribadi mereka.</small></h2>
                                    </div>
                                </div>

                                <!--begin::Card body-->
                                <div class="body">
                                    <!--begin::Table-->
                                    <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
                                                <th style="width:20% !important; text-align: center;">Nama</th>
                                                <th style="width:15% !important; text-align: center;">No. Kad Pengenalan</th>
                                                <th style="width:15% !important; text-align: center;">Pejabat AADK Daerah Baharu</th>
                                                <th style="width:25% !important; text-align: center;">Alamat Rumah Asal</th>
                                                <th style="width:25% !important; text-align: center;">Alamat Rumah Baharu</th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach($klienPindahKeluar as $klien)
                                                @php
                                                    $daerah_baharu = DB::table('senarai_daerah_pejabat')->where('kod', $klien->daerah_aadk_baru)->value('senarai_daerah_pejabat.daerah');
                                                    $daerah1 = DB::table('senarai_daerah')->where('id', $klien->daerah_rumah_baru)->value('senarai_daerah.daerah');
                                                    $negeri1 = DB::table('senarai_negeri')->where('id', $klien->negeri_rumah_baru)->value('senarai_negeri.negeri');
                                                    $daerah2 = DB::table('senarai_daerah')->where('id', $klien->daerah_rumah_asal)->value('senarai_daerah.daerah');
                                                    $negeri2 = DB::table('senarai_negeri')->where('id', $klien->negeri_rumah_asal)->value('senarai_negeri.negeri');
                                                    $alamat_rumah_asal2 = $klien->alamat_rumah_asal . ', ' . $klien->poskod_rumah_asal . ', ' . $daerah2 . ', ' . $negeri2;
                                                    $alamat_rumah_baru2 = $klien->alamat_rumah_baru . ', ' . $klien->poskod_rumah_baru . ', ' . $daerah1 . ', ' . $negeri1;
                                                @endphp
                                                <tr>
                                                    <td style="width:20% !important; text-align: center;">{{ $klien->nama }}</td>
                                                    <td style="width:15% !important; text-align: center;">{{ $klien->no_kp }}</td>
                                                    <td style="width:15% !important; text-align: center;">{{ $daerah_baharu }}</td>
                                                    <td style="width:25% !important; text-align: center;">{{ $alamat_rumah_asal2 }}</td>
                                                    <td style="width:25% !important; text-align: center;">{{ $alamat_rumah_baru2 }}</td>
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
        </script>
    </body>
@endsection