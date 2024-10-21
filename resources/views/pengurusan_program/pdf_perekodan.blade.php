<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ public_path('/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ public_path('/assets/css/customAADK.css') }}">
</head>
<style>
    body::before {
        content: "";
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('logo/mySupport-bw.png');
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        opacity: 0.1;
        z-index: -1; /* Place behind content */
    }
    body {
        font-family: 'Arial', sans-serif !important;
    }
</style>
<body>
    <div class="m-5">
        <div class="my-3 text-center">
            <table class="mx-auto">
                <tr>
                    <td class="text-center border-transparent"><img src="{{ public_path('logo/mySupport.png') }}" alt="Logo AADK" style="width: 100px; height: auto;"></td>
                </tr>
                <tr>
                    <td class="text-center border-transparent p-0"><p class="fs-30 mt-5"><b>AGENSI ANTIDADAH KEBANGSAAN (AADK)</b></p></td>
                </tr>
                <tr>
                    <td class="text-center border-transparent p-0"><p class="fs-25"><b>SENARAI KEHADIRAN KLIEN</b></p></td>
                </tr>
            </table>
        </div>

        <hr class="border-0 h-1px bg-black mt-10 mb-8">

        <div class="d-table w-100">
            <div class="d-table-row">
                <div class="d-table-cell text-left w-50">
                    <p class="text-uppercase">Nama Aktiviti: {{$program->nama}}</p>
                </div>
                <div class="d-table-cell text-right w-50">
                    <p class="text-uppercase">Tarikh/Masa Mula: {{date('d/m/Y, h:iA', strtotime($program->tarikh_mula))}}</p>
                </div>
            </div>
        </div>

        <div class="d-table w-100">
            <div class="d-table-row">
                <div class="d-table-cell text-left w-50">
                    <p class="text-uppercase">Tempat: {{$program->tempat}}</p>
                </div>
                <div class="d-table-cell text-right w-50">
                    <p class="text-uppercase">Tarikh/Masa Tamat: {{date('d/m/Y, h:iA', strtotime($program->tarikh_tamat))}}</p>
                </div>
            </div>
        </div>

        <hr class="border-0 h-1px bg-black mb-10">

        <table class="table table-row-dashed fs-6 gy-5 my-0">
            <thead>
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                <th class="min-w-20px uppercase">Bil.</th>
                <th class="min-w-125px">Nama</th>
                <th class="min-w-175px">No. Kad Pengenalan</th>
                <th class="min-w-175px">Tarikh/Masa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($perekodan as $item)
                <tr>
                    <td class="text-uppercase text-center">{{ $loop->iteration }}</td>
                    <td class="text-uppercase"> {{$item->klien->nama}} </td>
                    <td class="text-uppercase"> {{$item->klien->no_kp}} </td>
                    <td> {{date('d/m/Y H:i:s', strtotime($item->tarikh_perekodan))}} </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
