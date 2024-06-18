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
        return view('modal_kepulihan.klien.soalan_demografi');
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
        return redirect()->route('klien.soalanKepulihan')->with('success', 'Respon demografi telah disimpan.');
    }

    public function soalanKepulihan()
    {
        // Fetch 13 fixed questions (assuming modal_id ranges or specific IDs are known)
        $fixedQuestions = DB::table('soalan_modal_kepulihan')
                            ->whereIn('modal_id', [2, 3, 4, 5, 6, 7, 8, 9, 10, 11]) // Adjust according to your fixed modal_id values
                            ->limit(13)
                            ->get();

        // Fetch remaining 126 questions
        $remainingQuestions = DB::table('soalan_modal_kepulihan')
                                ->whereNotIn('id', $fixedQuestions->pluck('id')->toArray())
                                ->whereIn('modal_id', [2, 3, 4, 5, 6, 7, 8, 9, 10, 11])
                                ->inRandomOrder()
                                ->limit(12)
                                ->get();

        // Combine both sets of questions
        $allQuestions = $fixedQuestions->merge($remainingQuestions);

        return view('modal_kepulihan.klien.soalan_kepulihan', ['questions' => $allQuestions]);
    }

    public function storeResponSoalanKepulihan(Request $request)
    {
        $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        foreach ($request->input('answer') as $soalanId => $skalaId) {
            DB::table('respon_modal_kepulihan')->insert([
                'klien_id' => $klienId,
                'soalan_id' => $soalanId,
                'skala_id' => $skalaId,
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('klien.soalSelidik')->with('success', 'Respon soal selidik kepulihan telah disimpan.');
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
