<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/assets/plugins/custom/datatables/datatables.bundle.css">
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/css/style.bundle.css">
    <link rel="stylesheet" href="/assets/css/customAADK.css">
</head>
<body>
<form method="post" action="{{url('/pengurusan-program/hebahan/jenis-hebahan/'.$program->id)}}">
    @csrf
    <div class="h-500px">
        <b class="text-uppercase fw-medium">NAMA PROGRAM: {{$program->nama}}</b> <br>
        <b class="text-uppercase fw-medium">TARIKH/MASA MULA: {{date('d/m/Y, h:iA', strtotime($program->tarikh_mula))}}</b><br>
        <b class="text-uppercase fw-medium">TARIKH/MASA TAMAT: {{date('d/m/Y, h:iA', strtotime($program->tarikh_tamat))}}</b><br>
        <b class="text-uppercase fw-medium">TEMPAT: {{$program->tempat}}</b><br>
        <br>
        <hr>
        <p>Sila pilih klien untuk hebahan program:</p>

        <div class="d-flex flex-row">

            <div class="d-flex flex-column flex-row-fluid mb-5">
                <div class="d-flex flex-row flex-column-fluid gap-5">
                    <div class="d-flex flex-row-auto w-40 flex-center">

                        <input type="hidden" name="negeri" id="negeri" value="{{$negeri}}">

                        <select id="daerah" class="form-select" name="daerah">
                            <!--AJAX-->
                        </select>
                    </div>

                    <div class="d-flex flex-row-auto w-10 flex-center">
                        <button class="btn btn-primary btn-icon" type="button" id="filterBtn"><i class="bi bi-funnel-fill fs-2"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::Table-->
        <div class="container">
            <div class="mh-sm-350px overflow-y-auto">
                <table class="table" id="modalHebahan">
                    <thead>
                    <tr class="text-center text-gray-400 fw-bold fs-7 gs-0 text-uppercase">
                        <th class="min-w-50px">
                            <input type="checkbox" id="selectAll" onclick="toggleAll(this)">
                        </th>
                        <th class="min-w-250px">Nama</th>
                        <th class="min-w-125px">No. Telefon</th>
                        <th class="min-w-200px">Email</th>
                    </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">

                    </tbody>
                </table>
            </div>
        </div>

        <!--end::Table-->
    </div>

    <div class="modal-footer">
        <button type="submit" name="kaedah" value="emel" class="btn btn-icon btn-danger btn mx-2 btn-sm" id="share-button"><i class="bi bi-envelope-fill fs-3  text-white"></i></button>
    </div>

</form>
</body>
</html>
<!--generate table-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function(){
        var negeriId = $('#negeri').val();
        fetchItems();
        function fetchItems() {
            $.ajax({
                url: '/klien-negeri/' + negeriId,
                method: 'GET',
                success: function(response) {
                    let rows = '';
                    $.each(response, function(index, klien) {
                        let emel = klien.emel ? klien.emel : 'TIADA';  // Handle null
                        let no_tel = klien.no_tel ? klien.no_tel : 'TIADA';  // Handle null

                        rows += '<tr>';
                        rows += '<td class="text-center"><input type="checkbox" name="pilihan[]" value="' + klien.id + '" multiple></td>';
                        rows += '<td class="text-uppercase">' + klien.nama + '</td>';
                        rows += '<td class="text-uppercase">' + no_tel + '</td>';
                        rows += '<td>' + emel + '</td>';
                        rows += '</tr>';
                    });
                    $('#modalHebahan tbody').html(rows);
                }
            });
        }
    });
</script>

<!--filter-->
<script>
    $(document).ready(function(){
        var negeriId = $('#negeri').val();
        fetchItems();
        function fetchItems() {
            $.ajax({
                url: '/daerah/' + negeriId,
                method: 'GET',
                success: function(response) {
                    let rows = '<option value="">Pilih Daerah</option>';
                    $.each(response, function(index, daerah) {
                        rows += '<option value="' + daerah.kod + '">' + daerah.daerah + '</option>';
                    });
                    $('#daerah').html(rows);
                }
            });
        }
    });
</script>

<!--filter result-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '#filterBtn', function() {
        $.ajax({
            url: '/pengurusan-program/hebahan/filter-hebahan',
            type: 'GET',
            data: {
                negeri: $('#negeri').val(),
                daerah: $('#daerah').val()
            },
            success: function(response) {
                let rows = '';
                $.each(response, function(index, filter) {
                    let emel = filter.emel ? filter.emel : 'TIADA';  // Handle null
                    let no_tel = filter.no_tel ? filter.no_tel : 'TIADA';  // Handle null

                    rows += '<tr>';
                    rows += '<td class="text-center"><input type="checkbox" name="pilihan[]" value="' + filter.id + '"></td>';
                    rows += '<td class="text-uppercase">' + filter.nama + '</td>';
                    rows += '<td class="text-uppercase">' + no_tel + '</td>';
                    rows += '<td>' + emel + '</td>';
                    rows += '</tr>';
                });
                $('#modalHebahan tbody').html(rows);
            }
        });
    });
</script>

