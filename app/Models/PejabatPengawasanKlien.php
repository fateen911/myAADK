<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PejabatPengawasanKlien extends Model
{
    use HasFactory;

    protected $table = 'pejabat_pengawasan_klien';

    protected $fillable = [
        'klien_id',
        'negeri_aadk_asal',
        'daerah_aadk_asal',
        'alamat_rumah_asal',
        'poskod_rumah_asal',
        'negeri_rumah_asal',
        'daerah_rumah_asal',
        'negeri_aadk_baru',
        'daerah_aadk_baru',
        'alamat_rumah_baru',
        'poskod_rumah_baru',
        'negeri_rumah_baru',
        'daerah_rumah_baru',
    ];

    public function klien()
    {
        return $this->belongsTo(Klien::class);
    }
}
