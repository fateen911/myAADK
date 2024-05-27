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
}
