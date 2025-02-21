<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klien View Data</title>
</head>
<body>
    <h2>Data from view_pccp_klien</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                @foreach($data->first() ?? [] as $column => $value)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    @foreach($row->getAttributes() as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
