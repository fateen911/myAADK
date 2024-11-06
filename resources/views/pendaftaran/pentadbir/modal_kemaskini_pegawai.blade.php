<!DOCTYPE html>
<html>
    <head>
        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/assets/plugins/custom/datatables/datatables.bundle.css">
        <link rel="stylesheet" href="/assets/css/style.bundle.css">
        <link rel="stylesheet" href="/assets/css/customAADK.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
                        <span class="input-group-text">@adk.gov.my</span>
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
                @if ($pegawai->negeri_bertugas != null)
                    <div class="fv-row mb-5" id="kemaskini_negeri_field">
                        <label class="fs-6 fw-semibold mb-2 required">Negeri Bertugas</label>
                        <select name="negeri_bertugas" id="negeri_bertugas" class="form-select form-select-solid custom-select">
                            <option value="">Pilih Negeri Bertugas</option>
                            @foreach ($negeri as $item1)
                                <option value="{{ $item1->negeri_id }}" {{ $pegawai->negeri_bertugas == $item1->negeri_id ? 'selected' : '' }} data-id="{{ $item1->negeri_id }}">{{ $item1->negeri }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!-- Daerah Bertugas -->
                @if ($pegawai->daerah_bertugas != null)
                    <div class="fv-row mb-5" id="kemaskini_daerah_field">
                        <label class="fs-6 fw-semibold mb-2 required">Daerah Bertugas</label>
                        <select name="daerah_bertugas" id="daerah_bertugas" class="form-select form-select-solid custom-select">
                            <option value="">Pilih Daerah Bertugas</option>
                            @foreach ($daerah as $item2)
                                <option value="{{ $item2->kod }}" {{ $pegawai->daerah_bertugas == $item2->kod ? 'selected' : '' }} data-negeri-id="{{ $item2->negeri_id }}">{{ $item2->daerah }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

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

        {{-- Validate input --}}
        <script>
            // Function to validate 'Nama' field
            function validateNama(input) {
                // Allow only alphabets, @, and ' characters
                input.value = input.value.replace(/[^a-zA-Z@' ]/g, '');
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

        {{-- Display field bertugas based on peranan --}}
        <script>
            // Function to toggle fields based on tahap_pengguna value
            function toggleFields() {
                const tahapPengguna = document.getElementById('tahap_pengguna').value;
                const negeriField = document.getElementById('kemaskini_negeri_field');
                const daerahField = document.getElementById('kemaskini_daerah_field');

                // Show or hide the "Negeri Bertugas" field if tahap_pengguna is 4 or 5
                negeriField.style.display = (tahapPengguna == 4 || tahapPengguna == 5) ? 'block' : 'none';

                // Show or hide the "Daerah Bertugas" field if tahap_pengguna is 5
                daerahField.style.display = (tahapPengguna == 5) ? 'block' : 'none';
            }

            // Run the toggle function when the modal is opened
            document.addEventListener('DOMContentLoaded', function() {
                toggleFields(); // Initial check to set the correct display based on tahap_pengguna
            });

            // Also run the toggle function whenever tahap_pengguna is changed
            document.getElementById('tahap_pengguna').addEventListener('change', toggleFields);
        </script>

        {{-- Filter daerah based on negeri --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const negeriSelect = document.getElementById('negeri_bertugas');
                const daerahSelect = document.getElementById('daerah_bertugas');
            
                negeriSelect.addEventListener('change', function() {
                    const negeriId = this.value;
            
                    // Clear previous daerah options
                    daerahSelect.innerHTML = '<option value="">Pilih Daerah Bertugas</option>';
            
                    if (negeriId) {
                        // Fetch daerah based on selected negeri_id
                        fetch(`/get-daerah-bertugas/${negeriId}`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(daerah => {
                                    const option = document.createElement('option');
                                    option.value = daerah.kod; // Adjust to your 'kod' column
                                    option.text = daerah.daerah; // Adjust to your 'daerah' column
                                    daerahSelect.appendChild(option);
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching daerah:', error);
                            });
                    }
                });
            });
        </script>

        {{-- Display field bertugas based on peranan and filter daerah based on negeri --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const negeriSelect = document.getElementById('negeri_bertugas');
                const daerahSelect = document.getElementById('daerah_bertugas');

                // Function to filter daerah options based on selected negeri and kod_daerah_pejabat
                function filterDaerahOptions() {
                    const selectedNegeriId = negeriSelect.options[negeriSelect.selectedIndex].getAttribute('data-id');
                    Array.from(daerahSelect.options).forEach(option => {
                        if (option.getAttribute('data-negeri-id') === selectedNegeriId  && option.value !== '') {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                    daerahSelect.value = '';
                }

                // Event listeners
                negeriSelect.addEventListener('change', filterDaerahOptions);

                // Initial setup
                filterDaerahOptions();
            });
        </script>
    </body>
</html>

