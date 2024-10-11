<!DOCTYPE html>
<html>
    <body>
        <!--begin::Modal - Kemaskini Pegawai-->
        <form class="form" id="modal_kemaskini_klien_form" action="{{ route('pentadbir-kemaskini-klien') }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $klien->id }}">
            <div class="scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                @php
                    $status_ak_1 = DB::table('users')->where('no_kp', $klien->no_kp)->value('acc_status');
                @endphp
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">Status Akaun</label>
                    <select id="statusAk2" class="form-select form-select-solid custom-select" name="status_ak" required>
                        <option value="AKTIF" {{ $status_ak_1 == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                        <option value="DIBEKUKAN" {{ $status_ak_1 == 'DIBEKUKAN' ? 'selected' : '' }}>DIBEKUKAN</option>
                    </select>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="fs-6 fw-semibold mb-2 required">Nama Penuh</label>
                    <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{$klien->nama}}" readonly/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="fs-6 fw-semibold mb-2 required">No. Kad Pengenalan
                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan no kad pengenalan tanpa '-'.">
                            <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </label>
                    <input type="text" class="form-control form-control-solid" name="no_kp" value="{{$klien->no_kp}}" readonly/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="fs-6 fw-semibold mb-2">No. Telefon
                        <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan nombor telefon tidak termasuk simbol '-' dan tidak melebihi 11 aksara.">
                            <i class="ki-duotone ki-information-2 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </label>
                    <input type="text" class="form-control form-control-solid custom-form" id="no_tel_klien" name="no_tel" value="{{$klien->no_tel}}" inputmode="numeric" maxlength="11"/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="fs-6 fw-semibold mb-2">E-mel</label>
                    <input type="email" class="form-control form-control-solid custom-form" placeholder="" name="email" value="{{$klien->emel}}" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-5">
                    <label class="fs-6 fw-semibold mb-2">Kata Laluan Baharu</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-solid custom-form" id="passwordKlien{{$klien->id}}" name="passwordKemaskini" />
                        <button type="button" class="btn btn-secondary" onclick="generatePasswordKlien('passwordKlien{{$klien->id}}')">Jana Kata Laluan</button>
                    </div>
                </div>
                <!--end::Input group-->
            </div>

            <!--begin::Actions-->
            <div class="text-center pt-15">
                <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>

                <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                    <span class="indicator-label">Simpan</span>
                    <span class="indicator-progress">Sila tunggu...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Modal -  Kemaskini Pegawai-->
    </body>
</html>

<!--generate table-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

