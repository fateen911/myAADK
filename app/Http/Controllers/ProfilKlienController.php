<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Daerah;
use App\Models\KeluargaKlien;
use App\Models\Negeri;
use App\Models\Klien;
use App\Models\PasanganKlien;
use App\Models\PekerjaanKlien;
use App\Models\RawatanKlien;
use App\Models\WarisKlien;
use App\Models\KlienUpdateRequest;
use App\Models\PasanganKlienUpdateRequest;
use App\Models\PekerjaanKlienUpdateRequest;
use App\Models\RawatanKlienUpdateRequest;
use App\Models\WarisKlienUpdateRequest;
use Illuminate\Support\Facades\Log;

class ProfilKlienController extends Controller
{
    // PENTADBIR & STAF
    public function senaraiKlien()
    {
        $klien = Klien::all();

        return view ('profil_klien.pentadbir_pegawai.senarai', compact('klien'));
    }

    public function maklumatKlien($id)
    {
        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');
        $negeriKerja = Negeri::all()->sortBy('negeri');
        $daerahKerja = Daerah::all()->sortBy('daerah');
        $negeriWaris = Negeri::all()->sortBy('negeri');
        $daerahWaris = Daerah::all()->sortBy('daerah');
        $negeriPasangan = Negeri::all()->sortBy('negeri');
        $daerahPasangan = Daerah::all()->sortBy('daerah');
        $negeriKerjaPasangan = Negeri::all()->sortBy('negeri');
        $daerahKerjaPasangan = Daerah::all()->sortBy('daerah');

        $klien = Klien::where('id', $id)->first();
        $pekerjaan = PekerjaanKlien::where('klien_id', $id)->first();
        $waris = WarisKlien::where('klien_id',$id)->first();
        $pasangan = PasanganKlien::where('klien_id',$id)->first();
        $rawatan = RawatanKlien::where('klien_id',$id)->first();

        return view('profil_klien.pentadbir_pegawai.kemaskini',compact('daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan','klien','pekerjaan','waris','pasangan','rawatan'));
    }

    public function kemaskiniMaklumatPeribadiKlien(Request $request, $id)
    {
        $klien = Klien::find($id);

        if ($klien) {
            $klien->update([
                'no_tel' => $request->no_tel,
                'emel' => $request->emel,
                'alamat_rumah' => $request->alamat_rumah,
                'poskod' => $request->poskod,
                'daerah' => $request->daerah,
                'negeri' => $request->negeri,
            ]);
    
            return redirect()->back()->with('success', 'Maklumat profil berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatPekerjaanKlien(Request $request, $id)
    {
        $klien = PekerjaanKlien::where('klien_id',$id)->first();

        if ($klien) {
            $klien->update([
                'pekerjaan' => $request->pekerjaan,
                'pendapatan' => $request->pendapatan,
                'bidang_kerja' => $request->bidang_kerja,
                'alamat_kerja' => $request->alamat_kerja,
                'poskod_kerja' => $request->poskod_kerja,
                'daerah_kerja' => $request->daerah_kerja,
                'negeri_kerja' => $request->negeri_kerja,
                'nama_majikan' => $request->nama_majikan,
                'no_tel_majikan' => $request->no_tel_majikan,
            ]);
    
            return redirect()->back()->with('success', 'Maklumat pekerjaan klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatWarisKlien(Request $request, $id)
    {
        $waris = WarisKlien::where('id',$id)->first();

        if ($waris) {
            $waris->update([
                'nama_waris' => $request->nama_waris,
                'no_tel_waris' => $request->no_tel_waris,
                'alamat_waris' => $request->alamat_waris,
                'poskod_waris' => $request->poskod_waris,
                'daerah_waris' => $request->daerah_waris,
                'negeri_waris' => $request->negeri_waris,
                'hubungan_waris' => $request->hubungan_waris,
            ]);
    
            return redirect()->back()->with('success', 'Maklumat waris klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatPasanganKlien(Request $request, $id)
    {
        $pasangan = PasanganKlien::where('id',$id)->first();

        if ($pasangan) {
            $pasangan->update([
                'status_perkahwinan' => $request->status_perkahwinan,
                'nama_pasangan' => $request->nama_pasangan,
                'no_tel_pasangan' => $request->no_tel_pasangan,
                'alamat_pasangan' => $request->alamat_pasangan,
                'poskod_pasangan' => $request->poskod_pasangan,
                'daerah_pasangan' => $request->daerah_pasangan,
                'negeri_pasangan' => $request->negeri_pasangan,
                'alamat_kerja_pasangan' => $request->alamat_kerja_pasangan,
                'poskod_kerja_pasangan' => $request->poskod_kerja_pasangan,
                'daerah_kerja_pasangan' => $request->daerah_kerja_pasangan,
                'negeri_kerja_pasangan' => $request->negeri_kerja_pasangan,
            ]);
    
            return redirect()->back()->with('success', 'Maklumat pasangan klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function kemaskiniMaklumatRawatanKlien(Request $request, $id)
    {
        $rawatan = RawatanKlien::where('id',$id)->first();

        if ($rawatan) {
            $rawatan->update([
                'status_kesihatan_mental' => $request->status_kesihatan_mental,
                'status_oku' => $request->status_oku,
                'seksyen_okp' => $request->seksyen_okp,
                'tarikh_tamat_pengawasan' => $request->tarikh_tamat_pengawasan,
                'skor_ccri' => $request->skor_ccri,
            ]);
    
            return redirect()->back()->with('success', 'Maklumat rawatan dan pemulihan klien berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Klien tidak dijumpai.');
        }
    }

    public function viewUpdateRequest($id)
    {
        // Find the update request by its ID
        $updateRequest = KlienUpdateRequest::findOrFail($id);

        // Decode the requested data JSON
        $requestedData = json_decode($updateRequest->requested_data, true);
        
        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');
        $negeriKerja = Negeri::all()->sortBy('negeri');
        $daerahKerja = Daerah::all()->sortBy('daerah');
        $negeriWaris = Negeri::all()->sortBy('negeri');
        $daerahWaris = Daerah::all()->sortBy('daerah');
        $negeriPasangan = Negeri::all()->sortBy('negeri');
        $daerahPasangan = Daerah::all()->sortBy('daerah');
        $negeriKerjaPasangan = Negeri::all()->sortBy('negeri');
        $daerahKerjaPasangan = Daerah::all()->sortBy('daerah');

        $klien = Klien::where('id', $id)->first();
        $pekerjaan = PekerjaanKlien::where('klien_id', $id)->first();
        $waris = WarisKlien::where('klien_id',$id)->first();
        $pasangan = PasanganKlien::where('klien_id',$id)->first();
        $rawatan = RawatanKlien::where('klien_id',$id)->first();

        // Pass the update request to the view
        return view('profil_klien.pentadbir_pegawai.approve_update', compact('updateRequest','requestedData','klien','pekerjaan','waris','pasangan','rawatan','daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan'));
    }

    public function approveUpdate(Request $request, $id)
    {
        $updateRequest = KlienUpdateRequest::findOrFail($id);

        if ($request->status == 'Lulus') {
            $client = $updateRequest->client;
            $requestedData = json_decode($updateRequest->requested_data, true);

            // Update the client's profile with the requested data
            $client->update($requestedData);
        }

        $updateRequest->update(['status' => $request->status]);

        // Fetch all daerah and negeri
        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');
        $negeriKerja = Negeri::all()->sortBy('negeri');
        $daerahKerja = Daerah::all()->sortBy('daerah');
        $negeriWaris = Negeri::all()->sortBy('negeri');
        $daerahWaris = Daerah::all()->sortBy('daerah');
        $negeriPasangan = Negeri::all()->sortBy('negeri');
        $daerahPasangan = Daerah::all()->sortBy('daerah');
        $negeriKerjaPasangan = Negeri::all()->sortBy('negeri');
        $daerahKerjaPasangan = Daerah::all()->sortBy('daerah');

        $klien = Klien::where('id', $id)->first();
        $pekerjaan = PekerjaanKlien::where('klien_id', $id)->first();
        $waris = WarisKlien::where('klien_id',$id)->first();
        $pasangan = PasanganKlien::where('klien_id',$id)->first();
        $rawatan = RawatanKlien::where('klien_id',$id)->first();

        return view('profil_klien.pentadbir_pegawai.approve_update', ['updateRequest' => $updateRequest, 'requestedData' => json_decode($updateRequest->requested_data, true)], 
        compact('klien','pekerjaan','waris','pasangan','rawatan','daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan'))
        ->with('success', 'Permintaan Kemaskini telah ' . $request->status . '.');
    }


    // KLIEN
    public function pengurusanProfil()
    {
        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');
        $negeriKerja = Negeri::all()->sortBy('negeri');
        $daerahKerja = Daerah::all()->sortBy('daerah');
        $negeriWaris = Negeri::all()->sortBy('negeri');
        $daerahWaris = Daerah::all()->sortBy('daerah');
        $negeriPasangan = Negeri::all()->sortBy('negeri');
        $daerahPasangan = Daerah::all()->sortBy('daerah');
        $negeriKerjaPasangan = Negeri::all()->sortBy('negeri');
        $daerahKerjaPasangan = Daerah::all()->sortBy('daerah');

        // Retrieve the client's id based on their no_kp
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        // Join tables and get the client's details
        $butiranKlien = Klien::leftJoin('pekerjaan_klien', 'klien.id', '=', 'pekerjaan_klien.klien_id')
            ->leftJoin('waris_klien', 'klien.id', '=', 'waris_klien.klien_id')
            ->leftJoin('pasangan_klien', 'klien.id', '=', 'pasangan_klien.klien_id')
            ->leftJoin('rawatan_klien', 'klien.id', '=', 'rawatan_klien.klien_id')
            ->where('klien.id', $clientId)
            ->first();

        return view('profil_klien.klien.view',compact('daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan','butiranKlien'));
    }

    public function muatTurunProfilDiri()
    {
        $klien_id = Klien::where('no_kp',Auth()->user()->no_kp)->value('id');

        $klien = Klien::where('id',$klien_id)->first();
        $pekerjaan = PekerjaanKlien::where('id',$klien_id)->first();
        $waris = WarisKlien::where('id',$klien_id)->first();
        $pasangan = PasanganKlien::where('id',$klien_id)->first();
        $rawatan = RawatanKlien::where('id',$klien_id)->first();

        $pdf = PDF::loadView('profil_klien.klien.export_profil', compact('klien', 'pekerjaan','waris','pasangan','rawatan'));

        $no_kp = Auth()->user()->no_kp;

        return $pdf->stream($no_kp . '-profil-peribadi.pdf');
    }

    // public function KlienRequestUpdate(Request $request)
    // {
    //     Log::info('KlienRequestUpdate method called');
    //     Log::info('Request data: ', $request->all());

    //     $clientId = Klien::where('no_kp',Auth()->user()->no_kp)->value('id');

    //     $updateRequest = KlienUpdateRequest::create([
    //         'klien_id' => $clientId,
    //         'requested_data' => json_encode($request->except('_token')), // Store all requested fields except CSRF token
    //         'status' => 'Dikemaskini'
    //     ]);

    //     if ($updateRequest) {
    //         Log::info('Update request stored successfully');
    //     } else {
    //         Log::error('Failed to store update request');
    //     }

    //     return redirect()->back()->with('success', 'Permintaan untuk kemaskini anda telah dihantar untuk kelulusan.');
    // }

    public function KlienRequestUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'emel' => 'required|email',
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer',
            'no_kp' => 'required|string|max:12',
            'daerah' => 'required|string|max:255',
            'negeri' => 'required|string|max:255',
            'no_tel' => 'required|string|max:11',
            'poskod' => 'required|string|max:5',
            'alamat_rumah' => 'required|string|max:255',
            'tahap_pendidikan' => 'required|string|max:255',
        ]);
        
        $klienId = Klien::where('no_kp',Auth()->user()->no_kp)->value('id');
        $updateRequest = KlienUpdateRequest::where('klien_id', $klienId)->first();

        if ($updateRequest) {
            // Update existing request
            $updateRequest->update([
                'requested_data' => json_encode($validatedData),
                'status' => 'Dikemaskini', 
            ]);
        } 
        else {
            // Create new request
            KlienUpdateRequest::create([
                'klien_id' => $klienId,
                'requested_data' => json_encode($validatedData),
                'status' => 'Dikemaskini',
            ]);
        }

        return redirect()->back()->with('success', 'Permintaan kemaskini telah dihantar.');
    }

    public function rawatanKlienRequestUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'status_kesihatan_mental' => 'required|string|max:255',
            'status_oku' => 'required|string|max:255',
            'seksyen_okp' => 'required|string|max:255',
            'tarikh_tamat_pengawasan' => 'required|date',
            'skor_ccri' => 'required|double',
        ]);
        
        $klienId = Klien::where('no_kp',Auth()->user()->no_kp)->value('id');
        $updateRequest = RawatanKlienUpdateRequest::where('klien_id', $klienId)->first();

        if ($updateRequest) {
            // Update existing request
            $updateRequest->update([
                'requested_data' => json_encode($validatedData),
                'status' => 'Dikemaskini', 
            ]);
        } 
        else {
            // Create new request
            RawatanKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'requested_data' => json_encode($validatedData),
                'status' => 'Dikemaskini',
            ]);
        }

        return redirect()->back()->with('success', 'Permintaan kemaskini telah dihantar.');
    }

    public function pekerjaanKlienRequestUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'pekerjaan' => 'required|string|max:255',
            'pendapatan' => 'nullable|string|max:255',
            'bidang_kerja' => 'nullable|string|max:255',
            'alamat_kerja' => 'nullable|string|max:255',
            'poskod_kerja' => 'nullable|integer|max:5',
            'daerah_kerja' => 'nullable|string|max:255',
            'negeri_kerja' => 'nullable|string|max:255',
            'nama_majikan' => 'nullable|string|max:255',
            'no_tel_majikan' => 'nullable|string|max:11',
        ]);

        // Temporarily bypass validation for testing
        $validatedData = $request->all();

        $klienId = Klien::where('no_kp',Auth()->user()->no_kp)->value('id');
        $updateRequest = PekerjaanKlienUpdateRequest::where('klien_id', $klienId)->first();

        if ($updateRequest) {
            // Update existing request
            $updateRequest->update([
                'requested_data' => json_encode($validatedData),
                'status' => 'Dikemaskini', 
            ]);
        } 
        else {
            // Create new request
            PekerjaanKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'requested_data' => json_encode($validatedData),
                'status' => 'Dikemaskini',
            ]);
        }

        return redirect()->back()->with('success', 'Permintaan kemaskini telah dihantar.');
    }

    public function warisKlienRequestUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'hubungan_waris' => 'required|string|max:255',
            'nama_waris' => 'required|string|max:255',
            'no_tel_waris' => 'required|string|max:11',
            'alamat_waris' => 'required|string|max:255',
            'poskod_waris' => 'required|string|max:5',
            'daerah_waris' => 'required|string|max:255',
            'negeri_waris' => 'required|string|max:255',
        ]);
        
        $klienId = Klien::where('no_kp',Auth()->user()->no_kp)->value('id');
        $updateRequest = WarisKlienUpdateRequest::where('klien_id', $klienId)->first();

        if ($updateRequest) {
            // Update existing request
            $updateRequest->update([
                'requested_data' => json_encode($validatedData),
                'status' => 'Dikemaskini', // or any other status you prefer
            ]);
        } 
        else {
            // Create new request
            WarisKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'requested_data' => json_encode($validatedData),
                'status' => 'Dikemaskini',
            ]);
        }

        return redirect()->back()->with('success', 'Permintaan kemaskini telah dihantar.');
    }

    public function pasanganKlienRequestUpdate(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'status_perkahwinan' => 'required|string|max:255',
            'nama_pasangan' => 'required|string|max:255',
            'alamat_pasangan' => 'nullable|string|max:255',
            'poskod_pasangan' => 'nullable|string|max:5',
            'daerah_pasangan' => 'nullable|string|max:255',
            'negeri_pasangan' => 'nullable|string|max:255',
            'no_tel_pasangan' => 'nullable|string|max:11',
            'alamat_kerja_pasangan' => 'nullable|string|max:255',
            'poskod_kerja_pasangan' => 'nullable|string|max:5',
            'daerah_kerja_pasangan' => 'nullable|string|max:255',
            'negeri_kerja_pasangan' => 'nullable|string|max:255',
        ]);

        // Check for default select values and set to null if needed
        $validatedData['daerah_pasangan'] = $validatedData['daerah_pasangan'] === 'Pilih Daerah' ? null : $validatedData['daerah_pasangan'];
        $validatedData['negeri_pasangan'] = $validatedData['negeri_pasangan'] === 'Pilih Negeri' ? null : $validatedData['negeri_pasangan'];
        $validatedData['daerah_kerja_pasangan'] = $validatedData['daerah_kerja_pasangan'] === 'Pilih Daerah' ? null : $validatedData['daerah_kerja_pasangan'];
        $validatedData['negeri_kerja_pasangan'] = $validatedData['negeri_kerja_pasangan'] === 'Pilih Negeri' ? null : $validatedData['negeri_kerja_pasangan'];

        // Proceed with the existing logic
        $klienId = Klien::where('no_kp', Auth()->user()->no_kp)->value('id');
        $updateRequest = PasanganKlienUpdateRequest::where('klien_id', $klienId)->first();

        if ($updateRequest) {
            // Update existing request
            $updateRequest->update([
                'requested_data' => json_encode($validatedData, JSON_FORCE_OBJECT), // Ensure NULL values are handled
                'status' => 'Dikemaskini', // or any other status you prefer
            ]);
        } else {
            // Create new request
            PasanganKlienUpdateRequest::create([
                'klien_id' => $klienId,
                'requested_data' => json_encode($validatedData, JSON_FORCE_OBJECT), // Ensure NULL values are handled
                'status' => 'Dikemaskini',
            ]);
        }

        return redirect()->back()->with('success', 'Permintaan kemaskini telah dihantar.');
    }

    // public function pasanganKlienRequestUpdate(Request $request)
    // {
    //     // Validate the incoming request
    //     $validatedData = $request->validate([
    //         'status_perkahwinan' => 'required|string|max:255',
    //         'nama_pasangan' => 'nullable|string|max:255',
    //         'alamat_pasangan' => 'nullable|string|max:255',
    //         'poskod_pasangan' => 'nullable|string|max:5',
    //         'daerah_pasangan' => 'nullable|string|max:255',
    //         'negeri_pasangan' => 'nullable|string|max:255',
    //         'no_tel_pasangan' => 'nullable|string|max:11',
    //         'alamat_kerja_pasangan' => 'nullable|string|max:255',
    //         'poskod_kerja_pasangan' => 'nullable|string|max:5',
    //         'daerah_kerja_pasangan' => 'nullable|string|max:255',
    //         'negeri_kerja_pasangan' => 'nullable|string|max:255',
    //     ]);
        
    //     $klienId = Klien::where('no_kp', Auth()->user()->no_kp)->value('id');
    //     $updateRequest = PasanganKlienUpdateRequest::where('klien_id', $klienId)->first();

    //     // Ensure to debug the incoming request data
    //     Log::info('Request data: ', $validatedData);

    //     if ($updateRequest) {
    //         // Update existing request
    //         $updateRequest->update([
    //             'requested_data' => json_encode($validatedData, JSON_FORCE_OBJECT), // Ensure NULL values are handled
    //             'status' => 'Dikemaskini', // or any other status you prefer
    //         ]);
    //     } else {
    //         // Create new request
    //         PasanganKlienUpdateRequest::create([
    //             'klien_id' => $klienId,
    //             'requested_data' => json_encode($validatedData, JSON_FORCE_OBJECT), // Ensure NULL values are handled
    //             'status' => 'Dikemaskini',
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Permintaan kemaskini telah dihantar.');
    // }

}
