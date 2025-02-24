<?php

namespace App\Http\Controllers;

use App\Models\KlienView;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KlienViewController extends Controller
{
    public function viewKlien()
    {
        // Subquery to get the latest 'tkh_tamatPengawasan' per 'id_pk'
        $subQuery = DB::connection('mysql_support')
            ->table('view_pccp_klien')
            ->select('id_pk', DB::raw('MAX(tkh_tamatPengawasan) as latest_tkh_tamatPengawasan'))
            ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
            ->whereIn('id_fasiliti', ['16', '31', '45', '57', '69', '80', '90', '99', '106'])
            ->groupBy('id_pk');

        // Main query joining with the subquery
        $data = KlienView::joinSub($subQuery, 'latest', function ($join) {
                $join->on('view_pccp_klien.id_pk', '=', 'latest.id_pk')
                    ->on('view_pccp_klien.tkh_tamatPengawasan', '=', 'latest.latest_tkh_tamatPengawasan');
            })
            ->whereIn('view_pccp_klien.id_fasiliti', ['16', '31', '45', '57', '69', '80', '90', '99', '106'])
            ->limit(15000) // Limit to 1000 rows
            ->get()
            ->toArray();

        // Insert data into 'viewKlien' table if data is not empty
        if (!empty($data)) {
            DB::table('viewKlien')->insert($data);
        }

        // Pass the data to the view
        return view('secondDB.view_klien', compact('data'));
    }

}
