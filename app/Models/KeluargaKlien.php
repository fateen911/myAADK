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
        'status_perkahwinan',
        'nama_pasangan',
        'no_tel_pasangan',
        'bilangan_anak',
        'alamat_pasangan',
        'poskod_pasangan',
        'daerah_pasangan',
        'negeri_pasangan',
        'alamat_kerja_pasangan',
        'poskod_kerja_pasangan',
        'daerah_kerja_pasangan',
        'negeri_kerja_pasangan',
    ];

    public function keluargaProfileUpdateRequests()
    {
        return $this->hasMany(KeluargaKlienUpdateRequest::class, 'klien_id');
    }
}
