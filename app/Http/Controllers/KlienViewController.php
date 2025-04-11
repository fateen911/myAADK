<?php

namespace App\Http\Controllers;

use App\Models\KlienView;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KlienViewController extends Controller
{
    public function viewKlien()
    {
        $data = KlienView::where('tkh_tamatPengawasan', '<=', '2025-04-01')
            // ->where('AADK_Negeri', 'WP Kuala Lumpur')
            // ->limit(50000)
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

    public function addKlien()
    {
        DB::statement("
            INSERT INTO klien_view (
                id_pk, id_ki, no_kp, nama, no_tel, emel, alamat_rumah, poskod, daerah, negeri, 
                jantina, agama, bangsa, tahap_pendidikan, penyakit, status_oku, 
                skor_ccri, daerah_pejabat, negeri_pejabat, status_kemaskini, 
                created_at, updated_at
            )
            WITH latest_klien AS (
                SELECT  
                    a.*,
                    b.negeri_id,
                    c.id AS negeri_alamat,
                    d.id AS daerah_alamat,
                    ROW_NUMBER() OVER (PARTITION BY a.id_pk ORDER BY a.tkh_tamatPengawasan DESC) AS row_num
                FROM 
                    viewklien AS a
                JOIN (
                    SELECT 
                        id_pk, 
                        MAX(tkh_tamatPengawasan) AS latest_tkh_tamatPengawasan
                    FROM 
                        viewklien
                    WHERE 
                        tkh_tamatPengawasan > '2025-04-01'
                        AND mykad NOT IN (
                            '950206015777', '860310015049', '000306030705', '871124496153', 
                            '831006015279', '000414011843', '961001235091', '830320035951', 
                            '930607016190', '801012086949', '910106025154'
                        )
                        AND id_pk NOT IN (
                            '466012','446544','473274','335839','464892',
                            '396387','442697','541241','480367'
                        )
                    GROUP BY id_pk
                ) grouped 
                    ON a.id_pk = grouped.id_pk 
                    AND a.tkh_tamatPengawasan = grouped.latest_tkh_tamatPengawasan
                LEFT JOIN senarai_daerah_pejabat AS b ON a.id_fasiliti = b.kod
                LEFT JOIN senarai_negeri AS c ON a.negeri = c.negeri
                LEFT JOIN senarai_daerah AS d ON a.alamat03 = d.daerah
            )
            SELECT  
                a.id_pk,
                a.id_ki,
                a.mykad AS no_kp,
                UPPER(a.nama),
                REGEXP_REPLACE(TRIM(REPLACE(a.telefon, '-', '')), '[^0-9]', ''),
                a.emel,
                UPPER(CONCAT_WS(' ', a.alamat01, a.alamat02, a.alamat03)),
                CASE 
                    WHEN a.poskod = '' THEN '00000' 
                    WHEN LENGTH(a.poskod) = 5 THEN a.poskod 
                    ELSE LEFT(CONCAT('00000', a.poskod), 5) 
                END,
                IFNULL(a.daerah_alamat, ''),
                a.negeri_alamat,
                a.jantina,
                a.id_agama,
                a.id_bangsa,
                a.id_pendidikan,
                CASE 
                    WHEN a.penyakit IS NULL THEN 'TIADA'
                    ELSE UPPER(
                        SUBSTRING(
                            a.penyakit,
                            LOCATE('s:4:\"nama\";s:', a.penyakit) 
                            + LENGTH('s:4:\"nama\";s:') 
                            + LOCATE(':', SUBSTRING(a.penyakit, LOCATE('s:4:\"nama\";s:', a.penyakit) + LENGTH('s:4:\"nama\";s:'))) 
                            + 1,
                            LOCATE('\";s:4:\"ubat\"', a.penyakit) - (
                                LOCATE('s:4:\"nama\";s:', a.penyakit) 
                                + LENGTH('s:4:\"nama\";s:') 
                                + LOCATE(':', SUBSTRING(a.penyakit, LOCATE('s:4:\"nama\";s:', a.penyakit) + LENGTH('s:4:\"nama\";s:'))) 
                                + 1
                            )
                        )
                    ) 
                END,
                CASE 
                    WHEN a.`kategori oku` IS NULL THEN 'TIADA'
                    ELSE UPPER(a.`kategori oku`)
                END,
                a.markah,
                a.id_fasiliti,
                a.negeri_id,
                'Baharu',
                NULL,
                NULL
            FROM 
                latest_klien a
            WHERE 
                a.row_num = 1
        ");

        return redirect()->back();
    }





}
