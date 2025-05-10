@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
	<!--begin::Vendor Stylesheets(used for this page only)-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

	<!-- Custom AADK CSS -->
	<script src="/assets/lang/Malay.json"></script>
	<link rel="stylesheet" href="/assets/css/customAADK.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

	<style>
		.btn-icon {
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.d-none {
			display: none;
		}

		.input-group {
			display: flex;
			align-items: center;
		}

		.input-group-text {
			background-color: #f3f3f3;
			padding: 0.75rem 0.75rem;
			margin-left: -1px;
		}

		.form-control {
			flex: 1;
		}

		input.form-control.form-control-solid.custom-form,
        textarea.form-control.form-control-solid.custom-form {
            background-color: #e0e0e0;
            color: #45505b;
        }

        input.form-control.form-control-solid.custom-form:focus,
        textarea.form-control.form-control-solid.custom-form:focus {
            background-color: #d0d0d0;
            color: #333333;
            box-shadow: none;
        }

        .form-select.custom-select {
            background-color: #e0e0e0 !important;
            color: #222222 !important;
        }

        .form-select.custom-select option {
            background-color: #f5f5f5 !important;
            color: #222222 !important;
        }

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

		@media (max-width: 768px) {
			/* Adjust Nav tabs for mobile */
			.nav-tabs {
				flex-wrap: wrap; /* Stack tabs vertically */
			}
			.nav-tabs .nav-item {
				flex: 1 1 100% !important; /* Full width for each tab */
			}
			.nav-tabs .nav-link {
				text-align: center;
				margin-bottom: 5px;
			}
			#kt_app_content_container {
				padding: 0 !important;
			}
			.col-auto {
				padding-top: 10px;
			}
		}
	</style>
</head>

<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Senarai Pengguna</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">Akaun Pengguna</li>
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
<div class="card shadow-sm mx-w-300 mx-w-450 mw-r-700">
	<div class="table-responsive">
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-xxl">
				{{-- Nav Bar --}}
				<ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="permohonan-pegawai-tab" data-toggle="tab" data-target="#permohonan-pegawai" type="button" role="tab" aria-controls="permohonan-pegawai" aria-selected="true">Pegawai Mohon Mendaftar</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="pegawai-tab" data-toggle="tab" data-target="#pegawai" type="button" role="tab" aria-controls="pegawai" aria-selected="true">Pegawai AADK</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="klien-tab" data-toggle="tab" data-target="#klien" type="button" role="tab" aria-controls="klien" aria-selected="true">Klien AADK</button>
					</li>
				</ul>

				{{-- Content Navigation Bar --}}
				<div class="tab-content mt-0" id="myTabContent">
					{{-- PERMOHONAN DAFTAR PEGAWAI --}}
					<div class="tab-pane fade show active" id="permohonan-pegawai" role="tabpanel" aria-labelledby="permohonan-pegawai-tab">
						<div class="header row align-items-center">
							<div class="col">
								<h2>Senarai Permohonan Pendaftaran Pegawai sebagai Pengguna Baharu Sistem</h2>
								<small>Sila klik pada ikon pensil untuk lihat maklumat pegawai baharu serta luluskan permohonan pendaftaran sebagai pengguna sistem.</small>
							</div>
						</div>

						<!--begin::Card body-->
						<div class="body">
							<!--begin::Table-->
							<table id="sortTable3" class="table table-striped table-hover dataTable js-exportable">
								<thead>
									<tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
										<th class="min-w-175px">Nama</th>
										<th class="min-w-125px">No. Kad Pengenalan</th>
										<th class="min-w-125px">E-mel</th>
										<th class="min-w-125px">Peranan</th>
										<th class="min-w-150px">Negeri Bertugas (Daerah Bertugas)</th>
										<th class="min-w-50px">Kelulusan</th>
									</tr>
								</thead>

								<tbody class="fw-semibold text-gray-600">
									<!-- Data will be populated here by AJAX -->
                                    <tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
                                        <td class="min-w-175px">Tiada</td>
                                        <td class="min-w-125px">Tiada</td>
                                        <td class="min-w-125px">Tiada</td>
                                        <td class="min-w-125px">Tiada</td>
                                        <td class="min-w-150px">Tiada</td>
                                        <td class="min-w-50px">Tiada</td>
                                    </tr>
								</tbody>
							</table>
							<!--end::Table-->

							<!-- Modal-->
                            <div class="modal fade modal-lg" id="modal_permohonan_pegawai" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" style="padding-left: 50px !important;">Semakan Permohonan Pegawai</h3>
											<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
												<i class="ki-solid ki-cross-circle fs-1"></i>
											</div>
                                        </div>

                                        <div class="modal-body scroll-y mx-5 mx-xl-15" id="modalBodyPermohonanPegawai"></div>
                                    </div>
                                </div>
                            </div>

							<!-- Modal-->
							<div class="modal fade modal-lg" id="modal_permohonan_ditolak" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h3 class="modal-title" style="padding-left: 50px !important;">Alasan Permohonan Pegawai Ditolak</h3>
											<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
												<i class="ki-solid ki-cross-circle fs-1"></i>
											</div>
										</div>
							
										<div class="modal-body scroll-y mx-5 mx-xl-15" id="modalBodyPermohonanPegawaiDitolak"></div>
									</div>
								</div>
							</div>
						</div>
						<!--end::Card body-->
					</div>

					{{-- PEGAWAI --}}
					<div class="tab-pane fade" id="pegawai" role="tabpanel" aria-labelledby="pegawai-tab">
						<div class="header row align-items-center">
							<div class="col">
								<h2>Senarai Keseluruhan Pegawai</h2>
								<small>Sila klik pada butang "Daftar Pegawai" untuk mendaftar pegawai baharu dan klik pada ikon pensil untuk kemaskini akaun pegawai.</small>
							</div>

							<!--begin::Card toolbar-->
							<div class="col-auto">
								<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
									<i class="bi bi-plus-circle"></i> &nbsp;Daftar Pegawai
								</button>
							</div>
							<!--end::Card toolbar-->
						</div>

						<!--begin::Card body-->
						<div class="body">
							<!--begin::Table-->
							<table id="sortTable2" class="table table-striped table-hover dataTable js-exportable">
								<thead>
									<tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
										<th class="min-w-150px">Nama</th>
										<th class="min-w-125px">No. Kad Pengenalan</th>
										<th class="min-w-100px">E-mel</th>
										<th class="min-w-100px">Peranan</th>
										<th class="min-w-150px">Negeri Bertugas (Daerah Bertugas)</th>
										<th class="min-w-75px">Tarikh Daftar</th>
										<th class="min-w-50px">Kemaskini</th>
									</tr>
								</thead>

								<tbody class="fw-semibold text-gray-600">
									<!-- Data will be populated here by AJAX -->
                                    <tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
                                        <td class="min-w-150px">Tiada</td>
                                        <td class="min-w-125px">Tiada</td>
                                        <td class="min-w-100px">Tiada</td>
                                        <td class="min-w-100px">Tiada</td>
                                        <td class="min-w-150px">Tiada</td>
                                        <td class="min-w-75px">Tiada</td>
                                        <td class="min-w-50px">Tiada</td>
                                    </tr>
								</tbody>
							</table>
							<!--end::Table-->

                            <!-- Modal-->
                            <div class="modal fade modal-lg" id="modal_kemaskini_pegawai" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" style="padding-left: 50px !important;">Kemaskini Maklumat Pegawai</h3>
											<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
												<i class="ki-solid ki-cross-circle fs-1"></i>
											</div>
                                        </div>

                                        <div class="modal-body scroll-y mx-5 mx-xl-15" id="modalBodyPegawai"></div>
                                    </div>
                                </div>
                            </div>
						</div>
						<!--end::Card body-->
					</div>

					{{-- KLIEN --}}
					<div class="tab-pane fade" id="klien" role="tabpanel" aria-labelledby="klien-tab">
						<div class="row m-5">
							<!--begin::Col-->
							<div class="col-xl-3">
								<!--begin::Engage widget 9-->
								<div class="card h-lg-100" style="background:  #ffffff )">
									<!--begin::Body-->
									<div class="card-body">
										<!--begin::Row-->
										<div class="row align-items-center">
											<!--begin::form-->
											<form class="form w-100" action="{{ route('semak.kp') }}" method="post">
											@csrf 
												<!--begin::Heading-->
												<div class="text-center mb-11">
													<br>
													<h2 class="text-dark fw-bolder mb-3">
														Sistem MyAADK
													</h2>
												</div>
												<!--end::Heading-->

												<!--begin::logo-->
												<div class="text-center mb-11">
													<img src="{{ asset('logo/aadk.png') }}" alt="Logo" style="height: 120px; width: auto;">
												</div>
												<!--end::logo-->

												<!--begin::Input group-->
												<div class="col-xs-3">
													<input type="text" placeholder="No Kad Pengenalan" name="no_kp" maxlength="12" autocomplete="off" class="form-control bg-transparent" style="text-align:center; display: block;margin-left: auto; margin-right: auto;" required oninvalid="this.setCustomValidity('Sila isi.')" oninput="setCustomValidity('')"/>
												</div>
												<!--end::Input group-->

												<!--begin::Submit button-->
												<div class="d-flex flex-center mt-5">
													<button type="submit" class="btn btn-primary">Semak</button>
												</div>
												<!--end::Submit button-->
											</form>
										</div>
									</div>
									<!--end::Body-->
								</div>
							</div>
							<!--end::Col-->
							
							<!--begin::Col-->
							<div class="col-xl-9">
								<div class="card card-flush h-xl-100">
									<!--begin::Header-->
									<div class="card-header pt-5">
										<h2>Senarai Keseluruhan Klien<br><small>Sila klik pada ikon pensil untuk mendaftar klien sebagai pengguna sistem atau mengemaskini maklumat akaun klien.</small></h2>
									</div>
									<!--end::Header-->

									<!--begin::Body-->
									<div class="body">
										<!--begin::Table container-->
										<div class="table-responsive">
											<!--begin::Table-->
											<table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
												<thead>
													<tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
														<th class="min-w-250px">Nama</th>
														<th class="min-w-50px">No. Kad Pengenalan</th>
														<th class="min-w-50px">E-mel</th>
														<th class="min-w-60px" style="text-align: center;">Tarikh Daftar</th>
														<th class="min-w-40px" style="text-align: center;">Kemaskini</th>
													</tr>
												</thead>

												<tbody class="fw-semibold text-gray-600">
													<!-- Data will be injected here by AJAX -->
													<td class="min-w-250px">Tiada</td>
													<td class="min-w-50px">Tiada</td>
													<td class="min-w-50px">Tiada</td>
													<td class="min-w-60px">Tiada</td>
													<td class="min-w-40px">Tiada</td>
												</tbody>
											</table>
											<!--end::Table-->

											<!--begin::Modal - Kemaskini Klien-->
											<div class="modal fade" id="modal_kemaskini_klien" tabindex="-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered mw-650px">
													<div class="modal-content">
														<div class="modal-header">
															<!--begin::Modal title-->
															<h2 style="padding-left: 50px !important;">Kemaskini Maklumat Akaun Klien</h2>
															<!--end::Modal title-->
															<!--begin::Close-->
															<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
																<i class="ki-solid ki-cross-circle fs-1"></i>
															</div>
															<!--end::Close-->
														</div>

														<div class="modal-body scroll-y mx-5 mx-xl-15" id="modalBodyKemaskiniKlien"></div>
													</div>
												</div>
											</div>
											<!--end::Modal - Kemaskini Klien-->

											
										</div>
										<!--end::Table container-->
									</div>
									<!--end::Body-->
								</div>
								<!--end::Table Widget 9-->
							</div>
						</div>
					</div>
				</div>

				<!--begin::Modal - Daftar Pegawai-->
				<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
					<!--begin::Modal dialog-->
					<div class="modal-dialog modal-dialog-centered mw-650px">
						<!--begin::Modal content-->
						<div class="modal-content">
							<!--begin::Form-->
							<form class="form" id="kt_modal_add_customer_form" action="{{ route('daftar-pegawai') }}" method="post" data-kt-redirect="{{ route('senarai-pengguna') }}">
								@csrf
								<!--begin::Modal header-->
								<div class="modal-header" id="kt_modal_add_customer_header">
									<!--begin::Modal title-->
									<h2 class="fw-bold" style="padding-left: 40px !important;">Pendaftaran Pegawai Baharu</h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
										<i class="ki-solid ki-cross-circle fs-1"></i>
									</div>
									<!--end::Close-->
								</div>
								<!--end::Modal header-->

								<!--begin::Modal body-->
								<div class="modal-body py-10 px-lg-17">
									<!--begin::Scroll-->
									<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<label class="fs-6 fw-semibold mb-2 required">Nama Penuh</label>
											<input type="text" class="form-control form-control-solid custom-form" id="name" name="name" style="text-transform: uppercase;" required/>
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<label class="fs-6 fw-semibold mb-2 required">No. Kad Pengenalan
												<span class="ms-1" data-bs-toggle="tooltip" title="Masukkan no kad pengenalan tanpa '-'.">
													<i class="ki-duotone ki-information-2 text-gray-500 fs-6">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span>
											</label>
											<input type="text" class="form-control form-control-solid custom-form" placeholder="Contoh: 950506019001" id="no_kp_pegawai_baru" name="no_kp" inputmode="numeric" pattern="[0-9]*" pattern="\d{12}" required/>
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<label class="fs-6 fw-semibold mb-2 required">E-mel</label>
											<div class="input-group">
												<input type="text" class="form-control form-control-solid custom-form" placeholder="contoh12" id="emailPegawai" name="emailPegawai" required />
												<span class="input-group-text">@aadk.gov.my</span>
											</div>
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<label class="fs-6 fw-semibold mb-2 required">No. Telefon
												<span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
													<i class="ki-duotone ki-information-2 text-gray-500 fs-6">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span>
											</label>
											<input type="text" class="form-control form-control-solid custom-form" placeholder="Contoh: 0139001234" id="no_tel_pegawai_baru" name="no_tel" inputmode="numeric" pattern="\d{10,11}" required/>
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<label class="fs-6 fw-semibold mb-2 required">Jawatan & Gred</label>
											<select name="jawatan" id="jawatan" class="form-select form-select-solid custom-select">
												<option value="">Pilih Jawatan & Gred</option>
												@foreach ($jawatan as $j)
													<option value="{{ $j->id }}">{{ $j->jawatan_gred }}</option>
												@endforeach
											</select>
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<label class="fs-6 fw-semibold mb-2 required">Peranan</label>
											<select name="peranan_pegawai" id="peranan_pegawai" class="form-select form-select-solid custom-select">
												<option value="">Pilih Peranan</option>
												@foreach ($tahap->sortBy('jawatan') as $t)
													<option value="{{ $t->id }}">{{ $t->peranan }}</option>
												@endforeach
											</select>
										</div>
										<!--end::Input group-->
										<div class="fv-row mb-5" id="daftar_negeri_field">
											<label class="fs-6 fw-semibold mb-2 required">Negeri Bertugas</label>
											<select name="daftar_negeri_bertugas" id="daftar_negeri_bertugas" class="form-select form-select-solid custom-select">
												<option value="">Pilih Negeri Bertugas</option>
												@foreach ($negeri as $item1)
													<option value="{{ $item1->negeri_id }}" data-id="{{ $item1->negeri_id }}">{{ $item1->negeri }}</option>
												@endforeach
											</select>
										</div>
										<div class="fv-row mb-5" id="daftar_daerah_field">
											<label class="fs-6 fw-semibold mb-2 required">Daerah Bertugas</label>
											<select name="daftar_daerah_bertugas" id="daftar_daerah_bertugas" class="form-select form-select-solid custom-select">
												<option value="">Pilih Daerah Bertugas</option>
												@foreach ($daerah as $item2)
													<option value="{{ $item2->kod }}" data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>
												@endforeach
											</select>
										</div>
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
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
										</span>
									</button>
									<!--end::Button-->
								</div>
								<!--end::Modal footer-->
							</form>
							<!--end::Form-->
						</div>
					</div>
				</div>
				<!--end::Modal - Daftar Pegawai-->

				<!--begin::Modal - Daftar Klien-->
				<div class="modal fade" id="modal_daftar_klien" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered mw-650px">
						<div class="modal-content">
							<div class="modal-header">
								<!--begin::Modal title-->
								<h2 style="padding-left: 50px !important;">Pendaftaran Akaun Klien</h2>
								<!--end::Modal title-->
								<!--begin::Close-->
								<div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
									<i class="ki-solid ki-cross-circle fs-1"></i>
								</div>
								<!--end::Close-->
							</div>

							<div class="modal-body scroll-y mx-5 mx-xl-15" id="modalBodyDaftarKlien"></div>
						</div>
					</div>
				</div>
				<!--end::Modal - Daftar Klien-->

			</div>
			<!--end::Content container-->
		</div>
		<!--end::Content-->
	</div>
</div>

    <!--begin::Javascript-->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<!--end::Javascript-->

	{{-- Popup alert success/error message --}}
    <script>
        document.addEventListener('DOMContentLoaded', function ()
        {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya Didaftarkan!',
                    text: '{!! session('success') !!}',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Didaftarkan!',
                    text: '{!! session('error') !!}',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('message'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya Dikemaskini!',
                    text: '{!! session('message') !!}',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('warning'))
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Dikemaskini!',
                    text: '{!! session('warning') !!}',
                    confirmButtonText: 'OK'
                });
            @endif

			@if(session('exists'))
				let noKp = @json(session('no_kp'));

				Swal.fire({
					icon: 'success',
					title: 'No Kad Pengenalan Klien Wujud!',
					text: {!! json_encode(session('exists')) !!},
					confirmButtonText: 'Daftar'
				}).then((result) => {
					if (result.isConfirmed) {
						loadDaftarKlienModal(noKp);
					}
				});
			@endif

			@if(session('not-exists'))
				Swal.fire({
					icon: 'error',
					title: 'Ralat',
					text: {!! json_encode(session('error')) !!},
				});
			@endif
        });
    </script>

	{{-- Generate password --}}
	<script>
		function generatePasswordPegawai(inputId) {
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

		function generatePasswordKlien(inputId) {
			const length = 6;
			const lowercase = 'abcdefghijklmnopqrstuvwxyz';
			const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			const numbers = '0123456789';
			const symbols = '!@#$%^&*()-_+=<>?';

			const allCharacters = lowercase + uppercase + numbers + symbols;
			let password = '';

			password += lowercase[Math.floor(Math.random() * lowercase.length)];
			password += uppercase[Math.floor(Math.random() * uppercase.length)];
			password += numbers[Math.floor(Math.random() * numbers.length)];
			password += symbols[Math.floor(Math.random() * symbols.length)];

			for (let i = 4; i < length; i++) {
				password += allCharacters[Math.floor(Math.random() * allCharacters.length)];
			}

			password = password.split('').sort(() => 0.5 - Math.random()).join('');

			document.getElementById(inputId).value = password;
		}

		function generatePasswordDaftarKlien(inputId) {
			const length = 6;
			const lowercase = 'abcdefghijklmnopqrstuvwxyz';
			const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			const numbers = '0123456789';
			const symbols = '!@#$%^&*()-_+=<>?';

			const allCharacters = lowercase + uppercase + numbers + symbols;
			let password = '';

			password += lowercase[Math.floor(Math.random() * lowercase.length)];
			password += uppercase[Math.floor(Math.random() * uppercase.length)];
			password += numbers[Math.floor(Math.random() * numbers.length)];
			password += symbols[Math.floor(Math.random() * symbols.length)];

			for (let i = 4; i < length; i++) {
				password += allCharacters[Math.floor(Math.random() * allCharacters.length)];
			}

			password = password.split('').sort(() => 0.5 - Math.random()).join('');

			document.getElementById(inputId).value = password;
		}
	</script>

	{{-- Display field bertugas based on peranan and filter daerah based on negeri --}}
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const perananField = document.getElementById('peranan_pegawai');
			const negeriField = document.getElementById('daftar_negeri_field');
			const daerahField = document.getElementById('daftar_daerah_field');
			const negeriSelect = document.getElementById('daftar_negeri_bertugas');
			const daerahSelect = document.getElementById('daftar_daerah_bertugas');

			// Function to toggle visibility of fields based on peranan
			function toggleFields() {
				const peranan = parseInt(perananField.value);
				if (peranan === 3) {
					negeriField.style.display = 'none';
					daerahField.style.display = 'none';
				} else if (peranan === 4) {
					negeriField.style.display = 'block';
					daerahField.style.display = 'none';
				} else if (peranan === 5) {
					negeriField.style.display = 'block';
					daerahField.style.display = 'block';
				} else {
					negeriField.style.display = 'none';
					daerahField.style.display = 'none';
				}
			}

			// Function to filter daerah options based on selected negeri and kod_daerah_pejabat
			function filterDaerahOptions() {
				const selectedNegeriId = negeriSelect.options[negeriSelect.selectedIndex].getAttribute('data-id');
				Array.from(daerahSelect.options).forEach(option => {
					if (option.getAttribute('data-negeri-id') === selectedNegeriId  && option.value !== '') {
						option.style.display = 'block';
					} else {
						option.style.display = 'none';
					}
				});
				daerahSelect.value = '';
			}

			// Event listeners
			perananField.addEventListener('change', toggleFields);
			negeriSelect.addEventListener('change', filterDaerahOptions);

			// Initial setup
			toggleFields();
			filterDaerahOptions();
		});
	</script>

	{{-- Control input type --}}
	<script>
		document.querySelectorAll('input[name="nama"]').forEach(function(input) {
			input.addEventListener('input', function() {
				// Allow letters, spaces, and single quotes
				this.value = this.value.replace(/[^a-zA-Z\s'@.]/g, '');
			});
		});

		document.getElementById('name').addEventListener('input', function (e) {
			// Allow letters, spaces, and single quotes
			this.value = this.value.replace(/[^a-zA-Z\s'@.]/g, '');
		});

		document.addEventListener('DOMContentLoaded', function() {
			// Select all elements with name 'no_kp' and 'no_tel'
			const noKpElements = document.querySelectorAll('[name="no_kp"]');
			const noTelElements = document.querySelectorAll('[name="no_tel"]');

			// Restrict input to digits for 'no_kp' elements
			noKpElements.forEach(function(element) {
				element.addEventListener('input', function (e) {
					this.value = this.value.replace(/\D/g, '');  // Remove non-digit characters
					if (this.value.length > 12) {                // Limit to 12 digits
						this.value = this.value.slice(0, 12);
					}
				});
			});

			// Restrict input to digits for 'no_tel' elements
			noTelElements.forEach(function(element) {
				element.addEventListener('input', function (e) {
					this.value = this.value.replace(/\D/g, '');  // Remove non-digit characters
					if (this.value.length > 11) {                // Limit to 11 digits
						this.value = this.value.slice(0, 11);
					}
				});
			});
		});
	</script>

	{{-- AJAX TABLE SENARAI PERMOHONAN PEGAWAI --}}
	<script>
		$(document).ready(function() {
			$('#sortTable3').DataTable({
				serverSide: true,
				ajax: {
					url: "{{ route('ajax-senarai-permohonan-pegawai') }}",
					dataSrc: function(json) {
						return json.data; // No custom message, just return the data
					}
				},
				columns: [
					{ data: 'nama', name: 'pegawai_mohon_daftar.nama' },
					{ data: 'no_kp', name: 'pegawai_mohon_daftar.no_kp', className: "text-center" },
					{ data: 'emel', name: 'pegawai_mohon_daftar.emel', className: "text-center" },
					{ data: 'peranan', name: 'tahap_pengguna.peranan', className: "text-center" },
					{ 
						data: null, 
						name: 'negeri_bertugas',
						className: "text-center", 
						render: function(data, type, row) {
							// If both are null, return an empty string
							if (!row.negeri_bertugas && !row.daerah_bertugas) {
								return "";
							}
							// Otherwise, display the state and (district) if available
							return row.negeri_bertugas + (row.daerah_bertugas ? ' (' + row.daerah_bertugas + ')' : '');
						}
					},
					{
						data: 'id',
						name: 'pegawai_mohon_daftar.id',
						className: "text-center",
						orderable: false,
						searchable: false,
						render: function(data, type, row) {
							return `
								<div class="d-flex justify-content-center align-items-center">
									<a id="permohonanPegawaiModal" href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" 
										data-bs-toggle="modal" 
										data-id="${row.id}" 
										data-bs-target="#modal_permohonan_pegawai">
										<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
											<i class="ki-duotone bi bi-pencil fs-3"></i>
										</span>
									</a>
								</div>`;
						}
					}
				],
				order: [[5, 'desc']], // Order by created_at
				dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                language: {
                    url: "/assets/lang/Malay.json",
					emptyTable: "", // Custom message
                },
			});
		});
	</script>

    <!-- Modal Luluskan Permohonan Pegawai -->
    <script>
        $(document).on('click', '#permohonanPegawaiModal', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/modal/luluskan-pegawai/'+ id, // Laravel route with dynamic ID
                method: 'GET',
                success: function(response) {
                    $('#modalBodyPermohonanPegawai').html(response);
                },
                error: function() {
                    $('#modalBodyPermohonanPegawai').html('Ralat kandungan.'+id);
                }
            });
        });
    </script>

	<!-- Modal Alasan Tolak Permohonan Pegawai -->
	<script>
		$(document).on('click', '#permohonanPegawaiDitolakModal', function() {
			var id = $(this).data('id');
			$.ajax({
				url: '/modal/alasan-ditolak/pegawai/'+ id, // Laravel route with dynamic ID
				method: 'GET',
				success: function(response) {
					$('#modalBodyPermohonanPegawaiDitolak').html(response);
					$('#modal_permohonan_ditolak').modal('show'); // Open the modal
				},
				error: function() {
					$('#modalBodyPermohonanPegawaiDitolak').html('Ralat kandungan.'+id);
				}
			});
		});
	</script>

    {{-- AJAX TABLE SENARAI PEGAWAI --}}
	<script>
		$(document).ready(function() {
			$('#sortTable2').DataTable({
				serverSide: true,
				ajax: "{{ route('ajax-senarai-pegawai') }}",
				columns: [
					{ data: 'name', name: 'users.name' },
					{ data: 'no_kp', name: 'users.no_kp', className: "text-center" },
					{ data: 'email', name: 'users.email', className: "text-center" },
					{ data: 'peranan', name: 'tahap_pengguna.peranan', className: "text-center" },
					{ 
						data: null, 
						name: 'negeri_bertugas', 
						className: "text-center",
						render: function(data, type, row) {
							// If both are null, return an empty string
							if (!row.negeri_bertugas && !row.daerah_bertugas) {
								return "";
							}
							// Otherwise, display the state and (district) if available
							return row.negeri_bertugas + (row.daerah_bertugas ? ' (' + row.daerah_bertugas + ')' : '');
						}
					},
					{ 
						data: 'created_at', 
						name: 'users.created_at',
						className: "text-center",
						render: function(data, type, row) {
							return new Date(data).toLocaleDateString('en-GB');
						}
					},
					{
						data: 'pegawai_id',
						name: 'pegawai.id',
						className: "text-center",
						orderable: false,
						searchable: false,
						render: function(data, type, row) {
							return `
								<div class="d-flex justify-content-center align-items-center">
									<a id="pegawaiModal" href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" 
										data-bs-toggle="modal" 
										data-id="${row.pegawai_id}" 
										data-bs-target="#modal_kemaskini_pegawai">
										<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
											<i class="ki-duotone bi bi-pencil fs-3"></i>
										</span>
									</a>
								</div>`;
						}
					}
				],
				order: [[5, 'desc']], // Order by created_at
				dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                language: {
                    url: "/assets/lang/Malay.json"
                },
                responsive: true
			});
		});
	</script>

    <!-- Modal Kemaskini Pegawai -->
    <script>
        $(document).on('click', '#pegawaiModal', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/modal/kemaskini-pegawai/'+ id, // Laravel route with dynamic ID
                method: 'GET',
                success: function(response) {
                    $('#modalBodyPegawai').html(response);
                },
                error: function() {
                    $('#modalBodyPegawai').html('Ralat kandungan.'+id);
                }
            });
        });
    </script>

	{{-- AJAX TABLE SENARAI KLIEN --}}
	<script>
        $(document).ready(function() {
            let table1 = $('#sortTable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('ajax-senarai-klien') }}", // Ensure this route is correct
                    type: "GET",
                },
                columns: [
                    { data: "nama", name: "nama" },
                    { data: "no_kp", name: "no_kp", className: "text-center" },
                    { data: "emel", name: "emel", className: "text-center" },
                    { data: "tarikhDaftar", name: "tarikhDaftar", className: "text-center" },
                    { data: "tindakan", name: "tindakan", className: "text-center", orderable: false, searchable: false }
                ],
                dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                    '<"row"<"col-sm-12 my-0"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                language: {
                    url: "/assets/lang/Malay.json"
                },
                responsive: true
            });
        });
	</script>

	<!-- Modal Kemaskini Klien -->
    <script>
        $(document).on('click', '#kemaskiniKlienModal', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/modal/kemaskini-klien/'+ id, // Laravel route with dynamic ID
                method: 'GET',
                success: function(response) {
                    $('#modalBodyKemaskiniKlien').html(response);
                },
                error: function() {
                    $('#modalBodyKemaskiniKlien').html('Ralat kandungan.'+id);
                }
            });
        });
    </script>

	<!-- Modal Daftar Klien -->
    <script>
		function loadDaftarKlienModal(noKp) {
			$.ajax({
				url: '/modal/daftar-klien/' + noKp,
				method: 'GET',
				success: function(response) {
					$('#modalBodyDaftarKlien').html(response);
					$('#modal_daftar_klien').modal('show');
				},
				error: function() {
					$('#modalBodyDaftarKlien').html('Ralat kandungan. ID tidak dijumpai: ' + noKp);
					$('#modal_daftar_klien').modal('show');
				}
			});
		}
	</script>
	
	

	{{-- Form validation for Daftar Pegawai --}}
	<script>
		document.getElementById('kt_modal_add_customer_submit').addEventListener('click', function (event) {
			// Prevent form submission
			event.preventDefault();

			// Get form elements
			const name = document.getElementById('name').value.trim();
			const no_kp = document.getElementById('no_kp_pegawai_baru').value.trim();
			const email = document.getElementById('emailPegawai').value.trim();
			const no_tel = document.getElementById('no_tel_pegawai_baru').value.trim();
			const jawatan = document.getElementById('jawatan').value;
			const peranan_pegawai = document.getElementById('peranan_pegawai').value;
			const negeri_bertugas = document.getElementById('daftar_negeri_bertugas').value;
			const daerah_bertugas = document.getElementById('daftar_daerah_bertugas').value;

			// Validation logic based on peranan_pegawai
			let errorMessage = '';

			// Common required field check
			if (!name || !no_kp || !email || !no_tel || !jawatan || !peranan_pegawai) {
				errorMessage = 'Sila isi semua medan yang bertanda *.';
			} else {
				// Additional validation based on peranan_pegawai
				if (peranan_pegawai == 3) {
					// No additional checks for peranan_pegawai == 3
				} else if (peranan_pegawai == 4) {
					// For peranan_pegawai == 4, only negeri_bertugas is required
					if (!negeri_bertugas) {
						errorMessage = 'Sila pilih Negeri Bertugas.';
					}
				} else if (peranan_pegawai == 5) {
					// For peranan_pegawai == 5, both negeri_bertugas and daerah_bertugas are required
					if (!negeri_bertugas || !daerah_bertugas) {
						errorMessage = 'Sila pilih Negeri Bertugas dan Daerah Bertugas.';
					}
				}
			}

			// Validate email
			if (validateEmailDomain(email)) {
				if (errorMessage) {
					alert(errorMessage);
				} else {
					// If all required fields are filled and email is valid, submit the form
					document.getElementById('kt_modal_add_customer_form').submit();
				}
			}
		});

		function validateEmailDomain(emailInput) {
			// Check if email contains '@'
			if (emailInput.includes('@')) {
				alert('Sila masukkan nama e-mel pengguna sahaja tanpa domain.');
				return false; // Prevent form submission
			}

			return true; // Allow form submission if email is valid
		}
	</script>
@endsection
