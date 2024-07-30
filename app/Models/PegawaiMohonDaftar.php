<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiMohonDaftar extends Model
{
    use HasFactory;

    protected $table = 'pegawai_mohon_daftar';

    protected $fillable = [
        'no_kp',
        'nama',
        'emel',
        'no_tel',
        'jawatan',
        'peranan',
        'negeri_bertugas',
        'daerah_bertugas',
        'status'
    ];
}
