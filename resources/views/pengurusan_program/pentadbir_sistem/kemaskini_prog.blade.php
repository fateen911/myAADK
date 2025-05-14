@php use Illuminate\Support\Str; @endphp
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
            /* Hide number input spinners in WebKit browsers */
            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Hide number input spinners in Firefox */
            input[type="number"] {
                -moz-appearance: textfield;
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
            <li class="breadcrumb-item text-muted">Pengurusan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Kemaskini Aktiviti</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <!--begin::Body-->
    <!--begin::Main-->
    <div class="app-main mx-w-300" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-md-flex flex-md-column flex-md-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Form-->
                    <form id="program_form" class="form d-flex flex-column flex-lg-row" action="{{ url('/pengurusan-program/pentadbir-sistem/post-kemaskini-prog/'.$program->id) }}" method="POST">
                        @csrf
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Maklumat Aktiviti</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">Kategori Aktiviti</label>
                                        <!--begin::Select2-->
                                        <select class="form-select" name="kategori" aria-label="Select example" required>
                                            <option selected="selected">Sila Pilih</option>
                                            @foreach($kategori as $item)
                                                @if($program->kategori_id == $item->id)
                                                    <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">Nama Aktiviti</label>
                                        <input type="text" name="nama" class="form-control mb-2" value="{{$program->nama}}" required/>
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
                                            <div id="kt_docs_quill_basic" class="min-h-200px mb-2">
                                                {!!$program->objektif!!}
                                            </div>
                                            <input type="hidden" id="objektif" name="objektif">
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
                                                <input class="form-control form-control-solid" name="tarikh_mula" placeholder="Pilih tarikh" id="kt_daterangepicker_1" value="{{date('d/m/Y h:iA', strtotime($program->tarikh_mula))}}"/>
                                            </div>
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-300px">
                                                <label class="required form-label">Tarikh & Masa Tamat</label>
                                                <input class="form-control form-control-solid" name="tarikh_tamat" placeholder="Pilih tarikh" id="kt_daterangepicker_2" value="{{date('d/m/Y h:iA', strtotime($program->tarikh_tamat))}}"/>
                                            </div>
                                        </div>
                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>
                                    <!--end::Input group-->

                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">Tempat Aktiviti</label>
                                        <input type="text" name="tempat" id="tempat" class="form-control mb-2" value="{{$program->tempat}}" required/>
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <div class="form d-flex flex-column flex-lg-row mb-6">
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-300px me-lg-10">
                                                <label class="form-label">Negeri</label>
                                                <select id="negeri" class="form-select" name="negeri"  required>
                                                    @php
                                                        $displayName = $negeriP->negeri;
                                                        if (Str::contains($displayName, 'NEGERI SEMBILAN')) {
                                                            // For Negeri Sembilan, remove only 'AADK '
                                                            $displayName = Str::replaceFirst('AADK ', '', $negeriP->negeri);
                                                        } else {
                                                            // For others, remove 'AADK NEGERI '
                                                            $displayName = Str::replaceFirst('AADK NEGERI ', '', $negeriP->negeri);
                                                        }
                                                    @endphp
                                                    <option value="{{$program->negeri}}">{{$displayName}}</option>
                                                    @foreach($negeri as $item)
                                                        @php
                                                            $displayName2 = $item->negeri;
                                                            if (Str::contains($displayName2, 'NEGERI SEMBILAN') || Str::contains($displayName2, 'WILAYAH PERSEKUTUAN')) {
                                                                // For Negeri Sembilan, remove only 'AADK '
                                                                $displayName2 = Str::replaceFirst('AADK', '', $item->negeri);
                                                            } else {
                                                                // For others, remove 'AADK NEGERI '
                                                                $displayName2 = Str::replaceFirst('AADK NEGERI', '', $item->negeri);
                                                            }
                                                        @endphp
                                                        <option value="{{$item->id}}">{{ $displayName2 }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-300px">
                                                <label class="form-label">Daerah</label>
                                                <select id="daerah" class="form-select" name="daerah"  required>
                                                    <option value="{{$program->daerah}}">{{ \Illuminate\Support\Str::replaceFirst('AADK DAERAH', '', $daerahP->daerah) }}</option>
                                                    <!--AJAX-->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                    <div class="mb-5 fv-row">
                                        <div class="form d-flex flex-column flex-lg-row mb-5">
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-350px me-lg-10">
                                                <label class="required form-label">Nama Pegawai</label>
                                                <input type="text" name="nama_pegawai" class="form-control mb-2" value="{{$program->nama_pegawai}}" required/>
                                            </div>
                                            <div class="d-flex flex-column flex-row-fluid w-100 w-lg-350px">
                                                <label class="form-label">Penganjur Aktiviti (Jika Ada)</label>
                                                <input type="text" name="penganjur" class="form-control mb-2" value="{{$program->penganjur}}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">No. Telefon Untuk Dihubungi</label>
                                        <input type="text" name="no_tel_dihubungi" class="form-control mb-2" placeholder="Contoh: 601134789594" value="{{$program->no_tel_dihubungi}}" maxlength="11" onkeypress="return isNumberKey(event)" required/>
                                    </div>

                                    <!-- Input bagi hebahan pindaan program -->
                                    <input type="checkbox" id="hebah_pindaan" name="hebah_pindaan" style="display: none;">
                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="form-label">Catatan (Jika Ada)</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <div id="kt_docs_quill_basic_2" class="min-h-200px mb-2">
                                            {!!$program->catatan!!}
                                        </div>
                                        <!--end::Editor-->
                                        {{--                                                            <!--begin::Description-->--}}
                                        {{--                                                            <div class="text-muted fs-7">Berikan catatan anda.</div>--}}
                                        {{--                                                            <!--end::Description-->--}}
                                    </div>
                                    <input type="hidden" id="catatan" name="catatan">
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="{{ url('pengurusan-program/pentadbir-sistem/maklumat-prog/'.$program->id) }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Batal</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="button" id="submitBtn" class="btn btn-primary">
                                    <span class="indicator-label">Kemaskini</span>
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

    <!--filter-->
    <script>
        $(document).ready(function() {
            $('#negeri').change(function() {
                var negeriId = $(this).val();
                if (negeriId) {
                    $.ajax({
                        url: '/daerah/' + negeriId,
                        type: 'GET',
                        success: function(response) {
                            $('#daerah').empty();
                            $('#daerah').append('<option value="">Pilih Daerah</option>');
                            $.each(response, function(key, daerah) {
                                var nameWithoutPrefix = daerah.daerah.replace(/^AADK DAERAH\s*/, '');
                                $('#daerah').append('<option value="' + daerah.kod + '">' + nameWithoutPrefix + '</option>');
                            });
                        }
                    });
                } else {
                    $('#daerah').empty();
                    $('#daerah').append('<option value="">Pilih Daerah</option>');
                }
            });
        });
    </script>

    <script>
        // Store initial values for comparison
        const tarikh_mula_asal = "{{ $program->tarikh_mula }}";
        const tarikh_tamat_asal = "{{ $program->tarikh_tamat }}";
        const tempat_asal = "{{ $program->tempat }}";

        document.getElementById('submitBtn').addEventListener('click', function() {
            // Get current values
            const date_1 = document.getElementById('kt_daterangepicker_1').value;
            const tarikh_mula_terkini = moment(date_1, 'DD/MM/YYYY hh:mmA').format('YYYY-MM-DD HH:mm:ss');
            const date_2 = document.getElementById('kt_daterangepicker_2').value;
            const tarikh_tamat_terkini = moment(date_2, 'DD/MM/YYYY hh:mmA').format('YYYY-MM-DD HH:mm:ss');
            const tempat_terkini = document.getElementById('tempat').value;

            // Check if date or location has changed
            if (tarikh_mula_terkini !== tarikh_mula_asal || tarikh_tamat_terkini !== tarikh_tamat_asal || tempat_terkini !== tempat_asal) {
                Swal.fire({
                    title: 'Pengesahan Pindaan',
                    text: "Adakah anda ingin membuat hebahan mengenai perubahan terkini",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Kemaskini dan Hebah',
                    cancelButtonText: 'Kemaskini Sahaja',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Check the checkbox to indicate notification
                        document.getElementById('hebah_pindaan').checked = true;
                    }
                    // Submit the form
                    var quillHtml1 = document.getElementById('kt_docs_quill_basic').children[0].innerHTML;
                    var quillHtml2 = document.getElementById('kt_docs_quill_basic_2').children[0].innerHTML;

                    // Assign the content to a hidden input field
                    document.querySelector('input[name=objektif]').value = quillHtml1;
                    document.querySelector('input[name=catatan]').value = quillHtml2;
                    document.getElementById('program_form').submit();
                });
            } else {
                // If no changes, just submit the form
                var quillHtml1 = document.getElementById('kt_docs_quill_basic').children[0].innerHTML;
                var quillHtml2 = document.getElementById('kt_docs_quill_basic_2').children[0].innerHTML;

                // Assign the content to a hidden input field
                document.querySelector('input[name=objektif]').value = quillHtml1;
                document.querySelector('input[name=catatan]').value = quillHtml2;
                document.getElementById('program_form').submit();
            }
        });
    </script>

    <script>
        function isNumberKey(evt) {
            // Get the ASCII code of the key pressed
            var charCode = evt.which ? evt.which : evt.keyCode;

            // Allow only numbers (0-9), and prevent others
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }

            // If the character is a valid number, allow it
            return true;
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

    <script>
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
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: "DD/MM/YYYY hh:mm A"
                }
            }
        );

        $("#kt_daterangepicker_2").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: "DD/MM/YYYY hh:mm A"
                }
            }
        );

    </script>
@endsection
