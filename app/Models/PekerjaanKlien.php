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
        'pekerjaan',
        'pendapatan',
        'bidang_kerja',
        'alamat_kerja',
        'poskod_kerja',
        'daerah_kerja',
        'negeri_kerja',
        'nama_majikan',
        'no_tel_majikan',
    ];

    public function pekerjaanProfileUpdateRequests()
    {
        return $this->hasMany(PekerjaanKlienUpdateRequest::class, 'klien_id');
    }
}
