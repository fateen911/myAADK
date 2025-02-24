<?php

namespace App\Http\Controllers;

use App\Models\KlienView;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KlienViewController extends Controller
{
    public function viewKlien()
    {
        $data = KlienView::where('id_fasiliti', '31')
            ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
            ->limit(5000)
            ->get()
            ->toArray();

        if (!empty($data)) {
            // Insert data in chunks of 500 to avoid database limits
            collect($data)->chunk(500)->each(function ($chunk) {
                DB::table('viewKlien')->insert($chunk->toArray());
            });
        }


        // Pass the data to the view
        return view('secondDB.view_klien', compact('data'));

    }

}
