<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/assets/plugins/custom/datatables/datatables.bundle.css')">
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/css/style.bundle.css">
    <link rel="stylesheet" href="/assets/css/customAADK.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="{{url('/pengurusan_program/hebahan/'.$program->id)}}">
    @csrf
    <div class="h-500px">
        <p class="text-uppercase">NAMA PROGRAM: {{$program->nama}}</p>
        <p>DAERAH: PETALING JAYA</p>
        <br>
        <p>Sila pilih klien untuk hebahan program:</p>

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
            </div>
        </div>

        <!--end::Table-->
    </div>

    <div class="modal-footer">
        <button type="submit" name="kaedah" value="sms" class="btn btn-icon btn-warning mx-2 btn-sm" id="share-button"><i class="bi bi-chat-dots-fill fs-3  text-white"></i></button>
        <button type="submit" name="kaedah" value="emel" class="btn btn-icon btn-danger btn mx-2 btn-sm" id="share-button"><i class="bi bi-envelope-fill fs-3  text-white"></i></button>
        <button type="submit" name="kaedah" value="telegram" class="btn btn-icon btn-primary mx-2 btn-sm" id="share-button"><i class="bi bi-telegram fs-3 text-white"></i></button>
    </div>

</form>
</body>
</html>


