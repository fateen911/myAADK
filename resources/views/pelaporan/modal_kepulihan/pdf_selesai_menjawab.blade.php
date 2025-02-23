<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Analisis Modal Kepulihan</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .tittle { background-color: #666; color: white; padding: 10px; text-align: center; font-size: 18px; font-weight: bold; }
            .table { width: 100%; margin-top: 10px; }
            .table th, .table td { border: 1px solid black; padding: 8px; }
            .table th { background-color: #2d2d5d !important; text-align: center; color: white;}

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
                z-index: -1; /* Place behind content */
            }
        </style>
    </head>

    <body>
        <div class="header">
            <img src="{{ public_path('logo/mySupport.png') }}" alt="Logo AADK" style="width: 12%; height: 8%;">
            <h3>AGENSI ANTIDADAH KEBANGSAAN (AADK)</h3>
        </div>

        <div class="tittle">SENARAI KLIEN SELESAI MENJAWAB SOAL SELIDIK MODAL KEPULIHAN</div>
        
        <table class="table table-striped table-hover dataTable js-exportable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. Kad Pengenalan</th>
                    <th>AADK Daerah</th>
                    <th>AADK Negeri</th>
                    <th>Tarikh Terakhir Menjawab</th>
                    <th>Tahap Kepulihan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($query as $klien)
                    <tr>
                        <td>{{ $klien->nama }}</td>
                        <td>{{ $klien->no_kp }}</td>
                        <td>{{ $klien->daerah_pejabat }}</td>
                        <td>{{ $klien->negeri_pejabat }}</td>
                        <td>{{ \Carbon\Carbon::parse($klien->updated_at)->format('d/m/Y') }}</td>
                        <td>{{ $klien->tahap_kepulihan_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
