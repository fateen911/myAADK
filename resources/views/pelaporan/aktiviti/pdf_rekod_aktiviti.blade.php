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
    .table-custom{
        border: 0 solid transparent !important;
    }

    .table-custom tr td{
        border: 0 solid transparent !important;
    }
</style>
<body>
<div class="m-5">
    <br>
    <div class="my-3 text-center">
        <table class="mx-auto table-custom">
            <tr>
                <td class="text-center"><img src="{{ public_path('logo/mySupport.png') }}" alt="Logo AADK" style="width: 100px; height: auto;"></td>
            </tr>
            <tr>
                <td class="text-center p-0"><p class="mt-5 fs-30"><b>AGENSI ANTIDADAH KEBANGSAAN (AADK)</b></p></td>
            </tr>
            <tr>
                <td class="text-center p-0"><p class="fs-25"><b>REKOD AKTIVITI</b></p></td>
            </tr>
        </table>
    </div>

    <hr class="border-0 h-1px bg-black mb-10">

    <table class="table table-row-dashed fs-6 gy-5 my-0" id="aktivitiTable">
        <thead>
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th class="min-w-20px uppercase">Bil.</th>
            <th class="min-w-100px uppercase">Nama</th>
            <th class="min-w-100px uppercase">ID</th>
            <th class="min-w-100px uppercase">Kategori</th>
            <th class="min-w-100px uppercase">Tempat</th>
            <th class="min-w-60px uppercase">Negeri Bertugas</th>
            <th class="min-w-60px uppercase">Daerah Bertugas</th>
            <th class="min-w-100px uppercase">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td class="text-uppercase text-center">{{ $loop->iteration }}</td>
                <td class="text-uppercase"> {{$item['nama']}} </td>
                <td class="text-uppercase"> {{$item['custom_id']}} </td>
                <td class="text-uppercase"> {{$item['kategori']}} </td>
                <td class="text-uppercase"> {{$item['tempat']}} </td>
                <td class="text-uppercase"> {{$item['negeri']}} </td>
                <td class="text-uppercase"> {{$item['daerah']}} </td>
                <td class="text-uppercase"> {{$item['status']}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
