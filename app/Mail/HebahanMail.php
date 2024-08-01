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

    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function build()
    {
        return $this->view('pengurusan_program.hebahan.emel')
            ->attach(public_path('qr_codes/qr_pengesahan_'.$this->id.'.png'), [
                'as' => 'logo.png',
                'mime' => 'image/png',
            ]);
    }
}
