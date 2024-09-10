<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PegawaiRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $pegawaiBaharu;
    public $alasan_ditolak; // Add a public property for reasons

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pegawaiBaharu)
    {
        $this->pegawaiBaharu = $pegawaiBaharu;
        $this->alasan_ditolak = json_decode($pegawaiBaharu->alasan_ditolak, true); // Decode the reasons from JSON to array
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "DAFTAR PENGGUNA SISTEM MySupport";

        return $this->subject($subject)
                    ->view('pendaftaran.emel_daftar_pegawai_ditolak')
                    ->with([
                        'nama' => $this->pegawaiBaharu->nama,
                        'alasan_ditolak' => $this->alasan_ditolak, // Pass the rejection reasons to the view
                    ]);
    }
}

