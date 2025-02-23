<?php

namespace App\Http\Controllers;

use App\Models\KategoriProgram;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\NotifikasiPegawaiDaerah;
use App\Models\TahapKepulihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PelaporanController extends Controller
{
    public function modalKepulihan()
    {
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
        }

        return view('pelaporan.modal_kepulihan', compact('notifications', 'unreadCountPD'));
    }

    public function aktiviti()
    {
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
        }

        return view('pelaporan.aktiviti', compact('notifications', 'unreadCountPD'));
    }

    public function modalKepulihanNegeri(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $status = $request->input('status');
        $tahap_kepulihan_id = $request->input('tahap_kepulihan_id');

        // Clients who have responded within the last 6 months (Selesai Menjawab)
        $selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'),
                'kk.tahap_kepulihan_id',
                'kk.status',
                'kk.updated_at'
            )
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->whereIn('kk.updated_at', function ($query) {
                $query->select(DB::raw('MAX(updated_at)'))
                    ->from('keputusan_kepulihan_klien')
                    ->whereColumn('klien_id', 'kk.klien_id')
                    ->groupBy('klien_id');
            })
            ->where('kk.status', 'Selesai')
            ->when($tahap_kepulihan_id, function ($query, $tahap_kepulihan_id) {
                return $query->where('kk.tahap_kepulihan_id', $tahap_kepulihan_id);
            })
            ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
            ->orderBy('kk.updated_at', 'desc')
            ->get();

        // Clients who started but did not complete (Belum Selesai Menjawab)
        $belum_selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'),
                'kk.tahap_kepulihan_id',
                'kk.status',
                'kk.updated_at'
            )
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->whereIn('kk.updated_at', function ($query) {
                $query->select(DB::raw('MAX(updated_at)'))
                    ->from('keputusan_kepulihan_klien')
                    ->whereColumn('klien_id', 'kk.klien_id')
                    ->groupBy('klien_id');
            })
            ->where('kk.status', '!=', 'Selesai') // Not completed responses
            ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
            ->orderBy('kk.updated_at', 'desc')
            ->get();

        // Clients who last responded more than 6 months ago (Tidak Menjawab Lebih 6 Bulan)
        $tidak_menjawab_lebih_6bulan = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'),
                'kk.tahap_kepulihan_id',
                'kk.updated_at'
            )
            ->where('kk.updated_at', '<=', $sixMonthsAgo)
            ->whereIn('kk.updated_at', function ($query) {
                $query->select(DB::raw('MAX(updated_at)'))
                    ->from('keputusan_kepulihan_klien')
                    ->whereColumn('klien_id', 'kk.klien_id')
                    ->groupBy('klien_id');
            })
            ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at')
            ->orderBy('kk.updated_at', 'desc')
            ->get();

        // Clients who have never responded (Tidak Pernah Menjawab)
        $tidak_pernah_menjawab = DB::table('klien as u')
            ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat'
            )
            ->whereNull('kk.klien_id') // No response record found
            ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat')
            ->get();

        return view('pelaporan.modal_kepulihan.pegawai_negeri', compact('selesai_menjawab','belum_selesai_menjawab','tidak_menjawab_lebih_6bulan','tidak_pernah_menjawab'));
    }

    public function modalKepulihanDaerah(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $tahap_kepulihan_list = TahapKepulihan::all();

        $from_date_s = $request->input('from_date_s');
        $to_date_s = $request->input('to_date_s');
        $tahap_kepulihan_id = $request->input('tahap_kepulihan_id');

        $from_date_bs = $request->input('from_date_bs');
        $to_date_bs = $request->input('to_date_bs');

        $from_date_tm6 = $request->input('from_date_tm6');
        $to_date_tm6 = $request->input('to_date_tm6');

        $selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'),
                'kk.tahap_kepulihan_id',
                'kk.updated_at'
            )
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->where('kk.status', 'Selesai')
            ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
            ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
            ->when($from_date_s, function ($query, $from_date_s) {
                return $query->whereDate('kk.updated_at', '>=', $from_date_s);
            })
            ->when($to_date_s, function ($query, $to_date_s) {
                return $query->whereDate('kk.updated_at', '<=', $to_date_s);
            })
            ->when($tahap_kepulihan_id, function ($query, $tahap_kepulihan_id) {
                return $query->where('kk.tahap_kepulihan_id', $tahap_kepulihan_id);
            })
            ->orderBy('kk.updated_at', 'desc')
            ->get();

        // Clients who started but did not complete (Belum Selesai Menjawab)
        $belum_selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'),
                'kk.tahap_kepulihan_id',
                'kk.status',
                'kk.updated_at'
            )
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->whereIn('kk.updated_at', function ($query) {
                $query->select(DB::raw('MAX(updated_at)'))
                    ->from('keputusan_kepulihan_klien')
                    ->whereColumn('klien_id', 'kk.klien_id')
                    ->groupBy('klien_id');
            })
            ->where('kk.status', '!=', 'Selesai') // Not completed responses
            ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
            ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
            ->when($from_date_bs, function ($query, $from_date_bs) {
                return $query->whereDate('kk.updated_at', '>=', $from_date_bs);
            })
            ->when($to_date_bs, function ($query, $to_date_bs) {
                return $query->whereDate('kk.updated_at', '<=', $to_date_bs);
            })
            ->orderBy('kk.updated_at', 'desc')
            ->get();

        // Clients who last responded more than 6 months ago (Tidak Menjawab Lebih 6 Bulan)
        $tidak_menjawab_lebih_6bulan = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'),
                'kk.tahap_kepulihan_id',
                'kk.updated_at'
            )
            ->where('kk.updated_at', '<=', $sixMonthsAgo)
            ->whereIn('kk.updated_at', function ($query) {
                $query->select(DB::raw('MAX(updated_at)'))
                    ->from('keputusan_kepulihan_klien')
                    ->whereColumn('klien_id', 'kk.klien_id')
                    ->groupBy('klien_id');
            })
            ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
            ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at')
            ->when($from_date_tm6, function ($query, $from_date_tm6) {
                return $query->whereDate('kk.updated_at', '>=', $from_date_tm6);
            })
            ->when($to_date_tm6, function ($query, $to_date_tm6) {
                return $query->whereDate('kk.updated_at', '<=', $to_date_tm6);
            })
            ->orderBy('kk.updated_at', 'desc')
            ->get();

        // Clients who have never responded (Tidak Pernah Menjawab)
        $tidak_pernah_menjawab = DB::table('klien as u')
            ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat'
            )
            ->whereNull('kk.klien_id') // No response record found
            ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
            ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat')
            ->get();


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

        return view('pelaporan.modal_kepulihan.pegawai_daerah', compact( 'selesai_menjawab','belum_selesai_menjawab', 'tidak_menjawab_lebih_6bulan', 'tidak_pernah_menjawab', 'notifications', 'unreadCountPD','tahap_kepulihan_list'));
    }

    public function PDFselesaiMenjawabDaerah(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'),
                'kk.tahap_kepulihan_id',
                'kk.updated_at'
            )
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->where('kk.status', 'Selesai')
            ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
            ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
            ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_s')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_s);
        }
    
        if ($request->filled('to_date_s')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_s);
        }
    
        if ($request->filled('tahap_kepulihan_id')) {
            $query->where('kk.tahap_kepulihan_id', $request->tahap_kepulihan_id);
        }
    
        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_selesai_menjawab', compact('filteredData','pegawaiDaerah'));
        return $pdf->stream('Senarai_Selesai_Menjawab.pdf');
    }

    public function PDFbelumSelesaiMenjawabDaerah(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'u.daerah_pejabat',
                    'u.negeri_pejabat',
                    DB::raw('ROUND(kk.skor, 3) as skor'),
                    'kk.tahap_kepulihan_id',
                    'kk.status',
                    'kk.updated_at'
                )
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->where('kk.status', '!=', 'Selesai') // Not completed responses
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
                ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_bs')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_bs);
        }
    
        if ($request->filled('to_date_bs')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_bs);
        }
    
        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_belum_selesai_menjawab', compact('filteredData','pegawaiDaerah'));
        return $pdf->stream('Senarai_Belum_Selesai_Menjawab.pdf');
    }

    public function PDFtidakMenjawabLebih6BulanDaerah(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'u.daerah_pejabat',
                    'u.negeri_pejabat',
                    DB::raw('ROUND(kk.skor, 3) as skor'),
                    'kk.tahap_kepulihan_id',
                    'kk.updated_at'
                )
                ->where('kk.updated_at', '<=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at')
                ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_tm6')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_tm6);
        }
    
        if ($request->filled('to_date_tm6')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_tm6);
        }
    
        if ($request->filled('tahap_kepulihan_id')) {
            $query->where('kk.tahap_kepulihan_id', $request->tahap_kepulihan_id);
        }
    
        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_tidak_menjawab_lebih_6bulan', compact('filteredData','pegawaiDaerah'));
        return $pdf->stream('Senarai_Tidak_Menjawab_Lebih_6Bulan.pdf');
    }

    public function PDFtidakPernahMenjawabDaerah(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('klien as u')
                ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'u.daerah_pejabat',
                    'u.negeri_pejabat'
                )
                ->whereNull('kk.klien_id') // No response record found
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat')
                ->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_tidak_pernah_menjawab', compact('query','pegawaiDaerah'));
        return $pdf->stream('Selesai_Menjawab_Modal_Kepulihan.pdf');
    }

    public function senaraiAktiviti(){
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
        }
        //available years
        // Get available years from the database
        $years = Program::selectRaw('YEAR(tarikh_mula) as year')
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');
        // Get all category
        $kategori = KategoriProgram::all();

        return view('pelaporan.aktivitiND.senarai_aktiviti',compact('user_id', 'notifications', 'unreadCountPD', 'years','kategori'));
    }

    public function filterSenaraiAktiviti(Request $request)
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
        }

        // Get filters from the request
        $tahun = $request->input('tahun', null);
        $bulan = $request->input('bulan', null);
        $pKategori = $request->input('kategori', null);
        $status = $request->input('status', null);

        //available years
        // Get available years from the database
        $years = Program::selectRaw('YEAR(tarikh_mula) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        // Get all category
        $kategori = KategoriProgram::all();

        return view('pelaporan.aktivitiND.filter_senarai_aktiviti', compact('user_id', 'notifications', 'unreadCountPD','tahun','bulan','pKategori','status','years','kategori'));
    }

    public function jsonFIlterAktiviti(Request $request,$id)
    {
        $user = User::find($id);
        $pegawai = Pegawai::where('users_id',$id)->first();
        $query = Program::query();

        // Apply filters
        if ($request->tahun) {
            $query->whereYear('tarikh_mula', $request->tahun);
        }
        if ($request->tahun) {
            $query->whereMonth('tarikh_mula', $request->bulan);
        }
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if($user){
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $program = $query->with('kategori')->orderBy('created_at', 'desc')->get();
                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $program = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();
                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '5') {//pegawai daerah
                $program = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->where('daerah_pejabat',$pegawai->daerah_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();
                return response()->json($program);
            }
        }
        return redirect()->back()->with('error', 'User tidak dijumpai');
    }
}
