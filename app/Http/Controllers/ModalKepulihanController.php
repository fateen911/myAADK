<?php

namespace App\Http\Controllers;

use App\Models\KeputusanKepulihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ResponDemografi;
use App\Models\Klien;
use App\Models\ResponModalKepulihan;
use App\Models\NotifikasiKlien;
use App\Models\SkorModal;
use App\Models\NotifikasiPegawaiDaerah;
use App\Models\Pegawai;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ModalKepulihanController extends Controller
{
    // KLIEN
    public function soalSelidik()
    {
        $klien = Klien::where('no_kp', Auth::user()->no_kp)->first();
        $clientId = $klien->id;
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $unreadCount = 0;

        // Fetch the latest record from keputusan_kepulihan_klien for this client within 6 months
        $latestRecordKeputusan = DB::table('keputusan_kepulihan_klien')
                        ->where('klien_id', $clientId)
                        ->orderBy('updated_at', 'desc')
                        ->first();

        // Fetch the latest record from respon_soalan_demografi for this client within 6 months
        $latestRecordDemografi = DB::table('respon_soalan_demografi')
                        ->where('klien_id', $clientId)
                        ->where('updated_at', '>=', $sixMonthsAgo)
                        ->orderBy('updated_at', 'desc')
                        ->first();

        $butangMula = false;

        if (!$latestRecordKeputusan || $latestRecordKeputusan->status == 'Belum Selesai') {
            // If there is no record, the client can click the button or status is Belum Selesai
            $butangMula = true;
        }
        else {
            // Check if the current date is more than 6 months after the updated_at date of $latestRecordKeputusan
            $updatedAt = Carbon::parse($latestRecordKeputusan->updated_at);
            $currentDate = Carbon::now();
            $monthsDifference = $updatedAt->diffInMonths($currentDate);

            if ($monthsDifference > 6) {
                $butangMula = true;
            }
        }

        // Fetch notifications for the client
        $notifications = NotifikasiKlien::where('klien_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count unread notifications
        $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();

        return view('modal_kepulihan.klien.soalan_selidik', compact('klien', 'butangMula', 'latestRecordKeputusan', 'latestRecordDemografi', 'notifications', 'unreadCount'));
    }

    public function soalanDemografi()
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $latestRespon = ResponDemografi::where('klien_id', $clientId)
            ->where('updated_at', '>=', $sixMonthsAgo)
            ->orderBy('updated_at', 'desc')
            ->first();

        
        // Fetch notifications for the client
        $notifications = NotifikasiKlien::where('klien_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count unread notifications
        $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();

        return view('modal_kepulihan.klien.soalan_demografi', compact('latestRespon', 'notifications', 'unreadCount'));
    }

    public function storeResponSoalanDemografi(Request $request)
    {
        // Get the client ID from the authenticated user's 'no_kp'
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        // Get the latest session within the last 6 months
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $latestSession = ResponDemografi::where('klien_id', $clientId)
            ->where('updated_at', '>=', $sixMonthsAgo)
            ->orderBy('updated_at', 'desc')
            ->first();

        // Determine the session to use
        if (!$latestSession || $latestSession->status == 'Selesai') {
            $sessionCount = ResponDemografi::where('klien_id', $clientId)->count() + 1;
            $newSession = $sessionCount . '/' . Carbon::now()->format('Y');
        } else {
            $newSession = $latestSession->sesi;
        }

        // Check if a response already exists for the current session
        $existingResponse = ResponDemografi::where('klien_id', $clientId)
            ->where('sesi', $newSession)
            ->first();

        if ($existingResponse) {
            // Update the existing response
            $existingResponse->rawatan = $request->rawatan;
            $existingResponse->lain_lain_rawatan = $request->lain_lain_rawatan;
            $existingResponse->pusat_rawatan = $request->pusat_rawatan;
            $existingResponse->tempoh_tidak_ambil_dadah = $request->tempoh_tidak_ambil_dadah;
            $existingResponse->kategori = $request->kategori;
            $existingResponse->jumlah_relapse = $request->jumlah_relapse;
            $existingResponse->jenis_dadah = json_encode($request->jenis_dadah);
            $existingResponse->jenis_kediaman = $request->jenis_kediaman;
            $existingResponse->tempoh_tinggal_lokasi_terkini = $request->tempoh_tinggal_lokasi_terkini;
            $existingResponse->tinggal_dengan = $request->tinggal_dengan;
            $existingResponse->kawasan_tempat_tinggal = $request->kawasan_tempat_tinggal;
            $existingResponse->status = 'Belum Selesai';
            $existingResponse->save();
        }
        else {
            // Store a new response
            $respon = new ResponDemografi();
            $respon->klien_id = $clientId;
            $respon->sesi = $newSession;
            $respon->rawatan = $request->rawatan;
            $respon->lain_lain_rawatan = $request->lain_lain_rawatan;
            $respon->pusat_rawatan = $request->pusat_rawatan;
            $respon->tempoh_tidak_ambil_dadah = $request->tempoh_tidak_ambil_dadah;
            $respon->kategori = $request->kategori;
            $respon->jumlah_relapse = $request->jumlah_relapse;
            $respon->jenis_dadah = json_encode($request->jenis_dadah);
            $respon->jenis_kediaman = $request->jenis_kediaman;
            $respon->tempoh_tinggal_lokasi_terkini = $request->tempoh_tinggal_lokasi_terkini;
            $respon->tinggal_dengan = $request->tinggal_dengan;
            $respon->kawasan_tempat_tinggal = $request->kawasan_tempat_tinggal;
            $respon->status = 'Belum Selesai';
            $respon->save();
        }

        return redirect()->route('klien.soalanKepulihan')->with('success', 'Respon soalan demografi berjaya disimpan.');
    }

    public function soalanKepulihan(Request $request)
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $currentPage = (int) $request->input('currentPage', 1);

        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $latestSessionRespon = ResponModalKepulihan::where('klien_id', $clientId)
                                                    ->where('updated_at', '>=', $sixMonthsAgo)
                                                    ->orderBy('updated_at', 'desc')
                                                    ->first();
        $latestSessionKeputusan = KeputusanKepulihan::where('klien_id', $clientId)
                                                    ->where('updated_at', '>=', $sixMonthsAgo)
                                                    ->orderBy('updated_at', 'desc')
                                                    ->first();

        // Determine the session to use
        if (!$latestSessionRespon && !$latestSessionKeputusan) {
            $sessionCount = KeputusanKepulihan::where('klien_id', $clientId)->count() + 1;
            $newSession = $sessionCount . '/' . Carbon::now()->format('Y');
        } else {
            $newSession = $latestSessionRespon ? $latestSessionRespon->sesi : $latestSessionKeputusan->sesi;
        }

        // Check if it's time for a new session
        $isNewSession = !$latestSessionRespon || ($latestSessionRespon && Carbon::parse($latestSessionRespon->updated_at)->lt($sixMonthsAgo));

        // Fetch or generate questions
        if ($isNewSession)
        {
            // Delete previous session's questions
            ResponModalKepulihan::where('klien_id', $clientId)->delete();

            $allQuestions = DB::table('soalan_modal_kepulihan')->get();

            $shuffledQuestions = $allQuestions->shuffle();

            // Save the shuffled order for the client and reset columns
            foreach ($shuffledQuestions as $question) {
                DB::table('respon_modal_kepulihan')->updateOrInsert(
                    ['klien_id' => $clientId, 'soalan_id' => $question->id],
                    ['skala_id' => null, 'status' => 'Baharu', 'sesi' => $newSession, 'created_at' => now(), 'updated_at' => now()]
                );
            }

            $questions = $shuffledQuestions;

            // Create new row in table keputusan kepulihan
            KeputusanKepulihan::create([
                'klien_id' => $clientId,
                'sesi' => $newSession,
                'tahap_kepulihan_id' => null,
                'skor' => null,
                'status' => 'Belum Selesai',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        else {
            // Fetch questions based on saved order
            $savedQuestions = DB::table('respon_modal_kepulihan')
                                ->where('klien_id', $clientId)
                                ->pluck('soalan_id')
                                ->toArray();

            if (!empty($savedQuestions)) {
                $questions = DB::table('soalan_modal_kepulihan')
                                ->whereIn('id', $savedQuestions)
                                ->orderByRaw("FIELD(id, " . implode(',', $savedQuestions) . ")")
                                ->get();
            }
        }

        // Paginate the questions
        $questions = $questions->take(28)->chunk(10);

        // Fetch autosaved answers
        $autosavedAnswers = DB::table('respon_modal_kepulihan')
                                ->where('klien_id', $clientId)
                                ->pluck('skala_id', 'soalan_id')
                                ->toArray();
        
        // Fetch notifications for the client
        $notifications = NotifikasiKlien::where('klien_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count unread notifications
        $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();

            
        return view('modal_kepulihan.klien.soalan_kepulihan3', compact('notifications', 'unreadCount'), [
            'questions' => $questions,
            'autosavedAnswers' => $autosavedAnswers,
            'currentPage' => $currentPage
        ]);
    }

    public function autosaveResponSoalanKepulihan(Request $request)
    {
        $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        foreach ($request->input('answer') as $soalanId => $skalaId) {
            DB::table('respon_modal_kepulihan')
                ->updateOrInsert(
                    ['klien_id' => $klienId, 'soalan_id' => $soalanId],
                    ['skala_id' => $skalaId, 'status' => 'Belum Selesai', 'created_at' => now(), 'updated_at' => now()]
                );
        }

        return response()->json(['success' => true]);
    }

    public function storeResponSoalanKepulihan(Request $request)
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        // This variable holds the date and time of six months ago from the current date and time.
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // Filter the record where the updated_at is greater than or equal to within six months.
        $latestSessionKeputusan = KeputusanKepulihan::where('klien_id', $clientId)
                                                    ->where('updated_at', '>=', $sixMonthsAgo)
                                                    ->orderBy('updated_at', 'desc')
                                                    ->first();

        // Determine the session to use
        if ($latestSessionKeputusan) {
            $newSession = $latestSessionKeputusan->sesi;
        }
        else {
            $sessionCount = KeputusanKepulihan::where('klien_id', $clientId)->count() + 1;
            $newSession = $sessionCount . '/' . Carbon::now()->format('Y');
        }

        // Retrieve the autosaved answers
        $autosavedAnswers = DB::table('respon_modal_kepulihan')
                                ->where('klien_id', $clientId)
                                ->pluck('skala_id', 'soalan_id')
                                ->toArray();

        if (count($autosavedAnswers) == 0) {
            return redirect()->back()->with('error', 'Tiada jawapan yang diterima.');
        }

        // Process the autosaved answers
        $constants = [
            1 => 0.103,
            3 => 0.067,
            4 => 0.172,
            7 => 0.176,
            14 => 0.120,
            17 => 0.104,
            18 => 0.223,
            25 => 0.214
        ];

        $kebarangkalian = -3.433;

        foreach ($autosavedAnswers as $soalanId => $skalaId) {
            DB::table('respon_modal_kepulihan')->updateOrInsert(
                ['klien_id' => $clientId, 'soalan_id' => $soalanId],
                ['skala_id' => $skalaId, 'sesi' => $newSession, 'status' => 'Selesai', 'updated_at' => now()]
            );

            if (array_key_exists($soalanId, $constants)) {
                $kebarangkalian += $constants[$soalanId] * $skalaId;
            }
        }

        $skor = exp($kebarangkalian) / (1 + exp($kebarangkalian));
        $skor = round($skor, 3);

        $tahapKepulihanId = 0;
        if ($skor >= 0.00 && $skor <= 0.25) {
            $tahapKepulihanId = 1;
        } elseif ($skor >= 0.26 && $skor <= 0.50) {
            $tahapKepulihanId = 2;
        } elseif ($skor >= 0.51 && $skor <= 0.75) {
            $tahapKepulihanId = 3;
        } elseif ($skor >= 0.76 && $skor <= 1.00) {
            $tahapKepulihanId = 4;
        }

        DB::table('keputusan_kepulihan_klien')->updateOrInsert(
            ['klien_id' => $clientId, 'sesi' => $newSession],
            ['tahap_kepulihan_id' => $tahapKepulihanId, 'skor' => $skor, 'status' => 'Selesai', 'updated_at' => now()]
        );

        // Modal calculation logic
        $modalMappings = [
            'modal_fizikal' => [1, 2, 3],
            'modal_psikologi' => [4, 5, 6, 7, 8, 9, 10],
            'modal_sosial' => [11, 12, 13, 14, 15],
            'modal_persekitaran' => [16, 17, 18],
            'modal_insaniah' => [19, 20],
            'modal_strategi_daya_tahan' => [24, 25, 26],
            'modal_resiliensi' => [27, 28],
            'modal_spiritual' => [21],
            'modal_rawatan' => [22],
            'modal_kesihatan' => [23],
        ];

        $modalAverages = [];

        foreach ($modalMappings as $modal => $soalanIds) {
            // Get the sum of 'skala' values for the given soalan_ids
            $sumSkala = DB::table('respon_modal_kepulihan')
                        ->whereIn('soalan_id', $soalanIds)
                        ->where('klien_id', $clientId)
                        ->sum('skala_id');
            
            // Calculate the average (sum / count of soalan_ids)
            $average = $sumSkala / count($soalanIds);
            $modalAverages[$modal] = round($average, 2);
        }

        // Insert modal averages into 'skor_modal' table
        DB::table('skor_modal')->updateOrInsert(
            ['klien_id' => $clientId, 'sesi' => $newSession],
            [
                'modal_fizikal' => $modalAverages['modal_fizikal'],
                'modal_psikologi' => $modalAverages['modal_psikologi'],
                'modal_sosial' => $modalAverages['modal_sosial'],
                'modal_persekitaran' => $modalAverages['modal_persekitaran'],
                'modal_insaniah' => $modalAverages['modal_insaniah'],
                'modal_strategi_daya_tahan' => $modalAverages['modal_strategi_daya_tahan'],
                'modal_resiliensi' => $modalAverages['modal_resiliensi'],
                'modal_spiritual' => $modalAverages['modal_spiritual'],
                'modal_rawatan' => $modalAverages['modal_rawatan'],
                'modal_kesihatan' => $modalAverages['modal_kesihatan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Check if a response demografi already exists for the current session
        $existingResponseDemografi = ResponDemografi::where('klien_id', $clientId)
                                    ->where('sesi', $newSession)
                                    ->first();

        // If exists, update the status to 'Selesai'
        if ($existingResponseDemografi) {
            $existingResponseDemografi->update(['status' => 'Selesai']);
        }

        return redirect()->route('klien.soalSelidik')->with('success', 'Respon soal selidik kepulihan telah berjaya dihantar.');
    }

    // PENTADBIR ATAU PEGAWAI
    public function maklumBalasKepulihan(Request $request)
    {
        $pegawai = Auth::user();
        $tahap_kepulihan_id = $request->input('tahap_kepulihan_id'); // Get the filter parameter

        if($pegawai->tahap_pengguna == 5)
        {
            $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
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

            return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas', compact('notifications', 'unreadCountPD','tahap_kepulihan_id'));
        }
        else
        {
            return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas',compact('tahap_kepulihan_id'));
        }
    }

    public function selesaiMenjawabPB(Request $request)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $tahap_kepulihan_id = $request->input('tahap_kepulihan_id');

        $selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
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
                                DB::raw('ROUND(kk.skor, 3) as skor'),
                                't.tahap',
                                'kk.updated_at'
                            )
                            ->where('kk.updated_at', '>=', $sixMonthsAgo) // Only records from the last 6 months
                            ->whereIn('kk.updated_at', function ($query) {
                                $query->select(DB::raw('MAX(updated_at)'))
                                    ->from('keputusan_kepulihan_klien')
                                    ->whereColumn('klien_id', 'kk.klien_id') // Get the latest updated record for each client
                                    ->groupBy('klien_id');
                            })
                            ->where('kk.status', 'Selesai') // Filter for completed status
                            ->when($tahap_kepulihan_id, function ($query, $tahap_kepulihan_id) {
                                return $query->where('kk.tahap_kepulihan_id', $tahap_kepulihan_id); // Filter by tahap_kepulihan if provided
                            })
                            ->orderBy('kk.updated_at', 'desc') // Sort by latest update first
                            ->get();

        if ($selesai_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $selesai_menjawab]);
    }

    public function selesaiMenjawabPN(Request $request)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $tahap_kepulihan_id = $request->input('tahap_kepulihan_id');
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
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
                                't.tahap',
                                'kk.updated_at'
                            )
                            ->where('kk.updated_at', '>=', $sixMonthsAgo) // Only records from the last 6 months
                            ->whereIn('kk.updated_at', function ($query) {
                                $query->select(DB::raw('MAX(updated_at)'))
                                    ->from('keputusan_kepulihan_klien')
                                    ->whereColumn('klien_id', 'kk.klien_id') // Get the latest updated record for each client
                                    ->groupBy('klien_id');
                            })
                            ->where('kk.status', 'Selesai') // Filter for completed status
                            ->where('k.negeri_pejabat', $pegawaiNegeri->negeri_bertugas) // Filter by the logged-in officer's state
                            ->when($tahap_kepulihan_id, function ($query, $tahap_kepulihan_id) {
                                return $query->where('kk.tahap_kepulihan_id', $tahap_kepulihan_id); // Filter by tahap_kepulihan if provided
                            })
                            ->orderBy('kk.updated_at', 'desc') // Sort by latest update first
                            ->get();

        if ($selesai_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $selesai_menjawab]);
    }

    public function selesaiMenjawabPD(Request $request)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $tahap_kepulihan_id = $request->input('tahap_kepulihan_id');
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
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
                                DB::raw('ROUND(kk.skor, 3) as skor'),
                                't.tahap',
                                'kk.updated_at'
                            )
                            ->where('kk.updated_at', '>=', $sixMonthsAgo) // Only records from the last 6 months
                            ->whereIn('kk.updated_at', function ($query) {
                                $query->select(DB::raw('MAX(updated_at)'))
                                    ->from('keputusan_kepulihan_klien')
                                    ->whereColumn('klien_id', 'kk.klien_id') // Get the latest updated record for each client
                                    ->groupBy('klien_id');
                            })
                            ->where('kk.status', 'Selesai') // Filter for completed status
                            ->where('k.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                            ->where('k.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                            ->when($tahap_kepulihan_id, function ($query, $tahap_kepulihan_id) {
                                return $query->where('kk.tahap_kepulihan_id', $tahap_kepulihan_id); // Filter by tahap_kepulihan if provided
                            })
                            ->orderBy('kk.updated_at', 'desc') // Sort by latest update first
                            ->get();

        if ($selesai_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $selesai_menjawab]);
    }

    // AJAX BELUM SELESAI MENJAWAB
    public function belumSelesaiMenjawabPB()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $belum_selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
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
                                    ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                    ->whereIn('kk.updated_at', function ($query) {
                                        $query->select(DB::raw('MAX(updated_at)'))
                                            ->from('keputusan_kepulihan_klien')
                                            ->whereColumn('klien_id', 'kk.klien_id')
                                            ->groupBy('klien_id');
                                    })
                                    ->where('kk.status', 'Belum Selesai')
                                    ->orderBy('kk.updated_at', 'desc')
                                    ->get();

        if ($belum_selesai_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $belum_selesai_menjawab]);
    }

    public function belumSelesaiMenjawabPN()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $belum_selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
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
                                    ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                    ->whereIn('kk.updated_at', function ($query) {
                                        $query->select(DB::raw('MAX(updated_at)'))
                                            ->from('keputusan_kepulihan_klien')
                                            ->whereColumn('klien_id', 'kk.klien_id')
                                            ->groupBy('klien_id');
                                    })
                                    ->where('kk.status', 'Belum Selesai')
                                    ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                    ->orderBy('kk.updated_at', 'desc')
                                    ->get();

        if ($belum_selesai_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $belum_selesai_menjawab]);
    }

    public function belumSelesaiMenjawabPD()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $belum_selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
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
                                    ->where('kk.updated_at', '>=', $sixMonthsAgo)
                                    ->whereIn('kk.updated_at', function ($query) {
                                        $query->select(DB::raw('MAX(updated_at)'))
                                            ->from('keputusan_kepulihan_klien')
                                            ->whereColumn('klien_id', 'kk.klien_id')
                                            ->groupBy('klien_id');
                                    })
                                    ->where('kk.status', 'Belum Selesai')
                                    ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                    ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                    ->orderBy('kk.updated_at', 'desc')
                                    ->get();

        if ($belum_selesai_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $belum_selesai_menjawab]);
    }

    // AJAX TIDAK MENJAWAB LEBIH 6 BULAN
    public function tidakMenjawabLebih6BulanPB()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $tidak_menjawab_lebih_6bulan = DB::table('klien as u')
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
                                        ->where('kk.updated_at', '<=', $sixMonthsAgo)
                                        ->orderBy('kk.updated_at', 'desc')
                                        ->get();

        if ($tidak_menjawab_lebih_6bulan->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $tidak_menjawab_lebih_6bulan]);
    }

    public function tidakMenjawabLebih6BulanPN()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $tidak_menjawab_lebih_6bulan = DB::table('klien as u')
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
                                        ->where('kk.updated_at', '<=', $sixMonthsAgo)
                                        ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                        ->orderBy('kk.updated_at', 'desc')
                                        ->get();

        if ($tidak_menjawab_lebih_6bulan->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $tidak_menjawab_lebih_6bulan]);
    }

    public function tidakMenjawabLebih6BulanPD()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $tidak_menjawab_lebih_6bulan = DB::table('klien as u')
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
                                        ->where('kk.updated_at', '<=', $sixMonthsAgo)
                                        ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                        ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                        ->orderBy('kk.updated_at', 'desc')
                                        ->get();

        if ($tidak_menjawab_lebih_6bulan->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $tidak_menjawab_lebih_6bulan]);
    }

    // AJAX TIDAK PERNAH MENJAWAB
    public function tidakPernahMenjawabPB()
    {
        $tidak_pernah_menjawab = DB::table('klien as u')
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
                                    ->whereNull('kk.klien_id')
                                    ->orderBy('u.nama', 'asc')
                                    ->get();

        if ($tidak_pernah_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $tidak_pernah_menjawab]);
    }

    public function tidakPernahMenjawabPN()
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $tidak_pernah_menjawab = DB::table('klien as u')
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
                                    ->whereNull('kk.klien_id')
                                    ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                                    ->orderBy('u.nama', 'asc')
                                    ->get();

        if ($tidak_pernah_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $tidak_pernah_menjawab]);
    }

    public function tidakPernahMenjawabPD()
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();

        $tidak_pernah_menjawab = DB::table('klien as u')
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
                                    ->whereNull('kk.klien_id')
                                    ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
                                    ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
                                    ->orderBy('u.nama', 'asc')
                                    ->get();

        if ($tidak_pernah_menjawab->isEmpty()) {
            return response()->json(['data' => [], 'message' => 'Tiada data dijumpai']);
        }
        
        return response()->json(['data' => $tidak_pernah_menjawab]);
    }

    // PEGAWAI NEGERI
    // public function maklumBalasKepulihanNegeri(Request $request)
    // {
    //     $pegawai = Auth::user();
    //     $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
    //     $sixMonthsAgo = Carbon::now()->subMonths(6);
    //     $status = $request->input('status');
    //     $tahap_kepulihan_id = $request->input('tahap_kepulihan_id');

    //     // Clients who have responded within the last 6 months (Selesai Menjawab)
    //     $selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
    //         ->join('klien as u', 'kk.klien_id', '=', 'u.id')
    //         ->select(
    //             'u.id as klien_id',
    //             'u.nama',
    //             'u.no_kp',
    //             'u.daerah_pejabat',
    //             'u.negeri_pejabat',
    //             DB::raw('ROUND(kk.skor, 3) as skor'),
    //             'kk.tahap_kepulihan_id',
    //             'kk.status',
    //             'kk.updated_at'
    //         )
    //         ->where('kk.updated_at', '>=', $sixMonthsAgo)
    //         ->whereIn('kk.updated_at', function ($query) {
    //             $query->select(DB::raw('MAX(updated_at)'))
    //                 ->from('keputusan_kepulihan_klien')
    //                 ->whereColumn('klien_id', 'kk.klien_id')
    //                 ->groupBy('klien_id');
    //         })
    //         ->where('kk.status', 'Selesai')
    //         ->when($tahap_kepulihan_id, function ($query, $tahap_kepulihan_id) {
    //             return $query->where('kk.tahap_kepulihan_id', $tahap_kepulihan_id);
    //         })
    //         ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
    //         ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
    //         ->orderBy('kk.updated_at', 'desc')
    //         ->get();

    //     // Clients who started but did not complete (Belum Selesai Menjawab)
    //     $belum_selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
    //         ->join('klien as u', 'kk.klien_id', '=', 'u.id')
    //         ->select(
    //             'u.id as klien_id',
    //             'u.nama',
    //             'u.no_kp',
    //             'u.daerah_pejabat',
    //             'u.negeri_pejabat',
    //             DB::raw('ROUND(kk.skor, 3) as skor'),
    //             'kk.tahap_kepulihan_id',
    //             'kk.status',
    //             'kk.updated_at'
    //         )
    //         ->where('kk.updated_at', '>=', $sixMonthsAgo)
    //         ->whereIn('kk.updated_at', function ($query) {
    //             $query->select(DB::raw('MAX(updated_at)'))
    //                 ->from('keputusan_kepulihan_klien')
    //                 ->whereColumn('klien_id', 'kk.klien_id')
    //                 ->groupBy('klien_id');
    //         })
    //         ->where('kk.status', '!=', 'Selesai') // Not completed responses
    //         ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
    //         ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
    //         ->orderBy('kk.updated_at', 'desc')
    //         ->get();

    //     // Clients who last responded more than 6 months ago (Tidak Menjawab Lebih 6 Bulan)
    //     $tidak_menjawab_lebih_6bulan = DB::table('keputusan_kepulihan_klien as kk')
    //         ->join('klien as u', 'kk.klien_id', '=', 'u.id')
    //         ->select(
    //             'u.id as klien_id',
    //             'u.nama',
    //             'u.no_kp',
    //             'u.daerah_pejabat',
    //             'u.negeri_pejabat',
    //             DB::raw('ROUND(kk.skor, 3) as skor'),
    //             'kk.tahap_kepulihan_id',
    //             'kk.updated_at'
    //         )
    //         ->where('kk.updated_at', '<=', $sixMonthsAgo)
    //         ->whereIn('kk.updated_at', function ($query) {
    //             $query->select(DB::raw('MAX(updated_at)'))
    //                 ->from('keputusan_kepulihan_klien')
    //                 ->whereColumn('klien_id', 'kk.klien_id')
    //                 ->groupBy('klien_id');
    //         })
    //         ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
    //         ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at')
    //         ->orderBy('kk.updated_at', 'desc')
    //         ->get();

    //     // Clients who have never responded (Tidak Pernah Menjawab)
    //     $tidak_pernah_menjawab = DB::table('klien as u')
    //         ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id')
    //         ->select(
    //             'u.id as klien_id',
    //             'u.nama',
    //             'u.no_kp',
    //             'u.daerah_pejabat',
    //             'u.negeri_pejabat'
    //         )
    //         ->whereNull('kk.klien_id') // No response record found
    //         ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
    //         ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat')
    //         ->get();

    //     return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas', compact('selesai_menjawab','belum_selesai_menjawab','tidak_menjawab_lebih_6bulan','tidak_pernah_menjawab'));
    // }

    // public function maklumBalasKepulihanDaerah(Request $request)
    // {
    //     $pegawai = Auth::user();
    //     $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
    //     $sixMonthsAgo = Carbon::now()->subMonths(6);
    //     $status = $request->input('status');
    //     $tahap_kepulihan_id = $request->input('tahap_kepulihan_id');

    //     // Clients who have responded within the last 6 months (Selesai Menjawab)
    //     $selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
    //         ->join('klien as u', 'kk.klien_id', '=', 'u.id')
    //         ->select(
    //             'u.id as klien_id',
    //             'u.nama',
    //             'u.no_kp',
    //             'u.daerah_pejabat',
    //             'u.negeri_pejabat',
    //             DB::raw('ROUND(kk.skor, 3) as skor'),
    //             'kk.tahap_kepulihan_id',
    //             'kk.status',
    //             'kk.updated_at'
    //         )
    //         ->where('kk.updated_at', '>=', $sixMonthsAgo)
    //         ->whereIn('kk.updated_at', function ($query) {
    //             $query->select(DB::raw('MAX(updated_at)'))
    //                 ->from('keputusan_kepulihan_klien')
    //                 ->whereColumn('klien_id', 'kk.klien_id')
    //                 ->groupBy('klien_id');
    //         })
    //         ->where('kk.status', 'Selesai')
    //         ->when($tahap_kepulihan_id, function ($query, $tahap_kepulihan_id) {
    //             return $query->where('kk.tahap_kepulihan_id', $tahap_kepulihan_id);
    //         })
    //         ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
    //         ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
    //         ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
    //         ->orderBy('kk.updated_at', 'desc')
    //         ->get();

    //     // Clients who started but did not complete (Belum Selesai Menjawab)
    //     $belum_selesai_menjawab = DB::table('keputusan_kepulihan_klien as kk')
    //         ->join('klien as u', 'kk.klien_id', '=', 'u.id')
    //         ->select(
    //             'u.id as klien_id',
    //             'u.nama',
    //             'u.no_kp',
    //             'u.daerah_pejabat',
    //             'u.negeri_pejabat',
    //             DB::raw('ROUND(kk.skor, 3) as skor'),
    //             'kk.tahap_kepulihan_id',
    //             'kk.status',
    //             'kk.updated_at'
    //         )
    //         ->where('kk.updated_at', '>=', $sixMonthsAgo)
    //         ->whereIn('kk.updated_at', function ($query) {
    //             $query->select(DB::raw('MAX(updated_at)'))
    //                 ->from('keputusan_kepulihan_klien')
    //                 ->whereColumn('klien_id', 'kk.klien_id')
    //                 ->groupBy('klien_id');
    //         })
    //         ->where('kk.status', '!=', 'Selesai') // Not completed responses
    //         ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
    //         ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
    //         ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
    //         ->orderBy('kk.updated_at', 'desc')
    //         ->get();

    //     // Clients who last responded more than 6 months ago (Tidak Menjawab Lebih 6 Bulan)
    //     $tidak_menjawab_lebih_6bulan = DB::table('keputusan_kepulihan_klien as kk')
    //         ->join('klien as u', 'kk.klien_id', '=', 'u.id')
    //         ->select(
    //             'u.id as klien_id',
    //             'u.nama',
    //             'u.no_kp',
    //             'u.daerah_pejabat',
    //             'u.negeri_pejabat',
    //             DB::raw('ROUND(kk.skor, 3) as skor'),
    //             'kk.tahap_kepulihan_id',
    //             'kk.updated_at'
    //         )
    //         ->where('kk.updated_at', '<=', $sixMonthsAgo)
    //         ->whereIn('kk.updated_at', function ($query) {
    //             $query->select(DB::raw('MAX(updated_at)'))
    //                 ->from('keputusan_kepulihan_klien')
    //                 ->whereColumn('klien_id', 'kk.klien_id')
    //                 ->groupBy('klien_id');
    //         })
    //         ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
    //         ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
    //         ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at')
    //         ->orderBy('kk.updated_at', 'desc')
    //         ->get();

    //     // Clients who have never responded (Tidak Pernah Menjawab)
    //     $tidak_pernah_menjawab = DB::table('klien as u')
    //         ->leftJoin('keputusan_kepulihan_klien as kk', 'u.id', '=', 'kk.klien_id')
    //         ->select(
    //             'u.id as klien_id',
    //             'u.nama',
    //             'u.no_kp',
    //             'u.daerah_pejabat',
    //             'u.negeri_pejabat'
    //         )
    //         ->whereNull('kk.klien_id') // No response record found
    //         ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
    //         ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
    //         ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat')
    //         ->get();


    //     // Fetch notifications where daerah_bertugas matches daerah_aadk_lama (for message1)
    //     $notificationsLama = NotifikasiPegawaiDaerah::where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
    //     ->select('id', 'message1', 'created_at', 'is_read1')
    //     ->get();

    //     // Fetch notifications where daerah_bertugas matches daerah_aadk_baru (for message2)
    //     $notificationsBaru = NotifikasiPegawaiDaerah::where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
    //             ->select('id', 'message2', 'created_at', 'is_read2')
    //             ->get();
                

    //     // Combine and sort notifications by created_at descending
    //     $notifications = $notificationsLama->merge($notificationsBaru)->sortByDesc('created_at');

    //     // Correct unread count calculation for logged-in user's daerah_bertugas
    //     $unreadCountPD = NotifikasiPegawaiDaerah::where(function ($query) use ($pegawaiDaerah) {
    //                         $query->where(function ($subQuery) use ($pegawaiDaerah) {
    //                             $subQuery->where('daerah_aadk_lama', $pegawaiDaerah->daerah_bertugas)
    //                                 ->where('is_read1', false);
    //                         })->orWhere(function ($subQuery) use ($pegawaiDaerah) {
    //                             $subQuery->where('daerah_aadk_baru', $pegawaiDaerah->daerah_bertugas)
    //                                 ->where('is_read2', false);
    //                         });
    //                     })->count();

    //     return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas', compact( 'selesai_menjawab','belum_selesai_menjawab', 'tidak_menjawab_lebih_6bulan', 'tidak_pernah_menjawab', 'notifications', 'unreadCountPD'));
    // }

    public function sejarahSoalSelidik($klien_id)
    {
        // Fetch the main history data
        $sejarah = DB::table('keputusan_kepulihan_klien as kk')
                    ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                    ->select(
                        'u.nama',
                        'u.no_kp',
                        'kk.skor',
                        'kk.tahap_kepulihan_id',
                        'kk.status',
                        'kk.updated_at',
                        'kk.klien_id',
                        'kk.sesi'
                    )
                    ->where('kk.klien_id', $klien_id)
                    ->orderBy('kk.updated_at', 'desc')
                    ->get();

        $clientModals = SkorModal::where('klien_id', $klien_id)->orderBy('sesi')->get();

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

        return view('modal_kepulihan.pentadbir_pegawai.sejarah_soal_selidik', compact('sejarah', 'clientModals', 'notifications', 'unreadCountPD'));
    }

    public function exportPDFAnalisisMK()
    {
        // Fetch data based on 'selesai_menjawab' status
        $sixMonthsAgo = now()->subMonths(6);
        
        // Define the modal kepulihan categories
        $modalKepulihan = [
            'modal_fizikal', 'modal_psikologi', 'modal_sosial', 'modal_persekitaran', 'modal_insaniah',
            'modal_spiritual', 'modal_rawatan', 'modal_kesihatan', 'modal_strategi_daya_tahan', 'modal_resiliensi'
        ];

        // Get clients who completed the assessment
        $data = DB::table('keputusan_kepulihan_klien as kk')
            ->join('skor_modal as sm', function ($join) {
                $join->on('kk.klien_id', '=', 'sm.klien_id')
                    ->on('kk.sesi', '=', 'sm.sesi'); // Ensure same session
            })
            ->select('kk.klien_id', 'kk.skor', 'sm.*')
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->where('kk.status', 'Selesai')
            ->get();

        // Define categories
        $categories = [
            'Sangat Memuaskan' => [3.51, 4.0],
            'Memuaskan' => [2.51, 3.5],
            'Kurang Memuaskan' => [1.51, 2.5],
            'Sangat Tidak Memuaskan' => [1.0, 1.5],
        ];

        // Count clients in each category for each modal kepulihan
        $counts = [];
        foreach ($categories as $category => [$min, $max]) {
            foreach ($modalKepulihan as $modal) {
                $counts[$category][$modal] = $data->whereBetween($modal, [$min, $max])->count();
            }
        }

        $totalClients = $data->unique('klien_id')->count();

        // Generate PDF
        $pdf = PDF::loadView('modal_kepulihan.pentadbir_pegawai.pdf_analisis_modal_kepulihan', compact('counts', 'modalKepulihan', 'totalClients'))->setPaper('a4', 'landscape');
        return $pdf->stream('analisis_modal_kepulihan.pdf');
    }

    public function exportPDFAnalisisMKNegeri()
    {
        // Fetch data based on the latest six month
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = now()->subMonths(6);
        
        // Define the modal kepulihan categories
        $modalKepulihan = [
            'modal_fizikal', 'modal_psikologi', 'modal_sosial', 'modal_persekitaran', 'modal_insaniah',
            'modal_spiritual', 'modal_rawatan', 'modal_kesihatan', 'modal_strategi_daya_tahan', 'modal_resiliensi'
        ];

        // Get clients who completed the assessment
        $data = DB::table('keputusan_kepulihan_klien as kk')
                ->join('skor_modal as sm', function ($join) {
                    $join->on('kk.klien_id', '=', 'sm.klien_id')
                        ->on('kk.sesi', '=', 'sm.sesi'); // Ensure same session
                })
                ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                ->select(
                    'u.id as klien_id',
                    'u.daerah_pejabat',
                    'u.negeri_pejabat',
                )
                ->select('kk.klien_id', 'kk.skor', 'sm.*')
                ->where('kk.updated_at', '>=', $sixMonthsAgo)
                ->where('kk.status', 'Selesai')
                ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
                ->get();

        // Define categories
        $categories = [
            'Sangat Memuaskan' => [3.51, 4.0],
            'Memuaskan' => [2.51, 3.5],
            'Kurang Memuaskan' => [1.51, 2.5],
            'Sangat Tidak Memuaskan' => [1.0, 1.5],
        ];

        // Count clients in each category for each modal kepulihan
        $counts = [];
        foreach ($categories as $category => [$min, $max]) {
            foreach ($modalKepulihan as $modal) {
                $counts[$category][$modal] = $data->whereBetween($modal, [$min, $max])->count();
            }
        }

        $totalClients = $data->unique('klien_id')->count();

        // Generate PDF
        $pdf = PDF::loadView('modal_kepulihan.pentadbir_pegawai.pdf_analisis_modal_kepulihan', compact('counts', 'modalKepulihan', 'totalClients'))->setPaper('a4', 'landscape');
        return $pdf->stream('analisis_modal_kepulihan.pdf');
    }

    public function exportPDFAnalisisMKDaerah()
    {
        // Fetch data based on 'selesai_menjawab' status
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = now()->subMonths(6);
        
        // Define the modal kepulihan categories
        $modalKepulihan = [
            'modal_fizikal', 'modal_psikologi', 'modal_sosial', 'modal_persekitaran', 'modal_insaniah',
            'modal_spiritual', 'modal_rawatan', 'modal_kesihatan', 'modal_strategi_daya_tahan', 'modal_resiliensi'
        ];

        // Get clients who completed the assessment
        $data = DB::table('keputusan_kepulihan_klien as kk')
            ->join('skor_modal as sm', function ($join) {
                $join->on('kk.klien_id', '=', 'sm.klien_id')
                    ->on('kk.sesi', '=', 'sm.sesi'); // Ensure same session
            })
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
            )
            ->select('kk.klien_id', 'kk.skor', 'sm.*')
            ->where('kk.updated_at', '>=', $sixMonthsAgo)
            ->where('kk.status', 'Selesai')
            ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
            ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
            ->get();

        // Define categories
        $categories = [
            'Sangat Memuaskan' => [3.51, 4.0],
            'Memuaskan' => [2.51, 3.5],
            'Kurang Memuaskan' => [1.51, 2.5],
            'Sangat Tidak Memuaskan' => [1.0, 1.5],
        ];

        // Count clients in each category for each modal kepulihan
        $counts = [];
        foreach ($categories as $category => [$min, $max]) {
            foreach ($modalKepulihan as $modal) {
                $counts[$category][$modal] = $data->whereBetween($modal, [$min, $max])->count();
            }
        }

        $totalClients = $data->unique('klien_id')->count();

        // Generate PDF
        $pdf = PDF::loadView('modal_kepulihan.pentadbir_pegawai.pdf_analisis_modal_kepulihan', compact('counts', 'modalKepulihan', 'totalClients'))->setPaper('a4', 'landscape');
        return $pdf->stream('analisis_modal_kepulihan.pdf');
    }

}
