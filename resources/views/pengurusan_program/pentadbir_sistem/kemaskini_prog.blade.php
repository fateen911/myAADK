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
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Form-->
                    <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('pengurusan_program.pentadbir_sistem.maklumat_prog') }}" method="GET">
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Maklumat Program</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">Kategori Program</label>
                                        <!--begin::Select2-->
                                        <select class="form-select" aria-label="Select example">
                                            <option >Sila Pilih</option>
                                            <option value="SK" selected="selected">Kelompok Sokongan Keluarga Kepulihan</option>
                                            <option value="PR">Pencegahan Relaps</option>
                                            <option value="APC">Alumni - PCCP</option>
                                            <option value="AMK">Alumni - Mentor Kepulihan</option>
                                            <option value="ASB">Alumni - Kelompok Sokong Bantu</option>
                                        </select>
                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">Nama Program</label>
                                        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Program" value="Program Pemulihan Bersepadu" required/>
                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <!--begin::Input group-->
                                        <div>
                                            <!--begin::Label-->
                                            <label class="form-label required">Objektif</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <div id="kt_docs_quill_basic" name="kt_docs_quill_basic" class="min-h-200px mb-2">
                                                Meningkatkan kesedaran tentang kesan negatif dadah dan kepentingan pemulihan
                                            </div>
                                            <!--end::Editor-->
                                            {{--                                                            <!--begin::Description-->--}}
                                            {{--                                                            <div class="text-muted fs-7">Berikan catatan anda.</div>--}}
                                            {{--                                                            <!--end::Description-->--}}
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <div class="form d-flex flex-column flex-lg-row mb-5">
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-300px me-lg-10">
                                                <label class="required form-label">Tarikh & Masa Mula</label>
                                                <input class="form-control form-control-solid" name="tarikh" placeholder="Pilih tarikh" id="kt_daterangepicker_1"/>
                                            </div>
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-300px">
                                                <label class="required form-label">Tarikh & Masa Tamat</label>
                                                <input class="form-control form-control-solid" name="tarikh" placeholder="Pilih tarikh" id="kt_daterangepicker_2"/>
                                            </div>
                                        </div>
                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <div class="form d-flex flex-column flex-lg-row mb-5">
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-300px me-lg-10">
                                                <label class="required form-label">Tempat Program</label>
                                                <input type="text" name="tempat" class="form-control mb-2" placeholder="Tempat Program" value="Pusat Pemulihan Komuniti, Taman Desa Harmoni, Johor Bahru" required/>
                                            </div>
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-300px">
                                                <label class="form-label">Penganjur Program (Jika Ada)</label>
                                                <input type="text" name="penganjur" class="form-control mb-2" placeholder="Penganjur Program" value="Majlis Pemulihan Dadah Kebangsaan (MPDK)"/>
                                            </div>
                                        </div>

                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>
                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                    <div class="mb-5 fv-row">
                                        <div class="form d-flex flex-column flex-lg-row mb-5">
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-350px me-lg-10">
                                                <label class="required form-label">Nama Pegawai</label>
                                                <input type="text" name="penganjur" class="form-control mb-2" placeholder="Nama Pegawai" value="En. Kairul Azizi" required/>
                                            </div>
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-350px">
                                                <label class="required form-label">No. Telefon Untuk Dihubungi (Tanpa '-')</label>
                                                <input type="text" name="penganjur" class="form-control mb-2" placeholder="No. Telefon Untuk Dihubungi" value="0135728935" required/>
                                            </div>
                                        </div>

                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label">Catatan (Jika Ada)</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <div id="kt_docs_quill_basic_2" name="kt_docs_quill_basic" class="min-h-200px mb-2">
                                            Para peserta diminta hadir 15 minit lebih awal untuk proses pendaftaran.
                                        </div>
                                        <!--end::Editor-->
                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">Berikan catatan anda.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="{{ url('pengurusan-program/pentadbir-sistem/maklumat-prog') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Batal</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                    <span class="indicator-label">Simpan</span>
                                    <span class="indicator-progress">Sila Tunggu...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->

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

    <!--text editor-->
    <script>
        var quill = new Quill('#kt_docs_quill_basic', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });

        var quill = new Quill('#kt_docs_quill_basic_2', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });
    </script>

    <!--date-->
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script>
        $("#kt_daterangepicker_1").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: "DD/MM/YYYY"
                }
            }
        );

        $("#kt_daterangepicker_2").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: "hh:mm A"
                }
            }
        );

    </script>

@endsection
