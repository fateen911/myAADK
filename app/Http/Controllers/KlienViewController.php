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
        return view('secondDB.view_klien', compact('data'));

    }

    public function viewKlienUpdate()
    {
        // Select specific columns from KlienView
        $data = KlienView::select('id_pk', 'id_ki', 'alamat01', 'alamat02', 'alamat03', 'poskod', 'negeri')
            ->where('id_fasiliti', '31')
            ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
            ->get();

        if ($data->isNotEmpty()) {
            // Process updates in chunks of 500 to avoid database limits
            $data->chunk(500)->each(function ($chunk) {
                foreach ($chunk as $row) {
                    DB::table('viewklien_new')
                        ->where('id_pk', $row->id_pk)
                        ->where('id_ki', $row->id_ki)
                        ->update([
                            'alamat01' => $row->alamat01,
                            'alamat02' => $row->alamat02,
                            'alamat03' => $row->alamat03,
                            'poskod'   => $row->poskod,
                            'negeri'   => $row->negeri,
                        ]);
                }
            });
        }

        // Pass the data to the view
        return view('secondDB.view_klien', compact('data'));
    }


}
