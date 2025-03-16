<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Tidak Pernah Menjawab</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        .title { 
            background-color: #666; 
            color: white; 
            padding: 10px; 
            text-align: center; 
            font-size: 16px; 
            font-weight: bold; 
        }
        .table { 
            width: 100%; 
            margin-top: 10px; 
            border-collapse: collapse; /* Ensures single-line borders */
            font-size: 11px;
            page-break-inside: auto; /* Ensure the table does not break */
        }
        .table th, .table td { 
            border: 1px solid black; 
            padding: 8px; 
        }
        .table th { 
            background-color: #2d2d5d !important; 
            color: white; 
        }
        /* Prevent row break */
        tr { 
            page-break-inside: avoid; 
            page-break-after: auto; 
        }
        /* Ensure headers repeat on each page */
        thead { 
            display: table-header-group; 
        }
        tfoot { 
            display: table-row-group; 
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        /* Fix PDF Background Image */
        .watermark {
            position: fixed;
            top: 30%;
            left: 10%;
            width: 80%;
            opacity: 0.2;
            z-index: -1;
        }
    </style>
</head>

<body>
    <!-- Fix Logo Not Appearing -->
    <div class="header">
        <img src="{{ public_path('logo/mySupport.png') }}" alt="Logo AADK" style="width: 12%; height: auto;">
        <h3>AGENSI ANTIDADAH KEBANGSAAN (AADK)</h3>
    </div>

    <div class="title">SENARAI KLIEN TIDAK PERNAH MENJAWAB SOAL SELIDIK MODAL KEPULIHAN</div>

    @php
        $daerahList = DB::table('senarai_daerah_pejabat')->pluck('daerah', 'kod');
        $negeriList = DB::table('senarai_negeri_pejabat')->pluck('negeri', 'negeri_id');
    @endphp

    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%">NO.</th>
                <th style="width: 35%">NAMA</th>
                <th style="width: 15%">NO. KAD PENGENALAN</th>
                <th style="width: 20%;">AADK NEGERI</th>
                <th style="width: 25%;">AADK DAERAH</th>
            </tr>
        </thead>
        <tbody>
            @foreach($filteredData as $index => $klien)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}.</td>
                    <td>{{ $klien->nama }}</td>
                    <td style="text-align: center;">{{ $klien->no_kp }}</td>
                    <td style="text-align: center;">{{ $negeriList[$klien->negeri_pejabat] ?? '-' }}</td>
                    <td style="text-align: center;">{{ $daerahList[$klien->daerah_pejabat] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Background Image Watermark -->
    <img src="{{ public_path('logo/mySupport-bw.png') }}" class="watermark">

</body>
</html>
