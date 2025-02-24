<?php

namespace App\Http\Controllers;

use App\Models\KlienView;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KlienViewController extends Controller
{
    public function viewKlien()
    {
        // $data = KlienView::limit(20)->get()->toArray(); // Retrieve limited data for testing
        $data = KlienView::whereIn('id_fasiliti', ['16', '31', '45', '57', '69', '80', '90', '99', '106'])
                ->get()
                ->toArray();

        // Insert the retrieved data into the viewKlien table
        if (!empty($data)) {
            DB::table('viewKlien')->insert($data);
        }
        return view('secondDB.view_klien', compact('data'));
    }
}
