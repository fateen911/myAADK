<table>
    <thead>
        <!-- Title Row -->
        <tr>
            <th colspan="{{ count($modalKepulihan) + 1 }}" style="color: black; text-align: center; font-size: 16px; font-weight: bold;">
                ANALISIS MODAL KEPULIHAN
            </th>
        </tr>

        <!-- Merged Info Row -->
        <tr></tr>
        <tr>
            <td colspan="{{ count($modalKepulihan) + 2 }}" style="font-weight: bold;">
                <div style="display: flex; justify-content: space-between; width: 100%;">
                    <span>JUMLAH KLIEN MENJAWAB 6 BULAN TERKINI: {{ $totalClients }} ORANG</span>
                </div>
            </td>
        </tr>
        <tr></tr>      

        <!-- Column Headers -->
        <tr>
            <th style="background-color: lightgray; color: black; text-align: center; font-size: 12px;">Tahap Kepulihan</th>
            @foreach ($modalKepulihan as $modal)
                <th style="background-color: lightgray; color: black; text-align: center; font-size: 12px;">{{ ucfirst(str_replace('_', ' ', $modal)) }}</th>
            @endforeach
        </tr>
    </thead>
    
    <tbody>
        @foreach ($counts as $category => $values)
            <tr>
                <td style="background-color: lightgray; color: black; text-align: center; font-size: 12px;">{{ $category }}</td>
                @foreach ($modalKepulihan as $modal)
                    <td>{{ $values[$modal] }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
