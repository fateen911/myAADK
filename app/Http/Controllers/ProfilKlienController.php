<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilKlienController extends Controller
{
    public function senaraiKlien()
    {
        $user = User::where('tahap_pengguna','2')->get();

        return view ('profil_klien.senarai', compact('user'));
    }

    public function maklumatKlien($id)
    {
        $user = User::find($id);

        return view('profil_klien.kemaskini',compact('user'));
    }
}
