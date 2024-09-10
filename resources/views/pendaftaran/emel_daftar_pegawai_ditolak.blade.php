<!DOCTYPE html>
<html>
    <body>
        <h3>PENDAFTARAN AKAUN PENGGUNA SISTEM MySupport</h3>
        <p>Assalamualaikum WBT & Salam Sejahtera,</p>
        
        <p>Tuan/Puan,</p>
        <p>Dukacita dimaklumkan bahawan permohonan anda untuk mendaftar sebagai pengguna sistem telah <b>ditolak</b> atas sebab-sebab yang dinyatakan di bawah:

            <!-- Display rejection reasons, if available -->
            @if(!empty($alasan_ditolak))
            <ol type="i">
                @if(is_array($alasan_ditolak))
                    @foreach($alasan_ditolak as $reason)
                        <li>{{ $reason }}</li>
                    @endforeach
                @else
                    <li>{{ $alasan_ditolak }}</li>
                @endif
            </ol>
        @endif

        <p>Jika mempunyai sebarang pertanyaan, sila hubungi <i>hotline</i> di talian 1-800-22-2235 / 019 – 626 2233 atau e-mel ke webmaster@adk.gov.my </p>
    
        <p>Untuk maklumat lanjut, sila layari https://www.adk.gov.my </p>
        <br>
        <p>Sekian, terima kasih.</p>
        <br>
        
        <p><b>Agensi Antidadah Kebangsaan</b></p>
    </body>
</html>