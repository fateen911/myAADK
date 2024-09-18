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
    <h3>Nama Aktiviti: {{$program->nama}}</h3>
    <h3>Tarikh/Masa Mula: {{date('d/m/Y, h:iA', strtotime($program->tarikh_mula))}}</h3>
    <h3>Tarikh/Masa Tamat: {{date('d/m/Y, h:iA', strtotime($program->tarikh_tamat))}}</h3>
    <h3>Tempat: {{$program->nama}}</h3>
    <h3>Pautan: <a href="{{$program->pautan_perekodan}}">{{$program->pautan_perekodan}}</a></h3>
</div>

</body>
</html>
