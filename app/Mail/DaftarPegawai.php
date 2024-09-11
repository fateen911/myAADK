<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DaftarPegawai extends Mailable
{
    use Queueable, SerializesModels;

    public $pegawai;
    public $password;
    public $verificationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($pegawai, $password, $verificationUrl)
    {
        $this->pegawai = $pegawai;
        $this->password = $password;
        $this->verificationUrl = $verificationUrl;
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
                    ->view('pendaftaran.emel_daftar_pegawai_lulus')
                    ->with([
                        'nama' => $this->pegawai->nama,
                        'no_kp' => $this->pegawai->no_kp,
                        'password' => $this->password,
                        'verificationUrl' => $this->verificationUrl,
                    ]);
    }
}
