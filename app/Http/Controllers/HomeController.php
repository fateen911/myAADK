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
            $status = Auth()->user()->status;

            if ($status == 0)
            {
                session()->flash('message', 'Sila kemaskini kata laluan anda terlebih dahulu.');
                return view('profile.update_password');
            }
            else
            {
                if($tahap == 1)
                    return view('dashboard.pentadbir.dashboard');
                else if($tahap == 2)
                    return view('dashboard.klien.dashboard');
                else
                    return view('dashboard.pegawai.dashboard');
            }
        }
    }
}
