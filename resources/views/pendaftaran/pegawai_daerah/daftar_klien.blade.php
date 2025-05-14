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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
        <li class="breadcrumb-item text-muted">Akaun Pengguna</li>
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
<div class="card shadow-sm mx-w-300 mx-w-450 mw-r-700">
	<div class="table-responsive">
		<div id="kt_app_content" class="app-content flex-column-fluid">
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
                                <form class="form w-100" action="{{ route('pegawai-daerah.semak.kp') }}" method="post">
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
                        <div style="padding-top: 15px; padding-left: 30px;">
                            <h2>Senarai Keseluruhan Klien</h2>
                            <small>Sila klik pada ikon pensil untuk mengemaskini maklumat akaun klien.</small>
                        </div>
                        <!--end::Header-->

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
                                    <!-- Data will be injected here by AJAX -->
                                </tbody>
                            </table>

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
                        <!--end::Card body-->

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
				</div>
			</div>
		</div>
	</div>
</div>

    <!--begin::Javascript-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<!--end::Javascript-->
	
    {{-- POP-UP / ALERT MESSAGE --}}
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

    {{-- GENERATE PASSWORD --}}
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

    {{-- INPUT CONTROL --}}
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

    {{-- AJAX TABLE SENARAI KLIEN --}}
	<script>
        $(document).ready(function() {
            let table1 = $('#sortTable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pegawai-daerah-ajax-senarai-klien') }}", // Ensure this route is correct
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
                url: '/modal/pegawai-daerah/kemaskini-klien/'+ id, // Laravel route with dynamic ID
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
        $(document).on('click', '#daftarKlienModal', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/modal/pegawai-daerah/daftar-klien/'+ id, // Laravel route with dynamic ID
                method: 'GET',
                success: function(response) {
                    $('#modalBodyDaftarKlien').html(response);
                },
                error: function() {
                    $('#modalBodyDaftarKlien').html('Ralat kandungan.'+id);
                }
            });
        });
    </script>
@endsection
