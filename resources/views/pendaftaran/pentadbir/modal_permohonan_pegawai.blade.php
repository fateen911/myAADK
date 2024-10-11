<!DOCTYPE html>
<html>
    <body>
        <form class="form" id="modal_permohonan_pegawai_form" action="{{ route('kelulusan-permohonan-pegawai', ['id' => $permohonan_pegawai->id]) }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $permohonan_pegawai->id }}">
            <div class="scroll-y me-n7 pe-7" id="modal_permohonan_pegawai_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_permohonan_pegawai_header" data-kt-scroll-wrappers="#modal_permohonan_pegawai_scroll" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2 required">Nama Penuh</label>
                    <input type="text" class="form-control form-control-solid custom-form" name="nama" id="nama" value="{{$permohonan_pegawai->nama}}" style="text-transform: uppercase;" required/>
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
                    <input type="text" class="form-control form-control-solid custom-form" id="no_kp_pegawai_mohon" name="no_kp" value="{{$permohonan_pegawai->no_kp}}" inputmode="numeric" maxlength="12" required/>
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
                    <input type="text" class="form-control form-control-solid custom-form" id="no_tel_pegawai_mohon" name="no_tel" value="{{$permohonan_pegawai->no_tel}}" inputmode="numeric" maxlength="11" required/>
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
                    <select name="peranan_pengguna" id="peranan_pengguna" class="form-select form-select-solid custom-select" data-placeholder="Pilih">
                        @foreach ($tahap as $tahap1)
                            <option value="{{$tahap1->id}}" {{$permohonan_pegawai->peranan == $tahap1->id  ? 'selected' : ''}}>{{$tahap1->peranan}}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                @if ($permohonan_pegawai->negeri_bertugas != null)
                    <div class="fv-row mb-5">
                        <label class="fs-6 fw-semibold mb-2 required">Negeri Bertugas</label>
                        <select name="negeri_bertugas" id="negeri_bertugas" class="form-select form-select-solid custom-select">
                            <option value="">Pilih Negeri Bertugas</option>
                            @foreach ($negeri as $item1)
                                <option value="{{ $item1->negeri_id}}" {{$permohonan_pegawai->negeri_bertugas == $item1->negeri_id  ? 'selected' : ''}}>{{$item1->negeri}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <!--end::Input group-->
                <!--begin::Input group-->
                @if ($permohonan_pegawai->daerah_bertugas != null)
                    <div class="fv-row mb-5">
                        <label class="fs-6 fw-semibold mb-2 required">Daerah Bertugas</label>
                        <select name="daerah_bertugas" id="daerah_bertugas" class="form-select form-select-solid custom-select">
                            <option value="">Pilih Daerah Bertugas</option>
                            @foreach ($daerah as $item2)
                                <option value="{{ $item2->kod }}" {{$permohonan_pegawai->daerah_bertugas == $item2->kod  ? 'selected' : ''}}>{{ $item2->daerah }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <!--end::Input group-->
            </div>
            <!--end::Scroll-->

            <!--begin::Actions-->
            <div class="text-center pt-5">
                <button type="submit" name="status" value="Lulus" class="btn btn-success me-3">Diluluskan</button>
                <button type="button" class="btn btn-danger" data-id="{{ $permohonan_pegawai->id }}" id="permohonanPegawaiDitolakModal" data-bs-toggle="modal" data-bs-target="#modal_permohonan_ditolak">Ditolak</button>
            </div>
            <!--end::Actions-->
        </form>
    </body>
</html>

<!--generate table-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

