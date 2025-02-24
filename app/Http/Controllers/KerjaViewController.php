<?php

namespace App\Http\Controllers;

use App\Models\KerjaView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KerjaViewController extends Controller
{
    public function viewKerja()
    {
        $data = KerjaView::join('view_pccp_klien as klien', 'kerja_view.id_pk', '=', 'klien.id_pk')
            ->where('klien.id_fasiliti', '31')
            ->where('klien.tkh_tamatPengawasan', '<=', '2025-04-01')
            ->limit(10000)
            ->get()
            ->toArray();



        if (!empty($data)) {
            // Insert data in chunks of 500 to avoid database limits
            collect($data)->chunk(500)->each(function ($chunk) {
                DB::table('viewkerja')->insert($chunk->all());
            });
        }



        // Pass the data to the view
        return view('secondDB.view_kerja', compact('data'));

    }
}
