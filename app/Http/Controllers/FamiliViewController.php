<?php

namespace App\Http\Controllers;

use App\Models\FamiliView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamiliViewController extends Controller
{
    public function viewFamili()
    {
        $data = FamiliView::join('view_pccp_klien as klien', 'view_pccp_famili.id_pk', '=', 'klien.id_pk')
            ->where('klien.id_fasiliti', '31')
            ->where('klien.tkh_tamatPengawasan', '<=', '2025-04-01')
            ->select('view_pccp_famili.*')
            ->limit(10000)
            ->get()
            ->toArray();

        if (!empty($data)) {
            // Insert data in chunks of 500 to avoid database limits
            collect($data)->chunk(500)->each(function ($chunk) {
                DB::table('viewklien')->insert($chunk->all());
            });
        }



        // Pass the data to the view
        return view('secondDB.view_famili', compact('data'));

    }
}
