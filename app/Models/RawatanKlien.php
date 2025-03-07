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
        'id_pk',
        'id_ki',
        'tkh_perintah',
        'tkh_mula_pengawasan',
        'tkh_tamat_pengawasan',
        'seksyen',
        'puspen',
        'pejabat',
    ];

    public function rawatanProfileUpdateRequests()
    {
        return $this->hasMany(RawatanKlienUpdateRequest::class, 'klien_id');
    }
}
