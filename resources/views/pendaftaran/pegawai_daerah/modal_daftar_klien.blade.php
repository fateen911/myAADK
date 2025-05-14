<!DOCTYPE html>
<html>
    <body>
        <!--begin::Modal - Daftar Klien -->
        <form class="form" id="modal_daftar_klien_form" action="{{ route('pegawai-daerah.daftar.klien') }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $klien->mykad }}">
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
                    <input type="text" class="form-control form-control-solid" name="no_kp" value="{{ $klien->mykad }}" readonly/>
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
                    <input type="text" class="form-control form-control-solid custom-form" name="no_tel" placeholder="Contoh: 0109000000" value="{{$klien->no_tel}}" oninput="validateNoTel(this)" inputmode="numeric"/>
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
            function validateNoTel(input) {
                // Remove all non-numeric characters
                input.value = input.value.replace(/\D/g, '');

                // Limit the input length to 11 characters
                if (input.value.length > 11) {
                    input.value = input.value.slice(0, 11);
                }
            }
        </script>
    </body>
</html>



