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
    <h3>Tarikh/Masa Mula: 1 Ogos 2024, 8:00 AM</h3>
    <h3>Tarikh/Masa Tamat: 3 Ogos 2024, 2:00 PM</h3>
    <h3>Tempat: Pusat Pemulihan Komuniti, Taman Desa Harmoni, Johor Bahru</h3>
    <h3>Pautan: <a href="http://127.0.0.1:8000/pengurusan_program/klien/daftar_kehadiran">http://127.0.0.1:8000/pengurusan_program/klien/daftar_kehadiran</a></h3>
</div>

</body>
</html>
