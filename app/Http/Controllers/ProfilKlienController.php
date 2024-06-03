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


        // PERIBADI
        $klien = Klien::where('id', $id)->first();
        $requestKlien = KlienUpdateRequest::where('klien_id', $id)->where('status', 'Dikemaskini')->first();
        $updateRequestKlien = KlienUpdateRequest::where('klien_id', $id)->first();
        // Decode the requested data updates
        $requestedDataKlien = json_decode($updateRequestKlien->requested_data, true);
                                  

        // PEKERJAAN  
        $pekerjaan = PekerjaanKlien::where('klien_id', $id)->first();
        $requestPekerjaan = PekerjaanKlienUpdateRequest::where('klien_id', $id)->where('status', 'Dikemaskini')->first();
        $updateRequestPekerjaan = PekerjaanKlienUpdateRequest::where('klien_id', $id)->first();
        $requestedDataPekerjaan = json_decode($updateRequestPekerjaan->requested_data, true);

        // WARIS
        $waris = WarisKlien::where('klien_id',$id)->first();
        $requestWaris = WarisKlienUpdateRequest::where('klien_id', $id)->where('status', 'Dikemaskini')->first();
        $updateRequestWaris = WarisKlienUpdateRequest::where('klien_id', $id)->first();
        $requestedDataWaris = json_decode($updateRequestWaris->requested_data, true);

        // PASANGAN
        $pasangan = PasanganKlien::where('klien_id',$id)->first();
        $requestPasangan = PasanganKlienUpdateRequest::where('klien_id', $id)->where('status', 'Dikemaskini')->first();
        $updateRequestPasangan = PasanganKlienUpdateRequest::where('klien_id', $id)->first();
        $requestedDataPasangan = json_decode($updateRequestPasangan->requested_data, true);

        // RAWATAN
        $rawatan = RawatanKlien::where('klien_id',$id)->first();
        $requestRawatan = RawatanKlienUpdateRequest::where('klien_id', $id)->where('status', 'Dikemaskini')->first();
        $updateRequestRawatan = RawatanKlienUpdateRequest::where('klien_id', $id)->first();
        $requestedDataRawatan = json_decode($updateRequestRawatan->requested_data, true);

        return view('profil_klien.pentadbir_pegawai.kemaskini', compact('daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan',
                                                                        'klien', 'requestKlien', 'updateRequestKlien','requestedDataKlien',
                                                                        'pekerjaan','requestPekerjaan', 'updateRequestPekerjaan','requestedDataPekerjaan', 
                                                                        'waris', 'requestWaris', 'updateRequestWaris','requestedDataWaris',
                                                                        'pasangan', 'requestPasangan', 'updateRequestPasangan','requestedDataPasangan',
                                                                        'rawatan', 'requestRawatan', 'updateRequestRawatan','requestedDataRawatan',));
    }

    // CURRENT METHOD OF APPROVAL CLIENT'S REQUEST
    public function approveUpdateKlien(Request $request, $id)
    {
        $updateRequest = KlienUpdateRequest::where('klien_id', $id)->first();
        $klien = Klien::where('id', $id)->first();

        if ($request->status == 'Lulus') {
            $requestedDataKlien = json_decode($updateRequest->requested_data, true);

            // Update the _klien with the requested data
            $klien->update($requestedDataKlien);
            $updateRequest->update(['status' => $request->status]);

            return redirect()->back()->with('success', 'Maklumat peribadi klien telah berjaya dikemaskini.');
        }
        else{
            $updateRequest->update(['status' => $request->status]);
            return redirect()->back()->with('error', 'Maklumat peribadi klien tidak berjaya dikemaskini.');
        }   
    }

    public function approveUpdateRawatan(Request $request, $id)
    {
        $updateRequestRawatan = RawatanKlienUpdateRequest::where('klien_id', $id)->first();
        $rawatanKlien = RawatanKlien::where('klien_id', $id)->first();

        if ($request->status == 'Lulus') {
            $requestedDataRawatan = json_decode($updateRequestRawatan->requested_data, true);

            // Update the Rawatan_klien with the requested data
            $rawatanKlien->update($requestedDataRawatan);
            $updateRequestRawatan->update(['status' => $request->status]);

            return redirect()->back()->with('success', 'Maklumat rawatan klien telah berjaya dikemaskini.');
        }
        else{
            $updateRequestRawatan->update(['status' => $request->status]);
            return redirect()->back()->with('error', 'Maklumat rawatan klien tidak berjaya dikemaskini.');
        }     
    }

    public function approveUpdatePekerjaan(Request $request, $id)
    {
        $updateRequestPekerjaan = PekerjaanKlienUpdateRequest::where('klien_id', $id)->first();
        $pekerjaanKlien = PekerjaanKlien::where('klien_id', $id)->first();

        if ($request->status == 'Lulus') {
            $requestedData = json_decode($updateRequestPekerjaan->requested_data, true);

            // Update the pekerjaan_klien with the requested data
            $pekerjaanKlien->update($requestedData);
            $updateRequestPekerjaan->update(['status' => $request->status]);

            return redirect()->back()->with('success', 'Maklumat pekerjaan klien telah berjaya dikemaskini.');
        }
        else{
            $updateRequestPekerjaan->update(['status' => $request->status]);
            return redirect()->back()->with('error', 'Maklumat pekerjaan klien tidak berjaya dikemaskini.');
        }   
    }

    public function approveUpdateWaris(Request $request, $id)
    {
        $updateRequestWaris = WarisKlienUpdateRequest::where('klien_id', $id)->first();
        $warisKlien = WarisKlien::where('klien_id', $id)->first();

        if ($request->status == 'Lulus') {
            $requestedDataWaris = json_decode($updateRequestWaris->requested_data, true);

            // Update the Waris_klien with the requested data
            $warisKlien->update($requestedDataWaris);
            $updateRequestWaris->update(['status' => $request->status]);

            return redirect()->back()->with('success', 'Maklumat waris klien telah berjaya dikemaskini.');
        }
        else{
            $updateRequestWaris->update(['status' => $request->status]);
            return redirect()->back()->with('error', 'Maklumat waris klien tidak berjaya dikemaskini.');
        }    
    }

    public function approveUpdatePasangan(Request $request, $id)
    {
        $updateRequestPasangan = PasanganKlienUpdateRequest::where('klien_id', $id)->first();
        $pasanganKlien = PasanganKlien::where('klien_id', $id)->first();

        if ($request->status == 'Lulus') {
            $requestedDataPasangan = json_decode($updateRequestPasangan->requested_data, true);

            // Update the Pasangan_klien with the requested data
            $pasanganKlien->update($requestedDataPasangan);
            $updateRequestPasangan->update(['status' => $request->status]);

            return redirect()->back()->with('success', 'Maklumat pasangan klien telah berjaya dikemaskini.');
        }
        else{
            $updateRequestPasangan->update(['status' => $request->status]);
            return redirect()->back()->with('error', 'Maklumat pasangan klien tidak berjaya dikemaskini.');
        }   
    }


    // UPDATE WITHOUT REQUEST
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

    // TEST
    public function viewClientProfile($clientId)
    {
        // Fetch client information
        $klien = Klien::findOrFail($clientId);

        // Fetch pending profile update request, if any
        $profileUpdateRequest = PasanganKlienUpdateRequest::where('klien_id', $clientId)
                                                    ->where('status', 'Dikemaskini')
                                                    ->first();

        $negeri = Negeri::all()->sortBy('negeri');
        $daerah = Daerah::all()->sortBy('daerah');

        return view('profil_klien.pentadbir_pegawai.test', compact('klien', 'profileUpdateRequest', 'daerah', 'negeri'));
    }

    // QIV UPDATE WITH APPROVE THE CLIENT'S REQUEST
    // public function approveClientProfileUpdate(Request $request, $id)
    // {
    //     $profileUpdateRequest = PasanganKlienUpdateRequest::findOrFail($id);
    //     $requestedData = json_decode($profileUpdateRequest->requested_data, true);
    //     $klien = PasanganKlien::findOrFail($profileUpdateRequest->klien_id);

    //     if ($request->has('approve_field')) {
    //         $field = $request->input('approve_field');
    //         $klien->$field = $requestedData[$field];
    //         $klien->save();

    //         // Remove the approved field from the requested data
    //         unset($requestedData[$field]);
    //         if (empty($requestedData)) {
    //             $profileUpdateRequest->status = 'Lulus';
    //             $profileUpdateRequest->save();
    //         } else {
    //             $profileUpdateRequest->requested_data = json_encode($requestedData);
    //             $profileUpdateRequest->save();
    //         }
    //     } elseif ($request->has('reject_field')) {
    //         $field = $request->input('reject_field');

    //         // Remove the rejected field from the requested data
    //         unset($requestedData[$field]);
    //         if (empty($requestedData)) {
    //             $profileUpdateRequest->status = 'Ditolak';
    //             $profileUpdateRequest->save();
    //         } else {
    //             $profileUpdateRequest->requested_data = json_encode($requestedData);
    //             $profileUpdateRequest->save();
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Profile update processed successfully.');
    // }

    // public function rejectProfileUpdate(Request $request, $clientId)
    // {
    //     // Fetch the pending update request
    //     $profileUpdateRequest = KlienUpdateRequest::where('klien_id', $clientId)
    //                                                 ->where('status', 'Dikemaskini')
    //                                                 ->firstOrFail();

    //     // Mark the request as rejected
    //     $profileUpdateRequest->status = 'Ditolak';
    //     $profileUpdateRequest->save();

    //     return redirect()->back()->with('success', 'Profile update request rejected.');
    // }


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
            'skor_ccri' => 'required|numeric',
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
        // dd($request->all());

        $validatedData = $request->validate([
            'pekerjaan' => 'required|string|max:255',
            'pendapatan' => 'nullable|string|max:255',
            'bidang_kerja' => 'nullable|string|max:255',
            'alamat_kerja' => 'nullable|string|max:255',
            'poskod_kerja' => 'nullable|integer',
            'daerah_kerja' => 'nullable|string|max:255',
            'negeri_kerja' => 'nullable|string|max:255',
            'nama_majikan' => 'nullable|string|max:255',
            'no_tel_majikan' => 'nullable|string|max:11',
        ]);        

        // Temporarily bypass validation for testing
        $validatedData = $request->all();

        // Remove the CSRF token from the validated data
        unset($validatedData['_token']);

        // Set default values to null if they match "Pilih Daerah" or "Pilih Negeri"
        if ($validatedData['daerah_kerja'] === 'Pilih Daerah') {
            $validatedData['daerah_kerja'] = null;
        }
        if ($validatedData['negeri_kerja'] === 'Pilih Negeri') {
            $validatedData['negeri_kerja'] = null;
        }
        
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

}
