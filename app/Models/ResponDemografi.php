<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponDemografi extends Model
{
    use HasFactory;

    protected $table = 'respon_soalan_demografi';

    protected $fillable = [
        'klien_id', 
        'rawatan',
        'lain_lain_rawatan',
        'pusat_rawatan',
        'tempoh_tidak_ambil_dadah',
        'kategori',
        'jumlah_relapse',
        'jenis_dadah',
        'jenis_kediaman',
        'tempoh_tinggal_lokasi_terkini',
        'tinggal_dengan',
        'kawasan_tempat_tinggal',
    ];
}
