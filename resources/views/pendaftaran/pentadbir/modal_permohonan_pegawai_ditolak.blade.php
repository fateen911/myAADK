<!DOCTYPE html>
<html>
    <body>
        <form id="rejection_form_{{$permohonan_pegawai->id}}" action="{{ route('permohonan-pegawai-ditolak', ['id' => $permohonan_pegawai->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="status" value="Ditolak">
            <input type="hidden" name="id" value="{{ $permohonan_pegawai->id }}">

            <!-- Begin Rejection Reasons Input -->
            <div id="dynamicFields">
                <label class="fs-6 fw-semibold mb-2">Nyatakan alasan permohonan ditolak :</label>
                <div class="input-group mb-2 catatan-row">
                    <textarea class="form-control form-control-solid custom-form" name="alasan_ditolak" placeholder="Contoh: Sila isi nama seperti kad pengenalan, Peranan tidak benar"></textarea>
                </div>
            </div>
            <!-- End Rejection Reasons Input -->

            <!-- Form actions -->
            <div class="text-center pt-3">
                <button type="submit" class="btn btn-primary">Hantar</button>
            </div>
        </form>
    </body>
</html>

<!--generate table-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

