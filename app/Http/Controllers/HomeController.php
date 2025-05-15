<?php

namespace App\Http\Controllers;

use App\Models\KeluargaKlien;
use App\Models\KeputusanKepulihan;
use App\Models\PegawaiMohonDaftar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Klien;
use App\Models\NotifikasiKlien;
use App\Models\NotifikasiPegawaiDaerah;
use App\Models\PekerjaanKlien;
use App\Models\ResponDemografi;
use App\Models\ResponModalKepulihan;
use App\Models\TahapKepulihan;
use App\Models\User;
use App\Models\WarisKlien;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $tahap = Auth::user()->tahap_pengguna;
            $status = Auth::user()->status;
            $pegawai = Auth::user();

            // Retrieve the client's id based on their no_kp
            $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

            $sixMonthsAgo = Carbon::now()->subMonths(6);

            if ($status == 0)
            {
                if($tahap == 2)
                {
                    $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
                    $unreadCount = 0;

                    $notifications = NotifikasiKlien::where('klien_id', $clientId)
                        ->orderBy('created_at', 'desc')
                        ->get();

                    $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
                    ->where('is_read', false)
                    ->count();

                    session()->flash('message', 'Sila kemaskini kata laluan anda terlebih dahulu.');
                    return view('profile.update_password', compact('unreadCount','notifications'));
                }
                if($tahap == 5)
                {
                    $pegawai = Auth::user();
                    $pegawaiDaerah = DB::table('pegawai')->where('users_id',$pegawai->id)->first();
                    $unreadCountPD = 0;

                    // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (for message1)
                    $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                                                                ->select('id', 'message1', 'created_at', 'is_read1')
                                                                ->get();

                    // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (for message2)
                    $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                                                                ->select('id', 'message2', 'created_at', 'is_read2')
                                                                ->get();
                                                                
                                            
                    // Combine and sort notifications by created_at descending
                    $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');
                    
                    // Correct unread count calculation for logged-in user's daerah_bertugas
                    $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) use ($pegawaiDaerah) {
                                        $query->where(function ($subQuery) use ($pegawaiDaerah) {
                                            $subQuery->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                                                ->where('is_read1', false);
                                        })->orWhere(function ($subQuery) use ($pegawaiDaerah) {
                                            $subQuery->where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                                                ->where('is_read2', false);
                                        });
                                    })->count();


                    session()->flash('message', 'Sila kemaskini kata laluan anda terlebih dahulu.');
                    return view('profile.update_password', compact('unreadCountPD','notifications'));
                }
                else{
                    session()->flash('message', 'Sila kemaskini kata laluan anda terlebih dahulu.');
                    return view('profile.update_password');
                }
            }
            else
            {
                if($tahap == 1)
                {
                    // users
                    $permohonan_pendaftaran = PegawaiMohonDaftar::where('status', 'Baharu')->count();
                    $pegawai = User::whereIn('tahap_pengguna', [3, 4, 5])->count();
                    $klien = User::where('tahap_pengguna', 2)->count();

                    // jumlah keseluruhan klien
                    $jumlah1 = Klien::all()->count();

                    // Count the number of clients who have updated their profile (Telah Kemaskini)
                    $telahKemaskini = DB::table('klien')
                                        ->join('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id')
                                        ->distinct('klien.id')
                                        ->count('klien.id');

                    // Count the number of clients who have never updated their profile (Belum Kemaskini)
                    $belumKemaskini = DB::table('klien')
                                        ->leftJoin('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id')
                                        ->whereNull('sejarah_profil_klien.klien_id')
                                        ->count('klien.id');
                    
                    // Count the number of clients in "Belum Selesai"
                    $belumSelesai = DB::table('klien')
                                    ->leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                    ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                    ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                    ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                    ->select('klien.id')
                                    ->where(function ($query) {
                                        $query->where('klien_update_requests.status', '=', 'Kemaskini')
                                            ->orWhere('pekerjaan_klien_update_requests.status', '=', 'Kemaskini')
                                            ->orWhere('keluarga_klien_update_requests.status', '=', 'Kemaskini')
                                            ->orWhere('waris_klien_update_requests.status', '=', 'Kemaskini');
                                    })
                                    ->distinct()
                                    ->count('klien.id');

                    // Find clients with status Kemaskini
                    $clientsWithKemaskini = DB::table('klien')
                                            ->leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                            ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                            ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                            ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                            ->where(function ($query) {
                                                $query->where('klien_update_requests.status', 'Kemaskini')
                                                    ->orWhere('pekerjaan_klien_update_requests.status', 'Kemaskini')
                                                    ->orWhere('keluarga_klien_update_requests.status', 'Kemaskini')
                                                    ->orWhere('waris_klien_update_requests.status', 'Kemaskini');
                                            })
                                            ->distinct()
                                            ->pluck('klien.id');

                    // Count clients who are not in the above list and meet the criteria for being 'selesai'
                    $selesai = DB::table('klien')
                                    ->whereNotIn('klien.id', $clientsWithKemaskini) // Exclude clients with 'Kemaskini'
                                    ->where(function ($query) {
                                        $query->whereIn('klien.id', function ($subQuery) {
                                            $subQuery->select('klien_id')
                                                ->from('klien_update_requests')
                                                ->whereIn('status', ['Lulus', 'Ditolak'])
                                                ->unionAll(
                                                    DB::table('pekerjaan_klien_update_requests')
                                                        ->select('klien_id')
                                                        ->whereIn('status', ['Lulus', 'Ditolak'])
                                                )
                                                ->unionAll(
                                                    DB::table('keluarga_klien_update_requests')
                                                        ->select('klien_id')
                                                        ->whereIn('status', ['Lulus', 'Ditolak'])
                                                )
                                                ->unionAll(
                                                    DB::table('waris_klien_update_requests')
                                                        ->select('klien_id')
                                                        ->whereIn('status', ['Lulus', 'Ditolak'])
                                                );
                                        });
                                    })
                                    ->distinct()
                                    ->count('klien.id');

                    $jumlah2 = $belumSelesai + $selesai;
        
                    // modal kepulihan
                    $responses = DB::table('keputusan_kepulihan_klien as kk')
                                    ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                                    ->select(
                                        'u.id as klien_id',
                                        'u.nama',
                                        'u.no_kp',
                                        'u.daerah',
                                        'u.negeri',
                                        DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
                                        'kk.tahap_kepulihan_id',
                                        'kk.updated_at',
                                        'kk.status' // Assuming there is a status column
                                    )
                                    ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                    ->whereIn('kk.updated_at', function ($query) {
                                        $query->select(DB::raw('MAX(updated_at)'))
                                            ->from('keputusan_kepulihan_klien')
                                            ->whereColumn('klien_id', 'kk.klien_id')
                                            ->groupBy('klien_id');
                                    })
                                    ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah', 'u.negeri', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
                                    ->get();

                    $selesai_menjawab = $responses->filter(function ($response) {
                                            return ($response->status == 'Selesai');
                                        })->count();

                    $belum_selesai_menjawab = $responses->filter(function ($response) {
                                                return ($response->status == 'Belum Selesai');;
                                            })->count();

                    $tidak_menjawab_lebih_6bulan = DB::table('klien as u')
                                                    ->join('keputusan_kepulihan_klien as kk', function($join) {
                                                        $join->on('u.id', '=', 'kk.klien_id')
                                                            ->whereRaw('kk.updated_at = (SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)');
                                                    })
                                                    ->where('kk.updated_at', '<=', now()->subMonths(6)) // Latest record is more than 6 months old
                                                    ->count();

                    $tidak_pernah_menjawab = DB::table('klien as u')
                                            ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                                            ->whereNull('kk.klien_id') // No records in keputusan_kepulihan_klien
                                            ->count();

                    // Count tahap kepulihan
                    $latestTahapKepulihan = DB::table('keputusan_kepulihan_klien as kk')
                                                ->select('kk.klien_id', 'kk.tahap_kepulihan_id')
                                                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                                ->whereIn('kk.updated_at', function ($query) {
                                                    $query->select(DB::raw('MAX(updated_at)'))
                                                        ->from('keputusan_kepulihan_klien')
                                                        ->whereColumn('klien_id', 'kk.klien_id')
                                                        ->groupBy('klien_id');
                                                })
                                                ->get();

                    // Count the number of clients in each tahap kepulihan
                    $cemerlang = $latestTahapKepulihan->where('tahap_kepulihan_id', 4)->count();
                    $baik = $latestTahapKepulihan->where('tahap_kepulihan_id', 3)->count();
                    $memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 2)->count();
                    $tidak_memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 1)->count();

                    // Get name of tahap kepulihan
                    $tahap1 = TahapKepulihan::where('id', 1)->value('tahap');
                    $tahap2 = TahapKepulihan::where('id', 2)->value('tahap');
                    $tahap3 = TahapKepulihan::where('id', 3)->value('tahap');
                    $tahap4 = TahapKepulihan::where('id', 4)->value('tahap');

                    return view('dashboard.pentadbir.dashboard', compact('permohonan_pendaftaran','pegawai','klien',
                                                                        'belum_selesai_menjawab','selesai_menjawab','tidak_menjawab_lebih_6bulan','tidak_pernah_menjawab',
                                                                        'tidak_memuaskan','memuaskan','baik','cemerlang',
                                                                        'tahap1', 'tahap2', 'tahap3', 'tahap4',
                                                                        'belumKemaskini', 'telahKemaskini', 'jumlah1', 'jumlah2', 'belumSelesai', 'selesai'));
                }
                else if($tahap == 2)
                {
                    // DASHBOARD KLIEN
                    $klien = Klien::where('id', $klienId)->first();
                    $pekerjaan = PekerjaanKlien::where('klien_id', $klienId)->first();
                    $waris = WarisKlien::where('klien_id',$klienId)->first();
                    $pasangan = KeluargaKlien::where('klien_id',$klienId)->first();

                    // Ensure $unreadCount is initialized
                    $unreadCount = 0; 

                    $responDemografi = ResponDemografi::where('klien_id', $klienId)->orderBy('updated_at', 'desc')->get();
                    $latestResponDemografi = ResponDemografi::where('klien_id', $klienId)->orderBy('updated_at', 'desc')->first();
                    $keputusanKepulihan = KeputusanKepulihan::where('klien_id', $klienId)->orderBy('updated_at', 'desc')->get();
                    $latestKeputusanKepulihan = KeputusanKepulihan::where('klien_id', $klienId)->orderBy('updated_at', 'desc')->first();
                    
                    // Retrieve the latest sesi from KeputusanKepulihan
                    $latestSesi = $latestKeputusanKepulihan ? $latestKeputusanKepulihan->sesi : null;

                    // Check record if not answered more than 6 month
                    $sixMonthsAgo = Carbon::now()->subMonths(6);
                    $tidakMenjawabKepulihan = false;

                    if ($latestSesi) 
                    {
                        $tidakMenjawabKepulihan = ResponModalKepulihan::where('klien_id', $klienId)
                                                ->where('sesi', '=', $latestSesi)
                                                ->where('updated_at', '<=', $sixMonthsAgo)
                                                ->orderBy('updated_at', 'desc')
                                                ->exists();
                    }

                    // Handle the case where no KeputusanKepulihan record exists
                    $tarikhTidakMenjawabKepulihan = $latestKeputusanKepulihan ? $latestKeputusanKepulihan->updated_at->addMonths(6) : null;

                    $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

                    // Fetch notifications for the client
                    $notifications = NotifikasiKlien::where('klien_id', $clientId)
                        ->orderBy('created_at', 'desc')
                        ->get();

                    // Ensure $unreadCount is defined even when there are no notifications
                    $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
                    ->where('is_read', false)
                    ->count();

                    return view('dashboard.klien.dashboard', compact('klien','pekerjaan','waris','pasangan',
                                                                                'responDemografi','latestResponDemografi','keputusanKepulihan','latestKeputusanKepulihan','tidakMenjawabKepulihan','tarikhTidakMenjawabKepulihan',
                                                                                'unreadCount','notifications'));
                }
                else if($tahap == 3)
                {
                    // Jumlah keseluruhan klien
                    $jumlah1 = Klien::all()->count();

                    // Count the number of clients who have updated their profile (Sedang Kemaskini)
                    $sedangKemaskini = DB::table('klien')
                                        ->join('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id')
                                        ->distinct('klien.id')
                                        ->count('klien.id');
                
                    // Count the number of clients who have never updated their profile (Belum Kemaskini)
                    $belumKemaskini = DB::table('klien')
                                        ->leftJoin('sejarah_profil_klien', 'klien.id', '=', 'sejarah_profil_klien.klien_id')
                                        ->whereNull('sejarah_profil_klien.klien_id')
                                        ->count('klien.id');
                    
                    // Count the number of clients in "Belum Selesai"
                    $belumSelesai = DB::table('klien')
                                        ->leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                        ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                        ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                        ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                        ->select('klien.id')
                                        ->where(function ($query) {
                                            $query->where('klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('pekerjaan_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('keluarga_klien_update_requests.status', '=', 'Kemaskini')
                                                ->orWhere('waris_klien_update_requests.status', '=', 'Kemaskini');
                                        })
                                        ->distinct()
                                        ->count('klien.id');

                    // Find clients with status Kemaskini
                    $clientsWithKemaskini = DB::table('klien')
                                                ->leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                                ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                                ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                                ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                                ->where(function ($query) {
                                                    $query->where('klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('pekerjaan_klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('keluarga_klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('waris_klien_update_requests.status', 'Kemaskini');
                                                })
                                                ->distinct()
                                                ->pluck('klien.id');

                    // Count clients who are not in the above list and meet the criteria for being 'selesai'
                    $selesai = DB::table('klien')
                                    ->whereNotIn('klien.id', $clientsWithKemaskini) // Exclude clients with 'Kemaskini'
                                    ->where(function ($query) {
                                        $query->whereIn('klien.id', function ($subQuery) {
                                            $subQuery->select('klien_id')
                                                ->from('klien_update_requests')
                                                ->whereIn('status', ['Lulus', 'Ditolak'])
                                                ->unionAll(
                                                    DB::table('pekerjaan_klien_update_requests')
                                                        ->select('klien_id')
                                                        ->whereIn('status', ['Lulus', 'Ditolak'])
                                                )
                                                ->unionAll(
                                                    DB::table('keluarga_klien_update_requests')
                                                        ->select('klien_id')
                                                        ->whereIn('status', ['Lulus', 'Ditolak'])
                                                )
                                                ->unionAll(
                                                    DB::table('waris_klien_update_requests')
                                                        ->select('klien_id')
                                                        ->whereIn('status', ['Lulus', 'Ditolak'])
                                                );
                                        });
                                    })
                                    ->distinct()
                                    ->count('klien.id');

                    $jumlah2 = $belumSelesai + $selesai;

                    // modal kepulihan
                    $responses = DB::table('keputusan_kepulihan_klien as kk')
                                    ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                                    ->select(
                                        'u.id as klien_id',
                                        'u.nama',
                                        'u.no_kp',
                                        'u.daerah',
                                        'u.negeri',
                                        DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
                                        'kk.tahap_kepulihan_id',
                                        'kk.updated_at',
                                        'kk.status' // Assuming there is a status column
                                    )
                                    ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                    ->whereIn('kk.updated_at', function ($query) {
                                        $query->select(DB::raw('MAX(updated_at)'))
                                            ->from('keputusan_kepulihan_klien')
                                            ->whereColumn('klien_id', 'kk.klien_id')
                                            ->groupBy('klien_id');
                                    })
                                    ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah', 'u.negeri', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
                                    ->get();

                    // Count the number of "Selesai" and "Tidak Selesai"
                    $selesai_menjawab = $responses->filter(function ($response) {
                        return ($response->status == 'Selesai');
                    })->count();

                    $belum_selesai_menjawab = $responses->filter(function ($response) {
                        return ($response->status == 'Belum Selesai');;
                    })->count();

                    $tidak_menjawab_lebih_6bulan = DB::table('klien as u')
                                                    ->join('keputusan_kepulihan_klien as kk', function($join) {
                                                        $join->on('u.id', '=', 'kk.klien_id')
                                                            ->whereRaw('kk.updated_at = (SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)');
                                                    })
                                                    ->where('kk.updated_at', '<=', now()->subMonths(6)) // Latest record is more than 6 months old
                                                    ->count();

                    $tidak_pernah_menjawab = DB::table('klien as u')
                                            ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                                            ->whereNull('kk.klien_id') // No records in keputusan_kepulihan_klien
                                            ->count();

                    // Count tahap kepulihan
                    $latestTahapKepulihan = DB::table('keputusan_kepulihan_klien as kk')
                                                ->select('kk.klien_id', 'kk.tahap_kepulihan_id')
                                                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                                ->whereIn('kk.updated_at', function ($query) {
                                                    $query->select(DB::raw('MAX(updated_at)'))
                                                        ->from('keputusan_kepulihan_klien')
                                                        ->whereColumn('klien_id', 'kk.klien_id')
                                                        ->groupBy('klien_id');
                                                })
                                                ->get();

                    // Count the number of clients in each tahap kepulihan
                    $cemerlang = $latestTahapKepulihan->where('tahap_kepulihan_id', 4)->count();
                    $baik = $latestTahapKepulihan->where('tahap_kepulihan_id', 3)->count();
                    $memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 2)->count();
                    $tidak_memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 1)->count();

                    // Get name of tahap kepulihan
                    $tahap1 = TahapKepulihan::where('id', 1)->value('tahap');
                    $tahap2 = TahapKepulihan::where('id', 2)->value('tahap');
                    $tahap3 = TahapKepulihan::where('id', 3)->value('tahap');
                    $tahap4 = TahapKepulihan::where('id', 4)->value('tahap');

                    return view('dashboard.pegawai.dashboard_brpp', compact('belumKemaskini', 'sedangKemaskini', 'jumlah1', 'jumlah2', 'belumSelesai', 'selesai',
                                                                            'belum_selesai_menjawab','selesai_menjawab','tidak_menjawab_lebih_6bulan','tidak_pernah_menjawab',
                                                                            'tidak_memuaskan','memuaskan','baik','cemerlang',
                                                                            'tahap1', 'tahap2', 'tahap3', 'tahap4'));
                }
                else if($tahap == 4)
                {
                    // Fetch pegawai (user) info
                    $pegawaiNegeri = DB::table('pegawai')->where('users_id',$pegawai->id)->first();

                    // Filter clients based on daerah_bertugas and negeri_bertugas
                    $clients = DB::table('klien')->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)->get();

                    // Count profile update statuses
                    $sedangKemaskiniNegeri = $clients->filter(function ($client) {
                                                return DB::table('sejarah_profil_klien')
                                                    ->where('klien_id', $client->id)
                                                    ->exists();
                                            })->count();

                    $belumKemaskiniNegeri = $clients->filter(function ($client) {
                                                return !DB::table('sejarah_profil_klien')
                                                    ->where('klien_id', $client->id)
                                                    ->exists();
                                            })->count();

                    $jumlahKlienNegeri = $sedangKemaskiniNegeri + $belumKemaskiniNegeri;

                    // Count the number of clients in "Belum Selesai"
                    // A client is "Belum Selesai" if at least one of the statuses in the 4 tables is "Kemaskini"
                    $belumSelesaiNegeri = DB::table('klien')
                                            ->leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                            ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                            ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                            ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                            ->select('klien.id')
                                            ->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                            ->where(function ($query) {
                                                $query->where('klien_update_requests.status', '=', 'Kemaskini')
                                                    ->orWhere('pekerjaan_klien_update_requests.status', '=', 'Kemaskini')
                                                    ->orWhere('keluarga_klien_update_requests.status', '=', 'Kemaskini')
                                                    ->orWhere('waris_klien_update_requests.status', '=', 'Kemaskini');
                                            })
                                            ->distinct()
                                            ->count('klien.id');

                    // Find id clients with status Kemaskini
                    $clientsWithKemaskini = DB::table('klien')
                                                ->leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                                ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                                ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                                ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                                ->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                                ->where(function ($query) {
                                                    $query->where('klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('pekerjaan_klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('keluarga_klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('waris_klien_update_requests.status', 'Kemaskini');
                                                })
                                                ->distinct()
                                                ->pluck('klien.id');

                    // A client is "Selesai" only if all statuses in the 4 tables are either "Lulus" or "Ditolak"
                    // Count clients who are not in the above list and meet the criteria for being 'selesai'
                    $selesaiNegeri = DB::table('klien')
                                        ->whereNotIn('klien.id', $clientsWithKemaskini) // Exclude clients with 'Kemaskini'
                                        ->where('klien.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                        ->where(function ($query) {
                                            $query->whereIn('klien.id', function ($subQuery) {
                                                $subQuery->select('klien_id')
                                                    ->from('klien_update_requests')
                                                    ->whereIn('status', ['Lulus', 'Ditolak'])
                                                    ->unionAll(
                                                        DB::table('pekerjaan_klien_update_requests')
                                                            ->select('klien_id')
                                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                                    )
                                                    ->unionAll(
                                                        DB::table('keluarga_klien_update_requests')
                                                            ->select('klien_id')
                                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                                    )
                                                    ->unionAll(
                                                        DB::table('waris_klien_update_requests')
                                                            ->select('klien_id')
                                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                                    );
                                            });
                                        })
                                        ->distinct()
                                        ->count('klien.id');

                    $jumlahPermohonanNegeri = $belumSelesaiNegeri + $selesaiNegeri;

                    // Count kepulihan statuses
                    $responses = DB::table('keputusan_kepulihan_klien as kk')
                        ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                        ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                        ->get();

                    // Start building the query for status modal kepulihan
                    $query = DB::table('keputusan_kepulihan_klien as kk')
                            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                            ->select(
                                'u.id as klien_id',
                                'u.nama',
                                'u.no_kp',
                                'u.daerah',
                                'u.negeri',
                                DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
                                'kk.tahap_kepulihan_id',
                                'kk.updated_at',
                                'kk.status' // Assuming there is a status column
                            )
                            ->where('kk.updated_at', '>=', $sixMonthsAgo)
                            ->whereIn('kk.updated_at', function ($query) {
                                $query->select(DB::raw('MAX(updated_at)'))
                                    ->from('keputusan_kepulihan_klien')
                                    ->whereColumn('klien_id', 'kk.klien_id')
                                    ->groupBy('klien_id');
                            })
                            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah', 'u.negeri', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status');

                    // Filter by negeri_bertugas for tahap 4 (pegawai negeri)
                    $query->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas);

                    // Execute the query and get the results
                    $responses = $query->get();

                    // Count the number of "Selesai" and "Tidak Selesai"
                    $selesai_menjawab_negeri = $responses->filter(function ($response) {
                        return ($response->status == 'Selesai');
                    })->count();

                    $belum_selesai_menjawab_negeri = $responses->filter(function ($response) {
                        return ($response->status == 'Belum Selesai');
                    })->count();

                    // Count clients who didn't answer
                    $tidak_menjawab_lebih_6bulan = DB::table('klien as u')
                                                    ->join('keputusan_kepulihan_klien as kk', function($join) {
                                                        $join->on('u.id', '=', 'kk.klien_id')
                                                            ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
                                                    })
                                                    ->where('kk.updated_at', '<=', $sixMonthsAgo); // Latest record is more than 6 months old

                    $tidak_pernah_menjawab = DB::table('klien as u')
                                            ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                                            ->whereNull('kk.klien_id'); // No records in keputusan_kepulihan_klien

                    $tidak_pernah_menjawab_negeri = $tidak_pernah_menjawab->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)->count();
                    $tidak_menjawab_lebih_6bulan_negeri = $tidak_menjawab_lebih_6bulan->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)->count();

                    // Count tahap kepulihan
                    $latestTahapKepulihan = DB::table('keputusan_kepulihan_klien as kk')
                                                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                                                ->select('kk.klien_id', 'kk.tahap_kepulihan_id')
                                                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                                ->whereIn('kk.updated_at', function ($query) {
                                                    $query->select(DB::raw('MAX(updated_at)'))
                                                        ->from('keputusan_kepulihan_klien')
                                                        ->whereColumn('klien_id', 'kk.klien_id')
                                                        ->groupBy('klien_id');
                                                });

                    $latestTahapKepulihan = $latestTahapKepulihan->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)->get();

                    // Count the number of clients in each tahap kepulihan
                    $cemerlang = $latestTahapKepulihan->where('tahap_kepulihan_id', 4)->count();
                    $baik = $latestTahapKepulihan->where('tahap_kepulihan_id', 3)->count();
                    $memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 2)->count();
                    $tidak_memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 1)->count();

                    // Get name of tahap kepulihan
                    $tahap1 = TahapKepulihan::where('id', 1)->value('tahap');
                    $tahap2 = TahapKepulihan::where('id', 2)->value('tahap');
                    $tahap3 = TahapKepulihan::where('id', 3)->value('tahap');
                    $tahap4 = TahapKepulihan::where('id', 4)->value('tahap');

                    return view('dashboard.pegawai.dashboard_negeri',compact('sedangKemaskiniNegeri','belumKemaskiniNegeri', 'jumlahKlienNegeri', 'jumlahPermohonanNegeri', 'selesaiNegeri', 'belumSelesaiNegeri',
                                                                                            'selesai_menjawab_negeri','belum_selesai_menjawab_negeri','tidak_menjawab_lebih_6bulan_negeri','tidak_pernah_menjawab_negeri',
                                                                                            'cemerlang', 'baik', 'memuaskan', 'tidak_memuaskan', 'tahap1', 'tahap2', 'tahap3', 'tahap4'));
                }
                else if($tahap == 5)
                {
                    $pegawai = Auth::user();
                    $pegawaiDaerah = DB::table('pegawai')->where('users_id',$pegawai->id)->first();
                    $unreadCountPD = 0;

                    // Filter clients based on daerah_bertugas and negeri_bertugas
                    $clients = DB::table('klien')
                                ->where('negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                ->where('daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                ->get();

                    $telahKemaskiniDaerah = $clients->filter(function ($client) {
                                                return DB::table('sejarah_profil_klien')
                                                    ->where('klien_id', $client->id)
                                                    ->exists();
                                            })->count();

                    $belumKemaskiniDaerah = $clients->filter(function ($client) {
                                                return !DB::table('sejarah_profil_klien')
                                                    ->where('klien_id', $client->id)
                                                    ->exists();
                                            })->count();

                    $jumlahKlienDaerah = $telahKemaskiniDaerah + $belumKemaskiniDaerah;
                    
                    // Count the number of clients in "Belum Selesai"
                    // A client is "Belum Selesai" if at least one of the statuses in the 4 tables is "Kemaskini"
                    $belumSelesaiDaerah = DB::table('klien')
                                            ->leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                            ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                            ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                            ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                            ->select('klien.id')
                                            ->where('klien.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                            ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                            ->where(function ($query) {
                                                $query->where('klien_update_requests.status', '=', 'Kemaskini')
                                                    ->orWhere('pekerjaan_klien_update_requests.status', '=', 'Kemaskini')
                                                    ->orWhere('keluarga_klien_update_requests.status', '=', 'Kemaskini')
                                                    ->orWhere('waris_klien_update_requests.status', '=', 'Kemaskini');
                                            })
                                            ->distinct()
                                            ->count('klien.id');

                    // Count the number of clients in "Selesai"
                    // Find clients with status Kemaskini
                    $clientsWithKemaskini = DB::table('klien')
                                                ->where('klien.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                                ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                                ->leftJoin('klien_update_requests', 'klien.id', '=', 'klien_update_requests.klien_id')
                                                ->leftJoin('pekerjaan_klien_update_requests', 'klien.id', '=', 'pekerjaan_klien_update_requests.klien_id')
                                                ->leftJoin('keluarga_klien_update_requests', 'klien.id', '=', 'keluarga_klien_update_requests.klien_id')
                                                ->leftJoin('waris_klien_update_requests', 'klien.id', '=', 'waris_klien_update_requests.klien_id')
                                                ->where(function ($query) {
                                                    $query->where('klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('pekerjaan_klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('keluarga_klien_update_requests.status', 'Kemaskini')
                                                        ->orWhere('waris_klien_update_requests.status', 'Kemaskini');
                                                })
                                                ->distinct()
                                                ->pluck('klien.id');

                    // Count clients who are not in the above list and meet the criteria for being 'selesai'
                    $selesaiDaerah = DB::table('klien')
                                        ->whereNotIn('klien.id', $clientsWithKemaskini) // Exclude clients with 'Kemaskini'
                                        ->where('klien.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                        ->where('klien.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                        ->where(function ($query) {
                                            $query->whereIn('klien.id', function ($subQuery) {
                                                $subQuery->select('klien_id')
                                                    ->from('klien_update_requests')
                                                    ->whereIn('status', ['Lulus', 'Ditolak'])
                                                    ->unionAll(
                                                        DB::table('pekerjaan_klien_update_requests')
                                                            ->select('klien_id')
                                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                                    )
                                                    ->unionAll(
                                                        DB::table('keluarga_klien_update_requests')
                                                            ->select('klien_id')
                                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                                    )
                                                    ->unionAll(
                                                        DB::table('waris_klien_update_requests')
                                                            ->select('klien_id')
                                                            ->whereIn('status', ['Lulus', 'Ditolak'])
                                                    );
                                            });
                                        })
                                        ->distinct()
                                        ->count('klien.id');
                                        
                    $jumlahPermohonanDaerah = $belumSelesaiDaerah + $selesaiDaerah;

                    // Start building the query for Keputusan Kepulihan
                    $query = DB::table('keputusan_kepulihan_klien as kk')
                                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                                ->select(
                                    'u.id as klien_id',
                                    'u.nama',
                                    'u.no_kp',
                                    'u.daerah',
                                    'u.negeri',
                                    DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
                                    'kk.tahap_kepulihan_id',
                                    'kk.updated_at',
                                    'kk.status' // Assuming there is a status column
                                )
                                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                ->whereIn('kk.updated_at', function ($query) {
                                    $query->select(DB::raw('MAX(updated_at)'))
                                        ->from('keputusan_kepulihan_klien')
                                        ->whereColumn('klien_id', 'kk.klien_id')
                                        ->groupBy('klien_id');
                                })
                                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah', 'u.negeri', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status');

                    // Filter by daerah_bertugas and negeri_bertugas for tahap 5 (pegawai daerah)
                    $query->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas);

                    // Execute the query and get the results
                    $responses = $query->get();

                    // Count the number of "Selesai" and "Tidak Selesai"
                    $selesai_menjawab_daerah = $responses->filter(function ($response) {
                                                    return ($response->status == 'Selesai');
                                                })->count();

                    $belum_selesai_menjawab_daerah = $responses->filter(function ($response) {
                                                        return ($response->status == 'Belum Selesai');
                                                    })->count();

                    // Count clients who didn't answer
                    $tidak_menjawab_lebih_6bulan = DB::table('klien as u')
                                                    ->join('keputusan_kepulihan_klien as kk', function($join) {
                                                        $join->on('u.id', '=', 'kk.klien_id')
                                                            ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
                                                    })
                                                    ->where('kk.updated_at', '<=', $sixMonthsAgo); // Latest record is more than 6 months old

                    $tidak_pernah_menjawab = DB::table('klien as u')
                                            ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                                            ->whereNull('kk.klien_id'); // No records in keputusan_kepulihan_klien

                    $tidak_pernah_menjawab_daerah = $tidak_pernah_menjawab->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)->count();
                    $tidak_menjawab_lebih_6bulan_daerah = $tidak_menjawab_lebih_6bulan->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)->count();

                    // Count tahap kepulihan
                    $latestTahapKepulihan = DB::table('keputusan_kepulihan_klien as kk')
                                                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                                                ->select('kk.klien_id', 'kk.tahap_kepulihan_id')
                                                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                                ->whereIn('kk.updated_at', function ($query) {
                                                    $query->select(DB::raw('MAX(updated_at)'))
                                                        ->from('keputusan_kepulihan_klien')
                                                        ->whereColumn('klien_id', 'kk.klien_id')
                                                        ->groupBy('klien_id');
                                                });

                    $latestTahapKepulihan =  $latestTahapKepulihan->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)->get();

                    // Count the number of clients in each tahap kepulihan
                    $cemerlang = $latestTahapKepulihan->where('tahap_kepulihan_id', 4)->count();
                    $baik = $latestTahapKepulihan->where('tahap_kepulihan_id', 3)->count();
                    $memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 2)->count();
                    $tidak_memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 1)->count();


                    // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (for message1)
                    $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                                                                ->select('id', 'message1', 'created_at', 'is_read1')
                                                                ->get();

                    // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (for message2)
                    $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                                                                ->select('id', 'message2', 'created_at', 'is_read2')
                                                                ->get();
                                                                
                                            
                    // Combine and sort notifications by created_at descending
                    $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');
                    
                    // Correct unread count calculation for logged-in user's daerah_bertugas
                    $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) use ($pegawaiDaerah) {
                                        $query->where(function ($subQuery) use ($pegawaiDaerah) {
                                            $subQuery->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
                                                ->where('is_read1', false);
                                        })->orWhere(function ($subQuery) use ($pegawaiDaerah) {
                                            $subQuery->where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
                                                ->where('is_read2', false);
                                        });
                                    })->count();


                    // Get name of tahap kepulihan
                    $tahap1 = TahapKepulihan::where('id', 1)->value('tahap');
                    $tahap2 = TahapKepulihan::where('id', 2)->value('tahap');
                    $tahap3 = TahapKepulihan::where('id', 3)->value('tahap');
                    $tahap4 = TahapKepulihan::where('id', 4)->value('tahap');

                    return view('dashboard.pegawai.dashboard_daerah', compact('telahKemaskiniDaerah','belumKemaskiniDaerah','jumlahKlienDaerah','belumSelesaiDaerah','selesaiDaerah','jumlahPermohonanDaerah',
                                                                                                    'selesai_menjawab_daerah','belum_selesai_menjawab_daerah','tidak_menjawab_lebih_6bulan_daerah','tidak_pernah_menjawab_daerah',
                                                                                                    'cemerlang', 'baik', 'memuaskan', 'tidak_memuaskan', 'tahap1', 'tahap2', 'tahap3', 'tahap4',
                                                                                                    'notifications', 'unreadCountPD'));
                }
            }
        }
    }

    

}
