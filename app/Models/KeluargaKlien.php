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
        'status_kemaskini',

        'nama_bapa',
        'no_kp_bapa',
        'no_tel_bapa',
        'alamat_bapa',
        'poskod_bapa',
        'daerah_bapa',
        'negeri_bapa',
        'status_bapa',

        'nama_ibu',
        'no_kp_ibu',
        'no_tel_ibu',
        'alamat_ibu',
        'poskod_ibu',
        'daerah_ibu',
        'negeri_ibu',
        'status_ibu',

        'nama_penjaga',
        'no_kp_penjaga',
        'no_tel_penjaga',
        'alamat_penjaga',
        'poskod_penjaga',
        'daerah_penjaga',
        'negeri_penjaga',
        'status_penjaga'
    ];

    public function warisProfileUpdateRequests()
    {
        return $this->hasMany(KeluargaKlienUpdateRequest::class, 'klien_id');
    }
}
