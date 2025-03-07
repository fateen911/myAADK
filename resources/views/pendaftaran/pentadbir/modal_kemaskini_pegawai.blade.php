<!DOCTYPE html>
<html>
    <head>
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/assets/plugins/custom/datatables/datatables.bundle.css">
        <link rel="stylesheet" href="/assets/css/style.bundle.css">
        <link rel="stylesheet" href="/assets/css/customAADK.css">
    </head>

    <body>
        <!--begin::Modal - Kemaskini Pegawai-->
        <form class="form" id="modal_kemaskini_pegawai_form" action="{{ route('kemaskini-pegawai') }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $pegawai->id }}">
            <div class="scroll-y me-n7 pe-7" id="modal_kemaskini_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_kemaskini_pegawai_header" data-kt-scroll-wrappers="#modal_kemaskini_pegawai_scroll" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                @php
                    $status_ak_2 = DB::table('users')->where('id', $pegawai->users_id)->value('acc_status');
                @endphp
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">Status Akaun</label>
                    <select id="statusAk2" class="form-select form-select-solid custom-select" name="status_ak" required>
                        <option value="AKTIF" {{ $status_ak_2 == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                        <option value="DIBEKUKAN" {{ $status_ak_2 == 'DIBEKUKAN' ? 'selected' : '' }}>DIBEKUKAN</option>
                    </select>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">Nama Penuh</label>
                    <input type="text" class="form-control form-control-solid custom-form" name="nama" id="nama" value="{{$pegawai->nama}}" style="text-transform: uppercase;" oninput="validateNama(this)" required/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">No. Kad Pengenalan
                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan no kad pengenalan tanpa '-'.">
                            <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </label>
                    <input type="text" class="form-control form-control-solid custom-form" id="no_kp_pegawai" name="no_kp" value="{{$pegawai->no_kp}}" inputmode="numeric" maxlength="12" oninput="validateNoKp(this)" required/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">E-mel</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-solid custom-form" id="emel" name="emel" value="{{ explode('@', $pegawai->emel)[0] }}" required/>
                        <span class="input-group-text">@aadk.gov.my</span>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="fs-6 fw-semibold mb-2 required">No. Telefon
                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                            <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </label>
                    <input type="text" class="form-control form-control-solid custom-form" id="no_tel_pegawai" name="no_tel" value="{{$pegawai->no_tel}}" inputmode="numeric" maxlength="11" oninput="validateNoTel(this)" required/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="fs-6 fw-semibold mb-2 required">Jawatan & Gred</label>
                    <select name="jawatan" id="jawatan" class="form-select form-select-solid custom-select">
                        <option value="">Pilih</option>
                        @foreach ($jawatan as $j)
                            <option value="{{ $j->id }}" {{$pegawai->jawatan == $j->id  ? 'selected' : ''}}>{{ $j->jawatan_gred }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group-->
                <!-- Tahap Pengguna -->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">Peranan</label>
                    <select name="tahap_pengguna" id="tahap_pengguna" class="form-select form-select-solid custom-select" onchange="toggleFields()">
                        @foreach ($tahap as $tahap1)
                            <option value="{{ $tahap1->id }}" {{ $pegawai->peranan == $tahap1->id ? 'selected' : '' }}>{{ $tahap1->peranan }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Negeri Bertugas -->
                <div class="fv-row mb-5" id="kemaskini_negeri_field" style="display: {{ $pegawai->negeri_bertugas != null ? 'block' : 'none' }}">
                    <label class="fs-6 fw-semibold mb-2 required">Negeri Bertugas</label>
                    <select class="form-select form-select-solid custom-select" name="negeri_bertugas" id="negeri_bertugas" data-control="select2" onchange="filterDaerahOptions()">>
                        <option value="">Pilih Negeri Bertugas</option>
                        @foreach ($negeri as $item1)
                            <option value="{{ $item1->negeri_id }}" {{ $pegawai->negeri_bertugas == $item1->negeri_id ? 'selected' : '' }}>{{ $item1->negeri }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Daerah Bertugas -->
                <div class="fv-row mb-5" id="kemaskini_daerah_field" style="display: {{ $pegawai->daerah_bertugas != null ? 'block' : 'none' }}">
                    <label class="fs-6 fw-semibold mb-2 required">Daerah Bertugas</label>
                    <select class="form-select form-select-solid custom-select" name="daerah_bertugas" id="daerah_bertugas" data-control="select2">
                        <option value="">Pilih Daerah Bertugas</option>
                        @foreach ($daerah as $item2)
                            <option value="{{ $item2->kod }}" data-negeri-id="{{ $item2->negeri_id }}" {{ $pegawai->daerah_bertugas == $item2->kod ? 'selected' : '' }}>
                                {{ $item2->daerah }}
                            </option>
                        @endforeach
                    </select>
                </div>                
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">Kata Laluan Baharu</label>
                    <div class="input-group">
                        <input type="text" maxlength="12" class="form-control form-control-solid custom-form" id="password{{$pegawai->id}}" name="password" />
                        <button type="button" class="btn btn-secondary" onclick="generatePasswordPegawai('password{{$pegawai->id}}')">Jana Kata Laluan</button>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Scroll-->

            <!--begin::Actions-->
            <div class="text-center">
                <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>

                <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary" onclick="return validateEmailDomain()">
                    <span class="indicator-label">Simpan</span>
                    <span class="indicator-progress">Sila tunggu...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Modal -  Kemaskini Pegawai-->

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        {{-- Form vaidation for Kemaskini Akaun Pegawai --}}
        <script>
            document.getElementById('modal_kemaskini_pegawai_form').addEventListener('submit', function (event) {
                // Get form elements
                const status = document.getElementById('statusAk2').value.trim();
                const name = document.getElementById('nama').value.trim();
                const no_kp = document.getElementById('no_kp_pegawai').value.trim();
                const email = document.getElementById('emel').value.trim();
                const no_tel = document.getElementById('no_tel_pegawai').value.trim();
                const jawatan = document.getElementById('jawatan').value;
                const peranan_pegawai = document.getElementById('tahap_pengguna').value;
                const negeri_bertugas = document.getElementById('negeri_bertugas').value;
                const daerah_bertugas = document.getElementById('daerah_bertugas').value;
            
                // Initialize error message
                let errorMessage = '';
            
                // Common required field check
                if (!status || !name || !no_kp || !email || !no_tel || !jawatan || !peranan_pegawai) {
                    errorMessage = 'Sila isi semua medan yang bertanda *.';
                } 
                else {
                    if (peranan_pegawai == 3) {
                        // No additional checks for peranan_pegawai == 3
                    } else if (peranan_pegawai == 4) {
                        // For peranan_pegawai == 4, only negeri_bertugas is required
                        if (!negeri_bertugas) {
                            errorMessage = 'Sila pilih Negeri Bertugas.';
                        }
                    } else if (peranan_pegawai == 5) {
                        // For peranan_pegawai == 5, both negeri_bertugas and daerah_bertugas are required
                        if (!negeri_bertugas || !daerah_bertugas) {
                            errorMessage = 'Sila pilih Negeri Bertugas dan Daerah Bertugas.';
                        }
                    }
                }
            
                // If there is an error message, prevent form submission and display the message
                if (errorMessage) {
                    event.preventDefault();  // Prevent form submission
                    alert(errorMessage);     // Display the error message to the user 
                }
            });
        </script>   

        {{-- Validate input --}}
        <script>
            // Function to validate 'Nama' field
            function validateNama(input) {
                // Allow only alphabets, @, and ' characters
                input.value = input.value.replace(/[^a-zA-Z@'. ]/g, '');
            }

            // Function to validate 'No. Telefon' field
            function validateNoTel(input) {
                // Remove all non-numeric characters
                input.value = input.value.replace(/\D/g, '');

                // Limit the input length to 11 characters
                if (input.value.length > 11) {
                    input.value = input.value.slice(0, 11);
                }
            }

            // Function to validate 'No. Kad Pengenalan' field
            function validateNoKp(input) {
                // Remove all non-numeric characters
                input.value = input.value.replace(/\D/g, '');

                // Ensure the input length is exactly 12 characters
                if (input.value.length > 12) {
                    input.value = input.value.slice(0, 12);
                }
            }
        </script>

        {{-- Validate emel --}}
        <script>
            function validateEmailDomain() {
                const emailInput = document.getElementById('emel').value;

                // Check if email is empty
                if (emailInput.trim() === '') {
                    alert('Sila masukkan emel.');
                    return false; // Prevent form submission
                }
            
                // Check if email contains '@'
                if (emailInput.includes('@')) {
                    alert('Sila masukkan nama e-mel pengguna sahaja tanpa domain.');
                    return false; // Prevent form submission
                }

                return true; // Allow form submission if email is valid
            }
        </script>

        {{-- Display field tempat bertugas based on peranan --}}
        <script>
            // Define toggleFields globally so it's accessible from inline onchange
            function toggleFields() {
                const tahapPengguna = document.getElementById('tahap_pengguna').value;
                const negeriField = document.getElementById('kemaskini_negeri_field');
                const daerahField = document.getElementById('kemaskini_daerah_field');
                
                if (negeriField && daerahField) {
                    if (tahapPengguna === "3") {
                        negeriField.style.display = 'none';
                        daerahField.style.display = 'none';
                    } else if (tahapPengguna === "4") {
                        negeriField.style.display = 'block';
                        daerahField.style.display = 'none';
                    } else if (tahapPengguna === "5") {
                        negeriField.style.display = 'block';
                        daerahField.style.display = 'block';
                    }
                }
            }
        
            document.addEventListener('DOMContentLoaded', function() {
                // Call toggleFields on page load to set initial state
                toggleFields();
            });
        </script> 

        {{-- Filter daerah based on negeri --}}
        <script>
            // Function to filter daerah options based on selected negeri
            function filterDaerahOptions() {
                const negeriSelect = document.getElementById('negeri_bertugas');
                const daerahSelect = document.getElementById('daerah_bertugas');
                const selectedNegeriId = negeriSelect.value;
                
                console.log("Selected Negeri ID:", selectedNegeriId);

                Array.from(daerahSelect.options).forEach(option => {
                    if (option.getAttribute('data-negeri-id') === selectedNegeriId || option.value === '') {
                        option.hidden = false;
                    } else {
                        option.hidden = true;
                    }
                });

                daerahSelect.value = ''; // Reset daerah selection
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Call toggleFields on page load to set initial state
                filterDaerahOptions();
            });
        </script>
</html>

