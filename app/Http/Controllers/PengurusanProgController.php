<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\HebahanMail;
use App\Models\Program;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

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

    public function hebahanEmel()
    {

        $customMessage = "Habahan";
        $recipientEmail = "ziba0506@gmail.com";

        Mail::to($recipientEmail)->send(new HebahanMail($customMessage));

        return back()->with('success', 'Email sent successfully!');
    }

}
