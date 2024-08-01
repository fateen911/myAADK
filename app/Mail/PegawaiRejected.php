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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pegawaiBaharu)
    {
        $this->pegawaiBaharu = $pegawaiBaharu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "DAFTAR PENGGUNA SISTEM i-Recover";

        return $this->subject($subject)
                    ->view('pendaftaran.emel_daftar_pegawai_ditolak')
                    ->with([
                        'nama' => $this->pegawaiBaharu->nama,
                    ]);
    }
}
