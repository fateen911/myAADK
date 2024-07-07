<!DOCTYPE html>
<html>
<head>
    <title>Hebahan</title>
</head>
<body>
<h1>Hebahan Program</h1>
<p>Sila imbas kod qr berikut untuk pengesahan kehadiran anda:</p>
<img src="{{ $message->embed(public_path('qr_codes/qrcode.png')) }}" alt="Logo">
</body>
</html>
