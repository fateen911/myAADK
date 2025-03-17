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
        .table tr {
            page-break-inside: avoid !important; /* Prevent breaking rows */
        }
        .table td, .table th {
            page-break-inside: avoid !important;
            page-break-before: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .page-break {
            page-break-before: always;
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
                @php
                    $daerah = DB::table('senarai_daerah_pejabat')->where('kod', $klien->daerah_pejabat)->value('daerah');
                    $negeri = DB::table('senarai_negeri_pejabat')->where('negeri_id', $klien->negeri_pejabat)->value('negeri');
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}.</td>
                    <td>{{ $klien->nama }}</td>
                    <td style="text-align: center;">{{ $klien->no_kp }}</td>
                    <td style="text-align: center;">{{ $daerah ?? '-' }}</td>
                    <td style="text-align: center;">{{ $negeri ?? '-' }}</td>
                </tr>

                @if(($index + 1) % 30 == 0)  <!-- Insert a page break every 30 rows -->
                    <tr class="page-break"></tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
