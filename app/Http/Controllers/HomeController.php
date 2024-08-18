<?php

namespace App\Http\Controllers;

use App\Models\KeluargaKlien;
use App\Models\KeputusanKepulihan;
use App\Models\PegawaiMohonDaftar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $tahap = Auth::user()->tahap_pengguna;
            $status = Auth::user()->status;
            $pegawai = Auth::user();

            // Retrieve the client's id based on their no_kp
            $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

            $sixMonthsAgo = Carbon::now()->subMonths(6);

            if ($status == 0)
            {
                session()->flash('message', 'Sila kemaskini kata laluan anda terlebih dahulu.');
                return view('profile.update_password');
            }
            else
            {
                if($tahap == 1)
                {
                    // users
                    $permohonan_pendaftaran = PegawaiMohonDaftar::where('status', 'Baharu')->count();
                    $pegawai = User::whereIn('tahap_pengguna', [3, 4, 5])->count();
                    $klien = User::where('tahap_pengguna', 2)->count();

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

                    $jumlah1 = $sedangKemaskini + $belumKemaskini;

                    // Situation 1: Jumlah Keseluruhan
                    // $jumlah2 = Klien::whereIn('id', function ($query) {
                    //     $query->select('klien_id')->from('klien_update_requests')
                    //         ->union($query->select('klien_id')->from('keluarga_klien_update_requests'))
                    //         ->union($query->select('klien_id')->from('waris_klien_update_requests'))
                    //         ->union($query->select('klien_id')->from('pekerjaan_klien_update_requests'));
                    // })->count();

                    // // Situation 2: Belum Selesai
                    // $belumSelesai = Klien::whereIn('id', function ($query) {
                    //     $query->select('klien_id')->from('klien_update_requests')->where('status', 'Kemaskini')
                    //         ->union($query->select('klien_id')->from('keluarga_klien_update_requests')->where('status', 'Kemaskini'))
                    //         ->union($query->select('klien_id')->from('waris_klien_update_requests')->where('status', 'Kemaskini'))
                    //         ->union($query->select('klien_id')->from('pekerjaan_klien_update_requests')->where('status', 'Kemaskini'));
                    // })->count();

                    // // Situation 3: Selesai
                    // $selesai = Klien::whereIn('id', function ($query) {
                    //     $query->select('klien_id')->from('klien_update_requests')->whereIn('status', ['Lulus', 'Ditolak'])
                    //         ->union($query->select('klien_id')->from('keluarga_klien_update_requests')->whereIn('status', ['Lulus', 'Ditolak']))
                    //         ->union($query->select('klien_id')->from('waris_klien_update_requests')->whereIn('status', ['Lulus', 'Ditolak']))
                    //         ->union($query->select('klien_id')->from('pekerjaan_klien_update_requests')->whereIn('status', ['Lulus', 'Ditolak']));
                    // })->count();
        
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

                    $tidak_menjawab = DB::table('klien as u')
                                        ->leftJoin('rawatan_klien as rk', 'u.id', '=', 'rk.klien_id')
                                        ->leftJoin('keputusan_kepulihan_klien as kk', function($join) {
                                            $join->on('u.id', '=', 'kk.klien_id')
                                                ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
                                        })
                                        ->select(
                                            'u.id as klien_id',
                                            'u.nama',
                                            'u.no_kp',
                                            'u.daerah',
                                            'u.negeri',
                                            'rk.tkh_tamat_pengawasan',
                                            DB::raw('ROUND(kk.skor, 3) as skor'),
                                            'kk.tahap_kepulihan_id',
                                            'kk.updated_at'
                                        )
                                        ->where(function ($query) use ($sixMonthsAgo) {
                                            $query->whereNull('kk.klien_id') // No record in keputusan_kepulihan_klien
                                                ->where('rk.tkh_tamat_pengawasan', '<=', $sixMonthsAgo)
                                                ->orWhere(function ($query) use ($sixMonthsAgo) {
                                                    $query->whereNotNull('kk.klien_id')
                                                            ->where('kk.updated_at', '<=', $sixMonthsAgo);
                                                });
                                        })
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

                    return view('dashboard.pentadbir.dashboard', compact('permohonan_pendaftaran','pegawai','klien',
                                                                        'belum_selesai_menjawab','selesai_menjawab','tidak_menjawab',
                                                                        'tidak_memuaskan','memuaskan','baik','cemerlang',
                                                                        'belumKemaskini', 'sedangKemaskini', 'jumlah1'));
                }
                else if($tahap == 2)
                {
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

                    return view('dashboard.klien.dashboard', compact('klien','pekerjaan','waris','pasangan','responDemografi','latestResponDemografi','keputusanKepulihan','latestKeputusanKepulihan','tidakMenjawabKepulihan','tarikhTidakMenjawabKepulihan'));
                }
                else if($tahap == 3)
                {
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

                    $tidak_menjawab = DB::table('klien as u')
                                        ->leftJoin('rawatan_klien as rk', 'u.id', '=', 'rk.klien_id')
                                        ->leftJoin('keputusan_kepulihan_klien as kk', function($join) {
                                            $join->on('u.id', '=', 'kk.klien_id')
                                                ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
                                        })
                                        ->select(
                                            'u.id as klien_id',
                                            'u.nama',
                                            'u.no_kp',
                                            'u.daerah',
                                            'u.negeri',
                                            'rk.tkh_tamat_pengawasan',
                                            DB::raw('ROUND(kk.skor, 3) as skor'),
                                            'kk.tahap_kepulihan_id',
                                            'kk.updated_at'
                                        )
                                        ->where(function ($query) use ($sixMonthsAgo) {
                                            $query->whereNull('kk.klien_id') // No record in keputusan_kepulihan_klien
                                                ->where('rk.tkh_tamat_pengawasan', '<=', $sixMonthsAgo)
                                                ->orWhere(function ($query) use ($sixMonthsAgo) {
                                                    $query->whereNotNull('kk.klien_id')
                                                            ->where('kk.updated_at', '<=', $sixMonthsAgo);
                                                });
                                        })
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

                    return view('dashboard.pegawai.dashboard_brpp', compact('belumKemaskini', 'sedangKemaskini',
                                                                            'belum_selesai_menjawab','selesai_menjawab','tidak_menjawab',
                                                                            'tidak_memuaskan','memuaskan','baik','cemerlang'));
                }
                else if($tahap == 4)
                {
                    $pegawaiNegeri = DB::table('pegawai')->where('users_id',$pegawai->id)->first();

                    // Filter clients based on daerah_bertugas and negeri_bertugas
                    $clients = DB::table('klien')
                                ->where('negeri', $pegawaiNegeri->negeri_bertugas)
                                ->get();

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

                    // Count kepulihan statuses
                    $responses = DB::table('keputusan_kepulihan_klien as kk')
                        ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                        ->where('u.negeri', $pegawaiNegeri->negeri_bertugas)
                        ->get();

                    // Start building the query
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
                            $query->where('u.negeri', $pegawaiNegeri->negeri_bertugas);

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
                    $tidak_menjawab = DB::table('klien as u')
                    ->leftJoin('rawatan_klien as rk', 'u.id', '=', 'rk.klien_id')
                    ->leftJoin('keputusan_kepulihan_klien as kk', function($join) {
                        $join->on('u.id', '=', 'kk.klien_id')
                            ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
                    })
                    ->where(function ($query) use ($sixMonthsAgo) {
                        $query->whereNull('kk.klien_id') // No record in keputusan_kepulihan_klien
                            ->where('rk.tkh_tamat_pengawasan', '<=', $sixMonthsAgo)
                            ->orWhere(function ($query) use ($sixMonthsAgo) {
                                $query->whereNotNull('kk.klien_id')
                                    ->where('kk.updated_at', '<=', $sixMonthsAgo);
                            });
                    });

                    $tidak_menjawab_negeri = $tidak_menjawab->where('u.negeri', $pegawaiNegeri->negeri_bertugas)->count();

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

                    $latestTahapKepulihan = $latestTahapKepulihan->where('u.negeri', $pegawaiNegeri->negeri_bertugas)->get();

                    // Count the number of clients in each tahap kepulihan
                    $cemerlang = $latestTahapKepulihan->where('tahap_kepulihan_id', 4)->count();
                    $baik = $latestTahapKepulihan->where('tahap_kepulihan_id', 3)->count();
                    $memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 2)->count();
                    $tidak_memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 1)->count();

                    return view('dashboard.pegawai.dashboard_negeri', compact('sedangKemaskiniNegeri','belumKemaskiniNegeri', 
                                                                              'selesai_menjawab_negeri','belum_selesai_menjawab_negeri','tidak_menjawab_negeri',
                                                                              'cemerlang', 'baik', 'memuaskan', 'tidak_memuaskan'));
                }
                else if($tahap == 5)
                {
                    $pegawai = Auth::user();
                    $pegawaiDaerah = DB::table('pegawai')->where('users_id',$pegawai->id)->first();

                    // Filter clients based on daerah_bertugas and negeri_bertugas
                    $clients = DB::table('klien')
                                ->where('negeri', $pegawaiDaerah->negeri_bertugas)
                                ->where('daerah', $pegawaiDaerah->daerah_bertugas)
                                ->get();

                    // Count profile update statuses
                    $sedangKemaskiniDaerah = $clients->filter(function ($client) {
                        return DB::table('sejarah_profil_klien')
                            ->where('klien_id', $client->id)
                            ->exists();
                    })->count();

                    $belumKemaskiniDaerah = $clients->filter(function ($client) {
                        return !DB::table('sejarah_profil_klien')
                            ->where('klien_id', $client->id)
                            ->exists();
                    })->count();

                    // Start building the query
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
                    $query->where('u.negeri', $pegawaiDaerah->negeri_bertugas)->where('u.daerah', $pegawaiDaerah->daerah_bertugas);

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
                    $tidak_menjawab = DB::table('klien as u')
                    ->leftJoin('rawatan_klien as rk', 'u.id', '=', 'rk.klien_id')
                    ->leftJoin('keputusan_kepulihan_klien as kk', function($join) {
                        $join->on('u.id', '=', 'kk.klien_id')
                            ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
                    })
                    ->where(function ($query) use ($sixMonthsAgo) {
                        $query->whereNull('kk.klien_id') // No record in keputusan_kepulihan_klien
                            ->where('rk.tkh_tamat_pengawasan', '<=', $sixMonthsAgo)
                            ->orWhere(function ($query) use ($sixMonthsAgo) {
                                $query->whereNotNull('kk.klien_id')
                                    ->where('kk.updated_at', '<=', $sixMonthsAgo);
                            });
                    });

                    $tidak_menjawab_daerah = $tidak_menjawab->where('u.negeri', $pegawaiDaerah->negeri_bertugas)->where('u.daerah', $pegawaiDaerah->daerah_bertugas)->count();

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

                    $latestTahapKepulihan =  $latestTahapKepulihan->where('u.negeri', $pegawaiDaerah->negeri_bertugas)->where('u.daerah', $pegawaiDaerah->daerah_bertugas)->get();

                    // Count the number of clients in each tahap kepulihan
                    $cemerlang = $latestTahapKepulihan->where('tahap_kepulihan_id', 4)->count();
                    $baik = $latestTahapKepulihan->where('tahap_kepulihan_id', 3)->count();
                    $memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 2)->count();
                    $tidak_memuaskan = $latestTahapKepulihan->where('tahap_kepulihan_id', 1)->count();

                    return view('dashboard.pegawai.dashboard_daerah', compact('sedangKemaskiniDaerah','belumKemaskiniDaerah', 
                                                                              'selesai_menjawab_daerah','belum_selesai_menjawab_daerah','tidak_menjawab_daerah',
                                                                              'cemerlang', 'baik', 'memuaskan', 'tidak_memuaskan'));
                }
            }
        }
    }

    

}
