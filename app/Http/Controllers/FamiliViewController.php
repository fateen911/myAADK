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
            ->join(DB::raw("(  
                SELECT id_pk, tkh_tamatPengawasan,
                    ROW_NUMBER() OVER (PARTITION BY id_pk ORDER BY tkh_tamatPengawasan DESC) as row_num
                FROM view_pccp_klien
                WHERE tkh_tamatPengawasan <= '2025-04-01'
            ) as latest_klien"), function ($join) {
                $join->on('klien.id_pk', '=', 'latest_klien.id_pk')
                    ->on('klien.tkh_tamatPengawasan', '=', 'latest_klien.tkh_tamatPengawasan');
            })
            ->where('latest_klien.row_num', 1)  // Only keep the latest row per id_pk
            ->select('view_pccp_famili.*')
            ->get()
            ->toArray();

        if (!empty($data)) {
            // Insert data in chunks of 500 to avoid database limits
            collect($data)->chunk(500)->each(function ($chunk) {
                DB::table('viewfamili')->insert($chunk->all());
            });
        }

        // Pass the data to the view
        // return view('secondDB.view_famili', compact('data'));
        return redirect()->back();

    }
}
