<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PegawaiApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $pegawaiBaharu;
    public $password;
    public $verificationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($pegawaiBaharu, $password, $verificationUrl)
    {
        $this->pegawaiBaharu = $pegawaiBaharu;
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
                    ->view('pendaftaran.emel_daftar_pengguna')
                    ->with([
                        'nama' => $this->pegawaiBaharu->nama,
                        'no_kp' => $this->pegawaiBaharu->no_kp,
                        'password' => $this->password,
                        'verificationUrl' => $this->verificationUrl,
                    ]);
    }
}
