<?php

namespace App\Mail;

use App\Models\Program;
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

    public $id,$program;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->program = Program::where('id', $id)->first();
    }

    public function build()
    {
        return $this->view('pengurusan_program.hebahan.emel')
            ->with('id', $this->program);
    }
}
