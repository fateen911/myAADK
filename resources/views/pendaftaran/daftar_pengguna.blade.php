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
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pendaftaran</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Pendaftaran</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Senarai Pengguna</li>
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
						<div class="header p-0 m-0">
                            <h2>Senarai Keseluruhan Pengguna Sistem AADK<br><small>Sila klik pada butang "Tambah Pengguna" untuk mendaftarkan pengguna baharu.</small></h2>	
						</div>
						
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							<!--begin::Toolbar-->
							<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
								<!--begin::Add customer-->
								<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Tambah Pengguna</button>
								<!--end::Add customer-->
							</div>
							<!--end::Toolbar-->
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->

					<!--begin::Card body-->
                    <div class="body">
						<!--begin::Table-->
						<table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
							<thead>
								<tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
									<th class="min-w-175px">Nama</th>
									<th class="min-w-125px">No. Kad Pengenalan</th>
									<th class="min-w-125px">Emel</th>
									<th class="min-w-125px">Peranan</th>
									<th class="min-w-125px">Tarikh Daftar</th>
									<th class="min-w-75px">Tindakan</th>
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

										$peranan = DB::table('tahap_pengguna')->where('id', $user['tahap_pengguna'])->value('jawatan');
									@endphp

									<tr>
										<td>{{ $user->name }}</td>
										<td>{{ $user->no_kp }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $peranan }}</td>
										<td>{{ $user->created_at->format('d/m/Y h:i:sa') }}</td>
										<td>
											<div class="d-flex justify-content-center align-items-center">
												<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card{{$user->id}}">
													<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
														<i class="ki-duotone bi bi-pencil fs-3"></i>
													</span>
												</a>
											</div>                                                
										</td>

										<!--begin::Modal - Customers - Edit-->
										<div class="modal fade" id="kt_modal_new_card{{$user->id}}" tabindex="-1" aria-hidden="true">
											<!--begin::Modal dialog-->
											<div class="modal-dialog modal-dialog-centered mw-650px">
												<!--begin::Modal content-->
												<div class="modal-content">
													<!--begin::Modal header-->
													<div class="modal-header">
														<!--begin::Modal title-->
														<h2>Kemaskini Maklumat Akaun Pengguna</h2>
														<!--end::Modal title-->
														<!--begin::Close-->
														<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
															<i class="ki-duotone ki-cross fs-1">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</div>
														<!--end::Close-->
													</div>
													<!--end::Modal header-->

													<!--begin::Modal body-->
													<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
														<!--begin::Form-->
														<form class="form" id="kt_modal_new_card_form" action="{{ route('kemaskini-pengguna') }}" method="post">
															@csrf

															<input type="hidden" name="id" value="{{ $user->id }}">
															<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
																<!--begin::Input group-->
																<div class="fv-row mb-7">
																	<!--begin::Label-->
																	<label class="fs-6 fw-semibold mb-2">Nama</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{$user->name}}" />
																	<!--end::Input-->
																</div>
																<!--end::Input group-->
																<!--begin::Input group-->
																<div class="fv-row mb-7">
																	<!--begin::Label-->
																	<label class="fs-6 fw-semibold mb-2">Emel</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input type="email" class="form-control form-control-solid" placeholder="" name="email" value="{{$user->email}}" />
																	<!--end::Input-->
																</div>
																<!--end::Input group-->
																<!--begin::Input group-->
																<div class="fv-row mb-7">
																	<!--begin::Label-->
																	<label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" name="no_kp" value="{{$user->no_kp}}"/>
																	<!--end::Input-->
																</div>
																<!--end::Input group-->
																<!--begin::Input group-->
																<div class="fv-row mb-7">
																	<!--begin::Label-->
																	<label class="fs-6 fw-semibold mb-2">Kata Laluan Baharu</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<div class="input-group">
																		<input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" id="password{{$user->id}}" name="password" />
																		<button type="button" class="btn btn-secondary" onclick="generatePassword('password{{$user->id}}')">Jana Kata Laluan</button>
																	</div>
																	<!--end::Input-->
																</div>
																<!--end::Input group-->
																<!--begin::Input group-->
																<div class="fv-row mb-7">
																	<!--begin::Label-->
																	<label class="fs-6 fw-semibold mb-2">Peranan</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<select name="tahap_pengguna" id="tahap_pengguna" class="form-select form-select-solid" data-placeholder="Pilih">
																		@foreach ($tahap->sortBy('jawatan') as $tahap1)
																			<option value="{{$tahap1->id}}" {{$user->tahap_pengguna == $tahap1->id  ? 'selected' : ''}}>{{$tahap1->jawatan}}</option>
																		@endforeach
																	</select>
																	<!--end::Input-->
																</div>
																<!--end::Input group-->
															</div>
															<!--end::Scroll-->

															<!--begin::Actions-->
															<div class="text-center pt-15">
																<button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
																	<span class="indicator-label">Simpan</span>
																	<span class="indicator-progress">Sila tunggu...
																	<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
																</button>
															</div>
															<!--end::Actions-->
														</form>
														<!--end::Form-->
													</div>
													<!--end::Modal body-->
												</div>
												<!--end::Modal content-->
											</div>
											<!--end::Modal dialog-->
										</div>
										<!--end::Modal - Customers - Edit-->
									</tr>
								@endforeach
							</tbody>
						</table>
						<!--end::Table-->
					</div>
					<!--end::Card body-->

					<!--begin::Modal - Customers - Add-->
					<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-dialog-centered mw-650px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Form-->
								<form class="form" action="{{ route('daftar-pengguna') }}" method="post" data-kt-redirect="{{ route('senarai-pengguna') }}">
									@csrf
									<!--begin::Modal header-->
									<div class="modal-header" id="kt_modal_add_customer_header">
										<!--begin::Modal title-->
										<h2 class="fw-bold">Tambah Pengguna</h2>
										<!--end::Modal title-->
										<!--begin::Close-->
										<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
											<i class="ki-duotone ki-cross fs-1">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
										</div>
										<!--end::Close-->
									</div>
									<!--end::Modal header-->

									<!--begin::Modal body-->
									<div class="modal-body py-10 px-lg-17">
										<!--begin::Scroll-->
										<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Nama</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" class="form-control form-control-solid" placeholder="" id="name" name="name"/>
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">Emel</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="email" class="form-control form-control-solid" placeholder="" id="email" name="email" value="" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<!--begin::Label-->
												<label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
												<!--end::Label-->
												<!--begin::Input-->
												<input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" id="no_kp" name="no_kp" />
												<!--end::Input-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="fv-row mb-7">
												<label class="fs-6 fw-semibold mb-2">Peranan</label>
												<select name="tahap_pengguna" id="tahap_pengguna" class="form-select form-select-solid fw-bold">
													<option value="">Pilih</option>
													@foreach ($tahap->sortBy('jawatan') as $t)
														<option value="{{ $t->id }}">{{ $t->jawatan }}</option>
													@endforeach
												</select>
											</div>
											<div class="fv-row mb-7 d-none" id="div-jawatan">
												<label class="fs-6 fw-semibold mb-2">Jawatan</label>
												<input type="text" class="form-control form-control-solid" id="jawatan" name="jawatan"/>
											</div>
											<!--end::Input group-->
										</div>
										<!--end::Scroll-->
									</div>
									<!--end::Modal body-->

									<!--begin::Modal footer-->
									<div class="modal-footer flex-center">
										<!--begin::Button-->
										<button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>
										<!--end::Button-->
										<!--begin::Button-->
										<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
											<span class="indicator-label">Hantar</span>
											<span class="indicator-progress">Tunggu sebentar...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
										<!--end::Button-->
									</div>
									<!--end::Modal footer-->
								</form>
								<!--end::Form-->
							</div>
						</div>
					</div>
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

    <script>
        $('#sortTable1').DataTable({
                ordering: true, // Enable manual sorting
                order: [], // Disable initial sorting
                language: {
                    url: "/assets/lang/Malay.json"
                }
            });
    </script>

    <script>
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
			});
	</script>

	<script>
		$(document).ready(function() 
		{
			// Verify jQuery is loaded
			if (typeof $ !== 'undefined') {
                console.log('jQuery is loaded');
            } else {
                console.log('jQuery is not loaded');
            }

			// Initialize Select2
			$('#tahap_pengguna').select2();

			function toggleJawatanField() {
				var selectedValue = $('#tahap_pengguna').val();
				console.log('Selected value:', selectedValue);

				if (selectedValue == '3' || selectedValue == '4' || selectedValue == '5') {
					$('#div-jawatan').removeClass('d-none');
				} else {
					$('#div-jawatan').addClass('d-none');
				}
			}

			// Handle change event
			$('#tahap_pengguna').on('change', function() {
				toggleJawatanField();
			});

			// Initial call to set visibility based on default value
			toggleJawatanField();
		});
	</script>
	
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there is a flash message
            @if(session('message'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya!',
                    text: '{!! session('message') !!}',
                    confirmButtonText: 'OK'
                });
            @endif

            // Check if there is a flash error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Berjaya!',
                    text: '{!! session('error') !!}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>

	<!-- Add this script at the end of your HTML body -->
	<script>
		function generatePassword(inputId) {
			const length = 12;
			const lowercase = 'abcdefghijklmnopqrstuvwxyz';
			const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			const numbers = '0123456789';
			const symbols = '!@#$%^&*()-_+=<>?';
			
			const allCharacters = lowercase + uppercase + numbers + symbols;
			let password = '';
			
			// Ensure the password contains at least one character from each category
			password += lowercase[Math.floor(Math.random() * lowercase.length)];
			password += uppercase[Math.floor(Math.random() * uppercase.length)];
			password += numbers[Math.floor(Math.random() * numbers.length)];
			password += symbols[Math.floor(Math.random() * symbols.length)];
			
			// Fill the remaining length of the password with random characters from all categories
			for (let i = 4; i < length; i++) {
				password += allCharacters[Math.floor(Math.random() * allCharacters.length)];
			}
			
			// Shuffle the password to ensure a random order
			password = password.split('').sort(() => 0.5 - Math.random()).join('');
			
			document.getElementById(inputId).value = password;
		}
	</script>	
@endsection
