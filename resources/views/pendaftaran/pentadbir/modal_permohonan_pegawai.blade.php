<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    
    <body>
        <form class="form" id="modal_permohonan_pegawai_form" action="{{ route('kelulusan-permohonan-pegawai', ['id' => $permohonan_pegawai->id]) }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $permohonan_pegawai->id }}">
            <div class="scroll-y me-n7 pe-7" id="modal_permohonan_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_permohonan_pegawai_header" data-kt-scroll-wrappers="#modal_permohonan_pegawai_scroll" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">Nama Penuh</label>
                    <input type="text" class="form-control form-control-solid custom-form" name="nama" id="nama" value="{{$permohonan_pegawai->nama}}" style="text-transform: uppercase;" oninput="validateNama(this)" required/>
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
                    <input type="text" class="form-control form-control-solid custom-form" id="no_kp_pegawai_mohon" name="no_kp" value="{{$permohonan_pegawai->no_kp}}" inputmode="numeric" maxlength="12" oninput="validateNoKp(this)" required/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">E-mel</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-solid custom-form" id="emelPegawai" name="emelPegawai" value="{{ explode('@', $permohonan_pegawai->emel)[0] }}" required/>
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
                    <input type="text" class="form-control form-control-solid custom-form" id="no_tel_pegawai_mohon" name="no_tel" value="{{$permohonan_pegawai->no_tel}}" inputmode="numeric" maxlength="11" oninput="validateNoTel(this)" required/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="fs-6 fw-semibold mb-2 required">Jawatan & Gred</label>
                    <select name="jawatan" id="jawatan" class="form-select form-select-solid custom-select">
                        <option value="">Pilih</option>
                        @foreach ($jawatan as $j)
                            <option value="{{ $j->id }}" {{$permohonan_pegawai->jawatan == $j->id  ? 'selected' : ''}}>{{ $j->jawatan_gred }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">Peranan</label>
                    <select name="peranan_pengguna" id="peranan_pengguna" class="form-select form-select-solid custom-select" onchange="toggleFields()">
                        @foreach ($tahap as $tahap1)
                            <option value="{{$tahap1->id}}" {{$permohonan_pegawai->peranan == $tahap1->id  ? 'selected' : ''}}>{{$tahap1->peranan}}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5" id="permohonan_pegawai_negeri_field" style="display: {{ $permohonan_pegawai->negeri_bertugas != null ? 'block' : 'none' }}">
                    <label class="fs-6 fw-semibold mb-2 required">Negeri Bertugas</label>
                    <select name="negeri_bertugas" id="negeri_bertugas" class="form-select form-select-solid custom-select" onchange="filterDaerahOptions()">
                        <option value="">Pilih Negeri Bertugas</option>
                        @foreach ($negeri as $item1)
                            <option value="{{ $item1->negeri_id }}" {{ $permohonan_pegawai->negeri_bertugas == $item1->negeri_id ? 'selected' : '' }}>
                                {{ $item1->negeri }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5" id="permohonan_pegawai_daerah_field" style="display: {{ $permohonan_pegawai->daerah_bertugas != null ? 'block' : 'none' }}">
                    <label class="fs-6 fw-semibold mb-2 required">Daerah Bertugas</label>
                    <select name="daerah_bertugas" id="daerah_bertugas" class="form-select form-select-solid custom-select">
                        <option value="">Pilih Daerah Bertugas</option>
                        @foreach ($daerah as $item2)
                            <option value="{{ $item2->kod }}" data-negeri-id="{{ $item2->negeri_id }}" {{ $permohonan_pegawai->daerah_bertugas == $item2->kod ? 'selected' : '' }}>
                                {{ $item2->daerah }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Scroll-->

            <!--begin::Actions-->
            <div class="text-center pt-5">
                <button type="submit" name="status" value="Lulus" class="btn btn-success me-3" onclick="return validateEmailDomain()">Diluluskan</button>
                <button type="button" class="btn btn-danger" data-id="{{ $permohonan_pegawai->id }}" id="permohonanPegawaiDitolakModal" data-bs-toggle="modal" data-bs-target="#modal_permohonan_ditolak" onclick="checkEmailAndOpenModal(event)">Ditolak</button>
            </div>
            <!--end::Actions-->
        </form>

        {{-- Form vaidation for Permohonan Pegawai --}}
        <script>
            document.getElementById('modal_permohonan_pegawai_form').addEventListener('submit', function (event) {
                // Get form elements
                const name = document.getElementById('nama').value.trim();
                const no_kp = document.getElementById('no_kp_pegawai_mohon').value.trim();
                const email = document.getElementById('emelPegawai').value.trim();
                const no_tel = document.getElementById('no_tel_pegawai_mohon').value.trim();
                const jawatan = document.getElementById('jawatan').value;
                const peranan_pegawai = document.getElementById('peranan_pengguna').value;
                const negeri_bertugas = document.getElementById('negeri_bertugas').value;
                const daerah_bertugas = document.getElementById('daerah_bertugas').value;
            
                // Initialize error message
                let errorMessage = '';
            
                // Common required field check
                if (!name || !no_kp || !email || !no_tel || !jawatan || !peranan_pegawai) {
                    errorMessage = 'Sila isi semua medan yang bertanda *.';
                } else {
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
                    alert(errorMessage);     // Display the error message to the user (or use another method to show it on the form)
                }
            });
        </script>            

        {{-- Control input nama, no_tel, no_kp --}}
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

        {{-- Validate emelPegawai --}}
        <script>
            function validateEmailDomain() {
                const emailInput = document.getElementById('emelPegawai').value;
                
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

            function checkEmailAndOpenModal(event) {
                const emailInput = document.getElementById('emelPegawai').value;

                // Check if email is empty
                if (emailInput.trim() === '') {
                    alert('Sila masukkan emel.');
                    return; // Stay on the form
                }

                // Check if email contains '@'
                if (emailInput.includes('@')) {
                    alert('Sila masukkan nama e-mel pengguna sahaja tanpa domain.');
                    return false; // Prevent form submission
                }

                // If the email is valid, open the rejection modal
                const modal = new bootstrap.Modal(document.getElementById('permohonanPegawaiDitolakModal'));
                modal.show();
            }
        </script>

        {{-- Display field tempat bertugas based on peranan --}}
        <script>
            // Define toggleFields globally so it's accessible from inline onchange
            function toggleFields() {
                const tahapPengguna = document.getElementById('peranan_pengguna').value;
                const negeriField = document.getElementById('permohonan_pegawai_negeri_field');
                const daerahField = document.getElementById('permohonan_pegawai_daerah_field');
                
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
    </body>
</html>

