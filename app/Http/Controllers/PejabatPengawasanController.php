<?php

namespace App\Http\Controllers;

use App\Models\DaerahPejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Klien;
use App\Models\NegeriPejabat;
use App\Models\PejabatPengawasanKlien;
use App\Models\Notifikasi;

class PejabatPengawasanController extends Controller
{
    public function view(Request $request)
    {
        // Retrieve the client's id based on their no_kp
        $pejabatKlien = Klien::where('no_kp', Auth::user()->no_kp)->first();

        $senaraiDaerah = DaerahPejabat::all();
        $senaraiNegeri = NegeriPejabat::all();

        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $unreadCount = 0;
        
        // Fetch notifications for the client
        $notifications = Notifikasi::where('klien_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count unread notifications
        $unreadCount = Notifikasi::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();

        // Return view with all required data
        return view('pejabat_pengawasan.kemaskini', compact('pejabatKlien', 'senaraiDaerah', 'senaraiNegeri','notifications','unreadCount'));
    }

    public function update(Request $request)
    {
        // Validation rules for fields that users can update
        $validatedData = $request->validate([
            'negeri_baharu' => 'required',
            'daerah_baharu' => 'required',
        ], [
            'negeri_baharu.required' => 'Sila pilih Pejabat AADK Negeri Baharu.',
            'daerah_baharu.required' => 'Sila pilih Pejabat AADK Daerah Baharu.',
        ]);

        // Retrieve the client's id based on their no_kp
        $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $klien = Klien::where('id', $klienId)->first();
        $pejabatBaharuKlien = PejabatPengawasanKlien::where('klien_id', $klienId)->first();

        // If PejabatPengawasanKlien exists, update it
        if ($pejabatBaharuKlien) {
            $pejabatBaharuKlien->update([
                'negeri_baru' => $validatedData['negeri_baharu'],
                'daerah_baru' => $validatedData['daerah_baharu'],
                'updated_at' => now(),
            ]);
        } else {
            // If PejabatPengawasanKlien does not exist, create a new row
            PejabatPengawasanKlien::create([
                'klien_id' => $klienId,
                'negeri_asal' => $klien->negeri_pejabat,
                'daerah_asal' => $klien->daerah_pejabat,
                'negeri_baru' => $validatedData['negeri_baharu'],
                'daerah_baru' => $validatedData['daerah_baharu'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Update the klien table
        $klien->update([
            'daerah_pejabat' => $validatedData['daerah_baharu'],
            'negeri_pejabat' => $validatedData['negeri_baharu'],
        ]);

        // Return view with success message
        return redirect()->back()->with('success', 'Pertukaran pejabat pengawasan telah berjaya dikemaskini.');
    }
}
