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
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
	<script src="/assets/lang/Malay.json"></script>

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

		.nav{
			margin-left: 20px!important;
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
				{{-- Nav Bar --}}
				<ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="klien-tab" data-toggle="tab" data-target="#klien" type="button" role="tab" aria-controls="klien" aria-selected="true">Klien AADK</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="pegawai-tab" data-toggle="tab" data-target="#pegawai" type="button" role="tab" aria-controls="pegawai" aria-selected="true">Pegawai AADK</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="permohonan-pegawai-tab" data-toggle="tab" data-target="#permohonan-pegawai" type="button" role="tab" aria-controls="permohonan-pegawai" aria-selected="true">Pegawai Mohon Mendaftar</button>
					</li>
				</ul>			

				{{-- Content Navigation Bar --}}
				<div class="tab-content mt-0" id="myTabContent">
					{{-- KLIEN --}}
					<div class="tab-pane fade show active" id="klien" role="tabpanel" aria-labelledby="klien-tab">
						<!--begin::Card title-->
						<div class="header ml-5">
							<h2>Senarai Keseluruhan Klien<br><small>Sila klik pada ikon pensil untuk kemaskini maklumat akaun klien.</small></h2>	
						</div>

						<!--begin::Card body-->
						<div class="body">
							<!--begin::Table-->
							<table id="sortTable1" class="table table-striped table-hover dataTable js-exportable">
								<thead>
									<tr class="text-center text-gray-400 fw-bold fs-7 gs-0">
										<th style="width: 40%;">Nama</th>
										<th style="width: 15%;">No. Kad Pengenalan</th>
										<th style="width: 25%;">Emel</th>
										<th style="width: 10%;">Tarikh Daftar</th>
										<th style="width: 10%;">Kemaskini</th>
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600">
									@foreach ($klien as $user1)
										@php
											$peranan = DB::table('tahap_pengguna')->where('id', $user1['tahap_pengguna'])->value('peranan');
											$tarikh_daftar1 = Carbon::parse($user1->created_at)->format('d-m-Y');
										@endphp
	
										<tr>
											<td>{{ $user1->name }}</td>
											<td>{{ $user1->no_kp }}</td>
											<td>{{ $user1->email }}</td>
											<td>{{ $tarikh_daftar1}}</td>
											<td>
												<div class="d-flex justify-content-center align-items-center">
													<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_klien{{$user1->id}}">
														<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
															<i class="ki-duotone bi bi-pencil fs-3"></i>
														</span>
													</a>
												</div>                                                
											</td>
	
											<!--begin::Modal - Kemaskini Klien-->
											<div class="modal fade" id="modal_kemaskini_klien{{$user1->id}}" tabindex="-1" aria-hidden="true">
												<!--begin::Modal dialog-->
												<div class="modal-dialog modal-dialog-centered mw-650px">
													<!--begin::Modal content-->
													<div class="modal-content">
														<!--begin::Modal header-->
														<div class="modal-header">
															<!--begin::Modal title-->
															<h2>Kemaskini Maklumat Akaun Klien</h2>
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
															<form class="form" id="modal_kemaskini_klien_form" action="{{ route('kemaskini-klien') }}" method="post">
																@csrf
	
																<input type="hidden" name="id" value="{{ $user1->id }}">
																<div class="scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Nama</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{$user1->name}}" />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Emel</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="email" class="form-control form-control-solid" placeholder="" name="email" value="{{$user1->email}}" />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" name="no_kp" value="{{$user1->no_kp}}"/>
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
																			<input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" id="password{{$user1->id}}" name="password" />
																			<button type="button" class="btn btn-secondary" onclick="generatePasswordKlien('password{{$user1->id}}')">Jana Kata Laluan</button>
																		</div>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																</div>
	
																<!--begin::Actions-->
																<div class="text-center pt-15">
																	<button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>

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
											<!--end::Modal - Kemaskini Klien-->
										</tr>
									@endforeach
								</tbody>
							</table>
							<!--end::Table-->
						</div>
						<!--end::Card body-->
					</div> 

					{{-- PEGAWAI --}}
					<div class="tab-pane fade" id="pegawai" role="tabpanel" aria-labelledby="pegawai-tab">
						<div class="header row align-items-center">
							<!--begin::Card title-->
							<div class="col">
								<h2>Senarai Keseluruhan Pegawai</h2>
								<small>Sila klik pada butang "Tambah Pengguna" untuk mendaftar pegawai baharu dan klik pada ikon pensil untuk kemaskini akaun pegawai.</small>
							</div>
						
							<!--begin::Card toolbar-->
							<div class="col-auto">
								<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
									<i class="bi bi-plus-circle"></i> &nbsp;Tambah Pegawai 
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
										<th class="min-w-175px">Nama</th>
										<th class="min-w-125px">No. Kad Pengenalan</th>
										<th class="min-w-125px">Emel</th>
										<th class="min-w-125px">Peranan</th>
										<th class="min-w-150px">Negeri (Daerah)</th>
										<th class="min-w-100px">Tarikh Daftar</th>
										<th class="min-w-50px">Kemaskini</th>
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600">
									@foreach ($pegawai as $user2)
										@php
											$peranan = DB::table('tahap_pengguna')->where('id', $user2['tahap_pengguna'])->value('peranan');
											$tarikh_daftar = Carbon::parse($user2->created_at)->format('d-m-Y');
											$negeriB = DB::table('senarai_negeri')->where('id', $user2['negeri_bertugas'])->value('negeri');
											$daerahB = DB::table('senarai_daerah')->where('id', $user2['daerah_bertugas'])->value('daerah');
										@endphp
	
										<tr>
											<td>{{ $user2->name }}</td>
											<td>{{ $user2->no_kp }}</td>
											<td>{{ $user2->email }}</td>
											<td>{{ $peranan }}</td>
											<td>
												@if ($negeriB !== null)
        											{{ $negeriB }} 
													@if ($daerahB !== null)
														({{ $daerahB }})
													@endif
												@else
											</td>
											@endif
											<td>{{ $tarikh_daftar }}</td>
											<td>
												<div class="d-flex justify-content-center align-items-center">
													<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_pegawai{{$user2->id}}">
														<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
															<i class="ki-duotone bi bi-pencil fs-3"></i>
														</span>
													</a>
												</div>                                                
											</td>
	
											<!--begin::Modal - Kemaskini Pegawai-->
											<div class="modal fade" id="modal_kemaskini_pegawai{{$user2->id}}" tabindex="-1" aria-hidden="true">
												<!--begin::Modal dialog-->
												<div class="modal-dialog modal-dialog-centered mw-650px">
													<!--begin::Modal content-->
													<div class="modal-content">
														<!--begin::Modal header-->
														<div class="modal-header">
															<!--begin::Modal title-->
															<h2>Kemaskini Maklumat Akaun Pegawai</h2>
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
															<form class="form" id="modal_kemaskini_pegawai_form" action="{{ route('kemaskini-pegawai') }}" method="post">
																@csrf
	
																<input type="hidden" name="id" value="{{ $user2->id }}">
																<div class="scroll-y me-n7 pe-7" id="modal_kemaskini_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_kemaskini_pegawai_header" data-kt-scroll-wrappers="#modal_kemaskini_pegawai_scroll" data-kt-scroll-offset="300px">
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Nama</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" class="form-control form-control-solid" name="nama" id="nama" value="{{$user2->name}}" />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" maxlength="12" class="form-control form-control-solid" name="no_kp" value="{{$user2->no_kp}}"/>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Emel</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<div class="input-group">
																			<input type="text" class="form-control form-control-solid" id="emel" name="emel" value="{{ explode('@', $user2->email)[0] }}" />
																			<span class="input-group-text">@adk.gov.my</span>
																			<input type="hidden" id="email" name="email" value="{{ $user2->email }}" />
																		</div>
																		<!--end::Input-->
																	</div>																	
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-5">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Nombor Telefon
																			<span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
																				<i class="ki-duotone ki-information-2 text-gray-500 fs-6">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																				</i>
																			</span>
																		</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" maxlength="11" class="form-control form-control-solid" id="no_tel" name="no_tel" value="{{$user2->no_tel}}"/>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-5">
																		<label class="fs-6 fw-semibold mb-2">Jawatan & Gred</label>
																		<select name="jawatan" id="jawatan" class="form-select form-select-solid fw-bold">
																			<option value="">Pilih</option>
																			@foreach ($jawatan as $j)
																				<option value="{{ $j->id }}" {{$user2->jawatan == $j->id  ? 'selected' : ''}}>{{ $j->jawatan_gred }}</option>
																			@endforeach
																		</select>
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
																				<option value="{{$tahap1->id}}" {{$user2->tahap_pengguna == $tahap1->id  ? 'selected' : ''}}>{{$tahap1->peranan}}</option>
																			@endforeach
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	@if ($user2->negeri_bertugas != null)
																		<div class="fv-row mb-5">
																			<label class="fs-6 fw-semibold mb-2">Negeri Bertugas</label>
																			<select name="negeri_bertugas" id="negeri_bertugas" class="form-select form-select-solid fw-bold">
																				<option value="">Pilih Negeri Bertugas</option>
																				@foreach ($negeri as $item1)
																					<option value="{{ $item1->id}}" {{$user2->negeri_bertugas == $item1->id  ? 'selected' : ''}}>{{$item1->negeri}}</option>
																				@endforeach
																			</select>
																		</div>	
																	@endif
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	@if ($user2->daerah_bertugas != null)
																		<div class="fv-row mb-5">
																			<label class="fs-6 fw-semibold mb-2">Daerah Bertugas</label>
																			<select name="daerah_bertugas" id="daerah_bertugas" class="form-select form-select-solid fw-bold">
																				<option value="">Pilih Daerah Bertugas</option>
																				@foreach ($daerah as $item2)
																					<option value="{{ $item2->id}}" {{$user2->daerah_bertugas == $item2->id  ? 'selected' : ''}}>{{$item2->daerah}}</option>
																				@endforeach
																			</select>
																		</div>
																	@endif
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Kata Laluan Baharu</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<div class="input-group">
																			<input type="text" maxlength="12" class="form-control form-control-solid" id="password{{$user2->id}}" name="password" />
																			<button type="button" class="btn btn-secondary" onclick="generatePasswordPegawai('password{{$user2->id}}')">Jana Kata Laluan</button>
																		</div>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																</div>
																<!--end::Scroll-->

																<!--begin::Actions-->
																<div class="text-center pt-15">
																	<button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>

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
											<!--end::Modal -  Kemaskini Pegawai-->
										</tr>
									@endforeach
								</tbody>
							</table>
							<!--end::Table-->
						</div>
						<!--end::Card body-->
					</div>

					{{-- PERMOHONAN DAFTAR PEGAWAI --}}
					<div class="tab-pane fade" id="permohonan-pegawai" role="tabpanel" aria-labelledby="permohonan-pegawai-tab">
						<div class="header row align-items-center">
							<!--begin::Card title-->
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
										<th class="min-w-125px">Emel</th>
										<th class="min-w-125px">Peranan</th>
										<th class="min-w-150px">Negeri (Daerah)</th>
										<th class="min-w-50px">Kelulusan</th>
									</tr>
								</thead>
								<tbody class="fw-semibold text-gray-600">
									@foreach ($permohonan_pegawai as $user3)
										@php
											$peranan = DB::table('tahap_pengguna')->where('id', $user3['peranan'])->value('peranan');
											$negeriB = DB::table('senarai_negeri')->where('id', $user3['negeri_bertugas'])->value('negeri');
											$daerahB = DB::table('senarai_daerah')->where('id', $user3['daerah_bertugas'])->value('daerah');
										@endphp
	
										<tr>
											<td>{{ $user3->nama }}</td>
											<td>{{ $user3->no_kp }}</td>
											<td>{{ $user3->emel }}</td>
											<td>{{ $peranan }}</td>
											<td>
												@if ($negeriB !== null)
        											{{ $negeriB }} 
													@if ($daerahB !== null)
														({{ $daerahB }})
													@endif
												@else
											</td>
											@endif
											<td>
												<div class="d-flex justify-content-center align-items-center">
													<a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal_permohonan_pegawai{{$user3->id}}">
														<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Permohonan">
															<i class="ki-duotone bi bi-pencil fs-3"></i>
														</span>
													</a>
												</div>                                                     
											</td>
	
											<!--begin::Modal - Permohonan Pegawai-->
											<div class="modal fade" id="modal_permohonan_pegawai{{$user3->id}}" tabindex="-1" aria-hidden="true">
												<!--begin::Modal dialog-->
												<div class="modal-dialog modal-dialog-centered mw-650px">
													<!--begin::Modal content-->
													<div class="modal-content">
														<!--begin::Modal header-->
														<div class="modal-header">
															<!--begin::Modal title-->
															<h2>Luluskan Permohonan Pendaftaran Pegawai</h2>
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
															<form class="form" id="modal_permohonan_pegawai_form" action="{{ route('kelulusan-permohonan-pegawai') }}" method="post">
																@csrf
	
																<input type="hidden" name="id" value="{{ $user3->id }}">
																<div class="scroll-y me-n7 pe-7" id="modal_permohonan_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_permohonan_pegawai_header" data-kt-scroll-wrappers="#modal_permohonan_pegawai_scroll" data-kt-scroll-offset="300px">
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Nama</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" class="form-control form-control-solid" name="nama" id="nama" value="{{$user3->nama}}" />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" maxlength="12" class="form-control form-control-solid" name="no_kp" value="{{$user3->no_kp}}"/>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Emel</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<div class="input-group">
																			<input type="text" class="form-control form-control-solid" id="emel" name="emel" value="{{ explode('@', $user3->emel)[0] }}" />
																			<span class="input-group-text">@adk.gov.my</span>
																			<input type="hidden" id="email" name="email" value="{{ $user3->emel }}" />
																		</div>
																		<!--end::Input-->
																	</div>																	
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-5">
																		<!--begin::Label-->
																		<label class="fs-6 fw-semibold mb-2">Nombor Telefon
																			<span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
																				<i class="ki-duotone ki-information-2 text-gray-500 fs-6">
																					<span class="path1"></span>
																					<span class="path2"></span>
																					<span class="path3"></span>
																				</i>
																			</span>
																		</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" maxlength="11" class="form-control form-control-solid" id="no_tel" name="no_tel" value="{{$user3->no_tel}}"/>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-5">
																		<label class="fs-6 fw-semibold mb-2">Jawatan & Gred</label>
																		<select name="jawatan" id="jawatan" class="form-select form-select-solid fw-bold">
																			<option value="">Pilih</option>
																			@foreach ($jawatan as $j)
																				<option value="{{ $j->id }}" {{$user3->jawatan == $j->id  ? 'selected' : ''}}>{{ $j->jawatan_gred }}</option>
																			@endforeach
																		</select>
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
																				<option value="{{$tahap1->id}}" {{$user3->tahap_pengguna == $tahap1->id  ? 'selected' : ''}}>{{$tahap1->peranan}}</option>
																			@endforeach
																		</select>
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	@if ($user3->negeri_bertugas != null)
																		<div class="fv-row mb-5">
																			<label class="fs-6 fw-semibold mb-2">Negeri Bertugas</label>
																			<select name="negeri_bertugas" id="negeri_bertugas" class="form-select form-select-solid fw-bold">
																				<option value="">Pilih Negeri Bertugas</option>
																				@foreach ($negeri as $item1)
																					<option value="{{ $item1->id}}" {{$user3->negeri_bertugas == $item1->id  ? 'selected' : ''}}>{{$item1->negeri}}</option>
																				@endforeach
																			</select>
																		</div>	
																	@endif
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	@if ($user3->daerah_bertugas != null)
																		<div class="fv-row mb-5">
																			<label class="fs-6 fw-semibold mb-2">Daerah Bertugas</label>
																			<select name="daerah_bertugas" id="daerah_bertugas" class="form-select form-select-solid fw-bold">
																				<option value="">Pilih Daerah Bertugas</option>
																				@foreach ($daerah as $item2)
																					<option value="{{ $item2->id}}" {{$user3->daerah_bertugas == $item2->id  ? 'selected' : ''}}>{{$item2->daerah}}</option>
																				@endforeach
																			</select>
																		</div>
																	@endif
																	<!--end::Input group-->
																</div>
																<!--end::Scroll-->

																<!--begin::Actions-->
																<div class="text-center pt-15">
																	<button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Diluluskan</button>
                                                                    <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Ditolak</button>
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
											<!--end::Modal -  Kemaskini Pegawai-->
										</tr>
									@endforeach
								</tbody>
							</table>
							<!--end::Table-->
						</div>
						<!--end::Card body-->
					</div> 
				</div>

				<!--begin::Modal - Tambah Pegawai-->
				<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
					<!--begin::Modal dialog-->
					<div class="modal-dialog modal-dialog-centered mw-650px">
						<!--begin::Modal content-->
						<div class="modal-content">
							<!--begin::Form-->
							<form class="form" id="kt_modal_add_customer_form" action="{{ route('daftar-pengguna') }}" method="post" data-kt-redirect="{{ route('senarai-pengguna') }}">
								@csrf
								<!--begin::Modal header-->
								<div class="modal-header" id="kt_modal_add_customer_header">
									<!--begin::Modal title-->
									<h2 class="fw-bold">Tambah Pegawai Baharu</h2>
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
										<div class="fv-row mb-5">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold mb-2 required">Nama</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control form-control-solid" placeholder="" id="name" name="name"/>
											<!--end::Input-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold mb-2 required">No. Kad Pengenalan</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" id="no_kp" name="no_kp" />
											<!--end::Input-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold mb-2 required">Emel</label>
											<!--end::Label-->
											<!--begin::Input-->
											<div class="input-group">
												<input type="text" class="form-control form-control-solid" placeholder="contoh12" id="emailPegawai" name="emailPegawai" required />
												<span class="input-group-text">@adk.gov.my</span>
												<input type="hidden" id="emel" name="emel" />
											</div>
											<!--end::Input-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold mb-2">Nombor Telefon
												<span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
													<i class="ki-duotone ki-information-2 text-gray-500 fs-6">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" maxlength="11" class="form-control form-control-solid" placeholder="" id="no_tel" name="no_tel" />
											<!--end::Input-->
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<label class="fs-6 fw-semibold mb-2 required">Jawatan & Gred</label>
											<select name="jawatan" id="jawatan" class="form-select form-select-solid fw-bold">
												<option value="">Pilih</option>
												@foreach ($jawatan as $j)
													<option value="{{ $j->id }}">{{ $j->jawatan_gred }}</option>
												@endforeach
											</select>
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-5">
											<label class="fs-6 fw-semibold mb-2 required">Peranan</label>
											<select name="peranan_pegawai" id="peranan_pegawai" class="form-select form-select-solid fw-bold">
												<option value="">Pilih</option>
												@foreach ($tahap->sortBy('jawatan') as $t)
													<option value="{{ $t->id }}">{{ $t->peranan }}</option>
												@endforeach
											</select>
										</div>
										<!--end::Input group-->
										<div class="fv-row mb-5" id="daftar_negeri_field">
											<label class="fs-6 fw-semibold mb-2 required">Negeri Bertugas</label>
											<select name="daftar_negeri_bertugas" id="daftar_negeri_bertugas" class="form-select form-select-solid fw-bold">
												<option value="">Pilih Negeri Bertugas</option>
												@foreach ($negeri as $item1)
													<option value="{{ $item1->id }}" data-id="{{ $item1->id }}">{{ $item1->negeri }}</option>
												@endforeach
											</select>
										</div>
										<div class="fv-row mb-5" id="daftar_daerah_field">
											<label class="fs-6 fw-semibold mb-2 required">Daerah Bertugas</label>
											<select name="daftar_daerah_bertugas" id="daftar_daerah_bertugas" class="form-select form-select-solid fw-bold">
												<option value="">Pilih Daerah Bertugas</option>
												@foreach ($daerah as $item2)
													<option value="{{ $item2->id }}" data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>
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
				<!--end::Modal - Tambah Pegawai-->
			</div>
			<!--end::Content container-->
		</div>
		<!--end::Content-->
	</div>
</div>

    <!--begin::Javascript-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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

		$('#sortTable3').DataTable({
			ordering: true,
			order: [],
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
		
			// Function to filter daerah options based on selected negeri
			function filterDaerahOptions() {
				const selectedNegeriId = negeriSelect.options[negeriSelect.selectedIndex].getAttribute('data-id');
				Array.from(daerahSelect.options).forEach(option => {
					if (option.getAttribute('data-negeri-id') === selectedNegeriId) {
						option.style.display = 'block';
					} else {
						option.style.display = 'none';
					}
				});
				daerahSelect.value = ''; // Reset daerah selection
			}
		
			// Event listeners
			perananField.addEventListener('change', toggleFields);
			negeriSelect.addEventListener('change', filterDaerahOptions);
		
			// Initial setup
			toggleFields();
			filterDaerahOptions();
		});
	</script>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			document.getElementById('modal_kemaskini_pegawai_form').addEventListener('submit', function(event) {
				var emailInput = document.getElementById('emel').value;
				if (emailInput.includes('@')) {
					alert('Sila masukkan hanya nama e-mel pengguna tanpa domain.');
					event.preventDefault();
				}
			});
		});

		document.addEventListener('DOMContentLoaded', function() {
			document.getElementById('kt_modal_add_customer_form').addEventListener('submit', function(event) {
				var emailInput = document.getElementById('emailPegawai').value;
				if (emailInput.includes('@')) {
					alert('Sila masukkan hanya nama e-mel pengguna tanpa domain.');
					event.preventDefault();
				}
			});
		});
	</script>
@endsection
