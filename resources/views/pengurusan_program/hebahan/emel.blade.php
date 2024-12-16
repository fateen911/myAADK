<!DOCTYPE html>
<html>
<head>
    <title>Hebahan</title>
</head>
<body>
<p>Assalamualaikum dan Salam Sejahtera,</p><br>
<p>Dengan segala hormatnya, kami ingin menjemput pihak tuan/puan untuk menghadiri aktiviti berikut:</p> <br>
<p><b>NAMA AKTIVITI: {{strtoupper($program->nama)}}</b></p>
<p><b>TARIKH MULA: {{date('d/m/Y, h:iA', strtotime($program->tarikh_mula))}}</b></p>
<p><b>TARIKH TAMAT: {{date('d/m/Y, h:iA', strtotime($program->tarikh_tamat))}}</b></p>
<p><b>TEMPAT: {{strtoupper($program->tempat)}}</b></p>
<br>
<p>Sila imbas kod QR atau klik pautan berikut untuk maklum balas kehadiran anda:</p>
<img src="{{ $message->embed(public_path('qr_codes/qr_pengesahan_'.$program->id.'.png')) }}" alt="Logo">
<br>
<p>Pautan: <a href="{{$program->pautan_pengesahan}}">sila klik sini</a></p>
<br>
<p>Kami amat menghargai kehadiran tuan/puan ke program ini.
Untuk sebarang pertanyaan atau maklumat lanjut, sila hubungi <b>{{$program->no_tel_dihubungi}}</b>.
Kerjasama dan keprihatinan tuan/puan amat kami hargai.</p><br>
<p>Sekian, terima kasih.</p><br>

<p>Yang Benar,</p><br>
<p><b>{{$pendaftar_prog->name}}</b></p>
<p><b>Pegawai Agensi Antidadah Kebangsaan (AADK)</b></p><br>
</body>
</html>
