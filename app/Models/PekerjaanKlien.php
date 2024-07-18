<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanKlien extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan_klien';

    protected $fillable = [
        'klien_id',
        'status_kerja',
        'bidang_kerja',
        'nama_kerja',
        'pendapatan',
        'kategori_majikan',
        'nama_majikan',
        'no_tel_majikan',
        'alamat_kerja',
        'poskod_kerja',
        'daerah_kerja',
        'negeri_kerja',  
    ];

    public function pekerjaanProfileUpdateRequests()
    {
        return $this->hasMany(PekerjaanKlienUpdateRequest::class, 'klien_id');
    }
}
