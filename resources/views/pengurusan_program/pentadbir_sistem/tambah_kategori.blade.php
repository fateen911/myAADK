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
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pengurusan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Program</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Daftar Program</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <!--begin::Body-->
    <!--begin::Main-->

    <!--begin::Content container-->
    <div id="kt_app_content_container">
        <!--begin::Form-->
        <form class="form d-flex flex-column flex-lg-row" action="{{ url('/pengurusan_program/pentadbir_sistem/post_tambah_kategori') }}" method="POST">
            @csrf
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 mb-7 me-lg-10 h-100px w-400px">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Kategori Program</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="mb-5 fv-row">
                            <label class="required form-label">Nama Kategori</label>
                            <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Kategori" value="" required/>
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="required form-label">Kod Kategori</label>
                            <input type="text" name="kod" class="form-control mb-2" placeholder="Kod Kategori" value="" required/>
                        </div>
                        <!--end::Input group-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Sila Tunggu...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="card card-flush py-4 d-flex flex-column">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Maklumat Kategori</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <div class="card-body pt-0">
                        <div class="pt-0 table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed fs-6 gy-5" >
                                <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Nama</th>
                                    <th class="min-w-60px">Kod</th>
                                    <th class="min-w-175px">Tarikh Dicipta</th>
                                    <th class="min-w-50px">Tindakan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-uppercase">
                                        Kelompok Sokongan Keluarga Kepulihan
                                    </td>
                                    <td class="text-uppercase">SK</td>
                                    <td class="text-gray-600 fw-bold">2023-05-15 14:30:00</td>
                                    <td class="text-center">
                                        <a href="{{url('/pengurusan_program/pentadbir_sistem/padam_kategori')}}" class="btn btn-sm btn-danger px-4">
                                            <i class="bi bi-trash-fill fs-3"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">
                                        Pencegahan Relaps
                                    </td>
                                    <td class="text-uppercase">PR</td>
                                    <td class="text-gray-600 fw-bold">2023-06-16 15:45:00</td>
                                    <td class="text-center">
                                        <a href="{{url('/pengurusan_program/pentadbir_sistem/padam_kategori')}}" class="btn btn-sm btn-danger px-4">
                                            <i class="bi bi-trash-fill fs-3"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">
                                        Alumni - PCCP
                                    </td>
                                    <td class="text-uppercase">APC</td>
                                    <td class="text-gray-600 fw-bold">2023-07-17 16:50:00</td>
                                    <td class="text-center">
                                        <a href="{{url('/pengurusan_program/pentadbir_sistem/padam_kategori')}}" class="btn btn-sm btn-danger px-4">
                                            <i class="bi bi-trash-fill fs-3"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">
                                        Alumni - Mentor Kepulihan
                                    </td>
                                    <td class="text-uppercase">AMK</td>
                                    <td class="text-gray-600 fw-bold">2023-08-18 17:55:00</td>
                                    <td class="text-center">
                                        <a href="{{url('/pengurusan_program/pentadbir_sistem/padam_kategori')}}" class="btn btn-sm btn-danger px-4">
                                            <i class="bi bi-trash-fill fs-3"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">
                                        Alumni - Kelompok Sokong Bantu
                                    </td>
                                    <td class="text-uppercase">ASB</td>
                                    <td class="text-gray-600 fw-bold">2023-10-20 19:25:00</td>
                                    <td class="text-center">
                                        <a href="{{url('/pengurusan_program/pentadbir_sistem/padam_kategori')}}" class="btn btn-sm btn-danger px-4">
                                            <i class="bi bi-trash-fill fs-3"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                    <!--end::Card header-->
                </div>
            </div>
            <!--end::Main column-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content container-->

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
    <!-- Editor -->
    <script src="assets/js/custom/apps/ecommerce/catalog/save-product.js"></script>
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

@endsection
