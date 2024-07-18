<?php

namespace App\Http\Controllers;
use App\Models\KategoriProgram;
use App\Models\Klien;
use App\Models\PengesahanKehadiranProgram;
use App\Models\PerekodanKehadiranProgram;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
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

    public function postTambahKategoriPA(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'kod' => 'required|string|max:255',
        ]);

        $kategori = new KategoriProgram();
        $kategori->nama = $request->nama;
        $kategori->kod = $request->kod;
        $kategori->save();

        return view('pengurusan_program.pegawai_aadk.tambah_kategori')->with('success', 'User created successfully.');
    }

    public function kategoriProgPS(){
        return view('pengurusan_program.pentadbir_sistem.tambah_kategori');
    }

    public function kategoriProgPA(){
        return view('pengurusan_program.pegawai_aadk.tambah_kategori');
    }


    //PEGAWAI SISTEM
    public function daftarProgPS()
    {
        return view('pengurusan_program.pentadbir_sistem.daftar_prog');
    }

    public function postDaftarProgPS(Request $request)
    {
//        $request->validate([
//            'nama'              =>  'required|string|max:255',
//            'objektif'          =>  'required|string|max:255',
//            'tarikh_mula'       =>  'required|date_format:d/m/Y h:i A',
//            'tarikh_tamat'      =>  'required|date_format:d/m/Y h:i A',
//            'tempat'            =>  'required|string|max:255',
//            'penganjur'         =>  'required|string|max:255',
//            'nama_pegawai'      =>  'required|string|max:255',
//            'no_tel_dihubungi'  =>  'required|integer',
//            'catatan'           =>  'required|string|max:255',
//        ]);

        $program = new Program();

        $pegawai_id = Auth::id();

        //PENGESAHAN
        $pautan_pengesahan = "http://127.0.0.1:8000/pengurusan_program/klien/pengesahan_kehadiran/".$program->id;

        // Generate QR code
        $generate_qr_1 = QrCode::size(300)->generate($pautan_pengesahan);

        // Save QR code to public path (storage/app/public/qrcodes)
        $path_1 = public_path('qr_codes/');
        $file_name_1 = 'qr_pengesahan_' . $program->id . '.png';

        // Ensure the directory exists
        if (!file_exists($path_1)) {
            mkdir($path_1, 0777, true);
        }

        // Save the QR code image to the public path
        file_put_contents($path_1 . $file_name_1, $generate_qr_1);

        $qr_pengesahan = $file_name_1;

        //PEREKODAN
        $pautan_perekodan = "http://127.0.0.1:8000/pengurusan_program/klien/daftar_kehadiran/".$program->id;

        // Generate QR code
        $generate_qr_2 = QrCode::size(300)->generate($pautan_perekodan);

        // Save QR code to public path (storage/app/public/qrcodes)
        $path_2 = public_path('qr_codes/');
        $file_name_2 = 'qr_perekodan_' . $program->id . '.png';

        // Ensure the directory exists
        if (!file_exists($path_2)) {
            mkdir($path_2, 0777, true);
        }

        // Save the QR code image to the public path
        file_put_contents($path_2 . $file_name_2, $generate_qr_2);

        $qr_perekodan = $file_name_2;

        //GENERATE CUSTOM ID
        $kategori = KategoriProgram::where('id', $request->kategori)->first()->kod;
        $id_custom = [
            'table'  => 'program',
            'field'  => 'custom_id',
            'length' => 9,
            'prefix' => $kategori,
            'reset_on_prefix_change'=>true
        ];
        $custom_id = IdGenerator::generate($id_custom);

        $program->pegawai_id           =   $pegawai_id;
        $program->kategori_id          =   $request->kategori;
        $program->custom_id            =   $custom_id;
        $program->nama                 =   $request->nama;
        $program->objektif             =   $request->objektif;
        $program->tarikh_mula          =   $request->tarikh_mula;
        $program->tarikh_tamat         =   $request->tarikh_tamat;
        $program->tempat               =   $request->tempat;
        $program->penganjur            =   $request->penganjur;
        $program->nama_pegawai         =   $request->nama_pegawai;
        $program->no_tel_dihubungi     =   $request->no_tel_dihubungi;
        $program->catatan              =   $request->catatan;
        $program->pautan_pengesahan    =   $pautan_pengesahan;
        $program->qr_pengesahan        =   $qr_pengesahan;
        $program->pautan_perekodan     =   $pautan_perekodan;
        $program->qr_perekodan         =   $qr_perekodan;
        $program->status               =   "BELUM SELESAI";
        $program->save();

        return view('pengurusan_program.pentadbir_sistem.maklumat_prog')->with('success', 'User created successfully.');
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

    public function postTambahKategoriPS(Request $request){
        $request->validate([
            'nama'  =>  'required|string|max:255',
            'kod'   =>  'required|string|max:255',
        ]);

        $kategori = new KategoriProgram();
        $kategori->nama =   $request->nama;
        $kategori->kod  =   $request->kod;
        $kategori->save();

        return view('pengurusan_program.pentadbir_sistem.tambah_kategori')->with('success', 'User created successfully.');
    }

    //KLIEN
    public function daftarKehadiran()
    {
        return view('pengurusan_program.klien.daftar_kehadiran');
    }

    public function postDaftarKehadiran(Request $request)
    {
        $request->validate([
            'no_kp'  =>  'required|string|max:255'
        ]);

        $klien = Klien::where('no_kp', $request->no_kp)->first();
        $program = Program::where('id', $request->program_id)->first();
        if (is_null($klien)){
            return redirect()->back()->with('error', 'No Kad Pengenalan tidak sah.');
        }

        if (is_null($program)){
            return redirect()->back()->with('error', 'Program tidak wujud.');
        }

        $klien_id = $klien->id;
        $program_id = $program->id;

        $tarikh_perekodan = Carbon::now();

        $perekodan = new PerekodanKehadiranProgram();
        $perekodan->program_id          =   $program_id;
        $perekodan->klien_id            =   $klien_id;
        $perekodan->tarikh_perekodan    =   $tarikh_perekodan;
        $perekodan->save();
        return redirect()->back()->with('success', 'Berjaya dihantar.');
    }

    public function pengesahanKehadiran()
    {
        return view('pengurusan_program.klien.pengesahan_kehadiran');
    }

    public function postPengesahanKehadiran(Request $request)
    {
        $request->validate([
            'no_kp'     =>  'required|string|max:255'
        ]);

        $klien = Klien::where('no_kp', $request->no_kp)->first();
        $program = Program::where('id', $request->program_id)->first();
        if (is_null($klien)){
            return redirect()->back()->with('error', 'No Kad Pengenalan tidak sah.');
        }

        if (is_null($program)){
            return redirect()->back()->with('error', 'Program tidak wujud.');
        }

        $klien_id = $klien->id;
        $program_id = $program->id;

        $tarikh_pengesahan = Carbon::now();

        $pengesahan = new PengesahanKehadiranProgram();
        $pengesahan->program_id             =   $program_id;
        $pengesahan->klien_id               =   $klien_id;
        $pengesahan->tarikh_pengesahan      =   $tarikh_pengesahan;
        $pengesahan->catatan                =   $request->catatan;
        $pengesahan->keputusan              =   $request->keputusan;
        $pengesahan->save();


        return redirect()->back()->with('success', 'Berjaya dihantar.');
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
