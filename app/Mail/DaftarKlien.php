<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DaftarKlien extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        $subject = "DAFTAR PENGGUNA SISTEM MySupport";
        return $this->subject($subject)
                    ->view('pendaftaran.emel_daftar_klien')
                    ->with([
                        'nama' => $this->user->name,
                        'no_kp' => $this->user->no_kp,
                        'password' => $this->password,
                    ]);
    }
    
}
