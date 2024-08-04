<?php

namespace App\Http\Controllers;

use App\Models\KeluargaKlien;
use App\Models\PegawaiMohonDaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Klien;
use App\Models\PekerjaanKlien;
use App\Models\ResponModalKepulihan;
use App\Models\User;
use App\Models\WarisKlien;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $tahap = Auth()->user()->tahap_pengguna;
            $status = Auth()->user()->status;

            // Retrieve the client's id based on their no_kp
            $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

            $klien = Klien::where('id', $klienId)->first();
            $pekerjaan = PekerjaanKlien::where('klien_id', $klienId)->first();
            $waris = WarisKlien::where('klien_id',$klienId)->first();
            $pasangan = KeluargaKlien::where('klien_id',$klienId)->first();

            if ($status == 0)
            {
                session()->flash('message', 'Sila kemaskini kata laluan anda terlebih dahulu.');
                return view('profile.update_password');
            }
            else
            {
                if($tahap == 1)
                    return view('dashboard.pentadbir.dashboard');
                else if($tahap == 2)
                    return view('dashboard.klien.dashboard', compact('klien','pekerjaan','waris','pasangan'));
                else if($tahap == 3)
                    return view('dashboard.pegawai.dashboard_brpp');
                else if($tahap == 4)
                    return view('dashboard.pegawai.dashboard_negeri');
                else if($tahap == 5)
                    return view('dashboard.pegawai.dashboard_daerah');
            }
        }
    }

    public function getStatusCounts()
    {
        $counts = [
            // users
            'permohonan_pendaftaran' => PegawaiMohonDaftar::where('status', 'Baharu')->count(),
            'pegawai' => User::where('tahap_pengguna', [3, 4, 5])->count(),
            'klien' => User::where('tahap_pengguna', 2)->count(),

            // profil klien
            'belum_kemaskini' => Klien::where('status', 'belum_kemaskini')->count(),
            'mohon_kemaskini' => Klien::where('status', 'mohon_kemaskini')->count(),
            'dikemaskini' => Klien::where('status', 'dikemaskini')->count(),
            'ditolak' => Klien::where('status', 'ditolak')->count(),

            // modal kepulihan
            'selesai_menjawab' => ResponModalKepulihan::where('status', 'selesai_menjawab')->count(),
            'belum_selesai_menjawab' => ResponModalKepulihan::where('status', 'belum_selesai_menjawab')->count(),
            'tidak_menjawab' => ResponModalKepulihan::where('status', 'tidak_menjawab')->count(),
            'cemerlang' => ResponModalKepulihan::where('tahap_kepulihan_id', 4)->count(),
            'baik' => ResponModalKepulihan::where('tahap_kepulihan_id', 3)->count(),
            'memuaskan' => ResponModalKepulihan::where('tahap_kepulihan_id', 2)->count(),
            'tidak_memuaskan' => ResponModalKepulihan::where('tahap_kepulihan_id', 1)->count(),
        ];

        return response()->json($counts);
    }

}
