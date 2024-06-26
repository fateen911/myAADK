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
    <!--begin::Form-->
    <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html">
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10 h-600px">
            <!--begin::QR code settings-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>QR code</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body text-center pt-0">
                    <!--begin::Image input-->
                    {!! QrCode::size(200)->generate('www.google.com'); !!}
                    <!--end::Image input-->
                    <br><br>
                    <!--begin::Link-->
                    <input type="text" name="product_name" class="form-control mb-2" placeholder="Link" value="www.google.com" disabled/>
                    <!--end::Link-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::QR code settings-->
            <!--begin::Status-->
            <div class="card card-flush py-0">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Status</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select2-->
                    <select class="form-select" aria-label="Select example">
                        <option></option>
                        <option value="selesai" selected="selected">Belum Selesai</option>
                        <option value="belum">Sudah Selesai</option>
                        <option value="progres">Dalam Progres</option>
                        <option value="tangguh">Ditangguhkan</option>
                    </select>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Status-->

        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Maklumat Umum</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Pengesahan</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_reviews">Perekodan</a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Umum options-->
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
                                    <label class="required form-label">Nama Program</label>
                                    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Program" value="" required/>
                                    {{--                                                            <!--begin::Description-->--}}
                                    {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                    {{--                                                            <!--end::Description-->--}}
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">Objektif Program</label>
                                    <input type="text" name="objektif" class="form-control mb-2" placeholder="Objektif Program" value="" required/>
                                    {{--                                                            <!--begin::Description-->--}}
                                    {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                    {{--                                                            <!--end::Description-->--}}
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">Tarikh Program</label>
                                    <input class="form-control form-control-solid" name="tarikh" placeholder="Pilih tarikh" id="kt_daterangepicker_1"/>
                                    {{--                                                            <!--begin::Description-->--}}
                                    {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                    {{--                                                            <!--end::Description-->--}}
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">Tempat Program</label>
                                    <input type="text" name="tempat" class="form-control mb-2" placeholder="Tempat Program" value="" required/>
                                    {{--                                                            <!--begin::Description-->--}}
                                    {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                    {{--                                                            <!--end::Description-->--}}
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">Masa Program</label>
                                    <input class="form-control form-control-solid" name="masa" placeholder="Pilih tarikh" id="kt_daterangepicker_2"/>
                                    {{--                                                            <!--begin::Description-->--}}
                                    {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                    {{--                                                            <!--end::Description-->--}}
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">Penganjur Program</label>
                                    <input type="text" name="penganjur" class="form-control mb-2" placeholder="Penganjur Program" value="" required/>
                                    {{--                                                            <!--begin::Description-->--}}
                                    {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                    {{--                                                            <!--end::Description-->--}}
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div>
                                    <!--begin::Label-->
                                    <label class="form-label">Catatan</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <div id="kt_docs_quill_basic" name="kt_docs_quill_basic" class="min-h-200px mb-2">
                                        Sila berikan catatan anda...
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
                        <!--end::Umum options-->
                    </div>
                </div>
                <!--end::Tab pane-->

                <!--begin::Tab pane pengesahan-->
                <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Senarai Pengesahan-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Senarai Pengesahan Kehadiran</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 table-responsive mx-10">
                                <!--begin::Table-->
                                <table class="table table-row-dashed fs-6 gy-5 my-0">
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Nama</th>
                                        <th class="min-w-175px">No. Kad Pengenalan</th>
                                        <th class="min-w-175px">Alamat</th>
                                        <th class="min-w-175px">No. Telefon</th>
                                        <th class="min-w-175px">Pengesahan</th>
                                        <th class="min-w-175px">Catatan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            Ahmad Faizal bin Ahmad
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                890101011234
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">No. 12, Jalan Merbuk, Taman Setia, 43000 Kajang, Selangor</td>
                                        <td class="text-gray-600 fw-bold">012-3456789</td>
                                        <td class="text-gray-600 fw-bold">Hadir</td>
                                        <td class="text-gray-600 fw-bold">Tepat pada masanya</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Siti Nurhaliza binti Abdul
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                900202022345
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">No. 34, Jalan Matahari, Taman Cahaya, 50450 Kuala Lumpur</td>
                                        <td class="text-gray-600 fw-bold">013-4567890</td>
                                        <td class="text-gray-600 fw-bold">Tidak Hadir</td>
                                        <td class="text-gray-600 fw-bold">Cuti sakit</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Mohd Faiz bin Mohd
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                920303033456
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">No. 56, Jalan Teratai, Taman Seri, 11600 Pulau Pinang</td>
                                        <td class="text-gray-600 fw-bold">014-5678901</td>
                                        <td class="text-gray-600 fw-bold">Hadir</td>
                                        <td class="text-gray-600 fw-bold">Hadir lewat 10 minit</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nurul Ain binti Razali
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                940404044567
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">No. 78, Jalan Kenanga, Taman Melati, 81300 Skudai, Johor</td>
                                        <td class="text-gray-600 fw-bold">015-6789012</td>
                                        <td class="text-gray-600 fw-bold">Hadir</td>
                                        <td class="text-gray-600 fw-bold">-</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Hafiz bin Hamid
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                970606066789
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">No. 90, Jalan Dahlia, Taman Bunga, 75100 Melaka</td>
                                        <td class="text-gray-600 fw-bold">016-7890123</td>
                                        <td class="text-gray-600 fw-bold">Tidak Hadir</td>
                                        <td class="text-gray-600 fw-bold">Urusan keluarga</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Ahmad Faizal bin Ahmad
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                980707077890
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">No. 23, Jalan Anggerik, Taman Bukit, 70200 Seremban, Negeri Sembilan</td>
                                        <td class="text-gray-600 fw-bold">017-8901234</td>
                                        <td class="text-gray-600 fw-bold">Hadir</td>
                                        <td class="text-gray-600 fw-bold">Akan menghadiri program</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Syafiq bin Hassan
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                001010099012
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">No. 45, Jalan Cempaka, Taman Sentosa, 40100 Shah Alam, Selangor</td>
                                        <td class="text-gray-600 fw-bold">018-9012345</td>
                                        <td class="text-gray-600 fw-bold">Tidak Hadir</td>
                                        <td class="text-gray-600 fw-bold">Bercuti</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Senarai Pengesahan-->
                    </div>
                </div>
                <!--end::Tab pane pengesahan-->

                <!--begin::Tab pane perekodan-->
                <div class="tab-pane fade" id="kt_ecommerce_add_product_reviews" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Rekod Kehadiran-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Rekod Kehadiran</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">No. Kad Pengenalan</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="no_kp" class="form-control mb-2" placeholder="No. Kad pengenalan" value="011985001" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                        <span class="indicator-label">Hadir</span>
                                        <span class="indicator-progress">Tunggu sebentar...
													            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Rekod Kehadiran-->
                        <!--begin::Senarai kehadiran-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Senarai Klien Yang Hadir</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 table-responsive mx-10">
                                <!--begin::Table-->
                                <table class="table table-row-dashed fs-6 gy-5 my-0" >
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Nama</th>
                                        <th class="min-w-175px">No. Kad Pengenalan</th>
                                        <th class="min-w-175px">Tarikh/Masa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            Ahmad Faizal bin Ahmad
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                890101011234
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">2023-05-15 14:30:00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Siti Nurhaliza binti Abdul
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                900202022345
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">2023-06-16 15:45:00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Mohd Faiz bin Mohd
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                920303033456
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">2023-07-17 16:50:00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nurul Ain binti Razali
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                940404044567
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">2023-08-18 17:55:00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Hafiz bin Hamid
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                970606066789
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">2023-10-20 19:25:00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Ahmad Faizal bin Ahmad
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                980707077890
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">2023-11-21 20:30:00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Syafiq bin Hassan
                                        </td>
                                        <td>
                                            <a href="../../demo1/dist/apps/inbox/reply.html" class="d-flex text-dark text-gray-800 text-hover-primary">
                                                001010099012
                                            </a>
                                        </td>
                                        <td class="text-gray-600 fw-bold">2024-01-23 22:40:00</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Senarai kehadiran-->
                    </div>
                </div>
                <!--end::Tab pane perekodan-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->

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
