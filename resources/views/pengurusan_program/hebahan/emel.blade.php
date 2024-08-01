<!DOCTYPE html>
<html>
<head>
    <title>Hebahan</title>
</head>
<body>
<h1>HEBAHAN PROGRAM</h1>
<h4>NAMA PROGRAM: {{strtoupper($program->nama)}}</h4>
<h4>TARIKH MULA: {{date('d/m/Y, gA', strtotime($program->tarikh_mula))}}</h4>
<h4>TARIKH TAMAT: {{date('d/m/Y, gA', strtotime($program->tarikh_tamat))}}</h4>
<h4>TEMPAT: {{strtoupper($program->tempat)}}</h4>
<br>
<p>Sila imbas kod qr berikut untuk pengesahan kehadiran anda:</p>
<img src="{{ $message->embed(public_path('qr_codes/qr_pengesahan_'.$program->id.'.png')) }}" alt="Logo">
</body>
</html>
