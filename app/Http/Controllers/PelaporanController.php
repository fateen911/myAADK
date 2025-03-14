<?php

namespace App\Http\Controllers;

use App\Exports\AnalisisMKExcel;
use App\Exports\AnalisisMKExcelPN;
use App\Exports\AnalisisMKExcelPD;
use App\Exports\MKSelesaiMenjawabExcel;
use App\Exports\MKSelesaiMenjawabExcelPN;
use App\Exports\MKSelesaiMenjawabExcelPD;
use App\Exports\MKBelumSelesaiMenjawabExcel;
use App\Exports\MKBelumSelesaiMenjawabExcelPN;
use App\Exports\MKBelumSelesaiMenjawabExcelPD;
use App\Exports\MKTidakMenjawabLebih6BulanExcel;
use App\Exports\MKTidakMenjawabLebih6BulanExcelPN;
use App\Exports\MKTidakMenjawabLebih6BulanExcelPD;
use App\Exports\MKTidakPernahMenjawabExcel;
use App\Exports\MKTidakPernahMenjawabExcelPN;
use App\Exports\MKTidakPernahMenjawabExcelPD;
use App\Exports\PelaporanAktivitiExcel;
use App\Exports\PerekodanKehadiranExcel;
use App\Jobs\PDFTidakPernahMenjawabPB;
use App\Models\DaerahPejabat;
use App\Models\KategoriProgram;
use App\Models\Negeri;
use App\Models\NegeriPejabat;
use App\Models\PengesahanKehadiranProgram;
use App\Models\PerekodanKehadiranProgram;
use App\Models\Program;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\NotifikasiPegawaiDaerah;
use App\Models\TahapKepulihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use setasign\Fpdi\Tcpdf\Fpdi;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class PelaporanController extends Controller
{
    // PENTADBIR & BRPP - ANALISIS MODAL KEPULIHAN
    public function analisisModalKepulihan()
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

        return view('pelaporan.modal_kepulihan.pentadbir_brpp_analisis', compact('notifications', 'unreadCountPD'));
    }

    public function rekodModalKepulihan(Request $request)
    {
        $aadk_negeri = NegeriPejabat::all();
        $aadk_daerah = DaerahPejabat::all();
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $tahap_kepulihan_list = TahapKepulihan::all();

        return view('pelaporan.modal_kepulihan.pentadbir_brpp_rekod', compact('aadk_negeri','aadk_daerah','tahap_kepulihan_list'));
    }

    // PENTADBIR & BRPP - MODAL KEPULIHAN - SELESAI MENJAWAB
    public function jsonSelesaiMenjawabPB(Request $request)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as k', 'kk.klien_id', '=', 'k.id')
                ->join('senarai_negeri_pejabat as n', 'k.negeri_pejabat', '=', 'n.negeri_id')
                ->join('senarai_daerah_pejabat as d', 'k.daerah_pejabat', '=', 'd.kod')
                ->join('tahap_kepulihan as t', 'kk.tahap_kepulihan_id', '=', 't.id')
                ->select(
                    'k.id as klien_id', 
                    'k.nama', 
                    'k.no_kp', 
                    'n.negeri', 
                    'd.daerah', 
                    'kk.updated_at', 
                    't.tahap'
                )
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->where('kk.status', 'Selesai')
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->filled('from_date_s')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_s);
        }
        if ($request->filled('to_date_s')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_s);
        }
        if ($request->tahap_kepulihan_id) {
            $query->where('kk.tahap_kepulihan_id', $request->tahap_kepulihan_id);
        }
        if ($request->aadk_negeri_s) {
            $query->where('k.negeri_pejabat', $request->aadk_negeri_s);
        }
        if ($request->aadk_daerah_s) {
            $query->where('k.daerah_pejabat', $request->aadk_daerah_s);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function MKselesaiMenjawabExcelPB(Request $request)
    {
        $filters = [
            'from_date_s' => $request->input('from_date_s'),
            'to_date_s' => $request->input('to_date_s'),
            'tahap_kepulihan_id' => $request->input('tahap_kepulihan_id'),
            'aadk_negeri_s' => $request->input('aadk_negeri_s'),
            'aadk_daerah_s' => $request->input('aadk_daerah_s'),
        ];

        return Excel::download(new MKSelesaiMenjawabExcel($filters), 'senarai_klien_selesai_menjawab.xlsx');
    }

    public function PDFselesaiMenjawabPB(Request $request)
    {
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

        if ($request->filled('aadk_negeri_s')) {
            $query->where('u.negeri_pejabat', $request->aadk_negeri_s);
        }

        if ($request->filled('aadk_daerah_s')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_s);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_selesai_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Selesai_Menjawab.pdf');
    }

    public function PDFAnalisisMK(Request $request) 
    {
        // Fetch filters from request
        $filters = [
            'from_date_s' => $request->from_date_s,
            'to_date_s' => $request->to_date_s,
            'tahap_kepulihan_id' => $request->tahap_kepulihan_id,
            'aadk_negeri_s' => $request->aadk_negeri_s,
            'aadk_daerah_s' => $request->aadk_daerah_s,
        ];

        $sixMonthsAgo = now()->subMonths(6);
        $modalKepulihan = [
            'modal_fizikal', 'modal_psikologi', 'modal_sosial', 'modal_persekitaran', 'modal_insaniah',
            'modal_spiritual', 'modal_rawatan', 'modal_kesihatan', 'modal_strategi_daya_tahan', 'modal_resiliensi'
        ];

        // Fetch data with filters
        $query = DB::table('keputusan_kepulihan_klien as kk')
            ->join('skor_modal as sm', function ($join) {
                $join->on('kk.klien_id', '=', 'sm.klien_id')
                    ->on('kk.sesi', '=', 'sm.sesi');
            })
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select('kk.klien_id', 'kk.skor', 'sm.*')
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->where('kk.status', 'Selesai');

        // Apply filters if set
        if ($request->filled('from_date_s')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_s);
        }

        if ($request->filled('to_date_s')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_s);
        }

        if ($request->filled('tahap_kepulihan_id')) {
            $query->where('kk.tahap_kepulihan_id', $request->tahap_kepulihan_id);
        }

        if ($request->filled('aadk_negeri_s')) {
            $query->where('u.negeri_pejabat', $request->aadk_negeri_s);
        }

        if ($request->filled('aadk_daerah_s')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_s);
        }

        $data = collect($query->get());

        // Define categories
        $categories = collect([
            'Sangat Memuaskan' => [3.51, 4.0],
            'Memuaskan' => [2.51, 3.5],
            'Kurang Memuaskan' => [1.51, 2.5],
            'Sangat Tidak Memuaskan' => [1.0, 1.5],
        ]);

        // Count clients per category & modal
        $counts = $categories->mapWithKeys(function ($range, $category) use ($data, $modalKepulihan) {
            return [
                $category => collect($modalKepulihan)->mapWithKeys(function ($modal) use ($data, $range) {
                    return [$modal => $data->filter(fn($item) => $item->$modal >= $range[0] && $item->$modal <= $range[1])->count()];
                })
            ];
        });

        $totalClients = $data->unique('klien_id')->count();

        // Generate PDF
        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_analisis_modal_kepulihan', compact('counts', 'modalKepulihan', 'totalClients'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('analisis_modal_kepulihan.pdf');
    }

    public function excelAnalisisMK(Request $request)
    {
        $filters = [
            'from_date_s' => $request->from_date_s,
            'to_date_s' => $request->to_date_s,
            'tahap_kepulihan_id' => $request->tahap_kepulihan_id,
            'aadk_negeri_s' => $request->aadk_negeri_s,
            'aadk_daerah_s' => $request->aadk_daerah_s,
        ];
    
        return Excel::download(new AnalisisMKExcel($filters), 'Analisis_Modal_Kepulihan.xlsx');
    }

    // PENTADBIR & BRPP - MODAL KEPULIHAN - BELUM SELESAI MENJAWAB
    public function jsonBelumSelesaiMenjawabPB(Request $request)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'd.daerah as nama_daerah',  // Get the actual daerah name
                    'n.negeri as nama_negeri',  // Get the actual negeri name
                    'kk.updated_at',
                    'kk.status' // Assuming there is a status column
                )
                ->where('kk.status', '!=', 'Selesai') // Not completed responses
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'd.daerah', 'n.negeri','kk.updated_at', 'kk.status')
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->filled('from_date_bs')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_bs);
        }
        if ($request->filled('to_date_bs')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_bs);
        }
        if ($request->aadk_negeri_bs) {
            $query->where('u.negeri_pejabat', $request->aadk_negeri_bs);
        }
        if ($request->aadk_daerah_bs) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_bs);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function MKBelumSelesaiMenjawabExcelPB(Request $request)
    {
        $filters = [
            'from_date_bs' => $request->input('from_date_bs'),
            'to_date_bs' => $request->input('to_date_bs'),
            'aadk_negeri_bs' => $request->input('aadk_negeri_bs'),
            'aadk_daerah_bs' => $request->input('aadk_daerah_bs'),
        ];

        return Excel::download(new MKBelumSelesaiMenjawabExcel($filters), 'senarai_klien_belum_selesai_menjawab.xlsx');
    }

    public function PDFBelumSelesaiMenjawabPB(Request $request)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'u.daerah_pejabat',
                    'u.negeri_pejabat',
                    DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
                    'kk.tahap_kepulihan_id',
                    'kk.updated_at',
                    'kk.status' // Assuming there is a status column
                )
                ->where('kk.status', '!=', 'Selesai') // Not completed responses
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah', 'u.negeri', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
                ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_bs')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_bs);
        }

        if ($request->filled('to_date_bs')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_bs);
        }

        if ($request->filled('aadk_negeri_bs')) {
            $query->where('u.negeri_pejabat', $request->aadk_negeri_bs);
        }

        if ($request->filled('aadk_daerah_bs')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_bs);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_belum_selesai_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Klien_Belum_Selesai_Menjawab.pdf');
    }

    // PENTADBIR & BRPP - MODAL KEPULIHAN - TIDAK MENJAWAB LEBIH 6 BULAN
    public function jsonTidakMenjawabLebih6BulanPB(Request $request)
    {
        $query = DB::table('klien as u')
                ->join('keputusan_kepulihan_klien as kk', function($join) {
                    $join->on('u.id', '=', 'kk.klien_id')
                        ->whereRaw('kk.updated_at = (SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)');
                })
                ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'd.daerah',  // Get the actual daerah name
                    'n.negeri',  // Get the actual negeri name
                    'kk.updated_at',
                )
                ->where('kk.updated_at', '<=', now()->subMonths(6)) // Latest record is more than 6 months old
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->filled('from_date_tm6')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_tm6);
        }

        if ($request->filled('to_date_tm6')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_tm6);
        }

        if ($request->filled('aadk_negeri_tm6')) {
            $query->where('u.negeri_pejabat', '<=', $request->aadk_negeri_tm6);
        }
        
        if ($request->filled('aadk_daerah_tm6')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_tm6);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function ExcelTidakMenjawabLebih6BulanPB(Request $request)
    {
        $filters = [
            'from_date_tm6' => $request->input('from_date_tm6'),
            'to_date_tm6' => $request->input('to_date_tm6'),
            'aadk_negeri_tm6' => $request->input('aadk_negeri_tm6'),
            'aadk_daerah_tm6' => $request->input('aadk_daerah_tm6'),
        ];

        return Excel::download(new MKTidakMenjawabLebih6BulanExcel($filters), 'senarai_klien_tidak_menjawab_lebih_6bulan.xlsx');
    }

    public function PDFtidakMenjawabLebih6BulanPB(Request $request)
    {
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
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at')
                ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_tm6')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_tm6);
        }

        if ($request->filled('to_date_tm6')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_tm6);
        }

        if ($request->filled('aadk_negeri_tm6')) {
            $query->whereDate('u.negeri_pejabat', '<=', $request->aadk_negeri_tm6);
        }
        
        if ($request->filled('aadk_daerah_tm6')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_tm6);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_tidak_menjawab_lebih_6bulan', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Tidak_Menjawab_Lebih_6Bulan.pdf');
    }

    // PENTADBIR & BRPP - MODAL KEPULIHAN - TIDAK PERNAH MENJAWAB
    public function jsonTidakPernahMenjawabPB(Request $request)
    {
        $query = DB::table('klien as u')
                    ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                    ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                    ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                    ->select(
                        'u.id as klien_id',
                        'u.nama',
                        'u.no_kp',
                        'd.daerah',  // Get the actual daerah name
                        'n.negeri',  // Get the actual negeri name
                    )
                    ->whereNull('kk.klien_id'); // No records in keputusan_kepulihan_klien

        // Apply Filters
        if ($request->filled('aadk_negeri_tpm')) {
            $query->where('u.negeri_pejabat', '<=', $request->aadk_negeri_tpm);
        }
        
        if ($request->filled('aadk_daerah_tpm')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_tpm);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function ExcelTidakPernahMenjawabPB(Request $request)
    {
        $filters = [
            'aadk_negeri_tpm' => $request->input('aadk_negeri_tpm'),
            'aadk_daerah_tpm' => $request->input('aadk_daerah_tpm'),
        ];

        return Excel::download(new MKTidakPernahMenjawabExcel($filters), 'senarai_klien_tidak_pernah_menjawab.xlsx');
    }

    public function PDFtidakPernahMenjawabPB(Request $request)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // Query to fetch data
        $query = DB::table('klien as u')
            ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id')
            ->whereNull('kk.klien_id');

        if ($request->filled('aadk_negeri_tpm')) {
            $query->where('u.negeri_pejabat', $request->aadk_negeri_tpm);
        }
        
        if ($request->filled('aadk_daerah_tpm')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_tpm);
        }

        $allData = $query->get();

        // Process data in chunks (e.g., 2000 records per chunk)
        $chunks = $allData->chunk(2000);
        $chunkIndex = 1;
        $pdfPaths = [];

        foreach ($chunks as $filteredData) {
            $pdf = Pdf::loadView('pelaporan.modal_kepulihan.pdf_tidak_pernah_menjawab', compact('filteredData'));
            $filePath = storage_path("app/public/reports/pdf_part_{$chunkIndex}.pdf");
            $pdf->save($filePath);
            $pdfPaths[] = $filePath;
            $chunkIndex++;
        }

        // Merge PDFs into one file
        $finalPDFPath = storage_path("app/public/reports/final_report.pdf");
        $this->mergePDFs($pdfPaths, $finalPDFPath);

        return response()->json([
            'message' => 'PDF generation completed.',
            'download_link' => Storage::url('public/reports/final_report.pdf')
        ]);
    }

    // Function to merge PDFs
    public function mergePDFs($filePaths, $outputPath)
    {
        $pdf = new Fpdi();
        foreach ($filePaths as $file) {
            $pageCount = $pdf->setSourceFile($file);
            for ($i = 1; $i <= $pageCount; $i++) {
                $pdf->AddPage();
                $tplIdx = $pdf->importPage($i);
                $pdf->useTemplate($tplIdx);
            }
        }
        $pdf->Output($outputPath, 'F');
    }

    // public function PDFtidakPernahMenjawabPB(Request $request)
    // {
    //     $sixMonthsAgo = Carbon::now()->subMonths(6);

    //     $query = DB::table('klien as u')
    //             ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
    //             ->whereNull('kk.klien_id'); // No records in keputusan_kepulihan_klien

    //     if ($request->filled('aadk_negeri_tpm')) {
    //         $query->whereDate('u.negeri_pejabat', '<=', $request->aadk_negeri_tpm);
    //     }
        
    //     if ($request->filled('aadk_daerah_tpm')) {
    //         $query->where('u.daerah_pejabat', $request->aadk_daerah_tpm);
    //     }

    //     $filteredData = $query->get();

    //     $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_tidak_pernah_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
    //     return $pdf->stream('Senarai_Tidak_Pernah_Menjawab.pdf');
    // }

    // PEGAWAI NEGERI
    public function modalKepulihanNegeri(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $aadk_daerah = DB::table('senarai_daerah_pejabat')->where('negeri_id', $pegawaiNegeri->negeri_bertugas)->get();
        $tahap_kepulihan_list = TahapKepulihan::all();

        return view('pelaporan.modal_kepulihan.pegawai_negeri_rekod', compact('aadk_daerah','tahap_kepulihan_list'));
    }

    // PEGAWAI NEGERI - MODAL KEPULIHAN - SELESAI MENJAWAB
    public function jsonSelesaiMenjawabPN(Request $request)
    {        
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as k', 'kk.klien_id', '=', 'k.id')
                ->join('senarai_negeri_pejabat as n', 'k.negeri_pejabat', '=', 'n.negeri_id')
                ->join('senarai_daerah_pejabat as d', 'k.daerah_pejabat', '=', 'd.kod')
                ->join('tahap_kepulihan as t', 'kk.tahap_kepulihan_id', '=', 't.id')
                ->select(
                    'k.id as klien_id', 
                    'k.nama', 
                    'k.no_kp', 
                    'n.negeri', 
                    'd.daerah', 
                    'kk.updated_at', 
                    't.tahap'
                )
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->where('kk.status', 'Selesai')
                ->where('k.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->has('from_date_s') && $request->from_date_s != '') {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_s);
        }

        if ($request->has('to_date_s') && $request->to_date_s != '') {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_s);
        }

        if ($request->has('tahap_kepulihan_id') && $request->tahap_kepulihan_id != '') {
            $query->where('kk.tahap_kepulihan_id', $request->tahap_kepulihan_id);
        }
        
        if ($request->has('aadk_daerah_s') && $request->aadk_daerah_s != '') {
            $query->where('k.daerah_pejabat', $request->aadk_daerah_s);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function MKselesaiMenjawabExcelPN(Request $request)
    {
        $filters = [
            'from_date_s' => $request->input('from_date_s'),
            'to_date_s' => $request->input('to_date_s'),
            'tahap_kepulihan_id' => $request->input('tahap_kepulihan_id'),
            'aadk_daerah_s' => $request->input('aadk_daerah_s'),
        ];

        return Excel::download(new MKSelesaiMenjawabExcelPN($filters), 'senarai_klien_selesai_menjawab.xlsx');
    }

    public function PDFselesaiMenjawabPN(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
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
            ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
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

        if ($request->filled('aadk_daerah_s')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_s);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_selesai_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Selesai_Menjawab.pdf');
    }

    public function PDFAnalisisModalKepulihanPN(Request $request) 
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        // Fetch filters from request
        $filters = [
            'from_date_s' => $request->from_date_s,
            'to_date_s' => $request->to_date_s,
            'tahap_kepulihan_id' => $request->tahap_kepulihan_id,
            'aadk_daerah_s' => $request->aadk_daerah_s,
        ];

        $sixMonthsAgo = now()->subMonths(6);
        $modalKepulihan = [
            'modal_fizikal', 'modal_psikologi', 'modal_sosial', 'modal_persekitaran', 'modal_insaniah',
            'modal_spiritual', 'modal_rawatan', 'modal_kesihatan', 'modal_strategi_daya_tahan', 'modal_resiliensi'
        ];

        // Fetch data with filters
        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('skor_modal as sm', function ($join) {
                    $join->on('kk.klien_id', '=', 'sm.klien_id')
                        ->on('kk.sesi', '=', 'sm.sesi');
                })
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->select('kk.klien_id', 'kk.skor', 'sm.*')
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->where('kk.status', 'Selesai')
                ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas);

        // Apply filters if set
        if ($request->filled('from_date_s')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_s);
        }

        if ($request->filled('to_date_s')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_s);
        }

        if ($request->filled('tahap_kepulihan_id')) {
            $query->where('kk.tahap_kepulihan_id', $request->tahap_kepulihan_id);
        }

        if ($request->filled('aadk_daerah_s')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_s);
        }

        $data = collect($query->get());

        // Define categories
        $categories = collect([
            'Sangat Memuaskan' => [3.51, 4.0],
            'Memuaskan' => [2.51, 3.5],
            'Kurang Memuaskan' => [1.51, 2.5],
            'Sangat Tidak Memuaskan' => [1.0, 1.5],
        ]);

        // Count clients per category & modal
        $counts = $categories->mapWithKeys(function ($range, $category) use ($data, $modalKepulihan) {
            return [
                $category => collect($modalKepulihan)->mapWithKeys(function ($modal) use ($data, $range) {
                    return [$modal => $data->filter(fn($item) => $item->$modal >= $range[0] && $item->$modal <= $range[1])->count()];
                })
            ];
        });

        $totalClients = $data->unique('klien_id')->count();

        // Generate PDF
        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_analisis_modal_kepulihan', compact('counts', 'modalKepulihan', 'totalClients'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('analisis_modal_kepulihan.pdf');
    }

    public function excelAnalisisModalKepulihanPN(Request $request)
    {
        $filters = [
            'from_date_s' => $request->from_date_s,
            'to_date_s' => $request->to_date_s,
            'tahap_kepulihan_id' => $request->tahap_kepulihan_id,
            'aadk_daerah_s' => $request->aadk_daerah_s,
        ];
    
        return Excel::download(new AnalisisMKExcelPN($filters), 'Analisis_Modal_Kepulihan.xlsx');
    }

    // PEGAWAI NEGERI - MODAL KEPULIHAN - BELUM SELESAI MENJAWAB
    public function jsonBelumSelesaiMenjawabPN(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'd.daerah as nama_daerah',  // Get the actual daerah name
                    'n.negeri as nama_negeri',  // Get the actual negeri name
                    'kk.updated_at',
                    'kk.status' // Assuming there is a status column
                )
                ->where('kk.status', '!=', 'Selesai') // Not completed responses
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'd.daerah', 'n.negeri','kk.updated_at', 'kk.status')
                ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->filled('from_date_bs')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_bs);
        }

        if ($request->filled('to_date_bs')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_bs);
        }
       
        if ($request->aadk_daerah_bs) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_bs);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function MKBelumSelesaiMenjawabExcelPN(Request $request)
    {
        $filters = [
            'from_date_bs' => $request->input('from_date_bs'),
            'to_date_bs' => $request->input('to_date_bs'),
            'aadk_daerah_bs' => $request->input('aadk_daerah_bs'),
        ];

        return Excel::download(new MKBelumSelesaiMenjawabExcelPN($filters), 'senarai_klien_belum_selesai_menjawab.xlsx');
    }

    public function PDFBelumSelesaiMenjawabPN(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'u.daerah_pejabat',
                    'u.negeri_pejabat',
                    DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
                    'kk.tahap_kepulihan_id',
                    'kk.updated_at',
                    'kk.status' // Assuming there is a status column
                )
                ->where('kk.status', '!=', 'Selesai') // Not completed responses
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah', 'u.negeri', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
                ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_bs')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_bs);
        }

        if ($request->filled('to_date_bs')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_bs);
        }

        if ($request->filled('aadk_daerah_bs')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_bs);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_belum_selesai_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Klien_Belum_Selesai_Menjawab.pdf');
    }

    // PEGAWAI NEGERI - MODAL KEPULIHAN - TIDAK MENJAWAB LEBIH 6 BULAN
    public function jsonTidakMenjawabLebih6BulanPN(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $query = DB::table('klien as u')
                ->join('keputusan_kepulihan_klien as kk', function($join) {
                    $join->on('u.id', '=', 'kk.klien_id')
                        ->whereRaw('kk.updated_at = (SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)');
                })
                ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'd.daerah',  // Get the actual daerah name
                    'n.negeri',  // Get the actual negeri name
                    'kk.updated_at',
                )
                ->where('kk.updated_at', '<=', now()->subMonths(6)) // Latest record is more than 6 months old
                ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->filled('from_date_tm6')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_tm6);
        }

        if ($request->filled('to_date_tm6')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_tm6);
        }
        
        if ($request->filled('aadk_daerah_tm6')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_tm6);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function ExcelTidakMenjawabLebih6BulanPN(Request $request)
    {
        $filters = [
            'from_date_tm6' => $request->input('from_date_tm6'),
            'to_date_tm6' => $request->input('to_date_tm6'),
            'aadk_daerah_tm6' => $request->input('aadk_daerah_tm6'),
        ];

        return Excel::download(new MKTidakMenjawabLebih6BulanExcelPN($filters), 'senarai_klien_tidak_menjawab_lebih_6bulan.xlsx');
    }

    public function PDFtidakMenjawabLebih6BulanPN(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
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
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at')
                ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_tm6')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_tm6);
        }

        if ($request->filled('to_date_tm6')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_tm6);
        }
        
        if ($request->filled('aadk_daerah_tm6')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_tm6);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_tidak_menjawab_lebih_6bulan', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Tidak_Menjawab_Lebih_6Bulan.pdf');
    }

    // PEGAWAI NEGERI - MODAL KEPULIHAN - TIDAK MENJAWAB LEBIH 6 BULAN
    public function jsonTidakPernahMenjawabPN(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        
        $query = DB::table('klien as u')
                    ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                    ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                    ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                    ->select(
                        'u.id as klien_id',
                        'u.nama',
                        'u.no_kp',
                        'd.daerah',  // Get the actual daerah name
                        'n.negeri',  // Get the actual negeri name
                    )
                    ->whereNull('kk.klien_id') // No records in keputusan_kepulihan_klien
                    ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas);

        if ($request->filled('aadk_daerah_tpm')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_tpm);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function ExcelTidakPernahMenjawabPN(Request $request)
    {
        $filters = [
            'aadk_daerah_tpm' => $request->input('aadk_daerah_tpm'),
        ];

        return Excel::download(new MKTidakPernahMenjawabExcelPN($filters), 'senarai_klien_tidak_pernah_menjawab.xlsx');
    }

    public function PDFtidakPernahMenjawabPN(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('klien as u')
                ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                ->whereNull('kk.klien_id') // No records in keputusan_kepulihan_klien
                ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas);
        
        if ($request->filled('aadk_daerah_tpm')) {
            $query->where('u.daerah_pejabat', $request->aadk_daerah_tpm);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_tidak_pernah_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Tidak_Pernah_Menjawab.pdf');
    }

    
    // PEGAWAI DAERAH
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

        return view('pelaporan.modal_kepulihan.pegawai_daerah_rekod', compact( 'selesai_menjawab','belum_selesai_menjawab', 'tidak_menjawab_lebih_6bulan', 'tidak_pernah_menjawab', 'notifications', 'unreadCountPD','tahap_kepulihan_list'));
    }

    // PEGAWAI DAERAH - MODAL KEPULIHAN - SELESAI MENJAWAB
    public function jsonSelesaiMenjawabPD(Request $request)
    {        
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as k', 'kk.klien_id', '=', 'k.id')
                ->join('senarai_negeri_pejabat as n', 'k.negeri_pejabat', '=', 'n.negeri_id')
                ->join('senarai_daerah_pejabat as d', 'k.daerah_pejabat', '=', 'd.kod')
                ->join('tahap_kepulihan as t', 'kk.tahap_kepulihan_id', '=', 't.id')
                ->select(
                    'k.id as klien_id', 
                    'k.nama', 
                    'k.no_kp', 
                    'n.negeri', 
                    'd.daerah', 
                    'kk.updated_at', 
                    't.tahap'
                )
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->where('kk.status', 'Selesai')
                ->where('k.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('k.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)             
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->has('from_date_s') && $request->from_date_s != '') {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_s);
        }

        if ($request->has('to_date_s') && $request->to_date_s != '') {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_s);
        }

        if ($request->has('tahap_kepulihan_id') && $request->tahap_kepulihan_id != '') {
            $query->where('kk.tahap_kepulihan_id', $request->tahap_kepulihan_id);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function MKselesaiMenjawabExcelPD(Request $request)
    {
        $filters = [
            'from_date_s' => $request->input('from_date_s'),
            'to_date_s' => $request->input('to_date_s'),
            'tahap_kepulihan_id' => $request->input('tahap_kepulihan_id'),
        ];

        return Excel::download(new MKSelesaiMenjawabExcelPD($filters), 'senarai_klien_selesai_menjawab.xlsx');
    }

    public function PDFselesaiMenjawabPD(Request $request)
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

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_selesai_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Selesai_Menjawab.pdf');
    }

    public function PDFAnalisisModalKepulihanPD(Request $request) 
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        // Fetch filters from request
        $filters = [
            'from_date_s' => $request->from_date_s,
            'to_date_s' => $request->to_date_s,
            'tahap_kepulihan_id' => $request->tahap_kepulihan_id,
        ];

        $sixMonthsAgo = now()->subMonths(6);
        $modalKepulihan = [
            'modal_fizikal', 'modal_psikologi', 'modal_sosial', 'modal_persekitaran', 'modal_insaniah',
            'modal_spiritual', 'modal_rawatan', 'modal_kesihatan', 'modal_strategi_daya_tahan', 'modal_resiliensi'
        ];

        // Fetch data with filters
        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('skor_modal as sm', function ($join) {
                    $join->on('kk.klien_id', '=', 'sm.klien_id')
                        ->on('kk.sesi', '=', 'sm.sesi');
                })
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->select('kk.klien_id', 'kk.skor', 'sm.*')
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->where('kk.status', 'Selesai')
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas);

        // Apply filters if set
        if ($request->filled('from_date_s')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_s);
        }

        if ($request->filled('to_date_s')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_s);
        }

        if ($request->filled('tahap_kepulihan_id')) {
            $query->where('kk.tahap_kepulihan_id', $request->tahap_kepulihan_id);
        }

        $data = collect($query->get());

        // Define categories
        $categories = collect([
            'Sangat Memuaskan' => [3.51, 4.0],
            'Memuaskan' => [2.51, 3.5],
            'Kurang Memuaskan' => [1.51, 2.5],
            'Sangat Tidak Memuaskan' => [1.0, 1.5],
        ]);

        // Count clients per category & modal
        $counts = $categories->mapWithKeys(function ($range, $category) use ($data, $modalKepulihan) {
            return [
                $category => collect($modalKepulihan)->mapWithKeys(function ($modal) use ($data, $range) {
                    return [$modal => $data->filter(fn($item) => $item->$modal >= $range[0] && $item->$modal <= $range[1])->count()];
                })
            ];
        });

        $totalClients = $data->unique('klien_id')->count();

        // Generate PDF
        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_analisis_modal_kepulihan', compact('counts', 'modalKepulihan', 'totalClients'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('analisis_modal_kepulihan.pdf');
    }

    public function excelAnalisisModalKepulihanPD(Request $request)
    {
        $filters = [
            'from_date_s' => $request->from_date_s,
            'to_date_s' => $request->to_date_s,
            'tahap_kepulihan_id' => $request->tahap_kepulihan_id,
        ];
    
        return Excel::download(new AnalisisMKExcelPD($filters), 'Analisis_Modal_Kepulihan.xlsx');
    }

    // PEGAWAI DAERAH - MODAL KEPULIHAN - BELUM SELESAI MENJAWAB
    public function jsonBelumSelesaiMenjawabPD(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('keputusan_kepulihan_klien as kk')
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'd.daerah as nama_daerah',  // Get the actual daerah name
                    'n.negeri as nama_negeri',  // Get the actual negeri name
                    'kk.updated_at',
                    'kk.status' // Assuming there is a status column
                )
                ->where('kk.status', '!=', 'Selesai') // Not completed responses
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'd.daerah', 'n.negeri','kk.updated_at', 'kk.status')
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)                
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->filled('from_date_bs')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_bs);
        }

        if ($request->filled('to_date_bs')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_bs);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function MKBelumSelesaiMenjawabExcelPD(Request $request)
    {
        $filters = [
            'from_date_bs' => $request->input('from_date_bs'),
            'to_date_bs' => $request->input('to_date_bs'),
        ];

        return Excel::download(new MKBelumSelesaiMenjawabExcelPD($filters), 'senarai_klien_belum_selesai_menjawab.xlsx');
    }

    public function PDFBelumSelesaiMenjawabPD(Request $request)
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
                    'kk.tahap_kepulihan_id',
                    'kk.updated_at',
                    'kk.status' // Assuming there is a status column
                )
                ->where('kk.status', '!=', 'Selesai') // Not completed responses
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->whereIn('kk.updated_at', function ($query) {
                    $query->select(DB::raw('MAX(updated_at)'))
                        ->from('keputusan_kepulihan_klien')
                        ->whereColumn('klien_id', 'kk.klien_id')
                        ->groupBy('klien_id');
                })
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah', 'u.negeri', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)                
                ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_bs')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_bs);
        }

        if ($request->filled('to_date_bs')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_bs);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_belum_selesai_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Klien_Belum_Selesai_Menjawab.pdf');
    }

    // PEGAWAI DAERAH - MODAL KEPULIHAN - TIDAK MENJAWAB LEBIH 6 BULAN
    public function jsonTidakMenjawabLebih6BulanPD(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $query = DB::table('klien as u')
                ->join('keputusan_kepulihan_klien as kk', function($join) {
                    $join->on('u.id', '=', 'kk.klien_id')
                        ->whereRaw('kk.updated_at = (SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)');
                })
                ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                ->select(
                    'u.id as klien_id',
                    'u.nama',
                    'u.no_kp',
                    'd.daerah',  // Get the actual daerah name
                    'n.negeri',  // Get the actual negeri name
                    'kk.updated_at',
                )
                ->where('kk.updated_at', '<=', now()->subMonths(6)) // Latest record is more than 6 months old
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)                
                ->orderBy('kk.updated_at', 'desc');

        // Apply Filters
        if ($request->filled('from_date_tm6')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_tm6);
        }

        if ($request->filled('to_date_tm6')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_tm6);
        }

        return response()->json(['data' => $query->get()]);
    }

    public function ExcelTidakMenjawabLebih6BulanPD(Request $request)
    {
        $filters = [
            'from_date_tm6' => $request->input('from_date_tm6'),
            'to_date_tm6' => $request->input('to_date_tm6'),
        ];

        return Excel::download(new MKTidakMenjawabLebih6BulanExcelPN($filters), 'senarai_klien_tidak_menjawab_lebih_6bulan.xlsx');
    }

    public function PDFtidakMenjawabLebih6BulanPD(Request $request)
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
                ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at')
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)                
                ->orderBy('kk.updated_at', 'desc');

        if ($request->filled('from_date_tm6')) {
            $query->whereDate('kk.updated_at', '>=', $request->from_date_tm6);
        }

        if ($request->filled('to_date_tm6')) {
            $query->whereDate('kk.updated_at', '<=', $request->to_date_tm6);
        }

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_tidak_menjawab_lebih_6bulan', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Tidak_Menjawab_Lebih_6Bulan.pdf');
    }

    // PEGAWAI DAERAH - MODAL KEPULIHAN - TIDAK MENJAWAB LEBIH 6 BULAN
    public function jsonTidakPernahMenjawabPD(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        
        $query = DB::table('klien as u')
                    ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                    ->leftJoin('senarai_negeri_pejabat as n', 'u.negeri_pejabat', '=', 'n.negeri_id')
                    ->leftJoin('senarai_daerah_pejabat as d', 'u.daerah_pejabat', '=', 'd.kod')
                    ->select(
                        'u.id as klien_id',
                        'u.nama',
                        'u.no_kp',
                        'd.daerah',  // Get the actual daerah name
                        'n.negeri',  // Get the actual negeri name
                    )
                    ->whereNull('kk.klien_id') // No records in keputusan_kepulihan_klien
                    ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                    ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas);

        return response()->json(['data' => $query->get()]);
    }

    public function ExcelTidakPernahMenjawabPD(Request $request)
    {
        return Excel::download(new MKTidakPernahMenjawabExcelPD, 'senarai_klien_tidak_pernah_menjawab.xlsx');
    }

    public function PDFtidakPernahMenjawabPD(Request $request)
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $query = DB::table('klien as u')
                ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id') // Just a simple left join
                ->whereNull('kk.klien_id') // No records in keputusan_kepulihan_klien
                ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas);

        $filteredData = $query->get();

        $pdf = PDF::loadView('pelaporan.modal_kepulihan.pdf_tidak_pernah_menjawab', compact('filteredData'))->setPaper('a4', 'landscape');
        return $pdf->stream('Senarai_Tidak_Pernah_Menjawab.pdf');
    }


    //AKTIVITI
    //ND - Pegawai Negeri & Daerah
    //PB - Pentadbir & BRPP
    public function pelaporanProgram($id)
    {
        $user = User::find($id);
        $pegawai = Pegawai::where('users_id',$id)->first();
        $program = [];

        if($user){
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $prog = Program::with('kategori')->orderBy('created_at', 'desc')->get();

                foreach ($prog as $item) {
                    // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();

                    $program[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }
                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $prog = Program::with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();

                foreach ($prog as $item) {
                    // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();

                    $program[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }
                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '5') {//pegawai daerah
                $prog = Program::with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->where('daerah_pejabat',$pegawai->daerah_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();

                foreach ($prog as $item) {
                    // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();

                    $program[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }
                return response()->json($program);
            }
        }
        return redirect()->back()->with('error', 'User tidak dijumpai');
    }
    public function analisis() //power bi
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

        return view('pelaporan.aktiviti.analisis', compact('notifications', 'unreadCountPD'));
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

        return view('pelaporan.aktiviti.aktivitiND.senarai_aktiviti',compact('user_id', 'notifications', 'unreadCountPD', 'years','kategori'));
    }

    public function senaraiAktivitiPB(){
        $user_id = Auth::id();
        $negeri = NegeriPejabat::all();

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

        return view('pelaporan.aktiviti.aktivitiPB.senarai_aktiviti',compact('user_id', 'notifications', 'unreadCountPD', 'years','kategori','negeri'));
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

        return view('pelaporan.aktiviti.aktivitiND.filter_senarai_aktiviti', compact('user_id', 'notifications', 'unreadCountPD','tahun','bulan','pKategori','status','years','kategori'));
    }

    public function filterSenaraiAktivitiPB(Request $request)
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
        $pNegeri= $request->input('negeri', null);
        $pDaerah = $request->input('daerah', null);
        $status = $request->input('status', null);

        //available years
        // Get available years from the database
        $years = Program::selectRaw('YEAR(tarikh_mula) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        // Get all category
        $kategori = KategoriProgram::all();
        $negeri = Negeri::all();
        $daerah = DaerahPejabat::where('negeri_id',$pNegeri)->get();
        return view('pelaporan.aktiviti.aktivitiPB.filter_senarai_aktiviti', compact('user_id', 'notifications', 'unreadCountPD','tahun','bulan','pKategori','status','years','kategori','negeri','pNegeri','daerah','pDaerah'));
    }

    public function jsonFilterAktiviti(Request $request,$id)
    {
        $user = User::find($id);
        $pegawai = Pegawai::where('users_id',$id)->first();
        $query = Program::query();

        // Apply filters
        if ($request->tahun) {
            $query->whereYear('tarikh_mula', $request->tahun);
        }
        if ($request->bulan) {
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

    public function jsonFilterAktivitiPB(Request $request,$id)
    {
        $user = User::find($id);
        $pegawai = Pegawai::where('users_id',$id)->first();
        $query = Program::query();

        // Apply filters
        if ($request->tahun) {
            $query->whereYear('tarikh_mula', $request->tahun);
        }
        if ($request->bulan) {
            $query->whereMonth('tarikh_mula', $request->bulan);
        }
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->negeri) {
            $query->where('negeri_pejabat', $request->negeri);
        }
        if ($request->daerah) {
            $query->where('daerah_pejabat', $request->daerah);
        }

        $program = [];

        if($user){
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $prog = $query->with('kategori')->orderBy('created_at', 'desc')->get();

                foreach ($prog as $item) {
                    // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();

                    $program[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }

                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $prog = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();

                foreach ($prog as $item) {
                    // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();

                    $program[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }

                return response()->json($program);
            }
            else if ($user->tahap_pengguna == '5') {//pegawai daerah
                $prog = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->where('daerah_pejabat',$pegawai->daerah_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();

                foreach ($prog as $item) {
                    // Get the state and district names based on the klien's negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();

                    $program[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }

                return response()->json($program);
            }
        }
        return redirect()->back()->with('error', 'User tidak dijumpai');
    }

    public function excelPelaporanAktiviti(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $pegawai = Pegawai::where('users_id',$id)->first();
        $query = Program::query();

        // Apply filters
        if ($request->tahun) {
            $query->whereYear('tarikh_mula', $request->tahun);
        }
        if ($request->bulan) {
            $query->whereMonth('tarikh_mula', $request->bulan);
        }
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->negeri) {
            $query->where('negeri_pejabat', $request->negeri);
        }
        if ($request->daerah) {
            $query->where('daerah_pejabat', $request->daerah);
        }

        $nama_excel = 'pelaporan_senarai_aktiviti.xlsx';

        if($user){
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $program = $query->with('kategori')->orderBy('created_at', 'desc')->get();
                return Excel::download(new PelaporanAktivitiExcel($program), $nama_excel);
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $program = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();
                return Excel::download(new PelaporanAktivitiExcel($program), $nama_excel);
            }
            else if ($user->tahap_pengguna == '5') {//pegawai daerah
                $program = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->where('daerah_pejabat',$pegawai->daerah_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();
                return Excel::download(new PelaporanAktivitiExcel($program), $nama_excel);
            }
        }
        return redirect()->back()->with('error', 'User tidak dijumpai');
    }

    public function pdfPelaporanAktiviti(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $pegawai = Pegawai::where('users_id',$id)->first();
        $query = Program::query();

        // Apply filters
        if ($request->tahun) {
            $query->whereYear('tarikh_mula', $request->tahun);
        }
        if ($request->bulan) {
            $query->whereMonth('tarikh_mula', $request->bulan);
        }
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->negeri) {
            $query->where('negeri_pejabat', $request->negeri);
        }
        if ($request->daerah) {
            $query->where('daerah_pejabat', $request->daerah);
        }

        $nama_pdf = 'rekod_aktiviti.pdf';
        $data = [];

        if($user){
            if ($user->tahap_pengguna == '1' || $user->tahap_pengguna == '3') {//pentadbir or pegawai brpp
                $program = $query->with('kategori')->orderBy('created_at', 'desc')->get();

                foreach ($program as $item) {
                    // Get the state and district names based on the negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();
                    $data[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }

                $pdf = PDF::loadView('pelaporan.aktiviti.pdf_rekod_aktiviti', ['data' => $data])->setPaper('a4','landscape');
                return $pdf->download($nama_pdf);
            }
            else if ($user->tahap_pengguna == '4') {//pegawai negeri
                $program = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();

                foreach ($program as $item) {
                    // Get the state and district names based on the negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();
                    $data[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }

                $pdf = PDF::loadView('pelaporan.aktiviti.pdf_rekod_aktiviti', ['data' => $data])->setPaper('a4','landscape');;
                return $pdf->download($nama_pdf);
            }
            else if ($user->tahap_pengguna == '5') {//pegawai daerah
                $program = $query->with('kategori')
                    ->where('negeri_pejabat',$pegawai->negeri_bertugas)
                    ->where('daerah_pejabat',$pegawai->daerah_bertugas)
                    ->orderBy('created_at', 'desc')
                    ->get();

                foreach ($program as $item) {
                    // Get the state and district names based on the negeri_pejabat and daerah_pejabat
                    $negeri = Negeri::where('id', $item->negeri_pejabat)->first();
                    $daerah = DaerahPejabat::where('kod', $item->daerah_pejabat)->first();
                    $data[] = [
                        'id'        =>  $item->id,
                        'nama'      =>  strtoupper($item->nama),
                        'custom_id' =>  $item->custom_id,
                        'kategori'  =>  strtoupper($item->kategori->nama),
                        'tempat'    =>  strtoupper($item->tempat),
                        'negeri'    =>  strtoupper($negeri) ? $negeri->negeri : 'SEMUA',
                        'daerah'    =>  strtoupper($daerah) ? $daerah->daerah : 'SEMUA',
                        'status'    =>  $item->status,
                    ];
                }

                $pdf = PDF::loadView('pelaporan.aktiviti.pdf_rekod_aktiviti', ['data' => $data])->setPaper('a4','landscape');;
                return $pdf->download($nama_pdf);
            }
        }
        return redirect()->back()->with('error', 'User tidak dijumpai');
    }

    public function pelaporanKehadiran($id)
    {
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

        if ($program) {
            return view('pelaporan.aktiviti.aktivitiND.senarai_kehadiran', compact('program','notifications', 'unreadCountPD'));
        } else {
            return redirect()->back()->with('error', 'Program tidak dijumpai');
        }
    }
}
