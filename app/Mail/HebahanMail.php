<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HebahanMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->view('pengurusan_program.hebahan.emel')
            ->attach(public_path('qr_codes/qrcode.png'), [
                'as' => 'logo.png',
                'mime' => 'image/png',
            ]);
    }
}
