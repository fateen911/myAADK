<?php

namespace App\Http\Controllers;

use App\Models\KeluargaKlien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Klien;
use App\Models\PekerjaanKlien;
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
}
