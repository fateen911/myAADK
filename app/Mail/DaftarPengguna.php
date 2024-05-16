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

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
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

        $subject = "DAFTAR PENGGUNA SISTEM MYAADK";
        return $this->subject($subject)
                    ->view('pentadbir.pendaftaran.emel_daftar_pengguna')
                    ->with([
                        'email' => $this->email,
                        'password' => $this->password,
                        // 'verificationUrl' => $verificationUrl,
                    ]);
    }
}
