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
        <p>Dukacita dimaklumkan bahawan permohonan anda untuk mendaftar sebagai pengguna sistem telah <b>ditolak.</b>

            <!-- Display rejection reasons, if available -->
            @if(!empty($alasan_ditolak))
                <p>Alasan Penolakan:</p>
                <ul>
                    @foreach($alasan_ditolak as $reason)
                        <li>{{ $reason }}</li>
                    @endforeach
                </ul>
            @endif

        <br><br>
        <p>Jika mempunyai sebarang pertanyaan, sila hubungi <i>hotline</i> di talian 1-800-22-2235 / 019 – 626 2233 atau e-mel ke webmaster@adk.gov.my </p>
    
        <p>Untuk maklumat lanjut, sila layari https://www.adk.gov.my </p>
        <br>
        <p>Sekian, terima kasih.</p>
        <br>
        
        <p><b>Agensi Antidadah Kebangsaan</b></p>
    </body>
</html>