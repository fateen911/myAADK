<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasanganKlien extends Model
{
    use HasFactory;

    protected $table = 'pasangan_klien';

    protected $fillable = [
        'klien_id',
        'status_perkahwinan',
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
