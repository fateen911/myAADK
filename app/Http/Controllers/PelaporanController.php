<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    public function modalKepulihan()
    {
        return view('pelaporan.modal_kepulihan');
    }
    public function aktiviti()
    {
        return view('pelaporan.aktiviti');
    }
}
