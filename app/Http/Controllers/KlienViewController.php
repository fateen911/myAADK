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
        $data = KlienView::whereIn('id_fasiliti', ['16', '31', '45', '57', '69', '80', '90', '99', '106'])
                ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
                ->whereIn(DB::raw('(id_pk, tkh_tamatPengawasan)'), function ($query) {
                    $query->selectRaw('id_pk, MAX(tkh_tamatPengawasan)')
                        ->from('view_pccp_klien')
                        ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
                        ->whereIn('id_fasiliti', ['16', '31', '45', '57', '69', '80', '90', '99', '106'])
                        ->groupBy('id_pk');
                })
                ->get()
                ->limit(15000)
                ->toArray();

        // Insert the retrieved data into the viewKlien table
        if (!empty($data)) {
            DB::table('viewKlien')->insert($data);
        }
        return view('secondDB.view_klien', compact('data'));
    }
}
