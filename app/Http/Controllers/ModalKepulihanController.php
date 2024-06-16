<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModalKepulihanController extends Controller
{
    // KLIEN
    public function soalSelidik()
    {
        return view('modal_kepulihan.klien.soalan_selidik');
    }

    public function soalanDemografi()
    {
        return view('modal_kepulihan.klien.soalan_demografi');
    }
}
