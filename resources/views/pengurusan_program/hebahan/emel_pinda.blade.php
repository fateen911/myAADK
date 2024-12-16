<!DOCTYPE html>
<html>
<head>
    <title>Hebahan Pinda</title>
</head>
<body>
<p>Assalamualaikum dan Salam Sejahtera,<br>
<p>
    Dengan segala hormatnya, kami ingin memaklumkan bahawa aktiviti {{strtoupper($program->nama)}}
    telah dipinda atas sebab-sebab yang tidak dapat dielakkan.
</p>
<br>
<p>Butiran terkini aktiviti adalah seperti berikut:</p>
<p><b>NAMA AKTIVITI: {{strtoupper($program->nama)}}</b></p>
<p><b>TARIKH MULA: {{date('d/m/Y, h:iA', strtotime($program->tarikh_mula))}}</b></p>
<p><b>TARIKH TAMAT: {{date('d/m/Y, h:iA', strtotime($program->tarikh_tamat))}}</b></p>
<p><b>TEMPAT: {{strtoupper($program->tempat)}}</b></p>
<br>
<p>Sila imbas kod QR yang baharu atau klik pautan berikut untuk maklum balas kehadiran anda:</p>
<img src="{{ $message->embed(public_path('qr_codes/qr_pengesahan_'.$program->id.'.png')) }}" alt="Logo">
<br>
<p>Pautan: <a href="{{$program->pautan_pengesahan}}">sila klik sini</a></p>
<br>
<p>
    Kami memohon maaf atas sebarang kesulitan yang timbul dan menghargai pemahaman serta sokongan anda.
    Sekiranya terdapat sebarang pertanyaan atau keperluan lanjut, sila hubungi <b>{{$program->no_tel_dihubungi}}</b>.
    Terima kasih atas perhatian anda, dan kami berharap dapat melihat kehadiran anda pada tarikh baharu program ini.
</p>
<br>
<p>Sekian, terima kasih.</p><br>

<p>Yang Benar,</p><br>
<p><b>{{$pendaftar_prog->name}}</b></p>
<p><b>Pegawai Agensi Antidadah Kebangsaan (AADK)</b></p><br>
</body>
</html>
