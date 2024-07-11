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
        <!-- Custom AADK CSS -->
		<link rel="stylesheet" href="/assets/css/customAADK.css">
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
            <li class="breadcrumb-item text-muted">Senarai Klien</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <!--begin::Body-->
	<div class="card shadow-sm">
		<div class="table-responsive">
			<!--begin::Content-->
			<div id="kt_app_content" class="app-content flex-column-fluid">
				<!--begin::Content container-->
				<div id="kt_app_content_container" class="app-container container-xxl">
					<!--begin::Card header-->
                    <div class="header">
                        <h2>Senarai Keputusan Modal Kepulihan<br><small>Klik pada nama klien untuk lihat atau kemaskini modal kepulihan klien.</small></h2>
                    </div>
					<!--end::Card header-->

					<!--begin::Card body-->
                    <div class="body">
                        <!--begin::Table-->
                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr class="text-gray-400 fw-bold fs-7 gs-0">
                                    <th class="min-w-150px">Nama</th>
                                    <th class="min-w-100px">No. Kad Pengenalan</th>
                                    <th class="min-w-100px">Daerah</th>
                                    <th class="min-w-70px">Negeri</th>
                                    <th class="min-w-50px" style="text-align: center;">Status Menjawab</th> 
                                    <th class="min-w-50px" style="text-align: center;">Skor</th> 
                                    <th class="min-w-50px" style="text-align: center;">Tahap Kepulihan</th> 
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($responses as $response)
                                    @php
                                        $daerah = DB::table('senarai_daerah')->where('id', $response->daerah)->value('senarai_daerah.daerah');
                                        $negeri = DB::table('senarai_negeri')->where('id', $response->negeri)->value('senarai_negeri.negeri');
                                        $tahap_kepulihan = DB::table('tahap_kepulihan')->where('id', $response->tahap_kepulihan_id)->value('tahap_kepulihan.tahap');
                                        $statusMenjawab = ($response->selesai_count == 25) ? 'SELESAI' : 'BELUM SELESAI';
                                    @endphp

                                    <tr>
                                        <td>{{ $response->nama }}</td>
                                        <td>{{ $response->no_kp }}</td>
                                        <td>{{ $daerah }}</td>
                                        <td>{{ $negeri }}</td>
                                        <td class="d-flex justify-content-center">
                                            @if ($statusMenjawab == 'SELESAI')
                                                <button class="btn btn-sm text-white" style="background-color:cadetblue">SELESAI</button>
                                            @else
                                                <button class="btn btn-sm text-white" style="background-color:cornflowerblue">BELUM SELESAI</button>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if ($response->skor)
                                                {{ $response->skor }}
                                            @endif
                                        </td>
                                        <td style="text-align: center">                                        
                                            @if ($response->tahap_kepulihan_id)
                                                @if ($response->tahap_kepulihan_id == 1)
                                                    <button class="btn btn-sm bg-danger text-white">{{ $tahap_kepulihan }}</button>
                                                @elseif ($response->tahap_kepulihan_id == 2)
                                                    <button class="btn btn-sm text-white" style="background-color: orange;">{{ $tahap_kepulihan }}</button>
                                                @elseif ($response->tahap_kepulihan_id == 3)
                                                    <button class="btn btn-sm text-white" style="background-color: yellow">{{ $tahap_kepulihan }}</button>   
                                                @else
                                                    <button class="btn btn-sm bg-success text-white">{{ $tahap_kepulihan }}</button>
                                                @endif
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
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<!--end::Javascript-->
    
    <script>
        $('#sortTable1').DataTable({
                ordering: true, // Enable manual sorting
                order: [], // Disable initial sorting
                language: {
                    url: "/assets/lang/Malay.json"
                }
            });
    </script>
@endsection