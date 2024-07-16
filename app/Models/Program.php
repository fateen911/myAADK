<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';

    protected $fillable = [
        'pegawai_id',
        'kategori_id',
        'nama',
        'objektif',
        'tarikh_mula',
        'tarikh_tamat',
        'tempat',
        'penganjur',
        'nama_pegawai',
        'no_tel_dihubungi',
        'catatan',
        'pautan_pengesahan',
        'qr_pengesahan',
        'pautan_perekodan',
        'qr_perekodan',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function pegesahanKehadiranProgram()
    {
        return $this->hasMany(PengesahanKehadiranProgram::class);
    }

    public function perekodanKehadiranProgram()
    {
        return $this->hasMany(PerekodanKehadiranProgram::class);
    }
}
