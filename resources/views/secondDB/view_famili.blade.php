<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Famili View Data</title>
</head>
<body>
    <h2>Data from view_pccp_famili</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                @foreach(array_keys($data[0] ?? []) as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    @foreach($row as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
