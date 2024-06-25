<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ResponDemografi;
use App\Models\Klien;

class ModalKepulihanController extends Controller
{
    // KLIEN
    public function soalSelidik()
    {
        return view('modal_kepulihan.klien.soalan_selidik');
    }

    public function soalanDemografi()
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $respon = ResponDemografi::where('klien_id', $clientId)->first();

        return view('modal_kepulihan.klien.soalan_demografi', compact('respon'));
    }

    public function autosaveResponSoalanDemografi(Request $request)
    {
        // Get the client ID from the authenticated user's 'no_kp'
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        // Prepare data for insertion/updating
        $data = $request->all();
        $data['klien_id'] = $clientId;

        // Ensure 'jenis_dadah' is converted to JSON if it's an array
        if (isset($data['jenis_dadah']) && is_array($data['jenis_dadah'])) {
            $data['jenis_dadah'] = json_encode($data['jenis_dadah']);
        }

        // Update existing record or create a new one if it doesn't exist
        ResponDemografi::updateOrCreate(
            ['klien_id' => $clientId], // Condition to check for existing record
            $data // Data to update/create
        );

        // Return a JSON response
        return response()->json(['success' => 'Data autosaved successfully.']);
    }


    public function storeResponSoalanDemografi(Request $request)
    {
        // Get the client ID from the authenticated user's 'no_kp'
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        // Prepare data for insertion/updating
        $data = $request->all();
        $data['klien_id'] = $clientId;

        // Ensure 'jenis_dadah' is converted to JSON if it's an array
        if (isset($data['jenis_dadah']) && is_array($data['jenis_dadah'])) {
            $data['jenis_dadah'] = json_encode($data['jenis_dadah']);
        }

        // Update existing record or create a new one if it doesn't exist
        ResponDemografi::updateOrCreate(
            ['klien_id' => $clientId], // Condition to check for existing record
            $data // Data to update/create
        );

        // Redirect to the desired route with a success message
        return redirect()->route('klien.soalanKepulihan')->with('success', 'Respon demografi telah berjaya dihantar.');
    }

    public function soalanKepulihan()
    {
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        // Check if the client has previously saved questions
        $savedQuestions = DB::table('respon_modal_kepulihan')
                            ->where('klien_id', $clientId)
                            ->pluck('soalan_id')
                            ->toArray();

        if (!empty($savedQuestions)) {
            // Fetch the questions in the order they were previously saved
            $questions = DB::table('soalan_modal_kepulihan')
                        ->whereIn('id', $savedQuestions)
                        ->orderByRaw("FIELD(id, " . implode(',', $savedQuestions) . ")")
                        ->get();
        } else {
            // Fetch 8 fixed questions with specific IDs
            $fixedQuestionIds = [5, 9, 24, 28, 49, 60, 62, 120];
            $fixedQuestions = DB::table('soalan_modal_kepulihan')
                                ->whereIn('id', $fixedQuestionIds)
                                ->get();

            // Fetch 5 questions representing each recovery capital
            $capitalQuestions = DB::table('soalan_modal_kepulihan')
                                ->whereIn('modal_id', [2, 3, 4, 5, 6, 7, 8, 9, 10, 11])
                                ->whereNotIn('id', $fixedQuestionIds)
                                ->inRandomOrder()
                                ->limit(5)
                                ->get();

            // Merge the 13 fixed questions
            $fixedQuestions = $fixedQuestions->merge($capitalQuestions);

            // Fetch remaining questions excluding the already selected ones
            $remainingQuestions = DB::table('soalan_modal_kepulihan')
                                    ->whereNotIn('id', $fixedQuestions->pluck('id')->toArray())
                                    ->inRandomOrder()
                                    ->limit(12)
                                    ->get();

            // Combine both sets of questions
            $allQuestions = $fixedQuestions->merge($remainingQuestions);

            // Shuffle the questions to ensure randomness for every client
            $shuffledQuestions = $allQuestions->shuffle();

            // Save the shuffled order for the first time with status as "Baharu"
            foreach ($shuffledQuestions as $question) {
                DB::table('respon_modal_kepulihan')->insert([
                    'klien_id' => $clientId,
                    'soalan_id' => $question->id,
                    'skala_id' => null, // No answer yet
                    'status' => 'Baharu', // Setting the status to Baharu
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            $questions = $shuffledQuestions;
        }

        // Fetch autosaved answers
        $autosavedAnswers = DB::table('respon_modal_kepulihan')
        ->where('klien_id', $clientId)
        ->pluck('skala_id', 'soalan_id')
        ->toArray();

        return view('modal_kepulihan.klien.soalan_kepulihan', ['questions' => $questions,'autosavedAnswers' => $autosavedAnswers]);
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

        foreach ($request->input('answer') as $soalanId => $skalaId) {
            DB::table('respon_modal_kepulihan')->updateOrInsert(
                ['klien_id' => $clientId, 'soalan_id' => $soalanId],
                ['skala_id' => $skalaId, 'status' => 'Selesai', 'updated_at' => now()]
            );
        }

        return redirect()->route('klien.soalSelidik')->with('success', 'Respon soal selidik kepulihan telah berjaya dihantar.');
    }

    // PENTADBIR ATAU PEGAWAI
    public function maklumBalasKepulihan()
    {
        $responses = DB::table('respon_modal_kepulihan as rm')
        ->join('klien as u', 'rm.klien_id', '=', 'u.id')
        ->select('u.nama', 'u.no_kp', 'u.daerah', 'u.negeri', DB::raw('MAX(rm.status) as status'))
        ->groupBy('rm.klien_id')
        ->get();

        return view('modal_kepulihan.pentadbir_pegawai.senarai_maklum_balas', compact('responses'));
    }

}
