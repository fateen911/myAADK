<?php

namespace App\Http\Controllers;

use App\Models\KlienView;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KlienViewController extends Controller
{
    public function viewKlien()
    {
        // Chunk size to manage large datasets safely
        $chunkSize = 1000;

        // Subquery to get the latest 'tkh_tamatPengawasan' per 'id_pk'
        $subQuery = DB::connection('mysql_support')
            ->table('view_pccp_klien')
            ->select('id_pk', DB::raw('MAX(tkh_tamatPengawasan) as latest_tkh_tamatPengawasan'))
            ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
            ->whereIn('id_fasiliti', ['16', '31', '45', '57', '69', '80', '90', '99', '106'])
            ->groupBy('id_pk');

        // Fetch and insert data in chunks
        DB::connection('mysql_support')
            ->table('view_pccp_klien as v')
            ->joinSub($subQuery, 'latest', function ($join) {
                $join->on('v.id_pk', '=', 'latest.id_pk')
                    ->on('v.tkh_tamatPengawasan', '=', 'latest.latest_tkh_tamatPengawasan');
            })
            ->whereIn('v.id_fasiliti', ['16', '31', '45', '57', '69', '80', '90', '99', '106'])
            ->orderBy('v.id_pk') // Optional: ensures stable chunking
            ->chunk($chunkSize, function ($records) {
                if ($records->isNotEmpty()) {
                    DB::table('viewKlien')->insert($records->toArray());
                }
            });

        

        // Pass the data to the view
        return view('secondDB.view_klien', compact('data'));
    }

}
