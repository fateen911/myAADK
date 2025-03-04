<?php

namespace App\Http\Controllers;

use App\Models\KlienView;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KlienViewController extends Controller
{
    public function viewKlien()
    {
        $data = KlienView::where('AADK_Negeri', 'Kedah')
            ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
            ->limit(50000)
            ->get()
            ->toArray();

        if (!empty($data)) {
            // Insert data in chunks of 500 to avoid database limits
            collect($data)->chunk(500)->each(function ($chunk) {
                DB::table('viewklien')->insert($chunk->all());
            });
        }


        // Pass the data to the view
        // return view('secondDB.view_klien', compact('data'));
        return redirect()->back();

    }

    public function viewKlienUpdate()
    {
        ini_set('max_execution_time', 0); // Prevent timeout

        // List of mykad values to filter
        $mykadList = [
            '950206015777', '860310015049', '000306030705', '871124496153',
            '831006015279', '000414011843', '961001235091', '830320035951',
            '930607016190', '801012086949', '910106025154'
        ];

        // Retrieve data from KlienView with filters
        $data = KlienView::select('id_pk', 'id_ki', 'alamat01', 'alamat02', 'alamat03', 'poskod', 'negeri', 'mykad')
            ->where('id_fasiliti', '31')
            ->where('tkh_tamatPengawasan', '<=', '2025-04-01')
            ->whereIn('mykad', $mykadList)
            ->get();

        // Proceed if data is not empty
        if ($data->isNotEmpty()) {
            // Process in chunks of 500 to avoid overload
            $data->chunk(500)->each(function ($chunk) {
                foreach ($chunk as $row) {
                    // Update viewklien_new where id_pk, id_ki, and mykad match
                    DB::update("
                        UPDATE viewklien_new 
                        SET alamat01 = ?, alamat02 = ?, alamat03 = ?, poskod = ?, negeri = ?
                        WHERE id_pk = ? AND id_ki = ? AND mykad = ?",
                        [
                            $row->alamat01,
                            $row->alamat02,
                            $row->alamat03,
                            $row->poskod,
                            $row->negeri,
                            $row->id_pk,
                            $row->id_ki,
                            $row->mykad
                        ]
                    );
                }
            });
        }

        // Pass the data to the view
        return view('secondDB.view_klien', compact('data'));
    }




}
