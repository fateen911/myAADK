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
        'negeri_asal',
        'negeri_baru',
        'daerah_asal',
        'daerah_baru',
    ];

    public function klien()
    {
        return $this->belongsTo(Klien::class);
    }
}
