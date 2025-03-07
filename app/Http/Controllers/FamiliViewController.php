<?php

namespace App\Http\Controllers;

use App\Models\FamiliView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamiliViewController extends Controller
{
    public function viewFamili()
    {
        $subquery = DB::connection('mysql_support')->table('view_pccp_klien')
            ->select('id_pk', DB::raw('MAX(tkh_tamatPengawasan) AS latest_tkh_tamatPengawasan'))
            ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
            ->groupBy('id_pk');

        $data = DB::connection('mysql_support')->table('view_pccp_klien as a')
            ->joinSub($subquery, 'grouped', function ($join) {
                $join->on('a.id_pk', '=', 'grouped.id_pk')
                    ->on('a.tkh_tamatPengawasan', '=', 'grouped.latest_tkh_tamatPengawasan');
            })
            ->join('mysql_support.view_pccp_famili as b', 'a.id_pk', '=', 'b.id_pk') 
            ->select('b.*', 'a.tkh_tamatPengawasan')
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
