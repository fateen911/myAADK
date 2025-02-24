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

        DB::connection()->disableQueryLog();

        DB::table('view_pccp_klien as v')
            ->joinSub(
                DB::table('view_pccp_klien')
                    ->select('id_pk', DB::raw('MAX(tkh_tamatPengawasan) as latest_tkh_tamatPengawasan'))
                    ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
                    ->whereIn('id_fasiliti', ['16', '31', '45', '57', '69', '80', '90', '99', '106'])
                    ->groupBy('id_pk'),
                'grouped',
                fn($join) => $join->on('v.id_pk', '=', 'grouped.id_pk')
                                ->on('v.tkh_tamatPengawasan', '=', 'grouped.latest_tkh_tamatPengawasan')
            )
            ->select('v.*')
            ->orderBy('v.id_pk') // Order for consistent chunking
            ->chunk(15000, function ($chunk) {
                // Insert chunk into viewKlien table
                DB::table('viewKlien')->insert($chunk->toArray());
            });

        return view('secondDB.view_klien', compact('data'));
    }
}
