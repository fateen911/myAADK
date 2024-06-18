<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepulihanKlien extends Model
{
    use HasFactory;

    protected $table = 'keputusan_kepulihan_klien';

    protected $fillable = [
        'klien_id',
        'tahap_kepulihan_id',
        'kebarangkalian_tahap_kepulihan',
        'status_respon',
    ];
}
