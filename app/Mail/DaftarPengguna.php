<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class DaftarPengguna extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $no_kp;
    public $password;
    public $nama;
    public $verificationUrl;

    public function __construct($email, $password, $no_kp, $nama, $verificationUrl)
    {
        $this->email = $email;
        $this->no_kp = $no_kp;
        $this->password = $password;
        $this->nama = $nama;
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build new message instance.
     */
    public function build()
    {
        // Assume the $user ID is available
        //$userId = User::where('email', $this->email)->value('id'); // Ensure you get the user's ID

        // $verificationUrl = URL::temporarySignedRoute(
        //                         'verification.verify',
        //                         now()->addMinutes(60), // Adjust the expiration time as needed
        //                         ['id' => $userId, 'hash' => sha1($this->email)]
        //                     );

        $subject = "DAFTAR PENGGUNA SISTEM MySupport";
        return $this->subject($subject)
                    ->view('pendaftaran.emel_daftar_pengguna')
                    ->with([
                        'no_kp' => $this->no_kp,
                        'password' => $this->password,
                        'nama' => $this->nama,
                        'verificationUrl' => $this->verificationUrl,
                        // 'verificationUrl' => $verificationUrl,
                    ]);
    }
}
