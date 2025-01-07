<?php

namespace App\Http\Controllers;
use App\Exports\PengesahanKehadiranExcel;
use App\Exports\PerekodanKehadiranExcel;
use App\Mail\HebahanBatalMail;
use App\Mail\HebahanPindaMail;
use App\Models\Daerah;
use App\Models\DaerahPejabat;
use App\Models\KategoriProgram;
use App\Models\Klien;
use App\Models\Negeri;
use App\Models\NegeriPejabat;
use App\Models\Pegawai;
use App\Models\PengesahanKehadiranProgram;
use App\Models\PerekodanKehadiranProgram;
use App\Models\User;
use App\Models\NotifikasiPegawaiDaerah;
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
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;



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

    //JSON
    public function klienSemua()//semua
    {
        $klien = Klien::whereNotNull('emel')->get();
        return response()->json($klien);
    }

    public function klienNegeri($id)//negeri
    {
        $klien = Klien::where('negeri_pejabat',$id)->whereNotNull('emel')->get();
        return response()->json($klien);
    }

    public function klienDaerah($id)//daerah
    {
        $klien = Klien::where('daerah_pejabat',$id)->whereNotNull('emel')->get();
        return response()->json($klien);
    }

    public function kategori()
    {
        $kategori = KategoriProgram::all();
        return response()->json($kategori);
    }

    public function kategoriData($id)
    {
        $kategori = KategoriProgram::find($id);
        return response()->json($kategori);
    }

    public function programDianjurkan()
    {
        $program = Program::where('status','BELUM SELESAI')
                    ->orWhere('status','PINDA')
                    ->orWhere('status','BATAL')
                    ->get();
        return response()->json($program);
    }

    public function program($id)
    {
        $user = User::find($id);
        $pegawai = Pegawai::where('users_id',$id)->first();

        if($user){
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $program = Program::with('kategori')->get();
                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $program = Program::with('kategori')
                            ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                            ->get();
                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '5') {//pegawai daerah
                $program = Program::with('kategori')
                            ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                            ->where('daerah_pejabat',$pegawai->daerah_bertugas)
                            ->get();
                return response()->json($program);
            }
        }
        return redirect()->back()->with('error', 'User tidak dijumpai');
    }

    public function pengesahan($id)
    {
        // Fetch program and klien details using Eloquent relationships
        $pengesahan = PengesahanKehadiranProgram::with('program', 'klien')->where('program_id', $id)->get();

        // Initialize empty arrays for storing negeri and daerah values
        $responseData = [];

        // Loop through each pengesahan to fetch negeri and daerah
        foreach ($pengesahan as $item) {
            // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
            $negeri = NegeriPejabat::where('id', $item->klien->negeri_pejabat)->first();
            $daerah = DaerahPejabat::where('kod', $item->klien->daerah_pejabat)->first();

            // Add the negeri and daerah information to each pengesahan
            $responseData[] = [
                'klien' => $item->klien->nama,
                'no_kp' => $item->klien->no_kp,
                'no_tel' => $item->klien->no_tel,
                'keputusan' => $item->keputusan,
                'negeri' => $negeri ? $negeri->negeri : 'N/A',
                'daerah' => $daerah ? $daerah->daerah : 'N/A',
                'catatan' => $item->catatan,
            ];
        }

        // Return the response as JSON
        return response()->json($responseData);
    }

    public function perekodan($id)
    {
        $perekodan = PerekodanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();
        return response()->json($perekodan);
    }

    public function daerah($id)
    {
        $daerah = DaerahPejabat::where('negeri_id',$id)->get();
        return response()->json($daerah);
    }

    //QR CODE
    public function qrCode($id)
    {
        $program = Program::with('kategori')->find($id);
        $qrCode = QrCode::size(400)->generate($program->pautan_perekodan); // Replace with your URL or data

        $pdf = PDF::loadView('pengurusan_program.qr_code', ['qrCode' => $qrCode], ['program' => $program]);

        return $pdf->download('qr_code.pdf');
    }

    //PEGAWAI AADK
    public function daftarProgPA()
    {
        $kategori = KategoriProgram::all();

        if ($kategori) {
            // Notifications and unread count for tahap_pengguna == 5
            $notifications = null;
            $unreadCountPD = 0;

            if (Auth::user()->tahap_pengguna == 5) {
                $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

                // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (message1)
                $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                    ->select('id', 'message1', 'created_at', 'is_read1')
                    ->get();

                // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (message2)
                $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                    ->select('id', 'message2', 'created_at', 'is_read2')
                    ->get();

                // Combine and sort notifications by created_at descending
                $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

                // Count unread notifications where is_read = false
                $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) {
                    $query->where('is_read1', false)
                        ->orWhere('is_read2', false);
                })->count();
            }

            return view('pengurusan_program.pegawai_aadk.daftar_prog', compact('kategori', 'notifications', 'unreadCountPD'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function postDaftarProgPA(Request $request)
    {
//        $request->validate([
//            'nama'              =>  'required',
//            'objektif'          =>  'required',
//            'tarikh_mula'       =>  'required',
//            'tarikh_tamat'      =>  'required',
//            'tempat'            =>  'required',
//            'penganjur'         =>  'required',
//            'nama_pegawai'      =>  'required',
//            'no_tel_dihubungi'  =>  'required',
//            'catatan'           =>  'required',
//        ]);

        $program = new Program();

        //GENERATE CUSTOM ID
        $kategori = KategoriProgram::where('id', $request->kategori)->first()->kod;
        $id_custom = [
            'table'  => 'program',
            'field'  => 'custom_id',
            'length' => 6,
            'prefix' => $kategori,
            'reset_on_prefix_change'=>true
        ];
        $custom_id = IdGenerator::generate($id_custom);

        //Date format for database
        $format_1 = str_replace("/", "-", $request->tarikh_mula);
        $format_2 = str_replace("/", "-", $request->tarikh_tamat);

        $tarikh_mula = date('Y-m-d H:i:s', strtotime($format_1));
        $tarikh_tamat = date('Y-m-d H:i:s', strtotime($format_2));

        $pegawai = Pegawai::where('users_id', Auth::id())->first();
        $user = User::find(Auth::id());

        if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
            $program->negeri_pejabat       =   'semua';
            $program->daerah_pejabat       =   'semua';
        }
        else if ($user->tahap_pengguna == '4') {//pegawai negeri
            $program->negeri_pejabat       =   $pegawai->negeri_bertugas;
            $program->daerah_pejabat       =   'semua';
        }
        else if ($user->tahap_pengguna == '5') {//pegawai daerah
            $program->negeri_pejabat       =   $pegawai->negeri_bertugas;
            $program->daerah_pejabat       =   $pegawai->daerah_bertugas;
        }

        $program->user_id              =   $user->id;
        $program->kategori_id          =   $request->kategori;
        $program->custom_id            =   $custom_id;
        $program->nama                 =   $request->nama;
        $program->objektif             =   $request->objektif;
        $program->tarikh_mula          =   $tarikh_mula;
        $program->tarikh_tamat         =   $tarikh_tamat;
        $program->tempat               =   $request->tempat;
        $program->penganjur            =   $request->penganjur;
        $program->nama_pegawai         =   $request->nama_pegawai;
        $program->no_tel_dihubungi     =   $request->no_tel_dihubungi;
        $program->catatan              =   $request->catatan;
        $program->pautan_pengesahan    =   "tiada";
        $program->qr_pengesahan        =   "tiada";
        $program->pautan_perekodan     =   "tiada";
        $program->qr_perekodan         =   "tiada";
        $program->status               =   "BELUM SELESAI";
        $program->save();


        //PENGESAHAN
        // Generate the unique link with event ID
        $pautan_pengesahan = url('/pengurusan-program/klien/pengesahan-kehadiran', ['id' => $program->id]);

        // Generate the QR code for the event link
        $generate_qr_1 = QrCode::format('png')->size(300)->generate($pautan_pengesahan);


        // Save the QR code image to the public directory
        $filePath = public_path('qr_codes/qr_pengesahan_' . $program->id . '.png');
        file_put_contents($filePath, $generate_qr_1);

        $qr_pengesahan = 'qr_pengesahan_' . $program->id . '.png';

        //PEREKODAN
        $pautan_perekodan = url('/pengurusan-program/klien/daftar-kehadiran', ['id' => $program->id]);

        // Generate the QR code for the event link
        $generate_qr_2 = QrCode::format('png')->size(300)->generate($pautan_perekodan);

        // Save the QR code image to the public directory
        $filePath = public_path('qr_codes/qr_perekodan_' . $program->id . '.png');
        file_put_contents($filePath, $generate_qr_2);

        $qr_perekodan = 'qr_perekodan_' . $program->id . '.png';

        ///UPDATE
        $program->update([
            'pautan_pengesahan' =>  $pautan_pengesahan,
            'qr_pengesahan'     =>  $qr_pengesahan,
            'pautan_perekodan'  =>  $pautan_perekodan,
            'qr_perekodan'      =>  $qr_perekodan,
        ]);

        $direct = "/pengurusan-program/pegawai-aadk/maklumat-prog/" . $program->id;
        return redirect()->to($direct)->with('success', 'Aktiviti berjaya didaftar.');
    }

    public function kemaskiniProgPA($id)
    {
        $kategori = KategoriProgram::all();
        $program = Program::with('kategori')->find($id);

        // Notifications and unread count for tahap_pengguna == 5
        $notifications = null;
        $unreadCountPD = 0;

        if (Auth::user()->tahap_pengguna == 5) {
            $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (message1)
            $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message1', 'created_at', 'is_read1')
                ->get();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (message2)
            $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message2', 'created_at', 'is_read2')
                ->get();

            // Combine and sort notifications by created_at descending
            $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

            // Count unread notifications where is_read = false
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) {
                $query->where('is_read1', false)
                    ->orWhere('is_read2', false);
            })->count();
        }

        if ($kategori || $program) {
            return view('pengurusan_program.pegawai_aadk.kemaskini_prog', compact('kategori','program', 'notifications', 'unreadCountPD'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function postkemaskiniProgPA(Request $request,$id)
    {
        //Date format for database
        $format_1 = str_replace("/", "-", $request->tarikh_mula);
        $format_2 = str_replace("/", "-", $request->tarikh_tamat);

        $tarikh_mula = date('Y-m-d H:i:s', strtotime($format_1));
        $tarikh_tamat = date('Y-m-d H:i:s', strtotime($format_2));

        $program = Program::find($id);
        $program->update([
            'kategori_id'          =>   $request->kategori,
            'nama'                 =>   $request->nama,
            'objektif'             =>   $request->objektif,
            'tarikh_mula'          =>   $tarikh_mula,
            'tarikh_tamat'         =>   $tarikh_tamat,
            'tempat'               =>   $request->tempat,
            'penganjur'            =>   $request->penganjur,
            'nama_pegawai'         =>   $request->nama_pegawai,
            'no_tel_dihubungi'     =>   $request->no_tel_dihubungi,
            'catatan'              =>   $request->catatan,
        ]);

        $notif = "Aktiviti berjaya dikemaskini.";

        // Check hebahan
        if ($request->has('hebah_pindaan')) {

            $program->update([
                'status' => "PINDA",
            ]);

            if ($program->negeri_pejabat == "semua" && $program->daerah_pejabat == "semua") {
                $klien = Klien::all();
            }
            elseif ($program->negeri_pejabat != "semua" && $program->daerah_pejabat == "semua") {
                $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->get();
            }
            else {
                $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->where('daerah_pejabat',$program->negeri_pejabat)->get();
            }

            // Send communication based on the selected method
            foreach ($klien as $item) {
                if($item->emel != null){
                    $recipient = $item->emel;
                    Mail::to($recipient)->send(new HebahanPindaMail($id));
                }
            }

            $notif = "Aktiviti berjaya dikemaskini dan dihebahkan.";
        }
        $direct = "/pengurusan-program/pegawai-aadk/maklumat-prog/" . $program->id;
        return redirect()->to($direct)->with('success', $notif);
    }

    public function batalProgPA($id){
        $program = Program::find($id);
        $program->update([
            'status' => "BATAL",
        ]);

        if ($program->negeri_pejabat == "semua" && $program->daerah_pejabat == "semua") {
            $klien = Klien::all();
        }
        elseif ($program->negeri_pejabat != "semua" && $program->daerah_pejabat == "semua") {
            $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->get();
        }
        else {
            $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->where('daerah_pejabat',$program->negeri_pejabat)->get();
        }

        // Send communication based on the selected method
        foreach ($klien as $item) {
            if($item->emel != null){
                $recipient = $item->emel;
                Mail::to($recipient)->send(new HebahanBatalMail($id));
            }
        }

        $direct = "/pengurusan-program/pegawai-aadk/maklumat-prog/" . $program->id;
        return redirect()->to($direct)->with('success', 'Aktiviti berjaya dibatalkan.');
    }

    public function maklumatProgPA($id)
    {
        $program = Program::with('kategori')->find($id);
        $pengesahan = PengesahanKehadiranProgram::all();
        $hadir = $pengesahan->where('program_id',$id)->where('keputusan','HADIR')->count();
        $tdk_hadir = $pengesahan->where('program_id',$id)->where('keputusan','TIDAK HADIR')->count();
        $keseluruhan = $hadir + $tdk_hadir;

        // Notifications and unread count for tahap_pengguna == 5
        $notifications = null;
        $unreadCountPD = 0;

        if (Auth::user()->tahap_pengguna == 5) {
            $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (message1)
            $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message1', 'created_at', 'is_read1')
                ->get();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (message2)
            $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message2', 'created_at', 'is_read2')
                ->get();

            // Combine and sort notifications by created_at descending
            $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

            // Count unread notifications where is_read = false
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) {
                $query->where('is_read1', false)
                    ->orWhere('is_read2', false);
            })->count();
        }

        if ($program) {
            return view('pengurusan_program.pegawai_aadk.maklumat_prog', compact('program','hadir', 'tdk_hadir', 'keseluruhan', 'notifications', 'unreadCountPD'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function senaraiProgPA()
    {
        $user_id = Auth::id();

        // Notifications and unread count for tahap_pengguna == 5
        $notifications = null;
        $unreadCountPD = 0;

        if (Auth::user()->tahap_pengguna == 5) {
            $pegawaiDaerah = Pegawai::where('users_id', Auth::user()->id)->first();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (message1)
            $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message1', 'created_at', 'is_read1')
                ->get();

            // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (message2)
            $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                ->select('id', 'message2', 'created_at', 'is_read2')
                ->get();

            // Combine and sort notifications by created_at descending
            $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

            // Count unread notifications where is_read = false
            $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) {
                $query->where('is_read1', false)
                    ->orWhere('is_read2', false);
            })->count();
        }

        return view('pengurusan_program.pegawai_aadk.senarai_prog',compact('user_id', 'notifications', 'unreadCountPD'));
    }


    public function tambahKategoriPA(){
        return view('pengurusan_program.pegawai_aadk.tambah_kategori');
    }

    public function postTambahKategoriPA(Request $request){
        $request->validate([
            'nama'  =>  'required|string|max:255',
            'kod'   =>  'required|string|max:255',
        ]);

        $kategori = new KategoriProgram();
        $kategori->nama =   $request->nama;
        $kategori->kod  =   $request->kod;
        $kategori->save();

        return redirect()->back()->with('success', 'Kategori aktiviti ditambah.');
    }

    public function padamKategoriPA($id){
        $kategori = KategoriProgram::find($id);

        if ($kategori) {
            $kategori->delete();
            return redirect()->back()->with('success2', 'Kategori aktiviti berjaya dipadam.');
        } else {
            return redirect()->back()->with('error2', 'Kategori aktiviti gagal dipadam.');
        }
    }



    //PEGAWAI SISTEM
    public function daftarProgPS()
    {
        $kategori = KategoriProgram::all();
        if ($kategori) {
            return view('pengurusan_program.pentadbir_sistem.daftar_prog', compact('kategori'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
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

        //GENERATE CUSTOM ID
        $kategori = KategoriProgram::where('id', $request->kategori)->first()->kod;
        $id_custom = [
            'table'  => 'program',
            'field'  => 'custom_id',
            'length' => 6,
            'prefix' => $kategori,
            'reset_on_prefix_change'=>true
        ];
        $custom_id = IdGenerator::generate($id_custom);

        //Date format for database
        $format_1 = str_replace("/", "-", $request->tarikh_mula);
        $format_2 = str_replace("/", "-", $request->tarikh_tamat);

        $tarikh_mula = date('Y-m-d H:i:s', strtotime($format_1));
        $tarikh_tamat = date('Y-m-d H:i:s', strtotime($format_2));

        $pegawai = Pegawai::where('users_id', Auth::id())->first();
        $user = User::find(Auth::id());

        if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
            $program->negeri_pejabat       =   'semua';
            $program->daerah_pejabat       =   'semua';
        }
        else if ($user->tahap_pengguna == '4') {//pegawai negeri
            $program->negeri_pejabat       =   $pegawai->negeri_bertugas;
            $program->daerah_pejabat       =   'semua';
        }
        else if ($user->tahap_pengguna == '5') {//pegawai daerah
            $program->negeri_pejabat       =   $pegawai->negeri_bertugas;
            $program->daerah_pejabat       =   $pegawai->daerah_bertugas;
        }

        $program->user_id              =   $user->id;
        $program->kategori_id          =   $request->kategori;
        $program->custom_id            =   $custom_id;
        $program->nama                 =   $request->nama;
        $program->objektif             =   $request->objektif;
        $program->tarikh_mula          =   $tarikh_mula;
        $program->tarikh_tamat         =   $tarikh_tamat;
        $program->tempat               =   $request->tempat;
        $program->penganjur            =   $request->penganjur;
        $program->nama_pegawai         =   $request->nama_pegawai;
        $program->no_tel_dihubungi     =   $request->no_tel_dihubungi;
        $program->catatan              =   $request->catatan;
        $program->pautan_pengesahan    =   "tiada";
        $program->qr_pengesahan        =   "tiada";
        $program->pautan_perekodan     =   "tiada";
        $program->qr_perekodan         =   "tiada";
        $program->status               =   "BELUM SELESAI";
        $program->save();


        //PENGESAHAN
        // Generate the unique link with event ID
        $pautan_pengesahan = url('/pengurusan-program/klien/pengesahan-kehadiran', ['id' => $program->id]);

        // Generate the QR code for the event link
        $generate_qr_1 = QrCode::format('png')->size(300)->generate($pautan_pengesahan);


        // Save the QR code image to the public directory
        $filePath = public_path('qr_codes/qr_pengesahan_' . $program->id . '.png');
        file_put_contents($filePath, $generate_qr_1);

        $qr_pengesahan = 'qr_pengesahan_' . $program->id . '.png';

        //PEREKODAN
        $pautan_perekodan = url('/pengurusan-program/klien/daftar-kehadiran', ['id' => $program->id]);

        // Generate the QR code for the event link
        $generate_qr_2 = QrCode::format('png')->size(300)->generate($pautan_perekodan);

        // Save the QR code image to the public directory
        $filePath = public_path('qr_codes/qr_perekodan_' . $program->id . '.png');
        file_put_contents($filePath, $generate_qr_2);

        $qr_perekodan = 'qr_perekodan_' . $program->id . '.png';

        ///UPDATE
        $program->update([
            'pautan_pengesahan' =>  $pautan_pengesahan,
            'qr_pengesahan'     =>  $qr_pengesahan,
            'pautan_perekodan'  =>  $pautan_perekodan,
            'qr_perekodan'      =>  $qr_perekodan,
        ]);

        $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/" . $program->id;
        return redirect()->to($direct)->with('success', 'Aktiviti berjaya didaftar.');
    }

    public function kemaskiniProgPS($id)
    {
        $kategori = KategoriProgram::all();
        $program = Program::with('kategori')->find($id);
        if ($kategori || $program) {
            return view('pengurusan_program.pentadbir_sistem.kemaskini_prog', compact('kategori','program'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function postkemaskiniProgPS(Request $request,$id)
    {
        //Date format for database
        $format_1 = str_replace("/", "-", $request->tarikh_mula);
        $format_2 = str_replace("/", "-", $request->tarikh_tamat);

        $tarikh_mula = date('Y-m-d H:i:s', strtotime($format_1));
        $tarikh_tamat = date('Y-m-d H:i:s', strtotime($format_2));

        $program = Program::find($id);
        $program->update([
        'kategori_id'          =>   $request->kategori,
        'nama'                 =>   $request->nama,
        'objektif'             =>   $request->objektif,
        'tarikh_mula'          =>   $tarikh_mula,
        'tarikh_tamat'         =>   $tarikh_tamat,
        'tempat'               =>   $request->tempat,
        'penganjur'            =>   $request->penganjur,
        'nama_pegawai'         =>   $request->nama_pegawai,
        'no_tel_dihubungi'     =>   $request->no_tel_dihubungi,
        'catatan'              =>   $request->catatan,
        ]);

        $notif = "Aktiviti berjaya dikemaskini.";

        // Check hebahan
        if ($request->has('hebah_pindaan')) {

            $program->update([
                'status' => "PINDA",
            ]);

            if ($program->negeri_pejabat == "semua" && $program->daerah_pejabat == "semua") {
                $klien = Klien::all();
            }
            elseif ($program->negeri_pejabat != "semua" && $program->daerah_pejabat == "semua") {
                $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->get();
            }
            else {
                $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->where('daerah_pejabat',$program->negeri_pejabat)->get();
            }

            // Send communication based on the selected method
            foreach ($klien as $item) {
                if($item->emel != null){
                    $recipient = $item->emel;
                    Mail::to($recipient)->send(new HebahanPindaMail($id));
                }
            }

            $notif = "Aktiviti berjaya dikemaskini dan dihebahkan.";
        }
        $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/" . $program->id;
        return redirect()->to($direct)->with('success', $notif);
    }

    public function batalProgPS($id){

        $program = Program::find($id);
        $program->update([
            'status' => "BATAL",
        ]);

        if ($program->negeri_pejabat == "semua" && $program->daerah_pejabat == "semua") {
            $klien = Klien::all();
        }
        elseif ($program->negeri_pejabat != "semua" && $program->daerah_pejabat == "semua") {
            $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->get();
        }
        else {
            $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->where('daerah_pejabat',$program->negeri_pejabat)->get();
        }

        // Send communication based on the selected method
        foreach ($klien as $item) {
            if($item->emel != null){
                $recipient = $item->emel;
                Mail::to($recipient)->send(new HebahanBatalMail($id));
            }
        }

        $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/" . $program->id;
        return redirect()->to($direct)->with('success', 'Aktiviti berjaya dibatalkan.');
    }

    public function maklumatProgPS($id)
    {
        $program = Program::with('kategori')->find($id);
        $pengesahan = PengesahanKehadiranProgram::all();
        $hadir = $pengesahan->where('program_id',$id)->where('keputusan','HADIR')->count();
        $tdk_hadir = $pengesahan->where('program_id',$id)->where('keputusan','TIDAK HADIR')->count();
        $keseluruhan = $hadir + $tdk_hadir;
        if ($program) {
            return view('pengurusan_program.pentadbir_sistem.maklumat_prog', compact('program','hadir', 'tdk_hadir', 'keseluruhan'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function senaraiProgPS()
    {
        $user_id = Auth::id();
        return view('pengurusan_program.pentadbir_sistem.senarai_prog',compact('user_id'));
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

        return redirect()->back()->with('success', 'Kategori aktiviti berjaya ditambah.');
    }

    public function postKemaskiniKategoriPS(Request $request){
        $request->validate([
            'nama2'  =>  'required|string|max:255',
            'kod2'   =>  'required|string|max:255',
        ]);

        $id = $request->kat_id;

        $kategori = KategoriProgram::find($id);
        $kategori->update([
            'nama'   =>   $request->nama2,
            'kod'    =>   $request->kod2,
        ]);

        return redirect()->back()->with('success', 'Kategori aktiviti berjaya dikemaskini.');
    }

    public function padamKategoriPS($id){
        $kategori = KategoriProgram::find($id);

        if ($kategori) {
            $kategori->delete();
            return redirect()->back()->with('success2', 'Kategori aktiviti berjaya dipadam.');
        } else {
            return redirect()->back()->with('error2', 'Kategori aktiviti gagal dipadam.');
        }
    }

    //KLIEN
    public function daftarKehadiran($id) //perekodan
    {
        $program = Program::find($id);

        if ($program) {
            if ($program->status == 'SEDANG BERLANGSUNG'){
                return view('pengurusan_program.klien.daftar_kehadiran', compact('program'));
            }
            else{
                return view('pengurusan_program.klien.perekodan_tutup', compact('program'));
            }
        } else {
            return redirect()->back()->with('error', 'Program tidak wujud.');
        }
    }

    public function postDaftarKehadiran(Request $request, $id) //perekodan
    {
        $request->validate([
            'no_kp'  =>  'required'
        ]);

        $klien = Klien::where('no_kp', $request->no_kp)->first();
        $program = Program::where('id', $id)->first();
        if (is_null($klien)){
            return redirect()->back()->with('error', 'No Kad Pengenalan tidak sah.');
        }

        if (is_null($program)){
            return redirect()->back()->with('error', 'Program tidak wujud.');
        }

        $klien_id = $klien->id;
        $program_id = $program->id;

        $exists = PerekodanKehadiranProgram::where('program_id', $program_id)
            ->where('klien_id', $klien_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Kehadiran telah direkodkan sebelum ini.');
        }

        $tarikh_perekodan = Carbon::now();

        $perekodan = new PerekodanKehadiranProgram();
        $perekodan->program_id          =   $program_id;
        $perekodan->klien_id            =   $klien_id;
        $perekodan->tarikh_perekodan    =   $tarikh_perekodan;
        $perekodan->save();

        return view('pengurusan_program.klien.perekodan_berjaya', compact('program'));
    }

    public function postDaftarKehadiran2(Request $request, $id) //perekodan
    {
        $request->validate([
            'no_kp'  =>  'required|string|max:255'
        ]);

        $klien = Klien::where('no_kp', $request->no_kp)->first();
        $program = Program::where('id', $id)->first();

        if (is_null($klien)){
            return redirect()->back()->with('error2', 'No Kad Pengenalan tidak sah.');
        }

        if (is_null($program)){
            return redirect()->back()->with('error2', 'Program tidak wujud.');
        }

        $klien_id = $klien->id;
        $program_id = $program->id;

        $exists = PerekodanKehadiranProgram::where('program_id', $program_id)
            ->where('klien_id', $klien_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error2', 'Kehadiran telah direkodkan sebelum ini.');
        }

        $tarikh_perekodan = Carbon::now();

        $perekodan = new PerekodanKehadiranProgram();
        $perekodan->program_id          =   $program_id;
        $perekodan->klien_id            =   $klien_id;
        $perekodan->tarikh_perekodan    =   $tarikh_perekodan;
        $perekodan->save();
        return redirect()->back()->with('success2', 'Kehadiran berjaya direkodkan.');
    }

    public function pengesahanKehadiran($id)
    {
        $program = Program::find($id);

        if ($program) {
            if ($program->status == 'BELUM SELESAI'){
                return view('pengurusan_program.klien.pengesahan_kehadiran', compact('program'));
            }
            else{
                return view('pengurusan_program.klien.pengesahan_tutup', compact('program'));
            }
        } else {
            return redirect()->back()->with('error', 'Program tidak wujud.');
        }
    }

    public function postPengesahanKehadiran(Request $request, $id)
    {
        $request->validate([
            'no_kp'     =>  'required'
        ]);

        $klien = Klien::where('no_kp', $request->no_kp)->first();
        $program = Program::where('id', $id)->first();
        if (is_null($klien)){
            return redirect()->back()->with('error', 'No Kad Pengenalan tidak sah.');
        }

        if (is_null($program)){
            return redirect()->back()->with('error', 'Program tidak wujud.');
        }

        $klien_id = $klien->id;
        $program_id = $program->id;

        $exists = PengesahanKehadiranProgram::where('program_id', $program_id)
            ->where('klien_id', $klien_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Pengesahan telah dibuat sebelum ini.');
        }

        $tarikh_pengesahan = Carbon::now();

        $pengesahan = new PengesahanKehadiranProgram();
        $pengesahan->program_id             =   $program_id;
        $pengesahan->klien_id               =   $klien_id;
        $pengesahan->tarikh_pengesahan      =   $tarikh_pengesahan;
        $pengesahan->catatan                =   $request->catatan;
        $pengesahan->keputusan              =   $request->keputusan;
        $pengesahan->save();


        return view('pengurusan_program.klien.pengesahan_berjaya', compact('program'));
    }

    //HEBAHAN
    public function paparHebahan($id)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $program = Program::with('kategori')->find($id);

        if ($program) {
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $negeri = NegeriPejabat::all();
                return view('pengurusan_program.hebahan.papar_hebahan_semua', compact('program','negeri'));
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $negeri = Pegawai::where('users_id', $user_id)->first()->negeri_bertugas;
                return view('pengurusan_program.hebahan.papar_hebahan_negeri', compact('program','negeri'));
            }
            else if ($user->tahap_pengguna == '5') {//pegawai daerah
                $daerah = Pegawai::where('users_id', $user_id)->first()->daerah_bertugas;
                return view('pengurusan_program.hebahan.papar_hebahan_daerah', compact('program','daerah'));
            }
        }
        return redirect()->back()->with('error');
    }

    public function paparSms($id)
    {
        $negeri = NegeriPejabat::all();
        $program = Program::with('kategori')->find($id);
        if ($program) {
            return view('pengurusan_program.hebahan.papar_sms', compact('program','negeri'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function paparEmel($id)
    {
        $negeri = NegeriPejabat::all();
        $user_id = Auth::id();
        $user = User::find($user_id);
        $program = Program::with('kategori')->find($id);
        if ($program) {
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                return view('pengurusan_program.hebahan.papar_emel_semua', compact('program','negeri'));
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $negeri = Pegawai::where('users_id', $user_id)->first()->negeri_bertugas;
                return view('pengurusan_program.hebahan.papar_emel_negeri', compact('program','negeri'));
            }
            elseif ($user->tahap_pengguna == '5') {//pegawai daerah
                $daerah = Pegawai::where('users_id', $user_id)->first()->daerah_bertugas;
                return view('pengurusan_program.hebahan.papar_emel_daerah', compact('program','daerah'));
            }
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function paparTelegram($id)
    {
        $negeri = NegeriPejabat::all();
        $program = Program::with('kategori')->find($id);
        if ($program) {
            return view('pengurusan_program.hebahan.papar_telegram', compact('program','negeri'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function filterHebahan(Request $request)
    {
        $negeri_id = $request->input('negeri');
        $daerah_id = $request->input('daerah');

        $filter = Klien::where('negeri_pejabat',$negeri_id)->where('daerah_pejabat',$daerah_id)->whereNotNull('emel')->get();

        if ($filter) {
            return response()->json($filter);
        } else {
            return redirect()->back()->with('error', 'Negeri/daerah tidak dijumpai');
        }
    }
    public function jenisHebahan(Request $request, $id)
    {
        // Validate that the choices array is required and must have at least one selected value.
        $request->validate([
            'pilihan' => 'required|array|min:1',
            'pilihan.*' => 'exists:klien,id',
        ], [
            'pilihan.required' => 'You must select at least one choice.',
            'pilihan.min' => 'You must select at least one choice.',
        ]);

        $program = Program::with('kategori')->find($id);
        $kaedah = $request->input('kaedah');

        $klien = Klien::whereIn('id', $request->pilihan)->get();


        // Send communication based on the selected method
        foreach ($klien as $item) {
            if ($kaedah == 'sms') {

                $message = "Salam Sejahtera,\n\n" .
                    "Anda dijemput untuk menyertai program\n\n" .
                    "NAMA AKTIVITI: " . strtoupper($program->nama) . "\n" .
                    "TARIKH MULA: " . date('d/m/Y, h:iA', strtotime($program->tarikh_mula)) . "\n" .
                    "TARIKH TAMAT: " . date('d/m/Y, h:iA', strtotime($program->tarikh_tamat)) . "\n" .
                    "TEMPAT: " . strtoupper($program->tempat) . "\n\n" .
                    "Sila layari pautan berikut untuk pengesahan kehadiran program: " . $program->pautan_pengesahan;

                $this->sendSms($item->no_tel, $message);
            }
            elseif ($kaedah == 'emel') {
                if($item->emel != null){
                    $recipient = $item->emel;
                    Mail::to($recipient)->send(new HebahanMail($id));
                }
            }
            elseif ($kaedah == 'telegram') {
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
            }
        }

        $user_id = Auth::id();
        $user = User::find($user_id);

        if ($user->tahap_pengguna == '1') {//pentadbir
            $direct = "/pengurusan-program/pentadbir-sistem/senarai-prog/";
        }
        else if ($user->tahap_pengguna == '5' || $user->tahap_pengguna == '4' || $user->tahap_pengguna == '3') {//pegawai daerah, negeri, brpp
            $direct = "/pengurusan-program/pegawai-aadk/senarai-prog/";
        }

        return redirect()->to($direct)->with('success', 'Hebahan berjaya dihantar.');
    }
    public function jenisHebahan2(Request $request, $id)
    {
        // Validate that the choices array is required and must have at least one selected value.
        $request->validate([
            'pilihan' => 'required|array|min:1',
            'pilihan.*' => 'exists:klien,id',
        ], [
            'pilihan.required' => 'You must select at least one choice.',
            'pilihan.min' => 'You must select at least one choice.',
        ]);

        $program = Program::with('kategori')->find($id);
        $kaedah = $request->input('kaedah');

        $klien = Klien::whereIn('id', $request->pilihan)->get();


        // Send communication based on the selected method
        foreach ($klien as $item) {
            if ($kaedah == 'sms') {

                $message = "Salam Sejahtera,\n\n" .
                    "Anda dijemput untuk menyertai program\n\n" .
                    "NAMA AKTIVITI: " . strtoupper($program->nama) . "\n" .
                    "TARIKH MULA: " . date('d/m/Y, h:iA', strtotime($program->tarikh_mula)) . "\n" .
                    "TARIKH TAMAT: " . date('d/m/Y, h:iA', strtotime($program->tarikh_tamat)) . "\n" .
                    "TEMPAT: " . strtoupper($program->tempat) . "\n\n" .
                    "Sila layari pautan berikut untuk pengesahan kehadiran program: " . $program->pautan_pengesahan;

                $this->sendSms($item->no_tel, $message);
            }
            elseif ($kaedah == 'emel') {
                if($item->emel != null){
                    $recipient = $item->emel;
                    Mail::to($recipient)->send(new HebahanMail($id));
                }
            }
            elseif ($kaedah == 'telegram') {
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
            }
        }

        $user_id = Auth::id();
        $user = User::find($user_id);

        if ($user->tahap_pengguna == '1') {//pentadbir
            $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/".$id;
        }
        else if ($user->tahap_pengguna == '5'|| $user->tahap_pengguna == '4' || $user->tahap_pengguna == '3') {//pegawai daerah, negeri or pegawai brpp
            $direct = "/pengurusan-program/pegawai-aadk/maklumat-prog/".$id;
        }

        return redirect()->to($direct)->with('success', 'Hebahan berjaya dihantar.');
    }

    public function pdfPerekodan($id)
    {
        $perekodan = PerekodanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();
        $program = Program::with('kategori')->find($id);
        $data = ['title' => 'Senarai Pengesahan Kehadiran', 'perekodan' => $perekodan, 'program' => $program];
        $pdf = PDF::loadView('pengurusan_program.pdf_perekodan', $data)->setPaper('a4');

        $nama_pdf = 'senarai_perekodan_kehadiran_'.$program->custom_id.'.pdf';
        return $pdf->download($nama_pdf);
    }

    public function pdfPengesahan($id)
    {
        $program = Program::with('kategori')->find($id);

        // Fetch program and klien details using Eloquent relationships
        $pengesahan_data = PengesahanKehadiranProgram::with('program','klien')->where('program_id', $id)->get();

        // Initialize empty arrays for storing negeri and daerah values
        $pengesahan = [];

        // Loop through each pengesahan to fetch negeri and daerah
        foreach ($pengesahan_data as $item) {
            // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
            $negeri = NegeriPejabat::where('id', $item->klien->negeri_pejabat)->first();
            $daerah = DaerahPejabat::where('kod', $item->klien->daerah_pejabat)->first();

            // Add the negeri and daerah information to each pengesahan
            $pengesahan[] = [
                'klien' => $item->klien->nama,
                'no_kp' => $item->klien->no_kp,
                'alamat' => $item->klien->alamat_rumah,
                'no_tel' => $item->klien->no_tel ? $item->klien->no_tel : 'TIADA',
                'keputusan' => $item->keputusan,
                'negeri' => $negeri ? $negeri->negeri : 'TIADA',
                'daerah' => $daerah ? $daerah->daerah : 'TIADA',
                'catatan' => $item->catatan ? $item->catatan : 'TIADA',
            ];
        }

        $data = ['title' => 'Senarai Pengesahan Kehadiran', 'pengesahan' => $pengesahan, 'program' => $program];
        $pdf = PDF::loadView('pengurusan_program.pdf_pengesahan', $data)->setPaper('a4','landscape');

        $nama_pdf = 'senarai_maklum_balas_kehadiran_'.$program->custom_id.'.pdf';
        return $pdf->download($nama_pdf);
    }

    public function excelPengesahan($id)
    {
        $program = Program::with('kategori')->find($id);
        $pengesahan = PengesahanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();

        $nama_excel = 'senarai_maklum_balas_kehadiran_'.$program->custom_id.'.xlsx';
        return Excel::download(new PengesahanKehadiranExcel($program, $pengesahan), $nama_excel);
    }

    public function excelPerekodan($id)
    {
        $program = Program::with('kategori')->find($id);
        $perekodan = PerekodanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();
        $nama_excel = 'senarai_perekodan_kehadiran_'.$program->custom_id.'.xlsx';
        return Excel::download(new PerekodanKehadiranExcel($program, $perekodan), $nama_excel);
    }
}
