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
        <meta name="viewport" content="width=device-width, initial-scale=1" />

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
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Aktiviti</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Tambah Kategori</li>
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
        <form class="form d-flex flex-column flex-lg-row" action="{{ url('/pengurusan-program/pentadbir-sistem/post-tambah-kategori') }}" method="POST">
            @csrf
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 mb-7 me-lg-10 h-100px w-400px">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Kategori Aktiviti</h2>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="mb-5 fv-row">
                            <label class="required form-label">Nama Kategori</label>
                            <input type="text" name="nama" class="form-control mb-2" value="" required/>
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="required form-label">Kod Kategori</label>
                            <input type="text" name="kod" class="form-control mb-2" value="" required/>
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
                                    <th class="min-w-60px">Tindakan</th>
                                </tr>
                                </thead>
                                <tbody id="items-table-body">
                                    <!--ajax-->
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

    <!--begin::Modal - kemaskini-->
    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">KEMASKINI KATEGORI</h5>
                    <div class="btn btn-icon btn-sm ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg fs-4"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <form action="{{ url('/pengurusan-program/pentadbir-sistem/post-kemaskini-kategori') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-5 fv-row">
                            <label class="required form-label">Nama Kategori</label>
                            <input type="text" name="nama2" id="nama2" class="form-control mb-2" value="" required/>
                        </div>
                        <div class="mb-5 fv-row">
                            <label class="required form-label">Kod Kategori</label>
                            <input type="text" name="kod2" id="kod2" class="form-control mb-2" value="" required/>
                        </div>
                        <input type="hidden" name="kat_id" id="katId" value="">
                    </div>

                    <div class="modal-footer gap-3">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kemaskini</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal - hebahan-->

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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            fetchItems();

            function fetchItems() {
                $.ajax({
                    url: '/kategori',
                    method: 'GET',
                    success: function(response) {
                        let rows = '';
                        $.each(response, function(index, kategori) {
                            let formattedDate = moment(kategori.created_at).format('DD-MM-YYYY HH:mm:ss');
                            rows += '<tr>';
                            rows += '<td class="text-uppercase" id="nama">' + kategori.nama + '</td>';
                            rows += '<td class="text-uppercase" id="kod">' + kategori.kod + '</td>';
                            rows += '<td class="text-gray-600 fw-bold">' + formattedDate + '</td>';
                            rows += '<td><a id="kategori" class="btn btn-icon btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-id="' + kategori.id + '"><i class="bi bi-pencil-fill fs-3"></i></a><a href="{{url('/pengurusan-program/pentadbir-sistem/padam-kategori/')}}/' + kategori.id + '" data-link="{{url('/pengurusan-program/pentadbir-sistem/padam-kategori/')}}/' + kategori.id + '" class="btn btn-icon btn-danger btn-sm" id="padam"> &nbsp;<i class="bi bi-trash3-fill fs-3"></i></a></td>';
                            rows += '</tr>';
                        });
                        $('#items-table-body').html(rows);
                    }
                });
            }
        });
    </script>
    <!-- Modal Kemaskini -->
    <script>
        $(document).on('click', '#kategori', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/kategori-data/' + id,  // Pass the item ID in the URL
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    document.getElementById('nama2').value = data.nama;
                    document.getElementById('kod2').value = data.kod;
                    document.getElementById('katId').value = data.id;
                },
                error: function() {
                    alert('Category not found');
                }
            });
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
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: '{!! session('success') !!}',
                confirmButtonText: 'OK'
            });
            @endif

            @if(session('success2'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: '{!! session('success2') !!}',
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

            @if(session('error2'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: '{!! session('error2') !!}',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>
    <script>
        $(document).on('click', '#padam', function(e) {
            e.preventDefault(); // Prevent default action (like submitting a form or following a link)
            var link = $(this).data('link'); // Get the link from the data-link attribute
            Swal.fire({
                html: "Adakah anda pasti?",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the link if the user confirms
                    window.location.href = link;
                }
            });
        });
    </script>


@endsection
