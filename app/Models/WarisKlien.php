<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarisKlien extends Model
{
    use HasFactory;

    protected $table = 'waris_klien';

    protected $fillable = [
        'klien_id',
        'hubungan_waris',
        'nama_waris',
        'no_tel_waris',
        'alamat_waris',
        'poskod_waris',
        'daerah_waris',
        'negeri_waris',
    ];
}
