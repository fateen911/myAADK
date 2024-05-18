<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaKlien extends Model
{
    use HasFactory;

    protected $table = 'keluarga_klien';

    protected $fillable = [
        'klien_id',
        'nama_waris',
        'no_tel_waris',
        'alamat_waris',
        'poskod_waris',
        'daerah_waris',
        'negeri_waris',
        'hubungan_waris',
        'nama_pasangan',
        'alamat_pasangan',
        'poskod_pasangan',
        'daerah_pasangan',
        'negeri_pasangan',
        'no_tel_pasangan',
        'alamat_kerja_pasangan',
        'poskod_kerja_pasangan',
        'daerah_kerja_pasangan',
        'negeri_kerja_pasangan',
    ];
}
