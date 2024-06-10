<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
</head>
<style>
    .center {
        padding: 70px 0;
        border: 3px solid black;
        text-align: center;
    }
</style>
<body>
<div class="center">
    <h1>Program Pemulihan Bersepadu</h1>
    <br>
    <div>
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    </div>
    <br>
    <h2>
        <a href="https://laravel.com/">https://laravel.com/</a>
    </h2>
</div>

</body>
</html>
