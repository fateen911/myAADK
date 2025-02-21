<?php

namespace App\Http\Controllers;

use App\Models\KlienView;
use Illuminate\Http\Request;

class KlienViewController extends Controller
{
    public function viewKlien()
    {
        $data = KlienView::limit(20)->get(); // Retrieve limited data for testing
        return view('secondDB.view_klien', compact('data'));
    }
}
