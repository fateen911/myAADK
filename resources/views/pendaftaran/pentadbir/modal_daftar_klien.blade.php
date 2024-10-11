<!DOCTYPE html>
<html>
    <body>
        <!--begin::Modal - Daftar Klien -->
        <form class="form" id="modal_daftar_klien_form" action="{{ route('pentadbir-daftar-klien') }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $klien->id }}">
            <div class="scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold mb-2 required">Nama Penuh</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" name="name" value="{{$klien->nama}}" readonly/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold mb-2 required">No. Kad Pengenalan</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid" name="no_kp" value="{{$klien->no_kp}}" readonly/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold mb-2">No. Telefon
                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                            <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-solid custom-form" name="no_tel" placeholder="Contoh: 0109000000" value="{{$klien->no_tel}}" inputmode="numeric"/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold mb-2">E-mel</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="email" class="form-control form-control-solid custom-form" name="email" placeholder="Contoh: contoh1@gmail.com" value="{{$klien->emel}}" />
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold mb-2 required">Kata Laluan Baharu</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <div class="input-group">
                        <input type="text" class="form-control form-control-solid custom-form" id="passwordDaftarKlien{{$klien->id}}" name="passwordDaftar" />
                        <button type="button" class="btn btn-secondary" onclick="generatePasswordDaftarKlien('passwordDaftarKlien{{$klien->id}}')">Jana Kata Laluan</button>
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
            </div>

            <!--begin::Actions-->
            <div class="text-center">
                <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>

                <button type="submit" id="daftarBtn" class="btn btn-primary">
                    <span class="indicator-label">Daftar</span>
                    <span class="indicator-progress">Sila tunggu...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Modal -  Daftar Klien -->

        <!--generate table-->
        <script src="/assets/plugins/global/plugins.bundle.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        {{-- Control input type --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Control input for 'no_kp' (Kad Pengenalan)
                document.querySelectorAll('[name="no_kp"]').forEach(function(input) {
                    input.addEventListener('input', function() {
                        this.value = this.value.replace(/\D/g, ''); // Allow only digits
                        if (this.value.length > 12) {
                            this.value = this.value.slice(0, 12); // Limit to 12 digits
                        }
                    });
                });
    
                // Control input for 'no_tel' (No. Telefon)
                document.querySelectorAll('[name="no_tel"]').forEach(function(input) {
                    input.addEventListener('input', function() {
                        this.value = this.value.replace(/\D/g, ''); // Allow only digits
                        if (this.value.length > 11) {
                            this.value = this.value.slice(0, 11); // Limit to 11 digits
                        }
                    });
                });
    
                // Validate form submission
                document.getElementById('modal_daftar_klien_form').addEventListener('submit', function(e) {
                    const noKp = document.querySelector('[name="no_kp"]').value;
                    const noTel = document.querySelector('[name="no_tel"]').value;
    
                    if (noKp.length !== 12) {
                        alert('No. Kad Pengenalan mesti mempunyai 12 digit.');
                        e.preventDefault();  // Stop form submission if invalid
                    }
    
                    if (noTel.length < 10 || noTel.length > 11) {
                        alert('Bilangan digit nombor telefon mesti antara 10 hingga 11 digit.');
                        e.preventDefault();  // Stop form submission if invalid
                    }
                });
            });
        </script>
    </body>
</html>



