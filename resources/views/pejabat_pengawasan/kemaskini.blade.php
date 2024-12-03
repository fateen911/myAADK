@extends('layouts._default')

@section('content')
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
            .form-select.custom-select {
                background-color: #e0e0e0 !important;
                color: #222222 !important;
            }

            .form-select.custom-select option {
                background-color: #f5f5f5 !important;
                color: #222222 !important;
            }

            @media (max-width: 768px) {
                .page-title {
                    font-size: 1.5rem;
                }
                .card {
                    /* margin: 10px; */
                    padding-right: none;
                    padding-left: none;
                }
                .form-select {
                    width: 100% !important;
                }

                .app-content {
                    justify-content: flex-start; /* Aligns the content to the left */
                    align-items: flex-start;  /* Optional: Aligns vertically to the top */
                }
                .container-xxl {
                    width: 100%; /* Ensures the container stretches across the width */
                    padding-left: 0;
                    padding-right: 0;
                }
                .card {
                    margin-left: 0;
                    margin-right: 0;
                }
            }

            .swal-wide {
                width: 90% !important;
            }
        </style>
    </head>

    <body>
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pejabat AADK</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Pejabat AADK</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Kemaskini</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid d-flex justify-content-center align-items-center">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container" style="width: 80%;">
                <!--begin::Sign-in Method-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Kemaskini Pejabat AADK</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
        
                    <!--begin::Content-->
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <form method="POST" action="{{ route('kemaskini.pejabat-pengawasan') }}" id="pejabatPengawasanForm">
                            @csrf
        
                            @php
                                $daerahSemasa = DB::table('senarai_daerah_pejabat')->where('kod', $pejabatKlien->daerah_pejabat)->value('senarai_daerah_pejabat.daerah');
                                $negeriSemasa = DB::table('senarai_negeri_pejabat')->where('negeri_id', $pejabatKlien->negeri_pejabat)->value('senarai_negeri_pejabat.negeri');
                            @endphp
                            
                            <div class="card-body border-top p-9">
                                <!-- Pejabat Pengawasan Semasa -->
                                <div class="row mb-6">
                                    <label class="col-lg-5 col-form-label fw-semibold fs-6">
                                        <span>Pejabat AADK Negeri Semasa</span>
                                    </label>
                                    <div class="col-lg-7 fv-row position-relative">
                                        <span name="negeri_lama" class="fs-6 form-control-plaintext">{{$negeriSemasa}}</span>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-5 col-form-label fw-semibold fs-6">
                                        <span>Pejabat AADK Daerah Semasa</span>
                                    </label>
                                    <div class="col-lg-7 fv-row position-relative">
                                        <span name="negeri_lama" class="fs-6 form-control-plaintext">{{$daerahSemasa}}</span>
                                    </div>
                                </div>
        
                                <!-- Pejabat Pengawasan Baru -->
                                <div class="row mb-6">
                                    <label class="col-lg-5 col-form-label fw-semibold fs-6">
                                        <span class="required">Pejabat AADK Negeri Baharu</span>
                                    </label>
                                    <div class="col-lg-7 fv-row position-relative">
                                        <select class="form-select form-select-solid w-100 custom-select filterDaerahOptions" id="negeri_baharu" name="negeri_baharu" data-control="select2" required>
                                            <option value="">Pilih Negeri</option>
                                            @foreach ($senaraiNegeri as $item1)
                                                <option value="{{ $item1->negeri_id }}" data-id="{{ $item1->negeri_id }}">{{ $item1->negeri }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-6">
                                    <label class="col-lg-5 col-form-label fw-semibold fs-6">
                                        <span class="required">Pejabat AADK Daerah Baharu</span>
                                    </label>
                                    <div class="col-lg-7 fv-row position-relative">
                                        <select class="form-select form-select-solid w-100 custom-select" name="daerah_baharu" id="daerah_baharu" required>
                                            <option value="" data-negeri-id="">Pilih Daerah</option>
                                            @foreach ($senaraiDaerah as $item2)
                                                <option value="{{ $item2->kod }}" data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Sign-in Method-->
            </div>
            <!--end::Content container-->
        </div>    
        <!--end::Content-->

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        {{-- Success / Error Message --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berjaya!',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'OK'
                    });
                @endif

                @if(session('error'))
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Berjaya!',
                        text: '{{ session('error') }}',
                        confirmButtonText: 'OK'
                    });
                @endif
            });
        </script>

        <script>
            document.getElementById('kt_account_profile_details_submit').addEventListener('click', function(event) {
                let negeriBaharu = document.getElementById('negeri_baharu').value;
                let daerahBaharu = document.getElementById('daerah_baharu').value;

                // Check if both fields are not selected
                if (negeriBaharu === 'Pilih Negeri' || !negeriBaharu || daerahBaharu === 'Pilih Daerah' || !daerahBaharu) {
                    event.preventDefault(); // Prevent form submission
                    alert('Sila pilih pejabat baharu bagi kedua-dua negeri dan daerah baharu sebelum hantar.'); // Show an error message
                }
            });
        </script>

        <script>
            $(document).ready(function() {
                // Initialize Select2
                $('#daerah_baharu').select2();
            
                $('#negeri_baharu').change(filterDaerahOptions);
            
                // Initial setup to filter options if needed
                filterDaerahOptions();
            });
            
            function filterDaerahOptions() {
                const selectedNegeriId = $('#negeri_baharu').val(); // Get the selected negeri_id
                console.log("Selected Negeri ID:", selectedNegeriId);
            
                const daerahSelect = $('#daerah_baharu');
                console.log("Daerah Dropdown:", daerahSelect);
            
                // Clear current options
                daerahSelect.empty(); 
            
                // Add the placeholder option
                daerahSelect.append('<option value="" data-negeri-id="">Pilih Daerah</option>');
            
                // If no state is selected, disable the dropdown
                if (!selectedNegeriId) {
                    daerahSelect.prop('disabled', true).val('').trigger('change'); // Reset and trigger change
                    return; // Exit the function
                } else {
                    daerahSelect.prop('disabled', false);
                }
            
                // Iterate through each district and add only matching options
                @foreach ($senaraiDaerah as $item2)
                    if ("{{ $item2->negeri_id }}" === selectedNegeriId) {
                        daerahSelect.append('<option value="{{ $item2->kod }}" data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>');
                    }
                @endforeach
            
                // Reinitialize Select2 to reflect the changes in the dropdown
                daerahSelect.select2().trigger('change');
            }
        </script>
    </body>
@endsection
