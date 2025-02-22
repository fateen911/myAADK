<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Analisis Modal Kepulihan</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .tittle { background-color: #666; color: white; padding: 10px; text-align: center; font-size: 18px; font-weight: bold; }
            .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            .table th, .table td { border: 1px solid black; padding: 8px; text-align: center; }
            .table th { background-color: #f2f2f2; }
            .highlight { font-size: 14px; font-style: italic; color: red;}

            .header {
                text-align: center;
                margin-bottom: 10px;
            }

            .header img {
                width: 100px;
                height: auto;
            }

            .header h2 {
                margin: 0;
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
            <img src="{{ public_path('logo/mySupport.png') }}" alt="Logo AADK" style="width: 10%; height: 12%;">
            <h3>AGENSI ANTIDADAH KEBANGSAAN (AADK)</h3>
        </div>

        <div class="tittle">ANALISIS MODAL KEPULIHAN</div>

        <br>
        <div style="display: flex; justify-content: space-between;">
            <span><strong>JUMLAH KLIEN MENJAWAB 6 BULAN TERKINI:</strong> {{ $totalClients }} ORANG</span>
            <span><strong style="padding-left: 400px;">TARIKH:</strong> {{ date('d/m/Y') }}</span>
        </div>
        <br>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Tahap Kepulihan</th>
                    <th>Modal Fizikal</th>
                    <th>Modal Psikologi</th>
                    <th>Modal Sosial</th>
                    <th>Modal Persekitaran</th>
                    <th>Modal Insaniah</th>
                    <th>Modal Spiritual</th>
                    <th>Modal Rawatan</th>
                    <th>Modal Kesihatan</th>
                    <th>Modal Strategi Daya Tahan</th>
                    <th>Modal Resiliensi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($counts as $category => $values)
                    <tr>
                        <td>{{ $category }}</td>
                        @foreach ($values as $count)
                            <td>{{ $count }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="highlight">**Jumlah klien bagi setiap modal adalah {{ $totalClients }} orang</p>
    </body>
</html>
