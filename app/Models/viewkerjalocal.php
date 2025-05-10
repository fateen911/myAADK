<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewkerjalocal extends Model
{
    use HasFactory;

    protected $table = 'viewkerja';

    protected $fillable = [
        'id_pk',
        'id_kes',
        'tk_status',
        'tk_status_xbekerja',
        'tk_status_xbekerja_lain',
        'tk_pekerjaan',
        'tk_pekerjaan_lain',
        'tk_bidang',
        'tk_status_pekerjaan',
        'tk_gaji',
        'tk_majikan',
        'tk_nama_majikan',
        'tk_nama_majikan_kod',
        'tk_majikan_alamat1',
        'tk_majikan_alamat2',
        'tk_majikan_alamat3',
        'tk_majikan_poskod',
        'tk_majikan_negeri',
        'tk_majikan_notel',
        'tk_kategori_majikan',
        'tk_kump_perkhidmatan',
        'tk_skim_perkhidmatan',
        'tk_awam_pejabat1',
        'tk_awam_pejabat2',
        'tk_kementerian',
        'tk_jns_pendidikan',
        'tk_taraf_pendidikan',
        'tk_jns_persijilan',
        'MODE',
        'tk_status_kv',
        
    ];
}
