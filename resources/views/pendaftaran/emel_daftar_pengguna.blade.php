<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pemulihan dan Rawatan Klien AADK: Daftar Pengguna Sistem</title>
</head>
<body>
    <h3>PENDAFTARAN AKAUN PENGGUNA SISTEM MODAL KEPULIHAN KLIEN PASCA TAMAT RAWATAN PEMULIHAN DALAM KOMUNITI</h3>
    <p>Assalamualaikum WBT & Salam Sejahtera,</p>
    <br>
    <p>Tuan/Puan,</p>
    <br>
    <p>Dimaklumkan bahawa pendaftaran akaun tuan/puan telah diterima. 
       Sila gunakan maklumat yang disertakan di bawah untuk mendaftar masuk ke dalam sistem tersebut:</p>
    <p>No Kad Pengenalan : {{$no_kp}}
    <p>Kata Laluan : {{$password}}
    <p>Sila klik pautan di bawah untuk mengesahkan emel anda dan log masuk ke dalam sistem.
        @component('mail::button', ['url' => $verificationUrl])
        @endcomponent
    <br><br>
    <p>Jika mempunyai sebarang pertanyaan, sila hubungi <i>hotline</i> di talian 1-800-22-2235 / 019 – 626 2233 atau e-mel ke webmaster@adk.gov.my </p>
   
    <p>Untuk maklumat lanjut, sila layari https://www.adk.gov.my </p>
    <br>
    <p>Sekian, terima kasih.</p>
    <br>
    
    <p><b>Agensi Antidadah Kebangsaan</b></p>
</body>
</html>