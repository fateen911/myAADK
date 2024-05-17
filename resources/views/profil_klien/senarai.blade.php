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
					<div class="card-header border-0 pt-6">
						<!--begin::Card title-->
						<div class="card-title">
                            Senarai Klien AADK
						</div>
						<!--begin::Card title-->

						<!--begin::Card toolbar-->
						{{-- <div class="card-toolbar">
							<!--begin::Toolbar-->
							<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
								<!--begin::Add customer-->
								<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Tambah Pengguna</button>
								<!--end::Add customer-->
							</div>
							<!--end::Toolbar-->
						</div> --}}
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->

					<!--begin::Card body-->
					{{-- <div class="card-body pt-0"> --}}
                    <div class="body">
						<!--begin::Table-->
						<div class="table-responsive">
							{{-- <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table"> --}}
                            <table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
								<thead>
									<tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
										<th class="min-w-125px">Nama</th>
                                        <th class="min-w-125px">No. Kad Pengenalan</th>
                                        <th class="min-w-125px">Daerah</th>
                                        <th class="min-w-125px">Negeri</th> 
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600">
									@foreach ($user as $user)
                                        @php
                                            $text = ucwords(strtolower($user->name)); // Assuming you're sending the text as a POST parameter
                                            $conjunctions = ['bin', 'binti'];
                                            $words = explode(' ', $text);
                                            $result = [];
                                            foreach ($words as $word) {
                                                if (in_array(Str::lower($word), $conjunctions)) {
                                                    $result[] = Str::lower($word);
                                                } else {
                                                    $result[] = $word;
                                                }
                                            }
                                            $nama_user = implode(' ', $result);
                                        @endphp

                                        <tr>
                                            <td><a href="{{ url('maklumat-klien/'. $user['id']) }}" target="_blank">{{$user->name}}</a></td>
                                            <td>{{ $user->no_kp }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->status }}</td>
                                        </tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
						<!--end::Table-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Content container-->
			</div>
			<!--end::Content-->
		</div>
	</div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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