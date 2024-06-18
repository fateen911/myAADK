<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponDemografi extends Model
{
    use HasFactory;

    protected $fillable = [
        'klien_id', 
        'rawatan',
        'lain_lain_rawatan',
        'pusat_rawatan',
        'lama_tidak_ambil_dadah',
        'kategori',
        'jumlah_relapse',
        'jenis_dadah',
        'jenis_kediaman',
        'lama_tinggal_lokasi',
        'tinggal_dengan',
        'tinggal_kawasan',
    ];
}
