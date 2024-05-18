<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Daerah;
use App\Models\Negeri;

class ProfilKlienController extends Controller
{
    public function senaraiKlien()
    {
        $klien = User::where('tahap_pengguna','2')->get();

        return view ('profil_klien.senarai', compact('klien'));
    }

    public function maklumatKlien()
    {
        // $klien = User::find($id);
        $negeri = Negeri::orderby("negeri","asc")->get();
        $daerah = Daerah::orderby("daerah","asc")->get();
        $negeriKerja = Negeri::all()->sortBy('negeri');
        $daerahKerja = Daerah::all()->sortBy('daerah');
        $negeriWaris = Negeri::all()->sortBy('negeri');
        $daerahWaris = Daerah::all()->sortBy('daerah');
        $negeriPasangan = Negeri::all()->sortBy('negeri');
        $daerahPasangan = Daerah::all()->sortBy('daerah');
        $negeriKerjaPasangan = Negeri::all()->sortBy('negeri');
        $daerahKerjaPasangan = Daerah::all()->sortBy('daerah');

        return view('profil_klien.kemaskini',compact('daerah','negeri','daerahKerja','negeriKerja','negeriWaris','daerahWaris','negeriPasangan','daerahPasangan','negeriKerjaPasangan','daerahKerjaPasangan'));
    }
}
