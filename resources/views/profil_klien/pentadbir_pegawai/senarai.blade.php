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
                        <h2>Senarai Klien AADK<br><small>Klik pada nama klien untuk mengemaskini maklumat peribadi mereka.</small></h2>
                    </div>
					<!--end::Card header-->

					<!--begin::Card body-->
					<div class="body">
						<!--begin::Table-->
                        <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
                                    <th class="min-w-150px">Nama</th>
                                    <th class="min-w-100px">No. Kad Pengenalan</th>
                                    <th class="min-w-100px">Daerah</th>
                                    <th class="min-w-70px">Negeri</th>
                                    <th class="min-w-80px" style="text-align: center;">Status Profil Klien</th> 
                                    <th class="min-w-100px" style="text-align: center;">Pengemaskini</th> 
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($klien as $user)
                                    @php
                                        $daerah = DB::table('senarai_daerah')->where('id', $user['daerah'])->value('senarai_daerah.daerah');
                                        $negeri = DB::table('senarai_negeri')->where('id', $user['negeri'])->value('senarai_negeri.negeri');
                                    @endphp

                                    <tr>
                                        <td><a href="{{ url('pentadbir-pegawai/maklumat-klien/'. $user['id']) }}" target="_blank">{{$user->nama}}</a></td>
                                        <td>{{ $user->no_kp }}</td>
                                        <td>{{ $daerah }}</td>
                                        <td>{{ $negeri }}</td>
                                        <td style="text-align: center;">
                                            @if($user->status_kemaskini == 'Kemaskini')
                                                <button class="btn btn-sm text-white" style="background-color:mediumvioletred">MOHON KEMASKINI</button>
                                            @elseif($user->status_kemaskini == 'Baharu')
                                                <button class="btn btn-sm text-white" style="background-color: #787878">BELUM KEMASKINI</button>
                                            @elseif($user->status_kemaskini == 'Lulus')
                                                <button class="btn btn-sm text-white" style="background-color:lightseagreen">DIKEMASKINI</button>
                                            @elseif($user->status_kemaskini == 'Ditolak')
                                                <button class="btn btn-sm text-white bg-info">DITOLAK</button>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">{{ $user->pengemaskini_name ?? 'N/A' }}</td>
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
    </script>
@endsection