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
            <li class="breadcrumb-item text-muted">Senarai Program</li>
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
                            <h2>Senarai Program<br><small>Sila klik pada butang "Tambah Program" untuk mendaftarkan program baharu.</small></h2>
                        </div>

                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end gap-3" data-kt-customer-table-toolbar="base">
                                <!--begin::Add program-->
                                <a href={{url('/pengurusan-program/pegawai-aadk/daftar-prog')}}>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
                                        <i class="bi bi-plus-circle"></i> Program &nbsp;
                                    </button>
                                </a>
                                <!--end::Add program-->
                                <!--begin::Add category-->
                                <a href={{url('/pengurusan-program/pegawai-aadk/tambah-kategori')}}>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
                                        <i class="bi bi-plus-circle"></i> Kategori &nbsp;
                                    </button>
                                </a>
                                <!--end::Add category-->
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
                            <tr class="text-center text-gray-400 fw-bold fs-7 gs-0 text-uppercase">
                                <th class="min-w-40px">ID</th>
                                <th class="min-w-175px">Nama Program</th>
                                <th class="min-w-200px">Kategori</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-50px">Hebahan</th>
                                <th class="min-w-50px">QR Perekodan</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                            <!--ajax-->
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
    </div>

    <!--begin::Modal - hebahan-->
    <!-- Modal-->
    <div class="modal fade modal-lg" id="hebahanModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">HEBAHAN PROGRAM</h5>
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body" id="modalBody">

                </div>

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
                    url: '/program',
                    method: 'GET',
                    success: function(response) {
                        let rows = '';
                        $.each(response, function(index, program) {
                            rows += '<tr>';
                            rows += '<td><a href="{{url('/pengurusan-program/pegawai-aadk/maklumat-prog')}}/' + program.id + '">' + program.custom_id + '</a></td>';
                            rows += '<td class="text-uppercase">' + program.nama + '</td>';
                            rows += '<td class="text-uppercase">' + program.kategori.nama + '</td>';
                            rows += '<td class="text-uppercase">' + program.status + '</td>';
                            rows += '<td class="text-uppercase text-center"><a id="program" class="btn btn-icon btn-info btn-sm" data-toggle="modal" data-target="#hebahanModal" data-id="' + program.id + '"><i class="bi bi-share-fill fs-3"></i></a></td>';
                            rows += '<td class="text-uppercase text-center"><a class="btn btn-icon btn-success btn-sm" href={{url('/pengurusan-program/qr-code')}}/' + program.id + '><i class="bi bi-qr-code fs-3"></i></a></td>';
                            rows += '</tr>';
                        });
                        $('#sortTable1 tbody').html(rows);
                    }
                });
            }
        });
    </script>

    <!-- Modal Hebahan -->
    <script>
        $(document).on('click', '#program', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/pengurusan-program/hebahan/papar-hebahan/'+ id, // Laravel route with dynamic ID
                method: 'GET',
                success: function(response) {
                    $('#modalBody').html(response);
                },
                error: function() {
                    $('#modalBody').html('Error loading content.');
                }
            });
        });
    </script>

    <script>
        // JavaScript function to select/deselect all checkboxes
        function toggleAll(source) {
            checkboxes = document.querySelectorAll('input[name="pilihan[]"]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
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
    <!--share button-->
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('share-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default anchor behavior
            var icons = document.getElementById('social-media-icons');
            if (icons.classList.contains('hidden')) {
                icons.classList.remove('hidden');
            } else {
                icons.classList.add('hidden');
            }
        });
    </script>

    {{--display data from database--}}
    {{--<script>
            $(document).ready(function() {
                $.ajax({
                    url: '/program',
                    method: 'GET',
                    success: function(data) {
                        let tableBody = $('#sortTable1 tbody');
                        tableBody.empty(); // Clear any existing data

                        if (data.length === 0) {
                            let noDataRow = `<tr id="no-data">
                                <td colspan="5" class="text-center">No data available</td>
                            </tr>`;
                            tableBody.append(noDataRow);
                        } else {
                            data.forEach(course => {
                                let row = `<tr>
                                    <td>${program.id}</td>
                                    <td>${program.title}</td>
                                    <td>${program.description}</td>
                                    <td>${program.category_id}</td>
                                    <td>${program.lecturer_id}</td>
                                </tr>`;
                                tableBody.append(row);
                            });
                        }
                    },
                    error: function() {
                        alert('Failed to fetch program');
                    }
                });
            });
        </script>
    --}}
@endsection
