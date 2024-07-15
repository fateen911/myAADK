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
    <h1>PENDAFTARAN PROGRAM</h1>
    <br>
    <br>
    <div>
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    </div>
    <br>
    <br>
    <h3>Nama Program: Program Pemulihan Bersepadu</h3>
    <h3>Tarikh/Masa: 17/06/2024, 9AM</h3>
    <h3>Tempat: Dewan Perdana</h3>
    <h3>Pautan: <a href="https://laravel.com/">https://laravel.com/</a></h3>
</div>

</body>
</html>
