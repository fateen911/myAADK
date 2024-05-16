<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TahapPengguna;

class PentadbirController extends Controller
{
    public function senaraiPengguna()
    {
        $user = User::all();
        $tahap = TahapPengguna::all()->sortBy('id');

        return view ('pentadbir.daftar_pengguna', compact('user', 'tahap'));
    }
}
