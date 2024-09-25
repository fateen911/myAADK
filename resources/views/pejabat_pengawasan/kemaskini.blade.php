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

        <style>
            .form-select.custom-select {
                background-color: #e0e0e0 !important;
                color: #222222 !important;
            }

            .form-select.custom-select option {
                background-color: #f5f5f5 !important;
                color: #222222 !important;
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
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Pejabat AADK</a>
                </li>
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
            <div id="kt_app_content_container" class="app-container container-xxl" style="width: 80%;">
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
                                        
                                        <select class="form-select form-select-solid custom-select" id="negeri_baharu" name="negeri_baharu" data-control="select2" required>
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
                                        <select class="form-select form-select-solid custom-select" name="daerah_baharu" id="daerah_baharu" data-control="select2" required>
                                            <option value="">Pilih Daerah</option>
                                            @foreach ($senaraiDaerah as $item2)
                                                <option value="{{ $item2->kod }}" data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Hantar</button>
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
            document.addEventListener('DOMContentLoaded', function() {
                const negeriSelect = document.getElementById('negeri_baharu');
                const daerahSelect = document.getElementById('daerah_baharu');

                // Debugging: Log when the DOM is ready
                console.log("DOM Loaded");

                // Function to filter daerah options based on selected negeri
                function filterDaerahOptions() {
                    const selectedNegeriId = negeriSelect.value; // Use value to get the selected negeri_id

                    // Debugging: Log the selected negeri_id
                    console.log("Selected Negeri ID:", selectedNegeriId);

                    Array.from(daerahSelect.options).forEach(option => {
                        if (option.getAttribute('data-negeri-id') === selectedNegeriId || option.value === "") {
                            // Show option if it belongs to the selected negeri or is the placeholder option
                            option.style.display = 'block';
                        } else {
                            // Hide other options
                            option.style.display = 'none';
                        }
                    });
                    // Reset daerah value when negeri changes
                    daerahSelect.value = ''; 
                }

                // Event listeners
                negeriSelect.addEventListener('change', filterDaerahOptions);

                // Initial setup
                filterDaerahOptions();
            });
        </script>
    </body>
@endsection
