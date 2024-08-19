<?php

namespace App\Http\Controllers;
use App\Exports\PengesahanKehadiranExcel;
use App\Exports\PerekodanKehadiranExcel;
use App\Models\Daerah;
use App\Models\DaerahPejabat;
use App\Models\KategoriProgram;
use App\Models\Klien;
use App\Models\Negeri;
use App\Models\Pegawai;
use App\Models\PengesahanKehadiranProgram;
use App\Models\PerekodanKehadiranProgram;
use App\Models\User;
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
        phpinfo();
        return view('pengurusan_program.tryQR');
    }

    public function try()
    {
        $id =1;
        $program = Program::with('kategori')->find($id);
        if ($program) {
            return view('pengurusan_program.try', compact('program'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    //JSON
    public function klienSemua()//semua
    {
        $klien = Klien::all();
        return response()->json($klien);
    }

    public function klienNegeri($id)//negeri
    {
        $klien = Klien::where('negeri_pejabat',$id)->get();
        return response()->json($klien);
    }

    public function klienDaerah($id)//daerah
    {
        $klien = Klien::where('daerah_pejabat',$id)->get();
        return response()->json($klien);
    }

    public function kategori()
    {
        $kategori = KategoriProgram::all();
        return response()->json($kategori);
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
        $pengesahan = PengesahanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();
        return response()->json($pengesahan);
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
            return view('pengurusan_program.pegawai_aadk.daftar_prog', compact('kategori'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function postDaftarProgPA(Request $request)
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
        return redirect()->to($direct)->with('success', 'Program berjaya didaftar.');
    }

    public function kemaskiniProgPA($id)
    {
        $kategori = KategoriProgram::all();
        $program = Program::with('kategori')->find($id);
        if ($kategori || $program) {
            return view('pengurusan_program.pegawai_aadk.kemaskini_prog', compact('kategori','program'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function postkemaskiniProgPA(Request $request,$id)
    {
        $kategori = KategoriProgram::where('id', $request->kategori)->first()->kod;

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

        $direct = "/pengurusan-program/pegawai-aadk/maklumat-prog/" . $program->id;
        return redirect()->to($direct)->with('success', 'Program berjaya dikemaskini.');
    }

    public function padamProgPA($id){
        $program = Program::find($id);

        if ($program) {
            $program->delete();
            $direct = "/pengurusan-program/pegawai-aadk/senarai-prog/";
            return redirect()->to($direct)->with('success', 'Program berjaya dipadam.');
        } else {
            return redirect()->back()->with('error', 'Program gagal dipadam.');
        }
    }

    public function maklumatProgPA($id)
    {
        $program = Program::with('kategori')->find($id);
        $pengesahan = PengesahanKehadiranProgram::all();
        $hadir = $pengesahan->where('program_id',$id)->where('keputusan','HADIR')->count();
        $tdk_hadir = $pengesahan->where('program_id',$id)->where('keputusan','TIDAK HADIR')->count();
        $keseluruhan = $hadir + $tdk_hadir;
        if ($program) {
            return view('pengurusan_program.pegawai_aadk.maklumat_prog', compact('program','hadir', 'tdk_hadir', 'keseluruhan'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function senaraiProgPA()
    {
        $user_id = Auth::id();
        return view('pengurusan_program.pegawai_aadk.senarai_prog',compact('user_id'));
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

        return redirect()->back()->with('success', 'Kategori program berjaya ditambah.');
    }

    public function padamKategoriPA($id){
        $kategori = KategoriProgram::find($id);

        if ($kategori) {
            $kategori->delete();
            return redirect()->back()->with('success2', 'Kategori program berjaya dipadam.');
        } else {
            return redirect()->back()->with('error2', 'Kategori program gagal dipadam.');
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
        return redirect()->to($direct)->with('success', 'Program berjaya didaftar.');
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
        $kategori = KategoriProgram::where('id', $request->kategori)->first()->kod;

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

        $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/" . $program->id;
        return redirect()->to($direct)->with('success', 'Program berjaya dikemaskini.');
    }

    public function padamProgPS($id){
        $program = Program::find($id);

        if ($program) {
            $program->delete();
            $direct = "/pengurusan-program/pentadbir-sistem/senarai-prog/";
            return redirect()->to($direct)->with('success', 'Program berjaya dipadam.');
        } else {
            return redirect()->back()->with('error', 'Program gagal dipadam.');
        }
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

        return redirect()->back()->with('success', 'Kategori program berjaya ditambah.');
    }

    public function padamKategoriPS($id){
        $kategori = KategoriProgram::find($id);

        if ($kategori) {
            $kategori->delete();
            return redirect()->back()->with('success2', 'Kategori program berjaya dipadam.');
        } else {
            return redirect()->back()->with('error2', 'Kategori program gagal dipadam.');
        }
    }

    //KLIEN
    public function daftarKehadiran($id) //perekodan
    {
        $program = Program::find($id);

        if ($program) {
            return view('pengurusan_program.klien.daftar_kehadiran', compact('program'));
        } else {
            return redirect()->back()->with('error', 'Program tidak wujud.');
        }
    }

    public function postDaftarKehadiran(Request $request, $id) //perekodan
    {
        $request->validate([
            'no_kp'  =>  'required|string|max:255'
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
        return redirect()->back()->with('success', 'Kehadiran berjaya direkodkan.');
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
            return view('pengurusan_program.klien.pengesahan_kehadiran', compact('program'));
        } else {
            return redirect()->back()->with('error', 'Program tidak wujud.');
        }
    }

    public function postPengesahanKehadiran(Request $request, $id)
    {
        $request->validate([
            'no_kp'     =>  'required|string|max:255'
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


        return redirect()->back()->with('success', 'Berjaya dihantar.');
    }

    //HEBAHAN
    public function paparHebahan($id)
    {

        $user_id = Auth::id();
        $user = User::find($user_id);
        $program = Program::with('kategori')->find($id);

        if ($program) {
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $negeri = Negeri::all();
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
        $negeri = Negeri::all();
        $program = Program::with('kategori')->find($id);
        if ($program) {
            return view('pengurusan_program.hebahan.papar_sms', compact('program','negeri'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }

    public function paparEmel($id)
    {
        $negeri = Negeri::all();
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
        $negeri = Negeri::all();
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

        $filter = Klien::where('negeri_pejabat',$negeri_id)->where('daerah_pejabat',$daerah_id)->get();

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
                    "NAMA PROGRAM: " . strtoupper($program->nama) . "\n" .
                    "TARIKH MULA: " . date('d/m/Y, h:iA', strtotime($program->tarikh_mula)) . "\n" .
                    "TARIKH TAMAT: " . date('d/m/Y, h:iA', strtotime($program->tarikh_tamat)) . "\n" .
                    "TEMPAT: " . strtoupper($program->tempat) . "\n\n" .
                    "Sila layari pautan berikut untuk pengesahan kehadiran program: " . $program->pautan_pengesahan;

                $this->sendSms($item->no_tel, $message);
            }
            elseif ($kaedah == 'emel') {
                $recipient = $item->emel;
                Mail::to($recipient)->send(new HebahanMail($id));
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

        $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/".$id;
        return redirect()->to($direct)->with('success', 'Hebahan berjaya dihantar.');
    }

    //HEBAHAN - EMEL

    public function hebahanEmel(Request $request, $id) //pentadbir
    {
        // Validate that the choices array is required and must have at least one selected value.
        $request->validate([
            'pilihan' => 'required|array|min:1',
            'pilihan.*' => 'exists:klien,id',
        ], [
            'pilihan.required' => 'You must select at least one choice.',
            'pilihan.min' => 'You must select at least one choice.',
        ]);

        $klien = Klien::whereIn('id', $request->pilihan)->get();

        // Send communication based on the selected method
        foreach ($klien as $item) {
            $recipient = $item->emel;
            Mail::to($recipient)->send(new HebahanMail($id));
        }

        $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/".$id;
        return redirect()->to($direct)->with('success', 'Hebahan berjaya dihantar.');
    }

    public function hebahanEmel2(Request $request, $id) //pegawai
    {
        // Validate that the choices array is required and must have at least one selected value.
        $request->validate([
            'pilihan' => 'required|array|min:1',
            'pilihan.*' => 'exists:klien,id',
        ], [
            'pilihan.required' => 'You must select at least one choice.',
            'pilihan.min' => 'You must select at least one choice.',
        ]);

        $klien = Klien::whereIn('id', $request->pilihan)->get();

        // Send communication based on the selected method
        foreach ($klien as $item) {
            $recipient = $item->emel;
            Mail::to($recipient)->send(new HebahanMail($id));
        }

        $direct = "/pengurusan-program/pegawai-aadk/maklumat-prog/".$id;
        return redirect()->to($direct)->with('success', 'Hebahan berjaya dihantar.');
    }

    //HEBAHAN - SMS
    public function hebahanSMS(Request $request, $id)
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

        $klien = Klien::whereIn('id', $request->pilihan)->get();


        // Send communication based on the selected method
        foreach ($klien as $item) {
            $message = "Salam Sejahtera,\n\n" .
                "Anda dijemput untuk menyertai program\n\n" .
                "NAMA PROGRAM: " . strtoupper($program->nama) . "\n" .
                "TARIKH MULA: " . date('d/m/Y, h:iA', strtotime($program->tarikh_mula)) . "\n" .
                "TARIKH TAMAT: " . date('d/m/Y, h:iA', strtotime($program->tarikh_tamat)) . "\n" .
                "TEMPAT: " . strtoupper($program->tempat) . "\n\n" .
                "Sila layari pautan berikut untuk pengesahan kehadiran program: " . $program->pautan_pengesahan;

            return redirect("https://wa.me/{$item->no_tel}?text=try");
        }

        $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/".$id;
        return redirect()->to($direct)->with('success', 'Hebahan berjaya dihantar.');
    }


    //HEBAHAN - TELEGRAM
    public function hebahanTelegram(Request $request, $id)
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

        $klien = Klien::whereIn('id', $request->pilihan)->get();


        // Send communication based on the selected method
        foreach ($klien as $item) {
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

        $direct = "/pengurusan-program/pentadbir-sistem/maklumat-prog/".$id;
        return redirect()->to($direct)->with('success', 'Hebahan berjaya dihantar.');
    }

    public function handleWebhook(Request $request) //TELEGRAM
    {
        $telegram = new Api(env('7424416504:AAFBsucOUhWLVOaLXOWCvrr2AaC6_ZlaHrk'));
        $update = $telegram->getWebhookUpdates();

        $chatId = $update->getMessage()->getChat()->getId();
        $text = $update->getMessage()->getText();

        // Example handling logic
        $this->handleUserResponse($chatId, $text);

        return response('OK');
    }

    private function handleUserResponse($chatId, $text) //TELEGRAM
    {
        $telegram = new Api(env('7424416504:AAFBsucOUhWLVOaLXOWCvrr2AaC6_ZlaHrk'));

        // Fetch user data from database or create new
        $user = \DB::table('users')->where('chat_id', $chatId)->first();

        if (!$user) {
            // Start conversation
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Please select your country:',
                'reply_markup' => json_encode([
                    'keyboard' => [
                        ['Country1', 'Country2'],
                        ['Country3', 'Country4']
                    ],
                    'one_time_keyboard' => true
                ])
            ]);
            \DB::table('users')->insert([
                'chat_id' => $chatId,
                'state' => 'awaiting_country',
            ]);
        } elseif ($user->state === 'awaiting_country') {
            // Save country and ask for street
            \DB::table('users')->where('chat_id', $chatId)->update([
                'country' => $text,
                'state' => 'awaiting_street'
            ]);
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Please provide your street address:',
            ]);
        } elseif ($user->state === 'awaiting_street') {
            // Save street and complete
            \DB::table('users')->where('chat_id', $chatId)->update([
                'street' => $text,
                'state' => 'completed'
            ]);
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Thank you! Your information has been saved.',
            ]);
        }
    }

    public function pdfPerekodan($id)
    {
        $perekodan = PerekodanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();
        $program = Program::with('kategori')->find($id);
        $data = ['title' => 'Senarai Pengesahan Kehadiran', 'perekodan' => $perekodan, 'program' => $program];
        $pdf = PDF::loadView('pengurusan_program.pdf_perekodan', $data)->setPaper('a4');

        return $pdf->download('senarai_perekodan_kehadiran.pdf');
    }

    public function pdfPengesahan($id)
    {
        $pengesahan = PengesahanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();
        $program = Program::with('kategori')->find($id);
        $data = ['title' => 'Senarai Pengesahan Kehadiran', 'pengesahan' => $pengesahan, 'program' => $program];
        $pdf = PDF::loadView('pengurusan_program.pdf_pengesahan', $data)->setPaper('a4','landscape');

        return $pdf->download('senarai_perekodan_kehadiran.pdf');
    }

    public function excelPengesahan($id)
    {
        $program = Program::with('kategori')->find($id);
        $pengesahan = PengesahanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();

        return Excel::download(new PengesahanKehadiranExcel($program, $pengesahan), 'senarai_pengesahan_kehadiran.xlsx');
    }

    public function excelPerekodan($id)
    {
        $program = Program::with('kategori')->find($id);
        $perekodan = PerekodanKehadiranProgram::with('program','klien')->where('program_id',$id)->get();
        return Excel::download(new PerekodanKehadiranExcel($program, $perekodan), 'senarai_perekodan_kehadiran.xlsx');
    }
}
