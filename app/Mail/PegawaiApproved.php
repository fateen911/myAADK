<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PegawaiApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $pegawaiBaharu;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($pegawaiBaharu, $password)
    {
        $this->pegawaiBaharu = $pegawaiBaharu;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pendaftaran.emel_daftar_pengguna')
                    ->with([
                        'nama' => $this->pegawaiBaharu->nama,
                        'no_kp' => $this->pegawaiBaharu->no_kp,
                        'password' => $this->password,
                    ]);
    }
}
