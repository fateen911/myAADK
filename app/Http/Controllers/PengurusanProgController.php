<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\HebahanMail;
use App\Models\Program;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;



class PengurusanProgController extends Controller
{
    //TRY
    public function tryQR()
    {
        return view('pengurusan_program.tryQR');
    }

    public function try()
    {
        return view('pengurusan_program.try');
    }

    //QR CODE
    public function qrCode()
    {
        $qrCode = QrCode::size(400)->generate('https://laravel.com/'); // Replace with your URL or data

        $pdf = PDF::loadView('pengurusan_program.qr_code', ['qrCode' => $qrCode]);

        return $pdf->download('qr_code.pdf');
    }

//    public function share()
//    {
//        $share_buttons = \Share::page(
//            'https://www.laravelclick.com/post/laravel-10-social-media-share-buttons-integration-tutorial',
//            'How to Add Social Media Share Button in Laravel 10 App?'
//        )
//            ->facebook()
//            ->twitter()
//            ->linkedin()
//            ->whatsapp()
//            ->telegram()
//            ->reddit();
//
//        $view_data['share_buttons'] = $share_buttons;
//
//        return view('post')->with($view_data);
//    }

    //PEGAWAI AADK
    public function daftarProgPA()
    {
        return view('pengurusan_program.pegawai_aadk.daftar_prog');
    }

    public function kemaskiniProgPA()
    {
        return view('pengurusan_program.pegawai_aadk.kemaskini_prog');
    }

//    public function postDaftarProgPA(Request $request)
//    {
//        // Validate the form data
//        $request->validate([
//            'nama'      => 'required|string|max:255',
//            'objective' => 'required|string',
//            'tempat'    => 'required|string',
//            'tarikh'    => 'required|date',
//            'masa'      => 'required|time',
//            'catatan'   => 'required|string',
//        ]);
//
//        $program = new Program();
//        $program->penganjur_id  = $request->penganjur;
//        $program->nama          = $request->nama;
//        $program->objektif      = $request->objektif;
//        $program->tempat        = $request->tempat;
//        $program->tarikh        = $request->tarikh;
//        $program->masa          = $request->masa;
//        $program->catatan       = $request->catatan;
//
//        //$program->pautan = route('pengurusan_program.klien.pengesahan_kehadiran', $program->id);
//        $program->pautan = "https://laravel.com/";
//
//        $program->save();
//
//        $s_program = Program::with(['penganjur_id', 'nama', 'pautan'])->get();
//        $berjaya = "Program berjaya didaftar";
//
//        return view('pengurusan_program.pegawai_aadk.daftar_prog',compact('s_program','berjaya'));
//    }

//    public function postKemaskiniProgPA(Request $request, $id)
//    {
//        // Validate the form data
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'description' => 'required|string',
//            'start_time' => 'required|date',
//            'end_time' => 'required|date',
//            'user_id' => 'required|exists:users,id',
//            'category_id' => 'required|exists:categories,id',
//            'location_id' => 'required|exists:locations,id',
//        ]);
//
//        // Find the program
//        $program = Program::findOrFail($id);
//
//        // Update the program details
//        $program->penganjur_id  = $request->penganjur;
//        $program->nama          = $request->nama;
//        $program->objektif      = $request->objektif;
//        $program->tempat        = $request->tempat;
//        $program->tarikh        = $request->tarikh;
//        $program->masa          = $request->masa;
//        $program->catatan       = $request->catatan;
//
//        // Generate the registration link
//        //$program->pautan = route('pengurusan_program.klien.pengesahan_kehadiran', $program->id);
//        $program->pautan = "https://laravel.com/";
//
//        $program->save();
//        return view('pengurusan_program.pegawai_aadk.kemaskini_prog');
//    }

    public function maklumatProgPA()
    {
        return view('pengurusan_program.pegawai_aadk.maklumat_prog');
    }

    public function senaraiProgPA()
    {
        return view('pengurusan_program.pegawai_aadk.senarai_prog');
    }

    //PEGAWAI SISTEM
    public function daftarProgPS()
    {
        return view('pengurusan_program.pentadbir_sistem.daftar_prog');
    }

    public function kemaskiniProgPS()
    {
        return view('pengurusan_program.pentadbir_sistem.kemaskini_prog');
    }

    public function maklumatProgPS()
    {
        return view('pengurusan_program.pentadbir_sistem.maklumat_prog');
    }

    //    public function postDaftarProgPS(Request $request)
//    {
//        // Validate the form data
//        $request->validate([
//            'nama'      => 'required|string|max:255',
//            'objective' => 'required|string',
//            'tempat'    => 'required|string',
//            'tarikh'    => 'required|date',
//            'masa'      => 'required|time',
//            'catatan'   => 'required|string',
//        ]);
//
//        $program = new Program();
//        $program->penganjur_id  = $request->penganjur;
//        $program->nama          = $request->nama;
//        $program->objektif      = $request->objektif;
//        $program->tempat        = $request->tempat;
//        $program->tarikh        = $request->tarikh;
//        $program->masa          = $request->masa;
//        $program->catatan       = $request->catatan;
//
//        //$program->pautan = route('pengurusan_program.klien.pengesahan_kehadiran', $program->id);
//        $program->pautan = "https://laravel.com/";
//
//        $program->save();
//
//        $s_program = Program::with(['penganjur_id', 'nama', 'pautan'])->get();
//        $berjaya = "Program berjaya didaftar";
//
//        return view('pengurusan_program.pentadbir_sistem.daftar_prog',compact('s_program','berjaya'));
//    }

//    public function postKemaskiniProgPA(Request $request, $id)
//    {
//        // Validate the form data
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'description' => 'required|string',
//            'start_time' => 'required|date',
//            'end_time' => 'required|date',
//            'user_id' => 'required|exists:users,id',
//            'category_id' => 'required|exists:categories,id',
//            'location_id' => 'required|exists:locations,id',
//        ]);
//
//        // Find the program
//        $program = Program::findOrFail($id);
//
//        // Update the program details
//        $program->penganjur_id  = $request->penganjur;
//        $program->nama          = $request->nama;
//        $program->objektif      = $request->objektif;
//        $program->tempat        = $request->tempat;
//        $program->tarikh        = $request->tarikh;
//        $program->masa          = $request->masa;
//        $program->catatan       = $request->catatan;
//
//        // Generate the registration link
//        //$program->pautan = route('pengurusan_program.klien.pengesahan_kehadiran', $program->id);
//        $program->pautan = "https://laravel.com/";
//
//        $program->save();
//        return view('pengurusan_program.pentadbir_sistem.kemaskini_prog');
//    }

    public function senaraiProgPS()
    {
        return view('pengurusan_program.pentadbir_sistem.senarai_prog');
    }

    //KLIEN
    public function daftarKehadiran()
    {
        return view('pengurusan_program.klien.daftar_kehadiran');
    }

    public function pengesahanKehadiran()
    {
        return view('pengurusan_program.klien.pengesahan_kehadiran');
    }

    //HEBAHAN - EMEL

    public function hebahanEmel()
    {
        $recipient = 'ziba0506@gmail.com';
        Mail::to($recipient)->send(new HebahanMail());

        return redirect()->back()->with('status', 'Email sent successfully!');
    }

    //HEBAHAN - SMS
    public function hebahanSMS()
    {
        // Get the program and registration link
        $program = Program::findOrFail(1); //program_id
        $registrationLink = $program->registration_link;

        // Create the message
        $message = "Register for the program {$program->name} using this link: {$registrationLink}";

        // Send the SMS
        $this->sendTwilioSms("+601135679794", $message);

        return redirect()->route('programs.show', $program->id)
            ->with('success', 'SMS sent successfully.');
    }

    protected function sendTwilioSms($to, $message)
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');

        $client = new Client($sid, $token);
        $client->messages->create($to, [
            'from' => $from,
            'body' => $message,
        ]);
    }

    //HEBAHAN - TELEGRAM
    public function hebahanTelegram()
    {
        // Generate program link (replace with your logic)
        $programLink = url('www.google.com');

        // Generate QR code
        $qrCode = $this->generateQrCode($programLink);

        // Message to send via Telegram
        $message = "Check out this program: " . $programLink;

        // Example: integrate with Telegram API to send message with QR code
        // Here we're logging the message to simulate sending via Telegram API
        Log::info("Sending program details via Telegram: {$message}");

        // Redirect back or to another page
        return redirect()->back()->with('success', 'Program shared via Telegram successfully.');
    }

    protected function generateQrCode($text)
    {
        // Create QR code instance
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new Png()
        );
        $writer = new Writer($renderer);
        $qrCode = $writer->writeString($text);

        return base64_encode($qrCode); // Encode QR code as base64 for embedding in HTML
    }


    //PDF
    public function pdfPengesahan()
    {
        $data = ['title' => 'Senarai Pengesahan Kehadiran', 'date' => date('d/m/Y')];
        $pdf = PDF::loadView('pengurusan_program.pdf_pengesahan', $data)->setPaper('a4', 'landscape');

        return $pdf->download('senarai_pengesahan_kehadiran.pdf');
    }

    public function pdfPerekodan()
    {
        $data = ['title' => 'Senarai Klien Yang Hadir', 'date' => date('d/m/Y')];
        $pdf = PDF::loadView('pengurusan_program.pdf_perekodan', $data)->setPaper('a4');

        return $pdf->download('senarai_perekodan_kehadiran.pdf');
    }

    public function excelPengesahan()
    {
        return Excel::download(new Program,'senarai_pengesahan_kehadiran.xlsx');
    }

    public function excelPerekodan()
    {
        return Excel::download(new Program,'senarai_perekodan_kehadiran.xlsx');
    }
}
