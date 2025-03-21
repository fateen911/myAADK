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

        <style>
            .scrollable-container {
                max-width: 1100px; /* Adjust the height as needed */
                overflow-x: auto;
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
            <li class="breadcrumb-item text-muted">Sejarah</li>
            <!--end::Item-->
             <!--begin::Item-->
             <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Soal Selidik Klien</li>
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
                    {{-- SEJARAH KLIEN --}}
                    <div class="tab-content mt-0" id="myTabContent">
                        <!--begin::Card header-->
                        <div class="header mt-10">
                            <h2>Sejarah Klien Menjawab Soal Selidik Modal Kepulihan
                                <br><small>Sila klik pada butang di kolum 'Tahap Kepulihan' untuk lihat butiran skala bagi setiap modul bagi klien yang selesai menjawab.</small>
                            </h2>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="body">
                            <!--begin::Table-->
                            <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr class="text-gray-400 fw-bold fs-7">
                                        <th style="width: 25%;">Nama</th>
                                        <th style="text-align: center; width: 15%;">No. Kad Pengenalan</th>
                                        <th style="text-align: center; width: 15%;">Tarikh Menjawab</th> 
                                        <th style="text-align: center; width: 15%;">Status</th> 
                                        <th style="text-align: center; width: 5%;">Skor</th> 
                                        <th style="text-align: center; width: 25%;">Tahap Kepulihan</th> 
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($sejarah as $response)
                                        @php
                                            $tahap_kepulihan = DB::table('tahap_kepulihan')->where('id', $response->tahap_kepulihan_id)->value('tahap_kepulihan.tahap');
                                        @endphp

                                        <tr>
                                            <td>{{ $response->nama }}</td>
                                            <td style="text-align: center;">{{ $response->no_kp }}</td>
                                            <td style="text-align: center">{{ isset($response->updated_at) ? Carbon::parse($response->updated_at)->format('d/m/Y') : 'N/A' }}</td>
                                            <td class="d-flex justify-content-center">
                                                @if ($response->status == 'Selesai')
                                                    <span class="badge text-white" style="background-color: cadetblue; padding-top:10px; padding-bottom:10px; width:100px; display: inline-block; text-align: center;">{{ strtoupper($response->status) }}</span>
                                                @else
                                                    <span class="badge text-white" style="background-color: cornflowerblue; padding-top:10px; padding-bottom:10px; width:100px; display: inline-block; text-align: center;">{{ strtoupper($response->status) }}</span>
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
                                                        <button type="button" class="btn btn-sm fs-8" style="background-color: red; padding: 5px 10px !important; width: 250px !important; color:white;" 
                                                            data-bs-toggle="modal" data-bs-target="#skorModal{{ $response->klien_id }}-{{ $response->sesi }}">
                                                            {{ $tahap_kepulihan }}
                                                        </button>
                                                    @elseif ($response->tahap_kepulihan_id == 2)
                                                        <button type="button" class="btn btn-sm fs-8" style="background-color: darkorange; padding: 5px 10px !important; width: 250px !important; color:white;" 
                                                            data-bs-toggle="modal" data-bs-target="#skorModal{{ $response->klien_id }}-{{ $response->sesi }}">
                                                            {{ $tahap_kepulihan }}
                                                        </button>
                                                    @elseif ($response->tahap_kepulihan_id == 3)
                                                        <button type="button" class="btn btn-warning btn-sm fs-8" style="padding: 5px 10px !important; width: 250px !important; color:white;" 
                                                            data-bs-toggle="modal" data-bs-target="#skorModal{{ $response->klien_id }}-{{ $response->sesi }}">
                                                            {{ $tahap_kepulihan }}
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm fs-8" style="background-color: green; padding: 5px 10px !important; width: 250px !important; color:white;" 
                                                            data-bs-toggle="modal" data-bs-target="#skorModal{{ $response->klien_id }}-{{ $response->sesi }}">
                                                            {{ $tahap_kepulihan }}
                                                        </button>
                                                    @endif
                                                @endif

                                                <!-- Modal for showing the scores for the selected sesi -->
                                                <div class="modal fade" id="skorModal{{ $response->klien_id }}-{{ $response->sesi }}" tabindex="-1" aria-labelledby="skorModalLabel{{ $response->klien_id }}-{{ $response->sesi }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" style="text-align: center !important;">
                                                                    Skor Setiap Modal Kepulihan (Sesi {{ $response->sesi }})
                                                                </h3>
                                                                <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                                    <i class="ki-solid ki-cross-circle fs-3"></i>
                                                                </div>
                                                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($clientModals->count())
                                                                    @foreach ($clientModals->groupBy('sesi') as $sesi => $modalData)
                                                                        @if ($sesi == $response->sesi)
                                                                            <h6>Status Keseluruhan Modal Kepulihan: 
                                                                                @if ($response->tahap_kepulihan_id == 1)
                                                                                    <badge class="badge text-white" style="background-color: red; padding:5px;">{{ $tahap_kepulihan }}</badge>
                                                                                @elseif ($response->tahap_kepulihan_id == 2)
                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:5px;">{{ $tahap_kepulihan }}</badge>
                                                                                @elseif ($response->tahap_kepulihan_id == 3)
                                                                                    <badge class="badge text-white bg-warning" style="padding: 5px;">{{ $tahap_kepulihan }}</badge> 
                                                                                @else
                                                                                    <badge class="badge text-white" style="background-color: green; padding:5px;">{{ $tahap_kepulihan }}</badge>
                                                                                @endif
                                                                            </h6>

                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="text-align: center">Modal</th>
                                                                                        <th style="text-align: center">Skor</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($modalData as $modalSkor)
                                                                                        <tr>
                                                                                            <td>Fizikal</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_fizikal >= 1.0 && $modalSkor->modal_fizikal <= 1.5)
                                                                                                    <span class="badge badge-danger" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_fizikal, 2) }}
                                                                                                    </span>
                                                                                                @elseif($modalSkor->modal_fizikal > 1.5 && $modalSkor->modal_fizikal <= 2.5)
                                                                                                    <span class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_fizikal, 2) }}
                                                                                                    </span>
                                                                                                @elseif($modalSkor->modal_fizikal > 2.5 && $modalSkor->modal_fizikal <= 3.5)
                                                                                                    <span class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_fizikal, 2) }}
                                                                                                    </span>
                                                                                                @elseif($modalSkor->modal_fizikal > 3.5 && $modalSkor->modal_fizikal <= 4.0)
                                                                                                    <span class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_fizikal, 2) }}
                                                                                                    </span>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Psikologi</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_psikologi >= 1.0 && $modalSkor->modal_psikologi <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_psikologi, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_psikologi > 1.5 && $modalSkor->modal_psikologi <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_psikologi, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_psikologi > 2.5 && $modalSkor->modal_psikologi <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_psikologi, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_psikologi > 3.5 && $modalSkor->modal_psikologi <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_psikologi, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Sosial</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_sosial >= 1.0 && $modalSkor->modal_sosial <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_sosial, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_sosial > 1.5 && $modalSkor->modal_sosial <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_sosial, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_sosial > 2.5 && $modalSkor->modal_sosial <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_sosial, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_sosial > 3.5 && $modalSkor->modal_sosial <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_sosial, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Persekitaran</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_persekitaran >= 1.0 && $modalSkor->modal_persekitaran <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_persekitaran, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_persekitaran > 1.5 && $modalSkor->modal_persekitaran <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_persekitaran, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_persekitaran > 2.5 && $modalSkor->modal_persekitaran <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_persekitaran, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_persekitaran > 3.5 && $modalSkor->modal_persekitaran <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_persekitaran, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Insaniah</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_insaniah >= 1.0 && $modalSkor->modal_insaniah <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_insaniah, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_insaniah > 1.5 && $modalSkor->modal_insaniah <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_insaniah, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_insaniah > 2.5 && $modalSkor->modal_insaniah <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_insaniah, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_insaniah > 3.5 && $modalSkor->modal_insaniah <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_insaniah, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Strategi Daya Tahan</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_strategi_daya_tahan >= 1.0 && $modalSkor->modal_strategi_daya_tahan <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_strategi_daya_tahan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_strategi_daya_tahan > 1.5 && $modalSkor->modal_strategi_daya_tahan <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_strategi_daya_tahan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_strategi_daya_tahan > 2.5 && $modalSkor->modal_strategi_daya_tahan <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_strategi_daya_tahan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_strategi_daya_tahan > 3.5 && $modalSkor->modal_strategi_daya_tahan <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_strategi_daya_tahan, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Resiliensi</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_resiliensi >= 1.0 && $modalSkor->modal_resiliensi <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_resiliensi, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_resiliensi > 1.5 && $modalSkor->modal_resiliensi <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_resiliensi, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_resiliensi > 2.5 && $modalSkor->modal_resiliensi <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_resiliensi, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_resiliensi > 3.5 && $modalSkor->modal_resiliensi <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_resiliensi, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Spiritual</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_spiritual >= 1.0 && $modalSkor->modal_spiritual <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_spiritual, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_spiritual > 1.5 && $modalSkor->modal_spiritual <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_spiritual, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_spiritual > 2.5 && $modalSkor->modal_spiritual <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_spiritual, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_spiritual > 3.5 && $modalSkor->modal_spiritual <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_spiritual, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Rawatan</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_rawatan >= 1.0 && $modalSkor->modal_rawatan <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_rawatan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_rawatan > 1.5 && $modalSkor->modal_rawatan <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_rawatan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_rawatan > 2.5 && $modalSkor->modal_rawatan <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_rawatan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_rawatan > 3.5 && $modalSkor->modal_rawatan <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_rawatan, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>Kesihatan</td>
                                                                                            <td>
                                                                                                @if($modalSkor->modal_kesihatan >= 1.0 && $modalSkor->modal_kesihatan <= 1.5)
                                                                                                    <badge class="badge badge-danger"class="badge text-white" style="background-color: red; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT TIDAK MEMUASKAN <br><br> 
                                                                                                        {{ number_format($modalSkor->modal_kesihatan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_kesihatan > 1.5 && $modalSkor->modal_kesihatan <= 2.5)
                                                                                                    <badge class="badge text-white" style="background-color: darkorange; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        KURANG MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_kesihatan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_kesihatan > 2.5 && $modalSkor->modal_kesihatan <= 3.5)
                                                                                                    <badge class="badge text-white bg-warning" style="padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_kesihatan, 2) }}
                                                                                                    </badge>
                                                                                                @elseif($modalSkor->modal_kesihatan > 3.5 && $modalSkor->modal_kesihatan <= 4.0)
                                                                                                    <badge class="badge text-white" style="background-color: green; padding:10px; width:180px; display: inline-block; text-align: center;">
                                                                                                        SANGAT MEMUASKAN <br><br>
                                                                                                        {{ number_format($modalSkor->modal_kesihatan, 2) }}
                                                                                                    </badge>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>

                                                                            <div style="display: block;">
                                                                                <badge class="badge text-white" style="background-color: green; padding:5px; display: inline-block; width: 250px; text-align: center; margin-bottom: 5px;">
                                                                                    {{ '3.51 - 4.0 (SANGAT MEMUASKAN)' }}
                                                                                </badge>
                                                                                <br>
                                                                                <badge class="badge text-white bg-warning" style="padding:5px; display: inline-block; width: 250px; text-align: center; margin-bottom: 5px;">
                                                                                    {{ '2.51 - 3.5 (MEMUASKAN)' }}
                                                                                </badge>
                                                                                <br>
                                                                                <badge class="badge text-white" style="background-color: darkorange; padding:5px; display: inline-block; width: 250px; text-align: center; margin-bottom: 5px;">
                                                                                    {{ '1.51 - 2.5 (KURANG MEMUASKAN)' }}
                                                                                </badge>
                                                                                <br>
                                                                                <badge class="badge text-white" style="background-color: red; padding:5px; display: inline-block; width: 250px; text-align: center; margin-bottom: 5px;">
                                                                                    {{ '1.0 - 1.5 (SANGAT TIDAK MEMUASKAN)' }}
                                                                                </badge>
                                                                            </div>
                                                                        @else
                                                                            <p>Tiada skor modal untuk sesi ini.</p>    
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <p>Tiada skor untuk setiap modal kepulihan kerana ini adalah data perintis.</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>                    
                        <!--end::Card body-->
                    </div>
				</div>
				<!--end::Content container-->
			</div>
			<!--end::Content-->
		</div>
	</div>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    
    <script>
        $('#sortTable1').DataTable({
                ordering: true, 
                order: [], 
                language: {
                    url: "/assets/lang/Malay.json"
                }
        });
    </script>
@endsection