<?php

namespace App\Http\Controllers;

use App\Models\WarisView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarisViewController extends Controller
{
    public function viewWaris()
    {
        $data = WarisView::from('mysql_support.kerja_view as kerja')
            ->join('mysql_support.view_pccp_klien as klien', 'kerja.id_klien', '=', 'klien.id')
            ->where('klien.id_fasiliti', '31')
            ->where('klien.tkh_tamatPengawasan', '<=', '2025-04-01')
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
        return view('secondDB.view_waris', compact('data'));

    }
}
