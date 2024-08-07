<?php

namespace App\Http\Controllers;

use App\Models\KeluargaKlien;
use App\Models\KeputusanKepulihan;
use App\Models\PegawaiMohonDaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Klien;
use App\Models\PekerjaanKlien;
use App\Models\ResponDemografi;
use App\Models\ResponModalKepulihan;
use App\Models\User;
use App\Models\WarisKlien;
use Carbon\Carbon;

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

            // DASHBOARD KLIEN
            $klien = Klien::where('id', $klienId)->first();
            $pekerjaan = PekerjaanKlien::where('klien_id', $klienId)->first();
            $waris = WarisKlien::where('klien_id',$klienId)->first();
            $pasangan = KeluargaKlien::where('klien_id',$klienId)->first();

            $responDemografi = ResponDemografi::where('klien_id', $klienId)->orderBy('updated_at', 'desc')->get();
            $latestResponDemografi = ResponDemografi::where('klien_id', $klienId)->orderBy('updated_at', 'desc')->first();
            $keputusanKepulihan = KeputusanKepulihan::where('klien_id', $klienId)->orderBy('updated_at', 'desc')->get();
            $latestKeputusanKepulihan = KeputusanKepulihan::where('klien_id', $klienId)->orderBy('updated_at', 'desc')->first();
            
            // Retrieve the latest sesi from KeputusanKepulihan
            $latestSesi = $latestKeputusanKepulihan ? $latestKeputusanKepulihan->sesi : null;

            // Check record if not answered more than 6 month
            $sixMonthsAgo = Carbon::now()->subMonths(6);
            $tidakMenjawabKepulihan = ResponModalKepulihan::where('klien_id', $klienId)
                                    ->where('sesi', '=', $latestSesi)
                                    ->where('updated_at', '<=', $sixMonthsAgo)
                                    ->orderBy('updated_at', 'desc')
                                    ->exists();
            $tarikhTidakMenjawabKepulihan = $latestKeputusanKepulihan->updated_at->addMonths(6);

            // Check if there are any records in ResponModalKepulihan for a different sesi with any status not equal to 'Selesai'
            $incompletedDifferentSesi = ResponModalKepulihan::where('klien_id', $klienId)
                                        ->where('sesi', '!=', $latestSesi)
                                        ->where('status', '!=', 'Selesai')
                                        ->first();
            
            // Check if all statuses for the 25 questions in ResponModalKepulihan are 'Selesai' but the sesi is different
            $completedDifferentSesi = ResponModalKepulihan::where('klien_id', $klienId)
                                    ->where('sesi', '!=', $latestSesi)
                                    ->select('sesi')
                                    ->distinct()
                                    ->get()
                                    ->map(function ($record) use ($klienId) {
                                        $countTotal = ResponModalKepulihan::where('klien_id', $klienId)
                                                        ->where('sesi', $record->sesi)
                                                        ->count();
                                        $countSelesai = ResponModalKepulihan::where('klien_id', $klienId)
                                                        ->where('sesi', $record->sesi)
                                                        ->where('status', 'Selesai')
                                                        ->count();
                                        return $countTotal == $countSelesai;
                                    })
                                    ->contains(true);

            // Check if all statuses for the 25 questions in ResponModalKepulihan are 'Baharu' but the sesi is different
            $baharuDifferentSesi = ResponModalKepulihan::where('klien_id', $klienId)
                                    ->where('sesi', '!=', $latestSesi)
                                    ->select('sesi')
                                    ->distinct()
                                    ->get()
                                    ->map(function ($record) use ($klienId) {
                                        $countTotal = ResponModalKepulihan::where('klien_id', $klienId)
                                                        ->where('sesi', $record->sesi)
                                                        ->count();
                                        $countBaharu = ResponModalKepulihan::where('klien_id', $klienId)
                                                        ->where('sesi', $record->sesi)
                                                        ->where('status', 'Baharu')
                                                        ->count();
                                        return $countTotal == $countBaharu;
                                    })
                                    ->contains(true);

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
                    return view('dashboard.klien.dashboard', compact('klien','pekerjaan','waris','pasangan','responDemografi','latestResponDemografi','keputusanKepulihan','latestKeputusanKepulihan','incompletedDifferentSesi','completedDifferentSesi','baharuDifferentSesi','tidakMenjawabKepulihan','tarikhTidakMenjawabKepulihan'));
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
        dd('Step 1: Method reached'); // Check if method is called
    
        $clients = Klien::all();
        dd('Step 2: Clients retrieved', $clients); // Check if clients are retrieved

        $counts = [
            // users
            'permohonan_pendaftaran' => PegawaiMohonDaftar::where('status', 'Baharu')->count(),
            'pegawai' => User::where('tahap_pengguna', [3, 4, 5])->count(),
            'klien' => User::where('tahap_pengguna', 2)->count(),

            // profil klien
            'belum_kemaskini' => 0,
            'mohon_kemaskini' => 0,
            'dikemaskini' => 0,
            'ditolak' => 0,

            // modal kepulihan
            'selesai_menjawab' => ResponModalKepulihan::where('status', 'selesai')->count(),
            'belum_selesai_menjawab' => ResponModalKepulihan::where('status', 'belum_selesai')->count(),
            'tidak_menjawab' => ResponModalKepulihan::where('status', 'tidak_menjawab')->count(),
            'cemerlang' => KeputusanKepulihan::where('tahap_kepulihan_id', 4)->count(),
            'baik' => KeputusanKepulihan::where('tahap_kepulihan_id', 3)->count(),
            'memuaskan' => KeputusanKepulihan::where('tahap_kepulihan_id', 2)->count(),
            'tidak_memuaskan' => KeputusanKepulihan::where('tahap_kepulihan_id', 1)->count(),
        ];

        foreach ($clients as $client) {
            $keluargaStatus = KeluargaKlien::where('klien_id', $client->id)->pluck('status_kemaskini');
            $pekerjaanStatus = PekerjaanKlien::where('klien_id', $client->id)->pluck('status_kemaskini');
            $warisStatus = WarisKlien::where('klien_id', $client->id)->pluck('status_kemaskini');
    
            $statuses = array_merge([$client->status_kemaskini], $keluargaStatus->toArray(), $pekerjaanStatus->toArray(), $warisStatus->toArray());
    
            if (count(array_unique($statuses)) === 1) {
                if ($statuses[0] === 'Baharu') {
                    $counts['belum_kemaskini']++;
                } elseif ($statuses[0] === 'Lulus') {
                    $counts['dikemaskini']++;
                } elseif ($statuses[0] === 'Ditolak') {
                    $counts['ditolak']++;
                }
            } elseif (in_array('Kemaskini', $statuses)) {
                $counts['mohon_kemaskini']++;
            }
        }

        dd ($counts);

        return response()->json($counts);
    }

}
