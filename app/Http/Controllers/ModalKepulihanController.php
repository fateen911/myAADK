<?php

namespace App\Http\Controllers;

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

    public function storeDemografi(Request $request)
    {
        // Get the client ID from the authenticated user's 'no_kp'
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        // Create an array of the data to be stored
        $data = $request->all();
        $data['klien_id'] = $clientId;

        // Ensure 'jenis_dadah' is converted to JSON if it's an array
        if (isset($data['jenis_dadah']) && is_array($data['jenis_dadah'])) {
            $data['jenis_dadah'] = json_encode($data['jenis_dadah']);
        }

        // Create the demographic response
        ResponDemografi::create($data);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Respon demografi telah disimpan.');
    }

    public function soalanKepulihan()
    {
        return view('modal_kepulihan.klien.soalan_kepulihan');
    }

}
