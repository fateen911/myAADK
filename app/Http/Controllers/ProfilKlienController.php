<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Daerah;
use App\Models\KeluargaKlien;
use App\Models\Negeri;
use App\Models\Klien;
use App\Models\PekerjaanKlien;

class ProfilKlienController extends Controller
{
    // PENTADBIR & STAF
    public function senaraiKlien()
    {
        $klien = Klien::all();

        return view ('profil_klien.senarai', compact('klien'));
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
        $keluarga = KeluargaKlien::where('klien_id', $id)->first();

        return view('profil_klien.kemaskini',compact('daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan','klien','pekerjaan','keluarga'));
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

        // $id = Klien::where('no_kp', Auth::user()->no_kp)->get('id');

        // $butiranKlien = Klien::leftJoin('pekerjaan_klien','pekerjaan_klien.id','=','id')
        // ->leftJoin('keluarga_klien','keluarga_klien.id','=','id')
        // ->where('id',$id)
        // ->first();

        // dd($butiranKlien);
        // Retrieve the client's id based on their no_kp
        $clientId = Klien::where('no_kp', Auth::user()->no_kp)->value('id');

        // Join tables and get the client's details
        $butiranKlien = Klien::leftJoin('pekerjaan_klien', 'klien.id', '=', 'pekerjaan_klien.klien_id')
            ->leftJoin('keluarga_klien', 'klien.id', '=', 'keluarga_klien.klien_id')
            ->where('klien.id', $clientId)
            ->first();

        return view('profil_klien.klien.view',compact('daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan','butiranKlien'));
    }
}
