<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $tahap = Auth()->user()->tahap_pengguna;

            if($tahap == 1)
            {
                return view('pentadbir.dashboard');
            }
            else if($tahap == 2)
            {
                return view('klien.dashboard');
            }
            else
            {
                return view('pegawai.dashboard');
            }
        }
    }
}
