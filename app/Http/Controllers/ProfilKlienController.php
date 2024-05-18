<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilKlienController extends Controller
{
    public function senaraiKlien()
    {
        $klien = User::where('tahap_pengguna','2')->get();

        return view ('profil_klien.senarai', compact('klien'));
    }

    public function maklumatKlien($id)
    {
        $klien = User::find($id);

        return view('profil_klien.kemaskini',compact('klien'));
    }
}
