<!DOCTYPE html>
<html>
<body>
    <h3>PENDAFTARAN PEGAWAI SEBAGAI PENGGUNA SISTEM MySupport AADK DILULUSKAN</h3>
    <p>Assalamualaikum WBT & Salam Sejahtera,</p>
    <p>Tuan/Puan,</p>
    <p>Dimaklumkan bahawa pendaftaran akaun tuan/puan telah diterima. Sila gunakan maklumat yang disertakan di bawah untuk mendaftar masuk ke dalam sistem tersebut:</p>
    <br>
    <p><b>Nama Pegawai :</b> {{strtoupper($nama)}}</p>
    <p><b>No Kad Pengenalan :</b> {{$no_kp}}
    <p><b>Kata Laluan :</b>Kata Laluan : {{$password}}
    <p>Sila klik pada pautan yang diberikan untuk mengesahkan emel anda dan log masuk ke dalam sistem.
        @component('mail::button', ['url' => $verificationUrl])
        @endcomponent
    <br>
    <p>Jika mempunyai sebarang pertanyaan, sila hubungi <i>hotline</i> di talian 1-800-22-2235 / 019 – 626 2233 atau e-mel ke webmaster@adk.gov.my </p>
    <p>Untuk maklumat lanjut, sila layari https://www.adk.gov.my </p>
    <br>
    <p>Sekian, terima kasih.</p>
    <br>
    
    <p><b>Agensi Antidadah Kebangsaan</b></p>
</body>
</html>