<!DOCTYPE html>
<html>
<head>
    <title>Hebahan Batal</title>
</head>
<body>
<p>Assalamualaikum dan Salam Sejahtera,</p><br>
<p>
    Dengan segala hormatnya, kami ingin memaklumkan bahawa <b>{{strtoupper($program->nama)}}</b>
    yang dijadualkan pada <b>{{date('d/m/Y, h:iA', strtotime($program->tarikh_mula))}}</b> terpaksa dibatalkan
    atas sebab-sebab yang tidak dapat dielakkan. Kami amat menghargai sokongan dan minat anda terhadap
    aktiviti ini, dan dengan rasa kesal kami memohon maaf atas sebarang kesulitan yang mungkin timbul
    akibat pembatalan ini.
</p>
<p>
    Sekiranya terdapat sebarang pertanyaan atau maklumat lanjut, sila hubungi <b>{{$program->no_tel_dihubungi}}</b>.
    Terima kasih atas pemahaman anda, dan kami berharap dapat bekerjasama dengan anda dalam aktiviti-aktiviti akan datang.
</p>
<br>
<p>Sekian, terima kasih.</p><br>

<p>Yang Benar,</p><br>
<p><b>{{$pendaftar_prog->name}}</b></p>
<p><b>Pegawai Agensi Antidadah Kebangsaan (AADK)</b></p><br>
</body>
</html>
