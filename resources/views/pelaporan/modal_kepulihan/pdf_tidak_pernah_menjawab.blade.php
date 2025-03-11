<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Tidak Pernah Menjawab</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .tittle { background-color: #666; color: white; padding: 10px; text-align: center; font-size: 16px; font-weight: bold; }
        .table { 
            width: 100%; 
            margin-top: 10px; 
            border-collapse: collapse; /* Ensures single-line borders */
            font-size: 11px;
        }
        .table th, .table td { 
            border: 1px solid black; 
            padding: 8px; 
        }
        .table th { background-color: #2d2d5d !important; color: white; }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 100px;
            height: auto;
        }

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
            opacity: 0.2;
            z-index: -1;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('logo/mySupport.png') }}" alt="Logo AADK" style="width: 12%; height: 8%;">
        <h3>AGENSI ANTIDADAH KEBANGSAAN (AADK)</h3>
    </div>

    <div class="tittle">SENARAI KLIEN TIDAK PERNAH MENJAWAB SOAL SELIDIK MODAL KEPULIHAN</div>

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
            @foreach($filteredData as $klien)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}.</td>
                    <td>{{ $klien['nama'] }}</td>
                    <td style="text-align: center;">{{ $klien['no_kp'] }}</td>
                    <td style="text-align: center;">{{ $klien['negeri'] }}</td>
                    <td style="text-align: center;">{{ $klien['daerah'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
