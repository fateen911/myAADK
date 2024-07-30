<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ public_path('/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/customAADK.css') }}">
</head>
<body>
<form method="post" action="{{url('/pengurusan_program/hebahan/'.$program->id)}}">
    @csrf
    <div class="modal-body h-500px">
        <p>NAMA PROGRAM: PROGRAM PEMULIHAN BERSEPADU</p>
        <p>DAERAH: PETALING JAYA</p>
        <br>
        <p>Sila pilih klien untuk hebahan program:</p>

        <!--begin::Table-->

        <table id="modalHebahan">
            <thead>
            <tr class="text-center text-gray-400 fw-bold fs-7 gs-0 text-uppercase">
                <th class="min-w-50px">
                    <input type="checkbox" id="selectAll" onclick="toggleAll(this)">
                </th>
                <th class="min-w-300px">Nama</th>
                <th class="min-w-150px">No. Telefon</th>
                <th class="min-w-250px">Email</th>
            </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
            <tr>
                <td class="text-center"><input type="checkbox" name="pilihan[]" value="1"></td>
                <td>Ahmad bin Ali</td>
                <td>012-3456789</td>
                <td>ahmad.ali@example.com</td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox" name="pilihan[]" value="2"></td>
                <td>Siti Nurhaliza binti Abdul Razak</td>
                <td>013-9876543</td>
                <td>siti.nurhaliza@example.com</td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox" name="pilihan[]" value="3"></td>
                <td>Muhammad Faizal bin Ismail</td>
                <td>014-2233445</td>
                <td>faizal.ismail@example.com</td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox" name="pilihan[]" value="4"></td>
                <td>Nurul Aisyah binti Zulkifli</td>
                <td>015-6677889</td>
                <td>nurul.aisyah@example.com</td>
            </tr>
            <tr>
                <td class="text-center"><input type="checkbox" name="pilihan[]" value="5"></td>
                <td>Hafiz bin Ahmad</td>
                <td>016-1122334</td>
                <td>hafiz.ahmad@example.com</td>
            </tr>
            </tbody>
        </table>

        <!--end::Table-->
    </div>

    <div class="modal-footer">
        <button type="submit" name="kaedah" value="sms" class="btn btn-icon btn-warning mx-2 btn-sm" id="share-button"><i class="bi bi-chat-dots-fill fs-3"></i></button>
        <button type="submit" name="kaedah" value="emel" class="btn btn-icon btn-danger mx-2 btn-sm" id="share-button"><i class="bi bi-envelope-fill fs-3"></i></button>
        <button type="submit" name="kaedah" value="telegram" class="btn btn-icon btn-primary mx-2 btn-sm" id="share-button"><i class="bi bi-telegram fs-3"></i></button>
    </div>

</form>
</body>
</html>


