<?php

namespace App\Http\Controllers;

use App\Models\KlienView;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KlienViewController extends Controller
{
    public function viewKlien()
    {
        $data = KlienView::whereIn('id_fasiliti', ['31'])
                // ->limit(1000)        
                ->get()
                ->toArray();
        if (!empty($data)) {
            DB::table('viewKlien')->insert($data);
        }
        // Pass the data to the view
        return view('secondDB.view_klien', compact('data'));
    }

}
