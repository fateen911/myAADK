@extends('layouts._default')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <head>
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
                    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="menjawab-tab" data-toggle="tab" data-target="#menjawab" type="button" role="tab" aria-controls="menjawab" aria-selected="true">Menjawab Soal Selidik</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tidakMenjawab-tab" data-toggle="tab" data-target="#tidakMenjawab" type="button" role="tab" aria-controls="tidakMenjawab" aria-selected="true">Tidak Menjawab Soal Selidik</button>
                        </li>
                    </ul>	

                    <div class="tab-content mt-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="menjawab" role="tabpanel" aria-labelledby="menjawab-tab">
                            <!--begin::Card header-->
                            <div class="header">
                                <h2>Senarai Keputusan Klien Menjawab Soal Selidik Modal Kepulihan</h2>
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
                                            <th class="min-w-100px" style="text-align: center;">Daerah</th>
                                            <th class="min-w-70px" style="text-align: center;">Negeri</th>
                                            <th class="min-w-50px" style="text-align: center;">Tarikh Menjawab</th> 
                                            <th class="min-w-50px" style="text-align: center;">Status</th> 
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
                                                <td style="text-align: center;">{{ $daerah }}</td>
                                                <td style="text-align: center;">{{ $negeri }}</td>
                                                <td style="text-align: center">{{ isset($response->updated_at) ? Carbon::parse($response->updated_at)->format('d/m/Y') : 'N/A' }}</td>
                                                <td class="d-flex justify-content-center">
                                                    @if ($statusMenjawab == 'SELESAI')
                                                        <button class="btn btn-sm text-white" style="background-color:cadetblue">SELESAI</button>
                                                    @else
                                                        <button class="btn btn-sm text-white" style="background-color:cornflowerblue">BELUM SELESAI</button>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    @if ($response->skor)
                                                        {{ number_format($response->skor, 3) }}
                                                    @endif
                                                </td>
                                                <td style="text-align: center">                                        
                                                    @if ($response->tahap_kepulihan_id)
                                                        @if ($response->tahap_kepulihan_id == 1)
                                                            <button class="btn btn-sm bg-danger text-white">{{ $tahap_kepulihan }}</button>
                                                        @elseif ($response->tahap_kepulihan_id == 2)
                                                            <button class="btn btn-sm text-white" style="background-color: darkorange;">{{ $tahap_kepulihan }}</button>
                                                        @elseif ($response->tahap_kepulihan_id == 3)
                                                            <button class="btn btn-sm text-white bg-warning">{{ $tahap_kepulihan }}</button>   
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

                        <div class="tab-pane fade" id="tidakMenjawab" role="tabpanel" aria-labelledby="tidakMenjawab-tab">
                            <!--begin::Card header-->
                            <div class="header">
                                <h2>Senarai Klien Tidak Menjawab Soal Selidik Modal Kepulihan</h2>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="body">
                                <!--begin::Table-->
                                <table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr class="text-gray-400 fw-bold fs-7 gs-0">
                                            <th class="min-w-150px">Nama</th>
                                            <th class="min-w-50px">No. Kad Pengenalan</th>
                                            <th class="min-w-70px" style="text-align: center;">Daerah</th>
                                            <th class="min-w-50px" style="text-align: center;">Negeri</th>
                                            <th class="min-w-80px" style="text-align: center;">Tarikh Terakhir Menjawab</th> 
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach($tidakMenjawab as $response2)
                                            @php
                                                $daerah = DB::table('senarai_daerah')->where('id', $response2->daerah)->value('senarai_daerah.daerah');
                                                $negeri = DB::table('senarai_negeri')->where('id', $response2->negeri)->value('senarai_negeri.negeri');
                                            @endphp

                                            <tr>
                                                <td>{{ $response2->nama }}</td>
                                                <td>{{ $response2->no_kp }}</td>
                                                <td style="text-align: center;">{{ $daerah }}</td>
                                                <td style="text-align: center;">{{ $negeri }}</td>
                                                <td style="text-align: center">{{ isset($response2->updated_at) ? Carbon::parse($response2->updated_at)->format('d/m/Y') : 'N/A' }}</td>
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
@endsection