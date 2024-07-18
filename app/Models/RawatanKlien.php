<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatanKlien extends Model
{
    use HasFactory;

    protected $table = 'rawatan_klien';

    protected $fillable = [
        'klien_id',
        'status_kesihatan_mental',
        'status_oku',
        'seksyen_okp',
        'tarikh_tamat_pengawasan',
        'skor_ccri',
    ];

    public function rawatanProfileUpdateRequests()
    {
        return $this->hasMany(RawatanKlienUpdateRequest::class, 'klien_id');
    }
}
