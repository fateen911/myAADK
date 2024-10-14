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

	<!-- Custom AADK CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="/assets/css/customAADK.css">
    <script src="/assets/lang/Malay.json"></script>

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

        input.form-control.form-control-solid.custom-form {
            background-color: #e0e0e0;
            color: #45505b;
        }

        input.form-control.form-control-solid.custom-form:focus {
            background-color: #d0d0d0;
            color: #333333;
            box-shadow: none;
        }
	</style>
</head>

<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Akaun Pengguna</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">
			<a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Akaun Pengguna</a>
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
				{{-- Content Navigation Bar --}}
				<div class="tab-content mt-0" id="myTabContent">
					{{-- KLIEN --}}
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
                                    <th class="min-w-250px">Nama</th>
                                    <th class="min-w-50px">No. Kad Pengenalan</th>
                                    <th class="min-w-50px">E-mel</th>
                                    <th class="min-w-60px" style="text-align: center;">Tarikh Daftar</th>
                                    <th class="min-w-40px" style="text-align: center;">Kemaskini</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($klien as $user1)
                                    @php
                                        $peranan = DB::table('tahap_pengguna')->where('id', $user1['tahap_pengguna'])->value('peranan');
                                        // $tarikh_daftar1 = Carbon::parse($user1->updated_at)->format('d-m-Y');
                                        $tarikh_daftar1 = $user1->user_updated_at ? Carbon::parse($user1->user_updated_at)->format('d-m-Y') : 'N/A';
                                    @endphp

                                    <tr>
                                        <td>{{ $user1->nama }}</td>
                                        <td>{{ $user1->no_kp }}</td>
                                        <td>{{ $user1->emel }}</td>
                                        @if ( $user1->user_updated_at !== null)
                                            <td style="text-align: center;">{{ $tarikh_daftar1}}</td>
                                        @else
                                            <td style="text-align: center;">N/A</td>
                                        @endif
                                        <td style="text-align: center;">
                                            <div class="d-flex justify-content-center align-items-center">
                                                @if ( $user1->user_updated_at !== null)
                                                    <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal_kemaskini_klien{{$user1->id}}">
                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kemaskini">
                                                            <i class="ki-duotone bi bi-pencil fs-3"></i>
                                                        </span>
                                                    </a>
                                                @else
                                                    <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal_daftar_klien{{$user1->id}}">
                                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Daftar">
                                                            <i class="ki-duotone bi bi-pencil fs-3"></i>
                                                        </span>
                                                    </a>
                                                @endif
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
                                                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                            <i class="ki-solid ki-cross-circle fs-1"></i>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                                    <!--end::Modal header-->

                                                    <!--begin::Modal body-->
                                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                        <!--begin::Form-->
                                                        <form class="form" id="modal_kemaskini_klien_form" action="{{ route('pegawai-kemaskini-klien') }}" method="post">
                                                            @csrf

                                                            <input type="hidden" name="id" value="{{ $user1->id }}">
                                                            <div class="scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2 required">Nama Penuh</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-solid" name="name" value="{{$user1->nama}}" readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2 required">No. Kad Pengenalan</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-solid" name="no_kp" value="{{$user1->no_kp}}" readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">No. Telefon
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
                                                                    <input type="text" class="form-control form-control-solid custom-form" name="no_tel" placeholder="Contoh: 0109000000" value="{{$user1->no_tel}}" inputmode="numeric"/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">E-mel</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="email" class="form-control form-control-solid custom-form" name="email" placeholder="Contoh: contoh1@gmail.com" value="{{$user1->emel}}" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">Kata Laluan Baharu</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control form-control-solid custom-form" id="passwordKlien{{$user1->id}}" name="passwordKemaskini" />
                                                                        <button type="button" class="btn btn-secondary" onclick="generatePasswordKlien('passwordKlien{{$user1->id}}')">Jana Kata Laluan</button>
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

                                        <!--begin::Modal - Daftar Klien-->
                                        <div class="modal fade" id="modal_daftar_klien{{$user1->id}}" tabindex="-1" aria-hidden="true">
                                            <!--begin::Modal dialog-->
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <!--begin::Modal content-->
                                                <div class="modal-content">
                                                    <!--begin::Modal header-->
                                                    <div class="modal-header">
                                                        <!--begin::Modal title-->
                                                        <h2>Pendaftaran Akaun Klien</h2>
                                                        <!--end::Modal title-->
                                                        <!--begin::Close-->
                                                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                            <i class="ki-solid ki-cross-circle fs-1"></i>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                                    <!--end::Modal header-->

                                                    <!--begin::Modal body-->
                                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                        <!--begin::Form-->
                                                        <form class="form" id="modal_daftar_klien_form" action="{{ route('pegawai-daftar-klien') }}" method="post">
                                                            @csrf

                                                            <input type="hidden" name="id" value="{{ $user1->id }}">
                                                            <div class="scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2 required">Nama Penuh</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-solid" name="name" value="{{$user1->nama}}" readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2 required">No. Kad Pengenalan</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-solid" name="no_kp" value="{{$user1->no_kp}}" readonly/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">No. Telefon
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
                                                                    <input type="text" class="form-control form-control-solid custom-form" name="no_tel" placeholder="Contoh: 0109000000" value="{{$user1->no_tel}}" inputmode="numeric"/>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">E-mel</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="email" class="form-control form-control-solid custom-form" name="email" placeholder="Contoh: contoh1@gmail.com" value="{{$user1->emel}}" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-5">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2 required">Kata Laluan Baharu</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control form-control-solid custom-form" placeholder="" id="passwordDaftarKlien{{$user1->id}}" name="passwordDaftar" />
                                                                        <button type="button" class="btn btn-secondary" onclick="generatePasswordDaftarKlien('passwordDaftarKlien{{$user1->id}}')">Jana Kata Laluan</button>
                                                                    </div>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                            </div>

                                                            <!--begin::Actions-->
                                                            <div class="text-center pt-15">
                                                                <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>

                                                                <button type="submit" id="daftarBtn" class="btn btn-primary">
                                                                    <span class="indicator-label">Daftar</span>
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
                                        <!--end::Modal - Daftar Klien-->
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

    <!--begin::Javascript-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
        });
    </script>

    <script>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all elements with name 'no_tel'
            const noTelElements = document.querySelectorAll('[name="no_tel"]');

            // Restrict input to digits for 'no_tel' elements
            noTelElements.forEach(function(element) {
                element.addEventListener('input', function (e) {
                    this.value = this.value.replace(/\D/g, '');  // Remove non-digit characters
                    if (this.value.length > 11) {                // Limit to 11 digits
                        this.value = this.value.slice(0, 11);
                    }
                });
            });

            // Add event listener to form submission
            document.getElementById('modal_kemaskini_klien_form').addEventListener('submit', function(e) {
                let valid = true;

                // Validate each 'no_tel' field
                noTelElements.forEach(function(element) {
                    const errorMessage = element.nextElementSibling; // Assuming there's an element for error message
                    if (element.value.length < 10 || element.value.length > 11) {
                        errorMessage.textContent = 'Bilangan digit nombor telefon mesti antara 10 hingga 11 digit.';
                        valid = false;
                    } else {
                        errorMessage.textContent = ''; // Clear any previous error message
                    }
                });

                if (!valid) {
                    e.preventDefault();  // Prevent form submission if any validation fails
                }
            });

            // Add event listener to form submission
            document.getElementById('modal_daftar_klien_form').addEventListener('submit', function(e) {
                let valid = true;

                // Validate each 'no_tel' field
                noTelElements.forEach(function(element) {
                    const errorMessage = element.nextElementSibling; // Assuming there's an element for error message
                    if (element.value.length < 10 || element.value.length > 11) {
                        errorMessage.textContent = 'Bilangan digit nombor telefon mesti antara 10 hingga 11 digit.';
                        valid = false;
                    } else {
                        errorMessage.textContent = ''; // Clear any previous error message
                    }
                });

                if (!valid) {
                    e.preventDefault();  // Prevent form submission if any validation fails
                }
            });
        });
    </script>
@endsection
