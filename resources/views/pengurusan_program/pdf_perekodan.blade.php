<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ public_path('/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/customAADK.css') }}">
</head>
<body>
    <div class="m-5">
        <br><h2 class="my-3 text-center text-uppercase">Senarai Klien Yang Hadir</h2>

        <hr class="border-0 h-1px bg-black mt-10 mb-8">

        <div class="d-table w-100">
            <div class="d-table-row">
                <div class="d-table-cell text-left w-50">
                    <p class="text-uppercase">Nama Program: {{$program->nama}}</p>
                </div>
                <div class="d-table-cell text-right w-50">
                    <p class="text-uppercase">Tarikh/Masa Mula: {{date('d/m/Y, gA', strtotime($program->tarikh_mula))}}</p>
                </div>
            </div>
        </div>

        <div class="d-table w-100">
            <div class="d-table-row">
                <div class="d-table-cell text-left w-50">
                    <p class="text-uppercase">Tempat: {{$program->tempat}}</p>
                </div>
                <div class="d-table-cell text-right w-50">
                    <p class="text-uppercase">Tarikh/Masa Tamat: {{date('d/m/Y, gA', strtotime($program->tarikh_tamat))}}</p>
                </div>
            </div>
        </div>

        <hr class="border-0 h-1px bg-black mb-10">

        <table class="table table-row-dashed fs-6 gy-5 my-0">
            <thead>
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                <th class="min-w-125px">Nama</th>
                <th class="min-w-175px">No. Kad Pengenalan</th>
                <th class="min-w-175px">Tarikh/Masa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($perekodan as $item)
                <tr>';
                    <td class="text-uppercase"> {{$item->klien->nama}} </td>
                    <td class="text-uppercase"> {{$item->klien->no_kp}} </td>
                    <td> {{date('d/m/Y H:i:s', strtotime($item->tarikh_perekodan))}} </td>
                </tr>';
            @endforeach
        </table>
    </div>
</body>
</html>
