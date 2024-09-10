<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KemaskiniKataLaluan extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $email;
    public $no_kp;
    public $password;

    public function __construct($email, $password, $no_kp)
    {
        $this->email = $email;
        $this->no_kp = $no_kp;
        $this->password = $password;
    }

    public function build()
    {
        $subject = "KEMASKINI KATA LALUAN AKAUN SISTEM MySupport";
        return $this->subject($subject)
                    ->view('pendaftaran.pegawai_daerah.emel_kemaskini_kata_laluan')
                    ->with([
                        'no_kp' => $this->no_kp,
                        'password' => $this->password,
                    ]);
    }
}

