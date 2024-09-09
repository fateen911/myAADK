<?php

namespace App\Http\Controllers;

use App\Models\DaerahPejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Klien;
use App\Models\NegeriPejabat;
use App\Models\PejabatPengawasanKlien;

class PejabatPengawasanController extends Controller
{
    public function view(Request $request)
    {
        // Retrieve the client's id based on their no_kp
        $pejabatKlien = Klien::where('no_kp', Auth::user()->no_kp)->first();

        $senaraiDaerah = DaerahPejabat::all();
        $senaraiNegeri = NegeriPejabat::all();

        // Return view with all required data
        return view('pejabat_pengawasan.kemaskini', compact('pejabatKlien', 'senaraiDaerah', 'senaraiNegeri'));
    }

    public function update(Request $request)
    {
        // Retrieve the client's id based on their no_kp
        $klienId = Klien::where('no_kp',Auth::user()->no_kp)->value('id');
        $klien = Klien::where('id', $klienId)->first();
        $pejabatBaharuKlien = PejabatPengawasanKlien::where('klien_id', $klienId)->first();

        if ($pejabatBaharuKlien)
        {
            $pejabatBaharuKlien->update([
                'negeri_baru' => $request->negeri_baharu,
                'daerah_baru' => $request->daerah_baharu, 
                'updated_at' => now(),
            ]);

            $klien->update([
                'daerah_pejabat' => $request->daerah_baharu,
                'negeri_pejabat' => $request->negeri_baharu,
            ]);
        }

        // Return view with all required data
        return redirect()->back()->with('success', 'Pertukaran pejabat pengawasan telah berjaya dikemaskini.');
    }

}
