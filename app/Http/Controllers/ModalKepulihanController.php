<?php

namespace App\Http\Controllers;

use App\Models\KeputusanKepulihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ResponDemografi;
use App\Models\Klien;
use App\Models\ResponModalKepulihan;
use Carbon\Carbon;

class ModalKepulihanController extends Controller
{
    // KLIEN
    public function soalSelidik()
    {
        $klien = Klien::where('no_kp', Auth::user()->no_kp)->first();
        $clientId = $klien->id;
        $sixMonthsAgo = Carbon::now()->subMonths(6);
       
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

        return view('modal_kepulihan.klien.soalan_selidik', compact('klien', 'butangMula', 'latestRecordKeputusan', 'latestRecordDemografi'));
    }

    public function soalanDemografi()
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $latestRespon = ResponDemografi::where('klien_id', $clientId)
            ->where('updated_at', '>=', $sixMonthsAgo)
            ->orderBy('updated_at', 'desc')
            ->first();

        return view('modal_kepulihan.klien.soalan_demografi', compact('latestRespon'));
    }

    // public function autosaveResponSoalanDemografi(Request $request)
    // {
    //     // Get the client ID from the authenticated user's 'no_kp'
    //     $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

    //     // Get the latest session within the last 6 months
    //     $sixMonthsAgo = Carbon::now()->subMonths(6);
    //     $latestSession = ResponDemografi::where('klien_id', $clientId)
    //         ->where('updated_at', '>=', $sixMonthsAgo)
    //         ->orderBy('updated_at', 'desc')
    //         ->first();

    //     if (!$latestSession || $latestSession->status == 'Selesai') {
    //         // Calculate the new session number
    //         $sessionCount = ResponDemografi::where('klien_id', $clientId)->count() + 1;
    //         $sessionYear = Carbon::now()->year;
    //         $sesi = "{$sessionCount}/{$sessionYear}";

    //         // Create a new session with status 'Belum Selesai'
    //         $latestSession = ResponDemografi::create([
    //             'klien_id' => $clientId,
    //             'sesi' => $sesi,
    //             'status' => 'Belum Selesai'
    //         ]);
    //     }

    //     // Prepare data for insertion/updating
    //     $data = $request->except(['_token', '_method']);
    //     $data['klien_id'] = $clientId;
    //     $data['sesi'] = $latestSession->sesi;
    //     $data['status'] = 'Belum Selesai';

    //     // Ensure 'jenis_dadah' is converted to JSON if it's an array
    //     if (isset($data['jenis_dadah']) && is_array($data['jenis_dadah'])) {
    //         $data['jenis_dadah'] = json_encode($data['jenis_dadah']);
    //     }

    //     // Update the existing record or create a new one if it doesn't exist
    //     ResponDemografi::updateOrCreate(
    //         ['klien_id' => $clientId, 'sesi' => $latestSession->sesi], // Condition to check for existing record
    //         $data // Data to update or create
    //     );

    //     // Return a JSON response
    //     return response()->json(['success' => 'Data autosaved successfully.']);
    // }

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

            $fixedQuestionIds = [5, 9, 24, 28, 49, 60, 62, 120];
            $fixedQuestions = DB::table('soalan_modal_kepulihan')
                ->whereIn('id', $fixedQuestionIds)
                ->get();

            // Ensure we have 5 capital questions
            $capitalQuestions = DB::table('soalan_modal_kepulihan')
                ->whereIn('modal_id', [2, 3, 4, 5, 6, 7, 8, 9, 10, 11])
                ->whereNotIn('id', $fixedQuestionIds)
                ->inRandomOrder()
                ->limit(5)
                ->get();

            // Calculate remaining questions needed to make up 25 in total
            $remainingQuestionsCount = 25 - $fixedQuestions->count() - $capitalQuestions->count();

            // Fetch remaining random questions
            $remainingQuestions = DB::table('soalan_modal_kepulihan')
                ->whereNotIn('id', $fixedQuestions->pluck('id')->toArray())
                ->whereNotIn('id', $capitalQuestions->pluck('id')->toArray())
                ->inRandomOrder()
                ->limit($remainingQuestionsCount)
                ->get();

            $allQuestions = $fixedQuestions->merge($capitalQuestions)->merge($remainingQuestions);
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
        $questions = $questions->take(25)->chunk(10);
        
        // Fetch autosaved answers
        $autosavedAnswers = DB::table('respon_modal_kepulihan')
            ->where('klien_id', $clientId)
            ->pluck('skala_id', 'soalan_id')
            ->toArray();

        return view('modal_kepulihan.klien.soalan_kepulihan', [
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
        
        // dd($latestSessionKeputusan);

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
            5 => 0.103,
            9 => 0.067,
            24 => 0.172,
            28 => 0.176,
            49 => 0.120,
            60 => 0.104,
            62 => 0.223,
            120 => 0.214
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
    public function maklumBalasKepulihan()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // Fetch clients who have responded within the last 6 months
        $responses = DB::table('keputusan_kepulihan_klien as kk')
                    ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                    ->select(
                        'u.id as klien_id',
                        'u.nama',
                        'u.no_kp',
                        'u.daerah_pejabat',
                        'u.negeri_pejabat',
                        DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
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
                    ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
                    ->get();
        
        // Fetch clients who have not responded yet or their last response was over 6 months ago
        $tidakMenjawab = DB::table('klien as u')
                        ->leftJoin('rawatan_klien as rk', 'u.id', '=', 'rk.klien_id')
                        ->leftJoin('keputusan_kepulihan_klien as kk', function($join) {
                            $join->on('u.id', '=', 'kk.klien_id')
                                ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
                        })
                        ->select(
                            'u.id as klien_id',
                            'u.nama',
                            'u.no_kp',
                            'u.daerah_pejabat',
                            'u.negeri_pejabat',
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
                        ->get();

        return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas', compact('responses', 'tidakMenjawab'));
    }

    public function maklumBalasKepulihanBrpp()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // Fetch clients who have responded within the last 6 months
        $responses = DB::table('keputusan_kepulihan_klien as kk')
                    ->join('klien as u', 'kk.klien_id', '=', 'u.id')
                    ->select(
                        'u.id as klien_id',
                        'u.nama',
                        'u.no_kp',
                        'u.daerah_pejabat',
                        'u.negeri_pejabat',
                        DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
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
                    ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
                    ->get();
        
        // Fetch clients who have not responded yet or their last response was over 6 months ago
        $tidakMenjawab = DB::table('klien as u')
                        ->leftJoin('rawatan_klien as rk', 'u.id', '=', 'rk.klien_id')
                        ->leftJoin('keputusan_kepulihan_klien as kk', function($join) {
                            $join->on('u.id', '=', 'kk.klien_id')
                                ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
                        })
                        ->select(
                            'u.id as klien_id',
                            'u.nama',
                            'u.no_kp',
                            'u.daerah_pejabat',
                            'u.negeri_pejabat',
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
                        ->get();

        return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas', compact('responses', 'tidakMenjawab'));
    }

    public function maklumBalasKepulihanNegeri()
    {
        $pegawai = Auth::user();
        $pegawaiNegeri = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // Fetch clients who have responded within the last 6 months
        $responses = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
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
            ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
            ->get();

        // Fetch clients who have not responded yet or their last response was over 6 months ago
        $tidakMenjawab = DB::table('klien as u')
            ->leftJoin('rawatan_klien as rk', 'u.id', '=', 'rk.klien_id')
            ->leftJoin('keputusan_kepulihan_klien as kk', function($join) {
                $join->on('u.id', '=', 'kk.klien_id')
                    ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
            })
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
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
            ->where('u.negeri_pejabat', $pegawaiNegeri->negeri_bertugas)
            ->get();

        return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas', compact('responses', 'tidakMenjawab'));
    }

    public function maklumBalasKepulihanDaerah()
    {
        $pegawai = Auth::user();
        $pegawaiDaerah = DB::table('pegawai')->where('users_id', $pegawai->id)->first();
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // Fetch clients who have responded within the last 6 months
        $responses = DB::table('keputusan_kepulihan_klien as kk')
            ->join('klien as u', 'kk.klien_id', '=', 'u.id')
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
                DB::raw('ROUND(kk.skor, 3) as skor'), // Format skor to 3 decimal places
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
            ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
            ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
            ->groupBy('u.id', 'u.nama', 'u.no_kp', 'u.daerah_pejabat', 'u.negeri_pejabat', 'kk.skor', 'kk.tahap_kepulihan_id', 'kk.updated_at', 'kk.status')
            ->get();

        // Fetch clients who have not responded yet or their last response was over 6 months ago
        $tidakMenjawab = DB::table('klien as u')
            ->leftJoin('rawatan_klien as rk', 'u.id', '=', 'rk.klien_id')
            ->leftJoin('keputusan_kepulihan_klien as kk', function($join) {
                $join->on('u.id', '=', 'kk.klien_id')
                    ->on('kk.updated_at', '=', DB::raw('(SELECT MAX(updated_at) FROM keputusan_kepulihan_klien WHERE klien_id = u.id)'));
            })
            ->select(
                'u.id as klien_id',
                'u.nama',
                'u.no_kp',
                'u.daerah_pejabat',
                'u.negeri_pejabat',
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
            ->where('u.negeri_pejabat', $pegawaiDaerah->negeri_bertugas)
            ->where('u.daerah_pejabat', $pegawaiDaerah->daerah_bertugas)
            ->get();

        return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas', compact('responses', 'tidakMenjawab'));
    }

}
