<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Klien;
use App\Models\NegeriPejabat;
use App\Models\DaerahPejabat;
use App\Models\Negeri;
use App\Models\Daerah;
use App\Models\PejabatPengawasanKlien;
use App\Models\NotifikasiKlien;
use App\Models\NotifikasiPegawaiDaerah;

class PejabatPengawasanController extends Controller
{
    public function view(Request $request)
    {
        // Retrieve the client's id based on their no_kp
        $pejabatKlien = Klien::where('no_kp', Auth::user()->no_kp)->first();

        $senaraiDaerah = DaerahPejabat::all();
        $senaraiNegeri = NegeriPejabat::all();

        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');

        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $unreadCount = 0;
        
        // Fetch notifications for the client
        $notifications = NotifikasiKlien::where('klien_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count unread notifications
        $unreadCount = NotifikasiKlien::where('klien_id', $clientId)
            ->where('is_read', false)
            ->count();

        // Return view with all required data
        return view('pejabat_pengawasan.kemaskini', compact('pejabatKlien', 'senaraiDaerah', 'senaraiNegeri', 'negeri', 'daerah', 'notifications', 'unreadCount'));
    }

    public function update(Request $request)
    {
        // Validation rules for all fields
        $validatedData = $request->validate([
            'negeri_baharu' => 'required',
            'daerah_baharu' => 'required',
            'alamat_rumah'  => 'required|string|max:255',
            'poskod'        => 'required|string|max:5',
            'negeri'        => 'required',
            'daerah'        => 'required',
        ], [
            'negeri_baharu.required'    => 'Sila pilih Pejabat AADK Negeri Baharu.',
            'daerah_baharu.required'    => 'Sila pilih Pejabat AADK Daerah Baharu.',
            'alamat_rumah.required'     => 'Sila isi alamat rumah baharu anda.',
            'poskod.required'           => 'Sila isi poskod rumah baharu anda.',
            'poskod.digits'             => 'Poskod mesti mengandungi 5 digit.',
            'negeri.required'           => 'Sila pilih negeri rumah baharu anda.',
            'daerah.required'           => 'Sila pilih daerah rumah baharu anda.',
        ]);

        // Retrieve the client's ID based on their no_kp
        $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
        $klien = Klien::where('id', $klienId)->first();
        $pejabatBaharuKlien = PejabatPengawasanKlien::where('klien_id', $klienId)->first();

        // Update or create the PejabatPengawasanKlien record
        if ($pejabatBaharuKlien) {
            $pejabatBaharuKlien->update([
                'negeri_aadk_asal' => $klien->negeri_pejabat,
                'daerah_aadk_asal' => $klien->daerah_pejabat,
                'negeri_aadk_baru' => $validatedData['negeri_baharu'],
                'daerah_aadk_baru' => $validatedData['daerah_baharu'],
                'alamat_rumah_baru' => $validatedData['alamat_rumah'],
                'poskod_rumah_baru' => $validatedData['poskod'],
                'negeri_rumah_baru' => $validatedData['negeri'],
                'daerah_rumah_baru' => $validatedData['daerah'],
                'updated_at' => now(),
            ]);
        } else {
            PejabatPengawasanKlien::create([
                'klien_id' => $klienId,
                'negeri_aadk_asal' => $klien->negeri_pejabat,
                'daerah_aadk_asal' => $klien->daerah_pejabat,
                'negeri_aadk_baru' => $validatedData['negeri_baharu'],
                'daerah_aadk_baru' => $validatedData['daerah_baharu'],
                'alamat_rumah_baru' => $validatedData['alamat_rumah'],
                'poskod_rumah_baru' => $validatedData['poskod'],
                'negeri_rumah_baru' => $validatedData['negeri'],
                'daerah_rumah_baru' => $validatedData['daerah'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Update the Klien table
        $klien->update([
            'negeri_pejabat' => $validatedData['negeri_baharu'],
            'daerah_pejabat' => $validatedData['daerah_baharu'],
        ]);

        // Create a notification for the new daerah
        NotifikasiPegawaiDaerah::create([
            'klien_id' => $klienId,
            'message' => "Klien {$klien->nama} telah membuat pertukaran pejabat pengawasan.",
            'daerah_aadk_asal' => $klien->daerah_pejabat,
            'daerah_aadk_baru' => $validatedData['negeri_baharu'],
            'is_read' => false,
        ]);

        // Return with success message
        return redirect()->back()->with('success', 'Pertukaran pejabat pengawasan telah berjaya dikemaskini.');
    }


    // public function update(Request $request)
    // {
    //     // Validation rules for fields that users can update
    //     $validatedData = $request->validate([
    //         'negeri_baharu' => 'required',
    //         'daerah_baharu' => 'required',
    //     ], [
    //         'negeri_baharu.required' => 'Sila pilih Pejabat AADK Negeri Baharu.',
    //         'daerah_baharu.required' => 'Sila pilih Pejabat AADK Daerah Baharu.',
    //     ]);

    //     // Retrieve the client's id based on their no_kp
    //     $klienId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');
    //     $klien = Klien::where('id', $klienId)->first();
    //     $pejabatBaharuKlien = PejabatPengawasanKlien::where('klien_id', $klienId)->first();

    //     // If PejabatPengawasanKlien exists, update it
    //     if ($pejabatBaharuKlien) {
    //         $pejabatBaharuKlien->update([
    //             'negeri_baru' => $validatedData['negeri_baharu'],
    //             'daerah_baru' => $validatedData['daerah_baharu'],
    //             'updated_at' => now(),
    //         ]);
    //     } else {
    //         // If PejabatPengawasanKlien does not exist, create a new row
    //         PejabatPengawasanKlien::create([
    //             'klien_id' => $klienId,
    //             'negeri_asal' => $klien->negeri_pejabat,
    //             'daerah_asal' => $klien->daerah_pejabat,
    //             'negeri_baru' => $validatedData['negeri_baharu'],
    //             'daerah_baru' => $validatedData['daerah_baharu'],
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }

    //     // Update the klien table
    //     $klien->update([
    //         'daerah_pejabat' => $validatedData['daerah_baharu'],
    //         'negeri_pejabat' => $validatedData['negeri_baharu'],
    //     ]);

    //     // Return view with success message
    //     return redirect()->back()->with('success', 'Pertukaran pejabat pengawasan telah berjaya dikemaskini.');
    // }
}
