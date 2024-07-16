<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
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

    //PEGAWAI AADK
    public function daftarProgPA()
    {
        return view('pengurusan_program.pegawai_aadk.daftar_prog');
    }

    public function kemaskiniProgPA()
    {
        return view('pengurusan_program.pegawai_aadk.kemaskini_prog');
    }

    public function maklumatProgPA()
    {
        return view('pengurusan_program.pegawai_aadk.maklumat_prog');
    }

    public function senaraiProgPA()
    {
        return view('pengurusan_program.pegawai_aadk.senarai_prog');
    }

    public function tambahKategoriPA(){
        return view('pengurusan_program.pegawai_aadk.tambah_kategori');
    }

    public function kategoriProgPA(){
        return view('pengurusan_program.pegawai_aadk.tambah_kategori');
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

    public function senaraiProgPS()
    {
        return view('pengurusan_program.pentadbir_sistem.senarai_prog');
    }

    public function tambahKategoriPS(){
        return view('pengurusan_program.pentadbir_sistem.tambah_kategori');
    }
    public function kategoriProgPS(){
        return view('pengurusan_program.pentadbir_sistem.tambah_kategori');
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
        // Telegram Bot API endpoint
        $telegramToken = '7424416504:AAFBsucOUhWLVOaLXOWCvrr2AaC6_ZlaHrk';
        $telegramEndpoint = "https://api.telegram.org/bot{$telegramToken}/sendPhoto";
        $chatId = 490430239; //618021127 - syafiqah

        // Public path to the image file
        $imagePath = public_path('qr_codes/qrcode.png');

        // Check if the image file exists
        if (!file_exists($imagePath)) {
            return "Image file not found.";
        }

        // Send image file
        $response = Http::attach(
            'photo',
            file_get_contents($imagePath),
            'qrcode.png'
        )->post($telegramEndpoint, [
            'chat_id' => $chatId,
            'caption' => 'Your QR code:',
        ]);

        // Check response and handle accordingly
        if ($response->successful()) {
            return redirect()->back()->with('status', 'Successfully!');
        } else {
            return redirect()->back()->with('status', 'Fail!');
        }
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
